<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php global $fortun_options, $product_carousel, $product_layout, $product_shortcode; 
$column = '';
$shop_gutter = esc_attr( $fortun_options['shop-gutter'] );
$shop_gutter_value = esc_attr( $fortun_options['shop-gutter-value'] );

$shop_carousel_autoplay = 'true';
$shop_carousel_autoplay_timeout = '4000';
$shop_carousel_autoplay_speed = '700';
$shop_carousel_autoplay_hover = 'true';
$shop_carousel_loop = 'true';
$shop_carousel_pagination = 'true';
$shop_carousel_navigation = 'true';

switch($product_layout){
    case '1':
        $column = 'data-post-0="1" data-post-768="1" data-post-992="1" data-post-1200="1"';
        break;
    case '2':
        $column = 'data-post-0="1" data-post-768="1" data-post-992="2" data-post-1200="2"';
        break;
    case '3':
        $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="3"';
        break;
    case '4':
        $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="4"';
        break;
    case '5':
        $column = 'data-post-0="1" data-post-768="2" data-post-992="4" data-post-1200="5"';
        break;
}

    ?>
<ul class="products <?php echo esc_attr( $product_carousel ); $product_carousel = null; ?> products-row row<?php if( $fortun_options['shop-gutter'] != '1' ){ echo ' shop-no-gutter'; } ?>" style="<?php if( $shop_gutter == '1' ){ if( $product_shortcode != true ){ echo 'margin: 0 -'.intval($shop_gutter_value/2).'px;'; } else{ echo 'margin: 0;'; } } ?>" data-shop-grid="<?php echo esc_attr( $fortun_options['shop-grid-layout'] ); ?>" <?php if( $shop_gutter == '1' ){ echo 'data-gutter="'.esc_attr( $shop_gutter_value ).'"'; } ?>  data-posttype-autoplay="<?php echo esc_attr( $shop_carousel_autoplay ); ?>" data-posttype-autoplay-timeout="<?php echo esc_attr( $shop_carousel_autoplay_timeout ); ?>" data-posttype-autoplay-speed="<?php echo esc_attr( $shop_carousel_autoplay_speed ); ?>" data-posttype-autoplay-hover="<?php echo esc_attr( $shop_carousel_autoplay_hover ); ?>" data-posttype-loop="<?php echo esc_attr( $shop_carousel_loop ); ?>" data-posttype-pagination="<?php echo esc_attr( $shop_carousel_pagination ); ?>" data-posttype-navigation="<?php echo esc_attr( $shop_carousel_navigation ); ?>" <?php echo wp_kses_post( $column ); ?>>