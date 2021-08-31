<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://hztech.biz
 * @since      1.0.0
 *
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Coupons
 * @subpackage Easy_Coupons/admin
 * @author     Abid <abid@hztech.biz>
 */
class Easy_Coupons_Admin
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
	 * @param string $plugin_name The name of this plugin.
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
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-coupons-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-coupons-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_post_type()
	{
		$labels = array(
			'name'               => _x( 'Coupons', 'Post type general name', 'easy-coupons' ),
			'singular_name'      => _x( 'Coupon', 'Post type singular name', 'easy-coupons' ),
			'menu_name'          => _x( 'Coupons', 'Admin Menu text', 'easy-coupons' ),
			'name_admin_bar'     => _x( 'Coupon', 'Add New on Toolbar', 'easy-coupons' ),
			'add_new'            => __( 'Add New', 'easy-coupons' ),
			'add_new_item'       => __( 'Add New Coupon', 'easy-coupons' ),
			'new_item'           => __( 'New Coupon', 'easy-coupons' ),
			'edit_item'          => __( 'Edit Coupon', 'easy-coupons' ),
			'view_item'          => __( 'View Coupon', 'easy-coupons' ),
			'all_items'          => __( 'All Coupons', 'easy-coupons' ),
			'search_items'       => __( 'Search Coupons', 'easy-coupons' ),
			'parent_item_colon'  => __( 'Parent Coupons:', 'easy-coupons' ),
			'not_found'          => __( 'No coupons found.', 'easy-coupons' ),
			'not_found_in_trash' => __( 'No coupons found in Trash.', 'easy-coupons' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'coupon' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
		);

		register_post_type( 'coupon', $args );

		$labels = array(
			'name'               => _x( 'Videos', 'Post type general name', 'easy-coupons' ),
			'singular_name'      => _x( 'Video', 'Post type singular name', 'easy-coupons' ),
			'menu_name'          => _x( 'Videos', 'Admin Menu text', 'easy-coupons' ),
			'name_admin_bar'     => _x( 'Video', 'Add New on Toolbar', 'easy-coupons' ),
			'add_new'            => __( 'Add New', 'easy-coupons' ),
			'add_new_item'       => __( 'Add New Video', 'easy-coupons' ),
			'new_item'           => __( 'New Video', 'easy-coupons' ),
			'edit_item'          => __( 'Edit Video', 'easy-coupons' ),
			'view_item'          => __( 'View Video', 'easy-coupons' ),
			'all_items'          => __( 'All Videos', 'easy-coupons' ),
			'search_items'       => __( 'Search Videos', 'easy-coupons' ),
			'parent_item_colon'  => __( 'Parent Videos:', 'easy-coupons' ),
			'not_found'          => __( 'No videos found.', 'easy-coupons' ),
			'not_found_in_trash' => __( 'No videos found in Trash.', 'easy-coupons' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'videos' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' ),
		);

		register_post_type( 'video', $args );

		flush_rewrite_rules();
	}

	public function add_meta_boxes()
	{
		add_meta_box(
			'coupon-meta',
			'Configuration',
			[ $this, 'coupon_meta_boxes_html' ],
			'coupon'
		);
		add_meta_box(
			'video-meta',
			'Video Fields',
			[ $this, 'video_meta_boxes_html' ],
			'video'
		);
	}

	public function video_meta_boxes_html( $post )
	{
		$url = get_post_meta( $post->ID, '_url', true );
		?>
        <div class="ec-field">
            <label for="wporg_field">URL</label>
            <input type="text" name="video[_url]" value="<?= $url ?>"/>
        </div>
		<?php
	}

	public function coupon_meta_boxes_html( $post )
	{
		$expiry = get_post_meta( $post->ID, '_expiry', true );
		?>
        <div class="ec-field">
            <label for="wporg_field">Expiry Date</label>
            <input type="date" name="coupon[_expiry]" value="<?= $expiry ?>"/>
        </div>
		<?php
	}

	public function save_meta_boxes( $post_id )
	{
		if ( array_key_exists( 'coupon', $_POST ) ) {
			foreach ( $_POST['coupon'] as $k => $v ) {
				update_post_meta( $post_id, $k, esc_html( $v ) );
			}
		}

		if ( array_key_exists( 'video', $_POST ) ) {
			foreach ( $_POST['video'] as $k => $v ) {
				update_post_meta( $post_id, $k, esc_html( $v ) );
			}
		}
	}

	public function admin_menu()
	{
		add_submenu_page(
			'edit.php?post_type=coupon',
			__( 'Generate Coupons', 'easy-coupons' ),
			__( 'Generate Coupons', 'easy-coupons' ),
			'manage_options',
			'ec-generate-coupons',
			[ $this, 'render_generate_coupons' ]
		);
		add_submenu_page(
			'edit.php?post_type=coupon',
			__( 'Coupon Reports', 'easy-coupons' ),
			__( 'Coupon Reports', 'easy-coupons' ),
			'manage_options',
			'ec-report-coupons',
			[ $this, 'render_report_coupons' ]
		);
	}

	public function render_report_coupons()
	{
		include dirname( __FILE__ ) . '/partials/report-coupons.php';
	}

	public function render_generate_coupons()
	{
		include dirname( __FILE__ ) . '/partials/generate-coupons.php';
	}

	public function notices()
	{
		$notices = apply_filters( 'ec_notices', [] );

		foreach ( $notices as $notice ) {
			$class   = 'notice notice-' . $notice['type'];
			$message = __( $notice['message'], 'easy-coupons' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
		}
	}

	public function handle_requests()
	{
		if ( isset( $_REQUEST['_ec_nonce'] ) ) {
			$nonce = esc_html( $_REQUEST['_ec_nonce'] );

			if ( wp_verify_nonce( $nonce, 'ec-generate-coupons' ) ) {
				$quantity = esc_html( $_REQUEST['quantity'] );
				$expiry   = esc_html( $_REQUEST['expiry'] );
				$coupons  = [];
				$errored  = 0;

				if ( $quantity > 1 ) {
					for ( $i = 0; $i < $quantity; $i ++ ) {
						$coupon = Easy_Coupons::createCouponCode( $expiry );

						if ( $coupon ) {
							$coupons[] = $coupon;
						} else {
							$errored ++;
						}
					}

					if ( $errored ) {
						add_filter( 'ec_notices', function ( $notices ) use ( &$errored ) {
							$notices[] = [ 'message' => $errored . " failed to created", 'type' => 'error' ];

							return $notices;
						} );
					}

					add_filter( 'ec_notices', function ( $notices ) use ( &$coupons ) {
						$notices[] = [ 'message' => count( $coupons ) . " coupons created", 'type' => 'success' ];
						$notices   = array_merge( $notices, array_map( function ( $c ) {
							return [ 'message' => "{$c->post_title} coupon created", 'type' => 'success' ];
						}, $coupons ) );

						return $notices;
					} );
				}
			}
		}
	}

	public function manage_coupon_columns( $columns )
	{
		$date_column = $columns['date'];

		unset( $columns['date'] );

		$columns['expiry'] = __( 'Expiry', 'easy-coupons' );
		$columns['used']   = __( 'Used For', 'easy-coupons' );
		$columns['date']   = $date_column;

		return $columns;
	}

	public function render_coupon_columns( $column, $post_id )
	{
		switch ( $column ) {
			case 'expiry':
				$expiry = get_post_meta( $post_id, '_expiry', true );
				echo date( 'j F Y', strtotime( $expiry ) );
				break;
			case 'used':
				$video_id = get_post_meta( $post_id, '_usage_video_id', true );
				echo $video_id ? '<a href="' . get_edit_post_link( $video_id ) . '">' . get_post( $video_id )->post_title . '</a>' : 'Not used';
				break;
		}
	}

	public function render_coupons_filter()
	{
		global $typenow;

		if ( $typenow == 'coupon' ) {
			$expiry = ! empty( $_REQUEST['expiry'] ) ? esc_html( $_REQUEST['expiry'] ) : '';
			?>
            <label>Filter by expiry</label>
            <input type="date" name="expiry" value="<?= $expiry ?>"/>
		<?php }
	}

	public function parse_query( $query )
	{
		global $pagenow;
		$current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

		if ( $current_page == 'coupon' && $pagenow == 'edit.php' ) {
			if ( ! empty( $_REQUEST['expiry'] ) ) {
				$query->query_vars['meta_key']     = '_expiry';
				$query->query_vars['meta_compare'] = '=';
				$query->query_vars['meta_value']   = esc_html( $_REQUEST['expiry'] );
			}
		}
	}

	public function actions()
	{
		if ( isset( $_REQUEST['ec-nonce'] ) && isset( $_REQUEST['ec-action'] ) && wp_verify_nonce( $_REQUEST['ec-nonce'], $_REQUEST['ec-action'] ) ) {
			switch ( $_REQUEST['ec-action'] ) {
				case "clear-logs":
					update_option( 'coupons_not_found', [] );
					update_option( 'coupons_expired', [] );
					update_option( 'coupons_used', [] );

					wp_redirect( admin_url( 'edit.php?post_type=coupon&page=ec-report-coupons' ) );
					die;
					break;
			}
		}
	}

}
