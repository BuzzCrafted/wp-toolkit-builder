<?php
/**
 * File name: class-base-asset-subscriber.php
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

namespace Bdev\Subscriber;

use Bdev\AssetManagement\Interfaces\Asset_Loader_Interface;
use Bdev\EventManagement\Interfaces\Subscriber_Interface;

/**
 * Class Base_Assets_Subscriber
 *
 * Provides base functionality for managing WordPress assets such as styles and scripts.
 * Implements the Subscriber_Interface to allow for event subscriptions.
 *
 * @since 1.0.0
 */
abstract class Base_Assets_Subscriber implements Subscriber_Interface {

	/**
	 * Asset loader instance used to register styles and scripts.
	 *
	 * @var Asset_Loader_Interface
	 */
	protected Asset_Loader_Interface $asset_loader;

	/**
	 * Constructor
	 *
	 * Initializes the Base_Assets_Subscriber with an instance of Asset_Loader_Interface.
	 *
	 * @since 1.0.0
	 *
	 * @param Asset_Loader_Interface $asset_loader Instance of asset loader used for managing assets.
	 */
	public function __construct( Asset_Loader_Interface $asset_loader ) {
		$this->asset_loader = $asset_loader;
	}

	/**
	 * Register the assets.
	 *
	 * Calls the asset loader to register both styles and scripts for WordPress.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function manage_assets(): void {
		$this->asset_loader->register_styles();
		$this->asset_loader->register_scripts();
	}
}
