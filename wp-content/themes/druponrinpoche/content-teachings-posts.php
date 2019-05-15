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
        <a class="category-post-title" href="<?php the_permalink() ?>">
            <article class="article-blog">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="article-text">
                        <span class="teaching_title"><?php if(get_the_title(get_the_id())) { the_title(); } else { the_time( get_option( 'date_format' ) ); } ?></span>
                        <!--								<p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
                        <p class="teaching_info"><?php echo get_post_meta(get_the_ID(), 'teaching_info', true);?></p>
                        <p><?php echo get_the_excerpt();?></p>
                        <!--								<a class="button" href="--><?php //the_permalink() ?><!--">--><?php //_e( 'Learn More', 'dkr' ); ?><!--</a>-->
                    </div>

                </div>
            </article>
        </a>
        <?php endwhile; ?>
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => pll__('Previous Posts'),
                'next_text' => pll__('Next posts'),
            ) );
            ?>
<!--            --><?php //if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
<!--                <span class="left button-gray">--><?php //next_posts_link(__('Previous Posts', 'dkr')) ?><!--</span>-->
<!--                <span class="right button-gray">--><?php //previous_posts_link(__('Next posts', 'dkr')) ?><!--</span>-->
<!--            --><?php //} ?>
        <!--				</div>-->
    </div>
</div> <!--  END section-blog  -->