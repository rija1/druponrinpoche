<?php
/**
 * The template for displaying tag
 *
 * @package Onsen
 */
get_header();
?>

    <div class="section section-blog">
        <div class="container">
            <div class="blog-columns clearfix">
                <div class="inner-page-container right">
                    <div class="section-title">
                        <div class="gutter">
                            <h1><?php printf( __( 'Quotes on: %s', 'dkr' ), '' . single_tag_title( '', false ) . '' ); ?></h1>
                        </div>
                    </div>
                    <div class="gutter">
                    <?php get_template_part( 'content', 'quotes' ); ?>
                    </div>
                </div>
                <div class="sidebar-container left">

                    <?php wp_nav_menu( array( 'theme_location' => 'teachings-tags-menu' ) ); ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>