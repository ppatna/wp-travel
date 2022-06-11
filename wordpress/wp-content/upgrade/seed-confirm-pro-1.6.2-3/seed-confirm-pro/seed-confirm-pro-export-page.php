<?php 

/**
* Adds a submenu page under a seed_confirm_log post type.
*/
add_action('admin_menu', 'seed_register_confirm_log_export_page');

function seed_register_confirm_log_export_page() {
	$capabilities = 'manage_options';

	if (is_woo_activated()) {
		$capabilities = 'manage_woocommerce';
	}
	add_submenu_page(
		'edit.php?post_type=seed_confirm_log',
		__( 'CSV Export', 'seed-confirm' ),
		__( 'CSV Export', 'seed-confirm' ),
		$capabilities,
		'seed-confirm-log-export',
		'seed_confirm_log_export_html'
	);
}

/**
 * Seed CSV export form
 */
function seed_confirm_log_export_html(){
	/*'seed-confirm' = 'seed-confirm';*/
	?>

	<div class="wrap">

		<h1><?php echo _e( 'CSV Export', 'seed-confirm' ) ?></h1>

		<!-- main content -->
		<div>
			<p><?php echo __( 'When you click the button below system will create an CSV file for you to save to your computer.', 'seed-confirm' ) ?></p>
			
			<form action="<?php echo admin_url('admin-post.php') ?>" method="POST">
				<input type="hidden" name="action" value="csv_export">
				<?php wp_nonce_field( 'csv_export_nonce', 'csv_export' ); ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="blogname"><?php esc_html_e('Export By', 'seed-confirm') ?></label></th>
							<td>
								<p style="margin-top: 0;">
									<label title='<?php esc_attr_e( 'Export All', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_by" id="by_all" value="all" required /><span><?php esc_html_e('All', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'PromptPay', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_by" value="promptpay" /><span><?php esc_html_e('PromptPay', 'seed-confirm' ); ?></span>
									</label>
								</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="blogname"><?php esc_html_e('Numbers of export', 'seed-confirm') ?></label></th>
							<td>
								<p style="margin-top: 0;">
									<select name="expert_number" id="expert_number" required>
										<option value="all"><?php esc_html_e( 'All', 'seed-confirm' ); ?></option>
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="30">100</option>
										<option value="custom"><?php esc_html_e( 'Custom', 'seed-confirm' ); ?></option>
									</select>
									<span><?php esc_html_e( 'Row', 'seed-confirm' ); ?></span>
								</p>
								<p class="expert_number_custom_wrapper" style="display: none;"></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="blogname"><?php esc_html_e('Export Range', 'seed-confirm') ?></label></th>
							<td>
								<p style="margin-top: 0;">
									<label title='<?php esc_attr_e( 'All', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="all" id="export_range_all" required /><span><?php esc_html_e( 'All', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'Last 7 Days', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="week" id="export_range_week" /><span><?php esc_html_e( 'Last 7 Days', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'This Month', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="current_month" id="export_range_month" /><span><?php esc_html_e( 'This Month', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'Last Month', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="last_month" id="export_range_month" /><span><?php esc_html_e( 'Last Month', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'This Year', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="current_year" id="export_range_year" /><span><?php esc_html_e( 'This Year', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'Last Year', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="last_year" id="export_range_year" /><span><?php esc_html_e( 'Last Year', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'Custom Range', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_range" value="custom" id="export_range_custom" /><span><?php esc_html_e( 'Custom Range', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<ul id="page-filters" class="export-filters" style="display: block;">
									<li>
										<fieldset>
										<legend class="screen-reader-text"><?php esc_html_e( 'Date range:', 'seed-confirm' ) ?></legend>
										<label for="page-start-date" class="label-responsive"><?php esc_html_e( 'Start date:', 'seed-confirm' ) ?></label>
										<input type="text" name="export_range_start" class="datepicker export-range-datepicker" placeholder="dd/mm/yy" disabled>
										<label for="page-end-date" class="label-responsive"><?php esc_html_e( 'End date:', 'seed-confirm' ) ?></label>
										<input type="text" name="export_range_end" id="export_range_end" class="datepicker export-range-datepicker" placeholder="dd/mm/yy" disabled>	
										</fieldset>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="blogname"><?php echo __('Export Language', 'seed-confirm') ?></label></th>
							<td>
								<p style="margin-top: 0;">
									<label title='<?php esc_attr_e( 'Thai (TH)', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_lang" id="by_all" value="th" checked required /><span><?php esc_attr_e('Thai (TH)', 'seed-confirm' ); ?></span>
									</label>
								</p>
								<p>
									<label title='<?php esc_attr_e( 'English (EN)', 'seed-confirm' ); ?>'>
										<input type="radio" name="export_lang" value="en" /><span><?php esc_attr_e('English (EN)', 'seed-confirm' ); ?></span>
									</label>
								</p>
							</td>
						</tr>
						<tr>
							<th></th>
							<td colspan="2">
								<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Download Export File' ); ?>" />&nbsp;
								<input class="button-secondary" type="reset" value="<?php esc_attr_e( 'Reset', 'seed-confirm' ); ?>" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<!-- post-body-content -->

	</div> <!-- .wrap -->

	<?php
}

