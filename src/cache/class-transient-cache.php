<?php
/**
 * Transient Cache Implementation
 *
 * This file contains the Transient_Cache class which implements caching using WordPress transients.
 *
 * @package   Bdev
 * @subpackage Cache
 * @since 1.0.2
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  BuzzDeveloper
 */

namespace Bdev\Cache;

use Bdev\Cache\Interfaces\Cache_Interface;

/**
 * Transient_Cache class
 *
 * Implements caching using WordPress transients.
 */
class Transient_Cache implements Cache_Interface {

	/**
	 * Check whether data accociated with a key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return boolean
	 */
	public function is_cached( string $key ): bool {
		return get_transient( $key ) ? true : false;
	}

	/**
	 * Store data in the cache
	 *
	 * @param string $key The key associated with the cached data.
	 * @param mixed  $data The data to be cached.
	 * @param int    $expiration The expiration time in seconds.
	 * @return Cache_Interface
	 */
	public function store( string $key, mixed $data, int $expiration = 0 ): Cache_Interface {
		set_transient( $key, $data, $expiration );
		return $this;
	}

	/**
	 * Retrieve cached data by its key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return mixed
	 */
	public function retrieve( string $key ): mixed {
		return get_transient( $key );
	}

	/**
	 * Retrieve all cached data
	 *
	 * @return array<string, mixed>
	 */
	public function retrieve_all(): array {
		return array();
	}

	/**
	 * Erase cached entry by its key
	 *
	 * @param string $key The key associated with the cached data.
	 * @return Cache_Interface
	 */
	public function erase( string $key ): Cache_Interface {
		delete_transient( $key );
		return $this;
	}

	/**
	 * Erase all expired entries
	 *
	 * @return int
	 */
	public function erase_expired(): int {
		return 0;
	}

	/**
	 * Erase all cached entries
	 *
	 * @return Cache_Interface
	 */
	public function erase_all(): Cache_Interface {
		return $this;
	}
}