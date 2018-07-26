(function ($) {
    "use strict";

    if (typeof wp === 'undefined') {
        return;
    }

    wp.customize('crdm_basic_theme_options[text_color]', function (value) {
        value.bind(function (newval) {
            $('body, a, a:visited').css('color', newval);
        });
    });
})(jQuery);