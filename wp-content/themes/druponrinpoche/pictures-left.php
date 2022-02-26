<?php /* Template Name: PicturesLeft */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog picture-gallery">
        <div class="container">
            <div class="blog-columns clearfix">
                <div class="inner-page-container right">
                    <div class="section-title">
                        <h1><?php the_title(); ?></h1>
                        <?php //the_excerpt(); ?>
                    </div>
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
                <div class="sidebar-container left">
                    <?php echo wpb_list_child_pages(); ?>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        var expandOffHtml ='<div class="expandContainer"><div id="expand" class="expandOff"></div></div>';
        var expandOnHtml ='<div class="expandContainer"><div id="expand" class="expandOn"></div></div>';
        jQuery( '.sidebar-container li.page_item_has_children').not('.current_page_item').not('.current_page_parent').prepend(expandOffHtml);
        jQuery( '.sidebar-container .current_page_parent').prepend(expandOnHtml);

        if (jQuery( '.sidebar-container .current_page_item').hasClass('page_item_has_children')) {
            jQuery( '.sidebar-container .current_page_item').prepend(expandOnHtml);
        }

        jQuery( ".expandContainer" ).click(function() {
            var expand = jQuery(this).find('#expand');
            if (expand.hasClass('expandOff')) {
                expand.removeClass('expandOff');
                expand.addClass('expandOn');
                jQuery(this).parent().find('ul.children').show();
            } else if (expand.hasClass('expandOn')) {
                expand.removeClass('expandOn');
                expand.addClass('expandOff');
                jQuery(this).parent().find('ul.children').hide();
            }



        });

    });
</script>