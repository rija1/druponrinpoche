<?php
/* Blogs settings options */
$wp_customize->add_section( 'unicon_lite_blogs_setting', array(
    'priority'       => 37,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Blogs Page Template Settings', 'unicon-lite' ),
    'description'    => __( 'This setting will control your page that you create using template "Blog Page" ','unicon-lite')
) );

/**
 * Load header panel file
*/
require $unicon_customizer_blog_options_file_path = unicon_lite_file_directory('unicon/customizer/blog-section/blog-options.php');