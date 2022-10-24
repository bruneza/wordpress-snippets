<?php

// echo '<br>***$terms****<br>';
// print_r($terms);
// echo '<br>**************<br>';

/*** ANCHOR: Validate Function */
function validateEleSetting($settings, $field, $condition = null)
{
    if (!isset($field)) return false;
    if (isset($settings[$field])) return false;

    return $settings[$field];
}

function validateNeededFields($settings, $field)
{
    if (!isset($field)) return false;
    if (!isset($settings)) return false;

    if ($settings[$field])
        $neededFields =  $settings[$field];
    else
        $neededFields =  ['post-link'];

    return $neededFields;
}


function validateEleCPT($settings, $field, $altField = null)
{
    if (isset($settings[$field]) && $settings[$field] != 'ino-query')
        $postType = $settings[$field];
    else if (isset($settings[$altField]))
        $postType = $settings[$altField];
    else
        $postType = null;

    return $postType;
}

function validatedSettings($arr)
{
    $defArr = [
        'x_post_type' => 'post',
        'x_posts_per_page' => -1,
        'x_terms' => null,
        'x_outputs' => null,
        'x_taxonomy' => null,
        'x_ignore' => null,
        'x_show' => 'all',
        'x_conditions' => [
            'x_skip_nothumbnail' => false,
        ],
    ];


    foreach ($arr as $key => $val) {
        if (isset($arr[$key]) && !empty($arr[$key])) {
            $sanitize_arr[$key] = $val;
        }
    }
    $arr = $sanitize_arr;

    $defArr = wp_parse_args($arr, $defArr);

    return $defArr;
}

/*** End Validate Function */

/*** ANCHOR: PROCESS Function */
function processSingleIcon($array)
{
    $value = $array['value'];
    $library = $array['library'];
    $output = null;

    if (empty($library)) {
        return false;
    }

    if ('svg' === $library) {
        if (!isset($value['id'])) return '';

        $output = get_post_meta($value['id'], '_elementor_inline_svg', true);
    } else {
        $output = '<i aria-hidden="true" class="' . $value . '"></i>';
    }

    return apply_filters('post_filter_icon', $output);
}

function processTerms($terms)
{
    $output = array();
    if (is_wp_error($terms)) return false;

    foreach ($terms as $key => $term) {

        $taxInfo = get_taxonomy($term->taxonomy);

        $output[$term->taxonomy . ':' . $term->term_id] = [
            'term_id' => $term->term_id,
            'slug' => $term->slug,
            'name' => $term->name,
            'taxonomy' => $term->taxonomy,
            'taxonomy_label' => $taxInfo->label,
            'post_type' => $taxInfo->object_type,
            'post-count' => $term->count,
            'term-link' => get_term_link($term, $term->taxonomy)
        ];
    }
    return $output;
}

function processTermIds($ids)
{
    if (!isset($ids) && !is_array($ids)) return false;
    $output = [];

    foreach ($ids as $key => $value) {
        $terms = get_term($value);

        if (!isset($terms)) continue;

        $output[$value] = [
            'slug' => $terms->slug,
            'name' => $terms->name,
            'taxonomy' => $terms->taxonomy,
            'post_type' => $terms->post_type,
            'label' =>  $terms->label,
            'post-count' =>  $terms->count,
            'term-link' => get_term_link($terms, $terms->taxonomy)
        ];
    }

    return $output;
}

function processArgs($additionalArgs, $conditions = null)
{
    $thumbnailArgs = null;
    $defaultArgs = array(
        'posts_per_page'         =>  -1,
        'order'                  => 'DESC',
        'orderby'                => 'date',
    );

    if (isset($conditions)) {
        if (!empty($conditions['x_skip_nothumbnail'])) {
            $thumbnailArgs = array(
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ),
                ),
            );

            $additionalArgs = wp_parse_args($thumbnailArgs, $additionalArgs);
        }
    }

    return wp_parse_args($additionalArgs, $defaultArgs);
}

/**
 * processOutput
 *
 * @param  array $input
 * @return array
 */
