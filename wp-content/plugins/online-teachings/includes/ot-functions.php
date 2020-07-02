<?php

add_action( 'init', 'create_ot_teaching' );

function create_ot_teaching() {
    register_post_type( 'online-course',
        array(
            'labels' => array(
                'name' => 'Online Courses',
                'singular_name' => 'Online Course',
                'add_new' => 'Add New',
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
            'register_meta_box_cb' => 'add_online_teachings_metaboxes',
        )
    );
//    flush_rewrite_rules();
}


// Add Teaching / User Relationship (for user registrations to teachings)
add_action( 'mb_relationships_init', function () {
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
} );


add_filter( 'rwmb_meta_boxes', 'ot_register_meta_boxes' );
function ot_register_meta_boxes( $meta_boxes )
{
    $meta_boxes[] = array(
        'title' => 'Registration End Date',
        'post_types' => 'online-course',

        'fields' => array(
            array(
                'name' => 'Registration End Date',
                'id' => 'regis_end_date',
                'type' => 'text',
            ),
        )
    );

    // Add more meta boxes if you want
    // $meta_boxes[] = ...

    return $meta_boxes;
}

function getDatesFromSessions($sessionsRaw) {

    $sessions = explode(',',$sessionsRaw[0]);

    $startDate = strftime('%d %B %Y ', strtotime($sessions[0]));
    $endDate = strftime('%d %B %Y ', strtotime($sessions[count($sessions)-1]));

    return $startDate . ' - ' .$endDate;
}

// define the actions for the two hooks created, first for logged in users and the next for logged out users
add_action("wp_ajax_online_teaching_register", "online_teaching_register");
add_action("wp_ajax_nopriv_online_teaching_register", "please_login");

// define the function to be fired for logged in users
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

// define the function to be fired for logged out users
function please_login() {
    echo "You must log in to register to a course";
    die();
}

// Fires after WordPress has finished loading, but before any headers are sent.
add_action( 'init', 'script_enqueuer' );

function script_enqueuer() {

    // Register the JS file with a unique handle, file location, and an array of dependencies
    wp_register_script( "online_teaching_script", plugin_dir_url(__FILE__).'/includes/js/online_teaching.js', array('jquery') );

    // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
    wp_localize_script( 'online_teaching_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    // enqueue jQuery library and the script you registered above
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'online_teaching_script' );
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
add_filter( 'um_shortcode_args_filter', 'umShortcode', 10, 3 );

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

add_filter( 'manage_users_columns', 'new_modify_user_table' );
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

function new_modify_user_table( $column ) {
    $column['passport'] = 'Passport';
    $column['registration_date'] = 'Registration Date';
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
        default:
    }
    return $value;
}



