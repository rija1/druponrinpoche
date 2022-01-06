<?php


/**
 * The main template file.
 *
 * @package Onsen
 */
error_reporting(E_ALL);
@ini_set('display_errors', 'On');

define( 'WP_DEBUG', true);



?>
<!--<section class="section section-page-title" --><?php //if(get_theme_mod('dkr_blog_image')) { ?><!-- style="background-image: url('--><?php //echo esc_url(get_theme_mod('dkr_blog_image')); ?><!--')"  --><?php //} ?><!-->
<!--	<div class="overlay">-->
<!--		<div class="container">-->
<!--			<div class="section-title">-->
<!--				<div class="gutter">-->
<!--					<h4>--><?php //echo esc_html(get_theme_mod('dkr_blog_page_title')); ?><!--</h4>-->
<!--					<p>--><?php //echo esc_html(get_theme_mod('dkr_blog_subtitle')); ?><!--</p>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div> -->
<!--	</div> -->
<!--</section> -->

<?php //echo do_shortcode('[metaslider id="132"]'); ?>

<?php





get_template_part( 'home', 'posts' );
get_footer();
?>