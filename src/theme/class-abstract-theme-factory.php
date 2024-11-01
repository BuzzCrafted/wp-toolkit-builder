<?php
/**
 * Abstract_Theme_Factory Class
 *
 * Implements Theme_Factory_Interface to create instances of theme-related classes.
 *
 * @package    Bdev
 * @subpackage Theme
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper
 */

namespace Bdev\Theme;

use Bdev\ContentManagement\Interfaces\Content_Data_Interface;
use Bdev\EventManagement\Event_Manager;
use Bdev\Shortcodes\Shortcode_Manager;
use Bdev\Theme\Interfaces\Theme_Factory_Interface;

/**
 * Class Concrete_Theme_Factory
 *
 * Implements Theme_Factory_Interface to create instances of theme-related classes.
 *
 * @since 1.0.0
 */
abstract class Abstract_Theme_Factory implements Theme_Factory_Interface {

	/**
	 * Create a new Content_Data_Interface instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Content_Data_Interface
	 */
	abstract public function create_content_data(): Content_Data_Interface;

	/**
	 * Create a new Event_Manager instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Event_Manager
	 */
	public function create_event_manager(): Event_Manager {
		return new Event_Manager();
	}

	/**
	 * Create a new Shortcode_Manager instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Shortcode_Manager
	 */
	public function create_shortcode_manager(): Shortcode_Manager {
		return new Shortcode_Manager();
	}

	/**
	 * Create a new Theme_Loader instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Theme_Loader
	 */
	public function create_theme_loader(): Theme_Loader {
		$content_data_interface = $this->create_content_data();
		$event_manager          = $this->create_event_manager();
		$shortcode_manager      = $this->create_shortcode_manager();

		return new Theme_Loader( $content_data_interface, $event_manager, $shortcode_manager );
	}
}
