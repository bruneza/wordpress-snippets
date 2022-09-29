<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
	exit;
}

class MTN_Single_Faqs  extends \Elementor\Widget_Base
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
		return 'Single Faqs';
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
		return esc_html__('Single Faqs', 'mtn');
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

        number_control($this, 'num_of_posts', ['default' => 5, 'label' => 'Number of Posts']);
        number_control($this, 'num_of_columns', ['default' => 3, 'label' => 'Number of Columns']);
        text_control($this, 'view_more_btn', ['label' =>'View More Button']);
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
        /////STYLESSS

        $this->start_controls_section(
            'grid_Style',
            [
                'label' => esc_html__('FAQ Grid Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        space_between_control($this,'grid_space_between', '.faq-column', ['default' => 20]);
        padding_control($this, 'grid_padding', '.faq-wrapper', ['label' => 'Grid Padding']);
        box_shadow_control($this, '.faq-wrapper', ['label' => 'Box Shadow']);
        border_radius_control($this, 'grid_border_radius', '.faq-wrapper');

        $this->end_controls_section();

        $this->start_controls_section(
            'haq_header_Style',
            [
                'label' => esc_html__('FAQ Header Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        padding_control($this, 'heading_padding', 'Heading Padding', '.faq-header');
        border_radius_control($this, 'heading_border_radius', '.faq-header');
        typography_control($this, 'header_typography', '.faq-header h4');
        
        color_control($this, 'heading_color', '.faq-header h4',['label' => 'Heading Color']);
        heading_control($this,'header_bg',['label' => 'Background']);
        background_control($this, 'header_background', '.faq-header', ['label' => 'Background']);
        
        $this->end_controls_section();
        $this->start_controls_section(
            'item_Style',
            [
                'label' => esc_html__('FAQ Items Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        vertical_spacing_control($this,'item_space_between','.faq-item', ['default' => 20]);
        padding_control($this, 'item_padding', '.faq-items', ['label' => 'Item Padding']);
        heading_control($this,'title_heading',['label' => 'Title']);
        typography_control($this, 'item_header_typography', 'a.faq-item');

        $this->start_controls_tabs(
			'faq_item_state'
		);
        // NORMAL STATE
		$this->start_controls_tab(
			'item_normal_state',
			[
				'label' => esc_html__('Normal', 'mtn'),
			]

		);
        color_control($this, 'item_color', 'a.faq-item', ['label' => 'Heading Color']);
        heading_control($this,'item_header_bg',['label' => 'Background']);
        background_control($this, 'item_background', '.faq-item', ['label' => 'Background']);
        border_control($this,'item_border', '.faq-item', ['label' => 'Border']);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'item_hover_state',
			[
				'label' => esc_html__('Hover', 'mtn'),
			]

		);
        color_control($this, 'item_color_hover', 'a.faq-item:hover',['label' => 'Heading Color']);
        heading_control($this,'item_header_bg_hover',['label' => 'Background']);
        background_control($this, 'item_background_hover', '.faq-item:hover', ['label' => 'Background']);
        border_control($this,'item_border_hover', '.faq-item:hover', ['label' => 'Border']);

        $this->end_controls_tab();
		$this->end_controls_tabs();


        $this->end_controls_section();
        $this->start_controls_section(
            'btn_Style',
            [
                'label' => esc_html__('View All Button Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
	{
        $post_id = get_the_id();
        $cat_ids = array();
        $categories = get_the_category( $post_id );
        

        if ( $categories && ! is_wp_error( $categories ) ) {
         
            foreach ( $categories as $category ) {
         
                array_push( $cat_ids, $category->term_id );
         
            }
             
        }
        
        $current_post_type = get_post_type( $post_id );

       

        $args = array(
            'category__in' => $cat_ids,
            'post_type' => $current_post_type,
            'posts_per_page' => '-1',
            'post__not_in' => array( $current_post_type )
        );
        
        



		
?>
<div class="mtn-accordion-section">
    <div class="mtn-accordion-row row">
        <div class="nav flex-column nav-pills col-md col-sm-12 section-navigator mb-sm-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
            <button class="accordion-tab-btn nav-link">
                <span class="back-btn" href="javascript:void(0)" onclick="history.back()">
                    <i class="fa fa-angle-left"></i>&nbsp; Go Back
                </span>
            </button>
            <?php

            
                
                $query = new \WP_Query($args);
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        
            ?>
                        
                        <button class="accordion-tab-btn nav-link <?php if (get_the_id() == $post_id) echo 'active'; ?>" id="v-pills-<?php the_id(); ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php the_id(); ?>" type="button" role="tab" aria-controls="v-pills-<?php the_id(); ?>" <?php get_the_id() == $post_id ? 'aria-selected="true"' : 'aria-selected="false"'; ?>>
                                        <span><?php the_title()?></span>
                                    </button>
                        <?php
                    }
                }

            ?>
		</div>

        <div class="tab-content mtn-accordion-content col-md-8 col-sm-12" id="v-pills-tabContent">
            <?php
            $counter = 1;
            $query = new \WP_Query($args);
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <div class="tab-pane fade <?php if (get_the_id() == $post_id) echo 'show active'; ?>" id="v-pills-<?php the_id(); ?>" role="tabpanel" aria-labelledby="v-pills-<?php the_id(); ?>-tab">
                        <?php the_content();?>
					</div>
                    <?php
                }
            }?>
		</div>

        

    </div>
</div>

		<?php
    }
}