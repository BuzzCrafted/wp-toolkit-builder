<?php
/**
 * File name: class-subscriber-registry.php
 *
 * Provides functionality for managing theme configurations and content.
 *
 * @package   Bdev
 * @subpackage ContentManagement
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  BuzzDeveloper
 * @link    https://buzzdeveloper.net
 */

namespace Bdev\ContentManagement;

use Bdev\AssetManagement\Asset_Path;
use Bdev\AssetManagement\Default_Asset_Loader;
use Bdev\AssetManagement\Subscriber\Admin\Admin_Assets_Subscriber;
use Bdev\EventManagement\Interfaces\Subscriber_Interface;
use Bdev\Settings\Sanitized_Settings;
use Bdev\Subscriber\Frontend\Frontend_Assets_Subscriber;

/**
 * Class Subscriber_Registry
 *
 * Registers and manages theme subscribers for WordPress assets.
 *
 * @since 1.0.0
 */
class Subscriber_Registry {

	/**
	 * Array of registered subscribers.
	 *
	 * @var Subscriber_Interface[]
	 */
	private array $subscribers = array();

	/**
	 * Registers subscribers based on provided settings.
	 *
	 * @param array<string, array<string, Subscriber_Interface>> $subscribers Associative array of subscriber settings.
	 * @param Sanitized_Settings                                 $settings    The sanitized settings instance.
	 * @return void
	 */
	public function register_subscribers( array $subscribers, Sanitized_Settings $settings ): void {
		foreach ( $subscribers as $setting => $options ) {
			foreach ( $options as $option => $subscriber ) {
				if ( $settings->has_support( $setting, $option ) ) {
					try {
						$this->add_subscriber( $subscriber );
					} catch ( \TypeError $th ) {
						// TODO: implement error handling.
						$error = $th->getMessage();
					}
				}
			}
		}
		$this->register_default_subscribers( $settings );
	}

	/**
	 * Registers default subscribers for frontend and admin assets.
	 *
	 * @param Sanitized_Settings $settings The sanitized settings instance.
	 * @return void
	 */
	private function register_default_subscribers( Sanitized_Settings $settings ): void {
		$this->subscribers = array(
			new Frontend_Assets_Subscriber(
				new Default_Asset_Loader(
					new Asset_Path( 'bundle-style', 'assets', get_stylesheet_directory(), get_stylesheet_uri() ),
					new Asset_Path( 'bundle', 'assets', get_stylesheet_directory(), get_stylesheet_uri() ),
					$settings->get_property( 'slug' ) . '-bundle',
					$settings->get_property( 'version' ),
					trailingslashit( get_stylesheet_directory() ) . 'language',
					$settings->get_property( 'slug' )
				)
			),
			new Admin_Assets_Subscriber(
				new Default_Asset_Loader(
					new Asset_Path( 'admin-style', 'assets', get_stylesheet_directory(), get_stylesheet_directory_uri() ),
					new Asset_Path( 'admin', 'assets', get_stylesheet_directory(), get_stylesheet_directory_uri() ),
					$settings->get_property( 'slug' ) . '-admin',
					$settings->get_property( 'version' ),
					trailingslashit( get_stylesheet_directory() ) . 'language',
					$settings->get_property( 'slug' )
				)
			),
		);
	}

	/**
	 * Adds an additional subscriber to the registry.
	 *
	 * @param Subscriber_Interface $subscriber The subscriber to be added.
	 * @return void
	 */
	public function add_subscriber( Subscriber_Interface $subscriber ): void {
		$this->subscribers[] = $subscriber;
	}

	/**
	 * Retrieves all registered subscribers.
	 *
	 * @return Subscriber_Interface[] Array of registered subscribers.
	 */
	public function get_subscribers(): array {
		return $this->subscribers;
	}
}
