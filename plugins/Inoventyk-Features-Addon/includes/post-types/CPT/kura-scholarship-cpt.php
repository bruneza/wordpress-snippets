<?php

namespace INO_FEATURES\CPT;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('Kura_scholarships_cpt')) :
    class Kura_scholarships_cpt
    {

        private static $instance = null;

        /**
         * Variables for Scholarship Custom Post Type
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
            add_action('init', [$this, 'register_Scholarship_cpt'], 0);

            require_once INO_DIR . '/includes/post-types/custom-fields/kura-scholarship-cfields.php';
			
			\INO_FEATURES\Custom_Field\kura_Scholarship_fields::instance();

        }



        /**
         * Create Scholarships Post Type
         */
        public function register_Scholarship_cpt()
        {
            /**
             * Create Scholarships CPT
             */
            if (post_type_exists('kura_scholarships')) {
                return;
            }
            register_post_type(
                'kura_scholarships',
                array(
                    'labels' => array(
                        'name' => __('Scholarships', 'kura'),
                        'singular_name' => __('Scholarship', 'kura'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Scholarships', 'kura'),
                    'menu_icon' => 'dashicons-welcome-learn-more',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail','excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'scholarships'),
                )
            );



            /**
             * Create Scholarships Category Taxonomy
             */
            if (taxonomy_exists('kura_scholarship_category')) {
                return;
            }
            register_taxonomy('kura_scholarship_category', ["kura_scholarships"], array(
                "label" => __("Scholarship Categories", "kura"),
                'labels'                     => array(
                    'name'                       => _x('Scholarship Categories', 'Taxonomy General Name', 'kura'),
                    'singular_name'              => _x('Scholarship Category', 'Taxonomy Singular Name', 'kura'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'scholarship-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_scholarship_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }

        
    }
endif; // End if class_exists check.