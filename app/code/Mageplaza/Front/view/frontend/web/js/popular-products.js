define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/translate'
], function($, Component, ko, $t) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Mageplaza_Front/popular-products',
            title: $t('Popular Products'),
            products: []
        },
        getTitle: function () {
            return this.title;
        }
    });
});