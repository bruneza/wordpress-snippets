<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Device_Filter1  extends \Elementor\Widget_Base
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
		return 'Device Filter01';
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
		return esc_html__('Device Filter01', 'mtn');
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

        number_control($this, 'grid_num_posts', 'Number of Posts', '-1');


        count_ten_control($this,'Number of Columns', 'num_of_col', 3);

        heading_control($this, 'icon_section', 'Icons');

        $repeater = new \Elementor\Repeater();

        icon_control($repeater, 'filter_selected_icon', 'Icon');


        $this->add_control(
            'filter_icons',
            [
                'label' => esc_html__('Items', 'mtn'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'filter_icons_Title' => esc_html__('List Item', 'mtn'),
                        'filter_selected_icon' => [
                            'value' => 'fas fa-times',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, filter_selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}',
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
        /*** Style begins here***/

        $this->start_controls_section(
            'Layout_style',
            [
                'label' => esc_html__('Layout Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        border_radius_control($this, 'grid_border_radius', '.post-wrapper');
        space_between_control($this, 'space_between',null, '.post-card', 20);
        padding_control($this, 'grid_padding', 'Content Padding', '.post-content');
        slider_control($this, 'grid_height', 'Grid Height', array('.post-wrapper', 'height'), 350);
        background_control($this, 'backgroud_overlay', 'Overlay', '.post-content');

        $this->end_controls_section();

        $this->start_controls_section(
            'Filter_style',
            [
                'label' => esc_html__('Filter Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        slider_control($this, 'filter_tab_height', 'Tab Height', array('.posts-filter .nav-link', 'height'), 80, array('max-px' => 200));
        slider_control($this, 'filter_tab_width', 'Tab Width', array('.posts-filter .nav-link', 'width'), 80, array('max-px' => 200));


        space_between_control($this, 'tab_space_between',null, '.nav-item', 20);

        typography_control($this, 'filter_title_typography', '.nav-link');


        slider_control($this, 'filter_svg_size', 'SVG Icon Size', array('.nav-link svg', 'width'), 30, array('max-px' => 200));

        slider_control($this, 'filter_icon_size', 'Icon Font Size', array('.nav-link i', 'font-size'), 30, array('max-px' => 200));

        // NORMAL STATE
        $this->start_controls_tabs(
            'filter_btn_tabs'
        );

        $this->start_controls_tab(
            'filter_normal_tab',
            [
                'label' => esc_html__('Normal', 'mtn'),
            ]
        );


        heading_control($this, 'fitler_btn_heading', 'Button pill');
        border_control($this, 'filter_btn_border', 'Border', '.nav-link');

        background_control($this, 'filter_btn_background', 'Button Background', '.nav-link');

        heading_control($this, 'fitler_title_heading', 'Tab Content');

        color_control($this, 'fitler_title_color', 'Color', '.nav-link');

        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'filter_hover_tab',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]
        );


        heading_control($this, 'fitler_btn_heading_hover', 'Button pill');

        border_control($this, 'filter_btn_border_hover', 'Border', '.nav-link:hover');


        background_control($this, 'filter_btn_background_hover', 'Background', '.nav-link:hover');



        heading_control($this, 'fitler_title_heading_hover', 'Tab Content');

        color_control($this, 'fitler_title_color_hover', 'Color', '.nav-link:hover');

        $this->end_controls_tab();

        // ACTIVE STATE
        $this->start_controls_tab(
            'filter_active_tab',
            [
                'label' => esc_html__('Active', 'mtn'),
            ]
        );

        heading_control($this, 'fitler_btn_heading_active', 'Button pill');

        border_control($this, 'filter_btn_border_active', 'Border', '.nav-link.active');
        background_control($this, 'filter_btn_background_active', 'Button Background', '.nav-link.active');


        heading_control($this, 'fitler_title_heading_active', 'Tab Content');
        color_control($this, 'fitler_title_color_active', 'Color', '.nav-link.active');

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->end_controls_section();
        $this->start_controls_section(
            'Content_style',
            [
                'label' => esc_html__('Content Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        heading_control($this, 'title_heading', 'Title');

        color_control($this, 'title_color', 'title_color', 'h4.post-title');

        typography_control($this, 'title_typography', 'h4.post-title');


        heading_control($this, 'readmore_heading', 'Read More Button');


        border_radius_control($this, 'btn_border_radius', '.post-readmore');

        typography_control($this, 'btn_typography', '.post-readmore');


        padding_control($this, 'btn_padding', $label = 'Padding', '.post-readmore');

        // NORMAL STATE
        $this->start_controls_tabs(
            'style_btn_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'mtn'),
            ]
        );

        color_control($this, 'btn_color', 'Color', '.post-readmore');
        border_control($this, 'btn_border', 'Border', '.post-readmore');
        background_control($this, 'btn_background', 'Background', '.post-readmore');
        
        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]
        );
        color_control($this, 'btn_hover_color', 'Color', '.post-readmore:hover');
        border_control($this, 'btn_hover_border', 'Border', '.post-readmore:hover');
        background_control($this, 'btn_hover_background', 'Background', '.post-readmore:hover');
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function render()
	{
		$settings = $this->get_settings_for_display();

		$postType = getPostType($settings);
		$terms = mtnTerms($postType);
		// print_r($terms);
        foreach($terms as $key => $taxonomy)
            $category =  $key;

		$posts = postsRender($settings);

        $brands =array();
        $categories =array();
        
        foreach($posts as $postTypes)
        {
        //    print_r($post['product_type']);


        if (is_array($postTypes['product_type']) || is_object($postTypes['product_type']))
            {
                foreach ($postTypes['product_type'] as $key => $value)
                {
                    array_push($categories,$value);
                }
            }


           
        } 
            

        foreach($posts as $postBrand)
            {
                if (is_array($postBrand['product_brand']) || is_object($postBrand['product_brand']))
                {
                    foreach ($postBrand['product_brand'] as $key => $value)
                    {
                        array_push($brands,$value);
                    }
                }
            }
		
?>

		<div class="col-md-12">
            <div class="col">
                <div class="filter-section">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="d-flex" style="gap:20px">
                                <div class="filter-first-btn">
                                    <select class="filter-one">
                                        <option value="all">
                                            Select Brand
                                        </option>
										<?php
										foreach($brands as $key => $brand)
										{?>
											<option value="<?=$brand['slug']?>"><?=$brand['name']?></option>
											<?php
										}
										?>
                                        
                                    </select>
                                </div>

                                <div class="filter-scnd-btn">
                                    <select class="filter-two">
                                        <option value="all-category" class="all-category">Select Category</option>
                                        
										<?php
										foreach($categories as $key => $category)
										{                     
                                            ?>
                                            <option value="<?=$category['name']?>" class="category <?=$category['name']?>"><?=$category['name']?></option>
											<?php
										}
										?>
                                        
                                    </select>
                                </div>
								

                            </div>
                        </div>
                    </div>


                </div>

                <div class="business-item-section">
                    <div class="row" id="category-items">
					<?php
						foreach($posts as $product)
					{
                        
                        if (is_array($product['product_brand']) || is_object($product['product_brand']))
                        {
                            foreach ($product['product_brand'] as $key => $value)
                                $brand = $value['slug'];
                            
                        }
                        else
                        $brand = "";

                        if (is_array($product['product_type']) || is_object($product['product_type']))
                        {
                            foreach ($product['product_type'] as $keys => $product_type)
                                $category = $product_type['name'];
                            
                        }
                        else
                        $category = "";
                               ?>
                        <div class="col-md-4 filter categories <?=$brand?> <?=$category?>">
                            <div class="deals-item">
                                <div class="d-flex">
                                    <div class="col-md-4">
                                        <img src="<?=$product['thumbnail']?>" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="bottom-section">
                                    <div class="btm-upper-section">
                                        <h3><?=$product['title']?></h3>
                                        <h1><?=$product['regular_price']?></h1>
                                    </div>
                                    <hr>
                                    <div class="btm-down-section row">
                                        <p><?=$product['warant_fee']?></p>
                                        <a href="<?=$product['post-link']?>" class="deal-items-icon">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
							}
						?>

                    </div>
                </div>

				<div class="col-md-12">
                            <div class="see-all-btn">
                                <a href="" class="">Load More</a>
                            </div>
                        </div>

            </div>
        </div>
		<?php
    }
}