<?php

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RWF': $currency_symbol = 'Frw'; break;
     }
     return $currency_symbol;
}
