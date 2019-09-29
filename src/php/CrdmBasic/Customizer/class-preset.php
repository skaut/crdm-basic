<?php
/**
 * Contains the Preset class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * Preset choice
 *
 * This class sets up all the customizer options for choosing one of the built-in presets of the template
 */
class Preset {
	const DEFAULT = 'light';

	/**
	 * Preset class constructor
	 *
	 * Adds settings for the 2 presets for the page.
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'customize' ], 1000 );
	}

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panel, section, all the settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	public function customize( $wp_customize ) {
		$wp_customize->register_control_type( 'CrdmBasic\Customizer\Controls\Preset_Customize_Control' );

		$wp_customize->add_section(
			'crdm_basic_preset',
			[
				'title'      => __( 'Preset', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 21,
			]
		);

		/*
		$wp_customize->add_setting(
			'crdm_basic_preset',
			[
				'default'           => self::DEFAULT,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => [ $this, 'sanitize' ],
			]
		);
		 */

		$wp_customize->add_control(
			new Controls\Preset_Customize_Control(
				$wp_customize,
				'crdm_basic_preset',
				[
					'section'  => 'crdm_basic_preset',
					'settings' => [],
				]
			)
		);
	}

	/*
	public function sanitize( $value ) {
		return 'dark' === $value ? 'dark' : 'light';
	}
	 */

	/*
	protected function init_section() {
		Kirki::add_section(
			$this->section_id,
			[
				'title' => esc_attr__( 'Preset', 'crdm-basic' ),
				'panel' => $this->panel_id,
			]
		);
	}

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
							'webBg'                 => [
								'background-color' => 'rgba(255, 255, 255, 0)',
								'background-image' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
							],
							'headerBg1'             => [
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right top',
								'background-size'       => '376px auto',
								'background-attachment' => 'scroll',
							],
							'headerBg2'             => [
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right bottom',
								'background-size'       => '100% auto',
								'background-attachment' => 'scroll',
							],
							'headerBg3'             => [
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_grass.png',
								'background-repeat'     => 'repeat-x',
								'background-position'   => 'left bottom',
								'background-size'       => 'auto 100%',
								'background-attachment' => 'scroll',
							],
							'borderRadius'          => '0px',
							'menuBg'                => [
								'background-color' => '#037b8c',
								'background-image' => '',
							],
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
							'contentFont'           => [
								'font-family' => 'PT Sans',
								'color'       => '#3f3f3f',
							],
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
							'webBg'                 => [
								'background-color' => '#0f2b4a',
								'background-image' => '',
							],
							'headerBg1'             => [
								'background-color' => 'rgba(255, 255, 255, 0)',
								'background-image' => '',
							],
							'headerBg2'             => [
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_header_foreground.png',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'right bottom',
								'background-size'       => '87% auto',
								'background-attachment' => 'scroll',
							],
							'headerBg3'             => [
								'background-color'      => 'rgba(255, 255, 255, 0)',
								'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_pavement.png',
								'background-repeat'     => 'repeat-x',
								'background-position'   => 'left bottom',
								'background-size'       => '24px 10px',
								'background-attachment' => 'scroll',
							],
							'borderRadius'          => '0.5em',
							'menuBg'                => [
								'background-color' => '#122030',
								'background-image' => '',
							],
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
							'contentFont'           => [
								'font-family' => 'PT Sans',
								'color'       => '#ebebeb',
							],
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
	 */

}
