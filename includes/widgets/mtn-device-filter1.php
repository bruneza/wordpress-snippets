<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Device_Filter1  extends \Elementor\Widget_Base
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
        return 'Device Filter01';
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
        return esc_html__('Device Filter01', 'mtn');
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
                'label' => esc_html__('Post Content', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'grid_num_posts',
            [
                'label' => esc_html__('Number of Posts', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => -1,
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__('Price', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );


        $this->add_control(
            'num_of_col',
            [
                'label' => esc_html__('Number of Columns', 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => count_to(10),
            ]
        );

        $this->add_control(
            'icon_section',
            [
                'label' => esc_html__('Icons', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'filter_selected_icon',
            [
                'label' => esc_html__('Icon', 'mtn'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'icon',
            ]
        );


        $this->add_control(
            'filter_icons',
            [
                'label' => esc_html__('Items', 'mtn'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'filter_icons_Title' => esc_html__('List Item', 'mtn'),
                        'filter_selected_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, filter_selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
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
        /*** Style begins here***/

        $this->start_controls_section(
            'Layout_style',
            [
                'label' => esc_html__('Layout Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control('grid_border_radius', [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .post-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control(
            'space_between',
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
                    '{{WRAPPER}} .post-card' => 'padding-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .post-card:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .post-card:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );
        $this->add_responsive_control('grid_padding', [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__('Padding', 'mtn'),
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_responsive_control(
            'grid_height',
            [
                'label' => esc_html__('Grid Height', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'backgroud_overlay',
            'label' => esc_html__('Overlay', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .post-content',
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            'Filter_style',
            [
                'label' => esc_html__('Filter Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'filter_tab_height',
            [
                'label' => esc_html__('Tab Height', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .posts-filter .nav-link' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_tab_width',
            [
                'label' => esc_html__('Tab Width', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .posts-filter .nav-link' => ' width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'tab_space_between',
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
                    '{{WRAPPER}} .nav-item' => 'padding-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .nav-item:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .nav-item:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'filter_title_typography',
                'selector' => '{{WRAPPER}} .nav-link',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );


        $this->add_responsive_control(
            'filter_svg_size',
            [
                'label' => esc_html__('SVG Icon Size', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-link svg' => ' width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_icon_size',
            [
                'label' => esc_html__('Icon Font Size', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-link i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // NORMAL STATE
        $this->start_controls_tabs(
            'filter_btn_tabs'
        );

        $this->start_controls_tab(
            'filter_normal_tab',
            [
                'label' => esc_html__('Normal', 'mtn'),
            ]
        );


        $this->add_control(
            'fitler_btn_heading',
            [
                'label' => esc_html__('Button pill', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'filter_btn_border',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .nav-link',
        ]);

        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'filter_btn_background',
            'label' => esc_html__('Button Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .nav-link',
        ]);

        $this->add_control(
            'fitler_title_heading',
            [
                'label' => esc_html__('Tab Content', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('fitler_title_color', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} .nav-link' => 'color: {{VALUE}}',
        '{{WRAPPER}} .nav-link svg path' => 'fill: {{VALUE}}',
    ],
]);

        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'filter_hover_tab',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]
        );


        $this->add_control(
            'fitler_btn_heading_hover',
            [
                'label' => esc_html__('Button pill', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'filter_btn_border_hover',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .nav-link:hover',
        ]);


        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'filter_btn_background_hover',
            'label' => esc_html__('Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .nav-link:hover',
        ]);

        $this->add_control(
            'fitler_title_heading_hover',
            [
                'label' => esc_html__('Tab Content', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('fitler_title_color_hover', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} .nav-link:hover' => 'color: {{VALUE}}',
        '{{WRAPPER}} .nav-link:hover svg path' => 'fill: {{VALUE}}',
    ],
]);

        $this->end_controls_tab();

        // ACTIVE STATE
        $this->start_controls_tab(
            'filter_active_tab',
            [
                'label' => esc_html__('Active', 'mtn'),
            ]
        );

        $this->add_control(
            'fitler_btn_heading_active',
            [
                'label' => esc_html__('Button pill', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'filter_btn_border_active',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .nav-link.active',
        ]);
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'filter_btn_background_active',
            'label' => esc_html__('Button Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .nav-link.active',
        ]);


        $this->add_control(
            'fitler_title_heading_active',
            [
                'label' => esc_html__('Tab Content', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control('fitler_title_color_active', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} .nav-link.active' => 'color: {{VALUE}}',
        '{{WRAPPER}} .nav-link.active svg path' => 'fill: {{VALUE}}',
    ],
]);

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->end_controls_section();
        $this->start_controls_section(
            'Content_style',
            [
                'label' => esc_html__('Content Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

        $this->add_control('title_color', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} h4.post-title' => 'color: {{VALUE}}',
        '{{WRAPPER}} h4.post-title svg path' => 'fill: {{VALUE}}',
    ],
]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} . h4.post-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );


        $this->add_control(
            'readmore_heading',
            [
                'label' => esc_html__('Read More Button', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control('btn_border_radius', [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .post-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .post-readmore',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );


        $this->add_responsive_control('btn_padding', [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__('Padding', 'mtn'),
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .post-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        // NORMAL STATE
        $this->start_controls_tabs(
            'style_btn_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'mtn'),
            ]
        );

        $this->add_control('btn_color', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} .post-readmore' => 'color: {{VALUE}}',
        '{{WRAPPER}} .post-readmore svg path' => 'fill: {{VALUE}}',
    ],
]);
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'btn_border',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .post-readmore',
        ]);
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'btn_background',
            'label' => esc_html__('Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .post-readmore',
        ]);

        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]
        );
        $this->add_control('btn_hover_color', [
    'type' => \Elementor\Controls_Manager::COLOR,
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
    ],
    'selectors' => [
        '{{WRAPPER}} .post-readmore:hover' => 'color: {{VALUE}}',
        '{{WRAPPER}} .post-readmore:hover svg path' => 'fill: {{VALUE}}',
    ],
]);
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'btn_hover_border',
            'label' => esc_html__('Border', 'mtn'),
            'selector' => '{{WRAPPER}} .post-readmore:hover',
        ]);
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'btn_hover_background',
            'label' => esc_html__('Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} .post-readmore:hover',
        ]);
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function render()
    {
        // $settings = $this->get_settings_for_display();

        // $postType = getPostType($settings);
        // $terms = mtnTerms($postType);
?>
        <div class="container">
        <div class="filter-btn d-flex">
            <div class="col-md-4">
                <div class="select-btn">
                    <label for="">Select Brand</label>
                    <select name="" id="" class="select-country selector1">
                        <option value="cat-all">All Brands</option>
                        <option value="apple">Apple</option>
                        <option value="samsung">Samsung</option>
                        <option value="south-africa">Tecno</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="select-btn">
                    <label for="">Select Category</label>
                    <select name="" id="" class="select-country selector2">
                        <option value="cat-all">All Categories</option>
                        <option value="ipad">Ipad</option>
                        <option value="iphone">Iphone</option>
                        <option value="Galaxy">Galaxy</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="devices-contents">
                <div class="row">

                    <div class="col-md-4 dv-filter" data-filter="apple" data-filter2="ipad">
                        <div class="single-device">
                            <div class="col">
                                <div class="device-picture">
                                    <div class="col-md-4">
                                        <img src="https://mtn.inoventyk.rw/wp-content/uploads/2022/09/HOT-10-Play1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="device-details-contents">
                                    <small>Samsung</small>
                                    <h4>Galaxy 9 Plus</h4>
                                    <h1>800,000 Rwf</h1>
                                    <hr>
                                    <div class="device-botm-sec col-md-12 d-flex">
                                        <span class="col-md-9">Comes with 1 GB per month for 3 months</span>
                                        <span class="col-md-3 link-icon-sec">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dv-filter" data-filter="samsung" data-filter2="Galaxy">
                        <div class="single-device">
                            <div class="col">
                                <div class="device-picture">
                                    <div class="col-md-4">
                                        <img src="https://mtn.inoventyk.rw/wp-content/uploads/2022/09/HOT-10-Play1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="device-details-contents">
                                    <small>Samsung</small>
                                    <h4>Galaxy 9 Plus</h4>
                                    <h1>800,000 Rwf</h1>
                                    <hr>
                                    <div class="device-botm-sec col-md-12 d-flex">
                                        <span class="col-md-9">Comes with 1 GB per month for 3 months</span>
                                        <span class="col-md-3 link-icon-sec">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dv-filter" data-filter="apple" data-filter2="iphone">
                        <div class="single-device">
                            <div class="col">
                                <div class="device-picture">
                                    <div class="col-md-4">
                                        <img src="https://mtn.inoventyk.rw/wp-content/uploads/2022/09/HOT-10-Play1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="device-details-contents">
                                    <small>Samsung</small>
                                    <h4>Galaxy 9 Plus</h4>
                                    <h1>800,000 Rwf</h1>
                                    <hr>
                                    <div class="device-botm-sec col-md-12 d-flex">
                                        <span class="col-md-9">Comes with 1 GB per month for 3 months</span>
                                        <span class="col-md-3 link-icon-sec">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dv-filter" data-filter="samsung" data-filter2="Galaxy">
                        <div class="single-device">
                            <div class="col">
                                <div class="device-picture">
                                    <div class="col-md-4">
                                        <img src="https://mtn.inoventyk.rw/wp-content/uploads/2022/09/HOT-10-Play1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="device-details-contents">
                                    <small>Samsung</small>
                                    <h4>Galaxy 9 Plus</h4>
                                    <h1>800,000 Rwf</h1>
                                    <hr>
                                    <div class="device-botm-sec col-md-12 d-flex">
                                        <span class="col-md-9">Comes with 1 GB per month for 3 months</span>
                                        <span class="col-md-3 link-icon-sec">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 dv-filter" data-filter="apple" data-filter2="iphone">
                        <div class="single-device ">
                            <div class="col ">
                                <div class="device-picture ">
                                    <div class="col-md-4 ">
                                        <img src="https://mtn.inoventyk.rw/wp-content/uploads/2022/09/HOT-10-Play1.png" class="img-fluid " alt=" ">
                                    </div>
                                </div>
                                <div class="device-details-contents ">
                                    <small>Samsung</small>
                                    <h4>Galaxy 9 Plus</h4>
                                    <h1>800,000 Rwf</h1>
                                    <hr>
                                    <div class="device-botm-sec col-md-12 d-flex ">
                                        <span class="col-md-9 ">Comes with 1 GB per month for 3 months</span>
                                        <span class="col-md-3 link-icon-sec ">
                                            <i class="fa fa-chevron-right "></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        var filterActive;

        function filterCategory(selector1, selector2) {
            // reset results list
            $(".dv-filter").addClass("disactive");

            // the filtering in action for all criteria
            var selector = ".dv-filter";
            if (selector1 !== "cat-all") {
                selector = "[data-filter=" + selector1 + "]";
                //$('.selector2').prop('selectedIndex',0);
            }
            if (selector2 !== "cat-all") {
                selector = selector + "[data-filter2=" + selector2 + "]";
            }
            //console.log(selector);
            // show all results
            $(selector).removeClass("disactive");

            // reset active filter
            filterActive = selector1;
        }

        // start by showing all items
        $(".dv-filter").removeClass("disactive");

        // call the filtering function when selects are changed
        $(".select-country").change(function() {
            filterCategory(
                $(".selector1 ").val(),
                $(".selector2 ").val()
            );
        });
    })(jQuery);
    </script>
<?php
    }
}
