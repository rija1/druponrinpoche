<?php
/* adding sections for header social options */

/* Top header settings options */
    $wp_customize->add_setting( 'unicon-lite-top-header-settings-option', array(
        'default' => 'hide',
        'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon-lite-top-header-settings-option',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Enable/Disable Option', 'unicon-lite' ),
        'description'   => esc_html__( 'Enable/Disable Top Header Section Option', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-quickinfo',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'unicon-lite' ),
            'hide'  => esc_html__( 'Disable', 'unicon-lite' )
            )
    ) ) );

$wp_customize->add_section( 'unicon-lite-header-quickinfo', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Quick Contact Info', 'unicon-lite' ),
    'panel'          => 'unicon-lite-top-header-panel'
) );

    /**
     * Select Our About Icon
    */
    $wp_customize->add_setting( 'unicon_lite_address_icon', array(
        'default' => 'fa-map-marker',
        'sanitize_callback' => 'unicon_lite_text_sanitize',
    ) );
    $wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_address_icon', array(
        'type'      => 'unicon_icons',                  
        'label'     => esc_html__( 'Address Icon', 'unicon-lite' ),
        'description'   => esc_html__( 'Choose the icon for the address.', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_address_icon',
    ) ) );
    
    $wp_customize->add_setting('unicon_lite_map_address', array(
        'default' => esc_html__('Mathuri Sadan, 5th floor Ravi Bhawan, Kathmandu, Nepal', 'unicon-lite'),
        'sanitize_callback' => 'unicon_lite_text_sanitize',  // done
    ));
    
    $wp_customize->add_control('unicon_lite_map_address',array(
        'type' => 'text',
        'label' => esc_html__('Address', 'unicon-lite'),
        'section' => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_map_address',
    ));    
    
    
    /**
     * Select Time Icon
    */
    $wp_customize->add_setting( 'unicon_lite_start_open_icon', array(
        'default' => 'fa-clock-o',
        'sanitize_callback' => 'unicon_lite_text_sanitize',
    ) );
    $wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_start_open_icon', array(
        'type'      => 'unicon_icons',                  
        'label'     => esc_html__( 'Address Icon', 'unicon-lite' ),
        'description'   => esc_html__( 'Start Time Icon.', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_start_open_icon',
    ) ) );
    
    $wp_customize->add_setting('unicon_lite_start_open_time', array(
        'default' => '',
        'sanitize_callback' => 'unicon_lite_text_sanitize',  // done
    ));
    
    $wp_customize->add_control('unicon_lite_start_open_time',array(
        'type' => 'text',
        'label' => esc_html__('Opening Time', 'unicon-lite'),
        'section' => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_start_open_time',
    ));


    /**
     * Select Email Icon
    */
    $wp_customize->add_setting( 'unicon_lite_email_icon', array(
        'default' => 'fa-envelope',
        'sanitize_callback' => 'unicon_lite_text_sanitize',
    ) );
    $wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_email_icon', array(
        'type'      => 'unicon_icons',                  
        'label'     => esc_html__( 'Email Icon', 'unicon-lite' ),
        'description'   => esc_html__( 'Start Time Icon.', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_email_icon',
    ) ) );
    
    $wp_customize->add_setting('unicon_lite_email_title', array(
        'default' => '',
        'sanitize_callback' => 'unicon_lite_text_sanitize',  // done
    ));
    
    $wp_customize->add_control('unicon_lite_email_title',array(
        'type' => 'text',
        'label' => esc_html__('Email Address', 'unicon-lite'),
        'section' => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_email_title',
    ));
    
    /** Set Phone Icon **/
    $wp_customize->add_setting( 'unicon_lite_phone_icon', array(
        'default' => 'fa-phone',
        'sanitize_callback' => 'unicon_lite_text_sanitize',
    ) );
    $wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_phone_icon', array(
        'type'      => 'unicon_icons',                  
        'label'     => esc_html__( 'Phone Icon', 'unicon-lite' ),
        'description'   => esc_html__( 'Set the phone icon.', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_phone_icon',
    ) ) );
    
    $wp_customize->add_setting('unicon_lite_phone_number', array(
        'default' => '',
        'sanitize_callback' => 'unicon_lite_text_sanitize',  // done
    ));
    
    $wp_customize->add_control('unicon_lite_phone_number',array(
        'type' => 'text',
        'label' => esc_html__('Phone Number', 'unicon-lite'),
        'section' => 'unicon-lite-header-quickinfo',
        'setting' => 'unicon_lite_phone_number',
    )); 



