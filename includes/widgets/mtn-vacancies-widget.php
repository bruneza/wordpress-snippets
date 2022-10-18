<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Vacancies  extends \Elementor\Widget_Base
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
		return 'Vacancies Widget';
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
		return esc_html__('Vacancies Widget', 'mtn');
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

		$this->add_control(
			'num_of_columns',
			[
				'label' => esc_html__('Number of Columns', 'mtn'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'view_more_btn',
			[
				'label' => esc_html__('View More Button', 'mtn'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Enter Value', 'mtn'),
				'default' => esc_html__('View More', 'mtn'),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->end_controls_section();

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
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');

		$mtnSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
			'x_taxonomy' => validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs'),
			'x_show' => 'by_taxonomy',
		];

		$taxonomies = xgetTerms($mtnSettings);

		$posts = xpostsRender($mtnSettings);



		// echo '<br>-----$Department-----<br>';
		// print_r($taxonomies);
		// echo '<br>----------<br>';

		$postMeta = array();
		$tabTaxSlug = array();
		foreach (array_keys($taxonomies) as $filterTaxKey) {
			$tabTaxSlug = array_merge($tabTaxSlug, ['$(".filter-grid-section select.' . get_taxonomy($filterTaxKey)->rewrite['slug'] . '").val()']);
		}
		$tabTaxSlug = implode(',', $tabTaxSlug);
		// echo '<br>-----$Department-----<br>';
		// 	print_r($tabTaxSlug);
		// 	echo '<br>----------<br>';


?>
		<script>
			(function($) {
				$(document).ready(function() {
					var filterActive;

					function filterCategory(tab1) {
						// reset results list
						$('.filter-content-items .filter-content-item').removeClass('active');

						// the filtering in action for all criteria
						var selector = ".filter-grid-section .filter-content-item";

						if (tab1 !== 'tab-all') {
							selector = '[data-tab=' + tab1 + "]";
						}

						// show all results
						$(selector).addClass('active');

						// reset active filter
						filterActive = tab1;
					}

					/***** FILTER GRID****/

					// start by showing all items
					$('.filter-grid-section .filter-content-item').addClass('active');

					// call the filtering function when selects are changed
					$('.filter-grid-section select').change(function() {
						filterCategory(<?= $tabTaxSlug; ?>);
					});
				});

			})(jQuery);
		</script>

		<div class="filter-grid-section container">
			<div class="filter-tab-row row">
				<?php
				foreach ($taxonomies as $taxKey => $terms) {
					$taxSlug = get_taxonomy($taxKey)->rewrite['slug'];
					$taxLabel = get_taxonomy($taxKey)->label;
				?>
					<div class="filter-tab-col col-md-4 col-sm-12">
						<select class="form-control <?= $taxSlug; ?>">
							<?php
							foreach ($terms as $termKey => $term) {
								if (array_key_first($terms) == $termKey)
									echo '<option value="tab-all">All ' . $taxLabel . '</option>';

								echo '<option value="tab-' . $term['slug'] . '">' . $term['name'] . '</option>';

							?>
							<?php } ?>
						</select>
					</div>
				<?php } ?>
			</div>
			<div class="row filter-content-items">
				<?php
				foreach ($posts as $post) {
					$divAttr = array();
					foreach ($post['selected-tax'] as $selKey => $selectedTax) {
						$divAttr = array_merge($divAttr, ['data-tab= "tab-' . $selectedTax['terms-obj'][0]->slug . '" ']);
					}
					$divAttr = implode(' ', $divAttr);
					// echo '<br>-----$taxKey-----<br>';
					// print_r($selectedTax['terms-obj']);
					// echo '<br>----------<br';

				?>
					<div class="col col-md-6 col-sm-12 filter-content-item" <?= $divAttr; ?>>
						<div class="vacancies">
							<div class="d-flex">
								<div class="col-md-10">
									<h4><?= $post['title'] ?></h4>
									<p><?= $selectedTax['terms-obj'][0]->name; ?></p>
									<i><?= $post['closing_data'] ?></i>
								</div>
								<div class="col-md-2">
									<a href="<?= $post['post-link'] ?>" class="deal-items-icon">
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
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
