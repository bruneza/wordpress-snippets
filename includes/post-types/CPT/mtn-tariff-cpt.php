<?php

namespace MTN_FEATURES\CPT;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Tariff_Cpt')) :
    class MTN_Tariff_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Tariff Custom Post Type
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

            require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-tariffs-cfields.php';
			
			\MTN_FEATURES\Custom_Field\MTN_Tariff_fields::instance();


        }



        /**
         * Create Tariffs Post Type
         */
        public function register_cpt()
        {
            /**
             * Create Tariffs CPT
             */
            if (post_type_exists('mtn_tariffs')) {
                return;
            }
            register_post_type(
                'mtn_tariffs',
                array(
                    'labels' => array(
                        'name' => __('Tariffs', 'mtn'),
                        'singular_name' => __('Tariff', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Tariffs', 'mtn'),
                    'menu_icon' => 'dashicons-tag',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','editor','revisions', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'tariffs'),
                )
            );


            /**
             * Create Tariffs Category Taxonomy
             */
            if (taxonomy_exists('mtn_tariff_category')) {
                return;
            }
            register_taxonomy('mtn_tariff_category', ["mtn_tariffs"], array(
                "label" => __("Tariff Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Tariff Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Tariff Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'tariff-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_tariff_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.