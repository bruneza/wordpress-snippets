<?php

namespace MTN_FEATURES\EXTRA;


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Page_Taxonomy')) :
    class MTN_Page_Taxonomy
    {

        private static $instance = null;

        /**
         * Variables for Page Custom Post Type
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
            add_action('init', [$this, 'register_Page_Taxonomy'], 0);
        }



        /**
         * Create Pages Post Type
         */
        public function register_Page_Taxonomy()
        {
            /**
             * Create Pages Category Taxonomy
             */
            if (taxonomy_exists('mtn_page_category')) {
                return;
            }
            register_taxonomy('mtn_page_category', ["page"], array(
                "label" => __("Page Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Page Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Page Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'page-category', 'with_front' => false,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_page_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));

            /**
             * Create Job Region Taxonomy
             */
            if (taxonomy_exists('mtn_job_region')) {
                return;
            }
            register_taxonomy('mtn_job_region', ["job_listing"], array(
                "label" => __("Job Region", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Job Regions', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Job Region', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'job-region', 'with_front' => false,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_job_region",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
    }
endif; // End if class_exists check.