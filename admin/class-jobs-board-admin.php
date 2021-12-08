<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       def.com
 * @since      1.0.0
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/admin
 * @author     Talha <talha@wpminds.com>
 */
class Jobs_Board_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jobs_Board_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jobs_Board_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jobs-board-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jobs_Board_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jobs_Board_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jobs-board-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * add custo post type.
	 *
	 * @since    1.0.0
	 */

	function create_jobsboard_cpt() {

		$labels = array(
			'name' =>'jobs_board',
			  'add_new_item' =>'New Job',
			  'edit_item' =>'Edit Job',
			  'all_items'=> 'All Jobs',
			  'Singular_name'=> 'Job'
		);
		$args = array(
			'label' => __( 'Jobs Board', 'textdomain' ),
			'description' => __( 'A detail of the jobs available', 'textdomain' ),
			'labels' => $labels,
			'menu_icon' => 'dashicons-businessman',
			'supports' => array('title'),
			'taxonomies' => array(),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'show_in_rest' => true,
			'capability_type' => 'post',
		);
		register_post_type( 'jobs', $args );
	}

	//adding metaboxes metabox

	function location_metabox(){
		add_meta_box(
			'location_meta_box_id',
			'Location',
			 array($this,'location_meta_input_box'),
			'jobs',
			'side',
			'low'
		);

		add_meta_box(
			'salary_meta_box_id',
			'Salary',
			 array($this,'salary_meta_input_box'),
			'jobs',
			'side',
			'low'
		);


		add_meta_box(
			'timings_meta_box_id',
			'Timings',
			 array($this,'timings_meta_input_box'),
			'jobs',
			'side',
			'low'
		);

		add_meta_box(
			'benefits_meta_box_id',
			'Benefits',
			 array($this,'benefits_meta_input_box'),
			'jobs',
			'side',
			'low'
		);
	}

	//pionting towards the metabox funtion

	function location_meta_input_box(){ 
		require_once 'partials/jobs-board-admin-display.php';
	}
	function salary_meta_input_box(){ 
		require_once 'partials/jobs-board-admin-display-salary.php';
	}
	function timings_meta_input_box(){ 
		require_once 'partials/jobs-board-admin-display-timings.php';
	}
	function benefits_meta_input_box(){ 
		require_once 'partials/jobs-board-admin-display-benefits.php';
	}

	// adding custom taxonomy

	function job_boards_taxonomy(){
		$labels = array(
			'name' =>  'Job Category',
			'singular_name' =>  'job',
			'search_items' =>  __( 'Search jobs' ),
			'popular_items' => __( 'Popular jobs' ),
			'all_items' => __( 'All jobs' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit job' ), 
			'update_item' => __( 'Update job' ),
			'add_new_item' => __( 'Add New job' ),
			'new_item_name' => __( 'New job Name' ),
			'separate_items_with_commas' => __( 'Separate jobs with commas' ),
			'add_or_remove_items' => __( 'Add or remove jobs' ),
			'choose_from_most_used' => __( 'Choose from the most used jobs' ),
			'menu_name' => __( 'Jobs' ),
		  ); 
		 
		// Now register the non-hierarchical taxonomy like tag
		 
		  register_taxonomy('jobs','jobs',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'topic' ),
		  ));

	}


}
