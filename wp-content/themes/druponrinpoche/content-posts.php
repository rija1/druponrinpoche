<?php
/**
 *
 * @package Onsen
 */
?>
<?php
//$posts = have_posts();

$categoryId = get_queried_object_id();
$posts = get_posts(array('category'=>$categoryId,'numberposts' => 7));

?>
<div class="section section-blog">
    <div class="featured-grid">
        <article class="article-blog">
            <div id="post-<?php echo $posts[0]->ID; ?>" <?php post_class(''.$posts[0]->ID); ?>>
                <?php if ( has_post_thumbnail($posts[0]) && !post_password_required($posts[0]) ) : ?>
                    <div class="article-image">
                        <a class="category-post-title" href="<?php the_permalink($posts[0]) ?>"><?php echo get_the_post_thumbnail($posts[0],'dkr-photo-800-500'); ?></a>
                    </div>
                <?php endif; ?>
                <div class="article-text">
                    <a class="category-post-title" href="<?php the_permalink($posts[0]) ?>"><?php if(get_the_title($posts[0])) { echo get_the_title($posts[0]); } else { echo get_the_time( get_option( 'date_format' ),$posts[0] ); } ?></a>
                    <!--								<p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
                    <p><?php echo get_text_excerpt(get_the_excerpt($posts[0]),240);?></p>
                    <!--								<a class="button" href="--><?php //the_permalink() ?><!--">--><?php //_e( 'Learn More', 'dkr' ); ?><!--</a>-->
                </div>
            </div>
        </article>
        <div class="news_right_block">
            <?php
            if ( function_exists( 'rl_gallery' ) ) { rl_gallery( '1293' ); }
            ?>
        </div>
    </div>


    <div class="posts-grid">
    <?php foreach($posts as $key => $post): ?>
        <?php if($key >= 1) : ?>
        <article class="article-blog">
            <div id="post-<?php echo $post->ID; ?>" <?php post_class('',$post->ID); ?>>
                <?php if ( has_post_thumbnail($post) && ! post_password_required($post) ) : ?>
                    <div class="article-image">
                        <a class="category-post-title" href="<?php the_permalink($post) ?>"><?php echo get_the_post_thumbnail($post,'dkr-photo-300-200'); ?></a>
                    </div>
                <?php endif; ?>
                <div class="article-text">
                    <a class="category-post-title" href="<?php the_permalink($post) ?>"><?php if(get_the_title($post->ID)) { echo get_the_title($post); } else { echo get_the_time( get_option( 'date_format' ),$post ); } ?></a>
<!--								<p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
                    <p><?php echo get_text_excerpt(get_the_excerpt($post),140);?></p>
<!--								<a class="button" href="--><?php //the_permalink() ?><!--">--><?php //_e( 'Learn More', 'dkr' ); ?><!--</a>-->
                </div>
            </div>
        </article>
        <?php endif; ?>
    <?php endforeach; ?>

    <p class="pagination">
    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <span class="left button-gray"><?php next_posts_link(__('Previous Posts', 'dkr')) ?></span>
            <span class="right button-gray"><?php previous_posts_link(__('Next posts', 'dkr')) ?></span>
    <?php } ?>
    </p>
    </div>
</div> <!--  END section-blog  -->