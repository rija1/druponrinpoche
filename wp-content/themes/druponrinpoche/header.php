<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Onsen
 */

$polylang = new PLL_Widget_Languages();
$pllSwitcher = new PLL_Switcher();
$pllArgs = array(
    'dropdown'               => 0, // display as list and not as dropdown
    'echo'                   => 1, // echoes the list
    'hide_if_empty'          => 1, // hides languages with no posts ( or pages )
    'menu'                   => 0, // not for nav menu ( this argument is deprecated since v1.1.1 )
    'show_flags'             => 0, // don't show flags
    'show_names'             => 1, // show language names
    'display_names_as'       => 'name', // valid options are slug and name
    'force_home'             => 0, // tries to find a translation
    'hide_if_no_translation' => 0, // don't hide the link if there is no translation
    'hide_current'           => 0, // don't hide current language
    'post_id'                => null, // if not null, link to translations of post defined by post_id
    'raw'                    => 0, // set this to true to build your own custom language switcher
    'item_spacing'           => 'preserve', // 'preserve' or 'discard' whitespace between list items
);

//pa(PLL()->links,1);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KR69DWG');</script>
<!-- End Google Tag Manager -->

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KR69DWG"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="fb-root"></div>
<script>
(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

		<div id="content" class="content">

        <div class="container">
            <header id="header" class="header">
                <div class="menu-bar">
<!--                    <div class="gutter clearfix">-->

                        <div class="header_top_block">
                            <div class="menu-bar-logo-block">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/logo_dharma_wheel_gold.png" />
                                    <div class="logo_name">
                                        <span class="logo_dkr">Drupon Khen Rinpoche</span>
                                        <span class="logo_kl">Karma Lhabu <!--&nbsp;&nbsp;&nbsp;ཀརྨ་ལྷ་བུ།--></span>
                                    </div>
                                </a>
                            </div>
                            <ul class="poly_switcher">
                                <?php
                                $pllSwitcher->the_languages(PLL()->links,$pllArgs);
                                ?>
                            </ul>
                        </div>

                        <nav class="menu-top-container">
                            <?php if ( has_nav_menu( 'dkr-menu' ) ) { ?>
                                <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'dkr-menu', 'items_wrap'  => '<ul class="menu-top">%3$s</ul>','depth' => 2  ) ); ?>
                            <?php } else { ?>
                                <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top', 'items_wrap'  => '<ul class="menu-top">%3$s</ul>','depth' => 2 ) ); ?>
                            <?php } ?>
                        </nav>
                        <nav class="menu-top-mob-container">
                            <a class="icon-menu" href="#"><?php _e( 'Menu', 'druponrinpoche' ); ?></a>
                            <?php if ( has_nav_menu( 'dkr-menu' ) ) { ?>
                                <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'dkr-menu', 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>','depth' => 2  ) ); ?>
                            <?php } else { ?>
                                <?php wp_nav_menu(  array('container'=> '', 'menu_class'  => 'menu-top-mob', 'items_wrap'  => '<ul class="menu-top-mob">%3$s</ul>','depth' => 2 ) ); ?>
                            <?php } ?>
                        </nav>
<!--                    </div>-->

                </div>
            </header>
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
