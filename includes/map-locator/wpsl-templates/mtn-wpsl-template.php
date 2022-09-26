<?php 
global $wpsl_settings, $wpsl;

$mapLocator = array();

$mapLocator['searchLabel'] = $wpsl->i18n->get_translation( 'search_label', __( 'Your location', 'wpsl' ) );
$mapLocator['searchResult'] = $wpsl->i18n->get_translation( 'results_label', __( 'Results', 'wpsl' ) ) ;
$mapLocator['searchBtnLabel'] = esc_attr( $wpsl->i18n->get_translation( 'search_btn_label', __( 'Search', 'wpsl' ) ) );

$output = mtn_map_Locator($mapLocator) . "\r\n";

return $output;