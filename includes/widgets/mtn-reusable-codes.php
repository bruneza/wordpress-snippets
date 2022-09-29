<?php

if (!function_exists('switcher_control')) {
    /**
     * switcher control
     *
     * @param  [type]  $parentControl
     * @param  string $name
     * @param  string $label
     * @param  array  $extra[
     * 'condition' => array 
     * ]
     * 
     * @return void
     */
    function switcher_control($parentControl, $name = 'show', $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Show';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mtn'),
            'label_off' => esc_html__('Hide', 'mtn'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => $extra['condition'],
        ];
        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('select_callback_control')) {
    /**
     * Select Control Function
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $callback
     * @param  array  $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */

    function select_callback_control($parentControl, $name = 'text', $callback = null, $extra = array())
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
    /**
     * Select Style Control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $options
     * @param array $selector
     * @param  array  $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */
    function select_style_control($parentControl, $name = 'text', $options, $selector, $extra = array())
    {
        if (!isset($extra['label'])) $extra['label'] = 'Select';
        if (!isset($extra['default'])) $extra['default'] = '';

        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => $extra['default'],
            'options' =>  $options,
            'selectors' => [
                '{{WRAPPER}} ' . $selector[0] => $selector[1] . ': {{VALUE}};',
            ],
            'condition' => $extra['condition'],
        ];
        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('select2_callback_control')) {
    /**
     * select2_callback_control
     *
     * @param   [type] $parentControl
     * @param   string $name
     * @param   array $callback
     * @param   array  $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */
    function select2_callback_control($parentControl, $name = 'text', $callback = null, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Select';
        if (!isset($extra['default'])) $extra['default'] = '';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'default' => $extra['default'],
            'multiple' => true,
            'options' =>  $callback,
        ];
        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('text_control')) {
    /**
     * Text Control function
     *
     * @param   [type]  $parentControl
     * @param   string  $name
     * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */
    function text_control($parentControl, $name = 'text', $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Text';
        if (!isset($extra['placeholder'])) $extra['placeholder'] = 'Item';
        if (!isset($extra['default'])) $extra['default'] = '';

        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => esc_html__($extra['placeholder'], 'mtn'),
            'default' => esc_html__($extra['default'], 'mtn'),
            'dynamic' => [
                'active' => true,
            ],
            'condition' => $extra['condition']
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('link_control')) {

    /**
     * Link Control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */
    function link_control($parentControl, $name = 'text', $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__('https://your-link.com', 'mtn'),
            'options' => ['url', 'is_external', 'nofollow'],
            'condition' => $extra['condition'],
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
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

    /**
     * editor_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * 
     * @return void
     */
    function editor_control($parentControl, $name, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => esc_html__('Default description', 'mtn'),
            'condition' => $extra['condition'],
            'placeholder' => esc_html__('Type your description here', 'mtn'),
        ];
        $parentControl->add_control($name, $arr);
    }
}
if (!function_exists('number_control')) {
    /**
     * Number Control
     *
     * @param [type] $parentControl
     * @param string $name
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function number_control($parentControl, $name, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        if (!isset($extra['default'])) $extra['default'] = 3;
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => $extra['default'],
        ];
        $parentControl->add_control($name, $arr);
    }
}
if (!function_exists('icon_control')) {
    /**
     * icon_control
     *
     * @param [type] $parentControl
     * @param string $name
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function icon_control($parentControl, $name, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Icon';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
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
    /**
     * count_ten_control
     *
     * @param [type] $parentControl
     * @param [type] $label
     * @param string $name
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function count_ten_control($parentControl, $name, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Count';
        if (!isset($extra['default'])) $extra['default'] = 1;
        $count_to_ten = range(1, 10);
        $count_to_ten = array_combine($count_to_ten, $count_to_ten);

        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => $extra['default'],
            'options' => ['' => esc_html__('Default', 'mtn')] + $count_to_ten,
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('space_between_control')) {
    /**
     * space_between_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function space_between_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Space Between';
        if (!isset($extra['default'])) $extra['default'] = 10;
        $arr =  [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => $extra['default']
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
    function vertical_spacing_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Vertical Spacing';
        if (!isset($extra['default'])) $extra['default'] = 10;
        $arr =  [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => $extra['default']
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
     * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function slider_control($parentControl, $name, $selector, $extra = array())
    {

        if (!isset($extra['min-px'])) $extra['min-px'] = 0;
        if (!isset($extra['max-px'])) $extra['max-px'] = 1000;
        if (!isset($extra['default'])) $extra['default'] = 300;
        if (!isset($extra['label'])) $extra['label'] = 'Height';
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['max-percent'])) $extra['max-percent'] = 100;
        $arr =  [
            'label' => esc_html__($extra['label'], 'mtn'),
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
    /**
     * select_value_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function select_value_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Value';
        if (!isset($extra['default'])) $extra['default'] = 'auto';
        $count = range(1, 15);
        $count = array_combine($count, $count);

        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => $extra['default'],
            'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
            'selectors' => [
                '{{WRAPPER}} ' . $selector[0] => $selector[1] . ': {{VALUE}};',
            ],
        ];

        $parentControl->add_responsive_control($name, $arr);
    }
}
if (!function_exists('padding_control')) {
    /**
     * padding_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function padding_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Padding';
        $arr = [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__($extra['label'], 'mtn'),
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];
        $parentControl->add_responsive_control($name, $arr);
    }
}

if (!function_exists('border_control')) {
    /**
     * border_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function border_control($parentControl, $name = 'border', $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Border';
        $arr = [
            'name' => $name,
            'label' => esc_html__($extra['label'], 'mtn'),
            'selector' => '{{WRAPPER}} ' . $selector,
        ];

        $parentControl->add_group_control(\Elementor\Group_Control_Border::get_type(), $arr);
    }
}
if (!function_exists('border_radius_control')) {
    /**
     * border_radius_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function border_radius_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
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
    /**
     * grid_area_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function grid_area_control($parentControl, $name, $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        if (!isset($extra['default'])) $extra['default'] = 3;
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
    /**
     * heading_control
     *
     * @param [type] $parentControl
     * @param string $name
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function heading_control($parentControl, $name, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ];

        $parentControl->add_control($name, $arr);
    }
}

// COLOR
if (!function_exists('color_control')) {
    /**
     * color_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param string $label
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function color_control($parentControl, $name = 'color', $selector, $extra = array())
    {
        if (!isset($extra) || !is_array($extra)) $extra = array();
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Color';
        $arr = [
            'label' => esc_html__($extra['label'], 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
                '{{WRAPPER}} ' . $selector . ' svg path' => 'fill: {{VALUE}}',
            ],
            'condition' => $extra['condition'],
        ];

        $parentControl->add_control($name, $arr);
    }
}

if (!function_exists('background_control')) {
    /**
     * background_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param string $label
     * @param array $selector
     * @param [type] $exclude
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function background_control($parentControl, $name = 'Background', $selector, $exclude = null, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'Background';
        if (!isset($extra['default'])) $extra['default'] = 3;
        $arr =
            [
                'name' => $name,
                'label' => esc_html__($extra['label'], 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} ' . $selector,
                'exclude' => $exclude,
            ];
        $parentControl->add_group_control(\Elementor\Group_Control_Background::get_type(), $arr);
    }
}
if (!function_exists('box_shadow_control')) {
    /**
     * box_shadow_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function box_shadow_control($parentControl, $name = 'Box Shadow', $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        if (!isset($extra['default'])) $extra['default'] = 3;
        $arr = [
            'name' => 'tab_box_shadow',
            'label' => esc_html__('Box Shadow', 'mtn'),
            'selector' => '{{WRAPPER}} ' . $selector,
        ];
        $parentControl->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), $arr);
    }
}

if (!function_exists('typography_control')) {
    /**
     * typography_control
     *
     * @param [type] $parentControl
     * @param string $name
     * @param array $selector
    * @param   array   $extra[
     * 'condition' => array,
     * 'label' => string,
     * 'default' => mixed,
     * 'min-px' => integer
     * 'max-px' => integer,
     * max-percent' => integer
     * ]
     * @return void
     */
    function typography_control($parentControl, $name = 'title_typography', $selector, $extra = array())
    {
        if (!isset($extra['condition'])) $extra['condition'] = array();
        if (!isset($extra['label'])) $extra['label'] = 'URL';
        if (!isset($extra['default'])) $extra['default'] = 3;
        $arr = [
            'name' => $name,
            'selector' => '{{WRAPPER}} ' . $selector,
            'condition' => $extra['condition'],
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
        ];

        $parentControl->add_group_control(\Elementor\Group_Control_Typography::get_type(), $arr);
    }
}
