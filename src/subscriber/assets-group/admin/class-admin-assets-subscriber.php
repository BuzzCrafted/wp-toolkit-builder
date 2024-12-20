<?php
/**
 * File name: class-admin-assets-subscriber.php
 *
 * Subscribes to WordPress events related to admin asset loading,
 * specifically enqueuing styles and scripts for the WordPress admin dashboard.
 *
 * @package    Bdev
 * @subpackage AssetManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\AssetManagement\Subscriber\Admin;

use Bdev\Subscriber\Base_Assets_Subscriber;

/**
 * Class Admin_Assets_Subscriber
 *
 * Subscribes to WordPress events related to admin asset loading,
 * specifically enqueuing styles and scripts for the WordPress admin dashboard.
 *
 * @since 1.0.0
 */
class Admin_Assets_Subscriber extends Base_Assets_Subscriber {

	/**
	 * Get the list of events to subscribe to.
	 *
	 * Returns an array of WordPress events and their respective callback methods.
	 * This class handles enqueuing admin scripts by hooking into the 'admin_enqueue_scripts' event.
	 *
	 * @since 1.0.0
	 * @return array<string, mixed> Array of events with their callback methods.
	 */
	public static function get_subscribed_events(): array {
		return array(
			'admin_enqueue_scripts' => 'manage_assets',
		);
	}
}
