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
//$term = get_queried_object();
//
//var_dump($term);
?>
<div class="section section-blog">
    <div class="featured-grid">
        <?php
        query_posts('posts_per_page=1&cat='.$featuredCatId); /*1, 2*/
//        pa($ok,1);
        if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <?php
            $featuredPostIds[] = get_the_ID();
            $author = get_post_meta(get_the_ID(), 'Post Author', true);
            ?>
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
                    <div class="post-info">
                        <?php if (!empty($author)): ?>
                            <div class="post-author"><?php echo rbq_trsl('By').' '.$author; ?></div>
                        <?php endif; ?>
                        <div class="post_date"><?php echo get_the_date(); ?></div>
                    </div>
                    <p><?php echo get_text_excerpt(get_the_excerpt(),240);?></p>
<!--                    <span class="read_more">--><?php //rbq_trsl('Read More'); ?><!--</span>-->
                </div>
            </div>
            </a>
        </article>
        <?php endwhile; ?> <?php wp_reset_query(); /*4*/ ?>

        <div class="news_right_block">
            <h5><?php rbq_trsl('Selected Pictures'); ?></h5>
            <?php
            if ( function_exists( 'rl_gallery' ) ) { rl_gallery(array('id'=> '1293')); }
            ?>
        </div>
    </div>


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
                    <?php echo get_the_post_thumbnail($post,'dkr-photo-310-207'); ?>
                </div>
            <?php endif; ?>
            <div class="article-text">
                <span class="category-post-title" href="<?php the_permalink() ?>"><?php if(get_the_title()) { echo get_the_title(); } else { echo get_the_time(); } ?></span>
                <div class="post-info">
                    <?php if (!empty($author)): ?>
                        <div class="post-author"><?php echo rbq_trsl('By').' '.$author; ?></div>
                    <?php endif; ?>
                    <div class="post_date"><?php echo get_the_date(); ?></div>
                </div>
                <p><?php echo get_text_excerpt(get_the_excerpt($post),140);?></p>
<!--                <span class="read_more">--><?php //rbq_trsl('Read More'); ?><!--</span>-->
            </div>
        </div>
    </article>
    </a>
<?php endwhile; ?>

    </div>

    <?php
    the_posts_pagination( array(
        'mid_size'  => 2,
        'show_all' => true,
        'prev_text' => rbq_trsl('Previous Posts'),
        'next_text' => rbq_trsl('Next posts'),
    ) );
    ?>

</div> <!--  END section-blog  -->