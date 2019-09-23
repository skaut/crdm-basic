<?php
/**
 * Contains the Background class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

/**
 * Background configuration
 *
 * This class sets up all the customizer options for configuring the background of the webpage.
 */
class Background {

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

	const DEFAULT = [
		'body_image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
		'body_repeat'     => '',
		'body_size'       => '',
		'body_attachment' => '',
		'body_position'   => '',
	];

	/**
	 * Background class constructor
	 *
	 * Adds the section and its controls to the customizer.
	 *
	 * @param string $config_id The ID of the configuration set ("crdm-basic").
	 * @param string $panel_id The ID of the panel in which this option is displayed.
	 */
	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_background';

		$this->init_section();
		$this->init_controls();

		add_action( 'customize_register', [ $this, 'customize' ], 1000 );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_inline_css' ] );
	}

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panel, section, all the settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	public function customize( $wp_customize ) {
		if ( ! Init::generatepress_module_enabled( 'generate_package_backgrounds' ) ) {
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

			$wp_customize->add_setting(
				'generate_background_settings[body_image]',
				[
					'default'           => self::DEFAULT['body_image'],
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
					'default'           => self::DEFAULT['body_repeat'],
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_control(
				'generate_background_settings[body_repeat]',
				[
					'type'    => 'select',
					'section' => 'generate_backgrounds_body',
					'choices' => [
						''          => esc_html__( 'Repeat', 'crdm-basic' ),
						'repeat-x'  => esc_html__( 'Repeat x', 'crdm-basic' ),
						'repeat-y'  => esc_html__( 'Repeat y', 'crdm-basic' ),
						'no-repeat' => esc_html__( 'No Repeat', 'crdm-basic' ),
					],
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_size]',
				[
					'default'           => self::DEFAULT['body_size'],
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_control(
				'generate_background_settings[body_size]',
				[
					'type'    => 'select',
					'section' => 'generate_backgrounds_body',
					'choices' => [
						''        => esc_html__( 'Size (Auto)', 'crdm-basic' ),
						'100'     => esc_html__( '100% Width', 'crdm-basic' ),
						'cover'   => esc_html__( 'Cover', 'crdm-basic' ),
						'contain' => esc_html__( 'Contain', 'crdm-basic' ),
					],
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_attachment]',
				[
					'default'           => self::DEFAULT['body_attachment'],
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_control(
				'generate_background_settings[body_attachment]',
				[
					'type'    => 'select',
					'section' => 'generate_backgrounds_body',
					'choices' => [
						''        => esc_html__( 'Attachment', 'crdm-basic' ),
						'fixed'   => esc_html__( 'Fixed', 'crdm-basic' ),
						'local'   => esc_html__( 'Local', 'crdm-basic' ),
						'inherit' => esc_html__( 'Inherit', 'crdm-basic' ),
					],
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_position]',
				[
					'default'           => self::DEFAULT['body_position'],
					'type'              => 'option',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_html',
				]
			);

			$wp_customize->add_control(
				'generate_background_settings[body_position]',
				[
					'type'        => 'text',
					'section'     => 'generate_backgrounds_body',
					'description' => __( 'left top, x% y%, xpos ypos (px)', 'crdm-basic' ),
					'input_attrs' => [
						'placeholder' => __( 'Position', 'crdm-basic' ),
					],
				]
			);
		}
	}

	/**
	 * Prints a CSS property.
	 *
	 * Escapes, formats and returns a CSS property line.
	 *
	 * @param array  $settings Parsed background settings for GeneratePress.
	 * @param string $css_name The name of the CSS property.
	 * @param string $settings_name The name of the settings field in $generate_background_settings.
	 * @param bool   $is_url Whether the property is an URL. Default false.
	 *
	 * @return string The CSS property line;
	 */
	private function print_css_property( $settings, $css_name, $settings_name, $is_url = false ) {
		$value = $settings[ $settings_name ];
		if ( empty( $value ) ) {
			return '';
		}
		$value = $is_url ? 'url(\'' . esc_url( $value ) . '\')' : esc_attr( $value );
		return $css_name . ': ' . $value . ';';
	}

	/**
	 * Prints the CSS for the background settings.
	 *
	 * Return all the CSS properties for the background settings.
	 *
	 * @return string CSS string.
	 */
	private function inline_css() {
		$settings = wp_parse_args( get_option( 'generate_background_settings', [] ), self::DEFAULT );
		return "body {\n" .
		$this->print_css_property( $settings, 'background-image', 'body_image', true ) .
		$this->print_css_property( $settings, 'background-repeat', 'body_repeat' ) .
		$this->print_css_property( $settings, 'background-size', 'body_size' ) .
		$this->print_css_property( $settings, 'background-attachment', 'body_attachment' ) .
		$this->print_css_property( $settings, 'background-position', 'body_position' ) .
		'}';
	}

	/**
	 * Adds the CSS to WordPress hooks.
	 *
	 * Cretes a new stylesheet and adds all the CSS to it.
	 */
	public function add_inline_css() {
		wp_register_style( 'crdm_customizer', false, [], CRDMBASIC_APP_VERSION );
		wp_enqueue_style( 'crdm_customizer' );
		wp_add_inline_style( 'crdm_customizer', $this->inline_css() );
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
				'title' => esc_attr__( 'Background', 'crdm-basic' ),
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
