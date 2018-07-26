<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Background {

	protected $configId = '';
	protected $panelId = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_background';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section( $this->sectionId, [
			'title' => esc_attr__( 'Pozadí', 'crdm_basic' ),
			'panel' => $this->panelId
		] );
	}

	protected function initControls() {
		Kirki::add_field( $this->configId, [
			'type'     => 'background',
			'settings' => 'webBg',
			'label'    => esc_attr__( 'Pozadí webu', 'crdm_basic' ),
			'section'  => $this->sectionId,
			'default'  => [
				'background-color'      => '#f7f3e2',
				'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/bck_@2x.png',
				'background-repeat'     => 'repeat',
				'background-position'   => 'left top',
				'background-size'       => '300px auto',
				'background-attachment' => 'scroll'
			],
			'output'   => [
				[
					'element' => 'body'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'        => 'background',
			'settings'    => 'headerBg1',
			'label'       => esc_attr__( 'Pozadí hlavičky 1', 'crdm_basic' ),
			'description' => esc_attr__( 'Za lištou menu', 'crdm_basic' ),
			'section'     => $this->sectionId,
			'default'     => [
				'background-color'      => 'transparent',
				'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/undermenu_sun_@2x.png',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'right top',
				'background-size'       => '376px auto',
				'background-attachment' => 'scroll'
			],
			'output'      => [
				[
					'element' => '.crdm_header__bg_1'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'        => 'background',
			'settings'    => 'headerBg2',
			'label'       => esc_attr__( 'Pozadí hlavičky 2', 'crdm_basic' ),
			'description' => esc_attr__( 'V popředí lišty menu', 'crdm_basic' ),
			'section'     => $this->sectionId,
			'default'     => [
				'background-color'      => 'transparent',
				'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/teepee_2@x.png',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'right bottom',
				'background-size'       => '100% auto',
				'background-attachment' => 'scroll'
			],
			'output'      => [
				[
					'element' => '.crdm_header__bg_2-container-content'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'        => 'background',
			'settings'    => 'headerBg3',
			'label'       => esc_attr__( 'Pozadí hlavičky 3', 'crdm_basic' ),
			'description' => esc_attr__( 'Pod lištou menu', 'crdm_basic' ),
			'section'     => $this->sectionId,
			'default'     => [
				'background-color'      => 'transparent',
				'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/trava_2@x.png',
				'background-repeat'     => 'repeat-x',
				'background-position'   => 'left bottom',
				'background-size'       => 'auto 100%',
				'background-attachment' => 'scroll'
			],
			'output'      => [
				[
					'element' => '.crdm_header__bg_3'
				]
			],
			'transport' => 'auto'
		] );
	}

}