<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Onsen
 */
?>
		</div> <!--  END content  -->
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
								<p><?php echo  esc_html(get_theme_mod('onsen_copyrights')); ?></p>
							</div>
						</div>
						<div class="column-6-12 right">
							<div class="gutter">
								<p><?php do_action( 'onsen_display_credits' ); ?></p>
							</div>
						</div>
					</div>
				</div> <!--  END container  -->
			</div> <!--  END copyright-block  -->
		</footer> <!--  END footer  -->
	</div> <!--  END wrapper  -->
<?php wp_footer(); ?>	
</body>
</html>