<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Page_Header {

	protected $config_id  = '';
	protected $panel_id   = '';
	protected $section_id = '';

	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_pageHeader';

		$this->init_section();
		$this->init_controls();
	}

	protected function init_section() {
		Kirki::add_section(
			$this->section_id,
			[
				'title'       => esc_attr__( 'Page header', 'crdm-basic' ),
				'description' => esc_attr__( 'Header with featured image and heading', 'crdm-basic' ),
				'panel'       => $this->panel_id,
			]
		);
	}

	protected function init_controls() {
		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'background',
				'settings'  => 'pageHeaderBg',
				'label'     => esc_attr__( 'Textbox background color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'background-color'      => 'rgba(196, 219, 122, 0.79)',
					'background-image'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'left top',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => '.crdm_page-header_captions',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'        => 'spacing',
				'settings'    => 'pageHeaderPosition',
				'label'       => esc_attr__( 'Textbox position', 'crdm-basic' ),
				'description' => esc_attr__( 'Including units, e. g. "10px"', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => [
					'left'   => '0',
					'right'  => 'auto',
					'top'    => 'auto',
					'bottom' => '1.5em',
				],
				'output'      => [
					[
						'element' => '.crdm_page-header_captions',
					],
				],
				'transport'   => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'pageHeaderH1Font',
				'label'     => esc_attr__( 'Heading', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => '700',
					'font-size'      => '1.8rem',
					'line-height'    => '1.125',
					'letter-spacing' => 'inherit',
					'color'          => '#3c2314',
					'text-align'     => 'left',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => '.crdm_page-header_captions h1',
					],
				],
				'transport' => 'auto',
			]
		);
	}

}
