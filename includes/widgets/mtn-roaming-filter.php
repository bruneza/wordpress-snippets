<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Roaming_Filter  extends \Elementor\Widget_Base
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
		return 'Roaming Filter';
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
		return esc_html__('Roaming Filter', 'mtn');
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
        $count_to_ten = range(1, 10);
        $count_to_ten = array_combine($count_to_ten, $count_to_ten);

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
            'label' => esc_html__('Number of Posts', 'textdomain'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => -1,
        ]
    );
        $this->end_controls_section();
        /*** Style begins here***/
    }

    protected function render()
	{

        $settings = $this->get_settings_for_display();
        $postType = $settings['mtn_posts_post_type'] = 'mtn_roamings';
		$planTaxonomy = mtnTerms($postType, 'mtn_roaming_plans');
		$planLocation = mtnTerms($postType, 'mtn_roaming_locations');
		$planProvider = mtnTerms($postType, 'mtn_roaming_providers');
        $neededFields =  ['id','title','package','roaming_price','plan_type','roaming_location','roaming_provider'];
        $Allposts = postsRender($settings,null,$neededFields);
        // $Fieldposts = postsRender($settings,null,null);
        // $posts = postsRender($settings,null,$taxonomy, ['title','deadline','terms','post-link','region']);

        
        echo '<br>********************************************************* <br>';
		echo '<h3>POSTsaaa </h3>';
		echo '********************************************************* <br><br><br>';
		// $TermsId = array(92);


		foreach ($planLocation as $location) {
			echo 'Location: '.$location['name'].'<br>';
		}



    }
}