/**
 * Seed CSV Export function
 * @return csv file
 */
function seed_csv_export_download() {
	$wp_http_referer = $_POST['_wp_http_referer'];
	global $wpdb;

	// Check for current user privileges 
  if( !current_user_can( 'manage_options' ) ){ 
  	wp_die('Sorry, you are not allowed to access this page.');
  }

  // Check if we are in WP-Admin
  if( !is_admin() ){ 
  	wp_die('Sorry, you are not allowed to access this page.');
  }
  
  // Nonce Check
  if (!isset( $_POST['csv_export'] ) || !wp_verify_nonce( $_POST['csv_export'], 'csv_export_nonce')) {
    wp_die('Sorry, your nonce did not verify <a href="'.$wp_http_referer.'" style="display: block;">Return Back</a>');
  }

  // Variable
  $range = sanitize_text_field( $_POST['export_range'] );
  $by = sanitize_text_field( $_POST['export_by'] );
  $lang = sanitize_text_field( $_POST['export_lang'] );
  $export_number = sanitize_text_field( $_POST['expert_number'] );
  $export_number_custom = sanitize_text_field( $_POST['expert_number_custom'] );

  $order_status = array();

  $args = array(
    'post_type' => 'seed_confirm_log',
    'post_status' => 'publish',
	);

	if ($export_number === "all") {
		$args['posts_per_page'] = -1;
	} elseif ($export_number === "custom" && $export_number_custom > 0) {
		$args['posts_per_page'] = $export_number_custom;
	} else {
		$args['posts_per_page'] = $export_number;
	}

  $time_human = '';

	if ($range !== "custom" && $range !== "all") {
		if ($range === "week") {
			$after = date('Y-m-d', strtotime("sunday last week"));
			$before = date('Y-m-d', strtotime("sunday this week"));
			$time_human = "Last week";
		} elseif ($range === "current_month") {
			$after = date('Y-m-d', strtotime("first day of this month"));
			$before = date('Y-m-d', strtotime("now"));
			$time_human = "This month";
		} elseif ($range === "last_month") {
			$after = date('Y-m-d', strtotime("first day of last month"));
			$before = date('Y-m-d', strtotime("last day of last month"));
			$time_human = "Last month";
		} elseif ($range === "current_year") {
			$after = date('Y-m-d', strtotime("this year January 1st"));
			$before = date('Y-m-d', strtotime("now"));
			$time_human = "This year";
		} elseif ($range === "last_year") {
			$after = date('Y-m-d', strtotime("last year January 1st"));
			$before = date('Y-m-d', strtotime("last year December 31st"));
			$time_human = "Last year";
		}
  	$args['date_query'] = array(
  		array(
				'after' => $after,
			),
    	array(
				'before' => $before,
			),
			'inclusive' => true,
  	);
  } elseif ($range === "custom") {
  	if (isset($_POST['export_range_start'])) {
  		$date_range = explode(' to ', $_POST['export_range_start']);
	  	$args['date_query'] = array(
	    	array(
					'after'     => $date_range[0],
					'before'    => $date_range[1],
					'inclusive' => true,
				),
	  	);
	  	$time_human = $date_range[0].' to '.$date_range[1];
  	}
  } else {
  	$time_human = 'All';
  }

	if ($by === "promptpay") {
		$args['s'] = 'promptpay';
	}

	$posts = get_posts( $args );

	$csv_body = array();
	foreach ($posts as $key => $post) {
		$post_id = $post->ID;

		$name         = get_post_meta( $post_id, 'seed-confirm-name', true );
		$email        = get_post_meta( $post_id, 'seed-confirm-email', true );
		$via          = get_post_meta( $post_id, 'seed-confirm-via', true );
		$promptpay_id = get_post_meta( $post_id, 'seed-confirm-promptpay_id', true );
		$date 				= get_post_meta( $post_id, 'seed-confirm-date', true );
		$hour         = get_post_meta( $post_id, 'seed-confirm-hour', true );
		$minute         = get_post_meta( $post_id, 'seed-confirm-minute', true );
		$date_formatted = $date.' '.$hour.':'.$minute;


		if (!empty($name)) {

			$csv_body[$key]['name']         = $name;
			$csv_body[$key]['tel']          = get_post_meta( $post_id, 'seed-confirm-contact', true );
			$csv_body[$key]['email']        = $email;
			$csv_body[$key]['order_no']     = get_post_meta( $post_id, 'seed-confirm-order', true );
			$csv_body[$key]['bank_name']    = get_post_meta( $post_id, 'seed-confirm-bank-name', true );
			$csv_body[$key]['bank_number']  = get_post_meta( $post_id, 'seed-confirm-account-number', true );
			$csv_body[$key]['via']          = $via;
			$csv_body[$key]['promptpay_id'] = $promptpay_id;
			$csv_body[$key]['amount']       = get_post_meta( $post_id, 'seed-confirm-amount', true );
			$csv_body[$key]['date']         = $date_formatted;
			$csv_body[$key]['remark']       = get_post_meta( $post_id, 'seed-confirm-optional-information', true );
			$csv_body[$key]['slip']         = get_post_meta( $post_id, 'seed-confirm-image', true );

			// Split <br> tag from content string
			$lists = preg_split("/(<br ?\/?>)/", $post->post_content);

			// Restructor array for csv body
			foreach ($lists as $value) {

				if (empty($email) && preg_match('/อีเมล|Email/', $value)) {
					$csv_body[$key]['email'] = getTextBetweenTags($value, 'span');
				} elseif (empty($via) && preg_match('/(PromptPay|promptpay)/', $value)) {
					$csv_body[$key]['via'] = 'PromptPay';
				} elseif (empty($promptpay_id) && preg_match('/(หมายเลขพร้อมเพย์|PromptPay ID)/', $value)) {
					$csv_body[$key]['promptpay_id'] = getTextBetweenTags($value, 'span');
				}

			}

		}

	}
  
  ob_start();
  $time_range_sanitize = sanitize_title( $time_human );
  $filename = 'seed-confirm-pro-'.$time_range_sanitize.'-'.time().'.csv';
  
  if (isset($lang) && $lang === "th") {
  	$header_row = array(
	    'ชื่อ',
	    'เบอร์ติดต่อ',
	    'อีเมล',
	    'คำสั่งซื้อเลขที่',
	    'ธนาคาร',
	    'เลขที่บัญชี',
	    'โดย',
	    'หมายเลขพร้อมเพย์',
	    'ยอดโอน',
	    'วันที่',
	    'หมายเหตุ',
	    'สลิป',
	  );
  } else {
  	$header_row = array(
  		'Name',
	  	'Tel.',
	  	'Email',
	  	'Order No.',
	  	'Bank Name',
	  	'Bank Number',
	  	'Via',
	  	'PromptPay ID',
	  	'Amount',
	  	'Date',
	  	'Remark',
	  	'Payment Slip',
  	);
  }

  $data_rows = array();
  $fh = @fopen( 'php://output', 'w' );
  fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
  header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
  header( 'Content-Description: File Transfer' );
  header( 'Content-type: text/csv' );
  header( "Content-Disposition: attachment; filename={$filename}" );
  header( 'Expires: 0' );
  header( 'Pragma: public' );
  fputcsv( $fh, $header_row );
  foreach ( $csv_body as $value ) {
      fputcsv( $fh, $value );
  }
  fclose( $fh );
  
  ob_end_flush();
  
  die();
}
add_action( 'admin_post_csv_export', 'seed_csv_export_download' );

