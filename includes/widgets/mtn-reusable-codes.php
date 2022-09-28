<?php

if (!function_exists('switcher_control')) {
    function switcher_control($parentControl, $name = 'show', $label = 'Show')
    { {
            $arr = [
                'label' => esc_html__($label, 'mtn'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mtn'),
                'label_off' => esc_html__('Hide', 'mtn'),
                'return_value' => 'yes',
                'default' => 'yes',
            ];
            $parentControl->add_control($name, $arr);
        }
    }
}

if (!function_exists('select_callback_control')) {
    function select_callback_control($parentControl, $name = 'text', $callback = null, $extra = null)
    { {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Select';
        if (!isset($extra['default'])) $extra['default'] = '';

            $arr = [
                'label' => esc_html__($extra['label'], 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => $extra['default'],
                'options' =>  $callback,
                'condition' => $extra['condition']
            ];
            $parentControl->add_control($name, $arr);
        }
    }
}
if (!function_exists('select_style_control')) {
    function select_style_control($parentControl, $name = 'text', $options,$selector, $extra = null)
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Select';
        if (!isset($extra['default'])) $extra['default'] = '';

            $arr = [
                'label' => esc_html__($extra['label'], 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => $extra['default'],
                'options' =>  $options,
                'selectors' => [
					'{{WRAPPER}} '.$selector[0] => $selector[1].': {{VALUE}};',
				],
                'condition' => $extra['condition'],
            ];
            $parentControl->add_control($name, $arr);
        }
}

if (!function_exists('select2_callback_control')) {
    function select2_callback_control($parentControl, $name = 'text', $label = 'Title', $callback = null, $default = 'post')
    { {
            $arr = [
                'label' => esc_html__($label, 'mtn'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => $default,
                'multiple' => true,
                'options' =>  $callback,
            ];
            $parentControl->add_control($name, $arr);
        }
    }
}

if (!function_exists('text_control')) {
    function text_control($parentControl, $name = 'text', $label = 'Title')
    {
        $arr = [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => esc_html__('Item', 'mtn'),
            'default' => esc_html__('Item', 'mtn'),
            'dynamic' => [
                'active' => true,
            ],
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('link_control')) {
    function link_control($parentControl, $name = 'text', $label = 'Link')
    {

        $arr = [
            'label' => esc_html__( $label, 'mtn' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'mtn' ),
            'options' => [ 'url', 'is_external', 'nofollow' ],
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
                // 'custom_attributes' => '',
            ],
            'dynamic' => [
                'active' => true,
            ],
            'label_block' => true,
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('editor_control')) {
    function editor_control($parentControl, $name, $label = 'Description')
    {
        $arr = [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => esc_html__('Default description', 'mtn'),
            'placeholder' => esc_html__('Type your description here', 'mtn'),
        ];
        $parentControl->add_control($name, $arr);
    }
}
if (!function_exists('number_control')) {
    function number_control($parentControl, $name, $label = 'Number', $default = 3)
    {
        $arr = [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => $default,
        ];
        $parentControl->add_control($name, $arr);
    }
}
if (!function_exists('icon_control')) {
    function icon_control($parentControl, $name, $label = 'Icon')
    {
        $arr = [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-check',
                'library' => 'fa-solid',
            ],
            'fa4compatibility' => 'icon',
        ];

        $parentControl->add_control($name, $arr);
    }
}
if (!function_exists('count_ten_control')) {
    function count_ten_control($parentControl, $label, $name, $default = 1)
    {
        
        $count_to_ten = range(1, 10);
		$count_to_ten = array_combine($count_to_ten, $count_to_ten);
        
        $arr = [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => $default,
            'options' => ['' => esc_html__('Default', 'mtn')] + $count_to_ten,
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('space_between_control')) {
    function space_between_control($parentControl, $name, $label = 'Space Between', $selector, $default = 10)
    {
        $arr =  [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => $default
            ],
            'range' => [
                'px' => [
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'padding-bottom: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} ' . $selector . ':not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                '{{WRAPPER}} ' . $selector . ':not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
            ],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}

if (!function_exists('vertical_spacing_control')) {
    function vertical_spacing_control($parentControl, $name, $label = 'Vertical Spacing', $selector, $default = 10)
    {
        $arr =  [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => $default
            ],
            'range' => [
                'px' => [
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector . ':not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
                '{{WRAPPER}} ' . $selector . ':not(:first-child)' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
            ],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}
if (!function_exists('slider_control')) {    
    /**
     * slider control
     *
     * @var $this  $parentControl
     * @param  string $name
     * @param  string $label
     * @param  array $selector
     * @param  integer $default
     * @param  array $extra
     * @return void
     */
    function slider_control($parentControl, $name, $label = 'Height', $selector, $extra = null)
    {
        if (!isset($extra['min-px'])) $extra['min-px'] = 0;
        if (!isset($extra['max-px'])) $extra['max-px'] = 1000;
        if (!isset($extra['default'])) $extra['default'] = 300;
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['max-percent'])) $extra['max-percent'] = 100;
        $arr =  [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'default' => [
                'unit' => 'px',
                'size' => $extra['default']
            ],
            'range' => [
                'px' => [
                    'min' => $extra['min-px'],
                    'max' => $extra['max-px'],
                ],
                '%' => [
                    'min' => 0,
                    'max' => $extra['max-percent'],
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector[0] => $selector[1] . ': {{SIZE}}{{UNIT}} !important',
            ],
            'condition' => $extra['condition'],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}
if (!function_exists('select_value_control')) {   
    function select_value_control($parentControl, $name, $label = 'Value', $selector, $default = 30, $extra = null)
    {
        $count = range(1, 15);
		$count = array_combine($count, $count);

			$arr = [
				'label' => esc_html__( $label, 'mtn' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} '.$selector[0] => $selector[1].': {{VALUE}};',
				],
			];

        $parentControl->add_responsive_control($name, $arr);
    }
}
if (!function_exists('padding_control')) {
    function padding_control($parentControl, $name, $label = 'Padding', $selector)
    {
        $arr = [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__($label, 'mtn'),
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];
        $parentControl->add_responsive_control($name, $arr);
    }
}

if (!function_exists('border_control')) {
    function border_control($parentControl, $name = 'border', $label = 'Border', $selector)
    {
        $arr = [
            'name' => $name,
            'label' => esc_html__($label, 'mtn'),
            'selector' => '{{WRAPPER}} ' . $selector,
        ];

        $parentControl->add_group_control(\Elementor\Group_Control_Border::get_type(), $arr);
    }
}
if (!function_exists('border_radius_control')) {
    function border_radius_control($parentControl, $name, $selector)
    {
        $arr = [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}

if (!function_exists('grid_area_control')) {
    function grid_area_control($parentControl, $name, $selector)
    {
        $arr = [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}

// HEADING
if (!function_exists('heading_control')) {
    function heading_control($parentControl, $name, $title)
    {
        $arr = [
            'label' => esc_html__($title, 'mtn'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ];

        $parentControl->add_control($name, $arr);
    }
}

// COLOR
if (!function_exists('color_control')) {
    function color_control($parentControl, $name = 'color', $label = 'Color', $selector)
    {
        $arr = [
            'label' => esc_html__('Color', 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
                '{{WRAPPER}} ' . $selector . ' svg path' => 'fill: {{VALUE}}',
            ],
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('background_control')) {
    function background_control($parentControl, $name = 'Background', $label = 'Background', $selector,$exclude = null)
    {
        $arr =
            [
                'name' => $name,
                'label' => esc_html__($label, 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} ' . $selector,
                'exclude' => $exclude,
            ];
        $parentControl->add_group_control(\Elementor\Group_Control_Background::get_type(), $arr);
    }
}
if (!function_exists('box_shadow_control')) {
    function box_shadow_control($parentControl, $name = 'Box Shadow', $selector)
    {
        $arr = [
            'name' => 'tab_box_shadow',
            'label' => esc_html__('Box Shadow', 'mtn'),
            'selector' => '{{WRAPPER}} ' . $selector,
        ];
        $parentControl->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), $arr);
    }
}

if (!function_exists('typography_control')) {
    function typography_control($parentControl, $name = 'title_typography', $selector)
    {
        $arr = [
            'name' => $name,
            'selector' => '{{WRAPPER}} ' . $selector,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
        ];

        $parentControl->add_group_control(\Elementor\Group_Control_Typography::get_type(), $arr);
    }
}
