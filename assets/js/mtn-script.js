(function($) {

    /***** Post Grid ***/
    $(document).ready(function() {
/***** Append badge to post grid content ***/
        $('#overlayed-post-grid .elementor-post__text').prepend( function() {
           return $(this).prev();
        });
        $('.mtn-move-badge .elementor-post__text').prepend( function() {
           return $(this).prev();
        });

        var menuIndex; 
        var selectedMega;

            /*$('.mtn-megamenu-link-secion .menu-item').hover(function() {
                menuIndex = $(this).index()+1;
                selectedMega = ".mtn-megamenu-content-" + menuIndex;
                $(selectedMega).addClass("active");
            },function() {

                $(selectedMega).mouseenter(function() {
                    $(selectedMega).show();
                });

                $(selectedMega).removeClass("active");
            }); */

           /* $('.mtn-megamenu-link-secion .menu-item').mouseenter(function() {

                menuIndex = $(this).index()+1;
                selectedMega = ".mtn-megamenu-content-" + menuIndex;
                $(selectedMega).addClass("active");

            }).mouseleave(function() {      
                $(selectedMega).mouseenter(function(){
                    $(selectedMega).css("background","yellow");
                }).mouseleave(function(){
                    $(selectedMega).css("background","blue");
                });
                $(selectedMega).removeClass("active");
            });*/

            

            
            
        //     function(){
        //         
        // });


    });
    
})(jQuery);