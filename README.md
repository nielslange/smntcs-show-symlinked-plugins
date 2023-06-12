# SMNTCS Show Symlinked Plugins

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

## Screenshot

<img width="1441" alt="Screen Shot 2023-05-17 at 22 23 56" src="https://github.com/nielslange/smntcs-show-symlinked-plugins/assets/3323310/c5e7fcbe-e7c9-4e2d-a026-abfb9d24a4f4">

-   ![#72aee6](https://placehold.co/15x15/72aee6/72aee6.png) `#72aee6`: This plugin is not symlinked, but installed.
-   ![#dba617](https://placehold.co/15x15/dba617/dba617.png) `#dba617`: This plugin is symlinked, and it's the most recent version.
-   ![#d63638](https://placehold.co/15x15/d63638/d63638.png) `#d63638`: This plugin is symlinked, but there's a more recent version available.

## Installation

1. Upload `smntcs-show-symlinked-plugins` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

## Changelog

### 1.1 (2023.06.12)

-   Add screenshot

### 1.0 (2023.05.15)

-   Initial release
