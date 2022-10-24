<?php

namespace INO_FEATURES\CPT;
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('Kura_workshops_cpt')) :
    class Kura_workshops_cpt
    {

        private static $instance = null;

        /**
         * Variables for Workshop Custom Post Type
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
            add_action('init', [$this, 'register_WorkShop_cpt'], 0);

            require_once INO_DIR . '/includes/post-types/custom-fields/kura-workshop-cfields.php';
			
			\INO_FEATURES\Custom_Field\kura_Workshop_fields::instance();


        }



        /**
         * Create Workshops Post Type
         */
        public function register_WorkShop_cpt()
        {
            /**
             * Create Workshops CPT
             */
            if (post_type_exists('kura_workshops')) {
                return;
            }
            register_post_type(
                'kura_workshops',
                array(
                    'labels' => array(
                        'name' => __('Workshops', 'kura'),
                        'singular_name' => __('Workshop', 'kura'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Workshops', 'kura'),
                    'menu_icon' => 'dashicons-groups',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'workshops'),
                )
            );


            /**
             * Create Workshops Category Taxonomy
             */
            if (taxonomy_exists('kura_workshop_category')) {
                return;
            }
            register_taxonomy('kura_workshop_category', ["kura_workshops"], array(
                "label" => __("Workshop Categories", "kura"),
                'labels'                     => array(
                    'name'                       => _x('Workshop Categories', 'Taxonomy General Name', 'kura'),
                    'singular_name'              => _x('Workshop Category', 'Taxonomy Singular Name', 'kura'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'workshop-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_workshop_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.