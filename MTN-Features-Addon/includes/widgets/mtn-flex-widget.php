<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Flex_Grid  extends \Elementor\Widget_Base
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
        return 'Flex Grid';
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
        return esc_html__('Flex Grid', 'mtn');
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
        return 'eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['basic'];
    }
    protected function get_taxonomies()
    {
        $taxonomies = get_taxonomies(['show_in_nav_menus' => true], 'objects');

        $options = ['' => ''];

        foreach ($taxonomies as $taxonomy) {
            $options[$taxonomy->name] = $taxonomy->label;
        }

        return $options;
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'posts_per_column',
            [
                'label' => esc_html__('Posts per Column', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'bru_box_width',
            [
                'label' => esc_html__('Column Number', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
            ]
        );

        $repeater->add_control(
            'grid_post_offset',
            [
                'label' => esc_html__('Post Offset', 'mtn'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );
        $repeater->add_control(
            'mtn_image_position',
            [
                'label' => esc_html__('Image Position', 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => 'Overlay',
                    'top' => 'Top',
                ]
            ]
        );
        $repeater->add_control(
            'content_valign',
            [
                'label' => esc_html__('content vertical align', 'kura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'align-items-end',
                'options' => [
                    'align-items-start' => [
                        'title' => esc_html__('Top', 'kura'),
                        'icon' => ' eicon-arrow-up',
                    ],
                    'align-items-end' => [
                        'title' => esc_html__('Bottom', 'kura'),
                        'icon' => ' eicon-arrow-down',
                    ],
                ],
                'condition' => [
                    'bru_box_show_title' => 'yes',
                    'bru_image_position' => 'overlay',

                ],
            ]
        );

        $repeater->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'kura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'kura'),
                'label_off' => esc_html__('Hide', 'kura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'flex_grid',
            [
                'label' => esc_html__('Grid List', 'mtn'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'post_type' => esc_html__('post'),
                        'posts_per_column' => 1,
                    ],
                ],
                'title_field' => '{{{ posts_per_column }}} Posts',
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

        /*** Style COntrol ***/
        $this->start_controls_section(
            'grid_style',
            [
                'label' => esc_html__('Grid Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'grid_height',
            [
                'label' => esc_html__('Grid Height', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 400
                ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .row' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'dot_style',
            [
                'label' => esc_html__('Carousel dot Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dot_vertical_position',
            [
                'label' => esc_html__('Vertical Position', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => 'px',
                    'size' => -60
                ],
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_dot_style');
        $this->start_controls_tab(
            'tab_dot_normal',
            [
                'label' => esc_html__('Normal', 'elementor'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background',
                'label' => esc_html__('Dot Background', 'plugin-name'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .owl-dots span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dot_hover',
            [
                'label' => esc_html__('Hover', 'elementor'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_hover_background',
                'label' => esc_html__('Dot Background', 'plugin-name'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .owl-dots .active span',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border',
                'label' => esc_html__('Dot Border', 'mtn'),
                'selector' => '{{WRAPPER}} .owl-dot span',
            ]
        );

        $this->add_control(
            'allbtn_border_radius',
            [
                'label' => esc_html__('Button Radius', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function getPosts($settings)
    {
        $args = [
            'post_type' => $settings['mtn_posts_post_type'],
            'posts_per_page' => $settings['grid_num_posts'],
        ];

        if (isset($settings['mtn_posts_include_term_ids']) && $settings['mtn_posts_include_term_ids']) {
            foreach ($settings['mtn_posts_include_term_ids'] as $key => $termIds) {
                $termInfo = get_term($termIds);
                $terms[$termInfo->taxonomy] = $termIds;
            }
            return $posts = mtn_posts($args,null,$terms);
        }
        else{
            return $posts = mtn_posts($args);
        }
    }

    protected function box_card_item($settings,$item,$i,$colPostNum)
		{
            $posts = $this->getPosts($settings);
            $thumbnail = $posts[$i]['thumbnail'];
            $imgPosition = $item['mtn_image_position'];
            
            if ($item['show_title'] == 'yes')
            $title = $posts[$i]['title'];
            if($item['content_valign'])
            $vAlign = $item['content_valign'];
            else
            $vAlign = null;
            
			if ($imgPosition == 'top') {
				$imgAttr = 'class="img-fluid img-top" ';
				$contentAttr = 'class="flex-card-content"';
			} else if ($imgPosition == 'overlay') {
				$imgAttr = 'class="img-fluid"';
				$contentAttr = 'class="flex-card-content ' . $vAlign . '"';
			}
            echo '<div class="flex-card" style="height: calc(100% /'.$colPostNum.')">';
			echo '<img ' . $imgAttr . '" src="' . $thumbnail . '" alt="' . $title . '">';
			echo '<div ' . $contentAttr . '">';
			echo '<h3 class="card-title">' . $title . '</h3>';
			echo '</div>';
			echo '</div>';
		}

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $posts = $this->getPosts($settings);
        $postNum = count($posts);

        /*** Start Content Section ***/
        echo '<div class="mtn-flex-grid-section">';
        echo '<div class="row">';
        foreach ( range(0, $postNum) as $Npost){

        if ($settings['flex_grid']) {
            $colCount = count($settings['flex_grid']);
            foreach ($settings['flex_grid'] as $key => $item) {    

                $colPostNum = $item['posts_per_column'];
                $columnWidth = $item['bru_box_width'];
                if ($columnWidth > 0)
						$columnWidth = 'flex-column col-md-' . $columnWidth;
					else
						$columnWidth = 'flex-column col-md';

                 echo'<div class="'.$columnWidth.'">';
                   foreach (range(0,$colPostNum-1) as $index) { 
                    $i = intval($index+$key+$Npost);
                    if(isset($posts[$i])){
                        $this->box_card_item($settings,$item,$i,$colPostNum);
                    }
                    
                   }
                
                echo '</div>';
            }
        }
    }
        echo '</div>';
        echo '</div>';

        // /*** End Content Section ***/


    }
}
