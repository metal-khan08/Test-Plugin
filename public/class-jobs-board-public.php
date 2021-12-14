<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       def.com
 * @since      1.0.0
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Jobs_Board
 * @subpackage Jobs_Board/public
 * @author     Talha <talha@wpminds.com>
 */
class Jobs_Board_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jobs-board-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jobs-board-public.js', array( 'jquery' ), $this->version, false );

	}

	// call back function to display jobs board
	function public_hello_world(){

		//this is to show the form to filter the jobs on the above

		//creating custom query
		$args = array(
			'post_type'      => 'jobs',
			'posts_per_page' => '-1',
			'publish_status' => 'published',
		 );
		 $query = new WP_Query($args); ?>

		 <h1>Jobs Board</h1>

		 <div class="contact-form">
		 <form method="GET" action="<?php site_url() ?>/results">
			 <select id="city" name="city">
			<option value="city" >Select City</option>
				 <?php
		$cityarray=array();
		while($query->have_posts()) {
		$query->the_post();
		$jobid=get_the_ID();
		$jcity= get_post_meta( $jobid, 'meta_location', true);
		if(in_array($jcity,$cityarray) == false){
		?>
				<option value="<?php echo $jcity; ?>"><?php echo $jcity; ?></option>
			<?php 
			array_push($cityarray,$jcity);
			}
		} ?>
			</select>

		<!-- select job type category -->
			 <select id="jtype" name="jtype">
			 <option value="category">Select Category</option>
				 <?php
		while($query->have_posts()) {
		$query->the_post() ;
		$jobid=get_the_ID();
				 $jobtax = wp_get_post_terms( $jobid, 'jobs');
				 foreach($jobtax as $jobtax) {
					$url = get_term_link($jobtax->slug, 'jobs');
					echo 	'<option value="'.$jobtax->name .'">'. $jobtax->name .'</option>';					
				 }			
				  } ?>
					</select>
					<h4>Select Salary Range</h4>
					<input type="range" />
					<input type="submit" value="GO!">
		</form>
		</div>

		<!-- following are the 3 jobs box -->

				 <div class="space-div"></div>

		<h2>Available Jobs</h2	>
 <?php
		wp_reset_postdata();

		//this is to show three jobs at the bottom
		$args = array(
			'post_type'      => 'jobs',
			'posts_per_page' => '3',
			'publish_status' => 'published',
		 );
		
		 $query = new WP_Query($args);
		while($query->have_posts()) {
		$query->the_post() ;
		$jobid=get_the_ID(); ?>
			<ul>
				<li><?php the_title() ?></li>
			</ul>
 <?php	 }	
		wp_reset_postdata()	;

	}
	 

	//call back for the results page filter
	function jobs_results(){

		$jobcity=$_GET["city"];
		$typeOfJob=$_GET["jtype"];

		//meta query for the job results page
		$args = array(
			'post_type'      => 'jobs',
			'posts_per_page' => '-1',
			'publish_status' => 'published',
			 );
				
		 $query = new WP_Query($args);
		while($query->have_posts()) {
		$query->the_post() ;
		$jobid=get_the_ID(); 
		$jcity= get_post_meta( $jobid, 'meta_location', true);
		$jobtax = wp_get_post_terms( $jobid, 'jobs');
				if($jobcity == $jcity){

					foreach($jobtax as $jobtax) {
						if($jobtax->name == $typeOfJob){ ?>
							<div>
							<li><?php the_title(); ?></li>
							</div>
						<?php } elseif ($typeOfJob == 'category') { ?>
							<div>
							<li><?php the_title(); ?></li>
							</div>
						<?php }

						else{?>
							<div>
							<li>No job Found</li>
							</div>
						<?php }
				}					
			 }
			  elseif($jobcity == 'city'){

				foreach($jobtax as $jobtax) {
					if($jobtax->name == $typeOfJob){ ?>
						<div>
						<li><?php the_title(); ?></li>
						</div>
					<?php }
					else{ ?>
						<div>
						<li>No job Found</li>
						</div>
					<?php } 
			}					
		 }	
	}	
				wp_reset_postdata()	;
		
	}

}