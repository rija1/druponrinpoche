<?php /* Template Name: RinpocheLamas */ ?>
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
    <div class="rinpoche-lamas section section-blog">
        <div class="container">
                <div class="inner-page-container ">
                    <!-- <div class="gutter"> -->
                        <article class="single-post">
                            <div class=lamas-grid>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( '' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/drupon-khen-rinpoche.webp"/>
                                    <span class="lamas-grid-caption">主奔堪仁波切</span>
                                </a>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( 'about/rinpoches-lamas/lama-senge' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/lama-senge.webp"/>
                                    <span class="lamas-grid-caption">喇嘛僧给</span>
                                </a>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( 'about/rinpoches-lamas/jigme-phuntsok' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/khenpo-jigme-phuntsok-rinpoche.webp"/>
                                    <span class="lamas-grid-caption">法王如意宝</span>
                                </a>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( 'about/rinpoches-lamas/khenchen-pema-tsewang' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/khenpo-pema-tsewang.webp"/>
                                    <span class="lamas-grid-caption">堪千贝玛才旺</span>
                                </a>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( 'about/rinpoches-lamas/khenpo-chokhyab' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/khenpo-chokhyab.webp"/>
                                    <span class="lamas-grid-caption">堪千曲恰</span>
                                </a>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( '' ) );?>">
                                    <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/khenpo-palga.webp"/>
                                    <span class="lamas-grid-caption">堪布巴尔噶</span>
                                </a>
                            </div>
                        </article>
                    <!-- </div> -->
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>