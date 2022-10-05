<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Complex_Filter_Widget  extends \Elementor\Widget_Base
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
		return 'Complex Filter';
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
		return esc_html__('Complex Filter', 'mtn');
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

	// Register Controller
	protected function register_controls()
	{
		$count = range(1, 15);
		$count = array_combine($count, $count);

		// ANCHOR: Complex Filter - Content Control
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content layout', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// ANCHOR: Complex Filter - Grid Structure
		$this->add_responsive_control(
			'grid_template_columns',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Grid Number of Columns', 'mtn'),
				'default' => [
					'size' => 'auto'
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 12,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .filter-tab-contents' => 'grid-template-columns : repeat({{SIZE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->end_controls_section();

		// ANCHOR: Complex Filter - Grid Query Controls
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
		/*$this->add_control(
			'grid_filter_heading',
			[
				'label' => esc_html__('Filter By', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'choose_grid_taxonomy',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__('Select Taxonomy', 'mtn'),
				'multiple' => false,
				'options' => [
					'mtn_documentscategory' => "Documents Category",
				],
				'default' => 'mtn_documentscategory',
			]
		);

		$this->add_control(
			'mtn_posts_grid_terms_filter',
			[
				'type' => Module_Query::QUERY_CONTROL_ID,
				'label' => esc_html__('Terms to Filter', 'mtn'),
				'multiple' => true,
				'options' => [],
				'autocomplete' => [
					'object' => Module_Query::QUERY_OBJECT_CPT_TAX,
					'display' => 'detailed',
					'post_type' => 'mtn_posts_post_type'
				],
			]
		);*/

		$this->end_controls_section();

		// ANCHOR: Complex Filter - Style Controls Section
		// ANCHOR: Complex Filter - Grid Style
		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__('Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}


	// ANCHOR: Complex Filter - Render
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// if ($settings['choose_grid_fields'])
		// 	$neededFields =  $settings['choose_grid_fields'];
		// else
		// 	$neededFields =  ['post-link'];

		$postType = $settings['mtn_posts_post_type'];
		$posts = postsRender($settings, null);
		$terms = mtnTerms($posts, null, $settings['mtn_posts_include_term_ids']);
		$selectedKeys = array();
		
		/*** Start Content Section ***/
		echo '<div class="complex-filter-section">';
?>
		<div class="mtn-filter-tab">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

				<?php foreach ($terms as $key => $value) {
					// print_r(array_key_first($terms));
					array_push($selectedKeys, array($key, $value['taxonomy']));
				?>
					<li class="nav-item" role="presentation">
						<button class="nav-link <?php if (intval($key) == array_key_first($terms))  echo 'active'; ?>" id="pills-home-<?= $key; ?>" data-bs-toggle="pill" data-bs-target="#pills-<?= $key; ?>" type="button" role="tab" aria-controls="pills-<?= $key; ?>" aria-selected="true"><?= $value['name']; ?></button>
					</li>
				<?php } ?>
			</ul>
		</div>		
		<?php
		foreach ($selectedKeys as $key => $value) { ?>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show <?php if($key == 0) echo 'active'; ?>" id="pills-<?=$value[0];?>" role="tabpanel" aria-labelledby="pills-<?=$value[0];?>-tab">
			<div class="grid filter-tab-contents">
			<?php $posts = postsRender($settings,array($value[1] =>$value[0]));
			// print_r($posts);
			foreach ($posts as $post) {
		?>
				<div class="document-card">
						<div class="icon">
							<i class="fa fa-file-pdf"></i>
						</div>
						<div class="title">
							<p class="content-title"><?=$post['title'];?></p>
						</div>
						<a href="<?=$post['post-link'];?>" class="btn">Download</a>
					</div>
<?php
			}
			echo '</div></div></div>';
		}
		echo '</div></div>';
		/*** End Content Section ***/
	}
}
