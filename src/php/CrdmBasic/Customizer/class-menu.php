<?php
/**
 * Contains the Menu class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

use Kirki;

/**
 * Menu configuration
 *
 * This class sets up all the customizer options for configuring the menu.
 */
class Menu {

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
	 * Menu class constructor
	 *
	 * Adds the section and its controls to the customizer.
	 *
	 * @param string $config_id The ID of the configuration set ("crdm-basic").
	 * @param string $panel_id The ID of the panel in which this option is displayed.
	 */
	public function __construct( string $config_id, string $panel_id ) {
		$this->config_id  = $config_id;
		$this->panel_id   = $panel_id;
		$this->section_id = $panel_id . '_menu';

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
				'title' => esc_attr__( 'Menu', 'crdm-basic' ),
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
				'type'      => 'typography',
				'settings'  => 'menuFont',
				'label'     => esc_attr__( 'Menu items', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'Patrick Hand',
					'variant'        => 'regular',
					'font-size'      => '16px',
					'line-height'    => '37px',
					'letter-spacing' => 'inherit',
					'color'          => '#efefe5',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => '.main-navigation .main-nav > ul > li > a, .main-navigation .main-nav ul li[class*="current-menu-"] > a, .main-navigation .main-nav ul li[class*="current-menu-"] > a:hover, .main-navigation .main-nav ul li[class*="current-menu-"].sfHover > a',
					],
					[
						'choice'   => 'color',
						'element'  => '.dropdown-menu-toggle:before',
						'property' => 'color',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'color',
				'settings'  => 'menuSeparatorColor',
				'label'     => esc_attr__( 'Menu item separator color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => '#3b969f',
				'output'    => [
					[
						'element'  => '.main-nav > ul > li > a:after',
						'property' => 'background-color',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'background',
				'settings'  => 'submenuBg',
				'label'     => esc_attr__( 'Dropdown menu background', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'background-color'      => '#65c3d4',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => '.main-navigation .main-nav .sub-menu li a, .main-navigation .main-nav ul ul li:hover > a, .main-navigation .main-nav ul ul li:focus > a',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'typography',
				'settings'  => 'submenuFont',
				'label'     => esc_attr__( 'Dropdown menu items', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => [
					'font-family'    => 'Patrick Hand',
					'variant'        => 'regular',
					'font-size'      => '14px',
					'line-height'    => 'normal',
					'letter-spacing' => 'inherit',
					'color'          => '#ffffff',
					'text-transform' => 'none',
				],
				'output'    => [
					[
						'element' => '.main-navigation .main-nav .sub-menu li a, .main-navigation .main-nav ul ul li:hover > a, .main-navigation .main-nav ul ul li:focus > a, .main-navigation .main-nav ul ul li.sfHover > a',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->config_id,
			[
				'type'      => 'color',
				'settings'  => 'submenuSeparatorColor',
				'label'     => esc_attr__( 'Dropdown menu item separator color', 'crdm-basic' ),
				'section'   => $this->section_id,
				'default'   => '#ffffff',
				'output'    => [
					[
						'element'  => '.main-navigation .main-nav ul ul li a',
						'property' => 'border-top-color',
					],
				],
				'transport' => 'auto',
			]
		);
	}

}
