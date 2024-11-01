<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @package        WordPress
 * @subpackage     BuddyPress, Woocommerce, WC4BP
 * @author         ThemKraft Dev Team
 * @copyright      2017, Themekraft
 * @link           http://themekraft.com/store/woocommerce-buddypress-integration-wordpress-plugin/
 * @license        http://www.opensource.org/licenses/gpl-2.0.php GPL License
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class wc4bp_groups_manager {

	private static $plugin_slug = 'wc4bp_groups';
	protected static $version   = '1.4.7';

	public function __construct() {
		require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_log.php';
		new wc4bp_groups_log();
		try {
			// loading_dependency
			require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_woo_base.php';
			require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_model.php';
			require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_woo.php';
			new wc4bp_groups_model();
			new wc4bp_groups_woo();
			if ( wc4bp_groups_required::is_woo_subscription_active() ) {
				require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_woo_subscription.php';
				new wc4bp_groups_woo_subscription();
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_js' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_style' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			if ( wc4bp_groups_required::is_woo_elem_active() ) {
				require_once WC4BP_GROUP_CLASSES_PATH . 'wc4bp_groups_woo_elem_integration.php';
				new wc4bp_groups_woo_elem_integration();
			}
		} catch ( Exception $ex ) {
			wc4bp_groups_log::log(
				array(
					'action'         => get_class( $this ),
					'object_type'    => self::getSlug(),
					'object_subtype' => 'loading_dependency',
					'object_name'    => $ex->getMessage(),
				)
			);
		}
	}

	/**
	 * Add scripts to the frontend in the product page.
	 *
	 * @param $hook
	 */
	public function enqueue_scripts( $hook ) {
		global $post;
		if ( isset( $post ) && isset( $post->post_type ) && $post->post_type == 'product' ) {
			wp_register_script( 'wc4bp_groups_frontend', WC4BP_GROUP_JS_PATH . 'wc4bp-groups-frontend.js', array( 'jquery' ), self::getVersion() );
			wp_enqueue_script( 'wc4bp_groups_frontend' );
		}
	}

	/**
	 * Include styles in admin
	 *
	 * @param $hook
	 * @param bool $force
	 */
	public static function enqueue_style( $hook, $force = false ) {
		global $post;
		if ( ( ( $hook == 'post.php' || $hook == 'post-new.php' ) && $post->post_type == 'product' ) || $force ) {
			wp_enqueue_style( 'jquery' );
			wp_enqueue_style( 'wc4bp-groups', WC4BP_GROUP_CSS_PATH . 'wc4bp-groups.css', array(), self::getVersion() );
		}
	}

	/**
	 * Include script
	 *
	 * @param $hook
	 * @param bool $force
	 */
	public static function enqueue_js( $hook, $force = false ) {
		global $post;
		if ( ( ( $hook == 'post.php' || $hook == 'post-new.php' ) && $post->post_type == 'product' ) || $force ) {
			wp_register_script( 'wc4bp_groups', WC4BP_GROUP_JS_PATH . 'wc4bp-groups.js', array( 'jquery' ), self::getVersion() );
			wp_enqueue_script( 'wc4bp_groups' );
			wp_localize_script(
				'wc4bp_groups',
				'wc4bp_groups',
				array(
					'ajax_url'            => admin_url( 'admin-ajax.php' ),
					'post_id'             => $post->ID,
					'search_groups_nonce' => wp_create_nonce( 'wc4bp-nonce' ),
					'is_force'            => $force,
					'general_error'       => self::translation( 'General Error, contact the admin. #1' ),
					'remove'              => self::translation( 'General Error, contact the admin. #2' ),
				)
			);
		}
	}

	/**
	 * Get plugins version
	 *
	 * @return mixed
	 */
	static function getVersion() {
		return self::$version;
	}

	/**
	 * Get plugins slug
	 *
	 * @return string
	 */
	static function getSlug() {
		return self::$plugin_slug;
	}

	/**
	 * Retrieve the translation for the plugins. Wrapper for @param $str
	 *
	 * @return string
	 * @see __()
	 */
	public static function translation( $str ) {
		return __( $str, 'wc4bp_groups' );
	}


	/**
	 * Display the translation for the plugins. Wrapper for @param $str
	 *
	 * @see _e()
	 */
	public static function echo_translation( $str ) {
		esc_html_e( $str, 'wc4bp_groups' );
	}

	/**
	 * Display the translation for the plugins.
	 *
	 * @param $str
	 */
	public static function echo_esc_attr_translation( $str ) {
		echo esc_attr( self::translation( $str ) );
	}
}
