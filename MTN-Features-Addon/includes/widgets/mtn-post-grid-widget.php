<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Post_Grid  extends \Elementor\Widget_Base
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
			return 'Post Grid';
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
			return esc_html__('Post Grid', 'mtn');
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
			
			$items = array(
				array(
					"category"=>"Cloud",
                    "title"=>"",
					"image"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_Youth.jpg",
					"link"=>"",
					"content"=>"Managed firewall"
				),
				array(
					"category"=>"Network",
                    "title"=>"",
					"image"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_Youth.jpg",
					"link"=>"",
					"content"=>"Managed firewall"
				),
				array(
					"category"=>"Cloud",
                    "title"=>"",
					"image"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_Youth.jpg",
					"link"=>"",
					"content"=>"Managed firewall"
				),
				array(
					"category"=>"Cloud",
                    "title"=>"",
					"image"=>"https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_Youth.jpg",
					"link"=>"",
					"content"=>"Managed firewall"
				),

			);
						
		// $settings = $this->get_settings_for_display();
		/*** Start Content Section ***/
		echo '
				<div class="mtn-news-grid-section">
					<div class="col-md-12">
						<div class="col">
				';
	 ?>
                    

                    <div class="business-item-section">
                        <div class="row">
                            <?php
                            foreach($items as $item)
                            {?>


                                <div class="col-md-6">
                                    <div class="business-item" style="background-image:url( <?=$item['image']?>)">
                                        <div class="business-item-contents">
                                            <span> <?=$item['category']?></span>
                                            <h4>
                                                <?=$item['title']?>
                                            </h4>
                                            <p><?=$item['content']?></p>
                                            <a href=" <?=$item['link']?>">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                        }
                            ?>

                        </div>
                    </div>
                </div>
	 <?php echo'
	</div></div>';
			/*** End Content Section ***/
		}
	}