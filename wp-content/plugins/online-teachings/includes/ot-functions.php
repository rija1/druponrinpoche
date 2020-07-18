<?php
add_action( 'init', 'script_enqueuer' );
add_action( 'init', 'create_ot_course' );
add_action( 'init', 'create_ot_session' );
add_action( 'init', 'create_ot_attendance' );
add_action( 'init', 'create_ot_group' );
add_filter( 'rwmb_meta_boxes', 'ot_get_meta_box' );
add_action("wp_ajax_online_teaching_register", "online_teaching_register");
add_action("wp_ajax_nopriv_online_teaching_register", "please_login");
add_action( 'mb_relationships_init', 'mbRelationships');
add_filter( 'um_shortcode_args_filter', 'umShortcode', 10, 3 );
add_filter( 'manage_users_columns', 'new_modify_user_table' );
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
add_action('save_post','createOnlineCourseSessions');

const TS_TMZ = 'Europe/London';

const SESS_STATUS_NOT_STARTED = 0;
const SESS_STATUS_OPEN = 1;
const SESS_STATUS_FINISHED = 2;
const SESS_STATUS_WAITING = 3;
const SESS_STATUS_TOO_LATE = 4;

const ATT_STATUS_NOT_JOINED = 0;
const ATT_STATUS_JOINED_ONTIME = 1;
const ATT_STATUS_JOINED_LATE = 2;
const ATT_STATUS_JOINED_VERYLATE = 3;
const ATT_STATUS_PART_OF_GROUP = 4;

function script_enqueuer() {

    // Register the JS file with a unique handle, file location, and an array of dependencies
    wp_register_script( "online_teaching_script", plugin_dir_url(__FILE__).'/includes/js/online_teaching.js', array('jquery') );

    // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
    wp_localize_script( 'online_teaching_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    // enqueue jQuery library and the script you registered above
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'online_teaching_script' );
}

/**
 * Create Online Course Custom Post Type
 */
function create_ot_course() {
    register_post_type( 'online-course',
        array(
            'labels' => array(
                'name' => 'Online Courses',
                'singular_name' => 'Online Course',
                'add_new' => 'Add Online Course',
                'add_new_item' => 'Add New Online Course',
                'edit' => 'Edit',
                'edit_item' => 'Edit Online Course',
                'new_item' => 'New Online Course',
                'view' => 'View',
                'view_item' => 'View Online Course',
                'search_items' => 'Search Online Courses',
                'not_found' => 'No Online Courses found',
                'not_found_in_trash' => 'No Online Courses found in Trash',
                'parent' => 'Parent Online Course'
            ),

            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/teaching.png', __FILE__ ),
            'has_archive' => true,
        )
    );
//    flush_rewrite_rules();
}


/**
 * Create Course Teaching Session Custom Post Type
 */
