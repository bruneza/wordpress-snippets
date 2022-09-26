<?php

namespace MTN_FEATURES\CPT;


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Roaming_Cpt')) :
    class MTN_Roaming_Cpt
    {

        private static $instance = null;

        /**
         * Variables for roaming Custom Post Type
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

         //use custom fields
        public function __construct()
        {
            add_action('init', [$this, 'register_Roaming_cpt'], 0);


        }


        /**
         * Create roamings Post Type
         */
        public function register_Roaming_cpt()
        {
            /**
             * Create roamings CPT
             */
            if (post_type_exists('mtn_roamings')) {
                return;
            }
            register_post_type(
                'mtn_roamings',
                array(
                    'labels' => array(
                        'name' => __('Roamings', 'mtn'),
                        'singular_name' => __('Roaming', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Roaming', 'mtn'),
                    'menu_icon' => 'dashicons-editor-help',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'roamings'),
                )
            );


            /**
             * Create roamings Category Taxonomy
             */
            if (taxonomy_exists('mtn_roaming_category')) {
                return;
            }
            register_taxonomy('mtn_roaming_category', ["mtn_roamings"], array(
                "label" => __("Roaming Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_roaming_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
            /**
             * Create Roaming Plan Taxonomy
             */
            if (taxonomy_exists('mtn_roaming_plans')) {
                return;
            }
            register_taxonomy('mtn_roaming_plans', ["mtn_roamings"], array(
                "label" => __("Roaming Plans", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Plan', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Plan', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-plans', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_roaming_plans",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
            /**
             * Create Roaming Location Taxonomy
             */
            if (taxonomy_exists('mtn_roaming_countries')) {
                return;
            }
            register_taxonomy('mtn_roaming_locations', ["mtn_roamings"], array(
                "label" => __("Roaming Location", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Location', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Location', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-locations', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_roaming_countries",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
            
            /**
             * Create Roaming Provider Taxonomy
             */
            if (taxonomy_exists('mtn_roaming_providers')) {
                return;
            }
            register_taxonomy('mtn_roaming_providers', ["mtn_roamings"], array(
                "label" => __("Roaming Provider", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Provider', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Provider', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-providers', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_roaming_providers",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.