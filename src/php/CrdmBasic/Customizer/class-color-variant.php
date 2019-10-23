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
			[
				'title' => esc_attr__( 'Preset', 'crdm-basic' ),
				'panel' => $this->panel_id,
			]
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
			[
				'type'        => 'radio-image',
				'settings'    => 'radio_image_setting',
				'label'       => esc_attr__( 'Choose a preset', 'crdm-basic' ),
				'description' => esc_attr__( 'CAUTION! Current theme settings will be overriden upon saving.', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => 'light',
				'choices'     => [
					'light' => CRDMBASIC_TEMPLATE_URL . 'admin/light.png',
					'dark'  => CRDMBASIC_TEMPLATE_URL . 'admin/dark.png',
				],
				'preset'      => [
					'light' => [
						'settings' => [
							'menuFont'              => [
								'font-family' => 'Patrick Hand',
								'color'       => '#efefe5',
							],
							'menuSeparatorColor'    => '#3b969f',
							'submenuBg'             => [
								'background-color' => '#65c3d4',
								'background-image' => '',
							],
							'submenuFont'           => [
								'font-family' => 'Patrick Hand',
								'color'       => '#ffffff',
							],
							'submenuSeparatorColor' => '#ffffff',
							'contentH1Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							],
							'contentH2Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							],
							'contentH3Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							],
							'contentH4Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#037b8c',
							],
							'contentH5Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							],
							'contentH6Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#00011f',
							],
							'contentLinksColor'     => '#037b8c',
							'sidebarLinksColor'     => '#037b8c',
							'footerLinksColor'      => '#037b8c',
						],
					],
					'dark'  => [
						'settings' => [
							'menuFont'              => [
								'font-family' => 'Patrick Hand',
								'color'       => '#f2efde',
							],
							'menuSeparatorColor'    => '#465058',
							'submenuBg'             => [
								'background-color' => '#122030',
								'background-image' => '',
							],
							'submenuFont'           => [
								'font-family' => 'Patrick Hand',
								'color'       => '#5aa4cc',
							],
							'submenuSeparatorColor' => '#0f2b4a',
							'contentH1Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							],
							'contentH2Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							],
							'contentH3Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							],
							'contentH4Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#7adff1',
							],
							'contentH5Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							],
							'contentH6Font'         => [
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							],
							'contentLinksColor'     => '#7adff1',
							'sidebarLinksColor'     => '#5aa5c8',
							'footerLinksColor'      => '#5aa5c8',
						],
					],
				],
			]
		);
	}

}
