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

function mtn_get_terms($postType = 'post')
{

    $taxonomies = mtn_get_taxonomies($postType);

    $output = array();

    foreach ($taxonomies as $key => $label) {
        $terms = get_terms(array('taxonomy' => $key));

        foreach ($terms as $term) {
            $output[$term->slug] = [
                'id' => $term->term_id,
                'name' => $term->name,
                'taxonomy' => $term->taxonomy,
                'label' => $label,
                'post-count' => $term->count,
            ];
        }
    }

    return apply_filters('mtn_term_options', $output, $postType);
}

function mtn_terms_options($postType = 'post')
{


    $terms = mtn_get_terms($postType);

    $output['all_terms'] = 'All';

    if ($postType == 'kura_videos') {
        foreach ($terms as $slug => $term) {
            $output[$slug] = $term['name'];
        }
    } else {
        foreach ($terms as $slug => $term) {
            $output[$term['taxonomy'] . ':' . $slug . ':' . $term['post-count']] = esc_html($term['label'] . ':' . $term['name']);
        }
    }

    return apply_filters('mtn_term_options', $output, $postType);
}


function mtn_posts($args = null, $terms = null)
{
    $defaultArgs = array(
        'posts_per_page'         =>  -1,
        'order'                  => 'DESC',
        'orderby'                => 'date',
    );

    $args = wp_parse_args($args, $defaultArgs);

    if ($terms && is_array($terms)) {

        $selectedTerms = array();
        $taxonomies = array();

        foreach ($terms as $key => $value) {
            array_push($selectedTerms, array(
                'taxonomy' => $key,
                'field' => 'term_id',
                'terms' => $value,
            ));
        }
        $args['tax_query'] = $selectedTerms;
    }

    $query = new WP_Query($args);
    $finalOutput = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $post = $query->the_post();
            $post_id = get_the_ID();
            $initDate = wp_date("d-m-Y", get_post_timestamp());
            $today = date_create(date("d-m-Y"));
            $output['id'] = $post_id;
            $output['title'] = esc_attr(get_the_title());
            $output['slug'] = esc_attr(get_post_field('post_name', $post_id));
            $output['excerpt'] = esc_attr(wp_trim_words(get_the_excerpt(), 15, '...'));
            $output['author'] = esc_attr(get_the_author_meta('display_name'));
            $output['thumbnail'] = get_the_post_thumbnail_url();
            $output['categories'] = get_the_category($post_id);
            $output['post-link'] = get_permalink();
            $output['date'] = esc_attr(get_the_date());
            $output['posted-date'] = esc_html($initDate); 

            /*** OUTPUT ALL ***/
            array_push($finalOutput, $output);
        }
        return apply_filters('mtn_posts', $finalOutput);
    } else {
        return null;
    }
}

/*** Process Query */
function postsRender($settings)
{
    if(isset($settings['grid_num_posts']))
    $pnp = $settings['grid_num_posts'];
    else
    $pnp = -1;

    $args = [
        'post_type' => $settings['mtn_posts_post_type'],
        'posts_per_page' => $pnp,
    ];

    if (isset($settings['mtn_posts_include_term_ids']) && $settings['mtn_posts_include_term_ids']) {
        foreach ($settings['mtn_posts_include_term_ids'] as $key => $termIds) {
            $termInfo = get_term($termIds);
            $terms[$termInfo->taxonomy] = $termIds;
        }
        return $posts = mtn_posts($args,$terms);
    }
    else{
        return $posts = mtn_posts($args);
    }
}

function mtn_get_thumbnail($post)
{
    
    if (isset($post['thumbnail']) && $post['thumbnail']){
        echo '<img class="img-fluid" src="' . esc_url($post['thumbnail']) . '" alt="' . $post['title'] . '" />';
     }else
        null;
}
