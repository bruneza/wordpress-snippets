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
				'dot_style',
				[
					'label' => esc_html__('Carousel dot Style', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'dot_vertical_position',
				[
					'label' => esc_html__('Vertical Position', 'mtn'),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => ['%', 'px'],
					'default' => [
						'unit' => 'px',
						'size' => -60
					],
					'range' => [
						'px' => [
							'min' => -150,
							'max' => 150,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_dot_style' );
			$this->start_controls_tab(
				'tab_dot_normal',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'dot_background',
					'label' => esc_html__( 'Dot Background', 'plugin-name' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} .owl-dots span',
				]
			);

			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_dot_hover',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'dot_hover_background',
					'label' => esc_html__( 'Dot Background', 'plugin-name' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} .owl-dots .active span',
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'dot_border',
					'label' => esc_html__( 'Dot Border', 'mtn' ),
					'selector' => '{{WRAPPER}} .owl-dot span',
				]
			);

			$this->add_control(
				'allbtn_border_radius',
				[
					'label' => esc_html__( 'Button Radius', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
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
            echo '<div class="d-flex deals-item owl-carousel deal-carousel owl-theme">';
            foreach ($posts as $post)
          {?>
              <div class="deals filter" style="background-image: url('<?echo $post['thumbnail']; ?>'); 
              background-size:cover; height:100%; overflow:hidden; background-position:cover ; display:flex; align-items:flex-end">
                      <div class="deals-contents">
                          <a class="btn read-more-btn" href="<?=$post['post-link'];?>">Read More &nbsp;<i class="fa fa-angle-right"></i></a>
                      </div>
              </div>
<?php
}
			echo '</div></div>';
			/*** End Content Section ***/
		}
	}