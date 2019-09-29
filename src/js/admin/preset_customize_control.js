'use strict';

jQuery( 'document' ).ready( function( $ ) {
    wp.customize.control(
        'crdm_basic_preset',
        function( control ) {
            console.log( crdmbasicPresetCustomizeControlLocalize );
            control.container.find( '.button' ).on( 'click', function() {
                console.log( 'CLICK' );
                console.log( wp.customize( 'generate_background_settings[body_image]' ).get() );
                console.log( wp.customize( 'generate_background_settings[body_repeat]' ).get() );
                console.log( wp.customize( 'generate_background_settings[body_size]' ).get() );
                console.log( wp.customize( 'generate_background_settings[body_attachment]' ).get() );
                console.log( wp.customize( 'generate_background_settings[body_position]' ).get() );
                console.log( wp.customize( 'crdm_basic_header[background]' ).get() );
                console.log( wp.customize( 'crdm_basic_header[foreground]' ).get() );
                console.log( wp.customize( 'crdm_basic_header[under]' ).get() );
            });
        }
    );
});
