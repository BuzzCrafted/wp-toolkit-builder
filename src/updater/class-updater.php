<?php
/**
 * Updater class file
 *
 * This file contains the Updater class which implements the Updater_Interface.
 *
 * @package Bdev
 * @subpackage Updater
 * @since      1.0.1
 * @version    1.0.0
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\Updater;

use Bdev\Updater\Interfaces\Update_Info_Interface;
use Bdev\Settings\Interfaces\WP_Info_Interface;
use Bdev\Updater\Interfaces\Updater_Interface;
use stdClass;

/**
 * Class Updater
 *
 * Implements the Updater_Interface to handle updates.
 */
class Updater implements Updater_Interface {

	/**
	 * Update info instance.
	 *
	 * @var Update_Info_Interface
	 */
	private Update_Info_Interface $update_info;

	/**
	 * WordPress info instance.
	 *
	 * @var WP_Info_Interface
	 */
	private WP_Info_Interface $wp_info;

	/**
	 * Updater constructor.
	 *
	 * Initializes the Updater with the provided data provider and update info instances.
	 *
	 * @param Update_Info_Interface $update_info Update info instance.
	 * @param WP_Info_Interface     $wp_info WordPress info instance.
	 */
	public function __construct( Update_Info_Interface $update_info, WP_Info_Interface $wp_info ) {
		$this->update_info = $update_info;
		$this->wp_info     = $wp_info;
	}

	/**
	 * Sets the update info.
	 *
	 * @param Update_Info_Interface $update_info Update info instance.
	 */
	public function set_update_info_provider( Update_Info_Interface $update_info ): void {
		$this->update_info = $update_info;
	}

	/**
	 * Gets the update info.
	 *
	 * @return Update_Info_Interface Update info instance.
	 */
	public function get_update_info_provider(): Update_Info_Interface {
		return $this->update_info;
	}

		/**
		 * Sets the WordPress info.
		 *
		 * @param WP_Info_Interface $wp_info WordPress info instance.
		 */
	public function set_wp_info_provider( WP_Info_Interface $wp_info ): void {
		$this->wp_info = $wp_info;
	}

	/**
	 * Gets the WordPress info.
	 *
	 * @return WP_Info_Interface WordPress info instance.
	 */
	public function get_wp_info_provider(): WP_Info_Interface {
		return $this->wp_info;
	}

	/**
	 * Prepares the update.
	 *
	 * @param \stdClass $transient The transient object containing update information.
	 * @return \stdClass The modified transient object.
	 */
	public function prepare_update( \stdClass $transient ): \stdClass {
		$update = $this->check_for_updates();
		if ( ! empty( $update ) ) {
			if ( ! isset( $transient->response ) ) {
				$transient->response = array();
			}
			$transient->response[ $this->get_update_info_provider()->get_update_id() ] = $update;
		} else {
			$item = (object) $this->get_update_info_provider()->get_no_update_info();
			$transient->no_update[ $this->get_update_info_provider()->get_update_id() ] = $item;
		}
		return $transient;
	}

	/**
	 * Checks for updates.
	 *
	 * @return array<string, mixed> Update information array.
	 */
	protected function check_for_updates(): array {
		$update_info = array();
		$update_data = $this->get_update_info_provider()->get_update_info();

		if ( version_compare( (string) $update_data['new_version'], $this->get_wp_info_provider()->get_version(), '>' )
		&& version_compare( $update_data['requires'] ?? '', $this->get_wp_info_provider()->get_requires(), '<' )
		&& version_compare( $update_data['requires_php'] ?? '', $this->get_wp_info_provider()->get_requires_php(), '<' ) ) {
			$update_info = $this->get_update_info_provider()->get_update_info();
		}

		return $update_info;
	}
}
