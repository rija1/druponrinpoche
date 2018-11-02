<?php
/**
 * Onsen functions and definitions
 *
 * @package Onsen
 */
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see http://developer.wordpress.com/themes/content-width/Enqueue
 */

function onsen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'onsen_content_width', 980 );
}
add_action( 'after_setup_theme', 'onsen_content_width', 0 );

/**
 * Theme support and thumbnail sizes
*/
 
if( ! function_exists( 'onsen_theme_setup' ) ) {

	function onsen_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BuildPress, use a find and replace
		 */

		load_theme_textdomain( 'onsen', get_template_directory() . '/lang' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add default title support
		add_theme_support( 'title-tag' );

		// Add default logo support
        add_theme_support( 'custom-logo' );

		// Custom Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff',
		) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */

		add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 150, 150, true);

		add_image_size('onsen-photo-800-500', 800, 500, true);

		// Menus
        register_nav_menu( 'onsen-menu', _x( 'Main Menu', 'backend', 'onsen' ) );

		// Add theme support for Semantic Markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		// add excerpt support for pages
		add_post_type_support( 'page', 'excerpt' );

		// Add CSS for the TinyMCE editor
		add_editor_style();
	}
	add_action( 'after_setup_theme', 'onsen_theme_setup' );
}

if ( ! function_exists( 'onsen_the_custom_logo' ) ) :
/**
 * Displays custom logo.
 */
function onsen_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Displays Favicon
 */

function onsen_custom_site_icon_size( $sizes ) {
   $sizes[] = 64;
 
   return $sizes;
}
add_filter( 'site_icon_image_sizes', 'onsen_custom_site_icon_size' );
 
function onsen_custom_site_icon_tag( $meta_tags ) {
   $meta_tags[] = sprintf( '<link rel="icon" href="%s" sizes="64x64" />', esc_url( get_site_icon_url( null, 64 ) ) );
 
   return $meta_tags;
}
add_filter( 'site_icon_meta_tags', 'onsen_custom_site_icon_tag' );

/**
 * Customizer additions.
 */

include_once( trailingslashit(get_template_directory()) . '/customizer.php' );


/**
 * About themes additions.
*/

include_once( trailingslashit(get_template_directory()) . '/about.php' );

/**
 * Enqueue CSS stylesheets
 */
 
 
if( ! function_exists( 'onsen_enqueue_styles' ) ) {
	function onsen_enqueue_styles() {

		// OWL Carousel
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array());		
		
		// OWL Theme
		wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.css', array());
		
		// OWL Transitions
		wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css', array());

		// Font Awesome
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array());

		// main style
	    wp_enqueue_style( 'onsen-style', get_stylesheet_uri() );
		
	}
	add_action( 'wp_enqueue_scripts', 'onsen_enqueue_styles' );
}

/**
 * Enqueue JS scripts
 */
 
if( ! function_exists( 'onsen_enqueue_scripts' ) ) {
	function onsen_enqueue_scripts() {

		// owl carousel for sliders
		wp_enqueue_script( 'carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), null );	

		// html5
		wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.js' ); 
		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
		
		// mediaqueries
		wp_enqueue_script( 'mediaqueries', get_template_directory_uri() . '/assets/js/css3-mediaqueries.js' );
		wp_script_add_data( 'mediaqueries', 'conditional', 'lt IE 9' );			

		// main for script js
		wp_enqueue_script( 'onsen-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null );		
		
		// for nested comments
		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'onsen_enqueue_scripts' );
}


/**
 * Register sidebars for Onsen
*/

function onsen_sidebars() {

	// Blog Sidebar
	
	register_sidebar(array(
		'name' => __( 'Blog Sidebar', "onsen"),
		'id' => 'blog-sidebar',
		'description' => __( 'Sidebar on the blog layout.', "onsen"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	

	// Footer Sidebar
	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 1', "onsen"),
		'id' => 'footer-widget-area-1',
		'description' => __( 'The footer widget area 1', "onsen"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 2', "onsen"),
		'id' => 'footer-widget-area-2',
		'description' => __( 'The footer widget area 2', "onsen"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 3', "onsen"),
		'id' => 'footer-widget-area-3',
		'description' => __( 'The footer widget area 3', "onsen"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 4', "onsen"),
		'id' => 'footer-widget-area-4',
		'description' => __( 'The footer widget area 4', "onsen"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));		
}

add_action( 'widgets_init', 'onsen_sidebars' );

// Create List Post

if ( ! function_exists( 'onsen_get_list_posts' ) ) :
	function onsen_get_list_posts($n) {
	
		global $wp_query;
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$args = array(
			'post_type' => 'post',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => $n
		);
		
		$wp_query->query( $args );
		
		return new WP_Query( $args );
	}
endif; 

// Create Function Credits

if ( ! function_exists( 'onsen_credits' ) ) :
	function onsen_credits() {
		
		$text = sprintf( __('Theme created by <a href="%s">PWT</a>. Powered by <a href="%s">WordPress.org</a>', 'onsen'), esc_url('http://www.pwtthemes.com/'), esc_url('http://wordpress.org/'));
		
		echo apply_filters( 'onsen_credits_text', $text) ;
	}
endif; 

add_action( 'onsen_display_credits', 'onsen_credits' );
?>