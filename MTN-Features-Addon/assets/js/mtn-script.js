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

        // $('.mtn-award-img .elementor-image-box-description').insertBefore( function() {
        //    return $(this).parent();
        // });
        $(document).ready(function() {
            
        });

    });
    
})(jQuery);