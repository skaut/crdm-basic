'use strict';

function log(msg) {
    return console.log(msg);
}

function intval(v) {
    v = parseInt(v);
    return isNaN(v) ? 0 : v;
}

function isTouchDevice() {
    return (
        !!(typeof window !== 'undefined' &&
            ('ontouchstart' in window ||
                (window.DocumentTouch &&
                    typeof document !== 'undefined' &&
                    document instanceof window.DocumentTouch))) ||
        !!(typeof navigator !== 'undefined' &&
            (navigator.maxTouchPoints || navigator.msMaxTouchPoints))
    );
}

function browserSupportCssVariables() {
    var color = 'rgb(255, 198, 0)';
    var el = document.createElement('span');

    el.style.setProperty('--color', color);
    el.style.setProperty('background', 'var(--color)');
    document.body.appendChild(el);

    var styles = getComputedStyle(el);
    var doesSupport = styles.backgroundColor === color;
    document.body.removeChild(el);
    return doesSupport;
}

export {log, intval, isTouchDevice, browserSupportCssVariables};