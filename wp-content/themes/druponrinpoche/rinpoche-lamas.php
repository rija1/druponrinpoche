<?php /* Template Name: RinpocheLamas */ 
$lamas = array(
            array('page_path'=>'about/rinpoches-lamas/drupon-khen-rinpoche',
                  'caption'=>'主奔堪仁波切'),
            array('page_path'=>'about/rinpoches-lamas/lama-senge',
                  'caption'=>'喇嘛僧给'),
            array('page_path'=>'about/rinpoches-lamas/jigme-phuntsok',
                  'caption'=>'法王如意宝'),
            array('page_path'=>'about/rinpoches-lamas/khenchen-pema-tsewang',
                  'caption'=>'堪千贝玛才旺'),
            array('page_path'=>'about/rinpoches-lamas/khenpo-chokhyab',
                  'caption'=>'堪千曲恰'),
            array('page_path'=>'about/rinpoches-lamas/khenpo-palga',
                  'caption'=>'堪布巴尔噶'),
);
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <section class="section section-page-title">
                <div class="section-title">
                    <div class="gutter">
                        <h1 class="centered"><?php the_title(); ?></h1>
                        <?php //the_excerpt(); ?>
                    </div>
                </div>
    </section> <!--  END section-page-title  -->
    <div class="rinpoche-lamas section section-blog">
        <div class="container">
                <div class="inner-page-container ">
                    <!-- <div class="gutter"> -->
                        <article class="single-post">
                            <div class=lamas-grid>
                                <?php foreach($lamas as $lama) : ?>
                                <a class="lamas-grid-item" href="<?php echo get_permalink( get_page_by_path( $lama['page_path'] ) );?>">
                                    <?php echo get_the_post_thumbnail( get_page_by_path($lama['page_path']), 'medium',array('class'=>'lamas-grid-img')); ?>
                                    <!-- <img class="lamas-grid-img" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/lamas/drupon-khen-rinpoche.webp"/> -->
                                    <span class="lamas-grid-caption"><?php echo $lama['caption']; ?></span>
                                </a>
                                <?php endforeach; ?>    
                            </div>
                        </article>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>