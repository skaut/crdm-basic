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
	 * The available presets
	 *
	 * @var array
	 */
	private $presets;

	/**
	 * Preset_Customize_Control constructor.
	 *
	 * Initializes the available presets.
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id Control ID.
	 * @param array                 $args Control arguments.
	 * @param array                 $presets The available presets.
	 *
	 * @inheritDoc
	 *
	 * @SuppressWarnings(PHPMD.ShortVariable)
	 */
	public function __construct( $manager, $id, $args, $presets = [] ) {
		parent::__construct( $manager, $id, $args );

		$this->presets = $presets;
	}

	/**
	 * Enqueues the JS.
	 *
	 * Enqueues the JavaScript file handling the Control.
	 *
	 * @inheritDoc
	 */
	public function enqueue() {
		wp_enqueue_script( 'crdm_basic_preset_customize_control', CRDMBASIC_TEMPLATE_URL . 'admin/preset_customize_control.js', [ 'jquery', 'customize-preview' ], CRDMBASIC_APP_VERSION, true );
		wp_localize_script(
			'crdm_basic_preset_customize_control',
			'crdmbasicPresetCustomizeControlLocalize',
			$this->presets
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
	<input type="radio" name="crdm_basic_preset" value="dark"> Dark <br>
</label>
<button type="button" class="button button-primary">GO</button>
		<?php
	}
}
