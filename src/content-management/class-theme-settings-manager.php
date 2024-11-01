<?php
/**
 * File name: class-theme-settings-manager.php
 *
 * Provides functionality for managing theme configurations and content.
 *
 * @package   Bdev
 * @subpackage ContentManagement
 * @since 1.0.0
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  BuzzDeveloper
 * @link    https://buzzdeveloper.net
 */

namespace Bdev\ContentManagement;

use Bdev\Settings\Sanitized_Settings;
use Bdev\Provider\JSON_Provider;
use Bdev\Validator\Settings_Validator;

/**
 * Class Theme_Settings_Manager
 *
 * Manages theme settings using JSONProvider and validates them using SettingsValidator.
 *
 * @since 1.0.0
 */
class Theme_Settings_Manager {

	/**
	 * Load and validate theme settings.
	 *
	 * @param string                                         $file_path Path to the JSON configuration file.
	 * @param array<int|string, array<string, mixed>|string> $ruleset   Validation ruleset for the settings.
	 * @return Sanitized_Settings The sanitized settings instance.
	 */
	public function load_settings( string $file_path, array $ruleset ): Sanitized_Settings {
		return new Sanitized_Settings(
			new JSON_Provider( $file_path ),
			new Settings_Validator( $ruleset )
		);
	}
}
