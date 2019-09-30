<?php
/**
 * Contains the Color_Customize_Control class.
 *
 * @package crdm-basic
 */

declare(strict_types = 1);

namespace CrdmBasic\Customizer\Controls;

/**
 * A WP_Customize_Control for color selection.
 *
 * Allows for TODO.
 */
class Color_Customize_Control extends \WP_Customize_Control {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'crdm-basic-color';

	/**
	 * Exports control parameters for JS.
	 *
	 * @inheritDoc
	 */
	public function to_json() {
		parent::to_json();
	}

	/**
	 * Prints the Underscore.js template for the control.
	 *
	 * @inheritDoc
	 */
	public function content_template() {
		?>
<b>GO</b>
		<?php
	}
}
