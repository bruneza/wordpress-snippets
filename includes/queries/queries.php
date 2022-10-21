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
    if (isset($settings[$field]) && $settings[$field] != 'mtn-query')
        $postType = $settings[$field];
    else if (isset($settings[$altField]))
        $postType = $settings[$altField];
    else
        $postType = null;

    return $postType;
}

function xvalidatedSettings($arr)
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

function xmeta_validator($post_id, $field)
{
    if (get_field($field, $post_id)) {
        $postMeta = get_field($field, $post_id);
    } else {
        $postMeta = get_post_meta($post_id, $field, true);
    }


    if (isset($postMeta) && $postMeta) {

        if (is_string($postMeta) && str_contains($postMeta, 'field_')) return false;

        return $postMeta;
    }
    return false;
}

/*** End Validate Function */


/*** ANCHOR: CHECKERS Function 
 * 
 * Check if Array is Associative Array or sequential
 *
 * @param  {Array} $array
 * 
 * @return void
 * 
 **/

function is_associative($array = array())
{
    if (!is_array($array)) return false;

    if (array_keys($array) !== range(0, count($array) - 1))
        return true;
    else
        return false;
}
/*** End Validate Function */

/*** ANCHOR: PROCESS Function */


function term_has_posts($inoSettings, $terms)
{
    if (!isset($terms)) return false;
    if (!isset($inoSettings)) return false;
    $inoSettings = xvalidatedSettings($inoSettings);
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

    $args = xprocessArgs($args, $conditions);

    if (count(get_posts($args)) > 0)
        return $terms;
    else
        return false;
}
function xprocessSingleIcon($array)
{
    $value = $array['value'];
    $library = $array['library'];
    $output = null;

    if (empty($library)) {
        return false;
    }

    if ('svg' === $library) {
        if (!isset($value['id'])) return '';

        $output = xmeta_validator($value['id'], '_elementor_inline_svg', true);
    } else {
        $output = '<i aria-hidden="true" class="' . $value . '"></i>';
    }

    return apply_filters('post_filter_icon', $output);
}

