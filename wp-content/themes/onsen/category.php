<?php
/**
 * The template for displaying category
 *
 * @package Onsen
 */
get_header();
?>
<section class="section section-page-title" <?php if(get_theme_mod('onsen_blog_image')) { ?> style="background-image: url('<?php echo esc_url(get_theme_mod('onsen_blog_image')); ?>')"  <?php }  ?>>
	<div class="overlay">
		<div class="container">
			<div class="section-title">
				<div class="gutter">
					<h4><?php printf( __( 'Category Archives: %s', 'onsen' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h4>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END overlay  -->
</section> <!--  END section-page-title  -->
<?php
get_template_part( 'content', 'posts' );
get_footer();
?>