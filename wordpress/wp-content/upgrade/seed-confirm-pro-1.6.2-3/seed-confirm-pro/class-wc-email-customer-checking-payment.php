<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Checking_Payment', false ) ) :

/**
 * (I copy this file from original WooCommerce)
 * Customer Checking Payment Email.
 *
 * An email sent to the customer when a new order is paid for.
 *
 * @class       WC_Email_Customer_Checking_Payment
 * @version     1.0
 * @package     Seed-confirm-pro
 * @author      SeedTheme
 * @extends     WC_Email
 */
class WC_Email_Customer_Checking_Payment extends WC_Email {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id               = 'customer_checking_payment';
		$this->customer_email   = true;
		$this->title            = __( 'Checking Payment', 'seed-confirm' );
		$this->description      = __( 'This is an email notification sent to customers.', 'seed-confirm' );
		$this->heading          = __( 'We are checking order payment', 'seed-confirm' );
		$this->subject          = __( 'Your {site_title} order receipt from {order_date}', 'seed-confirm' );
		$this->template_base    = untrailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/';
		$this->template_html    = 'emails/customer-checking-payment.php';
		$this->template_plain   = 'emails/plain/customer-checking-payment.php';

		// Triggers for this email
		add_action( 'woocommerce_order_status_on-hold_to_checking-payment_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_pending_to_checking-payment_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_processing_to_checking-payment_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_checking-payment_to_checking-payment_notification', array( $this, 'trigger' ), 10, 2 );

		// Call parent constructor
		parent::__construct();
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param int $order_id The order ID.
	 * @param WC_Order $order Order object.
	 */
	public function trigger( $order_id, $order = false ) {
		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
			$order = wc_get_order( $order_id );
		}

		if ( is_a( $order, 'WC_Order' ) ) {
			$this->object       = $order;
			$this->recipient    = $this->object->billing_email;

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   =  mysql2date( get_option('date_format'), $this->object->order_date);
			$this->replace['order-number'] = $this->object->order_number;
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
		), '', untrailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/');
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		), '', untrailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/');
	}
}

endif;

return new WC_Email_Customer_Checking_Payment();