function create_ot_session() {
    register_post_type( 'ot-session',
        array(
            'labels' => array(
                'name' => 'Teaching Sessions',
                'singular_name' => 'Teaching Session',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Teaching Session',
                'edit' => 'Edit',
                'edit_item' => 'Edit Teaching Session',
                'new_item' => 'New Teaching Session',
                'view' => 'View',
                'view_item' => 'View Teaching Session',
                'search_items' => 'Search Teaching Sessions',
                'not_found' => 'No Teaching Sessions found',
                'not_found_in_trash' => 'No Teaching Sessions found in Trash',
                'parent' => 'Parent Teaching Session'
            ),
            'show_in_menu' => 'edit.php?post_type=online-course',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );

}/**
 * Create Course Teaching Session Custom Post Type
 */
function create_ot_attendance() {
    register_post_type( 'ot-attendance',
        array(
            'labels' => array(
                'name' => 'Attendance',
                'singular_name' => 'Attendance',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Attendance',
                'edit' => 'Edit',
                'edit_item' => 'Edit Attendance',
                'new_item' => 'New Attendance',
                'view' => 'View',
                'view_item' => 'View Attendance',
                'search_items' => 'Search Attendance',
                'not_found' => 'No Attendance found',
                'not_found_in_trash' => 'No Attendance found in Trash',
                'parent' => 'Parent Attendance'
            ),
            'show_in_menu' => 'edit.php?post_type=online-course',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => 35,
            'supports' => array( 'title','custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );
}
/**
 * Create Online Course Custom Post Type
 */
function create_ot_group() {
    register_post_type( 'ot-att-group',
        array(
            'labels' => array(
                'name' => 'Attendees Group',
                'singular_name' => 'Attendees Group',
                'add_new' => 'Add Attendees Group',
                'add_new_item' => 'Add New Attendees Group',
                'edit' => 'Edit',
                'edit_item' => 'Edit Attendees Group',
                'new_item' => 'New Attendees Group',
                'view' => 'View',
                'view_item' => 'View Attendees Group',
                'search_items' => 'Search Attendees Group',
                'not_found' => 'No Online Attendees Group found',
                'not_found_in_trash' => 'No Attendees Group found in Trash',
                'parent' => 'Parent Attendees Group'
            ),
            'show_in_menu' => 'edit.php?post_type=online-course',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => 15,
            'supports' => array( 'title','custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );
//    flush_rewrite_rules();
}

/**
 * Add relationships between different custom post types
 */
function mbRelationships()
{
    // Add Teaching / User Relationship (for user registrations to teachings)
    MB_Relationships_API::register([
        'id' => 'users_to_course',
        'from' => [
            'object_type' => 'user',
            'admin_column' => true,  // THIS!
            'meta_box' => [
                'title' => 'Teachings Attended',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'online-course',
            'meta_box' => [
                'title' => 'Attended By',
                'context' => 'normal',

            ],
        ],
    ]);
    // Add Teaching / Session Relationship
    MB_Relationships_API::register([
        'id' => 'course_to_sessions',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'online-course',
//            'admin_column' => true,  // THIS!
            'meta_box' => [
                'title' => 'Session Posts',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'ot-session',
            'admin_column' => true,
            'meta_box' => [
                'title' => 'Belonging to Teaching',
                'context' => 'normal',

            ],
        ],
    ]);
// Add Session / Attendance Relationship
    MB_Relationships_API::register([
        'id' => 'session_to_attendance',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-session',
            'admin_column' => true,  // THIS!
            'meta_box' => [
                'title' => 'Session Attendance',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'ot-attendance',
            'admin_column' => true,
            'meta_box' => [
                'title' => 'Belonging to Session',
                'context' => 'normal',
            ],
        ],
    ]);
// Add Teaching / Attendance Relationship
    MB_Relationships_API::register([
        'id' => 'course_to_attendance',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'online-course',
//            'admin_column' => true,  // THIS!
            'meta_box' => [
                'title' => 'Session Attendance',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'ot-attendance',
            'admin_column' => true,
            'meta_box' => [
                'title' => 'Belonging to Teaching',
                'context' => 'normal',

            ],
        ],
    ]);
// Add Attendance / User Relationship
    MB_Relationships_API::register([
        'id' => 'user_to_attendance',
        'from' => [
            'object_type' => 'user',
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'ot-attendance',
            'meta_box' => [
                'title' => 'User',
                'context' => 'normal',

            ],
        ],
    ]);
    // Add User / Session Relationship
    MB_Relationships_API::register([
        'id' => 'user_to_session',
        'from' => [
            'object_type' => 'user',
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'ot-session',
            'meta_box' => [
                'title' => 'User',
                'context' => 'normal',
            ],
        ],
    ]);

    // Add Att Group / Course  Relationship
    MB_Relationships_API::register([
        'id' => 'att_group_to_course',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-att-group',
            'meta_box' => [
                'title' => 'Online Course',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'online-course',
        ],
    ]);

    // Add Att Group / Host User Relationship
    MB_Relationships_API::register([
        'id' => 'att_group_host_to_user',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-att-group',
            'meta_box' => [
                'title' => 'Host',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'user',
        ],
    ]);

    // Add Att Group / Guest User Relationship
    MB_Relationships_API::register([
        'id' => 'att_group_guests_to_user',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-att-group',
            'meta_box' => [
                'title' => 'Guests',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'user',
        ],
    ]);
}
/**
 * Add Meta Boxes
 */
function ot_get_meta_box( $meta_boxes ) {
    $prefix = '_';

    // Add Meta Boxes
    $meta_boxes[] = array(
        'id' => 'online_course_info',
        'title' => esc_html__( 'Online Teaching Info' ),
        'post_types' => array('online-course'),
        'context' => 'after_editor',
        'priority' => 'default',
        'autosave' => 'false',
        'fields' => array(
            array(
                'id' => $prefix . 'short_name',
                'type' => 'text',
                'name' => esc_html__( 'Short name', 'ot_txtd' ),
            ),
            array(
                'id' => $prefix . 'registration_close_date',
                'type' => 'datetime',
                'name' => esc_html__( 'Registration Close Time (UK Time)', 'ot_txtd' ),
            ),
            array(
                'id' => $prefix . 'teaching_sessions',
                'type' => 'datetime',
                'clone' => 'true',
                'name' => esc_html__( 'Session Times (UK Time)', 'ot_txtd' ),
            ),
        ),
    );

    $meta_boxes[] = array(
        'id' => 'ot_session_info',
        'title' => esc_html__( 'Online Session Info' ),
        'post_types' => array('ot-session'),
        'context' => 'after_editor',
        'priority' => 'default',
        'autosave' => 'false',
        'fields' => array(
            array(
                'id' => $prefix . 'session_time',
                'type' => 'datetime',
                'name' => esc_html__( 'Session Time (UK Time)', 'ot_txtd' ),
            ),
            array(
                'name'            => 'Session Status',
                'id'              => $prefix . 'status',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => SESS_STATUS_NOT_STARTED, 'label' => 'Not Started' ),
                    array( 'value' => SESS_STATUS_OPEN, 'label' => 'Open' ),
                    array( 'value' => SESS_STATUS_FINISHED, 'label' => 'Finished' ),
                ),
                // Placeholder text
                'placeholder'     => 'Select an Item',
            ),
            array(
                'id'              => $prefix . 'youtube_lang_url',
                'name'    => 'Youtube Videos Language / URLs',
                'type'    => 'text_list',
                'clone' => true,

                // Options: array of Placeholder => Label for text boxes
                // Number of options are not limited
                'options' => array(
                    'English'      => 'Language',
                    'https://www.youtube.com/watch?v=abcd' => 'Video URL',
                ),
            ),
        ),
    );

    $meta_boxes[] = array(
        'id' => 'ot_attendance_info',
        'title' => esc_html__( 'Online Attendance Info' ),
        'post_types' => array('ot-attendance'),
        'context' => 'after_editor',
        'priority' => 'default',
        'autosave' => 'false',
        'fields' => array(
            array(
                'id' => $prefix . 'joined_time',
                'type' => 'datetime',
                'name' => esc_html__( 'Joined Time', 'ot_txtd' ),
            ),
            array(
                'name'            => 'Status',
                'id'              => $prefix . 'attendance_status',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => ATT_STATUS_NOT_JOINED, 'label' => 'Not Joined' ),
                    array( 'value' => ATT_STATUS_JOINED_ONTIME, 'label' => 'Joined On Time' ),
                    array( 'value' => ATT_STATUS_JOINED_LATE, 'label' => 'Joined Late' ),
                    array( 'value' => ATT_STATUS_JOINED_VERYLATE, 'label' => 'Joined Very Late' ),
                    array( 'value' => ATT_STATUS_JOINED_VERYLATE, 'label' => 'Part of Group' ),
                ),
            ),
        ),
    );

    return $meta_boxes;
}

/**
 * Get From - To dates in readable format
 * from online course session times.
 * @param $sessionsRaw
 * @return string
 */
function getCourseFromToDates($courseId) {

    $sessions = getCourseSessions($courseId);

    $dates = array();
    foreach($sessions as $session) {
        $dates[] = rwmb_meta('_session_time',null,$session->ID);
    }

    sort($dates);

    $startDate = strftime('%d %B %Y ', strtotime($dates[0]));
    $endDate = strftime('%d %B %Y ', strtotime($dates[count($dates)-1]));

    return $startDate . ' - ' .$endDate;
}

/**
 * Registering to a course for logged in users - Ajax and Post calls
 */
function online_teaching_register() {

    // nonce check for an extra layer of security, the function will exit if it fails
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "online_teaching_register_nonce")) {
        exit("Woof Woof Woof");
    }

    $userId = get_current_user_id();
    $postId = $_REQUEST["post_id"];
    $registerAction = $_REQUEST["register"];

    $already_registered = MB_Relationships_API::has( $userId, $postId, 'users_to_course' );

    if($registerAction == 1) { // REGISTER ACTION
        if ( $already_registered ) {
            $result['type'] = "error";
            $result['registered'] = "1";
            $result['message'] = '<span class="modal_msg_hey">You are already registered to this course.</span>';
        } else {
            MB_Relationships_API::add( $userId, $postId, 'users_to_course' );
            $result['type'] = "success";
            $result['message'] = '<span class="modal_msg_alright">You have been successfully registered to this course. <br/>A link to the Youtube teaching video will appear on this page about 15 minutes before each session.</span>';
            $result['registered'] = "1";
        }
    } elseif($registerAction == 2) { // UNREGISTER ACTION
        if ( $already_registered ) {
            MB_Relationships_API::delete( $userId, $postId, 'users_to_course' );
            $result['type'] = "success";
            $result['message'] = '<span class="modal_msg_alright">You have been unregistered from this course.</span>';
            $result['registered'] = "0";
        } else {
            $result['type'] = "error";
            $result['message'] = '<span class="modal_msg_hey">You are already unregistered from this course.</span>';
            $result['registered'] = "0";
        }
    }



   // Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user is redirected to the post page
   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
       $result = json_encode($result);
       echo $result;
   }
   else {
       header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   // don't forget to end your scripts with a die() function - very important
   die();
}

/**
 * Function to be fired for logged out users
 */
function please_login() {
    echo "You must log in to register to a course";
    die();
}

// The filter callback function.
function umShortcode( $args ) {
    if (in_array($args['mode'],array('login','register'))) {
        if (is_user_logged_in() ) {
            exit( wp_redirect( 'tirthika-square' ) );
        }
    }
    return $args;
}

function pa($a,$b=0,$c=0) {
    echo '<pre>';
    if(!$c) {
        print_r($a);
    } else {
        var_dump($a);
    }
    echo '</pre>';
    if($b) { die(); }

}

function new_modify_user_table( $column ) {
    $column['passport'] = 'Passport';
    $column['registration_date'] = 'Registration Date';
    $column['group_host'] = 'Group Host';
    return $column;
}

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'passport' :
            um_fetch_user( $user_id );
            if(empty(um_user( 'passport_photo' ))) {
                return '';
            }
            $photoPath = um_user_uploads_uri() . um_user( 'passport_photo' );
            $value = '<a target="_blank" href="'.$photoPath.'">Passport Photo</a>';
            um_reset_user();
            break;
        case 'registration_date' :
            $udata = get_userdata($user_id);
            $registered = $udata->user_registered;
            return date(" d M Y H:i:s", strtotime($registered)) ;
            break;
        case 'group_host' :
            um_fetch_user( $user_id );
            $grpViewing = um_user( 'group_host' );
            if(!empty($grpViewing)) {
                return 'Yes';
            }
            return '';
            break;
        default:
    }
    return $value;
}

