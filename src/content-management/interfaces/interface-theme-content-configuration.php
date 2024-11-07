<?php
/**
 * Content_Configuration_Interface
 *
 * Provides access to configuration options for theme-related subscribers, shortcodes, and settings.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 */

namespace Bdev\ContentManagement\Interfaces;

use Bdev\EventManagement\Interfaces\Subscriber_Interface;
use Bdev\Shortcodes\Interfaces\Shortcode_Interface;

/**
 * Interface Theme_Content_Configuration_Interface
 *
 * Specifies methods for retrieving configuration data related to subscribers, shortcodes, and theme settings.
 *
 * @since 1.0.0
 */
interface Theme_Content_Configuration_Interface {

	/**
	 * Retrieve an array of event subscribers.
	 *
	 * Implementations should return all event or action subscribers
	 * associated with the theme.
	 *
	 * @since 1.0.0
	 * @return array<string, Subscriber_Interface> Array of event subscribers.
	 */
	public function get_event_subscribers(): array;

	/**
	 * Retrieve an array of shortcode configurations.
	 *
	 * Implementations should return all shortcode configurations
	 * associated with the theme.
	 *
	 * @since 1.0.0
	 * @return array<string, Shortcode_Interface> Array of shortcode configurations.
	 */
	public function get_shortcode_config(): array;

	/**
	 * Retrieve an array of theme settings.
	 *
	 * Implementations should return all theme settings
	 * associated with the theme.
	 *
	 * @since 1.0.0
	 * @return array<string, mixed> Array of theme settings.
	 */
	public function get_theme_settings(): array;
}
