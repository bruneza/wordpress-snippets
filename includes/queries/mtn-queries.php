<?php


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
function mtn_post_types()
{

    $post_types = get_post_types(array('public' => true, 'exclude_from_search' => false), 'objects');

    $options = ['' => ''];
    foreach ($post_types as $post_type) {
        $options[$post_type->name] = $post_type->label;
    }
    return apply_filters('mtn_post_type_options', $options);
}

function getPostType($settings)
{
    if ($settings['post_type'])
        return $settings['post_type'];
    else
        return null;
}

function mtn_get_taxonomies($postType = 'post')
{
    $taxonomies = array();

    // $taxonomies = get_taxonomies($args);
    $taxonomies_objects = get_object_taxonomies($postType, 'objects');
    foreach ($taxonomies_objects as $key => $value) {
        if ($value->show_ui)
            $taxonomies[$key] = $value->label;
    }

    return $taxonomies;
}

function get_taxonomy_by_term($input)
{

    if ($input) {
        if (is_array($input)) {
            $term = $input[array_key_first($input)];
            $taxonomy = $term['taxonomy'];
        } else {
            $taxonomy = $input;
        }

        return get_taxonomy($taxonomy)->object_type[0];
    }
    return null;
}

function search_in_array($type, $array, $search)
{
    if (!$type || !isset($array) || !is_array($array) || !$search) return false;
    if ($type == 'value') {
        $values = array_values($array);
        foreach ($values as $value) {
            if (!is_array($value)) return false;
            if ($value == $search) return true;
        }
    }
}

function mtnTerms($mtnSettings = null)
{
    $mtnSettings = validatedSettings($mtnSettings);

    $postType     =   $mtnSettings['x_post_type'];
    $taxonomy     =   $mtnSettings['x_taxonomy'];
    $termsArray   =   $mtnSettings['x_terms'];
    $ignore       =   $mtnSettings['x_ignore'];


    $output = array();

    if (isset($termsArray)) {
        $termId = $termsArray;
        $terms = array();

        if ($termId) {
            foreach ($termId as $id) {
                $terms = get_term($id);
                $output[$id] = [
                    'slug' => $terms->slug,
                    'name' => $terms->name,
                    'taxonomy' => $terms->taxonomy,
                    'label' =>  $terms->label,
                    'post-count' =>  $terms->count,
                    'term-link' => get_term_link($terms, $terms->taxonomy)
                ];
            }
        }
    } else {
        $taxonomies = mtn_get_taxonomies($postType);
        foreach ($taxonomies as $key => $label) {

            if (search_in_array('value', $ignore, $key)) continue;

            if (isset($taxonomy))
                $key = $taxonomy;

            $terms = get_terms(array('taxonomy' => $key));

            foreach ($terms as $term) {
                $output[$term->term_id] = [
                    'slug' => $term->slug,
                    'name' => $term->name,
                    'taxonomy' => $term->taxonomy,
                    'label' => $label,
                    'post-count' => $term->count,
                    'term-link' => get_term_link($term, $term->taxonomy)
                ];
            }
        }
    }

    return apply_filters('mtn_term_options', $output, $postType);
}


function getPostTerms($post_id, $taxonomy = null)
{
    $terms = null;
    if (!isset($post_id)) return null;

    if (isset($taxonomy)) {
        if (!is_array($taxonomy)) {
            $rawTerms = get_the_terms($post_id, $taxonomy);

            if (!empty($rawTerms)) {
                foreach ($rawTerms as $key => $term)
                    $terms[$term->term_id] = array('name' => $term->name, 'slug' => $term->slug, 'taxonomy' => $term->taxonomy);
            }
        } else {

            foreach ($taxonomy as $taxo) {
                $rawTerms = get_the_terms($post_id, $taxo);
                if (is_wp_error($rawTerms)) continue;
                if (!empty($rawTerms)) {
                    foreach ($rawTerms as $key => $term)
                        $terms[$term->term_id] = array('name' => $term->name, 'slug' => $term->slug, 'taxonomy' => $term->taxonomy);
                }
            }
        }
        return $terms;
    } else {

        if (get_post_taxonomies($post_id)) {
            foreach (get_post_taxonomies($post_id) as $taxo) {
                $rawTerms = get_the_terms($post_id, $taxo);
                if (is_wp_error($rawTerms)) continue;
                if (!empty($rawTerms)) {
                    foreach ($rawTerms as $key => $term)
                        $terms[$term->term_id] = array('name' => $term->name, 'slug' => $term->slug, 'taxonomy' => $term->taxonomy);
                }
            }
            return $terms;
        }

        if (get_the_category($post_id))
            return get_the_category($post_id);
    }

    return false;
}


