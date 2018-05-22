(function ($) {

    LABBAccordion = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this.toggle = settings.toggle;
        this.expanded = settings.expanded;
        this._init();
    };

    LABBAccordion.prototype = {

        nodeClass: '',
        toggle: false,
        expanded: false,
        current: null,

        _init: function () {

            var self = this;
                $panels = $(this.nodeClass + ' .labb-accordion').find('.labb-panel');

            if (this.expanded && this.toggle) {

                // Display all panels
                $panels.each(function () {

                    var $panel = jQuery(this);

                    self._show($panel);

                });
            }

            $panels.find('.labb-panel-title').click(function (event) {

                event.preventDefault();

                var $panel = jQuery(this).parent();

                // Do not disturb existing location URL if you are going to close an accordion panel that is currently open
                if (!$panel.hasClass('labb-active')) {

                    var target = $panel.attr("id");

                    history.pushState ? history.pushState(null, null, "#" + target) : window.location.hash = "#" + target;

                }
                else {
                    var target = $panel.attr("id");

                    if (window.location.hash == '#' + target)
                        history.pushState ? history.pushState(null, null, '#') : window.location.hash = "#";
                }

                self._show($panel);
            });
        },

        _show: function ($panel) {

            if (this.toggle) {
                if ($panel.hasClass('labb-active')) {
                    this._close($panel);
                }
                else {
                    this._open($panel);
                }
            }
            else {
                // if the $panel is already open, close it else open it after closing existing one
                if ($panel.hasClass('labb-active')) {
                    this._close($panel);
                    this.current = null;
                }
                else {
                    this._close(this.current);
                    this._open($panel);
                    this.current = $panel;
                }
            }

        },

        _open: function ($panel) {

            if ($panel !== null) {
                $panel.children('.labb-panel-content').slideDown(300);
                $panel.addClass('labb-active');
            }

        },

        _close: function ($panel) {

            if ($panel !== null) {
                $panel.children('.labb-panel-content').slideUp(300);
                $panel.removeClass('labb-active');
            }

        },
    };

})(jQuery);

