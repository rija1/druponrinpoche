<?php
global $post;
$post_slug = $post->post_name;
?>
<div class="sidebar-container left dc_left">
    <div class="dc_left_title"><?php pll_e('Marpa Online'); ?></div>
    <div class="dc_logged">
        <div class="logged_name">Logged as <?php echo esc_html( um_user( 'display_name' ) ); ?>.</div>
        <div class="logout_link"><a href="<?php echo um_get_core_page( 'logout' ); ?>">Logout</a></div>
    </div>
    <ul>
        <li class="page_item <?php echo ($post_slug=='online-teachings') ? 'current_page_item' : '' ;?>">
            <a href="<?php echo get_permalink( get_page_by_path( 'online-teachings' ) ); ?>"><?php pll_e('Online Teachings'); ?></a>
        </li>
        <li class="page_item <?php echo ($post_slug=='account') ? 'current_page_item' : '' ;?>">
            <a href="<?php echo get_permalink( get_page_by_path( 'account' ) ); ?>"><?php pll_e('My Account'); ?></a>
        </li>
    </ul>
</div>
