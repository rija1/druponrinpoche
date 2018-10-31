<?php
/**
 *
 * @package Onsen
 */
?>
<div class="section section-blog">
	<div class="container">
		<div class="blog-columns clearfix">
			<div class="inner-page-container left">
				<div class="gutter">
					<?php while (have_posts()) : the_post(); ?>
					<article class="article-blog">
					    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<div class="article-image">
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('onsen-photo-800-500'); ?></a>
							</div>
							<?php endif; ?>
							<div class="article-text">
								<h2><a href="<?php the_permalink() ?>"><?php if(get_the_title(get_the_id())) { the_title(); } else { the_time( get_option( 'date_format' ) ); } ?></a></h2>
<!--								<p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
								<p><?php the_excerpt(); ?></p>
								<a class="button" href="<?php the_permalink() ?>"><?php _e( 'Learn More', 'onsen' ); ?></a>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
					<p class="pagination">
					<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
							<span class="left button-gray"><?php next_posts_link(__('Previous Posts', 'onsen')) ?></span>
							<span class="right button-gray"><?php previous_posts_link(__('Next posts', 'onsen')) ?></span>
					<?php } ?>
					</p>
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