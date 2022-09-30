<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Accordion_Foundation  extends \Elementor\Widget_Base
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
		return 'Accordion Foundation';
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
		return esc_html__('Accordion Foundation', 'mtn');
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

		text_control($repeater, 'title', 'Title');
		editor_control($repeater, 'description', 'Description');

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

		padding_control($this, 'box_padding', 'Box Padding', '.section-navigator');
		box_shadow_control($this, 'Box Shadow', '.section-navigator');
		border_radius_control($this, 'tab_border_radius', '.section-navigator');
		heading_control($this, 'tab_item_heading', 'Item Style');
		padding_control($this, 'tab_item_padding', 'Padding', '.accordion-tab-btn');
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

		background_control($this, 'background', 'Background', '.accordion-tab-btn');
		color_control($this, 'item_color', 'Item Color', '.accordion-tab-btn');
		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_hover_state',
			[
				'label' => esc_html__('Hover', 'mtn'),
			]

		);

		background_control($this, 'hover_background', 'Background', '.accordion-tab-btn:hover');
		color_control($this, 'item_hover_color', 'Item Color', '.accordion-tab-btn:hover');

		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_active_state',
			[
				'label' => esc_html__('Active', 'mtn'),
			]

		);

		background_control($this, 'active_background', 'Background', '.accordion-tab-btn.active');
		color_control($this, 'item_active_color', 'Item Color', '.accordion-tab-btn.active');

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
		background_control($this, 'content_background', 'Background', '.tab-content');
		color_control($this, 'content_color', 'Item Color', '.tab-content');
		typography_control($this, 'content_typography', '.tab-content .tab-pane *');
		padding_control($this, 'content_padding', 'Padding', '.tab-content');


		$this->end_controls_section();
	}

	protected function render()
	{
		$imgs = array(
			array("img"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/Picture2-1.png"),
			array("img"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/Picture6-1.png"),
			array("img"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/Picture4-1.png"),
			array("img"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/Picture5-1.png"),
		);
		$settings = $this->get_settings_for_display();
		$title = [];
		$description = [];
		echo '<div class="mtn-accordion-section">';
		echo '<div class="mtn-accordion-row">';
		foreach ($settings['mtn_accordion'] as $key => $item) {
			array_push($title, array($item['_id'], $item['title']));
			array_push($description, array($item['_id'], $item['description']));
		}
?>
		<div class="nav d-flex nav-pills col-md col-sm-12 section-navigator mb-sm-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<?php if (isset($title)) {
				foreach ($title as $key => $value) { ?>

					<button class="accordion-tab-btn foundation-btn btn nav-link <?php if ($key == 0) echo 'active'; ?>" id="v-pills-<?= $value[0]; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $value[0]; ?>" type="button" role="tab" aria-controls="v-pills-<?= $value[0]; ?>" <?php $key == 0 ? 'aria-selected="true"' : 'aria-selected="false"'; ?>>
						<span><?= $value[1] ?></span>
					</button>
			<?php }
			} ?>
		</div>

		<div class="tab-content mtn-accordion-content col-md-12 col-sm-12" id="v-pills-tabContent">
			<?php if (isset($description)) {
				foreach ($description as $key => $value) { 
					
					 ?>

					<div class="fountaion-sec col-md-12 tab-pane fade <?php if ($key == 0) echo 'show active'; ?>" id="v-pills-<?= $value[0]; ?>" role="tabpanel" aria-labelledby="v-pills-<?= $value[0]; ?>-tab">
						
						<div class="row">
							<div class="col-md-6">
								<img src="<?php foreach($imgs[$key] as $img) print_r($img);?>" class="img-fluid foundation-img" alt="">
							</div>
							<div class="col-md-6 d-flx">
                            <div class="foundation-content ">
                            <?= $value[1] ?>
                            </div>
                        </div>
						
						</div>
					</div>
			<?php }
			} ?>
		</div>

<?php
		echo '</div></div>';
	}
} ?>