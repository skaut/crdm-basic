<?php
/**
 * Contains the Content class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;
use Kirki_Color;

/**
 * Content configuration
 *
 * This class sets up all the customizer options for configuring the look of the content of the webpage.
 */
class Content {

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
	 * Content class constructor
	 *
	 * Adds all the hooks, the section and its controls to the customizer.
	 *
	 * @param string $config_id The ID of the configuration set ("crdm-basic").
	 * @param string $panel_id The ID of the panel in which this option is displayed.
	 */
	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_content';

		$this->init_hooks();
		$this->init_section();
		$this->init_controls();
	}

	/**
	 * Initializes the hooks
	 *
	 * Adds all the hooks for the content CSS variables.
	 */
	protected function init_hooks() {
		add_action( 'wp_head', [ $this, 'resolve_and_print_list_css_variables' ], 0 );
		add_action( 'wp_head', [ $this, 'resolve_and_print_table_css_variables' ], 0 );
		add_action( 'wp_head', [ $this, 'resolve_and_print_separator_css_variables' ], 0 );
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
				'title' => esc_attr__( 'Content', 'crdm-basic' ),
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
				'type'      => 'background',
				'settings'  => 'contentBg',
				'label'     => esc_attr__( 'Background', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'background-color'      => 'rgba(255, 255, 255, 0)',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'left top',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => '#page',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentFont',
				'label'     => esc_attr__( 'Body', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '17px',
					'line-height'    => '1.4',
					'letter-spacing' => 'inherit',
					'color'          => '#3f3f3f',
				],
				'output'    => [
					[
						'element' => 'body .site-main',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'color',
				'settings'  => 'contentLinksColor',
				'label'     => esc_attr__( 'Link color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => '#037b8c',
				'output'    => [
					[
						'element'  => 'body .site-main a, body .site-main a:visited, body .site-main a:hover',
						'property' => 'color',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'        => 'typography',
				'settings'    => 'contentH1Font',
				'label'       => esc_attr__( 'Heading 1 (H1)', 'crdm-basic' ),
				'description' => esc_attr__( 'The color will be used for other elements (lists, tables etc.) as well.', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => [
					'font-family'    => 'PT Sans',
					'variant'        => '700',
					'font-size'      => '2.3em',
					'line-height'    => '1.15',
					'letter-spacing' => 'inherit',
					'color'          => '#037b8c',
					'text-transform' => 'none',
				],
				'output'      => [
					[
						'element' => 'body .site-main h1',
					],
				],
				'transport'   => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentH2Font',
				'label'     => esc_attr__( 'Heading 2 (H2)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '2.2em',
					'line-height'    => '1.2',
					'letter-spacing' => 'inherit',
					'color'          => '#037b8c',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => 'body .site-main h2',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentH3Font',
				'label'     => esc_attr__( 'Heading 3 (H3)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => '700',
					'font-size'      => '1.8em',
					'line-height'    => '1.25',
					'letter-spacing' => 'inherit',
					'color'          => '#00011f',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => 'body .site-main h3',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentH4Font',
				'label'     => esc_attr__( 'Heading 4 (H4)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '1.8em',
					'line-height'    => '1.25',
					'letter-spacing' => 'inherit',
					'color'          => '#037b8c',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => 'body .site-main h4',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentH5Font',
				'label'     => esc_attr__( 'Heading 5 (H5)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => '700',
					'font-size'      => '1.5em',
					'line-height'    => '1.3',
					'letter-spacing' => 'inherit',
					'color'          => '#00011f',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => 'body .site-main h5',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'contentH6Font',
				'label'     => esc_attr__( 'Heading 6 (H6)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '1.5em',
					'line-height'    => '1.3',
					'letter-spacing' => 'inherit',
					'color'          => '#00011f',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => 'body .site-main h6',
					],
				],
				'transport' => 'auto',
			]
		);
	}

	/**
	 * Prints list styles
	 *
	 * Computes and prints all the CSS variables used to style lists.
	 */
	public function resolve_and_print_list_css_variables() {
		$h1_font              = get_theme_mod( 'contentH1Font' );
		$list_primary_color   = '#037b8c';
		$list_secondary_color = '#65c3d4';
		if ( ! empty( $h1_font ) && isset( $h1_font['color'] ) ) {
			$list_primary_color   = $h1_font['color'];
			$list_secondary_color = Kirki_Color::adjust_brightness( $list_primary_color, 62 );
		}
		?>
		<style id="crdm_basic-css-vars-list">
			:root {
				--listPrimaryColor: <?php echo esc_html( $list_primary_color ); ?>;
				--listSecondaryColor: <?php echo esc_html( $list_secondary_color ); ?>;
			}
		</style>
		<?php
	}

	/**
	 * Gets background color
	 *
	 * Gets the theme background color.
	 *
	 * @return bool|array {
	 *     All fields are mandatory.
	 *
	 *     @type string $background-color The theme background color.
	 * }
	 */
	private static function get_bg_color() {
		$bg_color = get_theme_mod( 'contentBg' );
		if ( empty( $bg_color ) || ! isset( $bg_color['background-color'] ) || substr( $bg_color['background-color'], 0, 1 ) !== '#' ) {
			return get_theme_mod( 'generate_settings[background_color]' );
		}
		return $bg_color;
	}

	/**
	 * Checks whether the web is dark
	 *
	 * Checks whether the background is overall dark.
	 *
	 * @param bool|array $bg_color {
	 *     All fields are mandatory.
	 *
	 *     @type string $background-color The theme background color.
	 * }
	 *
	 * @return bool True if the web is dark.
	 */
	private static function is_web_dark( $bg_color ) {
		if ( ! empty( $bg_color ) && isset( $bg_color['background-color'] ) && substr( $bg_color['background-color'], 0, 1 ) === '#' ) {
			return 125 > Kirki_Color::get_brightness( $bg_color['background-color'] );
		}
		return false;
	}

	/**
	 * Gets the background color for `<thead>`
	 *
	 * Computes the background color from the text color.
	 *
	 * @param bool|array $h1_font {
	 *     All fields are mandatory.
	 *
	 *     @type string color Heading 1 text color.
	 * }
	 * @param bool       $web_is_dark Whether the web is overall dark.
	 */
	private static function get_thead_bg_color( $h1_font, bool $web_is_dark ) {
		if ( ! empty( $h1_font ) && isset( $h1_font['color'] ) ) {
			return Kirki_Color::adjust_brightness( $h1_font['color'], $web_is_dark ? -70 : 70 );
		}
		return '#65c3d4';
	}

	/**
	 * Gets the odd row background color
	 *
	 * Computes the background color for odd rows of a table.
	 *
	 * @return string The background color as CSS hex code.
	 */
	private static function get_odd_row_bg_color() {
		if ( ! empty( $bg_color ) && isset( $bg_color['background-color'] ) && substr( $bg_color['background-color'], 0, 1 ) === '#' ) {
			return ( Kirki_Color::brightness_difference( $bg_color['background-color'], '#ffffff' ) < 10 ) ? '#eeeeee' : '#ffffff';
		}
		return '#ffffff';
	}

	/**
	 * Prints table styles
	 *
	 * Computes and prints all the CSS variables used to style tables.
	 */
	public function resolve_and_print_table_css_variables() {
		$h1_font             = get_theme_mod( 'contentH1Font' );
		$bg_color            = self::get_bg_color();
		$web_is_dark         = self::is_web_dark( $bg_color );
		$thead_bg_color      = self::get_thead_bg_color( $h1_font, $web_is_dark );
		$thead_text_color    = ( 100 < Kirki_Color::get_brightness( $thead_bg_color ) ) ? '#ffffff' : '#222222';
		$odd_row_bg_color    = self::get_odd_row_bg_color();
		$even_row_bg_color   = Kirki_Color::adjust_brightness( $odd_row_bg_color, - 10 );
		$foot_row_bg_color   = Kirki_Color::adjust_brightness( $even_row_bg_color, - 25 );
		$row_text_color      = '#3f3f3f';
		$foot_row_text_color = '#3f3f3f';
		?>
		<style id="crdm_basic-css-vars-table">
			:root {
				--theadBgColor: <?php echo esc_html( $thead_bg_color ); ?>;
				--theadTextColor: <?php echo esc_html( $thead_text_color ); ?>;
				--oddRowBgColor: <?php echo esc_html( $odd_row_bg_color ); ?>;
				--evenRowBgColor: <?php echo esc_html( $even_row_bg_color ); ?>;
				--footRowBgColor: <?php echo esc_html( $foot_row_bg_color ); ?>;
				--rowTextColor: <?php echo esc_html( $row_text_color ); ?>;
				--footRowTextColor: <?php echo esc_html( $foot_row_text_color ); ?>;
			}
		</style>
		<?php
	}

	/**
	 * Prints separator styles
	 *
	 * Computes and prints all the CSS variables used to style separators.
	 */
	public function resolve_and_print_separator_css_variables() {
		$h1_font          = get_theme_mod( 'contentH1Font' );
		$content_hr_color = '#037b8c';
		if ( ! empty( $h1_font ) && isset( $h1_font['color'] ) ) {
			$content_hr_color = $h1_font['color'];
		}
		?>
		<style id="crdm_basic-css-vars-separator">
			:root {
				--contentHrColor: <?php echo esc_html( $content_hr_color ); ?>;
			}
		</style>
		<?php
	}

}
