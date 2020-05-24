<?php
/**
 *
 * @package Onsen
 */

$drWebsiteConfig = getDrWebsiteConfig();

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
                <h5><?php pll_e('About Rinpoche'); ?></h5>
                <p><?php pll_e('From an early age Rinpoche underwent long and rigorous training under the direction of supremely accomplished masters of mahamudra and dzogchen.'); ?></p>
            </div>
        </a>

    </li>
    <li class="box2">
        <?php
        $id=$drWebsiteConfig['sekhar_page_id'];
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), array(600,400));
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
            <img  src="<?php echo $url;?>" />
            <div class="inner">
                <h5><?php echo get_the_title($post); ?></h5>
                <p><?php pll_e('Thrangu Sekhar Retreat Center is situated in the hills forming the eastern rim of the Kathmandu Valley, just below a cave used by the revered Tibetan yogi, Milarepa'); ?></p>
            </div>
        </a>

    </li>
    <li class="box3">
        <?php
        $id=$drWebsiteConfig['mts_page_id'];
        $post = get_post( $id );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) , array(600,400));
        ?>
        <a href="<?php echo get_page_link($post)?>">
         <img  src="<?php echo $image[0];?>" />
            <div class="inner">
                <h5><?php echo get_the_title($post); ?></h5>
                <p><?php pll_e('The MTS was founded with the intention of making the classics of Tibetan Buddhism available to non Tibetan speaking practitioners, to aid their study and practice of Dharma.'); ?></p>
            </div>
        </a>

    </li>

    <li class="box4-mobile">
        <?php
        $id=$drWebsiteConfig['lineage_page_id'];
        $post = get_post( $id );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) , array(600,400));
        ?>
        <a href="<?php echo get_page_link($post)?>">
            <img  src="<?php echo $image[0];?>" />
            <div class="inner">
                <h5><?php pll_e('Lineage')?></h5>
            </div>
        </a>

    </li>
</ul>

<script type="text/javascript">
    jQuery( document ).ready(function() {


        jQuery('.schedule_carousel').slick({
            draggable: false,
            accessibility: false,
//                variableWidth: true,
            slidesToShow: 1,
//                slidesT
            arrows: false,
            dots:true,
//                customPaging:function(e,t){
//                    return '<button type="button" />;
//                },
            customPaging : function(slider, i) {
                return '<div class="slickdot"></div>';
            },
            appendDots:jQuery('.sched_carousel_arrows'),
            autoplay:true,
            prevArrow:'<span class="arrowLeft"></span>',
            nextArrow:'<span class="arrowRight"></span>',
            arrows:true,
            appendArrows:jQuery('.sched_carousel_arrows'),
//                swipeToSlide: true,
            infinite: true,
            autoplaySpeed:"10000"
        });

        var expandHtml = '<div class="circle-plus closed"><div class="circle"><div class="horizontal"></div><div class="vertical"></div></div></div>';


        jQuery( '.sidebar-container li.page_item_has_children').not('.current_page_item').not('.current_page_parent').after(expandHtml);
        jQuery( '.sidebar-container .current_page_parent').after(expandHtml);

        if (jQuery( '.sidebar-container .current_page_item').hasClass('page_item_has_children')) {
        }

        jQuery('.circle-plus').on('click', function(){
            jQuery(this).toggleClass('opened');
        })

    });
</script>

<?php get_footer(); ?>


