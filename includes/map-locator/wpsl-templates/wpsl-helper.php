<?php




if (!function_exists('mtn_map_Filter')) {
    function mtn_map_Locator($mapLocator)
    { ?>
        <div class="map-locator-section elementor-container" id="wpsl-wrap">
            <div id="wpsl-gmap" class="wpsl-gmap-canvas mtn-gmap"></div>
            <div class="mtn-filter-result-box">
                <div class="container">
                    <div class="mtn-map-search">
                        <form class="mtn-search-form" autocomplete="off">
                            
                            <input id="wpsl-search-input" type="text" value="<?= apply_filters('wpsl_search_input', ''); ?>" name="wpsl-search-input" placeholder="Search City" aria-required="true" />
                            <input id="wpsl-search-btn" type="submit" value="<?= $mapLocator['searchBtnLabel']; ?>">
                        </form>
                    </div>
                    <div class="mtn-map-results">
                        <div id="wpsl-result-list">
                            <div id="wpsl-stores">
                                <ul></ul>
                            </div>
                            <div id="wpsl-direction-details">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
