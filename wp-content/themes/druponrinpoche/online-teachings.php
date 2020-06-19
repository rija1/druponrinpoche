<?php /* Template Name: Online Teachings */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog online-teachings">
        <div class="container">
            <div class="blog-columns clearfix">
                <div class="sidebar-container left">
                    <?php get_template_part( 'online-teaching-left-menu'); ?>
                </div>
                <div class="inner-page-container right">
                    <div class="gutter">
                        <h1><?php echo pll__('Online Teachings'); ?></h1>
                        <?php
                        $args = array(
                            'post_type'=> 'online-teaching',
                            'order'    => 'ASC'
                        );
                        $the_query = new WP_Query( $args );
                        ?>
                        <?php if($the_query->have_posts() ) : ?>
                            <?php while ( $the_query->have_posts() ) : ?>
                                <?php
                                $the_query->the_post();
                                $dates = getDatesFromSessions(get_post_custom_values('teaching_sessions'));
                                ?>
                                <div class="teaching">
                                    <div class="teaching_left">
                                        <div class="teachingDates"><?php echo $dates;  ?></div>
                                        <div class="teachingTitle"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></div>
<!--                                        <a class="current_teaching" href="--><?php //echo the_permalink(); ?><!--">-->
<!--                                            <span>--><?php //echo pll__('Join Current Teaching'); ?><!--</span>-->
<!--                                        </a>-->
                                    </div>
                                    <div class="teaching_right">
                                        <a class="teaching_details" href="<?php echo the_permalink(); ?>">
                                            <span><?php echo pll__('Details'); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                       <?php endif; ?>
                    </div>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>