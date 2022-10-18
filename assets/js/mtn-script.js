(function ($) {

    /***** Post Grid ***/
    $(document).ready(function () {
        /***** Append badge to post grid content ***/
        $('#overlayed-post-grid .elementor-post__text').prepend(function () {
            return $(this).prev();
        });
        $('.mtn-move-badge .elementor-post__text').prepend(function () {
            return $(this).prev();
        });

    });
    /**** */

})(jQuery);