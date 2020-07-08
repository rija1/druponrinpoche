<?php
add_action( 'init', 'script_enqueuer' );
add_action( 'init', 'create_ot_course' );
add_action( 'init', 'create_ot_session' );
add_filter( 'rwmb_meta_boxes', 'ot_get_meta_box' );
add_action("wp_ajax_online_teaching_register", "online_teaching_register");
add_action("wp_ajax_nopriv_online_teaching_register", "please_login");
add_action( 'mb_relationships_init', 'mbRelationships');
add_filter( 'um_shortcode_args_filter', 'umShortcode', 10, 3 );
add_filter( 'manage_users_columns', 'new_modify_user_table' );
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
add_action('save_post','createOnlineCourseSessions');

const TS_TMZ = 'Europe/London';

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
            'menu_icon' => plugins_url( 'images/teaching.png', __FILE__ ),
            'has_archive' => true,
        )
    );
}

/**
 * Add relationships between different custom post types
 */
function mbRelationships() {
    // Add Teaching / User Relationship (for user registrations to teachings)
    MB_Relationships_API::register( [
        'id'   => 'users_to_online_teachings',
        'from' => [
            'object_type' => 'user',
            'admin_column' => true,  // THIS!
            'meta_box'    => [
                'title' => 'Teachings Attended',
                'context' => 'normal',
            ],
        ],
        'to'   => [
            'object_type' => 'post',
            'post_type'   => 'online-course',
            'meta_box'    => [
                'title' => 'Attended By',
                'context' => 'normal',

            ],
        ],
    ] );
    // Add Teaching / Session Relationship
    MB_Relationships_API::register( [
        'id'   => 'course_to_sessions',
        'from' => [
            'object_type' => 'post',
            'post_type'   => 'online-course',
//            'admin_column' => true,  // THIS!
            'meta_box'    => [
                'title' => 'Session Posts',
                'context' => 'normal',
            ],
        ],
        'to'   => [
            'object_type' => 'post',
            'post_type'   => 'ot-session',
            'admin_column' => true,
            'meta_box'    => [
                'title' => 'Belonging to Teaching',
                'context' => 'normal',

            ],
        ],
    ] );
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
                'name'            => 'Show Teaching Session Link',
                'id'              => $prefix . 'show_link',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    array( 'value' => 1, 'label' => 'Yes' ),
                    array( 'value' => 0, 'label' => 'No' ),
                ),
                // Placeholder text
                'placeholder'     => 'Select an Item',
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
function getDatesFromSessions($sessionsRaw) {

    // TODO use new metabox data

    $sessions = explode(',',$sessionsRaw[0]);

    $startDate = strftime('%d %B %Y ', strtotime($sessions[0]));
    $endDate = strftime('%d %B %Y ', strtotime($sessions[count($sessions)-1]));

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

    $already_registered = MB_Relationships_API::has( $userId, $postId, 'users_to_online_teachings' );

    if($registerAction == 1) { // REGISTER ACTION
        if ( $already_registered ) {
            $result['type'] = "error";
            $result['registered'] = "1";
            $result['message'] = '<span class="modal_msg_hey">You are already registered to this course.</span>';
        } else {
            MB_Relationships_API::add( $userId, $postId, 'users_to_online_teachings' );
            $result['type'] = "success";
            $result['message'] = '<span class="modal_msg_alright">You have been successfully registered to this course. <br/>A link to the Youtube teaching video will appear on this page about 15 minutes before each session.</span>';
            $result['registered'] = "1";
        }
    } elseif($registerAction == 2) { // UNREGISTER ACTION
        if ( $already_registered ) {
            MB_Relationships_API::delete( $userId, $postId, 'users_to_online_teachings' );
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
                    // TODO : associate Session to Course
                    MB_Relationships_API::add( $courseId, $newOtSessionId, 'course_to_sessions' );
                }
            }







        }
    }
}

/**
 * @param $courseId
 */
function getCourseSessions($courseId) {
    return MB_Relationships_API::get_connected( [
        'id'   => 'course_to_sessions',
        'from' => $courseId,
    ] );
}

/**
 * @param $courseId
 */
function waitingForSessionLink($courseId) {
    $sessions = getCourseSessions($courseId);
    $tmzObj = new DateTimeZone(TS_TMZ);

    foreach($sessions as $session) {

        $sessionTime = rwmb_meta( '_session_time', null, $courseId );
        pa($sessionTime,1);
        if (new DateTime('now',$tmzObj) > new DateTime($registrationCloseDate,$tmzObj)) {
            return false;
        }
    }
    $course = get_post($courseId);
}


