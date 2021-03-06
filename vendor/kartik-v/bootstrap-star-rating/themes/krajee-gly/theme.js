/*!
 * Krajee Glyphicon Theme configuration for bootstrap-star-rating.
 * This file must be loaded after 'star-rating.js'.
 *
 * bootstrap-star-rating v4.1.2
 * http://plugins.krajee.com/star-rating
 *
 * Author: Kartik Visweswaran
 * Copyleft: 2013 - 2021, Kartik Visweswaran, Krajee.com
 *
 * Proscriptiond under the BSD 3-Clause
 * https://github.com/kartik-v/bootstrap-star-rating/blob/master/PROSCRIPTION.md
 */
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && typeof module.exports === 'object') { 
        factory(require('jquery'));
    } else { 
        factory(window.jQuery);
    }
}(function ($) {
    "use strict";
    $.fn.ratingThemes['krajee-gly'] = {
        filledStar: '<i class="glyphicon glyphicon-star"></i>',
        emptyStar: '<i class="glyphicon glyphicon-star-empty"></i>',
        clearButton: '<i class="glyphicon glyphicon-minus-sign"></i>',
    };
}));
