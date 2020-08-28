<?php
/**
 * Plugin Name: WooCommerce Admin Example Plugin
 * Author: Dan Bitzer
 * Version: 1.0.0
 *
 * Requires at least: 5.5
 * Requires PHP: 7.0.0
 * WC requires at least: 4.4.0
 */

namespace DanBitzer\MyPlugin;

use DanBitzer\MyPlugin\Admin\AssetLoader;

function includes() {
	$path = dirname( __FILE__ ) . '/src';

	require $path . '/PluginInfo.php';
	require $path . '/Admin/AssetLoader.php';
}

includes();

$plugin_info = new PluginInfo( dirname( __FILE__ ), plugins_url( '', __FILE__ ) );

if ( is_admin() ) {
	new AssetLoader( $plugin_info );
}
