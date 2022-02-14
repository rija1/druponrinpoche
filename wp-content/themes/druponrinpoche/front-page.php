<?php
/**
 *
 * @package Onsen
 */

$drWebsiteConfig = getDrWebsiteConfig();
$locale = get_locale();

get_header();
$r = new WP_Query( apply_filters( 'widget_posts_args', array(
    'posts_per_page'      => $drWebsiteConfig['nb_latest_news_posts'],
    'no_found_rows'       => true,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'category__in' => $drWebsiteConfig['news_feat_cat_ids'],
), 'wpa' ) );
?>

<?php echo do_shortcode('[metaslider id="'.$drWebsiteConfig['home_metaslider_id'].'"]'); ?>

<div class="home_quote">
    <div class="home_quote_title">
    教言精选
    </div>
    <div class="home_quote_text">
    我们的环境或许不见得友善。甚至可能充满敌意，
但如果你有正确的内心态度，不论外在情况如何，都无法干扰你内在的宁静。
    </div>
    <div class="home_quote_button">
    <a href="">阅读更多</a>
    </div>
</div>

<ul class="home_pages_grid">
    <li class="box1">
        <?php
        $id=$drWebsiteConfig['aboutrinpoche_page_id'];
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), array(600,400));
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
            <img  src="<?php echo $url;?>" />
            <div class="inner">
                <h5><?php echo get_the_title($post); ?></h5>
           </div>
        </a>

    </li>
    <li class="box2">
        <?php
        $id=$drWebsiteConfig['monastery_page_id'];
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), array(600,400));
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
            <img  src="<?php echo $url;?>" />
            <div class="inner">
                <h5><?php echo get_the_title($post); ?></h5>
            </div>
        </a>

    </li>
    <li class="box3">
        <?php
        $id=$drWebsiteConfig['lineage_page_id'];
        $post = get_post( $id );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) , array(600,400));
        ?>
        <a href="<?php echo get_page_link($post)?>">
         <img  src="<?php echo $image[0];?>" />
            <div class="inner">
                <h5><?php echo get_the_title($post); ?></h5>
            </div>
        </a>

    </li>
</ul>

<?php get_footer(); ?>


