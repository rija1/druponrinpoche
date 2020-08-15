<?php
require_once __DIR__ . '/../wp-load.php';

global $wpdb;

// Delete all course regis
$args = array(
    'post_type' => 'ot-course-regis',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);
if ($query->have_posts() ) {

    while ( $query->have_posts() ) {
         $query->the_post();
         wp_delete_post(get_the_ID());
        
    }
    wp_reset_postdata();
}
// End delete

$usersToCourse = $wpdb->get_results(
    $wpdb->prepare(
        "
        SELECT * FROM wp_mb_relationships wmr
        WHERE`type`='users_to_course';          
        "
    )
);

foreach ($usersToCourse as $usersToCourseRow) {
    $userId = $usersToCourseRow->from;
    $courseId = $usersToCourseRow->to;

    // We create the course registration object
    $newCourseRegisData = array(
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'ot-course-regis'
    );
    $newCourseRegisId = wp_insert_post( $newCourseRegisData, true);

    // Associate course registration with user
    MB_Relationships_API::add( $newCourseRegisId, $userId, 'course_regis_to_user' );
    // Associate course registration with course
    MB_Relationships_API::add( $newCourseRegisId, $courseId, 'course_regis_to_course' );

}
