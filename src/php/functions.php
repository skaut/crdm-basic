<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CRDM_BASIC_APP_PATH', realpath( get_stylesheet_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDM_BASIC_APP_VERSION', '0.2.1' );
define( 'CRDM_BASIC_TEMPLATE_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'CRDM_BASIC_PARENT_TEMPLATE_PATH', realpath( get_template_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDM_BASIC_PARENT_TEMPLATE_URL', trailingslashit( get_template_directory_uri() ) );

class CrdmBasicTheme {

	public function __construct() {
		add_action( 'after_switch_theme', [ $this, 'switch_to_previous_theme_if_incompatible_version_of_wp_or_php' ] );

		// if incompatible version of WP / PHP => don´t init
		if ( ! $this->is_compatible_version_of_wp() || ! $this->is_compatible_version_of_php() ) {
			return;
		}

		$this->init();
	}

	protected function init() {
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'aristath' . DIRECTORY_SEPARATOR . 'kirki' . DIRECTORY_SEPARATOR . 'kirki.php'; // init Kirki library

		( new Crdm\Setup() );
		if ( ! is_admin() ) {
			( new Crdm\Front\Init() );
		}
	}

	protected function is_compatible_version_of_wp() {
		if ( isset( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '4.9.8', '>=' ) ) {
			return true;
		}

		return false;
	}

	protected function is_compatible_version_of_php() {
		if ( version_compare( PHP_VERSION, '7.0', '>=' ) ) {
			return true;
		}

		return false;
	}

	public function switch_to_previous_theme_if_incompatible_version_of_wp_or_php() {
		if ( ! $this->is_compatible_version_of_php() || ! $this->is_compatible_version_of_wp() ) {
			if ( ! $this->is_compatible_version_of_wp() ) {
				add_action(
					'admin_notices',
					function () {
						$this->show_admin_notice( esc_html__( '"CRDM - Basic" theme requires WordPress 4.9.8 or newer!', 'crdm-basic' ), 'warning' );
					}
				);
			}

			if ( ! $this->is_compatible_version_of_php() ) {
				add_action(
					'admin_notices',
					function () {
						$this->show_admin_notice( esc_html__( '"CRDM - Basic" theme requires PHP 7.0 or newer!', 'crdm-basic' ), 'warning' );
					}
				);
			}

			// Switch back to previous theme
			switch_theme( get_option( 'theme_switched' ) );

			return false;
		}

		return true;
	}

	public function show_admin_notice( $message, $type = 'warning' ) {
		$class = 'notice notice-' . $type . ' is-dismissible';
		printf(
			'<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss">
		<span class="screen-reader-text">' . esc_html__( 'Close', 'crdm-basic' ) . '</span>
	</button></div>',
			esc_attr( $class ),
			$message
		);
	}

}

global $crdm_basic_theme;
$crdm_basic_theme = new CrdmBasicTheme();
