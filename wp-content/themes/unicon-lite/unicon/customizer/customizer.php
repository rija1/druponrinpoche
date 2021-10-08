<?php
/**
 * Unicon Theme Customizer.
 *
 * @package AccessPress Themes
 * @subpackage Unicon
 */

/**
 * Load file for customizer sanitization functions
*/
require $unicon_lite_sanitize_functions_file_path = unicon_lite_file_directory('unicon/customizer/unicon-sanitize.php');


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function unicon_lite_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

/**
 * General Settings Panel
*/
$wp_customize->add_panel( 'unicon_lite_general_settings_panel', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'General Settings', 'unicon-lite' ),
) );
	
	$wp_customize->get_section('title_tagline')->panel = 'unicon_lite_general_settings_panel';
	
	$wp_customize->get_section('colors')->panel = 'unicon_lite_general_settings_panel';
	
	$wp_customize->get_section('background_image')->panel = 'unicon_lite_general_settings_panel';
	
	$wp_customize->get_section('static_front_page')->panel = 'unicon_lite_general_settings_panel';
	
	$wp_customize->get_section('colors')->title = __( 'Themes Colors', 'unicon-lite' );
		
	/**
	 * Load Customizer Custom Control File
	*/
	require $unicon_lite_customizer_file_path = unicon_lite_file_directory('unicon/customizer/unicon-custom-controls.php');

	/**
	 * Load header panel file
	*/
	require $unicon_lite_customizer_header_settings_file_path = unicon_lite_file_directory('unicon/customizer/header-section/header-settings.php');

	/**
	 * Load homepage panel file
	*/
	require $unicon_lite_customizer_homepage_settings_file_path = unicon_lite_file_directory('unicon/customizer/homepage-section/homepage-settings.php');

	/**
	 * Load footer panel file
	*/
	require $unicon_lite_customizer_footer_settings_file_path = unicon_lite_file_directory('unicon/customizer/footer-section/footer-settings.php');

	/**
	 * Load footer panel file
	*/
	require $unicon_lite_customizer_blog_settings_file_path = unicon_lite_file_directory('unicon/customizer/blog-section/blog-settings.php');

/*------------------------------------------------------------------------------------*/
/**
 * Upgrade to unicon Pro
*/
// Register custom section types.
$wp_customize->register_section_type( 'Unicon_Customize_Section_Pro' );

// Register sections.
$wp_customize->add_section(
    new Unicon_Customize_Section_Pro(
        $wp_customize,
        'unicon-pro',
        array(
            'title'    => esc_html__( 'Upgrade To Unicon Pro', 'unicon-lite' ),
            'title1'    => esc_html__( 'Free vs Pro', 'unicon-lite' ),
            'pro_text' => esc_html__( 'Go Pro','unicon-lite' ),
            'pro_text1' => esc_html__( 'Compare','unicon-lite' ),
            'pro_url'  => 'https://themeforest.net/item/unicon-pro-responsive-multipurpose-wordpress-theme/20417820?ref=AccessKeys',
            'pro_url1'  => admin_url( 'themes.php?page=unicon-lite-welcome&section=free_vs_pro'),
            'priority' => 1,
        )
    )
);

/**
* Theme animations
*/
	$wp_customize->add_section('unicon_lite_animation_setting', array(
        'title'   => esc_html__('Animation Settings', 'unicon-lite'),
        'priority'=> 36,
        'panel' => 'unicon_lite_general_settings_panel'
    )); 

	    $wp_customize->add_setting( 'unicon_lite_animation_section', array(
	        'default' => 'show',
	        'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    ) );

	    $wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_animation_section',  array(
	        'type'      => 'switch',                    
	        'label'     => esc_html__( 'Enable/Disable Theme Animations', 'unicon-lite' ),
	        'section'   => 'unicon_lite_animation_setting',
	        'choices'   => array(
	    	        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
	    	        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	            )
	    ) ) );

	/**
	 * Breadcrumb Settings Area
	*/
    $wp_customize->add_section('unicon_lite_breadcrumb_setting', array(
        'title'   => esc_html__('Breadcrumb Settings', 'unicon-lite'),
        'priority'=> 36,
        'panel' => 'unicon_lite_general_settings_panel',
        'description' => __('The Breadcrumb section will be displayed in inner page as well as archive pages except in home page.', 'unicon-lite')
    )); 

	    $wp_customize->add_setting( 'unicon_lite_breadcrumb_section', array(
	        'default' => 'show',
	        'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    ) );

	    $wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_breadcrumb_section',  array(
	        'type'      => 'switch',                    
	        'label'     => esc_html__( 'Enable/Disable Breadcrumb Section', 'unicon-lite' ),
	        'section'   => 'unicon_lite_breadcrumb_setting',
	        'choices'   => array(
	    	        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
	    	        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	            )
	    ) ) );

	    $wp_customize->add_setting('unicon_lite_breadcrumb_bg_image', array(
	        'default' =>      '',
	        'sanitize_callback' => 'esc_url_raw',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'unicon_lite_breadcrumb_bg_image', array(
	        'section'  => 'unicon_lite_breadcrumb_setting',
	        'label'    => esc_html__('Upload Breadcrumb Background Image', 'unicon-lite'),
	        'type'     => 'image',
	    ) ) );


	    $wp_customize->add_setting( 'unicon_lite_breadcrumb_menu', array(
	        'default' => 'show',
	        'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    ) );

	    $wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_breadcrumb_menu',  array(
	        'type'      => 'switch',                    
	        'label'     => esc_html__( 'Enable/Disable Breadcrumb Menu', 'unicon-lite' ),
	        'section'   => 'unicon_lite_breadcrumb_setting',
	        'choices'   => array(
	    	        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
	    	        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	            )
	    ) ) );
}
add_action( 'customize_register', 'unicon_lite_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function unicon_lite_customize_preview_js() {
	wp_enqueue_script( 'unicon-customizer', get_template_directory_uri() . '/unicon/customizer/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'unicon_lite_customize_preview_js' );


/**
 * Enqueue scripts and style for customizer
*/
function unicon_lite_customize_backend_scripts() {
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/font-awesome.min.css');
	wp_enqueue_style( 'unicon-lite-customizer-style', get_template_directory_uri() . '/unicon/customizer/assets/css/customizer-style.css' );
	wp_enqueue_script( 'unicon-lite-customizer-script', get_template_directory_uri() . '/unicon/customizer/assets/js/customizer-scripts.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action( 'customize_controls_enqueue_scripts', 'unicon_lite_customize_backend_scripts', 10 );
