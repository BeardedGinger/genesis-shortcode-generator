<?php
/**
 * Plugin class for the administrative views of the Genesis Shortcode plugin
 *
 */
class GingerBeard_Genesis_Shortcodes_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	public function __construct() {

		add_action( 'admin_notices', array( $this, 'genesis_shortcodes_admin_notice' ) );
		add_action( 'admin_notices', array( $this, 'genesis_shortcodes_dismissed_notice' ) );

		add_action( 'admin_head', array( $this, 'add_genesis_shortcode_generator_button' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'genesis_shortcode_css' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Admin notice
	 *
	 * @since    1.0.0
	 */
	public function genesis_shortcodes_admin_notice() {

		global $current_user ;
        $user_id = $current_user->ID;

        /* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta($user_id, 'genesis_shortcode_ignore_notice') && !function_exists('genesis') ) {
        	echo '<div class="updated"><p>';
        		printf(__('This plugin only works with the <a href="http://joshmallard.com/genesis-link">Genesis Framework</a> | <a href="%1$s">Hide Notice</a>'), '?genesis_shortcode_nag_ignore=0');
        	echo "</p></div>";
		}
	}

	/**
	 * Load stylesheet for shortcode generator icon
	 *
	 * @since	1.0.1
	 */
	public function genesis_shortcode_css() {
		wp_enqueue_style( 'genesis-shortcode-generator-styles', plugins_url( 'assets/admin.css', __FILE__ ), array() );
	}

	/**
	 * Add usermeta to check if user has dismissed the admin notice
	 *
	 * @since    1.0.0
	 */
	public function genesis_shortcodes_dismissed_notice() {

		global $current_user;
        $user_id = $current_user->ID;

        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['genesis_shortcode_nag_ignore']) && '0' == $_GET['genesis_shortcode_nag_ignore'] ) {
             add_user_meta($user_id, 'genesis_shortcode_ignore_notice', 'true', true);
		}
	}

	/**
	 * Add TinyMCE js and button for Genesis Shortcode Generator
	 *
	 */
	public function add_genesis_shortcode_generator_button() {

		if( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}

		if( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'add_shortcode_button_js' ) );
			add_filter( 'mce_buttons', array( $this, 'genesis_shortcode_button' ) );
		}
	}
	/**
	 * Get the js file for the TinyMCE button dropdown
	 *
	 */
	public function add_shortcode_button_js($plugin_array) {
		$plugin_array['genesis_shortcodes'] = plugins_url( 'assets/admin.js', __FILE__ );
		return $plugin_array;
	}

	/**
	 * Add the button to TinyMCE
	 *
	 */
	public function genesis_shortcode_button($buttons) {
		array_push($buttons, "genesis_shortcodes");
	   	return $buttons;
	}
}
