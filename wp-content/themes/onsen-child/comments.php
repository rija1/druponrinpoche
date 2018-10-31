<?php
/**
 * The template for displaying Comments.
 *
 *
 * @package Onsen
 */
?>
<?php if ( ! post_password_required() ) { ?>
<div class="comments comment-form-container">
	<?php if (have_comments()) : ?>
		<h3><?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'onsen' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );?></h3>
		<ul class="commentlist">
		    <?php wp_list_comments(); ?>
		</ul>
        <p><?php paginate_comments_links(); ?></p>
        <?php comment_form(); ?>
	<?php endif; ?>

</div>
<?php } ?>