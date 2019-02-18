<?php
/**
 *
 * @package Onsen
 */
?>
<?php
$categoryId = get_queried_object_id();
//$posts = get_posts(array('category'=>$categoryId,'numberposts' => 7));

?>
<div class="section section-blog">
    <div class="featured-grid">
        <?php
        query_posts('posts_per_page=1&cat=93'); /*1, 2*/
        if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            <article class="article-blog">
            <a class="article-link"  href="<?php the_permalink() ?>">
            <div id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
                    <div class="article-image">
                        <?php echo the_post_thumbnail('dkr-photo-800-500'); ?>
                    </div>
                <?php endif; ?>
                <div class="article-text">
                    <span class="category-post-title"><?php echo the_title();  ?></span>
                    <p><?php echo get_text_excerpt(get_the_excerpt(),240);?></p>
                    <span class="read_more">Read more</span>
                </div>
            </div>
            </a>
        </article>
        <?php endwhile; ?> <?php wp_reset_query(); /*4*/ ?>

        <div class="news_right_block">
            <h5>Selected Pictures</h5>
            <?php
            if ( function_exists( 'rl_gallery' ) ) { rl_gallery( '1293' ); }
            ?>
        </div>
    </div>


    <div class="posts-grid">
<?php

?>
        <?php while ( have_posts() ) : the_post();  ?>
        <a class="article-link" href="<?php the_permalink() ?>">
        <article class="article-blog">
            <div id="post-<?php echo $post->ID; ?>" <?php post_class('',$post->ID); ?>>
                <?php if ( has_post_thumbnail($post) && ! post_password_required($post) ) : ?>
                    <div class="article-image">
                        <?php echo get_the_post_thumbnail($post,'dkr-photo-300-200'); ?>
                    </div>
                <?php endif; ?>
                <div class="article-text">
                    <span class="category-post-title" href="<?php the_permalink() ?>"><?php if(get_the_title()) { echo get_the_title(); } else { echo get_the_time(); } ?></span>
                    <p><?php echo get_text_excerpt(get_the_excerpt($post),140);?></p>
                    <span class="read_more">Read more</span>
                </div>
            </div>
        </article>
        </a>
        <?php endwhile; ?>

    </div>
    <p class="pagination">
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <span class="left button-gray"><?php next_posts_link(__('Previous Posts', 'dkr')) ?></span>
            <span class="right button-gray"><?php previous_posts_link(__('Next posts', 'dkr')) ?></span>
        <?php } ?>
    </p>
</div> <!--  END section-blog  -->