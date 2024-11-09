<?php
/**
 * This file contains the Plugin_Update_Info class which provides update information for a plugin.
 *
 * @package Bdev
 * @subpackage Updater
 * @since      1.0.1
 * @version    1.0.0
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\Updater\Info;

/**
 * Class Plugin_Update_Info
 *
 * This class provides update information for a plugin.
 */
class Plugin_Update_Info extends Update_Info {

	/**
	 * Get update information.
	 *
	 * @return array<string, mixed> An array containing the update information.
	 */
	public function get_update_info(): array {
		return array(
			'plugin'       => $this->update_info['name'] ?? '',
			'new_version'  => '0',
			'url'          => '',
			'package'      => '',
			'requires'     => '',
			'requires_php' => '',
		);
	}

	/**
	 * Get information when there is no update.
	 *
	 * @return array<string, mixed> An array containing the no update information.
	 */
	public function get_no_update_info(): array {
		return array(
			'id'            => $this->update_info['name'] ?? '',
			'slug'          => $this->update_info['slug'] ?? '',
			'plugin'        => $this->update_info['name'] ?? '',
			'new_version'   => '0',
			'url'           => '',
			'package'       => '',
			'icons'         => array(),
			'banners'       => array(),
			'banners_rtl'   => array(),
			'tested'        => '',
			'requires_php'  => '',
			'compatibility' => new \stdClass(),
		);
	}
}
