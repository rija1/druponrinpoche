<?php
/**
 * The template for displaying archive
 *
 * @package Onsen
 */
get_header();
?>
<section class="section section-page-title" <?php if(get_theme_mod('dkr_blog_image')) { ?> style="background-image: url('<?php echo esc_url(get_theme_mod('dkr_blog_image')); ?>')"  <?php } ?>>
		<div class="container">
			<div class="section-title">
				<div class="gutter">
					<h4><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'dkr' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'dkr' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'dkr' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'dkr' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'dkr' ) ) . '</span>' );
					else :
						_e( 'Archives', 'dkr' );
					endif;
				?></h4>
				</div>
			</div>
		</div> <!--  END container  -->
</section> <!--  END section-page-title  -->
<?php
get_template_part( 'archive', 'posts' );
get_footer();
?>