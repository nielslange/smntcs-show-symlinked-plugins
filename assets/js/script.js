document.addEventListener( 'DOMContentLoaded', function () {
	const currentUrl = window.location.href;
	const installedPluginsLink = document.querySelector(
		'.wp-submenu a[href="plugins.php"]'
	);
	const activePluginsLink = document.querySelector(
		'.wp-submenu a[href="plugins.php?plugin_status=active"]'
	);

	if (
		currentUrl.indexOf( '/wp-admin/plugins.php?plugin_status=active' ) > -1
	) {
		installedPluginsLink.parentElement.classList.remove( 'current' );
		activePluginsLink.parentElement.classList.add( 'current' );
	}
} );
