<?php
/**
 * Theme Updater Subscriber class.
 *
 * @package   Bdev
 * @subpackage Various
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
 * Class Theme_Updater_Subscriber
 *
 * This class subscribes to theme update events and manages theme updates.
 *
 * @package Bdev\Subscriber
 * @since 1.0.0
 */
class Theme_Updater_Subscriber implements Subscriber_Interface {

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
	 * Get the list of subscribed events.
	 *
	 * Returns an array of WordPress hooks and corresponding methods to manage
	 * the registration and enqueueing of frontend assets.
	 *
	 * @since 1.0.0
	 * @return array<string, mixed> Array of hooks and callback methods.
	 */
	public static function get_subscribed_events(): array {
		return array(
			'pre_set_site_transient_update_themes' => 'manage_updates',
		);
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
