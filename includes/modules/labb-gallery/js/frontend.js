(function ($) {

    LABBGallery = function (settings) {
        this.nodeClass = '.fl-node-' + settings.id;
        this._init();
    };

    LABBGallery.prototype = {

        nodeClass: '',
        gallery_elem: null,

        _init: function () {

            this.gallery_elem = $(this.nodeClass).find(' .labb-gallery-wrap').eq(0);

            this._initGallery();
            this._initLightbox();

        },

        _initGallery: function () {

            if ($().isotope === undefined) {
                return;
            }

            var container = this.gallery_elem.find('.labb-gallery');
            if (container.length === 0) {
                return; // no items to filter or load and hence don't continue
            }

            // layout Isotope after all images have loaded
            var htmlContent = this.gallery_elem.find('.js-isotope');

            var isotopeOptions = htmlContent.data('isotope-options');

            htmlContent.isotope({
                // options
                itemSelector: isotopeOptions['itemSelector'],
                layoutMode: isotopeOptions['layoutMode'],
                masonry: {
                    columnWidth: '.labb-grid-sizer'
                }
            });

            htmlContent.imagesLoaded(function () {
                htmlContent.isotope('layout');
            });


            // Relayout on inline full screen video and back
            $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange',function(e){
                htmlContent.isotope('layout');
            });

            /* -------------- Taxonomy Filter --------------- */

            this.gallery_elem.find('.labb-taxonomy-filter .labb-filter-item a').on('click', function (e) {
                e.preventDefault();

                var selector = $(this).attr('data-value');
                container.isotope({filter: selector});
                $(this).closest('.labb-taxonomy-filter').children().removeClass('labb-active');
                $(this).closest('.labb-filter-item').addClass('labb-active');
                return false;
            });

            /* ------------------- Pagination ---------------------- */

            this.gallery_elem.find('.labb-pagination a.labb-page-nav').on('click', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $parent = $this.closest('.labb-gallery-wrap'),
                    paged = $this.data('page'),
                    settings = $parent.data('settings'),
                    items = $parent.data('items'),
                    maxpages = $parent.data('maxpages'),
                    current = $parent.data('current');

                // Do not continue if already processing or if the page is currently being shown
                if ($this.is('.labb-current-page') || $parent.is('.labb-processing'))
                    return;

                if (paged == 'prev') {
                    if (current <= 1)
                        return;
                    paged = current - 1;
                }
                else if (paged == 'next') {
                    if (current >= maxpages)
                        return;
                    paged = current + 1;
                }

                $parent.addClass('labb-processing');

                var data = {
                    'action': 'labb_load_gallery_items',
                    'settings': settings,
                    'items': items,
                    'paged': paged
                };
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(labb_ajax_object.ajax_url, data, function (response) {

                    var $grid = $parent.find('.labb-gallery');

                    var $existing_items = $grid.children('.labb-gallery-item');

                    $grid.isotope('remove', $existing_items);

                    var $response = $('<div></div>').html(response);

                    $response.imagesLoaded(function () {

                        var $new_items = $response.children('.labb-gallery-item');

                        $grid.isotope('insert', $new_items);
                    });

                    // Set attributes of DOM elements based on page loaded

                    $parent.data('current', paged);

                    $this.siblings('.labb-current-page').removeClass('labb-current-page');

                    $parent.find('.labb-page-nav[data-page="' + parseInt(paged) + '"]').addClass('labb-current-page');

                    $parent.find('.labb-page-nav[data-page="next"]').removeClass('labb-disabled');
                    $parent.find('.labb-page-nav[data-page="prev"]').removeClass('labb-disabled');

                    if (paged <= 1)
                        $parent.find('.labb-page-nav[data-page="prev"]').addClass('labb-disabled');
                    else if (paged >= maxpages)
                        $parent.find('.labb-page-nav[data-page="next"]').addClass('labb-disabled');

                    $parent.removeClass('labb-processing');
                });

            });


            /*---------------- Load More Button --------------------- */

            this.gallery_elem.find('.labb-pagination a.labb-load-more').on('click', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $parent = $this.closest('.labb-gallery-wrap'),
                    paged = $this.attr('data-page'),
                    settings = $parent.data('settings'),
                    items = $parent.data('items'),
                    maxpages = $parent.data('maxpages'),
                    current = $parent.data('current'),
                    total = $parent.data('total');

                if (current >= maxpages || $parent.is('.labb-processing'))
                    return;

                $parent.addClass('labb-processing');

                paged = ++current;

                var data = {
                    'action': 'labb_load_gallery_items',
                    'settings': settings,
                    'items': items,
                    'paged': paged
                };

                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(labb_ajax_object.ajax_url, data, function (response) {

                    var $grid = $parent.find('.labb-gallery');

                    var $response = $('<div></div>').html(response);

                    $response.imagesLoaded(function () {

                        var $new_items = $response.children('.labb-gallery-item');

                        $grid.isotope('insert', $new_items);

                    });

                    $parent.data('current', paged);

                    // Set remaining posts to be loaded and hide the button if we just loaded the last page
                    if (settings['show_remaining']) {
                        if (current == maxpages) {
                            $this.find('span').text(0);
                        }
                        else {
                            var remaining = total - (current * settings['items_per_page']);
                            $this.find('span').text(remaining);
                        }
                    }

                    if (current == maxpages)
                        $this.addClass('labb-disabled');

                    $parent.removeClass('labb-processing');
                });

            });
        },

        _initLightbox: function () {

            if ($().fancybox === undefined) {
                return;
            }

            /* ----------------- Lightbox Support ------------------ */

            this.gallery_elem.fancybox({
                selector: 'a.labb-lightbox-item,a.labb-video-lightbox', // the selector for gallery item
                loop: true,
                caption: function (instance, item) {

                    var caption = $(this).attr('title') || '';

                    var description = $(this).data('description') || '';

                    if (description !== '') {
                        caption += '<div class="labb-fancybox-description">' + description + '</div>';
                    }

                    return caption;
                }
            });
        }
    };

})(jQuery);

