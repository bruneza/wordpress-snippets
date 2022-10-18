<?php

namespace MTN_FEATURES\CPT;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Job_Cpt')) :
    class MTN_Job_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Job Custom Post Type
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

        }



        /**
         * Create Jobs Post Type
         */
        public function register_cpt()
        {
            /**
             * Create Jobs CPT
             */
            if (post_type_exists('mtn_jobs')) {
                return;
            }
            register_post_type(
                'mtn_jobs',
                array(
                    'labels' => array(
                        'name' => __('Jobs', 'mtn'),
                        'singular_name' => __('Job', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Jobs', 'mtn'),
                    'menu_icon' => 'dashicons-building',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'mtn-jobs'),
                )
            );


            /**
             * Create Jobs Department Taxonomy
             */
            if (taxonomy_exists('mtn_job_department')) {
                return;
            }
            register_taxonomy('mtn_job_department', ["mtn_jobs"], array(
                "label" => __("Job Departments", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Job Departments', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Job Department', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'job-departments', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_job_department",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.