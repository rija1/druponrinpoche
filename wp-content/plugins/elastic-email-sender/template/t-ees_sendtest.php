<?php
defined('EE_ADMIN') or die('No direct access allowed.');

wp_enqueue_style('eesender-bootstrap-grid');
wp_enqueue_style('eesender-css');
wp_enqueue_script('eesender-jquery');
wp_enqueue_script('eesender-send-test');

if (isset($_GET['settings-updated'])):
    ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.', 'elastic-email-sender') ?></strong></p>
    </div>
<?php endif; ?>
<div id="eewp_plugin" class="row eewp_container" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-12 col-md-12 col-lg-7">
        <?php
        if (get_option('ee_options')["ee_enable"] === 'yes') {

            if (get_option('ees-connecting-status') === 'disconnected') {
                include 't-ees_connecterror.php';
            } else { ?>
            <div class="ee_header">
                <div class="ee_pagetitle">
                    <h1><?php _e('Send test', 'elastic-email-sender') ?></h1>
                </div>
            </div>

            <div class="ee_send-test-container">

                <p class="ee_p test-description"><?php _e('Sending this testing email will provide You with the necessary information about the ability to send emails from your account as well as email and contact status. The email provided by You will be added to your All Contacts list, then the testing message will be send to this contact. Be aware that if you are charged by number of email sent, sending this testing messages will have impact on your credits.', 'elstic-email-sender') ?></p>

                <div class="form-box">
                    <div class="form-group">
                        <label><?php _e('Email to', 'elastic-email-sender') ?></label>
                        <input type="email" name="to" id="to" placeholder="<?php _e('Email to', 'elastic-email-sender') ?>">
                        <span class="valid hide" id="invalid_email"></span>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Test message', 'elastic-email-sender') ?></label>
                        <textarea name="message" id="message" rows="5" cols="40" placeholder="<?php _e('Test message', 'elastic-email-sender') ?>e"></textarea>
                        <span class="valid hide" id="invalid_message"></span>
                    </div>
                    <div class="form-group">
                        <input class="ee_button-test" id="sendTest" type="submit" value="<?php _e('Send test', 'elastic-email-sender') ?>">
                    </div>
                </div>

                <div id="send-status" class="hide">
                    <p><span class="status-more-info-bold"><?php _e('Sending status: ', 'elastic-email-sender') ?></span><span id="sendStatus"></span></p>
                    <div id="status-more-info" class="hide">
                        <p><span class="status-more-info-bold"><?php _e('Error: ', 'elastic-email-sender') ?></span><span id="contactFriendlyErrorMessage"></span></p>
                        <p><span class="status-more-info-bold"><?php _e('Contact status: ', 'elastic-email-sender') ?> </span><span id="contactStatus"></span></p>
                    </div>
                    <div id="loader" class="loader hide"></div>
                </div>

            </div>

        <?php }
        } else {
            include 't-ees_apidisabled.php';
        }?>
    </div>

    <?php
    include 't-ees_marketing.php';
    ?>

</div>