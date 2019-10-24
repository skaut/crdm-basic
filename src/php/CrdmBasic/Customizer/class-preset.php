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
				'navigation_text_color'       => '#efefe5',
				'font_body'                   => 'PT Sans',
				'body_font_weight'            => 'normal',
				'body_font_transform'         => 'none',
				'body_font_size'              => '17',
				'body_line_height'            => '1.4',
				'paragraph_margin'            => '1.5',
				'text_color'                  => '#3f3f3f',
				'font_navigation'             => 'Patrick Hand',
				'navigation_font_weight'      => 'normal',
				'navigation_font_transform'   => 'none',
				'navigation_font_size'        => '16',
				'mobile_navigation_font_size' => '',
				'font_heading_1'              => 'PT Sans',
				'heading_1_weight'            => 'normal',
				'heading_1_transform'         => 'none',
				'heading_1_font_size'         => '2.3',
				'mobile_heading_1_font_size'  => '',
				'heading_1_line_height'       => '1.15',
				'heading_1_margin_bottom'     => '20',
				'h1_color'                    => '#037b8c',
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
			'font_body_variants'           => 'regular',
			'font_body_category'           => '',
			'font_navigation_variants'     => 'regular',
			'font_navigation_category'     => '',
			'font_heading_1_variants'      => '700',
			'font_heading_1_category'      => '',
			'crdm_basic_border_radius'     => '',
		],
		'dark'  => [
			'generate_settings'            => [
				'background_color'            => '#0f2b4a',
				'navigation_background_color' => '#122030',
				'navigation_text_color'       => '#f2efde',
				'font_body'                   => 'PT Sans',
				'body_font_weight'            => 'normal',
				'body_font_transform'         => 'none',
				'body_font_size'              => '17',
				'body_line_height'            => '1.4',
				'paragraph_margin'            => '1.5',
				'text_color'                  => '#ebebeb',
				'font_navigation'             => 'Patrick Hand',
				'navigation_font_weight'      => 'normal',
				'navigation_font_transform'   => 'none',
				'navigation_font_size'        => '16',
				'mobile_navigation_font_size' => '',
				'font_heading_1'              => 'PT Sans',
				'heading_1_weight'            => 'normal',
				'heading_1_transform'         => 'none',
				'heading_1_font_size'         => '2.3',
				'mobile_heading_1_font_size'  => '',
				'heading_1_line_height'       => '1.15',
				'heading_1_margin_bottom'     => '20',
				'h1_color'                    => '#7adff1',
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
			'font_body_variants'           => 'regular',
			'font_body_category'           => '',
			'font_navigation_variants'     => 'regular',
			'font_navigation_category'     => '',
			'font_heading_1_variants'      => '700',
			'font_heading_1_category'      => '',
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
