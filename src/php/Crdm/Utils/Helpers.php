<?php declare( strict_types=1 );

namespace Crdm\Utils;

class Helpers {

	const CRDM_BASIC_OPTIONS_NAME = 'crdm_basic_theme';

	public static function normalizeUrl( string $url = '' ): string {
		if ( $url === '' || $url === 'http://' || $url === 'https://' ) {
			return '';
		}
		if ( strpos( $url, '://' ) < 0 ) {
			$url = 'http://' . $url;
		}

		return esc_url( $url );
	}

	public static function flushRewriteRules() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	public static function isAjax(): bool {
		return ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	}

	public static function showAdminNotice( string $message, string $type = 'warning', string $hideNoticeOnPage = '' ) {
		add_action( 'admin_notices', function () use ( $message, $type, $hideNoticeOnPage ) {
			if ( ! $hideNoticeOnPage || $hideNoticeOnPage != get_current_screen()->id ) {
				$class = 'notice notice-' . $type . ' is-dismissible';
				printf( '<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss">
		<span class="screen-reader-text">' . esc_html__( 'Close', 'crdm-basic' ) . '</span>
	</button></div>', esc_attr( $class ), $message );
			}
		} );
	}

	public static function getThemeOption( string $optionName ) {
		static $options = [];

		if ( empty( $options ) ) {
			$options = get_theme_mod( self::CRDM_BASIC_OPTIONS_NAME );
		}

		return ( isset( $options[ $optionName ] ) ) ? $options[ $optionName ] : false;
	}

}
