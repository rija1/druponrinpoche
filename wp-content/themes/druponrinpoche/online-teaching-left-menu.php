<?php
global $post;
$post_slug = $post->post_name;

$current_url = home_url( add_query_arg( array(), $wp->request ) );
$onlineTeaching = false;
if(strpos($current_url, 'online-course') !== false) {
    $onlineTeaching = true;
}

?>
<div class="sidebar-container left dc_left">
    <div class="dc_left_title"><?php pll_e('Tirthika Square'); ?></div>
    <div class="dc_logged">
        <div class="logged_name">Hello <?php echo esc_html( um_user( 'display_name' ) ); ?>.</div>
        <div class="logout_link"><a href="<?php echo um_get_core_page( 'logout' ); ?>">Logout</a></div>
    </div>
    <ul>
        <li class="page_item <?php echo ($onlineTeaching) ? 'current_page_item' : '' ;?>">
            <a href="<?php echo get_permalink( get_page_by_path( 'online-courses' ) ); ?>"><?php pll_e('Online Courses'); ?></a>
        </li>
        <li class="page_item <?php echo ($post_slug=='account') ? 'current_page_item' : '' ;?>">
            <a href="<?php echo get_permalink( get_page_by_path( 'account' ) ); ?>"><?php pll_e('My Account'); ?></a>
        </li>
    </ul>
</div>
