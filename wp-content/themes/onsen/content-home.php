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
					<div class="gutter">
						<p><?php the_title(); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; wp_reset_query(); ?>
	<?php } ?>
</div>
<?php }  ?>
<section class="section section-welcome">
	<div class="container">
		<div class="section-title">
			<div class="gutter">
				<h4><?php echo esc_html(get_theme_mod('onsen_whyus_title')); ?></h4>
				<p><?php echo esc_html(get_theme_mod('onsen_whyus_content')); ?></p>
			</div>
		</div>
		<div class="column-container articles-columns">
			<?php
			if( get_theme_mod('onsen_whyus_content_1')) {
			$queryslider = new WP_query('page_id='.get_theme_mod('onsen_whyus_content_1' ,true));
			while( $queryslider->have_posts() ) : $queryslider->the_post();
			?>
			<div class="column-4-12">
				<div class="gutter">
					<article class="article-welcome">
						<div class="article-icon">
							<a class="fa fa-<?php echo esc_html(get_theme_mod('onsen_whyus_icon_1',__( 'leaf', 'onsen' ))); ?>" href="<?php the_permalink(); ?>"></a>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="article-image">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?>" alt="" /></a>
							<div class="overlay">
								<a class="fa fa-link" href="<?php the_permalink(); ?>"></a>
							</div>
						</div>
						<?php  endif; ?>
						<div class="article-text">
							<p><?php the_excerpt(); ?></p>
						</div>
					</article>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); ?>
			<?php } ?>
			<?php
			if( get_theme_mod('onsen_whyus_content_2')) {
			$queryslider = new WP_query('page_id='.get_theme_mod('onsen_whyus_content_2' ,true));
			while( $queryslider->have_posts() ) : $queryslider->the_post();
			?>
			<div class="column-4-12">
				<div class="gutter">
					<article class="article-welcome">
						<div class="article-icon">
							<a class="fa fa-<?php echo esc_html(get_theme_mod('onsen_whyus_icon_2',__( 'heartbeat', 'onsen' ))); ?>" href="<?php the_permalink(); ?>"></a>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="article-image">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?>" alt="" /></a>
							<div class="overlay">
								<a class="fa fa-link" href="<?php the_permalink(); ?>"></a>
							</div>
						</div>
						<?php  endif; ?>
						<div class="article-text">
							<p><?php the_excerpt(); ?></p>
						</div>
					</article>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); ?>
			<?php } ?>
			<?php
			if( get_theme_mod('onsen_whyus_content_3')) {
			$queryslider = new WP_query('page_id='.get_theme_mod('onsen_whyus_content_3' ,true));
			while( $queryslider->have_posts() ) : $queryslider->the_post();
			?>
			<div class="column-4-12">
				<div class="gutter">
					<article class="article-welcome">
						<div class="article-icon">
							<a class="fa fa-<?php echo esc_html(get_theme_mod('onsen_whyus_icon_3',__( 'sun-o', 'onsen' ))); ?>" href="<?php the_permalink(); ?>"></a>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="article-image">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?>" alt="" /></a>
							<div class="overlay">
								<a class="fa fa-link" href="<?php the_permalink(); ?>"></a>
							</div>
						</div>
						<?php  endif; ?>
						<div class="article-text">
							<p><?php the_excerpt(); ?></p>
						</div>
					</article>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); ?>
			<?php } ?>
		</div>
	</div> <!--  END container  -->
</section> <!--  END section-welcome  -->
<?php while (have_posts()) : the_post(); ?>
	<div class="section section-blog">
		<div class="container">
			<div class="blog-columns clearfix">
				<div class="inner-page-container fullwidth">
					<div class="gutter">
						<article class="single-post">
							<div class="article-text">
								<?php the_content(); ?>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END section-blog  -->
<?php endwhile; ?>