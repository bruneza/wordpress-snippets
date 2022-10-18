<?php
if (!function_exists('register_vacancy_control')) {
	function register_vacancy_control($thisVacancy)
	{
		// ANCHOR: filter grid - content section
		$thisVacancy->start_controls_section(
			'vacancy_content_style',
			[
				'label' => esc_html__('Vacancy Content Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$thisVacancy->add_control(
			'vacancy_content_departments',
			[
				'label' => esc_html__('Departents', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$thisVacancy->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'vacancy_content_dep_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .department',
			]
		);

		$thisVacancy->add_control(
			'vacancy_content_dep_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .department' => 'color: {{VALUE}}',
				],
			]
		);
		$thisVacancy->add_control(
			'vacancy_content_date',
			[
				'label' => esc_html__('Closing Date', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$thisVacancy->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'vacancy_content_date_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .date-meta',
			]
		);

		$thisVacancy->add_control(
			'vacancy_content_date_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .date-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$thisVacancy->end_controls_section();
	}
}

//ANCHOR : filter grid - Button Card Style
if (!function_exists('register_filter_card_button')) {
	function register_filter_card_button($thisVacancy, $prefix)
	{
		$thisVacancy->start_controls_section(
			'section_style_' . $prefix,
			[
				'label' => esc_html__('Icon', 'elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$thisVacancy->start_controls_tabs($prefix . '_colors');

		$thisVacancy->start_controls_tab(
			$prefix . '_colors_normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$thisVacancy->add_control(
			$prefix . '_primary_color',
			[
				'label' => esc_html__('Primary Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$thisVacancy->add_control(
			$prefix . '_secondary_color',
			[
				'label' => esc_html__('Secondary Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$thisVacancy->end_controls_tab();

		$thisVacancy->start_controls_tab(
			$prefix . '_colors_hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		$thisVacancy->add_control(
			$prefix . '_hover_primary_color',
			[
				'label' => esc_html__('Primary Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$thisVacancy->add_control(
			$prefix . '_hover_secondary_color',
			[
				'label' => esc_html__('Secondary Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$thisVacancy->add_control(
			$prefix . '_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'elementor'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$thisVacancy->end_controls_tab();

		$thisVacancy->end_controls_tabs();

		$thisVacancy->add_responsive_control(
			$prefix . '_size',
			[
				'label' => esc_html__('Size', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$thisVacancy->add_control(
			$prefix . '_icon_padding',
			[
				'label' => esc_html__('Padding', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$thisVacancy->add_control(
			$prefix . '_border_width',
			[
				'label' => esc_html__('Border Width', 'elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$thisVacancy->add_control(
			$prefix . '_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$thisVacancy->end_controls_section();
	}
}
