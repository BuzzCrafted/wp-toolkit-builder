<?php
/**
 * File name: class-frontend-assets-subscriber.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @package   Bdev
 * @subpackage Various
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @link    https://buzzdeveloper.net
 * @author  BuzzDeveloper
 */

namespace Bdev\Subscriber\Frontend;

use Bdev\Subscriber\Base_Assets_Subscriber;

/**
 * Class Frontend_Assets_Subscriber
 *
 * Subscribes to WordPress events related to frontend assets, such as styles and scripts,
 * to properly manage asset loading.
 *
 * @since 1.0.0
 */
class Frontend_Assets_Subscriber extends Base_Assets_Subscriber {

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
			'wp_enqueue_scripts' => 'manage_assets',
		);
	}
}
