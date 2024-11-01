<?php
/**
 * Theme_Loader Class
 *
 * This file contains the Theme_Loader class, which is responsible for loading
 * and initializing a WordPress theme, including registering event subscribers
 * and shortcodes. It ensures the theme is fully prepared for the WordPress
 * environment by utilizing Event_Manager and Shortcode_Manager services.
 *
 * @package    Bdev
 * @subpackage Theme
 * @since      1.0.0
 * @version    1.0.0
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\Theme;

use Bdev\ContentManagement\Interfaces\Content_Data_Interface;
use Bdev\EventManagement\Event_Manager;
use Bdev\Shortcodes\Shortcode_Manager;

/**
 * Class Theme_Loader
 *
 * Loads and initializes the WordPress theme, including subscribers and shortcodes.
 *
 * @since 1.0.0
 */
class Theme_Loader {

	/**
	 * Event manager instance for managing theme events.
	 *
	 * @var Event_Manager
	 */
	private $event_manager;

	/**
	 * Shortcode manager instance for managing shortcodes.
	 *
	 * @var Shortcode_Manager
	 */
	private $shortcode_manager;

	/**
	 * Flag to track if the theme is loaded.
	 *
	 * @var bool
	 */
	private $is_loaded = false;

	/**
	 * The theme content configurator.
	 *
	 * @var Content_Data_Interface
	 */
	private $content_data_interface;

	/**
	 * Theme_Loader constructor.
	 *
	 * Initializes the theme with the given name, configurator, event manager, and shortcode manager.
	 *
	 * @param Content_Data_Interface $content_data_interface Content configurator for theme settings.
	 * @param Event_Manager          $event_manager          Event manager for handling theme events.
	 * @param Shortcode_Manager      $shortcode_manager      Shortcode manager for handling theme shortcodes.
	 */
	public function __construct( Content_Data_Interface $content_data_interface, Event_Manager $event_manager, Shortcode_Manager $shortcode_manager ) {
		$this->content_data_interface = $content_data_interface;
		$this->event_manager          = $event_manager;
		$this->shortcode_manager      = $shortcode_manager;
	}

	/**
	 * Checks if the theme is loaded.
	 *
	 * @since 1.0.0
	 * @return bool True if the theme is loaded, false otherwise.
	 */
	public function is_loaded(): bool {
		return $this->is_loaded;
	}

	/**
	 * Load the theme into WordPress.
	 *
	 * Initializes the theme by loading subscribers and shortcodes,
	 * and sets the loaded flag to true once completed.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_theme(): void {
		if ( $this->is_loaded() ) {
			return;
		}

		$this->load_subscribers();
		$this->load_shortcodes();
		$this->is_loaded = true;
	}

	/**
	 * Load event subscribers from the content configurator.
	 *
	 * This method iterates over subscribers provided by the configurator
	 * and registers each with the event manager.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function load_subscribers(): void {
		foreach ( $this->content_data_interface->get_subscribers() as $subscriber ) {
			$this->event_manager->add_subscriber( $subscriber );
		}
	}

	/**
	 * Load shortcodes from the content configurator.
	 *
	 * This method iterates over shortcodes provided by the configurator
	 * and registers each with the shortcode manager.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function load_shortcodes(): void {
		foreach ( $this->content_data_interface->get_shortcodes() as $shortcode ) {
			$this->shortcode_manager->add_shortcode( $shortcode );
		}
	}
}
