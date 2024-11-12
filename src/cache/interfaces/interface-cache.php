<?php
/**
 * Interface Cache
 *
 * This interface defines the contract for caching mechanisms used in the application.
 * Implementations of this interface should provide methods to store, retrieve, and manage cached data.
 *
 * @package   Bdev
 * @subpackage Cache
 * @since 1.0.2
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  BuzzDeveloper
 */

namespace Bdev\Cache\Interfaces;

/**
 * Interface for cache operations.
 *
 * @since 1.0.2
 */
interface Cache_Interface {

	/**
	 * Check whether data accociated with a key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return boolean
	 */
	public function is_cached( string $key ): bool;

	/**
	 * Store data in the cache
	 *
	 * @param string $key The key associated with the cached data.
	 * @param mixed  $data The data to be cached.
	 * @param int    $expiration The expiration time in seconds.
	 * @return Cache_Interface
	 */
	public function store( string $key, mixed $data, int $expiration = 0 ): Cache_Interface;

	/**
	 * Retrieve cached data by its key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return mixed
	 */
	public function retrieve( string $key ): mixed;

	/**
	 * Retrieve all cached data
	 *
	 * @return array<string, mixed>
	 */
	public function retrieve_all(): array;

	/**
	 * Erase cached entry by its key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return Cache_Interface
	 */
	public function erase( string $key ): Cache_Interface;

	/**
	 * Erase all expired entries
	 *
	 * @return int
	 */
	public function erase_expired(): int;

	/**
	 * Erase all cached entries
	 *
	 * @return Cache_Interface
	 */
	public function erase_all(): Cache_Interface;
}
