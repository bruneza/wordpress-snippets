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

        number_control($this, 'grid_num_posts', 'Number of Posts', '-1');


        column_number_control($this, 'num_of_col', $count_to_ten, $default = 3);

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
        $selectedKeys = array();

        $icon = processIcon($settings);

        $terms = mtn_get_terms($postType, $settings);

        echo '<div class="mtn-posts-filter-section">'; ?>

        <?php if (!empty($terms)) {
            $i = 0; ?>
            <ul class="nav nav-pills posts-filter mb-3" id="pills-tab" role="tablist">

                <?php foreach ($terms as $key => $value) {
                    array_push($selectedKeys, array($value['id'], $key)); ?>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ($i == 0) echo 'active'; ?>" id="pills-<?= $key; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $key; ?>" role="tab" aria-controls="pills-<?= $key; ?>" aria-selected="<?= $key; ?>">
                            <?php if ($icon) echo $icon[$i]; ?>
                            <span class="filter-tab-title"><?= $value['name']; ?></span>
                        </a>
                    </li>

                <?php
                    $i++;
                } ?>
            </ul>
        <?php } ?>
        <div class="tab-content post-filter-content" id="pills-tabContent">
            <?php
            foreach ($selectedKeys as $key => $value) {
            ?>

                <div class="tab-pane show <?php if ($key == 0) echo 'active'; ?>" id="pills-<?= $value[1]; ?>" role="tabpanel" aria-labelledby="pills-<?= $value[1]; ?>-tab">
                    <div class="row">

                        <?php $settings['mtn_posts_include_term_ids'] = array($value[0]);

                        $posts = postsRender(null,$settings);
                        if (isset($posts)) {
                            foreach ($posts as $post) {
                        ?>
                                <div class="col-md-<?= intval(12 / $settings['num_of_col']); ?> post-card">
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
                    <div class="post-call-to-action">
                        <a href="<?php echo $terms[$value[1]]['term-link']; ?>">View Solution</a>
                    </div>
                </div>

            <?php
            } ?>
        </div>

<?php
        echo '</div>';
    }
}
