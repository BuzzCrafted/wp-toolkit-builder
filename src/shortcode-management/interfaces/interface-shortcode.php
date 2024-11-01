<?php
/**
 * Shortcode_Interface
 *
 * Defines a contract for shortcode handlers, specifying required methods
 * for retrieving shortcode tag and handler.
 *
 * @package   Bdev
 * @subpackage Shortcode
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  BuzzDeveloper
 */

namespace Bdev\Shortcodes\Interfaces;

/**
 * Interface Shortcode_Interface
 *
 * Provides a structure for managing shortcodes with methods for
 * retrieving a shortcode tag and its handler.
 *
 * @since 1.0.0
 */
interface Shortcode_Interface {

	/**
	 * Retrieve the shortcode tag.
	 *
	 * @return string The unique tag for the shortcode.
	 */
	public function get_tag(): string;

	/**
	 * Retrieve the shortcode handler function name or callable.
	 *
	 * @return callable The handler associated with the shortcode.
	 */
	public function get_handler(): callable;
}
