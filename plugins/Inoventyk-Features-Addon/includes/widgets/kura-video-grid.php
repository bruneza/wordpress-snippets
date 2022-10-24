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

if (!class_exists('kura_video_grid')) {
	class kura_video_grid  extends \Elementor\Widget_Base
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
			return 'Video Grid';
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
			return esc_html__('Video Grid', 'kura');
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
			return 'eicon-youtube';
		}

		public function get_categories()
		{
			return ['basic'];
		}

		private function postType()
		{
			return 'kura_videos';
		}
		/**
		 * Register currency widget controls.
		 *
		 * Add input fields to allow the user to customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
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
				'video_row_category',
				[
					'label' => esc_html__('Row Category', 'kura'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'all',
					'options' => $options,
				]
			);
			$repeater->add_control(
				'video_row_columns',
				[
					'label' => esc_html__('Number of columns', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]
			);
			$repeater->add_control(
				'video_row_offset',
				[
					'label' => esc_html__('Video Offset', 'kura'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,
				]
			);

			$repeater->add_responsive_control(
				'video_row_height',
				[
					'label' => esc_html__('Video Height', 'kura'),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => ['%', 'px'],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 1000,
						],
						'%' => [
							'min' => 30,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item .inner-container' => 'height: calc({{SIZE}}{{UNIT}});',
					],
				]
			);

			$repeater->add_responsive_control(
				'video_row_padding',
				[
					'label' => esc_html__('Column Padding', 'kura'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item' => 'padding-top: {{TOP}}{{UNIT}} ;',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item' => 'padding-bottom: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item:not(:first-child)' => 'padding-left: {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item:not(:last-child)' => 'padding-right: {{RIGHT}}{{UNIT}};',
					],
					'separator' => 'after',
				]
			);
			$repeater->add_responsive_control(
				'video_row_inner_padding',
				[
					'label' => esc_html__('inner Container Padding', 'kura'),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item .inner-container' => 'padding-top: {{TOP}}{{UNIT}} ;',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item .inner-container' => 'padding-bottom: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item:not(:first-child) .inner-container' => 'padding-left: {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.row .flex-item:not(:last-child) .inner-container' => 'padding-right: {{RIGHT}}{{UNIT}};',
					],
					'separator' => 'after',
				]
			);

			$repeater->add_responsive_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'video_row_overlay',
					'label' => esc_html__('Video Overlay', 'kura'),
					'types' => ['classic', 'gradient', 'video'],
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.row .overlay',
				]
			);

			$repeater->add_control(
				'video_row_show_title',
				[
					'label' => esc_html__('Show Title', 'kura'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'kura'),
					'label_off' => esc_html__('Hide', 'kura'),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);
			$repeater->add_control(
				'video_row_title_position',
				[
					'label' => esc_html__('Title Position', 'kura'),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'default' => 'in',
					'options' => [
						'in' => [
							'title' => esc_html__('Inside', 'kura'),
							'icon' => ' eicon-arrow-up',
						],
						'out' => [
							'title' => esc_html__('Outside', 'kura'),
							'icon' => ' eicon-arrow-down',
						],
					],
					'condition' => [
						'video_row_show_title' => 'yes',
					],
				]
			);

			$repeater->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .k-title',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'condition' => [
						'video_row_show_title' => 'yes',
					],
				]
			);

			$repeater->add_control(
				'video_row_title_color',
				[
					'label' => esc_html__('Title Color', 'kura'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .k-title' => 'color: {{VALUE}}',
					],
					'condition' => [
						'video_row_show_title' => 'yes',
					],
				]
			);
			$repeater->add_control(
				'video_row_css',
				[
					'label' => esc_html__('Column Extra Css', 'kura'),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('', 'kura'),
					'placeholder' => esc_html__('Type your title here', 'kura'),
				]
			);

			$this->add_control(
				'video_row',
				[
					'label' => esc_html__('Repeater List', 'kura'),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'video_row_category' => esc_html__('health'),
							'video_row_columns' => 1,
						],
					],
					'title_field' => '{{{ video_row_columns }}} Columns',
				]
			);



			$this->end_controls_section();
		}

		protected function render()
		{
			/**** Initialization ****/
			$settings = $this->get_settings_for_display(); ?>
			
			<!-- Initiate Design -->
			<div class="k-video-grid-section">
				<?php
				if ($settings['video_row']) {
					foreach ($settings['video_row'] as $item) {
						$vCat = $item['video_row_category'];
						$vCol = $item['video_row_columns'];
						$vOffSet = $item['video_row_offset'];
						$vColSize = 12 / $vCol;
						$vTitlePos = $item['video_row_title_position'];
						$vCss = $item['video_row_css'];
						$args = array(
							'post_type' => $this->postType(),
							'posts_per_page'	=> $vCol,
							'offset'	=> $vOffSet,
						);
						/**** Request Post ****/
						if($vCat == 'all_terms'  ) $vCat =null;
						
						$posts = bru_posts($args,$vCat);
						if (isset($posts)) {
							echo '<div class="row elementor-repeater-item-' . esc_attr($item['_id']) . '">';
							foreach ($posts as $post) {
								$bgImg = $post['video-img-link']; ?>

								<div <?php echo 'class="' . $vCss . ' flex-item col-md-' . $vColSize .' col-sm-12"'; ?>>
									<div class="inner-container" style="background-image: url(<?php echo $bgImg; ?>)">
										<div class="overlay">
										<i aria-hidden="true" class="fas fa-play-circle font-primary red-span"></i>
										</div>
										<?php if ($vTitlePos == 'in') echo '<h3 class="k-title">' . $post['title'] . '</h3>'; ?>
									</div>
									<?php if ($vTitlePos == 'out') echo '<h3 class="k-title mt-3">' . $post['title'] . '</h3>'; ?>
								</div>

						<?php }
							echo '</div>';
						}

						 ?>
					<?php
					} ?>

			</div><?php
				}
			}
		}
	}