/**
 * Enqueues admin script for csv export page
 */
function seed_csv_enqueue_scripts() {

	$screen = get_current_screen();

	if ( $screen->id == 'seed_confirm_log_page_seed-confirm-log-export' ) {

		wp_enqueue_script('seed-jquery-ui-datepicker', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), false, true);
		wp_enqueue_script('seed-jquery-ui-rangePlugin', 'https://cdn.jsdelivr.net/npm/flatpickr@4.5.0/dist/plugins/rangePlugin.js', array('jquery'), false, true);
		wp_enqueue_style( 'seed-jquery-ui-datepicker', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', false, false, false );
		wp_enqueue_style( 'seed-jquery-ui-datepicker-theme', 'https://unpkg.com/flatpickr@4.4.6/dist/themes/airbnb.css', false, false, false );

	}

}
add_action( 'admin_enqueue_scripts', 'seed_csv_enqueue_scripts' );

/**
 * Adds inline css to csv export page
 */
function seed_csv_admin_style() {

	$screen = get_current_screen();

	if ( $screen->id == 'seed_confirm_log_page_seed-confirm-log-export' ) {
		?>
			<style>
				.export-range-datepicker,
				.export-range-datepicker[readonly]{
					background-color: #fff;
				}
				.export-range-datepicker[disabled] {
					background: rgba(255,255,255,.5);
    			border-color: rgba(222,222,222,.75);
				}
			</style>
		<?php
	}

}
add_action( 'admin_print_styles', 'seed_csv_admin_style', 1000 );

