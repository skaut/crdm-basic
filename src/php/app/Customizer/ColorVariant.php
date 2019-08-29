<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class ColorVariant {

	protected $configId = '';
	protected $panelId = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_colorVariant';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section( $this->sectionId, [
			'title' => esc_attr__( 'Barevná varianta', 'crdm-basic' ),
			'panel' => $this->panelId
		] );
	}

	protected function initControls() {
		Kirki::add_field( $this->configId, [
			'type'        => 'radio-image',
			'settings'    => 'radio_image_setting',
			'label'       => esc_attr__( 'Vyberte barevnou variantu', 'crdm-basic' ),
			'description' => esc_attr__( 'POZOR! Po uložení budou stávající nastavení šablony upraveny.', 'crdm-basic' ),
			'section'     => $this->sectionId,
			'default'     => 'light',
			'choices'     => [
				'light' => CRDM_BASIC_TEMPLATE_URL . 'assets/img/light.png',
				'dark'  => CRDM_BASIC_TEMPLATE_URL . 'assets/img/dark.png'
			],
			'preset'      => [
				'light' => [
					'settings' => [
						'webBg'                 => [
							'background-color' => 'rgba(255, 255, 255, 0)',
							'background-image' => CRDM_BASIC_TEMPLATE_URL . 'assets/img/bck_@2x.png'
						],
						'headerBg1'             => [
							'background-color'      => 'rgba(255, 255, 255, 0)',
							'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/undermenu_sun_@2x.png',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'right top',
							'background-size'       => '376px auto',
							'background-attachment' => 'scroll'
						],
						'headerBg2'             => [
							'background-color'      => 'rgba(255, 255, 255, 0)',
							'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/teepee_2@x.png',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'right bottom',
							'background-size'       => '100% auto',
							'background-attachment' => 'scroll'
						],
						'headerBg3'             => [
							'background-color'      => 'rgba(255, 255, 255, 0)',
							'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/trava_2@x.png',
							'background-repeat'     => 'repeat-x',
							'background-position'   => 'left bottom',
							'background-size'       => 'auto 100%',
							'background-attachment' => 'scroll'
						],
						'borderRadius'          => '0px',
						'menuBg'                => [
							'background-color' => '#037b8c',
							'background-image' => ''
						],
						'menuFont'              => [
							'font-family' => 'Patrick Hand',
							'color'       => '#efefe5'
						],
						'menuSeparatorColor'    => '#3b969f',
						'submenuBg'             => [
							'background-color' => '#65c3d4',
							'background-image' => ''
						],
						'submenuFont'           => [
							'font-family' => 'Patrick Hand',
							'color'       => '#ffffff'
						],
						'submenuSeparatorColor' => '#ffffff',
						'contentFont'           => [
							'font-family' => 'PT Sans',
							'color'       => '#3f3f3f'
						],
						'contentH1Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#037b8c'
						],
						'contentH2Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#037b8c'
						],
						'contentH3Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#00011f'
						],
						'contentH4Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#037b8c'
						],
						'contentH5Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#00011f'
						],
						'contentH6Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#00011f'
						],
						'contentLinksColor'     => '#037b8c',
						'sidebarLinksColor'     => '#037b8c',
						'footerLinksColor'      => '#037b8c'
					],
				],
				'dark'  => [
					'settings' => [
						'webBg'                 => [
							'background-color' => '#0f2b4a',
							'background-image' => ''
						],
						'headerBg1'             => [
							'background-color' => 'rgba(255, 255, 255, 0)',
							'background-image' => ''
						],
						'headerBg2'             => [
							'background-color'      => 'rgba(255, 255, 255, 0)',
							'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/truck_2@x.png',
							'background-repeat'     => 'no-repeat',
							'background-position'   => 'right bottom',
							'background-size'       => '87% auto',
							'background-attachment' => 'scroll'
						],
						'headerBg3'             => [
							'background-color'      => 'rgba(255, 255, 255, 0)',
							'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'assets/img/line_2@x.png',
							'background-repeat'     => 'repeat-x',
							'background-position'   => 'left bottom',
							'background-size'       => '24px 10px',
							'background-attachment' => 'scroll'
						],
						'borderRadius'          => '0.5em',
						'menuBg'                => [
							'background-color' => '#122030',
							'background-image' => ''
						],
						'menuFont'              => [
							'font-family' => 'Patrick Hand',
							'color'       => '#f2efde'
						],
						'menuSeparatorColor'    => '#465058',
						'submenuBg'             => [
							'background-color' => '#122030',
							'background-image' => ''
						],
						'submenuFont'           => [
							'font-family' => 'Patrick Hand',
							'color'       => '#5aa4cc'
						],
						'submenuSeparatorColor' => '#0f2b4a',
						'contentFont'           => [
							'font-family' => 'PT Sans',
							'color'       => '#ebebeb'
						],
						'contentH1Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#7adff1'
						],
						'contentH2Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#7adff1'
						],
						'contentH3Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#ebebeb'
						],
						'contentH4Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#7adff1'
						],
						'contentH5Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#ebebeb'
						],
						'contentH6Font'         => [
							'font-family' => 'PT Sans',
							'color'       => '#ebebeb'
						],
						'contentLinksColor'     => '#7adff1',
						'sidebarLinksColor'     => '#5aa5c8',
						'footerLinksColor'      => '#5aa5c8'
					],
				]
			],
		] );
	}

}