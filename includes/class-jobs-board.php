<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       def.com
 * @since      1.0.0
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Jobs_Board
 * @subpackage Jobs_Board/includes
 * @author     Talha <talha@wpminds.com>
 */
class Jobs_Board {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Jobs_Board_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'JOBS_BOARD_VERSION' ) ) {
			$this->version = JOBS_BOARD_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'jobs-board';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Jobs_Board_Loader. Orchestrates the hooks of the plugin.
	 * - Jobs_Board_i18n. Defines internationalization functionality.
	 * - Jobs_Board_Admin. Defines all hooks for the admin area.
	 * - Jobs_Board_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jobs-board-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jobs-board-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jobs-board-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-jobs-board-public.php';

		$this->loader = new Jobs_Board_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Jobs_Board_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Jobs_Board_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Jobs_Board_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//adding custom post type for jobs board the call back function is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'init', $plugin_admin, 'create_jobsboard_cpt' );
		
		//adding meta box the call back funtcion for jobsboard is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'location_metabox' );

		//adding a taxonomy the call back function is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'init', $plugin_admin, 'job_boards_taxonomy' );

		//saving the post data the call back function is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'save_post', $plugin_admin, 'pdetails_save' );

		//adding custom post type for application the call back function is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'init', $plugin_admin, 'application_custom_post_type' );

		//adding meta box the call back funtcion for application is on the admin/class-jobs-board-admin.php
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'application_metabox' );

		//adding a custom taxonomy for application
		$this->loader->add_action( 'init', $plugin_admin, 'application_taxonomy' );
		
		//column for the application
		$this->loader->add_filter( 'manage_application_posts_columns', $plugin_admin, 'application_post_type_columns' );
        $this->loader->add_filter( 'manage_application_posts_custom_column', $plugin_admin, 'application_fill_post_type_columns', 10, 2);
		//send mail on status changed
        $this->loader->add_filter( 'wp_insert_post_data', $plugin_admin, 'send_mail_when_status_changed', 10, 3);
		//register menu settings page
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'jobs_board_settings_menu' );
		//ajax function for application export
		$this->loader->add_action( 'wp_ajax_func_export_all_posts', $plugin_admin,'func_export_all_posts' );
		//ajax for jobs_board export
		$this->loader->add_action( 'wp_ajax_jobs_board_csv', $plugin_admin,'jobs_board_csv' );
		//ajax for importing the jobs board posts
		$this->loader->add_action( 'wp_ajax_jobs_board_import_csv', $plugin_admin,'jobs_board_import_csv' );
		


	}	
	

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Jobs_Board_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//short code for the jobs board main page the call back function is on the pulic/class-jobs-board-public.php
		$this->loader->add_shortcode( 'jobs-board', $plugin_public, 'jobs_board_call_back_function' );
		
		//adding the template for single job type
		$this->loader->add_filter("single_template", $plugin_public, "single_job_template");

		//ajax action for application form
		$this->loader->add_action("wp_ajax_create_applicant", $plugin_public, "create_applicant");


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Jobs_Board_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
