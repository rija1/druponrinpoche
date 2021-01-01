<?php /* Template Name: Online Courses */ ?>
<?php
if ( !is_user_logged_in() ) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}
$userId = get_current_user_id();
$nonce = wp_create_nonce("session_waiting_open_nonce");
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog online-teachings">
        <div class="container">
            <div class="blog-columns">
                <?php get_template_part( 'online-teaching-left-menu'); ?>
                <div class="inner-page-container">
                    <h1><?php dkr_str('Online Courses'); ?></h1>
                    <?php
                    $args = array(
                        'post_type'  => 'online-course',
                        'order'    => 'ASC',
                        'meta_query' => array(
                            array(
                                'key'     => '_status',
                                'value'   => COURSE_REGIS_STATUS_COMPLETE,
                                'compare' => '!='
                            )
                        )
                    );
                    $the_query = new WP_Query( $args );
                    // pa(get_class_methods($the_query));
   
                    ?>
                    <?php echo getUpcomingTeachingHtml($userId,$nonce); ?>
                    <?php if($the_query->have_posts() ) : ?>
                        <?php while ( $the_query->have_posts() ) : ?>
                            <?php
                            $the_query->the_post();
                            // $the_query->next_post();
                            $dates = getCourseFromToDates(get_the_ID());
                            $registered = MB_Relationships_API::has( $userId, get_the_ID(), 'users_to_course' );
                            $registrationOpen = isRegistrationOpen();
                            $currentSession = getCurrentSession(get_the_ID());
                            ?>
                            <div class="teaching">
                                <div class="teaching_left">
                                    <div class="teachingDates"><?php echo $dates;  ?></div>
                                    <div class="teachingTitle"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></div>
                                    <div class="registrationStatus registYes" style="<?php echo ($registered) ? 'display:block;' : 'display:none;' ; ?>"><?php dkr_str('You are registered to this course.'); ?></div>
                                    <span class="registrationStatus registNo" style="<?php echo ($registered) ? 'display:none;' : 'display:block;' ; ?>">
                                        <?php if($registrationOpen) : ?>
                                        <?php dkr_str('You are not registered to this course.'); ?>
                                        <?php else: ?>
                                        <span class="redText"><?php dkr_str('Registration for this course is now closed.'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="teaching_right">
                                    <a class="teaching_details" href="<?php echo the_permalink(); ?>"><?php dkr_str('Details & Registration'); ?></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else: ?>
                        <p><?php dkr_str('There is no upcoming online course.'); ?></p>
                   <?php endif; ?>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">
    function sessionWaitingOpenRefresh(session_id,nonce) {

        session_id = "<?php echo $currentSession->ID; ?>";
        nonce = "<?php echo $nonce; ?>";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : myAjax.ajaxurl,
            data : {action: "session_waiting_open", session_id : session_id, nonce: nonce},
            success: function(response) {

                if(response.status == "waiting") {
                    setTimeout( function(){
                        jQuery("#session_waiting_open_"+session_id).html(response.message);
                        sessionWaitingOpenRefresh(session_id,nonce);
                    }, 10000 );
                } else if(response.status == "open")
                    jQuery("#session_waiting_open_"+session_id).html(response.message);
                // TODO : Add button BEFORE details and regis
               // jQuery("#session_waiting_open_"+session_id).html(response.message);
                }

            });
        }
</script>
