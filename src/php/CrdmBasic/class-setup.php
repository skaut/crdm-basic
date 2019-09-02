<?php declare( strict_types=1 );

namespace CrdmBasic;

final class Setup {

	public function __construct() {
		( new Customizer\Init() );
	}
}
