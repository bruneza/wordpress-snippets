<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Viewed_Topics  extends \Elementor\Widget_Base
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
			return 'Viewed Topics';
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
			return esc_html__('Viewed Topics', 'mtn');
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
					'label' => esc_html__('Post Content Layout', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'Title_style',
				[
					'label' => esc_html__('Title Style', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__('Title Color', 'mtn'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .product-title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .product-title',
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'allbtn_style',
				[
					'label' => esc_html__('Main Button Style', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'allbtn_color',
				[
					'label' => esc_html__('Color', 'mtn'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .all-viewedtopics-btn' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'allbtn_background',
					'types' => [ 'classic', 'gradient' ],
					'exclude' => [ 'image' ],
					'selector' => '{{WRAPPER}} .all-viewedtopics-btn',
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
					'selector' => '{{WRAPPER}} .all-viewedtopics-btn',
				]
			);
	
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'allbtn_border',
					'label' => esc_html__( 'Border', 'mtn' ),
					'selector' => '{{WRAPPER}} .all-viewedtopics-btn',
				]
			);

			$this->add_control(
				'allbtn_border_radius',
				[
					'label' => esc_html__( 'Button Radius', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .all-viewedtopics-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .all-viewedtopics-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
	
			$this->end_controls_section();
	

		}

		protected function render()
		{
			$topics = array(
				array(
					"title" => "Product Campaign",
					"body" => "Untouchable, a doer plugged on 4G. Upgrade to 4G with a free SIM swap at any Mtn Service Centre.",
					"link" => "google.com",
				),
				array(
					"title" => "Product Campaign",
					"body" => "Untouchable, a doer plugged on 4G. Upgrade to 4G with a free SIM swap at any Mtn Service Centre.",
					"link" => "google.com",
				),
				array(
					"title" => "Product Campaign",
					"body" => "Untouchable, a doer plugged on 4G. Upgrade to 4G with a free SIM swap at any Mtn Service Centre.",
					"link" => "google.com",
				),
				array(
					"title" => "Product Campaign",
					"body" => "Untouchable, a doer plugged on 4G. Upgrade to 4G with a free SIM swap at any Mtn Service Centre.",
					"link" => "google.com",
				)
		);

			// $settings = $this->get_settings_for_display();
			/*** Start Content Section ***/
			echo '
			<div class="title-Topic" >
        <h2 class="mtn-primary-font">Most-viewed Topics</h2>
      </div>
		  <div class="mtn-home-topics-carousel-section owl-carousel topic-owl-carousel owl-theme" style="margin: 60px 0;">';
		  
		  $topics = $topics;
          foreach ($topics as $topic)
          {
            ?>
          
          <div class="col-md-12">
          
            <div class="row">
                <div class="col-md-11"><span class="curve1"></span>
                    <div class="topic">
                         <span class="topic-title mtn-secondary-font"><h1><?=$topic['title'];?></h1></span> 
                         <div class="topic-body">
                            <p class="mtn-text-font">
                                <?=$topic['body'];?>
                            </p>
                         </div>
                         <a class="mtn-accent-font" href="<?=$topic['link'];?>">Read More &nbsp;<i class=" fa fa-caret-right"></i></a>
                    
                </div><span class="curve"></span>
                </div>
            </div>
            
          </div>
          <?php
}
          

		    echo '</div>';
			/*** End Content Section ***/
		}
	}