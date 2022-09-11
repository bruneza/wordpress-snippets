<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Deals_Carousel  extends \Elementor\Widget_Base
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
			return 'Deals Carousel';
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
			return esc_html__('Deals Carousel', 'mtn');
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
					'label' => esc_html__('Post Content Layout', 'kura'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .deal-title' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .deal-title',
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'allbtn_style',
				[
					'label' => esc_html__('Main Button Style', 'kura'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'allbtn_color',
				[
					'label' => esc_html__('Color', 'kura'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .all-deal-btn' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'allbtn_background',
					'types' => [ 'classic', 'gradient' ],
					'exclude' => [ 'image' ],
					'selector' => '{{WRAPPER}} .all-deal-btn',
					'fields_options' => [
						'background' => [
							'default' => 'classic',
						],
						'color' => [
							'dynamic' => [],
						],
						'color_b' => [
							'dynamic' => [],
						],
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'allbtn_typography',
					'selector' => '{{WRAPPER}} .all-deal-btn',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'allbtn_border',
					'label' => esc_html__( 'Border', 'mtn' ),
					'selector' => '{{WRAPPER}} .all-deal-btn',
				]
			);

			$this->add_control(
				'allbtn_border_radius',
				[
					'label' => esc_html__( 'Button Radius', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .all-deal-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'allbtn_padding',
				[
					'label' => esc_html__( 'Padding', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .all-deal-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->end_controls_section();

		}
		
		protected function render()
		{
			// $settings = $this->get_settings_for_display();

            $posts = mtn_posts();

			/*** Start Content Section ***/
			echo '<div class="mtn-deals-carousel-section">';
            echo '
		  <div class="title-deal" >
        <div><h3 class="deal-title">Deals</h3></div>
        <a href="" class="btn btn-primary all-deal-btn">All deal</a>
      </div>
		  <div class="d-flex deals-item owl-carousel deal-carousel owl-theme" style="margin:60px 0">';
            foreach ($posts as $post)
          {?>
              <div class="deals filter" style="background-image: url('<?echo $post['thumbnail']; ?>'); 
              background-size:cover; height:100%; overflow:hidden; background-position:cover ; display:flex; align-items:flex-end">
                      <div class="deals-contents">
                          <a class="read-more-btn" href="<?=$post['post-link'];?>">Read More &nbsp;<i class="fa fa-angle-right"></i></a>
                      </div>
              </div>
<?php
}
			echo '</div></div>';
			/*** End Content Section ***/
		}
	}