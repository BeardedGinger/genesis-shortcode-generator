<?php
/**
 * Genesis Featured Page Widget as shortcode for Genesis Shortcode Generator
 *
 * @since 2.0.0
 */

class GingerBeard_Featured_Page {

	protected static $instance;

	protected $args = array();

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
	 * Widget args also used for shortcode attributes
	 *
	 * @since 2.0.0
	 * @var array
	 */
	protected $default_args = array(
		'title'           => '',
		'page_id'         => '',
		'show_image'      => true,
		'image_alignment' => '',
		'image_size'      => '',
		'show_title'      => true,
		'show_content'    => true,
		'content_limit'   => '',
		'more_text'       => ''
	);

	/**
	 * Build the shortcode
	 *
	 * @since 2.0.0
	 */
	public function shortcode_build( $atts, $content = 'null' ) {
		$this->args = shortcode_atts( $this->default_args, $atts, 'genesis_featured_page' );

		ob_start();
		the_widget( 'Genesis_Featured_Page',  $this->args, $this->args );
		$featured_page = ob_get_clean();

		return $featured_page;

	}

	/**
	 * Shortode UI
	 *
	 * @since 2.1.0
	 */
	public function shortcode_ui() {

		if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
			return;

		$fields = array(
			array(
				'label' 	=> __( 'Title', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'title',
				'type' 		=> 'text'
			),
			array(
				'label' 	=> __( 'Page', 'gingerbeard-shortcodes' ),
				'attr'		=> 'page_id',
				'type' 		=> 'post_select',
				'query' 	=> array( 'post_type' => 'page' ),
				'multiple' 	=> false
			),
			array(
				'label' 	=> __( 'Hide Image?', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'show_image',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'false' 		=> __( 'False', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Image Alignment', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'image_alignment',
				'type' 		=> 'select',
				'options' 	=> array(
					'left' 		=> __( 'Left', 'gingerbeard-shortcodes' ),
					'right' 	=> __( 'Right', 'gingerbeard-shortcodes' ),
					'center' 	=> __( 'Center', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Image Size', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'image_size',
				'type' 		=> 'number'
			),
			array(
				'label' 	=> __( 'Hide Title', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'show_title',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'false' 		=> __( 'False', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Hide Content', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'show_content',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'false' 		=> __( 'False', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Content Limit', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'content_limit',
				'type' 		=> 'number'
			),
			array(
				'label' 	=> __( 'Read More Text', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'more_text',
				'type' 		=> 'text'
			)

		);

		$shortcode_ui_args = array(
			'label' 			=> __( 'Genesis Featured Page', 'gingerbeard-shortcodes' ),
			'attrs' 			=> $fields
		);

		shortcode_ui_register_for_shortcode( 'genesis_featured_page', $shortcode_ui_args );
	}

}