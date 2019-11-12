<?php
/**
 * Contains the Border_Radius class
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * Border radius configuration
 *
 * This class sets up all the customizer options for configuring the radius of corners of the webpage elements.
 */
class Border_Radius extends Customizer_Category {
	const DEFAULT = array(
		'crdm_basic_border_radius' => '',
	);

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panel, section, all the settings and controls to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	public function customize( $wp_customize ) {
		$wp_customize->add_section(
			'crdm_basic_border_radius',
			array(
				'capability' => 'edit_theme_options',
				'title'      => __( 'Border radius', 'crdm-basic' ),
				'priority'   => 25,
			)
		);

		$wp_customize->add_setting(
			'crdm_basic_border_radius',
			array(
				'default'    => self::DEFAULT['crdm_basic_border_radius'],
				'type'       => 'option',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'crdm_basic_border_radius',
			array(
				'type'        => 'text',
				'section'     => 'crdm_basic_border_radius',
				'label'       => __( 'Border radius', 'crdm-basic' ),
				'description' => __( 'Including units, e. g. "10px"', 'crdm-basic' ),
			)
		);
	}

	/**
	 * Returns the CSS for the background settings.
	 *
	 * Returns all the CSS properties for the background settings.
	 *
	 * @return array A list of properties in selectors.
	 */
	protected function inline_css() {
		$setting = get_option( 'crdm_basic_border_radius', self::DEFAULT['crdm_basic_border_radius'] );
		return array(
			'.widget-area .widget'       => array(
				array( 'border-radius', $setting ),
			),
			'.crdm_page-header_captions' => array(
				array( 'border-radius', $setting ),
			),
			'.main-navigation'           => array(
				array( 'border-radius', $setting ),
			),
			'.main-navigation .main-nav ul.sub-menu li:first-child a' => array(
				array( 'border-top-left-radius', $setting ),
				array( 'border-top-right-radius', $setting ),
			),
			'.main-navigation .main-nav ul.sub-menu li:last-child a' => array(
				array( 'border-bottom-left-radius', $setting ),
				array( 'border-bottom-right-radius', $setting ),
			),
		);
	}
}
