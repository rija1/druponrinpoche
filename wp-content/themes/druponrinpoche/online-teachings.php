<?php /* Template Name: Online Courses */ ?>
<?php
if ( !is_user_logged_in() ) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}
$userId = get_current_user_id();
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog online-teachings">
        <div class="container">
            <div class="blog-columns">
                <?php get_template_part( 'online-teaching-left-menu'); ?>
                <div class="inner-page-container">
                    <h1><?php echo pll__('Online Courses'); ?></h1>
                    <?php
                    $args = array(
                        'post_type'=> 'online-course',
                        'order'    => 'ASC'
                    );
                    $the_query = new WP_Query( $args );
                    ?>
                    <?php if($the_query->have_posts() ) : ?>
                        <?php while ( $the_query->have_posts() ) : ?>
                            <?php
                            $the_query->the_post();
                            $dates = getDatesFromSessions(get_post_custom_values('teaching_sessions'));
                            $registered = MB_Relationships_API::has( $userId, get_the_ID(), 'users_to_course' );
                            $registrationOpen = isRegistrationOpen();
                            $currentSession = getCurrentSession(get_the_ID());
                            ?>
                            <div class="teaching">
                                <div class="teaching_left">
                                    <div class="teachingDates"><?php echo $dates;  ?></div>
                                    <div class="teachingTitle"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></div>
                                    <div class="registrationStatus registYes" style="<?php echo ($registered) ? 'display:block;' : 'display:none;' ; ?>"><?php echo pll__('You are registered to this course.'); ?></div>
                                    <span class="registrationStatus registNo" style="<?php echo ($registered) ? 'display:none;' : 'display:block;' ; ?>">
                                        <?php if($registrationOpen) : ?>
                                        <?php echo pll__('You are not registered to this course.'); ?>
                                        <?php else: ?>
                                        <span class="redText"><?php echo pll__('Registration for this course is now closed.'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="teaching_right">
                                    <?php if($registered && $currentSession) : ?>
                                        <a class="join_session_main" href="<?php echo the_permalink($currentSession->ID); ?>"><?php echo pll__('Watch Teaching Now'); ?></a>
                                    <?php endif; ?>
                                    <a class="teaching_details" href="<?php echo the_permalink(); ?>"><?php echo pll__('Details & Registration'); ?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                   <?php endif; ?>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>