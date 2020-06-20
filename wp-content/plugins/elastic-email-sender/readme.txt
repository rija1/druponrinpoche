=== Elastic Email Sender ===
Contributors: elasticemail, rafkwa
Donate link: https://elasticemail.com/
Tags:  elastic email, email marketing, transactional email, email sender, email, mailer, send email
Requires at least: 4.1
Tested up to: 5.4
Stable tag: 4.1.2
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin reconfigures the `wp_mail()` function to send email using API (via Elastic Email) instead of SMTP and creates a Settings page that allows you to set up various options.


== Description ==

Elastic Email Sender allows you to connect your WordPress with powerful, low-cost Elastic Email API and send unlimited emails per month!
Please follow the information below and find out more about how we can help you send your emails in a more efficient way.
In case of any questions or concerns, feel free to contact us anytime.


**What is Elastic Email Sender plugin?**

Elastic Email Sender is an easy way to maintain all the aspects related to your email campaigns. From creating and sending your emails to monitoring and managing campaigns stats.
Elastic Email Sender replaces WordPress default wp_mail() function by using API integration with Elastic Email to send an outgoing email from your WordPress installation.
Thanks to this, you can track all the parameters of your delivery, use Private IP addresses to get full control over your sending IP address, maintain reputation and delivery, and secure your data better than ever. You can also use your own domain and analyze your data with ease.

