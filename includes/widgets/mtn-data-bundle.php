<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Date_Bundles  extends \Elementor\Widget_Base
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
		return 'Mtn Bundles';
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
		return esc_html__('Mtn Bundles', 'mtn');
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

		$count = range(1, 15);
		$count = array_combine($count, $count);

		// ANCHOR: Complex Filter - Content Control
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content layout', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// ANCHOR: Complex Filter - Grid Structure
		$this->add_responsive_control(
			'grid_template_columns',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Grid Number of Columns', 'mtn'),
				'default' => [
					'size' => 'auto'
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 12,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .filter-tab-contents' => 'grid-template-columns : repeat({{SIZE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->end_controls_section();

		// ANCHOR: Complex Filter - Grid Query Controls
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
		/*	$this->add_control(
			'choose_grid_fields',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => processOutput()['fields'],
				'default' => ['thumbnail', 'post-link']
			]
		);
*/
		$this->end_controls_section();

		// ANCHOR: Complex Filter - Style Controls Section
		// ANCHOR: Complex Filter - Grid Style

		$this->start_controls_section(
			'filter_btn_style',
			[
				'label' => esc_html__('Filter Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filter_btn_padding',
			[
				'label' => esc_html__('Padding', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_btn_br',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_filter_btn',
				'label' => esc_html__('Set Filter Bg', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .navigator-country',
			]
		);

		$this->add_control(
			'filter_btn_text_color',
			[
				'label' => esc_html__('Text Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .navigator-country',
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__('Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'filter_grid_padding',
			[
				'label' => esc_html__('Padding', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_grid_br',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_filter_grid',
				'label' => esc_html__('Set Filter Bg', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .bundles',
			]
		);

		$this->add_control(
			'filter_grid_text_color',
			[
				'label' => esc_html__('Text Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'grid_icon_style',
			[
				'label' => esc_html__('Grid Icon Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_grid_br',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_grid_icon',
				'label' => esc_html__('Set Filter Bg', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .icon',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'grid_text_style',
			[
				'label' => esc_html__('Grid Text Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_text_typography',
				'selector' => '{{WRAPPER}} .content-title',
			]
		);
		$this->add_control(
			'grid_text_color',
			[
				'label' => esc_html__('Text Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'grid_btn_style',
			[
				'label' => esc_html__('Grid Button Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'grid_btn_padding',
			[
				'label' => esc_html__('Padding', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'grid_btn_br',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_grid_btn',
				'label' => esc_html__('Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .btn',
			]
		);

		$this->add_control(
			'grid_btn_text_color',
			[
				'label' => esc_html__('Text Color', 'textdomain'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'grid_btn_typography',
				'selector' => '{{WRAPPER}} .btn',
			]
		);

		$this->add_control(
			'custom_box_shadow',
			[
				'label' => esc_html__('Box Shadow', 'textdomain'),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$selectedKeys = array();

		$neededFields = validateNeededFields($settings, 'choose_grid_fields');
		$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');

		$mtnSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
			'x_terms' => validateEleCPT($settings, 'mtn_posts_include_term_ids'),
			'x_taxonomy' => validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs'),
			'x_show' => 'by_terms',
		];

		$terms = xgetTerms($mtnSettings);

		// echo '<br>-----$setting-----<br>';
		// print_r($settings);
		// echo '<br>----------<br';

		// echo '<br>-----$continents-----<br>';
		// print_r($terms);
		// echo '<br>----------<br>';


		$posts = xpostsRender($mtnSettings);
?>

		<div class="container filtering">
			<ul class="nav nav-pills-btn nav-filter-cat">
				<?php
				$counter = 1;
				foreach ($terms['roaming_continents'] as $key => $continents) {
				?>
					<li class="navigator-countries"><button class="navigator-country <?php echo $counter == 1 ? 'active' : ''; ?>" data-cat="<?= $continents['slug'] ?>"><?= $continents['name'] ?></button></li>
				<?php
					$counter++;
				}
				?>
				<!-- <li class="navigator-countries"><button class="navigator-country cat-all active">All Items</button></li> -->
			</ul>
			<div class="row">
				<div class="col-md-10 row filter-cat-results bundles-section">

					<?php
					foreach ($posts as $key => $post) {
						$firstTermKey = array_key_first($post['terms']['roaming_continents']);
						$postContinent = get_term($firstTermKey);
						
					?>

						<div class="col col-xs-6 f-cat col-md-6 bundle-contents <?= $postContinent->slug ?>" data-cat="<?= $postContinent->slug ?>">
							<div class="bundles-sec">
								<div class="cart-title-body">
									<div class="country-name">
										<h3>
											<?= $post['title'] ?>
										</h3>
									</div>

									<div class="d-flex" style="margin: 10px;">
										<div class="col-md-3">
											<h4>Operators</h4>
										</div>
										<div class="col-md-9">
											<div class="operators">
												<?php
												
												if (!empty($post['terms']['mtn_telecom_companies'])) {
													foreach ($post['terms']['mtn_telecom_companies'] as $key => $operators) { ?>

														<span class=""><?= $operators['name'] ?></span>

												<?php
													}
												}
												?>
											</div>
										</div>
									</div>
								</div>
								<table class="table">
									<thead>

									</thead>
									<tbody>
										<tr>
											<th>Price</th>
											<th>Resources</th>
											<th>Validity</th>
										</tr>
										<?php
										foreach ($post['tariff_info'] as $key => $tariffInfo) { ?>

											<tr class="bundle">
												<td>
													<?= $tariffInfo['price'] ?> FRW
												</td>
												<td>
													<?= $tariffInfo['ressources'] ?>
												</td>
												<td>
													<?= xgetTariffValidity($tariffInfo['package']);?>
												</td>
											</tr>
										<?php

										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php
					}
					?>


				</div>
				<div class="col-md-2">
					<div class="bunner">
						<div class="bunner-texts">
							<h3>Enjoy MTN roaming</h3>
							<p>
								Dial <strong>*140#</strong> and select <strong>6</strong> to access international bundles.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			(function($) {


				var header = document.querySelector(".nav-filter-cat");
				var btns = header.getElementsByClassName("navigator-countries");
				for (var i = 0; i < btns.length; i++) {
					btns[i].addEventListener("click", function() {
						var current = document.getElementsByClassName("active");
						current[0].className = current[0].className.replace(" active", "");
						this.className += " active";
					});
				}

				var value = $(".navigator-countries .active").attr("data-cat");
				$(".bundle-contents").not('.' + value).removeClass("active");
				// $('.bundle-contents').filter('.' + value).show('3000');
				$('.bundle-contents').filter('.' + value).addClass("active");
				$(".navigator-country").click(function() {
					var value = $(this).attr("data-cat");
					// console.log(value);
					// $(".bundle-contents").not('.' + value).hide('1000');
					$(".bundle-contents").not('.' + value).removeClass("active");
					// $('.bundle-contents').filter('.' + value).show('3000');
					$('.bundle-contents').filter('.' + value).addClass("active");

				});


			})(jQuery);
		</script>
<?php



	}
}
