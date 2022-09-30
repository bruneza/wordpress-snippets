<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Vacancies  extends \Elementor\Widget_Base
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
		return 'Vacancies Widget';
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
		return esc_html__('Vacancies Widget', 'mtn');
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
				'label' => esc_html__('Content', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'num_of_columns', 
		[
            'label' => esc_html__('Number of Columns', 'textdomain'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3,
        ]
    );
	
		text_control($this, 'view_more_btn', ['label' => 'View More Button']);
		$this->end_controls_section();
	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$postType = $settings['mtn_posts_post_type'] = 'job_listing';
		$numCol = $settings['num_of_columns'];
		$taxonomy = 'job_listing_category';

		$terms = mtnTerms($postType, $settings,$taxonomy);
		$regions= mtnTerms($postType, $settings,'mtn_job_region');

		$posts = postsRender($settings,null,$taxonomy, ['title','deadline','terms','post-link','region']);
	
		echo '<br>********************************************************* <br>';
		echo '<h3>Category</h3>';
		echo '********************************************************* <br><br><br>';
		print_r($terms);
		echo '<br>********************************************************* <br>';
		echo '<h3>Region</h3>';
		echo '********************************************************* <br><br><br>';
		print_r($regions);
		echo '<br>********************************************************* <br>';
		echo '<h3>POSTS</h3>';
		echo '********************************************************* <br><br><br>';
		print_r($posts);
		


		// foreach
?>
		<?php
	}
}
