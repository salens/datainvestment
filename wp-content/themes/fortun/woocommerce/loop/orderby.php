<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering" method="get">
	<div class="dropdown woocommerce-dropdown text-right">
		<a class="btn toggle-woocommerce-dropdown" data-toggle="dropdown">
			<?php echo ( ! in_array($orderby, array_keys($catalog_orderby_options)))?reset($catalog_orderby_options):$catalog_orderby_options[$orderby]; ?>
			<i class="ion-ios-arrow-down"></i>
		</a>

		<ul class="dropdown-menu woocommerce-dropdown-list">
			<?php foreach ( $catalog_orderby_options as $id => $name ) { ?>
			<li class="<?php echo ( $id == $orderby ) ? 'active' : ''; ?>">
				<a tabindex="-1" href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $name ); ?></a>
			</li>
			<?php } ?>
		</ul>

		<select name="orderby" class="orderby hidden">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'orderby' === $key || 'submit' === $key ) {
					continue;
				}
				if ( is_array( $val ) ) {
					foreach( $val as $innerVal ) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					}
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			}
		?>
	</div>
</form>
