<?php

namespace MTN_FEATURES\MAP_Locator;


// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Map_Locator ')) :
    class MTN_Map_Locator 
    {

        private static $instance = null;

        /**
         * Variables for Map_Locator tom Post Type
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
            add_filter( 'wpsl_templates', [$this, 'mtn_wpsl_templates']);
        }

        function mtn_wpsl_templates( $templates ) {

            /**
             * The 'id' is for internal use and must be unique ( since 2.0 ).
             * The 'name' is used in the template dropdown on the settings page.
             * The 'path' points to the location of the custom template,
             * in this case the folder of your active theme.
             */
            $templates[] = array (
                'id'   => 'mtn-map-locator',
                'name' => 'Mtn Map Locator',
                'path' => MTN_DIR . '/includes/map-locator/wpsl-templates/mtn-wpsl-template.php',
            );
        
            return $templates;
        }

    }
endif; // End if class_exists check.