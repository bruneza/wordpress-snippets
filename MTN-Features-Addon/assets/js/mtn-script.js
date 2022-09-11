(function($) {
$(document).ready(function() {
   

    $('.deal-carousel').owlCarousel({
        loop: true,
        margin: 15,
        slideToScroll:3,
        dots: true,
        nav: false,
        autoplay: false,
        smartSpeed: 3000,
        autoplayTimeout: 7000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});

$('.products-carousel').owlCarousel({
    loop: true,
    margin: 15,
    slideToScroll:1,
    dots: true,
    nav: false,
    autoplay: false,
    smartSpeed: 3000,
    autoplayTimeout: 7000,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});
})(jQuery);