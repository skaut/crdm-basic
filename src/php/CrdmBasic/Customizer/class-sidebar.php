<?php
/**
 * Contains the Sidebar class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

/**
 * Sidebar configuration
 *
 * This class sets up all the customizer options for configuring the sidebar.
 */
class Sidebar {

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
	 * Sidebar class constructor
	 *
	 * Adds the section and its controls to the customizer.
	 *
	 * @param string $config_id The ID of the configuration set ("crdm-basic").
	 * @param string $panel_id The ID of the panel in which this option is displayed.
	 */
	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_sidebar';

		$this->init_section();
		$this->init_controls();
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
				'title' => esc_attr__( 'Sidebars', 'crdm-basic' ),
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
				'settings'  => 'sidebarBg',
				'label'     => esc_attr__( 'Background', 'crdm-basic' ),
				'section'   => $this->section_id,
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
						'element' => '.sidebar .widget',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'color',
				'settings'  => 'sidebarBoxshadowColor',
				'label'     => esc_attr__( 'Box shadow color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => 'rgba(240, 240, 240, 0.75)',
				'output'    => [
					[
						'element'       => '.sidebar .widget',
						'property'      => 'box-shadow',
						'value_pattern' => '0 -5px 0 0 $, 0 5px 0 0 $',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'sidebarTitlesFont',
				'label'     => esc_attr__( 'Heading 2 (H2)', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '20px',
					'line-height'    => '1.5',
					'letter-spacing' => 'inherit',
					'color'          => '#000000',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => '.sidebar .widget .widget-title',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'sidebarFont',
				'label'     => esc_attr__( 'Body', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'PT Sans',
					'variant'        => 'regular',
					'font-size'      => '17px',
					'line-height'    => '1.5',
					'letter-spacing' => 'inherit',
					'color'          => '#3a3a3a',
				],
				'output'    => [
					[
						'element' => '.sidebar .widget',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'color',
				'settings'  => 'sidebarLinksColor',
				'label'     => esc_attr__( 'Link color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => '#037b8c',
				'output'    => [
					[
						'element'  => '.sidebar .widget a, .sidebar .widget a:visited, .sidebar .widget a:hover',
						'property' => 'color',
					],
					[
						'element'  => '.simcal-calendar-head .simcal-nav .simcal-nav-button',
						'property' => 'color',
					],
				],
				'transport' => 'auto',
			]
		);
	}

}
