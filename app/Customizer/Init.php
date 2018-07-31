<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Init {

	const CONFIG_ID = 'crdm_basic';

	public function __construct() {
		$this->initKirkiAndControls();
	}

	protected function initKirkiAndControls() {
		$this->initKirki();
		$this->initPanel();
		$this->initSectionsAndControls();
	}

	protected function initKirki() {
		Kirki::add_config( self::CONFIG_ID, [
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod'
		] );
	}

	protected function initPanel() {
		Kirki::add_panel( self::CONFIG_ID . '_theme', [
			'title' => esc_attr__( 'Nastavení šablony', 'crdm-basic' )
		] );
	}

	protected function initSectionsAndControls() {
		( new ColorVariant( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Background( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new BorderRadius( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Menu( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Sidebar( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new PageHeader( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Content( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Footer( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
	}

}