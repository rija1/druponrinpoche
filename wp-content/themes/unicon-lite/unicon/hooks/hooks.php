<?php
/**
 * Page breadcrumb funciton area
*/
if ( ! function_exists( 'unicon_lite_breadcrumb_section' ) ) {    
    function unicon_lite_breadcrumb_section() {
    	global $post;
	    $breadcrumb_section = get_theme_mod('unicon_lite_breadcrumb_section', 'show');
	    $breadcrumb_menu = get_theme_mod('unicon_lite_breadcrumb_menu', 'show');
	    $breadcrumb_bg_image = get_theme_mod('unicon_lite_breadcrumb_bg_image');

		if(!empty( $breadcrumb_bg_image )){
	    	$breadcrumb_bg_image = $breadcrumb_bg_image;
	    }

    	if($breadcrumb_section == 'show') { ?>
			<?php if ( !is_home() ) : ?>
	        <div class="page_header_wrap page-banner" style="background:url('<?php echo esc_url($breadcrumb_bg_image); ?>') no-repeat center;">
	            <div class="container-wrap">
	                
	                <header class="entry-header">
	                    <?php if( is_archive() ) {
	                            the_archive_title( '<h1 class="entry-title">', '</h1>' );
	                        } elseif( is_search() ){ ?>
                              <header class="page-header">
                                <h1 class="entry-title"><?php printf( esc_html__( 'Search Results', 'unicon-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                              </header><!-- .page-header --> 
                            <?php } elseif( is_404() ){ ?>
                              <header class="page-header">
                                <h1 class="entry-title"><?php _e('404','unicon-lite') ?></h1>
                              </header><!-- .page-header -->   
                            <?php } else{
	                          the_title( '<h1 class="entry-title">', '</h1>' );
	                        }
	                    ?>                   
	                </header><!-- .entry-header -->

	                <?php if($breadcrumb_menu == 'show') {  unicon_lite_breadcrumbs_menu(); } ?>

	            </div>
	        </div>
	    	<?php endif; ?>
	    <?php }
    }
}
add_action( 'unicon-lite-breadcrumb', 'unicon_lite_breadcrumb_section' );