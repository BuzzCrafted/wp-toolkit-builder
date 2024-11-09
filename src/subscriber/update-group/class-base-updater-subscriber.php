<?php
/**
 * Base class for updater subscribers.
 *
 * @package   Bdev
 * @subpackage Subscriber
 * @since 1.0.1
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @link    https://buzzdeveloper.net
 * @author  BuzzDeveloper
 */

namespace Bdev\Subscriber;

use Bdev\EventManagement\Interfaces\Subscriber_Interface;
use Bdev\Updater\Interfaces\Updater_Interface;


/**
 * Abstract class Base_Updater_Subscriber.
 *
 * This class provides the base functionality for updater subscribers.
 *
 * @since 1.0.1
 */
abstract class Base_Updater_Subscriber implements Subscriber_Interface {

	/**
	 * Updater instance.
	 *
	 * @var Updater_Interface
	 */
	protected Updater_Interface $updater;

	/**
	 * Constructor.
	 *
	 * @param Updater_Interface $updater Updater instance.
	 */
	public function __construct( Updater_Interface $updater ) {
		$this->updater = $updater;
	}

	/**
	 * Manage theme updates.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $transient The transient object containing update information.
	 * @return \stdClass The modified transient object.
	 */
	public function manage_updates( \stdClass $transient ): \stdClass {

		return $this->updater->prepare_update( $transient );
	}
}
