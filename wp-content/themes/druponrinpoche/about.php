<?php
/**
 * Onsen About Theme
 *
 * @package Onsen
 */
// About theme info

add_action( 'admin_menu', 'dkr_abouttheme' );

function dkr_abouttheme() {
 	
	add_theme_page( __('About Theme', 'dkr'), __('About Theme', 'dkr'), 'edit_theme_options', 'about-dkr', 'dkr_guide');
	
} 

if( ! function_exists( 'admin_dkr_enqueue_styles' ) ) {
	function admin_dkr_enqueue_styles() {

		wp_enqueue_style( 'dkr-style-admin', get_template_directory_uri() . '/assets/css/style-admin.css', array(), '1.0' );
	}
	add_action( 'admin_enqueue_scripts', 'admin_dkr_enqueue_styles' );
}

//guidline for about theme

function dkr_guide() {

?>
<div class="wrapper-info">
	<div class="aedifcator-box">
   		<div class="aedifcator-box-title">
			<?php esc_attr_e('About Onsen Theme', 'dkr'); ?>
		</div>
		<p><?php esc_attr_e('Onsen is an awesome theme with fully responsive and compatible with newest version of WordPress, is easy to customizable, SEO Optimizable, Fast loading and an awesome panel options. Onsen Theme is perfect for a construction business, but also for various other business or personal blog, The customization of this theme is very easy.','dkr'); ?></p>
		<div class="proversion">
			<h3><?php esc_attr_e('Upgrade to Pro version!', 'dkr'); ?></h3>
				<a class="upgradepro" target="_blank" href="<?php echo esc_url('https://www.pwtthemes.com/theme/dkr-responsive-wordpress-theme'); ?>" target="_blank"><?php esc_attr_e('UPGRADE TO PRO', 'dkr'); ?></a>
				<a class="livepreviw" target="_blank" href="<?php echo esc_url('https://www.pwtthemes.com/demo/dkr'); ?>" target="_blank"><?php esc_attr_e('LIVE PREVIEW', 'dkr'); ?></a>
			<p><?php esc_attr_e('If you need assistance, please do not hesitate to', 'dkr'); ?> <a target="_blank" href="<?php echo esc_url('https://www.pwtthemes.com/contact'); ?>"><?php esc_attr_e('contact us', 'dkr'); ?></a></p>
	        <h3><?php esc_attr_e('FREE vs PRO', 'dkr'); ?></h3>

    	</div>		   
		<a href="<?php echo esc_url('https://www.pwtthemes.com/theme/dkr-responsive-wordpress-theme'); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/demo/freevspro.jpg" alt="" /></a>
	</div>
</div>
<?php } ?>