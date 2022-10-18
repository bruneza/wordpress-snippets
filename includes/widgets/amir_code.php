<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Date_Bundles  extends \Elementor\Widget_Base
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
		return 'Mtn Bundles';
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
		return esc_html__('Mtn Bundles', 'mtn');
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

		$this->add_control(
			'grid_fields_heading',
			[
				'label' => esc_html__('Choose Fields', 'mtn'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
	/*	$this->add_control(
			'choose_grid_fields',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => processOutput()['fields'],
				'default' => ['thumbnail', 'post-link']
			]
		);
*/
		$this->end_controls_section();

		// ANCHOR: Complex Filter - Style Controls Section
		// ANCHOR: Complex Filter - Grid Style

        $this->start_controls_section(
            'filter_btn_style',
			[
				'label' => esc_html__('Filter Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'filter_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'filter_btn_br',
			[
				'label' => esc_html__( 'Border Radius', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_filter_btn',
				'label' => esc_html__( 'Set Filter Bg', 'mtn' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .navigator-country',
			]
		);

        $this->add_control(
			'filter_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigator-country' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .navigator-country',
			]
		);



        $this->end_controls_section();

		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__('Grid Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


        $this->add_control(
			'filter_grid_padding',
			[
				'label' => esc_html__( 'Padding', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'filter_grid_br',
			[
				'label' => esc_html__( 'Border Radius', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_filter_grid',
				'label' => esc_html__( 'Set Filter Bg', 'mtn' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bundles',
			]
		);

        $this->add_control(
			'filter_grid_text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bundles' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'grid_icon_style',
			[
				'label' => esc_html__('Grid Icon Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_grid_br',
			[
				'label' => esc_html__( 'Border Radius', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_grid_icon',
				'label' => esc_html__( 'Set Filter Bg', 'mtn' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .icon',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'grid_text_style',
			[
				'label' => esc_html__('Grid Text Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_text_typography',
				'selector' => '{{WRAPPER}} .content-title',
			]
		);
		$this->add_control(
			'grid_text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'grid_btn_style',
			[
				'label' => esc_html__('Grid Button Style', 'mtn'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'grid_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'grid_btn_br',
			[
				'label' => esc_html__( 'Border Radius', 'mtn' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_grid_btn',
				'label' => esc_html__( 'Background', 'mtn' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .btn',
			]
		);

        $this->add_control(
			'grid_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'grid_btn_typography',
				'selector' => '{{WRAPPER}} .btn',
			]
		);

		$this->add_control(
			'custom_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				],
			]
		);

		$this->end_controls_section();

    
    }

    protected function render()
	{
		$settings = $this->get_settings_for_display();
		$selectedKeys = array();

		$neededFields = validateNeededFields($settings, 'choose_grid_fields');
		$postType = validateEleCPT($settings, 'mtn_posts_post_type', 'mtn_posts_selected_cpt');

        if ($settings['choose_grid_fields'])
            $neededFields =  $settings['choose_grid_fields'];
        else
            $neededFields =  ['title'];

        $mtnSettings = [
			'x_post_type' => $postType,
			'x_posts_per_page' => validateEleCPT($settings, 'mtn_posts_posts_per_page'),
			'x_terms' => validateEleCPT($settings, 'mtn_posts_include_term_ids'),
			'x_taxonomy' => validateEleCPT($settings, 'mtn_posts_include_taxonomy_slugs'),
			'x_show' => 'by_taxonomy',
        ];

        $terms = getTerms($mtnSettings);

		echo '<br>-----$settings-----<br';
		print_r($mtnSettings);
		echo '<br>----------<br';
		$continents = array();
		foreach ($terms as $term){
			array_push($continents, 
			[
				'name' => $term['name'], 
				'key' => $term['slug']
			]);
		}

		$posts = postsRender($mtnSettings);
		
		$country = array();
		$countryId = null;
		foreach ( $posts as $post){
			if(isset($countryId[$post['id']]))continue;
			$countryId[$post['id']] = $post['id'];
				array_push($country, 
			[
				'name' => $post['title'], 
				'key' => $post['slug'],
			]);
			
			
			echo '<br>-----tariff_continent-----<br>';
			print_r($post);
			echo '<br>----------<br>';
			};
			
       
        $countries = array( 
            array( 
                "name"=>"Uganda",
				"key"=>"uganda",
                "continent"=>"africe" 
                ), 
            array( "name"=>"Kenya", "key"=>"kenya",
            "continent"=>"africe"  ), 
            array( "name"=>"South Sudan", "key"=>"south-sudan",
            "continent"=>"africe" ), 
            array( "name"=>"USA", "key"=>"usa",
            "continent"=>"north-america" ), 
            array( "name"=>"Canada", "key"=>"canada",
            "continent"=>"north-america" ), 
            array("name"=>"China", "key"=>"china",
            "continent"=>"asia" ), 
            array( "name"=>"South Africa", "key"=>"south-africa",
            "continent"=>"africe" ),
            array("name"=>"Unitad Kingdom", "key"=>"uk",
            "continent"=>"europe" ), 
            array("name"=>"Beligium", "key"=>"beligium",
            "continent"=>"europe" ), 
            ); 
            $operators = array(
                array(
                    "name"=>"Orange",
                    "country"=>"uk"
                ),
                array(
                    "name"=>"Mobistar",
                    "country"=>"beligium"
                ),
                array(
                    "name"=>"Belgacom",
                    "country"=>"beligium"
                ),
                array(
                    "name"=>"T-Mobile",
                    "country"=>"uk"
                ),
            );
            $bundles = array( 
                array( 
                    "country"=>"uganda", 
                    "price"=>"500 Rwf",
                    "resources"=>"7 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"usa", 
                    "price"=>"500 Rwf",
                    "resources"=>"7 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"uganda", 
                    "price"=>"1,000 Rwf",
                    "resources"=>"13 min",
                    "validity"=>"24 Hrs"
                ), 
                array( 
                    "country"=>"uganda", 
                    "price"=>"3,000 Rwf",
                    "resources"=>"43 min",
                    "validity"=>"24 Hrs"
                ), 
                array( 
                    "country"=>"uganda", 
                    "price"=>"5,000 Rwf",
                    "resources"=>"71 min",
                    "validity"=>"24 Hrs"
                ),
                array( 
                    "country"=>"kenya", 
                    "price"=>"5,000 Rwf",
                    "resources"=>"71 min",
                    "validity"=>"24 Hrs"
                ), 
                array( 
                    "country"=>"beligium", 
                    "price"=>"1,100 Rwf",
                    "resources"=>"50 MB",
                    "validity"=>"3 Days"
                ), 
                array( 
                    "country"=>"beligium", 
                    "price"=>"2,200 Rwf",
                    "resources"=>"100 MB",
                    "validity"=>"3 Days"
                ),
                array( 
                    "country"=>"uk", 
                    "price"=>"14,00 Rwf",
                    "resources"=>"400 MB",
                    "validity"=>"3 Days"
                ), 
            );
    ?>

        <div class="col-md-12">
            <div class="container">
                <div class="navigator-countries">
                    <?php
                    $counter = 0;
                    foreach($continents as $continent)
                    {
                    ?>
                        <a class="navigator-country <?php echo $counter == 0 ? 'active-filter':'';?>" data-filter="<?=$continent['key']?>">
                            <?=$continent['name']?>
                        </a>
                        <?php
                        $counter++;
                    } ?>
                </div>

                <div class="bundles-section">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                        <?php
                    $couter = 0;
                    foreach($countries as $country)
                    {
                    ?>
                    
                            <div class="col-md-6 bundle-contents <?=$country['continent']?>" style="display: none;">
                                <div class="bundles">
                                    <table class="table">
                                        <thead>
                                            <div class="country-name">
                                                <h3>
                                                    <?=$country['name']?>
                                                </h3>
                                            </div>

                                            <div class="d-flex" style="margin: 10px;">
                                                <div class="col-md-3">
                                                    <h4>Operators</h4>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="operators">
                                                        <?php
                                                    foreach($operators as $operator)
                                                {
                                                    if($operator['country'] != $country['key']) continue;
                                                    ?>
                                                        <span class=""><?=$operator['name']?></span>
                                                        <?php
                    }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Price</th>
                                                <th>Resources</th>
                                                <th>Validity</th>
                                            </tr>
                                            <?php
                                                $couter = 0;
                                                foreach($bundles as $bundle)
                                                {
                                                    if($bundle['country'] != $country['key']) continue;
                                                ?>
                                                <tr class="bundle">
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
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                    }
                    ?>
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
            var header = document.querySelector(".navigator-countries");
            var btns = header.getElementsByClassName("navigator-country");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active-filter");
                    current[0].className = current[0].className.replace(" active-filter", "");
                    this.className += " active-filter";
                });
            }

            var value = $(".active-filter").attr("data-filter");
            $(".bundle-contents").not('.' + value).hide('1000');
            $('.bundle-contents').filter('.' + value).show('3000');

            $(".navigator-country").click(function() {
                var value = $(this).attr("data-filter");


                $(".bundle-contents").not('.' + value).hide('1000');
                $('.bundle-contents').filter('.' + value).show('3000');

            });
        })(jQuery);
        </script>
            <?php
    }
}
