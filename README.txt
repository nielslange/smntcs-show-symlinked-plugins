=== SMNTCS Show Symlinked Plugins ===

Contributors: 		nielslange
Tags: 				Plugins
Stable tag: 		1.1
Tested up to: 		6.2
Requires PHP: 		7.4
Requires at least: 	5.2
License: 			GPL v2 or later
License URI: 		https://www.gnu.org/licenses/gpl-2.0.html

Prevent accidentally deleting or updating symlinked plugins.

## Description

**SMNTCS Show Symlinked Plugins** is a powerful WordPress plugin designed to prevent the accidental deletion or updating of symlinked plugins. It is an essential tool for developers who use symbolic links (symlinks) for plugin development or deployment.

When working with WordPress, it is quite common to symlink plugins for various reasons. For example, you might want to test changes without affecting the original plugin, or symlink plugins across multiple sites for easy updates. However, WordPress, by default, does not distinguish between regular and symlinked plugins on the admin plugins page. This can lead to unintended deletions or updates.

**SMNTCS Show Symlinked Plugins** addresses this by adding visible indicators to symlinked plugins and adjusting their options.

## Features

### Indicate Symlinked Plugins

The plugin adds a 'Symlinked' text indicator in front of the action row of each symlinked plugin on the WordPress plugins page. This makes it visually clear which plugins are symlinked, helping you to avoid mistakes.

### Adjust Plugin Actions

For symlinked plugins, the plugin removes the delete button when the plugin is inactive, ensuring that you cannot accidentally delete symlinked plugins. Furthermore, it removes the option to enable auto-updates for symlinked plugins to prevent unintentional updates.

### Custom Styling

The plugin comes with an admin CSS file that you can customize to adjust how symlinked plugins are displayed.

== Installation ==

1. Upload `smntcs-show-symlinked-plugins` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

== Contribute ==

Contributions are more than welcome. Simply head over to [Github](https://github.com/nielslange/smntcs-show-symlinked-plugins) and open an issue or a pull request.

== Changelog ==

= 1.1 (2023.06.12) =

- Add screenshot

= 1.0 (2023.05.15) =

- Initial release
