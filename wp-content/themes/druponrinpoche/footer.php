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
			<div class="footer_block">
				<div class="footer">
					<div class="footer_social">
						<a class="weibo" href="https://weibo.com/u/1809059790" target="_blank" rel="noopener"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/weibo_logo.png" /></a>
						<div id="wechat_qrcode" class="modal">
							<img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/wechat_qrcode.webp" />
						</div>
						<a class="wechat" href="#wechat_qrcode"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/wechat_icon.png" /></a>
					</div>
					<div class="footer_copyright">
						<p><?php echo esc_html(get_theme_mod('dkr_copyrights')); ?><?php echo rbq_trsl('Copyright © 2010-2022 根绒多吉仁波切 All rights reserved'); ?></p>
					</div>
				</div> <!--  END footer  -->
			</div> <!--  END footer_block  -->
		</footer> <!--  END footer  -->
        </div> <!--  END container  -->
	</div> <!-- CLOSE #content -->
<?php
wp_footer(); ?>
</body>
</html>