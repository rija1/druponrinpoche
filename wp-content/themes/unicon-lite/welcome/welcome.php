<?php
	if(!class_exists('Unicon_Lite_Welcome')) :

		class Unicon_Lite_Welcome {

			public $tab_sections = array();

			public $theme_name = ''; // For storing Theme Name
			public $theme_version = ''; // For Storing Theme Current Version Information
			public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins
			public $pro_plugins = array(); // For Storing the list of the Recommended Pro Plugins
			public $req_plugins = array(); // For Storing the list of the Required Plugins
			public $companion_plugins = array(); // For Storing the list of the Companion Plugins

			/**
			 * Constructor for the Welcome Screen
			 */
			public function __construct() {
				
				/** Useful Variables **/
				$theme = wp_get_theme();
				$this->theme_name = $theme->Name;
				$this->theme_version = $theme->Version;

				$this->companion_plugins = array(
					'siteorigin-panels' => array(
						'slug' => 'siteorigin-panels',
						'bundled' => false,
						'filename' => 'siteorigin-panels.php',
						'class' => 'SiteOrigin_Panels',
						'description' => __('Install Siteorigin Page Builder plugin to have the flexible layout features', 'unicon-lite')
					),
				);

				/** List of required Plugins **/
				$this->req_plugins = array(

					'instant-demo-importer' => array(
						'slug' => 'instant-demo-importer',
						'name' => __('Instant Demo Importer', 'unicon-lite'),
						'filename' =>'instant-demo-importer.php',
						'class' => 'Instant_Demo_Importer',
						'github_repo' => true,
						'bundled' => true,
						'location' => 'https://github.com/WPaccesskeys/instant-demo-importer/archive/master.zip',
						'info' => __('Instant Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'unicon-lite'),
					),

				);

				/** Define Tabs Sections **/
				$this->tab_sections = array(
					'getting_started' => __('Getting Started', 'unicon-lite'),
					'recommended_plugins' => __('Recommended Plugins', 'unicon-lite'),
					'support' => __('Support', 'unicon-lite'),
					'free_vs_pro' => __('Free vs Pro', 'unicon-lite'),
				);

				/** List of Recommended Free Plugins **/
				$this->free_plugins = array(

					'elementor' => array(
						'slug' => 'elementor',
						'filename' => 'elementor.php',
						//'class' => 'UFBL_Class'
					),

					'accesspress-social-icons' => array(
						'slug' => 'accesspress-social-icons',
						'filename' => 'accesspress-social-icons.php',
						'class' => 'APS_Class'
					),

					'accesspress-social-share' => array(
						'slug' => 'accesspress-social-share',
						'filename' => 'accesspress-social-share.php',
						'class' => 'APSS_Class'
					),

					'accesspress-twitter-feed' => array(
						'slug' => 'accesspress-twitter-feed',
						'filename' => 'accesspress-twitter-feed.php',
						'class' => 'APTF_Class'
					),

					'ultimate-form-builder-lite' => array(
						'slug' => 'ultimate-form-builder-lite',
						'filename' => 'ultimate-form-builder-lite.php',
						'class' => 'UFBL_Class'
					),
				);

				/** List of Recommended Pro Plugins **/
				$this->pro_plugins = array();

				/* Theme Activation Notice */
				add_action( 'load-themes.php', array( $this, 'unicon_lite_activation_admin_notice' ) );

				/* Create a Welcome Page */
				add_action( 'admin_menu', array( $this, 'unicon_lite_welcome_register_menu' ) );

				/* Enqueue Styles & Scripts for Welcome Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'unicon_lite_welcome_styles_and_scripts' ) );

				/** Plugin Installation Ajax **/
				add_action( 'wp_ajax_unicon_lite_plugin_installer', array( $this, 'unicon_lite_plugin_installer_callback' ) );

				/** Plugin Installation Ajax **/
				add_action( 'wp_ajax_unicon_lite_plugin_offline_installer', array( $this, 'unicon_lite_plugin_offline_installer_callback' ) );

				/** Plugin Activation Ajax **/
				add_action( 'wp_ajax_unicon_lite_plugin_activation', array( $this, 'unicon_lite_plugin_activation_callback' ) );

				/** Plugin Activation Ajax (Offline) **/
				add_action( 'wp_ajax_unicon_lite_plugin_offline_activation', array( $this, 'unicon_lite_plugin_offline_activation_callback' ) );

			}

			/** Welcome Message Notification on Theme Activation **/
			public function unicon_lite_activation_admin_notice() {
				global $pagenow;

				if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {
					?>
					<div class="notice notice-success is-dismissible">
						<p><?php printf( __( 'Welcome! Thank you for choosing %1$s! Please make sure you visit our <a href="%2$s">Welcome page</a> to get started with %1$s.', 'unicon-lite' ), $this->theme_name, admin_url( 'themes.php?page=unicon-lite-welcome' )  ); ?></p>
						<p><a class="button" href="<?php echo admin_url( 'themes.php?page=unicon-lite-welcome' ) ?>"><?php _e( 'Lets Get Started', 'unicon-lite' ); ?></a></p>
					</div>
					<?php
				}
			}

			/** Register Menu for Welcome Page **/
			public function unicon_lite_welcome_register_menu() {
				$action_count = get_option('unicon_lite_plugin_installed_notif');
				$title        = $action_count > 0 ? 'Welcome<span class="pending-tasks">'.$action_count.'</span>' : esc_html__( 'Welcome', 'unicon-lite' );
				add_theme_page( 'Welcome', $title , 'edit_theme_options', 'unicon-lite-welcome', array( $this, 'unicon_lite_welcome_screen' ));
			}

			/** Welcome Page **/
			public function unicon_lite_welcome_screen() {
				$tabs = $this->tab_sections;

				$current_section = isset($_GET['section']) ? $_GET['section'] : 'getting_started';
				$section_inline_style = '';
				?>
				<div class="wrap about-wrap access-wrap">
					<div class="abt-promo-wrap clearfix">
						<div class="abt-theme-wrap">
							<h1><?php printf( esc_html__( 'Welcome to %s - Version %s', 'unicon-lite' ), $this->theme_name, $this->theme_version ); ?></h1>
							<div class="about-text"><?php printf( esc_html__( 'The %s is a creative theme with elegant design perfect for business, corporate, photography, personal blog and other creative website. The theme has creative design with vibrant color and all the required sections to make a complete website. The theme is fully translation ready and built with customizer for easy setup with live preview. The Theme has creative team, testimonial, service, video and portfolio section.', 'unicon-lite' ), $this->theme_name ); ?></div>
						</div>

						<div class="promo-banner-wrap">
							<p><?php echo __('Upgrade for <del>$45</del> $32', 'unicon-lite'); ?></p>
							<a href="<?php echo esc_url('https://themeforest.net/item/unicon-pro-responsive-multipurpose-wordpress-theme/20417820?ref=AccessKeys'); ?>" target="_blank" class="button button-primary upgrade-btn"><?php echo __('Upgrade Now', 'unicon-lite'); ?></a>
							<a class="promo-offer-text" href="<?php echo esc_url('https://themeforest.net/item/unicon-pro-responsive-multipurpose-wordpress-theme/20417820?ref=AccessKeys'); ?>" target="_blank"><?php echo __('The Offer is limited for initial <span>100</span> purchases only', 'unicon-lite'); ?></a>
						</div>
					</div>

					<div class="nav-tab-wrapper clearfix">
						<?php foreach($tabs as $id => $label) : ?>
							<?php
								$section = isset($_REQUEST['section']) ? esc_attr($_REQUEST['section']) : 'getting_started';
								$nav_class = 'nav-tab';
								if($id == $section) {
									$nav_class .= ' nav-tab-active';
								}
							?>
							<a href="<?php echo admin_url('themes.php?page=unicon-lite-welcome&section='.$id); ?>" class="<?php echo esc_attr($nav_class); ?>" >
								<?php echo esc_html( $label ); ?>
								<?php if($id == 'actions_required') : $not = $this->get_required_plugin_notification(); ?>
									<?php if($not) : ?>
								   		<span class="pending-tasks">
							   				<?php echo esc_html($not); ?>
							   			</span>
					   				<?php endif; ?>
							   	<?php endif; ?>
						   	</a>
						<?php endforeach; ?>
				   	</div>

			   		<div class="welcome-section-wrapper">
		   				<?php $section = isset($_REQUEST['section']) ? $_REQUEST['section'] : 'getting_started'; ?>
	   					
	   					<div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
	   						<?php require_once get_template_directory() . '/welcome/sections/'.esc_html($section).'.php'; ?>
						</div>
				   	</div>
			   	</div>
				<?php
			}

			/** Enqueue Necessary Styles and Scripts for the Welcome Page **/
			public function unicon_lite_welcome_styles_and_scripts() {
				wp_enqueue_style( 'unicon-lite-welcome-screen', get_template_directory_uri() . '/welcome/css/welcome.css' );
				wp_enqueue_script( 'unicon-lite-welcome-screen', get_template_directory_uri() . '/welcome/js/welcome.js', array( 'jquery' ) );

				wp_localize_script( 'unicon-lite-welcome-screen', 'uniconliteWelcomeObject', array(
					'admin_nonce'	=> wp_create_nonce('unicon_lite_plugin_installer_nonce'),
					'activate_nonce'	=> wp_create_nonce('unicon_lite_plugin_activate_nonce'),
					'ajaxurl'		=> esc_url( admin_url( 'admin-ajax.php' ) ),
					'activate_btn' => __('Activate', 'unicon-lite'),
					'installed_btn' => __('Activated', 'unicon-lite'),
					'demo_installing' => __('Installing Demo', 'unicon-lite'),
					'demo_installed' => __('Demo Installed', 'unicon-lite'),
					'demo_confirm' => __('Are you sure to import demo content ?', 'unicon-lite'),
				) );
			}

			/** Plugin API **/
			public function unicon_lite_call_plugin_api( $plugin ) {
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$call_api = plugins_api( 'plugin_information', array(
					'slug'   => $plugin,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true
					)
				) );

				return $call_api;
			}

			/** Check For Icon **/
			public function unicon_lite_check_for_icon( $arr ) {
				if ( ! empty( $arr['svg'] ) ) {
					$plugin_icon_url = $arr['svg'];
				} elseif ( ! empty( $arr['2x'] ) ) {
					$plugin_icon_url = $arr['2x'];
				} elseif ( ! empty( $arr['1x'] ) ) {
					$plugin_icon_url = $arr['1x'];
				} else {
					$plugin_icon_url = $arr['default'];
				}

				return $plugin_icon_url;
			}

			/** Check if Plugin is active or not **/
			public function unicon_lite_plugin_active($plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];
				$status = 'install';

				$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);

				if(file_exists( $path )) {
					if(isset($plugin['class'])) {
						$status = class_exists($plugin['class']) ? 'inactive' : 'active';
					}
					$status = 'inactive';
				}

				return $status;
			}

			/** Generate Url for the Plugin Button **/
			public function unicon_lite_plugin_generate_url($status, $plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				switch ( $status ) {
					case 'install':
						return wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'install-plugin',
									'plugin' => esc_attr($folder_name)
								),
								network_admin_url( 'update.php' )
							),
							'install-plugin_' . esc_attr($folder_name)
						);
						break;

					case 'inactive':
						return add_query_arg( array(
							                      'action'        => 'deactivate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;

					case 'active':
						return add_query_arg( array(
							                      'action'        => 'activate',
							                      'plugin'        => rawurlencode( esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
							                      'plugin_status' => 'all',
							                      'paged'         => '1',
							                      '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . esc_attr($folder_name) . '/' . esc_attr($file_name) . '.php' ),
						                      ), network_admin_url( 'plugins.php' ) );
						break;
				}
			}

			/* ========== Plugin Installation Ajax =========== */
			public function unicon_lite_plugin_installer_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( __( 'Sorry, you are not allowed to install plugins on this site.', 'unicon-lite' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];
				$plugin_file = $_POST["plugin_file"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'unicon_lite_plugin_installer_nonce' ))
					wp_die( __( 'Error - unable to verify nonce, please try again.', 'unicon-lite') );


         		// Include required libs for installation
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

				// Get Plugin Info
				$api = $this->unicon_lite_call_plugin_api($plugin);

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$upgrader->install($api->download_link);

				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if($api->name) {
					$main_plugin_file = $this->get_plugin_file($plugin);
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						echo "success";
						die();
					}
				}
				echo "fail";

				die();
			}

			/** Plugin Offline Installation Ajax **/
			public function unicon_lite_plugin_offline_installer_callback() {

				
				$file_location = $_POST['file_location'];
				$file = $_POST['file'];
				$github = $_POST['github'];
				$slug = $_POST['slug'];
				$plugin_directory = ABSPATH . 'wp-content/plugins/';

				$zip = new ZipArchive;
				if ($zip->open(esc_html($file_location)) === TRUE) {

				    $zip->extractTo($plugin_directory);
				    $zip->close();

				    if($github) {
				    	rename(realpath($plugin_directory).'/'.$slug.'-master', realpath($plugin_directory).'/'.$slug);
				    }
				    
				    activate_plugin($file);
					echo "success";
					die();
				} else {
				    echo 'failed';
				}

				die();
			}

			/** Plugin Offline Activation Ajax **/
			public function unicon_lite_plugin_offline_activation_callback() {

				$plugin = $_POST['plugin'];
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin).'.php';

				if(file_exists($plugin_file)) {
					activate_plugin($plugin_file);
				} else {
					echo "Plugin Doesn't Exists";
				}

				die();
				
			}

			/** Plugin Activation Ajax **/
			public function unicon_lite_plugin_activation_callback(){

				if ( ! current_user_can('install_plugins') )
					wp_die( __( 'Sorry, you are not allowed to activate plugins on this site.', 'unicon-lite' ) );

				$nonce = $_POST["nonce"];
				$plugin = $_POST["plugin"];

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'unicon_lite_plugin_activate_nonce' ))
					die( __( 'Error - unable to verify nonce, please try again.', 'unicon-lite' ) );


	         	// Include required libs for activation
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';


				// Get Plugin Info
				$api = $this->unicon_lite_call_plugin_api(esc_attr($plugin));


				if($api->name){
					$main_plugin_file = $this->get_plugin_file(esc_attr($plugin));
					$status = 'success';
					if($main_plugin_file){
						activate_plugin($main_plugin_file);
						$msg = $api->name .' successfully activated.';
					}
				} else {
					$status = 'failed';
					$msg = esc_html__('There was an error activating $api->name', 'unicon-lite');
				}

				$json = array(
					'status' => $status,
					'msg' => $msg,
				);

				wp_send_json($json);

			}

			public function all_required_plugins_installed() {

		      	$companion_plugins = $this->companion_plugins;
				$show_success_notice = false;

				foreach($companion_plugins as $plugin) {

					$path = WP_PLUGIN_DIR.'/'.esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']);

					if(file_exists($path)) {
						if(class_exists($plugin['class'])) {
							$show_success_notice = true;
						} else {
							$show_success_notice = false;
							break;
						}
					} else {
						$show_success_notice = false;
						break;
					}
				}

				return $show_success_notice;
	      	}

			public static function get_plugin_file( $plugin_slug ) {
		         require_once ABSPATH . '/wp-admin/includes/plugin.php'; // Load plugin lib
		         $plugins = get_plugins();

		         foreach( $plugins as $plugin_file => $plugin_info ) {

			         // Get the basename of the plugin e.g. [askismet]/askismet.php
			         $slug = dirname( plugin_basename( $plugin_file ) );

			         if($slug){
			            if ( $slug == $plugin_slug ) {
			               return $plugin_file; // If $slug = $plugin_name
			            }
		            }
		         }
		         return null;
	      	}

	      	public function get_local_dir_path($plugin) {

	      		$url = wp_nonce_url(admin_url('themes.php?page=unicon-lite-welcome&section=import_demo'),'unicon-lite-file-installation');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
					return; // stop processing here
				}

	      		if ( ! WP_Filesystem($creds) ) {
					request_filesystem_credentials($url, '', true, false, null);
					return;
				}

				global $wp_filesystem;
				$file = $wp_filesystem->get_contents( $plugin['location'] );

				$file_location = get_template_directory().'/welcome/plugins/'.$plugin['slug'].'.zip';

				$wp_filesystem->put_contents( $file_location, $file, FS_CHMOD_FILE );

				return $file_location;
	      	}

		}

		new Unicon_Lite_Welcome();

	endif;

	/** Initializing Demo Importer if exists **/
	if(class_exists('Instant_Demo_Importer')) :
		$demoimporter = new Instant_Demo_Importer();		
	endif;
?>