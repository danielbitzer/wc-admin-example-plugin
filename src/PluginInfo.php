<?php

namespace DanBitzer\MyPlugin;

/**
 * Class PluginInfo
 */
class PluginInfo {

	/**
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * PluginInfo constructor.
	 *
	 * @param string $path
	 * @param string $url
	 */
	public function __construct( string $path, string $url ) {
		$this->path = $path;
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function get_path() {
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function get_url() {
		return $this->url;
	}

}

