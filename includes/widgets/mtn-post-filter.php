<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Posts_Filter extends \Elementor\Widget_Base
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
        return 'Posts Filter';
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
        return esc_html__('Posts Filter', 'mtn');
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
                    '{{WRAPPER}} .post-card' . ':not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .post-card' . ':not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
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
        '{{WRAPPER}} .nav-link' . ' svg path' => 'fill: {{VALUE}}',
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

        $settings = $this->get_settings_for_display();
        $postType = getPostType($settings);
        $selectedKeys = array();
        $icon = processIcon($settings);
        $terms = mtnTerms($postType,null,$settings['mtn_posts_include_term_ids']);
        echo '<div class="mtn-posts-filter-section">'; ?>

        <?php if (!empty($terms)) {
            $i = 0; ?>
            <ul class="nav nav-pills posts-filter mb-3" id="pills-tab" role="tablist">

                <?php foreach ($terms as $key => $value) {
                    array_push($selectedKeys, array($key,$value['slug'],$value['taxonomy'])); ?>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ($i == 0) echo 'active'; ?>" id="pills-<?= $value['slug']; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $value['slug']; ?>" role="tab" aria-controls="pills-<?= $value['slug']; ?>" aria-selected="<?= $value['slug']; ?>">
                            <?php if ($icon) echo $icon[$i]; ?>
                            <span class="filter-tab-title"><?= $value['name']; ?></span>
                        </a>
                    </li>

                <?php
                    $i++;
                } ?>
            </ul>
        <?php } ?>
        <div class="tab-content post-filter-content" id="pills-tabContent">
            <?php
            foreach ($selectedKeys as $key => $value) {
            ?>

                <div class="tab-pane show <?php if ($key == 0) echo 'active'; ?>" id="pills-<?= $value[1]; ?>" role="tabpanel" aria-labelledby="pills-<?= $value[1]; ?>-tab">
                    <div class="row">

                        <?php $settings['mtn_posts_include_term_ids'] = array($value[0]);

                        $posts = postsRender($settings,array($value[2] =>$value[0]));
                        if (isset($posts)) {
                            foreach ($posts as $post) {
                        ?>
                                <div class="col-md-<?= intval(12 / $settings['num_of_col']); ?> post-card">
                                    <div class="post-wrapper" style="background-image: url(<?= $post['thumbnail']; ?>);">
                                        <div class="post-content">
                                            <h4 class="post-title"><?= $post['title']; ?></h4>
                                            <a href="<?= $post['post-link']; ?>" class="post-readmore">Read More</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="post-call-to-action">
                        <a href="<?php echo $terms[$value[1]]['term-link']; ?>">View Solution</a>
                    </div>
                </div>

            <?php
            } ?>
        </div>

<?php
        echo '</div>';
    }
}