function isRegistrationOpen($postId=null) {

    $tmzObj = new DateTimeZone(TS_TMZ);

    if(!empty($postId)) {
        $registrationCloseDate = rwmb_meta( '_registration_close_date', null, $postId );
    } else {
        $registrationCloseDate = rwmb_meta('_registration_close_date');
    }

    // If registration date has passed
    if (new DateTime('now',$tmzObj) > new DateTime($registrationCloseDate,$tmzObj)) {
        return false;
    }

    return true;
}

function createOnlineCourseSessions($courseId)
{
    $course = get_post($courseId);
    // Check if post is an online course
    if($course->post_type == 'online-course') {

        // Check if some teaching sessions are set
        if(!empty($course->_teaching_sessions) && is_array($course->_teaching_sessions)) {

            // We get all the Sessions already associated with the Course
            $connectedSessions = getCourseSessions($courseId);

            // Extract times from associated sessions and put them in an array
            $connectedSessionsTimes = array();
            foreach ( $connectedSessions as $connectedSession ) {
                $connectedSessionsTimes[] = rwmb_meta('_session_time',array(),$connectedSession->ID);
            }

            // Loop through all session times put directly in Course _session_time field
            foreach($course->_teaching_sessions as $sessionTime) {
                // If that time doesn't exists as a Session already associated...
                if(!in_array($sessionTime,$connectedSessionsTimes)) {
                    // ...then we create that Session...
                    $title = rwmb_meta('_short_name',array(),$courseId).' '.$sessionTime;
                    $newOtSessionData = array(
                        'post_title'    => $title,
                        'post_content'  => '',
                        'post_status'   => 'publish',
                        'post_type'     => 'ot-session'
                    );
                    $newOtSessionId = wp_insert_post( $newOtSessionData, true);
                    // ... and set the session time.
                    rwmb_set_meta( $newOtSessionId, '_session_time', $sessionTime);
                    // We associate the Session to the Course
                    MB_Relationships_API::add( $courseId, $newOtSessionId, 'course_to_sessions' );
                }
            }







        }
    }
}

