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

<div class="home_news_carousel">

    <div class="home_mini_carousel">
        <div class="schedule_title"><h5><?php pll_e('Upcoming Schedule'); ?> 2019</h5></div>
        <?php
        $table = TablePress::$model_table->load( $drWebsiteConfig['home_schedule_id'], true, true );
        $scheduleData = $table['data'];
        unset($scheduleData[0]);

        foreach ($scheduleData as $k =>$scheduleDataLine) {
            if(!empty($scheduleDataLine[4]) && (time() > strtotime($scheduleDataLine[4]))) {
                unset($scheduleData[$k]);
            }
        }

        $schBatch2 = false;

        if(count($scheduleData) >= 12) {
            list($schBatch1, $schBatch2) = array_chunk($scheduleData, ceil(count($scheduleData) / 2));
        } else {
            $schBatch1 = $scheduleData;
        }


        ?>
        <div class="schedule_carousel_wrap">
            <div class="schedule_carousel" id="homeCarousel">
                <div>
                    <table>
                        <tr>
                            <th><?php pll_e('Date'); ?></th>
                            <th><?php pll_e('Location'); ?></th>
                            <th><?php pll_e('Details'); ?></th>
                        </tr>
                        <?php foreach($schBatch1 as $schBatch1Line) :?>
                            <tr>
                                <td><?php echo $schBatch1Line[0]; ?></td>
                                <td><?php echo $schBatch1Line[1]; ?></td>
                                <td><?php echo $schBatch1Line[3]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php if(is_array($schBatch2)) : ?>
                <div>
                    <table>
                        <tr>
                            <th><?php pll_e('Date'); ?></th>
                            <th><?php pll_e('Location'); ?></th>
                            <th><?php pll_e('Details'); ?></th>
                        </tr>
                        <?php foreach($schBatch2 as $schBatch2Line) :?>
                            <tr>
                                <td><?php echo $schBatch2Line[0]; ?></td>
                                <td><?php echo $schBatch2Line[1]; ?></td>
                                <td><?php echo $schBatch2Line[3]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?php if($locale == 'en_US') : ?>
                <div>
                    <a href="<?php echo site_url(); ?>/wp-content/uploads/2019/10/poster_sa_2019.jpg" title="" data-rl_title="" class="rl-gallery-link" data-rl_caption="" data-rel="lightbox-gallery-0">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2019/10/poster_sa_2019.jpg" alt="" >
                    </a>
                </div>
                <div>
                    <a href="<?php echo site_url(); ?>/wp-content/uploads/2019/10/poster_congo_2019.jpg" title="" data-rl_title="" class="rl-gallery-link" data-rl_caption="" data-rel="lightbox-gallery-0">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2019/10/poster_congo_2019.jpg" alt="" >
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="sched_carousel_arrows"></div>
            <a class="view_full_schedule" href="<?php echo get_page_link($drWebsiteConfig['schedule_page_id'])?>"><span><?php pll_e('View Full Schedule');?></span></a>
        </div>



    </div>

    <div class="latestnews">
        <div class="latestnews_title"><h5><?php pll_e('Latest News'); ?></h5></div>
        <ul class="latestnews_list">
            <?php foreach ( $r->posts as $recent_post ) : ?>
                <?php
                $post_title = get_the_title( $recent_post->ID );
                $title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
                $image = wp_get_attachment_image_src( get_post_thumbnail_id($recent_post->ID) , 'medium');
                ?>
                <a class="recent_post_link" href="<?php the_permalink( $recent_post->ID ); ?>">
                    <span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
                    <li class="home_post">
                        <div class="home_post_img"><img src="<?php echo $image[0];?>" /></div>
                        <div class="home_post_txt">
                        <span class="recent_post_title"><?php echo $title ; ?></span>
                        <p><?php echo get_post_meta($recent_post->ID, 'short_excerpt', true);?></p>
<!--                        <span class="read_more">--><?php //pll_e('Read More'); ?><!--</span>-->
                        </div>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>


</div>

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


