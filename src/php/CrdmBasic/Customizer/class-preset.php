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
	const PRESETS = [
		'light' => [
			'generate_settings'            => [
				'background_color'            => '#ffffff',
				'navigation_background_color' => '#037b8c',
			],
			'generate_background_settings' => [
				'body_image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
				'body_repeat'     => '',
				'body_size'       => '',
				'body_attachment' => '',
				'body_position'   => '',
				'nav_image'       => '',
				'nav_repeat'      => '',
			],
			'crdm_basic_header'            => [
				'background' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
				'foreground' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
				'under'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_grass.png',
			],
			'crdm_basic_border_radius'     => '',
		],
		'dark'  => [
			'generate_settings'            => [
				'background_color'            => '#0f2b4a',
				'navigation_background_color' => '#122030',
			],
			'generate_background_settings' => [
				'body_image'      => '',
				'body_repeat'     => '',
				'body_size'       => '',
				'body_attachment' => '',
				'body_position'   => '',
				'nav_image'       => '',
				'nav_repeat'      => '',
			],
			'crdm_basic_header'            => [
				'background' => '',
				'foreground' => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_header_foreground.png',
				'under'      => CRDMBASIC_TEMPLATE_URL . 'frontend/dark_pavement.png',
			],
			'crdm_basic_border_radius'     => '0.5em',
		],
	];

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

		$wp_customize->add_control(
			new Controls\Preset_Customize_Control(
				$wp_customize,
				'crdm_basic_preset',
				[
					'section'  => 'crdm_basic_preset',
					'settings' => [],
				],
				self::PRESETS
			)
		);
	}
}
