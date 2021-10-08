<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Unicon
 */

$post_sidebar = esc_attr(get_post_meta($post->ID, 'unicon_lite_page_layouts', true));

if(!$post_sidebar){
	$post_sidebar = 'rightsidebar';
}

if ( $post_sidebar ==  'nosidebar' ) {
	return;
}

if( $post_sidebar == 'rightsidebar' || $post_sidebar == 'bothsidebar'  && is_active_sidebar('unicon-lite-leftsidebar')){ ?>
		<aside id="secondaryright" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'unicon-lite-rightsidebar' ); ?>
		</aside><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'leftsidebar' || $post_sidebar == 'bothsidebar'  && is_active_sidebar('unicon-lite-rightsidebar')){ ?>
		<aside id="secondaryleft" class="widget-area right" role="complementary">
			<?php dynamic_sidebar( 'unicon-lite-leftsidebar' ); ?>
		</aside><!-- #secondary -->
	<?php
}
