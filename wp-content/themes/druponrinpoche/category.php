<?php
/**
 * The template for displaying category
 *
 * @package Onsen
 */
get_header();
?>

<section class="section section-page-title" <?php if(get_theme_mod('dkr_blog_image')) { ?> style="background-image:; url('<?php echo esc_url(get_theme_mod('dkr_blog_image')); ?>')"  <?php }  ?>>
    <h1><?php echo single_cat_title( '', false ) ; ?></h1>
</section>

<?php
get_template_part( 'content', 'posts' );
get_footer();
?>
