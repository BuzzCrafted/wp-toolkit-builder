<?php
/**
 * This file contains the Theme_Update_Info class which provides update information for themes.
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
 * Class Theme_Update_Info
 *
 * This class provides update information for themes.
 */
class Theme_Update_Info extends Update_Info {
	/**
	 * Get update information.
	 *
	 * @return array<string, mixed> An array containing the update information.
	 */
	public function get_update_info(): array {
		return array(
			'theme'        => $this->update_info['name'] ?? '',
			'new_version'  => $this->update_info['version'] ?? '',
			'url'          => $this->update_info['url'] ?? '',
			'package'      => $this->update_info['package'] ?? '',
			'requires'     => $this->update_info['requires'] ?? '',
			'requires_php' => $this->update_info['requires_php'] ?? '',
		);
	}

	/**
	 * Get information when there is no update.
	 *
	 * @return array<string, mixed> An array containing the no update information.
	 */
	public function get_no_update_info(): array {
		return array(
			'theme'        => $this->update_info['name'] ?? '',
			'new_version'  => '0',
			'url'          => '',
			'package'      => '',
			'requires'     => '',
			'requires_php' => '',
		);
	}
}
