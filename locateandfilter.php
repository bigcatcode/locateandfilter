<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://locateandfilter.monothemes.com
 * @since             1.0.0
 * @package           Locate_And_Filter
 *
 * @wordpress-plugin
 * Plugin Name:       LocateAndFilter
 * Plugin URI:        http://locateandfilter.monothemes.com
 * Description:       LocateAndFilter is a versatile and highly customizable WordPress plugin aimed at creating searchable/filterable maps based on Leaflet. Support for any custom post type and their taxonomies.
 * Version:           1.5.02
 * Last Modified : 	  2022-02-18
 * Author:            Andrii Monin
 * Author URI:        http://www.bigcatcode.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       locate-anything
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-locate-and-filter-activator.php
 */
function activate_locate_and_filter() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-locate-and-filter-activator.php';
    Locate_And_Filter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-locate-and-filter-deactivator.php
 */
function deactivate_locate_and_filter() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-locate-and-filter-deactivator.php';
    Locate_And_Filter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_locate_and_filter' );
register_deactivation_hook( __FILE__, 'deactivate_locate_and_filter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-locate-and-filter.php';

/**
 * The addon plugin class 
 */
require plugin_dir_path( __FILE__ ) . 'addons/class-locate-and-filter-addons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_locate_and_filter() {

    if ( !function_exists( 'is_plugin_active' ) ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    if ( !is_plugin_active( 'locateandfilter_pro/locateandfilter.php' ) ) {

        $plugin = new Locate_And_Filter();
        $plugin->run();

        if ( !is_plugin_active( 'locateandfilter_addon-overlays/locateandfilter_addon-overlays.php' ) ) {
            $addons = new Locate_And_Filter_Addons_Demo();
        }

    } else {

        function locate_and_filter_notice() {

            ?>
                <div class="error"><p>
                    <?php printf(__('Please de-activate and remove the PRO version of LocateAndFilter before activating the free version.', 'locate-anything'));
                    ?>
                </p></div>
            <?php

        }

        add_action('admin_notices', 'locate_and_filter_notice');
        deactivate_plugins( 'locateandfilter/locateandfilter.php' );

    }

}
run_locate_and_filter();
