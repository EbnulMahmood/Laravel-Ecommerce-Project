; (function ($) {

    "use strict";

    // ----------------------------------------------
    // Animate on scroll
    // ----------------------------------------------

    $('.scroll-to').on('click', function () {
        if ($(window).width() < 991) {
            $('.navbar-toggler').trigger("click");
        }
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 500);
        return false;
    });

    // ----------------------------------------------
    // Price range
    // ----------------------------------------------

    var priceRange = $('.price-range');
    var priceValue = $('.price-value');

    priceValue.html(priceRange.val());
    $(document).on('input', '.price-range', function () {
        priceValue.html(priceRange.val());
    });

    // ----------------------------------------------
    // Sticky header
    // ----------------------------------------------

    var navbarSticky = $('.navbar-sticky');
    var headerSticky = $('.header-sticky');

    // When reload page - check if page has offset
    if ($(document).scrollTop() > 94) {
        navbarSticky.addClass('sticked');
    }

    // Add sticky menu on scroll
    $(document).on('bind ready scroll', function () {
        var docScroll = $(document).scrollTop();
        if (docScroll > 5) {
            if (navbarSticky.hasClass('navbar-dark')) {
                navbarSticky.addClass('navbar-light navbar-active-dark');
                navbarSticky.removeClass('navbar-dark');
            }
            navbarSticky.addClass('scrolled');
            headerSticky.addClass('active');

        } else {
            if (navbarSticky.hasClass('navbar-active-dark')) {
                navbarSticky.removeClass('navbar-light');
                navbarSticky.addClass('navbar-dark');
            }
            navbarSticky.removeClass('scrolled');
            headerSticky.removeClass('active');
        }
    });


    $.each($('.img-hover'), function (i, n) {
        var $n = $(n);
        $n.on({
            mouseenter: function () {
                $n.attr('src', $n.attr('data-img-hover'))
            },
            mouseleave: function () {
                $n.attr('src', $n.attr('data-img'));
            }
        });
    });

    // ----------------------------------------------
    // Carousel
    // ----------------------------------------------

    $.each($('.owl-carousel'), function (i, n) {

        var $this = $(n),
            $dataItems = $this.data('items') !== undefined ? $this.data('items') : 1,
            $dataNav = $this.data('nav') !== undefined ? $this.data('nav') : false,
            $dataAutoplay = $this.data('autoplay') !== undefined ? $this.data('autoplay') : false,
            $dataDots = $this.data('dots') !== undefined ? $this.data('dots') : false,
            $dataMargin = $this.data('margin') !== undefined ? $this.data('margin') : 0;

        var arrowIcons = [
            '<span class="icon icon-chevron-left"></span>',
            '<span class="icon icon-chevron-right"></span>'
        ];

        $this.owlCarousel({
            loop: true,
            autoplay: $dataAutoplay,
            items: $dataItems,
            margin: $dataMargin,
            nav: $dataNav,
            dots: $dataDots,
            smartSpeed: 1000,
            navText: arrowIcons,
            onTranslated: startAnimation,
            onTranslate: resetAnimation
        });

        resetAnimation(); // Reset effects all on initalization
        startAnimation(); // Start animation on first slide

        function startAnimation(event) {

            // Find active slide
            var activeItem = $(n).find('.owl-item.active'),
                timeDelay = 100;

            $.each(activeItem.find('.animated'), function (j, m) {

                // Fetch active slide
                var item = $(m);
                item.css('animation-delay', timeDelay + 'ms');
                timeDelay = timeDelay + 180;

                // Add animation
                item.removeClass('fadeOut');
                item.addClass(item.data('start'));

            });
        }

        function resetAnimation(event) {

            // Catch all slides
            var items = $(n).find('.owl-item');
            var $item = $(n).find('.owl-item .item');

            // Add animation end
            $.each(items.find('.animated'), function (j, m) {
                var item = $(m);
                item.removeClass(item.data('start'));
                item.addClass('fadeOut');
            });
        }

        // Fit to window height
        if ($this.hasClass('owl-fullscreen')) {
            var navHeight = $('.nav-wrapper').height();
            if (navHeight === null) {
                navHeight = 0;
            }
            $this.find('.slide').height($(window).height());
        }

    });

    // ----------------------------------------------------
    // Rellax
    // ----------------------------------------------------

    if ($(window).width() > 1200) {
        if ($('.rellax').length > 0) {
            var rellax = new Rellax('.rellax', {
                center: true
            });
        }
    }

    $(window).on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        $('.scroll-opacity').css({
            opacity: function () {
                var wh = $(window).height();
                return 1 - (scrollTop / wh);
            }
        });
    });

    // ----------------------------------------------------
    // In View - Scroll Animate on scroll
    // ----------------------------------------------------

    if (typeof (inView) !== "undefined") {
        // Reveal images on viewport
        inView('.reveal')
            .on('enter', function (el) {
                $.each($(el), function (i, n) {
                    setTimeout(function () {
                        $(n).addClass('revealed');
                    }, 500);
                });
            })
            .on('exit', function (el) {
                $(el).removeClass('revealed');
            });
        // Lazy load images 
        inView('img.lazy')
            .on('enter', function (img) {
                $.each($(img), function (i, n) {
                    $(n).attr('src', $(n).attr('data-src'));
                });
            })
    }

    // ----------------------------------------------------
    // Image Lazy load 
    // ----------------------------------------------------

    $.each($('img.lazy'), function (i, n) {
        $(n).attr('src', $(n).attr('data-src'));
    });


    // ----------------------------------------------------
    // Lavalamp
    // ----------------------------------------------------

    $.each($('.nav-lavalamp'), function (i, n) {
        var $n = $(n),
            $dataClick = $n.data('click') !== undefined ? $n.data('click') : true;

        $n.lavalamp({
            enableHover: false,
            setOnClick: $dataClick,
            enableFocus: true,
            duration: 300
        });
    });

    // ----------------------------------------------
    // Toggle show
    // ----------------------------------------------

    $('.toggle-show').on('click', function (e) {
        var $this = $(this),
            $body = $('body'),
            $thisId = $this.attr('data-show');

        $body.find("#" + $thisId).toggleClass('show');
        $body.toggleClass('overflow-hidden');
        e.preventDefault();
    });

    // ----------------------------------------------
    // Toggle info
    // ----------------------------------------------

    $('.toggle-info').on('click', function (e) {
        $(this).toggleClass('show');
    });

    // ----------------------------------------------
    // Tooltip
    // ----------------------------------------------

    $('[data-toggle="tooltip"]').tooltip();

    // ----------------------------------------------
    // Tabzy
    // ----------------------------------------------

    $.each($('.tabzy'), function (i, n) {

        var $this = $(n),
            $dataFullscreen = $this.data('fullscreen') !== undefined ? $this.data('fullscreen') : false,
            $dataEvent = $this.data('event') !== undefined ? $this.data('event') : 'hover';

        $this.tabzy({
            fullScreen: $dataFullscreen,
            event: $dataEvent
        });

    });

    // ----------------------------------------------
    // Isotope
    // ----------------------------------------------

    var $istpWrap = $.each($('.istp-wrap'), function (i, el) {
        $('body').imagesLoaded(function () {
            var $el = $(el);
            var elHorizontal = true;

            if ($el.hasClass('istp-wrap-vertical')) {
                elHorizontal = false;
            }

            console.log("Images are loaded!");
            $el.isotope({
                itemSelector: '.istp',
                masonry: {
                    horizontalOrder: elHorizontal
                }
            });
        });
    });

    var $istpBtn = $('.btn-istp');
    $istpBtn.on('click', function () {
        var $this = $(this);
        if ($this.hasClass('active')) {
            $this.removeClass('active');
            $istpWrap.isotope({ filter: "" });
        }
        else {
            $istpBtn.removeClass('active');
            $this.addClass('active');
            $istpWrap.isotope({
                filter: $this.attr('data-filter')
            });
        }
    });

    // ----------------------------------------------
    // Init on load
    // ----------------------------------------------

    $(window).on('load', function () {
        setTimeout(function () {

            // ----------------------------------------------------
            // Page loader
            // ----------------------------------------------------

            $('.loader').addClass('loaded');


            // ----------------------------------------------------
            // Wow js - Animate on scroll
            // ----------------------------------------------------

            if (typeof (WOW) !== "undefined") {
                new WOW().init();
            }
        }, 500);
    });

})(jQuery);
