<?php

namespace INO_FEATURES\INO_Helper;
 
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('ino_query_helper')) :
    class ino_query_helper
    {

        private $settings;
        private static $instance = null;

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
        public function __construct($settings = null)
        {
            // ANCHOR: Process settings
            $this->settings = $this->processSettings($settings);
            

        }

        public function processSettings($settings){
            $defSettings = [
                'x_post_type' => 'post',
                'x_posts_per_page' => -1,
                'x_terms' => null,
                'x_outputs' => null,
                'x_taxonomy' => null,
                'x_ignore' => null,
                'x_show' => 'all',
                'x_conditions' => [
                    'x_skip_nothumbnail' => false,
                ],
            ];

            if(isset($settings)){
            foreach ($settings as $key => $val) {
                if (isset($settings[$key]) && !empty($settings[$key])) {
                    $sanitize_settings[$key] = $val;
                }
            }
        }

        $settings = $sanitize_settings;
        
        return wp_parse_args($settings, $defSettings);

        }

        public function helper_tester(){
            return $this->settings;
        }
   




    }
endif; // End if class_exists check.