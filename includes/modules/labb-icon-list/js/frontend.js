(function ($) {

    LABBIconList = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBIconList.prototype = {

        nodeClass: '',

        _init: function () {

            if ($().powerTip === undefined) {
                return;
            }

            var icon_list = $(this.nodeClass).find(' .labb-icon-list').eq(0);

            icon_list.find('.labb-icon-list-item').powerTip({
                placement: 'n' // north-east tooltip position
            });
        },
    };

})(jQuery);

