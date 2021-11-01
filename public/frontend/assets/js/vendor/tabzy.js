/**
 * Tabzy - Background image tabs
 * Copyright 2017 Goran Hrustic
 */
/**
 * Tabzy - Image tablist
 * @version 1.0.0
 */
(function ($) {

    $.fn.tabzy = function (options) {

        // Establish our default settings
        var settings = $.extend({
            fullScreen: false,
            event: 'hover'
        }, options);

        return this.each(function () {

            var $this = $(this),
                objItem = $this.find(".tabzy-item");

            // Create gallery
            $(document.createElement('div')).addClass('tabzy-gallery').appendTo($this);

            // Take default image
            var objGal = $('.tabzy-gallery');
            objGal.css('background-image', 'url(' + objItem.find('img').attr("src") + ')')

            // Render gallery items
            $.each(objItem, function (i, n) {

                var $n = $(n),
                    count = (i + 1);

                $(n).attr('id-img', 'img' + count);

                objGal.append($(document.createElement("div"))
                    .css('background-image', 'url(' + $n.find('img').attr("src") + ')')
                    .attr('id', 'img' + count));

                if (settings.event === 'hover') {
                    $n.on({
                        mouseenter: function () {
                            var self = $(this);
                            self.addClass('current');
                            self.closest('.tabzy').find("#" + self.attr('id-img')).addClass('current');
                        },
                        mouseleave: function () {
                            var self = $(this);
                            self.removeClass('current');
                            self.closest('.tabzy').find("#" + self.attr('id-img')).removeClass('current');
                        }
                    });
                }

                if (settings.event === 'click') {
                    $n.on('click', function (e) {
                        var self = $(this);
                        e.stopPropagation();
                        removeCurrent()
                        self.addClass('current');
                        self.closest('.tabzy').find("#" + self.attr('id-img')).addClass('current');
                    });

                    $(document).on("click", function (e) {
                        removeCurrent()
                    });

                    function removeCurrent() {
                        objItem.removeClass('current');
                        objGal.find('div').removeClass('current');
                    }
                }
            });

            if (settings.fullScreen == true) {
                var h = $(window).height();
                $this.height(h)
            }

        });

    };

}(jQuery));
