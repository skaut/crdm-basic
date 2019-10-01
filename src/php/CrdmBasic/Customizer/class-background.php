<?php
/**
 * Contains the Background class.
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * Background configuration
 *
 * This class sets up all the customizer options for configuring the background of the webpage.
 */
class Background extends Customizer_Category {
	const DEFAULT = [
		'generate_background_settings' => [
			'body_image'      => '',
			'body_repeat'     => '',
			'body_size'       => '',
			'body_attachment' => '',
			'body_position'   => '',
			'nav_image'      => '',
			'nav_repeat'     => '',
		],
		'crdm_basic_header'            => [
			'background' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_background.png',
			'foreground' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_header_foreground.png',
			'under'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_grass.png',
		],
	];

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panel, section, all the settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	public function customize( $wp_customize ) {
		if ( ! Init::generatepress_module_enabled( 'generate_package_backgrounds' ) ) {
			$wp_customize->register_control_type( 'CrdmBasic\Customizer\Controls\Background_Image_Customize_Control' );

			$this->add_panel_sections( $wp_customize );

			$this->customize_body( $wp_customize );
			$this->customize_navigation( $wp_customize );
		}
		$this->customize_header( $wp_customize );
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
			'generate_backgrounds_panel',
			[
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Background Images', 'crdm-basic' ),
				'priority'       => 55,
			]
		);

		$wp_customize->add_section(
			'generate_backgrounds_body',
			[
				'title'      => __( 'Body', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 5,
				'panel'      => 'generate_backgrounds_panel',
			]
		);

		$wp_customize->add_section(
			'generate_backgrounds_header',
			[
				'title'      => __( 'Header', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 10,
				'panel'      => 'generate_backgrounds_panel',
			]
		);

		$wp_customize->add_section(
			'generate_backgrounds_navigation',
			[
				'title'      => __( 'Primary Navigation', 'crdm-basic' ),
				'capability' => 'edit_theme_options',
				'priority'   => 15,
				'panel'      => 'generate_backgrounds_panel',
			]
		);
	}

	/**
	 * Initializes customizer body options.
	 *
	 * Adds customizer options for controling the body background.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_body( $wp_customize ) {
		$wp_customize->add_setting(
			'generate_background_settings[body_image]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['body_image'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'generate_backgrounds-body-image',
				[
					'section'  => 'generate_backgrounds_body',
					'settings' => 'generate_background_settings[body_image]',
					'label'    => __( 'Body', 'crdm-basic' ),
				]
			)
		);

		$wp_customize->add_setting(
			'generate_background_settings[body_repeat]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['body_repeat'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
			]
		);

		$wp_customize->add_setting(
			'generate_background_settings[body_size]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['body_size'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
			]
		);

		$wp_customize->add_setting(
			'generate_background_settings[body_attachment]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['body_attachment'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
			]
		);

		$wp_customize->add_setting(
			'generate_background_settings[body_position]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['body_position'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_html',
			]
		);

		$wp_customize->add_control(
			new Controls\Background_Image_Customize_Control(
				$wp_customize,
				'body_backgrounds_control',
				[
					'section'  => 'generate_backgrounds_body',
					'settings' => [
						'repeat'     => 'generate_background_settings[body_repeat]',
						'size'       => 'generate_background_settings[body_size]',
						'attachment' => 'generate_background_settings[body_attachment]',
						'position'   => 'generate_background_settings[body_position]',
					],
				]
			)
		);
	}

	/**
	 * Initializes customizer navigation options.
	 *
	 * Adds customizer options for controling the background of the primary navigation.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_navigation( $wp_customize ) {
		$wp_customize->add_setting(
			'generate_background_settings[nav_image]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['nav_image'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'generate_backgrounds_settings[nav_image]',
				[
					'section'  => 'generate_backgrounds_navigation',
					'settings' => 'generate_background_settings[nav_image]',
					'priority' => 750,
					'label'    => __( 'Navigation', 'crdm-basic' ),
				]
			)
		);

		$wp_customize->add_setting(
			'generate_background_settings[nav_repeat]',
			[
				'default'           => self::DEFAULT['generate_background_settings']['nav_repeat'],
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_key',
			]
		);

		$wp_customize->add_control(
			'generate_background_settings[nav_repeat]',
			[
				'type'     => 'select',
				'section'  => 'generate_backgrounds_navigation',
				'settings' => 'generate_background_settings[nav_repeat]',
				'choices'  => [
					''          => __( 'Repeat', 'crdm-basic' ),
					'repeat-x'  => __( 'Repeat x', 'crdm-basic' ),
					'repeat-y'  => __( 'Repeat y', 'crdm-basic' ),
					'no-repeat' => __( 'No Repeat', 'crdm-basic' ),
				],
				'priority' => 800
			]
		);
	}

	/**
	 * Initializes customizer header options.
	 *
	 * Adds customizer options for controling the header background and foreground images.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	private function customize_header( $wp_customize ) {
		$wp_customize->add_setting(
			'crdm_basic_header[background]',
			[
				'default'           => self::DEFAULT['crdm_basic_header']['background'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'crdm_basic_header[background]',
				[
					'section'  => 'generate_backgrounds_header',
					'settings' => 'crdm_basic_header[background]',
					'label'    => __( 'Featured background image', 'crdm-basic' ),
				]
			)
		);

		$wp_customize->add_setting(
			'crdm_basic_header[foreground]',
			[
				'default'           => self::DEFAULT['crdm_basic_header']['foreground'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'crdm_basic_header[foreground]',
				[
					'section'  => 'generate_backgrounds_header',
					'settings' => 'crdm_basic_header[foreground]',
					'label'    => __( 'Featured foreground image', 'crdm-basic' ),
				]
			)
		);

		$wp_customize->add_setting(
			'crdm_basic_header[under]',
			[
				'default'           => self::DEFAULT['crdm_basic_header']['under'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'crdm_basic_header[under]',
				[
					'section'  => 'generate_backgrounds_header',
					'settings' => 'crdm_basic_header[under]',
					'label'    => __( 'Under menu image', 'crdm-basic' ),
				]
			)
		);
	}

	/**
	 * Returns the CSS for the background settings.
	 *
	 * Returns all the CSS properties for the background settings.
	 *
	 * @return array A list of properties in selectors.
	 */
	protected function inline_css() {
		$generate_settings = wp_parse_args( get_option( 'generate_background_settings', [] ), self::DEFAULT['generate_background_settings'] );
		$crdm_settings     = wp_parse_args( get_option( 'crdm_basic_header', [] ), self::DEFAULT['crdm_basic_header'] );
		return [
			'body'                                 => [
				[ 'background-image', $generate_settings['body_image'], 'url' ],
				[ 'background-repeat', $generate_settings['body_repeat'] ],
				[ 'background-size', $generate_settings['body_size'] ],
				[ 'background-attachment', $generate_settings['body_attachment'] ],
				[ 'background-position', $generate_settings['body_position'] ],
			],
			'.crdm_header__bg_1'                   => [
				[ 'background-image', $crdm_settings['background'], 'url' ],
			],
			'.crdm_header__bg_2-container-content' => [
				[ 'background-image', $crdm_settings['foreground'], 'url' ],
			],
			'.crdm_header__bg_3'                   => [
				[ 'background-image', $crdm_settings['under'], 'url' ],
			],
			'.main-navigation, .menu-toggle'       => [
				[ 'background-image', $generate_settings['nav_image'], 'url' ],
				[ 'background-repeat', $generate_settings['nav_repeat'] ],
			],
		];
	}
}
