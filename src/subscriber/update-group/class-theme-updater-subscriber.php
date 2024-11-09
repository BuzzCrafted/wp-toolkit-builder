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

/**
 * Class Theme_Updater_Subscriber
 *
 * Manages theme updates.
 *
 * @since 1.0.1
 */
class Theme_Updater_Subscriber extends Base_Updater_Subscriber {

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
}