Elastic Email Sender is compatible with almost every solution available on the market including [WooCommerce](https://wordpress.org/plugins/woocommerce/), [Contact Form 7](https://wordpress.org/plugins/contact-form-7/), [Ninja Forms](https://wordpress.org/plugins/ninja-forms/), [Flamingo](https://wordpress.org/plugins/flamingo/), [Caldera Forms](https://wordpress.org/plugins/caldera-forms/), [bbPress](https://wordpress.org/plugins/bbpress/)


**How to get started?**
Just sign up to your [Elastic Email account](https://elasticemail.com/account#/settings/apikey), copy the API Key and then, please log in to your WordPress dashboard, add the [Elastic Email Sender](https://wordpress.org/plugins/elastic-email-sender/) plugin and paste there the API Key from your Elastic Email account.


== Installation ==

To connect WordPress to Elastic Email:
1. Log in to your WordPress dashboard and click Plugins in the left sidebar.
2. Click Add New at the top of the page and then, search for “Elastic Email Sender” and click “Install Now”.
3. Click Activate Plugin.
4. Enter your [Elastic Email API key](https://elasticemail.com/account#/settings/apikey) in the plugin settings with permision `Plugin`, and click Save Changes.
5. If you do it successfully, you can start sending emails!

**Installation in Network**
To connect WordPress to Elastic Email:
1. Log in to your WordPress dashboard (Network Admin) and click Plugins in the left sidebar or dropdown menu.
2. Click Add New at the top of the page and then, search for “Elastic Email Sender” and click “Install Now”.
3. Click Network Activate.
4. Enter your [Elastic Email API key](https://elasticemail.com/account#/settings/apikey) in the plugin settings with permision `Plugin`, and click Save Changes.
5. If you do it successfully, you can start sending emails!

== Frequently Asked Questions ==

= Where can I find more details? =
Please take a look at the [Elastic Email resources](https://help.elasticemail.com/en/) first.
If you can’t find the answer, please contact our [Support Team](https://elasticemail.com/contact).

= How to get started with Elastic Email? =
Start with Elastic Email by creating a new account on our [website](https://elasticemail.com/).

= What kind of emails I can send with Elastic Email Sender plugin? =
With the new update (1.1.2), Elastic Email Sender has an option to switch between transactional and marketing emails. It means that from now on, you can easily decide what kind of emails you would like to send. By default, you will be sending marketing emails that should be used for all kind of marketing announcements: newsletters, marketing updates, sales offers, etc.
But if you would like to send more technical emails like notifications about your service or app status, password reset or notifications about orders, you can use transactional emails that should be used for all kind of transactions between users and service/app owner.
Please note that users who unsubscribe from marketing emails can still receive transactional emails. In case of any questions please contact our [Customer Success team](https://elasticemail.com/help/) - they are available 24/7!

= How to setup a domain to start sending? =
Find out [how to verify your domain](https://help.elasticemail.com/en/articles/2281323-how-to-verify-your-domain) on our Resources page.

= Where do I find Elastic Email API Key? =
You can find the Elastic Email API Key in Settings/API [account](https://elasticemail.com/account#/settings/apikey).

= Where can I find private IP address settings? =
All the details about the private IPs are available in Settings/Private IPs [account](https://elasticemail.com/account#/settings/privateips).

= I can’t send any attachments. =
Make sure you [allowed for the use of custom headers](https://elasticemail.com/account/#/settings/sending) by checking "Allow Custom Headers" option in Settings/Sending.

= Are my mail available also as a plain text? =
Please make sure that you have the “Auto Create Text Body” turned on in your [Sending Settings](https://elasticemail.com/account/#/settings/sending). If yes, your emails are also available as a plain text.

= Where do I find delivery status and statistics? =
All the data about your delivery statuses and campaigns stats are available in Reports [account](https://elasticemail.com/account#/activity).

= Where can I find out what was sent? =
You can see your reports and sending history in Reports/Email logs. Keep in mind that logs older than 30 days are not stored. [account](https://elasticemail.com/account#/activity/channels).

[Support Forum](https://wordpress.org/support/plugin/elastic-email-sender)


== Screenshots ==
1. Install Elastic Email Sender with ease! Just fill in a few details and let us help you send better emails.
2. A visual representation of your campaign's results. If you would like to know more about your campaigns statistic, please go to the Reports screen on Elastic Email dashboards.
3. Test the sending configuration easily.
4. If you are looking for the Elastic Email API Key which will be needed during the Elastic Email Sender plugin installation, please go to your Elastic Email account settings.

== Translations ==
You can translate Elastic Email Sender on [__translate.wordpress.org__](https://translate.wordpress.org/projects/wp-plugins/elastic-email-sender).


== Changelog ==

= 1.1.28 =
* Fix: Test url

= 1.1.27 =
* Regular update

= 1.1.26 =
* Regular update

= 1.1.25 =
* Small code refactoring

= 1.1.24 =
* Fix: Network and regular update

= 1.1.23 =
* Regular update

= 1.1.22 =
* Bugfix: Send test

= 1.1.21 =
* Regular update

= 1.1.20 =
* Bugfix: Contact status enum

= 1.1.19 =
* Bugfix: Admin

= 1.1.18 =
* Bugfix: Tests

= 1.1.17 =
* Added: Screen with test send

= 1.1.16 =
* Fix to visual update

= 1.1.15 =
* Visual update

= 1.1.14 =
* Regular update

= 1.1.13 =
* Regular update

= 1.1.12 =
* Regular update

= 1.1.11 =
* Added: Custom email from and from name
* Regular update

= 1.1.10 =
* Fixed: Option to hide the settings screen in the Network

= 1.1.9 =
* Fixed: Reset password

= 1.1.8 =
* Regular update

= 1.1.7 =
* Admin improvements

= 1.1.6 =
* Admin bugfix and improvements

= 1.1.5 =
* Admin update

= 1.1.4 =
* Bugfix: Conflict with WooCommerce

= 1.1.3 =
* Bugfix: Conflict with other plugins

= 1.1.2 =
* Sending of transactional and marketing e-mails
* Auto queue
* Marketing changes
* Improvements in credit and email status
* Mobile friendly

= 1.1.1 =
* Bugfix: content type

= 1.1.0 =
* Added: A queue of unsent messages
* Added: New account status
* Added: Improvements for support
* Fixed: Cc and bcc
* Fixed: Message formatting in text/plain
* Fixed: Password reset link
* Fixed: Integration with Elastic Email Subscribe Form

= 1.0.13 =
* Bugfix

= 1.0.12 =
* Added: credit status, tooltips, improved stability

= 1.0.11 =
* Buxfix - integration with Elastic Email Subscribe Form

= 1.0.10 =
* Integration with Elastic Email Subscribe Form

= 1.0.9 =
* Visual changes and adding compatibility with the Elastic Email Subscribe Form

= 1.0.8 =
* Bugfix - WP_Bakery conflict
* Bugfix - WooCommerce: undefined variables

= 1.0.7 =
* Internationalization

= 1.0.6 =
* Isolating styles in admin
* Checking account limit

= 1.0.5 =
* Bugfix - overwriting styles

= 1.0.4 =
* Bugfix - wp_error friendly message

= 1.0.3 =
* Bugfix - returning false

= 1.0.2 =
* Added reports panel
* Added checking the status and limit of the account
* Performance improvement
* Bugfix

= 1.0.1 =
* Bugfix in sending html and text messages

= 1.0 =
* Public release