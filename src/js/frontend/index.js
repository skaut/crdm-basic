import '../../css/frontend/main.scss';
import cssVars from 'css-vars-ponyfill';
import {browserSupportCssVariables} from './utils';

'use strict';

if ( ! browserSupportCssVariables() ) {
    cssVars(); // css variables polyfill for IE9+
}
