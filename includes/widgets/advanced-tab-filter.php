<?php

namespace MTN_FEATURES\Widgets;


use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Filter_Tabs  extends \Elementor\Widget_Base
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
		return 'Tab Filter';
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
		return esc_html__('Tab Filter', 'mtn');
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

	protected function register_controls()
	{
		$count = range(0, 12);
		$count = array_combine($count, $count);

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'column_number',
			[
				'label' => esc_html__('Column Number', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 12,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-tab-items' => 'grid-template-columns: repeat({{SIZE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->add_control(
			'filter_data_type',
			[
				'label' => esc_html__('Filter Data Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ona',
				'options' => [
					'local'  => esc_html__('Local', 'mtn'),
					'ona'  => esc_html__('Ona', 'mtn'),
				],
			]
		);

		// ANCHOR: filter grid - Filter Layout
		$this->add_control(
			'filter_layout',
			[
				'label' => esc_html__('Filter Layout', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'filter_layout_type',
			[
				'label' => esc_html__('Filter Layout Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'select-filter',
				'options' => [
					'select-filter'  => esc_html__('Select Filter', 'mtn'),
					'tab-filter'  => esc_html__('Tab Filter', 'mtn'),
				],
			]
		);

		// ANCHOR: filter grid - more button
		$this->add_control(
			'more_btn_heading',
			[
				'label' => esc_html__('More Button', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'more_btn_type',
			[
				'label' => esc_html__('Read More Button', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text-only',
				'options' => [
					'none'  => esc_html__('None', 'mtn'),
					'text-only'  => esc_html__('Text Only', 'mtn'),
					'text-with-icon'  => esc_html__('Text With Icon', 'mtn'),
					'icon-only'  => esc_html__('Icon Only', 'mtn'),
				],
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label' => esc_html__('More Button Text', 'mtn'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Enter Value', 'mtn'),
				'default' => esc_html__('View More', 'mtn'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'more_btn_type!' => ['icon-only', 'none']
				]
			]
		);

		$this->add_control(
			'more_btn_icon',
			[
				'label' => esc_html__('More Button Icon', 'mtn'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'condition' => [
					'more_btn_type!' => ['text-only', 'none'],
				]
			]
		);

		$this->end_controls_section();

		//ANCHOR : filter grid - Query section
		$this->start_controls_section(
			'Query',
			[
				'label' => esc_html__('MTN Query', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_MTN_Query::get_type(),
			[
				'name' => 'mtn_posts',
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

		//ANCHOR : filter grid - Query section
		//ANCHOR : filter grid - Query section
		$this->start_controls_section(
			'filter_tab_style',
			[
				'label' => esc_html__('Filter Tab Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'filter_space_between',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Space Between', 'mtn'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-tab-col:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .filter-tab-col:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'filter_select_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Box Padding', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .filter-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_select_background',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .filter-nav',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_select_border',
				'selector' => '{{WRAPPER}} .filter-nav',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_select_box_shadow',
				'label' => esc_html__('Box Shadow', 'mtn'),
				'selector' => '{{WRAPPER}} .filter-nav',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_select_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .filter-nav',
			]
		);

		$this->add_control(
			'filter_select_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-nav' => 'color: {{VALUE}}',
				],
			]
		);

		//TABS
		$this->start_controls_tabs('filter_stle_tab_colors');
		//NORMAL STATE
		$this->start_controls_tab(
			'filter_stle_tab_normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$this->end_controls_tab();
		//NORMAL STATE
		//NORMAL STATE
		$this->end_controls_tabs();

		$this->end_controls_section();
		// ANCHOR: filter grid - Grid Card section
		$this->start_controls_section(
			'grid_card_style',
			[
				'label' => esc_html__('Grid Card Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// ANCHOR: filter grid - content row
		$this->add_control(
			'content_grid_row',
			[
				'label' => esc_html__('Content Grid Row', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_grid_row_margin',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Content Row Margin', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .filter-tab-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		// ANCHOR: filter grid - content columns
		$this->add_control(
			'content_grid_col',
			[
				'label' => esc_html__('Content Column', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_grid_col_gap',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Column Gap', 'mtn'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .filter-tab-items' => ' grid-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_grid_col_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Content Card Padding', 'mtn'),
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .filter-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'content_grid_col_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .filter-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_grid_card_background',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .filter-card',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_grid_col_border',
				'selector' => '{{WRAPPER}} .filter-card',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_grid_col_shadow',
				'label' => esc_html__('Box Shadow', 'mtn'),
				'selector' => '{{WRAPPER}} .filter-card',
			]
		);

		$this->end_controls_section();

		// ANCHOR: filter grid - content section
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => esc_html__('Thumbnail Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
		// ANCHOR: filter grid - content section
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'default_content_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} h4.title',
			]
		);

		$this->add_control(
			'default_content_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} h4.title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__('Sub Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector' => '{{WRAPPER}} .sub-title',
			]
		);

		$this->add_control(
			'sub_title__color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_info',
			[
				'label' => esc_html__('Meta - Accent', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_info_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .meta-info',
			]
		);

		$this->add_control(
			'meta_info_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .meta-info' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_info',
			[
				'label' => esc_html__('Price', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_info_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .price-info',
			]
		);

		$this->add_control(
			'price_info_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .price-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		register_vacancy_control($this);
	}



	protected function render()
	{
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

		$taxonomies = xgetTerms($mtnSettings);
		$taxCount = count($taxonomies);

		// foreach ($posts as $post) {

		// }

		$postMeta = array();
?>

		<div class="tab-grid-section container">
			<div class="filter-tab-row row">
				<?php

				if (isset($taxonomies) && is_array($taxonomies)) {
					$terms = $taxonomies[array_key_first($taxonomies)];

					echo '<ul class="filter-tab-col nav nav-pills mb-3" id="pills-tab" role="tablist">';
					foreach ($terms as $termKey => $term) {

						$termSlug = $term['slug'];
				?>
						<li class="nav-item" role="presentation">
							<button class="filter-nav nav-link <?php if (array_key_first($terms) == $termKey) echo 'active'; ?>" id="pills-<?= $term['slug']; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $term['slug']; ?>" type="button" role="tab" aria-controls="pills-<?= $term['slug']; ?>" aria-selected="true"><?= $term['name']; ?></button>
						</li>
				<?php
					}
					echo '</ul>';
				} else {
					$terms = null;
					echo 'no Taxonomies selected';
				}

				?>
			</div>
			<div class="filter-contents tab-content" id="pills-tabContent">
				<?php
				foreach ($terms as $termKey => $term) {
					$mtnSettings['x_terms'][1] = $term['term_id'];
					$posts = xpostsRender($mtnSettings);
					// echo '<br>-----$mtnSettings-----<br>';
					// print_r($mtnSettings['x_terms']);
					// echo '<br>----------<br>';
					// echo '<br>-----$terms-----<br>';
					// print_r($posts);
					// echo '<br>----------<br>';
					?>
					<div class="filter-tab-items tab-pane fade show <?php if (array_key_first($terms) == $termKey) echo 'active'; ?>" id="pills-<?= $term['slug']; ?>" role="tabpanel" aria-labelledby="pills-<?= $term['slug']; ?>-tab">
						<?php
						foreach ($posts as $post) {
							switch ($settings['filter_data_type']) {
								case 'ona':
									$cardInfo = [
										'class' => 'one-roaming',
									];
									ona_card($post, $cardInfo);
									break;
								case 'local':
									$cardInfo = [
										'class' => 'bundle-card card-block-left',
									];
									local_card($post, $cardInfo);
									break;
								default:
									echo 'Choose data type';
									break;
							} ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
<?php
	}
}
