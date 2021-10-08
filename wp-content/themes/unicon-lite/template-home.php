<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Front Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Unicon
 */

get_header(); 
	
	/**
	 * About Section in Front Page
	*/
	do_action( 'unicon_lite_about_section' );

	/**
	 * About Section in Front Page
	*/
	do_action( 'unicon_lite_services_section' );

	/**
	 * Sucess Graph Section in Front Page
	*/
	do_action( 'unicon_lite_sucess_graph_section' );

	/**
	 * Counter Section in Front Page
	*/
	do_action( 'unicon_lite_counter_section' );

	/**
	 * Team Section in Front Page
	*/
	do_action( 'unicon_lite_team_section' );

	/**
	 * Video Section in Front Page
	*/
	do_action( 'unicon_lite_video_section' );

	/**
	 * Our Works Section in Front Page
	*/
	do_action( 'unicon_lite_works_section' );


	/**
	 * Call To Action Section in Front Page
	*/
	do_action( 'unicon_lite_call_to_action_section' );

	/**
	 * Testimonial in Front Page
	*/
	do_action( 'unicon_lite_testimonial_section' );

	/**
	 * Our Partners in Front Page
	*/
	do_action( 'unicon_lite_partners_section' );

	/**
	 * Our Blog in Front Page
	*/
	do_action( 'unicon_lite_blog_section' );		
	

get_footer();