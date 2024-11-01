<?php
/**
 * Settings_Validator
 *
 * Provides functionality for validating WordPress settings based on predefined rulesets.
 *
 * @package    Bdev
 * @subpackage Validator
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 */

namespace Bdev\Validator;

use Bdev\Validator\Interfaces\Validator_Interface;

/**
 * Class Settings_Validator
 *
 * Validates provided settings against a set of predefined rules.
 * Ensures that all settings and their options conform to the allowed structure.
 *
 * @since 1.0.0
 */
class Settings_Validator implements Validator_Interface {

	/**
	 * Key for settings within the ruleset.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private const SETTINGS_KEY = 'settings';

	/**
	 * Ruleset array containing all validation rules.
	 *
	 * @since 1.0.0
	 * @var array<int|string, array<string, mixed>|string>
	 */
	private array $ruleset;

	/**
	 * Indicates whether the ruleset has been validated and is ready.
	 *
	 * @since 1.0.0
	 * @var bool
	 */
	private bool $is_valid = false;

	/**
	 * Constructor
	 *
	 * Initializes the validator with a ruleset and validates it.
	 *
	 * @since 1.0.0
	 * @param array<int|string, array<string, mixed>|string> $ruleset Array containing the validation rules.
	 */
	public function __construct( array $ruleset ) {
		$this->ruleset = $ruleset;
		$this->check_rules();
	}

	/**
	 * Validates the ruleset and sets the readiness flag.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function check_rules(): void {
		$this->set_ready( true );
	}

	/**
	 * Retrieve all root-level rules from the ruleset.
	 *
	 * @since 1.0.0
	 * @return array<string> Array of root-level rule names.
	 */
	private function get_all_root_rules(): array {
		$roots = array();
		if ( $this->is_ready() ) {
			foreach ( $this->ruleset as $rule_name => $rule ) {
				if ( ( self::SETTINGS_KEY !== $rule_name ) && is_string( $rule ) ) {
					$roots[] = $rule;
				}
			}
		}

		return $roots;
	}

	/**
	 * Retrieve all setting rules from the ruleset.
	 *
	 * @since 1.0.0
	 * @return array<int, int|string> Array of setting names defined in the ruleset.
	 */
	private function get_all_settings_rules(): array {
		if ( $this->is_ready() && isset( $this->ruleset[ self::SETTINGS_KEY ] ) ) {
			return array_keys( (array) $this->ruleset[ self::SETTINGS_KEY ] );
		}

		return array();
	}

	/**
	 * Retrieve all option rules for a specific setting.
	 *
	 * @since 1.0.0
	 * @param string $setting_name The name of the setting.
	 * @return array<string, mixed> Array of options defined for the given setting.
	 */
	private function get_all_options_rules( string $setting_name ): array {
		if ( $this->is_ready()
			&& isset( $this->ruleset[ self::SETTINGS_KEY ] )
			&& isset( $this->ruleset[ self::SETTINGS_KEY ][ $setting_name ] ) ) {
			return array_map(
				fn( $option ) => is_string( $option ) ? $option : ( is_scalar( $option ) ? strval( $option ) : '' ),
				(array) $this->ruleset[ self::SETTINGS_KEY ][ $setting_name ],
			);
		}

		return array();
	}

	/**
	 * Check if the ruleset is ready and validated.
	 *
	 * @since 1.0.0
	 * @return bool True if the ruleset is ready, false otherwise.
	 */
	public function is_ready(): bool {
		return $this->is_valid;
	}

	/**
	 * Set the readiness state of the ruleset.
	 *
	 * @since 1.0.0
	 * @param bool $state True to set the ruleset as ready, false otherwise.
	 * @return void
	 */
	public function set_ready( bool $state ): void {
		$this->is_valid = $state;
	}

	/**
	 * Checks if the given setting is allowed.
	 *
	 * @param string $name  The name of the setting.
	 * @param mixed  $value The value of the setting.
	 * @return bool True if the setting is allowed, false otherwise.
	 */
	public function is_allowed( string $name, mixed $value ): bool {
		if ( ! $this->is_ready() ) {
			return false;
		}

		if ( self::SETTINGS_KEY === $name ) {
			if ( is_array( $value ) ) {
				foreach ( $value as $setting_name => $settings ) {
					if ( ! in_array( $setting_name, $this->get_all_settings_rules(), true ) ) {
						return false;
					}
					if ( is_array( $settings ) ) {
						foreach ( $settings as $setting => $setting_value ) {
							if ( ! in_array( $setting, $this->get_all_options_rules( $setting_name ), true ) ) {
								return false;
							}
						}
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
			return in_array( $name, $this->get_all_root_rules(), true );
		}

		return true;
	}
}
