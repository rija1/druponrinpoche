<?php
/**
 * Unicon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Unicon
 */

if ( ! function_exists( 'unicon_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unicon_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Unicon, use a find and replace
	 * to change 'unicon-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'unicon-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('unicon-lite-about-image', 360, 240, true); // About Us
	add_image_size('unicon-lite-work-image', 480, 350, true); // Our Work
	add_image_size('unicon-lite-team-image', 300, 400, true); // Our Team
	add_image_size('unicon-lite-homeblog-image', 255, 268, true); // Home Blog
	add_image_size('unicon-lite-blog-image', 360, 270, true);
	add_image_size('unicon-lite-single-blog-image', 820, 390, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'unicon-lite' ),
		'buttom' => esc_html__( 'Buttom Menu', 'unicon-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'unicon_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Enable support for custom logo.
	*/
	add_image_size( 'unicon-lite-logo', 250, 75 );
	add_theme_support( 'custom-logo', array( 'size' => 'unicon-lite-logo' ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	*/
	add_editor_style( 'assets/css/editor-style.css' );

}
endif;
add_action( 'after_setup_theme', 'unicon_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function unicon_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'unicon_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'unicon_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function unicon_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar Widget Area', 'unicon-lite' ),
		'id'            => 'unicon-lite-leftsidebar',
		'description'   => esc_html__( 'Add widgets here.', 'unicon-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title wow slideInUp">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'unicon-lite' ),
		'id'            => 'unicon-lite-rightsidebar',
		'description'   => esc_html__( 'Add widgets here.', 'unicon-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title wow slideInUp">',
		'after_title'   => '</h2>',
	) );

	register_sidebars( 4 , array(
        'name'          => __('Footer area %d','unicon-lite'),
        'id'            => 'unicon-lite-sidebar-footer',
        'description'   => esc_html__( 'Add widgets here.', 'unicon-lite' ),
        'before_widget' => '<aside id="%1$s" class="widget footer-widget-footer %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
	) );
}
add_action( 'widgets_init', 'unicon_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function unicon_lite_scripts() {

	global $unicon_sucess_per, $unicon_sucess_year;
	$unicon_theme = wp_get_theme();
	$theme_version = $unicon_theme->get( 'Version' );
	$unicon_lite_animation_section = get_theme_mod('unicon_lite_animation_section','show');

	/**
	 * Google Fonts
	*/
	wp_enqueue_style( 'unicon-lite-googlefonts', '//fonts.googleapis.com/css?family=Poppins:300,400|Roboto:300,400,500,600,900|Lora:400,400i,700,700i', '1.0.0' );

	/**
	 * Font-Awesome-master
	*/
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/font-awesome.min.css', esc_attr( $theme_version ) );

	/**
	 * Youtube jquery.mb.YTPlayer
	*/
	wp_enqueue_style( 'jquery-mb-YTPlayer', get_template_directory_uri() . '/assets/library/youtube-video/css/jquery.mb.YTPlayer.min.css',  esc_attr( $theme_version ) );

	/**
	 * jQuery jquery-ui.css
	*/
	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css');

	/**
	 * Lightslider Carousel
	*/
	wp_enqueue_style( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider.css', esc_attr( $theme_version ) );

	/**
	 * Main Style 
	*/
	wp_enqueue_style( 'unicon-lite-style', get_stylesheet_uri() );

	/**
	 * jquery start
	*/
	wp_enqueue_script('html5shiv', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), esc_attr( $theme_version ), false);
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), esc_attr( $theme_version ), false);
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script( 'unicon-lite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'unicon-lite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 * Youtube jquery.mb.YTPlayer
	*/
	wp_enqueue_script('jquery-mb-YTPlayer', get_template_directory_uri() . '/assets/library/youtube-video/js/jquery.mb.YTPlayer.min.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * jQuery jquery-ui-slider
	*/
	wp_enqueue_script( 'jquery-ui-slider');

	/**
	 * lightslider Carousel
	*/
	wp_enqueue_script('lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.min.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * Waypoints
	*/
	wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/library/waypoints/js/jquery.waypoints.min.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * Chart Graph
	*/
	wp_enqueue_script('jquery-chart', get_template_directory_uri() . '/assets/library/chart/jquery.chart.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * Counter
	*/
	wp_enqueue_script('jquery-counterup', get_template_directory_uri() . '/assets/library/counter/js/jquery.counterup.min.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * Animation
	*/
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/library/wow/css/animate.min.css', esc_attr( $theme_version ));

    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/library/wow/js/wow.min.js', array('jquery'), esc_attr( $theme_version ), true);

	/**
	 * Unicon Custom Jquery With Localize Scripts
	*/
	
	wp_enqueue_script('unicon-lite-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), esc_attr( $theme_version ), true);
	wp_localize_script('unicon-lite-plugins','unicon_lite_pro_ajax_script', array('sucess_per' => $unicon_sucess_per, 'sucess_year' => $unicon_sucess_year,'theme_animation'=> $unicon_lite_animation_section ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'unicon_lite_scripts' );


/**
 * Enqueue admin scripts and styles.
*/
if ( ! function_exists( 'unicon_lite_admin_scripts' ) ) {
	function unicon_lite_admin_scripts( ) {
		wp_enqueue_script( 'unicon-lite-customizer-script', get_template_directory_uri() . '/unicon/customizer/assets/js/customizer-scripts.js', array( 'jquery', 'customize-controls' ), '20160714', true );
		wp_enqueue_style( 'unicon-lite-customizer-style', get_template_directory_uri() . '/unicon/customizer/assets/css/customizer-style.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'unicon_lite_admin_scripts' );


/**
 * Load Require init file.
*/
require $unicon_lite_file_directory_init_file_path = trailingslashit( get_template_directory() ).'unicon/init.php';

/**
 * Include Welcome Page
 */
require get_template_directory() . '/welcome/welcome.php';

if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
	define( 'ELEMENTOR_PARTNER_ID', 2117 );
}