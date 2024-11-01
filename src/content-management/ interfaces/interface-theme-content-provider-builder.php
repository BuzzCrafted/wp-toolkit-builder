<?php
/**
 * Theme_Content_Provider_Builder_Interface
 *
 * Defines the builder interface for constructing Theme_Content_Provider instances.
 *
 * @package    Bdev
 * @subpackage ContentManagement
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper
 */

namespace Bdev\ContentManagement\Interfaces;

use Bdev\ContentManagement\Theme_Content_Provider;
use Bdev\ContentManagement\Interfaces\Theme_Content_Configuration_Interface;

/**
 * Interface Theme_Content_Provider_Builder_Interface
 *
 * Specifies methods for building a Theme_Content_Provider.
 *
 * @since 1.0.0
 */
interface Theme_Content_Provider_Builder_Interface {

	/**
	 * Set the theme content configurator.
	 *
	 * @since 1.0.0
	 * @param Theme_Content_Configuration_Interface $configurator The content configurator instance.
	 * @return Content_Provider_Builder_Interface
	 */
	public function set_theme_content_configurator( Theme_Content_Configuration_Interface $configurator ): self;

	/**
	 * Build and return an instance of Theme_Content_Provider.
	 *
	 * @since 1.0.0
	 * @return Theme_Content_Provider
	 */
	public function build(): Theme_Content_Provider;
}
