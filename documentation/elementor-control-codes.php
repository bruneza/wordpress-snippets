<?php

/**
 * 
 * Requirements
 * 
 */

/**
 * 
 * NOTE: This file contains all functions to know for Elementor Controls.
 * 
 */

class Elementor_controls_Widget  extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Complex Carousel';
    }
    public function get_title()
    {
        return esc_html__('Complex Carousel', 'mtn');
    }

    // ANCHOR: Control codes
    protected function register_controls()
    {
        $this->start_controls_section(
            'code_control_key',
            [
                'label' => esc_html__('Style Codes Section', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // ANCHOR: Code - Slider_control
        $this->add_responsive_control(
            'code_control_key',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Control Label', 'mtn'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    // condition goes here
                ],
            ]
        );

        // ANCHOR: Code - select_control

        $this->add_control(
            'code_control_key',
            [
                'label' => esc_html__('code_control_label', 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'code_select_def',
                'options' => [
                    'code_opt1'  => esc_html__('code_opt opt 1', 'mtn'),
                    'code_opt1'  => esc_html__('code_opt opt 1', 'mtn'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'code_style_prop: {{VALUE}};',
                ],
                'condition' => [
                    // condition goes here
                ],
            ]
        );

        // ANCHOR: Code - Select2_control

        $this->add_control(
			'show_elements',
			[
				'label' => esc_html__( 'Show Elements', 'mtn' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'title'  => esc_html__( 'Title', 'mtn' ),
					'description' => esc_html__( 'Description', 'mtn' ),
					'button' => esc_html__( 'Button', 'mtn' ),
				],
				'default' => [ 'title', 'description' ],
			]
		);
        // ANCHOR: Code - heading_control
        $this->add_control(
            'code_control_key',
            [
                'label' => esc_html__('code_control_label', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    // condition goes here
                ],
            ]
        );

        // ANCHOR: Code - dimensions_control
        $this->add_responsive_control(
            'code_control_key',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('code_control_label', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    // condition goes here
                ],
            ]
        );

        // ANCHOR: Code - switcher_control
        $this->add_control(
            'code_control_key',
            [
                'label' => esc_html__('code_control_label', 'mtn'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mtn'),
                'label_off' => esc_html__('Hide', 'mtn'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // ANCHOR: Code - typography_control

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .title',
                'condition' => [
                    // condition goes here
                ],
            ]
        );

        // ANCHOR: Code - color_control
        $this->add_control(
            'color_key',
            [
                'label' => esc_html__('Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cssclass' => 'color: {{VALUE}}',
                ],
            ]
        );
        // ANCHOR: Code - Border_control
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .wrapper',
            ]
        );

        // ANCHOR: Code - Background_control
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .your-class',
                'exclude' => [
                    // eg: image
                ]
            ]
        );

        // ANCHOR: Code - text_control

        $this->add_control(
			'widget_title',
			[
				'label' => esc_html__( 'Title', 'mtn' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'mtn' ),
				'placeholder' => esc_html__( 'Type your title here', 'mtn' ),
			]
		);
        // ANCHOR: Code - Editor_control

        $this->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Description', 'mtn' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'mtn' ),
				'placeholder' => esc_html__( 'Type your description here', 'mtn' ),
			]
		);
        // ANCHOR: Code - box_shadow_control

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mtn' ),
				'selector' => '{{WRAPPER}} .your-class',
			]
		);
        // ANCHOR: Code - number_control
        $this->add_control(
			'number',
			[
				'label' => esc_html__( 'Price', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control
        // ANCHOR: Code - _control

        // ANCHOR: Code - Tabs_control
        $this->start_controls_tabs('tabs_dot_style');
            $this->start_controls_tab(
                'tab_dot_normal',
                [
                    'label' => esc_html__('Normal', 'elementor'),
                ]
            );

            // COntrols here

            $this->end_controls_tab();
        $this->end_controls_tabs();


        // ANCHOR: Code - Repeater_control
        $repeater = new \Elementor\Repeater();
        // Control goes here
        $this->add_control(
            'repeater_key',
            [
                'label' => esc_html__('label', 'mtn'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_key' => esc_html__('default value'),
                    ],
                ],
                'title_field' => '{{{item_key}}}',
            ]
        );


        $this->end_controls_section();
    }
}
