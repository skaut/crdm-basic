<?php
/**
 * Contains the Color_Variant class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

/**
 * Preset choice
 *
 * This class sets up all the customizer options for choosing one of the built-in presets of the template
 */
class Color_Variant {

	/**
	 * The ID of the configuration set ("crdm-basic").
	 *
	 * @var string $config_id
	 */
	protected $config_id = '';
	/**
	 * The ID of the panel in which this option is displayed.
	 *
	 * @var string $panel_id
	 */
	protected $panel_id = '';
	/**
	 * The ID of the section in which this option is displayed.
	 *
	 * @var string $section_id
	 */
	protected $section_id = '';

	/**
	 * Color_Variant class constructor
	 *
	 * Adds the section and its controls to the customizer.
	 *
	 * @param string $config_id The ID of the configuration set ("crdm-basic").
	 * @param string $panel_id The ID of the panel in which this option is displayed.
	 */
	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_colorVariant';

		$this->init_section();
		$this->init_controls();
	}

	/**
	 * Initializes the section
	 *
	 * Adds the section to the customizer.
	 */
	protected function init_section() {
		Kirki::add_section(
			$this->section_id,
			array(
				'title' => esc_attr__( 'Preset', 'crdm-basic' ),
				'panel' => $this->panel_id,
			)
		);
	}

	/**
	 * Initializes the controls
	 *
	 * Adds all the controls to the section
	 */
	protected function init_controls() {
		Kirki::add_field(
			$this->config_id,
			array(
				'type'        => 'radio-image',
				'settings'    => 'radio_image_setting',
				'label'       => esc_attr__( 'Choose a preset', 'crdm-basic' ),
				'description' => esc_attr__( 'CAUTION! Current theme settings will be overriden upon saving.', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => 'light',
				'choices'     => array(
					'light' => CRDMBASIC_TEMPLATE_URL . 'admin/light.png',
					'dark'  => CRDMBASIC_TEMPLATE_URL . 'admin/dark.png',
				),
				'preset'      => array(
					'light' => array(
						'settings' => array(
							'webBg'                 => array(
								'background-color' => 'rgba(255, 255, 255, 0)',
								'background-image' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
							),
							'headerBg1'             => array(
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right top',
								'background-size'       => '376px auto',
								'background-attachment' => 'scroll',
							),
							'headerBg2'             => array(
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right bottom',
								'background-size'       => '100% auto',
								'background-attachment' => 'scroll',
							),
							'headerBg3'             => array(
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_grass.png',
								'background-repeat'     => 'repeat-x',
								'background-position'   => 'left bottom',
								'background-size'       => 'auto 100%',
								'background-attachment' => 'scroll',
							),
							'borderRadius'          => '0px',
							'menuBg'                => array(
								'background-color' => '#037b8c',
								'background-image' => '',
							),
							'menuFont'              => array(
								'font-family' => 'Patrick Hand',
								'color'       => '#efefe5',
							),
							'menuSeparatorColor'    => '#3b969f',
							'submenuBg'             => array(
								'background-color' => '#65c3d4',
								'background-image' => '',
							),
							'submenuFont'           => array(
								'font-family' => 'Patrick Hand',
								'color'       => '#ffffff',
							),
							'submenuSeparatorColor' => '#ffffff',
							'contentFont'           => array(
								'font-family' => 'PT Sans',
								'color'       => '#3f3f3f',
							),
							'contentH1Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							),
							'contentH2Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							),
							'contentH3Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							),
							'contentH4Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							),
							'contentH5Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							),
							'contentH6Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							),
							'contentLinksColor'     => '#037b8c',
							'sidebarLinksColor'     => '#037b8c',
							'footerLinksColor'      => '#037b8c',
						),
					),
					'dark'  => array(
						'settings' => array(
							'webBg'                 => array(
								'background-color' => '#0f2b4a',
								'background-image' => '',
							),
							'headerBg1'             => array(
								'background-color' => 'rgba(255, 255, 255, 0)',
								'background-image' => '',
							),
							'headerBg2'             => array(
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_header_foreground.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right bottom',
								'background-size'       => '87% auto',
								'background-attachment' => 'scroll',
							),
							'headerBg3'             => array(
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_pavement.png',
								'background-repeat'     => 'repeat-x',
								'background-position'   => 'left bottom',
								'background-size'       => '24px 10px',
								'background-attachment' => 'scroll',
							),
							'borderRadius'          => '0.5em',
							'menuBg'                => array(
								'background-color' => '#122030',
								'background-image' => '',
							),
							'menuFont'              => array(
								'font-family' => 'Patrick Hand',
								'color'       => '#f2efde',
							),
							'menuSeparatorColor'    => '#465058',
							'submenuBg'             => array(
								'background-color' => '#122030',
								'background-image' => '',
							),
							'submenuFont'           => array(
								'font-family' => 'Patrick Hand',
								'color'       => '#5aa4cc',
							),
							'submenuSeparatorColor' => '#0f2b4a',
							'contentFont'           => array(
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							),
							'contentH1Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							),
							'contentH2Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							),
							'contentH3Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							),
							'contentH4Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							),
							'contentH5Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							),
							'contentH6Font'         => array(
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							),
							'contentLinksColor'     => '#7adff1',
							'sidebarLinksColor'     => '#5aa5c8',
							'footerLinksColor'      => '#5aa5c8',
						),
					),
				),
			)
		);
	}

}
