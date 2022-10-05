<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Tariffs_Widget  extends \Elementor\Widget_Base
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
        return 'MTN Tariffs';
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
        return esc_html__('MTN Tariffs', 'mtn');
    }

    /**
     * Get widget tariff.
     *
     * Retrieve test widget tariff.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget tariff.
     */
    public function get_tariff()
    {
        return 'etariff-code';
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
        $count_to_ten = range(1, 10);
		$count_to_ten = array_combine($count_to_ten, $count_to_ten);

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
				'exclude' => [
				],
			]
		);

        $this->end_controls_section();

        /*** Style begins here***/

        $this->start_controls_section(
            'tariff_grid_style',
            [
                'label' => esc_html__('Tariff Grid Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'Hspace_between_x',
            [
                'label' => esc_html__('Horizontal Gap', 'mtn'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tariff-column' => 'padding-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .tariff-column:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .tariff-column:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_control(
            'main_title_color',
            [
                'label' => esc_html__('Main Title Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} h4.mtn-tariff-title ' => 'color: {{VALUE}}',
                ],
            ],
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography',
                'selector' => '{{WRAPPER}} h4.mtn-tariff-title',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'tariff_secondary_color',
            [
                'label' => esc_html__('Value Title Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} p.tariff-secondary-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'secondary_typography',
                'selector' => '{{WRAPPER}} p.tariff-secondary-title',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tariff_grid_background',
                'label' => esc_html__('Tariff Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mtn-tariff-item',
            ]
        );

        $this->add_responsive_control(
            'grid_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Grid Padding', 'mtn'),
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mtn-tariff-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tariff_border_radius',
            [
                'label' => esc_html__('Tariff Border Radius', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtn-tariff-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tariff_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mtn-tariff-item',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'tariff_value_style',
            [
                'label' => esc_html__('Tariff Values Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tariff_value_color',
            [
                'label' => esc_html__('Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-tariff-value' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'value_typography',
                'selector' => '{{WRAPPER}} p.mtn-tariff-value',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'tariff_value_padding',
            [
                'label' => esc_html__('Padding', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mtn-tariff-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Action Button Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} a.tariff-btn',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__('Padding', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tariff-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => esc_html__('Btn Margin', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tariff-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs(
            'contact_tabs'
        );
        
        $this->start_controls_tab(
            'style_Phone_tab',
            [
                'label' => esc_html__( 'Phone', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'phone_color',
            [
                'label' => esc_html__('Phone Btn Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-phone-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'phone_border',
                'label' => esc_html__('Border', 'mtn'),
                'selector' => '{{WRAPPER}} .mtn-phone-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'phone_background',
                'label' => esc_html__('Email Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mtn-phone-btn',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_Email_tab',
            [
                'label' => esc_html__( 'Email', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'email_color',
            [
                'label' => esc_html__('Email Btn Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtn-email-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'email_border',
                'label' => esc_html__('Border', 'mtn'),
                'selector' => '{{WRAPPER}} .mtn-email-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'email_background',
                'label' => esc_html__('Phone Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mtn-email-btn',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        

        $this->add_responsive_control(
            'tariff_btn_radius',
            [
                'label' => esc_html__('Btn Border Radius', 'mtn'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tariff-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function validateControl($field, $switch)
    {
        if ($switch == 'yes' && $field)
            return $field;
        else
            return false;
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $phone = $settings['mtn_tariff_phone'];
        $email = $settings['mtn_tariff_email'];
        /*** Start Content Section ***/
        echo '<div class="mtn-tariff-grid-section">';
        echo '<div class="row mtn-tariff-items">';

        foreach ($settings['mtn_tariff_items'] as $item) {
            $type = $this->validateControl($item['type_title'], $item['show_type_title']);
            $speed = $this->validateControl($item['dedicated_speed'], $item['show_dedicated_speed']);
            $nFee = $this->validateControl($item['normal_fee'], $item['show_normal_fee']);
            $mFee = $this->validateControl($item['monthly_fee'], $item['show_monthly_fee']);
            $rFee = $this->validateControl($item['router_fee'], $item['show_router_fee']);
            if($settings['Num_of_col'])
            $numCol = $settings['Num_of_col'];
            else
            $numCol = 6;
?>
            <div class="tariff-column col-md-<?=$numCol?> col-sm-12" >
                <div class="mtn-tariff-item">
                    <div class="tariff-info tariff-info-1">
                        <h4 class="mtn-tariff-title"><?= $type; ?></h4>
                    </div>
                    <?php if (!empty($rFee)) { ?>
                        <div class="tariff-info tariff-info-1 ">
                            <div class="d-flex justify-content-between border-yb-gray">
                                <div class="speed-content">
                                    <p class="tariff-secondary-title">DEDICATED SPEED</p>
                                    <p class="mtn-tariff-speed mtn-tariff-value"><?= $speed; ?></p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-yb-gray">
                                <div class="month-price">
                                    <p class="tariff-secondary-title">MONTHLY RENTAL VAT INCLUSIVE</p>
                                    <p class="mtn-tariff-value"><?= $mFee; ?></p>
                                </div>
                                <div class="tariff-contact">
                                    <p class="tariff-secondary-title ">ROUTER</p>
                                    <p class="mtn-tariff-value"><?= $rFee; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } else if (!empty($nFee)) { ?>
                        <div class="tariff-info tariff-info-1 ">
                            <div class="d-flex justify-content-between border-yb-gray">
                                <div class="month-price">
                                    <p class="tariff-secondary-title">Start from</p>
                                    <p class="mtn-tariff-value"><?= $nFee; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="tariff-info tariff-info-2">
                            <div class="d-flex justify-content-between border-yb-gray">
                                <div class="speed-content">
                                    <p class="tariff-secondary-title">DEDICATED SPEED</p>
                                    <p class="mtn-tariff-value"><?= $speed; ?></p>
                                </div>
                                <div class="month-price">
                                    <p class="tariff-secondary-title">MONTHLY RENTAL VAT INCLUSIVE</p>
                                    <p class="mtn-tariff-value"><?= $mFee; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (empty($nFee)) { ?>
                    <div class="tariff-contact">
                        <p class="tariff-secondary-title">Installation are free of charge</p>
                        <div class="d-flex justify-content-between">
                            <a href="tel:<?= $phone; ?>" class="mtn-phone-btn tariff-btn btn-long-left">Call Us</a>
                            <a href="mailto:<?= $email; ?>" class="mtn-email-btn tariff-btn btn-long-left">Email Us</a>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="tariff-amenities mtn-text-font mtn-text-gray">
                        <p>Flat Fee <br> Data Package</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php
        }

        echo '</div></div>';
        /*** End Content Section ***/
    }
}
