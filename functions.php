<?php

use Crdm\Utils\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CRDM_BASIC_APP_PATH', realpath( get_stylesheet_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDM_BASIC_APP_VERSION', '0.1' );
define( 'CRDM_BASIC_TEMPLATE_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'CRDM_BASIC_PARENT_TEMPLATE_PATH', realpath( get_template_directory() ) . DIRECTORY_SEPARATOR );
define( 'CRDM_BASIC_PARENT_TEMPLATE_URL', trailingslashit( get_template_directory_uri() ) );

class CrdmBasicTheme {

	public function __construct() {
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

		$this->initHooks();

		// if incompatible version of WP / PHP => don´t init
		if ( ! $this->isCompatibleVersionOfWp() ||
		     ! $this->isCompatibleVersionOfPhp()
		) {
			return;
		}

		$this->init();
	}

	protected function initHooks() {
		add_action( 'admin_init', [ $this, 'checkCompatibility' ] );

		add_action( 'after_switch_theme', [ $this, 'activation' ] );
		add_action( 'switch_theme', [ $this, 'deactivation' ] );
	}

	protected function init() {
		require CRDM_BASIC_APP_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'aristath' . DIRECTORY_SEPARATOR . 'kirki' . DIRECTORY_SEPARATOR . 'kirki.php'; // init Kirki framework

		( new Crdm\Setup() );
		if ( is_admin() ) {
			( new Crdm\Admin\Init() );
		} else {
			( new Crdm\Front\Init() );
		}
	}

	protected function isCompatibleVersionOfWp() {
		if ( isset( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '4.9.7', '>=' ) ) {
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

	public function activation() {
		$this->checkCompatibility();
	}

	public function deactivation() {

	}

	public function checkCompatibility() {
		if ( ! $this->isCompatibleVersionOfWp() ) {
			Helpers::showAdminNotice( esc_html__( 'Šablona ČRDM - základní vyžaduje verzi WordPress 4.9.6 nebo vyšší!', 'crdm_basic' ), 'warning' );
		}

		if ( ! $this->isCompatibleVersionOfPhp() ) {
			Helpers::showAdminNotice( esc_html__( 'Šablona ČRDM - základní vyžaduje verzi PHP 7.0 nebo vyšší!', 'crdm_basic' ), 'warning' );
		}
	}
}

global $crdmBasicTheme;
$crdmBasicTheme = new CrdmBasicTheme();