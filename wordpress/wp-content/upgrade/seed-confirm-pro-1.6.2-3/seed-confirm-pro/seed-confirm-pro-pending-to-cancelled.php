<?php

/**
 * Run seed_confirm_schedule_pending_to_cancelled_orders
 *
 * @access public
 * @return void
 */
add_action('seed_confirm_schedule_pending_to_cancelled_orders', 'seed_confirm_schedule_pending_to_cancelled_orders');

function seed_confirm_schedule_pending_to_cancelled_orders($param) {

    $held_duration = get_option('seed_confirm_time');

    $params = array(
        'duration' => $held_duration,
        'status' => 'cancelled',
        'status_text' => 'Unpaid order cancelled - time limit reached.',
    );
    seed_confirm_update_order_status($params);

    wp_clear_scheduled_hook('seed_confirm_schedule_pending_to_cancelled_orders');
    // wp_schedule_single_event(time() + ( absint($held_duration) * 60 ), 'seed_confirm_schedule_pending_to_cancelled_orders');
    wp_schedule_event(time() + ( absint($held_duration) * 60 ), 'hourly', 'seed_confirm_schedule_pending_to_cancelled_orders');
}

/*
 * seed_confirm_update_order_status
 * @access public
 * @return int order number
 */
function seed_confirm_update_order_status($params) {
    global $wpdb;
    $duration = $params['duration'];
    $status = $params['status'];
    $status_text = $params['status_text'];

    $date = date("Y-m-d H:i:s", strtotime('-' . absint($duration) . ' MINUTES', current_time('timestamp')));

    $unpaid_orders = $wpdb->get_col($wpdb->prepare("
		SELECT posts.ID
		FROM {$wpdb->posts} AS posts
		WHERE 	posts.post_type   = 'shop_order'
		AND 	posts.post_status = 'wc-on-hold'
		AND 	posts.post_modified < '%s'
	", $date));

    if ($unpaid_orders) {
        foreach ($unpaid_orders as $unpaid_order) {
            $order = new WC_Order($unpaid_order);
            $order->update_status($status, $status_text);
        }
    }

    return count($unpaid_orders);
}
