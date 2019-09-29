<?php
/**
 * Contains the Customizer_Category class.
 *
 * @package crdm-basic
 */

declare( strict_types=1 );

namespace CrdmBasic\Customizer;

/**
 * A customizer category (panel/section)
 *
 * This class contains all the functions used by a customizer category.
 */
abstract class Customizer_Category {
	/**
	 * Customizer_Category class constructor
	 *
	 * Adds the customize function to the WordPress action.
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'customize' ], 1000 );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_inline_css' ], 11 );
	}

	/**
	 * Initializes customizer options.
	 *
	 * Adds the panels, sections, settings and controls for the category to the WordPress customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress customizer manager.
	 */
	abstract public function customize( $wp_customize );

	/**
	 * Returns the styles for the category.
	 *
	 * Returns the styles for the category encoded in an array.
	 *
	 * @return array The styles.
	 */
	abstract protected function inline_css();

	/**
	 * Registers the inline CSS stylesheet
	 *
	 * Registers and enqueues an empty stylesheet to be used for the customizer-defined settings.
	 */
	public static function register_inline_css() {
		wp_register_style( 'crdm_customizer', false, [], CRDMBASIC_APP_VERSION );
		wp_enqueue_style( 'crdm_customizer' );
	}

	/**
	 * Adds the inline CSS to the page.
	 *
	 * Processes all the styles provided by `inline_css`, converts them to CSS and adds them to the page.
	 *
	 * @see inline_css
	 */
	public function add_inline_css() {
		$css = '';
		foreach ( $this->inline_css() as $selector => $properties ) {
			$css .= $selector . " {\n";
			foreach ( $properties as $property ) {
				if ( empty( $property[1] ) ) {
					continue;
				}
				if ( isset( $property[2] ) ) {
					switch ( $property[2] ) {
						case 'url':
							$value = 'url(\'' . esc_url( $property[1] ) . '\')';
							break;
						default:
							$value = esc_attr( $property[1] );
					}
				} else {
					$value = esc_attr( $property[1] );
				}
				$css .= $property[0] . ': ' . $value . ";\n";
			}
			$css .= "}\n";
		}
		wp_add_inline_style( 'crdm_customizer', $css );
	}
}

add_action( 'wp_enqueue_scripts', [ '\\CrdmBasic\\Customizer\\Customizer_Category', 'register_inline_css' ], 10 );
