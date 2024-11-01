<?php
/**
 * File name: class-shortcode-registry.php
 *
 * Provides functionality for managing theme shortcodes within the WordPress environment.
 * It includes methods for registering, adding, and retrieving shortcodes.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 */

namespace Bdev\ContentManagement;

use Bdev\Settings\Sanitized_Settings;
use Bdev\Shortcodes\Interfaces\Shortcode_Interface;

/**
 * Class Shortcode_Registry
 *
 * Provides methods to manage theme shortcodes, including registration, adding, and retrieving shortcodes.
 *
 * @since 1.0.0
 */
class Shortcode_Registry {

	/**
	 * Array of registered shortcodes.
	 *
	 * Stores all shortcodes that are registered by the theme.
	 *
	 * @since 1.0.0
	 * @var Shortcode_Interface[]
	 */
	private array $shortcodes = array();

	/**
	 * Register shortcodes based on theme settings.
	 *
	 * Registers shortcodes defined by the provided settings. Only registers
	 * shortcodes if the corresponding setting and option are supported.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string, array<string, Shortcode_Interface>> $shortcodes Array of shortcodes to register.
	 * @param Sanitized_Settings                                $settings   Sanitized settings instance for validation.
	 * @return void
	 */
	public function register_shortcodes( array $shortcodes, Sanitized_Settings $settings ): void {
		foreach ( $shortcodes as $setting => $options ) {
			foreach ( $options as $option => $shortcode ) {
				if ( $settings->has_support( $setting, $option ) ) {
					try {
						$this->add_shortcode( $shortcode );
					} catch ( \TypeError $th ) {
						// TODO: implement error handling.
						$error = $th->getMessage();
					}
				}
			}
		}
		$this->register_default_shortcodes();
	}

	/**
	 * Register default shortcodes.
	 *
	 * Registers any default shortcodes required by the theme.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function register_default_shortcodes(): void {
		// TODO: Implement registration of default shortcodes.
	}

	/**
	 * Add a shortcode to the registry.
	 *
	 * Adds a new shortcode to the internal shortcode registry.
	 *
	 * @since 1.0.0
	 *
	 * @param Shortcode_Interface $shortcode The shortcode to add.
	 * @return void
	 */
	public function add_shortcode( Shortcode_Interface $shortcode ): void {
		$this->shortcodes[] = $shortcode;
	}

	/**
	 * Retrieve the registered shortcodes.
	 *
	 * Retrieves all shortcodes that have been added to the registry.
	 *
	 * @since 1.0.0
	 * @return Shortcode_Interface[] Array of registered shortcodes.
	 */
	public function get_shortcodes(): array {
		return $this->shortcodes;
	}
}
