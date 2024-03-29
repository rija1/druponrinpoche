<?php get_header(); ?>
<?php
if ( !is_user_logged_in() ) {
    $curr = UM()->permalinks()->get_current_url();
    $redirect = esc_url( add_query_arg( 'redirect_to', urlencode_deep( $curr ), um_get_core_page( 'login' ) ) );
    exit( wp_redirect( $redirect ) );
}

$nonce = wp_create_nonce("online_teaching_register_nonce");
$userId = get_current_user_id();
$alreadyRegistered = isUserRegisteredToCourse($userId, get_the_ID());
$unregLink = admin_url('admin-ajax.php?action=online_teaching_register&register=2&post_id='.$post->ID.'&nonce='.$nonce);
$regLink = admin_url('admin-ajax.php?action=online_teaching_register&register=1&post_id='.$post->ID.'&nonce='.$nonce);
$registrationOpen = isRegistrationOpen();
$currentSession = getCurrentSession(get_the_ID());
$zoomNumber = getZoomNumber($userId);
$showSessionInfo = false; // We don't bother with stuff regarding current session anymore //showSessionInfo($currentSession);
?>



<?php while (have_posts()) : the_post(); ?>
    <div class="section section-blog online-teachings single-online-teaching">
        <div class="container">
            <div class="blog-columns">
                <?php get_template_part( 'online-teaching-left-menu'); ?>
                <div class="inner-page-container">
                    <div class="section-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="registrationStatus registYes" style="<?php echo ($alreadyRegistered && !$showSessionInfo) ? 'display:block;' : 'display:none;' ; ?>">
                        <p><?php echo pll__('You are registered to this course.'); ?></p>
                    </div>
                    <div class="registrationStatus registNo" style="<?php echo ($alreadyRegistered) ? 'display:none;' : 'display:block;' ; ?>">
                        <?php if($registrationOpen): ?>
                            <p><?php echo pll__('You are not registered to this course.'); ?></p>
                        <?php else: ?>
                            <p class="redText"><?php echo pll__('Registration for this course is closed.'); ?></p>
                        <?php endif; ?>
                    </div>

                    <article class="single-post">
                        <div class="article-text">
                            <?php the_content(); ?>
                            
<div class="zoomNumber">
<div class="zoomNumberNotif">Please ensure that your username in Zoom starts with your zoom number below, so that you can be identified and marked as present.</div>
<div class="yourZoomNumberLine">Your Zoom Number : <span class="yourZoomNumber"><?php echo $zoomNumber; ?></span></div>
</div>


                            <a style="display:<?php echo ($alreadyRegistered) ? 'block' : 'none' ; ?>;" class="teaching_unregister teaching_reg_action" href="<?php echo $unregLink; ?>">
                                <span><?php echo pll__('Unregister from this course'); ?></span>
                            </a>
                            <?php if(!$alreadyRegistered && $registrationOpen): ?>
                                <div class="course_registration um-form um">
                                    <form>
                                        <h3>Course Registration</h3>        
                                        <div id="attend_all_sessions" class="um-field um-field-checkbox um-field-type_checkbox">
                                            <div class="um-field-area">
                                                <label class="um-field-checkbox">
                                                    <input type="checkbox" name="attent_all_sessions[]" value="I confirm that I can attend all sessions for this course.">
                                                    <span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-outline-blank"></i></span>
                                                    <span class="um-field-checkbox-option">I confirm that I can attend all sessions for this course, unless in case of emergency or the like.</span>
                                                </label>
                                                <div class="um-clear"></div>
                                            </div>
                                        </div>

                                        <div id="is_group_viewing_host" class="um-field um-field-checkbox um-field-type_checkbox">
                                            <div class="um-field-area">
                                                <label class="um-field-checkbox">
                                                    <input type="checkbox" name="attent_all_sessions[]" value="I will host a group viewing. (Only your account will be used to join the Zoom meeting)">
                                                    <span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-outline-blank"></i></span>
                                                    <span class="um-field-checkbox-option">I will host a group viewing, meaning that other Tirthika Square members will view the teaching with me.</span>
                                                </label>
                                                <div class="um-clear"></div>
                                            </div>
                                        </div>
                                            
                                        <a class="teaching_register teaching_reg_action" href="<?php echo $regLink; ?>">
                                        <span><?php echo pll__('Register to this course'); ?></span>
                                        </a>
                                    </form>
                                </div>
                                
                            <?php endif; ?>

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
        </div> <!--  END container  -->
    </div> <!--  END section-blog  -->
<?php endwhile; ?>
<?php get_footer(); ?>

<script type="text/javascript">

    function teachingRegUnregAction(action) {

        jQuery(".modal_buttons").show();

        if(action == 'register') {
            var modalText = '<?php echo pll__('I confirm I want to register for this course.'); ?>';

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
            url : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
            data : { action: "online_teaching_register", post_id : post_id, register : regaction, nonce: nonce },
            // error: function (response) {alert(response.message);return;},
            success: function(response) {
            // if(response.type == "success") {
                alert(response.message);
                alert(response.type);
                alert(response.registered);
                
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
            // }
        }
        });

return;


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