<?php
/**
 * Contains the Colors class.
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * Typography configuration
 *
 * This class sets up all the customizer options for configuring the various font and text properties of the theme.
 */
class Typography extends Customizer_Category {
	const DEFAULT = [
		'generate_settings'  => [
			'font_body'           => 'System Stack',
			'body_font_weight'    => 'normal',
			'body_font_transform' => 'none',
			'body_font_size'      => '17',
			'body_line_height'    => '1.5',
			'paragraph_margin'    => '1.5',
		],
		'font_body_variants' => '',
		'font_body_category' => '',
	];

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panel, section, all the settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	public function customize( $wp_customize ) {
		if ( ! Init::generatepress_module_enabled( 'generate_package_colors' ) ) {
			$wp_customize->register_control_type( 'Generate_Typography_Customize_Control' );
			$wp_customize->register_control_type( 'Generate_Range_Slider_Control' );
			$this->add_panel_sections( $wp_customize );

			$this->customize_body( $wp_customize );
		}
	}

	/**
	 * Adds the panel and sections
	 *
	 * Adds the panel and sections that would otherwise be added by GeneratePress.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function add_panel_sections( $wp_customize ) {
		$wp_customize->add_panel(
			'generate_typography_panel',
			[
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Typography', 'crdm-basic' ),
				'priority'       => 30,
			]
		);

		$wp_customize->add_section(
			'font_section',
			[
				'title'      => __( 'Body', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
				'panel'      => 'generate_typography_panel',
			]
		);
	}

	/**
	 * Initializes customizer options for body.
	 *
	 * Adds customizer options for controling the body typography.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_body( $wp_customize ) {
		// Family.
		$wp_customize->add_setting(
			'generate_settings[font_body]',
			[
				'default'           => self::DEFAULT['generate_settings']['font_body'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		// Variants.
		$wp_customize->add_setting(
			'font_body_variants',
			[
				'default'           => self::DEFAULT['font_body_variants'],
				'sanitize_callback' => [ '\\CrdmBasic\\Customizer\\Typography', 'sanitize_variants' ],
			]
		);

		// Category.
		$wp_customize->add_setting(
			'font_body_category',
			[
				'default'           => self::DEFAULT['font_body_category'],
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		// Font weight.
		$wp_customize->add_setting(
			'generate_settings[body_font_weight]',
			[
				'default'           => self::DEFAULT['generate_settings']['body_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			]
		);

		// Transform.
		$wp_customize->add_setting(
			'generate_settings[body_font_transform]',
			[
				'default'           => self::DEFAULT['generate_settings']['body_font_transform'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \Generate_Typography_Customize_Control(
				$wp_customize,
				'body_typography',
				[
					'section'  => 'font_section',
					'priority' => 1,
					'settings' => [
						'family'    => 'generate_settings[font_body]',
						'variant'   => 'font_body_variants',
						'category'  => 'font_body_category',
						'weight'    => 'generate_settings[body_font_weight]',
						'transform' => 'generate_settings[body_font_transform]',
					],
				]
			)
		);

		// Size.
		$wp_customize->add_setting(
			'generate_settings[body_font_size]',
			[
				'default'           => self::DEFAULT['generate_settings']['body_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[body_font_size]',
				[
					'description' => __( 'Font size', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 40,
					'settings'    => [
						'desktop' => 'generate_settings[body_font_size]',
					],
					'choices'     => [
						'desktop' => [
							'min'  => 6,
							'max'  => 25,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						],
					],
				]
			)
		);

		// Line height.
		$wp_customize->add_setting(
			'generate_settings[body_line_height]',
			[
				'default'           => self::DEFAULT['generate_settings']['body_line_height'],
				'type'              => 'option',
				'sanitize_callback' => [ '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ],
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[body_line_height]',
				[
					'description' => __( 'Line height', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 45,
					'settings'    => [
						'desktop' => 'generate_settings[body_line_height]',
					],
					'choices'     => [
						'desktop' => [
							'min'  => 1,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => '',
						],
					],
				]
			)
		);

		// Paragraph margin.
		$wp_customize->add_setting(
			'generate_settings[paragraph_margin]',
			[
				'default'           => self::DEFAULT['generate_settings']['paragraph_margin'],
				'type'              => 'option',
				'sanitize_callback' => [ '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ],
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[paragraph_margin]',
				[
					'description' => __( 'Paragraph margin', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 47,
					'settings'    => [
						'desktop' => 'generate_settings[paragraph_margin]',
					],
					'choices'     => [
						'desktop' => [
							'min'  => 0,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => 'em',
						],
					],
				]
			)
		);
	}

	/**
	 * Sanitizes a decimal number.
	 *
	 * Converts a string representation of a number into a non-negative float.
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return float The float value.
	 */
	public static function sanitize_decimal_number( $value ) {
		return abs( floatval( $value ) );
	}

	/**
	 * Sanitizes font variants.
	 *
	 * Converts a list of font variants into a variant string.
	 *
	 * @param string|array $value The value to be sanitized.
	 *
	 * @return float The variant string.
	 */
	public static function sanitize_variants( $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}
		return sanitize_text_field( $value );
	}

	/**
	 * Returns the CSS for the background settings.
	 *
	 * Returns all the CSS properties for the background settings.
	 *
	 * @return array A list of properties in selectors.
	 */
	protected function inline_css() {
		return [];
	}
}
