<?php
/**
 * File name: interface-content-data.php
 *
 * Provides an interface for content data management.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\ContentManagement\Interfaces;

use Bdev\EventManagement\Interfaces\Subscriber_Interface;
use Bdev\Shortcodes\Interfaces\Shortcode_Interface;

interface Content_Data_Interface {

	/**
	 * Retrieve an array of subscribers.
	 *
	 * Implementations should return all event or action subscribers
	 * associated with the theme or plugin.
	 *
	 * @since 1.0.0
	 * @return array<int, Subscriber_Interface> Array of subscribers.
	 */
	public function get_subscribers(): array;

	/**
	 * Retrieve an array of shortcodes.
	 *
	 * Implementations should return all shortcodes registered by
	 * the theme or plugin.
	 *
	 * @since 1.0.0
	 * @return array<int, Shortcode_Interface> Array of shortcodes.
	 */
	public function get_shortcodes(): array;
}
