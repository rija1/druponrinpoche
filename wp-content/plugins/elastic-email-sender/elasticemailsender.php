<?php

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

update_option('elastic-email-sender-basename', plugin_basename(__FILE__));

function sender_deactivation_admin_notice__info()
{
    $class = 'notice notice-info';
    $message = __('The Plugin Elastic Email Sender has just been activated. We\'ve detected the use of our second product - Elastic Email Subscribe Form. The plugin that has been activated is only for shipping. You want to send via the Elastic Email API and collect your contacts through our Widgets, activate Subscribe Form. If you don\'t need widgets, it\'s okay, keep Sender active.', 'elastic-email-subscribe');

    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

if (is_plugin_active(get_option('elastic-email-subscribe-basename')) === true) {

    deactivate_plugins(get_option('elastic-email-subscribe-basename'));
    add_action('admin_notices', 'sender_deactivation_admin_notice__info');

} else {

    /*
     * Plugin Name: Elastic Email Sender
     * Version: 1.1.28
     * Plugin URI: https://wordpress.org/plugins/elastic-email-sender/
     * Description: This plugin reconfigures the <code>wp_mail()</code> function to send email using API (via Elastic Email) instead of SMTP and creates an options page that allows you to specify various options.
     * Author: Elastic Email Inc.
     * Author URI: https://elasticemail.com
     * Network: false
     * Text Domain: elastic-email-sender
     * Domain Path: /languages
     */

    /**
     * @author    Elastic Email Inc.
     * @copyright Elastic Email, 2020, All Rights Reserved
     * This code is released under the GPL licence version 3 or later, available here
     * https://www.gnu.org/licenses/gpl.txt
     */

    /* Version check */
    global $wp_version;
    $exit_msg = 'ElasticEmail Sender requires WordPress 4.1 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress"> Please update!</a>';

    global $sender_queue__db_version;
    $ee_db_version = '1.0';

    if (version_compare($wp_version, "4.1", "<")) {
        exit($exit_msg);
    }

    if (!class_exists('eemail')) {
        require_once('defaults/function.reset_pass.php');
        require_once('class/ees_mail.php');
        eemail::on_load(__DIR__);
    }
    update_option('ees_plugin_dir_name', plugin_basename(__DIR__));


    /* ----------- ADMIN ----------- */
    if (is_admin()) {

        register_activation_hook(__FILE__, 'elasticemailsender_activate');

        function elasticemailsender_activate()
        {
            update_option('daterangeselect', 'last-wk');
            register_deactivation_hook(__FILE__, 'elasticemailsender_deactivate');
            register_uninstall_hook(__FILE__, 'elasticemailsender_uninstall');
        }

        function elasticemailsender_deactivate()
        {
            $status = 'D';
            if (class_exists('ElasticEmailClient\\ApiClient')) {
                eeadmin::addToUserList($status);
            }
        }

        function elasticemailsender_uninstall()
        {
            $status = 'D';
            if (class_exists('ElasticEmailClient\\ApiClient')) {
                eeadmin::addToUserList($status);
            }

            $options = [
                'ees-connecting-status',
                'ee_publicaccountid',
                'ee_enablecontactfeatures',
                'ee_options',
                'ee_accountemail',
                'ee_accountemail_2',
                'ee_setapikey',
                'ee_send-email-type',
                'ees_plugin_dir_name',
                'ee_config_from_name',
                'ee_config_from_email',
                'ee_from_email',
                'daterangeselect',
                'elastic-email-sender-basename',
                'ee_config_override_wooCommerce',
                'ee_config_woocommerce_original_email',
                'ee_config_woocommerce_original_name'
            ];

            foreach ($options as $option) {
                delete_option($option);
            }

        }

        require_once 'class/ees_admin.php';
        $ee_admin = new eeadmin(__DIR__);
    }

    add_action('wp_ajax_sender_send_test', 'eeSenderTestMsg');

    function eeSenderTestMsg()
    {
        $key = filter_input(INPUT_GET, "hex", FILTER_SANITIZE_STRING);
        if ($key === '422f753b2d746e205b422e2068276f352143') {
            $to = $_POST['to'];
            $subject = 'Elastic Email Sender send test';
            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

            $send = eemail::send($to, $subject, $message, null, null);

            if ($send) {
                exit('Sent');
            } else {
                exit('Error');
            }

        }
    }

}