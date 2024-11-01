<?php
/**
 * File name: class-event-manager.php
 *
 * Provides functionality for theme, assets, and event management.
 *
 * @package    Bdev
 * @subpackage Various
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 * @author     BuzzDeveloper <dev@buzzdeveloper.net>
 * @copyright  2024
 */

namespace Bdev\EventManagement;

use Bdev\EventManagement\Interfaces\Subscriber_Interface;

/**
 * Class Event_Manager
 *
 * Manages event subscriptions, actions, and filters in WordPress.
 * Provides functionality to add, remove, and manage hook callbacks.
 *
 * @since 1.0.0
 */
class Event_Manager {

	/**
	 * Adds a callback to a specific hook in the WordPress Plugin API.
	 *
	 * Supports adding callbacks to both actions and filters.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $hook_name     WordPress Plugin API hook name.
	 * @param callable $callback      The callback function.
	 * @param int      $priority      The hook priority. Default is 10.
	 * @param int      $accepted_args Number of accepted arguments. Default is 1.
	 * @return void
	 */
	public function add_callback( string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1 ): void {
		add_filter( $hook_name, $callback, $priority, $accepted_args );
	}

	/**
	 * Adds an event subscriber.
	 *
	 * Registers all the hooks specified by the subscriber with the WordPress Plugin API.
	 *
	 * @since 1.0.0
	 *
	 * @param Subscriber_Interface $subscriber The event subscriber.
	 * @return void
	 */
	public function add_subscriber( Subscriber_Interface $subscriber ): void {
		foreach ( $subscriber->get_subscribed_events() as $hook_name => $parameters ) {
			$this->add_subscriber_callback( $subscriber, $hook_name, $parameters );
		}
	}

	/**
	 * Executes all the callbacks registered with the given hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string $action The action hook name.
	 * @param mixed  $args Arguments to pass to the hook callbacks.
	 * @return void
	 */
	public function execute( string $action, $args ): void {
		do_action( $action, $args );
	}

	/**
	 * Filters the given value by applying all the changes from the callbacks registered with the given hook.
	 *
	 * Returns the filtered value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $filter The filter hook name.
	 * @param mixed  $args   Arguments to pass to the filter callbacks.
	 * @return mixed Filtered value.
	 */
	public function filter( string $filter, $args ) {
		return apply_filters( $filter, $args );
	}

	/**
	 * Gets the name of the currently executing hook.
	 *
	 * Returns false if there is no current hook executing.
	 *
	 * @since 1.0.0
	 *
	 * @return string|bool Hook name if a hook is executing, false otherwise.
	 */
	public function get_current_hook() {
		return current_filter();
	}

	/**
	 * Checks if the given hook has the specified callback registered.
	 *
	 * Returns the callback priority or false if the callback is not registered.
	 * If no callback is provided, returns true or false indicating if there are any callbacks for the hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $hook_name The hook name.
	 * @param callable $callback  Optional. The callback function.
	 * @return bool|int True if there are callbacks, priority of the callback, or false if not found.
	 */
	public function has_callback( string $hook_name, $callback ) {
		return has_filter( $hook_name, $callback );
	}

	/**
	 * Removes a callback from the specified hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $hook_name The hook name.
	 * @param callable $callback  The callback function.
	 * @param int      $priority  The priority at which the callback was added. Default is 10.
	 * @return bool True if the callback was successfully removed, false otherwise.
	 */
	public function remove_callback( string $hook_name, callable $callback, int $priority = 10 ): bool {
		return remove_filter( $hook_name, $callback, $priority );
	}

	/**
	 * Removes an event subscriber.
	 *
	 * Unregisters all hooks that the subscriber had registered with the WordPress Plugin API.
	 *
	 * @since 1.0.0
	 *
	 * @param Subscriber_Interface $subscriber The event subscriber.
	 * @return void
	 */
	public function remove_subscriber( Subscriber_Interface $subscriber ): void {
		foreach ( $subscriber->get_subscribed_events() as $hook_name => $parameters ) {
			$this->remove_subscriber_callback( $subscriber, $hook_name, $parameters );
		}
	}

	/**
	 * Adds the subscriber's callback to a specific hook of the WordPress Plugin API.
	 *
	 * @since 1.0.0
	 *
	 * @param Subscriber_Interface $subscriber The event subscriber.
	 * @param string               $hook_name  The hook name.
	 * @param mixed                $parameters Hook parameters (callback, priority, accepted args).
	 * @return void
	 */
	private function add_subscriber_callback( Subscriber_Interface $subscriber, string $hook_name, $parameters ): void {
		if ( is_string( $parameters ) ) {
			$this->add_callback( $hook_name, $this->make_callable( array( $subscriber, $parameters ) ) );
		} elseif ( is_array( $parameters ) && isset( $parameters[0] ) ) {
			$this->add_callback( $hook_name, $this->make_callable( array( $subscriber, $parameters[0] ) ), $parameters[1] ?? 10, $parameters[2] ?? 1 );
		}
	}

	/**
	 * Removes the subscriber's callback from a specific hook of the WordPress Plugin API.
	 *
	 * @since 1.0.0
	 *
	 * @param Subscriber_Interface $subscriber The event subscriber.
	 * @param string               $hook_name  The hook name.
	 * @param mixed                $parameters Hook parameters (callback, priority).
	 * @return void
	 */
	private function remove_subscriber_callback( Subscriber_Interface $subscriber, string $hook_name, $parameters ): void {
		if ( is_string( $parameters ) ) {
			$this->remove_callback( $hook_name, $this->make_callable( array( $subscriber, $parameters ) ) );
		} elseif ( is_array( $parameters ) && isset( $parameters[0] ) ) {
			$this->remove_callback( $hook_name, $this->make_callable( array( $subscriber, $parameters[0] ) ), $parameters[1] ?? 10 );
		}
	}

	/**
	 * Convert a mixed value to a callable.
	 *
	 * @param mixed $callback The callback to convert.
	 * @return callable The converted callable.
	 * @throws \InvalidArgumentException If the callback is not valid.
	 */
	private function make_callable( mixed $callback ): callable {
		if ( is_callable( $callback ) ) {
			return $callback;
		}

		throw new \InvalidArgumentException( 'Invalid callback provided.' );
	}
}
