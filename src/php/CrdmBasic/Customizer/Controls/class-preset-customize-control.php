<?php
/**
 * Contains the Preset_Customize_Control class.
 *
 * @package crdm-basic
 */

declare(strict_types = 1);

namespace CrdmBasic\Customizer\Controls;

/**
 * A WP_Customize_Control choosing a preset
 *
 * Allows for choosing a preset for the whole webpage.
 */
class Preset_Customize_Control extends \WP_Customize_Control {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'crdm-basic-preset';

	/**
	 * Enqueues the JS.
	 *
	 * Enqueues the JavaScript file handling the Control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'crdm_basic_preset_customize_control', CRDMBASIC_TEMPLATE_URL . 'admin/preset_customize_control.js', [ 'jquery', 'customize-preview' ], CRDMBASIC_APP_VERSION, true );
		wp_localize_script(
			'crdm_basic_preset_customize_control',
			'crdmbasicPresetCustomizeControlLocalize',
			[
				'light' => $this->settings['light'],
				'dark'  => $this->settings['dark'],
			]
		);
	}

	/**
	 * Exports control parameters for JS.
	 *
	 * @inheritDoc
	 *
	public function to_json() {
		parent::to_json();

		//vardump($this->settings);
		//$this->json['settings'] = $this->value( $this->settings );
	}
	 */

	/**
	 * Prints the Underscore.js template for the control.
	 *
	 * @inheritDoc
	 */
	public function content_template() {
		?>
<label>
	<input type="radio" name="crdm_basic_preset" value="light"> Light <br>
</label>
<label>
	<input type="radio" name="crdm_basic_preset" value="Dark"> Dark <br>
</label>
<button type="button" class="button button-primary">GO</button>
		<?php
	}
}
