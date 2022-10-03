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
		// Query
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
				'label' => esc_html__('Team Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title Style
		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__('Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .team-member-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .team-member-name',
			]
		);

		// Job Title Style
		$this->add_control(
			'job_title_heading',
			[
				'label' => esc_html__('Job Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => esc_html__('Job Title Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .job-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .job-title',
			]
		);

		// Excerpt Style
		$this->add_control(
			'excerpt_title_heading',
			[
				'label' => esc_html__('Excerpt', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Excerpt Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .team-excerpt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .team-excerpt',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'modal_content_style',
			[
				'label' => esc_html__('Popup Modal Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Modal Grid Style
		$this->add_control(
			'modal_grid_heading',
			[
				'label' => esc_html__('Modal Grid', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'modal_background',
				'label' => esc_html__('Modal Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .mtn-modal-body',
				'exclude' => [
					'image'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'modal_border',
				'selector' => '{{WRAPPER}} .mtn-modal-body',
			]
		);
		$this->add_responsive_control(
			'modal_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .mtn-modal-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'modal_grid_height',
			[
				'label' => esc_html__('Height', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 100
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtn-modal-dialog' => 'height: {{SIZE}}{{UNIT}}',
				],

			]
		);

		$this->add_responsive_control(
			'modal_grid_width',
			[
				'label' => esc_html__('Width', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 100
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtn-modal-dialog' => 'width: {{SIZE}}{{UNIT}}',
				],

			]
		);

		// Modal Image Column
		$this->add_control(
			'modal_image_heading',
			[
				'label' => esc_html__('Modal Image Column', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'modal_image_column_width',
			[
				'label' => esc_html__('Width', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 100
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-member-img' => 'max-width: {{SIZE}}{{UNIT}}',
				],

			]
		);

		// Modal Content Column
		$this->add_control(
			'modal_content_heading',
			[
				'label' => esc_html__('Modal Content Column', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'modal_content_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Padding', 'mtn'),
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .team-member-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		// Title Style
		$this->add_control(
			'modal_title_heading',
			[
				'label' => esc_html__('Title', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'modal_title_color',
			[
				'label' => esc_html__('Title Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .modal-member-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'modal_title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .modal-member-name',
			]
		);
		$this->add_responsive_control(
			'modal_title_spacing',
			[
				'label' => esc_html__('Spacing', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 20
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .modal-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],

			]
		);

		// Job Title Style
		$this->add_control(
			'modal_job_title_heading',
			[
				'label' => esc_html__('Job Position', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'modal_job_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .modal-member-position' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'modal_job_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .modal-member-position',
			]
		);
		$this->add_responsive_control(
			'modal_job_spacing',
			[
				'label' => esc_html__('Spacing', 'mtn'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 20
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .modal-member-position' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		// Excerpt Style
		$this->add_control(
			'content_title_heading',
			[
				'label' => esc_html__('Content', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Excerpt Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .modal-member-bio' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .modal-member-bio',
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


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'socialmedia_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .team-more-btn',
			]
		);
		$this->add_responsive_control(
			'socialmedia_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mtn'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .team-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'socialmedia_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__('Padding', 'mtn'),
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .team-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		// STATE TABS
		$this->start_controls_tabs('tabs_dot_style');
		// Normal State
		$this->start_controls_tab(
			'normal_btn',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$this->add_control(
			'socialmedia_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .team-more-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'socialmedia_background',
				'label' => esc_html__('Button Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .team-more-btn',
				'exclude' => [
					'image'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'socialmedia_border',
				'selector' => '{{WRAPPER}} .team-more-btn',
			]
		);

		$this->end_controls_tab();
		// Hover State
		$this->start_controls_tab(
			'hover_btn',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);
		$this->add_control(
			'socialmedia_hover_color',
			[
				'label' => esc_html__('Color', 'mtn'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .team-more-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'socialmedia_hover_background',
				'label' => esc_html__('Button Background', 'mtn'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .team-more-btn:hover',
				'exclude' => [
					'image'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'socialmedia_hover_border',
				'selector' => '{{WRAPPER}} .team-more-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$neededFields =  ['id', 'thumbnail', 'title', 'excerpt', 'post-link', 'content', 'job-title'];
		$posts = postsRender($settings, ['mtn_team_category'=>$settings['mtn_posts_include_term_ids']], $neededFields);

		/*** Start Content Section ***/
		echo '
			
		  <div class="mtn-team-grid-section">
		  <div class="row">';
		foreach ($posts as $post) {
?>
			<div class="col-md-4">
				<div class="profile-card">
					<div class="col">
						<div class="col-md-12 profile-title">
							<div class="d-flex">
								<div class="col-md-4">
									<div class="profile-picture" style="background-image: url(<?= $post['thumbnail']; ?>);">
									</div>
								</div>
								<div class="col-md-8">
									<h3 class="team-member-name"><?= $post['title']; ?></h3>
									<span class="job-title"><?= $post['job-title']; ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="profile-body">
								<p class="team-excerpt">
									<?= $post['excerpt']; ?>
								</p>
								<!-- POPUP BUTTON -->
								<button type="button" class="team-more-btn" data-bs-toggle="modal" data-bs-target="#post-popup-<?= $post['id']; ?>">
									<span class="icon-desc">Learn More</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		echo '
			</div></div>';

		/*** End Content Section ***/
		/*** POPUP MODAL Section ***/

		echo '<div class="mtn-team-popup modal-section">';
		foreach ($posts as $key => $post) { ?>
			<!-- POST POPUP MODAL -->
			<div class="mtn-team-modal modal fade" id="post-popup-<?= $post['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="teamMemberInfo<?= $key; ?>" aria-hidden="true" aria-hidden="true">
				<div class="modal-dialog mtn-modal-dialog" role="document">
					<div class="mtn-modal-body mtn-modal-row row">
						<div class="col col-md team-member-img">
							<img src="<?= $post['thumbnail']; ?>" alt="<?= $post['title']; ?>">
						</div>
						<div class="col col-md team-member-info">
							<h4 class="modal-member-name mtn-secondary-font"><?= $post['title']; ?></h4>
							<p class="modal-member-position mtn-accent-font"><?= $post['job-title']; ?></p>
							<p class="modal-member-bio mtn-text-font"><?= $post['content']; ?></p>
						</div>
					</div>
				</div>
			</div>
<?php
		}
		echo '</div>';
		/*** End  POPUP MODAL Section ***/
	}
}
