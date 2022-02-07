<?php
/**
 *
 * @package Onsen
 */
?>
<div class="section section-blog">
    <div class="posts-grid">
        <!--				<div class="gutter">-->
        <?php while (have_posts()) : the_post(); ?>
        <!-- <a class="category-post-title" href="<?php the_permalink() ?>"> -->
            <article class="article-blog">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="article-text">
                        <span class="teaching_title"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        <p class="<?php echo (isPostTibetan()) ? 'tibetan' : '' ; ?>"><?php echo get_the_content();?></p>
                        <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="swipebox">
                        <?php echo get_the_post_thumbnail( null, 'medium',array('class'=>'teaching-img')); ?>
                        </a>
                        <!--								<a class="button" href="--><?php //the_permalink() ?><!--">--><?php //_e( 'Learn More', 'dkr' ); ?><!--</a>-->
                    </div>

                </div>
            </article>
        <!-- </a> -->
        <?php endwhile; ?>
        <?php
            the_posts_pagination( array(
                'mid_size'  => 1,
                // 'show_all' => true,
                'prev_text' => json_decode('"\uF053"'),
                'next_text' => json_decode('"\uF054"'),
            ) );
            ?>
<!--            --><?php //if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
<!--                <span class="left button-gray">--><?php //next_posts_link(__('Previous Posts', 'dkr')) ?><!--</span>-->
<!--                <span class="right button-gray">--><?php //previous_posts_link(__('Next posts', 'dkr')) ?><!--</span>-->
<!--            --><?php //} ?>
        <!--				</div>-->
    </div>
</div> <!--  END section-blog  -->