<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://hztech.biz
 * @since      1.0.0
 *
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/public
 * @author     Abid <abid@hztech.biz>
 */
class Easy_Coupons_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version )
	{

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Coupons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Coupons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-coupons-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Coupons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Coupons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-coupons-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ec_ajax', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		] );
	}

	public function shortcodes()
	{
		add_shortcode( 'easy-coupon-videos', [ $this, 'render_videos' ] );
	}

	public function render_videos()
	{
		ob_start();

		$video_id = ! empty( $_REQUEST['ec-video'] ) ? $_REQUEST['ec-video'] : false;
		$template = "shortcode-videos";

		if ( ! empty( $video_id ) ) {
			$template = "shortcode-coupon";
		} else {
			$videos = get_posts( [
				                     'post_type'      => 'video',
				                     'posts_per_page' => - 1,
				                     'meta_key'       => '_url',
				                     'meta_compare'   => 'EXISTS'
			                     ] );

		}

		include dirname( __FILE__ ) . "/partials/{$template}.php";

		return ob_get_clean();
	}

	public function ajax_check_coupon()
	{
		$url = $code = $video_id = $is_expired = $can_use = false;

		if ( ! empty( $_REQUEST['video_id'] ) ) {
			$code       = ! empty( $_REQUEST['code'] ) ? $_REQUEST['code'] : false;
			$video_id   = ! empty( $_REQUEST['video_id'] ) ? $_REQUEST['video_id'] : false;
			$coupon_id  = Easy_Coupons::getCoupon( $code );
			$is_expired = Easy_Coupons::isExpired( $code );
			$can_use    = Easy_Coupons::canBeUsed( $code, $video_id );
			$is_admin   = strtolower( $code ) == 'admn';

			if ( $is_admin || ( $coupon_id && ! $is_expired && $can_use ) ) {

				if ( ! $is_admin ) {
					update_post_meta( $coupon_id, '_usage_video_id', $video_id );
				}

				$url = add_query_arg( [
					                      'video'    => $video_id,
					                      'action'   => 'load_video',
					                      'ec-nonce' => wp_create_nonce( 'ec-video' )
				                      ], admin_url( 'admin-ajax.php' ) );
			}
		}

		echo json_encode( [
			                  'status'   => ! empty( $url ),
			                  'source'   => $url,
			                  'video_id' => $video_id,
			                  'code'     => $code,
			                  'error'    => empty( $url ) ? ( empty( $coupon_id ) ? 'Invalid Coupon' : $is_expired ? "Coupon Expired" : ! $can_use ? "Already Used" : false ) : false
		                  ] );
		die;
	}

	public function ajax_load_video()
	{
		if ( ! empty( $_REQUEST['video'] ) && wp_verify_nonce( $_REQUEST['ec-nonce'], 'ec-video' ) ) {
			$video_id  = $_REQUEST['video'];
			$video_url = get_post_meta( $video_id, '_url', true );

			if ( ! empty( $video_url ) ) {
				header( 'Content-type: video/mp4' );

				readfile( $video_url );
				die;
			}
		} else {
			echo json_encode( [ 'error' => 'failed to load' ] );
		}
		die;
	}
}
