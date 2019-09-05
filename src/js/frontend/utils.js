'use strict';

function browserSupportCssVariables() {
    var styles, doesSupport;
    var color = 'rgb(255, 198, 0)';
    var el = document.createElement( 'span' );

    el.style.setProperty( '--color', color );
    el.style.setProperty( 'background', 'var(--color)' );
    document.body.appendChild( el );

    styles = getComputedStyle( el );
    doesSupport = styles.backgroundColor === color;
    document.body.removeChild( el );
    return doesSupport;
}

export {browserSupportCssVariables};
