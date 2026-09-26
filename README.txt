=== SMNTCS Show Symlinked Plugins ===

Contributors:       nielslange
Tags:               plugins, symlink, development, admin, updates
Requires at least:  5.2
Tested up to:       7.1
Requires PHP:       5.6
Stable tag:         1.6
License:            GPL v2 or later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html

Labels symlinked plugins on the Plugins page and hides their delete link and update notice, so you cannot change them by accident.

== Description ==

Developers often symlink plugins from a shared folder into several WordPress sites. Updating or deleting such a plugin from one site changes it for all of them.

SMNTCS Show Symlinked Plugins labels symlinked plugins on the Plugins page and hides their delete link and update notice, so they cannot be removed or updated by accident.

== Installation ==

1. Upload `smntcs-show-symlinked-plugins` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

== Frequently Asked Questions ==

= A symlinked plugin folder is suddenly empty. Why? =

The plugin only hides the update and delete links. It cannot stop other tools from changing the folder, for example automatic updates run by your host or by another site that shares the same plugin folder. Check the automatic update settings of every site that uses the shared folder.

= A symlinked plugin folder is suddenly empty. Why? =

The plugin only hides the update and delete links. It cannot stop other tools from changing the folder, for example automatic updates run by your host or by another site that shares the same plugin folder. Check the automatic update settings of every site that uses the shared folder.

== Contribute ==

Contributions are more than welcome. Simply head over to [GitHub](https://github.com/nielslange/smntcs-show-symlinked-plugins) and open an issue or a pull request.

== Changelog ==

= 1.6 (2026.09.26) =

- Test up to WordPress 7.1
- Update development dependencies and GitHub Actions

= 1.5 (2026.08.14) =

- Test up to WP 7.0

= 1.4 (2025.03.20) =

- Test up to WP 6.8

= 1.3 (2023.10.24) =

- Encapsulated JS within anonymous function

= 1.2 (2023.10.21) =

- Test up to WP 6.4

= 1.1 (2023.06.12) =

- Add screenshot

= 1.0 (2023.05.15) =

- Initial release
