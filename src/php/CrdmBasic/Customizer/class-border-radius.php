<?php declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

class Border_Radius {

	protected $config_id  = '';
	protected $panel_id   = '';
	protected $section_id = '';

	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_borderRadius';

		$this->init_section();
		$this->init_controls();
	}

	protected function init_section() {
		Kirki::add_section(
			$this->section_id,
			[
				'title' => esc_attr__( 'Border radius', 'crdm-basic' ),
				'panel' => $this->panel_id,
			]
		);
	}

	protected function init_controls() {
		Kirki::add_field(
			$this->config_id,
			[
				'type'        => 'dimension',
				'settings'    => 'borderRadius',
				'label'       => esc_attr__( 'Border radius', 'crdm-basic' ),
				'description' => esc_attr__( 'Including units, e. g. "10px"', 'crdm-basic' ),
				'section'     => $this->section_id,
				'default'     => '0px',
				'css_vars'    => [
					[ '--main-border-radius' ],
				],
				'transport'   => 'auto',
			]
		);
	}

}
