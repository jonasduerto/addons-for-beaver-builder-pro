(function ($) {

    LABBOdometers = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBOdometers.prototype = {

        nodeClass: '',

        _init: function () {

            if ($().waypoint === undefined) {
                return;
            }

            $(this.nodeClass).find(' .labb-odometers').waypoint(function (direction) {

                $(this.element).find('.labb-odometer .labb-number').each(function () {

                    var odometer = $(this);

                    setTimeout(function () {
                        var data_stop = odometer.attr('data-stop');
                        $(odometer).text(data_stop);

                    }, 100);


                });

            }, {
                offset: Waypoint.viewportHeight() - 100,
                triggerOnce: true
            });


        },
    };

})(jQuery);

