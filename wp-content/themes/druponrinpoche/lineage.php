<?php /* Template Name: Lineage */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <section class="section section-page-title">
        <!--            <div class="container">-->
        <div class="section-title">
            <div class="gutter">
                <h1><?php the_title(); ?></h1>
                <?php //the_excerpt(); ?>
            </div>
        </div>
        <!--            </div>-->
    </section> <!--  END section-page-title  -->
    <div class="section section-blog">
        <div class="container">
            <div class="inner-page-container ">
                <div class="gutter">
                    <article class="single-post">

                        <div class="article-text">
                            <?php the_content(); ?>
                        </div>

<!--                        <div class="lineages">-->
<!---->
<!--                            <div class="lineage nyingma">-->
<!--                                <a href="http://druponrinpoche.local/lineage/nyingma-lineage/">-->
<!--                                    <div class="lineage_img"><img class="alignnone wp-image-1045 size-medium" src="http://druponrinpoche.local/wp-content/uploads/2018/07/GR_W600-277x300.jpg" alt="" width="277" height="300" /></div>-->
<!--                                    <div class="lineage_name">Nyingma Lineage</div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="lineage kagyu">-->
<!--                                <a href="http://druponrinpoche.local/lineage/kagyu-lineage/">-->
<!--                                    <div class="lineage_img"><img class="alignnone wp-image-1044 size-medium" src="http://druponrinpoche.local/wp-content/uploads/2018/07/DC_W600.jpg-277x300.jpg" alt="" width="277" height="300" /></div>-->
<!--                                    <div class="lineage_name">Kagyu Lineage</div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="lineage shangpa">-->
<!--                                <a href="http://druponrinpoche.local/lineage/shangpa-kagyu-lineage/">-->
<!--                                    <div class="lineage_img"><img class="alignnone wp-image-1046 size-medium" src="http://druponrinpoche.local/wp-content/uploads/2018/07/NIG_W600.jpg-277x300.jpg" alt="" width="277" height="300" /></div>-->
<!--                                    <div class="lineage_name">Shangpa Lineage</div>-->
<!--                                </a>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->

                        <p><?php posts_nav_link(); ?></p>
                        <div class="padinate-page"><?php wp_link_pages(); ?></div>
                        <div class="comments">
                            <?php comments_template(); ?>
                        </div> <!--  END comments  -->
                    </article>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>