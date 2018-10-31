<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Onsen
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper" class="wrapper">
		<header id="header" class="header">
			<div class="top-bar">
				<div class="container">
					<div class="column-container top-bar-columns">
						<div class="column-7-12 left">
							<div class="gutter">
								<ul>
								    <li><i class="fa fa-phone"></i><a href="phone:<?php echo esc_html(get_theme_mod('onsen_header_phone',__( '+80 12-878-587', 'onsen' ))); ?>"><?php echo esc_html(get_theme_mod('onsen_header_phone',__( '+80 12-878-587', 'onsen' ))); ?></a></li>
									<li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_html(get_theme_mod('onsen_header_email',__( 'info@example.com', 'onsen' ))); ?>"><?php echo esc_html(get_theme_mod('onsen_header_email',__( 'info@example.com', 'onsen' ))); ?></a></li>
								</ul>
							</div>
						</div>
						<div class="column-5-12 right">
							<div class="gutter">
								<ul>
									<li><?php bloginfo( 'description' ); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div> <!--  END container  -->
			</div> <!--  END top-bar  -->
			<div class="header-block">
				<div class="container">
					<div class="gutter clearfix">
                        <?php
                        if ( has_custom_logo() ) { onsen_the_custom_logo(); }
                        else{
                        ?>       
                        <div class="column-5-12 left">
                            <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="ct_site_name"><?php echo bloginfo('name');?></h1></a>
                        </div>
                        <?php } ?>
						<?php if(get_theme_mod('onsen_social_media_code1') or get_theme_mod('onsen_social_media_code2') or get_theme_mod('onsen_social_media_code3') or get_theme_mod('onsen_social_media_code4') or get_theme_mod('onsen_social_media_code5')) { ?>
						<ul class="social">
							<?php if(get_theme_mod('onsen_social_media_code1')) { ?><li><a class="fa fa-<?php echo get_theme_mod('onsen_social_media_code1'); ?>" href="<?php echo esc_url(get_theme_mod('onsen_social_media_link1')); ?>"></a></li><?php } ?>																
							<?php if(get_theme_mod('onsen_social_media_code2')) { ?><li><a class="fa fa-<?php echo get_theme_mod('onsen_social_media_code2'); ?>" href="<?php echo esc_url(get_theme_mod('onsen_social_media_link2')); ?>"></a></li><?php } ?>																
							<?php if(get_theme_mod('onsen_social_media_code3')) { ?><li><a class="fa fa-<?php echo get_theme_mod('onsen_social_media_code3'); ?>" href="<?php echo esc_url(get_theme_mod('onsen_social_media_link3')); ?>"></a></li><?php } ?>																
							<?php if(get_theme_mod('onsen_social_media_code4')) { ?><li><a class="fa fa-<?php echo get_theme_mod('onsen_social_media_code4'); ?>" href="<?php echo esc_url(get_theme_mod('onsen_social_media_link4')); ?>"></a></li><?php } ?>																
							<?php if(get_theme_mod('onsen_social_media_code5')) { ?><li><a class="fa fa-<?php echo get_theme_mod('onsen_social_media_code5'); ?>" href="<?php echo esc_url(get_theme_mod('onsen_social_media_link5')); ?>"></a></li><?php } ?>									
						</ul>						
						<?php } ?>						
					</div>
				</div> <!--  END container  -->
			</div> <!--  END header-block  -->
			<div class="menu-bar">
                <div class="gutter clearfix">
                    <nav class="menu-top-container">
                        <?php if ( has_nav_menu( 'onsen-menu' ) ) { ?>
                           <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'onsen-menu', 'items_wrap'  => '<ul class="menu-top">%3$s</ul>'  ) ); ?>
                        <?php } else { ?>
                            <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top', 'items_wrap'  => '<ul class="menu-top">%3$s</ul>' ) ); ?>
                        <?php } ?>
                    </nav>
                    <nav class="menu-top-mob-container">
                        <a class="icon-menu" href="#"><?php _e( 'Menu', 'onsen' ); ?></a>
                        <?php if ( has_nav_menu( 'onsen-menu' ) ) { ?>
                           <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'onsen-menu', 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>'  ) ); ?>
                        <?php } else { ?>
                            <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top-mob', 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>' ) ); ?>
                        <?php } ?>
                    </nav>
                </div>
			</div> <!--  END menu-bar  -->
		</header> <!--  END header  -->
		<div id="content" class="content">