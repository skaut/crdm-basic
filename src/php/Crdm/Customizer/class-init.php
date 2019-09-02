<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Init {

	const CONFIG_ID = 'crdm_basic';

	public function __construct() {
		$this->init_kirki_and_controls();
	}

	protected function init_kirki_and_controls() {
		$this->init_kirki();
		$this->init_panel();
		$this->init_sections_and_controls();
	}

	protected function init_kirki() {
		Kirki::add_config(
			self::CONFIG_ID,
			[
				'capability'  => 'edit_theme_options',
				'option_type' => 'theme_mod',
			]
		);
	}

	protected function init_panel() {
		Kirki::add_panel(
			self::CONFIG_ID . '_theme',
			[
				'title' => esc_attr__( 'Child theme options', 'crdm-basic' ),
			]
		);
	}

	protected function init_sections_and_controls() {
		( new Color_Variant( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Background( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Border_Radius( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Menu( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Sidebar( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Page_Header( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Content( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
		( new Footer( self::CONFIG_ID, self::CONFIG_ID . '_theme' ) );
	}

}
