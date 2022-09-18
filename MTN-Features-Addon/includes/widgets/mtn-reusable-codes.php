<?php

namespace MTN_FEATURES\Widgets;

if (!function_exists('icon_control')) {
    function icon_control($label = 'Icon')
    {
        $arr = [
            'label' => esc_html__( $label , 'mtn' ),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-check',
                'library' => 'fa-solid',
            ],
            'fa4compatibility' => 'icon',
        ];

        return apply_filters('mtn_column_number', $arr);
    }
}
if (!function_exists('column_number_control')) {
    function column_number_control($count_to_ten, $default = 10)
    {
        $arr = [
            'label' => esc_html__('Number of Columns', 'mtn'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => $default,
            'options' => ['' => esc_html__('Default', 'mtn')] + $count_to_ten,
        ];

        return apply_filters('mtn_column_number', $arr);
    }
}

if (!function_exists('space_between_control')) {
    function space_between_control($selector, $default = 10)
    {
        $arr =  [
            'label' => esc_html__('Space Between', 'mtn'),
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

        return apply_filters('mtn_space_between', $arr);
    }
}
if (!function_exists('slider_control')) {
    function slider_control($label ='Height', $selector, $props, $default = 300,$extra = null)
    {
        if(!isset($extra['min-px'])) $extra['min-px'] = 0;
        if(!isset($extra['max-px'])) $extra['max-px'] = 1000;
        $arr =  [
            'label' => esc_html__($label, 'mtn'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'default' => [
                'unit' => 'px',
                'size' => $default
            ],
            'range' => [
                'px' => [
                    'min' => $extra['min-px'],
                    'max' => $extra['max-px'],
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} '.$selector => $props.': {{SIZE}}{{UNIT}} !important',
            ],
        ];

        return apply_filters('mtn_slider_control', $arr);
    }
}
if (!function_exists('padding_control')) {
    function padding_control($label = 'Padding', $selector)
    {
        $arr = [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__($label, 'mtn'),
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];

        return apply_filters('mtn_padding_control', $arr);
    }
}

if (!function_exists('border_control')) {
    function border_control($name = 'border', $label = 'Border', $selector)
    {
        $arr = [
            'name' => $name,
            'label' => esc_html__($label, 'mtn'),
            'selector' => '{{WRAPPER}} ' . $selector,
        ];

        return apply_filters('mtn_border_control', $arr);
    }
}
if (!function_exists('border_radius_control')) {
    function border_radius_control($selector)
    {
        $arr = [
            'label' => esc_html__('Border Radius', 'mtn'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ];

        return apply_filters('mtn_border_radius', $arr);
    }
}

// HEADING
if (!function_exists('heading_control')) {
    function heading_control($title)
    {
        $arr = [
            'label' => esc_html__($title, 'mtn'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ];

        return apply_filters('mtn_heading_control', $arr);
    }
}

// COLOR
if (!function_exists('color_control')) {
    function color_control($selector)
    {
        $arr = [
            'label' => esc_html__('Color', 'mtn'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ],
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
            ],
        ];

        return apply_filters('mtn_color_control', $arr);
    }
}

if (!function_exists('background_control')) {
    function background_control($name = 'background', $selector)
    {
        $arr = [
            'name' => $name,
            'label' => esc_html__('Tariff Background', 'mtn'),
            'types' => ['classic', 'gradient', 'video'],
            'selector' => '{{WRAPPER}} ' . $selector,
        ];

        return apply_filters('mtn_bg_control', $arr);
    }
}

if (!function_exists('typography_control')) {
    function typography_control($name = 'title_typography', $selector)
    {
        $arr = [
            'name' => $name,
            'selector' => '{{WRAPPER}} ' . $selector,
            'global' => [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
            ],
        ];

        return apply_filters('mtn_typography_control', $arr);
    }
}
