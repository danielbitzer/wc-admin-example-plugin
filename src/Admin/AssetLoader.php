<?php

namespace DanBitzer\MyPlugin\Admin;

use DanBitzer\MyPlugin\PluginInfo;

/**
 * Class AssetLoader.
 *
 * Loads JavaScript and CSS files.
 */
class AssetLoader {

	/**
	 * @var PluginInfo
	 */
	protected $plugin_info;

	/**
	 * AssetLoader constructor.
	 *
	 * @param PluginInfo $plugin_info
	 */
	public function __construct( PluginInfo $plugin_info ) {
		$this->plugin_info = $plugin_info;

		add_action( 'admin_enqueue_scripts', [ $this, 'handle_admin_enqueue_scripts_action' ] );
	}

	/**
	 * Register asset loader hooks.
	 */
	public function handle_admin_enqueue_scripts_action() {
		// Load assets if on an WooCommerce Admin page
		if ( function_exists( 'wc_admin_is_registered_page' ) && wc_admin_is_registered_page() ) {
			$this->load_js_and_css();
		}
	}

	/**
	 * Load JS and CSS assets.
	 */
	protected function load_js_and_css() {
		$handle            = 'dan-bitzer-my-plugin';
		$build_path        = '/assets/build';
		$script_asset_path = $this->plugin_info->get_path() . $build_path . '/index.asset.php';
		$script_info       = file_exists( $script_asset_path )
			? include $script_asset_path
			: [ 'dependencies' => [], 'version' => $this->plugin_info::VERSION ];

		wp_register_script(
			$handle,
			$this->plugin_info->get_url() . $build_path . '/index.js',
			$script_info['dependencies'],
			$script_info['version'],
			true
		);

		wp_register_style(
			$handle,
			$this->plugin_info->get_url() . $build_path . '/index.css',
			// Add the WooCommerce Admin styles as a dependency
			[ 'wc-admin-app' ],
			$this->plugin_info::VERSION
		);

		wp_enqueue_script( $handle );
		wp_enqueue_style( $handle );
	}

}