function getCourseSessions($courseId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'course_to_sessions',
        'from' => $courseId,
    ] );
}

function getSessionCourse($sessionId) {
    $courses = MB_Relationships_API::get_connected( [
        'id'   => 'course_to_sessions',
        'to' => $sessionId,
    ] );
    if(is_array($courses) && !empty($courses)) {
        return $courses[0];
    }
    return false;
}

function getCourseAttendance($courseId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'course_to_attendance',
        'from' => $courseId,
    ] );
}

function getSessionAttendance($sessionId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'session_to_attendance',
        'from' => $sessionId,
    ] );
}

function isUserRegisteredToCourse($userId, $courseId) {
    return MB_Relationships_API::has( $userId, $courseId, 'users_to_course' );
}

/**
 * @param $courseId
 */
function getCurrentSession($courseId) {
    $sessions = getCourseSessions($courseId);
    $tmzObj = new DateTimeZone(TS_TMZ);

    foreach($sessions as $session) {

        /// ENABLE FOR TEST
//        $session->session_final_status = SESS_STATUS_OPEN;
//        return $session;
        ///

        $session->session_final_status = SESS_STATUS_OPEN;

        $sessionTime = rwmb_meta( '_session_time', null, $session->ID );
        $sessionStatus = rwmb_meta( '_status', null, $session->ID );

        // Session has not started
        if ($sessionStatus == SESS_STATUS_NOT_STARTED) {
            // If we are later than one hour before the session and earlier than 3 hours after the session.
            if (new DateTime('now',$tmzObj) > new DateTime($sessionTime.' - 1 hour',$tmzObj) &&
                new DateTime('now',$tmzObj) < new DateTime($sessionTime.' + 3 hour',$tmzObj)) {
                $session->session_final_status = SESS_STATUS_WAITING;
                return $session;
            } else {
                // Session will happen in more than an hour, skip to check next one
                continue;
            }
        // Session has started
        } elseif($sessionStatus == SESS_STATUS_OPEN) {
            $session->session_final_status = SESS_STATUS_OPEN;
            return $session;

//            Handle Too Late status
//            // User has already visited the session page
//            if(!MB_Relationships_API::has($userId,$session->ID,'user_to_session')) {
//                $session->session_final_status = SESS_STATUS_OPEN;
//                return $session;
//            // User has not already visited the session page
//            } else {
//                // Session has started more than 10 minutes ago
//                if (new DateTime('now',$tmzObj) > new DateTime($sessionTime.' + 10 minute',$tmzObj)) {
//                    $session->session_final_status = SESS_STATUS_TOO_LATE;
//                    return $session;
//                } else {
//                    $session->session_final_status = SESS_STATUS_OPEN;
//                    return $session;
//                }
//            }
        }

    }

    return false;
}

