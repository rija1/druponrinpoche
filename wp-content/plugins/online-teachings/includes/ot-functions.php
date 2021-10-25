<?php
add_action( 'init', 'script_enqueuer' );
add_action( 'init', 'create_ot_course' );
add_action( 'init', 'create_ot_session' );
add_action( 'init', 'create_ot_attendance' );
add_action( 'init', 'create_ot_group' );
add_action( 'init', 'create_ot_course_regis' );
add_filter( 'rwmb_meta_boxes', 'ot_get_meta_box' );
add_action("wp_ajax_online_teaching_register", "online_teaching_register");
add_action("wp_ajax_nopriv_online_teaching_register", "please_login");
add_action( 'mb_relationships_init', 'mbRelationships');
add_filter( 'um_shortcode_args_filter', 'umShortcode', 10, 3 );
add_filter( 'manage_users_columns', 'new_modify_user_table' );
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
add_filter( 'manage_ot-course-regis_posts_columns' , 'new_modify_course_regis_table');
add_action( 'manage_ot-course-regis_posts_custom_column', 'new_modify_course_regis_table_row', 10, 2 );
add_filter( 'manage_ot-session_posts_columns' , 'new_modify_session_table');
add_action( 'manage_ot-session_posts_custom_column', 'new_modify_session_table_row', 10, 2 );
add_filter( 'manage_ot-attendance_posts_columns' , 'new_modify_attendance_table');
add_action( 'manage_ot-attendance_posts_custom_column', 'new_modify_attendance_table_row', 10, 2 );
add_action('save_post','createOnlineCourseSessions');
add_action('save_post','initAllAttendance');
add_action( 'delete_post', 'deleteAllObjectRelationships', 10 );
add_action('um_after_account_general', 'after_account_general_custom_fields', 100);
add_action('um_account_pre_update_profile', 'account_pre_update_profile_newsletter_subscription', 100, 2);

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

const ATT_GROUP_HOST_TO_USER = 'att_group_host_to_user';
const ATT_GROUP_GUESTS_TO_USER = 'att_group_guests_to_user';

const COURSE_REGIS_STATUS_NOT_ATTENDED = 0;
const COURSE_REGIS_STATUS_INCOMPLETE = 1;
const COURSE_REGIS_STATUS_COMPLETE = 2;

const COURSE_STATUS_NOT_STARTED = 0;
const COURSE_STATUS_STARTED = 1;
const COURSE_STATUS_FINISHED = 2;

const MCHIMP_API_KEY = '287c02b9a2ef8cc3fea196fb44097d5a';
const MCHIMP_SVR_PREF = 'us10';
const MCHIMP_LIST_ID = 'ca06c2bf51';

