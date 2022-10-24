<?php

/**
 * File containing the class Kura_Elementor_addon.
 *
 * @package wp-job-manager
 * @since   1.33.0
 */

namespace INO_FEATURES\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Kura_grid_large_4sm')) {
    class Kura_grid_large_4sm  extends \Elementor\Widget_Base
    {

        private $ksettings = null;


        public function get_name()
        {
            return 'Large post block with 4 smalls';
        }

        public function get_title()
        {
            return esc_html__('Large post block with 4 small', 'kura');
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

            $posts = bru_posts($args); ?>
            <div class="kura-post-section-lsm container">
                <div class="row row-eq-height">
                    <div class="col-md-3 small-col">
                        <?php foreach (range(1, 2) as $index) { ?>
                            <div class="container">
                                <img class="img-thumbnail" src="<?php echo $posts[$index]['thumbnail']; ?>" alt="<?php echo $posts[$index]['title']; ?>">
                                <div class="k-grid-details">
                                    <a href="<?php echo $posts[$index]['post-link']; ?>">
                                        <h3 class="heading"><?php echo $posts[$index]['title']; ?></h3>
                                    </a>
                                </div>
                            </div>
                        <?php }  ?>
                    </div>
                    <div class="col-md-6 big-col p-3" style="background-image: url(<?php echo $posts[0]['thumbnail']; ?>) ;">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="k-grid-details">
                                <a href="<?php echo $posts[0]['post-link']; ?>">
                                    <h3 class="heading"><?php echo $posts[0]['title']; ?></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 small-col">
                        <?php foreach (range(3, 4) as $index) { ?>
                            <div class="container">
                                <img class="img-thumbnail" src="<?php echo $posts[$index]['thumbnail']; ?>" alt="<?php echo $posts[$index]['title']; ?>">
                                <div class="k-grid-details">
                                    <a href="<?php echo $posts[$index]['post-link']; ?>">
                                        <h3 class="heading"><?php echo $posts[$index]['title']; ?></h3>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
<?php
        }
    }
} // End if class_exists check.
