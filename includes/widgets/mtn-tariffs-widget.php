<?php

namespace MTN_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \ElementorPro\Modules\QueryControl\Controls\Group_MTN_Query;

if (!defined('ABSPATH')) {
    exit;
}

class MTN_Tariffs_Widget  extends \Elementor\Widget_Base
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
        return 'MTN Tariffs';
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
        return esc_html__('MTN Tariffs', 'mtn');
    }

    /**
     * Get widget tariff.
     *
     * Retrieve test widget tariff.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget tariff.
     */
    public function get_tariff()
    {
        return 'etariff-code';
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
            'tariff_content',
            [
                'label' => esc_html__('Tariff Content', 'mtn'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_MTN_Query::get_type(),
            [
                'name' => 'mtn_posts',
            ]
        );

        $this->end_controls_section();

        /*** Style begins here***/
    }

    // protected function validateControl($field, $switch)
    // {
    //     if ($switch == 'yes' && $field)
    //         return $field;
    //     else
    //         return false;
    // }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $termsID = $settings['mtn_posts_include_term_ids'];
        $terms = mtnTerms(array('x_terms' => $termsID));
        $selectedKeys = array();



        // print_r($terms);
        // print_r($settings['mtn_posts_include']);
        /*** Start Content Section ***/
?>
        <div class="mtn-tariff-section">

            <!-- ANCHOR: Tariff - Tab List Section -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php if (isset($terms)) {
                    foreach ($terms as $key => $value) {
                        // print_r(array_key_first($terms));
                        array_push($selectedKeys, array($key, $value['taxonomy']));
                ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if (intval($key) == array_key_first($terms))  echo 'active'; ?>" id="pills-home-<?= $key; ?>" data-bs-toggle="pill" data-bs-target="#pills-<?= $key; ?>" type="button" role="tab" aria-controls="pills-<?= $key; ?>" aria-selected="true"><?= $value['name']; ?></button>
                        </li>
                <?php
                    }
                } ?>

        </div>
        <!-- ANCHOR: Tariff - Content Section -->
        <div class="row mtn-tariff-items">

        </div>
        </div>
<?php
        /*** End Content Section ***/
    }
}
