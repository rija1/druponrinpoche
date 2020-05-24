<?php
/* Adding homepage options panel*/
$wp_customize->add_panel( 'unicon-lite-homepage-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Page Settings', 'unicon-lite' ),
    'description'    => __( 'Customize your awesome site homepage settings', 'unicon-lite' )
) );

/**
 * Load header panel file
*/
require $unicon_customizer_header_options_file_path = unicon_lite_file_directory('unicon/customizer/homepage-section/homepage-options.php');