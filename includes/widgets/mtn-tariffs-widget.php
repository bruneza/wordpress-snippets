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

        $this->add_control(
            'grid_fields_heading',
            [
                'label' => esc_html__('Choose Fields', 'mtn'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'choose_grid_fields',
            [
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => processOutput()['fields'],
                'default' => ['thumbnail', 'post-link']
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
        $selectedKeys = array();

        if ($settings['choose_grid_fields'])
            $neededFields =  $settings['choose_grid_fields'];
        else
            $neededFields =  ['title'];

        $mtnSettings = [
            'x_posts_per_page' => $settings['mtn_posts_posts_per_page'],
            'x_terms' => $settings['mtn_posts_include_term_ids'],
            'x_show' => 'first_term',
            'x_outputs' => $neededFields,
        ];
        $terms = mtnTerms($mtnSettings);
        if ($settings['mtn_posts_post_type'] == 'mtn-query')
            $mtnSettings['x_post_type']  = get_taxonomy_by_term($terms);
        else
            $mtnSettings['x_post_type']  = $settings['mtn_posts_post_type'];

        $posts = postsRender($mtnSettings);

        /*** Start Content Section ***/
?>
        <div class="mtn-tariff-section">

            <!-- ANCHOR: Tariff - Tab List Section -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php if (isset($terms)) {
                    foreach ($terms as $key => $value) {

                        array_push($selectedKeys, array($key, $value['taxonomy'], $value['slug']));
                        if (array_key_first($terms) === $key) {
                ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-all" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-home-<?= $key; ?>" data-bs-toggle="pill" data-bs-target="#pills-<?= $key; ?>" type="button" role="tab" aria-controls="pills-<?= $key; ?>" aria-selected="true"><?= $value['name']; ?></button>
                            </li>
                <?php
                        }
                    }
                } ?>
            </ul>
            <!-- ANCHOR: Tariff - Content Section -->
            <div class="tab-content" id="pills-tabContent">
                <?php
                foreach ($selectedKeys as $key => $value) {
                    $result = filterArray($posts,  $value[0]);
                ?>
                    <div class="mtn-tariff-items tab-pane fade show <?php if ($key == 0) echo 'active'; ?>" id="pills-<?= ($key == 0) ? 'all' : $value[0]; ?>" role="tabpanel" aria-labelledby="pills-<?= ($key == 0) ? 'all' : $value[0]; ?>-tab">

                        <div class="mtn-tariff-item card-section">
                            <?php

                            foreach ($result['posts'] as $post) {
                                

                                $packageValidity = xgetValidity($post)['validity'];
                            ?>
                                <div class="bundle-card">
                                    <!-- <div class="card-header">xxxx</div> -->
                                    <div class="tariff-price">
                                        <h5>Price</h5>
                                        <p><?= $post['tariff_infos']['price']; ?> Rwf</p>
                                    </div>
                                    <hr>
                                    <div class="tariff-ressources">
                                        <h5>Ressources</h5>
                                    </div>
                                    <p><?= $post['tariff_infos']['ressources']; ?></p>
                                    <hr>
                                    <div class="tariff-validity">
                                        <h5>Validity</h5>
                                    </div>
                                    <p><?= $packageValidity; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
<?php /*** End Content Section ***/
    }
}
