<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Footer {

	protected $configId  = '';
	protected $panelId   = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_footer';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section(
			$this->sectionId,
			[
				'title' => esc_attr__( 'Footer', 'crdm-basic' ),
				'panel' => $this->panelId,
			]
		);
	}

	protected function initControls() {
		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'background',
				'settings'  => 'footerBg',
				'label'     => esc_attr__( 'Background', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => [
					'background-color'      => '#ffffff',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'left top',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => '.footer-widgets',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'typography',
				'settings'  => 'footerTitlesFont',
				'label'     => esc_attr__( 'Heading 2 (H2)', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '20px',
					'line-height'    => '1.5',
					'letter-spacing' => 'inherit',
					'color'          => '#4e4e4d',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => '.footer-widgets .widget-title',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'typography',
				'settings'  => 'footerFont',
				'label'     => esc_attr__( 'Body', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '17px',
					'line-height'    => '1.5',
					'letter-spacing' => 'inherit',
					'color'          => '#9e9d9b',
				],
				'output'    => [
					[
						'element' => '.footer-widgets',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'color',
				'settings'  => 'footerLinksColor',
				'label'     => esc_attr__( 'Link color', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => '#037b8c',
				'output'    => [
					[
						'element'  => '.footer-widgets a, .footer-widgets a:visited, .footer-widgets a:hover',
						'property' => 'color',
					],
				],
				'transport' => 'auto',
			]
		);
	}

}
