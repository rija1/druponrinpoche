<?php
global $post;
$post_slug = $post->post_name;
?>
<h5><?php pll_e('Online Teachings'); ?></h5>
<ul>
    <li class="page_item <?php echo ($post_slug=='online-teachings') ? 'current_page_item' : '' ;?>">
        <a href="<?php echo get_permalink( get_page_by_path( 'online-teachings' ) ); ?>"><?php pll_e('Online Teachings'); ?></a>
    </li>
    <li class="page_item <?php echo ($post_slug=='account') ? 'current_page_item' : '' ;?>">
        <a href="<?php echo get_permalink( get_page_by_path( 'account' ) ); ?>"><?php pll_e('My Account'); ?></a>
    </li>
</ul>
