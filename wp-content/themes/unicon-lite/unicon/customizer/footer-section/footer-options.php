<?php
/* Buttom Footer settings options */
$wp_customize->add_section( 'unicon_lite_buttom_footer_setting', array(
    'priority'       => 35,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Footer Settings', 'unicon-lite' )
) );

    $wp_customize->add_setting( 'unicon_lite_buttom_footer_settings_option', array(
        'default' => 'show',
        'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_buttom_footer_settings_option',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Enable/Disable Option Bottom Footer', 'unicon-lite' ),
        'description'   => esc_html__( 'Enable/Disable Bottom Footer Section Option', 'unicon-lite' ),
        'section'   => 'unicon_lite_buttom_footer_setting',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'unicon-lite' ),
            'hide'  => esc_html__( 'Disable', 'unicon-lite' )
            )
    ) ) );


    $wp_customize->add_setting('unicon_lite_footer_copyright', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post'
        
    ));

    $wp_customize->add_control('unicon_lite_footer_copyright', array(
        'type' => 'textarea',
        'label' => esc_html__('Copyright', 'unicon-lite'),
        'section' => 'unicon_lite_buttom_footer_setting',
        'settings' => 'unicon_lite_footer_copyright'
    ));