function script_enqueuer() {

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
function create_ot_course_regis() {
    register_post_type( 'ot-course-regis',
        array(
            'labels' => array(
                'name' => 'Course Registration',
                'singular_name' => 'Course Registration',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Course Registration',
                'edit' => 'Edit',
                'edit_item' => 'Edit Course Registration',
                'new_item' => 'New Course Registration',
                'view' => 'View',
                'view_item' => 'View Course Registration',
                'search_items' => 'Search Course Registration',
                'not_found' => 'No Course Registration found',
                'not_found_in_trash' => 'No Course Registration found in Trash',
                'parent' => 'Parent Course Registration'
            ),
            'show_in_menu' => 'edit.php?post_type=online-course',
            'public' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'menu_position' => 1,
            'supports' => array( 'custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,                                                
        )
    );
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
            'menu_position' => 18,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );

}
/**
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
            'publicly_queryable' => false,
            'exclude_from_search' => true,
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
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'menu_position' => 15,
            'supports' => array( 'title','custom-fields' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );
}

/**
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
                'type'  => 'user',
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
            'meta_box' => [
                'title' => 'Attendance',
            ],
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
            'meta_box' => [
                'title' => 'Host of Groups',
                'context' => 'normal',
            ],
            'field' => [
                'query_args' => [
                    'number' => 200 // This
                ]
            ]
        ],
    ]);

    // Add Att Course Regis / Guest User Relationship
    MB_Relationships_API::register([
        'id' => 'course_regis_to_guests',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-course-regis',
            'meta_box' => [
                'title' => 'Viewer Guests',
                'context' => 'normal',
                // 'priority' => '1',
            ],
        ],
        'to' => [
            'object_type' => 'user',
            'meta_box' => [
                'title' => 'Guest of Course Registrations',
            ],
            'field' => [
                'query_args' => [
                    'number' => 200 // This
                ]
            ]
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
            'meta_box' => [
                'title' => 'Guest of Groups',
            ],
            'field' => [
                'query_args' => [
                    'number' => 200 // This
                ]
            ]
        ],
    ]);

    // Add Course Registration / Course
    MB_Relationships_API::register([
        'id' => 'course_regis_to_course',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-course-regis',
            'meta_box' => [
                'title' => 'Course',
                'context' => 'normal',
            ],
        ],
        'to' => [
            'object_type' => 'post',
            'post_type' => 'online-course',
        ],
    ]);

    // Add Course Registration / User
    MB_Relationships_API::register([
        'id' => 'course_regis_to_user',
        'from' => [
            'object_type' => 'post',
            'post_type' => 'ot-course-regis',
            'meta_box' => [
                'title' => 'User',
                'context' => 'normal',
                // 'priority' => '99',
            ],
        ],
        'to' => [
            'object_type' => 'user',
            'meta_box' => [
                'title' => 'Course Registrations',
                'context' => 'normal',
            ],
            'field' => [
                'query_args' => [
                    'number' => 2000 // This
                ]
            ]
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
                'name'            => 'Course Status',
                'id'              => $prefix . 'status',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => COURSE_STATUS_NOT_STARTED, 'label' => 'Not Started' ),
                    array( 'value' => COURSE_STATUS_STARTED, 'label' => 'Started' ),
                    array( 'value' => COURSE_STATUS_FINISHED, 'label' => 'Finished' ),
                ),
                // Placeholder text
                'placeholder'     => 'Select an Item',
            ),
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
            array(
                'id'              => $prefix . 'zoom_meeting',
                'name'    => 'Zoom Meeting Details',
                'type'    => 'text_list',
                'options' => array(
                    'https://....'      => 'Join Zoom Meeting URL',
                    '123456' => 'Meeting ID',
                    'xxxxx' => 'Passcode',
                ),
            ),
            array(
                'id' => $prefix . 'zoom_name',
                'type' => 'text',
                'name' => esc_html__( 'Zoom Name', 'ot_txtd' ),
            ),
        ),
    );

    $meta_boxes[] = array(
        'id' => 'ot-course-regis-info',
        'title' => esc_html__( 'Course Registration Info' ),
        'post_types' => array('ot-course-regis'),
        'context' => 'after_editor',
        'priority' => 'default',
        'autosave' => 'false',
        'fields' => array(
            array(
                'id' => $prefix . 'registration_time',
                'type' => 'datetime',
                'name' => esc_html__( 'Registration Time (UK Time)', 'ot_txtd' ),
            ),
            array(
                'name'            => 'Status',
                'id'              => $prefix . 'status',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => COURSE_REGIS_STATUS_NOT_ATTENDED, 'label' => 'Course Not Attended' ),
                    array( 'value' => COURSE_REGIS_STATUS_INCOMPLETE, 'label' => 'Course Incomplete' ),
                    array( 'value' => COURSE_REGIS_STATUS_COMPLETE, 'label' => 'Course Complete' ),
                ),
                // Placeholder text
                'placeholder'     => 'Select an Item',
            ),
            array(
                'name'            => 'Is Group Viewing Host',
                'id'              => $prefix . 'is_group_viewing_host',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => 0, 'label' => 'No' ),
                    array( 'value' => 1, 'label' => 'Yes' ),
                ),
                // Placeholder text
                'placeholder'     => 'Select an Item',
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
        exit("Can't verify your session.");
    }
    
    $result=array();

    $userId = get_current_user_id();
    $courseId = $_REQUEST["post_id"];
    $registerAction = $_REQUEST["register"];

    $already_registered = MB_Relationships_API::has( $userId, $courseId, 'users_to_course' );
    
    if($registerAction == 1) { // REGISTER ACTION
        if ( $already_registered ) {
            $result['type'] = "error";
            $result['registered'] = "1";
            $result['message'] = '<span class="modal_msg_hey">You are already registered to this course.</span>';
        } else {

            // We create the course registration object
            $newCourseRegisData = array(
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'ot-course-regis'
            );
            $newCourseRegisId = wp_insert_post( $newCourseRegisData, true);

            rwmb_set_meta( $newCourseRegisId, '_status', COURSE_REGIS_STATUS_COMPLETE);
            // Associate course registration with user
            MB_Relationships_API::add( $newCourseRegisId, $userId, 'course_regis_to_user' );
            // Associate course registration with course
            MB_Relationships_API::add( $newCourseRegisId, $courseId, 'course_regis_to_course' );

            // Associate course with user
            MB_Relationships_API::add( $userId, $courseId, 'users_to_course' );
            $result['type'] = "success";
            $result['message'] = '<span class="modal_msg_alright">You have been successfully registered to this course. <br/>A link to the Youtube teaching video will appear on this page about 15 minutes before each session.</span>';
            $result['registered'] = "1";
        }
    } elseif($registerAction == 2) { // UNREGISTER ACTION
        if ( $already_registered ) {
            MB_Relationships_API::delete( $userId, $courseId, 'users_to_course' );
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

function new_modify_session_table( $column ) {
    $column['sess_status'] = 'Status';
    $column['sess_time'] = 'Session Time';
    return $column;
}

function new_modify_course_regis_table( $column ) {
    $column['creg_name'] = 'Name';
    $column['creg_course'] = 'Course';
    $column['creg_regis_date'] = 'Registration Date';
    $column['creg_status'] = 'Status';
    // unset ($column['title']);
    // unset ($column['date']);
    return $column;
}

function new_modify_attendance_table( $column ) {
    $column['att_status'] = 'Status';
    $column['joined_time'] = 'Joined Time';
    return $column;
}

function new_modify_user_table( $column ) {
    $column['passport'] = 'Passport';
    $column['registration_date'] = 'Registration Date';
    $column['group_host'] = 'Group Host';
    return $column;
}

function getSessionStatusName($status) {
    switch($status) {
        case SESS_STATUS_OPEN:
            return 'Open';
            break;
        case SESS_STATUS_FINISHED:
            return 'Finished';
            break;
        case SESS_STATUS_WAITING:
            return 'Waiting';
            break;
        case SESS_STATUS_NOT_STARTED:
            return 'Not Started';
            break;
        default:
            return 'Not Started';
            break;
    }
}

function getAttendanceStatusName($status) {
    switch($status) {
        case ATT_STATUS_NOT_JOINED:
            return 'Not Joined';
            break;
        case ATT_STATUS_JOINED_LATE:
            return 'Joined Late';
            break;
        case ATT_STATUS_JOINED_ONTIME:
            return 'Joined On Time';
            break;
        case ATT_STATUS_JOINED_VERYLATE:
            return 'Joined Very Late';
            break;
        default:
            return 'Not Joined';
            break;
    }
}

function getCourseRegisStatusName($status) {
    switch($status) {
        case COURSE_REGIS_STATUS_NOT_ATTENDED:
            return 'Not Attended';
            break;
        case COURSE_REGIS_STATUS_INCOMPLETE:
            return 'Incomplete';
            break;
        case COURSE_REGIS_STATUS_COMPLETE:
            return 'Complete';
            break;
    }
}

function new_modify_course_regis_table_row( $column, $courseregId ) {
    switch ($column) {
        case 'creg_name' :
            $user = getCourseRegisUser($courseregId);
            echo ($user) ? $user->data->display_name : '';
            break;
        case 'creg_course' :
            $courseId = getCourseRegisCourse($courseregId);
            echo get_the_title($courseId);
            break;
        case 'creg_regis_date' :
            echo rwmb_meta('_registration_time',array(),$courseregId);
            break;
        case 'creg_status' :
            echo getCourseRegisStatusName(rwmb_meta('_status',array(),$courseregId));
            break;
        default:
    }
}

function new_modify_session_table_row( $column, $sessionId ) {
    switch ($column) {
        case 'sess_status' :
            echo getSessionStatusName(rwmb_meta('_status',array(),$sessionId));
            break;
        case 'sess_time' :
            echo rwmb_meta('_session_time',array(),$sessionId);
            break;
        default:
    }
}

function new_modify_attendance_table_row( $column, $attendanceId ) {
    switch ($column) {
        case 'att_status' :
            $status = rwmb_meta('_attendance_status',array(),$attendanceId);
            if($status == ATT_STATUS_NOT_JOINED) {
                $circle = '<div style="background:red; width:15px; height:15px;float: left;border-radius: 10px;margin: 2px 15px 0 0;"></div>';
            } elseif($status == ATT_STATUS_JOINED_LATE) {
                $circle = '<div style="background:yellow; width:15px; height:15px;float: left;border-radius: 10px;margin: 2px 15px 0 0;"></div>';
            } elseif($status == ATT_STATUS_JOINED_VERYLATE) {
                $circle = '<div style="background:orange; width:15px; height:15px;float: left;border-radius: 10px;margin: 2px 15px 0 0;"></div>';
             }elseif($status == ATT_STATUS_JOINED_ONTIME) {
                $circle = '<div style="background:lawngreen; width:15px; height:15px;float: left;border-radius: 10px;margin: 2px 15px 0 0;"></div>';
            }
            echo $circle.getAttendanceStatusName($status);
            break;
        case 'joined_time' :
            echo rwmb_meta('_joined_time',array(),$attendanceId);
            break;
        default:
    }
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

function initAllAttendance($sessionId)
{
    $session = get_post($sessionId);
    // Check if post is a session
    if($session->post_type == 'ot-session') {

        $sessionStatus = rwmb_meta('_status',array(),$sessionId);
        $courseId = getSessionCourse($sessionId)->ID;

        // If we open the session
        if($sessionStatus == SESS_STATUS_OPEN) {
            // TODO: Check if other open session exists for course
            if(true) {

            }

            // Create all attendances
            $users = getCourseUsers($courseId);
            foreach ($users as $user) {
                // Do not create if attendance already exists
                if(!getAttendance($user->ID,$sessionId)) {
                    saveAttendance($user->ID, $sessionId, $courseId, true);
                }
            }
        }

    }
}

function getCourseUsers($courseId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'users_to_course',
        'to' => $courseId,
    ] );
}

function getUserCourses($userId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'users_to_course',
        'from' => $userId,
    ] );
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

function getCourseRegisCourse($regisId) {
    $courses = MB_Relationships_API::get_connected( [
        'id'   => 'course_regis_to_course',
        'from' => $regisId,
    ] );
    if(is_array($courses) && !empty($courses)) {
        return $courses[0];
    }
    return false;
}

function getCourseRegisUser($regisId) {
    $users = MB_Relationships_API::get_connected( [
        'id'   => 'course_regis_to_user',
        'from' => $regisId,
    ] );
    if(is_array($users) && !empty($users)) {
        return $users[0];
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

function getUserSessionAttendance($userId,$sessionId) {

    global $wpdb;

    $attendanceId = $wpdb->get_var(
        $wpdb->prepare(
            "
                SELECT wmr.`to` FROM wp_mb_relationships wmr
                INNER JOIN wp_mb_relationships wmr2
                ON wmr.`to` = wmr2.`to`
                AND wmr.`type`='user_to_attendance'
                AND wmr.`from`=%d
                AND wmr2.`type`='session_to_attendance'
                AND wmr2.`from`=%d 
        
            ",
            $userId,
            $sessionId
        )
    );

    if($attendanceId) {
        return get_post($attendanceId);
    }

    return false;
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

        }

    }
    return false;
}

function saveAttendance($userId,$sessionId, $courseId,$create=false) {

    $joinedTime = new DateTime('now',new DateTimeZone(TS_TMZ));

    $attendanceId = getAttendance($userId,$sessionId);

    // If user has not joined yet
    if(!$attendanceId) {

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

        // We initialize the attendance status as "Not joined yet"
        rwmb_set_meta( $newOtAttendanceId, '_attendance_status', ATT_STATUS_NOT_JOINED);

        // Finally, we associate the Attendance to the Session, Course and User
        MB_Relationships_API::add( $sessionId, $newOtAttendanceId, 'session_to_attendance' );
        MB_Relationships_API::add( $courseId, $newOtAttendanceId, 'course_to_attendance' );
        MB_Relationships_API::add( $userId, $newOtAttendanceId, 'user_to_attendance' );

        if(!$create) {
            setAttendanceData($joinedTime,$sessionId,$userId,$courseId);
        }

    } else {    // Now the attendance exists already so we will update it
        $attendanceStatus = rwmb_meta( '_status', null, $attendanceId );
        // We check the status, if already initialized we leave it otherwise we will update joined time and status
        if(empty($attendanceStatus)) {
            setAttendanceData($joinedTime, $sessionId, $userId, $courseId);
        }
    }


}

/**
 *
 * Set Attendance Status and Joined Time
 *
 * @param $joinedTime
 * @param $sessionId
 * @param $userId
 * @throws Exception
 */
function setAttendanceData($joinedTime,$sessionId,$userId,$courseId) {
    $tmzObj = new DateTimeZone(TS_TMZ);
    $userIds = array();
    $userIds[] = $userId;

    // If user is group host we get all guests
    $groupId = getHostGroupId($userId,$courseId);
    if($groupId) {
        $groupGuests = getGroupGuests($groupId);
        foreach($groupGuests as $groupGuest) {
            $userIds[] = $groupGuest->ID;
        }
    }

    // We update user, and host guests if there are some
    foreach($userIds as $userId) {
        // We load the attendance
        $attendance = getUserSessionAttendance($userId,$sessionId);
        if($attendance) {
            // Set the joined time.
            rwmb_set_meta( $attendance->ID, '_joined_time', $joinedTime->format('Y-m-d H:i'));
            $sessionTime = rwmb_meta('_session_time',array(),$sessionId);
            // Depending on the joined time we put the status to on time, late or verylate
            if ($joinedTime > new DateTime($sessionTime.' + 20 minute',$tmzObj)) {
                rwmb_set_meta( $attendance->ID, '_attendance_status', ATT_STATUS_JOINED_VERYLATE);
            } elseif($joinedTime > new DateTime($sessionTime.' + 0 minute',$tmzObj)) {
                rwmb_set_meta( $attendance->ID, '_attendance_status', ATT_STATUS_JOINED_LATE);
            } else {
                rwmb_set_meta( $attendance->ID, '_attendance_status', ATT_STATUS_JOINED_ONTIME);
            }
        }
    }

}

function showSessionInfo($session) {

    $allowedSessionStatuses = array(SESS_STATUS_OPEN,SESS_STATUS_WAITING,SESS_STATUS_TOO_LATE,SESS_STATUS_FINISHED);
    return in_array($session->session_final_status,$allowedSessionStatuses);
}

function getSessionTime($sessionId) {
    $tmzObj = new DateTimeZone(TS_TMZ);
    $date = new DateTime(rwmb_meta('_session_time',array(),$sessionId),$tmzObj);
    return $date->format('H:i');
}

function isUserGroupGuest($userId, $courseId) {

    global $wpdb;

    $relId = $wpdb->get_var(
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

    return (bool) $relId;

}

function getHostGroupId($userId, $courseId) {

    global $wpdb;

    $groupId = $wpdb->get_var(
        $wpdb->prepare(
            "
                SELECT wmr.`from` FROM wp_mb_relationships wmr
                INNER JOIN wp_mb_relationships wmr2
                ON wmr.`from` = wmr2.`from`
                AND wmr.`to`=%d
                AND wmr.`type`='att_group_host_to_user'
                AND wmr2.`to`=%d
                AND wmr2.`type`='att_group_to_course'            
            ",
            $userId,
            $courseId
        )
    );

    if((bool) $groupId) {
        return $groupId;
    }

    return false;

}

function getGroupGuests($groupId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'att_group_guests_to_user',
        'from' => $groupId,
    ] );
}

