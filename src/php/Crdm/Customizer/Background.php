<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Background {

	protected $configId  = '';
	protected $panelId   = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_background';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section(
			$this->sectionId,
			[
				'title' => esc_attr__( 'Background', 'crdm-basic' ),
				'panel' => $this->panelId,
			]
		);
	}

	protected function initControls() {
		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'background',
				'settings'  => 'webBg',
				'label'     => esc_attr__( 'Webpage background', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => [
					'background-color'      => '#f7f3e2',
					'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'frontend/light_background.png',
					'background-repeat'     => 'repeat',
					'background-position'   => 'left top',
					'background-size'       => '300px auto',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => 'body',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'        => 'background',
				'settings'    => 'headerBg1',
				'label'       => esc_attr__( 'Header background image', 'crdm-basic' ),
				'description' => esc_attr__( 'Behind the menu', 'crdm-basic' ),
				'section'     => $this->sectionId,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'right top',
					'background-size'       => '376px auto',
					'background-attachment' => 'scroll',
				],
				'output'      => [
					[
						'element' => '.crdm_header__bg_1',
					],
				],
				'transport'   => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'        => 'background',
				'settings'    => 'headerBg2',
				'label'       => esc_attr__( 'Header foreground image', 'crdm-basic' ),
				'description' => esc_attr__( 'In front of the menu', 'crdm-basic' ),
				'section'     => $this->sectionId,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'right bottom',
					'background-size'       => '100% auto',
					'background-attachment' => 'scroll',
				],
				'output'      => [
					[
						'element' => '.crdm_header__bg_2-container-content',
					],
				],
				'transport'   => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'        => 'background',
				'settings'    => 'headerBg3',
				'label'       => esc_attr__( 'Header bottom image', 'crdm-basic' ),
				'description' => esc_attr__( 'Under the menu', 'crdm-basic' ),
				'section'     => $this->sectionId,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDM_BASIC_TEMPLATE_URL . 'frontend/light_grass.png',
					'background-repeat'     => 'repeat-x',
					'background-position'   => 'left bottom',
					'background-size'       => 'auto 100%',
					'background-attachment' => 'scroll',
				],
				'output'      => [
					[
						'element' => '.crdm_header__bg_3',
					],
				],
				'transport'   => 'auto',
			]
		);
	}

}
