define([
    'jquery',
    'mage/translate'
], function($, $t) {
    'use strict';
    
    $.widget('mageplaza.welcome', {
        _create: function () {
            this.element.text($t('Welcome ' + this.options.name));
        }
    });
    return $.mageplaza.welcome;
});