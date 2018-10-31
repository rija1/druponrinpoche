<?php
/**
 * Onsen Theme Customizer
 *
 * @package Onsen
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
function onsen_customize_register( $wp_customize ) {
	
	// Update Your Settings
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';	
	

    // Add General Sections

    $wp_customize->add_section('general',             array('title' => __('General', 'onsen'),          'description' => '',                                         'priority' => 130,));
    $wp_customize->add_section('blogpage',            array('title' => __('Blog', 'onsen'),             'description' => '',                                         'priority' => 170,));
    $wp_customize->add_section('socialmedia',         array('title' => __('Social Media', 'onsen'),     'description' => '',                                         'priority' => 180,));	

	// Add Panels

	$wp_customize->add_section('slider',                array('title' => __('Slider', 'onsen' ),          'description' => __( 'Slides Details', 'onsen' ),           'priority' => 140));
    $wp_customize->add_section('homepage',              array('title' => __('Home Page', 'onsen'),        'description' => '',                                         'priority' => 160,));


    // Add Control General Settings
	

	$wp_customize->add_setting('onsen_header_email',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_header_email',array(
			'label'	=> __('Header Email','onsen'),
			'section'	=> 'general',
			'setting'	=> 'onsen_header_email'
	));	

	$wp_customize->add_setting('onsen_header_phone',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_header_phone',array(
			'label'	=> __('Header Phone','onsen'),
			'section'	=> 'general',
			'setting'	=> 'onsen_header_phone'
	));			
	
	$wp_customize->add_setting('onsen_copyrights',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_copyrights',array(
			'label'	=> __('Copyrights Text','onsen'),
			'section'	=> 'general',
			'setting'	=> 'onsen_copyrights'
	));		
 
    // Add Control Blog Settings


	$wp_customize->add_setting('onsen_blog_image',array(
			'default'	=> esc_url(get_template_directory_uri()).'/assets/images/demo/bgh.jpg',
			'sanitize_callback'	=> 'esc_url_raw'
	));

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
		   $wp_customize,
		   'onsen_blog_image',
		   array(
			   'label'      => __( 'Blog BG Image', 'onsen' ),
			   'section'    => 'blogpage',
			   'settings'   => 'onsen_blog_image',
			   'context'    => 'onsen_blog_image' 
		   )
	   )
	);		
	
	$wp_customize->add_setting('onsen_blog_page_title',array(
			'default'	=> __('Latest Blog','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_blog_page_title',array(
			'label'	=> __('Blog Page Title','onsen'),
			'section'	=> 'blogpage',
			'setting'	=> 'onsen_blog_page_title'
	));	 
	
	$wp_customize->add_setting('onsen_blog_subtitle',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_blog_subtitle',array(
		    'type' => 'textarea',
			'label'	=> __('Blog Page Sub Title','onsen'),
			'section'	=> 'blogpage',
			'setting'	=> 'onsen_blog_subtitle'
	));	 	
	
    // Add Control Slider
	
	
	$wp_customize->add_setting('pwt_slider_content1',array(
			'default'	=> __('0','onsen'),
			'sanitize_callback'	=> 'onsen_sanitize_integer'
			
	));
	
	$wp_customize->add_control('pwt_slider_content1',array(
			'label'	=> __('Slider 1','onsen'),
			'section'	=> 'slider',
			'setting'	=> 'pwt_slider_content1',
			'type' => 'dropdown-pages'
	));		


	$wp_customize->add_setting('pwt_slider_content2',array(
			'default'	=> __('0','onsen'),
			'sanitize_callback'	=> 'onsen_sanitize_integer'
			
	));
	
	$wp_customize->add_control('pwt_slider_content2',array(
			'label'	=> __('Slider 2','onsen'),
			'section'	=> 'slider',
			'setting'	=> 'pwt_slider_content2',
			'type' => 'dropdown-pages'
	));		

		

    // Add Control Home Page	
	
	$wp_customize->add_setting('onsen_whyus_title',array(
			'default'	=> __('Welcome to our Salon','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_whyus_title',array(
			'label'	=> __('Why Us Title','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_title'
	));		

	$wp_customize->add_setting('onsen_whyus_content',array(
			'default'	=> '',
			'sanitize_callback'	=> 'esc_textarea'
	));
	
	$wp_customize->add_control('onsen_whyus_content',array(
	        'type' => 'textarea',
			'label'	=> __('Why Us Content','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_content'
	));	
	

	$wp_customize->add_setting('onsen_whyus_icon_1',array(
			'default'	=> __('leaf','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_whyus_icon_1',array(
			'label'	=> __('Why Us Icon 1','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_icon_1'
	));			
	
	$wp_customize->add_setting('onsen_whyus_content_1',array(
			'default'	=> 0,
			'sanitize_callback'	=> 'onsen_sanitize_integer'
			
	));
	
	$wp_customize->add_control('onsen_whyus_content_1',array(
			'label'	=> __('Why Us Content 1','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_content_1',
			'type' => 'dropdown-pages'
	));	
	

	$wp_customize->add_setting('onsen_whyus_icon_2',array(
			'default'	=> __('heartbeat','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_whyus_icon_2',array(
			'label'	=> __('Why Us Icon 2','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_icon_2'
	));			
	
	$wp_customize->add_setting('onsen_whyus_content_2',array(
			'default'	=> 0,
			'sanitize_callback'	=> 'onsen_sanitize_integer'
			
	));
	
	$wp_customize->add_control('onsen_whyus_content_2',array(
			'label'	=> __('Why Us Content 2','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_content_2',
			'type' => 'dropdown-pages'
	));	


	$wp_customize->add_setting('onsen_whyus_icon_3',array(
			'default'	=> __('sun-o','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_whyus_icon_3',array(
			'label'	=> __('Why Us Icon 3','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_icon_3'
	));			
	
	$wp_customize->add_setting('onsen_whyus_content_3',array(
			'default'	=> 0,
			'sanitize_callback'	=> 'onsen_sanitize_integer'
			
	));
	
	$wp_customize->add_control('onsen_whyus_content_3',array(
			'label'	=> __('Why Us Content 3','onsen'),
			'section'	=> 'homepage',
			'setting'	=> 'onsen_whyus_content_3',
			'type' => 'dropdown-pages'
	));	
	


    // Social Media	
	

	$wp_customize->add_setting('onsen_social_media_code1',array(
			'default'	=> __('facebook','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_social_media_code1',array(
			'label'	=> __('Social Media Code 1','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_code1'
	));		
	
	$wp_customize->add_setting('onsen_social_media_link1',array(
			'default'	=> __('#','onsen'),
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('onsen_social_media_link1',array(
			'label'	=> __('Social Media Link 1','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_link1'
	));		
	
	$wp_customize->add_setting('onsen_social_media_code2',array(
			'default'	=> __('twitter','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_social_media_code2',array(
			'label'	=> __('Social Media Code 2','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_code2'
	));		
	
	$wp_customize->add_setting('onsen_social_media_link2',array(
			'default'	=> __('#','onsen'),
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('onsen_social_media_link2',array(
			'label'	=> __('Social Media Link 2','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_link2'
	));		

	$wp_customize->add_setting('onsen_social_media_code3',array(
			'default'	=> __('google-plus','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_social_media_code3',array(
			'label'	=> __('Social Media Code 3','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_code3'
	));		
	
	$wp_customize->add_setting('onsen_social_media_link3',array(
			'default'	=> __('#','onsen'),
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('onsen_social_media_link3',array(
			'label'	=> __('Social Media Link 3','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_link3'
	));		

	$wp_customize->add_setting('onsen_social_media_code4',array(
			'default'	=> __('pinterest','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_social_media_code4',array(
			'label'	=> __('Social Media Code 4','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_code4'
	));		
	
	$wp_customize->add_setting('onsen_social_media_link4',array(
			'default'	=> __('#','onsen'),
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('onsen_social_media_link4',array(
			'label'	=> __('Social Media Link 4','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_link4'
	));		

	$wp_customize->add_setting('onsen_social_media_code5',array(
			'default'	=> __('linkedin','onsen'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('onsen_social_media_code5',array(
			'label'	=> __('Social Media Code 5','onsen'),
			'description' => __('Select a icon in this list <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a> and enter the code','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_code5'
	));		
	
	$wp_customize->add_setting('onsen_social_media_link5',array(
			'default'	=> __('#','onsen'),
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('onsen_social_media_link5',array(
			'label'	=> __('Social Media Link 5','onsen'),
			'section'	=> 'socialmedia',
			'setting'	=> 'onsen_social_media_link5'
	));			
	
}
add_action( 'customize_register', 'onsen_customize_register' );

function onsen_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {  return intval( $input ); }
}


function onsen_custom_customize_enqueue() {
	wp_enqueue_script( 'onsen-custom-customize', get_template_directory_uri() . '/assets/js/custom-customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'onsen_custom_customize_enqueue' );
