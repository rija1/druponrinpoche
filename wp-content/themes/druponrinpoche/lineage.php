<?php /* Template Name: Lineage */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <section class="section section-page-title">
        <div class="section-title">
            <div class="gutter">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </section> <!--  END section-page-title  -->
    <div class="section section-blog">
        <div class="container">
            <div class="inner-page-container ">
                <div class="gutter">
                    <article class="single-post">
                        <div class="lineage-grid">
                            <a class="lineage-grid-item" href="<?php echo get_permalink( get_page_by_path( '' ) );?>">
                                    <img class="lineage-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lineage/lineage-samanthabhadra.webp"/>
                                    <span class="lineage-grid-title">宁玛传承</span>
                                    <div class="lineage-grid-text">宁玛巴（红教）是藏传佛教四大教派中最早的传承，是莲花生大士所传下来的教法，“宁玛”的意义即是“古老的”，由莲师于公元八世纪传到西藏。传承源自法身佛普贤王如来。</div>
                            </a>
                            <a class="lineage-grid-item" href="<?php echo get_permalink( get_page_by_path( '' ) );?>">
                                    <img class="lineage-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lineage/lineage-vajradhara.webp"/>
                                    <span class="lineage-grid-title">噶举传承</span>
                                    <div class="lineage-grid-text">噶举传承源自释迦牟尼佛，由大瑜伽士马尔巴译师将此无间断的传承由印度带入西藏。“噶举”藏文的含意是“口传”及“传承”，它是以直接口喻方式将三身心要、四种成就法等等法教传给弟子，以确保法教正确的延续。</div>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>