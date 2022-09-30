<?php

namespace MTN_FEATURES\Widgets;

if (!defined('ABSPATH')) {
	exit;
}

	class MTN_Simplex_Filter  extends \Elementor\Widget_Base
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
			return 'Simplex Filter';
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
			return esc_html__('Simplex Filter', 'mtn');
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

			select_callback_control($this, 'posts_filter','Mtn Post Filter', mtn_post_types(), null);
			typography_control($this, 'filter_section_typography', '.mtn-filter-content');
			

			$this->end_controls_section();

			$this->start_controls_section(
				'filter_section',
				[
					'label' => esc_html__('Content', 'mtn'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			heading_control($this, "filter_buttons", "Filter Buttons");
			// $settings = $this->get_settings_for_display();
			// select2_callback_control($this, "filter_selection","Filter Selections", mtn_get_taxonomies($settings), null);
			$this->end_controls_section();

			
        }
        protected function render()
		{
			echo "hello";
        }
    }
