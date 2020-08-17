<?php
require_once __DIR__ . '/../wp-load.php';

global $wpdb;

function reedzLog($str,$col='white') {
    echo '<div  style="width:700px; color:'.$col.'; width:100%; float:left; padding-bottom:10px;">'.$str.'</div>';
}

echo '<div style="width:700px; font-family:Courier; float:left; background:#222; color:white; padding:20px; margin:15px;">';

// Delete all course regis
$args = array(
    'post_type' => 'ot-course-regis',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);
if ($query->have_posts() ) {

    while ( $query->have_posts() ) {
         $query->the_post();
         reedzLog('Deleting course registration #'.get_the_ID());
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
    reedzLog('Found '.count($usersToCourseRow).' course registrations.');
    // We create the course registration object
    $newCourseRegisData = array(
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'ot-course-regis'
    );
    $newCourseRegisId = wp_insert_post( $newCourseRegisData, true);

    rwmb_set_meta( $newCourseRegisId, '_status', COURSE_REGIS_STATUS_COMPLETE);

    reedzLog('Inserted Course Registration #'.$newCourseRegisId);
    // Associate course registration with user
    MB_Relationships_API::add( $newCourseRegisId, $userId, 'course_regis_to_user' );
    // Associate course registration with course
    MB_Relationships_API::add( $newCourseRegisId, $courseId, 'course_regis_to_course' );
    reedzLog('Associated Course Registration #'.$newCourseRegisId.' to user #'.$userId.' and course #'.$courseId);

    // Check if user was group host
    $groupId = getHostGroupId($userId,$courseId);
    if($groupId) {
        $user = get_user_by( 'id',$userId );
        reedzLog('USER '.$user->data->display_name.' is a Group Viewing Host','#ebf980');
        // Set course regis as group viewing host
        rwmb_set_meta( $newCourseRegisId, '_is_group_viewing_host', 1);
        // Add relationship to guests
        $groupGuests = getGroupGuests($groupId);
        foreach($groupGuests as $groupGuest) {
            reedzLog('USER '.$groupGuest->data->display_name.' is a Guest of this Host','#ebf980');
            MB_Relationships_API::add( $newCourseRegisId, $groupGuest->ID, 'course_regis_to_guests' );
        }

    }

}

echo '</div>';