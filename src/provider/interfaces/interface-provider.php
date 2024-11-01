<?php
/**
 * File name: interface-provider.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @package   Bdev
 * @subpackage Various
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @link    https://buzzdeveloper.net
 * @author  BuzzDeveloper
 */

namespace Bdev\Provider\Interfaces;

/**
 * Interface Provider_Interface
 *
 * Represents a data provider that offers a method to retrieve data.
 * Classes implementing this interface should provide specific data-fetching logic.
 *
 * @since 1.0.0
 */
interface Provider_Interface {

	/**
	 * Retrieve data from the provider.
	 *
	 * Implementations should define how data is fetched, which may involve
	 * database queries, external API requests, or other sources.
	 *
	 * @since 1.0.0
	 * @return array<string, mixed> An array of data.
	 */
	public function get_data(): array;
}
