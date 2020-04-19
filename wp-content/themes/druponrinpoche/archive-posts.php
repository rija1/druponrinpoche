<?php
/**
 *
 * @package Onsen
 */
?>
<?php
//$categoryId = get_queried_object_id();
$drWebsiteConfig = getDrWebsiteConfig();
$featuredCatId = $drWebsiteConfig['featured_cat_id'];
$featuredPostIds = array();
//$posts = get_posts(array('category'=>$categoryId,'numberposts' => 7));

?>
<div class="section section-blog">
    <div class="news_left_right">
        <div class="news_left_block">



            <div class="posts-grid">
        <?php while ( have_posts() ) : the_post();  ?>
            <?php
            $author = get_post_meta(get_the_ID(), 'Post Author', true);
            ?>
            <a class="article-link" href="<?php the_permalink() ?>">
            <article class="article-blog">
                <div id="post-<?php echo $post->ID; ?>" <?php post_class('',$post->ID); ?>>
                    <?php if ( has_post_thumbnail($post) && ! post_password_required($post) ) : ?>
                        <div class="article-image">
                            <?php echo get_the_post_thumbnail($post,'dkr-photo-322-215'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="article-text">
                        <span class="category-post-title" href="<?php the_permalink() ?>"><?php if(get_the_title()) { echo get_the_title(); } else { echo get_the_time(); } ?></span>
                        <div class="post-info">
                            <?php if (!empty($author)): ?>
                                <div class="post-author"><?php echo pll_e('By').' '.$author; ?></div>
                            <?php endif; ?>
                            <div class="post_date"><?php echo get_the_date(); ?></div>
                        </div>
                        <p><?php echo get_text_excerpt(get_the_excerpt($post),140);?></p>
        <!--                <span class="read_more">--><?php //pll_e('Read More'); ?><!--</span>-->
                    </div>
                </div>
            </article>
            </a>
        <?php endwhile; ?>
        </div>

        </div>

        <div class="news_right_block">
            <?php
            /* translators: %1$s: smiley */
            //$archive_content = '<p>' . pll_e( 'All posts by month') . '</p>';
            the_widget( 'WP_Widget_Archives', array('count'=>1), "" );
            ?>
            <!--            <h5>--><?php //pll_e('Selected Pictures'); ?><!--</h5>-->
            <!--            --><?php
            //            if ( function_exists( 'rl_gallery' ) ) { rl_gallery(array('id'=> '1293')); }
            //            ?>
        </div>
    </div>

    <?php
    the_posts_pagination( array(
        'mid_size'  => 2,
        'show_all' => true,
        'prev_text' => pll__('Previous Posts'),
        'next_text' => pll__('Next posts'),
    ) );
    ?>

</div> <!--  END section-blog  -->


