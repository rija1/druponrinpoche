<?php get_header(); ?>
<?php
if ( !is_user_logged_in() ) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}
$nonce = wp_create_nonce("online_teaching_register_nonce");
$userId = get_current_user_id();
$already_registered = MB_Relationships_API::has( $userId, get_the_ID(), 'users_to_online_teachings' );
$unregLink = admin_url('admin-ajax.php?action=online_teaching_register&register=2&post_id='.$post->ID.'&nonce='.$nonce);
$regLink = admin_url('admin-ajax.php?action=online_teaching_register&register=1&post_id='.$post->ID.'&nonce='.$nonce);
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog online-teachings single-online-teaching">
        <div class="container">
            <div class="blog-columns clearfix">
                <?php get_template_part( 'online-teaching-left-menu'); ?>
                <div class="inner-page-container right">
                    <div class="section-title">
                        <div class="gutter">
                            <h1><?php the_title(); ?></h1>
                            <?php //the_excerpt(); ?>
                            <div class="registrationStatus registYes" style="<?php echo ($already_registered) ? 'display:block;' : 'display:none;' ; ?>">
                                <p><?php echo pll__('You are registered to this course.'); ?></p>
                                <p><?php echo pll__('A link to the Youtube live teaching video will appear on this page about 15 minutes before each session.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="gutter">
                        <article class="single-post">
                            <div class="article-text">
                                <?php the_content(); ?>

                                <a style="display:<?php echo ($already_registered) ? 'block' : 'none' ; ?>;" class="teaching_unregister teaching_reg_action" href="<?php echo $unregLink; ?>">
                                    <span><?php echo pll__('Unregister from this course'); ?></span>
                                </a>
                                <a style="display:<?php echo ($already_registered) ? 'none' : 'block' ; ?>;" class="teaching_register teaching_reg_action" href="<?php echo $regLink; ?>">
                                    <span><?php echo pll__('Register to this course'); ?></span>
                                </a>

                                <div id="modal_register" class="modal">
                                    <div class="modal_confirm">
                                        <div class="modal_loading">
                                            <img src="<?php echo plugins_url( 'online-teachings/includes/images/spinner.gif'); ?>" />
                                        </div>
                                        <div class="modal_content">
                                            <div class="modal_text">

                                            </div>
                                            <div class="modal_buttons">
                                                <a id="modal_cancel" class="um-button" href="#" rel="modal:close"><?php echo pll__('Cancel'); ?></a>
                                                <a id="modal_confirm" regaction="1" class="um-button" href="javascript:confirmRegUnregAction();"><?php echo pll__('OK'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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

    function teachingRegUnregAction(action) {

        jQuery(".modal_buttons").show();

        if(action == 'register') {
            var modalText = '<?php echo pll__('I confirm I can attend all the sessions for this course.'); ?>';

        } else if (action == 'unregister') {
            var modalText = '<?php echo pll__('Do you confirm you want to unregister from this course ?<br/>You cannot register again once the course has started.'); ?>';
        }
        jQuery(".modal_text").html(modalText);
        jQuery("#modal_register").modal();
    }

    function confirmRegUnregAction() {

        jQuery(".modal_content").hide();
        jQuery(".modal_loading").show();

        var regaction = jQuery("#modal_confirm").attr('regaction');

        post_id = "<?php echo $post->ID; ?>";
        nonce = "<?php echo $nonce; ?>";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : myAjax.ajaxurl,
            data : {action: "online_teaching_register", post_id : post_id, register : regaction, nonce: nonce},
            success: function(response) {
//                    if(response.type == "success") {
                jQuery(".modal_text").html(response.message);
                jQuery(".modal_loading").hide();
                jQuery(".modal_content").show();
                jQuery(".modal_buttons").hide();
                jQuery(".modal_register").modal();

                if(response.registered == "1") {
                    jQuery('.teaching_unregister').show();
                    jQuery('.teaching_register').hide();
                    jQuery('.registYes').show();
                    jQuery('.registNo').hide();
                } else if(response.registered == "0") {
                    jQuery('.teaching_unregister').hide();
                    jQuery('.teaching_register').show();
                    jQuery('.registYes').hide();
                    jQuery('.registNo').show();
                }
            }
        });


    }

    jQuery( document ).ready(function() {

        jQuery(".teaching_register").click( function(e) {
            e.preventDefault();
            teachingRegUnregAction('register');
            jQuery("#modal_confirm").attr('regaction','1');
        });

        jQuery(".teaching_unregister").click( function(e) {
            e.preventDefault();
            teachingRegUnregAction('unregister');
            jQuery("#modal_confirm").attr('regaction','2');
        });

        jQuery("#modal_cancel").click( function(e) {
            jQuery("#modal_register").modal().close();
        });

    });
</script>