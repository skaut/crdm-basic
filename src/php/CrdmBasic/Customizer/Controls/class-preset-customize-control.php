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
		wp_enqueue_style( 'crdm_basic_preset_customize_control_style', CRDMBASIC_TEMPLATE_URL . 'admin/preset_customize_control.css', [], CRDMBASIC_APP_VERSION );
		wp_enqueue_script( 'crdm_basic_preset_customize_control_script', CRDMBASIC_TEMPLATE_URL . 'admin/preset_customize_control.js', [ 'jquery', 'customize-preview' ], CRDMBASIC_APP_VERSION, true );
		wp_localize_script(
			'crdm_basic_preset_customize_control_script',
			'crdmbasicPresetCustomizeControlLocalize',
			$this->presets
		);
	}

	/**
	 * Exports control parameters for JS.
	 *
	 * @inheritDoc
	 */
	public function to_json() {
		parent::to_json();

		$this->json['light_image'] = CRDMBASIC_TEMPLATE_URL . 'admin/light.png';
		$this->json['dark_image']  = CRDMBASIC_TEMPLATE_URL . 'admin/dark.png';
		$this->json['light']       = esc_html__( 'Light', 'crdm-basic' );
		$this->json['dark']        = esc_html__( 'Dark', 'crdm-basic' );
		$this->json['warning']     = esc_html__( 'Applying the preset overrides a lot of the theme options. You can always go back by closing the customizer.', 'crdm-basic' );
		$this->json['button']      = esc_html__( 'Apply', 'crdm-basic' );
	}

	/**
	 * Prints the Underscore.js template for the control.
	 *
	 * @inheritDoc
	 */
	public function content_template() {
		?>
<label>
	<input type="radio" name="crdm_basic_preset" value="light"> {{{ data.light }}}
	<img class="crdmbasic_preset_customize_control_img" src="{{{ data.light_image }}}" alt="{{{ data.light }}}">
</label>
<label>
	<input type="radio" name="crdm_basic_preset" value="dark"> {{{ data.dark }}}
	<img class="crdmbasic_preset_customize_control_img" src="{{{ data.dark_image }}}" alt="{{{ data.dark }}}">
</label>
<div>
	{{{ data.warning }}}
</div>
<button type="button" class="crdmbasic_preset_customize_control_button button button-primary" disabled> {{{ data.button}}} </button>
		<?php
	}
}
