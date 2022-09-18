<?php

namespace MTN_FEATURES\CPT;

use \MTN_FEATURES\Custom_Field\MTN_Team_Fields;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Team_Cpt')) :
    class MTN_Team_Cpt
    {

        private static $instance = null;

        /**
         * Variables for Team Custom Post Type
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

            require_once MTN_DIR . '/includes/post-types/custom-fields/mtn-team-cfields.php';
			
			MTN_Team_Fields::instance();


        }



        /**
         * Create Teams Post Type
         */
        public function register_cpt()
        {
            /**
             * Create Teams CPT
             */
            if (post_type_exists('mtn_teams')) {
                return;
            }
            register_post_type(
                'mtn_teams',
                array(
                    'labels' => array(
                        'name' => __('Teams', 'mtn'),
                        'singular_name' => __('Team', 'mtn'),
                    ),
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'show_in_rest' => true,
                    'description' => __('Lists of available Teams', 'mtn'),
                    'menu_icon' => 'dashicons-groups',
                    'public' => true,
                    'hierarchy' => false,
                    'supports' => array('title','revisions','editor','thumbnail', 'excerpt'),
                    'taxonomies' => array('post_tag'),
                    'capability_type' => 'post',
                    'rewrite' => array('slug' => 'teams'),
                )
            );


            /**
             * Create Teams Category Taxonomy
             */
            if (taxonomy_exists('mtn_team_category')) {
                return;
            }
            register_taxonomy('mtn_team_category', ["mtn_teams"], array(
                "label" => __("Team Categories", "mtn"),
                'labels'                     => array(
                    'name'                       => _x('Team Categories', 'Taxonomy General Name', 'mtn'),
                    'singular_name'              => _x('Team Category', 'Taxonomy Singular Name', 'mtn'),
                ),
                'hierarchical'               => true,
                'public'                     => true,
                "publicly_queryable" => true,
                'show_ui'                    => true,
                "show_in_menu" => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'query_var'                  => true,
                'rewrite'                    => array('slug' => 'team-categories', 'with_front' => true,),
                "show_in_rest" => true,
                "show_tagcloud" => false,
                "rest_base" => "bru_team_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => false,
                "sort" => false,
                "show_in_graphql" => false,
            ));
        }
        
    }
endif; // End if class_exists check.