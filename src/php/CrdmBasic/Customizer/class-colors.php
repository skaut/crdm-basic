<?php
/**
 * Contains the Colors class.
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * Color configuration
 *
 * This class sets up all the customizer options for configuring the various colors of the webpage.
 */
class Colors extends Customizer_Category {
	const DEFAULT = [
		'generate_settings' => [
			'navigation_background_color' => '#222222',
			'navigation_text_color'       => '#ffffff',
			'h1_color'                    => '',
		],
	];

	/**
	 * Enqueues the JS.
	 *
	 * Enqueues the live-preview JS handlers.
	 */
	public function enqueue_live_preview() {
		wp_enqueue_script( 'crdm_colors_live_preview', CRDMBASIC_TEMPLATE_URL . 'admin/colors_live_preview.js', [], CRDMBASIC_APP_VERSION, false );
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
			$this->add_panel_sections( $wp_customize );

			$this->customize_primary_navigation( $wp_customize );
			$this->customize_content( $wp_customize );
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
			'generate_colors_panel',
			[
				'priority'       => 30,
				'theme_supports' => '',
				'title'          => __( 'Colors', 'crdm-basic' ),
				'description'    => '',
			]
		);

		$wp_customize->add_section(
			'navigation_color_section',
			[
				'title'    => __( 'Primary Navigation', 'crdm-basic' ),
				'priority' => 60,
				'panel'    => 'generate_colors_panel',
			]
		);

		$wp_customize->add_section(
			'content_color_section',
			[
				'title'    => __( 'Content', 'crdm-basic' ),
				'priority' => 80,
				'panel'    => 'generate_colors_panel',
			]
		);
	}

	/**
	 * Initializes customizer options for primary navigation.
	 *
	 * Adds customizer options for controling the menu background color.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_primary_navigation( $wp_customize ) {
		$wp_customize->add_setting(
			'generate_settings[navigation_background_color]',
			[
				'default'           => self::DEFAULT['generate_settings']['navigation_background_color'],
				'type'              => 'option',
				'sanitize_callback' => [ $this, 'sanitize_hex' ],
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'navigation_background_color_control',
				[
					'label'    => __( 'Background', 'crdm-basic' ),
					'section'  => 'navigation_color_section',
					'settings' => 'generate_settings[navigation_background_color]',
					'priority' => '1',
				]
			)
		);

		$wp_customize->add_setting(
			'generate_settings[navigation_text_color]',
			[
				'default'           => self::DEFAULT['generate_settings']['navigation_text_color'],
				'type'              => 'option',
				'sanitize_callback' => [ $this, 'sanitize_hex' ],
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'navigation_text_color',
				[
					'label'    => __( 'Text', 'crdm-basic' ),
					'section'  => 'navigation_color_section',
					'settings' => 'generate_settings[navigation_text_color]',
					'priority' => '2',
				]
			)
		);
	}

	/**
	 * Initializes customizer options for heading.
	 *
	 * Adds customizer options for controling heading text color.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_content( $wp_customize ) {
		$wp_customize->add_setting(
			'generate_settings[h1_color]',
			[
				'default'           => self::DEFAULT['generate_settings']['h1_color'],
				'type'              => 'option',
				'sanitize_callback' => [ $this, 'sanitize_hex' ],
				'transport'         => 'postMessage',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'h1_color',
				[
					'label'    => __( 'Heading 1 (H1) Color', 'crdm-basic' ),
					'section'  => 'content_color_section',
					'settings' => 'generate_settings[h1_color]',
					'priority' => '11',
				]
			)
		);
	}

	/**
	 * Sanitizes a color.
	 *
	 * Checks whether a color is a valid hex code.
	 *
	 * @param string $value The value to be checked.
	 *
	 * @return string Hex code or empty string.
	 */
	public function sanitize_hex( $value ) {
		if ( mb_ereg_match( '^#([a-fA-F0-9]{3}){1,2}$', $value ) ) {
			return $value;
		}
		return '';
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
