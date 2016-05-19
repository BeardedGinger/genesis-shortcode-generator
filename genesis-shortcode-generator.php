<?php
/**
 * Plugin Name:       Shortcode Generator for Genesis
 * Plugin URI:        http://joshmallard.com
 * Description:       Adds a simple interface for configuring and inserting default Genesis shortcodes, columns, and widgets as shortcodes within your site content
 * Version:           2.1.0
 * Author:            Josh Mallard
 * Author URI:        http://joshmallard.com
 * Text Domain:       gingerbeard-shortcodes
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


include_once( 'includes/Main.php' );
include_once( 'admin/GingerBeard_Admin.php' );

function genesis_shortcode_generator() {
	new GingerBeard_Main();
}

genesis_shortcode_generator();

function genesis_shortcode_generator_admin() {
	new GingerBeard_Genesis_Shortcodes_Admin();
}

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
	genesis_shortcode_generator_admin();
}