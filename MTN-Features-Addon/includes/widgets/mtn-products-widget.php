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
						'{{WRAPPER}} .all-product-btn' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'allbtn_background',
					'types' => [ 'classic', 'gradient' ],
					'exclude' => [ 'image' ],
					'selector' => '{{WRAPPER}} .all-product-btn',
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
					'selector' => '{{WRAPPER}} .all-product-btn',
				]
			);
	
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'allbtn_border',
					'label' => esc_html__( 'Border', 'mtn' ),
					'selector' => '{{WRAPPER}} .all-product-btn',
				]
			);

			$this->add_control(
				'allbtn_border_radius',
				[
					'label' => esc_html__( 'Button Radius', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .all-product-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .all-product-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
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
		  <div class="title-section" >
				<div><h3 class="product-title">Products</h3></div>
				<a href="" class="btn btn-primary all-product-btn">All Products</a>
      		</div>
			<div class="d-flex services-item owl-carousel products-carousel owl-theme" style="margin:60px 0">';

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