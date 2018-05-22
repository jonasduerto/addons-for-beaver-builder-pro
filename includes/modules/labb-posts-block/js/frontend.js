(function ($) {

    LABBPostsBlock = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBPostsBlock.prototype = {

        nodeClass: '',
        block_elem: null,
        block_object: null,

        _init: function () {

            this.block_elem = $(this.nodeClass).find(' .labb-block').eq(0);

            if (this.block_elem.find('.labb-module').length === 0) {
                return; // no items to display or load and hence don't continue
            }

            this.block_object = labbBlocks.getBlockObjById(this.block_elem.data('block-uid'));

            this._initBlock();

            this._initLightbox();

        },

        _initBlock: function () {

            var self = this;


            /* ----------- Reorganize Filters when device width changes -------------- */

            /* https://stackoverflow.com/questions/24460808/efficient-way-of-using-window-resize-or-other-method-to-fire-jquery-functions */
            var labbResizeTimeout;

            $(window).resize(function () {

                if (!!labbResizeTimeout) {
                    clearTimeout(labbResizeTimeout);
                }

                labbResizeTimeout = setTimeout(function () {

                    self.block_object.organizeFilters();

                }, 200);
            });


            /* -------------- Taxonomy Filter --------------- */

            self.block_elem.find('.labb-taxonomy-filter .labb-filter-item a, .labb-block-filter .labb-block-filter-item a').on('click', function (e) {

                e.preventDefault();

                self.block_object.handleFilterAction($(this));

                return false;
            });

            /* ------------------- Pagination ---------------------- */

            self.block_elem.find('.labb-pagination a.labb-page-nav').on('click', function (e) {

                e.preventDefault();

                self.block_object.handlePageNavigation($(this));

            });


            /*---------------- Load More Button --------------------- */

            self.block_elem.find('.labb-pagination a.labb-load-more').on('click', function (e) {

                e.preventDefault();

                self.block_object.handleLoadMore($(this));

            });
        },

        _initLightbox: function () {

            var self = this;

            self.block_object.initLightbox(self.block_elem);
        }
    };

})(jQuery);

