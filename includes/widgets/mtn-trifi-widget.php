<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Roaming_Calling_tarrifs  extends \Elementor\Widget_Base
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
		return 'Calling tarrifs';
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
		return esc_html__('Calling tarrifs', 'mtn');
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
			'Query',
			[
				'label' => esc_html__('MTN Query', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_MTN_Query::get_type(),
			[
				'name' => 'mtn_posts',
			]
		);

		// $this->add_control(
		// 	'grid_fields_heading',
		// 	[
		// 		'label' => esc_html__('Choose Fields', 'mtn'),
		// 		'type' => \Elementor\Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 	]
		// );
		// $this->add_control(
		// 	'choose_grid_fields',
		// 	[
		// 		'type' => \Elementor\Controls_Manager::SELECT2,
		// 		'multiple' => true,
		// 		'options' => processOutput()['fields'],
		// 		'default' => ['thumbnail', 'post-link']
		// 	]
		// );

		$this->end_controls_section();
    }

    protected function render()
	{
        $settings = $this->get_settings_for_display();
		$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');

		$mtnSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
			'x_taxonomy' => validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs'),
            'x_terms' => validateEleCPT($settings,'mtn_posts_include_term_ids'),
			'x_show' => 'by_terms',
		];

		$taxonomies = xgetTerms($mtnSettings);



		// echo '<br>-----$Department-----<br>';
		// print_r($taxonomies);
		// echo '<br>----------<br>';
        $posts = xpostsRender($mtnSettings);
		$postMeta = array();

        $countries = array( array( "name"=>"Uganda", "key"=>"uganda", ), array( "name"=>"Kenya", "key"=>"kenya", ), array( "name"=>"South Sudan", "key"=>"south-sudan", ), array( "name"=>"USA", "key"=>"usa", ), array( "name"=>"Canada", "key"=>"canada", ), array(
            "name"=>"China", "key"=>"china", ), array( "name"=>"South Africa", "key"=>"south-africa", ), ); 
            
            $bundles = array( 
                array( 
                    "country"=>"uganda", 
                    "price"=>"500 Rwf",
                    "plan"=>"daily",
                    "resources"=>"7 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"usa", 
                    "price"=>"500 Rwf",
                    "plan"=>"daily",
                    "resources"=>"7 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"uganda", 
                    "price"=>"1,000 Rwf",
                    "plan"=>"daily",
                    "resources"=>"13 min",
                    "validity"=>"24 Hrs"
                ), 
                array( 
                    "country"=>"uganda", 
                    "price"=>"3,000 Rwf",
                    "plan"=>"weekly",
                    "resources"=>"43 min",
                    "validity"=>"24 Hrs"
                ), 
                array( 
                    "country"=>"uganda", 
                    "price"=>"5,000 Rwf",
                    "plan"=>"weekly",
                    "resources"=>"71 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"kenya", 
                    "price"=>"5,000 Rwf",
                    "plan"=>"weekly",
                    "resources"=>"71 min",
                    "validity"=>"24 Hrs"
                ), 
            );
        ?>
            <div class="col-md-12"> 
                <div class="container">
                    <div class="col-md-4 navigator">
                        <select class="data-bundle">
                            <?php
                            foreach($countries as $country)
                            {
                            ?>
                        <option value="<?=$country['key']?>"><?=$country['name']?></option>
                        <?php
                            } ?>
                    </select>
                    </div>
        
                    <div class="bundles-section">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="bundles">
                                    <table class="table table-responsive calling-tarifs">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Daily Bundles
                                                </th>
                                                <th>
        
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Price</td>
                                                <td>Resources</td>
                                                <td>Validity</td>
                                            </tr>
                                            <?php
                                            foreach($bundles as $bundle)
                                            {
                                                if($bundle['plan'] != 'daily') continue;
                                            ?>
                                                <tr class="bundle <?=$bundle['country']?>" style="display: none;">
                                                    <td>
                                                        <?=$bundle['price']?>
                                                    </td>
                                                    <td>
                                                        <?=$bundle['resources']?>
                                                    </td>
                                                    <td>
                                                        <?=$bundle['validity']?>
                                                    </td>
                                                </tr>
                                                <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="bundles">
                                    <table class="table table-responsive calling-tarifs">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Weekty Bundles
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
                                                <td>Price</td>
                                                <td>Resources</td>
                                                <td>Validity</td>
                                            </tr>
                                            <?php
                                            foreach($bundles as $bundle)
                                            {
                                                if($bundle['plan'] != 'weekly') continue;
                                            ?>
                                                <tr class="bundle <?=$bundle['country']?>" style="display: none;">
                                                    <td>
                                                        <?=$bundle['price']?>
                                                    </td>
                                                    <td>
                                                        <?=$bundle['resources']?>
                                                    </td>
                                                    <td>
                                                        <?=$bundle['validity']?>
                                                    </td>
                                                </tr>
                                                <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="bunner">
                                    <div class="bunner-texts">
                                        <h3>Enjoy MTN roaming</h3>
                                        <p>
                                            Dial <strong>*140#</strong> and select <strong>6</strong> to access international bundles.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <script>
                (function($) {
                var value = $(".data-bundle").val();
                $(".bundle").not('.' + value).hide('1000');
                $('.bundle').filter('.' + value).show('3000');
        
                $(".data-bundle").change(function() {
                    var value = $(this).val();
        
                    $(".bundle").not('.' + value).hide('1000');
                    $('.bundle').filter('.' + value).show('3000');
        
                });

        })(jQuery);
            </script>
            <?php
    }
}
