<?php 


    mysqli_query($connection, "UPDATE settings SET version = '1.5' WHERE id = 1;");

    mysqli_query($connection, "ALTER TABLE `business` ADD `enable_guest` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_group`;");

    mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_coupon` INT NULL DEFAULT '0' AFTER `enable_lifetime`;");

    mysqli_query($connection, "ALTER TABLE `services` ADD `google_meet` TEXT NULL DEFAULT NULL AFTER `zoom_link`;");

    mysqli_query($connection, "UPDATE `features` SET `name` = 'Virtual Meeting(Zoom, Google Meet)' WHERE `features`.`id` = 7;");

    mysqli_query($connection, "UPDATE `lang_values` SET `english` = 'Virtual Meeting(Zoom, Google Meet)' WHERE `lang_values`.`keyword` = 'zoom-meeting';");

    mysqli_query($connection, "ALTER TABLE `settings` ADD `paystack_payment` VARCHAR(155) NULL DEFAULT '0' AFTER `secret_key`, ADD `paystack_secret_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_payment`, ADD `paystack_public_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_secret_key`;");

    mysqli_query($connection, "ALTER TABLE `users` ADD `paystack_payment` VARCHAR(155) NULL DEFAULT '0' AFTER `secret_key`, ADD `paystack_secret_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_payment`, ADD `paystack_public_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_secret_key`;");


    mysqli_query($connection, "
        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Apply your coupon code here', 'apply-your-coupon-code-here', 'Apply your coupon code here'),
        ('user', 'Coupons limit', 'coupons-limit', 'Coupons limit'),
        ('user', 'How many days will be active this coupon', 'how-many-days-will-be-active-this-coupon', 'How many days will be active this coupon'),
        ('user', 'Discount must be between 1% - 99%', 'discount-must-be-between', 'Discount must be between 1% - 99%'),
        ('user', 'Export as CSV', 'export-as-csv', 'Export as CSV'),
        ('user', 'Codes', 'codes', 'Codes'),
        ('user', 'See all codes', 'see-all-codes', 'See all codes'),
        ('user', 'Your name string contains illegal characters.', 'illegal-characters-title', 'Your name string contains illegal characters.'),
        ('user', 'Please Complete these steps', 'please-complete-these-steps', 'Please Complete these steps'),
        ('user', 'Set Business Hours', 'set-business-hours', 'Set Business Hours'),
        ('user', 'Add Staff', 'add-staff', 'Add Staff'),
        ('user', 'Add Customer', 'add-customer', 'Add Customer'),
        ('user', 'Add Service', 'add-service', 'Add Service'),
        ('user', 'Enter phone number with dial code', 'enter-phone-number-with-dial-code', 'Enter phone number with dial code'),
        ('user', 'Cities', 'cities', 'Cities'),
        ('user', 'Location is required', 'location-required', 'Location is required'),
        ('admin', 'Paystack', 'paystack', 'Paystack'),
        ('admin', 'Setup Your Paystack Account to Accept Payments', 'paystack-title', 'Setup Your Paystack Account to Accept Payments'),
        ('user', 'Recently booked an appointment at', 'recently-booked-an-appointment', 'Recently booked an appointment at'),
        ('user', 'New appointment is booked', 'new-appointment-is-booked', 'Booked new appointment'),
        ('user', 'Quantity', 'quantity', 'Quantity'),
        ('user', 'Coupon code already applied', 'coupon-code-already-applied', 'Coupon code already applied'),
        ('user', 'Have any coupon code?', 'have-any-coupon-code', 'Have any coupon code?'),
        ('user', 'Enable to active coupon code feature', 'enable-coupon-title', 'Enable to active coupon code feature'),
        ('user', 'Allow Google Meet', 'allow-google-meet', 'Allow Google Meet'),
        ('user', 'Google meet link', 'google-meet-link', 'Google meet invitation link'),
        ('user', 'Google Meet', 'google-meet', 'Google Meet'),
        ('user', 'Virtual Meeting', 'virtual-meeting', 'Virtual Meeting'),
        ('user', 'Zoom', 'zoom', 'Zoom'),
        ('user', 'Enable Coupon from', 'enable-coupon-from', 'Enable Coupon from');
    ");

    mysqli_query($connection, "CREATE TABLE `plan_coupons_apply` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `coupon_id` int(11) NOT NULL,
      `created_at` date NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

    mysqli_query($connection, "CREATE TABLE `plan_coupons` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uid` varchar(255) NOT NULL,
      `name` varchar(255) DEFAULT NULL,
      `user_id` varchar(155) DEFAULT '0',
      `plan` varchar(255) NOT NULL,
      `plan_type` varchar(255) DEFAULT NULL,
      `code` varchar(255) NOT NULL,
      `days` varchar(155) DEFAULT NULL,
      `discount` int(11) NOT NULL,
      `discount_type` varchar(155) DEFAULT NULL,
      `start_date` date DEFAULT NULL,
      `end_date` date DEFAULT NULL,
      `quantity` int(11) DEFAULT '0',
      `used` int(11) NOT NULL,
      `status` int(11) NOT NULL,
      `apply_date` varchar(255) DEFAULT NULL,
      `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");



    //version 1.6
	
	mysqli_query($connection, "UPDATE settings SET version = '1.6' WHERE id = 1;");

    mysqli_query($connection, "ALTER TABLE `appointments` ADD `sync_calendar_staff` VARCHAR(155) NULL DEFAULT '0' AFTER `sync_calendar`, ADD `sync_calendar_user` VARCHAR(155) NULL DEFAULT '0' AFTER `sync_calendar_staff`;");

    mysqli_query($connection, "ALTER TABLE `business` ADD `holidays` LONGTEXT NULL DEFAULT NULL AFTER `enable_onsite`;");

    mysqli_query($connection, "ALTER TABLE `working_days` ADD `staff_id` VARCHAR(155) NULL DEFAULT '0' AFTER `user_id`;");

    mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_wallet` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_sms`, ADD `min_payout_amount` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_wallet`, ADD `commission_rate` VARCHAR(155) NULL DEFAULT '0' AFTER `min_payout_amount`;");

    mysqli_query($connection, "ALTER TABLE `settings` ADD `paypal_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `commission_rate`, ADD `iban_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `paypal_payout`, ADD `swift_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `iban_payout`;");


    mysqli_query($connection, "ALTER TABLE `payment_user` ADD `type` VARCHAR(155) NOT NULL DEFAULT 'user' AFTER `payment_method`;");

    mysqli_query($connection, "ALTER TABLE `users` ADD `balance` BIGINT NULL DEFAULT '0' AFTER `slug`, ADD `total_sales` BIGINT NULL DEFAULT '0' AFTER `balance`;");

    mysqli_query($connection, "ALTER TABLE `payment_user` ADD `total_amount` DECIMAL(10,2) NULL DEFAULT '0' AFTER `amount`, ADD `commission_amount` DECIMAL(10,2) NULL DEFAULT '0' AFTER `total_amount`, ADD `commission_rate` INT NULL DEFAULT '0' AFTER `commission_amount`;");



    mysqli_query($connection, "ALTER TABLE `appointments` CHANGE `business_id` `business_id` VARCHAR(255) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `customers` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `coupons` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `coupons_apply` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `gallery` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `locations` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `ratings` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `services` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `service_category` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `staffs` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `staff_locations` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `working_days` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");
    mysqli_query($connection, "ALTER TABLE `working_time` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';");

    mysqli_query($connection, "
            INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
            ('user', 'Holidays', 'holidays', 'Holidays'),
            ('user', 'Interval Settings', 'interval-settings', 'Interval Settings'),
            ('user', 'Enable Appointment Reminder', 'enable-appointment-reminder', 'Enable Appointment Reminder'),
            ('user', 'Send reminder email', 'send-reminder-email', 'Send reminder email'),
            ('user', 'Same day', 'same-day', 'Same day'),
            ('user', 'Before', 'before', 'Before'),
            ('user', 'Login', 'login', 'Login'),
            ('user', 'Trial', 'trial', 'Trial'),
            ('user', 'Plan Coupons', 'plan-coupons', 'Plan Coupons'),
            ('user', 'System Settings', 'system-settings', 'System Settings'),
            ('user', 'Guest Booking', 'guest-booking', 'Guest Booking'),
            ('user', 'Enable Guest Booking', 'enable-guest-booking', 'Enable Guest Booking'),
            ('user', 'Enable to allow guest booking', 'enable-guest-booking-title', 'Enable to allow guest booking'),
            ('user', 'Wallet Settings', 'wallet-settings', 'Wallet Settings'),
            ('user', 'Commission Rate', 'commission-rate', 'Commission Rate'),
            ('user', 'Minimum Payout Amount', 'minimum-payout-amount', 'Minimum Payout Amount'),
            ('user', 'Enable Payouts', 'enable-payouts', 'Enable Payouts'),
            ('user', 'Enable to active payouts module and receive users appointment payment to admin account.', 'enable-payout-title', 'Enable to active payouts module and receive users appointment payment to admin account.'),
            ('user', 'Payouts', 'payouts', 'Payouts'),
            ('user', 'Setup Payout Accounts', 'setup-payout-accounts', 'Setup Payout Accounts'),
            ('user', 'Set Payout Account', 'set-payout-account', 'Set Payout Account'),
            ('user', 'Full Name', 'full-name', 'Full Name'),
            ('user', 'IBAN', 'iban', 'IBAN'),
            ('user', 'Bank Name', 'bank-name', 'Bank Name'),
            ('user', 'International Bank Account Number(IBAN) ', 'iban-number', 'International Bank Account Number(IBAN) '),
            ('user', 'State', 'state', 'State'),
            ('user', 'City', 'city', 'City'),
            ('user', 'Postcode', 'post-code', 'Postcode'),
            ('user', 'Bank Account Holder\'s Name', 'bank-account-holders-name', 'Bank Account Holder\'s Name'),
            ('user', 'Bank Branch Country', 'bank-branch-country', 'Bank Branch Country'),
            ('user', 'Bank Branch City', 'bank-branch-city', 'Bank Branch City'),
            ('user', 'Bank Account Number', 'bank-account-number', 'Bank Account Number'),
            ('user', 'Swift Code', 'swift-code', 'Swift Code'),
            ('user', 'Swift', 'swift', 'Swift'),
            ('user', 'Invalid withdrawal amount!', 'invalid-withdrawal-amount', 'Invalid withdrawal amount!'),
            ('user', 'Payout request sent successfully !', 'payout-request-sent-successfully', 'Payout request sent successfully !'),
            ('user', 'Minimum Payout Amounts', 'minimum-payout-amounts', 'Minimum Payout Amounts'),
            ('user', 'Empty Paypal email', 'empty-paypal-email', 'Empty Paypal email'),
            ('user', 'Empty IBAN info', 'empty-iban-info', 'Empty IBAN info'),
            ('user', 'Empty Swift info', 'empty-swift-info', 'Empty Swift info'),
            ('user', 'Transaction ID', 'transaction-id', 'Transaction ID'),
            ('user', 'Withdrawal Method', 'withdrawal-method', 'Withdrawal Method'),
            ('user', 'Amount', 'amount', 'Amount'),
            ('user', 'Send Payout Request', 'send-payout-request', 'Send Payout Request'),
            ('user', 'Total Earnings', 'total-earnings', 'Total Earnings'),
            ('user', 'Total Withdraw', 'total-withdraw', 'Total Withdraw'),
            ('user', 'Balance', 'balance', 'Balance'),
            ('user', 'after commission of', 'after-commission-of', 'after commission of'),
            ('user', 'Payout Settings', 'payout-settings', 'Payout Settings'),
            ('user', 'Payout Requests', 'payout-requests', 'Payout Requests'),
            ('user', 'Payout Completed', 'payout-completed', 'Payout Completed'),
            ('user', 'Request Sent', 'request-sent', 'Request Sent'),
            ('user', 'Enable / Disable Payout Methods', 'enabledisable-payout-methods', 'Enable / Disable Payout Methods'),
            ('user', 'must be between 1% - 99%', 'must-be-between-1-99', 'must be between 1% - 99%'),
            ('user', 'Payout History', 'payout-history', 'Payout History'),
            ('user', 'Payout Method', 'payout-method', 'Payout Method'),
            ('user', 'Add Payout', 'add-payout', 'Add Payout'),
            ('user', 'Wallet', 'wallet', 'Wallet'),
            ('user', 'User Dashboard', 'user-dashboard', 'User Dashboard'),
            ('user', 'has been', 'has-been', 'has been'),
            ('user', 'Appointment Reminder', 'appointment-reminder', 'Appointment Reminder'),
            ('user', 'Tomorrow you have an appointment', 'tomorrow-you-have-an-appointment', 'Tomorrow you have an appointment'),
            ('user', 'Dear', 'dear', 'Dear'),
            ('user', 'thank you for your booking at our', 'thank-you-for-your-booking-at-our', 'thank you for your booking at our'),
            ('user', 'at', 'at', 'at'),
            ('user', 'is', 'is', 'is'),
            ('user', 'Confirmed', 'confirmed', 'Confirmed'),
            ('user', 'Rate this service', 'rate-this-service', 'Rate this service'),
            ('user', 'Your feedback', 'your-feedback', 'Your feedback');
        ");
		
		mysqli_query($connection, "CREATE TABLE `payouts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `payout_method` varchar(255) NOT NULL,
		  `amount` bigint(20) NOT NULL,
		  `transaction_id` varchar(255) DEFAULT NULL,
		  `message` text,
		  `currency` varchar(255) DEFAULT NULL,
		  `status` int(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");



		mysqli_query($connection, "CREATE TABLE `users_payout_accounts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) DEFAULT NULL,
		  `payout_paypal_email` varchar(255) DEFAULT NULL,
		  `payout_bank_info` mediumtext,
		  `iban_full_name` varchar(255) DEFAULT NULL,
		  `iban_country_id` varchar(20) DEFAULT NULL,
		  `iban_bank_name` varchar(255) DEFAULT NULL,
		  `iban_number` varchar(500) DEFAULT NULL,
		  `swift_full_name` varchar(255) DEFAULT NULL,
		  `swift_address` varchar(500) DEFAULT NULL,
		  `swift_state` varchar(255) DEFAULT NULL,
		  `swift_city` varchar(255) DEFAULT NULL,
		  `swift_postcode` varchar(100) DEFAULT NULL,
		  `swift_country_id` varchar(20) DEFAULT NULL,
		  `swift_bank_account_holder_name` varchar(255) DEFAULT NULL,
		  `swift_iban` varchar(255) DEFAULT NULL,
		  `swift_code` varchar(255) DEFAULT NULL,
		  `swift_bank_name` varchar(255) DEFAULT NULL,
		  `swift_bank_branch_city` varchar(255) DEFAULT NULL,
		  `swift_bank_branch_country_id` varchar(20) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");






		// version 1.7

		mysqli_query($connection, "UPDATE settings SET version = '1.7' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_animation` INT NULL DEFAULT '1' AFTER `enable_faq`;");
        mysqli_query($connection, "UPDATE `lang_values` SET `english` = 'Public key' WHERE `lang_values`.`keyword` = 'publish-key';");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `flutterwave_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `flutterwave_public_key` VARCHAR(255) NULL AFTER `flutterwave_payment`, ADD `flutterwave_secret_key` VARCHAR(255) NULL AFTER `flutterwave_public_key`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `flutterwave_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `flutterwave_public_key` VARCHAR(255) NULL AFTER `flutterwave_payment`, ADD `flutterwave_secret_key` VARCHAR(255) NULL AFTER `flutterwave_public_key`;");

        mysqli_query($connection, "UPDATE `lang_values` SET `english` = ' Click here to copy below code and add to your website' WHERE `lang_values`.`keyword` = 'embed-code-copy';");

        mysqli_query($connection, "ALTER TABLE `pages` ADD `business_id` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `id`;");


        

        mysqli_query($connection, "
            INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
            ('admin', 'Dear', 'dear', 'Dear'),
            ('admin', 'thank you for your booking at our', 'thank-you-for-your-booking-at-our', 'thank you for your booking at our'),
            ('admin', 'at', 'at', 'at'),
            ('admin', 'is', 'is', 'is'),
            ('admin', 'Confirmed', 'confirmed', 'Confirmed'),
            ('admin', 'Rate this service', 'rate-this-service', 'Rate this service'),
            ('admin', 'Your feedback', 'your-feedback', 'Your feedback'),
            ('admin', 'Your account has been created successfully, now you can login to your account using below access', 'new-user-account-login', 'Your account has been created successfully, now you can login to your account using below access'),
            ('admin', 'Site Animation', 'site-animation', 'Site Animation'),
            ('admin', 'Enable to activate website animation', 'site-animation-title', 'Enable to activate website animation'),
            ('admin', 'Enable', 'enable', 'Enable'),
            ('admin', 'Amount Withdraw', 'amount-withdraw', 'Amount Withdraw'),
            ('admin', 'Flutterwave', 'flutterwave', 'Flutterwave'),
            ('admin', 'Copy', 'copy', 'Copy'),
            ('admin', 'Copied', 'copied', 'Copied');
        ");








		// version 1.8

		mysqli_query($connection, "UPDATE settings SET version = '1.8' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `sender_mail` VARCHAR(255) NULL DEFAULT NULL AFTER `is_smtp`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `mercado_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `mercado_currency` VARCHAR(155) NULL AFTER `mercado_payment`, ADD `mercado_api_key` VARCHAR(255) NULL AFTER `mercado_currency`, ADD `mercado_token` VARCHAR(255) NULL AFTER `mercado_api_key`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `mercado_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `mercado_currency` VARCHAR(155) NULL AFTER `mercado_payment`, ADD `mercado_api_key` VARCHAR(255) NULL AFTER `mercado_currency`, ADD `mercado_token` VARCHAR(255) NULL AFTER `mercado_api_key`;");


        mysqli_query($connection, "UPDATE `lang_values` SET `english` = 'must be between 1% - 100%' WHERE `lang_values`.`keword` = 'must-be-between-1-99';");
        

        mysqli_query($connection, "
            INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
            ('admin', 'Sender Email', 'sender-email', 'Sender Email'),
            ('admin', 'Access Token', 'access-token', 'Access Token'),
            ('admin', 'Password Recovery', 'password-recovery', 'Password Recovery'),
            ('admin', 'Hello', 'hello', 'Hello'),
            ('admin', 'We have reset your password, Please use this', 'we-reset-pass', 'We have reset your password, Please use below'),
            ('admin', 'code to login your account', 'code-to-login-your-account', 'code to login your account');
        ");

        mysqli_query($connection, "CREATE TABLE `booking_val` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `business_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
		  `staff_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
		  `service_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
		  `location_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
		  `sub_location_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");










    mysqli_query($connection, "UPDATE settings SET version = '1.9' WHERE id = 1;");











    mysqli_query($connection, "UPDATE settings SET version = '2.0' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `site_url` VARCHAR(255) NULL DEFAULT NULL AFTER `time_zone`;");

        mysqli_query($connection, "INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`) VALUES (NULL, 'Custom Domain', 'custom-domain', '0', NULL, NULL, NULL);");

        mysqli_query($connection, "ALTER TABLE `payment_user` ADD `proof` VARCHAR(255) NULL DEFAULT NULL AFTER `payment_method`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `offline_details` TEXT NULL DEFAULT NULL AFTER `flutterwave_secret_key`, ADD `enable_offline_payment` INT NULL DEFAULT '0' AFTER `offline_details`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `openai_key` VARCHAR(255) NULL AFTER `offline_details`, ADD `openai_model` VARCHAR(255) NULL AFTER `openai_key`, ADD `enable_openai` INT NULL DEFAULT '0' AFTER `openai_model`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_cdomain` INT NULL DEFAULT '1' AFTER `enable_openai`;");
        

        mysqli_query($connection, "
            INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
            ('admin', 'Custom Domain', 'custom-domain', 'Custom Domain'),
            ('admin', 'Domains', 'domain', 'Domains'),
            ('admin', 'Requests', 'request', 'Requests'),
            ('admin', 'Current domain', 'current-domain', 'Current domain'),
            ('admin', 'Custom domain', 'custom-domain', 'Custom domain'),
            ('admin', 'Approve', 'approve', 'Approve'),
            ('admin', 'Short details', 'short-details', 'Short details'),
            ('admin', 'Host', 'host', 'Host'),
            ('admin', 'ttl', 'ttl', 'TTL'),
            ('admin', 'two', 'two', 'two'),
            ('admin', 'One', 'one', 'one'),
            ('admin', 'IP', 'ip', 'IP'),
            ('admin', 'Write details here', 'write-details-here', 'Write details here'),
            ('admin', 'Domain Requests', 'domain-requests', 'Domain Requests'),
            ('admin', 'Current Url', 'current-url', 'Current Url'),
            ('admin', 'Domain Settings', 'domain-settings', 'Domain Settings'),
            ('admin', 'Custom Domains', 'custom-domains', 'Custom Domains'),
            ('admin', 'Your Server IP Address', 'server-ip-address', 'Your Server IP Address'),
            ('admin', 'This ip address will be used to setup users custom domain > DNS settings', 'ip-help-info', 'This ip address will be used to setup users custom domain > DNS settings'),
            ('admin', 'DNS Settings', 'dns-settings', 'DNS Settings'),
            ('admin', 'Upload an Example Screenshot', 'upload-an-example-screenshot', 'Upload an Example Screenshot'),
            ('admin', 'This part will be shown for your users to setup custom domain > DNS settings', 'user-dns-settings-types', 'This part will be shown for your users to setup custom domain > DNS settings'),
            ('admin', 'Before going to submit your custom domain request make sure you have purchased this domain and its ready to use', 'custom-domain-user-warning-info', 'Before going to submit your custom domain request make sure you have purchased this domain and its ready to use'),
            ('admin', 'Default Url', 'default-url', 'Default Url'),
            ('admin', 'Openai API', 'openai-api', 'Openai API'),
            ('admin', 'Openai API Key', 'openai-api-key', 'Openai API Key'),
            ('admin', 'Openai Model', 'openai-model', 'Openai Model'),
            ('admin', 'Enable to allow openai in this system', 'enable-openai', 'Enable to allow openai in this system'),
            ('admin', 'Ai Response', 'ai-response', 'Ai Response'),
            ('admin', 'Generate', 'generate', 'Generate'),
            ('admin', 'Advanced settings', 'advanced-settings', 'Advanced settings'),
            ('admin', 'Content creativity level', 'content-creativity-level', 'Content creativity level'),
            ('admin', 'Output Variations', 'output-variations', 'Output Variations'),
            ('admin', 'Max words', 'max-wrods', 'Max words'),
            ('admin', 'No content yet', 'no-content-yet', 'No content yet'),
            ('admin', 'Output', 'output', 'Output'),
            ('admin', 'Documents', 'documents', 'Documents'),
            ('admin', 'Low', 'low', 'Low'),
            ('admin', 'Medium', 'medium', 'Medium'),
            ('admin', 'High', 'high', 'High'),
            ('admin', 'Generate AI Response', 'generate-ai-response', 'Generate AI Response'),
            ('admin', 'Give some directions about your topic', 'give-some-directions-about-your-topic', 'Give some directions about your topic'),
            ('admin', 'Enable to allow custom domain feature for users', 'enable-cdomain', 'Enable to allow custom domain feature for users');
        ");


        // import database table
        $query = '';
          $sqlScript = file('sql/domains.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/domain_settings.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }









        mysqli_query($connection, "UPDATE settings SET version = '2.1' WHERE id = 1;");
        mysqli_query($connection, "ALTER TABLE `blog_posts` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `product_services` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `pages` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `faqs` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `testimonials` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");
        mysqli_query($connection, "ALTER TABLE `blog_category` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;");

        mysqli_query($connection, "INSERT INTO `package` (`id`, `name`, `slug`, `price`, `monthly_price`, `lifetime_price`, `bill_type`, `is_special`, `status`) VALUES (NULL, 'Plus', 'Plus', '2000.99', '10.00', '20.00', 'year', '0', '0');");
        mysqli_query($connection, "ALTER TABLE `features` ADD `plus` VARCHAR(155) NULL DEFAULT NULL AFTER `premium`;");


        mysqli_query($connection, "ALTER TABLE `users` ADD `referral_id` VARCHAR(155) NULL DEFAULT NULL AFTER `role`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `referral_earn` VARCHAR(155) NULL DEFAULT '0' AFTER `referral_id`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `enable_whatsapp_msg` INT NULL DEFAULT '0' AFTER `enable_onsite`, ADD `ultramsg_instance_id` VARCHAR(155) NULL AFTER `enable_whatsapp_msg`, ADD `ultramsg_token` VARCHAR(155) NULL AFTER `ultramsg_instance_id`;");

       


        // import database table
        $query = '';
          $sqlScript = file('sql/settings_extra.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/referral_payouts.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/referral_settings.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/referrals.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Withdrawal Amount', 'withdrawal-amount', 'Withdrawal Amount'),
        ('user', 'Request Sent', 'request-sent', 'Request Sent'),
        ('user', 'Total Referrals', 'total-referrals', 'Total Referrals'),
        ('user', 'Total Earnings', 'total-earnings', 'Total Earnings'),
        ('user', 'Total Withdraw', 'total-withdraw', 'Total Withdraw'),
        ('user', 'Minimum Payout Amounts', 'minimum-payout-amounts', 'Minimum Payout Amounts'),
        ('user', 'My Referral URL', 'my-referral-url', 'My Referral URL'),
        ('user', 'Referral policy', 'referral-policy', 'Referral policy'),
        ('user', 'First Successful Payment by Referred Person', 'first-successful-payment-by-referred-person', 'First Successful Payment by Referred Person'),
        ('user', 'Every Successful Payment by Referred Person', 'every-successful-payment-by-referred-person', 'Every Successful Payment by Referred Person'),
        ('user', 'Referral guidelines', 'referral-guidelines', 'Referral guidelines'),
        ('user', 'How It works', 'how-it-works', 'How It works'),
        ('user', 'Send Invitation', 'send-invitation', 'Send Invitation'),
        ('user', 'Send your referral link to your friends and tell them how cool is this', 'send-your-referral-link-to-your-friends-and-tell-them-how-cool-is-this', 'Send your referral link to your friends and tell them how cool is this'),
        ('user', 'Registration', 'registration', 'Registration'),
        ('user', 'Let them register using your referral link', 'let-them-register-using-your-referral-link', 'Let them register using your referral link'),
        ('user', 'Get Commissions', 'get-commissions', 'Get Commissions'),
        ('user', 'Earn commission for their first subscription plan payments!', 'earn-commission-for-their-first-subscription-plan-payments', 'Earn commission for their first subscription plan payments!'),
        ('user', 'Paypal Email', 'paypal-email', 'Paypal Email'),
        ('user', 'Bank Details', 'bank-details', 'Bank Details'),
        ('user', 'Referrals', 'referrals', 'Referrals'),
        ('user', 'Referrar Id', 'referrar-id', 'Referral Id '),
        ('user', 'Order Id', 'order-id', 'Order Id'),
        ('user', 'Commision', 'commision', 'Commission '),
        ('user', 'Commision Amount', 'commision-amount', 'Commission Amount'),
        ('user', 'Select your payment method', 'select-your-payment-method', 'Select your payment method'),
        ('user', 'Paypal', 'paypal', 'Paypal'),
        ('user', 'Bank', 'bank', 'Bank'),
        ('user', 'Method Details', 'method-details', 'Method Details'),
        ('user', 'Enable Referral', 'enable-referral', 'Enable Referral'),
        ('user', 'Choose Referral policy', 'choose-referral-policy', 'Choose Referral policy'),
        ('user', 'Commission only on first purchase', 'commission-only-on-first-purchase', 'Commission only on first purchase'),
        ('user', 'Commission on every purchase', 'commission-on-every-purchase', 'Commission on every purchase'),
        ('user', 'Commision Rate(%)', 'commision-rate', 'Commission Rate'),
        ('user', 'Minimum Payout', 'minimum-payout', 'Minimum Payout'),
        ('user', 'Refferal Guidelines', 'refferal-guidelines', 'Refferal Guidelines'),
        ('user', 'Payout Request', 'payout-request', 'Payout Request'),
        ('user', 'Completed Payout', 'completed-payout', 'Completed Payout'),
        ('user', 'Affiliate', 'affiliate', 'Affiliate'),
        ('user', 'Referral Settings', 'referral-settings', 'Referral Settings');");








        mysqli_query($connection, "UPDATE settings SET version = '2.2' WHERE id = 1;");
        
        mysqli_query($connection, "ALTER TABLE `business` ADD `about_title` VARCHAR(255) NULL AFTER `holidays`, ADD `about_details` TEXT NULL AFTER `about_title`, ADD `company_established` VARCHAR(155) NULL AFTER `about_details`, ADD `about_image` VARCHAR(255) NULL AFTER `company_established`, ADD `about_vedio_url` VARCHAR(255) NULL AFTER `about_image`;");

        mysqli_query($connection, "ALTER TABLE `testimonials` ADD `type` VARCHAR(255) NOT NULL AFTER `user_id`;");

        mysqli_query($connection, "ALTER TABLE `testimonials` CHANGE `type` `business_id` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL;");

        mysqli_query($connection, "ALTER TABLE `blog_category` ADD `business_id` VARCHAR(255) NOT NULL AFTER `user_id`;");

        mysqli_query($connection, "ALTER TABLE `blog_posts` ADD `business_id` VARCHAR(255) NOT NULL AFTER `lang_id`;");

        mysqli_query($connection, "ALTER TABLE `service_category` ADD `icon` VARCHAR(255) NULL AFTER `name`, ADD `image` VARCHAR(255) NULL AFTER `icon`;");

        mysqli_query($connection, "ALTER TABLE `service_category` ADD `is_active` INT NOT NULL DEFAULT '1' AFTER `image`;");

        mysqli_query($connection, "ALTER TABLE `staffs` ADD `designation` VARCHAR(255) NOT NULL AFTER `name`;");

        mysqli_query($connection, "ALTER TABLE `staffs` ADD `facebook` VARCHAR(255) NULL AFTER `phone`, ADD `twitter` VARCHAR(255) NULL AFTER `facebook`, ADD `linkedin` VARCHAR(255) NULL AFTER `twitter`, ADD `whatsapp` VARCHAR(255) NULL AFTER `linkedin`;");

        mysqli_query($connection, "ALTER TABLE `contacts` ADD `business_id` VARCHAR(255) NULL AFTER `user_id`;");

        mysqli_query($connection, "ALTER TABLE `contacts` ADD `website` VARCHAR(255) NULL AFTER `email`;");

        mysqli_query($connection, "ALTER TABLE `contacts` ADD `phone` VARCHAR(255) NULL AFTER `name`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `enable_portfolio` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_gallery`, ADD `enable_brand` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_portfolio`, ADD `enable_slider` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_brand`, ADD `enable_blog` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_slider`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `enable_testimonial` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_blog`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `font` VARCHAR(255) NULL AFTER `color`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_embed_badge` VARCHAR(11) NULL DEFAULT '0' AFTER `enable_cdomain`, ADD `enable_default_tzone` VARCHAR(11) NULL DEFAULT '0' AFTER `enable_embed_badge`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `terms` LONGTEXT NULL DEFAULT NULL AFTER `about_vedio_url`, ADD `privacy` LONGTEXT NULL DEFAULT NULL AFTER `terms`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `tax_type` VARCHAR(255) NULL AFTER `privacy`, ADD `tax_amount` INT NULL AFTER `tax_type`;");

        mysqli_query($connection, "ALTER TABLE `services` ADD `tax` INT NULL AFTER `price`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_whatsapp_msg` INT NULL DEFAULT '0' AFTER `twillo_number`, ADD `ultramsg_instance_id` VARCHAR(155) NULL AFTER `enable_whatsapp_msg`, ADD `ultramsg_token` VARCHAR(155) NULL AFTER `ultramsg_instance_id`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `global_twilio` INT NULL DEFAULT '0' AFTER `ultramsg_token`, ADD `global_ultramsg` INT NULL DEFAULT '0' AFTER `global_twilio`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `size` VARCHAR(55) NULL DEFAULT '120px' AFTER `logo`;");

       


        // import database table
        $query = '';
          $sqlScript = file('sql/sliders.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/portfolios.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/fonts.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Upload About Image', 'upload-about-image', 'Upload About Image'),
        ('user', 'About Company', 'about-company', 'About Company'),
        ('user', 'About Title', 'about-title', 'About Title'),
        ('user', 'Established In', 'established-in', 'Established In'),
        ('user', 'About Video Url', 'about-video-url', 'About Video Url'),
        ('user', 'About Details', 'about-details', 'About Details'),
        ('user', 'Brand', 'brand', 'Brand'),
        ('user', 'Slider', 'slider', 'Slider'),
        ('user', 'Icon', 'icon', 'Icon'),
        ('user', 'Icon Image', 'icon-image', 'Icon Image'),
        ('user', 'Category Image', 'category-image', 'Category Image'),
        ('user', 'Select Icon/Image', 'select-iconimage', 'Select Icon/Image'),
        ('user', 'Link', 'link', 'Link'),
        ('user', 'Brands', 'brands', 'Brands'),
        ('user', 'Sliders', 'sliders', 'Sliders'),
        ('user', 'Send message', 'send-message', 'Send message'),
        ('user', 'Logo', 'logo', 'Logo'),
        ('user', 'Portfolios', 'portfolios', 'Portfolios'),
        ('user', 'View', 'view', 'View'),
        ('user', 'Portfolio Category', 'portfolio-category', 'Portfolio Category'),
        ('user', 'Enable Portfolio', 'enable-portfolio', 'Enable Portfolio'),
        ('user', 'Enable to show portfolio option in home page', 'enable-portfolio-title', 'Enable to show portfolio option in home page'),
        ('user', 'Enable to show brand option in home page', 'enable-brand-title', 'Enable to show brand option in home page'),
        ('user', 'Enable Brand', 'enable-brand', 'Enable Brand'),
        ('user', 'Enable Slider', 'enable-slider', 'Enable Slider'),
        ('user', 'Enable to show slider option in home page', 'enable-slider-title', 'Enable to show slider option in home page'),
        ('user', 'Enable to show blog option in home page', 'enable-blog-title', 'Enable to show blog option in home page'),
        ('user', 'Enable Blog', 'enable-blog', 'Enable Blog'),
        ('user', 'Enable Testimonial', 'enable-testimonial', 'Enable Testimonial'),
        ('user', 'Enable to show testimonial option in home page', 'enable-testimonial-title', 'Enable to show testimonial option in home page'),
        ('user', 'Sort by Categories', 'sort-by-categories', 'Sort by Categories'),
        ('user', 'Fonts', 'fonts', 'Fonts'),
        ('user', 'Font Name', 'font-name', 'Font Name'),
        ('user', 'Color', 'color', 'Color'),
        ('user', 'Theme Color & Font', 'theme-color', 'Theme, Color & Font'),
        ('user', 'Themes', 'themes', 'Themes'),
        ('user', 'Manage Fonts', 'manage-fonts', 'Manage Fonts'),
        ('user', 'Overview', 'overview', 'Overview'),
        ('user', 'Rating & Review', 'rating-review', 'Rating & Review'),
        ('user', 'Google Fonts', 'google-fonts', 'Google Fonts'),
        ('user', 'Get New Font', 'get-new-font', 'Get New Font'),
        ('user', 'Custom Font', 'custom-font', 'Custom Font'),
        ('user', 'Default', 'default', 'Default'),
        ('user', 'About us', 'about-us', 'About us'),
        ('user', 'Happy Clients', 'happy-clients', 'Happy Clients'),
        ('user', 'Schedule', 'schedule', 'Schedule'),
        ('user', 'Closed', 'closed', 'Closed'),
        ('user', 'What We Offer', 'what-we-offer', 'What We Offer'),
        ('user', 'What we do', 'what-we-do', 'What we do'),
        ('user', 'Our Services', 'our-services', 'Our Services'),
        ('user', 'Meet Our Specialists', 'meet-our-specialists', 'Meet Our Specialists'),
        ('user', 'What our client says about ', 'what-our-client-says-about', 'What our client says about '),
        ('user', 'Ready to book our Service?', 'ready-to-book-our-service', 'Ready to book our Service?'),
        ('user', 'Our Best Services', 'our-best-services', 'Our Best Services'),
        ('user', 'Projects', 'projects', 'Projects'),
        ('user', 'Our Latest Portfolios', 'our-latest-portfolios', 'Our Latest Portfolios'),
        ('user', 'Our Team Members', 'our-team-members', 'Our Team Members'),
        ('user', 'Latest from our blog', 'latest-from-our-blog', 'Latest from our blog'),
        ('user', 'More blogs', 'more-blogs', 'More blogs'),
        ('user', 'Lets Talk', 'lets-talk', 'Lets Talk'),
        ('user', 'Request a Free Quote', 'request-a-free-quote', 'Request a Free Quote'),
        ('user', 'See Here', 'see-here', 'See Here'),
        ('user', 'E-mail', 'e-mail', 'E-mail'),
        ('user', 'Your Website', 'your-website', 'Your Website'),
        ('user', 'Your message here', 'your-message-here', 'Your message here'),
        ('user', 'We are available when you want', 'we-are-available-when-you-want', 'We are available when you want'),
        ('user', 'Find design inspiration. Share your work. Join the #1 creative community online.', 'find-design-inspiration.-share-your-work.-join-the-1-creative-community-online', 'Find design inspiration. Share your work. Join the #1 creative community online.'),
        ('user', 'What We Provide', 'what-we-provide', 'What We Provide'),
        ('user', 'Teams', 'teams', 'Teams'),
        ('user', 'Our Specialists', 'our-specialists', 'Our Specialists'),
        ('user', 'What peoples says about Us', 'what-peoples-says-about-us', 'What peoples says about Us'),
        ('user', 'Scince', 'scince', 'Scince'),
        ('user', 'What Customers say about us', 'what-customers-say-about-us', 'What Customers say about us'),
        ('user', 'What peoples say about our company', 'what-peoples-say-about-our-company', 'What peoples say about our company'),
        ('user', 'Want to book our Service?', 'want-to-book-our-service', 'Want to book our Service?'),
        ('user', 'Manage your bookings to click this', 'manage-your-bookings-to-click-this', 'Manage your bookings to click this'),
        ('user', 'Contact Info', 'contact-info', 'Contact Info'),
        ('user', 'Useful Links', 'useful-links', 'Useful Links'),
        ('user', 'Want to get a online consultation?', 'want-to-get-a-online-consultation', 'Want to get a online consultation?'),
        ('user', 'Themes', 'themes', 'Themes'),
        ('user', 'Theme Settings', 'theme-settings', 'Theme Settings'),
        ('user', 'Multipurpose One', 'multipurpose-one', 'Multipurpose One'),
        ('user', 'Multipurpose Two', 'multipurpose-two', 'Multipurpose Two'),
        ('user', 'Barbar / Stylists', 'barbar-stylists', 'Barbar / Stylists'),
        ('user', 'Agency / Law Consultancy', 'law-consultancy', 'Agency / Law Consultancy'),
        ('user', 'Medical / Health', 'medical-health', 'Medical / Health'),
        ('user', 'Beauty / Wellness', 'beauty-wellness', 'Beauty / Wellness'),
        ('user', 'Terms & Privacy', 'terms-privacy', 'Terms & Privacy'),
        ('user', 'Enable Default Time Zone', 'enable-default-time-zone', 'Default Time Zone'),
        ('user', 'Enable to activate default admin time zone for all users', 'default-time-zone-tiltle', 'Enable to activate default admin time zone for all users'),
        ('user', 'Enable Embded Powered By Badge', 'enable-embded-badge', 'Enable Embded Powered By Badge'),
        ('user', 'Enable to activate powered by badge on embedded booking page', 'embded-badge-tiltle', 'Enable to activate powered by badge on embedded booking page'),
        ('user', 'Tax Settings', 'tax-settings', 'Tax Settings'),
        ('user', 'Fixed Tax', 'fixed-tax', 'Fixed Tax'),
        ('user', 'Service based tax', 'service-based-tax', 'Service Based Tax'),
        ('user', 'Tax', 'tax', 'Tax'),
        ('user', 'Service Tax', 'service-tax', 'Service Tax'),
        ('user', 'Enable Globally', 'enable-globally', 'Enable Globally'),
        ('user', 'Enable to activate WhatsApp sms for admin and user side.', 'enable-globally-whatsapp', 'Enable to activate WhatsApp sms for admin and user side.'),
        ('user', 'Enable to activate Twilio sms for admin and user side.', 'enable-globally-twilio', 'Enable to activate Twilio sms for admin and user side.'),
        ('user', 'Instance Id', 'instance-id', 'Instance Id'),
        ('user', 'Ultramsg API', 'ultramsg-api', 'Ultramsg API'),
        ('user', 'Token', 'token', 'Token'),
        ('user', 'Sorry, Appointment is not available on that time', 'appointment-is-not-available-on-that-time', 'Sorry, Appointment is not available on that time'),
        ('user', 'Small Logo', 'small-logo', 'Small Logo'),
        ('user', 'Medium Logo', 'medium-logo', 'Medium Logo'),
        ('user', 'Large Logo', 'large-logo', 'Large Logo');");



        // import database table
        $query = '';
          $sqlScript = file('sql/brands.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }







        mysqli_query($connection, "UPDATE settings SET version = '2.3' WHERE id = 1;");

        mysqli_query($connection, "ALTER TABLE `customers` ADD `time_zone` VARCHAR(155) NULL AFTER `gender`;");
        mysqli_query($connection, "ALTER TABLE `services` ADD `enable_service_extra` INT NULL DEFAULT '0' AFTER `google_meet`;");

        mysqli_query($connection, "ALTER TABLE `users` ADD `auth_type` VARCHAR(20) NULL DEFAULT NULL AFTER `parent_id`, ADD `auth_id` VARCHAR(30) NULL DEFAULT NULL AFTER `auth_type`, ADD `device_1` TEXT NULL DEFAULT NULL AFTER `auth_id`, ADD `device_2` TEXT NULL DEFAULT NULL AFTER `device_1`;");

        mysqli_query($connection, "ALTER TABLE `settings` CHANGE `global_ultramsg` `global_wapp_msg` INT(11) NULL DEFAULT '0';");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;");

        mysqli_query($connection, "UPDATE `lang_values` SET `label` = 'Ultramsg', `keyword` = 'ultramsg', `english` = 'Ultramsg' WHERE `lang_values`.`keyword` = 'ultramsg-api';");

        mysqli_query($connection, "ALTER TABLE `services` ADD `service_type` INT NOT NULL DEFAULT '1' AFTER `details`, ADD `number_of_service` VARCHAR(255) NULL AFTER `service_type`, ADD `service_repeat` VARCHAR(255) NULL AFTER `number_of_service`;");

        mysqli_query($connection, "ALTER TABLE `appointments` ADD `is_recurring` INT NOT NULL DEFAULT '0' AFTER `sync_calendar_user`, ADD `recurring_count` INT NOT NULL DEFAULT '0' AFTER `is_recurring`, ADD `next_recur_date` VARCHAR(255) NULL AFTER `recurring_count`, ADD `is_completed` INT NOT NULL DEFAULT '0' AFTER `next_recur_date`;");

        mysqli_query($connection, "ALTER TABLE `services` ADD `service_extra` VARCHAR(255) NULL AFTER `google_meet`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `pwa_logo` VARCHAR(155) NULL AFTER `link`, ADD `enable_pwa` INT NULL DEFAULT '0' AFTER `pwa_logo`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `custom_css` LONGTEXT NULL DEFAULT NULL AFTER `about_info`;");

        mysqli_query($connection, "ALTER TABLE `appointments` ADD `service_extra` VARCHAR(255) NULL DEFAULT NULL AFTER `service_id`;");
        mysqli_query($connection, "ALTER TABLE `users` ADD `remember_me_token` VARCHAR(155) NULL DEFAULT NULL AFTER `slug`;");

        mysqli_query($connection, "ALTER TABLE `business` ADD `default_timezone` VARCHAR(11) NULL DEFAULT '1' AFTER `time_zone`;");
        

        // import database table
        $query = '';
          $sqlScript = file('sql/system_settings.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


        // import database table
        $query = '';
          $sqlScript = file('sql/custom_form.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/custom_form_answer.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }

        // import database table
        $query = '';
          $sqlScript = file('sql/service_extra.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }



        mysqli_query($connection, "INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Custom Form', 'custom-form', 'Custom Form'),
        ('user', 'Input Title', 'input-title', 'Input Title'),
        ('user', 'Input Name', 'input-name', 'Input Name'),
        ('user', 'Input Type', 'input-type', 'Input Type'),
        ('user', 'Input required or not', 'input-required-or-not', 'Input required or not'),
        ('user', 'New Input', 'new-input', 'New Input'),
        ('user', 'Custom Forms', 'custom-forms', 'Custom Forms'),
        ('user', 'Add new input', 'add-new-input', 'Add new input'),
        ('user', 'Select input type', 'select-input-type', 'Select input type'),
        ('user', 'text', 'text', 'Text'),
        ('user', 'Textarea', 'textarea', 'Textarea'),
        ('user', 'Is this required ?', 'is-required', 'Is this required ?'),
        ('user', 'Additional Info', 'additional-info', 'Additional Info'),
        ('user', 'Service Extra', 'service-extra', 'Service Extra'),
        ('user', 'Wazfy', 'wazfy', 'Wazfy'),
        ('user', 'Extra Service', 'extra-service', 'Extra Service'),
        ('user', 'Service Type', 'service-type', 'Service Type'),
        ('user', 'Recurring Service', 'recurring-sevice', 'Recurring Service'),
        ('user', 'One of Service', 'one-of-service', 'One of Service'),
        ('user', 'Number of Service', 'number-of-service', 'Number of Services'),
        ('user', 'Repeats In', 'repeats-in', 'Repeats In'),
        ('user', 'Repeats Weekly', 'repeats-weekly', 'Repeats Weekly'),
        ('user', 'Repeats Monthly', 'repeats-monthly', 'Repeats Monthly'),
        ('user', 'Recurring Service', 'recurring-service', 'Recurring Service'),
        ('user', 'Recurring', 'recurring', 'Recurring'),
        ('user', 'One Time Service', 'one-time-service', 'One Time Service'),
        ('user', 'Service repeats weekly', 'service-repeats-weekly', 'Service repeats weekly'),
        ('user', 'Service repeats monthly', 'service-repeats-monthly', 'Service repeats monthly'),
        ('user', 'Recurring-info', 'recurring-info', 'Recurring-info'),
        ('user', 'Repeated in ', 'repeated-in', 'Repeated in '),
        ('user', 'Next', 'next', 'Next'),
        ('user', 'Recurring Count', 'recurring-count', 'Recurring Count'),
        ('user', 'Booked service extra', 'booked-service-extra', 'Booked service extra'),
        ('user', 'Disable service extra', 'disable-service-extra', 'Disable service extra'),
        ('user', 'Enable service extra', 'enable-service-extra', 'Enable service extra'),
        ('user', 'PWA Settings', 'pwa-settings', 'PWA Settings'),
        ('user', 'Enable PWA (Progressive Web Apps)', 'enable-pwa', 'Enable PWA (Progressive Web Apps)'),
        ('user', 'Enable to allow your users to install PWA on their phone', 'pwa-enable-title', 'Enable to allow your users to install PWA on their phone'),
        ('user', 'mage dimensions should not exceed 512 x 512 pixels.', 'pwa-logo-size-alert', 'mage dimensions should not exceed 512 x 512 pixels.'),
        ('user', 'Install PWA', 'install-pwa', 'Install PWA'),
        ('user', 'Custom CSS', 'custom-css', 'Custom CSS'),
        ('user', 'Add your custom css code here', 'add-your-own-css-code-here', 'Add your custom css code here'),
        ('user', 'Required', 'required', 'Required'),
        ('user', 'Custom Inputs', 'custom-inputs', 'Custom Inputs'),
        ('user', 'Setup Business', 'setup-business', 'Setup Business'),
        ('user', 'Redirect URL', 'redirect-url', 'Redirect URL'),
        ('user', 'Google', 'google', 'Google'),
        ('user', 'Facebook App ID', 'facebook-app-id', 'Facebook App ID'),
        ('user', 'Facebook App Secret', 'facebook-app-secret', 'Facebook App Secret'),
        ('user', 'Graph Version', 'graph-version', 'Graph Version'),
        ('user', 'Social Login', 'social-login', 'Social Login'),
        ('user', 'Continue With Google', 'continue-with-google', 'Continue With Google'),
        ('user', 'Continue With Facebook', 'continue-with-facebook', 'Continue With Facebook'),
        ('user', 'Remember me', 'remember-me', 'Remember Me'),
        ('user', 'Enable Default Timezone', 'enable-default-timezone', 'Enable Default Timezone'),
        ('user', 'Enable to use company timezone for your all booking customers', 'enable-default-timezone-title', 'Enable to use company timezone for your all booking customers'),
        ('user', 'Integration docs', 'integration-docs', 'Integration docs');");

?>












































<!-- ***

  Without mysql query 

*** -->

<?php 

    UPDATE settings SET version = '1.5' WHERE id = 1;

    ALTER TABLE `business` ADD `enable_guest` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_group`;

    ALTER TABLE `settings` ADD `enable_coupon` INT NULL DEFAULT '0' AFTER `enable_lifetime`;

    ALTER TABLE `services` ADD `google_meet` TEXT NULL DEFAULT NULL AFTER `zoom_link`;

    UPDATE `features` SET `name` = 'Virtual Meeting(Zoom, Google Meet)' WHERE `features`.`id` = 7;

    UPDATE `lang_values` SET `english` = 'Virtual Meeting(Zoom, Google Meet)' WHERE `lang_values`.`keyword` = 'zoom-meeting';

    ALTER TABLE `settings` ADD `paystack_payment` VARCHAR(155) NULL DEFAULT '0' AFTER `secret_key`, ADD `paystack_secret_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_payment`, ADD `paystack_public_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_secret_key`;

    ALTER TABLE `users` ADD `paystack_payment` VARCHAR(155) NULL DEFAULT '0' AFTER `secret_key`, ADD `paystack_secret_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_payment`, ADD `paystack_public_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_secret_key`;


    
        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Apply your coupon code here', 'apply-your-coupon-code-here', 'Apply your coupon code here'),
        ('user', 'Coupons limit', 'coupons-limit', 'Coupons limit'),
        ('user', 'How many days will be active this coupon', 'how-many-days-will-be-active-this-coupon', 'How many days will be active this coupon'),
        ('user', 'Discount must be between 1% - 99%', 'discount-must-be-between', 'Discount must be between 1% - 99%'),
        ('user', 'Export as CSV', 'export-as-csv', 'Export as CSV'),
        ('user', 'Codes', 'codes', 'Codes'),
        ('user', 'See all codes', 'see-all-codes', 'See all codes'),
        ('user', 'Your name string contains illegal characters.', 'illegal-characters-title', 'Your name string contains illegal characters.'),
        ('user', 'Please Complete these steps', 'please-complete-these-steps', 'Please Complete these steps'),
        ('user', 'Set Business Hours', 'set-business-hours', 'Set Business Hours'),
        ('user', 'Add Staff', 'add-staff', 'Add Staff'),
        ('user', 'Add Customer', 'add-customer', 'Add Customer'),
        ('user', 'Add Service', 'add-service', 'Add Service'),
        ('user', 'Enter phone number with dial code', 'enter-phone-number-with-dial-code', 'Enter phone number with dial code'),
        ('user', 'Cities', 'cities', 'Cities'),
        ('user', 'Location is required', 'location-required', 'Location is required'),
        ('admin', 'Paystack', 'paystack', 'Paystack'),
        ('admin', 'Setup Your Paystack Account to Accept Payments', 'paystack-title', 'Setup Your Paystack Account to Accept Payments'),
        ('user', 'Recently booked an appointment at', 'recently-booked-an-appointment', 'Recently booked an appointment at'),
        ('user', 'New appointment is booked', 'new-appointment-is-booked', 'Booked new appointment'),
        ('user', 'Quantity', 'quantity', 'Quantity'),
        ('user', 'Coupon code already applied', 'coupon-code-already-applied', 'Coupon code already applied'),
        ('user', 'Have any coupon code?', 'have-any-coupon-code', 'Have any coupon code?'),
        ('user', 'Enable to active coupon code feature', 'enable-coupon-title', 'Enable to active coupon code feature'),
        ('user', 'Allow Google Meet', 'allow-google-meet', 'Allow Google Meet'),
        ('user', 'Google meet link', 'google-meet-link', 'Google meet invitation link'),
        ('user', 'Google Meet', 'google-meet', 'Google Meet'),
        ('user', 'Virtual Meeting', 'virtual-meeting', 'Virtual Meeting'),
        ('user', 'Zoom', 'zoom', 'Zoom'),
        ('user', 'Enable Coupon from', 'enable-coupon-from', 'Enable Coupon from');
    

    CREATE TABLE `plan_coupons_apply` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `coupon_id` int(11) NOT NULL,
      `created_at` date NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `plan_coupons` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uid` varchar(255) NOT NULL,
      `name` varchar(255) DEFAULT NULL,
      `user_id` varchar(155) DEFAULT '0',
      `plan` varchar(255) NOT NULL,
      `plan_type` varchar(255) DEFAULT NULL,
      `code` varchar(255) NOT NULL,
      `days` varchar(155) DEFAULT NULL,
      `discount` int(11) NOT NULL,
      `discount_type` varchar(155) DEFAULT NULL,
      `start_date` date DEFAULT NULL,
      `end_date` date DEFAULT NULL,
      `quantity` int(11) DEFAULT '0',
      `used` int(11) NOT NULL,
      `status` int(11) NOT NULL,
      `apply_date` varchar(255) DEFAULT NULL,
      `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;








	
	UPDATE settings SET version = '1.6' WHERE id = 1;

    ALTER TABLE `appointments` ADD `sync_calendar_staff` VARCHAR(155) NULL DEFAULT '0' AFTER `sync_calendar`, ADD `sync_calendar_user` VARCHAR(155) NULL DEFAULT '0' AFTER `sync_calendar_staff`;

    ALTER TABLE `business` ADD `holidays` LONGTEXT NULL DEFAULT NULL AFTER `enable_onsite`;

    ALTER TABLE `working_days` ADD `staff_id` VARCHAR(155) NULL DEFAULT '0' AFTER `user_id`;

    ALTER TABLE `settings` ADD `enable_wallet` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_sms`, ADD `min_payout_amount` VARCHAR(155) NULL DEFAULT '0' AFTER `enable_wallet`, ADD `commission_rate` VARCHAR(155) NULL DEFAULT '0' AFTER `min_payout_amount`;

    ALTER TABLE `settings` ADD `paypal_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `commission_rate`, ADD `iban_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `paypal_payout`, ADD `swift_payout` VARCHAR(155) NULL DEFAULT '1' AFTER `iban_payout`;


    ALTER TABLE `payment_user` ADD `type` VARCHAR(155) NOT NULL DEFAULT 'user' AFTER `payment_method`;

    ALTER TABLE `users` ADD `balance` BIGINT NULL DEFAULT '0' AFTER `slug`, ADD `total_sales` BIGINT NULL DEFAULT '0' AFTER `balance`;

    ALTER TABLE `payment_user` ADD `total_amount` DECIMAL(10,2) NULL DEFAULT '0' AFTER `amount`, ADD `commission_amount` DECIMAL(10,2) NULL DEFAULT '0' AFTER `total_amount`, ADD `commission_rate` INT NULL DEFAULT '0' AFTER `commission_amount`;



    ALTER TABLE `appointments` CHANGE `business_id` `business_id` VARCHAR(255) NULL DEFAULT '0';
    ALTER TABLE `customers` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `coupons` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `coupons_apply` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `gallery` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `locations` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `ratings` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `services` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `service_category` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `staffs` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `staff_locations` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `working_days` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';
    ALTER TABLE `working_time` CHANGE `business_id` `business_id` VARCHAR(25) NULL DEFAULT '0';


        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Holidays', 'holidays', 'Holidays'),
        ('user', 'Interval Settings', 'interval-settings', 'Interval Settings'),
        ('user', 'Enable Appointment Reminder', 'enable-appointment-reminder', 'Enable Appointment Reminder'),
        ('user', 'Send reminder email', 'send-reminder-email', 'Send reminder email'),
        ('user', 'Same day', 'same-day', 'Same day'),
        ('user', 'Before', 'before', 'Before'),
        ('user', 'Login', 'login', 'Login'),
        ('user', 'Trial', 'trial', 'Trial'),
        ('user', 'Plan Coupons', 'plan-coupons', 'Plan Coupons'),
        ('user', 'System Settings', 'system-settings', 'System Settings'),
        ('user', 'Guest Booking', 'guest-booking', 'Guest Booking'),
        ('user', 'Enable Guest Booking', 'enable-guest-booking', 'Enable Guest Booking'),
        ('user', 'Enable to allow guest booking', 'enable-guest-booking-title', 'Enable to allow guest booking'),
        ('user', 'Wallet Settings', 'wallet-settings', 'Wallet Settings'),
        ('user', 'Commission Rate', 'commission-rate', 'Commission Rate'),
        ('user', 'Minimum Payout Amount', 'minimum-payout-amount', 'Minimum Payout Amount'),
        ('user', 'Enable Payouts', 'enable-payouts', 'Enable Payouts'),
        ('user', 'Enable to active payouts module and receive users appointment payment to admin account.', 'enable-payout-title', 'Enable to active payouts module and receive users appointment payment to admin account.'),
        ('user', 'Payouts', 'payouts', 'Payouts'),
        ('user', 'Setup Payout Accounts', 'setup-payout-accounts', 'Setup Payout Accounts'),
        ('user', 'Set Payout Account', 'set-payout-account', 'Set Payout Account'),
        ('user', 'Full Name', 'full-name', 'Full Name'),
        ('user', 'IBAN', 'iban', 'IBAN'),
        ('user', 'Bank Name', 'bank-name', 'Bank Name'),
        ('user', 'International Bank Account Number(IBAN) ', 'iban-number', 'International Bank Account Number(IBAN) '),
        ('user', 'State', 'state', 'State'),
        ('user', 'City', 'city', 'City'),
        ('user', 'Postcode', 'post-code', 'Postcode'),
        ('user', 'Bank Account Holder\'s Name', 'bank-account-holders-name', 'Bank Account Holder\'s Name'),
        ('user', 'Bank Branch Country', 'bank-branch-country', 'Bank Branch Country'),
        ('user', 'Bank Branch City', 'bank-branch-city', 'Bank Branch City'),
        ('user', 'Bank Account Number', 'bank-account-number', 'Bank Account Number'),
        ('user', 'Swift Code', 'swift-code', 'Swift Code'),
        ('user', 'Swift', 'swift', 'Swift'),
        ('user', 'Invalid withdrawal amount!', 'invalid-withdrawal-amount', 'Invalid withdrawal amount!'),
        ('user', 'Payout request sent successfully !', 'payout-request-sent-successfully', 'Payout request sent successfully !'),
        ('user', 'Minimum Payout Amounts', 'minimum-payout-amounts', 'Minimum Payout Amounts'),
        ('user', 'Empty Paypal email', 'empty-paypal-email', 'Empty Paypal email'),
        ('user', 'Empty IBAN info', 'empty-iban-info', 'Empty IBAN info'),
        ('user', 'Empty Swift info', 'empty-swift-info', 'Empty Swift info'),
        ('user', 'Transaction ID', 'transaction-id', 'Transaction ID'),
        ('user', 'Withdrawal Method', 'withdrawal-method', 'Withdrawal Method'),
        ('user', 'Amount', 'amount', 'Amount'),
        ('user', 'Send Payout Request', 'send-payout-request', 'Send Payout Request'),
        ('user', 'Total Earnings', 'total-earnings', 'Total Earnings'),
        ('user', 'Total Withdraw', 'total-withdraw', 'Total Withdraw'),
        ('user', 'Balance', 'balance', 'Balance'),
        ('user', 'after commission of', 'after-commission-of', 'after commission of'),
        ('user', 'Payout Settings', 'payout-settings', 'Payout Settings'),
        ('user', 'Payout Requests', 'payout-requests', 'Payout Requests'),
        ('user', 'Payout Completed', 'payout-completed', 'Payout Completed'),
        ('user', 'Request Sent', 'request-sent', 'Request Sent'),
        ('user', 'Enable / Disable Payout Methods', 'enabledisable-payout-methods', 'Enable / Disable Payout Methods'),
        ('user', 'must be between 1% - 99%', 'must-be-between-1-99', 'must be between 1% - 99%'),
        ('user', 'Payout History', 'payout-history', 'Payout History'),
        ('user', 'Payout Method', 'payout-method', 'Payout Method'),
        ('user', 'Add Payout', 'add-payout', 'Add Payout'),
        ('user', 'Wallet', 'wallet', 'Wallet'),
        ('user', 'User Dashboard', 'user-dashboard', 'User Dashboard'),
        ('user', 'has been', 'has-been', 'has been'),
        ('user', 'Appointment Reminder', 'appointment-reminder', 'Appointment Reminder'),
        ('user', 'Tomorrow you have an appointment', 'tomorrow-you-have-an-appointment', 'Tomorrow you have an appointment'),
        ('user', 'Dear', 'dear', 'Dear'),
        ('user', 'thank you for your booking at our', 'thank-you-for-your-booking-at-our', 'thank you for your booking at our'),
        ('user', 'at', 'at', 'at'),
        ('user', 'is', 'is', 'is'),
        ('user', 'Confirmed', 'confirmed', 'Confirmed'),
        ('user', 'Rate this service', 'rate-this-service', 'Rate this service'),
        ('user', 'Your feedback', 'your-feedback', 'Your feedback');
        
		
		CREATE TABLE `payouts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `payout_method` varchar(255) NOT NULL,
		  `amount` bigint(20) NOT NULL,
		  `transaction_id` varchar(255) DEFAULT NULL,
		  `message` text,
		  `currency` varchar(255) DEFAULT NULL,
		  `status` int(11) NOT NULL,
		  `created_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;



		CREATE TABLE `users_payout_accounts` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) DEFAULT NULL,
		  `payout_paypal_email` varchar(255) DEFAULT NULL,
		  `payout_bank_info` mediumtext,
		  `iban_full_name` varchar(255) DEFAULT NULL,
		  `iban_country_id` varchar(20) DEFAULT NULL,
		  `iban_bank_name` varchar(255) DEFAULT NULL,
		  `iban_number` varchar(500) DEFAULT NULL,
		  `swift_full_name` varchar(255) DEFAULT NULL,
		  `swift_address` varchar(500) DEFAULT NULL,
		  `swift_state` varchar(255) DEFAULT NULL,
		  `swift_city` varchar(255) DEFAULT NULL,
		  `swift_postcode` varchar(100) DEFAULT NULL,
		  `swift_country_id` varchar(20) DEFAULT NULL,
		  `swift_bank_account_holder_name` varchar(255) DEFAULT NULL,
		  `swift_iban` varchar(255) DEFAULT NULL,
		  `swift_code` varchar(255) DEFAULT NULL,
		  `swift_bank_name` varchar(255) DEFAULT NULL,
		  `swift_bank_branch_city` varchar(255) DEFAULT NULL,
		  `swift_bank_branch_country_id` varchar(20) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;











		UPDATE settings SET version = '1.7' WHERE id = 1;

    ALTER TABLE `settings` ADD `enable_animation` INT NULL DEFAULT '1' AFTER `enable_faq`;
    UPDATE `lang_values` SET `english` = 'Public key' WHERE `lang_values`.`keyword` = 'publish-key';

    ALTER TABLE `settings` ADD `flutterwave_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `flutterwave_public_key` VARCHAR(255) NULL AFTER `flutterwave_payment`, ADD `flutterwave_secret_key` VARCHAR(255) NULL AFTER `flutterwave_public_key`;

    ALTER TABLE `users` ADD `flutterwave_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `flutterwave_public_key` VARCHAR(255) NULL AFTER `flutterwave_payment`, ADD `flutterwave_secret_key` VARCHAR(255) NULL AFTER `flutterwave_public_key`;

    UPDATE `lang_values` SET `english` = ' Click here to copy below code and add to your website' WHERE `lang_values`.`keyword` = 'embed-code-copy';

    ALTER TABLE `pages` ADD `business_id` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `id`;

    

    
    INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
    ('admin', 'Dear', 'dear', 'Dear'),
    ('admin', 'thank you for your booking at our', 'thank-you-for-your-booking-at-our', 'thank you for your booking at our'),
    ('admin', 'at', 'at', 'at'),
    ('admin', 'is', 'is', 'is'),
    ('admin', 'Confirmed', 'confirmed', 'Confirmed'),
    ('admin', 'Rate this service', 'rate-this-service', 'Rate this service'),
    ('admin', 'Your feedback', 'your-feedback', 'Your feedback'),
    ('admin', 'Your account has been created successfully, now you can login to your account using below access', 'new-user-account-login', 'Your account has been created successfully, now you can login to your account using below access'),
    ('admin', 'Site Animation', 'site-animation', 'Site Animation'),
    ('admin', 'Enable to activate website animation', 'site-animation-title', 'Enable to activate website animation'),
    ('admin', 'Enable', 'enable', 'Enable'),
    ('admin', 'Amount Withdraw', 'amount-withdraw', 'Amount Withdraw'),
    ('admin', 'Flutterwave', 'flutterwave', 'Flutterwave'),
    ('admin', 'Copy', 'copy', 'Copy'),
    ('admin', 'Copied', 'copied', 'Copied');
        











		    UPDATE settings SET version = '1.8' WHERE id = 1;

        ALTER TABLE `settings` ADD `sender_mail` VARCHAR(255) NULL DEFAULT NULL AFTER `is_smtp`;

        ALTER TABLE `settings` ADD `mercado_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `mercado_currency` VARCHAR(155) NULL AFTER `mercado_payment`, ADD `mercado_api_key` VARCHAR(255) NULL AFTER `mercado_currency`, ADD `mercado_token` VARCHAR(255) NULL AFTER `mercado_api_key`;

        ALTER TABLE `users` ADD `mercado_payment` INT NULL DEFAULT '0' AFTER `razorpay_key_secret`, ADD `mercado_currency` VARCHAR(155) NULL AFTER `mercado_payment`, ADD `mercado_api_key` VARCHAR(255) NULL AFTER `mercado_currency`, ADD `mercado_token` VARCHAR(255) NULL AFTER `mercado_api_key`;


        UPDATE `lang_values` SET `english` = 'must be between 1% - 100%' WHERE `lang_values`.`keyword` = 'must-be-between-1-99';
        

        
        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('admin', 'Sender Email', 'sender-email', 'Sender Email'),
        ('admin', 'Access Token', 'access-token', 'Access Token'),
        ('admin', 'Password Recovery', 'password-recovery', 'Password Recovery'),
        ('admin', 'Hello', 'hello', 'Hello'),
        ('admin', 'We have reset your password, Please use this', 'we-reset-pass', 'We have reset your password, Please use below'),
        ('admin', 'code to login your account', 'code-to-login-your-account', 'code to login your account');
        

        CREATE TABLE `booking_val` (
    		  `id` int(11) NOT NULL AUTO_INCREMENT,
    		  `business_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
    		  `staff_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
    		  `service_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
    		  `location_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
    		  `sub_location_id` varchar(155) COLLATE utf8_unicode_ci DEFAULT '0',
    		  PRIMARY KEY (`id`)
    		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;









        UPDATE settings SET version = '1.9' WHERE id = 1;







        Tables: domains | domain_settings

        UPDATE settings SET version = '2.0' WHERE id = 1;
        ALTER TABLE `settings` ADD `site_url` VARCHAR(255) NULL DEFAULT NULL AFTER `time_zone`;
        INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`) VALUES (NULL, 'Custom Domain', 'custom-domain', '0', NULL, NULL, NULL);
        ALTER TABLE `payment_user` ADD `proof` VARCHAR(255) NULL DEFAULT NULL AFTER `payment_method`;
        ALTER TABLE `users` ADD `offline_details` TEXT NULL DEFAULT NULL AFTER `flutterwave_secret_key`, ADD `enable_offline_payment` INT NULL DEFAULT '0' AFTER `offline_details`;
        ALTER TABLE `settings` ADD `openai_key` VARCHAR(255) NULL AFTER `offline_details`, ADD `openai_model` VARCHAR(255) NULL AFTER `openai_key`, ADD `enable_openai` INT NULL DEFAULT '0' AFTER `openai_model`;
        ALTER TABLE `settings` ADD `enable_cdomain` INT NULL DEFAULT '1' AFTER `enable_openai`;
        
        
        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
            ('admin', 'Custom Domain', 'custom-domain', 'Custom Domain'),
            ('admin', 'Domains', 'domain', 'Domains'),
            ('admin', 'Requests', 'request', 'Requests'),
            ('admin', 'Current domain', 'current-domain', 'Current domain'),
            ('admin', 'Custom domain', 'custom-domain', 'Custom domain'),
            ('admin', 'Approve', 'approve', 'Approve'),
            ('admin', 'Short details', 'short-details', 'Short details'),
            ('admin', 'Host', 'host', 'Host'),
            ('admin', 'ttl', 'ttl', 'TTL'),
            ('admin', 'two', 'two', 'two'),
            ('admin', 'One', 'one', 'one'),
            ('admin', 'IP', 'ip', 'IP'),
            ('admin', 'Write details here', 'write-details-here', 'Write details here'),
            ('admin', 'Domain Requests', 'domain-requests', 'Domain Requests'),
            ('admin', 'Current Url', 'current-url', 'Current Url'),
            ('admin', 'Domain Settings', 'domain-settings', 'Domain Settings'),
            ('admin', 'Custom Domains', 'custom-domains', 'Custom Domains'),
            ('admin', 'Your Server IP Address', 'server-ip-address', 'Your Server IP Address'),
            ('admin', 'This ip address will be used to setup users custom domain > DNS settings', 'ip-help-info', 'This ip address will be used to setup users custom domain > DNS settings'),
            ('admin', 'DNS Settings', 'dns-settings', 'DNS Settings'),
            ('admin', 'Upload an Example Screenshot', 'upload-an-example-screenshot', 'Upload an Example Screenshot'),
            ('admin', 'This part will be shown for your users to setup custom domain > DNS settings', 'user-dns-settings-types', 'This part will be shown for your users to setup custom domain > DNS settings'),
            ('admin', 'Before going to submit your custom domain request make sure you have purchased this domain and its ready to use', 'custom-domain-user-warning-info', 'Before going to submit your custom domain request make sure you have purchased this domain and its ready to use'),
            ('admin', 'Default Url', 'default-url', 'Default Url'),
            ('admin', 'Openai API', 'openai-api', 'Openai API'),
            ('admin', 'Openai API Key', 'openai-api-key', 'Openai API Key'),
            ('admin', 'Openai Model', 'openai-model', 'Openai Model'),
            ('admin', 'Enable to allow openai in this system', 'enable-openai', 'Enable to allow openai in this system'),
            ('admin', 'Ai Response', 'ai-response', 'Ai Response'),
            ('admin', 'Generate', 'generate', 'Generate'),
            ('admin', 'Advanced settings', 'advanced-settings', 'Advanced settings'),
            ('admin', 'Content creativity level', 'content-creativity-level', 'Content creativity level'),
            ('admin', 'Output Variations', 'output-variations', 'Output Variations'),
            ('admin', 'Max words', 'max-wrods', 'Max words'),
            ('admin', 'No content yet', 'no-content-yet', 'No content yet'),
            ('admin', 'Output', 'output', 'Output'),
            ('admin', 'Documents', 'documents', 'Documents'),
            ('admin', 'Low', 'low', 'Low'),
            ('admin', 'Medium', 'medium', 'Medium'),
            ('admin', 'High', 'high', 'High'),
            ('admin', 'Generate AI Response', 'generate-ai-response', 'Generate AI Response'),
            ('admin', 'Give some directions about your topic', 'give-some-directions-about-your-topic', 'Give some directions about your topic'),
            ('admin', 'Enable to allow custom domain feature for users', 'enable-cdomain', 'Enable to allow custom domain feature for users');







        Tables: settings_extra | referral_payouts | referral_settings | referrals

        UPDATE settings SET version = '2.1' WHERE id = 1;
        ALTER TABLE `blog_posts` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;
        ALTER TABLE `product_services` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;
        ALTER TABLE `pages` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;
        ALTER TABLE `faqs` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;
        ALTER TABLE `testimonials` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;
        ALTER TABLE `blog_category` ADD `lang_id` INT NULL DEFAULT '1' AFTER `id`;

        INSERT INTO `package` (`id`, `name`, `slug`, `price`, `monthly_price`, `lifetime_price`, `bill_type`, `is_special`, `status`) VALUES (NULL, 'Plus', 'Plus', '2000.99', '10.00', '20.00', 'year', '0', '0');
        ALTER TABLE `features` ADD `plus` VARCHAR(155) NULL DEFAULT NULL AFTER `premium`;


        ALTER TABLE `users` ADD `referral_id` VARCHAR(155) NULL DEFAULT NULL AFTER `role`;
        ALTER TABLE `users` ADD `referral_earn` VARCHAR(155) NULL DEFAULT '0' AFTER `referral_id`;

        ALTER TABLE `business` ADD `enable_whatsapp_msg` INT NULL DEFAULT '0' AFTER `enable_onsite`, ADD `ultramsg_instance_id` VARCHAR(155) NULL AFTER `enable_whatsapp_msg`, ADD `ultramsg_token` VARCHAR(155) NULL AFTER `ultramsg_instance_id`;

       




        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Withdrawal Amount', 'withdrawal-amount', 'Withdrawal Amount'),
        ('user', 'Request Sent', 'request-sent', 'Request Sent'),
        ('user', 'Total Referrals', 'total-referrals', 'Total Referrals'),
        ('user', 'Total Earnings', 'total-earnings', 'Total Earnings'),
        ('user', 'Total Withdraw', 'total-withdraw', 'Total Withdraw'),
        ('user', 'Minimum Payout Amounts', 'minimum-payout-amounts', 'Minimum Payout Amounts'),
        ('user', 'My Referral URL', 'my-referral-url', 'My Referral URL'),
        ('user', 'Referral policy', 'referral-policy', 'Referral policy'),
        ('user', 'First Successful Payment by Referred Person', 'first-successful-payment-by-referred-person', 'First Successful Payment by Referred Person'),
        ('user', 'Every Successful Payment by Referred Person', 'every-successful-payment-by-referred-person', 'Every Successful Payment by Referred Person'),
        ('user', 'Referral guidelines', 'referral-guidelines', 'Referral guidelines'),
        ('user', 'How It works', 'how-it-works', 'How It works'),
        ('user', 'Send Invitation', 'send-invitation', 'Send Invitation'),
        ('user', 'Send your referral link to your friends and tell them how cool is this', 'send-your-referral-link-to-your-friends-and-tell-them-how-cool-is-this', 'Send your referral link to your friends and tell them how cool is this'),
        ('user', 'Registration', 'registration', 'Registration'),
        ('user', 'Let them register using your referral link', 'let-them-register-using-your-referral-link', 'Let them register using your referral link'),
        ('user', 'Get Commissions', 'get-commissions', 'Get Commissions'),
        ('user', 'Earn commission for their first subscription plan payments!', 'earn-commission-for-their-first-subscription-plan-payments', 'Earn commission for their first subscription plan payments!'),
        ('user', 'Paypal Email', 'paypal-email', 'Paypal Email'),
        ('user', 'Bank Details', 'bank-details', 'Bank Details'),
        ('user', 'Referrals', 'referrals', 'Referrals'),
        ('user', 'Referrar Id', 'referrar-id', 'Referral Id '),
        ('user', 'Order Id', 'order-id', 'Order Id'),
        ('user', 'Commision', 'commision', 'Commission '),
        ('user', 'Commision Amount', 'commision-amount', 'Commission Amount'),
        ('user', 'Select your payment method', 'select-your-payment-method', 'Select your payment method'),
        ('user', 'Paypal', 'paypal', 'Paypal'),
        ('user', 'Bank', 'bank', 'Bank'),
        ('user', 'Method Details', 'method-details', 'Method Details'),
        ('user', 'Enable Referral', 'enable-referral', 'Enable Referral'),
        ('user', 'Choose Referral policy', 'choose-referral-policy', 'Choose Referral policy'),
        ('user', 'Commission only on first purchase', 'commission-only-on-first-purchase', 'Commission only on first purchase'),
        ('user', 'Commission on every purchase', 'commission-on-every-purchase', 'Commission on every purchase'),
        ('user', 'Commision Rate(%)', 'commision-rate', 'Commission Rate'),
        ('user', 'Minimum Payout', 'minimum-payout', 'Minimum Payout'),
        ('user', 'Refferal Guidelines', 'refferal-guidelines', 'Refferal Guidelines'),
        ('user', 'Payout Request', 'payout-request', 'Payout Request'),
        ('user', 'Completed Payout', 'completed-payout', 'Completed Payout'),
        ('user', 'Affiliate', 'affiliate', 'Affiliate'),
        ('user', 'Referral Settings', 'referral-settings', 'Referral Settings');








        Tables: sliders | portfolios | fonts | referrals | brands

        UPDATE settings SET version = '2.2' WHERE id = 1;
        
        ALTER TABLE `business` ADD `about_title` VARCHAR(255) NULL AFTER `holidays`, ADD `about_details` TEXT NULL AFTER `about_title`, ADD `company_established` VARCHAR(155) NULL AFTER `about_details`, ADD `about_image` VARCHAR(255) NULL AFTER `company_established`, ADD `about_vedio_url` VARCHAR(255) NULL AFTER `about_image`;

        ALTER TABLE `testimonials` ADD `type` VARCHAR(255) NOT NULL AFTER `user_id`;

        ALTER TABLE `testimonials` CHANGE `type` `business_id` VARCHAR(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL;

        ALTER TABLE `blog_category` ADD `business_id` VARCHAR(255) NOT NULL AFTER `user_id`;

        ALTER TABLE `blog_posts` ADD `business_id` VARCHAR(255) NOT NULL AFTER `lang_id`;

        ALTER TABLE `service_category` ADD `icon` VARCHAR(255) NULL AFTER `name`, ADD `image` VARCHAR(255) NULL AFTER `icon`;

        ALTER TABLE `service_category` ADD `is_active` INT NOT NULL DEFAULT '1' AFTER `image`;

        ALTER TABLE `staffs` ADD `designation` VARCHAR(255) NOT NULL AFTER `name`;

        ALTER TABLE `staffs` ADD `facebook` VARCHAR(255) NULL AFTER `phone`, ADD `twitter` VARCHAR(255) NULL AFTER `facebook`, ADD `linkedin` VARCHAR(255) NULL AFTER `twitter`, ADD `whatsapp` VARCHAR(255) NULL AFTER `linkedin`;

        ALTER TABLE `contacts` ADD `business_id` VARCHAR(255) NULL AFTER `user_id`;

        ALTER TABLE `contacts` ADD `website` VARCHAR(255) NULL AFTER `email`;

        ALTER TABLE `contacts` ADD `phone` VARCHAR(255) NULL AFTER `name`;

        ALTER TABLE `business` ADD `enable_portfolio` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_gallery`, ADD `enable_brand` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_portfolio`, ADD `enable_slider` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_brand`, ADD `enable_blog` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_slider`;

        ALTER TABLE `business` ADD `enable_testimonial` VARCHAR(255) NULL DEFAULT '1' AFTER `enable_blog`;

        ALTER TABLE `business` ADD `font` VARCHAR(255) NULL AFTER `color`;

        ALTER TABLE `settings` ADD `enable_embed_badge` VARCHAR(11) NULL DEFAULT '0' AFTER `enable_cdomain`, ADD `enable_default_tzone` VARCHAR(11) NULL DEFAULT '0' AFTER `enable_embed_badge`;

        ALTER TABLE `business` ADD `terms` LONGTEXT NULL DEFAULT NULL AFTER `about_vedio_url`, ADD `privacy` LONGTEXT NULL DEFAULT NULL AFTER `terms`;

        ALTER TABLE `business` ADD `tax_type` VARCHAR(255) NULL AFTER `privacy`, ADD `tax_amount` INT NULL AFTER `tax_type`;

        ALTER TABLE `services` ADD `tax` INT NULL AFTER `price`;

        ALTER TABLE `settings` ADD `enable_whatsapp_msg` INT NULL DEFAULT '0' AFTER `twillo_number`, ADD `ultramsg_instance_id` VARCHAR(155) NULL AFTER `enable_whatsapp_msg`, ADD `ultramsg_token` VARCHAR(155) NULL AFTER `ultramsg_instance_id`;

        ALTER TABLE `settings` ADD `global_twilio` INT NULL DEFAULT '0' AFTER `ultramsg_token`, ADD `global_ultramsg` INT NULL DEFAULT '0' AFTER `global_twilio`;

        ALTER TABLE `business` ADD `size` VARCHAR(55) NULL DEFAULT '120px' AFTER `logo`;

       


        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Upload About Image', 'upload-about-image', 'Upload About Image'),
        ('user', 'About Company', 'about-company', 'About Company'),
        ('user', 'About Title', 'about-title', 'About Title'),
        ('user', 'Established In', 'established-in', 'Established In'),
        ('user', 'About Video Url', 'about-video-url', 'About Video Url'),
        ('user', 'About Details', 'about-details', 'About Details'),
        ('user', 'Brand', 'brand', 'Brand'),
        ('user', 'Slider', 'slider', 'Slider'),
        ('user', 'Icon', 'icon', 'Icon'),
        ('user', 'Icon Image', 'icon-image', 'Icon Image'),
        ('user', 'Category Image', 'category-image', 'Category Image'),
        ('user', 'Select Icon/Image', 'select-iconimage', 'Select Icon/Image'),
        ('user', 'Link', 'link', 'Link'),
        ('user', 'Brands', 'brands', 'Brands'),
        ('user', 'Sliders', 'sliders', 'Sliders'),
        ('user', 'Send message', 'send-message', 'Send message'),
        ('user', 'Logo', 'logo', 'Logo'),
        ('user', 'Portfolios', 'portfolios', 'Portfolios'),
        ('user', 'View', 'view', 'View'),
        ('user', 'Portfolio Category', 'portfolio-category', 'Portfolio Category'),
        ('user', 'Enable Portfolio', 'enable-portfolio', 'Enable Portfolio'),
        ('user', 'Enable to show portfolio option in home page', 'enable-portfolio-title', 'Enable to show portfolio option in home page'),
        ('user', 'Enable to show brand option in home page', 'enable-brand-title', 'Enable to show brand option in home page'),
        ('user', 'Enable Brand', 'enable-brand', 'Enable Brand'),
        ('user', 'Enable Slider', 'enable-slider', 'Enable Slider'),
        ('user', 'Enable to show slider option in home page', 'enable-slider-title', 'Enable to show slider option in home page'),
        ('user', 'Enable to show blog option in home page', 'enable-blog-title', 'Enable to show blog option in home page'),
        ('user', 'Enable Blog', 'enable-blog', 'Enable Blog'),
        ('user', 'Enable Testimonial', 'enable-testimonial', 'Enable Testimonial'),
        ('user', 'Enable to show testimonial option in home page', 'enable-testimonial-title', 'Enable to show testimonial option in home page'),
        ('user', 'Sort by Categories', 'sort-by-categories', 'Sort by Categories'),
        ('user', 'Fonts', 'fonts', 'Fonts'),
        ('user', 'Font Name', 'font-name', 'Font Name'),
        ('user', 'Color', 'color', 'Color'),
        ('user', 'Theme Color & Font', 'theme-color', 'Theme, Color & Font'),
        ('user', 'Themes', 'themes', 'Themes'),
        ('user', 'Manage Fonts', 'manage-fonts', 'Manage Fonts'),
        ('user', 'Overview', 'overview', 'Overview'),
        ('user', 'Rating & Review', 'rating-review', 'Rating & Review'),
        ('user', 'Google Fonts', 'google-fonts', 'Google Fonts'),
        ('user', 'Get New Font', 'get-new-font', 'Get New Font'),
        ('user', 'Custom Font', 'custom-font', 'Custom Font'),
        ('user', 'Default', 'default', 'Default'),
        ('user', 'About us', 'about-us', 'About us'),
        ('user', 'Happy Clients', 'happy-clients', 'Happy Clients'),
        ('user', 'Schedule', 'schedule', 'Schedule'),
        ('user', 'Closed', 'closed', 'Closed'),
        ('user', 'What We Offer', 'what-we-offer', 'What We Offer'),
        ('user', 'What we do', 'what-we-do', 'What we do'),
        ('user', 'Our Services', 'our-services', 'Our Services'),
        ('user', 'Meet Our Specialists', 'meet-our-specialists', 'Meet Our Specialists'),
        ('user', 'What our client says about ', 'what-our-client-says-about', 'What our client says about '),
        ('user', 'Ready to book our Service?', 'ready-to-book-our-service', 'Ready to book our Service?'),
        ('user', 'Our Best Services', 'our-best-services', 'Our Best Services'),
        ('user', 'Projects', 'projects', 'Projects'),
        ('user', 'Our Latest Portfolios', 'our-latest-portfolios', 'Our Latest Portfolios'),
        ('user', 'Our Team Members', 'our-team-members', 'Our Team Members'),
        ('user', 'Latest from our blog', 'latest-from-our-blog', 'Latest from our blog'),
        ('user', 'More blogs', 'more-blogs', 'More blogs'),
        ('user', 'Lets Talk', 'lets-talk', 'Lets Talk'),
        ('user', 'Request a Free Quote', 'request-a-free-quote', 'Request a Free Quote'),
        ('user', 'See Here', 'see-here', 'See Here'),
        ('user', 'E-mail', 'e-mail', 'E-mail'),
        ('user', 'Your Website', 'your-website', 'Your Website'),
        ('user', 'Your message here', 'your-message-here', 'Your message here'),
        ('user', 'We are available when you want', 'we-are-available-when-you-want', 'We are available when you want'),
        ('user', 'Find design inspiration. Share your work. Join the #1 creative community online.', 'find-design-inspiration.-share-your-work.-join-the-1-creative-community-online', 'Find design inspiration. Share your work. Join the #1 creative community online.'),
        ('user', 'What We Provide', 'what-we-provide', 'What We Provide'),
        ('user', 'Teams', 'teams', 'Teams'),
        ('user', 'Our Specialists', 'our-specialists', 'Our Specialists'),
        ('user', 'What peoples says about Us', 'what-peoples-says-about-us', 'What peoples says about Us'),
        ('user', 'Scince', 'scince', 'Scince'),
        ('user', 'What Customers say about us', 'what-customers-say-about-us', 'What Customers say about us'),
        ('user', 'What peoples say about our company', 'what-peoples-say-about-our-company', 'What peoples say about our company'),
        ('user', 'Want to book our Service?', 'want-to-book-our-service', 'Want to book our Service?'),
        ('user', 'Manage your bookings to click this', 'manage-your-bookings-to-click-this', 'Manage your bookings to click this'),
        ('user', 'Contact Info', 'contact-info', 'Contact Info'),
        ('user', 'Useful Links', 'useful-links', 'Useful Links'),
        ('user', 'Want to get a online consultation?', 'want-to-get-a-online-consultation', 'Want to get a online consultation?'),
        ('user', 'Themes', 'themes', 'Themes'),
        ('user', 'Theme Settings', 'theme-settings', 'Theme Settings'),
        ('user', 'Multipurpose One', 'multipurpose-one', 'Multipurpose One'),
        ('user', 'Multipurpose Two', 'multipurpose-two', 'Multipurpose Two'),
        ('user', 'Barbar / Stylists', 'barbar-stylists', 'Barbar / Stylists'),
        ('user', 'Agency / Law Consultancy', 'law-consultancy', 'Agency / Law Consultancy'),
        ('user', 'Medical / Health', 'medical-health', 'Medical / Health'),
        ('user', 'Beauty / Wellness', 'beauty-wellness', 'Beauty / Wellness'),
        ('user', 'Terms & Privacy', 'terms-privacy', 'Terms & Privacy'),
        ('user', 'Enable Default Time Zone', 'enable-default-time-zone', 'Default Time Zone'),
        ('user', 'Enable to activate default admin time zone for all users', 'default-time-zone-tiltle', 'Enable to activate default admin time zone for all users'),
        ('user', 'Enable Embded Powered By Badge', 'enable-embded-badge', 'Enable Embded Powered By Badge'),
        ('user', 'Enable to activate powered by badge on embedded booking page', 'embded-badge-tiltle', 'Enable to activate powered by badge on embedded booking page'),
        ('user', 'Tax Settings', 'tax-settings', 'Tax Settings'),
        ('user', 'Fixed Tax', 'fixed-tax', 'Fixed Tax'),
        ('user', 'Service based tax', 'service-based-tax', 'Service Based Tax'),
        ('user', 'Tax', 'tax', 'Tax'),
        ('user', 'Service Tax', 'service-tax', 'Service Tax'),
        ('user', 'Enable Globally', 'enable-globally', 'Enable Globally'),
        ('user', 'Enable to activate WhatsApp sms for admin and user side.', 'enable-globally-whatsapp', 'Enable to activate WhatsApp sms for admin and user side.'),
        ('user', 'Enable to activate Twilio sms for admin and user side.', 'enable-globally-twilio', 'Enable to activate Twilio sms for admin and user side.'),
        ('user', 'Instance Id', 'instance-id', 'Instance Id'),
        ('user', 'Ultramsg API', 'ultramsg-api', 'Ultramsg API'),
        ('user', 'Token', 'token', 'Token'),
        ('user', 'Sorry, Appointment is not available on that time', 'appointment-is-not-available-on-that-time', 'Sorry, Appointment is not available on that time'),
        ('user', 'Small Logo', 'small-logo', 'Small Logo'),
        ('user', 'Medium Logo', 'medium-logo', 'Medium Logo'),
        ('user', 'Large Logo', 'large-logo', 'Large Logo');


        





        Tables: system_settings | custom_form | custom_form_answer | service_extra

        UPDATE settings SET version = '2.3' WHERE id = 1;

        ALTER TABLE `customers` ADD `time_zone` VARCHAR(155) NULL AFTER `gender`;
        ALTER TABLE `services` ADD `enable_service_extra` INT NULL DEFAULT '0' AFTER `google_meet`;

        ALTER TABLE `users` ADD `auth_type` VARCHAR(20) NULL DEFAULT NULL AFTER `parent_id`, ADD `auth_id` VARCHAR(30) NULL DEFAULT NULL AFTER `auth_type`, ADD `device_1` TEXT NULL DEFAULT NULL AFTER `auth_id`, ADD `device_2` TEXT NULL DEFAULT NULL AFTER `device_1`;

        ALTER TABLE `settings` CHANGE `global_ultramsg` `global_wapp_msg` INT(11) NULL DEFAULT '0';

        ALTER TABLE `settings` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;

        ALTER TABLE `business` ADD `whatsapp_type` VARCHAR(20) NULL DEFAULT 'ultramsg' AFTER `enable_whatsapp_msg`, ADD `wazfy_instance_id` VARCHAR(50) NULL DEFAULT NULL AFTER `whatsapp_type`, ADD `wazfy_token` VARCHAR(50) NULL DEFAULT NULL AFTER `wazfy_instance_id`;

        UPDATE `lang_values` SET `label` = 'Ultramsg', `keyword` = 'ultramsg', `english` = 'Ultramsg' WHERE `lang_values`.`keyword` = 'ultramsg-api';

        ALTER TABLE `services` ADD `service_type` INT NOT NULL DEFAULT '1' AFTER `details`, ADD `number_of_service` VARCHAR(255) NULL AFTER `service_type`, ADD `service_repeat` VARCHAR(255) NULL AFTER `number_of_service`;

        ALTER TABLE `appointments` ADD `is_recurring` INT NOT NULL DEFAULT '0' AFTER `sync_calendar_user`, ADD `recurring_count` INT NOT NULL DEFAULT '0' AFTER `is_recurring`, ADD `next_recur_date` VARCHAR(255) NULL AFTER `recurring_count`, ADD `is_completed` INT NOT NULL DEFAULT '0' AFTER `next_recur_date`;

        ALTER TABLE `services` ADD `service_extra` VARCHAR(255) NULL AFTER `google_meet`;

        ALTER TABLE `settings` ADD `pwa_logo` VARCHAR(155) NULL AFTER `link`, ADD `enable_pwa` INT NULL DEFAULT '0' AFTER `pwa_logo`;
        ALTER TABLE `settings` ADD `custom_css` LONGTEXT NULL DEFAULT NULL AFTER `about_info`;

        ALTER TABLE `appointments` ADD `service_extra` VARCHAR(255) NULL DEFAULT NULL AFTER `service_id`;
        ALTER TABLE `users` ADD `remember_me_token` VARCHAR(155) NULL DEFAULT NULL AFTER `slug`;

        ALTER TABLE `business` ADD `default_timezone` VARCHAR(11) NULL DEFAULT '1' AFTER `time_zone`;
        
      

        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Custom Form', 'custom-form', 'Custom Form'),
        ('user', 'Input Title', 'input-title', 'Input Title'),
        ('user', 'Input Name', 'input-name', 'Input Name'),
        ('user', 'Input Type', 'input-type', 'Input Type'),
        ('user', 'Input required or not', 'input-required-or-not', 'Input required or not'),
        ('user', 'New Input', 'new-input', 'New Input'),
        ('user', 'Custom Forms', 'custom-forms', 'Custom Forms'),
        ('user', 'Add new input', 'add-new-input', 'Add new input'),
        ('user', 'Select input type', 'select-input-type', 'Select input type'),
        ('user', 'text', 'text', 'Text'),
        ('user', 'Textarea', 'textarea', 'Textarea'),
        ('user', 'Is this required ?', 'is-required', 'Is this required ?'),
        ('user', 'Additional Info', 'additional-info', 'Additional Info'),
        ('user', 'Service Extra', 'service-extra', 'Service Extra'),
        ('user', 'Wazfy', 'wazfy', 'Wazfy'),
        ('user', 'Extra Service', 'extra-service', 'Extra Service'),
        ('user', 'Service Type', 'service-type', 'Service Type'),
        ('user', 'Recurring Service', 'recurring-sevice', 'Recurring Service'),
        ('user', 'One of Service', 'one-of-service', 'One of Service'),
        ('user', 'Number of Service', 'number-of-service', 'Number of Services'),
        ('user', 'Repeats In', 'repeats-in', 'Repeats In'),
        ('user', 'Repeats Weekly', 'repeats-weekly', 'Repeats Weekly'),
        ('user', 'Repeats Monthly', 'repeats-monthly', 'Repeats Monthly'),
        ('user', 'Recurring Service', 'recurring-service', 'Recurring Service'),
        ('user', 'Recurring', 'recurring', 'Recurring'),
        ('user', 'One Time Service', 'one-time-service', 'One Time Service'),
        ('user', 'Service repeats weekly', 'service-repeats-weekly', 'Service repeats weekly'),
        ('user', 'Service repeats monthly', 'service-repeats-monthly', 'Service repeats monthly'),
        ('user', 'Recurring-info', 'recurring-info', 'Recurring-info'),
        ('user', 'Repeated in ', 'repeated-in', 'Repeated in '),
        ('user', 'Next', 'next', 'Next'),
        ('user', 'Recurring Count', 'recurring-count', 'Recurring Count'),
        ('user', 'Booked service extra', 'booked-service-extra', 'Booked service extra'),
        ('user', 'Disable service extra', 'disable-service-extra', 'Disable service extra'),
        ('user', 'Enable service extra', 'enable-service-extra', 'Enable service extra'),
        ('user', 'PWA Settings', 'pwa-settings', 'PWA Settings'),
        ('user', 'Enable PWA (Progressive Web Apps)', 'enable-pwa', 'Enable PWA (Progressive Web Apps)'),
        ('user', 'Enable to allow your users to install PWA on their phone', 'pwa-enable-title', 'Enable to allow your users to install PWA on their phone'),
        ('user', 'mage dimensions should not exceed 512 x 512 pixels.', 'pwa-logo-size-alert', 'mage dimensions should not exceed 512 x 512 pixels.'),
        ('user', 'Install PWA', 'install-pwa', 'Install PWA'),
        ('user', 'Custom CSS', 'custom-css', 'Custom CSS'),
        ('user', 'Add your custom css code here', 'add-your-own-css-code-here', 'Add your custom css code here'),
        ('user', 'Required', 'required', 'Required'),
        ('user', 'Custom Inputs', 'custom-inputs', 'Custom Inputs'),
        ('user', 'Setup Business', 'setup-business', 'Setup Business'),
        ('user', 'Redirect URL', 'redirect-url', 'Redirect URL'),
        ('user', 'Google', 'google', 'Google'),
        ('user', 'Facebook App ID', 'facebook-app-id', 'Facebook App ID'),
        ('user', 'Facebook App Secret', 'facebook-app-secret', 'Facebook App Secret'),
        ('user', 'Graph Version', 'graph-version', 'Graph Version'),
        ('user', 'Social Login', 'social-login', 'Social Login'),
        ('user', 'Continue With Google', 'continue-with-google', 'Continue With Google'),
        ('user', 'Continue With Facebook', 'continue-with-facebook', 'Continue With Facebook'),
        ('user', 'Remember me', 'remember-me', 'Remember Me'),
        ('user', 'Enable Default Timezone', 'enable-default-timezone', 'Enable Default Timezone'),
        ('user', 'Enable to use company timezone for your all booking customers', 'enable-default-timezone-title', 'Enable to use company timezone for your all booking customers'),
        ('user', 'Integration docs', 'integration-docs', 'Integration docs');









        Table: events, event_ticket, event_category, event_venue, event_booking, event_gallary, payment_user_event


        UPDATE settings SET version = '2.4' WHERE id = 1;

        ALTER TABLE `services` CHANGE `tax` `tax` DECIMAL(10,2) NULL DEFAULT NULL;

        UPDATE `lang_values` SET `label` = 'Ultramsg', `keyword` = 'ultramsg', `english` = 'Ultramsg' WHERE `lang_values`.`keyword` = 'ultramsg-api';

        ALTER TABLE `business` CHANGE `tax_amount` `tax_amount` VARCHAR(11) NULL DEFAULT NULL;

        ALTER TABLE `business` ADD `cancelation_time` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `time_interval`;
        ALTER TABLE `settings` ADD `reminder_before` VARCHAR(255) NOT NULL DEFAULT '1' AFTER `time_zone`;

        INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`, `plus`) VALUES (NULL, 'Events', 'events', '1', '5', '10', '50', '5000');

        ALTER TABLE `business` ADD `enable_event` INT(2) NULL DEFAULT '0' AFTER `enable_onsite`;

        ALTER TABLE `staffs` ADD `holidays` TEXT NULL DEFAULT NULL AFTER `phone`;


        
        INSERT INTO `lang_values` (`type`, `label`, `keyword`, `english`) VALUES
        ('user', 'Enable Default Timezone', 'enable-default-timezone', 'Enable Default Timezone'),
        ('user', 'Enable to use company timezone for your all booking customers', 'enable-default-timezone-title', 'Enable to use company timezone for your all booking customers'),
        ('user', 'Contact Message from', 'contact-message-from', 'Contact Message from'),
        ('user', 'Events', 'events', 'Events'),
        ('user', 'Tickets', 'tickets', 'Tickets'),
        ('user', 'Venues', 'venues', 'Venues'),
        ('user', 'Website', 'website', 'Website'),
        ('user', 'Vedio URL', 'vedio-url', 'Vedio URL'),
        ('user', 'Is seatable ?', 'is-seatable-', 'Is seatable ?'),
        ('user', 'Is seatable ?', 'is-seatable', 'Is seatable ?'),
        ('user', 'Total attendee', 'total-attendee', 'Total attendee (Maximum )'),
        ('user', 'Venue Image', 'venue-image', 'Venue Image'),
        ('user', 'Total Seat', 'total-seat', 'Total Seat'),
        ('user', 'Seating info', 'seating-info', 'Seating info'),
        ('user', 'Event Image', 'event-image', 'Event Image'),
        ('user', 'Audience Type', 'audience-type', 'Audience Type'),
        ('user', 'Youtube Vedio URL', 'youtube-vedio-url', 'Youtube Vedio URL'),
        ('user', 'External Link', 'external-link', 'External Link'),
        ('user', 'Contact Number', 'contact-number', 'Contact Number'),
        ('user', 'Artists', 'artists', 'Artists (if  any artist of this event)'),
        ('user', 'Is this organized by other ?', 'is-other-organizer', 'Is this organized by other ?'),
        ('user', 'Organizer Name', 'organizer-name', 'Organizer Name'),
        ('user', 'Organizer Phone', 'organizer-phone', 'Organizer Phone'),
        ('user', 'Organizer Email', 'organizer-email', 'Organizer Email'),
        ('user', 'Organizer Website', 'organizer-website', 'Organizer Website'),
        ('user', 'Meta Tags', 'meta-tags', 'Meta Tags'),
        ('user', 'Meta Description', 'meta-description', 'Meta Description'),
        ('user', 'Ticket Name', 'ticket-name', 'Ticket Name'),
        ('user', 'Ticket Details', 'ticket-details', 'Ticket Details'),
        ('user', 'Ticket Price', 'ticket-price', 'Ticket Price'),
        ('user', 'Sales Start', 'sales-start', 'Sales Start'),
        ('user', 'ticket Description', 'ticket-description', 'ticket Description'),
        ('user', 'Ticket Per Attendee', 'ticket-per-attendee', 'Ticket Per Attendee'),
        ('user', 'Sales End', 'sales-end', 'Sales End'),
        ('user', 'Venue', 'venue', 'Venue'),
        ('user', 'Event', 'event', 'Event'),
        ('user', 'Venue Info', 'venue-info', 'Venue Info'),
        ('user', 'Ticket Info', 'ticket-info', 'Ticket Info'),
        ('user', 'Countdown', 'countdown', 'Countdown'),
        ('user', 'Organizer Info', 'organizer-info', 'Organizer Info'),
        ('user', 'Book a ticket', 'book-a-ticket', 'Book a ticket'),
        ('user', 'Event Info', 'event-info', 'Event Info'),
        ('user', 'Maximum', 'maximum', 'Maximum'),
        ('user', 'Ticket', 'ticket', 'Ticket'),
        ('user', 'Total Ticket', 'total-ticket', 'Total Ticket'),
        ('user', 'Total Price', 'total-price', 'Total Price'),
        ('user', 'Event booked successfully', 'event-booked-successfully', 'Event booked successfully'),
        ('user', 'Event booking number', 'event-booking-number', 'Event booking number'),
        ('user', 'You can not buy more than', 'ticket-limit-msg', 'You can not buy more than'),
        ('user', 'Booked new event', 'booked-new-event', 'Booked new event'),
        ('user', 'We are thrilled to inform you that your ticket booking for the upcoming', 'event-booking-confirmation', 'We are thrilled to inform you that your ticket booking for the upcoming event'),
        ('user', 'has been successfully confirmed', 'has-been-successfully-confirmed', 'has been successfully confirmed at'),
        ('user', 'Recently bookrd an event', 'recently-bookrd-an-event', 'Recently booked an event'),
        ('user', 'Recently booked an event', 'recently-booked-an-event', 'Recently booked an event'),
        ('user', 'Bookings', 'bookings', 'Bookings'),
        ('user', 'New Booking', 'new-booking', 'New Booking'),
        ('user', 'Booking', 'booking', 'Booking'),
        ('user', 'Sorry we have only ', 'sorry-we-have-only', 'Sorry !! we have only '),
        ('user', 'More tickets available.', 'more-tickets-available', 'More tickets available.'),
        ('user', 'This event is organized by', 'this-event-is-organized-by', 'This event is organized by'),
        ('user', 'Availlable tickets for', 'availlable-tickets-for', 'Availlable tickets for'),
        ('user', 'Add new ticket', 'add-new-ticket', 'Add new ticket'),
        ('user', 'Appointment Date', 'appointment-date', 'Appointment Date'),
        ('user', 'Appointment Time', 'appointment-time', 'Appointment Time'),
        ('user', 'Appointment Cancelation before', 'cancelation-time', 'Appointment Cancelation before'),
        ('user', 'Appointment Reminder before', 'reminder-before', 'Appointment Reminder before'),
        ('user', 'Set 0 to disable this feature', 'set-0-to-disable-this-feature', 'Set 0 to disable this feature'),
        ('user', 'You have an appointment', 'you-have-an-appointment', 'You have an appointment'),
        ('user', 'The wallet system is now enabled. All appointment payments will be credited to the admin account, with the remaining amount added to your wallet balance.', 'wallet-enable-alert', 'The wallet system is now enabled. All appointment payments will be credited to the admin account, with the remaining amount added to your wallet balance.'),
        ('user', 'Upcoming', 'upcoming', 'Upcoming');

?>