function processOutput($inputArray = null)
{

    $finalOutput = array();
    $fields = array();
    $arg = null;
    if (!isset($inputArray)) {
        $arg = [
            'post_type' => null,
        ];
        $query = new WP_Query($arg);
    }
    if (isset($inputArray['query']) && isset($inputArray)) {
        $query = $inputArray['query'];
    }

    if (isset($inputArray['post_type']) && isset($inputArray)) {
        $arg = [
            'post_type' => $inputArray['post_type'],
        ];
        $query = new WP_Query($arg);
    }


    while ($query->have_posts()) {
        $post = $query->the_post();

        $post_id = get_the_ID();
        $initDate = wp_date("d-m-Y", get_post_timestamp());
        $today = date_create(date("d-m-Y"));
        $output['post_type'] = esc_attr(get_post_type($post));
        $output['id'] = $post_id;
        $output['title'] = esc_attr(get_the_title());
        $output['slug'] = esc_attr(get_post_field('post_name', $post_id));
        $output['excerpt'] = esc_attr(wp_trim_words(get_the_excerpt(), 15, '...'));
        // $output['content'] = esc_attr(wp_strip_all_tags(get_the_content()));
        $output['author'] = esc_attr(get_the_author_meta('display_name'));
        $output['thumbnail'] = get_the_post_thumbnail_url();
        $output['post-link'] = get_permalink();
        $output['date'] = esc_attr(get_the_date());
        $output['posted-date'] = esc_html($initDate);

        $postMeta = get_post_custom_keys($post_id);

        //ANCHOR - Process Custom Keys
        foreach ($postMeta as $key) {

            $skip = [
                '_edit_lock', '_thumbnail_id', '_edit_lock', 'ekit_post_views_count',
                '_edit_last', '_elementor_template_type', '_elementor_version', '_elementor_pro_version',
                'rs_page_bg_color', '_elementor_pro_version'
            ];


            if (in_array($key, $skip)) continue;
            $value = get_post_meta($post_id, $key, true);
            $key = ltrim($key, '_');
            if (DateTime::createFromFormat('Y-m-d', $value) == true)
                $output[$key] = date('d M Y', strtotime($value));
            else
                $output[$key] = $value;
        }
        $output['terms'] = getPostTerms($post_id);

        $selectedOutputs = null;
        If($inputArray && isset($inputArray['fields'])){
        foreach ($output as $key => $value) {
                if(in_array($key, $inputArray['fields'])){
                    $selectedOutputs[$key] =$value;
                }
        }
    } else{
        $selectedOutputs = $output;
    }

        array_push($finalOutput,  $selectedOutputs);
    }

    foreach (array_keys($output) as $out) {
        $label = ucfirst(str_replace(str_split('-_'), ' ', $out));
        $fields[$out] = esc_html($label);
    }

    $OutputData = ['data' => $finalOutput, 'fields' => $fields];


    return apply_filters('ino_process_outputs', $OutputData);
}

/*** End PROCESS Function */

/*** ANCHOR: TERMS Function */

function getTerms($inoSettings = null)
{
    $inoSettings = validatedSettings($inoSettings);

    $taxonomies     =   $inoSettings['x_taxonomy'];
    $termsArray   =   $inoSettings['x_terms'];

    $terms = array();

    if (isset($termsArray)) {
        return processTermIds($termsArray);
    }

    if (isset($taxonomies)) {
        foreach ($taxonomies as $key => $taxonomy) {
            $terms = processTerms(get_terms($taxonomy));
        }
        return $terms;
    }
}

function getPostTerms($post_id, $taxonomy = null)
{
    $terms = null;
    if (!isset($post_id)) return null;
    if (!isset($taxonomy))
        $taxonomies = get_post_taxonomies($post_id);
    else
        $taxonomies = [$taxonomy];

    foreach ($taxonomies as $key => $taxonomy) {
        if (empty(get_taxonomy($taxonomy)->show_ui)) continue;
        $terms = processTerms(get_terms($taxonomy));
    }
    return $terms;
}

/*** End TERMS Function */

