<?php declare( strict_types=1 );

namespace Crdm\Admin;

final class Init {

	public function __construct() {
		$this->initHooks();

		( new PageSubtitle() );
	}

	private function initHooks() {

	}

}