function xprocessTerms($terms, $mtnSettings = null)
{
    $output = array();
    if (is_wp_error($terms) || !isset($terms) || !$terms) return false;

    foreach ($terms as $key => $term) {

        if (isset($mtnSettings) && !term_has_posts($mtnSettings, (array) $term->term_id)) continue;
        $taxInfo = get_taxonomy($term->taxonomy);

        $output[$term->term_id] = [
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

function xprocessTermIds($ids)
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

function xprocessArgs($additionalArgs, $conditions = null)
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
 * xprocessOutput
 *
 * @param  array $input
 * @return array
 */
function xprocessOutput($inputArray = null)
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

    $repeaterKey = null;
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

        // echo '<br>***$$$$$postMeta OOOUTT****<br>';
        //     print_r($postMeta);
        //     echo '<br>**************<br>';


        //ANCHOR - Process Custom Keys

        foreach ($postMeta as $key) {
            if (preg_match('/__/', $key)) continue;
            if (preg_match('/_\d__/', $key)) continue;



            $skip  = [
                '_edit_lock', '_thumbnail_id', '_edit_lock', 'ekit_post_views_count',
                '_edit_last', '_elementor_template_type', '_elementor_version',
            ];

            if (in_array($key, $skip)) continue;
            if (str_contains($key, '_elementor')) continue;
            if (str_contains($key, '_wp_')) continue;

            //     echo '<br>***$key IINNN****<br>';
            //     print_r($key);
            //     echo '<br>**************<br>';
            // echo '<br>***KEEYYYS:  '.$key.' ****<br>';
            //     print_r(xmeta_validator($post_id,$key));
            //     echo '<br>**************<br>';

            if (have_rows($key)  && $key == '_tarriff_information') {

                $value = xmeta_validator($post_id, $key);
                if (isset($value) && is_array($value)) {

                    $valInfo = array();
                    foreach ($value as $key => $val) {
                        foreach (array_keys($val) as $valKey) {
                            $vals[ltrim($valKey, '_')] = $val[$valKey];
                        }
                        if (isset($vals))
                            array_push($valInfo, $vals);
                    }
                }
                $output['tariff_info'] = $valInfo;
                continue;
            }
            $value = xmeta_validator($post_id, $key);
            $key = ltrim($key, '_');
            $output[$key] = $value;
        }

        // echo '<br>***TITLE***<br>';
        // print_r($output['title']);
        // echo '<br>***<br>';
        // echo '<br>***FIELDSSSS***<br>';
        // print_r(array_keys($output));
        // echo '<br>***<br>';

        if (isset($inputArray['taxonomies'])) {
            foreach ($inputArray['taxonomies'] as $taxonomy) {
                $selectedTax = get_taxonomy($taxonomy);
                $termObj = get_the_terms($post_id, $taxonomy);
                // echo '<br>***$selectedTax***<br>';
                // print_r($selectedTax);
                // echo '<br>***<br>';
                // echo '<br>***$termObj***<br>';
                // print_r($termObj);
                // echo '<br>***<br>';
                $output['selected-tax'][$selectedTax->rewrite['slug']] = ['taxonomy' => $taxonomy, 'terms-obj' => $termObj];
            }
        }

        $output['terms'] = xgetPostTerms($post_id);


        $selectedOutputs = null;
        if ($inputArray && isset($inputArray['fields'])) {
            foreach ($output as $key => $value) {
                if (in_array($key, $inputArray['fields'])) {
                    $selectedOutputs[$key] = $value;
                }
            }
        } else {
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

function xgetTerms($inoSettings = null)
{
    $inoSettings = xvalidatedSettings($inoSettings);

    $taxonomies     =   $inoSettings['x_taxonomy'];
    $termsArray   =   $inoSettings['x_terms'];

    $terms = array();

    if (isset($taxonomies)) {
        foreach ($taxonomies as $key => $taxonomy) {
            if (isset($termsArray)) {
                $args =
                    $terms[$taxonomy] = xprocessTerms(get_terms($taxonomy), $inoSettings);
            } else {
                $terms[$taxonomy] = xprocessTerms(get_terms($taxonomy), $inoSettings);
            }
        }
        return $terms;
    }
    if (isset($termsArray)) {
        return xprocessTermIds($termsArray);
    }

    return false;
}

function xgetPostTerms($post_id, $taxonomy = null)
{
    $terms = null;
    if (!isset($post_id)) return null;
    if (!isset($taxonomy))
        $taxonomies = get_post_taxonomies($post_id);
    else
        $taxonomies = [$taxonomy];

    // echo '<br>***$taxonomies***<br>';
    // print_r($taxonomies);
    // echo '<br>***<br>';
    foreach ($taxonomies as $key => $taxonomy) {
        $exclude_include_tax = ['post_tag'];
        if (empty(get_taxonomy($taxonomy))) continue;
        if (in_array($taxonomy, $exclude_include_tax)) continue;

        $terms[$taxonomy] = xprocessTerms(get_the_terms($post_id, $taxonomy));
    }
    return $terms;
}

/*** End TERMS Function */

/*** ANCHOR: Get Tariff Validity */
function xgetValidity($post)
{
    if (isset($post['package'])) {
        $package = $post['package'];
        $packageValidity = xgetTariffValidity($post['package']);
        $packageName = get_term($post['package'])->name;

        return [
            'name' => $packageName,
            'validity' => $packageValidity,
        ];
    }
    if (isset($post['tariff_package'])) {
        $package = $post['tariff_package'][(array_key_first($post['tariff_package']))];
        echo '<br>-----$terms-----<br>';
        print_r($package);
        echo '<br>----------<br>';

        $packageValidity = xgetTariffValidity($post['tariff_package']);
        $packageName = get_term($post['package'])->name;

        return [
            'name' => $packageName,
            'validity' => $packageValidity,
        ];
    }

    return [
        'name' => null,
        'validity' => null,
    ];
}

function xgetTariffValidity($termID = null)
{
    if (!isset($termID)) return false;

    if (is_array($termID))
        $termSlug = get_term(array_key_first($termID))->slug;
    else
        $termSlug = get_term($termID);

    switch ($termSlug->slug) {
        case 'daily':
            return '24 Hrs';
            break;
        case 'weekly':
            return '7 Days';
            break;
        case 'daily':
            return '1 Month';
            break;
        default:
            return $termSlug->name;
            break;
    }
}
/*** END Tariff Validity */

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



    $query = new WP_Query($args);

    return xprocessOutput(['query' => $query, 'fields' => $output, 'taxonomies' => $taxonomies])['data'];
}

/*** End POSTS Function */
