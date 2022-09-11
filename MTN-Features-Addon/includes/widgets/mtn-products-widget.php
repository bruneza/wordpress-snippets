<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Products_Carousel  extends \Elementor\Widget_Base
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
			return 'Products Carousel';
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
			return esc_html__('Products Carousel', 'mtn');
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
			$posts = mtn_posts();
			$screens = array_chunk($posts,6);
			// $screens = array(
			// 	//screen 2
			// 		array(
			// 			array(
			// 				"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 				"link" => "google.com",
			// 			),
			// 			array(
			// 				"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 				"link" => "google.com",
			// 			),
			// 			array(
			// 				"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 				"link" => "google.com",
			// 			),
			// 			array(
			// 				"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 				"link" => "google.com",
			// 			),array(
			// 				"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 				"link" => "google.com",
			// 			)
			// 			),
				
			// 			//screen 2
				
			// 			array(
			// 				array(
			// 					"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 					"link" => "google.com",
			// 				),
			// 				array(
			// 					"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 					"link" => "google.com",
			// 				),
			// 				array(
			// 					"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 					"link" => "google.com",
			// 				),
			// 				array(
			// 					"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 					"link" => "google.com",
			// 				),array(
			// 					"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 					"link" => "google.com",
			// 				)
			// 				),
				
			// 				//screen 3
			// 				array(
			// 					array(
			// 						"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 						"link" => "google.com",
			// 					),
			// 					array(
			// 						"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 						"link" => "google.com",
			// 					),
			// 					array(
			// 						"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 						"link" => "google.com",
			// 					),
			// 					array(
			// 						"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 						"link" => "google.com",
			// 					),array(
			// 						"image" => "https://mtn.inoventyk.rw/wp-content/uploads/2022/09/MTN_SME_473699302.jpg",
			// 						"link" => "google.com",
			// 					)
			// 					),
					
			// 	);
			// $settings = $this->get_settings_for_display();
			/*** Start Content Section ***/
			echo '
			<div class="title-section" >
				<div><h3 class="deal-tital">Products</h3></div>
				<button class="deal-btn">All Products</button>
      		</div>
		  <div class="mtn-products-carousel-section d-flex services-item owl-carousel products-carousel owl-theme" style="margin:60px 0">';
            // Code GOES HERE
			
          foreach ($screens as $screen)
          {
			print_r($screen);
            ?>
			<div class="col-md-12">
            <div class="row main-galery">
                <div class="col-md-4">
                    <div class="col">
                        <div class="col-md-12">
                            <a hre="<?=$screen[0]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[0]['thumbnail']?>;?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                    
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a hre="<?=$screen[1]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[1]['thumbnail'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                
                            </a> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <a  hre="<?=$screen[2]['post-link'];?>" class="full-imgs" style="background-image: url('<?=$screen[2]['thumb'];?>'); 
                        background-size:cover; 
                        overflow:hidden;background-position:50% 30%;
                        display:flex;align-items:flex-end">
                                    
                    </a>
                    
                </div>

                <div class="col-md-4">
                    <div class="col">
                        <div class="col-md-12">
                            <a hre="<?=$screen[3]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[3]['thumbnail'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                    
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a hre="<?=$screen[4]['post-link'];?>" class="half-img" style="background-image: url('<?=$screen[4]['thumb'];?>'); 
                                background-size:cover; 
                                overflow:hidden;background-position:50% 30%;
                                display:flex;align-items:flex-end">
                                                
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
          </div>
			<?php
		  }
			echo '</div>';
			/*** End Content Section ***/
		}
	}