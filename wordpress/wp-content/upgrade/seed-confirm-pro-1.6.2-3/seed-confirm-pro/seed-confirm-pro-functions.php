<?php

/**
 * Check woo-commerce plugin is installed and activated or not.
 * @return bool
 */
if (! function_exists('is_woo_activated')) {
    function is_woo_activated()
    {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Get array of banks.
 * @param array $accounts
 * @return array
 */
if (!function_exists('seed_confirm_get_banks')) {
    function seed_confirm_get_banks($accounts)
    {
        $thai_accounts = array();

        if (!empty($accounts) && is_array($accounts) && count($accounts) > 0) {
            foreach ($accounts as $_account) {
                $is_thaibank = false;
                $logo = '';

                if ((false !==  mb_strpos(trim($_account['bank_name']), 'กสิกร'))
                    || false !== stripos(trim($_account['bank_name']), 'kbank')
                    || false !== stripos(trim($_account['bank_name']), 'kasikorn')) {
                    $is_thaibank = true;
                    $logo = 'kbank';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'กรุงเทพ'))
                || false !== stripos(trim($_account['bank_name']), 'bbl')
                || false !== stripos(trim($_account['bank_name']), 'bangkok')
                || false !== stripos(trim($_account['bank_name']), 'bualuang')) {
                    $is_thaibank = true;
                    $logo = 'bbl';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'กรุงไทย'))
                || false !== stripos(trim($_account['bank_name']), 'ktb')
                || false !== stripos(trim($_account['bank_name']), 'krungthai')) {
                    $is_thaibank = true;
                    $logo = 'ktb';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ทหารไทย'))
                || false !== stripos(trim($_account['bank_name']), 'tmb')
                || false !== stripos(trim($_account['bank_name']), 'thai military')) {
                    $is_thaibank = true;
                    $logo = 'tmb';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ไทยพาณิชย์'))
                || false !== stripos(trim($_account['bank_name']), 'scb')
                || false !== stripos(trim($_account['bank_name']), 'siam commercial')) {
                    $is_thaibank = true;
                    $logo = 'scb';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'กรุงศรี'))
                || false !== stripos(trim($_account['bank_name']), 'bay')
                || false !== stripos(trim($_account['bank_name']), 'krungsri')) {
                    $is_thaibank = true;
                    $logo = 'krungsri';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ซิดี้'))
                || false !== stripos(trim($_account['bank_name']), 'citi')) {
                    $is_thaibank = true;
                    $logo = 'citi';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ออมสิน'))
                || false !== stripos(trim($_account['bank_name']), 'gsb')) {
                    $is_thaibank = true;
                    $logo = 'gsb';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ธนชาต'))
                || false !== stripos(trim($_account['bank_name']), 'tbank')) {
                    $is_thaibank = true;
                    $logo = 'tbank';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'ยูโอบี'))
                || false !== stripos(trim($_account['bank_name']), 'uob')) {
                    $is_thaibank = true;
                    $logo = 'uob';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'อิสลาม'))
                || false !== stripos(trim($_account['bank_name']), 'islamic')
                || false !== stripos(trim($_account['bank_name']), 'ibank')) {
                    $is_thaibank = true;
                    $logo = 'ibank';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'อาคารสงเคราะห์'))
                || false !== mb_strpos(trim($_account['bank_name']), 'ธอส')
                || false !== stripos(trim($_account['bank_name']), 'ghb')) {
                    $is_thaibank = true;
                    $logo = 'ghb';
                } elseif ((false !== mb_strpos(trim($_account['bank_name']), 'พร้อมเพย์'))
                || false !== stripos(trim($_account['bank_name']), 'promptpay')) {
                    $is_thaibank = true;
                    $logo = 'promptpay';
                } elseif (false !== stripos(trim($_account['bank_name']), 'bca')) { /* ------------- ID BANK ------------- */
                    $is_thaibank = true;
                    $logo = 'bca';
                } elseif (false !== stripos(trim($_account['bank_name']), 'bni')) {
                    $is_thaibank = true;
                    $logo = 'bni';
                } elseif (false !== stripos(trim($_account['bank_name']), 'bri')) {
                    $is_thaibank = true;
                    $logo = 'bri';
                } elseif (false !== stripos(trim($_account['bank_name']), 'mandiri')) {
                    $is_thaibank = true;
                    $logo = 'mandiri';
                } elseif (false !== stripos(trim($_account['bank_name']), 'btpn')) {
                    $is_thaibank = true;
                    $logo = 'btpn';
                }

                $_account['is_thaibank'] = $is_thaibank;

                if ($logo !== '') {
                    $_account['logo'] = plugins_url('img/'.$logo.'.png', __FILE__);
                } else {
                    $_account['logo'] = plugins_url('img/none.png', __FILE__);
                }

                $thai_accounts[] = $_account;
            }
        }

        return $thai_accounts;
    }
}

/**
 * Use for generate unique file name.
 * Difficult to predict.
 * Only slip image that upload through seed-confirm.
 * @param $dir
 * @param $name
 * @param $ext
 * @return (string) uniq name
 */
if (!function_exists('seed_unique_filename')) {
    function seed_unique_filename($dir, $name, $ext)
    {
        return 'slip-'.md5($dir.$name.time()).$ext;
    }
}


/**
 * Find Order ID from Order Number
 */

if (!function_exists('seed_get_order_id')) {
    function seed_get_order_id($order_number)
    {
        // Check for https://woocommerce.com/products/sequential-order-numbers-pro/
        if (class_exists('WC_Seq_Order_Number')) {
            return wc_seq_order_number_pro()->find_order_by_order_number($order_number);
        } else {
            // Other Plugins including https://wordpress.org/plugins/custom-order-numbers-for-woocommerce/
            foreach (wc_get_orders(array( 'limit' => -1 )) as $order) {
                if ($order->get_order_number() == $order_number) {
                    return $order->get_id();
                } else {
                    return false;
                }
            }
        }
    }
}