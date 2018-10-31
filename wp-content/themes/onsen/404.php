<?php
/**
 * The template for displaying page NOT FOUND.
 *
 * @package Onsen
 */
 get_header(); ?>
<section class="section section-page-title" <?php if(get_theme_mod('onsen_blog_image')) { ?> style="background-image: url('<?php echo esc_url(get_theme_mod('onsen_blog_image')); ?>')"  <?php } ?>>
	<div class="overlay">
		<div class="container">
			<div class="section-title">
				<div class="gutter">
					<h4><?php _e( 'Not found', 'onsen' ); ?></h4>
					<p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'onsen' ); ?></p>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END overlay  -->
</section> <!--  END section-page-title  -->
<?php get_footer(); ?>