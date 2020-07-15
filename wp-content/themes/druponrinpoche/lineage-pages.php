<?php /* Template Name: LineagePages */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog">
        <div class="container">
            <div class="blog-columns">
                <div class="sidebar-container">
                    <?php
                    global $post;
                    $parPost = getTopLevelParent($post);
                    ?>
                    <h5><?php pll_e('Lineage'); ?></h5>
                    <?php echo wpb_list_child_pages(); ?>
                </div>
                <div class="inner-page-container">
                    <div class="gutter">
                        <div class="section-title">
                                <h1><?php the_title(); ?></h1>
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
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        var expandHtml ='<div class="circle-plus closed"><div class="circle"><div class="horizontal"></div><div class="vertical"></div></div></div>';
        jQuery( '.sidebar-container li.page_item_has_children > a').after(expandHtml);

        if (jQuery( '.sidebar-container .current_page_item').hasClass('page_item_has_children')) {
            jQuery( '.sidebar-container .current_page_item .circle-plus').toggleClass('opened');
        }

        if (jQuery( '.sidebar-container .current_page_item').parent().hasClass('children')) {
            jQuery( '.sidebar-container .current_page_item').parent().parent().toggleClass('opened');
        }

        jQuery('.circle-plus').on('click', function(){
            jQuery(this).toggleClass('opened');

            if(jQuery(this).hasClass('opened')) {
                jQuery(this).parent().find('ul.children').css('display','block');

            } else {
                jQuery(this).parent().find('ul.children').css('display','none');

            }
        })

    });
</script>