<?php declare( strict_types=1 );

namespace Crdm\Customizer;

use Crdm\Utils\Helpers;

class Init {

	public function __construct() {
		$this->initHooks();
	}

	protected function initHooks() {
		add_action( 'customize_register', [ $this, 'registerSettingsAndControls' ] );
		add_action( 'wp_head', [ $this, 'printValuesToPage' ] );
		add_action( 'customize_preview_init', [ $this, 'customizerLivePreview' ] );
	}

	public function registerSettingsAndControls( \WP_Customize_Manager $Customizer ) {
		$Customizer->add_setting( 'crdm_basic_theme_options[text_color]', [
			'default'           => '#000',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage'
		] );

		$Customizer->add_control( new \WP_Customize_Color_Control( $Customizer, 'text_color', [
			'label'    => __( 'Výchozí barva textu', 'crdm_basic' ),
			'section'  => 'colors',
			'settings' => 'crdm_basic_theme_options[text_color]',
		] ) );
	}

	public function printValuesToPage() {
		if ( Helpers::getThemeOption( 'text_color' ) ) {
			?>
			<style type="text/css">
				body {
					color: <?php echo Helpers::getThemeOption( 'text_color' ); ?> !important;
				}
			</style>
			<?php
		}
	}

	public function customizerLivePreview() {
		wp_enqueue_script(
			'crdm-theme_customizer',
			CRDM_BASIC_TEMPLATE_URL . 'app/Customizer/customizer.js',
			[ 'jquery', 'customize-preview' ],
			CRDM_BASIC_APP_VERSION,
			true
		);
	}

}