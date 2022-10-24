<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 * @package wp-job-manager
 * @since   1.33.0
 */

namespace INO_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Kura_Opportunity_Filter')) {
	class Kura_Opportunity_Filter  extends \Elementor\Widget_Base
	{
		public function get_name()
		{
			return 'Opportunity Filter';
		}

		public function get_title()
		{
			return esc_html__('Opportunity Filter', 'kura');
		}

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

			$this->start_controls_section(
				'content_section',
				[
				'label' => esc_html__('Post Content', 'kura'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_type',
			[
				'label' => esc_html__('Post Type', 'kura'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'Default' => 'kura_workshops',
				'options' => bru_post_types(),
			]
		);
		// $this->add_control(
		// 	'post_taxonomy',
		// 	[
		// 		'label' => esc_html__('Post Type', 'kura'),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => 'progress_filter',
		// 		'options' => [
		// 			'normal_filter' => 'Normal Filter',
		// 			'progress_filter' => 'Progress Filter',
		// 		],
		// 	]
		// );

		$this->add_control(
			'k_posts_per_page',
			[
				'label' => esc_html__('Posts Per Page', 'kura'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->end_controls_section();

		// STYLE CONTROLLER 
		$this->start_controls_section(
			'Card_style',
			[
				'label' => esc_html__('Card Style', 'kura'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__('Space Between', 'kura'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .k-opp-list-items .k-opp-list-item:not(:last-child)' => 'margin-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .k-opp-list-items .k-opp-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'Title_style',
			[
				'label' => esc_html__('Title Style', 'kura'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'kura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .k-grid-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .k-grid-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'company_style',
			[
				'label' => esc_html__('company Style', 'kura'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'metadata_color',
			[
				'label' => esc_html__('Metadata Color', 'kura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .k-meta-info' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_info_typography',
				'selector' => '{{WRAPPER}} .k-meta-info',
			]
		);

		$this->end_controls_section();
	}
	protected function postType(){
		$settings = $this->get_settings_for_display();
		if($settings['post_type'])
		return $settings['post_type'];
		else
		return 'kura_workshops';

	}
	protected function filter_tab_render(){
		$tabId = array('all');
		?>

		<div class="row">
				<ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
					</li>
					<?php
					$taxonomies =bru_get_terms($this->postType());
					foreach ($taxonomies as $key => $cat) {
						if ($cat['post-count'] < 0) continue;
						
						array_push($tabId, array($cat['name'], $key, $cat['taxonomy'])); ?>
						<li class="nav-item">
							<a class="nav-link" id="<?php echo $key ?>-tab" data-bs-toggle="pill" data-bs-target="#<?php echo $key ?>" role="tab" aria-controls="<?php echo $key ?>" aria-selected="false"><?php echo $cat['name'].'('.$cat['post-count'].')'; ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php
		return $tabId;
	}

		/**
		 * Render widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @since 1.0.1
		 * @access protected
		 */
		protected function render()
		{
			$args = array(
				'post_type' =>$this->postType(),
			); ?>
			
			<div class="kura-opportunityFilter-section">
			<?php $tabId = $this->filter_tab_render(); ?>
				<div class="tab-content  mt-2 mb-3" id="pills-tabContent">
				<?php
					foreach ($tabId as $pcat) {
						if (is_array($pcat)) {
							$posts = bru_posts($args,array($pcat[2] => $pcat[1]));
							$tabIndex = $pcat[1];
						} else {
							$posts = bru_posts($args);
							$tabIndex = $pcat;
						}
					
					?>

						<div class="tab-pane show " id="<?php echo $tabIndex; ?>" role="tabpanel" aria-labelledby="<?php echo $tabIndex; ?>-tab">

							<div class="kura-masonry">
								<?php
								// The Loop
								if ($posts) {	
									foreach ($posts as $post) { ?>

										<div class="kura-masonry-item">
											<div class="card light-gray-bg">
												<img src="<?php echo $post['thumbnail']; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
												<div class="content-wrapper p-4">
													<p class="date font-text">
														<?php echo '<span class="span-red font-weight-bold">Starting: </span>' . $post['starting-date'] . ' | <span class="span-red font-weight-bold">Duration: </span> ' . $post['duration']; ?>
													</p>
													<h3 class="font-secondary"><?php echo $post['company']; ?></h3>
													<p class="location font-small"><?php echo $post['location']; ?></p>
													<p class="description font-text">
														<?php echo $post['descr']; ?>
													</p>
													<a href="<?php echo $post['post-link']; ?>" class="stretched-link btn btn-primary">Apply</a>
												</div>
											</div>
										</div>


								<?php
									}
								}

								?>
							</div>
						</div>
					<?php } ?>
					<script>
						var activebtn = document.getElementById('all');
						activebtn.classList.add("active");
					</script>
				</div>
			</div>
<?php }
	}
} // End if class_exists check.
