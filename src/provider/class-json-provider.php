<?php
/**
 * File name: class-json-provider.php
 *
 * Provides functionality for reading data from JSON files.
 *
 * @package    Bdev
 * @subpackage Provider
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\Provider;

use Bdev\Provider\Interfaces\Provider_Interface;

/**
 * Class JSON_Provider
 *
 * Reads JSON data from a given file and provides it in array format.
 *
 * @since 1.0.0
 */
class JSON_Provider implements Provider_Interface {

	/**
	 * Path to the JSON file.
	 *
	 * @var string
	 */
	protected string $filename;

	/**
	 * Constructor
	 *
	 * Initializes the JSON_Provider with a file path.
	 *
	 * @since 1.0.0
	 *
	 * @param string $filename Path to the JSON file.
	 */
	public function __construct( string $filename ) {
		$this->filename = $filename;
	}

	/**
	 * Read data from the JSON file.
	 *
	 * This method reads the content of the provided JSON file and returns it as an array.
	 * If the file does not exist or cannot be decoded properly, it returns an empty array.
	 *
	 * @since 1.0.0
	 *
	 * @return array<string, mixed> Decoded content of the JSON file.
	 */
	private function read_from_file(): array {
		$content = array();

		if ( ! empty( $this->filename ) && file_exists( $this->filename ) ) {
			$decoded_file = wp_json_file_decode( $this->filename, array( 'associative' => true ) );

			if ( is_array( $decoded_file ) ) {
				$content = $decoded_file;
			}
		}

		return $content;
	}

	/**
	 * Get data from the JSON file.
	 *
	 * Provides the decoded JSON data as an associative array.
	 *
	 * @since 1.0.0
	 *
	 * @return array<string, mixed> The JSON data as an associative array.
	 */
	public function get_data(): array {
		return $this->read_from_file();
	}
}
