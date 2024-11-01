<?php
/**
 * File name: class-asset-meta.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @packageBdev
 * @subpackage Various
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @link    https://buzzdeveloper.net
 * @author  BuzzDeveloper
 */

namespace Bdev\AssetManagement;

/**
 * Class Asset_Meta
 *
 * Retrieves asset metadata, such as dependencies and version, from specified files.
 *
 * @since 1.0.0
 */
class Asset_Meta {

	/**
	 * Path to the metadata file.
	 *
	 * @var string
	 */
	private string $file_path;

	/**
	 * Constructor
	 *
	 * Initializes the Asset_Meta object with the path to the metadata file.
	 *
	 * @param string $file_path Path to the metadata file.
	 */
	public function __construct( string $file_path ) {
		$this->file_path = $file_path;
	}

	/**
	 * Retrieve asset metadata.
	 *
	 * Reads metadata from the file path provided during initialization. Metadata typically
	 * includes dependencies and versioning information required for WordPress to properly
	 * enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 * @throws \RuntimeException If the file cannot be read.
	 * @return array Associative array containing 'dependencies' and 'version'.
	 */
	public function get_assets(): array {
		if ( ! is_readable( $this->file_path ) ) {
			throw new \RuntimeException( \esc_html( sprintf( 'Asset metadata file %s is not readable.', $this->file_path ) ) );
		}

		$assets = include $this->file_path;

		if ( ! is_array( $assets ) || ! isset( $assets['dependencies'], $assets['version'] ) ) {
			throw new \RuntimeException( \esc_html( sprintf( 'Asset metadata file %s is not valid.', $this->file_path ) ) );
		}

		return $assets;
	}

	/**
	 * Check if metadata file exists and is readable.
	 *
	 * This method can be used to verify if the specified metadata file is available and can be read.
	 *
	 * @since 1.0.0
	 * @return bool True if the metadata file is readable, false otherwise.
	 */
	public function is_valid(): bool {
		return is_readable( $this->file_path );
	}
}
