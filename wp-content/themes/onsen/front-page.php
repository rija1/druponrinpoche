<?php 
/**
 * 
 * @package Onsen 
 */
get_header();  
if ( 'posts' == get_option( 'show_on_front')) {
	include( get_home_template() );
} else {	
	get_template_part( 'content', 'home' ); 
} 
get_footer(); ?>