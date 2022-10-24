<?php

namespace INO_FEATURES\Custom_Field;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('kura_Scholarship_fields')) :
    class kura_Scholarship_fields
    {

        private static $instance = null;

        /**
         * Variables for Job Custom Post Type
         */

        private $screen = array(
            'kura_scholarships'
        );
    
        private $meta_fields = array(
                    array(
                        'label' => 'Location',
                        'id' => '_location',
                        'placeholder' => 'eg: this scholarship is about...',
                        'type' => 'textarea',
                    ),
                    array(
                        'label' => 'Description',
                        'id' => '_description',
                        'placeholder' => 'eg: this scholarship is about...',
                        'type' => 'textarea',
                    ),
        
                    array(
                        'label' => 'Application Url',
                        'id' => '_link_url',
                        'placeholder' => 'eg: https://innoventyk.rw',
                        'type' => 'url',
                    ),
        
                    array(
                        'label' => 'Starting Date',
                        'id' => '_starting_date',
                        'placeholder' => '',
                        'type' => 'date',
                    ),
        
                    array(
                        'label' => 'Application Deadline',
                        'id' => '_deadline',
                        'placeholder' => '',
                        'type' => 'date',
                    )
        
                    
    
        );

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

        public function __construct() {
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_fields' ) );
        }
    
        public function add_meta_boxes() {
            foreach ( $this->screen as $single_screen ) {
                add_meta_box(
                    'KuraScholarship',
                    __( 'KuraScholarship', 'textdomain' ),
                    array( $this, 'meta_box_callback' ),
                    $single_screen,
                    'normal',
                    'high'
                );
            }
        }

        public static function sanitize_meta_field_date( $meta_value ) {
            $meta_value = trim( $meta_value );
    
            // Matches yyyy-mm-dd.
            if ( ! preg_match( '/[\d]{4}\-[\d]{2}\-[\d]{2}/', $meta_value ) ) {
                return '';
            }
    
            // Checks for valid date.
            $test_date = \DateTimeImmutable::createFromFormat( 'Y-m-d', $meta_value, wp_timezone() );
            if ( ! $test_date || $test_date->format( 'Y-m-d' ) !== $meta_value ) {
                return '';
            }
    
            return $meta_value;
        }
    
        public function meta_box_callback( $post ) {
            wp_nonce_field( 'KuraScholarship_data', 'KuraScholarship_nonce' );
                    echo 'Wordshops and Trainings';
            $this->field_generator( $post );
        }
        public function field_generator( $post ) {
            $output = '';
            foreach ( $this->meta_fields as $meta_field ) {
                $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
                $meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
                if ( empty( $meta_value ) ) {
                    if ( isset( $meta_field['default'] ) ) {
                        $meta_value = $meta_field['default'];
                    }
                }
                switch ( $meta_field['type'] ) {
                    case 'textarea':
                        $input = sprintf(
                            '<textarea %s id="%s" name="%s" placeholder="%s" rows="5">%s</textarea>',
                            $meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
                            $meta_field['id'],
                            $meta_field['id'],
                            $meta_field['placeholder'],
                            $meta_value
                        );
                        break;

                    default:
                                        $input = sprintf(
                                            '<input %s id="%s" name="%s" placeholder="%s" type="%s" value="%s">',
                                            $meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
                                            $meta_field['id'],
                                            $meta_field['id'],
                                            $meta_field['placeholder'],
                                            $meta_field['type'],
                                            $meta_value
                                        );
                }
                $output .= $this->format_rows( $label, $input );
            }
            echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
        }
    
        public function format_rows( $label, $input ) {
            return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
        }
    
        public function save_fields( $post_id ) {
            if ( ! isset( $_POST['KuraScholarship_nonce'] ) )
                return $post_id;
            $nonce = $_POST['KuraScholarship_nonce'];
            if ( !wp_verify_nonce( $nonce, 'KuraScholarship_data' ) )
                return $post_id;
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return $post_id;
            foreach ( $this->meta_fields as $meta_field ) {
                if ( isset( $_POST[ $meta_field['id'] ] ) ) {
                    switch ( $meta_field['type'] ) {
                        case 'email':
                            $_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
                            break;
                        case 'text':
                            $_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
                            break;
                    }
                    update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
                } else if ( $meta_field['type'] === 'checkbox' ) {
                    update_post_meta( $post_id, $meta_field['id'], '0' );
                }
            }
        }
    
    }
endif; // End if class_exists check.