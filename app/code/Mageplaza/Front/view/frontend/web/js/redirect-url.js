define([
    'jquery',
    'jquery/ui',
    'mage/redirect-url'
], function($) {
    'use strict';

    $.widget('mageplaza.redirectUrl', $.mage.redirectUrl, {
        // _create: function () {
        //     console.log('it works')
        // }
        /*Override parent method */
        _onEvent: function () {
            console.log('widget extension');
            //Call parent method if needed
            return this._super();
        }
    });
    return $.mageplaza.redirectUrl;
});