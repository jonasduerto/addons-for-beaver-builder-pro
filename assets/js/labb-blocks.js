if (typeof (jQuery) != 'undefined') {

    var labbBlockObjColl;

    var labbBlockCache;

    var LABB_Block;

    var labbBlocks;

    var labbGrids;

    jQuery.noConflict(); // Reverts '$' variable back to other JS libraries

    (function ($) {
        "use strict";

        labbBlockObjColl = [];

        labbBlockCache = {

            data: {},

            remove: function (blockSignature) {
                delete this.data[blockSignature];
            },

            exist: function (blockSignature) {
                return this.data.hasOwnProperty(blockSignature) && this.data[blockSignature] !== null;
            },

            get: function (blockSignature) {
                return this.data[blockSignature];
            },

            set: function (blockSignature, cachedData) {
                this.remove(blockSignature);
                this.data[blockSignature] = cachedData;
            }
        };

        //LABB_Block class - each ajax block uses a object of this class for requests
        LABB_Block = function (blockId) {

            var self = this;

            var $blockElem = $('#' + blockId).eq(0);

            self.blockId = blockId;
            self.query = $blockElem.data('query');
            self.settings = $blockElem.data('settings');
            self.blockType = self.settings['block_type'];
            self.currentPage = $blockElem.data('current');
            self.filterTaxonomy = $blockElem.data('filter-taxonomy');
            self.filterTerm = $blockElem.data('filter-term');

            var $filterItemColl = $blockElem.find('ul.labb-block-filter-list > li.labb-block-filter-item');

            self.filterWidths = [];
            // Preserve the filter widths for future use. Initially all filters are in the main list and visible until JS takes over
            $filterItemColl.each(function () {

                self.filterWidths.push($(this).width())

            });

            self._processNumberedPagination();

            self.organizeFilters();

        };

        LABB_Block.prototype = {

            blockId: '',
            blockType: '',
            query: '',
            settings: '',
            currentPage: 1,
            filterTerm: '', //current chosen filter term
            filterTaxonomy: '',
            userAction: 'next_prev', // load more or next prev action
            filterWidths: [],
            is_ajax_running: false,

            doAjaxBlockRequest: function (userAction) {

                var self = this;

                // first look in the cache
                var myCacheSignature = self._getObjectSignature();

                if (labbBlockCache.exist(myCacheSignature)) {

                    self._doAjaxBlockLoadingStart(true, userAction);

                    var cachedResponseObj = labbBlockCache.get(myCacheSignature);

                    self._doAjaxBlockProcessResponse(true, cachedResponseObj, userAction);

                    self._doAjaxBlockLoadingEnd(true, userAction);

                    return 'cache_hit';
                }

                self._doAjaxBlockLoadingStart(false, userAction);

                var requestData = {
                    'action': 'labb_load_posts_block',
                    'blockId': self.blockId,
                    'query': self.query,
                    'settings': self.settings,
                    'blockType': self.blockType,
                    'currentPage': self.currentPage,
                    'filterTerm': self.filterTerm,
                    'filterTaxonomy': self.filterTaxonomy,
                    'userAction': userAction
                };

                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(labb_ajax_object.ajax_url, requestData, function (response) {

                    labbBlockCache.set(myCacheSignature, response); // store for future retrieval

                    self._doAjaxBlockProcessResponse(false, response, userAction);

                    self._doAjaxBlockLoadingEnd(false, userAction);

                });
            },

            organizeFilters: function () {

                var self = this;

                var $blockElem = jQuery('#' + self.blockId);

                var $blockHeaderElem = $blockElem.find('.labb-block-header').eq(0);

                var availableWidth = self._getAvailableWidth($blockHeaderElem);

                self._resizeFilters($blockHeaderElem, availableWidth);

            },

            handleFilterAction: function ($target) {

                var userAction = 'filter';

                var $blockElem = $target.closest('.labb-block');

                $blockElem.find('.labb-block-filter-item, .labb-filter-item').removeClass('labb-active');

                $target.parent().addClass('labb-active');

                if (this.is_ajax_running === true)
                    return;

                var filterTerm = $target.attr('data-term-id');

                var filterTaxonomy = $target.attr('data-taxonomy');

                $blockElem.data('filter-term', filterTerm);

                $blockElem.data('filter-taxonomy', filterTaxonomy);

                this.filterTerm = filterTerm;

                this.filterTaxonomy = filterTaxonomy;

                this.currentPage = 1; // reset the current page

                this.doAjaxBlockRequest(userAction);

            },

            handlePageNavigation: function ($target) {

                var userAction = 'next';

                var $blockElem = $target.closest('.labb-block');

                var paged = $target.data('page');

                // Do not continue if already processing or if the page is currently being shown
                if ($target.is('.labb-current-page') || $blockElem.is('.labb-processing'))
                    return;

                if (this.is_ajax_running === true)
                    return;

                if (paged == 'prev') {

                    if (this.currentPage == 1)
                        return;

                    this.currentPage--;

                    userAction = 'prev';
                }
                else if (paged == 'next') {

                    if (this.currentPage >= this.maxpages)
                        return;

                    this.currentPage++;

                    userAction = 'next';
                }
                else {

                    this.currentPage = paged;

                    userAction = 'load_page';
                }

                this.doAjaxBlockRequest(userAction);
            },

            handleLoadMore: function ($target) {

                var $blockElem = $target.closest('.labb-block');

                // Do not continue if already processing or if the page is currently being shown
                if (this.currentPage >= this.maxpages || $blockElem.is('.labb-processing'))
                    return;

                if (this.is_ajax_running === true)
                    return;

                var userAction = 'load_more';

                this.currentPage++;

                this.doAjaxBlockRequest(userAction);

            },

            initLightbox: function ($blockElem) {

                if ($().fancybox === undefined) {
                    return;
                }

                /* ----------------- Lightbox Support ------------------ */

                $blockElem.fancybox({
                    selector: 'a.labb-lightbox-item', // the selector for portfolio item
                    loop: true,
                    caption: function (instance, item) {

                        var title = $(this).attr('title') || '';

                        var link = $(this).data('post-link') || '';

                        var caption = '<a href="' + link + '" title="' + title + '">' + title + '</a>';

                        var excerpt = $(this).data('post-excerpt') || '';

                        if (excerpt !== '') {

                            var txt = document.createElement("textarea");

                            txt.innerHTML = excerpt;

                            excerpt = txt.value;

                            caption += '<div class="labb-fancybox-description">' + excerpt + '</div>';
                        }

                        return caption;
                    }
                });

            },

            _doAjaxBlockLoadingStart: function (cacheHit, userAction) {

                var self = this;

                self.is_ajax_running = true;

                var $blockElem = jQuery('#' + self.blockId);

                $blockElem.addClass('labb-processing');

                var $blockElementInner = $('#' + self.blockId).find('.labb-block-inner');

                //$blockElementInner.css('opacity', 0);

                if (userAction == 'next' || userAction == 'prev' || userAction == 'filter' || userAction == 'load_page') {

                    if (cacheHit == false)
                        $blockElem.append('<div class="labb-loader-gif"></div>');

                    $blockElementInner.addClass('animated fadeOut_to_1');
                }
            },

            _doAjaxBlockLoadingEnd: function (cacheHit, userAction) {

                var self = this;

                self.is_ajax_running = false;

                var $blockElem = jQuery('#' + self.blockId);

                $blockElem.removeClass('labb-processing');

                $('.labb-loader-gif').remove();

                var $blockElementInner = $blockElem.find('.labb-block-inner');

                $blockElementInner.removeClass('animated fadeOut_to_1');

                switch (userAction) {
                    case 'next':
                    case 'load_page':
                        $blockElementInner.addClass("animated fadeInRightSmall").on('animationend webkitAnimationEnd oAnimationEnd', function () {
                            $blockElementInner.removeClass('animated fadeInRightSmall');
                        });

                        break;
                    case 'prev':
                        $blockElementInner.addClass("animated fadeInLeftSmall").on('animationend webkitAnimationEnd oAnimationEnd', function () {
                            $blockElementInner.removeClass('animated fadeInLeftSmall');
                        });
                        break;
                    case 'filter':
                        $blockElementInner.addClass("animated fadeIn").on('animationend webkitAnimationEnd oAnimationEnd', function () {
                            $blockElementInner.removeClass('animated fadeIn');
                        });
                        break;

                }

                //$blockElementInner.css('opacity', 1);

                self._ensureBlockObjectsAreVisible($blockElem, userAction);

            },

            _doAjaxBlockProcessResponse: function (cacheHit, response, userAction) {

                var self = this;

                //read the server response
                var responseObj = $.parseJSON(response); //get the data object

                if (this.blockId !== responseObj.blockId)
                    return; // not mine

                var $blockElem = $('#' + this.blockId); // we know the response is for this block

                if ('load_more' === userAction) {

                    $(responseObj.data).appendTo($blockElem.find('.labb-block-inner'));
                } else {
                    $blockElem.find('.labb-block-inner').html(responseObj.data); //in place
                }

                $blockElem.attr('data-current', responseObj.paged);

                $blockElem.attr('data-maxpages', responseObj.maxpages);


                $blockElem.find('.labb-pagination .labb-page-nav.labb-current-page').removeClass('labb-current-page');

                $blockElem.find('.labb-page-nav[data-page="' + parseInt(responseObj.paged) + '"]').addClass('labb-current-page');

                $blockElem.find('.labb-page-nav[data-page="next"]').removeClass('labb-disabled');
                $blockElem.find('.labb-page-nav[data-page="prev"]').removeClass('labb-disabled');

                //hide or show prev
                if (true === responseObj.hidePrev) {
                    $blockElem.find('.labb-page-nav[data-page="prev"]').addClass('labb-disabled');
                }

                //hide or show next
                if (true === responseObj.hideNext) {
                    $blockElem.find('.labb-page-nav[data-page="next"]').addClass('labb-disabled');
                }

                var maxpages = parseInt(responseObj.maxpages);

                // If the query is being filtered by a specific taxonomy term - the All option is not chosen
                if (responseObj.filterTerm.length) {

                    if (maxpages == 1) {
                        // Hide everything if no pagination is required
                        $blockElem.find('.labb-page-nav').hide();
                    }
                    else {

                        // hide all pages which are irrelevant in filtered results
                        $blockElem.find('.labb-page-nav').each(function () {

                            var page = $(this).attr('data-page'); // can return next and prev too

                            if (page.match('prev|next')) {
                                $(this).show(); // could have been hidden with earlier filter if maxpages == 1
                            }
                            else if (parseInt(page) > maxpages) {
                                $(this).hide();
                            }
                            else {
                                $(this).show(); // display the same if hidden due to previous filter
                            }
                        });
                    }
                }
                else {
                    // display all navigation if it was hidden before during filtering
                    $blockElem.find('.labb-page-nav').show();
                }

                // Reorganize the pagination if there are too many pages to display navigation for
                this._processNumberedPagination();

                var remaining_posts = parseInt(responseObj.remaining);

                // Set remaining posts to be loaded and hide the button if we just loaded the last page
                if (self.settings['show_remaining'] && remaining_posts !== 0) {
                    $blockElem.find('.labb-pagination a.labb-load-more span').text(remaining_posts);
                }

                if (remaining_posts === 0) {
                    $blockElem.find('.labb-pagination a.labb-load-more').addClass('labb-disabled');
                }
                else {
                    $blockElem.find('.labb-pagination a.labb-load-more').removeClass('labb-disabled');
                }

            },

            _getObjectSignature: function () {

                var self = this;

                /*
                var objectSignature = JSON.parse(JSON.stringify(self));

                objectSignature.query = '';
                objectSignature.settings = '';
                objectSignature.userAction = '';
                */

                // create a block signature object without heavy footprint of settings and query fields
                var signatureObject = {

                    blockId: self.blockId,
                    blockType: self.blockType,
                    query: '',
                    settings: '',
                    currentPage: self.currentPage,
                    filterTerm: self.filterTerm,
                    filterTaxonomy: self.filterTaxonomy

                };

                var objectSignature = JSON.stringify(signatureObject);

                return objectSignature;
            },

            // Manage page number display so that it does not get too long with too many page numbers displayed
            _processNumberedPagination: function () {

                var self = this;

                var $blockElem = jQuery('#' + self.blockId);

                var maxpages = parseInt($blockElem.attr('data-maxpages'));

                var currentPage = parseInt($blockElem.attr('data-current'));

                // Remove all existing dotted navigation elements
                $blockElem.find('.labb-page-nav.labb-dotted').remove();

                // proceed only if there are too many pages to display navigation for
                if (maxpages > 5) {

                    var beenHiding = false;

                    $blockElem.find('.labb-page-nav.labb-numbered').each(function () {

                        var page = $(this).attr('data-page'); // can return next and prev too

                        var pageNum = parseInt(page);

                        // Deal with only those pages between 1 and maxpages
                        if (pageNum > 1 && pageNum <= maxpages) {

                            var $navElement = $(this);

                            if (pageNum == currentPage || (pageNum == currentPage - 1) || (pageNum == currentPage + 1) || (pageNum == currentPage + 2)) {

                                if (beenHiding)
                                    $('<a class="labb-page-nav labb-dotted" href="#" data-page="">...</a>').insertBefore($navElement);

                                $navElement.show();

                                beenHiding = false;
                            }
                            else if (pageNum == maxpages) {

                                if (beenHiding)
                                    $('<a class="labb-page-nav labb-dotted" href="#" data-page="">...</a>').insertBefore($navElement);

                                beenHiding = false; // redundant for now
                            }
                            else {

                                $navElement.hide();

                                beenHiding = true;
                            }
                        }
                    });
                }
            },

            _getAvailableWidth: function ($blockHeaderElem) {

                var headerWidth = $blockHeaderElem.width();

                // Keep about 100px for more dropdown indicator
                var availableWidth = headerWidth - 100;

                var headingWidth = 0;

                if ($blockHeaderElem.find('.labb-heading').length) {

                    if ($blockHeaderElem.find('.labb-heading a').length)
                        headingWidth = $blockHeaderElem.find('.labb-heading a').eq(0).width();
                    else
                        headingWidth = $blockHeaderElem.find('.labb-heading span').eq(0).width();

                }

                if (availableWidth > headingWidth)
                    availableWidth = availableWidth - headingWidth;
                else
                    availableWidth = 0;

                return availableWidth;
            },

            _resizeFilters: function ($blockHeaderElem, availableWidth) {

                var self = this;

                var spaceRequired = 0;

                var $mainListElem = $blockHeaderElem.find('ul.labb-block-filter-list');

                // Do not proceed if there is no main list as is the case with few header styles
                if ($mainListElem.length == 0)
                    return;

                var $mainListElem = $mainListElem.eq(0);

                var $dropdownListElem = $blockHeaderElem.find('ul.labb-block-filter-dropdown-list').eq(0);

                var $mainListFilterColl = $mainListElem.find('li.labb-block-filter-item');

                var $dropdownListFilterColl = $dropdownListElem.find('li.labb-block-filter-item');

                var filterIndex = 0;

                var dropdownModified = false;

                $mainListFilterColl.each(function () {

                    var $filter = $(this);

                    spaceRequired = spaceRequired + self.filterWidths[filterIndex];

                    if (spaceRequired >= availableWidth) {

                        self._moveFilterToDropdownList($filter, $dropdownListElem);

                        dropdownModified = true;
                    }

                    filterIndex++;
                });

                $dropdownListFilterColl.each(function () {

                    var $filter = $(this);

                    /* If dropdown was modified earlier, we need to rearrange the list to maintain initial ordering of filters by
                    adding the elements back to the list.
                    Also no question of adding to main list if dropdownlist was modified earlier due to lack of space. */
                    if (dropdownModified) {

                        self._moveFilterToDropdownList($filter, $dropdownListElem);

                    }
                    else {

                        // takes into consideration the space required for existing items as calculated in previous loop
                        spaceRequired = spaceRequired + self.filterWidths[filterIndex];

                        // move if enough space is available
                        if (spaceRequired < availableWidth) {

                            self._moveFilterToMainList($filter, $mainListElem);

                        }
                    }

                    filterIndex++;
                });

                self._toggleMoreDropdownList($blockHeaderElem, $dropdownListElem);

            },

            _moveFilterToDropdownList: function ($filter, $dropdownFilterList) {

                $filter.detach();

                $dropdownFilterList.append($filter);

            },

            _moveFilterToMainList: function ($filter, $mainFilterList) {

                $filter.detach();

                $mainFilterList.append($filter);

            },

            _toggleMoreDropdownList: function ($blockHeaderElem, $dropdownListElem) {

                var moreFilter = $blockHeaderElem.find('.labb-block-filter-more').eq(0);

                if ($dropdownListElem.find('li.labb-block-filter-item').length == 0)
                    moreFilter.hide();
                else
                    moreFilter.show();

            },

            // Restore focus to the top of the block to make new elements visible
            _ensureBlockObjectsAreVisible: function ($blockElem, userAction) {

                if (userAction.match(/^(next|prev|load_page)$/)) {

                    var viewportTop = $(window).scrollTop();

                    var blockElemTop = $blockElem.offset().top;

                    // If top of block element is hidden above viewport when pagination in invoked,
                    // bring it back down and make it visible in viewport about 50 pixels from top
                    if (blockElemTop < viewportTop) {

                        $('html,body').animate({ scrollTop: blockElemTop - 60}, 800);

                    }

                }
            }

        };


        labbBlocks = {

            getBlockObjById: function (blockId) {

                var blockIndex = this._getBlockIndex(blockId);

                if (blockIndex !== -1)
                    return labbBlockObjColl[blockIndex];

                var blockObj = new LABB_Block(blockId);

                labbBlockObjColl.push(blockObj); // add to the array for instant retrieval later

                return blockObj;
            },

            _getBlockIndex: function (blockId) {

                var blockIndex = -1;

                $.each(labbBlockObjColl, function (index, labbBlock) {

                    if (labbBlock.blockId === blockId) {

                        blockIndex = index;

                        return false; // breaks out of $.each only

                    }
                });

                return blockIndex;
            },

        };  //end labbBlocks

        /* -------------------------------------- END Block Implementation ----------------- */

        /* -------------------------------------- START Grid Block Implementation ----------------- */

        function LABB_Grid() {

            LABB_Block.apply(this, arguments);

        }

        // inherit LABB_Block
        LABB_Grid.prototype = Object.create(LABB_Block.prototype);

        LABB_Grid.prototype.constructor = LABB_Grid;

        LABB_Grid.prototype._doAjaxBlockLoadingStart = function (cacheHit, userAction) {

            var self = this;

            self.is_ajax_running = true;

            var $blockElem = jQuery('#' + self.blockId);

            $blockElem.addClass('labb-processing');

            if (userAction == 'next' || userAction == 'prev' || userAction == 'filter' || userAction == 'load_page') {

                if (cacheHit == false) {

                    $blockElem.addClass('labb-fetching');

                    $blockElem.append('<div class="labb-loader-gif"></div>');
                }

            }
        };


        LABB_Grid.prototype._doAjaxBlockLoadingEnd = function (cacheHit, userAction) {

            var self = this;

            self.is_ajax_running = false;

            var $gridElem = jQuery('#' + self.blockId);

            $gridElem.removeClass('labb-processing');

            $('.labb-loader-gif').remove();

            self._ensureBlockObjectsAreVisible($gridElem, userAction);

        };

        LABB_Grid.prototype._doAjaxBlockProcessResponse = function (cacheHit, response, userAction) {

            var self = this;

            //read the server response
            var responseObj = $.parseJSON(response); //get the data object

            if (this.blockId !== responseObj.blockId)
                return; // not mine

            var $blockElem = $('#' + this.blockId); // we know the response is for this grid

            if ('load_more' === userAction) {

                var $blockElementInner = $blockElem.find('.labb-block-inner');

                var $response = $('<div></div>').html(responseObj.data);

                $response.imagesLoaded(function () {

                    if (cacheHit == false)
                        $blockElem.removeClass('labb-fetching');

                    var $new_items = $response.children('.labb-block-column');

                    $blockElementInner.isotope('insert', $new_items);
                });

            } else {

                var $blockElementInner = $blockElem.find('.labb-block-inner');

                var $existing_items = $blockElementInner.children('.labb-block-column');

                var $response = $('<div></div>').html(responseObj.data);

                $response.imagesLoaded(function () {

                    if (cacheHit == false)
                        $blockElem.removeClass('labb-fetching');

                    $blockElementInner.isotope('remove', $existing_items);

                    var $new_items = $response.children('.labb-block-column');

                    $blockElementInner.isotope('insert', $new_items);
                });

            }

            $blockElem.attr('data-current', responseObj.paged);

            $blockElem.attr('data-maxpages', responseObj.maxpages);


            $blockElem.find('.labb-pagination .labb-page-nav.labb-current-page').removeClass('labb-current-page');

            $blockElem.find('.labb-page-nav[data-page="' + parseInt(responseObj.paged) + '"]').addClass('labb-current-page');

            $blockElem.find('.labb-page-nav[data-page="next"]').removeClass('labb-disabled');
            $blockElem.find('.labb-page-nav[data-page="prev"]').removeClass('labb-disabled');

            //hide or show prev
            if (true === responseObj.hidePrev) {
                $blockElem.find('.labb-page-nav[data-page="prev"]').addClass('labb-disabled');
            }

            //hide or show next
            if (true === responseObj.hideNext) {
                $blockElem.find('.labb-page-nav[data-page="next"]').addClass('labb-disabled');
            }

            var maxpages = parseInt(responseObj.maxpages);

            // If the query is being filtered by a specific taxonomy term - the All option is not chosen
            if (responseObj.filterTerm.length) {

                if (maxpages == 1) {
                    // Hide everything if no pagination is required
                    $blockElem.find('.labb-page-nav').hide();
                }
                else {

                    // hide all pages which are irrelevant in filtered results
                    $blockElem.find('.labb-page-nav').each(function () {

                        var page = $(this).attr('data-page'); // can return next and prev too

                        if (page.match('prev|next')) {
                            $(this).show(); // could have been hidden with earlier filter if maxpages == 1
                        }
                        else if (parseInt(page) > maxpages) {
                            $(this).hide();
                        }
                        else {
                            $(this).show(); // display the same if hidden due to previous filter
                        }
                    });
                }
            }
            else {
                // display all navigation if it was hidden before during filtering
                $blockElem.find('.labb-page-nav').show();
            }

            // Reorganize the pagination if there are too many pages to display navigation for
            this._processNumberedPagination();

            var remaining_posts = parseInt(responseObj.remaining);

            // Set remaining posts to be loaded and hide the button if we just loaded the last page
            if (self.settings['show_remaining'] && remaining_posts !== 0) {
                $blockElem.find('.labb-pagination a.labb-load-more span').text(remaining_posts);
            }

            if (remaining_posts === 0) {
                $blockElem.find('.labb-pagination a.labb-load-more').addClass('labb-disabled');
            }
            else {
                $blockElem.find('.labb-pagination a.labb-load-more').removeClass('labb-disabled');
            }

        };

        labbGrids = Object.create(labbBlocks);

        labbGrids.getBlockObjById = function (blockId) {

            var blockIndex = this._getBlockIndex(blockId);

            if (blockIndex !== -1)
                return labbBlockObjColl[blockIndex];

            var blockObj = new LABB_Grid(blockId);

            labbBlockObjColl.push(blockObj); // add to the array for instant retrieval later

            return blockObj;

        };

        /* -------------------------------------- END Grid Block Implementation ----------------- */

    }(jQuery));

}