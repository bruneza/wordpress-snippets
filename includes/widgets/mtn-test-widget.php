<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Test_Widget  extends \Elementor\Widget_Base
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
		return 'Test Widget';
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
		return esc_html__('Test Widget', 'mtn');
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
		$slides_per_view = range(1, 10);
		$slides_per_view = array_combine($slides_per_view, $slides_per_view);

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
		$this->add_control(
			'slides_to_scroll',
			[
				'label' => esc_html__('Number of Posts', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__('Slides Per View', 'mtn'),
				'options' => $slides_per_view,
				'default' => 3,
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
		slider_control($this, 'grid_height', 'Grid Height', '.carousel-column', 400);

		$this->add_control(
			'grid_margin',
			[
				'label' => esc_html__('Space Between', 'mtn'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 15,
				'min' => 1,
				'max' => 12,
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
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-carousel .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_horizontal_position',
			[
				'label' => esc_html__('Horizontal Position', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => 'Left',
					'center' => 'center',
					'flex-end' => 'Right',

				]
			]
		);
		$this->add_responsive_control(
			'dot_vertical_offset',
			[
				'label' => esc_html__('Vertical Offset', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => -60
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-carousel .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
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
				'label' => esc_html__('Dot Background', 'mtn'),
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
				'label' => esc_html__('Dot Background', 'mtn'),
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



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$neededFields =  ['post-link', 'thumbnail'];
		$posts = postsRender($settings, null, $neededFields);

?>
		<script>
			jQuery(document).ready(function() {
				jQuery('.mtn-carousel-3').owlCarousel({
					loop: true,
					margin: <?php echo $settings['grid_margin']; ?>,
					slideToScroll: <?php echo $settings['slides_to_scroll']; ?>,
					dots: true,
					nav: false,
					autoplay: false,
					smartSpeed: 500,
					autoplayTimeout: 7000,
					responsive: {
						0: {
							items: 1
						},
						600: {
							items: 2
						},
						1000: {
							items: 3
						}
					},
				});
				jQuery(".owl-carousel .owl-dots").css("justify-content", "<?= $settings['dot_horizontal_position']; ?>");

			});
		</script>
<?php
		/*** Start Content Section ***/
		echo '<div class="mtn-deals-carousel-section">';
		echo '<div class="row owl-carousel mtn-carousel-3">';

		foreach ($posts as $post) {

			echo '<div class="col col-md">';
			echo '<div class="carousel-column" style="background-image: url(' . $post['thumbnail'] . ');">';
			echo '<div class="deals-contents">';

			echo '<a class="btn read-more-btn" href="' . $post['post-link'] . '">Read More &nbsp;<i class="fa fa-angle-right"></i></a>';

			echo '</div></div></div>';
		}
		echo '</div></div>';
		/*** End Content Section ***/
	}
}
