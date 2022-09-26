<?php

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
    if ($settings['mtn_posts_post_type'])
        return $settings['mtn_posts_post_type'];
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

function mtnTerms($postType = 'post', $taxonomy = null, $termsArray = null, $ignore = null)
{
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

            if ($taxonomy)
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

function mtn_terms_options($postType = 'post')
{


    $terms = mtnTerms($postType);

    $output['all_terms'] = 'All';

    if ($postType == 'kura_videos') {
        foreach ($terms as $slug => $term) {
            $output[$slug] = $term['name'];
        }
    } else {
        foreach ($terms as $slug => $term) {
            $output[$term['taxonomy'] . ':/:' . $slug] = esc_html($term['label'] . ': ' . $term['name']);
        }
    }

    return apply_filters('mtn_term_options', $output, $postType);
}

function getPostTerms($post_id, $taxonomy = null)
{
    $terms = null;
    if (!isset($post_id)) return null;

    if (isset($taxonomy)) {
        foreach ($taxonomy as $taxo) {
            $rawTerms = get_the_terms($post_id, $taxo);
            if (is_wp_error($rawTerms)) continue;
            if (!empty($rawTerms)) {
                foreach ($rawTerms as $key => $term)
                    $terms[$term->term_id] = array('name' => $term->name, 'slug' => $term->slug, 'taxonomy' => $term->taxonomy);
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
        array_push($selectedTerms, array(
            'taxonomy' => $key,
            'field' => 'term_id',
            'terms' => $value,
        ));
    }
    return $selectedTerms;
}
// function mtn_posts($args = null, $taxonomy = null, $terms = null)
// {

// }

/**
 * process post Output and convert in array
 *
 * @param  object $query
 * 
 * 
 * @return array
 */
function processOutput($query)
{
    $finalOutput = array();
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
        $output['author'] = esc_attr(get_the_author_meta('display_name'));
        $output['thumbnail'] = get_the_post_thumbnail_url();
        $output['post-link'] = get_permalink();
        $output['date'] = esc_attr(get_the_date());
        $output['posted-date'] = esc_html($initDate);
        $output['cpt-description'] = meta_validator($post_id, '_mtn_description');
        $output['cpt-jobtitle'] = meta_validator($post_id, '_mtn_job_title');
        $output['cpt-linkedin'] = meta_validator($post_id, '_mtn_linkdin_url');

        if ($output['post_type'] == 'job_listing') {
            $output['location'] = get_the_job_location($post_id);
            $output['deadline'] = meta_date_validator($post_id, '_job_expires');
        }
        if ($output['post_type'] == 'mtn_products') {
            $output['storage'] = meta_validator($post_id, '_mtn_storage');
            $output['regular_price'] = meta_validator($post_id, '_mtn_reg_price');
            $output['warant_fee'] = meta_validator($post_id, '_mtn_warranty_fee');
            $output['product_type'] = getPostTerms($post_id, array('mtn_product_type'));
            $output['product_brand'] = getPostTerms($post_id, array('mtn_product_brand'));
        }
        if ($output['post_type'] == 'mtn_roamings') {
            $output['roaming_price'] = array();
            $output['roaming_price_array'] = get_field('price', $post_id);
            $output['plan_type'] = getPostTerms($post_id, array('mtn_roaming_plans'));
            $output['roaming_location'] = getPostTerms($post_id, array('mtn_roaming_locations'));
            $output['roaming_provider'] =  getPostTerms($post_id, array('mtn_roaming_providers'));

            if (get_field('price')) {
                foreach ($output['roaming_price_array'] as $repeater) {
                    $ptpTemp = array();
                    if (isset($repeater['plan_type_price']) && $repeater['plan_type_price']) {
                        foreach ($repeater['plan_type_price'] as $ptp) {
                            array_push($ptpTemp, array('plan_type_id' => $ptp->term_id));
                            array_push($ptpTemp, array('plan_type_name' => $ptp->name));
                        }

                        array_push($output['roaming_price'], array('plan_type' => $ptpTemp));
                    }

                    array_push($output['roaming_price'], array('location' => $repeater['location_price']));
                    array_push($output['roaming_price'], array('provider' => $repeater['provider_price']));
                    array_push($output['roaming_price'], array('price' => $repeater['roaming_price']));
                }
            }
        }

        $output['terms'] = getPostTerms($post_id);

        array_push($finalOutput, $output);
    }
    return apply_filters('mtn_process_outputs', $finalOutput);
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
        if ($conditions['skip_nothumbnail']) {
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
 * postsRender
 *
 * @param  mixed $settings
 * @param  mixed $output
 * @param  array $terms
 * @param  array $conditions[
 * 'skip_nothumbnail' = boolean,
 * ]
 * @return array
 * 
 *  $terms = array($taxonomy1 => array($term_id1,$term_id2, $term_id3,...$term_idN),$taxonomyN => array($term_id1,$term_id2, $term_id3,...$term_idN),...$taxonomyN => array($term_id1,$term_id2, $term_id3,...$term_idN))
 */

function postsRender($settings, $terms = null, $output = null, $conditions = null)
{

    if (isset($settings['mtn_posts_post_type']))
        $postType = $settings['mtn_posts_post_type'];

    if (isset($settings['mtn_posts_posts_per_page']))
        $NumofPosts = $settings['mtn_posts_posts_per_page'];
    else
        $NumofPosts = -1;

    $additionalArgs = [
        'post_type' => $postType,
        'posts_per_page' => $NumofPosts,
    ];


    if ($terms && is_array($terms)) {
        $additionalArgs['tax_query'] = getTaxQuery($terms);
    }

    $args = processArgs($additionalArgs, $conditions);
    
    if (isset($settings['mtn_posts_include_term_ids']) && $settings['mtn_posts_include_term_ids']) {
        foreach ($settings['mtn_posts_include_term_ids'] as $key => $termIds) {
            $termInfo = get_term($termIds);
            $terms[$termInfo->taxonomy] = $termIds;
        }
    }

    $query = new WP_Query($args);


    if ($query->have_posts()) {
        if (isset($output))
            $posts = filterPost(processOutput($query), $output);
        else
            $posts = processOutput($query);

        return $posts;
    }

    return null;
}

function filterPost($posts, $fields)
{

    $result = array();
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
 * @param  {Array} $array - Array to check
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

    return apply_filters('post_filter_icon', $output);
}
