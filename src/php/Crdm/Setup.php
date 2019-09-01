<?php declare( strict_types=1 );

namespace Crdm;

final class Setup {

	public function __construct() {
		( new Customizer\Init() );
	}
}
