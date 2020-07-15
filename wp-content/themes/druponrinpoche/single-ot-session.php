<?php
get_header();
$course = getSessionCourse(get_the_ID());
$userId = get_current_user_id();
$registeredToCourse = isUserRegisteredToCourse($userId, $course->ID);

if ( !is_user_logged_in() || !$registeredToCourse) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}

saveAttendance($userId,get_the_ID(),$course->ID);

?>
    <div class="section section-blog teachings_category">
        <div class="blog-columns">
            <?php get_template_part( 'online-teaching-left-menu'); ?>
            <div class="inner-page-container">
                <div class="gutter">
                    <article class="single-post">
                        <div class="article-text">
                            <h2><?php the_title(); ?></h2>
                            <
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div> <!--  END section-blog  -->
<?php get_footer(); ?>