function saveAttendance($userId,$sessionId, $courseId = null) {

    $tmzObj = new DateTimeZone(TS_TMZ);
    $joinedTime = new DateTime('now',$tmzObj);

    // If no user/session relationships = user has not joined the session before
    if(!MB_Relationships_API::has($userId,$sessionId,'user_to_session')) {
        // We create the user/session relationship
        MB_Relationships_API::add($userId,$sessionId,'user_to_session');

        // Load the session
        $session = get_post($sessionId);
        $user = get_user_by('ID',$userId);

        $title = $session->post_title.' - '.$user->data->display_name;

        // ...then we create that Attendance...
        $newOtAttendanceData = array(
            'post_title'    => $title,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'ot-attendance'
        );
        $newOtAttendanceId = wp_insert_post( $newOtAttendanceData, true);

        // ... and set the joined time.
        rwmb_set_meta( $newOtAttendanceId, '_joined_time', $joinedTime->format('Y-m-d H:i'));

        $sessionTime = rwmb_meta('_session_time',array(),$sessionId);
        // Depending on the joined time we put the status to on time, late or verylate
        if ($joinedTime > new DateTime($sessionTime.' + 20 minute',$tmzObj)) {
            rwmb_set_meta( $newOtAttendanceId, '_attendance_status', ATT_STATUS_JOINED_VERYLATE);
        } elseif($joinedTime > new DateTime($sessionTime.' + 0 minute',$tmzObj)) {
            rwmb_set_meta( $newOtAttendanceId, '_attendance_status', ATT_STATUS_JOINED_LATE);
        } else {
            rwmb_set_meta( $newOtAttendanceId, '_attendance_status', ATT_STATUS_JOINED_ONTIME);
        }

        // We associate the Attendance to the Session, Course and User
        MB_Relationships_API::add( $sessionId, $newOtAttendanceId, 'session_to_attendance' );
        MB_Relationships_API::add( $courseId, $newOtAttendanceId, 'course_to_attendance' );
        MB_Relationships_API::add( $userId, $newOtAttendanceId, 'user_to_attendance' );

    }


}

function showSessionInfo($session) {
    $allowedSessionStatuses = array(SESS_STATUS_OPEN,SESS_STATUS_WAITING,SESS_STATUS_TOO_LATE,SESS_STATUS_FINISHED);
    return in_array($session->session_final_status,$allowedSessionStatuses);
}

function getSessionTime($sessionId) {
    $date = new DateTime(rwmb_meta('_session_time',array(),$sessionId));
    return $date->format('H:i');
}

function isUserPartOfGroup($userId, $courseId) {

    global $wpdb;

    $rel_id = $wpdb->get_var(
        $wpdb->prepare(
            "
                SELECT wmr.`ID` FROM wp_mb_relationships wmr
                INNER JOIN wp_mb_relationships wmr2
                ON wmr.`from` = wmr2.`from`
                AND wmr.`to`=%d
                AND wmr.`type`='att_group_guests_to_user'
                AND wmr2.`to`=%d
                AND wmr2.`type`='att_group_to_course'            
            ",
            $userId,
            $courseId
        )
    );

    return (bool) $rel_id;

}


