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
                        <!--								<p class="meta"><span class="meta-auth">--><?php //the_author(); ?><!--</span> <span class="meta-categ">--><?php //the_category(', '); ?><!--</span></p>-->
                        <p class="teaching_info"><?php echo get_post_meta(get_the_ID(), 'teaching_info', true);?></p>
                        <p><?php echo get_the_content();?></p>
                        <!-- <a href="http://druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa.jpg" data-rel="lightbox-gallery-Rjpw1lYs" data-rl_title="" data-rl_caption="" title="" class="swipebox"><img loading="lazy" class="wp-image-2002 size-medium" src="https://www.druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa-227x300.jpg" alt="" width="227" height="300" srcset="https://renboqie.druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa-227x300.jpg 227w, https://renboqie.druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa-768x1015.jpg 768w, https://renboqie.druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa-775x1024.jpg 775w, https://renboqie.druponrinpoche.org/wp-content/uploads/2019/02/No.32-Chökyi-Jungne-–-8th-Situpa.jpg 868w" sizes="(max-width: 227px) 100vw, 227px"></a> -->
                        <?php echo get_the_post_thumbnail( null, 'medium',array('class'=>'teaching-img')); ?>
                        <!-- </a> -->
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