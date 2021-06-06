<?php
/**
 *
 * @package Onsen
 */
 get_header();
$author = get_post_meta(get_the_ID(), 'Post Author', true);
?>

 <?php while (have_posts()) : the_post(); ?>
    <section class="section section-page-title">
	</section> <!--  END section-page-title  -->
	<div class="section section-blog">
		<div class="container">
            <div class="inner-page-container">
                    <article class="single-post">
                        <div class="article-text">
<!--                            <a href="--><?php //?><!--">< Back</a>-->
                            <h2><?php the_title(); ?></h2>
                            <div class="post-info">
                                <?php if (!empty($author)): ?>
                                    <div class="post-author"><?php echo rbq_trsl('By').' '.$author; ?></div>
                                <?php endif; ?>
<!--                            <p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
                                <div class="post_date"><?php the_date(); ?></div>
                            </div>
                            <?php the_content(); ?>
<!--                            <p class="tags">--><?php //the_tags(); ?><!--</p>-->
                        </div>
                        <p><?php posts_nav_link(); ?></p>
                        <div class="padinate-page"><?php wp_link_pages(); ?></div>
                        <div class="comments">
                            <?php comments_template(); ?>
                        </div>
                    </article>
            </div>
		</div> <!--  END container  -->
	</div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>