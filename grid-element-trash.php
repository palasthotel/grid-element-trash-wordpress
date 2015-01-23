<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       Grid Element Trash
 * Plugin URI:        https://github.com/palasthotel/grid-element-trash-wordpress
 * Description:       Extends Grid with a trash for containers and boxes
 * Version:           1.0
 * Author:            PALASTHOTEL
 * Author URI:        http://palasthotel.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       grid-element-trash
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';

/** This action is documented in includes/class-plugin-name-activator.php */
register_activation_hook( __FILE__, array( 'Grid_Element_Trash_Activator', 'activate' ) );

/** This action is documented in includes/class-plugin-name-deactivator.php */
register_deactivation_hook( __FILE__, array( 'Grid_Element_Trash_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-grid-element-trash.php';

/**
 * Begins execution of the plugin.
 */
function run_plugin_name() {

	$plugin = new Grid_Element_Trash();
	$plugin->run();

}
run_plugin_name();
