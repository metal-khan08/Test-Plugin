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


	 // creating Jobs board custom Post type
	function create_jobsboard_cpt() {
		$labels = array(
			'name' =>'Jobs Board',
			  'add_new_item' =>'New Job',
			  'edit_item' =>'Edit Job',
			  'all_items'=> 'All Jobs',
			  'Singular_name'=> 'Job'
		);
		$args = array(
			'label' => __( 'jobs_board', 'textdomain' ),
			'description' => __( 'A detail of the jobs available', 'textdomain' ),
			'labels' => $labels,
			'menu_icon' => 'dashicons-groups',
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

	//adding metaboxes for jobs board metabox
	function location_metabox(){
		add_meta_box(
			'pdetails',
			'Job Details',
			 array($this,'location_meta_input_box'),
			'jobs',
			'side',
			'low'
		);
	}

	//call back funtion for the metabox
	function location_meta_input_box($post){ 
		$jobpostId= $post->ID;
			?>
		
			<!-- this the fields of meta box -->
			<ul>
				<h3>Location</h3>
				<input type="text" name="meta_job_location" id="meta_job_location" value="<?php echo get_post_meta($jobpostId, 'meta_job_location', true ); ?>"/>
				<h3>Salary</h3>
				<input type="range" min="10000" max="100000" name="meta_number" id="meta_number" value="<?php echo get_post_meta($jobpostId, 'meta_number', true ); ?>"/>
				<h3>Timings</h3>
				<input type="text" name="meta_timings" id="meta_timings" value="<?php echo $timval=get_post_meta($jobpostId, 'meta_timings', true ); ?>"/>
				<h3>Benefits</h3>
				<input type="text" name="custom_benefits" id="custom_benefits" value="<?php echo get_post_meta($jobpostId, 'custom_benefits', true ); ?>"/>
			</ul>
			<?php
	}
	function pdetails_save($post_id){
		//saving the meta data into individual variables 
		$jobLocation=isset($_POST["meta_job_location"]) ? $_POST["meta_job_location"] : 'Enter Location';
		$jobSalary= isset($_POST["meta_number"]) ? $_POST["meta_number"] : 'Enter Salary';
		$jobTimings=isset($_POST["meta_timings"]) ? $_POST["meta_timings"] : 'Enter Timings';
		$jobBenefits=isset($_POST["custom_benefits"]) ? $_POST["custom_benefits"] : 'No benefits';
		//updating the data into the database using the above captured values
		update_post_meta($post_id, "meta_job_location",$jobLocation  );
		update_post_meta($post_id, "meta_number",$jobSalary );
		update_post_meta($post_id, "meta_timings", $jobTimings );
		update_post_meta($post_id, "custom_benefits",  $jobBenefits);
		}

	// adding custom taxonomy
	function job_boards_taxonomy(){
		$labels = array(
			'name' =>  'Job Category',
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

	// custo post type for application
	function application_custom_post_type(){
		$applabels = array(
			'name' =>'Application',
			  'add_new_item' =>'New Application',
			  'edit_item' =>'Edit Application',
			  'all_items'=> 'All Applications',
			  'Singular_name'=> 'Application'
		);
		$appargs = array(
			'label' => __( 'Application', 'textdomain' ),
			'labels' => $applabels,
			'menu_icon' => 'dashicons-portfolio',
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
		register_post_type( 'application', $appargs );
	}

	//adding metaboxes for application metabox
	function application_metabox(){
		add_meta_box(
			'appdetails',
			'Application Details',
			 array($this,'application_meta_input_box'),
			'application',
			'normal',
			'default'
		);
	}

	//call back funtion for the application metabox
	function application_meta_input_box($post){ 
			//fetch the value from the database and saved in to variables
			$postId =$post->ID;
			$fnameval=get_post_meta($postId, 'fname', true );
			$snameval=get_post_meta( $postId, 'sname', true );
			$bdateval=get_post_meta( $postId, 'birthdate', true );
			$emailval=get_post_meta( $postId, 'email', true );
			$pnumberval=get_post_meta( $postId, 'pnumber', true );
			$caddresslval=get_post_meta( $postId, 'caddress' , true);
			$jobname=get_post_meta( $postId, 'jobname', true );
			$personResume=get_post_meta( $postId, 'resume', true);
			?>
			<!-- this the fields of meta box -->
			<ul>
				<label for="name">Full Name</label><br>
				<input type="text" name="fname" id="name" value="<?php echo $fnameval; ?>" placeholder="First name" /><input type="text" name="sname" id="name" value="<?php echo $snameval; ?>" placeholder="second name"/><br>
				<label for="birthdate">Birth date</label><br>
				<input type="date" id="birthdate" name="birthdate" value=""/><br>
				<label for="email">Email Address</label><br>
				<input type="text" name="email" id="email" value="<?php echo $emailval; ?>"/><br>
				<label for="pnumber">Phone Number</label><br>
				<input type="text" name="pnumber" id="pnumber" value="<?php echo $pnumberval; ?>"/><br>
				<label for="caddress">Complete Address</label><br>
				<input type="text" name="caddress" id="caddress" value="<?php echo $caddresslval; ?>"/><br>
				the name of the job applied is <?php echo $jobname; ?>
			</ul>
			<?php
		  $resumeUrl= $personResume['url']; ?>
		  click to download resume <button><a download="<?php echo $fnameval; ?> resume" href="<?php echo $resumeUrl; ?>">Download Resume</a></button>
	<?php }

}
