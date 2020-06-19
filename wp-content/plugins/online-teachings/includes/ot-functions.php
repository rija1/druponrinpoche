<?php

add_action( 'init', 'create_ot_teaching' );

function create_ot_teaching() {
    register_post_type( 'online-teaching',
        array(
            'labels' => array(
                'name' => 'Online Teachings',
                'singular_name' => 'Online Teaching',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Online Teaching',
                'edit' => 'Edit',
                'edit_item' => 'Edit Online Teaching',
                'new_item' => 'New Online Teaching',
                'view' => 'View',
                'view_item' => 'View Online Teaching',
                'search_items' => 'Search Online Teachings',
                'not_found' => 'No Online Teachings found',
                'not_found_in_trash' => 'No Online Teachings found in Trash',
                'parent' => 'Parent Online Teaching'
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
            'post_type'   => 'online-teaching',
            'meta_box'    => [
                'title' => 'Attended By',
                'context' => 'normal',

            ],
        ],
    ] );
} );

function add_online_teachings_metaboxes() {
    add_meta_box(
        'ot_from_date',
        'From Date',
        'ot_from_date',
        'online-teaching',
        'normal',
        'default'
    );
    add_meta_box(
        'ot_to_date',
        'To Date',
        'ot_to_date',
        'online-teaching',
        'normal',
        'default'
    );
}

function ot_from_date() {
    global $post;
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'online_teaching_fields' );
    // Get the location data if it's already been entered
    $ot_from_date = get_post_meta( $post->ID, 'from_date', true );
    // Output the field
    echo '<input type="text" name="from_date" value="' . esc_textarea( $ot_from_date )  . '" class="widefat">';
}

function ot_to_date() {
    global $post;
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'online_teaching_fields' );
    // Get the location data if it's already been entered
    $ot_to_date = get_post_meta( $post->ID, 'to_date', true );
    // Output the field
    echo '<input type="text" name="to_date" value="' . esc_textarea( $ot_to_date )  . '" class="widefat">';
}

/**
 * Save the metabox data
 */
function save_online_teachings_meta( $post_id, $post ) {

    // Return if the user doesn't have edit permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['from_date'] ) || ! isset( $_POST['to_date'] ) || ! wp_verify_nonce( $_POST['online_teaching_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }


    // Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.
    $events_meta['from_date'] = esc_textarea( $_POST['from_date'] );
    $events_meta['to_date'] = esc_textarea( $_POST['to_date'] );

    // Cycle through the $events_meta array.
    // Note, in this example we just have one item, but this is helpful if you have multiple.
    foreach ( $events_meta as $key => $value ) :

        // Don't store custom data twice
        if ( 'revision' === $post->post_type ) {
            return;
        }

        if ( get_post_meta( $post_id, $key, false ) ) {
            // If the custom field already has a value, update it.
            update_post_meta( $post_id, $key, $value );
        } else {
            // If the custom field doesn't have a value, add it.
            add_post_meta( $post_id, $key, $value);
        }

        if ( ! $value ) {
            // Delete the meta key if there's no value
            delete_post_meta( $post_id, $key );
        }

    endforeach;

}
add_action( 'save_post', 'save_online_teachings_meta', 1, 2 );


function getDatesFromSessions($sessionsRaw) {

    $sessions = explode(',',$sessionsRaw[0]);
    $date = explode(' ',$sessions[0]);
    $startDate = strftime('%d %B %Y ', strtotime($date[0]));
    $endDate = strftime('%d %B %Y ', strtotime($date[count($date)-1 ]));

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

    $already_registered = MB_Relationships_API::has( $userId, $postId, 'users_to_online_teachings' );

    if ( $already_registered ) {
        MB_Relationships_API::delete( $userId, $postId, 'users_to_online_teachings' );
        $result['type'] = "success";
    } else {
        MB_Relationships_API::add( $userId, $postId, 'users_to_online_teachings' );
        $result['type'] = "success";
    }

   // Update the value of 'likes' meta key for the specified post, creates new meta data for the post if none exists
   $like = update_post_meta($_REQUEST["post_id"], "likes", $new_like_count);

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

