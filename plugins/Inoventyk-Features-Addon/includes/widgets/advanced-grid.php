<?php

namespace INO_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
// use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

use ElementorPro\Modules\QueryControl\Controls\Group_INO_Query;

if (!defined('ABSPATH')) {
	exit;
}


class INO_Advanced_Grid  extends \Elementor\Widget_Base
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
		return 'Advanced Grid';
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
		return esc_html__('Advanced Grid', 'mtn');
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

	// Register Controller
	protected function register_controls()
	{
		$count = range(0, 15);
		$count = array_combine($count, $count);

		// ANCHOR: Complex Carousel - Content Control
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content layout', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// ANCHOR: Complex Carousel - Grid Structure
		$this->add_responsive_control(
			'grid_template_columns',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Grid Number of Columns', 'mtn'),
				'default' => [
					'size' => 'auto'
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 12,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-row' => 'grid-template-columns : repeat({{SIZE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->add_responsive_control(
			'grid_template_rows',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Grid Number of Rows', 'mtn'),
				'default' => [
					'size' => 'auto'
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-row' => 'grid-template-rows : repeat({{SIZE}}, minmax(0, 1fr));',
				],
			]
		);

		// ANCHOR: Complex Carousel - Start Repeater
		$contentRepeater = new \Elementor\Repeater();

		// ANCHOR: Complex Carousel - Custom Grid Item Settings

		$contentRepeater->add_responsive_control(
			'custom_grid_styling',
			[
				'label' => esc_html__('Grid Style Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'custom_display',
				'devices' => ['desktop', 'tablet', 'mobile'],
				'options' => [
					'default_display' => 'default',
					'custom_display' => 'Custom',
				],
			]
		);

		$contentRepeater->add_control(
			"custom_grid_setting_heading",
			[
				'label' => esc_html__("Grid Settings", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'custom_grid_styling' => 'custom_display',
				],
				'device_args' => [
					'desktop' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'tablet' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'mobile' => [
						'custom_grid_styling' => 'custom_display',
					]
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_grid_row_start',
			[
				'label' => esc_html__('Grid Row Start', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.complex-column-item' => 'grid-row-start: {{VALUE}};',
				],
				'condition' => [
					'custom_grid_styling' => 'custom_display',
				],
				'device_args' => [
					'desktop' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'tablet' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'mobile' => [
						'custom_grid_styling' => 'custom_display',
					]
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_grid_row_end',
			[
				'label' => esc_html__('Grid Row End', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.complex-column-item' => 'grid-row-end: {{VALUE}};',
				],
				'condition' => [
					'custom_grid_styling' => 'custom_display',
				],
				'device_args' => [
					'desktop' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'tablet' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'mobile' => [
						'custom_grid_styling' => 'custom_display',
					]
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_grid_column_start',
			[
				'label' => esc_html__('Grid Column Start', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.complex-column-item' => 'grid-column-start: {{VALUE}};',
				],
				'condition' => [
					'custom_grid_styling' => 'custom_display',
				],
				'device_args' => [
					'desktop' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'tablet' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'mobile' => [
						'custom_grid_styling' => 'custom_display',
					]
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_grid_column_end',
			[
				'label' => esc_html__('Grid Column End', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.complex-column-item' => 'grid-column-end: {{VALUE}};',
				],
				'condition' => [
					'custom_grid_styling' => 'custom_display',
				],
				'device_args' => [
					'desktop' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'tablet' => [
						'condition' => [
							'custom_grid_styling' => 'custom_display',
						]
					],
					'mobile' => [
						'custom_grid_styling' => 'custom_display',
					]
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'grid_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Grid Padding', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-column-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// ANCHOR: Complex Carousel - Grid Image Settings
		$contentRepeater->add_control(
			"grid_img",
			[
				'label' => esc_html__("Grid Image", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_img_display',
			[
				'label' => esc_html__('Grid Image Display Setting', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default_display',
				'options' => [
					'default_display' => 'default',
					'custom_display' => 'Custom',
					'hide_display' => 'Hide',
				],
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_img_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Set Image Height', 'mtn'),
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-img-container img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'custom_img_display' => 'custom_display',
				]
			]
		);

		$contentRepeater->add_responsive_control(
			'custom_img_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Set Image Width', 'mtn'),
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-img-container img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'custom_img_display' => 'custom_display',
				]
			]
		);

		$contentRepeater->add_control(
			'custom_object_fit',
			[
				'label' => esc_html__('Object Fit', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'contain',
				'options' => [
					'fill' => 'Fill',
					'contain' => 'Contain',
					'cover' => 'Cover',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-img-container img' => 'object-fit: {{VALUE}};',
				],
				'condition' => [
					'custom_img_display' => 'custom_display',
				]
			]
		);

		//ANCHOR: Complex Carousel - Grid content Settings
		$contentRepeater->add_control(
			"content_content_heading",
			[
				'label' => esc_html__("Content Setting", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$contentRepeater->add_control(

			'show_grid_content',
			[
				'label' => esc_html__('Content Display Settings', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default_display',
				'options' => [
					'default_display' => 'default',
					'custom_display' => 'Custom',
					'hide_display' => 'Hide',
				],
			]
		);
		// Content Title
		$this->add_control(
			'show_grid_title',
			[
				'label' => esc_html__('Show Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'your-plugin'),
				'label_off' => esc_html__('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_grid_content' => 'custom_display',
				]
			]
		);

		$contentRepeater->add_control(
			"content_title_heading",
			[
				'label' => esc_html__("Title", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_title' => 'yes',
				]

			]
		);
		$contentRepeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'custom_title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > h3',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_title' => 'yes',
				]
			],
		);
		$contentRepeater->add_control(
			'custom_title_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_title' => 'yes',
				]
			]
		);

		$contentRepeater->add_control(
			'btn_icon',
			[
				'label' => esc_html__('Button Icon', 'mtn'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		// Content Excerpt
		$this->add_control(
			'show_grid_excerpt',
			[
				'label' => esc_html__('Show Excerpt', 'mtn'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'your-plugin'),
				'label_off' => esc_html__('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_grid_content' => 'custom_display',
				]
			]
		);
		$contentRepeater->add_control(
			"content_excerpt_heading",
			[
				'label' => esc_html__("Excerpt", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_title' => 'show_grid_excerpt',
				]
			]
		);
		$contentRepeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'custom_excerpt_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > p',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_excerpt' => 'yes',
				]
			],
		);

		$contentRepeater->add_control(
			'custom_excerpt_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_excerpt' => 'yes',
				]
			]
		);

		// Content Button
		$this->add_control(
			'show_grid_button',
			[
				'label' => esc_html__('Show Button', 'mtn'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'your-plugin'),
				'label_off' => esc_html__('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_grid_content' => 'custom_display',
				]
			]
		);
		$contentRepeater->add_control(
			"content_btn_heading",
			[
				'label' => esc_html__("Button", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_button' => 'yes',
				]
			]
		);
		$contentRepeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'custom_btn_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > a',
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_button' => 'yes',
				]

			],
		);

		$contentRepeater->add_control(
			'custom_btn_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_grid_content' => 'custom_display',
					'show_grid_title' => 'show_grid_button',
				]
			]
		);

		$this->add_control(
			'content_grid_cols',
			[
				'label' => esc_html__('Content Grid Column', 'mtn'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $contentRepeater->get_controls(),
				'default' => [
					[
						'custom_grid_row_start' => esc_html__('auto'),
						'custom_grid_column_start' => esc_html__('auto'),
						'custom_grid_row_end' => esc_html__('auto'),
						'custom_grid_column_end' => esc_html__('auto'),
					],
				],
				'title_field' => '{{{custom_grid_row_start}}} / {{{custom_grid_column_start}}} / {{{custom_grid_row_end}}} / {{{custom_grid_column_end}}}',
			]
		);

		$this->end_controls_section();

		// Carousel Settings
		$this->start_controls_section(
			'grid_settings_section',
			[
				'label' => esc_html__('Carousel Settings', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => esc_html__('Slides to Scroll', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => $count,
			]
		);

		$this->end_controls_section();

		// ANCHOR: Complex Carousel - Grid Query Controls
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__('Query', 'elementor-pro'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_INO_Query::get_type(),
			[
				'name' => 'ino_query',
			]
		);
		$this->add_control(
			'grid_fields_heading',
			[
				'label' => esc_html__('Choose Fields', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'choose_grid_fields',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => processOutput()['fields'],
				'default' => ['thumbnail', 'post-link']
			]
		);

		$this->end_controls_section();

		// ANCHOR: Complex Carousel - Style Controls Section
		// ANCHOR: Complex Carousel - Grid Style
		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__('Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'grid_grid_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Carousel Grid Height', 'mtn'),
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-row' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_grid_gap',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Grid Gap', 'mtn'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-row' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Item Container
		$this->add_control(
			'grid_heading',
			[
				'label' => esc_html__('Grids Item Container', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// ANCHOR: Complex Carousel - Custom Grid Item Settings
		$this->add_responsive_control(
			'grid_row_start',
			[
				'label' => esc_html__('Grid Row Start', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} .complex-column-item' => 'grid-row-start: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_row_end',
			[
				'label' => esc_html__('Grid Row End', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} .complex-column-item' => 'grid-row-end: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_column_start',
			[
				'label' => esc_html__('Grid Column Start', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} .complex-column-item' => 'grid-column-start: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_column_end',
			[
				'label' => esc_html__('Grid Column End', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => ['auto' => esc_html__('Auto', 'mtn')] + $count,
				'selectors' => [
					'{{WRAPPER}} .complex-column-item' => 'grid-column-end: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_container_border',
				'selector' => '{{WRAPPER}} .complex-column-item',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_container_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Border Radius', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .complex-column-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_container_backgound',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .complex-column-wrapper',
				'exclude' => [
					// eg: image
				]
			]
		);

		// ANCHOR: Complex Carousel -Grid Divider

		$this->add_control(
			'grid_divider_heading',
			[
				'label' => esc_html__('Grids Item Container', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('tabs_divider_types');
		$this->start_controls_tab(
			'tab_top_divider',
			[
				'label' => esc_html__('Top', 'mtn'),
			]
		);

		$this->add_responsive_control(
			'grid_top_divider_type',
			[
				'label' => esc_html__('Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => 'None',
					'curve' => 'Curve',
				],
			]
		);

		$this->add_control(
			'top_divider_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-top .shape-fill' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'grid_topDivider_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Width', 'mtn'),
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 100,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-top' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_topDivider_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Width', 'mtn'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-top svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'invert_top_divider',
			[
				'label' => esc_html__('Invert', 'mtn'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'mtn'),
				'label_off' => esc_html__('Hide', 'mtn'),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bottom_divider',
			[
				'label' => esc_html__('Bottom', 'mtn'),
			]
		);

		$this->add_responsive_control(
			'grid_bottom_divider_type',
			[
				'label' => esc_html__('Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => 'None',
					'curve' => 'Curve',
				],
			]
		);

		$this->add_control(
			'bottom_divider_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-top .shape-fill' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'grid_bottomDivider_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Width', 'mtn'),
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 100,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-bottom' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_bottomDivider_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Width', 'mtn'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .bru-divDivider-bottom svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'invert_bottom_divider',
			[
				'label' => esc_html__('Invert', 'mtn'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'mtn'),
				'label_off' => esc_html__('Hide', 'mtn'),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();





		$this->end_controls_section();

		// Carousel Post Image
		$this->start_controls_section(
			'grid_image_style',
			[
				'label' => esc_html__('Carousel Post Image', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'bulk_img_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Set Image Height', 'mtn'),
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-img-container img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bulk_img_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Set Image Width', 'mtn'),
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-img-container img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bulk_object_fit',
			[
				'label' => esc_html__('Object Fit', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'contain',
				'options' => [
					'fill' => 'Fill',
					'contain' => 'Contain',
					'cover' => 'Cover',
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-img-container img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Carousel Post COntent
		$this->start_controls_section(
			'post_content_style',
			[
				'label' => esc_html__('Carousel Post Content', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Content Title
		$this->add_control(
			"content_title_heading",
			[
				'label' => esc_html__("Title", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .complex-grid-col-content > h3',
			],
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-col-content > p' => 'color: {{VALUE}}',
				],
			]
		);

		// Content Excerpt
		$this->add_control(
			"content_excerpt_heading",
			[
				'label' => esc_html__("Excerpt", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .complex-grid-col-content > p',
			],
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .complex-grid-col-content > p' => 'color: {{VALUE}}',
				],
			]
		);

		// Content Button
		$this->add_control(
			"content_btn_heading",
			[
				'label' => esc_html__("Button", 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .complex-grid-col-content > a',
			],
		);
		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .complex-grid-col-content > p' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
		// Carousel dot Style
		$this->start_controls_section(
			'dot_style',
			[
				'label' => esc_html__('Carousel dot Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dot_horizontal_position',
			[
				'label' => esc_html__('Horizontal Position', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => 'Left',
					'center' => 'center',
					'flex-end' => 'Right',

				],
			]
		);

		$this->add_responsive_control(
			'dot_vertical_offset',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Vertical Offset', 'mtn'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -60,
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// STATE TABS
		$this->start_controls_tabs('tabs_dot_style');
		// Normal State
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
				'label' => esc_html__('Dot Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .owl-dots span',
			]
		);

		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab(
			'tab_dot_active',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dot_active_background',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .owl-dots .active span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dot_hover_background',
				'label' => esc_html__('Dot Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .owl-dots  .active span',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		// END TABS

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dot_border',
				'selector' => '{{WRAPPER}} .owl-dot span',
			]
		);

		$this->add_responsive_control(
			'allbtn_border_radius',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Border Radius', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'coursel_btn_style',
			[
				'label' => esc_html__('Button Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'coursel_btn_padding',
			[
				'label' => esc_html__('Padding', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .btn-white' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'coursel_btn_br',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .btn-white' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_coursel_btn_typography',
				'selector' => '{{WRAPPER}} .btn-white',
			]
		);
		$this->start_controls_tabs(
			'btn_style_tabs'
		);


		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => esc_html__('Normal', 'mtn'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_coursel_btn',
				'label' => esc_html__('Set Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .btn-white',
			]
		);

		$this->add_control(
			'coursel_btn_text_color',
			[
				'label' => esc_html__('Text Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-white' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'btn_hover_style_normal_tab',
			[
				'label' => esc_html__('Hover', 'mtn'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_coursel_btn_hover',
				'label' => esc_html__('Set Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .btn-white:hover',
			]
		);

		$this->add_control(
			'coursel_btn_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-white:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();


		$this->end_controls_tabs();






		$this->end_controls_section();
	}


	// ANCHOR: Complex Carousel - Render
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$neededFields = validateNeededFields($settings, 'choose_grid_fields');
		$postType = validateEleCPT($settings, 'ino_query_post_type', 'ino_query_selected_cpt');

		$inoSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'ino_query_posts_per_page'),
			'x_terms' => validateEleCPT($settings, 'ino_query_include_term_ids'),
			'x_outputs' => $neededFields,
			'x_show' => 'by_terms',
			'x_conditions' => [
				'x_skip_nothumbnail' => true,
			]
		];

		// echo '<br>-----$settings-----<br';
		// print_r($settings);
		// echo '<br>----------<br';


		// $terms = getTerms($inoSettings);
		$posts = postsRender($inoSettings);

		$grid_cols = $settings['content_grid_cols'];
		$grid_col_count = count($grid_cols);

		// echo '<br>-----$grid_col_count-----<br';
		// print_r($grid_col_count);
		// echo '<br>----------<br';

		if (isset($grid_col_count) && isset($posts))
			$posts = array_chunk($posts, $grid_col_count);

?>
		<?php
		//Start Content Section
		echo '<div class="complex-grid-section">';
		echo '<div class=" complex-grid">';

		foreach ($posts as $key => $innerPosts) {
			echo '<div class="complex-grid-row">';
			foreach ($innerPosts as $innerKey => $post) {

				$btnIcon =  processSingleIcon($grid_cols[$innerKey]['btn_icon']);
		?>

				<div class="complex-column-item elementor-repeater-item-<?= $grid_cols[$innerKey]['_id']; ?>">
					<div class="complex-column-wrapper">
						<?php
						if (isset($settings['grid_top_divider_type'])) {
							if ($settings['grid_top_divider_type'] != 'none') {
								if ($settings['invert_top_divider'] == 'yes')
									$invert = 'transform: rotate(180deg);';
						?>
								<div class="bru-divDivider bru-divDivider-top" style=" font-size:auto; <?= $invert; ?>"><?= bruShapeDivider($settings['grid_top_divider_type']); ?></div>
						<?php
							}
						}
						?>

						<div class="complex-item-wrapper">
							<?php if ($grid_cols[$innerKey]['custom_img_display'] != 'hide_display') { ?>
								<div class="complex-grid-img-container">
									<img class="complex-col-img" src="<?= $post['thumbnail']; ?>" />
								</div>
							<?php } ?>
							<?php if ($grid_cols[$innerKey]['show_grid_content'] != 'hide_display') { ?>
								<div class="complex-grid-col-content overlay-content">
									<?php
									if (isset($post['title']))
										echo '<h3>' . $post['title'] . '</h3>';
									if (isset($post['excerpt']))
										echo '<P>' . $post['excerpt'] . '</P>';
									if (isset($post['post-link']))
										echo '<a class ="btn-white btn" href="' . $post['post-link'] . '">
								<span>Read More </span>' . $btnIcon . '</a>'; ?>
								</div>
							<?php } ?>
						</div>
						<?php
						if (isset($settings['grid_bottom_divider_type'])) {
							if ($settings['grid_bottom_divider_type'] != 'none') {
								if ($settings['invert_bottom_divider'] == 'yes') $binvert = 'transform: rotate(180deg);';
								echo '<div class="bru-divDivider bru-divDivider-bottom" style =" font-size:auto; ' . $binvert . '"> ' . bruShapeDivider($settings['grid_bottom_divider_type']) . '</div>';
							}
						}
						?>
					</div>
				</div>
<?php

			}
			echo '</div>';
		}
		echo '</div></div>';
	}
}