/**
 * Delete all relationships to an object.
 *
 * @param int    $object_id ID of the object metadata is for.
 * @param string $type      The relationship type.
 */
 function deleteAllObjectRelationships( $object_id ) {
    global $wpdb;
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $wpdb->mb_relationships WHERE (`from`=%d OR `to`=%d)",
            $object_id,
            $object_id
        )
    );
}


function getAttendance($userId, $sessionId) {

    global $wpdb;

    $attId = $wpdb->get_var(
        $wpdb->prepare(
            "
                SELECT wmr.`to` FROM wp_mb_relationships wmr
                INNER JOIN wp_mb_relationships wmr2
                ON wmr.`to` = wmr2.`to`
                AND wmr.`from`=%d
                AND wmr.`type`='user_to_attendance'
                AND wmr2.`from`=%d
                AND wmr2.`type`='session_to_attendance'            
            ",
            $userId,
            $sessionId
        )
    );

    if($attId) {
        return $attId;
    }

    return false;

}

function dateSort($a, $b) {
    return strtotime($a) - strtotime($b);
}

function after_account_general_custom_fields()
{
    $custom_fields = [
        'newsletter_subscription' => [
            'title'    => 'Newsletter subscription',
            'label'    => 'Newsletter subscription',
            'metakey'  => 'newsletter_subscription',
            'type'     => 'checkbox',
            'options' => ['Subscribe'],
            'required' => 0,
            'public'   => 1,
            'editable' => 1,
        ],
        'email_notifications' => [
            'title'    => 'Email notifications',
            'label'    => 'Receive email updates about courses you are registered to',
            'metakey'  => 'email_notifications',
            'type'     => 'checkbox',
            'options' => ['Yes'],
            'required' => 0,
            'public'   => 1,
            'editable' => 1,
        ],
    ];

    $fields = apply_filters('um_account_secure_fields', $custom_fields, um_user('ID'));

    UM()->builtin()->saved_fields = $fields;
    UM()->builtin()->set_custom_fields();

    $output = '';
    foreach ($fields as $key => $data) {
        $output .= UM()->fields()->edit_field($key, $data);
    }
    echo $output;
}

