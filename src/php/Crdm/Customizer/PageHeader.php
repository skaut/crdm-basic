<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class PageHeader {

	protected $configId  = '';
	protected $panelId   = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_pageHeader';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section(
			$this->sectionId,
			[
				'title'       => esc_attr__( 'Page header', 'crdm-basic' ),
				'description' => esc_attr__( 'Header with featured image and heading', 'crdm-basic' ),
				'panel'       => $this->panelId,
			]
		);
	}

	protected function initControls() {
		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'background',
				'settings'  => 'pageHeaderBg',
				'label'     => esc_attr__( 'Textbox background color', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
			$this->configId,
			[
				'type'        => 'spacing',
				'settings'    => 'pageHeaderPosition',
				'label'       => esc_attr__( 'Textbox position', 'crdm-basic' ),
				'description' => esc_attr__( 'Including units, e. g. "10px"', 'crdm-basic' ),
				'section'     => $this->sectionId,
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
			$this->configId,
			[
				'type'      => 'typography',
				'settings'  => 'pageHeaderH1Font',
				'label'     => esc_attr__( 'Heading', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
