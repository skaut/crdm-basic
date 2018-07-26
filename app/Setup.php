<?php declare( strict_types=1 );

namespace Crdm;

final class Setup {

	public function __construct() {
		$this->initHooks();

		( new Customizer\Init() );
	}

	private function initHooks() {

	}

}