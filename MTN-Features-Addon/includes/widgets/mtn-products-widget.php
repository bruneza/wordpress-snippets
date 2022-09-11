<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Products_Carousel  extends \Elementor\Widget_Base
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
			return 'Products Carousel';
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
			return esc_html__('Products Carousel', 'mtn');
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

			$posts = mtn_posts();
			$screens = array_chunk($posts,6);

			// $settings = $this->get_settings_for_display();
			/*** Start Content Section ***/
			echo '
			
		  <div class="mtn-products-carousel-section">
			<div class="d-flex services-item owl-carousel products-carousel owl-theme">';

            // Code GOES HERE
			
          foreach ($screens as $screen)
          {	
            ?>
			<div class="col-md-12">
            <div class="row main-galery">
                <div class="col-md-4">
                    <div class="col">
                        <div class="col-md-12">
                            <a hre="<?=$screen[0]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[0]['thumbnail']?>;?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                    
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a hre="<?=$screen[1]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[1]['thumbnail'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                
                            </a> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <a  hre="<?=$screen[2]['post-link'];?>" class="full-imgs" style="background-image: url('<?=$screen[2]['thumbnail'];?>'); 
                        background-size:cover; 
                        overflow:hidden;background-position:50% 30%;
                        display:flex;align-items:flex-end">
                                    
                    </a>
                    
                </div>

                <div class="col-md-4">
                    <div class="col">
                        <div class="col-md-12">
                            <a hre="<?=$screen[3]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[3]['thumbnail'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                    
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a hre="<?=$screen[4]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[4]['thumbnail'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
          </div>
			<?php
		  }
			echo '</div>';
			/*** End Content Section ***/
		}
	}