/*** ANCHOR: POSTS Function */
function postsRender($inoSettings = null)
{
    // ANCHOR: Blank Array
    $selectedTerms = array();

    // ANCHOR: Retrieve Settings from Widget
    $inoSettings = validatedSettings($inoSettings);
    if (is_string($inoSettings)) {
        $postType = $inoSettings;
        $NumofPosts = -1;
    } else if (is_array($inoSettings)) {
        $postType   =  $inoSettings['x_post_type'];
        $NumofPosts =  $inoSettings['x_posts_per_page'];
        $terms      =  $inoSettings['x_terms'];
        $display      =  $inoSettings['x_show'];
        $output     =  $inoSettings['x_outputs'];
        $conditions =  $inoSettings['x_conditions'];
    }

    // ANCHOR: MAnage Display
    if ($display == 'first_term') {
        $terms = [$terms[0]];
    } else if ($display == 'all' || $display == 'by_taxonomy') {
        $tax_query = false;
        $terms = null;
    } else {
        $terms =  $terms;
    }

    // ANCHOR: Process Tax Query Args
    $additionalArgs = [
        'post_type' => $postType,
        'posts_per_page' => $NumofPosts,
    ];

    $tax_query = true;

    if (isset($terms) && $terms && $tax_query) {

        if (!is_array($terms))
            $terms = [$terms];

        foreach ($terms as $key => $value) {

            if (is_numeric($key)) {
                $key = get_term($value)->taxonomy;
                $value = get_term($value)->term_id;
            }

            array_push($selectedTerms, array(
                'taxonomy' => $key,
                'field' => 'term_id',
                'terms' => $value,
            ));
        }
        $additionalArgs['tax_query'] = $selectedTerms;
    }

    $args = processArgs($additionalArgs);


    $query = new WP_Query($args);

    return processOutput(['query' => $query,'fields' => $output])['data'];
}

/*** End POSTS Function */
/**************!SECTION
 * 
 * 
 * 
 * 
 * 
 * 
 */
function term_has_posts($inoSettings, $terms)
{
    if (!isset($terms)) return false;
    if (!isset($inoSettings)) return false;
    $inoSettings = validatedSettings($inoSettings);
    $postType   =  $inoSettings['x_post_type'];
    $NumofPosts =  1;
    $Defterms      =  $inoSettings['x_terms'];
    $taxonomies     =  $inoSettings['x_taxonomy'];
    $conditions =  $inoSettings['x_conditions'];
    $args = [
        'post_type' => $postType,
        'posts_per_page' => $NumofPosts,
    ];

    $termArgs = array();
    if (!isset($terms) || !is_array($terms)) return false;
    $selTerms  = array_merge($terms,  $Defterms);


    foreach ($selTerms as $id) {
        $taxonomy = get_term($id)->taxonomy;
        $value = get_term($id)->term_id;

        array_push($termArgs, array(
            'taxonomy' => $taxonomy,
            'field' => 'term_id',
            'terms' => $value,
        ));
    }
    $args['tax_query'] = $termArgs;

    $args = processArgs($args, $conditions);

    if (count(get_posts($args)) > 0)
        return $terms;
    else
        return false;
}

/*** ANCHOR: POSTS Function */
function xpostsRender($inoSettings = null)
{
    // ANCHOR: Blank Array
    $selectedTerms = array();

    // ANCHOR: Retrieve Settings from Widget
    $inoSettings = xvalidatedSettings($inoSettings);
    if (is_string($inoSettings)) {
        $postType = $inoSettings;
        $NumofPosts = -1;
    } else if (is_array($inoSettings)) {
        $postType   =  $inoSettings['x_post_type'];
        $NumofPosts =  $inoSettings['x_posts_per_page'];
        $terms      =  $inoSettings['x_terms'];
        $taxonomies     =  $inoSettings['x_taxonomy'];
        $display      =  $inoSettings['x_show'];
        $output     =  $inoSettings['x_outputs'];
        $conditions =  $inoSettings['x_conditions'];
    }

    // ANCHOR: MAnage Display
    if ($display == 'first_term') {
        $terms = [$terms[0]];
    } else if ($display == 'all' || $display == 'by_taxonomy') {
        $tax_query = false;
        $terms = null;
    } else {
        $terms =  $terms;
    }

    // ANCHOR: Process Tax Query Args
    $additionalArgs = [
        'post_type' => $postType,
        'posts_per_page' => $NumofPosts,
    ];

    $tax_query = true;

    if (isset($terms) && $terms && $tax_query) {

        if (!is_array($terms))
            $terms = [$terms];

        foreach ($terms as $key => $value) {

            if (is_numeric($key)) {
                $key = get_term($value)->taxonomy;
                $value = get_term($value)->term_id;
            }

            array_push($selectedTerms, array(
                'taxonomy' => $key,
                'field' => 'term_id',
                'terms' => $value,
            ));
        }
        $additionalArgs['tax_query'] = $selectedTerms;
    }


    $args = xprocessArgs($additionalArgs, $conditions);


}