/* adding sections for header social options */
$wp_customize->add_section( 'unicon-lite-header-socialicon', array(
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Social Icon Options', 'unicon-lite' ),
    'panel'          => 'unicon-lite-top-header-panel'
) );

    /*facebook url*/
    $wp_customize->add_setting( 'unicon_lite_facebook_url', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'unicon_lite_facebook_url', array(
        'label'		=> esc_html__( 'Facebook url', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-socialicon',
        'settings'  => 'unicon_lite_facebook_url',
        'type'	  	=> 'url',
        'priority'  => 20
    ) );

    /*twitter url*/
    $wp_customize->add_setting( 'unicon_lite_twitter_url', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'unicon_lite_twitter_url', array(
        'label'		=> esc_html__( 'Twitter url', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-socialicon',
        'settings'  => 'unicon_lite_twitter_url',
        'type'	  	=> 'url',
        'priority'  => 25
    ) );

    /*google plus url*/
    $wp_customize->add_setting( 'unicon_lite_google_plus_url', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'unicon_lite_google_plus_url', array(
        'label'		=> esc_html__( 'Google Plus url', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-socialicon',
        'settings'  => 'unicon_lite_google_plus_url',
        'type'	  	=> 'url',
        'priority'  => 25
    ) );


    /*linkedin plus url*/
    $wp_customize->add_setting( 'unicon_lite_linkedin_url', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'unicon_lite_linkedin_url', array(
        'label'     => esc_html__( 'Google Plus url', 'unicon-lite' ),
        'section'   => 'unicon-lite-header-socialicon',
        'settings'  => 'unicon_lite_linkedin_url',
        'type'      => 'url',
        'priority'  => 30
    ) );

$wp_customize->get_section('header_image')->panel = 'unicon-lite-top-header-panel';
$wp_customize->get_section('header_image')->description = __('The Main Header Banner will be displayed in home page only.', 'unicon-lite');
$wp_customize->get_section('header_image')->title = esc_html__( 'Main Header Banner Settings', 'unicon-lite' );
$wp_customize->get_section('header_image')->priority = 1;

    

    /* Main Header Title */
    $wp_customize->add_setting( 'unicon_lite_main_title', array(
        'sanitize_callback' => 'unicon_lite_text_sanitize',
        'default' => esc_html__('SOLUTION FOR YOUR BUSINCESS','unicon-lite'),
    ) );

    $wp_customize->add_control( 'unicon_lite_main_title', array(
        'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
        'section'  => 'header_image',
        'settings' => 'unicon_lite_main_title'
    ) );

    /* Very Short Descriptions */
    $wp_customize->add_setting( 'unicon_lite_main_description', array(
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'default' => esc_html__('Better security happens when we work together, Get tips on further steps you can take to protect yourself online. better security happens when we work together happens','unicon-lite'),
    ) );

    $wp_customize->add_control( 'unicon_lite_main_description', array(
        'type' => 'textarea',
        'label'    => esc_html__( 'Very Short Description', 'unicon-lite' ),
        'section'  => 'header_image',
        'settings' => 'unicon_lite_main_description'
    ) );

    /* First button */
    $wp_customize->add_setting( 'unicon_lite_first_button_title', array(
        'sanitize_callback' => 'unicon_lite_text_sanitize',
        'default' => esc_html__('Read More','unicon-lite'),
    ) );

    $wp_customize->add_control( 'unicon_lite_first_button_title', array(
        'label'    => esc_html__( 'First button label', 'unicon-lite' ),
        'section'  => 'header_image',
        'settings' => 'unicon_lite_first_button_title'
    ) );

    $wp_customize->add_setting( 'unicon_lite_first_button_url', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => esc_url( home_url( '/' ) ).'#focus',
    ) );

    $wp_customize->add_control( 'unicon_lite_first_button_url', array(
        'label'    => esc_html__( 'First button link', 'unicon-lite' ),
        'section'  => 'header_image',
        'settingsd' => 'unicon_lite_first_button_url',
    ) );

    /* Second button */
    $wp_customize->add_setting( 'unicon_lite_second_button_title', array(
        'sanitize_callback' => 'unicon_lite_text_sanitize',
        'default' => esc_html__('Purchase Now','unicon-lite'),
    ) );

    $wp_customize->add_control( 'unicon_lite_second_button_title', array(
        'label'    => esc_html__( 'Second button label', 'unicon-lite' ),
        'section'  => 'header_image',
        'settings' => 'unicon_lite_second_button_title'
    ) );

    $wp_customize->add_setting( 'unicon_lite_second_button_url', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => esc_url( home_url( '/' ) ).'#focus',
    ) );

    $wp_customize->add_control( 'unicon_lite_second_button_url', array(
        'label'    => esc_html__( 'Second button link', 'unicon-lite' ),
        'section'  => 'header_image',
        'settingsd' => 'unicon_lite_second_button_url',
    ) );