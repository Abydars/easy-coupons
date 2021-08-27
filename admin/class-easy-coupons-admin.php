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
			'name'                  => _x( 'Coupons', 'Post type general name', 'easy-coupons' ),
			'singular_name'         => _x( 'Coupon', 'Post type singular name', 'easy-coupons' ),
			'menu_name'             => _x( 'Coupons', 'Admin Menu text', 'easy-coupons' ),
			'name_admin_bar'        => _x( 'Coupon', 'Add New on Toolbar', 'easy-coupons' ),
			'add_new'               => __( 'Add New', 'easy-coupons' ),
			'add_new_item'          => __( 'Add New Coupon', 'easy-coupons' ),
			'new_item'              => __( 'New Coupon', 'easy-coupons' ),
			'edit_item'             => __( 'Edit Coupon', 'easy-coupons' ),
			'view_item'             => __( 'View Coupon', 'easy-coupons' ),
			'all_items'             => __( 'All Coupons', 'easy-coupons' ),
			'search_items'          => __( 'Search Coupons', 'easy-coupons' ),
			'parent_item_colon'     => __( 'Parent Coupons:', 'easy-coupons' ),
			'not_found'             => __( 'No coupons found.', 'easy-coupons' ),
			'not_found_in_trash'    => __( 'No coupons found in Trash.', 'easy-coupons' ),
			'featured_image'        => _x( 'Coupon Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'easy-coupons' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'easy-coupons' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'easy-coupons' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'easy-coupons' ),
			'archives'              => _x( 'Coupon archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'easy-coupons' ),
			'insert_into_item'      => _x( 'Insert into coupon', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'easy-coupons' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this coupon', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'easy-coupons' ),
			'filter_items_list'     => _x( 'Filter coupons list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'easy-coupons' ),
			'items_list_navigation' => _x( 'Coupons list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'easy-coupons' ),
			'items_list'            => _x( 'Coupons list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'easy-coupons' ),
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
		flush_rewrite_rules();
	}

	public function add_meta_boxes()
	{
		add_meta_box(
			'coupon-meta',
			'Configuration',
			[ $this, 'meta_boxes_html' ],
			'coupon'
		);
	}

	public function meta_boxes_html( $post )
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
		}
	}

	public function render_coupons_filter()
	{
		global $typenow;

		if ( $typenow == 'coupon' ) {
			$expiry = ! empty( $_REQUEST['expiry'] ) ? esc_html( $_REQUEST['expiry'] ) : '';
			?>
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

}
