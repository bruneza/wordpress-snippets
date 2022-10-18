<?php

namespace MTN_FEATURES\Widgets;


use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Filter_Grid  extends \Elementor\Widget_Base
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
		return 'Filter Grid';
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
		return esc_html__('Filter Grid', 'mtn');
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
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => $count,
			]
		);

		$this->add_control(
			'filter_data_type',
			[
				'label' => esc_html__('Filter Data Type', 'mtn'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'jobs',
				'options' => [
					'jobs'  => esc_html__('Jobs', 'mtn'),
					'tarrif-table'  => esc_html__('Tariff Table', 'mtn'),
				],
			]
		);

		// ANCHOR: filter grid - more button
		$this->add_control(
			'code_control_key',
			[
				'label' => esc_html__('code_control_label', 'mtn'),
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
					'{{WRAPPER}} select.filter-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'filter_select_background',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .filter-select',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_select_border',
				'selector' => '{{WRAPPER}} select.filter-select',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_select_box_shadow',
				'label' => esc_html__('Box Shadow', 'mtn'),
				'selector' => '{{WRAPPER}} select.filter-select',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_select_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} select.filter-select',
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
					'{{WRAPPER}} select.filter-select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		// ANCHOR: filter grid - content section
		$this->start_controls_section(
			'grid_content_style',
			[
				'label' => esc_html__('Grid Content Style', 'mtn'),
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
					'{{WRAPPER}} .filter-content-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'content_grid_col_space',
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
					'{{WRAPPER}} .filter-content-item' => 'padding-bottom: calc({{SIZE}}{{UNIT}})',
					'{{WRAPPER}} .filter-content-item:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .filter-content-item:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)',
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

		$this->add_control(
			'default_content_title',
			[
				'label' => esc_html__('Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
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

		$this->end_controls_section();
		register_vacancy_control($this);
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');

		$mtnSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
			'x_taxonomy' => validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs'),
			'x_terms' => validateEleCPT($settings, 'mtn_posts_include_term_ids'),
			'x_show' => 'by_terms',
		];

		$taxonomies = xgetTerms($mtnSettings);

		$posts = xpostsRender($mtnSettings);
		// foreach ($posts as $post) {
			
		// }




		// echo '<br>-----$Department-----<br>';
		// print_r($mtnSettings);
		// echo '<br>----------<br>';

		$postMeta = array();

		// echo '<br>-----$Department-----<br>';
		// 	print_r($tabTaxSlug);
		// 	echo '<br>----------<br>';


?>
		<script>
			(function($) {
				$(document).ready(function() {
					var filterActive;

					function filterCategory(tab1) {

						$('.filter-content-items .filter-content-item').removeClass('active');

						var selector = ".filter-grid-section .filter-content-item";

						if (tab1 !== 'tab-all') {
							selector = '[data-tab=' + tab1 + "]";
						}

						$(selector).addClass('active');

						filterActive = tab1;
					}

					$('.filter-grid-section .filter-content-item').addClass('active');
					<?php
					$tabTaxSlug = array();
					foreach (array_keys($taxonomies) as $filterTaxKey) {
						$tabTaxSlug = array_merge($tabTaxSlug, ['$(".filter-grid-section select.' . get_taxonomy($filterTaxKey)->rewrite['slug'] . '").val()']);
					}

					$tabTaxSlug = implode(',', $tabTaxSlug);
					?>
					$('.filter-grid-section select').change(function() {
						filterCategory(<?= $tabTaxSlug; ?>);
					});
				});

			})(jQuery);
		</script>

		<div class="filter-grid-section container">
			<div class="filter-tab-row row">
				<?php

				if (isset($taxonomies) && is_array($taxonomies)) {
					foreach ($taxonomies as $taxKey => $terms) {
						$taxSlug = get_taxonomy($taxKey)->rewrite['slug'];
						$taxLabel = get_taxonomy($taxKey)->label;
				?>
						<div class="filter-tab-col col-md-4 col-sm-12">
							<select class="filter-select <?= $taxSlug; ?>">
								<?php
								foreach ($terms as $termKey => $term) {
									if (array_key_first($terms) == $termKey)
										echo '<option value="tab-all">All ' . $taxLabel . '</option>';

									echo '<option value="tab-' . $term['slug'] . '">' . $term['name'] . '</option>';

								?>
								<?php } ?>
							</select>
						</div>
				<?php }
				} else {
					echo 'no Taxonomies selected';
				}
				?>
			</div>
			<div class="row filter-content-items">
				<?php
				foreach ($posts as $post) {
					if(isset($post['selected-tax'])){
				// 		echo '<br>-----selected-tax-----<br>';
                // print_r($post['selected-tax']);
                // echo '<br>----------<br>';
					$divAttr = array();
	
					foreach ($post['selected-tax'] as $selKey => $selectedTax) {
						if(isset($selectedTax['terms-obj']) && is_array($selectedTax['terms-obj']))
						$divAttr = array_merge($divAttr, ['data-tab= "tab-' . $selectedTax['terms-obj'][0]->slug . '" ']);
					}
					$divAttr = implode(' ', $divAttr);
				?>
					<div class="col col-md-<?php echo intval(12 / $settings['column_number']); ?> col-sm-12 filter-content-item" <?= $divAttr; ?>>
						<?php
						switch ($settings['filter_data_type']) {
							case 'jobs':
								$cardInfo = [
									'department' => $selectedTax['terms-obj'][0]->name,

								];

								vancancy_card($cardInfo, $post);
								break;
							case 'tarrif-table':
								$cardInfo = [
									'title' => $post['title'],
								];
								international_tariffs_card($cardInfo, $post,['main_term' => $mtnSettings['x_terms']]);
								break;
							default:
								echo 'Choose data type';
								break;
						}
						?>
					</div>
				<?php }
			} 
				?>
			</div>


			<div class="col-md-12">
				<div class="see-all-btn">
					<a href="" class="">Load More</a>
				</div>
			</div>
		</div>
<?php 
	}
}
