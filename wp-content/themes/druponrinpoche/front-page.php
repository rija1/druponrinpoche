<?php
/**
 *
 * @package Onsen
 */

$newsCategoryId = 2;
$homeMetaSliderId = 132;

get_header();
if ( 'posts' == get_option( 'show_on_front')) {
//	include( get_home_template() );
} else {

//	get_template_part( 'content', 'home' );
}


$r = new WP_Query( apply_filters( 'widget_posts_args', array(
    'posts_per_page'      => 3,
    'no_found_rows'       => true,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'category__in' => array($newsCategoryId),
), $instance ) );
?>

<?php echo do_shortcode('[metaslider id="'.$homeMetaSliderId.'"]'); ?>

<ul class="home_pages_grid">
    <li class="box1">
        <?php
        $id=1403;
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
             <img  src="<?php echo $url;?>" />
            <h5>About Rinpoche</h5>
        </a>
        <p>From an early age Rinpoche underwent long and rigorous training under the direction of supremely accomplished masters of mahamudra and dzogchen.</p>
    </li>
    <li class="box2">
        <?php
        $id=54;
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
            <img  src="<?php echo $url;?>" />
            <h5><?php echo get_the_title($post); ?></h5>
        </a>
        <p>Thrangu Sekhar Retreat Center is situated in the hills forming the eastern rim of the Kathmandu Valley, just below a cave used by the revered Tibetan yogi, Milarepa</p>
    </li>
    <li class="box3">
        <?php
        $id=693;
        $post = get_post( $id );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) , 'medium');
        ?>
        <a href="<?php echo get_page_link($post)?>">
         <img  src="<?php echo $image[0];?>" />
            <h5><?php echo get_the_title($post); ?></h5>
        </a>
        <p>The MTS was founded with the intention of making the classics of Tibetan Buddhism available to non Tibetan speaking practitioners, to aid their study and practice of Dharma.</p>
    </li>
</ul>

<div class="home_news_carousel">

    <div class="home_mini_carousel">
        <div class="schedule_title"><h5>Upcoming Schedule</h5></div>
        <?php
        $table = TablePress::$model_table->load( 1, true, true );
        $scheduleData = $table['data'];
        $schCnt = count($scheduleData)-1;
        $schCntBatch1 = round($schCnt/2,0,PHP_ROUND_HALF_UP);
        $schCntBatch2 = $schCnt - $schCntBatch1;
        ?>
        <!--        <a class="full_schedule_lnk" href="--><?php //echo get_page_link($schedulePage)?><!--">View Full Schedule</a>-->
        <div class="carousel" id="homeCarousel">
            <div class="carousel_item" style="width:386px; height:621px;">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Details</th>
                    </tr>
                    <?php for($i=1; $i<=$schCntBatch1; $i++) :?>
                    <tr>
                        <td><?php echo $scheduleData[$i][0]; ?></td>
                        <td><?php echo $scheduleData[$i][1]; ?></td>
                        <td><?php echo $scheduleData[$i][3]; ?></td>
                    </tr>
                    <?php endfor; ?>
                </table>
            </div>
            <div class="carousel_item" style="width:386px; height:557px;">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Details</th>
                    </tr>
                    <?php for($j=$schCntBatch1+1; $j<=$schCnt; $j++) :?>
                        <tr>
                            <td><?php echo $scheduleData[$j][0]; ?></td>
                            <td><?php echo $scheduleData[$j][1]; ?></td>
                            <td><?php echo $scheduleData[$j][3]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
<!--            <div class="carousel_item">-->
<!--                <h5>Super Important Information</h5>-->
<!--                <b>Bla bla bla bla bla bla</b>-->
<!--                <p>Lorem ipsum lattu gulib opilo ravlam maluchalu ipsum lattu gulib opilo ravlam maluchalu ipsum lattu gulib opilo ravlam maluchalu</p>-->
<!--            </div>-->
        </div>
    </div>

    <div class="latestnews">
        <div class="latestnews_title"><h5>Latest News</h5></div>
        <ul class="latestnews_list">
            <?php foreach ( $r->posts as $recent_post ) : ?>
                <?php
                $post_title = get_the_title( $recent_post->ID );
                $title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
                $image = wp_get_attachment_image_src( get_post_thumbnail_id($recent_post->ID) , 'medium');
                ?>
                <li class="home_post">
                    <div class="home_post_img"><img src="<?php echo $image[0];?>" /></div>
                    <div class="home_post_txt">
                    <span style="width:100%;"><a class="recent_post_link" href="<?php the_permalink( $recent_post->ID ); ?>"><?php echo $title ; ?></a></span>
                    <span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
                    <p><?php echo substr(get_the_excerpt($recent_post),0,220).' [...]'; ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>


</div>

    <script type="text/javascript">
        jQuery( document ).ready(function() {

            jQuery('#homeCarousel').cycle({
                fx:    'scrollRight',
                speed:  2000,
                timeout:  5000
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