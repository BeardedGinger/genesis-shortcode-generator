<?php
/**
 * Genesis Columns shortcode for Genesis Shortcode Generator
 *
 * @since 2.0.0
 */

class GingerBeard_Columns {

	protected static $instance;

	/**
	 * Used for getting an instance of this class
	 *
	 * @since 2.0.0
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
	 * @since 2.0.0
	 */
	public function shortcode_build( $atts, $content = null ) {
		extract( shortcode_atts( array(
        	'size' => '',
        	'position' => ''
        	),
    	$atts, 'genesis_column' ) );

    	$genesis_column_atts = $size;

    	if ( $position == 'first' ) {
    		$genesis_column_atts .= ' first';
    	}

    	$genesis_column = '<div class="' . $genesis_column_atts . '">' . do_shortcode( $content ) . '</div>';

    	return $genesis_column;
	}

	/**
	 * Shortode UI
	 *
	 * @since     2.1.0
	 * @access    public
	 */
	public function shortcode_ui() {

		if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
			return;

		$fields = array(
			array(
				'label' 	=> __( 'Size', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'size',
				'type' 		=> 'select',
				'options' 	=> array(
					'' 					=> __( 'Select Column Size', 'gingerbeard-shortcodes' ),
					'one-half' 			=> __( 'One Half', 'gingerbeard-shortcodes' ),
					'one-third' 		=> __( 'One Third', 'gingerbeard-shortcodes' ),
					'one-fourth' 		=> __( 'One Fourth', 'gingerbeard-shortcodes' ),
					'one-fifth'			=> __( 'One Fifth', 'gingerbeard-shortcodes' ),
					'one-sixth'			=> __( 'One Sixth', 'gingerbeard-shortcodes' ),
					'two-thirds' 		=> __( 'Two Thirds', 'gingerbeard-shortcodes' ),
					'three-fourths' 	=> __( 'Three Fourths', 'gingerbeard-shortcodes' ),
					'four-fifths' 		=> __( 'Four Fifths', 'gingerbeard-shortcodes' ),
					'five-sixths' 		=> __( 'Five Sixths', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Position', 'gingerbeard-shortcodes' ),
				'attr'		=> 'position',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'first' 	=> __( 'First', 'gingerbeard-shortcodes' )
				),
			)

		);

		$shortcode_ui_args = array(
			'label' 			=> __( 'Genesis Columns', 'gingerbeard-shortcodes' ),
			'attrs' 			=> $fields,
			'inner_content' 	=> array(
				'label' 		=> __( 'Column Content', 'gingerbeard-shortcodes' ),
				'description' 	=> __( 'Content to be displayed in this column', 'gingerbeard-shortcodes' )
			)
		);

		shortcode_ui_register_for_shortcode( 'genesis_column', $shortcode_ui_args );
	}

}