<?php declare( strict_types=1 );

namespace Crdm\Admin;

use Crdm\Customizer;

final class Init {

	public function __construct() {
		$this->initHooks();

		( new Customizer\Init() );
	}

	private function initHooks() {

	}

}