/**
 * getTaxQuery
 *
 * $terms = array($taxonomy1 => array($term_id1,$term_id2, $term_id3,...$term_idN),$taxonomyN => array($term_id1,$term_id2, $term_id3,...$term_idN),...$taxonomyN => array($term_id1,$term_id2, $term_id3,...$term_idN))
 * 
 * @param  mixed $terms
 * @return void
 */
function getTaxQuery($terms = null)
{
    if (!isset($terms)) return null;
    $selectedTerms = array();

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
    return $selectedTerms;
}
function getTariffValidity($termID, $taxo)
{

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

/**
 * process post Output and convert in array
 *
 * @param  object $query
 * 
 * 
 * @return array
 */
function processOutput($input = null)
{
    $finalOutput = array();
    $fields = array();
    $arg = null;
    if (isset($input)) {
        if (isset($input['query'])) {
            $query = $input['query'];
        }
        if (isset($input['post_type'])) {
            $arg = [
                'post_type' => $input['post_type'],
            ];
            $query = new WP_Query($arg);
        }
    } else {
        $arg = [
            'post_type' => null,
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
        $output['content'] = esc_attr(wp_strip_all_tags(get_the_content()));
        $output['author'] = esc_attr(get_the_author_meta('display_name'));
        $output['thumbnail'] = get_the_post_thumbnail_url();
        $output['post-link'] = get_permalink();
        $output['date'] = esc_attr(get_the_date());
        $output['posted-date'] = esc_html($initDate);

        if ($output['post_type'] == 'mtn_documents' || isset($arg)) {
            $output['doc_info'] = meta_validator($post_id, 'document__pdf');
            $output['doc_category'] = getPostTerms($post_id, array('mtn_documentscategory'));
        }
        if ($output['post_type'] == 'job_listing' || isset($arg)) {
            $output['location'] = get_the_job_location($post_id);
            $output['deadline'] = meta_date_validator($post_id, '_job_expires');
        }
        if ($output['post_type'] == 'mtn_teams' || isset($arg)) {
            $output['job-title'] = meta_validator($post_id, '_mtn_job_title');
            $output['cpt-linkedin'] = meta_validator($post_id, '_mtn_linkdin_url');
        }
        if ($output['post_type'] == 'mtn_products' || isset($arg)) {
            $output['storage'] = meta_validator($post_id, '_mtn_storage');
            $output['regular_price'] = meta_validator($post_id, '_mtn_reg_price');
            $output['warant_fee'] = meta_validator($post_id, '_mtn_warranty_fee');
            $output['product_type'] = getPostTerms($post_id, array('mtn_product_type'));
            $output['product_brand'] = getPostTerms($post_id, array('mtn_product_brand'));
        }

        if ($output['post_type'] == 'mtn_tariffs' || isset($arg)) {

            $output['tariff_type'] = meta_acf_validator($post_id, '_tariff_type');
            $output['location_type'] = meta_acf_validator($post_id, '_tariff_location_type');

            $output['tariff_telecom'] = meta_acf_validator($post_id, '_tariff_telecom_companies');
            $output['tariff_continent'] = meta_acf_validator($post_id, '_tariff_continent');

            $output['tariff_package'] = getPostTerms($post_id, array('tariff_package'));
            $output['tariff_category'] = getPostTerms($post_id, array('mtn_tariff_category'));

            $output['tariff_infos'] = meta_acf_validator($post_id, '_tarriff_information');

            if (get_field('_tarriff_information')) {
                $tarInfo = array();
                foreach ($output['tariff_infos'] as $key => $repeater) {

                    $tarInfo = array_merge($tarInfo, array(
                        'ressources' => $repeater['_tariff_ressources']
                    ));
                    $tarInfo = array_merge($tarInfo, array(
                        'price' => $repeater['_tariff_price']
                    ));
                    $tarInfo = array_merge($tarInfo, array(
                        'code' => $repeater['_tariff_code']
                    ));
                    $tarInfo = array_merge($tarInfo, array(
                        'additional_info' => $repeater['_tariff_additional_info']
                    ));

                    $tarInfoTemp = array();
                }
                $output['tariff_infos'] = $tarInfo;
            }
        }

        $output['terms'] = getPostTerms($post_id);

        array_push($finalOutput, $output);
    }

    foreach (array_keys($output) as $out) {
        $label = ucfirst(str_replace(str_split('-_'), ' ', $out));
        $fields[$out] = esc_html($label);
    }

    return apply_filters('mtn_process_outputs', ['data' => $finalOutput, 'fields' => $fields]);
}

function processArgs($additionalArgs, $conditions)
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


function postsRender($mtnSettings = null)
{
    $mtnSettings = validatedSettings($mtnSettings);
    if (is_string($mtnSettings)) {
        $postType = $mtnSettings;
        $NumofPosts = -1;
    } else if (is_array($mtnSettings)) {
        $postType   =  $mtnSettings['x_post_type'];
        $NumofPosts =  $mtnSettings['x_posts_per_page'];
        $terms      =  $mtnSettings['x_terms'];
        $display      =  $mtnSettings['x_show'];
        $output     =  $mtnSettings['x_outputs'];
        $conditions =  $mtnSettings['x_conditions'];
    }

    $additionalArgs = [
        'post_type' => $postType,
        'posts_per_page' => $NumofPosts,
    ];

    if ($display == 'first_term') {
        $terms = array($terms[array_key_first($terms)]);
    }


    if ($terms && is_array($terms) && $display != 'all') {
        $additionalArgs['tax_query'] = getTaxQuery($terms);
    }

    $args = processArgs($additionalArgs, $conditions);
    if (isset($terms)) {
        foreach ($terms as $key => $termIds) {
            $termInfo = get_term($termIds);
            $terms[$termInfo->taxonomy] = $termIds;
        }
    }

    $query = new WP_Query($args);


    if ($query->have_posts()) {
        if (isset($output))
            $posts = filterPost($conditions, processOutput(['query' => $query])['data'], $output);
        else
            $posts = processOutput(['query' => $query])['data'];

        return $posts;
    }

    return null;
}

function filterArray($array, $data)
{
    $result = [];
    $output = [];
    $selectedTerm = (array) get_term($data);
    
    foreach ($array as $key => $items) {

        $newArray = array();

        foreach ($items['terms'] as $termKey => $itemTerm) {
            // $itemFirstKey = array_key_first($items['terms']);
            if (stripos(strval($termKey), strval($data)) !== false) {
                

                array_push($newArray,$items);
            }
        }
        $output = array_merge($output,$newArray);
    }

    $selectedTerm['posts'] = $output;
    
    return $selectedTerm;
}

function filterPost($filter_by = null, $posts, $fields)
{

    $result = array();
    $in = array();


    if (isset($fields) && is_array($fields)) {
        foreach ($posts as $k => $post) {
            foreach ($fields as $value) {
                if (isset($post[$value]))
                    $in[$value] = $post[$value];
            }
            array_push($result, $in);
        }

        return $result;
    }

    return null;
}


function mtn_get_thumbnail($post)
{

    if (isset($post['thumbnail']) && $post['thumbnail']) {
        echo '<img class="img-fluid" src="' . esc_url($post['thumbnail']) . '" alt="' . $post['title'] . '" />';
    } else
        null;
}

function meta_validator($post_id, $field)
{
    $postMeta = get_post_meta($post_id, $field, true);
    if (isset($postMeta) && $postMeta)
        return esc_attr($postMeta);
    else
        return null;
}
function meta_acf_validator($post_id, $field)
{
    $postMeta = get_field($field, $post_id);

    if (isset($postMeta) && $postMeta)
        return $postMeta;
    else
        return null;
}

function meta_date_validator($post_id, $field, $format = 'd M Y')
{
    $postMeta = get_post_meta($post_id, $field, true);
    if (isset($postMeta) && $postMeta)
        return date($format, strtotime($postMeta));
    else
        return null;
}

/**
 * find_key
 *
 * @param  mixed $array
 * @param  mixed $key
 * @param  mixed $res
 * @return void
 * 
 */
function find_key($array, $key, $res = array())
{

    foreach ($array as $arrKey => $value) {
        if (empty($value)) {
            continue;
        }

        if ((string) strval($arrKey) == strval($key)) {
            array_push($res, $value);
            break;
        } else {
            if (is_array($value)) {
                array_push($res, find_key($value, $key));
            } else {
                continue;
            }
        }
    }
    return $res;
}


/**
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
    if (array_keys($array) !== range(0, count($array) - 1))
        return true;
    else
        return false;
}


/**
 * process Icons to add on Filter
 *
 * @param  mixed $settings - array of settings from elementor
 * @return void
 */
function processIcon($settings)
{
    $output = null;
    foreach ($settings['filter_icons'] as $key => $item) {
        $value = $item['filter_selected_icon']['value'];
        $library = $item['filter_selected_icon']['library'];

        if (empty($library)) {
            return false;
        }

        if ('svg' === $library) {
            if (!isset($value['id'])) return '';

            $output[$key] = get_post_meta($value['id'], '_elementor_inline_svg', true);
        } else {
            $output[$key] = '<i aria-hidden="true" class="' . $value . '"></i>';
        }
    }
}

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

// ANCHOR: Custom Designs

function bruShapeDivider($shape)
{

    if ($shape == 'curve') {
?>
        <svg data-name="shape-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" class="shape-fill"></path>
        </svg>
<?php
    }
}

// ANCHOR: Count to a specific point
function count_to($number = 10)
{
    $count = range(1, $number);
    $count = array_combine($count, $count);

    return $count;
}


// MANUAL