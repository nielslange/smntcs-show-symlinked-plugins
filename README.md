# SMNTCS Show Symlinked Plugins

Prevent accidentally deleting or updating symlinked plugins.

## Description

This plugins highlights the symlinked plugins on the plugin page and removes the delete and update links. This prevents accidentally deleting or updating symlinked plugins.

## Screenshot

<img width="1441" alt="Screen Shot 2023-05-17 at 22 23 56" src="https://github.com/nielslange/smntcs-show-symlinked-plugins/assets/3323310/c5e7fcbe-e7c9-4e2d-a026-abfb9d24a4f4">

- ![#72aee6](https://placehold.co/15x15/72aee6/72aee6.png) `#72aee6`: This plugin is not symlinked, but installed.
- ![#dba617](https://placehold.co/15x15/dba617/dba617.png) `#dba617`: This plugin is symlinked, and it's the most recent version.
- ![#d63638](https://placehold.co/15x15/d63638/d63638.png) `#d63638`: This plugin is symlinked, but there's a more recent version available.

## Installation

1. Upload `smntcs-show-symlinked-plugins` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

## Changelog

### 1.0 (2023.05.15)

-   Initial release
