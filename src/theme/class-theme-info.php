<?php
/**
 * Theme Info Class
 *
 * Provides theme information by implementing WP_Info_Interface.
 *
 * @package    Bdev
 * @subpackage Theme
 * @since      1.0.1
 * @version    1.0.0
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\Theme;

use Bdev\Settings\Interfaces\WP_Info_Interface;

/**
 * Class Theme_Info
 *
 * Implements WP_Info_Interface to provide theme information.
 */
class Theme_Info implements WP_Info_Interface {

	/**
	 * Get the theme version.
	 *
	 * @return string
	 */
	public function get_version(): string {
		$theme = wp_get_theme();
		return $theme->get( 'Version' );
	}

	/**
	 * Get the required WordPress version.
	 *
	 * @return string
	 */
	public function get_requires(): string {

		return get_bloginfo( 'version' );
	}

	/**
	 * Get the required PHP version.
	 *
	 * @return string
	 */
	public function get_requires_php(): string {
		return PHP_VERSION;
	}
}
