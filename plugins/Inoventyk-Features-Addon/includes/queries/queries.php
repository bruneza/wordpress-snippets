<?php

function bru_post_types()
{

    $post_types = get_post_types(array('public' => true, 'exclude_from_search' => false), 'objects');

    $options = ['' => ''];
    foreach ($post_types as $post_type) {
        $options[$post_type->name] = $post_type->label;
    }

    return apply_filters('bru_post_type_options', $options);
}

function bru_get_taxonomies($postType = 'post')
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

function bru_get_terms($postType = 'post')
{

    $taxonomies = bru_get_taxonomies($postType);

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

    return apply_filters('bru_term_options', $output, $postType);
}
function bru_terms_options($postType = 'post')
{


    $terms = bru_get_terms($postType);

    $output['all_terms'] = 'All';

    if ($postType == 'kura_videos') {
        foreach ($terms as $slug => $term) {
            $output[$slug] = $term['name'];
        }
    } else {
        foreach ($terms as $slug => $term) {
            $output[$term['taxonomy'] . ':' . $slug . ':' . $term['post-count']] = $term['label'] . ' : ' . $term['name'];
        }
    }

    return apply_filters('bru_term_options', $output, $postType);
}

function cal_percentage($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    return $count;
}

function bru_posts($args = null, $terms = null)
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
                'field' => 'slug',
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

            /***
             * CUstom JOBS & VIDEOS
             * 
             *
             */
            if ($args['post_type'] == 'job_listing') {
                $output['company'] = esc_attr(get_the_company_name($post_id));
                $output['location'] = esc_attr(get_the_job_location($post_id));
                $output['post-link'] = esc_attr(get_the_job_location($post_id));
                $finalDate = date('d-m-Y', strtotime(get_post_meta($post_id, '_job_expires')[0]));
                $output['deadline'] = esc_html($finalDate);
                $initDays = date_diff(date_create($initDate), date_create($finalDate));
                $remDays = date_diff($today, date_create($finalDate));
                $output['init-days'] = number_format($initDays->format('%a'));
                $output['rem-days'] = number_format($remDays->format('%a'));
                $output['dealine-percentage'] = esc_html(cal_percentage($output['rem-days'], $output['init-days']));
                $output['icon'] = $output['company'];

                } else if ($args['post_type'] == 'kura_videos') {
                    $output['post-link'] = meta_video_validator($post_id, '_k_video_url');
                if ($output['post-link']) {
                    $url = trim($output['post-link'], '/');
                    $value = explode("?v=", $url);
                    $videoId = $value[1];
                    $output['video-img-link'] =  esc_html("https://img.youtube.com/vi/$videoId/maxresdefault.jpg");
                }
            }
            else{
                $startingDate = meta_date_validator($post_id, '_starting_date');
            $output['starting-date'] = esc_html($startingDate);
            $Deadline = meta_date_validator($post_id, '_deadline');
            $output['deadline'] = esc_html($Deadline);
            $output['company'] = meta_validator($post_id, '_company_name', true);
            $remDays = date_diff($today, date_create($Deadline));
            $output['location'] = meta_validator($post_id, '_location', true);
            $output['descr'] = meta_validator($post_id, '_description', true);
            $output['post-link'] = meta_validator($post_id, '_link_url', true);
            $output['schedule'] = meta_validator($post_id, '_schedule', true);

                /*** Process Scheduled Event***/
                if ($output['schedule'] == 'Daily')
                    $output['starting-date'] = esc_html($startingDate);
                else if ($output['schedule'] == 'Weekly')
                    $output['starting-date'] = esc_html($startingDate);
                else if ($output['schedule'] == 'Anual')
                    $output['starting-date'] = esc_html($startingDate);
                else
                    $output['starting-date'] = esc_html($startingDate);
            }
            array_push($finalOutput, $output);
        }
        return apply_filters('bru_posts', $finalOutput);
    } else {
        return null;
    }
}

function k_get_thumbnail($post)
{
    
    if (isset($post['thumbnail']) && $post['thumbnail']){
        echo '<img class="company_logo" src="' . esc_url($post['thumbnail']) . '" alt="' . $post['title'] . '" />';
     }else
        null;
}

function k_get_duration($post_id, $sep = null)
{
    $Duration = get_post_meta($post_id, '_duration',true);

    if (isset($Duration) && $Duration){
        echo $sep . '<span class="span-red font-weight-bold">Duration: </span> ' . $Duration;
    }else
        null;
}
function meta_date_validator($post_id, $field, $format = 'd M Y')
{
    $postMeta = get_post_meta($post_id, $field, true);
    if (isset($postMeta) && $postMeta)
        return date($format, strtotime($postMeta));
    else
        return null;
}
function meta_validator($post_id, $field)
{
    $postMeta = get_post_meta($post_id, $field,true);
    if (isset($postMeta) && $postMeta)
        return esc_attr($postMeta);
    else
        return null;
}
function meta_video_validator($post_id, $field)
{
    $postMeta = get_post_meta($post_id, $field, true);
    if (isset($postMeta) && $postMeta)
        return esc_attr($postMeta);
    else
        return null;
}
/*
function bru_Test()
{
    $args = array(
        'post_type' => 'kura_workshops',
        'posts_per_page'         =>  -1,
        'order'                  => 'DESC',
        'orderby'                => 'date',
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $post = $query->the_post();
            $post_id = get_the_ID();
            print_r($args);
            echo "<br><br>//<br><br>";
            print_r(get_post_meta($post_id));
            echo "<br><br>***<br><br>";
        }
    }
}
*/
