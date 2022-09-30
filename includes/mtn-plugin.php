<?php

namespace MTN_FEATURES;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class MTN_Features
{

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}

		// Register Widget Styles
		add_action('elementor/frontend/after_enqueue_styles', [$this, 'frontend_widget_styles'], 999);

		// Register Widget Scripts
		add_action("elementor/frontend/after_enqueue_scripts", [$this, 'frontend_assets_scripts']);

		// Include Custom Post Type

		foreach (glob(MTN_DIR . "/includes/post-types/CPT/*.php") as $filename) {
			require_once $filename;
		}

		$this->team_cpt = \MTN_FEATURES\CPT\MTN_Team_Cpt::instance();
		$this->product_cpt = \MTN_FEATURES\CPT\MTN_Product_Cpt::instance();
		$this->deal_cpt = \MTN_FEATURES\CPT\MTN_Deal_Cpt::instance();
		$this->tariff_cpt = \MTN_FEATURES\CPT\MTN_Tariff_Cpt::instance();
		$this->faq_cpt = \MTN_FEATURES\CPT\MTN_Faq_Cpt::instance();
		$this->roaming_cpt = \MTN_FEATURES\CPT\MTN_Roaming_Cpt::instance();

		// EXTRA 
		include_once MTN_DIR . '/includes/post-types/EXTRA/taxonomy.php';

		$this->page_taxonomy = \MTN_FEATURES\EXTRA\MTN_Page_Taxonomy::instance();

		//MAP
		
		require_once MTN_DIR . '/includes/map-locator/mtn-map-locator.php';
		require_once MTN_DIR . '/includes/map-locator/wpsl-templates/wpsl-helper.php';

		\MTN_FEATURES\MAP_Locator\MTN_Map_Locator::instance();
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon'),
			'<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'elementor-test-addon') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon'),
			'<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'elementor-test-addon') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon'),
			'<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
			'<strong>' . esc_html__('PHP', 'elementor-test-addon') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init()
	{

		load_plugin_textdomain('mtn');
		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		require_once MTN_DIR . '/includes/queries/mtn-queries.php';
	}

	// Extra functionality

	/*
	plugin css
	*/

	function frontend_widget_styles()
	{
		wp_enqueue_style("mtn-bootstrap-css", MTN_ASSETS . 'css/bootstrap.min.css');
		wp_enqueue_style("mtn-owlcarousel-css", MTN_ASSETS . 'css/owl.carousel.min.css');
		wp_enqueue_style("mtn-mtn-css", MTN_ASSETS . 'css/mtn-style.css', array(), rand(1, 1000));
		wp_enqueue_style("mtn-test-css", MTN_ASSETS . 'css/test-css.css', array(), rand(1, 1000));
	}

	/*
	plugin elementor js
	*/
	function frontend_assets_scripts()
	{
		//posts carousel active
		wp_enqueue_script("mtn-bootstrap-js", MTN_ASSETS . 'js/bootstrap.min.js', array('jquery'), VERSION, true);
		wp_enqueue_script("mtn-owlcarousel-js", MTN_ASSETS . 'js/owl.carousel.min.js', array('jquery'), VERSION, true);
		wp_enqueue_script("mtn-mtn-js", MTN_ASSETS . 'js/mtn-script.js', array('jquery'), rand(1, 1000), true);
		wp_enqueue_script("mtn-test-js", MTN_ASSETS . 'js/test-js.js', array('jquery'), rand(1, 1000), true);
	}
	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		foreach (glob(MTN_DIR . "/includes/widgets/*.php") as $filename) {
			require_once $filename;
		}

		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Deals_Carousel());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Complex_Carousel_Widget());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Viewed_Topics());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Team_Grid());
		// $widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Flex_Grid());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_News_Grid());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Post_Grid());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Tariffs_Widget());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Device_Filter1());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Posts_Filter());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Accordion());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Faqs());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Single_Faqs());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Vacancies());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Roaming_Filter());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Related_Faqs());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Accordion_Foundation());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Roaming_International_Filter());
		// $widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Test_Widget());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Roaming_Data_Bundle_Filter());
		$widgets_manager->register(new \MTN_FEATURES\Widgets\MTN_Simplex_Filter());
	}
}

