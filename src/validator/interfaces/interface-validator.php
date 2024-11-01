<?php
/**
 * Validator_Interface
 *
 * Defines the contract for validating key/value pairs in the WordPress environment.
 *
 * @package    Bdev
 * @subpackage Validator
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 */

namespace Bdev\Validator\Interfaces;

/**
 * Interface Validator_Interface
 *
 * Represents a validator that checks whether specific key/value pairs meet defined criteria.
 *
 * @since 1.0.0
 */
interface Validator_Interface {

	/**
	 * Check if the provided key/value pair is allowed.
	 *
	 * Determines if the given key and its associated value satisfy validation rules.
	 *
	 * @since 1.0.0
	 *
	 * @since 1.0.0
	 * @param string $name  The name of the key being checked.
	 * @param mixed  $value The value associated with the key being checked.
	 * @return bool True if the key/value pair is allowed, false otherwise.
	 */
	public function is_allowed( string $name, mixed $value ): bool;
}
