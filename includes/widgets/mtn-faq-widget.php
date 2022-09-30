<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Faqs  extends \Elementor\Widget_Base
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
        return 'MTN Faqs';
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
        return esc_html__('MTN Faqs', 'mtn');
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

        $this->add_control(
            'num_of_posts',
            [
                'label' => esc_html__('Number of Posts', 'textdomain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'num_of_columns',
            [
                'label' => esc_html__('Number of Columns', 'textdomain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        text_control($this, 'view_more_btn', ['label' => 'View More Button']);
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

        space_between_control($this, 'grid_space_between', '.faq-column', ['default' => 20]);
        padding_control($this, 'grid_padding', '.faq-wrapper', ['label' => 'Grid Padding']);
        box_shadow_control($this, 'Box Shadow', '.faq-wrapper');
        border_radius_control($this, 'grid_border_radius', '.faq-wrapper');

        $this->end_controls_section();

        $this->start_controls_section(
            'haq_header_Style',
            [
                'label' => esc_html__('FAQ Header Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        padding_control($this, 'heading_padding', '.faq-header', ['label' => 'Heading Padding']);
        border_radius_control($this, 'heading_border_radius', '.faq-header');
        typography_control($this, 'header_typography', '.faq-header h4');

        color_control($this, 'heading_color', '.faq-header h4', ['label' => 'Heading Color']);
        heading_control($this, 'header_bg', ['label' => 'Background']);
        background_control($this, 'header_background', '.faq-header', ['label' => 'Background']);

        $this->end_controls_section();
        $this->start_controls_section(
            'item_Style',
            [
                'label' => esc_html__('FAQ Items Style', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        vertical_spacing_control($this, 'item_space_between', '.faq-item', ['default' => 20]);
        padding_control($this, 'item_padding', '.faq-items', ['label' => 'Item Padding']);
        heading_control($this, 'title_heading', ['label' => 'Title']);
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
        heading_control($this, 'item_header_bg', ['label' => 'Background']);
        background_control($this, 'item_background', '.faq-item',  ['label' => 'Background']);
        border_control($this, 'item_border', '.faq-item',  ['label' => 'Border']);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_hover_state',
            [
                'label' => esc_html__('Hover', 'mtn'),
            ]

        );
        color_control($this, 'item_color_hover', 'a.faq-item:hover',  ['label' => 'Heading Color']);
        heading_control($this, 'item_header_bg_hover',  ['label' => 'Background']);
        background_control($this, 'item_background_hover', '.faq-item:hover',   ['label' => 'Background']);
        border_control($this, 'item_border_hover', '.faq-item:hover',   ['label' => 'Border']);

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
        $settings = $this->get_settings_for_display();
        $postType = $settings['mtn_posts_post_type'] = 'mtn_faqs';
        $terms = mtnTerms($postType, 'mtn_faq_category');
        $colNum = intval(12 / $settings['num_of_columns']);


        echo '<div class="mtn-faq-section">';
        echo '<div class="row faq-row">';

        foreach ($terms as $key => $term) {
?>
            <div class="faq-column col-md-<?= $colNum; ?> col-sm-12">
                <div class="faq-wrapper">
                    <div class="faq-header">
                        <h4><?= $term['name']; ?></h4>
                    </div>
                    <div class="faq-items  vertical-space">
                        <?php
                        $settings['mtn_posts_include_term_ids'] = array($key);
                        $posts = postsRender($settings);

                        foreach ($posts as $post) {
                        ?>
                            <a href="<?= $post['post-link']; ?>" class="faq-item"><?= $post['title']; ?></a>
                        <?php } ?>
                    </div>
                    <div class="faq-all-btn">
                        <a href="<?= $term['term-link']; ?>"><?= $settings['view_more_btn']; ?></a>
                    </div>
                </div>
            </div>


<?php
        }
        echo '</div>';
        echo '</div>';
    }
}
