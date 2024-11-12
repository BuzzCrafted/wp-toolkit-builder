<?php
/**
 * Interface for retrieving WordPress information.
 *
 * @package    Bdev
 * @subpackage Settings
 * @since      1.0.1
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper
 */

namespace Bdev\Settings\Interfaces;

/**
 * Interface WP_Info_Interface
 *
 * This interface defines the methods that must be implemented to provide
 * information about a WordPress installation.
 */
interface WP_Info_Interface {

	/**
	 * Get the WordPress version.
	 *
	 * @return string
	 */
	public function get_version(): string;
	/**
	 * Get the required WordPress version.
	 *
	 * @return string
	 */
	public function get_requires(): string;
	/**
	 * Get the required PHP version.
	 *
	 * @return string
	 */
	public function get_requires_php(): string;
}
