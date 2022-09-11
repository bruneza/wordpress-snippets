<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Deals_Carousel  extends \Elementor\Widget_Base
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
			return 'Deals Carousel';
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
			return esc_html__('Deals Carousel', 'mtn');
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

		
		protected function render()
		{
			// $settings = $this->get_settings_for_display();

            $posts = mtn_posts();

			/*** Start Content Section ***/
			echo '<div class="mtn-deals-carousel-section">';
            echo '
		  <div class="title-deal" >
        <div><h3 class="deal-tital">Deals</h3></div>
        <button class="deal-btn">All deal</button>
      </div>
		  <div class="d-flex deals-item owl-carousel deal-carousel owl-theme" style="margin:60px 0">';
            foreach ($posts as $post)
          {?>
              <div class="deals filter" style="background-image: url('<?echo $post['thumbnail']; ?>'); 
              background-size:cover; height:100%; overflow:hidden; background-position:cover ; display:flex; align-items:flex-end">
                      <div class="deals-contents">
                          <a class="read-more-btn" href="<?=$post['post-link'];?>">Read More &nbsp;<i class="fa fa-angle-right"></i></a>
                      </div>
              </div>
<?php
}
			echo '</div></div>';
			/*** End Content Section ***/
		}
	}