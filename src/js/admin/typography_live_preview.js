'use strict';

jQuery( 'document' ).ready( function( $ ) {
    generatepress_typography_live_update( 'navigation_font_size', '.main-navigation a, .menu-toggle', 'font-size', 'px', crdmTypographyLivePreview.desktop );
    generatepress_typography_live_update( 'mobile_navigation_font_size', '.main-navigation:not(.slideout-navigation) a, .menu-toggle', 'font-size', 'px', crdmTypographyLivePreview.mobile );
    generatepress_typography_live_update( 'navigation_font_weight', '.main-navigation a, .menu-toggle', 'font-weight' );
    generatepress_typography_live_update( 'navigation_font_transform', '.main-navigation a, .menu-toggle', 'text-transform' );

    generatepress_typography_live_update( 'heading_1_font_size', 'h1', 'font-size', 'px', crdmTypographyLivePreview.desktop );
    generatepress_typography_live_update( 'mobile_heading_1_font_size', 'h1', 'font-size', 'px', crdmTypographyLivePreview.mobile );
    generatepress_typography_live_update( 'heading_1_weight', 'h1', 'font-weight' );
    generatepress_typography_live_update( 'heading_1_transform', 'h1', 'text-transform' );
    generatepress_typography_live_update( 'heading_1_line_height', 'h1', 'line-height', 'em' );
    generatepress_typography_live_update( 'heading_1_margin_bottom', 'h1', 'margin-bottom', 'px' );

    generatepress_typography_live_update( 'heading_2_font_size', 'h2', 'font-size', 'px', crdmTypographyLivePreview.desktop );
    generatepress_typography_live_update( 'mobile_heading_2_font_size', 'h2', 'font-size', 'px', crdmTypographyLivePreview.mobile );
    generatepress_typography_live_update( 'heading_2_weight', 'h2', 'font-weight' );
    generatepress_typography_live_update( 'heading_2_transform', 'h2', 'text-transform' );
    generatepress_typography_live_update( 'heading_2_line_height', 'h2', 'line-height', 'em' );
    generatepress_typography_live_update( 'heading_2_margin_bottom', 'h2', 'margin-bottom', 'px' );
});
