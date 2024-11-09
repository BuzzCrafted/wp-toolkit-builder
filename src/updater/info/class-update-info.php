<?php
/**
 * This file contains the Update_Info abstract class which represents update information.
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

use Bdev\Provider\Interfaces\Provider_Interface;
use Bdev\UpdateManagement\Interfaces\Update_Info_Interface;

/**
 * Abstract class representing update information.
 */
abstract class Update_Info implements Update_Info_Interface {
	/**
	 *  An associative array where the key is a string and the value can be of any type.
	 *
	 * @var array<string, mixed> $update_info
	 */
	protected array $update_info;

	/**
	 * Data provider instance
	 *
	 * @var Provider_Interface
	 */
	protected Provider_Interface $data_provider;

	/**
	 * Constructor for the Update_Info class.
	 *
	 * @param Provider_Interface $data_provider Data provider instance.
	 */
	public function __construct( Provider_Interface $data_provider ) {
		$this->data_provider = $data_provider;
		$this->update_info   = $this->data_provider->get_data();
	}

	/**
	 * Get update information.
	 *
	 * @return array<string, mixed> An array containing the update information.
	 */
	abstract public function get_update_info(): array;

	/**
	 * Get information when there is no update.
	 *
	 * @return array<string, mixed> An array containing the no update information.
	 */
	abstract public function get_no_update_info(): array;

	/**
	 * Get the update ID.
	 *
	 * @return string The update ID.
	 */
	public function get_update_id(): string {
		return $this->update_info['name'] ?? '';
	}

	/**
	 * Sets the data provider.
	 *
	 * @param Provider_Interface $data_provider Data provider instance.
	 */
	public function set_data_provider( Provider_Interface $data_provider ): void {
		$this->data_provider = $data_provider;
	}

	/**
	 * Gets the data provider.
	 *
	 * @return Provider_Interface Data provider instance.
	 */
	public function get_data_provider(): Provider_Interface {
		return $this->data_provider;
	}
}
