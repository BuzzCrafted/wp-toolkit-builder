<?php
/**
 * Content_Data_Interface
 *
 * Defines methods for retrieving theme or plugin data such as subscribers and shortcodes.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @author     BuzzDeveloper
 */

namespace Bdev\ContentManagement\Interfaces;

/**
 * Interface Content_Data_Interface
 *
 * Provides methods for accessing different types of content data.
 * Classes implementing this interface should handle data retrieval,
 * focusing on specific types of data like subscribers and shortcodes.
 *
 * @since 1.0.0
 */
interface Content_Data_Interface {

	/**
	 * Retrieve an array of subscribers.
	 *
	 * Implementations should return all event or action subscribers
	 * associated with the theme or plugin.
	 *
	 * @since 1.0.0
	 * @return array Array of subscribers.
	 */
	public function get_subscribers(): array;

	/**
	 * Retrieve an array of shortcodes.
	 *
	 * Implementations should return all shortcodes registered by
	 * the theme or plugin.
	 *
	 * @since 1.0.0
	 * @return array Array of shortcodes.
	 */
	public function get_shortcodes(): array;
}
