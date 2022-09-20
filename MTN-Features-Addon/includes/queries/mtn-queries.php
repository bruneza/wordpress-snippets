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

function mtn_get_terms($postType = 'post', $settings = null)
{

    $taxonomies = mtn_get_taxonomies($postType);

    // if(!$postType)

    
    $output = array();
    if (!isset($settings['mtn_posts_include_term_ids'])) {
        foreach ($taxonomies as $key => $label) {
            $terms = get_terms(array('taxonomy' => $key));
    
            foreach ($terms as $term) {
                $output[$term->slug] = [
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'taxonomy' => $term->taxonomy,
                    'label' => $label,
                    'post-count' => $term->count,
                    'term-link' => get_term_link($term, $term->taxonomy)
                ];

            }
        }
    } else {
        $termId = $settings['mtn_posts_include_term_ids'];
        $terms = array();
        if ($termId) {
            foreach ($termId as $id) {
                $terms = get_term($id);
                $output[$terms->slug] = [
                    'id' => $id,
                    'name' => $terms->name,
                    'taxonomy' => $terms->taxonomy,
                    'label' =>  $terms->label,
                    'post-count' =>  $terms->count,
                    'term-link' => get_term_link($terms, $terms->taxonomy)
                ];
            }
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
            $output['categories'] = get_the_category();
            $output['post-link'] = get_permalink();
            $output['date'] = esc_attr(get_the_date());
            $output['posted-date'] = esc_html($initDate);
            $output['cpt-description'] = meta_validator($post_id, '_mtn_description');
            $output['cpt-jobtitle'] = meta_validator($post_id, '_mtn_job_title');
            $output['cpt-linkedin'] = meta_validator($post_id, '_mtn_linkdin_url');

            /* 
            */

            /*** OUTPUT ALL ***/
            array_push($finalOutput, $output);
        }
        return apply_filters('mtn_posts', $finalOutput);
    } else {
        return null;
    }
}

/*** Process Query */

function getPostType($settings)
{
    if ($settings['mtn_posts_post_type'])
        return $settings['mtn_posts_post_type'];
    else
        return null;
}
function postsRender($settings,$NumofPosts = null)
{
    if (!isset($NumofPosts))
        $NumofPosts = -1;

    $args = [
        'post_type' => $settings['mtn_posts_post_type'],
        'posts_per_page' => $NumofPosts,
    ];

    if (isset($settings['mtn_posts_include_term_ids']) && $settings['mtn_posts_include_term_ids']) {
        foreach ($settings['mtn_posts_include_term_ids'] as $key => $termIds) {
            $termInfo = get_term($termIds);
            $terms[$termInfo->taxonomy] = $termIds;
        }
        return $posts = mtn_posts($args, $terms);
    } else {
        return $posts = mtn_posts($args);
    }
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


function processIcon($settings){
    $output = null;
    foreach($settings['filter_icons'] as $key=>$item){
        $value= $item['filter_selected_icon']['value'];
        $library = $item['filter_selected_icon']['library'];

        if ( empty( $library ) ) {
			return false;
		}

        if ( 'svg' === $library ) {
            if ( ! isset( $value['id'] ) ) return '';

            $output[$key] = get_post_meta( $value['id'], '_elementor_inline_svg', true );
		} else{
            $output[$key] = '<i aria-hidden="true" class="'.$value.'"></i>';
        }
    }

    return apply_filters('post_filter_icon', $output);

}