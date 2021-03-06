(function ($) {

    LABBCountdown = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBCountdown.prototype = {

        nodeClass: '',

        _init: function () {

            var countdown_elem = $(this.nodeClass).find(' .labb-countdown').eq(0);

            var end_date = countdown_elem.data('end-date');
            if (end_date) {
                countdown_elem.countdown(end_date, function (event) {
                    $(this).html(
                        event.strftime('<ul><li><span>%D</span>Days</li><li><span>%H</span>Hour</li><li><span>%M</span>Min</li><li><span>%S</span>Sec</li></ul>')
                    );
                });
            }
        },
    };

})(jQuery);

