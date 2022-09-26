<?php

namespace MTN_FEATURES\Custom_Field;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!class_exists('MTN_Events_fields')) :
    class MTN_Events_fields
    {

        private static $instance = null;

        /**
         * Variables for Job Custom Post Type
         */

        private $screen = array(
            'mtn_events'
        );
    
        private $meta_fields = array(
            array(
                'label'=>'Outlook Link',
                'id'=>'_mtn_event_outlook_link',
                'placeholder'=>'eg: https://mtn.co.rw',
                'type'=>'url',
            ),
            array(
                'label'=>'WebCast Link',
                'id'=>'_mtn_event_webcast_link',
                'placeholder'=>'eg: https://mtn.co.rw',
                'type'=>'url',
            ),

            array(
                'label'=>'South Africa Phone Number',
                'id'=>'_mtn_event_webcast_link',
                'placeholder'=>'eg: +27 524 5887 677',
                'type'=>'text',
            ),

            array(
                'label'=>'Rwanda Phone',
                'id'=>'_mtn_event_webcast_link',
                'placeholder'=>'eg: +250 782 6985 456',
                'type'=>'text',
            ),

            array(
                'label' => 'Starting Date',
                'id' => '_mtn_event_date',
                'placeholder' => '',
                'type' => 'date',
            ),

    
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
                    'MtnEvents',
                    __( 'MtnEvents', 'mtn' ),
                    array( $this, 'meta_box_callback' ),
                    $single_screen,
                    'normal',
                    'high'
                );
            }
        }
    
        public function meta_box_callback( $post ) {
            wp_nonce_field( 'MtnEvents_data', 'MtnEvents_nonce' );
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
            if ( ! isset( $_POST['MtnEvents_nonce'] ) )
                return $post_id;
            $nonce = $_POST['MtnEvents_nonce'];
            if ( !wp_verify_nonce( $nonce, 'MtnEvents_data' ) )
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