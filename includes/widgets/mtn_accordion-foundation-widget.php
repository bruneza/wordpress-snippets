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

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'mtn' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'mtn' ),
				'placeholder' => esc_html__( 'Type your title here', 'mtn' ),
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'mtn' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'mtn' ),
				'placeholder' => esc_html__( 'Type your description here', 'mtn' ),
			]
		);

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

		$this->add_responsive_control(
            'box_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Box Padding', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-navigator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mtn' ),
				'selector' => '{{WRAPPER}} .section-navigator',
			]
		);

		$this->add_responsive_control(
            'tab_border_radius',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Border Radius', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-navigator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->add_control(
            'tab_item_heading',
            [
                'label' => esc_html__('Item Style', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


		$this->add_responsive_control(
            'tab_item_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Padding', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->add_responsive_control(
            'item_border_radius',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Border Radius', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .accordion-tab-btn',
			]
        );

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


		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-tab-btn',
                'exclude' => [
                    // eg: image
                ]
            ]
        );
		$this->add_control(
            'item_color',
            [
                'label' => esc_html__('Item Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-tab-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_hover_state',
			[
				'label' => esc_html__('Hover', 'mtn'),
			]

		);

		// background_control($this, 'hover_background', '.accordion-tab-btn:hover', ['label' => 'Background']);

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-tab-btn:hover',
                'exclude' => [
                    // eg: image
                ]
            ]
        );

		$this->add_control(
            'item_hover_color',
            [
                'label' => esc_html__('Item Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-tab-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->start_controls_tab(
			'item_active_state',
			[
				'label' => esc_html__('Active', 'mtn'),
			]

		);

		
		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'active_background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .accordion-tab-btn.active',
                'exclude' => [
                    // eg: image
                ]
            ]
        );

		$this->add_control(
            'item_active_color',
            [
                'label' => esc_html__('Item active Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-tab-btn.active' => 'color: {{VALUE}}',
                ],
            ]
        );

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

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'label' => esc_html__('Background', 'mtn'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .tab-content',
                'exclude' => [
                    // eg: image
                ]
            ]
        );

		$this->add_control(
            'content_color',
            [
                'label' => esc_html__('Item Color', 'mtn'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .tab-content .tab-pane *',
            ]
        );

		$this->add_responsive_control(
            'content_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__('Padding', 'mtn'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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