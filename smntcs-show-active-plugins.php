<?php
/**
 * Plugin Name: SMNTCS Show Active Plugins
 * Plugin URI: http://github.com/nielslange/smntcs-show-active-plugins
 * Description: This plugin adds a submenu item to the Plugins menu item, that links to all active plugins.
 * Version: 1.0
 * Author: Niels Lange
 * Author URI: http://nielslange.de
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: smntcs-show-active-plugins
 *
 * @package smntcs-show-active-plugins
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add a submenu item to the Plugins menu item, that links to all active plugins.
 */
function smntcs_show_active_plugins_menu() {
	add_plugins_page(
		__( 'Active Plugins', 'smntcs-show-active-plugins' ),
		__( 'Active Plugins', 'smntcs-show-active-plugins' ),
		'manage_options',
		'plugins.php?plugin_status=active',
		'',
		1
	);
}
add_action( 'admin_menu', 'smntcs_show_active_plugins_menu' );

/**
 * Enqueue script to highlight the Active Plugins submenu item.
 */
function smntcs_enqueue_scripts() {
	wp_enqueue_script(
		'smntcs-show-active-plugins-script',
		plugins_url( '/assets/js/script.js', __FILE__ ),
		array(),
		true,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'smntcs_enqueue_scripts' );
