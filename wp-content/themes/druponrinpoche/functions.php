<?php
/**
 * DruponRinpoche functions and definitions
 *
 * @package Onsen
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see http://developer.wordpress.com/themes/content-width/Enqueue
 */

require_once('includes/class-walker-category-dr.php');
require_once('includes/class-walker-nav-menu-dr.php');

function dkr_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'dkr_content_width', 980 );
}
add_action( 'after_setup_theme', 'dkr_content_width', 0 );

/**
 * Theme support and thumbnail sizes
 */

if( ! function_exists( 'dkr_theme_setup' ) ) {

    function dkr_theme_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on BuildPress, use a find and replace
         */

        load_theme_textdomain( 'dkr', get_template_directory() . '/lang' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Add default title support
        add_theme_support( 'title-tag' );

        // Add default logo support
        add_theme_support( 'custom-logo' );

        // Custom Backgrounds
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
        ) );

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size( 150, 150, true);

        add_image_size('dkr-photo-800-500', 800, 500, true);
        add_image_size('dkr-photo-300-200', 300, 200, true);
        add_image_size('dkr-photo-310-207', 310, 207, true);

        // Menus
        register_nav_menu( 'dkr-menu', _x( 'Main Menu', 'backend', 'druponrinpoche' ) );

        // Add theme support for Semantic Markup
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );

        // add excerpt support for pages
        add_post_type_support( 'page', 'excerpt' );

        // Add CSS for the TinyMCE editor
        add_editor_style();
    }
    add_action( 'after_setup_theme', 'dkr_theme_setup' );
}

if ( ! function_exists( 'dkr_the_custom_logo' ) ) :
    /**
     * Displays custom logo.
     */
    function dkr_the_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
    }
endif;

/**
 * Displays Favicon
 */

function dkr_custom_site_icon_size( $sizes ) {
    $sizes[] = 64;

    return $sizes;
}
add_filter( 'site_icon_image_sizes', 'dkr_custom_site_icon_size' );

function dkr_custom_site_icon_tag( $meta_tags ) {
    $meta_tags[] = sprintf( '<link rel="icon" href="%s" sizes="64x64" />', esc_url( get_site_icon_url( null, 64 ) ) );

    return $meta_tags;
}
add_filter( 'site_icon_meta_tags', 'dkr_custom_site_icon_tag' );

/**
 * Customizer additions.
 */

include_once( trailingslashit(get_template_directory()) . '/customizer.php' );


/**
 * About themes additions.
 */

include_once( trailingslashit(get_template_directory()) . '/about.php' );

/**
 * Enqueue CSS stylesheets
 */


if( ! function_exists( 'dkr_enqueue_styles' ) ) {
    function dkr_enqueue_styles() {


        // Font Awesome
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array());

        // Slick Slider
        wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array());

        // main style
        wp_enqueue_style( 'dkr-style', get_stylesheet_directory_uri() . '/style.css', array() );

        // main style
//        wp_enqueue_style( 'dkr-resp', get_template_directory_uri() . '/assets/css/resp.css', array() );

    }
    add_action( 'wp_enqueue_scripts', 'dkr_enqueue_styles' );
}

/**
 * Enqueue JS scripts
 */

