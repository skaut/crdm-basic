'use strict';

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