<?php

namespace MTN_FEATURES\CPT;

use \MTN_FEATURES\Custom_Field\MTN_Product_Fields;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Product_Cpt')) :
    class MTN_Product_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Products Custom Post Type
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
            add_action('init', [$this, 'register_cpt'], 0);

            require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-products-cfields.php';
			
			mtn_Product_fields::instance();


        }



        /**
         * Create Products Post Type
         */
        public function register_cpt()
        {
            /**
             * Create Products CPT
             */
            if (post_type_exists('mtn_products')) {
                return;
            }
            register_post_type(
                'mtn_products',
                array(
                    'labels' => array(
                        'name' => __('Products', 'mtn'),
                        'singular_name' => __('Products', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Products', 'mtn'),
                    'menu_icon' => 'dashicons-products',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','editor','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'products'),
                )
            );


            /**
             * Create Products Category Taxonomy
             */
            if (taxonomy_exists('mtn_product_category')) {
                return;
            }
            register_taxonomy('mtn_product_category', ["mtn_products"], array(
                "label" => __("Products Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Products Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Products Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'product-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_product_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
            
            if (taxonomy_exists('mtn_product_amenity')) {
                return;
            }
            register_taxonomy('mtn_product_amenity', ["mtn_products"], array(
                "label" => __("Products Amenities", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Products Amenities', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Products Amenity', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'product-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_product_amenity",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.