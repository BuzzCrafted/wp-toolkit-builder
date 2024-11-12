<?php
/**
 * File name: interface-update-info.php
 *
 * Provides an interface for retrieving update information.
 *
 * @package    Bdev
 * @subpackage Updater
 * @since      1.0.1
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper
 */

namespace Bdev\Updater\Interfaces;

/**
 * Interface Update_Info_Interface
 *
 * Provides methods for retrieving update information.
 *
 * @since 1.0.1
 */
interface Update_Info_Interface {

	/**
	 * Get update information.
	 *
	 * @return array<string, mixed> An array containing the update information.
	 */
	public function get_update_info(): array;

	/**
	 * Get information when there is no update.
	 *
	 * @return array<string, mixed> An array containing the no update information.
	 */
	public function get_no_update_info(): array;

	/**
	 * Get the update ID.
	 *
	 * @return string The update ID.
	 */
	public function get_update_id(): string;
}
