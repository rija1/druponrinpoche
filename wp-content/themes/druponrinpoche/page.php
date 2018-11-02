<?php
/**
 * The template for displaying all pages.
 *
 * @package Onsen
 */
 get_header(); ?>
 <?php while (have_posts()) : the_post(); ?>
<!--	<section class="section section-page-title" --><?php //if ( has_post_thumbnail() && ! post_password_required() ) : ?><!-- style="background-image: url('--><?php //echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))); ?><!--')"  --><?php // endif; ?><!-->
			<div class="container">
				<div class="section-title">
					<div class="gutter">
						<h4><?php the_title(); ?></h4>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
<!--	</section> -->
	<div class="section section-blog">
		<div class="container">
			<div class="blog-columns clearfix">
				<div class="inner-page-container left">
					<div class="gutter">
						<article class="single-post">
							<div class="article-text">
								<?php the_content(); ?>
							</div>
							<p><?php posts_nav_link(); ?></p>
							<div class="padinate-page"><?php wp_link_pages(); ?></div>
							<div class="comments">
								<?php comments_template(); ?>
							</div> <!--  END comments  -->
						</article>
					</div>
				</div>
				<div class="sidebar-container right">
					<div class="gutter">
						<?php  get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>