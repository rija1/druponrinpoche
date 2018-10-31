<?php
/* Aobut Section */
$wp_customize->add_section( 'unicon_lite_about_section', array(
    'title'		=> esc_html__( 'About Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 1,
) );

	$wp_customize->add_setting( 'unicon_lite_about_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_about_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_about_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* About Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_about_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Company','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_about_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_about_section',
	    'settings' => 'unicon_lite_about_section_main_title'
	) );

	/* About Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_about_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('We Are Goahead','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_about_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_about_section',
	    'settings' => 'unicon_lite_about_section_sub_title'
	) );

	/* About Section Page */
	$wp_customize->add_setting( 'unicon_lite_about_section_page', array(
		'default'           => '0',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'unicon_lite_about_section_page', array(
		'label'    => esc_html__( 'Select About Section Page', 'unicon-lite' ),
		'section'  => 'unicon_lite_about_section',
		'type'     => 'dropdown-pages'
	) );

	/* About Section Category */
	$wp_customize->add_setting( 'unicon_lite_team_id', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Category_Control( $wp_customize, 'unicon_lite_team_id', array(
	    'label' => esc_html__( 'Select About Section Category', 'unicon-lite' ),
	    'section' => 'unicon_lite_about_section',
	) ) );


/* Services Section */
$wp_customize->add_section( 'unicon_lite_services_section', array(
    'title'		=> esc_html__( 'Services Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 2,
) );

	$wp_customize->add_setting( 'unicon_lite_services_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_services_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_services_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Services Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_services_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Services','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_services_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_services_section',
	    'settings' => 'unicon_lite_services_section_main_title'
	) );

	/* Services Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_services_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('What We Do','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_services_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_services_section',
	    'settings' => 'unicon_lite_services_section_sub_title'
	) );

	/* Our Services Full Background Image */
	$wp_customize->add_setting( 'unicon_lite_services_bg_image', array(
	    'default'       =>      '',
	    'sanitize_callback' => 'esc_url_raw'  // done
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'unicon_lite_services_bg_image', array(
	    'section'    =>      'unicon_lite_services_section',
	    'label'      =>      esc_html__('Upload Services Area Background Image', 'unicon-lite'),
	    'type'       =>      'image',
	) ) );


    $unicon_lite_default_service_icon = array( 'fa-flag', 'fa-database', 'fa-codepen', 'fa-hand-o-left', 'fa-coffee', 'fa-coffee' );
    $unicon_lite_separator_label = array( esc_html__('First', 'unicon-lite'), esc_html__('Second', 'unicon-lite'), esc_html__('Third', 'unicon-lite'), esc_html__('Forth', 'unicon-lite'), esc_html__('Fifth', 'unicon-lite'), esc_html__('Sixth', 'unicon-lite') );
    foreach ( $unicon_lite_default_service_icon as $icon_key => $icon_value ) { 
	    /**
	     * Our Services Section Separator
	    */
	    $wp_customize->add_setting( 'service_lite_icon_sec_separator_'.$icon_key, array(
            'default' => '',
            'sanitize_callback' => 'unicon_lite_text_sanitize',
        ) );

	    $wp_customize->add_control( new Unicon_Lite_Customize_Section_Separator( $wp_customize,  'service_lite_icon_sec_separator_'.$icon_key,  array(
            'type' 		=> 'unicon_separator',
            'label' 	=> sprintf(esc_html__( '%s Service Section', 'unicon-lite' ), $unicon_lite_separator_label[$icon_key] ),
            'section' 	=> 'unicon_lite_services_section',
        ) ) );

	    /**
	     * Select Our Services Icon
	    */
   		$wp_customize->add_setting( 'unicon_lite_service_icon_'.$icon_key, array(
        	'default' => $icon_value,
        	'sanitize_callback' => 'unicon_lite_text_sanitize',
    	) );
    	$wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_service_icon_'.$icon_key, array(
            'type' 		=> 'unicon_icons',	                
            'label' 	=> esc_html__( 'Our Service Icon', 'unicon-lite' ),
            'description' 	=> esc_html__( 'Choose the service icon from the lists.', 'unicon-lite' ),
            'section' 	=> 'unicon_lite_services_section',
        ) ) );

	    /**
	     * Select Our Services Page in Dropdown Options
	    */
	    $wp_customize->add_setting( 'unicon_lite_service_page_id_'.$icon_key, array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint'
        ) );

	    $wp_customize->add_control( 'unicon_lite_service_page_id_'.$icon_key, array(
        	'type' => 'dropdown-pages',
            'label' => esc_html__( 'Select Service Page', 'unicon-lite' ),
            'section' => 'unicon_lite_services_section'
        ) );

	}


