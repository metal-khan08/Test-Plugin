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

	//our first hello wold shortcode
	function public_hello_world(){
		//just say hello
		$args = array(
			'post_type'      => 'jobs',
			'posts_per_page' => '3',
			'publish_status' => 'published',
		 );
		
		 $query = new WP_Query($args);
		
		
		while($query->have_posts()) {
		$query->the_post() ;
		
		$location_output=get_post_meta($post->ID, 'meta_location', true);
		$salary_output=get_post_meta($post->ID, 'meta_number', true);
		$timing_output=get_post_meta($post->ID, 'meta_timings', true);
		$benefits_output=get_post_meta($post->ID, 'custom_benefits', true);
		?>
		this is the name of the job <?php the_title();
		?><br>
		
	<?php	
		wp_reset_postdata();
		
		}
	}

}