function account_pre_update_profile_newsletter_subscription($changes, $user_id)
{
    $fields = array('newsletter_subscription',
                    'email_notifications');

    $userdata = get_userdata($user_id);
    $email = $userdata->data->user_email;

    $newsletterSubs = false;
    $emailNotifSubs = false;
    if(array_key_exists('newsletter_subscription',$_POST)) {
        $newsletterSubs = true;
    }
    if(array_key_exists('email_notifications',$_POST)) {
        $emailNotifSubs = true;
    }

    $email='newreedz@test.com';

    // If one of the checkboxes is ticked user must be subscribed to our list
    if($newsletterSubs || $emailNotifSubs) {
        subscribeNewMchimpUser($email);
    }

    if ($userObject = userMchimpExists($email)) {
        // if ($userObject->status == 'unsubscribed') {

        // }
    }

    // if (isUserMchimpTag($email,'tsquare_newsletter')) {

    // }

    // if (isUserMchimpTag($email,'tsquare_notifications')) {

    // }

    foreach($fields as $field) {
        update_user_meta($user_id, $field, $_POST[$field]);
    }
    
};

function subscribeNewMchimpUser($email) {

    $client = getMchimpMarketingConnClient();

    try {
        $response = $client->lists->addListMember(MCHIMP_LIST_ID, [
            "email_address" => $email,
            "status" => "subscribed",
            "merge_fields" => [
            "FNAME" => "Prudence",
            "LNAME" => "McVankab"
            ]
        ]);
        pa($response,1);
    } catch (GuzzleHttp\Exception\ClientException $e) {
        if ($e->getCode() == '400') {
            pa('HELLO',1);
            // User exists, needs updating
        }
    }

}

