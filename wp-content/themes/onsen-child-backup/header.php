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

			<div class="header-block">
                <div class="header-block2">
                        <div class="gutter clearfix">
                            <?php
                            if ( has_custom_logo() ) { onsen_the_custom_logo(); }
                            else{
                            ?>
                            <div class="column-7-12 left">
                                <div class="header_img">
                                    <img width="50" class="left" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="" />
                                </div>
                                <div class="header_title">
                                    <span class="header_title_dkr">Drupon Khen Rinpoche<br/></span>
                                    <span class="header_title_kl" >Karma Lhabu</span>
                                </div>
    <!--                            <img width="400" style="padding-left:20px;" class="left" src="--><?php //echo esc_url(get_template_directory_uri()); ?><!--/assets/images/dkr-logo-txt-en.png" alt="" />-->
    <!--                            <a href="--><?php //echo esc_url(home_url('/')); ?><!--"><h1 class="ct_site_name">--><?php //echo bloginfo('name');?><!--</h1></a>-->
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
                </div> <!--  END header-block2  -->
                <div class="menu-bar">
<!--                    <div class="container">-->
<!--                        <div class="gutter clearfix">-->
                            <nav class="menu-top-container">
                                <?php if ( has_nav_menu( 'onsen-menu' ) ) { ?>
                                    <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'onsen-menu', 'depth'=>2, 'items_wrap'  => '<ul class="menu-top">%3$s</ul>'  ) ); ?>
                                <?php } else { ?>
                                    <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top', 'depth'=>2, 'items_wrap'  => '<ul class="menu-top">%3$s</ul>' ) ); ?>
                                <?php } ?>
                            </nav>
                            <nav class="menu-top-mob-container">
                                <a class="icon-menu" href="#"><?php _e( 'Menu', 'onsen' ); ?></a>
                                <?php if ( has_nav_menu( 'onsen-menu' ) ) { ?>
                                    <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'onsen-menu', 'depth'=>2, 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>'  ) ); ?>
                                <?php } else { ?>
                                    <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top-mob', 'depth'=>2, 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>' ) ); ?>
                                <?php } ?>
                            </nav>
<!--                        </div>-->
<!--                    </div> <!--  END container  -->
                </div> <!--  END menu-bar  -->
            </div> <!--  END header-block  -->

		</header> <!--  END header  -->
		<div id="content" class="content">