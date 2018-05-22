/* Credit for some tab styles - http://tympanus.net/codrops/2014/09/02/tab-styles-inspiration/ */

(function ($) {

    LABBTabs = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBTabs.prototype = {

        nodeClass: '',

        _init: function () {

            this.tabs = $(this.nodeClass).find('.labb-tabs');

            // tabs elems
            this.tabNavs = this.tabs.find('.labb-tab');

            // content items
            this.items = this.tabs.find('.labb-tab-pane');

            // show first tab item
            this._show(0);

            // init events
            this._initEvents();

            // make the tab responsive
            this._makeResponsive();

        },

        _show: function (index) {

            // Clear out existing tab
            this.tabNavs.removeClass('labb-active');
            this.items.removeClass('labb-active');

            this.tabNavs.eq(index).addClass('labb-active');
            this.items.eq(index).addClass('labb-active');

            this._triggerResize();

        },

        _initEvents: function ($panel) {

            var self = this;

            this.tabNavs.click(function (event) {

                event.preventDefault();

                var $anchor = jQuery(this).children('a').eq(0);

                var target = $anchor.attr('href').split('#').pop();

                self._show(self.tabNavs.index(jQuery(this)));

                history.pushState ? history.pushState(null, null, "#" + target) : window.location.hash = "#" + target;
            });
        },

        _makeResponsive: function () {

            var self = this;

            /* Trigger mobile layout based on an user chosen browser window resolution */
            var mediaQuery = window.matchMedia('(max-width: ' + self.tabs.data('mobile-width') + 'px)');
            if (mediaQuery.matches) {
                self.tabs.addClass('labb-mobile-layout');
            }
            mediaQuery.addListener(function (mediaQuery) {
                if (mediaQuery.matches)
                    self.tabs.addClass('labb-mobile-layout');
                else
                    self.tabs.removeClass('labb-mobile-layout');
            });

            /* Close/open the mobile menu when a tab is clicked and when menu button is clicked */
            this.tabNavs.click(function (event) {
                event.preventDefault();
                self.tabs.toggleClass('labb-mobile-open');
            });

            this.tabs.find('.labb-tab-mobile-menu').click(function (event) {
                event.preventDefault();
                self.tabs.toggleClass('labb-mobile-open');
            });
        },

        _triggerResize: function () {

            if(typeof(Event) === 'function') {
                // modern browsers
                window.dispatchEvent(new Event('resize'));
            }else{
                // for IE and other old browsers
                // causes deprecation warning on modern browsers
                var evt = window.document.createEvent('UIEvents');
                evt.initUIEvent('resize', true, false, window, 0);
                window.dispatchEvent(evt);
            }
        }


    };

})(jQuery);

