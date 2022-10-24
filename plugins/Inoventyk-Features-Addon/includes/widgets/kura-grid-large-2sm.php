<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 * @since   1.33.0
 */
namespace INO_FEATURES\Widgets;

use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;


if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Kura_grid_large_2sm')) {
    class Kura_grid_large_2sm  extends \Elementor\Widget_Base
    {

        private $ksettings = null;


        public function get_name()
        {
            return 'Large post block with 2 smalls';
        }

        public function get_title()
        {
            return esc_html__('Large post block with 2 small', 'kura');
        }

        public function get_icon()
        {
            return 'eicon-code';
        }

        public function get_categories()
        {
            return ['basic'];
        }

     
        /**
         * Render widget output on the frontend.
         *
         * Written in PHP and used to generate the final HTML.
         *
         * @since 1.0.1
         * @access protected
         */
        protected function render()
        {
            $args = array(
                'post_type' => 'post',
                'posts_per_page'    =>  5,
            );

            $posts = bru_posts($args);

            if (isset($posts[0])) {
                 ?>

                <div class="kura-post-section-l2sm container text-white">
                    <div class="image-cards row container row-eq-height">
                        <div class="col-sm-6 left-col" style="background-image: url(<?php echo $posts[0]['thumbnail']; ?>);">
                            <div class="overlay"></div>
                            <div class="k-details">
                                <a class="font-primary text-white" href="<?php echo $posts[0]['post-link']; ?>">
                                    <h3 class="text-white"><?php echo $posts[0]['title']; ?>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 right-col">
                            <?php foreach (range(1, 2) as $index) {
                                if (isset($posts[$index])) {
                            ?>

                                    <div class="container" style="background-image: url(<?php echo $posts[$index]['thumbnail']; ?>)">
                                        <div class="overlay"></div>
                                        <div class="k-details">
                                            <a href="<?php echo $posts[$index]['post-link']; ?>">
                                                <h3 class="font-secondary text-white"><?php echo $posts[$index]['title']; ?></h3>
                                            </a>
                                            <p class="font-text"><?php echo $posts[$index]['excerpt']; ?></p>
                                        </div>
                                    </div>
                            <?php }
                            }  ?>
                        </div>
                    </div>
                </div>

            <?php
            } else { ?>
                <span> No Posts</span>
<?php }
        }
    }
} // End if class_exists check.
