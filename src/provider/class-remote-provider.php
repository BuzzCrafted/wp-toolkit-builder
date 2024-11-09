<?php
/**
 * Remote Provider class for accessing remote resources.
 *
 * @package    Bdev
 * @subpackage Provider
 * @since      1.0.1
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\Provider;

use Bdev\Provider\Interfaces\Provider_Interface;


/**
 * Class Remote_Provider
 *
 * Provides methods to access and read data from a remote resource.
 *
 * @since      1.0.1
 */
class Remote_Provider implements Provider_Interface {


	/**
	 * The URL of the remote resource.
	 *
	 * @var string
	 */
	protected string $resource_url;


	/**
	 * Constructor for the Remote_Provider class.
	 *
	 * Initializes the Remote_Provider with the URL of the remote resource.
	 *
	 * @since 1.0.0
	 *
	 * @param string $resource_url The URL of the remote resource.
	 */
	public function __construct( string $resource_url ) {
		$this->resource_url = $resource_url;
	}

	/**
	 * Reads data from the remote resource.
	 *
	 * @since 1.0.0
	 *
	 * @return array<string, mixed> The data from the remote resource.
	 */
	private function read_from_remote(): array {
		$response = wp_remote_get( $this->resource_url );

		if ( is_wp_error( $response ) ) {
			return array( 'error' => $response->get_error_message() );
		}

		$body = wp_remote_retrieve_body( $response );

		if ( empty( $body ) ) {
			return array( 'error' => 'Empty response body' );
		}

		$data = json_decode( $body, true );

		if ( json_last_error() !== JSON_ERROR_NONE ) {
			return array( 'error' => json_last_error_msg() );
		}

		return $data;
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
		return $this->read_from_remote();
	}
}
