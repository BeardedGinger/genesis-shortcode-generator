<?php
/**
 * Genesis User Profile Widget as shortcode for Genesis Shortcode Generator
 *
 * @since 2.0.0
 */

class GingerBeard_User_Profile {

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
		'title'          => '',
		'alignment'	     => 'left',
		'user'           => '',
		'size'           => '45',
		'author_info'    => '',
		'bio_text'       => '',
		'page'           => '',
		'page_link_text' => 'Read More &#x02026;',
		'posts_link'     => '',
	);

	/**
	 * Build the shortcode
	 *
	 * @since 2.0.0
	 */
	public function shortcode_build( $atts, $content = 'null' ) {
		$this->args = shortcode_atts( $this->default_args, $atts, 'genesis_user_profile' );

		ob_start();
		the_widget( 'Genesis_User_Profile_Widget',  $this->args, $this->args );
		$user_profile = ob_get_clean();

		return $user_profile;

	}

	/**
	 * Shortode UI
	 *
	 * @since 2.1.0
	 */
	public function shortcode_ui() {

		$fields = array(
			array(
				'label' 	=> __( 'Title', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'title',
				'type' 		=> 'text'
			),
			array(
				'label' 	=> __( 'Alignment', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'alignment',
				'type' 		=> 'select',
				'options' 	=> array(
					'left' 		=> __( 'Left', 'gingerbeard-shortcodes' ),
					'right' 	=> __( 'Right', 'gingerbeard-shortcodes' ),
					'center' 	=> __( 'Center', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'User', 'gingerbeard-shortcode' ),
				'attr' 		=> 'user',
				'type' 		=> 'number'
			),
			array(
				'label' 	=> __( 'Gravatar Size', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'size',
				'type' 		=> 'number'
			)
		);

		$shortcode_ui_args = array(
			'label' 			=> __( 'Genesis User Profile', 'gingerbeard-shortcodes' ),
			'attrs' 			=> $fields
		);

		shortcode_ui_register_for_shortcode( 'genesis_user_profile', $shortcode_ui_args );
	}

}