/**
 * Adds inline javascript to csv export page
 */
function seed_csv_admin_script() {

	$screen = get_current_screen();

	if ( $screen->id == 'seed_confirm_log_page_seed-confirm-log-export' ) {
		?><script type="text/javascript">
			jQuery(document).ready(function($) {
		
				var $calendar = $(".datepicker").flatpickr({
					maxDate: "today",
					altInput: true,
			    altFormat: "d/m/Y",
			    dateFormat: "Y-m-d",
			    "plugins": [new rangePlugin({ input: "#export_range_end"})]
				});

				$('input[name="export_range"]').change(function(event) {
					if ($(this).is(":checked") && $(this).val() == "custom")	 {
						$('.export-range-datepicker').attr('disabled', false);
						$calendar.open();
					} else {
						$('.export-range-datepicker').attr('disabled', true);
						$calendar.clear();
					}
				});

				$('#expert_number').change(function(event) {
					if ($(this).val() === 'custom') $(".expert_number_custom_wrapper").append('<input type="number" name="expert_number_custom" id="expert_number_custom" step="1" min="1" placeholder="0" required />').show();
        	else $(".expert_number_custom_wrapper").html('').hide();
				});
			});
		</script><?php
	}

}
add_action( 'admin_print_scripts', 'seed_csv_admin_script', 1000 );

/**
 * Get text with beetween tag regex
 */
function getTextBetweenTags($string, $tagname) {
  $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
  preg_match($pattern, $string, $matches);
  return $matches[1];
}

