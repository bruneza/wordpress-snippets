<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 */

namespace INO_FEATURES\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('kura_quote_box')) {
    class kura_quote_box  extends \Elementor\Widget_Base
    {

        private $ksettings = null;

        /**
         * Get widget name.
         *
         * Retrieve test widget name.
         *
         * @since 1.0.0
         * @access public
         * @return string Widget name.
         */
        public function get_name()
        {
            return 'Quote Box';
        }
        /**
         * Get widget title.
         *
         * Retrieve test widget title.
         *
         * @since 1.0.0
         * @access public
         * @return string Widget title.
         */
        public function get_title()
        {
            return esc_html__('Quote Box', 'kura');
        }

        /**
         * Get widget icon.
         *
         * Retrieve test widget icon.
         *
         * @since 1.0.0
         * @access public
         * @return string Widget icon.
         */
        public function get_icon()
        {
            return 'eicon-code';
        }

        public function get_categories()
        {
            return ['basic'];
        }

        protected function register_controls()
        {

            $this->start_controls_section(
                'quote_box',
                [
                    'label' => esc_html__('Quote Box', 'kura'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'quote_image',
                [
                    'label' => esc_html__('Choose Image', 'kura'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'quote_author',
                [
                    'label' => esc_html__('Quote Author', 'kura'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('John Doe', 'kura'),
                    'placeholder' => esc_html__('eg: John Doe', 'kura'),
                ]
            );

            $this->add_control(
                'quote_text',
                [
                    'label' => esc_html__('Quote', 'kura'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', 'kura'),
                    'rows' => 10,

                    'placeholder' => esc_html__('Quote goes here...', 'kura'),
                ]
            );
            $this->add_control(
                'quote_url',
                [
                    'label' => esc_html__('Link', 'kura'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__('https://kura.rw', 'kura'),
                    'options' => ['url', 'is_external', 'nofollow'],
                    'default' => [
                        'url' => 'http://kura.rw/',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->end_controls_section();

            $this->start_controls_section(
                'quote_image_style',
                [
                    'label' => esc_html__('Image Style', 'kura'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'img_height',
                [
                    'label' => esc_html__('Image Height', 'kura'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                    ],
                    'size_units' => ['px', 'vh'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 500,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'img_object_fit',
                [
                    'label' => esc_html__('Object Fit', 'kura'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'condition' => [
                        'img_height[size]!' => '',
                    ],
                    'options' => [
                        '' => esc_html__('Default', 'kura'),
                        'fill' => esc_html__('Fill', 'kura'),
                        'cover' => esc_html__('Cover', 'kura'),
                        'contain' => esc_html__('Contain', 'kura'),
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} img',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'kura'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} img',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'quote_Box_style',
                [
                    'label' => esc_html__('Box Style', 'kura'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'vertical_content_position',
                [
                    'label' => esc_html__('Vertical Content Position', 'kura'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__('Default', 'kura'),
                        'align-items-start' => esc_html__('Top', 'kura'),
                        'align-items-center' => esc_html__('Middle', 'kura'),
                        'align-items-end' => esc_html__('Bottom', 'kura'),
                    ],
                    'default' => 'align-items-middle',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'quote_content_style',
                [
                    'label' => esc_html__('Content Style', 'kura'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'quote_typography',
                    'selector' => '{{WRAPPER}} .k-quote',
                ]
            );
            $this->add_control(
                'quote_title_color',
                [
                    'label' => esc_html__('Title Color', 'kura'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .k-quote' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'quote_author_typography',
                    'selector' => '{{WRAPPER}} .blockquote-footer',
                ]
            );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__('Title Color', 'kura'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blockquote-footer' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();

?>
            <div class="k-quote-box-section">
                <div class="row">
                    <div class="col col-md-5 col-sm-12">
                        <?php
                        $alt = \Elementor\Control_Media::get_image_alt($settings['quote_image']);
                        // Get image HTML
                        $image_html = wp_get_attachment_image($settings['quote_image']['id'], 'full', array("class" => "img-fluid"));
                        echo '<figure class="quote_image-figure">' . $image_html . '</figure>';

                        ?>
                    </div>
                    <div class="col col-md-7 col-sm-12 d-flex <?php echo $settings['vertical_content_position']; ?>">
                        <div class="container">
                            <?php

                            if (!empty($settings['quote_url']['url'])) {
                                $this->add_link_attributes('quote-link', $settings['quote_url']);
                            }
                            ?>
                            <a <?php echo $this->get_render_attribute_string('quote-link'); ?>>
                                <blockquote class="blockquote k-quote-content">
                                    <p class="mb-0 k-quote"><?php echo $settings['quote_text']; ?></p>
                                    <footer class="blockquote-footer mt-4"><cite title="Source Title">
                                            <cite title="Source Title"><?php echo $settings['quote_author']; ?></cite>
                                    </footer>
                                </blockquote>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}
