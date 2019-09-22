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

	private static $default = [
		'body_image' => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
		'body_repeat' => 'repeat',
		'body_size' => '300px auto',
		'body_attachment' => 'scroll',
		'body_position' => 'left top',
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

		add_action('customize_register', [$this, 'customize'], 1000);
		add_action('wp_enqueue_scripts', [$this, 'add_inline_css']);
	}

	public function customize($wp_customize)
	{
		if ( ! Init::generatepress_module_enabled('generate_package_backgrounds') ) {
			$wp_customize->add_panel( 'generate_backgrounds_panel', [
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Background Images', 'crdm-basic' ),
				'priority'		 => 55
			] );

			$wp_customize->add_section(
				'generate_backgrounds_body',
				[
					'title' => __( 'Body', 'crdm-basic' ),
					'capability' => 'edit_theme_options',
					'priority' => 5,
					'panel' => 'generate_backgrounds_panel',
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_image]', [
					'default' => self::$default['body_image'],
					'type' => 'option',
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw',
				]
			);

			$wp_customize->add_control(
				new \WP_Customize_Image_Control(
					$wp_customize,
					'generate_backgrounds-body-image',
					[
						'section'    => 'generate_backgrounds_body',
						'settings'   => 'generate_background_settings[body_image]',
						'label' => __( 'Body', 'crdm-basic' ),
					]
				)
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_repeat]',
				[
					'default' => self::$default['body_repeat'],
					'type' => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_size]',
				[
					'default' => self::$default['body_size'],
					'type' => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_attachment]',
				[
					'default' => self::$default['body_attachment'],
					'type' => 'option',
					'sanitize_callback' => 'sanitize_key',
				]
			);

			$wp_customize->add_setting(
				'generate_background_settings[body_position]', [
					'default' => self::$default['body_position'],
					'type' => 'option',
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_html',
				]
			);

			/*
			$wp_customize->add_control(
				new Background_Image_Customize_Control(
					$wp_customize,
					'body_backgrounds_control',
					[
						'section' => 'generate_backgrounds_body',
						'settings' => [
							'repeat' => 'generate_background_settings[body_repeat]',
							'size' => 'generate_background_settings[body_size]',
							'attachment' => 'generate_background_settings[body_attachment]',
							'position' => 'generate_background_settings[body_position]',
						],
					]
				)
			);
			 */
		}
	}

	private function inline_css()
	{
		$generate_background_settings = wp_parse_args(get_option( 'generate_background_settings', [] ),	self::$default);
		$background_image = esc_url( $generate_background_settings[ 'body_image' ] );
		return <<<CSS
body {
	background-image: url('$background_image');
}
CSS;
	}

	public function add_inline_css() {
		wp_register_style('crdm_customizer', false);
		wp_enqueue_style('crdm_customizer');
		wp_add_inline_style('crdm_customizer', $this->inline_css());
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
		/*
		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'background',
				'settings'  => 'webBg',
				'label'     => esc_attr__( 'Webpage background', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'background-color'      => '#f7f3e2',
					'background-image'      => CRDMBASIC_TEMPLATE_URL . 'frontend/light_background.png',
					'background-repeat'     => 'repeat',
					'background-position'   => 'left top',
					'background-size'       => '300px auto',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => 'body',
					],
				],
				'transport' => 'auto',
			]
		);
		 */

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
