<?php

/*
|--------------------------------------------------------------------------
| Application Loading Helpers
|--------------------------------------------------------------------------
|
| Here is where you can register all option helper functions for application.
| It's a breeze. Simply create functions and use it wherever required.
|
*/

/**
 * Whether the current request is for an administrative interface page.
 *
 * Does not check if the user is an administrator; {@see current_user_can()}
 * for checking roles and capabilities.
 *
 * @since 1.5.1
 *
 * @return bool True if inside WordPress administration interface, false otherwise.
 */
function is_admin() {
	if ( isset( $GLOBALS['current_screen'] ) )
		return $GLOBALS['current_screen']->in_admin();
	elseif ( defined( 'WP_ADMIN' ) )
		return WP_ADMIN;

	return false;
}

/**
 * Whether the current request is for a site's admininstrative interface.
 *
 * e.g. `/wp-admin/`
 *
 * Does not check if the user is an administrator; {@see current_user_can()}
 * for checking roles and capabilities.
 *
 * @since 3.1.0
 *
 * @return bool True if inside WordPress blog administration pages.
 */
function is_blog_admin() {
	if ( isset( $GLOBALS['current_screen'] ) )
		return $GLOBALS['current_screen']->in_admin( 'site' );
	elseif ( defined( 'WP_BLOG_ADMIN' ) )
		return WP_BLOG_ADMIN;

	return false;
}

/**
 * Whether the current request is for the network administrative interface.
 *
 * e.g. `/wp-admin/network/`
 *
 * Does not check if the user is an administrator; {@see current_user_can()}
 * for checking roles and capabilities.
 *
 * @since 3.1.0
 *
 * @return bool True if inside WordPress network administration pages.
 */
function is_network_admin() {
	if ( isset( $GLOBALS['current_screen'] ) )
		return $GLOBALS['current_screen']->in_admin( 'network' );
	elseif ( defined( 'WP_NETWORK_ADMIN' ) )
		return WP_NETWORK_ADMIN;

	return false;
}

/**
 * Whether the current request is for a user admin screen.
 *
 * e.g. `/wp-admin/user/`
 *
 * Does not inform on whether the user is an admin! Use capability
 * checks to tell if the user should be accessing a section or not
 * {@see current_user_can()}.
 *
 * @since 3.1.0
 *
 * @return bool True if inside WordPress user administration pages.
 */
function is_user_admin() {
	if ( isset( $GLOBALS['current_screen'] ) )
		return $GLOBALS['current_screen']->in_admin( 'user' );
	elseif ( defined( 'WP_USER_ADMIN' ) )
		return WP_USER_ADMIN;

	return false;
}

/**
 * If Multisite is enabled.
 *
 * @since 3.0.0
 *
 * @return bool True if Multisite is enabled, false otherwise.
 */
function is_multisite() {
	if ( defined( 'MULTISITE' ) )
		return MULTISITE;

	if ( defined( 'SUBDOMAIN_INSTALL' ) || defined( 'VHOST' ) || defined( 'SUNRISE' ) )
		return true;

	return false;
}

/**
 * Retrieve the current blog ID.
 *
 * @since 3.1.0
 *
 * @return int Blog id
 */
function get_current_blog_id() {
	global $blog_id;
	return absint($blog_id);
}