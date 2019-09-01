<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Kirki;

class Menu {

	protected $configId  = '';
	protected $panelId   = '';
	protected $sectionId = '';

	public function __construct( string $configId, string $panelId ) {
		$this->configId  = $configId;
		$this->panelId   = $panelId;
		$this->sectionId = $panelId . '_menu';

		$this->initSection();
		$this->initControls();
	}

	protected function initSection() {
		Kirki::add_section(
			$this->sectionId,
			[
				'title' => esc_attr__( 'Menu', 'crdm-basic' ),
				'panel' => $this->panelId,
			]
		);
	}

	protected function initControls() {
		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'background',
				'settings'  => 'menuBg',
				'label'     => esc_attr__( 'Menu background', 'crdm-basic' ),
				'section'   => $this->sectionId,
				'default'   => [
					'background-color'      => '#037b8c',
					'background-image'      => '',
					'background-repeat'     => 'repeat',
					'background-position'   => 'center center',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
				],
				'output'    => [
					[
						'element' => '.main-navigation, .main-navigation .main-nav ul li[class*="current-menu-"] > a, .main-navigation .main-nav ul li[class*="current-menu-"] > a:hover, .main-navigation .main-nav ul li[class*="current-menu-"].sfHover > a',
					],
				],
				'transport' => 'auto',
			]
		);

		Kirki::add_field(
			$this->configId,
			[
				'type'      => 'typography',
				'settings'  => 'menuFont',
				'label'     => esc_attr__( 'Menu items', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
			$this->configId,
			[
				'type'      => 'color',
				'settings'  => 'menuSeparatorColor',
				'label'     => esc_attr__( 'Menu item separator color', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
			$this->configId,
			[
				'type'      => 'background',
				'settings'  => 'submenuBg',
				'label'     => esc_attr__( 'Dropdown menu background', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
			$this->configId,
			[
				'type'      => 'typography',
				'settings'  => 'submenuFont',
				'label'     => esc_attr__( 'Dropdown menu items', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
			$this->configId,
			[
				'type'      => 'color',
				'settings'  => 'submenuSeparatorColor',
				'label'     => esc_attr__( 'Dropdown menu item separator color', 'crdm-basic' ),
				'section'   => $this->sectionId,
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
