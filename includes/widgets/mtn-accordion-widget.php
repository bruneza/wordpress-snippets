<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Accordion  extends \Elementor\Widget_Base
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
		return 'MTN Accordion';
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
		return esc_html__('MTN Accordion', 'mtn');
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
				'label' => esc_html__('Content', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		text_control($repeater, 'title', ['label' => 'Title']);
		editor_control($repeater, 'description', ['label' => 'Description']);

		$this->add_control(
			'mtn_accordion',
			[
				'label' => esc_html__('Items', 'mtn'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__('List Item', 'mtn'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();

		/////STYLESSS

		$this->start_controls_section(
			'Tab_Style',
			[
				'label' => esc_html__('Tab Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		padding_control($this, 'box_padding', '.section-navigator',['label' => 'Box Padding']);
		box_shadow_control($this, 'Box Shadow', '.section-navigator');
		border_radius_control($this, 'tab_border_radius', '.section-navigator');
		heading_control($this, 'tab_item_heading',['label' => 'Item Style']);
		padding_control($this, 'tab_item_padding', '.accordion-tab-btn',['label' => 'Padding']);
		border_radius_control($this, 'item_border_radius', '.accordion-tab-btn');
		typography_control($this, 'item_typography', '.accordion-tab-btn');

		$this->start_controls_tabs(
			'accordion_item_state'
		);
		// NORMAL STATE
		$this->start_controls_tab(
			'item_normal_state',
			[
				'label' => esc_html__('Normal', 'mtn'),
			]

		);

		background_control($this, 'background', '.accordion-tab-btn', ['label' =>'Background']);
		color_control($this, 'item_color', '.accordion-tab-btn', ['label' => 'Item Color']);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_hover_state',
			[
				'label' => esc_html__('Hover', 'mtn'),
			]

		);

		background_control($this, 'hover_background', '.accordion-tab-btn:hover', ['label' => 'Background']);
		color_control($this, 'item_hover_color', '.accordion-tab-btn:hover', ['label' => 'Item Color']);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_active_state',
			[
				'label' => esc_html__('Active', 'mtn'),
			]

		);

		background_control($this, 'active_background', '.accordion-tab-btn.active', ['label' => 'Background']);
		color_control($this, 'item_active_color', '.accordion-tab-btn.active', ['label' => 'Item Color']);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();
		$this->start_controls_section(
			'Content_Style',
			[
				'label' => esc_html__('Content Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		background_control($this, 'content_background', '.tab-content', ['label' => 'Background']);
		color_control($this, 'content_color', '.tab-content', ['label' => 'Item Color']);
		typography_control($this, 'content_typography', '.tab-content .tab-pane *');
		padding_control($this, 'content_padding', '.tab-content', ['label' => 'Padding']);


		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$title = [];
		$description = [];
		echo '<div class="mtn-accordion-section">';
		echo '<div class="mtn-accordion-row row">';
		foreach ($settings['mtn_accordion'] as $key => $item) {
			array_push($title, array($item['_id'], $item['title']));
			array_push($description, array($item['_id'], $item['description']));
		}
?>
		<div class="nav flex-column nav-pills col-md col-sm-12 section-navigator mb-sm-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<?php if (isset($title)) {
				foreach ($title as $key => $value) { ?>

					<button class="accordion-tab-btn nav-link <?php if ($key == 0) echo 'active'; ?>" id="v-pills-<?= $value[0]; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $value[0]; ?>" type="button" role="tab" aria-controls="v-pills-<?= $value[0]; ?>" <?php $key == 0 ? 'aria-selected="true"' : 'aria-selected="false"'; ?>>
						<span><?= $value[1] ?></span>
					</button>
			<?php }
			} ?>
		</div>

		<div class="tab-content mtn-accordion-content col-md-8 col-sm-12" id="v-pills-tabContent">
			<?php if (isset($description)) {
				foreach ($description as $key => $value) { ?>

					<div class="tab-pane fade <?php if ($key == 0) echo 'show active'; ?>" id="v-pills-<?= $value[0]; ?>" role="tabpanel" aria-labelledby="v-pills-<?= $value[0]; ?>-tab">
						<?= $value[1] ?>
					</div>
			<?php }
			} ?>
		</div>

<?php
		echo '</div>';
	}
} ?>