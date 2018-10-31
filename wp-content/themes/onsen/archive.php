<?php
/**
 * The template for displaying archive
 *
 * @package Onsen
 */
get_header();
?>
<section class="section section-page-title" <?php if(get_theme_mod('onsen_blog_image')) { ?> style="background-image: url('<?php echo esc_url(get_theme_mod('onsen_blog_image')); ?>')"  <?php } ?>>
	<div class="overlay">
		<div class="container">
			<div class="section-title">
				<div class="gutter">
					<h4><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'onsen' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'onsen' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'onsen' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'onsen' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'onsen' ) ) . '</span>' );
					else :
						_e( 'Archives', 'onsen' );
					endif;
				?></h4>
				</div>
			</div>
		</div> <!--  END container  -->
	</div> <!--  END overlay  -->
</section> <!--  END section-page-title  -->
<?php
get_template_part( 'content', 'posts' ); 
get_footer(); 
?>