// Add Buy Now Button -> redirect to checkout 
add_action( 'woocommerce_after_shop_loop_item', 'norma_buy_now_button', 15 );
add_action( 'woocommerce_after_add_to_cart_button', 'norma_buy_now_button' );
function norma_buy_now_button() {
	global $product;
   global $woocommerce_loop;

	if ( 'simple' !== $product->get_type()
	|| ! $product->is_purchasable()
	|| ! $product->is_in_stock() ) {
		return;
	}

	$id = $product->get_ID();

	$classes = implode(
		' ',
		array_filter(
			array(
        'button',
				'product_type_' . $product->get_type(),
				'add_to_cart_button',
        'single_add_to_cart_button', 
        'alt' 
			)
		)
	);
	ob_start();
	
    if ( is_product() && !($woocommerce_loop['name'] == 'up-sells')){?>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>?add-to-cart=<?php echo absint( $id ); ?>" rel="nofollow">
            <button class="<?php echo esc_attr( $classes ); ?> loop-buynow o2">
				<?php echo esc_html_e( 'Buy Now', 'norma-precision' ); ?>
            </button>
       </a>
   <?php }else{?>
         <?php    if ( is_product() && $woocommerce_loop['name'] == 'up-sells' ) {?>
               <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>?add-to-cart=<?php echo absint( $id ); ?>" class="button wp-element-button product_type_simple add_to_cart_button ajax_add_to_cart upsell   " rel="nofollow">
                    <?php echo esc_html_e( 'Buy Now', 'norma-precision' ); ?>
               </a>
        <?php }else{?>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>?add-to-cart=<?php echo absint( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> loop-buynow" rel="nofollow">
                    <?php echo esc_html_e( 'Buy Now', 'norma-precision' ); ?>
               </a>
        <?php }
    	
  }


	echo ob_get_clean();
}
