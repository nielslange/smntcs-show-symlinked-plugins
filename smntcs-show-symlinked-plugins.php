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
	 * Returns the plugin version.
	 *
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * SMNTCS_Show_Symlinked_Plugins constructor.
	 */
	public function __construct() {
		$this->version = $this->get_plugin_version();

		add_action( 'admin_footer', array( $this, 'add_custom_class_to_plugin_row' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'activated_plugin', array( $this, 'flush_plugins_cache' ) );
		add_action( 'deactivated_plugin', array( $this, 'flush_plugins_cache' ) );
		add_action( 'delete_plugin', array( $this, 'flush_plugins_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_plugins_cache' ) );
		add_action( 'symlink_plugin', array( $this, 'flush_plugins_cache' ) );
		add_action( 'uninstall_plugin', array( $this, 'flush_plugins_cache' ) );
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

		$plugins = $this->get_cached_plugins();

		$symlinkedPlugins = array_filter($plugins,
			function( $plugin_data, $plugin_file ) {
				$real_path = realpath( WP_PLUGIN_DIR . '/' . $plugin_file );
				return $real_path && dirname( $real_path ) !== WP_PLUGIN_DIR . '/' . dirname( $plugin_file );
			},
		ARRAY_FILTER_USE_BOTH);

		if ( empty( $symlinkedPlugins ) ) {
			return;
		}

		ob_start();
		?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		<?php foreach ( $symlinkedPlugins as $plugin_file => $plugin_data ) : ?>
			const row<?php echo esc_js( $plugin_file ); ?> = $('tr[data-plugin="<?php echo esc_attr( $plugin_file ); ?>"]');

			// Adds the "symlinked" class to the plugin row.
			row<?php echo esc_js( $plugin_file ); ?>.addClass('symlinked');

			// Adds the "Symlinked" text to the front of the actions row.
			row<?php echo esc_js( $plugin_file ); ?>.find('.row-actions').prepend('<span class="symlinked-text">Symlinked</span> | ');

			// Removes the delete button when the plugin is not active.
			row<?php echo esc_js( $plugin_file ); ?>.find('.delete').remove();

			// Removes the " | " separator behind the "Activate" link when the plugin is active.
			row<?php echo esc_js( $plugin_file ); ?>.find('.activate').html(function(_, html) {
				return html.replace(' | ', '');
			});

			// Removes the "Enable auto-updates" link.
			row<?php echo esc_js( $plugin_file ); ?>.find('.toggle-auto-update').remove();
		<?php endforeach; ?>
	});
	</script>
		<?php
		ob_end_flush();
	}

	/**
	 * Retrieves the list of plugins from cache or database.
	 *
	 * @return array
	 */
	private function get_cached_plugins() {
		$cache_key = 'smntcs_plugins_cache';
		$plugins   = get_transient( $cache_key );

		if ( false === $plugins ) {
			$plugins = get_plugins();
			set_transient( $cache_key, $plugins, DAY_IN_SECONDS );
		}

		return $plugins;
	}

	/**
	 * Flushes the plugins cache.
	 */
	public function flush_plugins_cache() {
		$cache_key = 'smntcs_plugins_cache';
		delete_transient( $cache_key );
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
