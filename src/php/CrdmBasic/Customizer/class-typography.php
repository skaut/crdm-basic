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
	const DEFAULT = array(
		'generate_settings'        => array(
			'font_body'                   => 'System Stack',
			'body_font_weight'            => 'normal',
			'body_font_transform'         => 'none',
			'body_font_size'              => '17',
			'body_line_height'            => '1.5',
			'paragraph_margin'            => '1.5',
			'font_navigation'             => 'inherit',
			'navigation_font_weight'      => 'normal',
			'navigation_font_transform'   => 'none',
			'navigation_font_size'        => '15',
			'mobile_navigation_font_size' => '15',
			'font_heading_1'              => 'inherit',
			'heading_1_weight'            => '300',
			'heading_1_transform'         => 'none',
			'heading_1_font_size'         => '40',
			'mobile_heading_1_font_size'  => '30',
			'heading_1_line_height'       => '1.2',
			'heading_1_margin_bottom'     => '20',
			'font_heading_2'              => 'inherit',
			'heading_2_weight'            => '300',
			'heading_2_transform'         => 'none',
			'heading_2_font_size'         => '40',
			'mobile_heading_2_font_size'  => '30',
			'heading_2_line_height'       => '1.2',
			'heading_2_margin_bottom'     => '20',
		),
		'font_body_variants'       => '',
		'font_body_category'       => '',
		'font_navigation_variants' => '',
		'font_navigation_category' => '',
		'font_heading_1_variants'  => '',
		'font_heading_1_category'  => '',
		'font_heading_2_variants'  => '',
		'font_heading_2_category'  => '',
	);

	/**
	 * Enqueues the JS.
	 *
	 * Enqueues the live-preview JS handlers.
	 */
	public function enqueue_live_preview() {
		wp_enqueue_script( 'crdm_typography_live_preview', CRDMBASIC_TEMPLATE_URL . 'admin/typography_live_preview.js', array(), CRDMBASIC_APP_VERSION, false );
		wp_localize_script(
			'crdm_typography_live_preview',
			'crdmTypographyLivePreview',
			array(
				// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				'mobile'  => apply_filters( 'generate_mobile_media_query', '(max-width:768px)' ),
				// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				'desktop' => apply_filters( 'generate_desktop_media_query', '(min-width:1025px)' ),
			)
		);
	}

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
			$this->customize_primary_navigation( $wp_customize );
			$this->customize_headings( $wp_customize );
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
			array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Typography', 'crdm-basic' ),
				'priority'       => 30,
			)
		);

		$wp_customize->add_section(
			'font_section',
			array(
				'title'      => __( 'Body', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
				'panel'      => 'generate_typography_panel',
			)
		);

		$wp_customize->add_section(
			'font_navigation_section',
			array(
				'title'      => __( 'Primary Navigation', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 50,
				'panel'      => 'generate_typography_panel',
			)
		);

		$wp_customize->add_section(
			'font_content_section',
			array(
				'title'      => __( 'Headings', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 60,
				'panel'      => 'generate_typography_panel',
			)
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
			array(
				'default'           => self::DEFAULT['generate_settings']['font_body'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Variants.
		$wp_customize->add_setting(
			'font_body_variants',
			array(
				'default'           => self::DEFAULT['font_body_variants'],
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_variants' ),
			)
		);

		// Category.
		$wp_customize->add_setting(
			'font_body_category',
			array(
				'default'           => self::DEFAULT['font_body_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Font weight.
		$wp_customize->add_setting(
			'generate_settings[body_font_weight]',
			array(
				'default'           => self::DEFAULT['generate_settings']['body_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		// Transform.
		$wp_customize->add_setting(
			'generate_settings[body_font_transform]',
			array(
				'default'           => self::DEFAULT['generate_settings']['body_font_transform'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Typography_Customize_Control(
				$wp_customize,
				'body_typography',
				array(
					'section'  => 'font_section',
					'priority' => 1,
					'settings' => array(
						'family'    => 'generate_settings[font_body]',
						'variant'   => 'font_body_variants',
						'category'  => 'font_body_category',
						'weight'    => 'generate_settings[body_font_weight]',
						'transform' => 'generate_settings[body_font_transform]',
					),
				)
			)
		);

		// Size.
		$wp_customize->add_setting(
			'generate_settings[body_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['body_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[body_font_size]',
				array(
					'description' => __( 'Font size', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 40,
					'settings'    => array(
						'desktop' => 'generate_settings[body_font_size]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 6,
							'max'  => 25,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
			)
		);

		// Line height.
		$wp_customize->add_setting(
			'generate_settings[body_line_height]',
			array(
				'default'           => self::DEFAULT['generate_settings']['body_line_height'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[body_line_height]',
				array(
					'description' => __( 'Line height', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 45,
					'settings'    => array(
						'desktop' => 'generate_settings[body_line_height]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 1,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => '',
						),
					),
				)
			)
		);

		// Paragraph margin.
		$wp_customize->add_setting(
			'generate_settings[paragraph_margin]',
			array(
				'default'           => self::DEFAULT['generate_settings']['paragraph_margin'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[paragraph_margin]',
				array(
					'description' => __( 'Paragraph margin', 'crdm-basic' ),
					'section'     => 'font_section',
					'priority'    => 47,
					'settings'    => array(
						'desktop' => 'generate_settings[paragraph_margin]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 0,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => 'em',
						),
					),
				)
			)
		);
	}

	/**
	 * Initializes customizer options for primary navigation.
	 *
	 * Adds customizer options for controling the primary navigation typography.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_primary_navigation( $wp_customize ) {
		// Family.
		$wp_customize->add_setting(
			'generate_settings[font_navigation]',
			array(
				'default'           => self::DEFAULT['generate_settings']['font_navigation'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Variants.
		$wp_customize->add_setting(
			'font_navigation_variants',
			array(
				'default'           => self::DEFAULT['font_navigation_variants'],
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_variants' ),
			)
		);

		// Category.
		$wp_customize->add_setting(
			'font_navigation_category',
			array(
				'default'           => self::DEFAULT['font_navigation_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Weight.
		$wp_customize->add_setting(
			'generate_settings[navigation_font_weight]',
			array(
				'default'           => self::DEFAULT['generate_settings']['navigation_font_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		// Transform.
		$wp_customize->add_setting(
			'generate_settings[navigation_font_transform]',
			array(
				'default'           => self::DEFAULT['generate_settings']['navigation_font_transform'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Typography_Customize_Control(
				$wp_customize,
				'google_font_site_navigation_control',
				array(
					'section'  => 'font_navigation_section',
					'priority' => 120,
					'settings' => array(
						'family'    => 'generate_settings[font_navigation]',
						'variant'   => 'font_navigation_variants',
						'category'  => 'font_navigation_category',
						'weight'    => 'generate_settings[navigation_font_weight]',
						'transform' => 'generate_settings[navigation_font_transform]',
					),
				)
			)
		);

		// Size.
		$wp_customize->add_setting(
			'generate_settings[navigation_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['navigation_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[mobile_navigation_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['mobile_navigation_font_size'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_empty_absint' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[navigation_font_size]',
				array(
					'description' => __( 'Font size', 'crdm-basic' ),
					'section'     => 'font_navigation_section',
					'priority'    => 165,
					'settings'    => array(
						'desktop' => 'generate_settings[navigation_font_size]',
						'mobile'  => 'generate_settings[mobile_navigation_font_size]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 6,
							'max'  => 30,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
						'mobile'  => array(
							'min'  => 6,
							'max'  => 30,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
			)
		);
	}

	/**
	 * Initializes customizer options for headings.
	 *
	 * Adds customizer options for controling heading typography.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	public function customize_headings( $wp_customize ) {
		// H1.
		// Family.
		$wp_customize->add_setting(
			'generate_settings[font_heading_1]',
			array(
				'default'           => self::DEFAULT['generate_settings']['font_heading_1'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Variants.
		$wp_customize->add_setting(
			'font_heading_1_variants',
			array(
				'default'           => self::DEFAULT['font_heading_1_variants'],
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_variants' ),
			)
		);

		// Category.
		$wp_customize->add_setting(
			'font_heading_1_category',
			array(
				'default'           => self::DEFAULT['font_heading_1_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Weight.
		$wp_customize->add_setting(
			'generate_settings[heading_1_weight]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_1_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		// Transform.
		$wp_customize->add_setting(
			'generate_settings[heading_1_transform]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_1_transform'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Typography_Customize_Control(
				$wp_customize,
				'font_heading_1_control',
				array(
					'label'    => __( 'Heading 1 (H1)', 'crdm-basic' ),
					'section'  => 'font_content_section',
					'settings' => array(
						'family'    => 'generate_settings[font_heading_1]',
						'variant'   => 'font_heading_1_variants',
						'category'  => 'font_heading_1_category',
						'weight'    => 'generate_settings[heading_1_weight]',
						'transform' => 'generate_settings[heading_1_transform]',
					),
				)
			)
		);

		// Size.
		$wp_customize->add_setting(
			'generate_settings[heading_1_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_1_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[mobile_heading_1_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['mobile_heading_1_font_size'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_empty_absint' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'h1_font_sizes',
				array(
					'description' => __( 'Font size', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_1_font_size]',
						'mobile'  => 'generate_settings[mobile_heading_1_font_size]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 15,
							'max'  => 100,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
						'mobile'  => array(
							'min'  => 15,
							'max'  => 100,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
			)
		);

		// Line height.
		$wp_customize->add_setting(
			'generate_settings[heading_1_line_height]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_1_line_height'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[heading_1_line_height]',
				array(
					'description' => __( 'Line height', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_1_line_height]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 0,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => 'em',
						),
					),
				)
			)
		);

		// Paragraph margin.
		$wp_customize->add_setting(
			'generate_settings[heading_1_margin_bottom]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_1_margin_bottom'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[heading_1_margin_bottom]',
				array(
					'description' => __( 'Bottom margin', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_1_margin_bottom]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
			)
		);

		// H2.
		// Family.
		$wp_customize->add_setting(
			'generate_settings[font_heading_2]',
			array(
				'default'           => self::DEFAULT['generate_settings']['font_heading_2'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Variants.
		$wp_customize->add_setting(
			'font_heading_2_variants',
			array(
				'default'           => self::DEFAULT['font_heading_2_variants'],
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_variants' ),
			)
		);

		// Category.
		$wp_customize->add_setting(
			'font_heading_2_category',
			array(
				'default'           => self::DEFAULT['font_heading_2_category'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Weight.
		$wp_customize->add_setting(
			'generate_settings[heading_2_weight]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_2_weight'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		// Transform.
		$wp_customize->add_setting(
			'generate_settings[heading_2_transform]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_2_transform'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Typography_Customize_Control(
				$wp_customize,
				'font_heading_2_control',
				array(
					'label'    => __( 'Heading 2 (H2)', 'crdm-basic' ),
					'section'  => 'font_content_section',
					'settings' => array(
						'family'    => 'generate_settings[font_heading_2]',
						'variant'   => 'font_heading_2_variants',
						'category'  => 'font_heading_2_category',
						'weight'    => 'generate_settings[heading_2_weight]',
						'transform' => 'generate_settings[heading_2_transform]',
					),
				)
			)
		);

		// Size.
		$wp_customize->add_setting(
			'generate_settings[heading_2_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_2_font_size'],
				'type'              => 'option',
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[mobile_heading_2_font_size]',
			array(
				'default'           => self::DEFAULT['generate_settings']['mobile_heading_2_font_size'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_empty_absint' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'h2_font_sizes',
				array(
					'description' => __( 'Font size', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_2_font_size]',
						'mobile'  => 'generate_settings[mobile_heading_2_font_size]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 10,
							'max'  => 80,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
						'mobile'  => array(
							'min'  => 10,
							'max'  => 80,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
			)
		);

		// Line height.
		$wp_customize->add_setting(
			'generate_settings[heading_2_line_height]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_2_line_height'],
				'type'              => 'option',
				'sanitize_callback' => array( '\\CrdmBasic\\Customizer\\Typography', 'sanitize_decimal_number' ),
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[heading_2_line_height]',
				array(
					'description' => __( 'Line height', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_2_line_height]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 0,
							'max'  => 5,
							'step' => .1,
							'edit' => true,
							'unit' => 'em',
						),
					),
				)
			)
		);

		// Paragraph margin.
		$wp_customize->add_setting(
			'generate_settings[heading_2_margin_bottom]',
			array(
				'default'           => self::DEFAULT['generate_settings']['heading_2_margin_bottom'],
				'type'              => 'option',
				'sanitize_callback' => 'generate_premium_sanitize_decimal_integer',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new \Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[heading_2_margin_bottom]',
				array(
					'description' => __( 'Bottom margin', 'crdm-basic' ),
					'section'     => 'font_content_section',
					'settings'    => array(
						'desktop' => 'generate_settings[heading_2_margin_bottom]',
					),
					'choices'     => array(
						'desktop' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
							'edit' => true,
							'unit' => 'px',
						),
					),
				)
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
	 * @return string The variant string.
	 */
	public static function sanitize_variants( $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}
		return sanitize_text_field( $value );
	}

	/**
	 * Sanitizes a non-negative integer.
	 *
	 * Converts a string representation of a number into a non-negative integer. Optionally keeps empty string as an empty string
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string|int The integer value.
	 */
	public static function sanitize_empty_absint( $value ) {
		if ( '' === $value ) {
			return '';
		}
		return absint( $value );
	}


	/**
	 * Returns the CSS for the background settings.
	 *
	 * Returns all the CSS properties for the background settings.
	 *
	 * @return array A list of properties in selectors.
	 */
	protected function inline_css() {
		return array();
	}
}
