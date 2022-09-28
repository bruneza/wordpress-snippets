<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Complex_Carousel_Widget  extends \Elementor\Widget_Base
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
		return 'Complex Carousel';
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
		return esc_html__('Complex Carousel', 'mtn');
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

		// Content Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content layout', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$contentRepeater = new \Elementor\Repeater();
		// Grid Settings
		heading_control($contentRepeater, "grid_setting_heading", "Grid Settings");
		select_value_control($contentRepeater, 'grid_row_start', 'Grid Row Start', ['{{CURRENT_ITEM}}.complex-column-item', 'grid-row-start'], 'auto');
		select_value_control($contentRepeater, 'grid_row_end', 'Grid Row End', ['{{CURRENT_ITEM}}.complex-column-item', 'grid-row-end'], 'auto');
		select_value_control($contentRepeater, "grid_column_start", 'Grid Column Start', ['{{CURRENT_ITEM}}.complex-column-item', 'grid-column-start'], 'auto');
		select_value_control($contentRepeater, "grid_column_end", 'Grid Column End', ['{{CURRENT_ITEM}}.complex-column-item', 'grid-column-end'], 'auto');

		padding_control($contentRepeater, 'grid_padding', "Grid Padding", '.mtn-complex-column');

		// Grid Image Settings
		heading_control($contentRepeater, "grid_img", "Grid Image");
		switcher_control($contentRepeater, 'show_col_image', 'Show Image');


		// Grid Image Style
		select_callback_control(
			$contentRepeater,
			'custom_img_style',

			[
				'default_style' => 'Default',
				'custom_style' => 'Custom',

			],
			[
				'default' => 'default_style',
				'label' => 'Image Style',
				'condition'	=> [
					'show_col_image' => 'yes'
				]
			]
		);

		slider_control($contentRepeater, 'custom_img_height', 'Set Image Height', ['.complex-col-img', 'height'], ['default' => 300, 'condition' => ['custom_img_style' => 'custom_style']]);
		slider_control($contentRepeater, 'custom_img_width', 'Set Image Width', ['.complex-col-img', 'width'], ['default' => 300, 'condition' => ['custom_img_style' => 'custom_style']]);

		select_style_control(
			$contentRepeater,
			'custom_object_fit',
			[
				'fill' => 'Fill',
				'contain' => 'Contain',
				'cover' => 'Cover',
			],
			[
				'.complex-col-img',
				'object-fit'
			],
			[
				'condition' => array('custom_img_style' => 'custom_style'),
				'label' => 'Object Fit',
				'default' => 'contain',
			]
		);

		// Grid Content
		switcher_control($contentRepeater, 'show_contents_title', 'Show Title');
		heading_control($contentRepeater, "content_title", "Content Title");

		select_callback_control(
			$contentRepeater,
			'title-color-settings',
			
			[
				'default_style' => 'Default',
				'custom_style' => 'Custom',

			],
			[
				'default' => 'default_style',
				'label' => 'Title Color Settings',
				'condition'	=> [
					'show_col_image' => 'yes'
				]
			]
		);

		typography_control($contentRepeater, 'content_section_typography', '.mtn-complex-column-content');

		// amir_codes($contentRepeater);

		$this->add_control(
			'content_grid_cols',
			[
				'label' => esc_html__('Content Grid Column', 'mtn'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $contentRepeater->get_controls(),
				'default' => [
					[
						'grid_row_start' => esc_html__('auto'),
						'grid_column_start' => esc_html__('auto'),
						'grid_row_end' => esc_html__('auto'),
						'grid_column_start' => esc_html__('auto'),
					],
				],
				'title_field' => '{{{grid_row_start}}} / {{{grid_row_end}}}',
			]
		);

		$this->end_controls_section();

		// Carousel Settings
		$this->start_controls_section(
			'carousel_settings_section',
			[
				'label' => esc_html__('Carousel Settings', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		count_ten_control($this, 'Slides to Scroll', 'slides_to_scroll', 3);


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
		slider_control($this, 'carousel_grid_height', 'Carousel Grid Height', array('.complex-carousel-row', 'height'), array('max-px' => 800));
		slider_control($this, 'carousel_grid_gap', 'Grid Gap', array('.complex-carousel-row', 'grid-gap'), array('max-px' => 50));

		//Item Container
		heading_control($this, 'grid_heading', 'Item Container');
		padding_control($this, 'item_container_padding', 'Padding', '.complex-column-item');
		border_control($this, 'item_container_border', 'Border', '.complex-column-item');
		border_radius_control($this, 'item_container_radius', '.complex-column-item');
		background_control($this, 'item_container_backgound', 'Background', '.complex-column-item');

		$this->end_controls_section();

		// Carousel Post Image
		$this->start_controls_section(
			'grid_imagebg_style',
			[
				'label' => esc_html__('Carousel Post Image', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		slider_control($this, 'grid_image_height', 'Image', array('.home-device-image', 'height'), array('max-percent' => 100));
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
			[
				'flex-start' => 'Left',
				'center' => 'center',
				'flex-end' => 'Right',

			],
			[
				'default' => 'flex-start',
				'label' => 'Horizontal Position',
			]
		);

		slider_control($this, 'dot_vertical_offset', 'Vertical Offset', array('.owl-dots', 'top'), ['default' => -60, 'min-px' => -200, 'max-px' => 200]);

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

		border_control($this, 'dot_border', 'Dot Border', '.owl-dot span');
		border_radius_control($this, 'allbtn_border_radius', 'Button Radius', '.owl-dot span');

		$this->end_controls_section();
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		// $neededFields =  ['post-link', 'thumbnail'];
		$posts = postsRender($settings, null, null, array('skip_nothumbnail' => true));
		$grid_cols = $settings['content_grid_cols'];
		$grid_col_count = count($grid_cols);
		$posts = array_chunk($posts, $grid_col_count);

		// print_r($settings['content_grid_cols']);
?>


		<script>
			jQuery(document).ready(function() {
				jQuery('.complex-carousel').owlCarousel({
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
		echo '<div class="complex-carousel-section">';
		echo '<div class="owl-carousel complex-carousel">';

		foreach ($posts as $key => $innerPosts) {
			echo '<div class="complex-carousel-row">';
			foreach ($innerPosts as $innerKey => $post) {
		?>
				<div class="complex-column-item elementor-repeater-item-<?= $grid_cols[$innerKey]['_id']; ?>">
					<img class="complex-col-img" src="<?= $post['thumbnail']; ?>" />
				</div>
<?php

			}
			echo '</div>';
		}
		echo '</div></div>';
		/*** End Content Section ***/
	}
}
