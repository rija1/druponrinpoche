<?php /* Template Name: Tirthika Square */ ?>
<?php
if ( !is_user_logged_in() ) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
} else {
    exit( wp_redirect( 'online-courses' ) );
}
?>
