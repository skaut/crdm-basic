'use strict';

jQuery( 'document' ).ready( function( $ ) {
    generatepress_typography_live_update( 'navigation_font_size', '.main-navigation a, .menu-toggle', 'font-size', 'px', crdm_typography_live_preview.desktop );
    generatepress_typography_live_update( 'mobile_navigation_font_size', '.main-navigation:not(.slideout-navigation) a, .menu-toggle', 'font-size', 'px', crdm_typography_live_preview.mobile );
    generatepress_typography_live_update( 'navigation_font_weight', '.main-navigation a, .menu-toggle', 'font-weight' );
    generatepress_typography_live_update( 'navigation_font_transform', '.main-navigation a, .menu-toggle', 'text-transform' );
});
