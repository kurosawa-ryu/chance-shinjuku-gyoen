<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              worldagent.jp
 * @since             1.0.0
 * @package           Work_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Work Manager
 * Plugin URI:        http://wordpress.org/plugins/work-manager
 * Description:       出勤管理登録
 * Version:           2.0.0
 * Author:            World Agent
 * Author URI:        worldagent.jp
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       work-manager
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
define( 'PLUGIN_NAME_VERSION', '2.0.0' );

define( 'LW_PLUGIN_VER', '1' );
define( 'LW_PLUGIN_URL', untrailingslashit( plugins_url( 'includes', __FILE__ ) ) );
define( 'LW_PLUGIN_DIR', untrailingslashit( __DIR__ ) );
define( 'LW_PLUGIN_FILE_PATH', __FILE__ );
define( 'TITLE_NAME', 'キャスト名' );
define( 'OFFICE_ENDHOUR', 31 );
define( 'OFFICE_SWITCH_TIME', 0 );
define( 'LW_NO_IMAGE', LW_PLUGIN_URL . '/img/no-img.png' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-work-manager-activator.php
 */
function activate_work_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-work-manager-activator.php';
	Work_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-work-manager-deactivator.php
 */
function deactivate_work_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-work-manager-deactivator.php';
	Work_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_work_manager' );
register_deactivation_hook( __FILE__, 'deactivate_work_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/functions.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-work-manager.php';
require plugin_dir_path( __FILE__ ) . 'includes/schedule-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_work_manager() {

	$plugin = new Work_Manager();
	$plugin->run();
}
run_work_manager();
