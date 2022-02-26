<?php
/**
 *
 * @package Onsen
 */
?>
<?php if( get_theme_mod('pwt_slider_content1') or get_theme_mod('pwt_slider_content2')) { ?>
<div class="owl-carousel welcome-carousel">
	<?php
	if( get_theme_mod('pwt_slider_content1')) {
	$queryslider = new WP_query('page_id='.get_theme_mod('pwt_slider_content1' ,true));
	while( $queryslider->have_posts() ) : $queryslider->the_post();
	?>
	<div class="item" <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?> style="background-image: url('<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?>')"  <?php  endif; ?>>
		<div class="overlay">
			<div class="welcome-overlay">
				<div class="container">
					<div class="gutter">
						<p><?php the_title(); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; wp_reset_query(); ?>
	<?php } ?>
	<?php
	if( get_theme_mod('pwt_slider_content2')) {
	$queryslider = new WP_query('page_id='.get_theme_mod('pwt_slider_content2' ,true));
	while( $queryslider->have_posts() ) : $queryslider->the_post();
	?>
	<div class="item" <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?> style="background-image: url('<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?>')"  <?php  endif; ?>>
		<div class="overlay">
			<div class="welcome-overlay">
				<div class="container">
					<p><?php the_title(); ?></p>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; wp_reset_query(); ?>
	<?php } ?>
</div>
<?php }  ?>

<?php while (have_posts()) : the_post(); ?>
	<div class="section section-blog">
		<div class="container">
			<div class="blog-columns clearfix">
				<div class="inner-page-container fullwidth">
					<article class="single-post">
						<div class="article-text">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END section-blog  -->
<?php endwhile; ?>