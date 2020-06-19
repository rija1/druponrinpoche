<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog">
        <div class="container">
            <div class="blog-columns clearfix">
                <div class="sidebar-container left">
                    <?php get_template_part( 'online-teaching-left-menu'); ?>
                </div>
                <div class="inner-page-container right">
                    <div class="section-title">
                        <div class="gutter">
                            <h1><?php the_title(); ?></h1>
                            <?php //the_excerpt(); ?>
                        </div>
                    </div>
                    <div class="gutter">
                        <article class="single-post">
                            <div class="article-text">
                                <?php the_content(); ?>


                                <?php
                                $nonce = wp_create_nonce("online_teaching_register_nonce");
                                $link = admin_url('admin-ajax.php?action=online_teaching_register&post_id='.$post->ID.'&nonce='.$nonce);
                                $userId = get_current_user_id();

                                $already_registered = MB_Relationships_API::has( $userId, $post->ID, 'users_to_online_teachings' );
//                                echo '<a class="user_like" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $link . '">Register to this course</a>';
                                ?>

                                <?php if ( $already_registered ): ?>
                                    <a class="teaching_unregister" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post->ID; ?>" href="<?php echo $link; ?>">
                                        <span><?php echo pll__('Unregister from this course'); ?></span>
                                    </a>
                                <?php else: ?>
                                    <a class="teaching_register" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post->ID; ?>" href="<?php echo $link; ?>">
                                        <span><?php echo pll__('Register to this course'); ?></span>
                                    </a>
                                <?php endif; ?>


                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">
//    jQuery( document ).ready(function() {
//        jQuery(".user_like").click( function(e) {
//            e.preventDefault();
//            post_id = jQuery(this).attr("data-post_id");
//            nonce = jQuery(this).attr("data-nonce");
//            jQuery.ajax({
//                type : "post",
//                dataType : "json",
//                url : myAjax.ajaxurl,
//                data : {action: "online_teaching_register", post_id : post_id, nonce: nonce},
//                success: function(response) {
//                    if(response.type == "success") {
//                        jQuery("#like_counter").html(response.like_count);
//                    }
//                    else {
//                        alert("Your like could not be added");
//                    }
//                }
//            });
//        });
//    });
</script>