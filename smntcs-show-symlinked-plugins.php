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
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'add_plugin_settings_link' ) );

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
					const row = $('tr[data-slug="<?php echo esc_html( $plugin_data['TextDomain'] ); ?>"]');
					row.addClass('symlinked');

					const activateLink = row.find('.activate');
					activateLink.each(function() {
						const text = $(this).html();
						$(this).html(text.replace(' | ', ''));
					});
				});
				</script>
				<?php
			}
		}
	}

	public function enqueue_admin_styles() {
		wp_enqueue_style( 'smntcs-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
	}


	/**
	 * Add settings link on plugin page
	 *
	 * @param array $url The original URL.
	 * @return array The updated URL.
	 * @since 1.0.0
	 */
	public static function add_plugin_settings_link( $url ) {
		$settings_link = sprintf( '<span class="symlinked-notice">%s</span>', __( 'Symlinked', 'smntcs-show-symlinked-plugins' ) );
		array_unshift( $url, $settings_link );

		return $url;
	}
}

new SMNTCS_Show_Symlinked_Plugins();
