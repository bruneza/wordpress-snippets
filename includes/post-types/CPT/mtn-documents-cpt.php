<?php

namespace MTN_FEATURES\CPT;

use \MTN_FEATURES\Custom_Field\MTN_Document_fields;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Document_Cpt')) :
    class MTN_Document_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Document Custom Post Type
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

            // require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-documents-cfields.php';
			
			// MTN_Document_fields::instance();


        }



        /**
         * Create Documents Post Type
         */
        public function register_cpt()
        {
            /**
             * Create Documents CPT
             */
            if (post_type_exists('mtn_documents')) {
                return;
            }
            register_post_type(
                'mtn_documents',
                array(
                    'labels' => array(
                        'name' => __('Documents', 'mtn'),
                        'singular_name' => __('Document', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Documents', 'mtn'),
                    'menu_icon' => 'dashicons-pdf',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'documents'),
                )
            );


            /**
             * Create Documents Category Taxonomy
             */
            if (taxonomy_exists('mtn_documentscategory')) {
                return;
            }
            register_taxonomy('mtn_documentscategory', ["mtn_documents"], array(
                "label" => __("Document Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Document Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Document Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'documentscategories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_documentscategory",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.