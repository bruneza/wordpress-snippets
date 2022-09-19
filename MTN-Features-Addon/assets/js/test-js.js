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

    $(".filter-one").change(function() {
        var value = $(this).val();
        if (value == "all") {
            //$('.filter').show('1000');
            $('.category').show('1000');

            $('.filter').removeClass('hidden');
        } else {
            $(".filter").not('.' + value).addClass('hidden');
            $('.filter').filter('.' + value).removeClass('hidden');

            //categories
            $(".category").not('.' + value).hide('3000');
            $('.category').filter('.' + value).show('3000');

            //$('.filter[filter-item="' + value + '"]').removeClass('hidden');
            //$(".filter").not('.filter[filter-item="' + value + '"]').addClass('hidden');
        }
    });

    $(".filter-two").change(function() {
        var value = $(this).val();
        if (value == "all-category") {
            $('.categories').show('1000');
        } else {
            $(".categories").not('.' + value).hide('3000');
            $('.categories').filter('.' + value).show('3000');
        }
    });


/*
    // level up 

    var header = document.querySelector(".section-navigator");
    var btns = header.getElementsByClassName("navigator-button");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active-navigator-button");
            current[0].className = current[0].className.replace(" active-navigator-button", "");
            this.className += " active-navigator-button";
        });
    }

    $(document).ready(function() {
        var value = $(".active-navigator-button").attr('data-filter');
        $(".section-contents-details").not('.' + value).hide('500');
        $('.section-contents-details').filter('.' + value).show('500');
    });

    $(".navigator-button").click(function() {
        var value = $(this).attr('data-filter');


        //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
        //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
        $(".section-contents-details").not('.' + value).hide('3000');
        $('.section-contents-details').filter('.' + value).show('3000');

    });*/


    // Single FAQ
    console.log("hi there");
    var header2 = document.querySelector(".section-navigator");
    var btns2 = header2.getElementsByClassName("navigator-buttons");
    for (var i = 0; i < btns2.length; i++) {
        btns2[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active-navigator-button");
            current[0].className = current[0].className.replace(" active-navigator-button", "");
            this.className += " active-navigator-button";
        });
    }

    $(document).ready(function() {
        var value2 = $(".active-navigator-button").attr('data-filter');
        $(".section-contents-details").not('.' + value2).hide('500');
        $('.section-contents-details').filter('.' + value2).show('500');
    });

    $(".navigator-buttons").click(function() {
        var value2 = $(this).attr('data-filter');
        console.log(value2);

        //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
        //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
        $(".section-contents-details").not('.' + value2).hide('3000');
        $('.section-contents-details').filter('.' + value2).show('3000');

    });

})(jQuery);