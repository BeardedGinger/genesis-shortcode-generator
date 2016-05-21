<?php
/**
 * Genesis Featured Post Widget as shortcode for Genesis Shortcode Generator
 *
 * @since 2.0.0
 */

class GingerBeard_Featured_Post {

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
		'title'                   => '',
		'posts_cat'               => '',
		'posts_num'               => 1,
		'posts_offset'            => 0,
		'orderby'                 => '',
		'order'                   => '',
		'exclude_displayed'       => 0,
		'exclude_sticky'          => 0,
		'show_image'              => 0,
		'image_alignment'         => '',
		'image_size'              => '',
		'show_gravatar'           => 0,
		'gravatar_alignment'      => '',
		'gravatar_size'           => '',
		'show_title'              => 1,
		'show_byline'             => 0,
		'post_info'               => '[post_date] By [post_author_posts_link] [post_comments]',
		'show_content'            => 'excerpt',
		'content_limit'           => '',
		'more_text'               => '[Read More...]',
		'extra_num'               => '',
		'extra_title'             => '',
		'more_from_category'      => '',
		'more_from_category_text' => 'More Posts from this Category',
	);

	/**
	 * Build the shortcode
	 *
	 * @since 2.0.0
	 */
	public function shortcode_build( $atts, $content = 'null' ) {
		$this->args = shortcode_atts( $this->default_args, $atts, 'genesis_featured_post' );

		ob_start();
		the_widget( 'Genesis_Featured_Post',  $this->args, $this->args );
		$featured_post = ob_get_clean();

		return $featured_post;

	}

	/**
	 * Shortode UI
	 *
	 * @since 2.1.0
	 */
	public function shortcode_ui() {

		if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
			return;

		$category_options = array(
			'' => 'All Categories'
		);

		$categories = get_terms( 'category' );
		$count = 0;

		foreach( $categories as $category ) {
			$category_options[$category->term_id] = $category->name;
		}

		$fields = array(
			array(
				'label' 	=> __( 'Title', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'title',
				'type' 		=> 'text'
			),
			array(
				'label' 	=> __( 'Category', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'posts_cat',
				'type' 		=> 'select',
				'options' 	=> $category_options
			),
			array(
				'label' 	=> __( 'Number of Posts to Show', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'posts_num',
				'type' 		=> 'number',
			),
			array(
				'label' 	=> __( 'Number of Posts to Offset', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'posts_offset',
				'type' 		=> 'number',
			),
			array(
				'label' 	=> __( 'Order By', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'orderby',
				'type' 		=> 'select',
				'options' 	=> array(
					'date' 				=> __( 'Date', 'gingerbeard-shortcodes' ),
					'title' 			=> __( 'Title', 'gingerbeard-shortcodes' ),
					'parent' 			=> __( 'Parent', 'gingerbeard-shortcodes' ),
					'ID' 				=> __( 'ID', 'gingerbeard-shortcodes' ),
					'comment_count' 	=> __( 'Comment Count', 'gingerbeard-shortcodes' ),
					'rand' 				=> __( 'Random', 'gingerbeard-shortcodes' ),
				)
			),
			array(
				'label' 	=> __( 'Sort Order', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'order',
				'type' 		=> 'select',
				'options' 	=> array(
					'DESC' 				=> __( 'Descending (3,2,1)', 'gingerbeard-shortcodes' ),
					'ASC' 				=> __( 'Ascending(1,2,3)', 'gingerbeard-shortcodes' ),
				)
			),
			array(
				'label' 	=> __( 'Exclude Previously Displayed Posts?', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'exclude_displayed',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'1' 		=> __( 'True', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Exclude Sticky Posts?', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'exclude_sticky',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'1' 		=> __( 'True', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Show Author Gravatar', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'show_gravatar',
				'type' 		=> 'checkbox',
				'options' 	=> array(
					'1' 		=> __( 'True', 'gingerbeard-shortcodes' )
				)
			),
			array(
				'label' 	=> __( 'Gravatar Size', 'gingerbeard-shortcodes' ),
				'attr' 		=> 'gravatar_size',
				'type' 		=> 'select',
				'options' 	=> array(
					'45' 		=> __( 'Small (45px)', 'gingerbeard-shortcodes' ),
					'65' 		=> __( 'Medium (65px)', 'gingerbeard-shortcodes' ),
					'85' 		=> __( 'Large (85px)', 'gingerbeard-shortcodes' ),
					'125' 		=> __( 'Extra Large (125px)', 'gingerbeard-shortcodes' ),
				)
			),
		);

		$shortcode_ui_args = array(
			'label' 			=> __( 'Genesis Featured Posts', 'gingerbeard-shortcodes' ),
			'attrs' 			=> $fields
		);

		shortcode_ui_register_for_shortcode( 'genesis_featured_posts', $shortcode_ui_args );
	}

}