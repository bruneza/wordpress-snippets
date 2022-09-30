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
		heading_control($this, 'title_heading',['label'=>'Title']);
		color_control($this, 'title_color', '.team-member-name',['label'=>'Title Color']);
		typography_control($this, 'title_typography', '.team-member-name');

		// Job Title Style
		heading_control($this, 'job_title_heading',['label'=>'Job Title']);
		color_control($this, 'job_color',  '.job-title',['label'=>'Job Title Color']);
		typography_control($this, 'job_typography', '.job-title');

		// Excerpt Style
		heading_control($this, 'excerpt_title_heading', ['label'=>'Excerpt']);
		color_control($this, 'excerpt_color', '.team-excerpt',['label'=>'Excerpt Color']);
		typography_control($this, 'excerpt_typography', '.team-excerpt');

		$this->end_controls_section();
		$this->start_controls_section(
			'modal_content_style',
			[
				'label' => esc_html__('Popup Modal Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Modal Grid Style
		heading_control($this, 'modal_grid_heading', ['label'=>'Modal Grid']);
		background_control($this, 'modal_background','.mtn-modal-body', ['image'], ['label'=>'Modal Background']);
		border_control($this, 'modal_border', '.mtn-modal-body', ['label'=>'Modal Border']);
		border_radius_control($this, 'modal_border_radius', '.mtn-modal-body');
		slider_control($this, 'modal_grid_height', ['.mtn-modal-dialog', 'height'], ['label'=>'Height','default'=>100]);
		slider_control($this, 'modal_grid_width',['.mtn-modal-dialog', 'width'], ['label'=>'Width','default'=>100]);

		// Modal Image Column
		heading_control($this, 'modal_image_heading', ['label'=>'Modal Image Column']);
		slider_control($this, 'modal_image_column_width', ['.team-member-img', 'max-width'], ['label'=>'Width','default'=>100]);

		// Modal Content Column
		heading_control($this, 'modal_content_heading', ['label'=>'Modal Content Column']);
		padding_control($this, 'modal_content_padding',  '.team-member-info', ['label'=>'Padding']);


		// Title Style
		heading_control($this, 'modal_title_heading', ['label'=>'Title']);
		color_control($this, 'modal_title_color', '.modal-member-name', ['label'=>'Title Color']);
		typography_control($this, 'modal_title_typography', '.modal-member-name');
		slider_control($this, 'modal_title_spacing',  ['.modal-member-name', 'margin-bottom'], ['label'=>'Spacing','default'=>20]);

		// Job Title Style
		heading_control($this, 'modal_job_title_heading',  ['label'=>'Job Position']);
		color_control($this, 'modal_job_color',  '.modal-member-position', ['label'=>'Color']);
		typography_control($this, 'modal_job_typography', '.modal-member-position');
		slider_control($this, 'modal_job_spacing',  ['.modal-member-position', 'margin-bottom'], ['label'=>'Spacing','default'=>20]);

		// Excerpt Style
		heading_control($this, 'content_title_heading',  ['label'=>'Content']);	
		color_control($this, 'content_color',  '.modal-member-bio', ['label'=>'Excerpt Color']);
		typography_control($this, 'content_typography', '.modal-member-bio', ['label'=>'Job Title Font']);

		$this->end_controls_section();

		$this->start_controls_section(
			'socialmedia_style',
			[
				'label' => esc_html__('Main Button Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		
		typography_control($this, 'socialmedia_typography', '.team-more-btn');
		border_radius_control($this, 'socialmedia_border_radius', '.team-more-btn');
		padding_control($this, 'socialmedia_padding', '.team-more-btn', ['label'=>'Padding']);

		// STATE TABS
		$this->start_controls_tabs('tabs_dot_style');
		// Normal State
		$this->start_controls_tab(
			'normal_btn',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		color_control($this, 'socialmedia_color', 'Color', '.team-more-btn');
		background_control($this, 'socialmedia_background',  '.team-more-btn', ['image'], ['label'=>'Button Background']);
		border_control($this, 'socialmedia_border', '.team-more-btn', ['label'=>'Border']);

		$this->end_controls_tab();
		// Hover State
		$this->start_controls_tab(
			'hover_btn',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);
		color_control($this, 'socialmedia_hover_color', '.team-more-btn:hover', ['label'=>'Color']);
		background_control($this, 'socialmedia_hover_background', '.team-more-btn:hover', ['image'], ['label'=>'Button Background']);
		border_control($this, 'socialmedia_hover_border',  '.team-more-btn:hover', ['label'=>'Border']);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$neededFields =  ['id', 'thumbnail', 'title', 'cpt-jobtitle', 'excerpt', 'post-link', 'content', 'job-title'];
		$posts = postsRender($settings, null, $neededFields);

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
									<span class="job-title"><?= $post['cpt-jobtitle']; ?></span>
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
