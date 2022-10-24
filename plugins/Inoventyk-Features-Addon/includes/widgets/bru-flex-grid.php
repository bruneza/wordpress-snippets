<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 */

namespace INO_FEATURES\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('bru_flex_grid')) {
	class bru_flex_grid  extends \Elementor\Widget_Base
	{

		private $ksettings = null;

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
			return 'bru-Flex Grid';
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
			return esc_html__('bru-Flex Grid', 'kura');
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
				'general_grid_settings',
				[
					'label' => esc_html__('General Grid Settings', 'kura'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$repeater = new \Elementor\Repeater();


			$repeater->add_control(
				'bru_box_alignment',
				[
					'label' => esc_html__('Content Alignment', 'kura'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'column',
					'options' => [
						'column' => 'Column',
						'row' => 'Row',
					]
				]
			);
			$repeater->add_control(
				'bru_box_width',
				[
					'label' => esc_html__('Column', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 12,
				]
			);
			$repeater->add_control(
				'bru_box_posts',
				[
					'label' => esc_html__('Number of Posts', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]
			);
			$repeater->add_control(
				'bru_Box_order',
				[
					'label' => esc_html__('Box Order', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
				]
			);
			$repeater->add_control(
				'bru_box_offset',
				[
					'label' => esc_html__('Post Offset', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,
				]
			);

			$repeater->add_control(
				'bru_image_position',
				[
					'label' => esc_html__('Content Alignment', 'kura'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'overlay',
					'options' => [
						'overlay' => 'Overlay',
						'top' => 'Top',
					]
				]
			);

			$repeater->add_responsive_control(
				'bru_image_height',
				[
					'label' => esc_html__('Image Height', 'kura'),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => ['%', 'px'],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 150,
							'max' => 1000,
						],
						'%' => [
							'min' => 30,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .card img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$repeater->add_responsive_control(
				'bru_box_padding',
				[
					'label' => esc_html__('Box Column Padding', 'kura'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.bru-flex-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'after',
				]
			);

			$repeater->add_responsive_control(
				'bru_content_gap',
				[
					'label' => esc_html__('Column content Gap', 'kura'),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => ['%', 'px'],
					'default' => [
						'unit' => 'px',
						'size' => '0',
					],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.flex-row .card:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2);',
						'{{WRAPPER}} {{CURRENT_ITEM}}.flex-row .card:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}} / 2);',
						'{{WRAPPER}} {{CURRENT_ITEM}}.flex-column .card:not(:first-child)' => 'padding-top: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.flex-column .card:not(:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'after',
				]
			);
			$repeater->add_responsive_control(
				'bru_content_padding',
				[
					'label' => esc_html__('Column Content Padding', 'kura'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'after',
				]
			);

			$repeater->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'bru_row_overlay',
					'label' => esc_html__('FlexBox Overlay', 'kura'),
					'types' => ['classic', 'gradient', 'bru'],
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .card-img-overlay',
				]
			);

			$repeater->add_control(
				'bru_box_show_title',
				[
					'label' => esc_html__('Show Title', 'kura'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'kura'),
					'label_off' => esc_html__('Hide', 'kura'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$repeater->add_control(
				'title_valign',
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

			$repeater->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} h3',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'condition' => [
						'bru_box_show_title' => 'yes',
					],
				]
			);

			$repeater->add_control(
				'bru_row_title_color',
				[
					'label' => esc_html__('Title Color', 'kura'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .card-title' => 'color: {{VALUE}}',
					],
					'condition' => [
						'bru_box_show_title' => 'yes',
					],
				]
			);
			$repeater->add_control(
				'bru_box_css',
				[
					'label' => esc_html__('Column Extra Css', 'kura'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('', 'kura'),
					'placeholder' => esc_html__('Type your title here', 'kura'),
				]
			);

			$this->add_control(
				'bru_box',
				[
					'label' => esc_html__('Repeater List', 'kura'),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'bru_row_category' => esc_html__('health'),
							'bru_row_columns' => 1,
						],
					],
					'title_field' => '{{{ bru_box_posts }}} Posts',
				]
			);

			$this->end_controls_section();

			INO_query_control($this, 'ino');
		}
		protected function box_card_item($thumbnail, $imagePosition, $title, $vAlign = null)
		{

			if ($imagePosition == 'top') {
				$imgClass = 'card-img-top';
				$contentClass = 'card-body';
			} else if ($imagePosition == 'overlay') {
				$imgClass = 'card-img';
				$contentClass = 'card-img-overlay ' . $vAlign . '';
			}

			echo '<img class="' . $imgClass . '" src="' . $thumbnail . '" alt="' . $title . '">';
			echo '<d	iv class="box-content ' . $contentClass . ' d-flex">';
			echo '<h3 class="card-title">' . $title . '</h3>';
			echo '</d>';
		}
		protected function render()
		{
			$settings = $this->get_settings_for_display();

			$settings = $this->get_settings_for_display();
			$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');
			$taxArray =  validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs');

			$mtnSettings = [
				'x_post_type' => $postType,
				'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
				'x_taxonomy' => $taxArray,
				'x_terms' => validateEleCPT($settings, 'mtn_posts_include_term_ids'),
				'x_show' => 'by_terms',
			];

			// $inoQuery = new \INO_FEATURES\INO_Helper\ino_query_helper($mtnSettings);
			// $posts = $inoQuery->helper_tester();

			// echo '<br>-----$terms-----<br>';
			// print_r($posts);
			// echo '<br>----------<br>';







			/*** Start Content Section ***/
			echo '<div class="bru-box-section row">';
			if ($settings['bru_box']) {
				foreach ($settings['bru_box'] as $key => $item) {
					/***Retrieve Settings ***/
					$selectedCat = $item['bru_box_category'];
					$contentAlign = $item['bru_box_alignment'];
					$imgPosition = $item['bru_image_position'];
					$columnWidth = $item['bru_box_width'];
					$boxOrder = $item['bru_Box_order'];
					if ($boxOrder)
						$boxOrder = 'order: ' . $boxOrder . ';';
					else
						$boxOrder = null;


					if ($columnWidth > 0)
						$columnWidth = 'col-md-' . $columnWidth;
					else
						$columnWidth = 'col-md';

					$postNumber = $item['bru_box_posts'];
					$offSet = $item['bru_box_offset'];
					$extraCss = $item['bru_box_css'];


					/*** Create ARGS ***/
					$args = array(
						'post_type' => $this->postType(),
						'posts_per_page'	=> $postNumber,
						'offset'	=> $offSet,
					);
					echo '<div class="bru-flex-box ' . $extraCss . ' ' . $columnWidth . ' col-sm-12 flex-' . $contentAlign . ' elementor-repeater-item-' . esc_attr($item['_id']) . '" style="' . $boxOrder . '">';
					/**** Request Post ****/
					if ($selectedCat == 'all_terms') $selectedCat = null;
					$posts = bru_posts($args, $selectedCat);

					if (isset($posts)) {
						foreach ($posts as $post) {
							$bgImg = $post['thumbnail'];

							if ($item['title_valign'] == 'overlay')
								echo '<div class="card col-content h-100">';
							else
								echo '<div class="card col-content">';

							$this->box_card_item($bgImg, $imgPosition, $post['title'], $item['title_valign']);
							echo '</div>';
						}
					}
					echo '</div>';
				}
			}
			echo '</div>';
			/*** End Content Section ***/
		}
	}
}