/* Sucess Graph Section */
$wp_customize->add_section( 'unicon_lite_sucess_graph_section', array(
    'title'		=> esc_html__( 'Sucess Graph Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 3,
) );

	$wp_customize->add_setting( 'unicon_lite_sucess_graph_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_sucess_graph_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_sucess_graph_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Sucess Graph Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_sucess_graph_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Sucess','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_sucess_graph_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_sucess_graph_section',
	    'settings' => 'unicon_lite_sucess_graph_section_main_title'
	) );

	/* Sucess Graph Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_sucess_graph_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Yearly Graph','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_sucess_graph_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_sucess_graph_section',
	    'settings' => 'unicon_lite_sucess_graph_section_sub_title'
	) );

	/* Sucess Graph Section Page */
	$wp_customize->add_setting( 'unicon_lite_sucess_graph_section_page', array(
		'default'           => '0',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'unicon_lite_sucess_graph_section_page', array(
		'label'    => esc_html__( 'Select Sucess Graph Section Page', 'unicon-lite' ),
		'section'  => 'unicon_lite_sucess_graph_section',
		'type'     => 'dropdown-pages'
	) );

	for ( $count = 1; $count <= 8; $count++ ) {

		/* Sucess Graph Yearly Percentage Section */
		$wp_customize->add_setting( 'unicon_lite_sucess_graph_percentage_' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'unicon_lite_sucess_graph_percentage_' . $count, array(
			'label'    => esc_html__( 'Enter the Yearly Sucess Percentage', 'unicon-lite' ),
			'section'  => 'unicon_lite_sucess_graph_section'
		) );

		/* Sucess Graph Yearly Section */
		$wp_customize->add_setting( 'unicon_lite_sucess_graph_year_' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'unicon_lite_text_sanitize'
		) );

		$wp_customize->add_control( 'unicon_lite_sucess_graph_year_' . $count, array(
			'type'    => 'number',
			'label'    => esc_html__( 'Enter the Sucess Yearly ', 'unicon-lite' ),
			'section'  => 'unicon_lite_sucess_graph_section'
		) );

	}


