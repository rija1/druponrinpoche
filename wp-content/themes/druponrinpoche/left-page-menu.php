<?php /* Template Name: LeftPageMenu */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog">
        <div class="container">
            <div class="blog-columns">
                <div class="sidebar-container">
                    <?php echo wpb_list_child_pages(); ?>
                </div>
                <div class="inner-page-container">
                    <div class="section-title">
                        <div class="gutter">
                            <h1><?php the_title(); ?></h1>
                            <?php //the_excerpt(); ?>
                        </div>
                    </div>
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
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        var expandHtml =' <div class="circle-plus closed">
            <div class="circle">
            <div class="horizontal"></div>
        <div class="vertical"></div>
        </div>
        </div>';


        jQuery( '.sidebar-container li.page_item_has_children').not('.current_page_item').not('.current_page_parent').after(expandHtml);
        jQuery( '.sidebar-container .current_page_parent').after(expandHtml);

        if (jQuery( '.sidebar-container .current_page_item').hasClass('page_item_has_children')) {
        }

        jQuery('.circle-plus').on('click', function(){
            jQuery(this).toggleClass('opened');
        })

    });
</script>