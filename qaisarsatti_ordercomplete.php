<?php
/**
 * Plugin Name: Qaisar Satti Autocomplete Order
 * Plugin URI: https://store.qaisarsatti.com
 * Description: Order complete automatically
 * Version: 1.0.0
 * Text Domain: Qaisar Satti Store
 * Author: Qaisar Satti
 * Author URI: https://store.qaisarsatti.com
 */
 if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	function qaisarsatti_completeorder_admin_notice() {
		$ordercomplete_allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'strong' => array(),
		);
		// Deactivate the plugin
		deactivate_plugins(__FILE__);
		$ordercomplete_woo_check = '<div id="message" class="error">
			<p><strong>Order Autocomplete plugin is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';
		echo wp_kses( __( $ordercomplete_woo_check, 'qaisarsatti-ordercomplete' ), $ordercomplete_allowed_tags);
	}
		add_action('admin_notices', 'qaisarsatti_completeorder_admin_notice');

			

}

add_action( 'woocommerce_thankyou', 'qaisarsatti_completeorder'  );
function qaisarsatti_completeorder( $orderId ) {			
	$orderDetail = wc_get_order( $orderId );
	if($orderDetail->get_status()!="completed")
	{
	$orderDetail->update_status( 'completed' );
	}
	return;
}