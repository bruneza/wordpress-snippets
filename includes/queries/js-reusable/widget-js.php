<?php
if (!function_exists('select_filter_js')) {    
    /**
     * select_filter_js
     *
     * @param  array $input [
     * array settings,
     * array tax-terms,
     * array tax-ids,
     * array tax-count,
     * ]
     * @return void
     */
    function select_filter_js($input)
    {
        $tabsArray = array();
        $tabsdata = array();
        foreach (range(1, $input['tax-count']) as $c) {
            $tabsArray = array_merge($tabsArray, ['tab' . $c]);
        }

        $tabs = implode(",", $tabsArray);
?>
        <script>
            (function($) {
                $(document).ready(function() {
                    var filterActive;

                    function filterCategory(<?= $tabs; ?>) {

                        $('.filter-content-items .filter-content-item').removeClass('active');

                        var selector = ".filter-grid-section .filter-content-item";

                        <?php
                        foreach ($tabsArray as $i => $tab) {
                            $taxInfo = get_taxonomy($input['tax-ids'][$i])->rewrite['slug'];
                        ?>
                            if (<?= $tab; ?> !== 'tab-all') {
                                selector = '[data-<?= $taxInfo; ?> =' + <?= $tab; ?> + "]";
                            }

                        <?php } ?>

                        filterActive = tab1;
                        $(selector).addClass('active');

                    }

                    $('.filter-grid-section .filter-content-item').addClass('active');
                    <?php
                    $tabTaxSlug = array();
                    foreach (array_keys($input['tax-terms']) as $filterTaxKey) {
                        $tabTaxSlug = array_merge($tabTaxSlug, ['$(".filter-grid-section select.' . get_taxonomy($filterTaxKey)->rewrite['slug'] . '").val()']);
                    }

                    $tabTaxSlug = implode(',', $tabTaxSlug);
                    ?>
                    $('.filter-grid-section select').change(function() {
                        filterCategory(<?= $tabTaxSlug; ?>);
                    });
                });

            })(jQuery);
        </script>
<?php
    }
}
