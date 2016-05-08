<?php
/**
 * Clear shortcode for Genesis Shortcode Generator
 *
 * @since 2.0.1
 */

class GingerBeard_Clear {

	protected static $instance;

	/**
	 * Used for getting an instance of this class
	 *
	 * @since 2.0.1
	 */
	public static function instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Build the shortcode
	 *
	 * @since 2.0.1
	 */
	public function shortcode_build( $content = 'null' ) {

    	$gb_clear = '<div style="clear:both;"></div>';

    	return $gb_clear;
	}

}