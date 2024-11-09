<?php
/**
 * Updater Interface for maintaining self-hosted plugin updater.
 *
 * @package Bdev
 * @subpackage Updater;
 */

namespace Bdev\Updater\Interfaces;

/**
 * Interface Updater_Interface
 *
 * This interface defines the contract for an updater.
 * Implementing classes should provide the necessary methods to perform update operations.
 */
interface Updater_Interface {

	/**
	 * Prepares the update.
	 *
	 * @param \stdClass $transient The transient object containing update information.
	 * @return \stdClass The modified transient object.
	 */
	public function prepare_update( \stdClass $transient ): \stdClass;
}
