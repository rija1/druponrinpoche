<?php
/**
 *
 * @package Onsen
 */
 get_header();
?>
<section class="section section-page-title">
</section> <!--  END section-page-title  -->
<div class="section section-blog">
	<div class="container">
		<div class="inner-page-container">
				<article class="single-post">
					<div class="article-text">
						<h1><?php dkr_str('Page Not Found'); ?></h1>
						<h2><?php dkr_str("The page you are looking for doesn't exist."); ?></h2>
						<a class="gold_button" href="<?php echo get_home_url()?>"><span><?php dkr_str('Return to the homepage');?></span></a>
<!--                            <p class="tags">--><?php //the_tags(); ?><!--</p>-->
					</div>
				</article>
		</div>
	</div> <!--  END container  -->
</div> <!--  END section-blog  -->
<?php get_footer(); ?>