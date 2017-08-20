<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function agni_woocommerce_pagination(){
global $wp_query, $fortun_options;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$shop_navigation = esc_attr( $fortun_options['shop-navigation'] );
$shop_navigation_ifs_btn_text = esc_attr( $fortun_options['shop-navigation-ifs-btn-text'] );
$shop_navigation_ifs_load_text = esc_attr( $fortun_options['shop-navigation-ifs-load-text'] );
$shop_navigation_ifs_finish_text = esc_attr( $fortun_options['shop-navigation-ifs-finish-text'] );
?>
		
<?php if( $shop_navigation == '2' || $shop_navigation == '3' ){ 
    $load_more_button = ( $shop_navigation == '3' )?'<span class="btn btn-accent">'.$shop_navigation_ifs_btn_text.'</span>':'';
    echo '<div class="load-more" data-msg-text="'.$shop_navigation_ifs_load_text.'" data-finished-text="'.$shop_navigation_ifs_finish_text.'">'.$load_more_button.'</div>';
} ?>
<div class="woocommerce-pagination page-number-navigation navigation">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
            'prev_text'    => esc_html__('Previous', 'fortun'),
            'next_text'    => esc_html__('Next', 'fortun'),
			'type'         => 'list',
			'end_size'     => 1,
			'mid_size'     => 1
		) ) );
	?>
</div>

<?php }
agni_woocommerce_pagination(); ?>
