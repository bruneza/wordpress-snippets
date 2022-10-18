<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Roaming_Data_Bundle_Filter  extends \Elementor\Widget_Base
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
		return 'Data Bundle';
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
		return esc_html__('Data Bundle', 'mtn');
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
            'label' => esc_html__('Number of Posts', 'mtn'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => -1,
        ]
    );

        $this->end_controls_section();
        /*** Style begins here***/
    }

    protected function render()
	{

		error_reporting(0);
ini_set('display_errors', 0);

        $settings = $this->get_settings_for_display();
        $postType = $settings['mtn_posts_post_type'] = 'mtn_roamings';
		$planTaxonomy = mtnTerms($postType, 'mtn_roaming_plans');
		$planLocation = mtnTerms($postType, 'mtn_roaming_locations');
		$planProvider = mtnTerms($postType, 'mtn_roaming_providers');
        $neededFields =  ['id','title','package','roaming_price','plan_type','roaming_location','roaming_provider'];
        $Allposts = postsRender($settings,null,$neededFields);
        // $Fieldposts = postsRender($settings,null,null);
        // $posts = postsRender($settings,null,$taxonomy, ['title','deadline','terms','post-link','region']);
       

?>
<div class="col-md-12">
	<div class="col">
		<div class="roaming-nav">
			<div class="row">
                <div class="col-md-4">
                    * Select Country
					<select name="" class="select-btn filter-lc-btn">
                    
						<option value="all">Select here</option>
						<?php
							foreach ($planLocation as $key => $location) {
								?>
								<option value="<?=$key?>"><?=$location['name']?></option>

							<?php }?>
					</select>
				</div>

			 

				<div class="col-md-4">
                * Select Service Provider
					<select name="" class="select-btn filter-2-btn">
						<option value="all">Select avalaible Provider</option>
						<?php
							foreach ($planProvider as $key => $Provider) {
								?>
								<option value="<?=$Provider['slug']?>" class="provider-btns <?=$key-1?>"><?=$Provider['name']?></option>

							<?php }?>
					</select>
				</div>
                
                <div class="col-md-4">
                * Select Plan
					<select name="" class="select-btn filter-2-btn">
						<option value="all">Choose your Plan</option>
						<?php
						foreach ($planTaxonomy as $key => $service) {
							?>
							<option value="<?=$service['name']?>"><?=$service['name']?></option>

						<?php }?>
					</select>
				</div> 
			</div>
		</div>
		<div class="col-md-12">
			<div class="roaming-tble">
				<table class="roaming-table table table-striped table-bordered table-condensed table-hover">
					<?php
						foreach($Allposts as $key => $post)
						{
							// print_r($post['roaming_price'][2]['provider'][0] [169]['slug']);
							// echo $post['roaming_price'][2]['provider'][0]->slug;
							?>
							<tr class="services filter <?=$post['roaming_price'][2]['provider'][0]->slug?> <?=$post['roaming_price'][1]['location'][0]?> <?=$post['roaming_price'][0]['plan_type'][1]['plan_type_name']?>" style="display:none">
								<td><?=$post['title']?></td>
								<!-- <td><?=$post['roaming_price'][0]['plan_type'][1]['plan_type_name']?></td> -->
								
								<td><?=$post['roaming_price'][2]['provider'][0]->name?></td>
                                <td><?=$post['roaming_price'][3]['price']?></td>
							</tr>
						<?php }
					?>
				</table>

			</div>
		</div>
	</div>
</div>
<?php
    }
}

// Array ( 
// 	[0] => Array ( 
// 		[id] => 35504 
// 		[title] => Call to the Rest of the World 
// 		[roaming_price] => Array ( 
// 			[0] => Array ( 
// 				[plan_type] => Array ( 
// 					[0] => Array ( 
// 						[plan_type_id] => 73 ) 
// 					[1] => Array ( 
// 						[plan_type_name] => Postpaid ) 
// 					) 
// 				) 
// 			[1] => Array ( 
// 				[location] => Array ( 
// 					[0] => 168 ) 
// 				) 
// 			[2] => Array ( 
// 				[provider] => Array ( 
// 					[0] => WP_Term Object ( 
// 						[term_id] => 170 
// 						[name] => AIRTEL Bharti Tele-Ventures2 
// 						[slug] => airtel-bharti-tele-ventures2 
// 						[term_group] => 0 
// 						[term_taxonomy_id] => 170 
// 						[taxonomy] => mtn_roaming_providers 
// 						[description] => 
// 						[parent] => 0 
// 						[count] => 6 
// 						[filter] => raw ) 
// 					) 
// 				) 
// 			[3] => Array ( [price] =>