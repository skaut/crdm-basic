<?php declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

class Background {

	protected $config_id  = '';
	protected $panel_id   = '';
	protected $section_id = '';

	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_background';

		$this->init_section();
		$this->init_controls();
	}

	protected function init_section() {
		Kirki::add_section(
			$this->section_id,
			[
				'title' => esc_attr__( 'Background', 'crdm-basic' ),
				'panel' => $this->panel_id,
			]
		);
	}

	protected function init_controls() {
		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'background',
				'settings'  => 'webBg',
				'label'     => esc_attr__( 'Webpage background', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'background-color'      => '#f7f3e2',
					'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
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
			$this->config_id,
			[
				'type'        => 'background',
				'settings'    => 'headerBg1',
				'label'       => esc_attr__( 'Header background image', 'crdm-basic' ),
				'description' => esc_attr__( 'Behind the menu', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
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
			$this->config_id,
			[
				'type'        => 'background',
				'settings'    => 'headerBg2',
				'label'       => esc_attr__( 'Header foreground image', 'crdm-basic' ),
				'description' => esc_attr__( 'In front of the menu', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
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
			$this->config_id,
			[
				'type'        => 'background',
				'settings'    => 'headerBg3',
				'label'       => esc_attr__( 'Header bottom image', 'crdm-basic' ),
				'description' => esc_attr__( 'Under the menu', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_grass.png',
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
