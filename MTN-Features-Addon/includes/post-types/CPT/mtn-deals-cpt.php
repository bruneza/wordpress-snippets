<?php

namespace MTN_FEATURES\CPT;

use \MTN_FEATURES\Custom_Field\MTN_Deal_fields;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Deal_Cpt')) :
    class MTN_Deal_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Deal Custom Post Type
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

            require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-deals-cfields.php';
			
			MTN_Deal_fields::instance();


        }



        /**
         * Create Deals Post Type
         */
        public function register_WorkShop_cpt()
        {
            /**
             * Create Deals CPT
             */
            if (post_type_exists('mtn_deals')) {
                return;
            }
            register_post_type(
                'mtn_deals',
                array(
                    'labels' => array(
                        'name' => __('Deals', 'mtn'),
                        'singular_name' => __('Deal', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Deals', 'mtn'),
                    'menu_icon' => 'dashicons-tag',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'deals'),
                )
            );


            /**
             * Create Deals Category Taxonomy
             */
            if (taxonomy_exists('mtn_deal_category')) {
                return;
            }
            register_taxonomy('mtn_deal_category', ["mtn_deals"], array(
                "label" => __("Deal Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Deal Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Deal Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'deal-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_deal_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.