<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;
use Kirki_Color;

class Content {

	protected $configId = '';
	protected $panelId = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_content';

		$this->initHooks();
		$this->initSection();
		$this->initControls();
	}

	protected function initHooks() {
		add_action( 'wp_head', [ $this, 'resolveAndPrintListCssVariables' ], 0 );
		add_action( 'wp_head', [ $this, 'resolveAndPrintTableCssVariables' ], 0 );
		add_action( 'wp_head', [ $this, 'resolveAndPrintSeparatorCssVariables' ], 0 );
	}

	protected function initSection() {
		Kirki::add_section( $this->sectionId, [
			'title' => esc_attr__( 'Obsah', 'crdm_basic' ),
			'panel' => $this->panelId
		] );
	}

	protected function initControls() {
		Kirki::add_field( $this->configId, [
			'type'      => 'background',
			'settings'  => 'contentBg',
			'label'     => esc_attr__( 'Pozadí', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'background-color'      => 'transparent',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'left top',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll'
			],
			'output'    => [
				[
					'element' => '#page'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentFont',
			'label'     => esc_attr__( 'Běžný text', 'crdm_basic' ),
			'section'   => $this->sectionId,
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
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'color',
			'settings'  => 'contentLinksColor',
			'label'     => esc_attr__( 'Barva odkazů', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => '#037b8c',
			'output'    => [
				[
					'element'  => 'body .site-main a, body .site-main a:visited, body .site-main a:hover',
					'property' => 'color'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'        => 'typography',
			'settings'    => 'contentH1Font',
			'label'       => esc_attr__( 'Nadpis (H1)', 'crdm_basic' ),
			'description' => esc_attr__( 'Barva bude použita i pro další prvky na stránce (seznamy, tabulky, ...)', 'crdm_basic' ),
			'section'     => $this->sectionId,
			'default'     => [
				'font-family'    => 'PT Sans',
				'variant'        => '700',
				'font-size'      => '2.3em',
				'line-height'    => '1.15',
				'letter-spacing' => 'inherit',
				'color'          => '#037b8c',
				'text-transform' => 'none'
			],
			'output'      => [
				[
					'element' => 'body .site-main h1',
				]
			],
			'transport'   => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentH2Font',
			'label'     => esc_attr__( 'Nadpis (H2)', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'font-family'    => 'PT Sans',
				'variant'        => 'regular',
				'font-size'      => '2.2em',
				'line-height'    => '1.2',
				'letter-spacing' => 'inherit',
				'color'          => '#037b8c',
				'text-transform' => 'none'
			],
			'output'    => [
				[
					'element' => 'body .site-main h2'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentH3Font',
			'label'     => esc_attr__( 'Nadpis (H3)', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'font-family'    => 'PT Sans',
				'variant'        => '700',
				'font-size'      => '1.8em',
				'line-height'    => '1.25',
				'letter-spacing' => 'inherit',
				'color'          => '#00011f',
				'text-transform' => 'none'
			],
			'output'    => [
				[
					'element' => 'body .site-main h3'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentH4Font',
			'label'     => esc_attr__( 'Nadpis (H4)', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'font-family'    => 'PT Sans',
				'variant'        => 'regular',
				'font-size'      => '1.8em',
				'line-height'    => '1.25',
				'letter-spacing' => 'inherit',
				'color'          => '#037b8c',
				'text-transform' => 'none'
			],
			'output'    => [
				[
					'element' => 'body .site-main h4'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentH5Font',
			'label'     => esc_attr__( 'Nadpis (H5)', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'font-family'    => 'PT Sans',
				'variant'        => '700',
				'font-size'      => '1.5em',
				'line-height'    => '1.3',
				'letter-spacing' => 'inherit',
				'color'          => '#00011f',
				'text-transform' => 'none'
			],
			'output'    => [
				[
					'element' => 'body .site-main h5'
				]
			],
			'transport' => 'auto'
		] );

		Kirki::add_field( $this->configId, [
			'type'      => 'typography',
			'settings'  => 'contentH6Font',
			'label'     => esc_attr__( 'Nadpis (H6)', 'crdm_basic' ),
			'section'   => $this->sectionId,
			'default'   => [
				'font-family'    => 'PT Sans',
				'variant'        => 'regular',
				'font-size'      => '1.5em',
				'line-height'    => '1.3',
				'letter-spacing' => 'inherit',
				'color'          => '#00011f',
				'text-transform' => 'none'
			],
			'output'    => [
				[
					'element' => 'body .site-main h6'
				]
			],
			'transport' => 'auto'
		] );
	}

	public function resolveAndPrintListCssVariables() {
		$h1Font             = get_theme_mod( 'contentH1Font' );
		$listPrimaryColor   = '#037b8c';
		$listSecondaryColor = '#65c3d4';
		if ( ! empty( $h1Font ) && isset( $h1Font['color'] ) ) {
			$listPrimaryColor   = $h1Font['color'];
			$listSecondaryColor = Kirki_Color::adjust_brightness( $listPrimaryColor, 62 );
		}
		?>
		<style id="crdm_basic-css-vars-list">
			:root {
				--listPrimaryColor: <?php echo esc_html( $listPrimaryColor ); ?>;
				--listSecondaryColor: <?php echo esc_html( $listSecondaryColor ); ?>;
			}
		</style>
		<?php
	}

	public function resolveAndPrintTableCssVariables() {
		$h1Font           = get_theme_mod( 'contentH1Font' );
		$theadBgColor     = '#65c3d4';
		$theadTextColor   = '#ffffff';
		$oddRowBgColor    = '#ffffff';
		$evenRowBgColor   = '#f6f6f6';
		$footRowBgColor   = '#dddddd';
		$rowTextColor     = '#3f3f3f';
		$footRowTextColor = '#3f3f3f';

		$bgColor = get_theme_mod( 'contentBg' );
		if ( empty( $bgColor ) || ! isset( $bgColor['background-color'] ) || substr( $bgColor['background-color'], 0, 1 ) != '#' ) {
			$bgColor = get_theme_mod( 'webBg' );
		}
		if ( ! empty( $bgColor ) && isset( $bgColor['background-color'] ) && substr( $bgColor['background-color'], 0, 1 ) === '#' ) {
			$webIsDark = ( 125 > Kirki_Color::get_brightness( $bgColor['background-color'] ) ) ? true : false;
		} else {
			$webIsDark = false;
		}

		if ( ! empty( $h1Font ) && isset( $h1Font['color'] ) ) {
			$steps = 70;
			if ( $webIsDark ) {
				$steps *= - 1;
			}
			$theadBgColor   = Kirki_Color::adjust_brightness( $h1Font['color'], $steps );
			$theadTextColor = ( 100 < Kirki_Color::get_brightness( $theadBgColor ) ) ? '#ffffff' : '#222222';
		}

		if ( ! empty( $bgColor ) && isset( $bgColor['background-color'] ) && substr( $bgColor['background-color'], 0, 1 ) === '#' ) {
			$oddRowBgColor    = ( Kirki_Color::brightness_difference( $bgColor['background-color'], '#ffffff' ) < 10 ) ? '#eeeeee' : '#ffffff';
			$evenRowBgColor   = Kirki_Color::adjust_brightness( $oddRowBgColor, - 10 );
			$footRowBgColor   = Kirki_Color::adjust_brightness( $evenRowBgColor, - 25 );
			$footRowTextColor = ( 125 < Kirki_Color::get_brightness( $footRowTextColor ) ) ? '#eeeeee' : $footRowTextColor;

			if ( $oddRowBgColor === '#cccccc' ) {
				$rowTextColor = '#ffffff';
			}
		}
		?>
		<style id="crdm_basic-css-vars-table">
			:root {
				--theadBgColor: <?php echo esc_html( $theadBgColor ); ?>;
				--theadTextColor: <?php echo esc_html( $theadTextColor ); ?>;
				--oddRowBgColor: <?php echo esc_html( $oddRowBgColor ); ?>;
				--evenRowBgColor: <?php echo esc_html( $evenRowBgColor ); ?>;
				--footRowBgColor: <?php echo esc_html( $footRowBgColor ); ?>;
				--rowTextColor: <?php echo esc_html( $rowTextColor ); ?>;
				--footRowTextColor: <?php echo esc_html( $footRowTextColor ); ?>;
			}
		</style>
		<?php
	}

	public function resolveAndPrintSeparatorCssVariables() {
		$h1Font         = get_theme_mod( 'contentH1Font' );
		$contentHrColor = '#037b8c';
		if ( ! empty( $h1Font ) && isset( $h1Font['color'] ) ) {
			$contentHrColor = $h1Font['color'];
		}
		?>
		<style id="crdm_basic-css-vars-separator">
			:root {
				--contentHrColor: <?php echo esc_html( $contentHrColor ); ?>;
			}
		</style>
		<?php
	}

}