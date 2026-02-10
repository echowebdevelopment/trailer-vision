<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// global $post, $product;

// if( $product->get_stock_quantity()<=0 && $product->backorders_allowed() ) { 
// 	echo apply_filters( 'woocommerce_sale_flash', '<span class="preorder">' . esc_html__( 'Pre Order', 'woocommerce' ) . '</span>', $post, $product );
// }

// if ( $product->is_on_sale() ) {
// 	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'On Sale', 'woocommerce' ) . '</span>', $post, $product );
// }

// if( $product->get_type() == 'simple' ) {
// 	if( $product->get_stock_quantity() > 0 && $product->get_stock_quantity() < 5 ) {
// 		echo apply_filters( 'woocommerce_sale_flash', '<span class="lastfew">' . esc_html__( 'Last Few', 'woocommerce' ) . '</span>', $post, $product );
// 	}
// } else if( $product->get_type() == 'variable' ) {
// 	$variations = $product->get_available_variations();
// 	foreach($variations as $variation) {
// 		if( isset( $variation['max_qty'] ) ) {
// 			$attr_string = [];
// 			foreach ( $variation['attributes'] as $attr_name => $attr_value ) {
// 				$attr_string[] = $attr_value;
// 			}
// 			if( $variation['max_qty'] > 0 && $variation['max_qty'] < 5 ) {
// 				echo apply_filters( 'woocommerce_sale_flash', '<span class="lastfew">' . esc_html__( 'Last Few', 'woocommerce' ) . '</span>', $post, $product );
// 			} else if( $variation['max_qty'] < 1 ){
// 				echo apply_filters( 'woocommerce_sale_flash', '<span class="lastfew">' . esc_html__( 'Last Few', 'woocommerce' ) . '</span>', $post, $product );
// 			}
			
// 		}
// 	}
// }

global $post, $product;

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>

	<?php
endif;
