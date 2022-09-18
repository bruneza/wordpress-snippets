<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Level_Up  extends \Elementor\Widget_Base
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
			return 'Level Up';
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
			return esc_html__('Level Up', 'mtn');
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

            $levelUps = array(
array(
    "title"=>"Get Started",
    "desc" => "Many small start-ups barely have enough capacity to make it through the first year successfully and lack funds for communication or advertising their businesses. 

    The successful launch and roll out of Level Up Your Business Season 1 in 2021 saw 6 youth led local SMEs receive intensive business skills training sessions, communication and advertising platforms, with the top 3 walking away with seed capital to support their businesses.
    
    This year, MTN Rwanda has once again partnered with Inkomoko Entrepreneur Development and seeks to support promising youth-led SMEs/start-ups in Rwanda in the second season of Level up Your Biz.",
    "handle"=>"start"
),
array(
    "title"=>"About Level Up Your Biz",
    "desc" => "Many small start-ups barely have enough capacity to make it through the first year successfully and lack funds for communication or advertising their businesses. 

    The successful launch and roll out of Level Up Your Business Season 1 in 2021 saw 6 youth led local SMEs receive intensive business skills training sessions, communication and advertising platforms, with the top 3 walking away with seed capital to support their businesses.
    
    This year, MTN Rwanda has once again partnered with Inkomoko Entrepreneur Development and seeks to support promising youth-led SMEs/start-ups in Rwanda in the second season of Level up Your Biz.",
    "handle"=>"about"
),
array(
    "title"=>"Benefits",
    "desc" => "Many small start-ups barely have enough capacity to make it through the first year successfully and lack funds for communication or advertising their businesses. 

    The successful launch and roll out of Level Up Your Business Season 1 in 2021 saw 6 youth led local SMEs receive intensive business skills training sessions, communication and advertising platforms, with the top 3 walking away with seed capital to support their businesses.
    
    This year, MTN Rwanda has once again partnered with Inkomoko Entrepreneur Development and seeks to support promising youth-led SMEs/start-ups in Rwanda in the second season of Level up Your Biz.",
    "handle"=>"Benefits "
),
array(
    "title"=>"Application Eligibility",
    "desc" => "Many small start-ups barely have enough capacity to make it through the first year successfully and lack funds for communication or advertising their businesses. 

    The successful launch and roll out of Level Up Your Business Season 1 in 2021 saw 6 youth led local SMEs receive intensive business skills training sessions, communication and advertising platforms, with the top 3 walking away with seed capital to support their businesses.
    
    This year, MTN Rwanda has once again partnered with Inkomoko Entrepreneur Development and seeks to support promising youth-led SMEs/start-ups in Rwanda in the second season of Level up Your Biz.",
    "handle"=>"Application"
),
array(
    "title"=>"Deadline",
    "desc" => "Many small start-ups barely have enough capacity to make it through the first year successfully and lack funds for communication or advertising their businesses. 

    The successful launch and roll out of Level Up Your Business Season 1 in 2021 saw 6 youth led local SMEs receive intensive business skills training sessions, communication and advertising platforms, with the top 3 walking away with seed capital to support their businesses.
    
    This year, MTN Rwanda has once again partnered with Inkomoko Entrepreneur Development and seeks to support promising youth-led SMEs/start-ups in Rwanda in the second season of Level up Your Biz.",
    "handle"=>"Deadline"
),
            );

            ?>
            <div class="col-md-12">
            <div class="level-up">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="section-navigator">
                            <?php
                            $counter = 1;
                                foreach($levelUps as $levelUp)
                                {
                                    if($counter == 1)
                                        $selector = "active-navigator-button";
                                    else
                                        $selector = "";
                                ?>
                                    <a class="navigator-button <?=$selector?>" data-filter="<?=$levelUp['handle']?>">
                                        <li><?=$levelUp['title']?></li>
                                    </a>
                              <?php 
                              $counter ++;
                               }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <?php
                            foreach($levelUps as $levelUp)
                                {?>
                                    <div class="section-contents-details <?=$levelUp['handle']?>">
                                        <p>
                                            <?=$levelUp['desc']?>
                                        </p>
                                    </div>
                            <?php    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
    }