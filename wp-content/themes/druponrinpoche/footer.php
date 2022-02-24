<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Onsen
 */
$locale = get_locale();
?>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        jQuery('a[href="#wechat_qrcode"]').click(function(event) {
        event.preventDefault();
            jQuery(this).modal({
        fadeDuration: 300
        });
        });
    });
</script>
		<footer id="footer" class="footer">
			<div class="footer-block">
				<div class="container">
					<div class="column-container widgets-columns">
						<div class="column-3-12">
							<div class="gutter">
								<?php if ( is_active_sidebar('footer-widget-area-1') ) : ?>
									<?php dynamic_sidebar('footer-widget-area-1'); ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="column-3-12">
							<div class="gutter">
								<?php if ( is_active_sidebar('footer-widget-area-2') ) : ?>
									<?php dynamic_sidebar('footer-widget-area-2'); ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="column-3-12">
							<div class="gutter">
								<?php if ( is_active_sidebar('footer-widget-area-3') ) : ?>
									<?php dynamic_sidebar('footer-widget-area-3'); ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="column-3-12">
							<div class="gutter">
								<?php if ( is_active_sidebar('footer-widget-area-4') ) : ?>
									<?php dynamic_sidebar('footer-widget-area-4'); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div> <!--  END container  -->
			</div> <!--  END footer-block  -->
			<div class="copyright-block">
				<div class="container">
					<div class="column-container copyright-columns">
						<div class="column-6-12 left">

							<div class="gutter">
                                <div class="footer_social">

                                    <a class="weibo" href="https://weibo.com/u/1809059790" target="_blank" rel="noopener"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/weibo_logo.png" /></a>

                                    <div id="wechat_qrcode" class="modal">
                                        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/wechat_qrcode.webp" />
                                    </div>

                                    <a class="wechat" href="#wechat_qrcode"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/wechat_icon.png" /></a>

                                </div>
								<p><?php echo  esc_html(get_theme_mod('dkr_copyrights')); ?></p>
							</div>
						</div>
						<div class="column-6-12 right">

							<div class="gutter">
                                </p><?php echo rbq_trsl('Copyright © 2010-2022 根绒多吉仁波切 All rights reserved'); ?></p>
							</div>
						</div>
					</div>
				</div> <!--  END container  -->
			</div> <!--  END copyright-block  -->
		</footer> <!--  END footer  -->
        </div> <!--  END container  -->
	</div> <!-- CLOSE #content -->
<?php
wp_footer(); ?>
</body>
</html>