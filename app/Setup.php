<?php declare( strict_types=1 );

namespace Crdm;

final class Setup {

	public function __construct() {
		$this->initHooks();
	}

	private function initHooks() {
		add_action( 'init', [ $this, 'flushRewriteRulesIfNecessary' ] );
		//add_action( 'after_setup_theme', [ $this, 'addThemeSupports' ] );
	}

	public function flushRewriteRulesIfNecessary() {
		if ( get_option( 'crdm_basic_rewrite_rules_need_to_flush' ) ) {
			flush_rewrite_rules();
			delete_option( 'crdm_basic_rewrite_rules_need_to_flush' );
		}
	}

}