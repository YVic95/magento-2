define([
    'jquery'
], function($) {
    return function (originalWidget) {
        // originalWidget._proto._onEvent = function() {
        //     console.log('777');
        // }
        // return originalWidget;
        $.widget('mageplaza.redirectUrl', originalWidget, {
            //Redefine _onEvent method
            _onEvent: function () {
                console.log('widget extension via mixins');
                //Call parents method if needed
                return this._super();
            }
        });
        return $.mageplaza.redirectUrl;
    }   
});