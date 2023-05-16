<?php
/**
 * Plugin Name: SMNTCS Show Symlinked Plugins
 * Plugin URI: http://github.com/nielslange/smntcs-show-symlinked-plugins
 * Description: Prevent accidentally deleting or updating symlinked plugins.
 * Version: 1.0
 * Author: Niels Lange
 * Author URI: http://nielslange.de
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: smntcs-show-symlinked-plugins
 *
 * @package smntcs-show-symlinked-plugins
 */

defined( 'ABSPATH' ) || exit;

class SMNTCS_Show_Symlinked_Plugins {
	public function __construct() {
		add_action( 'admin_footer', array( $this, 'add_custom_class_to_plugin_row' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
	}

	public function add_custom_class_to_plugin_row() {
		$screen = get_current_screen();
		if ( 'plugins' !== $screen->base ) {
			return;
		}

		$plugins = get_plugins();
		foreach ( $plugins as $plugin_file => &$plugin_data ) {
			$real_path = realpath( WP_PLUGIN_DIR . '/' . $plugin_file );
			if ( $real_path && dirname( $real_path ) !== WP_PLUGIN_DIR . '/' . dirname( $plugin_file ) ) {
				?>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
					const plugin = '<?php echo sanitize_text_field( wp_unslash( $plugin_data['TextDomain'] ) ); ?>';
					const row    = $( `tr[data-slug="${plugin}"]`);
					row.addClass( 'symlinked' );

					// Removes the delete button when plugin is not active.
					$( '#delete-' + plugin ).remove();

					// Adds the "Symlinked" text to the front of the actions row.
					row.find( '.row-actions' ).prepend( '<span class="symlinked-text">Symlinked</span> | ' );
				});
				</script>
				<?php
			}
		}
	}

	public function enqueue_admin_styles() {
		wp_enqueue_style( 'smntcs-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
	}
}

new SMNTCS_Show_Symlinked_Plugins();
