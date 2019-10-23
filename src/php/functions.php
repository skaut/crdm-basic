<?php
/**
 * Initializes the theme and handles theme switching.
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CRDMBASIC_APP_PATH', realpath( get_stylesheet_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDMBASIC_APP_VERSION', '0.2.1' );
define( 'CRDMBASIC_TEMPLATE_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'CRDMBASIC_PARENT_TEMPLATE_PATH', realpath( get_template_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDMBASIC_PARENT_TEMPLATE_URL', trailingslashit( get_template_directory_uri() ) );

require CRDMBASIC_APP_PATH . 'disable-gp-functions.php';

/**
 * Initializes the theme
 *
 * Handles switching the theme back if requirements aren't met and loads the theme files otherwise.
 */
function init() {
	add_action( 'after_switch_theme', '\\CrdmBasic\\switch_to_previous_theme_if_incompatible_version_of_wp_or_php' );

	if ( ! is_compatible_version_of_wp() || ! is_compatible_version_of_php() ) {
		return;
	}

	load();
}

/**
 * Loads the theme
 *
 * Loads the theme files and the Kirki framework.
 */
function load() {
	require CRDMBASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
	require CRDMBASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'aristath' . DIRECTORY_SEPARATOR . 'kirki' . DIRECTORY_SEPARATOR . 'kirki.php';

	( new Customizer\Init() );
	if ( ! is_admin() ) {
		( new Front\Init() );
	}
}

/**
 * Checks WordPress version
 *
 * Checks whether the theme is running on WordPress version at least 4.9.8.
 *
 * @return boolean True if WordPress version is sufficient.
 */
function is_compatible_version_of_wp() {
	if ( isset( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '4.9.8', '>=' ) ) {
		return true;
	}

	return false;
}

/**
 * Checks PHP version
 *
 * Checks whether the theme is running on PHP version at least 7.0.
 *
 * @return boolean True if PHP version is sufficient.
 */
function is_compatible_version_of_php() {
	if ( version_compare( PHP_VERSION, '7.0', '>=' ) ) {
		return true;
	}

	return false;
}

/**
 * Switches back to previous theme if the theme requirements aren't met
 *
 * Checks for minimum versions of WordPress and PHP and switches to previous theme if any of them is unsupported.
 *
 * @return boolean True if the theme **wasn't** switched back
 */
function switch_to_previous_theme_if_incompatible_version_of_wp_or_php() {
	if ( ! is_compatible_version_of_php() || ! is_compatible_version_of_wp() ) {
		if ( ! is_compatible_version_of_wp() ) {
			add_action(
				'admin_notices',
				function () {
					show_admin_notice( esc_html__( '"CRDM - Basic" theme requires WordPress 4.9.8 or newer!', 'crdm-basic' ), 'warning' );
				}
			);
		}

		if ( ! is_compatible_version_of_php() ) {
			add_action(
				'admin_notices',
				function () {
					show_admin_notice( esc_html__( '"CRDM - Basic" theme requires PHP 7.0 or newer!', 'crdm-basic' ), 'warning' );
				}
			);
		}

		// Switches back to previous theme.
		switch_theme( get_option( 'theme_switched', '' ) );

		return false;
	}

	return true;
}

/**
 * Shows an admin notice
 *
 * Displays a notice in the admin dashboard.
 *
 * @param string $message The message to be shown in the notice.
 * @param string $type Type of the notice. Default `warning`.
 */
function show_admin_notice( $message, $type = 'warning' ) {
	$class = 'notice notice-' . $type . ' is-dismissible';
	printf(
		'<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss">
	<span class="screen-reader-text">' . esc_html__( 'Close', 'crdm-basic' ) . '</span>
</button></div>',
		esc_attr( $class ),
		esc_html( $message )
	);
}

init();
