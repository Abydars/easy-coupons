<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://hztech.biz
 * @since      1.0.0
 *
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/includes
 * @author     Abid <abid@hztech.biz>
 */
class Easy_Coupons
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Easy_Coupons_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if ( defined( 'EASY_COUPONS_VERSION' ) ) {
			$this->version = EASY_COUPONS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'easy-coupons';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Easy_Coupons_Loader. Orchestrates the hooks of the plugin.
	 * - Easy_Coupons_i18n. Defines internationalization functionality.
	 * - Easy_Coupons_Admin. Defines all hooks for the admin area.
	 * - Easy_Coupons_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-coupons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-coupons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-easy-coupons-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-easy-coupons-public.php';

		$this->loader = new Easy_Coupons_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Easy_Coupons_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Easy_Coupons_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Easy_Coupons_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'actions' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_boxes' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'handle_requests' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'notices' );
		$this->loader->add_action( 'parse_query', $plugin_admin, 'parse_query' );
		$this->loader->add_action( 'restrict_manage_posts', $plugin_admin, 'render_coupons_filter' );
		$this->loader->add_filter( 'manage_coupon_posts_columns', $plugin_admin, 'manage_coupon_columns', 20 );
		$this->loader->add_action( 'manage_coupon_posts_custom_column', $plugin_admin, 'render_coupon_columns', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Easy_Coupons_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'shortcodes' );
		$this->loader->add_action( 'wp_ajax_check_coupon', $plugin_public, 'ajax_check_coupon' );
		$this->loader->add_action( 'wp_ajax_nopriv_check_coupon', $plugin_public, 'ajax_check_coupon' );
		$this->loader->add_action( 'wp_ajax_load_video', $plugin_public, 'ajax_load_video' );
		$this->loader->add_action( 'wp_ajax_nopriv_load_video', $plugin_public, 'ajax_load_video' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Easy_Coupons_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version()
	{
		return $this->version;
	}

	private static function generateRandomAlphaNumericCode( $strength = 4 )
	{
		$input         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_length  = strlen( $input );
		$random_string = '';
		for ( $i = 0; $i < $strength; $i ++ ) {
			$random_character = $input[ mt_rand( 0, $input_length - 1 ) ];
			$random_string    .= $random_character;
		}

		return $random_string;
	}

	public static function createCouponCode( $expiry, $code = false )
	{
		$code   = self::generateRandomAlphaNumericCode();
		$coupon = wp_insert_post( [
			                          'post_title'  => $code,
			                          'post_type'   => 'coupon',
			                          'post_status' => 'publish'
		                          ] );

		if ( is_wp_error( $coupon ) ) {
			return false;
		}

		update_post_meta( $coupon, '_expiry', $expiry );

		return get_post( $coupon );
	}

	public static function getCoupon( $code )
	{
		global $wpdb;

		$post_id = $wpdb->get_var( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '{$code}' AND post_type = 'coupon' AND post_status = 'publish';" );

		return ! empty( $post_id ) ? $post_id : false;
	}

	public static function isExpired( $code )
	{
		$coupon_id = self::getCoupon( $code );

		if ( $coupon_id ) {
			$expiry = get_post_meta( $coupon_id, '_expiry', true );
			$diff   = strtotime( $expiry ) - time();

			return ! ( $diff > 0 );
		}

		return true;
	}

	public static function canBeUsed( $code, $video_id )
	{
		$coupon_id = self::getCoupon( $code );

		if ( $coupon_id ) {
			$coupon_video_id = get_post_meta( $coupon_id, '_usage_video_id', true );
			$used            = $coupon_video_id === $video_id;

			return ( empty( $coupon_video_id ) || $used );
		}

		return false;
	}

	public static function getCoupons()
	{
		return $_COOKIE['ec-coupon'] ?: [];
	}

	public static function saveCoupon( $code )
	{
		$coupons              = self::getCoupons();
		$coupons[]            = $code;
		$_COOKIE['ec-coupon'] = $coupons;
	}

}
