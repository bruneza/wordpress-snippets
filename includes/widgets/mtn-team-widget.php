<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Team_Grid  extends \Elementor\Widget_Base
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
			return 'MTN Team';
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
			return esc_html__('MTN Team', 'mtn');
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
					'label' => esc_html__('Post Content', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
			$this->add_control(
				'grid_num_posts',
				[
					'label' => esc_html__('Number of Posts', 'mtn'),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => -1,
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_query',
				[
					'label' => esc_html__('Query', 'elementor-pro'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
			$this->add_group_control(
				Group_Control_Related::get_type(),
				[
					'name' => 'mtn_posts',
				]
			);
	
			$this->end_controls_section();
	
			/*** Style COntrol ***/

			$this->start_controls_section(
				'Content_style',
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
						'{{WRAPPER}} h3.team-member-name' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => esc_html__('Title Font', 'mtn'),
					'selector' => '{{WRAPPER}} h3.team-member-name',
				]
			);
			$this->add_control(
				'job_color',
				[
					'label' => esc_html__('Job Title Color', 'mtn'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .job-title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'job_typography',
					'label' => esc_html__('Job Title Font', 'mtn'),
					'selector' => '{{WRAPPER}} .job-title',
				]
			);
			$this->add_control(
				'excerpt_color',
				[
					'label' => esc_html__('Excerpt Color', 'mtn'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .team-excerpt' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'excerpt_typography',
					'label' => esc_html__('Job Title Font', 'mtn'),
					'selector' => '{{WRAPPER}} .team-excerpt',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'socialmedia_style',
				[
					'label' => esc_html__('Main Button Style', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'socialmedia_color',
				[
					'label' => esc_html__('Color', 'mtn'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .team-more-btn' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'socialmedia_background',
					'types' => [ 'classic', 'gradient' ],
					'exclude' => [ 'image' ],
					'selector' => '{{WRAPPER}} .team-more-btn',
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
					'name' => 'socialmedia_typography',
					'selector' => '{{WRAPPER}} .team-more-btn',
				]
			);
	
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'socialmedia_border',
					'label' => esc_html__( 'Border', 'mtn' ),
					'selector' => '{{WRAPPER}} .team-more-btn',
				]
			);

			$this->add_control(
				'socialmedia_border_radius',
				[
					'label' => esc_html__( 'Button Radius', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .team-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'socialmedia_padding',
				[
					'label' => esc_html__( 'Padding', 'mtn' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .team-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
	
			$this->end_controls_section();
	

		}

		protected function render()
		{
			$settings = $this->get_settings_for_display();
            $posts = postsRender($settings);

			/*** Start Content Section ***/
			echo '
			
		  <div class="mtn-team-grid-section">
		  <div class="col-md-12">
		  <div class="row">';
		  foreach($posts as $post)
            {
				?>
                <div class="col-md-4">
                    <div class="profile-card">
                        <div class="col">
                            <div class="col-md-12 profile-title">
                                <div class="d-flex">
                                    <div class="col-md-4">
                                        <div class="profile-picture" style="background-image: url(<?=$post['thumbnail'];?>);">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h3 class="team-member-name"><?=$post['title'];?></h3>
                                        <span class="job-title"><?=$post['cpt-jobtitle'];?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="profile-body">
                                    <p class="team-excerpt">
                                        <?=$post['excerpt'];?>
                                    </p>
                                    <a href="<?=$post['post-link'];?>" class="team-more-btn">
                                        <span class="icon-desc">Learn More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
		  
            // Code GOES HERE
}
		    echo '
			</div></div></div>';
			/*** End Content Section ***/
		}
	}