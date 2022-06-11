# Seed Confirm Pro

Confirmation form for bank transfer payment. Can be used with or without WooCommerce.

## Change Log

### 1.6.2

-   New: Show order number with link on admin page - Log Archive.
-   Tweak: Support entering order number on form. This plugin will save real Order ID.
-   Tweak: Show support active version of WooCommerce.
-   Fix: Guest user submit error.

### 1.6.1

-   Fix: JS Error on checkout page.

### 1.6.0

-   New: Support "Upload Slip" button My Order page (enable in Settings).
-   New: Support Sequential Order Number Plugins such as
    -   https://wordpress.org/plugins/sequential-order-numbers-for-woocommerce/
    -   https://wordpress.org/plugins/custom-order-numbers-for-woocommerce/
    -   https://woocommerce.com/products/sequential-order-numbers-pro/
-   Tweak: Javascript files. Now we can use with cache plugin.
-   Tweak: Adjust Bank List style. Focus on mobile and minimal bank account display.
-   Tweak: CSV Export now support multi language.
-   Tweak: Better handle submit form.

### 1.5.2

-   New: Support Indonesia Banks (BTPN).
-   New: CSV Export
-   Fix: PDF and ZIP icons on WooCommerce Order Page.

### 1.5.1

-   New: Show slip image on Order Detail Page for admin.
-   New: Optional Email field.
-   New: Support backward to WooCommerce 2.x
-   New: Support Indonesia Banks (MANDIRI, BCA, BRI, BNI)
-   Tweak: Show error message if using with PHP < 5.6

### 1.5.0

-   New: Support multilanguage plugin (WPML, Polylang, WP Multilang).
-   New: Support PromptPay with QR Code payment.
-   Tweak: Add "all" in Order Status Filter. (Backend)
-   Fix: Email not sent (Checking Payment -> Processing).
-   Fix: Change "From" on Notification Email to admin. (From "Seed Confirm" to Website Name.)
-   Fix: Show Confirm Payement Form only orders with BACS.
-   Fix: Upload error on mobile.
-   Fix: Duplicated Payment Confirmation.
-   Fix: Conflict with WooCommerce PayPal Express Checkout Gateway plugin.

### 1.4.4

-   Tweak: Support Citi Bank and BAY.
-   Fix: Duplicated Email on order status changed to Processing.
-   Fix: Some PHP Notices

### 1.4.3

-   Fix: Upload file is required. Now can set to not required.
-   Fix: Can't manage without WooCommerce. Now allowed.

### 1.4.2

-   Fix: Plugin updating process.

### 1.4.1

-   Tweak: Error message handling.
-   Tweak: Uploading file process.
-   Tweak: Only jpg, png, gif, pdf files are allowed to upload.
-   Tweak: Settings UI.
-   Fix: Thai language in Window Live Mail 2012.
-   Fix: Unrelated orders on payment confirmatio form.

### 1.4.0

-   New: Can filter logs by order status.
-   New: Order status icons and action button (On WooCommerce Orders Page).
-   Tweak: Compatible with Bootstrap 3 & Bootstrap 4 and Famouse themes such as Flatsome and The7.
-   Tweak: Allow Shop Manager managing logs.
-   Fix: Compatible with WooCommerce Wallet.
-   Fix: Duplicated admin email notification.
-   Fix: Allow PDF attachment and Link to PDF file.
-   Fix: Re-submit order confirmation not allowed.
-   Fix: Canceled order confirmation not allowed.
-   Fix: Show only order that pay via Bank Transfer (BACS)

### 1.3.1

-   Fix: Compatible with Flatsome Theme 3.4 (Function: is_woocommerce_activated)

### 1.3.0

-   New: Thai locale in jQuery DatePicker.
-   Fix: Hide from people who trying to seach or query.
-   Fix: Unsent email when changing order status.
-   Fix: Change to correct BACS instuction field.

### 1.2.1

-   Fixed: False Positive in message.

### 1.2.0

-   New: Option to redirect page after submit confirmation form.
-   New: Show order status in admin's archive (list) page.
-   Fix: Notice in some pages.
-   Fix: Wrong font in datepicker for some themes.
-   Fix: Error when change slug (/confirm-payment/).
-   Fix: Some confirmed orders did not show "[Noted]".

### 1.1.0

-   New: Add new order status - Checking Payment.
-   New: Option for order status change after submit form (Processing or Checking Payment).
-   New: Support Invisible reCAPTCHA for wordpress plugin.
-   New: Support PromptPay information.
-   New: Add email template for Checking Payment.
-   Tweak: Check and notify user if no BACS settings.
-   Tweak: Check and notify admin if no BACS settings.
-   Tweak: Add button, input class to match WooCommerce CSS.
-   Tweak: Change table with on e-mail.

### 1.0.5

-   Fix: Error when logged-in users submit (for some servers).

### 1.0.4

-   Fix: Error when not-logged-in users confirm with random order ID.

### 1.0.3

-   Fix: Bank information disappeared if it was not the 1st order of payment gateways.

### 1.0.2

-   Fix: Show bank information in email only user who choose bank transfer payment.

### 1.0.1

-   Fix: Bug with update_options() for some servers.

### 1.0.0

-   New: Auto Cancel Unpaid Orders.

### 0.9.0

-   New: Optional fields - Address and Remark.
-   Tweak: Button style in My Account.
-   Tweak: Add bank name in email.
-   Fix: English bank name not shown.

### 0.8.2

-   Fix: iBank and GHB logos in some forms.

### 0.8.1

-   Tweak: Add iBank and GHB logos.
-   Fix: Logo size in email.

### 0.8.0

-   New: License Activation & Auto update.

### 0.7.0

-   New: Custom notify text.
-   New: Form validation.
-   New: Bank information without WooCommerce.
-   Tweak: Add nonce security to settings's form.

### 0.6.0

-   New: Setting page.
-   New: Add 3 banks: GSB, TBANK and UOB.
-   Tweak: Attatched slip changed to random name and saved in custom field.
-   Tweak: Attatched slip now included in email and content, not in media library.
-   Fix: PHP short tag to full tag.

### 0.5.1

-   Fix: change shortcode from echo to return.
-   Fix: log is not viewable from public.

### 0.5.0

-   First version.
