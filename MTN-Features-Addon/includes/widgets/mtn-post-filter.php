<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Posts_Filter extends \Elementor\Widget_Base
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
        return 'Posts Filter';
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
        return esc_html__('Posts Filter', 'mtn');
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
        $this->add_control(
			'num_of_col',
            column_number_control($count_to_ten, $default = 3)
        );

        $this->add_control(
            'icon_section',
            heading_control('Icons')
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'filter_selected_icon',
			icon_control('Icon')
		);


        $this->add_control(
			'filter_icons',
			[
				'label' => esc_html__( 'Items', 'mtn' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'filter_icons_Title' => esc_html__( 'List Item', 'mtn' ),
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

        $this->add_responsive_control(
            'grid_border_radius',
            border_radius_control('.post-wrapper')
        );

        $this->add_responsive_control(
            'space_between',
            space_between_control('.post-card',20)
        );

        $this->add_responsive_control(
            'grid_padding',
            padding_control($label = 'Content Padding', '.post-wrapper')
        );

        $this->add_responsive_control(
			'grid_height',
			height_control('Grid Height', '.post-wrapper', 350)
		);
    
        $this->end_controls_section();

        $this->start_controls_section(
            'Filter_style',
            [
                'label' => esc_html__('Filter Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // NORMAL STATE
        $this->start_controls_tabs(
            'filter_btn_tabs'
        );
        
        $this->start_controls_tab(
            'filter_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'mtn' ),
            ]
        );

        $this->add_control(
			'fitler_btn_heading',
            heading_control('Button pill')
		);
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            border_control('filter_btn_border', 'Border', '.nav-link')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            background_control('filter_btn_background', '.nav-link')
        );

        $this->add_control(
			'fitler_title_heading',
            heading_control('Title')
		);

        $this->add_control(
            'fitler_title_color',
            color_control('.nav-link')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            typography_control('filter_title_typography','.nav-link')
        );
    

        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'filter_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'mtn' ),
            ]
        );


        $this->end_controls_tab();

        // ACTIVE STATE
        $this->start_controls_tab(
            'filter_active_tab',
            [
                'label' => esc_html__( 'Hover', 'mtn' ),
            ]
        );


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

        $this->add_control(
			'title_heading',
            heading_control('Title')
		);

        $this->add_control(
            'title_color',
            color_control('h4.post-title')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            typography_control('title_typography','h4.post-title')
        );

        $this->add_control(
			'readmore_heading',
			heading_control('Read More Button')
		);

        $this->add_responsive_control(
            'btn_border_radius',
            border_radius_control('.post-readmore')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            typography_control('btn_typography','.post-readmore')
        );

        $this->add_responsive_control(
            'btn_padding',
            padding_control($label = 'Padding', '.post-readmore')
        );
        // NORMAL STATE
        $this->start_controls_tabs(
            'style_btn_tabs'
        );
        
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'mtn' ),
            ]
        );
        $this->add_control(
            'btn_color',
            color_control('.post-readmore')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            border_control('btn_border', 'Border', '.post-readmore')
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            background_control('btn_background', '.post-readmore')
        );

        $this->end_controls_tab();
        // HOVER STATE;
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'mtn' ),
            ]
        );
        $this->add_control(
            'btn_hover_color',
            color_control('.post-readmore:hover')
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            border_control('btn_hover_border', 'Border', '.post-readmore:hover')
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            background_control('btn_hover_background', '.post-readmore:hover')
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function processIcon($settings){
        /*filter_selected_icon
filter_icons*/
        // print_r($settings['filter_icons']);

        foreach($settings['filter_icons'] as $item){
            // $library = $item['library'];
            // $url = $item['url'];
            print_r($item);

        }
    }
    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $postType = getPostType($settings);
        $selectedKeys = array();

        $this->processIcon($settings);


        $terms = mtn_get_terms($postType, $settings);

        echo '<div class="mtn-posts-filter-section">'; ?>

        <?php if (!empty($terms)) {
            $i = 0; ?>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                <?php foreach ($terms as $key => $value) {
                    array_push($selectedKeys, array($value['id'], $key)); ?>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ($i == 0) echo 'active'; ?>" id="pills-<?= $key; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $key; ?>" role="tab" aria-controls="pills-<?= $key; ?>" aria-selected="<?= $key; ?>">
                            <span class="filter-tab-title"><?= $value['name']; ?></span>
                        </a>
                    </li>

                <?php
                    $i++;
                } ?>
            </ul>
        <?php } ?>
        <div class="tab-content" id="pills-tabContent">
            <?php
            foreach ($selectedKeys as $key => $value) {
            ?>

                <div class="tab-pane show <?php if ($key == 0) echo 'active'; ?>" id="pills-<?= $value[1]; ?>" role="tabpanel" aria-labelledby="pills-<?= $value[1]; ?>-tab">
                    <div class="row">
                        
                        <?php $settings['mtn_posts_include_term_ids'] = array($value[0]);

                        $posts = postsRender($settings);
                        if (isset($posts)) {
                            foreach ($posts as $post) {
                        ?>
                                <div class="col-md-<?=intval(12 / $settings['num_of_col']); ?> post-card">
                                    <div class="post-wrapper" style="background-image: url(<?= $post['thumbnail']; ?>);">
                                        <div class="post-content">
                                            <h4 class="post-title"><?= $post['title']; ?></h4>
                                            <a href="<?= $post['post-link']; ?>" class="post-readmore">Read More</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>

            <?php
            } ?>
        </div>

<?php
        echo '</div>';
    }
}
