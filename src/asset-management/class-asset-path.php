<?php
/**
 * File name: class-asset-path.php
 *
 * Provides functionality for managing asset paths.
 *
 * @package    Bdev
 * @subpackage AssetManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\AssetManagement;

/**
 * Class Asset_Path
 *
 * Provides functionality to create paths and URLs for different plugin or theme resources.
 *
 * This class helps to construct paths and URLs for various assets such as JavaScript and CSS files,
 * ensuring consistency across the plugin or theme.
 *
 * @since 1.0.0
 */
class Asset_Path {

	/**
	 * The resource name.
	 *
	 * @var string
	 */
	private string $name;

	/**
	 * The base directory name for the assets.
	 *
	 * @var string
	 */
	private string $base_dir_name;

	/**
	 * Path to the asset root directory.
	 *
	 * @var string
	 */
	private string $path_to_asset;

	/**
	 * URL to the asset root directory.
	 *
	 * @var string
	 */
	private string $url_to_asset;


	/**
	 * Asset_Path constructor.
	 *
	 * Initializes the Asset_Path object with the provided parameters.
	 *
	 * @param string $name          The resource name.
	 * @param string $base_dir_name The base directory name for the assets.
	 * @param string $path_to_asset Path to the asset root directory.
	 * @param string $url_to_asset  URL to the asset root directory.
	 */
	public function __construct( string $name = 'index', string $base_dir_name = 'assets', string $path_to_asset = '', string $url_to_asset = '' ) {
		$this->name          = $name;
		$this->base_dir_name = $base_dir_name;
		$this->path_to_asset = $path_to_asset;
		$this->url_to_asset  = $url_to_asset;
	}

	/**
	 * Get the full file path for the specified asset type.
	 *
	 * Constructs the full path to the asset based on the provided type and minification flag.
	 *
	 * @param string $type        The asset type (e.g., 'css', 'js').
	 * @param bool   $is_minified Whether the asset is minified.
	 * @return string Full path to the asset file.
	 */
	public function get_full_filename( string $type, bool $is_minified = false ): string {
		return trailingslashit( $this->path_to_asset ) . $this->get_asset_dir( $type ) . $this->get_asset_filename( $type, $is_minified );
	}

	/**
	 * Get the full URL for the specified asset type.
	 *
	 * Constructs the URL for the asset based on the provided type and minification flag.
	 *
	 * @param string $type        The asset type (e.g., 'css', 'js').
	 * @param bool   $is_minified Whether the asset is minified.
	 * @return string Full URL to the asset file.
	 */
	public function get_url( string $type, bool $is_minified = false ): string {
		return trailingslashit( $this->url_to_asset ) . $this->get_asset_dir( $type ) . $this->get_asset_filename( $type, $is_minified );
	}

	/**
	 * Check if the asset file exists.
	 *
	 * Checks whether the specified asset file exists on the filesystem.
	 *
	 * @param string $type        The asset type (e.g., 'css', 'js').
	 * @param bool   $is_minified Whether the asset is minified.
	 * @return bool True if the asset file exists, false otherwise.
	 */
	public function exists( string $type, bool $is_minified = false ): bool {
		return file_exists( $this->get_full_filename( $type, $is_minified ) );
	}

	/**
	 * Get the filename for the specified asset type.
	 *
	 * Constructs the filename for the asset, including the type and minification suffix if applicable.
	 *
	 * @param string $type        The asset type (e.g., 'css', 'js').
	 * @param bool   $is_minified Whether the asset is minified.
	 * @return string Asset filename.
	 */
	protected function get_asset_filename( string $type, bool $is_minified ): string {
		return $this->name . $this->get_asset_suffix( $type, $is_minified ) . '.' . $type;
	}

	/**
	 * Get the suffix for the asset filename.
	 *
	 * Generates the appropriate suffix for the filename based on the type and whether the file is minified.
	 *
	 * @param string $type        The asset type (e.g., 'css', 'js').
	 * @param bool   $is_minified Whether the asset is minified.
	 * @return string Suffix to append to the asset filename.
	 */
	protected function get_asset_suffix( string $type, bool $is_minified ): string {
		return ( $is_minified ? '.min' : '' ) . ( 'php' === $type ? '.asset' : '' );
	}

	/**
	 * Get the directory for the specified asset type.
	 *
	 * Determines the appropriate subdirectory for the given asset type (e.g., 'scripts', 'css').
	 *
	 * @param string $type Asset type (e.g., 'css', 'js').
	 * @return string Directory path for the asset type.
	 */
	protected function get_asset_dir( string $type ): string {
		$subdirs = array(
			'php' => '/scripts',
			'js'  => '/scripts',
			'css' => '/css',
			'jpg' => '/img',
		);
		return trailingslashit( $this->base_dir_name . ( isset( $subdirs[ $type ] ) ? $subdirs[ $type ] : '' ) );
	}
}
