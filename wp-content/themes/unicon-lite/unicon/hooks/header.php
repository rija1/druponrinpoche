<?php
/**
 * Header Section Function Area
*/

if ( ! function_exists( 'unicon_lite_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	*/
	function unicon_lite_skip_links() {
		?>
			<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'unicon-lite' ); ?></a>
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'unicon-lite' ); ?></a>
		<?php
	}
}
add_action( 'unicon_lite_header_before', 'unicon_lite_skip_links', 5 );


/**
 * Header Before Function Area
**/
if ( ! function_exists( 'unicon_lite_header_before' ) ) { 

	function unicon_lite_header_before() { ?>
		<header id="masthead" class="site-header <?php if( ( is_page_template('template-home.php') ) ){ echo 'kr-homepage'; }else{ echo 'kr-innerheader'; } ?> " <?php if( is_page_template('template-home.php') ) { if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } } ?>>
			<?php if( is_front_page() ) { ?><div class="kr-headerwrap"> <?php } ?>
		<?php
	}
}
add_action( 'unicon_lite_header_before', 'unicon_lite_header_before', 10 );


/**
 * Top Header Function Area
**/
if ( ! function_exists( 'unicon_lite_top_header' ) ) {
	function unicon_lite_top_header() {
		$top_header = esc_attr( get_theme_mod('unicon-lite-top-header-settings-option','show') );
		$about_toggle = intval( get_theme_mod( 'unicon_top_header_toggle', 1 ));
		if( !empty( $top_header ) && $top_header == 'show' ) { ?>			
			<div class="topheader clearfix">
				<div class="container-wrap">
					<div class="quickinfo">
						<?php apply_filters( 'unicon_lite_quick_contact_info_top_header', 5 ); ?>
					</div>
					<div class="right-header-wrap">
					
					<?php if(!empty( $about_toggle ) && $about_toggle == 1) { ?>
						<div class="abouttoggle">
							<span class="first-line"></span>
							<span class="second-line"></span>
							<span class="third-line"></span>
						</div>
						<div class="abouttoggle-content">
						</div>
					<?php } ?>
					<div class="socialicon">
						<?php apply_filters( 'unicon_lite_social_icon_top_header', 10 ); ?>
					</div>
					</div>
				</div>
			</div>				
			<?php
		}
	}
}
add_action( 'unicon_lite_main_header', 'unicon_lite_top_header', 15 );


/**
 * Main Header Function Area
**/
if ( ! function_exists( 'unicon_lite_main_header' ) ) {
	function unicon_lite_main_header() { ?>
		<div class="container-wrap">
			<div class="mainheader clearfix">
				<div class="site-branding">
					<div class="logo">
						<?php
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							}
						?>
					</div>
					<div class="logo-textwrap">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<?php 
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) { ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php } ?>
					</div>
				</div><!-- .site-branding -->
				<div class="kr-navmenu">
				<div class="kr-toggle">
					<div class="one"></div>
					<div class="two"></div>
					<div class="three"></div>
				</div>
				<div class="menulink">				
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => 'unicon_lite_menu_notice' ) ); ?>

				</div>
				<div class="mask"></div>
				</div>
			</div>
		</div>			
		<?php
	}
}
add_action( 'unicon_lite_main_header', 'unicon_lite_main_header', 20 );

/**
* No Menu Set notice
*/
function unicon_lite_menu_notice() {
	?>
	<div class="un-menu-notice">
		<?php printf( esc_html__( 'SET %s.', 'unicon-lite' ), '<a href="'.esc_url(admin_url('nav-menus.php')).'">MENU</a>' ); ?>
		<?php //esc_html_e('Set the Primary Menu', 'unicon-lite'); ?>
	</div>
	<?php
}


/**
 * Main Header Banner Content Function Area
**/
if ( ! function_exists( 'unicon_lite_main_header_content' ) ) {
	function unicon_lite_main_header_content() { 
			$unicon_lite_main_title = get_theme_mod( 'unicon_lite_main_title', esc_html__('SOLUTION FOR YOUR BUSINCESS', 'unicon-lite') );
			$unicon_lite_main_description = get_theme_mod( 'unicon_lite_main_description', esc_html__('Better security happens when we work together, Get tips on further steps you can take to protect yourself online. better security happens when we work together happens', 'unicon-lite') );

			$unicon_lite_first_button_title = get_theme_mod( 'unicon_lite_first_button_title', esc_html__('Read More', 'unicon-lite') );
			$unicon_lite_first_button_url = get_theme_mod( 'unicon_lite_first_button_url', esc_url( home_url( '/' ).'#focus' ) );

			$unicon_lite_second_button_title = get_theme_mod( 'unicon_lite_second_button_title', esc_html__('Purchase Now', 'unicon-lite') );
			$unicon_lite_second_button_url = get_theme_mod( 'unicon_lite_second_button_url', esc_url( home_url( '/' ).'#focus' ) );
		if( is_page_template('template-home.php') ) { ?>
			<div class="mainbanner-content">
				<div class="mainbanner-wrap">
					<?php if(!empty( $unicon_lite_main_title )) { ?>
						<h1 class="wow slideInDown"><?php echo esc_html($unicon_lite_main_title); ?></h1>
					<?php } ?>
					<?php if(!empty( $unicon_lite_main_description )) { ?>
						<div class="main-content wow slideInDown"><?php echo esc_html($unicon_lite_main_description); ?></div>
					<?php } ?>
				</div>
				<div class="mainbanner-button-wrap">
					<?php if( !empty( $unicon_lite_first_button_title ) ) { ?>
						<div class="first-button kr-styleone wow fadeInLeft">
							<a href="<?php echo esc_url($unicon_lite_first_button_url); ?>">
								<?php echo esc_html($unicon_lite_first_button_title); ?>
							</a>
						</div>
					<?php } ?>
					<?php if( !empty( $unicon_lite_second_button_title ) ) { ?>
						<div class="first-button wow fadeInRight">
							<a href="<?php echo esc_url($unicon_lite_second_button_url); ?>">
								<?php echo esc_html($unicon_lite_second_button_title); ?>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>		
		<?php }
	}
}
add_action( 'unicon_lite_main_header', 'unicon_lite_main_header_content', 20 );

/**
 * Header After Function Area
**/
if ( ! function_exists( 'unicon_lite_header_after' ) ) {
	
	function unicon_lite_header_after() { ?>
			<?php if( is_front_page() ) { ?></div><?php } ?>
		</header>
		<?php
	}
}
add_action( 'unicon_lite_header_after', 'unicon_lite_header_after', 30 );