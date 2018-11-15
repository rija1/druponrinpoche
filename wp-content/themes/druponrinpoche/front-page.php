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
        $id=1053;
        $post = get_post( $id );
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
        $url = $src[0];
        ?>
        <a href="<?php echo get_page_link($post)?>">
             <img  src="<?php echo $url;?>" />
            <h5>About Rinpoche</h5>
        </a>
        <p>From an early age Rinpoche underwent long and rigorous training under the direction of supremely accomplished masters of mahamudra and dzogchen. Among his teachers were both famous lamas and unknown yogis of all lineages and especially the Kagyu and Nyingma lineages.</p>
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
        <p>Marpa Translation Society was founded by Drupon Khen Rinpoche in 2015, with the intention of making the classics of Tibetan Buddhism available to non-Tibetan-speaking practitioners, to aid their study and practice of Dharma.</p>
    </li>
</ul>

<ul class="home_news_carousel_grid">
    <li class="latestnews_title"><h5>Latest News</h5></li>
    <li class="latestnews">
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
    </li>
    <li class="schedule_title"><h5>Upcoming Schedule</h5></li>
    <li class="home_mini_carousel">
<!--        --><?php
//        $schedulePage = get_post( 43 );
//        echo do_shortcode('[table id=2 /]');
//        ?>
<!--        <a class="full_schedule_lnk" href="--><?php //echo get_page_link($schedulePage)?><!--">View Full Schedule</a>-->
        <div class="carousel">
            <input type="radio" id="carousel-1" name="carousel[]" checked>
            <input type="radio" id="carousel-2" name="carousel[]">
            <input type="radio" id="carousel-3" name="carousel[]">
            <input type="radio" id="carousel-4" name="carousel[]">
            <input type="radio" id="carousel-5" name="carousel[]">
            <ul class="carousel__items">
                <li class="carousel__item">
                    AHAHAHAH
                </li>
                <li class="carousel__item">
                    OHOHOHO
                </li>
                <li class="carousel__item">
                    AHAHAHAHAUUHUHUH
                </li>
                <li class="carousel__item">
                    OKOKOKOK
                </li>
                <li class="carousel__item">
                    MOMOMO
                </li>
            </ul>
            <div class="carousel__prev">
                <label for="carousel-1"></label>
                <label for="carousel-2"></label>
                <label for="carousel-3"></label>
                <label for="carousel-4"></label>
                <label for="carousel-5"></label>
            </div>
            <div class="carousel__next">
                <label for="carousel-1"></label>
                <label for="carousel-2"></label>
                <label for="carousel-3"></label>
                <label for="carousel-4"></label>
                <label for="carousel-5"></label>
            </div>
            <div class="carousel__nav">
                <label for="carousel-1"></label>
                <label for="carousel-2"></label>
                <label for="carousel-3"></label>
                <label for="carousel-4"></label>
                <label for="carousel-5"></label>
            </div>
        </div>
    </li>
</ul>

<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready(function() {
        jQuery( ".schedule tr" ).click(function() {
            window.location = '<?php echo get_page_link(get_post(43)); ?>';
        });
    });
</script>
