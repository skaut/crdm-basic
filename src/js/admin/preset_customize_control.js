import '../../scss/admin/preset_customize_control.scss';
'use strict';

jQuery( 'document' ).ready( function( $ ) {
    function flatten( input ) {
        const ret = {};
        $.each( input, function( key, value ) {
            if ( 'object' === typeof ( value ) ) {
                $.each( value, function( subKey, subValue ) {
                    ret[key + '[' + subKey + ']'] = subValue;
                });
            } else {
                ret[key] = value;
            }
        });
        return ret;
    }

    wp.customize.control(
        'crdm_basic_preset',
        function( control ) {
            const presets = [];
            $.each( crdmbasicPresetCustomizeControlLocalize, function( key, value ) {
                presets[key] = flatten( value );
            });
            control.container.find( 'input[name=crdm_basic_preset]' ).change( function() {
                control.container.find( '.button' ).prop( 'disabled', false );
            });
            control.container.find( '.button' ).on( 'click', function() {
                const chosen =  control.container.find( 'input[name=crdm_basic_preset]:checked' ).val();
                if ( ! chosen ) {
                    console.log( 'FAIL' );
                    return;
                }
                $.each( presets[chosen], function( key, value ) {
                    const setting = wp.customize( key );
                    if ( ! setting ) {
                        return;
                    }
                    setting.set( value );
                });
            });
        }
    );
});
