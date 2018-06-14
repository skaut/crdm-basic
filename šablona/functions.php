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
		add_action( 'admin_init', [ $this, 'checkVersions' ] );

		add_action( 'after_switch_theme', [ $this, 'activation' ] );
		add_action( 'switch_theme', [ $this, 'deactivation' ] );
	}

	protected function init() {
		( new Crdm\Setup() );
		if ( is_admin() ) {
			( new Crdm\Admin\Init() );
		} else {
			( new Crdm\Front\Init() );
		}
	}

	protected function isCompatibleVersionOfWp() {
		if ( isset( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '4.9.6', '>=' ) ) {
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
		if ( ! $this->isCompatibleVersionOfWp() ) {
			//wp_die( __( 'Šablona ČRDM - základní vyžaduje verzi WordPress 4.9.6 nebo vyšší!', 'crdm_basic' ) );
		}

		if ( ! $this->isCompatibleVersionOfPhp() ) {
			//wp_die( __( 'Šablona ČRDM - základní vyžaduje verzi PHP 7.0 nebo vyšší!', 'crdm_basic' ) );
		}

		if ( ! get_option( 'crdm_basic_rewrite_rules_need_to_flush' ) ) {
			add_option( 'crdm_basic_rewrite_rules_need_to_flush', true );
		}
	}

	public function deactivation() {
		delete_option( 'crdm_basic_rewrite_rules_need_to_flush' );
		flush_rewrite_rules();
	}

	public function checkVersions() {
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