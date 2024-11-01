<?php
/**
 * File name: interface-subscriber.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @packageBdev
 * @subpackage Various
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @link    https://buzzdeveloper.net
 * @author  BuzzDeveloper
 */

namespace Bdev\EventManagement\Interfaces;

/**
 * Interface Subscriber_Interface
 *
 * Represents an event subscriber that hooks into WordPress actions or filters.
 * Classes implementing this interface should provide a list of subscribed events.
 *
 * @since 1.0.0
 */
interface Subscriber_Interface {

	/**
	 * Get the list of events to which the subscriber should be subscribed.
	 *
	 * This method should return an array of events and their respective callbacks.
	 * The array keys are the event names (actions or filters), and the values can be
	 * the callback method name or an array containing the callback method name, priority,
	 * and number of accepted arguments.
	 *
	 * Example:
	 * ```php
	 * return [
	 *     'init' => 'initialize_method',
	 *     'wp_enqueue_scripts' => ['enqueue_assets', 20, 2],
	 * ];
	 * ```
	 *
	 * @since 1.0.0
	 * @return array Array of events and their respective callback methods.
	 */
	public static function get_subscribed_events(): array;
}
