(function ($) {

    LABBImageSlider = function (settings) {
        this.settings = settings;
        this.nodeClass = '.fl-node-' + settings.id;

        this._init();
    };

    LABBImageSlider.prototype = {
        settings: {},
        nodeClass: '',
        slider_elem: '',
        slider_type: '',
        animation: '',
        direction: '',
        slideshow_speed: 5000,
        animation_speed: 600,
        pause_on_action: '',
        pause_on_hover: '',
        direction_nav: '',
        control_nav: '',
        thumbnail_nav: '',
        slideshow: '',
        randomize: '',
        loop: '',


        _init: function () {


            this.slider_elem = $(this.nodeClass).find(' .labb-image-slider').eq(0);

            this.slider_type = this.slider_elem.data('slider-type');

            var settings = this.slider_elem.data('settings');

            this.animation = settings.slide_animation || "slide";

            this.direction = settings.direction || "horizontal";

            this.slideshow_speed = parseInt(settings.slideshow_speed) || 5000;

            this.animation_speed = parseInt(settings.animation_speed) || 600;

            this.pause_on_action = settings.pause_on_action;

            this.pause_on_hover = settings.pause_on_hover;

            this.direction_nav = settings.direction_nav;

            this.control_nav = settings.control_nav;

            this.thumbnail_nav = settings.thumbnail_nav;

            this.slideshow = settings.slideshow;

            this.randomize = settings.randomize;

            this.loop = settings.loop;

            if (this.slider_type == 'flex') {

                this._flexslider();
            }
            else if (this.slider_type == 'nivo') {

                this._nivoSlider();
            }
            else if (this.slider_type == 'slick') {

                this._slickSlider();
            }
            else if (this.slider_type == 'responsive') {

                this._responsiveSlider();
            }
        },

        _flexslider: function () {

            if ($().flexslider === undefined) {
                return;
            }

            var carousel_id, slider_id;

            var $parent_slider = this.slider_elem.find('.labb-flexslider');

            if (this.thumbnail_nav) {

                this.control_nav = false; // disable control nav if thumbnail slider is desired
                this.randomize = false; // thumbnail slider does not work right when randomize is enabled

                carousel_id = $parent_slider.attr('data-carousel');
                slider_id = $parent_slider.attr('id');

                jQuery('#' + carousel_id).flexslider({
                    selector: ".labb-slides > .labb-slide",
                    namespace: "labb-flex-",
                    animation: "slide",
                    controlNav: false,
                    animationLoop: true,
                    slideshow: false,
                    itemWidth: 120,
                    itemMargin: 5,
                    asNavFor: ('#' + slider_id)
                });
            }

            $parent_slider.flexslider({
                selector: ".labb-slides > .labb-slide",
                animation: this.animation,
                direction: this.direction,
                slideshowSpeed: this.slideshow_speed,
                animationSpeed: this.animation_speed,
                namespace: "labb-flex-",
                pauseOnAction: this.pause_on_action,
                pauseOnHover: this.pause_on_hover,
                controlNav: this.control_nav,
                directionNav: this.direction_nav,
                prevText: "Previous<span></span>",
                nextText: "Next<span></span>",
                smoothHeight: false,
                animationLoop: this.loop,
                slideshow: this.slideshow,
                easing: "swing",
                randomize: this.randomize,
                animationLoop: this.loop,
                sync: (carousel_id ? '#' + carousel_id : '')
            });
        },

        _nivoSlider: function () {

            if ($().nivoSlider === undefined) {
                return;
            }

            // http://docs.dev7studios.com/article/13-nivo-slider-settings
            this.slider_elem.find('.nivoSlider').nivoSlider({
                effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                slices: 15,                       // For slice animations
                boxCols: 8,                       // For box animations
                boxRows: 4,                       // For box animations
                animSpeed: this.animation_speed,       // Slide transition speed
                pauseTime: this.slideshow_speed,       // How long each slide will show
                startSlide: 0,                    // Set starting Slide (0 index)
                directionNav: this.direction_nav,      // Next & Prev navigation
                controlNav: this.control_nav,          // 1,2,3... navigation
                controlNavThumbs: this.thumbnail_nav,  // Use thumbnails for Control Nav
                pauseOnHover: this.pause_on_hover,     // Stop animation while hovering
                manualAdvance: !this.slideshow,        // Force manual transitions
                prevText: 'Prev',                 // Prev directionNav text
                nextText: 'Next',                 // Next directionNav text
                randomStart: false,           // Start on a random slide
                beforeChange: function () {
                },       // Triggers before a slide transition
                afterChange: function () {
                },        // Triggers after a slide transition
                slideshowEnd: function () {
                },       // Triggers after all slides have been shown
                lastSlide: function () {
                },          // Triggers when last slide is shown
                afterLoad: function () {
                }           // Triggers when slider has loaded
            });
        },

        _slickSlider: function () {

            if ($().slick === undefined) {
                return;
            }

            this.slider_elem.find('.labb-slickslider').slick({
                autoplay: this.slideshow, // Should the slider move by itself or only be triggered manually?
                speed: this.animation_speed, // How fast (in milliseconds) Slick Slider should animate between slides.
                autoplaySpeed: this.slideshow_speed, // If autoplay is set to true, how many milliseconds should pass between moving the slides?
                dots: this.control_nav, // Do you want to generate an automatic clickable navigation for each slide in your slider?
                arrows: this.direction_nav, // Do you want to add left/right arrows to your slider?
                fade: (this.animation == "fade"), // How should Slick Slider animate each slide?
                adaptiveHeight: false, // Should Slick Slider animate the height of the container to match the current slide's height?
                pauseOnHover: this.pause_on_hover, // Pause Autoplay on Hover
                slidesPerRow: 1, // With grid mode intialized via the rows option, this sets how many slides are in each grid row. dver
                slidesToShow: 1, // # of slides to show
                slidesToScroll: 1, // # of slides to scroll
                vertical: (this.direction == "vertical"), // Vertical slide mode
                infinite: this.loop, // Infinite loop sliding
                useTransform: true // Use CSS3 transforms

            });
        },

        _responsiveSlider: function () {

            if ($().responsiveSlides === undefined) {
                return;
            }
            // http://responsiveslides.com/

            this.slider_elem.find('.rslides').responsiveSlides({
                auto: this.slideshow,             // Boolean: Animate automatically, true or false
                speed: this.animation_speed,            // Integer: Speed of the transition, in milliseconds
                timeout: this.slideshow_speed,          // Integer: Time between slide transitions, in milliseconds
                pager: this.control_nav,           // Boolean: Show pager, true or false
                nav: this.direction_nav,             // Boolean: Show navigation, true or false
                random: this.randomize,          // Boolean: Randomize the order of the slides, true or false
                pause: this.pause_on_hover,           // Boolean: Pause on hover, true or false
                pauseControls: false,    // Boolean: Pause when hovering controls, true or false
                prevText: "Previous",   // String: Text for the "previous" button
                nextText: "Next",       // String: Text for the "next" button
                maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                manualControls: "",     // Selector: Declare custom pager navigation
                namespace: "rslides",   // String: Change the default namespace used
                before: function () {
                },   // Function: Before callback
                after: function () {
                }     // Function: After callback
            });
        }
    };

})(jQuery);

