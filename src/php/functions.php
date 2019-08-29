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
		add_action( 'after_switch_theme', [ $this, 'switchToPreviousThemeIfIncompatibleVersionOfWpOrPhp' ] );

		// if incompatible version of WP / PHP => don´t init
		if ( ! $this->isCompatibleVersionOfWp() ||
		     ! $this->isCompatibleVersionOfPhp()
		) {
			return;
		}

		$this->init();
	}

	protected function init() {
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'aristath' . DIRECTORY_SEPARATOR . 'kirki' . DIRECTORY_SEPARATOR . 'kirki.php'; // init Kirki library

		( new Crdm\Setup() );
		if ( is_admin() ) {
			( new Crdm\Admin\Init() );
		} else {
			( new Crdm\Front\Init() );
		}
	}

	protected function isCompatibleVersionOfWp() {
		if ( isset( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '4.9.8', '>=' ) ) {
			return true;
		}

		return false;
	}

	protected function isCompatibleVersionOfPhp() {
		if ( version_compare( PHP_VERSION, '7.0', '>=' ) ) {
			return true;
		}

		return false;
	}

	public function switchToPreviousThemeIfIncompatibleVersionOfWpOrPhp() {
		if ( ! $this->isCompatibleVersionOfPhp() || ! $this->isCompatibleVersionOfWp() ) {

			if ( ! $this->isCompatibleVersionOfWp() ) {
				add_action( 'admin_notices', function () {
					$this->showAdminNotice( esc_html__( 'Šablona ČRDM - základní vyžaduje verzi WordPress 4.9.8 nebo vyšší!', 'crdm-basic' ), 'warning' );
				} );
			}

			if ( ! $this->isCompatibleVersionOfPhp() ) {
				add_action( 'admin_notices', function () {
					$this->showAdminNotice( esc_html__( 'Šablona ČRDM - základní vyžaduje verzi PHP 7.0 nebo vyšší!', 'crdm-basic' ), 'warning' );
				} );
			}

			// Switch back to previous theme
			switch_theme( get_option( 'theme_switched' ) );

			return false;

		}

		return true;
	}

	public function showAdminNotice( $message, $type = 'warning' ) {
		$class = 'notice notice-' . $type . ' is-dismissible';
		printf( '<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss">
		<span class="screen-reader-text">' . __( 'Zavřít', 'crdm-basic' ) . '</span>
	</button></div>', esc_attr( $class ), $message );
	}

}

global $crdmBasicTheme;
$crdmBasicTheme = new CrdmBasicTheme();
