<?php

namespace INO_FEATURES\CPT;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('Kura_engagements_cpt')) :
    class Kura_engagements_cpt
    {

        private static $instance = null;

        /**
         * Variables for Engagement Custom Post Type
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
            add_action('init', [$this, 'register_Engagement_cpt'], 0);

            require_once INO_DIR . '/includes/post-types/custom-fields/kura-engagement-cfields.php';
			
			\INO_FEATURES\Custom_Field\kura_Engagement_fields::instance();

        }



        /**
         * Create Engagements Post Type
         */
        public function register_Engagement_cpt()
        {
            /**
             * Create Engagements CPT
             */
            if (post_type_exists('kura_engagements')) {
                return;
            }
            register_post_type(
                'kura_engagements',
                array(
                    'labels' => array(
                        'name' => __('Engagements', 'kura'),
                        'singular_name' => __('Engagement', 'kura'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Engagements', 'kura'),
                    'menu_icon' => 'dashicons-megaphone',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail','excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'engagements'),
                )
            );

         

            /**
             * Create Engagements Category Taxonomy
             */
            if (taxonomy_exists('kura_engagement_category')) {
                return;
            }
            register_taxonomy('kura_engagement_category', ["kura_engagements"], array(
                "label" => __("Engagement Categories", "kura"),
                'labels'                     => array(
                    'name'                       => _x('Engagement Categories', 'Taxonomy General Name', 'kura'),
                    'singular_name'              => _x('Engagement Category', 'Taxonomy Singular Name', 'kura'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'engagement-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_engagement_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }

        
    }
endif; // End if class_exists check.