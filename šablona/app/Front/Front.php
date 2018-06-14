<?php declare( strict_types=1 );

namespace Crdm\Front;

final class Init {

	public function __construct() {
		$this->initHooks();
	}

	private function initHooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'loadAllStyles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'loadAllScripts' ] );
	}

	public function loadAllStyles() {

		if ( is_rtl() ) {
			wp_enqueue_style( 'generatepress-rtl', CRDM_BASIC_PARENT_TEMPLATE_URL . 'rtl.css' );
		}

		wp_enqueue_style( 'crdm-main',
			CRDM_BASIC_TEMPLATE_URL . 'assets/css/main.css',
			[],
			CRDM_BASIC_APP_VERSION
		);
	}

	public function loadAllScripts() {
		wp_enqueue_script( 'crdm-main',
			CRDM_BASIC_TEMPLATE_URL . 'assets/js/app.js',
			[ 'jquery' ],
			CRDM_BASIC_APP_VERSION,
			true
		);
	}

}