<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Products_Carousel  extends \Elementor\Widget_Base
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
		return 'Products Carousel';
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
		return esc_html__('Products Carousel', 'mtn');
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
		$this->add_responsive_control(
			'grid_height',
			[
				'label' => esc_html__('Grid Height', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 400
				],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel-column' => 'height: {{SIZE}}{{UNIT}} !important',
				],
			]
		);

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

				],
				'selectors' => [
					'{{WRAPPER}} .owl-carousel .owl-dots' => 'justify-content: {{VALUE}};',
				],
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
		$posts = postsRender($settings, null, $neededFields, array('skip_nothumbnail' => true));
		$postCount = count($posts);
		$slides = range(0, intval($postCount / 6));

?>
		<script>
			jQuery(document).ready(function() {
				jQuery('.mtn-carousel-product').owlCarousel({
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
							items: 1
						},
						1000: {
							items: 1
						}
					},
				});
			});
		</script>
		<?php
		/*** Start Content Section ***/
		echo '<div class="mtn-products-carousel-section">
			<div class="owl-carousel mtn-carousel-product">';

		foreach ($slides as $slide) {
		?>

			<div class="row">
				<div class="col-md-4 col-sm-12 product-column">
					<a href="<? echo $posts[intval(0 + $slide)]['post-link']; ?>" class="product-container">
						<div class="product-img" style="background-image: url('<? echo $posts[intval(0 + $slide)]['thumbnail']; ?>')"></div>
					</a>
					<a href="<? echo $posts[intval(1 + $slide)]['post-link']; ?>" class="product-container">
						<div class="product-img" style="background-image: url('<? echo $posts[intval(1 + $slide)]['thumbnail']; ?>')"></div>
					</a>
				</div>
				<div class="col-md-4 col-sm-12 product-column">
					<a href="<? echo $posts[intval(2 + $slide)]['post-link']; ?>" class="product-container">
						<div class="product-img" style="background-image: url('<? echo $posts[intval(2 + $slide)]['thumbnail']; ?>')"></div>
					</a>
				</div>
				<div class="col-md-4 col-sm-12 product-column">
					<a href="<? echo $posts[intval(3 + $slide)]['post-link']; ?>" class="product-container">
						<div class="product-img" style="background-image: url('<? echo $posts[intval(3 + $slide)]['thumbnail']; ?>')"></div>
					</a>
					<a href="<? echo $posts[intval(4 + $slide)]['post-link']; ?>" class="product-container">
						<div class="product-img" style="background-image: url('<? echo $posts[intval(4 + $slide)]['thumbnail']; ?>')"></div>
					</a>
				</div>
			</div>
<?php
		}
		echo '</div></div>';
		/*** End Content Section ***/
	}
	
}
