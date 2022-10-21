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
                    '{{WRAPPER}} .filter-content-items' => 'grid-template-columns: repeat({{SIZE}}, minmax(0, 1fr));',
                ],
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
					'devices'  => esc_html__('Devices', 'mtn'),
					'tarrif-table'  => esc_html__('Tariff Table', 'mtn'),
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
					'{{WRAPPER}} .filter-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .filter-select',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_select_box_shadow',
				'label' => esc_html__('Box Shadow', 'mtn'),
				'selector' => '{{WRAPPER}} .filter-select',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_select_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .filter-select',
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
					'{{WRAPPER}} .filter-select' => 'color: {{VALUE}}',
				],
			]
		);

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
					'{{WRAPPER}} .filter-content-items' => ' grid-gap: {{SIZE}}{{UNIT}}',
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
		$this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => esc_html__('Width', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-card-thumbnail' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
				'condition' => [
				'filter_data_type' => 'devices',
					]
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
		if (isset($settings['filter_data_type']) && $settings['filter_data_type'] == 'devices')
			$mtnSettings['x_conditions'] = [
				'x_skip_nothumbnail' => true,
			];

		$taxonomies = xgetTerms($mtnSettings);
		$taxCount = count($taxonomies);

		$posts = xpostsRender($mtnSettings);
		echo '<br>-----$post-----<br>';
        		print_r($posts);
        		echo '<br>----------<br>';

		$postMeta = array();

		//SCRIPT JS
		if ($settings['filter_layout_type'] == 'select-filter') {
			select_filter_js(['tax-terms' => $taxonomies, 'tax-ids' => $taxArray, 'tax-count' => $taxCount]);
		}

		// else if($settings['filter_layout_type'] == 'tab-filter')
		// tab_filter_js(['tax-terms' => $taxonomies, 'tax-ids' => $taxArray, 'tax-count' => $taxCount]);
?>

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

									if (term_has_posts($mtnSettings, (array) $termKey))
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
			<div class="filter-content-items" id="paginated-list" data-current-page="1" aria-live="polite">
				<?php
				foreach ($posts as $post) {
					if (isset($post['selected-tax'])) {
						$divAttr = array();
						foreach ($post['selected-tax'] as $selKey => $selectedTax) {
							// echo '<br>-----$terms-----<br>';
							// print_r(($selKey));
							// echo '<br>----------<br>';
							if (isset($selectedTax['terms-obj']) && is_array($selectedTax['terms-obj']))
								$divAttr = array_merge($divAttr, ['data-' . $selKey . '= "tab-' . $selectedTax['terms-obj'][0]->slug . '" ']);
						}
						$divAttr = implode(' ', $divAttr);
				?>
						<div class="<?php /* echo intval(12 / $settings['column_number']);*/ ?> filter-content-item" <?= $divAttr; ?>>
							<?php
							switch ($settings['filter_data_type']) {
								case 'jobs':
									$cardInfo = [
										'name' => 'vancancies',
										'department' => $selectedTax['terms-obj'][0]->name,

									];

									vancancy_card($post, $cardInfo);
									break;
								// case 'devices':
								// 	$cardInfo = [
								// 		'name' => 'devices',
								// 	];
								// 	devices_card($post, $cardInfo);
								// 	break;
								case 'tarrif-table':
									$cardInfo = [
										'name' => 'bundles',
									];
									international_tariffs_card($post, $cardInfo, ['main_term' => $mtnSettings['x_terms']]);
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
				<nav class="pagination-container">
                    <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                    &lt;
                  </button>

                    <div id="pagination-numbers">

                    </div>

                    <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                    &gt;
                  </button>
                </nav>
			</div>

			<script>

(function($) {
        var filterActive;

        function filterCategory(selector1, selector2) {
            // reset results list
            // $(".dv-filter").addClass("hidden");

            // the filtering in action for all criteria
            var selector = ".filter-content-item";
            if (selector1 !== "tab-all") {
                selector = "[data-product-types=" + selector1 + "]";
                //$('.selector2').prop('selectedIndex',0);
            }
            if (selector2 !== "tab-all") {
                selector = selector + "[data-product-brands=" + selector2 + "]";
            }
            // console.log(selector);
            // show all results
            $(selector).removeClass("hidden");

            // reset active filter
            filterActive = selector1;
        }

        // start by showing all items
        $(".dv-filter").removeClass("hidden");

        // call the filtering function when selects are changed
        $(".filter-select").change(function() {
            filterCategory(
                $(".product-types").val(),
                $(".product-brands").val()
            );
        });
    })(jQuery);


        const paginationNumbers = document.getElementById("pagination-numbers");
        const paginatedList = document.getElementById("paginated-list");
        const listItems = paginatedList.querySelectorAll(".filter-content-item");
        // console.log(listItems);

        const nextButton = document.getElementById("next-button");
        const prevButton = document.getElementById("prev-button");

        const paginationLimit = 6;
        const pageCount = Math.ceil(listItems.length / paginationLimit);
        let currentPage = 1;
        // console.log(pageCount);
        const disableButton = (button) => {
            button.classList.add("disabled");
            button.setAttribute("disabled", true);
        };

        const enableButton = (button) => {
            button.classList.remove("disabled");
            button.removeAttribute("disabled");
        };

        const handlePageButtonsStatus = () => {
            if (currentPage === 1) {
                disableButton(prevButton);
            } else {
                enableButton(prevButton);
            }

            if (pageCount === currentPage) {
                disableButton(nextButton);
            } else {
                enableButton(nextButton);
            }
        };

        const handleActivePageNumber = () => {
            document.querySelectorAll(".pagination-number").forEach((button) => {
                button.classList.remove("active");
                const pageIndex = Number(button.getAttribute("page-index"));
                if (pageIndex == currentPage) {
                    button.classList.add("active");
                }
            });
        };

        const appendPageNumber = (index) => {
            const pageNumber = document.createElement("button");
            pageNumber.className = "pagination-number";
            pageNumber.innerHTML = index;
            pageNumber.setAttribute("page-index", index);
            pageNumber.setAttribute("aria-label", "Page " + index);

            paginationNumbers.appendChild(pageNumber);
        };

        const getPaginationNumbers = () => {
            for (let i = 1; i <= pageCount; i++) {
                appendPageNumber(i);
            }
        };

        const setCurrentPage = (pageNum) => {
            currentPage = pageNum;

            handleActivePageNumber();
            handlePageButtonsStatus();

            const prevRange = (pageNum - 1) * paginationLimit;
            const currRange = pageNum * paginationLimit;

            listItems.forEach((item, index) => {
                item.classList.add("hidden");
                if (index >= prevRange && index < currRange) {
                    item.classList.remove("hidden");
                }
            });
        };

        window.addEventListener("load", () => {
            getPaginationNumbers();
            setCurrentPage(1);

            prevButton.addEventListener("click", () => {
                setCurrentPage(currentPage - 1);
            });

            nextButton.addEventListener("click", () => {
                setCurrentPage(currentPage + 1);
            });

            document.querySelectorAll(".pagination-number").forEach((button) => {
                const pageIndex = Number(button.getAttribute("page-index"));

                if (pageIndex) {
                    button.addEventListener("click", () => {
                        setCurrentPage(pageIndex);
                    });
                }
            });
        });


    </script>
	<?php
	}
}
