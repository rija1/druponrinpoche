<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

    <div class="dc_logreg_welcome">Welcome to&nbsp;&nbsp;&nbsp;<span>Tirthika Square</span></div>
    <div class="dc_logreg_txt"><p>Tirthika Square is the place where you can access Drupon Khen Rinpoche’s online teachings. Once you have made an account, you can register for any scheduled course you would like to join when logged in.</p></div>

	<div class="um-form">

		<form method="post" action="" autocomplete="off">

			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_form
			 * @description Some actions before login form
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_form', 'my_before_form', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_before_form', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_{$mode}_fields
			 * @description Some actions before login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_before_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_main_{$mode}_fields
			 * @description Some actions before login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_main_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form_fields
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form_fields', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_{$mode}_fields
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_{$mode}_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_after_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form', 'my_after_form', 10, 1 );
			 * function my_after_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form', $args ); ?>

		</form>

	</div>

</div>