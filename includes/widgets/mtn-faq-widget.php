<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use \ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Faqs  extends \Elementor\Widget_Base
{

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
        return 'MTN Faqs';
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
        return esc_html__('MTN Faqs', 'mtn');
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


    private function postType()
    {
        return 'post';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'num_of_posts',
            [
                'label' => esc_html__('Number of Posts', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'num_of_columns',
            [
                'label' => esc_html__('Number of Columns', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $this->add_control(
            'view_more_btn',
            [
                'label' => esc_html__('View More Button', 'mtn'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Enter Value', 'mtn'),
                'default' => esc_html__('View More', 'mtn'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'tariff_content',
            [
                'label' => esc_html__('Tariff Content', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_MTN_Query::get_type(),
            [
                'name' => 'mtn_posts',
            ]
        );

        $this->add_control(
            'grid_fields_heading',
            [
                'label' => esc_html__('Choose Fields', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'choose_grid_fields',
            [
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => processOutput()['fields'],
                'default' => ['thumbnail', 'post-link']
            ]
        );

        $this->end_controls_section();

        /////STYLESSS
        $this->start_controls_section(
            'grid_Style',
            [
                'label' => esc_html__('FAQ Grid Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'grid_space_between',
            [
                'label' => esc_html__('Space Between', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 20
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-column' => 'padding-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .faq-column:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .faq-column:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Padding', 'mtn'),
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'tab_box_shadow',
            'label' => esc_html__('Box Shadow', 'mtn'),
            'selector' => '{{WRAPPER}} .faq-wrapper',
        ]);

        $this->add_responsive_control('grid_border_radius', [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .faq-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            'haq_header_Style',
            [
                'label' => esc_html__('FAQ Header Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Padding', 'mtn'),
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control('heading_border_radius', [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .faq-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'selector' => '{{WRAPPER}} .faq-header h4',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control('heading_color', [
            'label' => esc_html__('Heading Color', 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} .faq-header h4' => 'color: {{VALUE}}',
            ],
        ]);
        $this->add_control(
            'header_bg',
            [
                'label' => esc_html__('Background', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'header_background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .faq-header',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'item_Style',
            [
                'label' => esc_html__('FAQ Items Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('item_space_between', [
            'label' => esc_html__('Space Between', 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 20
            ],
            'range' => [
                'px' => [
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .faq-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
                '{{WRAPPER}} .faq-item:not(:first-child)' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
            ],
        ]);

        $this->add_responsive_control(
            'item_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Padding', 'mtn'),
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__('Title', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_header_typography',
                'selector' => '{{WRAPPER}} a.faq-item',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->start_controls_tabs(
            'faq_item_state'
        );
        // NORMAL STATE
        $this->start_controls_tab(
            'item_normal_state',
            [
                'label' => esc_html__('Normal', 'mtn'),
            ]

        );
        $this->add_control('item_color', [
            'label' => esc_html__('Heading Color', 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} a.faq-item' => 'color: {{VALUE}}',
            ],
        ]);
        $this->add_control(
            'item_header_bg',
            [
                'label' => esc_html__('Background', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'item_background',
            'label' => esc_html__('Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .faq-item',
        ]);
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'item_border',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .faq-item',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_hover_state',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]

        );
        $this->add_control('item_color_hover', [
            'label' => esc_html__('Heading Color', 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} a.faq-item:hover' => 'color: {{VALUE}}',
            ],
        ]);
        $this->add_control(
            'item_header_bg_hover',
            [
                'label' => esc_html__('Background', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'item_background_hover',
            'label' => esc_html__('Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .faq-item:hover',
        ]);
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'item_border_hover',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .faq-item:hover',
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
        $this->start_controls_section(
            'btn_Style',
            [
                'label' => esc_html__('View All Button Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $postType = $settings['mtn_posts_post_type'] = 'mtn_faqs';

        $mtnSettings = [
            'x_post_type' => $settings['mtn_posts_post_type'],
            'x_posts_per_page' => $settings['mtn_posts_posts_per_page'],
            'x_taxonomy' => $settings['mtn_posts_include_taxonomy_slugs'],
            'x_show' => 'by_terms',
        ];

        $postArgs = [
            'post_type' => $postType
        ];

        $terms = mtnTerms($mtnSettings);
        $colNum = intval(12 / $settings['num_of_columns']);

        echo '<div class="mtn-faq-section">';
        echo '<div class="row faq-row">';

        foreach ($terms as $key => $term) {

?>
            <div class="faq-column col-md-<?= $colNum; ?> col-sm-12">
                <div class="faq-wrapper">
                    <div class="faq-header">
                        <h4><?= $term['name']; ?></h4>
                    </div>
                    <div class="faq-items  vertical-space">
                        <?php
                        $mtnSettings['x_terms'] = array($key);
                        $posts = postsRender($mtnSettings);

                        foreach ($posts as $post) {
                        ?>
                            <a href="<?= $post['post-link']; ?>" class="faq-item"><?= $post['title']; ?></a>
                        <?php } ?>
                    </div>
                    <div class="faq-all-btn">
                        <a href="<?= $term['term-link']; ?>"><?= $settings['view_more_btn']; ?></a>
                    </div>
                </div>
            </div>


<?php
        }
        echo '</div>';
        echo '</div>';
    }
}
