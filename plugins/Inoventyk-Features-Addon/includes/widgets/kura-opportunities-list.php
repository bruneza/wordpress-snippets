<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 */

namespace INO_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('Kura_Opportunities_List')) {
	class Kura_Opportunities_List  extends \Elementor\Widget_Base
	{

		private $ksettings = null;


		public function get_name()
		{
			return 'Opportunity Filter';
		}

		public function get_title()
		{
			return esc_html__('Opportunity list', 'kura');
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
					'label' => esc_html__('Opportunies List', 'kura'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'post_type',
				[
					'label' => esc_html__('Post Type', 'kura'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => bru_post_types(),
				]
			);

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
			$settings = $this->get_settings_for_display();
			$postType = $settings['post_type'];
			$args = array(
				'post_type' => $postType,
				'posts_per_page'	=>  $settings['k_posts_per_page'],
			);

			$posts = bru_posts($args); ?>
			<div class="k-opp-list-section">
				<div class="k-opp-list-items">
				<?php if(isset($posts)){
					foreach ($posts as $post) {  ?>
						<div class="card k-opp-list-item">
							<div class="card-body light-gray-bg">
								<div class=" container k-grid-list">
									<h3 class="k-grid-title "><?php echo $post['title']; ?></h3>
									<p class="k-meta-info"><?php if ($postType != 'kura_scholarships') echo $post['company']; ?></p>
									<p class="k-meta-info"><?php if ($postType == 'kura_scholarships') echo $post['location']; ?></p>
									<a href="<?php echo $post['post-link']; ?>" class="btn btn-primary">Apply</a>
								</div>
							</div>
						</div>
					<?php } ?>

				</div>
			</div>
<?php }}
	}
} // End if class_exists check.
