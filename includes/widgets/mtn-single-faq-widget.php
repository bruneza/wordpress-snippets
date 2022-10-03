<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Single_Faqs  extends \Elementor\Widget_Base
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
        return 'Single Faqs';
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
        return esc_html__('Single Faqs', 'mtn');
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
            'section_query',
            [
                'label' => esc_html__('Query', 'elementor-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_Control_Related::get_type(),
            [
                'name' => 'mtn_posts',
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
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
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
        $post_id = get_the_id();
        $cat_ids = array();
        $categories = get_the_category($post_id);


        if ($categories && !is_wp_error($categories)) {

            foreach ($categories as $category) {

                array_push($cat_ids, $category->term_id);
            }
        }

        $current_post_type = get_post_type($post_id);



        $args = array(
            'category__in' => $cat_ids,
            'post_type' => $current_post_type,
            'posts_per_page' => '-1',
            'post__not_in' => array($current_post_type)
        );






?>
        <div class="mtn-accordion-section">
            <div class="mtn-accordion-row row">
                <div class="nav flex-column nav-pills col-md col-sm-12 section-navigator mb-sm-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <button class="accordion-tab-btn nav-link">
                        <span class="back-btn" href="javascript:void(0)" onclick="history.back()">
                            <i class="fa fa-angle-left"></i>&nbsp; Go Back
                        </span>
                    </button>
                    <?php



                    $query = new \WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();

                    ?>

                            <button class="accordion-tab-btn nav-link <?php if (get_the_id() == $post_id) echo 'active'; ?>" id="v-pills-<?php the_id(); ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php the_id(); ?>" type="button" role="tab" aria-controls="v-pills-<?php the_id(); ?>" <?php get_the_id() == $post_id ? 'aria-selected="true"' : 'aria-selected="false"'; ?>>
                                <span><?php the_title() ?></span>
                            </button>
                    <?php
                        }
                    }

                    ?>
                </div>

                <div class="tab-content mtn-accordion-content col-md-8 col-sm-12" id="v-pills-tabContent">
                    <?php
                    $counter = 1;
                    $query = new \WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                    ?>
                            <div class="tab-pane fade <?php if (get_the_id() == $post_id) echo 'show active'; ?>" id="v-pills-<?php the_id(); ?>" role="tabpanel" aria-labelledby="v-pills-<?php the_id(); ?>-tab">
                                <?php the_content(); ?>
                            </div>
                    <?php
                        }
                    } ?>
                </div>



            </div>
        </div>

<?php
    }
}
