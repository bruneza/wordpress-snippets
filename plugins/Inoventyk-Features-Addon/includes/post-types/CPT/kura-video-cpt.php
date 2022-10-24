<?php

namespace INO_FEATURES\CPT;
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('Kura_video_cpt')) :
    class Kura_video_cpt
    {

        private static $instance = null;

        /**
         * Variables for Video Custom Post Type
         */

        public static function instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('init', [$this, 'register_video_cpt'], 0);
            require_once INO_DIR . '/includes/post-types/custom-fields/kura-video-cfields.php';

            \INO_FEATURES\Custom_Field\kura_Video_fields::instance();
        }



        /**
         * Create Videos Post Type
         */
        public function register_video_cpt()
        {
            /**
             * Create Videos CPT
             */
            if (post_type_exists('kura_videos')) {
                return;
            }
            register_post_type(
                'kura_videos',
                array(
                    'labels' => array(
                        'name' => __('Videos', 'kura'),
                        'singular_name' => __('Video', 'kura'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Videos', 'kura'),
                    'menu_icon' => 'dashicons-building',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title', 'author', 'revisions', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'Videos'),
                )
            );


            /**
             * Create Videos Category Taxonomy
             */
            if (taxonomy_exists('kura_video_category')) {
                return;
            }
            register_taxonomy('kura_video_category', ["kura_videos"], array(
                "label" => __("Video Categories", "kura"),
                'labels'                     => array(
                    'name'                       => _x('Video Categories', 'Taxonomy General Name', 'kura'),
                    'singular_name'              => _x('Video Category', 'Taxonomy Singular Name', 'kura'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'Video-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_Video_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.