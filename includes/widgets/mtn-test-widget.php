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

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Post Content', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		count_ten_control($this, 'Slides to Scroll', 'slides_to_scroll', 3);

		select_callback_control($this, 'carousel_type', 'Carouse Type', [
			'3-col-carousel' => '3 Column Carousel',
			'two-1-two' => 'Two One Two',
		]);

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

		//Grid Style
		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__('Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		slider_control($this, 'carousel_grid_height', 'Carousel Grid Height', array('.mtn-carousel-row', 'height'), 400, array('max-px' => 800));
		slider_control($this, 'carousel_grid_gap', 'Grid Gap', array('.mtn-carousel-row', 'grid-gap'), 10, array('max-px' => 50));

		//Item Container
		heading_control($this, 'grid_heading', 'Item Container');
		padding_control($this, 'item_container_padding', 'Padding', '.mtn-carousel-column');
		border_control($this, 'item_container_border', 'Border', '.mtn-carousel-column');
		border_radius_control($this, 'item_container_radius', '.mtn-carousel-column');
		background_control($this, 'item_container_backgound', 'Background', '.mtn-carousel-column');

		$this->end_controls_section();

		// Carousel Post Image
		$this->start_controls_section(
			'grid_imagebg_style',
			[
				'label' => esc_html__('Carousel Post Image', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		slider_control($this, 'grid_image_height', 'Image', array('.home-device-image', 'height'), 10, array('max-percent' => 100));
		background_control($this, 'grid_image_background', 'Image background', '.home-device-image', array('image'));

		$this->end_controls_section();

		// Carousel dot Style
		$this->start_controls_section(
			'dot_style',
			[
				'label' => esc_html__('Carousel dot Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		select_callback_control(
			$this,
			'dot_horizontal_position',
			'Horizontal Position',
			[
				'flex-start' => 'Left',
				'center' => 'center',
				'flex-end' => 'Right',

			],
			'flex-start',
		);

		slider_control($this, 'dot_vertical_offset', 'Vertical Offset', array('.owl-dots', 'top'), -60, ['min-px' => -200, 'max-px' => 200]);

		// STATE TABS
		$this->start_controls_tabs('tabs_dot_style');
		// Normal State
		$this->start_controls_tab(
			'tab_dot_normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		background_control($this, 'dot_background', 'Dot Background', '.owl-dots span');

		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab(
			'tab_dot_hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		background_control($this, 'dot_hover_background', 'Dot Background', '.owl-dots .active span');
		$this->end_controls_tab();

		$this->end_controls_tabs();
		// END TABS

		border_control($this,'dot_border','Dot Border','.owl-dot span');
		border_radius_control($this,'allbtn_border_radius','Button Radius','.owl-dot span');

		$this->end_controls_section();
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$carouselType = $settings['carousel_type'];
		$neededFields =  ['post-link', 'thumbnail'];
		$posts = postsRender($settings, null, $neededFields, array('skip_nothumbnail' => true));

		if ($carouselType == 'two-1-two') {
			$posts = array_chunk($posts, 5);
		}
?>
		<script>
			jQuery(document).ready(function() {
				jQuery('.mtn-carousel-5').owlCarousel({
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
				jQuery(".owl-carousel .owl-dots").css("justify-content", "<?= $settings['dot_horizontal_position']; ?>");

			});
		</script>
		<?php
		/*** Start Content Section ***/
		echo '<div class="mtn-carousel-section">';
		echo '<div class="owl-carousel mtn-carousel-5">';

		foreach ($posts as $key => $innerPosts) {
			echo '<div class="mtn-carousel-row">';
			foreach ($innerPosts as $innerKey => $post) {
		?>
				<div class="mtn-carousel-column device-item-<?= $innerKey; ?>">
					<div class="home-device-image" style="background-image: url('<?= $post['thumbnail']; ?>');">
					</div>
				</div>
<?php

			}
			echo '</div>';
		}
		echo '</div></div>';
		/*** End Content Section ***/
	}
}
