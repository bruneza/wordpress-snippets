<?php

namespace MTN_FEATURES\CPT;


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Faq_Cpt')) :
    class MTN_Faq_Cpt
    {

        private static $instance = null;

        /**
         * Variables for faq Custom Post Type
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
            add_action('init', [$this, 'register_cpt'], 0);


        }


        /**
         * Create faqs Post Type
         */
        public function register_cpt()
        {
            /**
             * Create faqs CPT
             */
            if (post_type_exists('mtn_faqs')) {
                return;
            }
            register_post_type(
                'mtn_faqs',
                array(
                    'labels' => array(
                        'name' => __('Faqs', 'mtn'),
                        'singular_name' => __('Faq', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Faq', 'mtn'),
                    'menu_icon' => 'dashicons-editor-help',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','editor','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'faqs'),
                )
            );


            /**
             * Create faqs Category Taxonomy
             */
            if (taxonomy_exists('mtn_faq_category')) {
                return;
            }
            register_taxonomy('mtn_faq_category', ["mtn_faqs"], array(
                "label" => __("Faq Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Faq Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Faq Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'faq-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_faq_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.