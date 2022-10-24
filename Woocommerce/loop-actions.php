<?php
/**
 * Change a currency symbol
 */

/*** Edit Product loop grid***/
add_action( 'init', 'edit_loop_actions');
function edit_loop_actions() {
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30 );
    remove_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail',40 );
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 40 );
    add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail',30 );
}
