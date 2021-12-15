<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              def.com
 * @since             1.0.0
 * @package           Jobs_Board
 *
 * @wordpress-plugin
 * Plugin Name:       Jobs Board
 * Plugin URI:        abc.com
 * Description:       paste the short code [jobs-board] on the page you want to display the Jobs Board
 * Version:           1.0.0
 * Author:            Talha
 * Author URI:        def.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jobs-board
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JOBS_BOARD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jobs-board-activator.php
 */
function activate_jobs_board() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jobs-board-activator.php';
	Jobs_Board_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jobs-board-deactivator.php
 */
function deactivate_jobs_board() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jobs-board-deactivator.php';
	Jobs_Board_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jobs_board' );
register_deactivation_hook( __FILE__, 'deactivate_jobs_board' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jobs-board.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jobs_board() {

	$plugin = new Jobs_Board();
	$plugin->run();

}
run_jobs_board();
