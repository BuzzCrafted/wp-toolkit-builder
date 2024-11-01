<?php
/**
 * File name: class-default-asset-loader.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @package    Bdev
 * @subpackage AssetManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @autor      BuzzDeveloper
 * @copyright  2024
 */

namespace Bdev\AssetManagement;

use Bdev\AssetManagement\Asset_Meta;
use Bdev\AssetManagement\Asset_Path;
use Bdev\AssetManagement\Interfaces\Asset_Loader_Interface;

/**
 * Class Default_Asset_Loader
 *
 * Implements Asset_Loader_Interface to register and enqueue styles and scripts
 * using provided paths, names, and versioning.
 *
 * @since 1.0.0
 */
class Default_Asset_Loader implements Asset_Loader_Interface {

	/**
	 * Path to the stylesheet asset.
	 *
	 * @var Asset_Path
	 */
	private Asset_Path $style_path;

	/**
	 * Path to the script asset.
	 *
	 * @var Asset_Path
	 */
	private Asset_Path $script_path;

	/**
	 * Asset name.
	 *
	 * @var string
	 */
	private string $asset_name;

	/**
	 * Asset version.
	 *
	 * @var string
	 */
	private string $asset_version;

	/**
	 * Path to the language directory for translations.
	 *
	 * @var string
	 */
	private string $lang_path;

	/**
	 * Text domain for asset translation.
	 *
	 * @var string
	 */
	private string $asset_domain;

	/**
	 * Constructor.
	 *
	 * Initializes the asset loader with style and script paths, asset information, and translation settings.
	 *
	 * @param Asset_Path $style_path    Path to the style asset.
	 * @param Asset_Path $script_path   Path to the script asset.
	 * @param string     $asset_name    Unique name for the asset.
	 * @param string     $asset_version Version identifier for the asset.
	 * @param string     $lang_path     Path to the language directory for translations.
	 * @param string     $asset_domain  Text domain for translation. Default is 'default'.
	 */
	public function __construct(
		Asset_Path $style_path,
		Asset_Path $script_path,
		string $asset_name,
		string $asset_version,
		string $lang_path,
		string $asset_domain = 'default'
	) {
		$this->style_path    = $style_path;
		$this->script_path   = $script_path;
		$this->asset_name    = $asset_name;
		$this->asset_version = $asset_version;
		$this->lang_path     = $lang_path;
		$this->asset_domain  = $asset_domain;
	}

	/**
	 * Register and enqueue styles.
	 *
	 * Checks if the specified style file exists, then registers and enqueues it using the WordPress style API.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_styles(): void {
		if ( $this->style_path->exists( 'css', true ) ) {
			wp_enqueue_style(
				$this->asset_name,
				$this->style_path->get_url( 'css', true ),
				array(),
				$this->asset_version,
				'all'
			);
		}
	}

	/**
	 * Register and enqueue scripts.
	 *
	 * Checks if the specified script file exists, then registers and enqueues it using the WordPress script API.
	 * Attempts to load dependencies and versioning from an associated PHP metadata file. If this fails, a
	 * default set of dependencies is applied.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_scripts(): void {
		if ( $this->script_path->exists( 'js', true ) ) {
			try {
				$assets = ( new Asset_Meta( $this->script_path->get_full_filename( 'php', true ) ) )->get_assets();
			} catch ( \Error $e ) {
				$assets = array(
					'dependencies' => array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-i18n' ),
					'version'      => $this->asset_version,
				);
			}
			$assets['dependencies'] = array_merge( (array) $assets['dependencies'], array( 'wp-api' ) );
			// Ensure dependencies are strings.
			$dependencies = array_map(
				function ( $dep ) {
					return is_scalar( $dep ) ? strval( $dep ) : '';
				},
				(array) $assets['dependencies']
			);

			wp_enqueue_script(
				$this->asset_name,
				$this->script_path->get_url( 'js', true ),
				$dependencies,
				is_string( $assets['version'] ) ? $assets['version'] : $this->asset_version,
				true
			);

			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations(
					$this->asset_name,
					$this->asset_domain,
					$this->lang_path
				);
			}
		}
	}
}
