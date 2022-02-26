<?php /* Template Name: Monastery */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<img class="monastery-cover" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/monastery/班觉寺_crop.webp" />
    <section class="section section-page-title">
        <div class="section-title">
            <h1><span><?php the_title(); ?></span></h1>
            <?php //the_excerpt(); ?>
        </div>
    </section> <!--  END section-page-title  -->
    <div class="section section-blog">
        <div class="container">
                <div class="inner-page-container">
                    <article class="single-post">
                        <div class="article-text">
                            <?php the_content(); 

                            $abbots = array(
                                array('page_path'=>'monastery/abbots/chodrak-gyamtso-7th-karmapa',
                                        'caption'=>'第七世噶玛巴确札嘉措'),
                                array('page_path'=>'monastery/abbots/chokyi-jungne-8th-situpa',
                                        'caption'=>'第八世广定大司徒巴丘吉炯涅'),
                                array('page_path'=>'monastery/abbots/pema-wangchuk-gyalpo-11th-situpa',
                                        'caption'=>'第十一世大司徒仁波切贝玛旺秋嘉波'),
                                array('page_path'=>'monastery/abbots/karma-thupten-rinpoche',
                                        'caption'=>'噶玛土登仁波切'),
                                array('page_path'=>'monastery/abbots/kunzang-dorje',
                                        'caption'=>'根绒多吉仁波切'),
                            )
                            ?>
                            <!-- <h1><span>历任住持</span></h1> -->
                            <h2 class="cent_undline"><span>历任住持</span></h2>
                            <div class="abbots-grid">
                            <?php foreach ($abbots as $abbot): ?>
                                <a class="abbots-grid-item" href="<?php echo get_permalink( get_page_by_path($abbot['page_path']));?>">
                                <?php
                                echo get_the_post_thumbnail( get_page_by_path($abbot['page_path']), 'medium',array('class'=>'abbots-grid-img')); ?>
                                <span class="abbots-grid-caption"><?php echo $abbot['caption']; ?></span>
                            </a>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <p><?php posts_nav_link(); ?></p>
                        <div class="padinate-page"><?php wp_link_pages(); ?></div>
                        <div class="comments">
                            <?php comments_template(); ?>
                        </div> <!--  END comments  -->
                    </article>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>