<?php
/**
 *  SM_Shipping_Setting
 *
 * @package  Shipping-Method-plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'SM_Shipping_Setting' ) ) {

	/**
	 * Class SM_Shipping_Setting.
	 */
	class SM_Shipping_Setting {
		/**
		 *  Constructor.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register_shipped_order_status' ) );
			add_filter( 'wc_order_statuses', array( $this, 'custom_order_status' ), 20, 1 );
			add_action( 'woocommerce_order_status_changed', array( $this, 'client_email_on_shipment_status' ), 10, 4 );
		}

		/**
		 * Get dropdown Value.
		 */
		public function register_shipped_order_status() {
			register_post_status(
				'wc-shipped',
				array(
					'label'                     => 'Shipped',
					'public'                    => true,
					'exclude_from_search'       => false,
					'show_in_admin_all_list'    => true,
					'show_in_admin_status_list' => true,
					'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>' ),
				)
			);
		}
		/**
		 * Registered dropdown Value.
		 *
		 * @param array $order_statuses get all status.
		 */
		public function custom_order_status( $order_statuses ) {
			$order_statuses['wc-shipped'] = _x( 'Shipped', 'Order status', 'Shipping-Method-plugin' );
			return $order_statuses;
		}

		/**
		 * Sending an email notification when order get 'Shipped' status
		 *
		 * @param int    $order_id get order number.
		 * @param string $old_status get selected order status.
		 * @param string $new_status give a new order status.
		 * @param array  $order it recive complete order details.
		 */
		public function client_email_on_shipment_status( $order_id, $old_status, $new_status, $order ) {
			$mailer = WC()->mailer()->get_emails();

			if ( 'shipped' === $new_status ) {
 				$admin   = get_option( 'admin_email' );
				$heading = 'Your order has been shipped';
				$subject = 'Shipped order (Order No: {order_number}) - {order_date}';

				$mailer['WC_Email_Customer_Completed_Order']->heading             = $heading;
				$mailer['WC_Email_Customer_Completed_Order']->settings['heading'] = $heading;
				$mailer['WC_Email_Customer_Completed_Order']->subject             = $subject;
				$mailer['WC_Email_Customer_Completed_Order']->settings['subject'] = $subject;

				$mailer['WC_Email_Customer_Completed_Order']->trigger( $order_id );

				// Admin Mail.
				$admin_heading = 'Order status has been changed into shipped.';
				$admin_subject = 'Hello! You  changed the order.';
				 wp_mail( $admin, $admin_heading, $admin_subject );
			}
		}


	}
}
new SM_Shipping_Setting();
