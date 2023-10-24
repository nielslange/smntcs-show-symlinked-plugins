<?php
/**
 * Plugin Name:         SMNTCS Show Symlinked Plugins
 * Plugin URI:          http://github.com/nielslange/smntcs-show-symlinked-plugins
 * Description:         Prevent accidentally deleting or updating symlinked plugins.
 * Author:              Niels Lange
 * Author URI:          http://nielslange.de
 * Text Domain:         smntcs-show-symlinked-plugins
 * Version:             1.3
 * Requires at least:   5.2
 * Requires PHP:        5.6
 * License:             GPL2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package smntcs-show-symlinked-plugins
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class SMNTCS_Show_Symlinked_Plugins
 */
class SMNTCS_Show_Symlinked_Plugins {
	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * SMNTCS_Show_Symlinked_Plugins constructor.
	 */
	public function __construct() {
		$this->version = $this->get_plugin_version();

		add_action( 'admin_footer', array( $this, 'add_custom_class_to_plugin_row' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
	}

	/**
	 * Returns the plugin version by parsing the plugin header.
	 *
	 * @return string
	 */
	private function get_plugin_version() {
		static $version;

		if ( isset( $version ) ) {
			return $version;
		}

		$plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
		$version     = $plugin_data['Version'];

		return $version;
	}
	/**
	 * Adds a custom class to the plugin row.
	 */
	public function add_custom_class_to_plugin_row() {
		$screen = get_current_screen();
		if ( 'plugins' !== $screen->base ) {
			return;
		}

		$plugins = get_plugins();
		foreach ( $plugins as $plugin_file => $plugin_data ) {
			$real_path = realpath( WP_PLUGIN_DIR . '/' . $plugin_file );
			if ( $real_path && dirname( $real_path ) !== trailingslashit( WP_PLUGIN_DIR ) . dirname( $plugin_file ) ) {
				?>
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							const row = $( `tr[data-plugin="<?php echo esc_html( $plugin_file ); ?>"]`);

							// Adds the "symlinked" class to the plugin row.
							row.addClass( 'symlinked' );

							// Adds the "Symlinked" text to the front of the actions row.
							row.find( '.row-actions' ).prepend( '<span class="symlinked-text">Symlinked</span> | ' );

							// Removes the delete button when plugin is not active.
							row.find('.delete').remove();

							// Removes the " | " separator behind the "Activate" link when plugin is active.
							row.find('.activate').html(function(_, html){ return html.replace(' | ', ''); });

							// Removes the "Enable auto-updates" link.
							row.find( '.toggle-auto-update' ).remove();
						});
					})(jQuery);
				</script>
				<?php
			}
		}
	}

	/**
	 * Enqueues the admin styles.
	 */
	public function enqueue_admin_styles() {
		wp_enqueue_style(
			'smntcs-admin-style',
			plugins_url( 'assets/css/admin.css', __FILE__ ),
			array(),
			$this->version
		);
	}
}

new SMNTCS_Show_Symlinked_Plugins();