if( ! function_exists( 'dkr_enqueue_scripts' ) ) {
    function dkr_enqueue_scripts() {

        // Slick Slider
        wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), null );

        // html5
        wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.js' );
        wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

        // mediaqueries
        wp_enqueue_script( 'mediaqueries', get_template_directory_uri() . '/assets/js/css3-mediaqueries.js' );
        wp_script_add_data( 'mediaqueries', 'conditional', 'lt IE 9' );

        // main for script js
        wp_enqueue_script( 'dkr-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null );

        // for nested comments
        if ( is_singular() && comments_open() ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
    add_action( 'wp_enqueue_scripts', 'dkr_enqueue_scripts' );
}


/**
 * Register sidebars for Onsen
 */

function dkr_sidebars() {

    // Blog Sidebar

    register_sidebar(array(
        'name' => __( 'Blog Sidebar', "dkr"),
        'id' => 'blog-sidebar',
        'description' => __( 'Sidebar on the blog layout.', "dkr"),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

    // Footer Sidebar

    register_sidebar(array(
        'name' => __( 'Footer Widget Area 1', "dkr"),
        'id' => 'footer-widget-area-1',
        'description' => __( 'The footer widget area 1', "dkr"),
        'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __( 'Footer Widget Area 2', "dkr"),
        'id' => 'footer-widget-area-2',
        'description' => __( 'The footer widget area 2', "dkr"),
        'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __( 'Footer Widget Area 3', "dkr"),
        'id' => 'footer-widget-area-3',
        'description' => __( 'The footer widget area 3', "dkr"),
        'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __( 'Footer Widget Area 4', "dkr"),
        'id' => 'footer-widget-area-4',
        'description' => __( 'The footer widget area 4', "dkr"),
        'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
}

add_action( 'widgets_init', 'dkr_sidebars' );

// Create List Post

if ( ! function_exists( 'dkr_get_list_posts' ) ) :
    function dkr_get_list_posts($n) {

        global $wp_query;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $n
        );

        $wp_query->query( $args );

        return new WP_Query( $args );
    }
endif;

// Create Function Credits

if ( ! function_exists( 'dkr_credits' ) ) :
    function dkr_credits() {

        $text = sprintf( __('Theme created by <a href="%s">PWT</a>. Powered by <a href="%s">WordPress.org</a>', 'dkr'), esc_url('http://www.pwtthemes.com/'), esc_url('http://wordpress.org/'));

        echo apply_filters( 'dkr_credits_text', $text) ;
    }
endif;

add_action( 'dkr_display_credits', 'dkr_credits' );


//NEW FUNCTIONS.PHP

//show_admin_bar(true);

const PAGE_ID_ABOUT = 235;

function get_text_excerpt($text,$length) {
//    $line=$text;
//    if (preg_match('/^.{1,'.$length.'}\b/s', $text, $match))
//    {
//        $line=$match[0];
//    }

    if($length > strlen($text)) {
        $length = strlen($text) - 10;
    }

    return $text;
    return substr($text, 0, strpos($text, ' ', $length)).' [...]';
}

function my_theme_enqueue_styles() {

    $parent_style = 'dkr-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function theme_js() {

}

add_action('wp_enqueue_scripts', 'theme_js');

function register_teachings_tags_menu() {
    register_nav_menu('teachings-tags-menu',__( 'Teachings Tags Menu'));
}
add_action( 'init', 'register_teachings_tags_menu' );


if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => 'Homepage Content',
            'before_widget' => '<div class = "widgetizedArea">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

function getTopLevelParent($post) {
    if ( is_page() && $post->post_parent ) {

        $parentId = $post->post_parent;
        $parentPost = $post;

        while($parentPost->post_parent!=0) {

            $parentPost = get_post($parentPost->post_parent);
            $parentId = $parentPost->post_parent;
        }

        return $parentPost;
    }

    return $post;
}

function wpb_list_child_pages() {

    global $post;

    if ( is_page() && $post->post_parent ) {

        $parentId = $post->post_parent;
        $parentPost = $post;

        while($parentPost->post_parent!=0) {
            $parentPost = get_post($parentPost->post_parent);
            $parentId = $parentPost->post_parent;
        }



        $childpages = wp_list_pages_dkr( 'sort_column=menu_order&title_li=&child_of=' . $parentPost->ID . '&echo=0' );

    } else {
        $childpages = wp_list_pages_dkr( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

    }

    if ( $childpages ) {

        $string = '<ul>' . $childpages . '</ul>';
    }

    return $string;

}

function wp_list_pages_dkr( $args = '' ) {
    $defaults = array(
        'depth'        => 0,
        'show_date'    => '',
        'date_format'  => get_option( 'date_format' ),
        'child_of'     => 0,
        'exclude'      => '',
        'title_li'     => __( 'Pages' ),
        'echo'         => 1,
        'authors'      => '',
        'sort_column'  => 'menu_order, post_title',
        'link_before'  => '',
        'link_after'   => '',
        'item_spacing' => 'preserve',
        'walker'       => '',
    );

    $r = wp_parse_args( $args, $defaults );

    if ( ! in_array( $r['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
        // invalid value, fall back to default.
        $r['item_spacing'] = $defaults['item_spacing'];
    }

    $output = '';
    $current_page = 0;

    // sanitize, mostly to keep spaces out
    $r['exclude'] = preg_replace( '/[^0-9,]/', '', $r['exclude'] );

    // Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
    $exclude_array = ( $r['exclude'] ) ? explode( ',', $r['exclude'] ) : array();
    /**
     * Filters the array of pages to exclude from the pages list.
     *
     * @since 2.1.0
     *
     * @param array $exclude_array An array of page IDs to exclude.
     */
    $r['exclude'] = implode( ',', apply_filters( 'wp_list_pages_excludes', $exclude_array ) );

    // Query pages.
    $r['hierarchical'] = 0;
    $pages = get_pages_dkr( $r );

    if ( ! empty( $pages ) ) {
        if ( $r['title_li'] ) {
            $output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';
        }
        global $wp_query;
        if ( is_page() || is_attachment() || $wp_query->is_posts_page ) {
            $current_page = get_queried_object_id();
        } elseif ( is_singular() ) {
            $queried_object = get_queried_object();
            if ( is_post_type_hierarchical( $queried_object->post_type ) ) {
                $current_page = $queried_object->ID;
            }
        }

//        pa($current_page,1,1);
        if($current_page->post_parent ) {
            $pages[] = $current_page->post_parent;
//            pa(44,1);
        }



        $emptyPagesIds = array();
        foreach($pages as $page) {
            if( empty($page->post_content) ) {
                $emptyPagesIds[] = $page->ID;
            }
        }

        $emptyPagesIdsImplode = implode(',',$emptyPagesIds);

        $output .= <<<EOT
<script type="text/javascript">
jQuery( document ).ready(function() {
  var emptyPages = [{$emptyPagesIdsImplode}];
  var emptyPagesLength = emptyPages.length;
for (var i = 0; i < emptyPagesLength; i++) {
    var emptyPageLinkEl = 'li.page-item-'+emptyPages[i]+'> a';
    jQuery(emptyPageLinkEl).css('cursor','default');
    jQuery(emptyPageLinkEl).click(function(e) {
        e.preventDefault();
    //do other stuff when a click happens
});
}
});
</script>
EOT;




        $output .= walk_page_tree( $pages, $r['depth'], $current_page, $r );

        if ( $r['title_li'] ) {
            $output .= '</ul></li>';
        }
    }

    /**
     * Filters the HTML output of the pages to list.
     *
     * @since 1.5.1
     * @since 4.4.0 `$pages` added as arguments.
     *
     * @see wp_list_pages()
     *
     * @param string $output HTML output of the pages list.
     * @param array  $r      An array of page-listing arguments.
     * @param array  $pages  List of WP_Post objects returned by `get_pages()`
     */
    $html = apply_filters( 'wp_list_pages', $output, $r, $pages );

    if ( $r['echo'] ) {
        echo $html;
    } else {
        return $html;
    }
}

function get_pages_dkr( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'child_of'     => 0,
        'sort_order'   => 'ASC',
        'sort_column'  => 'post_title',
        'hierarchical' => 1,
        'exclude'      => array(),
        'include'      => array(),
        'meta_key'     => '',
        'meta_value'   => '',
        'authors'      => '',
        'parent'       => -1,
        'exclude_tree' => array(),
        'number'       => '',
        'offset'       => 0,
        'post_type'    => 'page',
        'post_status'  => 'publish',
    );

    $r = wp_parse_args( $args, $defaults );

    $number = (int) $r['number'];
    $offset = (int) $r['offset'];
    $child_of = (int) $r['child_of'];
    $hierarchical = $r['hierarchical'];
    $exclude = $r['exclude'];
    $meta_key = $r['meta_key'];
    $meta_value = $r['meta_value'];
    $parent = $r['parent'];
    $post_status = $r['post_status'];

    // Make sure the post type is hierarchical.
    $hierarchical_post_types = get_post_types( array( 'hierarchical' => true ) );
    if ( ! in_array( $r['post_type'], $hierarchical_post_types ) ) {
        return false;
    }

    if ( $parent > 0 && ! $child_of ) {
        $hierarchical = false;
    }

    // Make sure we have a valid post status.
    if ( ! is_array( $post_status ) ) {
        $post_status = explode( ',', $post_status );
    }
    if ( array_diff( $post_status, get_post_stati() ) ) {
        return false;
    }

    // $args can be whatever, only use the args defined in defaults to compute the key.
    $key = md5( serialize( wp_array_slice_assoc( $r, array_keys( $defaults ) ) ) );
    $last_changed = wp_cache_get_last_changed( 'posts' );

    $cache_key = "get_pages:$key:$last_changed";
    if ( $cache = wp_cache_get( $cache_key, 'posts' ) ) {
        // Convert to WP_Post instances.
        $pages = array_map( 'get_post', $cache );
        /** This filter is documented in wp-includes/post.php */
        $pages = apply_filters( 'get_pages', $pages, $r );
        return $pages;
    }

    $inclusions = '';
    if ( ! empty( $r['include'] ) ) {
        $child_of = 0; //ignore child_of, parent, exclude, meta_key, and meta_value params if using include
        $parent = -1;
        $exclude = '';
        $meta_key = '';
        $meta_value = '';
        $hierarchical = false;
        $incpages = wp_parse_id_list( $r['include'] );
        if ( ! empty( $incpages ) ) {
            $inclusions = ' AND ID IN (' . implode( ',', $incpages ) .  ')';
        }
    }

    $exclusions = '';
    if ( ! empty( $exclude ) ) {
        $expages = wp_parse_id_list( $exclude );
        if ( ! empty( $expages ) ) {
            $exclusions = ' AND ID NOT IN (' . implode( ',', $expages ) .  ')';
        }
    }

    $author_query = '';
    if ( ! empty( $r['authors'] ) ) {
        $post_authors = preg_split( '/[\s,]+/', $r['authors'] );

        if ( ! empty( $post_authors ) ) {
            foreach ( $post_authors as $post_author ) {
                //Do we have an author id or an author login?
                if ( 0 == intval($post_author) ) {
                    $post_author = get_user_by('login', $post_author);
                    if ( empty( $post_author ) ) {
                        continue;
                    }
                    if ( empty( $post_author->ID ) ) {
                        continue;
                    }
                    $post_author = $post_author->ID;
                }

                if ( '' == $author_query ) {
                    $author_query = $wpdb->prepare(' post_author = %d ', $post_author);
                } else {
                    $author_query .= $wpdb->prepare(' OR post_author = %d ', $post_author);
                }
            }
            if ( '' != $author_query ) {
                $author_query = " AND ($author_query)";
            }
        }
    }

    $join = '';
    $where = "$exclusions $inclusions ";

    if ( '' !== $meta_key || '' !== $meta_value ) {
        $join = " LEFT JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )";

        // meta_key and meta_value might be slashed
        $meta_key = wp_unslash($meta_key);
        $meta_value = wp_unslash($meta_value);
        if ( '' !== $meta_key ) {
            $where .= $wpdb->prepare(" AND $wpdb->postmeta.meta_key = %s", $meta_key);
        }
        if ( '' !== $meta_value ) {
            $where .= $wpdb->prepare(" AND $wpdb->postmeta.meta_value = %s", $meta_value);
        }

    }

    if ( is_array( $parent ) ) {
        $post_parent__in = implode( ',', array_map( 'absint', (array) $parent ) );
        if ( ! empty( $post_parent__in ) ) {
            $where .= " AND post_parent IN ($post_parent__in)";
        }
    } elseif ( $parent >= 0 ) {
        $where .= $wpdb->prepare(' AND post_parent = %d ', $parent);
    }

    if ( 1 == count( $post_status ) ) {
        $where_post_type = $wpdb->prepare( "post_type = %s AND post_status = %s", $r['post_type'], reset( $post_status ) );
    } else {
        $post_status = implode( "', '", $post_status );
        $where_post_type = $wpdb->prepare( "post_type = %s AND post_status IN ('$post_status')", $r['post_type'] );
    }

    $orderby_array = array();
    $allowed_keys = array( 'author', 'post_author', 'date', 'post_date', 'title', 'post_title', 'name', 'post_name', 'modified',
        'post_modified', 'modified_gmt', 'post_modified_gmt', 'menu_order', 'parent', 'post_parent',
        'ID', 'rand', 'comment_count' );

    foreach ( explode( ',', $r['sort_column'] ) as $orderby ) {
        $orderby = trim( $orderby );
        if ( ! in_array( $orderby, $allowed_keys ) ) {
            continue;
        }

        switch ( $orderby ) {
            case 'menu_order':
                break;
            case 'ID':
                $orderby = "$wpdb->posts.ID";
                break;
            case 'rand':
                $orderby = 'RAND()';
                break;
            case 'comment_count':
                $orderby = "$wpdb->posts.comment_count";
                break;
            default:
                if ( 0 === strpos( $orderby, 'post_' ) ) {
                    $orderby = "$wpdb->posts." . $orderby;
                } else {
                    $orderby = "$wpdb->posts.post_" . $orderby;
                }
        }

        $orderby_array[] = $orderby;

    }
    $sort_column = ! empty( $orderby_array ) ? implode( ',', $orderby_array ) : "$wpdb->posts.post_title";

    $sort_order = strtoupper( $r['sort_order'] );
    if ( '' !== $sort_order && ! in_array( $sort_order, array( 'ASC', 'DESC' ) ) ) {
        $sort_order = 'ASC';
    }

    $query = "SELECT * FROM $wpdb->posts $join WHERE ($where_post_type) $where ";
    $query .= $author_query;
    $query .= " ORDER BY " . $sort_column . " " . $sort_order ;

    if ( ! empty( $number ) ) {
        $query .= ' LIMIT ' . $offset . ',' . $number;
    }

    $pages = $wpdb->get_results($query);

    if ( empty($pages) ) {
        /** This filter is documented in wp-includes/post.php */
        $pages = apply_filters( 'get_pages', array(), $r );
        return $pages;
    }

    // Sanitize before caching so it'll only get done once.
    $num_pages = count($pages);
    for ($i = 0; $i < $num_pages; $i++) {
        $pages[$i] = sanitize_post($pages[$i], 'raw');
    }

    // Update cache.
    update_post_cache( $pages );

    if ( $child_of || $hierarchical ) {
        $pages = get_page_children_dkr($child_of, $pages);
    }

    if ( ! empty( $r['exclude_tree'] ) ) {

        $exclude = wp_parse_id_list( $r['exclude_tree'] );
        foreach ( $exclude as $id ) {
            $children = get_page_children_dkr( $id, $pages );
            foreach ( $children as $child ) {
                $exclude[] = $child->ID;
            }
        }

        $num_pages = count( $pages );
        for ( $i = 0; $i < $num_pages; $i++ ) {
            if ( in_array( $pages[$i]->ID, $exclude ) ) {
                unset( $pages[$i] );
            }
        }
    }

    $page_structure = array();
    foreach ( $pages as $page ) {
        $page_structure[] = $page->ID;
    }

    wp_cache_set( $cache_key, $page_structure, 'posts' );

    // Convert to WP_Post instances
    $pages = array_map( 'get_post', $pages );

    /**
     * Filters the retrieved list of pages.
     *
     * @since 2.1.0
     *
     * @param array $pages List of pages to retrieve.
     * @param array $r     Array of get_pages() arguments.
     */
    return apply_filters( 'get_pages', $pages, $r );
}

function get_page_children_dkr( $page_id, $pages ) {
    // Build a hash of ID -> children.
    $children = array();
    foreach ( (array) $pages as $page ) {
        $children[ intval( $page->post_parent ) ][] = $page;
    }

    $page_list = array();

    // Start the search by looking at immediate children.
    if ( isset( $children[ $page_id ] ) ) {
        // Always start at the end of the stack in order to preserve original `$pages` order.
        $to_look = array_reverse( $children[ $page_id ] );

        while ( $to_look ) {
            $p = array_pop( $to_look );
            $page_list[] = $p;
            if ( isset( $children[ $p->ID ] ) ) {
                foreach ( array_reverse( $children[ $p->ID ] ) as $child ) {
                    // Append to the `$to_look` stack to descend the tree.
                    $to_look[] = $child;
                }
            }
        }
    }

    return $page_list;
}


add_shortcode('wpb_childpages', 'wpb_list_child_pages');


function ggstyle_menu_item_count( $output, $item, $depth, $args ) {
    // Check if the item is a Category or Custom Taxonomy

    if( $item->object == 'post_tag' ) {
        $object = get_term($item->object_id, $item->object);

        // Check count, if more than 0 display count
        if($object->count > 0) {
            $output_new = '';
            $output_split = str_split($output, strpos($output, '</a>') );
            $output_new .= $output_split[0]. "&nbsp;<span class='menu-item-count'>(".$object->count.")</span>" . $output_split[1];
            $output = $output_new;

        }
    }

    return $output;
}
add_action( 'walker_nav_menu_start_el', 'ggstyle_menu_item_count', 10, 4 );

/* USE PARENT CATEGORIES TEMPLATE - START */
function new_subcategory_hierarchy() {
    $category = get_queried_object();

    $parent_id = $category->category_parent;

    $templates = array();

    if ( $parent_id == 0 ) {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';
    } else {

        // Create replacement $templates array
        $parent = get_category( $parent_id );

        while ($parent->category_parent != 0) {
            $parent = get_category( $parent->category_parent );
        }

        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";

        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php';
    }
    return locate_template( $templates );
}

add_filter( 'category_template', 'new_subcategory_hierarchy' );
/* USE PARENT CATEGORIES TEMPLATE - END */


function wp_list_categories_teachings( $args = '' ) {

    $defaults = array(
        'child_of'            => 0,
        'current_category'    => 0,
        'depth'               => 0,
        'echo'                => 1,
        'exclude'             => '',
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 1,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'name',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories' ),
        'style'               => 'list',
        'taxonomy'            => 'category',
        'title_li'            => __( 'Categories' ),
        'use_desc_for_title'  => 1,
    );

    $r = wp_parse_args( $args, $defaults );

    if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] )
        $r['pad_counts'] = true;

    // Descendants of exclusions should be excluded too.
    if ( true == $r['hierarchical'] ) {
        $exclude_tree = array();

        if ( $r['exclude_tree'] ) {
            $exclude_tree = array_merge( $exclude_tree, wp_parse_id_list( $r['exclude_tree'] ) );
        }

        if ( $r['exclude'] ) {
            $exclude_tree = array_merge( $exclude_tree, wp_parse_id_list( $r['exclude'] ) );
        }

        $r['exclude_tree'] = $exclude_tree;
        $r['exclude'] = '';
    }

    if ( ! isset( $r['class'] ) )
        $r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];

    if ( ! taxonomy_exists( $r['taxonomy'] ) ) {
        return false;
    }

    $show_option_all = $r['show_option_all'];
    $show_option_none = $r['show_option_none'];


    $categories = get_categories( $r );

    $output = '';
    if ( $r['title_li'] && 'list' == $r['style'] && ( ! empty( $categories ) || ! $r['hide_title_if_empty'] ) ) {
        $output = '<li class="' . esc_attr( $r['class'] ) . '">' . $r['title_li'] . '<ul>';
    }
    if ( empty( $categories ) ) {
        if ( ! empty( $show_option_none ) ) {
            if ( 'list' == $r['style'] ) {
                $output .= '<li class="cat-item-none">' . $show_option_none . '</li>';
            } else {
                $output .= $show_option_none;
            }
        }
    } else {
        if ( ! empty( $show_option_all ) ) {

            $posts_page = '';

            // For taxonomies that belong only to custom post types, point to a valid archive.
            $taxonomy_object = get_taxonomy( $r['taxonomy'] );
            if ( ! in_array( 'post', $taxonomy_object->object_type ) && ! in_array( 'page', $taxonomy_object->object_type ) ) {
                foreach ( $taxonomy_object->object_type as $object_type ) {
                    $_object_type = get_post_type_object( $object_type );

                    // Grab the first one.
                    if ( ! empty( $_object_type->has_archive ) ) {
                        $posts_page = get_post_type_archive_link( $object_type );
                        break;
                    }
                }
            }

            // Fallback for the 'All' link is the posts page.
            if ( ! $posts_page ) {
                if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
                    $posts_page = get_permalink( get_option( 'page_for_posts' ) );
                } else {
                    $posts_page = home_url( '/' );
                }
            }

            $posts_page = esc_url( $posts_page );
            if ( 'list' == $r['style'] ) {
                $output .= "<li class='cat-item-all'><a href='$posts_page'>$show_option_all</a></li>";
            } else {
                $output .= "<a href='$posts_page'>$show_option_all</a>";
            }
        }

        if ( empty( $r['current_category'] ) && ( is_category() || is_tax() || is_tag() ) ) {
            $current_term_object = get_queried_object();
            if ( $current_term_object && $r['taxonomy'] === $current_term_object->taxonomy ) {
                $r['current_category'] = get_queried_object_id();
            }
        }

        if ( $r['hierarchical'] ) {
            $depth = $r['depth'];
        } else {
            $depth = -1; // Flat.
        }

        $output .= walk_category_tree_teachings( $categories, $depth, $r );

    }

    if ( $r['title_li'] && 'list' == $r['style'] && ( ! empty( $categories ) || ! $r['hide_title_if_empty'] ) ) {
        $output .= '</ul></li>';
    }

    /**
     * Filters the HTML output of a taxonomy list.
     *
     * @since 2.1.0
     *
     * @param string $output HTML output.
     * @param array  $args   An array of taxonomy-listing arguments.
     */

    $html = apply_filters( 'wp_list_categories', $output, $args );

    if ( $r['echo'] ) {
        echo $html;
    } else {
        return $html;
    }
}

function walk_category_tree_teachings() {
    $args = func_get_args();
    // the user's options are the third parameter
    if ( empty( $args[2]['walker'] ) || ! ( $args[2]['walker'] instanceof Walker ) ) {
        $walker = new Walker_Category_Dr();
    } else {
        $walker = $args[2]['walker'];
    }

    return call_user_func_array( array( $walker, 'walk' ), $args );
}

function add_google_fonts() {
    wp_enqueue_style( 'font1', 'https://fonts.googleapis.com/css?family=Roboto+Slab', false );
    wp_enqueue_style( 'font2', 'https://fonts.googleapis.com/css?family=Raleway:100,300,400', false );
    wp_enqueue_style( 'font3', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );


// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
    echo '<meta property="fb:admins" content="YOUR USER ID"/>';
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:url" content="' . get_permalink() . '"/>';
    echo '<meta property="og:site_name" content="Drupon Rinpoche Karma Lhabu"/>';
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $default_image="http://druponrinpoche.org/wp-content/themes/druponrinpoche/assets/images/logo_dharma_wheel_gold.png"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


function order_posts_by_date_asc( $query ) {
    // Category to reverse order
    $cats = array('transcripts','samye-ling-2016-meditation-retreat');
    if ($query->is_main_query() && in_array($query->query_vars['category_name'],$cats) ) {
        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'ASC' );
    }
}
add_action( 'pre_get_posts', 'order_posts_by_date_asc' );


// Fix gallery bug not always loading when gallery is present, so we load by default...
function rlLightboxConditionaLoading($addScripts ) {
    $addScripts = true;
    return $addScripts;
}
add_filter( 'rl_lightbox_conditional_loading', 'rlLightboxConditionaLoading');


function getDrWebsiteConfig()
{
    $locale = get_locale();
    $drWebsiteConfig = array();

    if($locale == 'en_US') {
        $drWebsiteConfig['home_metaslider_id'] = 132;
        $drWebsiteConfig['home_schedule_id'] = 5;
        $drWebsiteConfig['news_feat_cat_ids'] = array(2,93);
        $drWebsiteConfig['featured_cat_id'] = 93;
        $drWebsiteConfig['schedule_page_id'] = 1581;
        $drWebsiteConfig['aboutrinpoche_page_id'] = 1403;
        $drWebsiteConfig['sekhar_page_id'] = 54;
        $drWebsiteConfig['mts_page_id'] = 693;
        $drWebsiteConfig['lineage_page_id'] = 1063;
        $drWebsiteConfig['selected_pics_gallery_id'] = 1293;
        $drWebsiteConfig['nb_latest_news_posts'] = 4;
        $drWebsiteConfig['teaching_cat_ids'] = array(28,30);
    } elseif($locale == 'zh_CN') {
        $drWebsiteConfig['home_metaslider_id'] = 1516;
        $drWebsiteConfig['home_schedule_id'] = 14;
        $drWebsiteConfig['news_feat_cat_ids'] = array(20,263);
        $drWebsiteConfig['featured_cat_id'] = 263;
        $drWebsiteConfig['schedule_page_id'] = 12987;
        $drWebsiteConfig['aboutrinpoche_page_id'] = 1269;
        $drWebsiteConfig['sekhar_page_id'] = 12938;
        $drWebsiteConfig['mts_page_id'] = 12521;
        $drWebsiteConfig['lineage_page_id'] = 1063;
        $drWebsiteConfig['selected_pics_gallery_id'] = 13617;
        $drWebsiteConfig['nb_latest_news_posts'] = 3;
        $drWebsiteConfig['teaching_cat_ids'] = array();
    }

    return $drWebsiteConfig;

}



add_action('init', function() {
    pll_register_string('read-more', 'Read More','drupon-rinpoche');
    pll_register_string('home-about-rinpoche', 'About Rinpoche','drupon-rinpoche');
    pll_register_string('home-about-rinpoche-intro', 'From an early age Rinpoche underwent long and rigorous training under the direction of supremely accomplished masters of mahamudra and dzogchen.','drupon-rinpoche');
    pll_register_string('home-sekhar-intro', 'Thrangu Sekhar Retreat Center is situated in the hills forming the eastern rim of the Kathmandu Valley, just below a cave used by the revered Tibetan yogi, Milarepa','drupon-rinpoche');
    pll_register_string('home-mts-intro', 'The MTS was founded with the intention of making the classics of Tibetan Buddhism available to non Tibetan speaking practitioners, to aid their study and practice of Dharma.','drupon-rinpoche');
    pll_register_string('upcoming-schedule', 'Upcoming Schedule','drupon-rinpoche');
    pll_register_string('schedule-date', 'Date','drupon-rinpoche');
    pll_register_string('schedule-location', 'Location','drupon-rinpoche');
    pll_register_string('schedule-details', 'Details','drupon-rinpoche');
    pll_register_string('view-full-schedule', 'View Full Schedule','drupon-rinpoche');
    pll_register_string('latest-news', 'Latest News','drupon-rinpoche');
    pll_register_string('header-title-line1','Drupon Khen Rinpoche','drupon-rinpoche');
    pll_register_string('header-title-line2','Karma Lhabu','drupon-rinpoche');
    pll_register_string('footer-copyright', '© 2019 Drupon Khen Rinpoche Karma Lhabu. All Rights Reserved.','drupon-rinpoche');
    pll_register_string('previous-posts','Previous Posts','drupon-rinpoche');
    pll_register_string('next-posts','Next posts','drupon-rinpoche');
    pll_register_string('by','By','drupon-rinpoche');
    pll_register_string('selected-pictures','Selected Pictures','drupon-rinpoche');
    pll_register_string('lineage','Lineage','drupon-rinpoche');

});


/**
 * Filter the single_template with our custom function
 */
add_filter('single_template', 'teaching_single_template');

/**
 * Single template function which will choose our template
 */
function teaching_single_template($single) {
    global $wp_query, $post;
//pa(333,1);
    /**
     * Checks for single template by category
     * Check by category slug and ID
     */

    $drConfig = getDrWebsiteConfig();
    $teachingCatIds = $drConfig['teaching_cat_ids'];
    $teachingTemplatePath = TEMPLATEPATH.'/single-teachings.php';

    foreach((array)get_the_category() as $cat) {
        if(in_array($cat->term_id,$teachingCatIds)) {
            if(file_exists($teachingTemplatePath)) {
                return $teachingTemplatePath;
            }
        }
    }

    return TEMPLATEPATH . '/single.php';

}