/* Sucess Graph Section */
$wp_customize->add_section( 'unicon_lite_counter_section', array(
    'title'		=> esc_html__( 'Counter Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 4,
) );
	
	$wp_customize->add_setting( 'unicon_lite_counter_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_counter_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_counter_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );


	for ( $count = 1; $count <= 4; $count++ ) {

		/* Counter Section Title */
		$wp_customize->add_setting( 'unicon_lite_counter_section_title_' . $count, array(
			'default'           => '<span>We Have</span> Completed Projects',
			'sanitize_callback' => 'unicon_lite_text_sanitize',
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'unicon_lite_counter_section_title_' . $count, array(
			'label'    => esc_html__( 'Enter the Counter Title', 'unicon-lite' ),
			'section'  => 'unicon_lite_counter_section'
		) );

		/* Counter Section Number */
		$wp_customize->add_setting( 'unicon_lite_counter_section_number_' . $count, array(
			'default'           => '272',
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'unicon_lite_counter_section_number_' . $count, array(
			'label'    => esc_html__( 'Enter the Counter Number', 'unicon-lite' ),
			'section'  => 'unicon_lite_counter_section'
		) );

		/* Counter Section Icon */
	    $wp_customize->add_setting( 'unicon_lite_counter_section_icon_' . $count, array(
	        'default' => 'fa-phone',
	        'sanitize_callback' => 'unicon_lite_text_sanitize',
	    ) );
	    $wp_customize->add_control( new Unicon_Lite_Customize_Icons_Control( $wp_customize, 'unicon_lite_counter_section_icon_' . $count, array(
	        'type'      => 'unicon_icons',                  
	        'label'     => esc_html__( 'Set the Counter Icon', 'unicon-lite' ),
	        'description'   => esc_html__( 'Set the phone icon.', 'unicon-lite' ),
	        'section'   => 'unicon_lite_counter_section',
	        'setting' => 'unicon_lite_counter_section_icon_' . $count,
	    ) ) );
		
/*		$wp_customize->add_setting( 'unicon_lite_counter_section_icon_' . $count, array(
			'default'           => 'fa fa-envelope',
			'sanitize_callback' => 'unicon_lite_text_sanitize',
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'unicon_lite_counter_section_icon_' . $count, array(
			'type'    => 'text',
			'label'    => esc_html__( 'Enter the Counter Icon', 'unicon-lite' ),
		    'description' => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'unicon-lite' ), 'fa fa-truck','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
			'section'  => 'unicon_lite_counter_section'
		) );*/

	}


/* Our Team Member Section */
$wp_customize->add_section( 'unicon_lite_team_section', array(
    'title'		=> esc_html__( 'Our Team Member Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 5,
) );

	$wp_customize->add_setting( 'unicon_lite_team_section_option', array(
	    'default' => 'hide',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_team_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_team_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Our Team Member Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_team_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Our Team','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_team_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_team_section',
	    'settings' => 'unicon_lite_team_section_main_title'
	) );

	/* Our Team Member Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_team_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Active Expert','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_team_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_team_section',
	    'settings' => 'unicon_lite_team_section_sub_title'
	) );
	

	/* Our Team Member Section Category */
	$wp_customize->add_setting( 'unicon_lite_team_team_id', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Category_Control( $wp_customize, 'unicon_lite_team_team_id', array(
	    'label' => esc_html__( 'Select Our Team Section Category', 'unicon-lite' ),
	    'description' => esc_html__( 'Select cateogry for Our Team Member Section', 'unicon-lite' ),
	    'section' => 'unicon_lite_team_section',
	) ) );


/* Video Section */
$wp_customize->add_section( 'unicon_lite_video_section', array(
    'title'		=> esc_html__( 'Video Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 6,
) );

	$wp_customize->add_setting( 'unicon_lite_video_section_option', array(
	    'default' => 'hide',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_video_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_video_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Video Section Title */
	$wp_customize->add_setting( 'unicon_lite_video_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Video Main Title','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_video_section_main_title', array(
	    'label'    => esc_html__( 'Video Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_video_section',
	    'settings' => 'unicon_lite_video_section_main_title'
	) );

	/* Very Short Video Description */
	$wp_customize->add_setting( 'unicon_lite_video_description', array(
	    'sanitize_callback' => 'wp_filter_nohtml_kses',
	    'transport' => 'postMessage',
	    'default' => esc_html__('Better security happens when we work together, Get tips on further steps you can take to protect yourself online.','unicon-lite'),
	) );

	$wp_customize->add_control( 'unicon_lite_video_description', array(
	    'type' => 'textarea',
	    'label'    => esc_html__( 'Very Short Video Description', 'unicon-lite' ),
	    'section'  => 'unicon_lite_video_section',
	    'settings' => 'unicon_lite_video_description'
	) );

	/* Video Section Title */
	$wp_customize->add_setting( 'unicon_lite_video_section_url', array(
	    'sanitize_callback' => 'esc_url_raw',
	    'default' => '',
	) );

	$wp_customize->add_control( 'unicon_lite_video_section_url', array(
	    'label'    => esc_html__( 'Enter the Youtube Video url', 'unicon-lite' ),
	    'section'  => 'unicon_lite_video_section',
	    'settings' => 'unicon_lite_video_section_url'
	) );


/* Our Works Section */
$wp_customize->add_section( 'unicon_lite_works_section', array(
    'title'		=> esc_html__( 'Our Works Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 7,
) );

	$wp_customize->add_setting( 'unicon_lite_works_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_works_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_works_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Our Works Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_works_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Our Works','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_works_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_works_section',
	    'settings' => 'unicon_lite_works_section_main_title'
	) );

	/* Our Works Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_works_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Project Done','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_works_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_works_section',
	    'settings' => 'unicon_lite_works_section_sub_title'
	) );
	

	/* Our Works Section Category */
	$wp_customize->add_setting( 'unicon_lite_works_team_id', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Category_Control( $wp_customize, 'unicon_lite_works_team_id', array(
	    'label' => esc_html__( 'Select Our Works Section Category', 'unicon-lite' ),
	    'description' => esc_html__( 'Select cateogry for Our Works Section', 'unicon-lite' ),
	    'section' => 'unicon_lite_works_section',
	) ) );



/* Call To Action Section */
$wp_customize->add_section( 'unicon_lite_call_to_action_section', array(
    'title'		=> esc_html__( 'Call To Action Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 8,
) );

	$wp_customize->add_setting( 'unicon_lite_call_to_action_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_call_to_action_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_call_to_action_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );


	$wp_customize->add_setting( 'unicon_lite_call_to_action_bg' , array(
	    'default'       =>      '',
	    'sanitize_callback' => 'esc_url_raw',  // done
	    'transport' => 'postMessage'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'unicon_lite_call_to_action_bg', array(
	    'section'    =>      'unicon_lite_call_to_action_section',
	    'label'      =>      esc_html__('Upload Call To Action Bg Image', 'unicon-lite'),
	    'type'       =>      'image',
	) ) );

	/* Call To Action Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_call_to_action_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Unicon WordPress Theme','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settings' => 'unicon_lite_call_to_action_section_main_title'
	) );


	/* Call To Action Very Short Description */
	$wp_customize->add_setting( 'unicon_lite_call_to_action_description', array(
	    'sanitize_callback' => 'wp_filter_nohtml_kses',
	    'default' => esc_html__('Build promptly, Launch Fast','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_description', array(
	    'type' => 'textarea',
	    'label'    => esc_html__( 'Very Short Description', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settings' => 'unicon_lite_call_to_action_description'
	) );

	/* First button */
	$wp_customize->add_setting( 'unicon_lite_call_to_action_first_button_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Read More','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_first_button_title', array(
	    'label'    => esc_html__( 'First button label', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settings' => 'unicon_lite_call_to_action_first_button_title'
	) );

	$wp_customize->add_setting( 'unicon_lite_call_to_action_first_button_url', array(
	    'sanitize_callback' => 'esc_url_raw',
	    'default' => esc_url( home_url( '/' ) ).'#focus',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_first_button_url', array(
	    'label'    => esc_html__( 'First button link', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settingsd' => 'unicon_lite_call_to_action_first_button_url',
	) );

	/* Second button */
	$wp_customize->add_setting( 'unicon_lite_call_to_action_second_button_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Purchase Now','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_second_button_title', array(
	    'label'    => esc_html__( 'Second button label', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settings' => 'unicon_lite_call_to_action_second_button_title'
	) );

	$wp_customize->add_setting( 'unicon_lite_call_to_action_second_button_url', array(
	    'sanitize_callback' => 'esc_url_raw',
	    'default' => esc_url( home_url( '/' ) ).'#focus',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_call_to_action_second_button_url', array(
	    'label'    => esc_html__( 'Second button link', 'unicon-lite' ),
	    'section'  => 'unicon_lite_call_to_action_section',
	    'settingsd' => 'unicon_lite_call_to_action_second_button_url',
	) );


/* Testimonial Section */
$wp_customize->add_section( 'unicon_lite_testimonial_section', array(
    'title'		=> esc_html__( 'Testimonial Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 9,
) );

	$wp_customize->add_setting( 'unicon_lite_testimonial_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_testimonial_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_testimonial_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Testimonial Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_testimonial_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Clients','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_testimonial_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_testimonial_section',
	    'settings' => 'unicon_lite_testimonial_section_main_title'
	) );

	/* Testimonial Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_testimonial_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Testimonials','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_testimonial_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_testimonial_section',
	    'settings' => 'unicon_lite_testimonial_section_sub_title'
	) );
	

	/* Testimonial Section Category */
	$wp_customize->add_setting( 'unicon_lite_testimonial_team_id', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Category_Control( $wp_customize, 'unicon_lite_testimonial_team_id', array(
	    'label' => esc_html__( 'Select Testimonial Section Category', 'unicon-lite' ),
	    'description' => esc_html__( 'Select cateogry for Testimonial Section', 'unicon-lite' ),
	    'section' => 'unicon_lite_testimonial_section',
	) ) );


/* Our Partners Section */
$wp_customize->add_section( 'unicon_lite_our_partners_section', array(
    'title'		=> esc_html__( 'Our Partners Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 10,
) );

	$wp_customize->add_setting( 'unicon_lite_our_partners_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_our_partners_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_our_partners_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Our Partners Full Background Image */
	$wp_customize->add_setting( 'unicon_lite_our_partners_bg_image', array(
	    'default'       =>      '',
	    'sanitize_callback' => 'esc_url_raw',  // done
	    'transport' => 'postMessage'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'unicon_lite_our_partners_bg_image', array(
	    'section'    =>      'unicon_lite_our_partners_section',
	    'label'      =>      esc_html__('Upload Partners Bg Image', 'unicon-lite'),
	    'type'       =>      'image',
	) ) );
	

	/* Our Partners Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_our_partners_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Our Partners','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_our_partners_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_our_partners_section',
	    'settings' => 'unicon_lite_our_partners_section_main_title'
	) );

	/* Our Partners Very Short Description */
	$wp_customize->add_setting( 'unicon_lite_our_partners_description', array(
	    'sanitize_callback' => 'wp_filter_nohtml_kses',
	    'transport' => 'postMessage',
	    'default' => esc_html__('Better security happens when we work together, Get tips on further steps you can take to protect yourself online.','unicon-lite'),
	) );

	$wp_customize->add_control( 'unicon_lite_our_partners_description', array(
	    'type' => 'textarea',
	    'label'    => esc_html__( 'Very Short Description', 'unicon-lite' ),
	    'section'  => 'unicon_lite_our_partners_section',
	    'settings' => 'unicon_lite_our_partners_description'
	) );

	/* Our Partners Logo */
	for ( $count = 1; $count <= 5; $count++ ) {

		$wp_customize->add_setting( 'unicon_lite_our_partners_logo_'.$count , array(
		    'default'       =>      '',
		    'transport' => 'postMessage',
		    'sanitize_callback' => 'esc_url_raw'  // done
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'unicon_lite_our_partners_logo_'.$count , array(
		    'section'    =>      'unicon_lite_our_partners_section',
		    'label'      =>      esc_html__('Upload Partners Logo', 'unicon-lite'),
		    'type'       =>      'image',
		) ) );

	}


/* Our Blogs Section */
$wp_customize->add_section( 'unicon_lite_blog_section', array(
    'title'		=> esc_html__( 'Our Blogs Section', 'unicon-lite' ),
    'panel'     => 'unicon-lite-homepage-panel',
    'priority'  => 11,
) );

	$wp_customize->add_setting( 'unicon_lite_blog_section_option', array(
	    'default' => 'show',
	    'sanitize_callback' => 'unicon_lite_sanitize_switch_option',
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Switch_Control( $wp_customize, 'unicon_lite_blog_section_option',  array(
	    'type'      => 'switch',                    
	    'label'     => esc_html__( 'Enable / Disable Option', 'unicon-lite' ),
	    'section'   => 'unicon_lite_blog_section',
	    'choices'   => array(
		        'show'  => esc_html__( 'Enable', 'unicon-lite' ),
		        'hide'  => esc_html__( 'Disable', 'unicon-lite' )
	        )
	) ) );

	/* Our Blogs Main Section Title */
	$wp_customize->add_setting( 'unicon_lite_blog_section_main_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Recent','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_blog_section_main_title', array(
	    'label'    => esc_html__( 'Main Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_blog_section',
	    'settings' => 'unicon_lite_blog_section_main_title'
	) );

	/* Our Blogs Sub Section Title */
	$wp_customize->add_setting( 'unicon_lite_blog_section_sub_title', array(
	    'sanitize_callback' => 'unicon_lite_text_sanitize',
	    'default' => esc_html__('Blogs','unicon-lite'),
	    'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'unicon_lite_blog_section_sub_title', array(
	    'label'    => esc_html__( 'Sub Title', 'unicon-lite' ),
	    'section'  => 'unicon_lite_blog_section',
	    'settings' => 'unicon_lite_blog_section_sub_title'
	) );

	/* Blogs Section Category */
	$wp_customize->add_setting( 'unicon_lite_blog_team_id', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Unicon_Lite_Customize_Category_Control( $wp_customize, 'unicon_lite_blog_team_id', array(
	    'label' => esc_html__( 'Select Blog Section Category', 'unicon-lite' ),
	    'description' => esc_html__( 'Select cateogry for Blog Section', 'unicon-lite' ),
	    'section' => 'unicon_lite_blog_section',
	) ) );