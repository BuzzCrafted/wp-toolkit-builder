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
 * @author     BuzzDeveloper
 */

namespace Bdev\ContentManagement\Interfaces;

/**
 * Interface Content_Configuration_Interface
 *
 * Specifies methods for retrieving configuration data related to subscribers, shortcodes, and theme settings.
 *
 * @since 1.0.0
 */
interface Theme_Content_Configuration_Interface {

	/**
	 * Retrieve configuration options for event subscribers.
	 *
	 * @since 1.0.0
	 * @return array Array of event subscriber options.
	 */
	public function get_event_subscribers(): array;

	/**
	 * Retrieve configuration options for shortcodes.
	 *
	 * @since 1.0.0
	 * @return array Array of shortcode configuration options.
	 */
	public function get_shortcode_config(): array;

	/**
	 * Retrieve configuration options for theme settings.
	 *
	 * @since 1.0.0
	 * @return array Array of theme settings options.
	 */
	public function get_theme_settings(): array;
}
