<?php
/**
 * Theme_Factory_Interface
 *
 * Defines the abstract factory interface for creating theme-related instances.
 *
 * @package    Bdev
 * @subpackage Theme
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 */

namespace Bdev\Theme\Interfaces;

use Bdev\ContentManagement\Interfaces\Content_Data_Interface;
use Bdev\EventManagement\Event_Manager;
use Bdev\Shortcodes\Shortcode_Manager;
use Bdev\Theme\Theme_Loader;

/**
 * Interface Theme_Factory_Interface
 *
 * Specifies methods for creating theme-related instances.
 *
 * @since 1.0.0
 */
interface Theme_Factory_Interface {

	/**
	 * Create a new Content_Data_Interface instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Content_Data_Interface
	 */
	public function create_content_data(): Content_Data_Interface;

	/**
	 * Create a new Event_Manager instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Event_Manager
	 */
	public function create_event_manager(): Event_Manager;

	/**
	 * Create a new Shortcode_Manager instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Shortcode_Manager
	 */
	public function create_shortcode_manager(): Shortcode_Manager;

	/**
	 * Create a new Theme_Loader instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Theme_Loader
	 */
	public function create_theme_loader(): Theme_Loader;
}
