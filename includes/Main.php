<?php
/**
 * Main plugin file where all the front-end magic happens
 *
 * @since 2.0.0
 *
 */

class GingerBeard_Main {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   2.0.0
	 *
	 * @var     string
	 */
	const VERSION = '2.0.0';

	/**
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    2.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'gingerbeard-shortcodes';

	/**
	 * Array of shortcodes that will be regsitered and available for use
	 *
	 * @since 2.0.0
	 * @var array
	 */
	protected $shortcodes = array();

	/**
	 * Load the shortcodes
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		// Get the necessary shortcode files
		$this->get_shortcode_files();

		add_shortcode( 'genesis_column', array( GingerBeard_Columns::instance(), 'shortcode_build' ) );
	}

	/**
	 * Get the shortcode files
	 *
	 * @since 2.0.0
	 */
	public function get_shortcode_files() {

		require plugin_dir_path( __FILE__ ) . '../shortcodes/Columns.php';
		require plugin_dir_path( __FILE__ ) . '../shortcodes/Featured_Page_Widget.php';
		require plugin_dir_path( __FILE__ ) . '../shortcodes/Featured_Post_Widget.php';
		require plugin_dir_path( __FILE__ ) . '../shortcodes/User_Profile_Widget.php';

	}

}