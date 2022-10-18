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

            // require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-tariffs-cfields.php';

            // \MTN_FEATURES\Custom_Field\MTN_Tariff_fields::instance();


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
                    'supports' => array('title', 'revisions', 'excerpt'),
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
                'rewrite'                    => array('slug' => 'tariff-types', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_tariff_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));

             /**
             * Create Tariffs Type Taxonomy
             */
            if (taxonomy_exists('tariff_package')) {
                return;
            }
            register_taxonomy('tariff_package', ["mtn_tariffs"], array(
                "label" => esc_html__("Tariff Packages", "mtn"),
                "labels" => [
                    "name" => esc_html__("Tariff Packages", "mtn"),
                    "singular_name" => esc_html__("Tariff Package", "mtn"),
                ],
                "public" => true,
                "publicly_queryable" => true,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => ['slug' => 'tariff_packge', 'with_front' => true,],
                "show_admin_column" => false,
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "tariff_packge",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => true,
                "sort" => true,
                "show_in_graphql" => false,
            ));

            /**
             * Create Roaming Continent Taxonomy
             */
            if (taxonomy_exists('roaming_continents')) {
                return;
            }
            register_taxonomy('roaming_continents', ["mtn_tariffs"], array(
                "label" => __("Roaming Continents", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Continents', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Continent', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-continents', 'with_front' => true,),
                "show_in_rest" => false,
                "show_tagcloud" => false,
                "rest_base" => "roaming_continents",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));

            /**
             * Create Roaming Country Taxonomy
             */
            if (taxonomy_exists('roaming_countries')) {
                return;
            }
            register_taxonomy('roaming_countries', ["mtn_tariffs"], array(
                "label" => __("Roaming Countries", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Countries', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Country', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-countries', 'with_front' => true,),
                "show_in_rest" => false,
                "show_tagcloud" => false,
                "rest_base" => "roaming_countries",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
            
            /**
             * Create Telecom Companies Taxonomy
             */
            if (taxonomy_exists('mtn_telecom_companies')) {
                return;
            }
            register_taxonomy('mtn_telecom_companies', ["mtn_tariffs"], array(
                "label" => __("Roaming Telecom Companies", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Roaming Telecom Companies', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Roaming Telecom Companies', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'roaming-telecom Companies', 'with_front' => true,),
                "show_in_rest" => false,
                "show_tagcloud" => false,
                "rest_base" => "bru_telecom_companies",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
    }
endif; // End if class_exists check.