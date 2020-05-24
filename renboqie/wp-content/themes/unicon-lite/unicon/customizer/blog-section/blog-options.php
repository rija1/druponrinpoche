<?php
    global $unicon_lite_categories;

    $wp_customize->add_setting( 'unicon_display_number_blog_post', array(
        'default'           => 10,
        'sanitize_callback' => 'unicon_lite_number_sanitize'
    ) );

    $wp_customize->add_control( 'unicon_display_number_blog_post', array(
        'type'    => 'number',
        'label'    => esc_html__( 'Display Number of Blog Posts ', 'unicon-lite' ),
        'section'  => 'unicon_lite_blogs_setting'
    ) );

    $wp_customize->add_setting( 'blog_categories', array(
        'default'           => array( 'uncategorized' ),
        'sanitize_callback' => 'unicon_lite_multiple_categories_sanitize'
    ) );

    $wp_customize->add_control( new Unicon_Lite_Customize_Control_Checkbox_Multiple( $wp_customize, 'blog_categories', array(
        'section' => 'unicon_lite_blogs_setting',
        'label'   => esc_html__( 'Select Blogs Categories', 'unicon-lite' ),
        'choices' => $unicon_lite_categories
    ) ) );

