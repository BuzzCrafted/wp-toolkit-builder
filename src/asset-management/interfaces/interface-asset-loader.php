<?php
/**
 * File name: interface-asset-loader.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @package    Bdev
 * @subpackage AssetManagement
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024 BuzzDeveloper
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\AssetManagement\Interfaces;

/**
 * Interface Asset_Loader_Interface
 *
 * Provides methods for registering and enqueuing styles and scripts for a WordPress theme or plugin.
 *
 * This interface defines the essential methods that any asset loader should implement
 * to ensure styles and scripts are properly enqueued or registered, promoting consistent
 * asset management across the theme or plugin.
 *
 * @since 1.0.0
 */
interface Asset_Loader_Interface {
	/**
	 * Registers styles.
	 */
	public function register_styles(): void;

	/**
	 * Registers scripts.
	 */
	public function register_scripts(): void;
}
