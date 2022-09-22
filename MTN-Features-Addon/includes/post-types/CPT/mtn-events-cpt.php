<?php

namespace MTN_FEATURES\CPT;


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Event_Cpt')) :
    class MTN_Event_Cpt
    {

        private static $instance = null;

        /**
         * Variables for event Custom Post Type
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
            add_action('init', [$this, 'register_Events_cpt'], 0);

            require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-events-cfields.php';
			
			\MTN_FEATURES\Custom_Field\MTN_Events_fields::instance();


        }


        /**
         * Create events Post Type
         */
        public function register_Events_cpt()
        {
            /**
             * Create events CPT
             */
            if (post_type_exists('mtn_events')) {
                return;
            }
            register_post_type(
                'mtn_events',
                array(
                    'labels' => array(
                        'name' => __('Events', 'mtn'),
                        'singular_name' => __('Event', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Event', 'mtn'),
                    'menu_icon' => 'dashicons-calendar',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','editor','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'Events'),
                )
            );


            /**
             * Create events Category Taxonomy
             */
            if (taxonomy_exists('mtn_event_category')) {
                return;
            }
            register_taxonomy('mtn_event_category', ["mtn_events"], array(
                "label" => __("event Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Event Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Event Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'event-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_event_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.