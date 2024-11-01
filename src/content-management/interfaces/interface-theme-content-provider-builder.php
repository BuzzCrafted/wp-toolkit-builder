<?php
/**
 * File name: interface-theme-content-provider-builder.php
 *
 * Provides an interface for building theme content providers.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\ContentManagement;

use Bdev\ContentManagement\Interfaces\Theme_Content_Configuration_Interface;

interface Theme_Content_Provider_Builder_Interface {
	/**
	 * Set the theme content configurator.
	 *
	 * @param Theme_Content_Configuration_Interface $configurator The theme content configurator.
	 * @return Theme_Content_Provider_Builder_Interface
	 */
	public function set_theme_content_configurator( Theme_Content_Configuration_Interface $configurator ): self;

	/**
	 * Build and retrieve the Theme_Content_Provider instance.
	 *
	 * @return Theme_Content_Provider
	 */
	public function build(): Theme_Content_Provider;
}
