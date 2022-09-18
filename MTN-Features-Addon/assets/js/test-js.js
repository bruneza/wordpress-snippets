/** */
(function($) {
    $('.topic-owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        slideToScroll: 2,
        dots: true,
        nav: false,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 7000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });

    $(".filter-button").click(function() {
        var value = $(this).attr('data-filter');

        if (value == "") {
            //$('.filter').removeClass('hidden');
            $('.filter').filter('.' + value).show('1000');
        } else {
            //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
            //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');
        }
    });

})(jQuery);