function getUserMchimpTags($email) {

    require_once __DIR__ . '/lib/mailchimp-marketing-php/vendor/autoload.php';

    $client = new MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => '',
        'server' => 'us10',
    ]);

    $response = $client->lists->getListMemberTags("list_id", "subscriber_hash");

    $response = $client->lists->getListMemberTags("ca06c2bf51", md5(strtolower($email)));


    return $response['tags'];
}

function isUserMchimpTag($email,$tag) {
    $userTags = getUserMchimpTags($email);
    if (in_array($tag,$userTags)) {
        return true;
    }
    return false;
}


function getMchimpMarketingConnClient() {
    require_once __DIR__ . '/lib/mailchimp-marketing-php/vendor/autoload.php';

    $client = new MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => MCHIMP_API_KEY,
        'server' => MCHIMP_SVR_PREF,
    ]);

    return $client;
}

function userMchimpExists($email) {

    $client = getMchimpMarketingConnClient();
    
try {
    
    $response = $client->lists->getListMember(MCHIMP_LIST_ID, md5(strtolower($email)));
    
} catch (GuzzleHttp\Exception\ClientException $e) {
    // 404 error means user is not found
      if($e->getCode()=='404') {
          return false;
      }
}

// ID is found, user exists
if(!empty($response->id)) {
    return $response;
}

return false;

}

/**
 * Get number to be used at start of Zoom name
 * 
 */
function getZoomNumber($userId) {
    $zoomNumber = str_pad($userId,4,'0',STR_PAD_LEFT);
    return $zoomNumber;
    // pa($user,1);
    // pa($zoomName,1);
}