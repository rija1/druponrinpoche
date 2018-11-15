<?php /* Template Name: LineagePages */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog">
        <div class="container">
            <div class="blog-columns clearfix">
                <div class="sidebar-container left">
                    <?php
                    global $post;
                    $parPost = getTopLevelParent($post);
                    ?>
                    <h5><?php echo $parPost->post_name; ?></h5>
                    <?php echo wpb_list_child_pages(); ?>
                </div>
                <div class="inner-page-container right">
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


        //jQuery( '.sidebar-container li.page_item_has_children > a').not('.current_page_item').not('.current_page_parent').after(expandHtml);
//        jQuery( '.sidebar-container .current_page_parent > a').after(expandHtml);
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
//              alert(jQuery(this).parent().find('ul.children').outerHeight(true));
//              jQuery(this).parent().find('ul.children').height(jQuery(this).parent().find('ul.children').outerHeight(true));
//              jQuery(this).parent().find('ul.children').height('100%');
//              jQuery(this).parent().find('ul.children').css('padding','12px 0px 15px 40px');

            } else {
                jQuery(this).parent().find('ul.children').css('display','none');
//              alert(jQuery(this).parent().find('ul.children').outerHeight(true));
//              jQuery(this).parent().find('ul.children').height(0);
//              jQuery(this).parent().find('ul.children').css('padding','0');

            }
        })

    });
</script>