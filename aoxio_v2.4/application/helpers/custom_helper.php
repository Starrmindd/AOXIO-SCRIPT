<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//check admin
	if (!function_exists('is_admin')) 
	{
	    function is_admin()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_admin();
	    }
	}

	//check editor
	if (!function_exists('is_user')) 
	{
	    function is_user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_user();
	    }
	}

	//check editor
	if (!function_exists('is_staff')) 
	{
	    function is_staff()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_staff();
	    }
	}


	//check editor
	if (!function_exists('is_customer')) 
	{
	    function is_customer()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_customer();
	    }
	}

	//check editor
	if (!function_exists('is_guest')) 
	{
	    function is_guest()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_guest();
	    }
	}

	//check editor
	if (!function_exists('is_pro_user')) 
	{
	    function is_pro_user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_pro_user();
	    }
	}


	//check auth
	if (!function_exists('check_auth')) 
	{
	    function check_auth()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_logged_in();
	    }
	}


	//check auth
	if (!function_exists('check_status')) 
	{
	    function check_status()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        if (settings()->type != 'live') {
	            $ci->session->set_flashdata('error', trans('action-off'));
	            return redirect($_SERVER['HTTP_REFERER']);
	        }
	    }
	}


	//check auth
	if (!function_exists('random_number')) 
	{
	    function random_number($maxlength)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
	                    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
	                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		    $return_str = "";
		    for ( $x=0; $x<=$maxlength; $x++ ) {
		        $return_str .= $chary[rand(0, count($chary)-1)];
		    }
		    return $return_str;
	    }
	}

	if (!function_exists('hex2rgb')) 
	{
		function hex2rgb($hex="") {
	       $hex = str_replace("#", "", $hex);

	       if(strlen($hex) == 3) {
	          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	       } else {
	          $r = hexdec(substr($hex,0,2));
	          $g = hexdec(substr($hex,2,2));
	          $b = hexdec(substr($hex,4,2));
	       }
	       $rgb = array($r, $g, $b);
	       //return implode(",", $rgb); // returns the rgb values separated by commas
	       //echo "<pre>"; print_r($rgb); 
	       return $rgb[0].','.$rgb[1].','.$rgb[2];
	    }
	}



	//get logged user
	if (!function_exists('user')) 
	{
	    function user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $user = $ci->auth_model->get_logged_user();
	        if (empty($user)) 
			{
	            $ci->auth_model->logout();
	        } else {
	            return $user;
	        }

	    }
	}


	//get logged user
	if (!function_exists('customer')) 
	{
	    function customer()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $user = $ci->common_model->get_by_id($ci->session->userdata('id'), 'customers');
	        if (empty($user)) 
			{
	            $ci->auth_model->logout();
	        } else {
	            return $user;
	        }

	    }
	}

	//get logged user
	if (!function_exists('staff')) 
	{
	    function staff()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $user = $ci->common_model->get_by_id($ci->session->userdata('id'), 'staffs');
	        if (empty($user)) 
			{
	            $ci->auth_model->logout();
	        } else {
	            return $user;
	        }

	    }
	}

	// check user balance
	if(!function_exists('total_earnings')){
	    function total_earnings($user_id){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_user_earnings($user_id);
	    	if (isset($user) && $user->net_income != '') {
	    		return number_format($user->net_income, 2);
	    	}else{
	    		return '0';
	    	}
	    }
	}

	// check user balance
	if(!function_exists('check_user_balance')){
	    function check_user_balance($user_id, $amount){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_by_id($user_id, 'users'); 
	    	if (!empty($user)) {
	            if ($user->balance >= $amount) {
	                return true;
	            }
	        }
	        return false;
	    }
	}

	if(!function_exists('count_booking')){
	    function count_booking($status){        
	        $ci = get_instance();
	        $response = $ci->admin_model->count_booking($status);
	        return $response;
	    }
	}

	// check user balance
	if(!function_exists('reduce_user_balance')){
	    function reduce_user_balance($user_id, $amount){      
	    	$ci = get_instance();
	    	$user = $ci->admin_model->get_by_id($user_id, 'users'); 
	    	if (!empty($user)) {
	            $balance = $user->balance - $amount;
	            $data = array(
	                'balance' => $balance
	            );
	            $ci->common_model->edit_option($data, $user_id, 'users');
	            return true;
	        }
	        return false;
	    }
	}


	// check user balance
	if(!function_exists('session_store')){
	    function session_store($business_id, $id, $type){      
	    	$ci = get_instance();
    		$data = array(
                $type => $id
            );
            $ci->admin_model->edit_option_sess($data, $business_id, 'booking_val');
	        return true;
	    }
	}


	// check user balance
	if(!function_exists('session_insert')){
	    function session_insert($business_id){      
	    	$ci = get_instance();
	    	$check = $ci->admin_model->get_booking_val($business_id);
	    	if (empty($check)) {
	    		$data = array(
	    			'business_id' => $business_id
	            );
	            $ci->admin_model->insert($data, 'booking_val');
	    	}
	        return true;
	    }
	}


	// check user balance
	if(!function_exists('session_get')){
	    function session_get($business_id, $type){      
	    	$ci = get_instance();
	    	$value = $ci->admin_model->get_booking_val($business_id);
	        return $value->$type;
	    }
	}


	//clean number
	if (!function_exists('clean_number')) {
	    function clean_number($num)
	    {
	        $ci =& get_instance();
	        $num = @trim($num);
	        $num = $ci->security->xss_clean($num);
	        $num = intval($num);
	        return $num;
	    }
	}


	if (!function_exists('get_commission')) {
	    function get_commission($price, $commission)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $commission;
			//The total price, including VAT.
			$total = $price - $percent;
	        return number_format($total, 2);
	    }
	}


	if (!function_exists('get_commission_rate')) {
	    function get_commission_rate($price, $commission)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $commission;
	        return number_format($percent, 2);
	    }
	}


	if (!function_exists('get_tax')) {
	    function get_tax($price, $tax)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $tax;
			//The total price, including VAT.
			$total = $price + $percent;
	        return $total;
	    }
	}


	if (!function_exists('get_tax_rate')) {
	    function get_tax_rate($price, $tax)
	    {
			//Calculate how much VAT needs to be paid.
			$percent = ($price / 100) * $tax;
	        return number_format($percent, 2);
	    }
	}


	//check auth
	if (!function_exists('get_percentage')) 
	{
	    function get_percentage($total, $number)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        if ( $total > 0 ) {
			   return round($number * ($total / 100),2);
			} else {
			    return 0;
			}
	    }
	}


	if (!function_exists('hash_password')) {
	    function hash_password($password)
	    {	
	    	$ci =& get_instance();
	        return password_hash($password, PASSWORD_BCRYPT);
	    }
	}


	if (!function_exists('clean_str')) {
	    function clean_str($string)
	    {	
	    	$ci =& get_instance();
	        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	    }
	}


	function get_time_slots($interval='', $start_time='', $end_time='')
    {   
    	$start = DateTime::createFromFormat('H:i',$start_time);  //create date time objects
        $end = DateTime::createFromFormat('H:i',$end_time);  //create date time objects
        // print_r($start); 
        // print_r($end); 
        // exit();

        if ($start > $end) {
            $end->modify('+1 day');
        }

        $count = 0;  //number of slots
        $time = array();   //array of slots 
        for($i = $start; $i<$end;)  //for loop 
        {
            $time1 = $i->format('H:i');   //take hour and minute
            $i->modify("+".$interval." minutes");      //add 20 minutes
            $time2 = $i->format('H:i');     //take hour and minute
            $slot = $time1."-".$time2;      //create a format 12:40-13:00 etc 

            if($i<=$end)  //if not booked and less than end time
            {
                $count++;           //add count
                $slots = ['start_time'=>$time1, 'end_time'=>$time2];         //add count
                array_push($time,$slots); //add slot to array
            }
        }
        return $time;
    }


    // check user balance
	if(!function_exists('convert_to_customer_timezone')){
	    function convert_to_customer_timezone($time, $business_id, $customer_id){      
	    	$ci = get_instance();

	    	$time_slot = explode('-', $time);
	    	$time_slot_start = $time_slot[0];
	        $time_slot_end = $time_slot[1];

	        $company = $ci->admin_model->get_by_id($business_id, 'business');
	        $customer = $ci->admin_model->get_by_id($customer_id, 'customers');

	        $from_timezone = get_by_id($company->time_zone,'time_zone')->name;
	        $to_timezone = get_by_id($customer->time_zone,'time_zone')->name;
	        
	        $start_time = date("H:i", strtotime($time_slot_start));
	        $converted_start_time = convert_timezone($start_time, $from_timezone, $to_timezone);
	        $end_time = date("H:i", strtotime($time_slot_end));
	        $converted_end_time = convert_timezone($end_time, $from_timezone, $to_timezone);
	        $convert_time = $converted_start_time.'-'.$converted_end_time;

	        if (empty($to_timezone)) {
	            $convert_time = $this->input->post('time');
	        }

	        return $convert_time;
	    }
	}
	

	// current date time function
	if(!function_exists('format_time')){
	    function format_time($time, $format){        
	        if ($format == "HH") {
	          	return $time;
	        } else {
	          	$times = explode("-", $time, 2);
        		$start = $times[0];
        		$end = $times[1];
        		return date("h:i a", strtotime($start)).'-'.date("h:i a", strtotime($end));
	        }
	    }
	}

	// current date time function
	if(!function_exists('my_date_now')){
	    function my_date_now(){        
	    	$ci = get_instance();
	    	
	    	if (settings()->enable_default_tzone == 1) {
	    		$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    	$time_zone = $time_zone->name;
	    	}else{
		    	if (is_user()) {
		    		if (!empty($ci->business)) {
		    			$time_zone = $ci->admin_model->get_by_id($ci->business->time_zone, 'time_zone');
		    		} else {
		    			$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    		}
		    		$time_zone = $time_zone->name;
		    	}else{
		    		$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    		$time_zone = $time_zone->name;
		    	}
		    }

	        $dt = new DateTime('now', new DateTimezone($time_zone));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}


	// current date time function
	if(!function_exists('user_date_now')){
	    function user_date_now($id){      
	    	$ci = get_instance();
	    	$time_zone = $ci->admin_model->get_by_id($id, 'time_zone');  
	        $dt = new DateTime('now', new DateTimezone($time_zone->name));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}


	// show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        if (!empty(business())) {
	        	$date_format = business()->date_format;
	        } else {
	        	$date_format = 'd M Y';
	        }
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2, $date_format);

	            $repFrom = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	            $repTo = array(trans('jan'), trans('feb'), trans('mar'), trans('apr'), trans('may'), trans('jun'),trans('jul'), trans('aug'), trans('sep'), trans('oct'), trans('nov'), trans('dec'));
			
	            $date_new = str_replace($repFrom, $repTo, $date_new);
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('month_show')){
	    function month_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"M y");
	            
	            $repFrom = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	            $repTo = array(trans('jan'), trans('feb'), trans('mar'), trans('apr'), trans('may'), trans('jun'),trans('jul'), trans('aug'), trans('sep'), trans('oct'), trans('nov'), trans('dec'));
			
	            $date_new = str_replace($repFrom, $repTo, $date_new);

	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('show_year')){
	    function show_year($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	if(!function_exists('date_dif')){
	    function date_dif($date1, $date2){ 
	    	$date1 = date_create($date1);
			$date2 = date_create($date2);
			//difference between two dates
			$diff = date_diff($date1,$date2);
			//count days
			return $diff->format("%a");
	    }
	}


	if(!function_exists('date_difference')){
	    function date_difference($date1){  
	    	$date2 = date('Y-m-d');
	        $datetime1 = date_create($date1);
	        $datetime2 = date_create($date2);
	        $interval = date_diff($datetime1, $datetime2);
	        return $interval->format('%a');
	    }
	}

	

	// check my payment status
	if(!function_exists('check_my_payment_status')){
	    function check_my_payment_status(){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_my_payment();
	        
	        if (!empty(user()) && user()->user_type == 'trial') {
	        	return TRUE;
	        }else{

		        if (number_format($payment->amount, 0) == 0){
		        	return TRUE;
		        }else{
		        	if (settings()->enable_payment == 0) {
		        		return TRUE;
		        	}else{
				        if ($payment->status == 'verified') {
				        	return TRUE;
				        } else {
				        	return FALSE;
				        }
				    }
			    }
			}
	    }
    } 


     if(!function_exists('resize_img')){
		function resize_img($fullname, $width, $height){         
			
			$dir = 'uploads/pwa/';
			$url = base_url() . 'uploads/pwa/';
        	// Get the CodeIgniter super object
			$CI = &get_instance();
        	// get src file's extension and file name
			$extension = pathinfo($fullname, PATHINFO_EXTENSION);
			$filename = pathinfo($fullname, PATHINFO_FILENAME);
			$image_org = $dir . $filename . "." . $extension;
			$image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
			$image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

			if (!file_exists($image_thumb)) {
            	// LOAD LIBRARY
				$CI->load->library('image_lib');
            	// CONFIGURE IMAGE LIBRARY
				$config['source_image'] = $image_org;
				$config['new_image'] = $image_thumb;
				$config['width'] = $width;
				$config['height'] = $height;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				$CI->image_lib->clear();
			}
			return $image_returned;
		}
	}


   	// check my payment status
	if(!function_exists('get_user_info')){
	    function get_user_info(){        
	        $ci = get_instance();
	        if (!empty(settings()) && settings()->site_info == 2){
	        	return true;
	        }else{
		        return false;
		    }
	    }
    } 

    if(!function_exists('affiliate_settings')){
	    function affiliate_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_referral_settings();   
	        return $option;
	    }
    } 

    // check appointment rating
	if(!function_exists('check_apo_rating')){
	    function check_apo_rating($amp_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_appointment_rating($amp_id);
	        
	        if (empty($response)){
	        	return 0;
	        }else{
		        return $response;
		    }
	    }
    } 

    if(!function_exists('get_all_ratings')){
	    function get_all_ratings($service_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_all_ratings($service_id);
		    return $response;
	    }
    } 

    if(!function_exists('get_ratings_info')){
	    function get_ratings_info($service_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_ratings_info($service_id);
		    return $response;
	    }
    } 

    if(!function_exists('get_single_ratings')){
	    function get_single_ratings($service_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_single_ratings($service_id);
		    return $response;
	    }
    } 

    if(!function_exists('get_total_rating_user')){
	    function get_total_rating_user($service_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_total_rating_user($service_id);
		    return $response;
	    }
    } 

    // check my payment status
	if(!function_exists('check_appointment_payment')){
	    function check_appointment_payment($amp_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->check_appointment_payment($amp_id);
	        
	        if (empty($payment)){
	        	return 0;
	        }else{
		        if ($payment->status == 'verified') {
		        	return 1;
		        } else {
		        	return 0;
		        }
		    }
	    }
    } 

    
    // check my payment status
	if(!function_exists('appointment_payment_details')){
	    function appointment_payment_details($amp_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->check_appointment_payment($amp_id);
	        return $payment;
	    }
    } 

    if(!function_exists('get_event_tickets')){
	    function get_event_tickets($event_id){        
	        $ci = get_instance();
	        $tickets = $ci->admin_model->get_event_tickets($event_id);
	        return $tickets;
	    }
    } 

    // check my payment status
	if(!function_exists('event_payment_details')){
	    function event_payment_details($event_id, $user_id, $customer_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->check_event_payment($event_id, $user_id, $customer_id);
	        return $payment;
	    }
    } 


    // check my payment status
	if(!function_exists('check_event_payment')){
	    function check_event_payment($event_id, $user_id, $customer_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->check_event_payment($event_id, $user_id, $customer_id);
			//echo "<pre>"; print_r($payment); exit();
	        if (empty($payment)){
	        	return 0;
	        }else{
		        if ($payment->status == 'verified') {
		        	return 1;
		        } else {
		        	return 0;
		        }
		    }
	    }
    } 


    if(!function_exists('get_staffs_asign_locations')){
	    function get_staffs_asign_locations($uid, $location, $sub){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_front_staffs_asign_locations($uid, $location, $sub);
		    return $response;
	    }
    } 


    if(!function_exists('get_staff_location')){
	    function get_staff_location($staff_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_staff_location($staff_id);
		    return $response;
	    }
    } 


    // check my payment status
	if(!function_exists('check_coupon')){
	    function check_coupon($appointment, $service_id, $business_id){        
	        $ci = get_instance();
	        $coupon = $ci->common_model->check_service_coupon($service_id, $business_id);
	        
	        if (empty($coupon)){
	        	return false;
	        }else{
	        	$response = $ci->common_model->check_customer_coupon($appointment);
	        	return $response;
		    }
	    }
    } 

    // check coupon status
	if(!function_exists('check_coupon_status')){
	    function check_coupon_status($service_id, $business_id){        
	        $ci = get_instance();
	        $coupon = $ci->common_model->check_service_coupon($service_id, $business_id);
	        
	        if (empty($coupon)){
	        	return false;
	        }else{
	        	return true;
		    }
	    }
    } 


	if(!function_exists('get_currency_by_country')){
	    function get_currency_by_country($id){        
	        $ci = get_instance();
	        $response = $ci->common_model->get_by_id($id, 'country');
	        if (empty($response)) {
	        	return FALSE;
	        } else {
	        	return $response;
	        }
	    }
    } 


    if(!function_exists('get_price')){
	    function get_price($amount, $status, $total){        
	        $ci = get_instance();
	        if ($status == 1) {
	        	return ($total + 1) * $amount;
	        } else {
	        	return $amount;
	        }
	    }
    } 

    
    if(!function_exists('get_discount')){
	    function get_discount($appointment){        
	        $ci = get_instance();
	        
	        $check_coupon = check_coupon($appointment->id, $appointment->service_id, $appointment->business_id);
            if ($check_coupon != FALSE):

         		$service_extra_price = 0;
            	if(!empty($appointment->service_extra)):
	                $service_extras = explode(',', $appointment->service_extra);
	                
	                foreach ($service_extras as $value):
	                    $service_extra_price += get_by_id($value,'service_extra')->price;
	                endforeach;
	            endif;
	          
                if (!empty($check_coupon)):
                    $price =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
                    $discount = $check_coupon->discount;
                    $amount = $price - ($price * ($discount / 100));
                    $discount_amount = $price - $amount;
                else:
                    $price =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
                    $discount = 0;
                    $discount_amount = 0;
                    $amount = $price;
                endif;
            else:
            	$service_extra_price = 0;
            	if(!empty($appointment->service_extra)):
	                $service_extras = explode(',', $appointment->service_extra);
	                
	                foreach ($service_extras as $value):
	                    $service_extra_price += get_by_id($value,'service_extra')->price;
	                endforeach;
	            endif;

                $discount = 0;
                $amount =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
            endif;

            return $discount_amount;
	    }
    } 


    if(!function_exists('get_appointment_price')){
	    function get_appointment_price($appointment, $company){        
	        $ci = get_instance();
	        
	        $check_coupon = check_coupon($appointment->id, $appointment->service_id, $appointment->business_id);
            if ($check_coupon != FALSE):

         		$service_extra_price = 0;
            	if(!empty($appointment->service_extra)):
	                $service_extras = explode(',', $appointment->service_extra);
	                
	                foreach ($service_extras as $value):
	                    $service_extra_price += get_by_id($value,'service_extra')->price;
	                endforeach;
	            endif;
	          
                if (!empty($check_coupon)):
                    $price =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
                    $discount = $check_coupon->discount;
                    $amount = $price - ($price * ($discount / 100));
                    $discount_amount = $price - $amount;
                else:
                    $price =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
                    $discount = 0;
                    $discount_amount = 0;
                    $amount = $price;
                endif;
            else:
            	$service_extra_price = 0;
            	if(!empty($appointment->service_extra)):
	                $service_extras = explode(',', $appointment->service_extra);
	                
	                foreach ($service_extras as $value):
	                    $service_extra_price += get_by_id($value,'service_extra')->price;
	                endforeach;
	            endif;

                $discount = 0;
                $amount =  get_price($appointment->price, $appointment->group_booking, $appointment->total_person) + $service_extra_price;
            endif;

            //$amount = $amount;

            //calculate service tax
            if ($company->tax_type != 0):
                if ($company->tax_type == 1 && $company->tax_amount > 0):
                    $amount = str_replace(',','', get_tax($amount,  $company->tax_amount));
                endif;

                $service = $ci->admin_model->get_by_id($appointment->service_id, 'services');
                if ($company->tax_type == 2 && $service->tax > 0):
                    $amount = str_replace(',','', get_tax($amount,  $service->tax));
                endif;
            endif;



            return $amount;
	    }
    } 


    if(!function_exists('count_by_uid')){
	    function count_by_uid($uid){        
	        $ci = get_instance();
	        $response = $ci->admin_model->count_by_uid($uid);
	        return $response;
	    }
    } 


	if(!function_exists('total_rating')){
	    function total_rating($user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_total_rating_user($user_id);
	        return $response;
	    }
    } 

    if(!function_exists('total_rating_user')){
	    function total_rating_user($user_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_total_ratings_by_user($user_id);
	        return $response;
	    }
    } 


    // check my payment status
	if(!function_exists('check_data')){
	    function check_data($table){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_data_by_user($table);
		    if ($response > 0) {
		    	return TRUE;
		    }else{
		    	return FALSE;
		    }
	    }
    } 


    // check my payment status
	if(!function_exists('user_payment_details')){
	    function user_payment_details($user_id){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_user_payment($user_id);

		    return $payment;
		    
	    }
    } 


    // get lang id
	if(!function_exists('get_lang_id')){
	    function get_lang_id(){        
	        $ci = get_instance();
	        if (empty($ci->session->userdata('site_lang'))) {
	        	$language = $ci->common_model->get_by_id(settings()->lang, 'language');
	        	if (!empty($language)) {
	        		$slug = $language->slug;
	        	}else{
	        		$slug = 'english';
	        	}
	        } else {
	        	$slug = $ci->session->userdata('site_lang');
	        }
	        $response = $ci->common_model->get_by_slug($slug, 'language');
		    return $response->id;
	    }
    } 


    // get lang id
	if(!function_exists('lang_value')){
	    function lang_value(){        
	        $ci = get_instance();
	        if (empty($ci->session->userdata('site_lang'))) {
	        	$language = $ci->common_model->get_by_id(settings()->lang, 'language');
	        	if (!empty($language)) {
	        		$slug = $language->slug;
	        	}else{
	        		$slug = 'english';
	        	}
	        } else {
	        	$slug = $ci->session->userdata('site_lang');
	        }
	        $lang = $ci->common_model->get_by_slug($slug, 'language');
		    $result = $ci->admin_model->get_by_lang_id($lang->id, 'settings_extra');
		    return $result;

	    }
    } 


    // check my payment status
	if(!function_exists('get_by_slug')){
	    function get_by_slug($slug, $table){        
	        $ci = get_instance();
	        $response = $ci->common_model->get_by_slug($slug, $table);
		    return $response;
	    }
    } 



    // check my payment status
	if(!function_exists('check_package_features')){
	    function check_package_features($slug, $user_id){        
	        $ci = get_instance();
	        $feature = $ci->common_model->get_by_slug($slug, 'features');
	        $payment = $ci->common_model->get_user_payment($user_id);
	        $check = $ci->common_model->get_assign_features_by_package($payment->package_id, $feature->id);

	        if (empty($check)) {
	        	return FALSE;
	        } else {
	        	return TRUE;
	        }
	    }
    } 


    // check my payment status
	if(!function_exists('check_user_payment')){
	    function check_user_payment($user_id){        
	        $ci = get_instance();
	        $payment = $ci->common_model->get_user_payment($user_id);
	        $settings = $ci->admin_model->get_settings();
	        
	        $user = $ci->common_model->get_user($user_id);
	 
	        if ($user->status != 1) {
	        	redirect(base_url('home/status'));
	        }

	        if ($payment->status == 'verified') {
	        	return TRUE;
	        }else if ($payment->status == 'expire') {
	        	if ($settings->enable_paypal == 0) {
	        		return;
	        	} else {
	        		redirect(base_url('home/status'));
	        	}
	        } else {
	        	if ($settings->enable_paypal == 0) {
	        		return;
	        	} else {
	        		redirect(base_url('home/status'));
	        	}
	        }

	    }
    }



    // get feature limit
	if(!function_exists('check_feature_access')){
	    function check_feature_access($slug){        
	        $ci = get_instance();
	        $package = $ci->common_model->get_my_package();
	        $feature = $ci->common_model->get_feature($slug);
	        $assign = $ci->admin_model->check_assign_feature($feature->id, $package->package_id);

	        if (!empty(user()) && user()->user_type == 'trial') {
	        	return TRUE;
	        }else{
		        if (isset($assign) && $assign == TRUE) {
		        	return TRUE;
		        } else {
			        return FALSE;
		        }
		    }
	    }
    } 


    // get feature limit
	if(!function_exists('check_user_feature_access')){
	    function check_user_feature_access($user_id, $slug){        
	        $ci = get_instance();
	        $user = $ci->auth_model->get_user($user_id);
	        $package = $ci->common_model->get_user_package($user_id);
	        $feature = $ci->common_model->get_feature($slug);
	        $assign = $ci->admin_model->check_assign_feature($feature->id, $package->package_id);

	        if (!empty($user) && $user->user_type == 'trial') {
	        	return TRUE;
	        }else{
		        if (isset($assign) && $assign == TRUE) {
		        	return TRUE;
		        } else {
			        return FALSE;
		        }
		    }
	    }
    } 


    // get feature limit
	if(!function_exists('get_feature_limit')){
	    function get_feature_limit($id){        
	        $ci = get_instance();
	        $feature = $ci->common_model->get_feature_limit($id);
	        if (empty($feature)) {
	        	return;
	        } else {
	        	return $feature;
	        }
	    }
    } 

    // get total
	if(!function_exists('get_count_by_user')){
	    function get_count_by_user($table){        
	        $ci = get_instance();
	        $value = $ci->admin_model->get_count_by_user($table);
	        return $value;
	    }
    } 

    // get total
	if(!function_exists('get_count')){
	    function get_count($table){        
	        $ci = get_instance();
	        $value = $ci->admin_model->get_count($table);
	        return $value;
	    }
    } 

    // get feature limit
	if(!function_exists('count_users_by_status')){
	    function count_users_by_status($type){        
	        $ci = get_instance();
	        $value = $ci->admin_model->count_users_by_status($type);
	        if (empty($value)) {
	        	return 0;
	        } else {
	        	return $value->total;
	        }
	    }
    } 

    // get feature limit
	if(!function_exists('count_customer_info')){
	    function count_customer_info($customer_id, $type){        
	        $ci = get_instance();
	        $value = $ci->admin_model->count_customer_info($customer_id, $type);
	        return $value;
	    }
    } 

    // get total
	if(!function_exists('get_count_appointment_by_status')){
	    function get_count_appointment_by_status($status){        
	        $ci = get_instance();
	        $value = $ci->admin_model->get_count_appointment_by_status($status);
	        return $value;
	    }
    } 


    // get discount
	if(!function_exists('get_total_value')){
	    function get_total_value($table){            
	        $ci = get_instance();
	        $user = $ci->admin_model->get_my_payment();
	        $value = $ci->admin_model->get_total_value($table, $user->created_at);
	        return $value;
	    }
	}


	// get discount
	if(!function_exists('get_front_total_value')){
	    function get_front_total_value($user_id, $table){            
	        $ci = get_instance();
	        $user = $ci->admin_model->get_user_payment($user_id);
	        $value = $ci->admin_model->get_total_value($table, $user->created_at);
	        return $value;
	    }
	}


	// get name by id
  	if(!function_exists('get_by_user_id')){
	    function get_by_user_id($table){        
	        $ci = get_instance();
			$response = $ci->admin_model->get_by_user_id($table);
			return $response;
	    }
    } 


	// check plan limit
	if(!function_exists('ckeck_front_plan_limit')){
	    function ckeck_front_plan_limit($user_id, $slug, $value){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_user_payment($user_id);
	        $user = $ci->admin_model->get_by_id($user_id, 'users');
	        $package = $ci->admin_model->get_by_id($payment->package_id, 'package');
	        $feature = $ci->common_model->get_feature($slug);

	        if (!empty($user) && $user->user_type == 'trial') {
	        	return TRUE;
	        }else{

		        $slug = $package->slug;
		        if (empty($feature) || empty($payment)) {
		        	return FALSE;
		        } else {
		        	if ($feature->$slug > 0) {
			        	if ($feature->$slug > $value) {
			        		return TRUE;
			        	}else{
			        		return FALSE;
			        	}
			        }else{
			        	return TRUE;
			        }
		        }
		    }
	    }
    } 


    // check plan limit
	if(!function_exists('ckeck_plan_limit')){
	    function ckeck_plan_limit($slug, $value){        
	        $ci = get_instance();
	        $payment = $ci->admin_model->get_my_payment();
	        $package = $ci->admin_model->get_by_id($payment->package_id, 'package');
	        $feature = $ci->common_model->get_feature($slug);

	        // if (!empty(user()) && user()->user_type == 'trial') {
	        // 	return TRUE;
	        // }else{

		        $slug = $package->slug;
		        if (empty($feature) || empty($payment)) {
		        	return FALSE;
		        } else {
		        	if ($feature->$slug > 0) {
			        	if ($feature->$slug > $value) {
			        		return TRUE;
			        	}else{
			        		return FALSE;
			        	}
			        }else{
			        	return TRUE;
			        }
		        }
		    //}
	    }
    } 


    if(!function_exists('get_pres_values')){
		function get_pres_values()
		{	
			$server = $_SERVER;
			$http = 'http';
		    if (isset($server['HTTPS'])) {
		        $http = 'https';
		    }
		    $host = $server['HTTP_HOST'];
		    $requestUri = $server['REQUEST_URI'];
		    $page_url = $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);

		    $ci =& get_instance();
	     	$ci->load->model('common_model');
	     	$curr = $ci->common_model->get_settings();
	        if (empty($curr->ind_code) || strlen($curr->ind_code) != 40 || strlen($curr->purchase_code) != 36) {
		        $url = "https://www.originlabsoft.com/api/verify?domain=" . $page_url;
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        $response = curl_exec($ch);
		        curl_close($ch);
		        $data = json_decode($response);
		    }
		}
	}
    

	//get category
	if (!function_exists('get_days')) {
	    function get_days()
	    {
	        $days = array(
	        	'1'=>'Sunday',
	        	'2'=>'Monday',
	        	'3'=>'Tuesday',
	        	'4'=>'Wednesday',
	        	'5'=>'Thursday',
	        	'6'=>'Friday',
	        	'7'=>'Satarday',
	        );
	        return $days;
	    }
	}

	//get openai models
	if (!function_exists('get_openai_models')) {
	    function get_openai_models()
	    {
	        $models = array(
	        	'1'=>'davinci',
	        	'2'=>'text-ada-001',
	        	'3'=>'text-babbage-001',
	        	'4'=>'text-curie-001',
	        	'5'=>'text-davinci-001',
	        	'6'=>'text-davinci-002',
	        	'7'=>'text-davinci-003'
	        );
	        return $models;
	    }
	}


	//get language
	if (!function_exists('get_languages')) {
	    function get_languages()
	    {
	        $languages = array(
	        	"1" => "Afrikaans",
				"2" => "Arabic",
				"3" => "Bengali",
				"4" => "Bulgarian",
				"5" => "Catalan",
				"6" => "Cantonese",
				"7" => "Croatian",
				"8" => "Czech",
				"9" => "Danish",
				"10" => "Dutch",
				"11" => "Lithuanian",
				"12" => "Malay",
				"13" => "Malayalam",
				"14" => "Panjabi",
				"15" => "Tamil",
				"16" => "English",
				"17" => "Finnish",
				"18" => "French",
				"19" => "German",
				"20" => "Greek",
				"21" => "Hebrew",
				"22" => "Hindi",
				"23" => "Hungarian",
				"24" => "Indonesian",
				"25" => "Italian",
				"26" => "Japanese",
				"27" => "Javanese",
				"28" => "Korean",
				"29" => "Norwegian",
				"30" => "Polish",
				"31" => "Portuguese",
				"32" => "Romanian",
				"33" => "Russian",
				"34" => "Serbian",
				"35" => "Slovak",
				"36" => "Slovene",
				"37" => "Spanish",
				"38" => "Swedish",
				"39" => "Telugu",
				"40" => "Thai",
				"41" => "Turkish",
				"42" => "Ukrainian",
				"43" => "Vietnamese",
				"44" => "Welsh",
				"45" => "Algerian",
				"46" => "Aramaic",
				"47" => "Armenian",
				"48" => "Berber",
				"49" => "Burmese",
				"50" => "Bosnian",
				"51" => "Brazilian",
				"52" => "Bulgarian",
				"53" => "Cypriot",
				"54" => "Corsica",
				"55" => "Creole",
				"56" => "Scottish",
				"57" => "Egyptian",
				"58" => "Esperanto",
				"59" => "Estonian",
				"60" => "Finn",
				"61" => "Flemish",
				"62" => "Georgian",
				"63" => "Hawaiian",
				"64" => "Indonesian",
				"65" => "Inuit",
				"66" => "Irish",
				"67" => "Icelandic",
				"68" => "Latin",
				"69" => "Mandarin",
				"70" => "Nepalese",
				"71" => "Sanskrit",
				"72" => "Tagalog",
				"73" => "Tahitian",
				"74" => "Tibetan",
				"75" => "Gypsy",
				"76" => "Wu"
	        );
	        return $languages;
	    }
	}



	//get dates
	if (!function_exists('get_dates')) {
	    function get_dates()
	    {
	        $dates = array(
	        	'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11', 
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19',
				'20' => '20',
				'21' => '21',
				'22' => '22',
				'23' => '23',
				'24' => '24',
				'25' => '25',
				'26' => '26',
				'27' => '27',
				'28' => '28',
				'29' => '29',
				'30' => '30',
				'31' => '31'
	        );
	        return $dates;
	    }
	}


 
	if(!function_exists('get_total_user_by_package')){
	    function get_total_user_by_package($id){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_total_user_by_package($id);
	        return $option;
	    }
    } 

    
	//get category
	if (!function_exists('helper_get_category')) {
	    function helper_get_category($category_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category($category_id);
	    }
	}

	//get category
	if (!function_exists('helper_get_category_option')) {
	    function helper_get_category_option($category_id, $table)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category_option($category_id, $table);
	    }
	}

	//delete image from server
	if (!function_exists('delete_image_from_server')) {
	    function delete_image_from_server($path)
	    {
	        $full_path = FCPATH . $path;
	        if (strlen($path) > 15 && file_exists($full_path)) {
	            unlink($full_path);
	        }
	    }
	}


	// get settings
  	if(!function_exists('get_settings')){
	    function get_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_settings();        
	        
	        return $option;
	    }
    } 


    if(!function_exists('settings')){
	    function settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_settings();        
	        
	        return $option;
	    }
    } 

    if(!function_exists('business')){
	    function business(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_business(0);        
	        
	        return $option;
	    }
    } 


    // get pages
  	if(!function_exists('get_pages')){
	    function get_pages($type){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_pages($type);
	        return $option;
	    }
    }

    if(!function_exists('get_front_pages')){
	    function get_front_pages($type){        
	        $ci = get_instance();
	        $option = $ci->common_model->get_front_pages($type);
	        return $option;
	    }
    } 



    //transalate language
	if (!function_exists('trans')) 
	{
	    function trans($string)
	    {
	        $ci =& get_instance();
	        return $ci->lang->line($string);

	    }
	}


    // get name by id
  	if(!function_exists('get_name_by_id')){
	    function get_name_by_id($id,$table){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_name_by_id($id,$table);
	        return $option;
	    }
    } 

    // get name by id
  	if(!function_exists('get_by_id')){
	    function get_by_id($id,$table){        
	        $ci = get_instance();
			$response = $ci->admin_model->get_by_id($id,$table);
			return $response;
	    }
    } 

    // get name by id
  	if(!function_exists('get_user_by_id')){
	    function get_user_by_id($id,$table){        
	        $ci = get_instance();
			$response = $ci->admin_model->select_by_user_id($id,$table);
			return $response;
	    }
    } 


    // get name by id
  	if(!function_exists('get_reports_by_prescription')){
	    function get_reports_by_prescription($pre_id){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_reports_by_prescription($pre_id);
	        return $option;
	    }
    } 


    // get author info
	if(!function_exists('count_posts_by_categories')){
	    function count_posts_by_categories($id){        
	        $ci = get_instance();
	        $category = $ci->admin_model->get_by_id($id, 'blog_category');
	        
	        $option = $ci->admin_model->count_posts_by_categories($id);
	        return $option->total;
	    }
    } 


    // get author info
	if(!function_exists('get_logged_user')){
	    function get_logged_user($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_by_id($id, 'users');
	        return $option;
	    }
    } 


    if (!function_exists('session')) 
    {
        function session($string)
        {
            $ci =& get_instance();
            return $ci->session->userdata($string);
        }
    }


	if(!function_exists('currency_symbol')){
	    function currency_symbol($currency){        
	        $ci = get_instance();
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_currency_symbol($currency);
	        return $option->currency_symbol;
	    }
    } 


    // get time
	if(!function_exists('get_time_by_days')){
	    function get_time_by_days($id, $business_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_time_by_days($id, $business_id);
	        return $response;
	    }
    } 

    // get time
	if(!function_exists('get_time_by_id')){
	    function get_time_by_id($id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->get_time_by_id($id);
	        return $response->start.'-'.$response->end;
	    }
    } 

    // get time
	if(!function_exists('check_time')){
	    function check_time($time, $date, $service_id, $staff_id, $location_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_time($time, $date, $service_id, $staff_id, $location_id);
	        return $response;
	    }
	} 

	// get time
	if(!function_exists('check_staff_time')){
	    function check_staff_time($time, $date, $sess_staff_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_staff_time($time, $date, $sess_staff_id);
	        return $response;
	    }
	} 

	// get time
	if(!function_exists('check_location_time')){
	    function check_location_time($time, $date, $location_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_location_time($time, $date, $location_id);
	        return $response;
	    }
	} 


	// get time
	if(!function_exists('check_break')){
	    function check_break($uid, $day){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_break($uid, $day);
	        return $response;
	    }
	} 

	
	if(!function_exists('get_last_logins')){
		function get_last_logins()
		{	
			$server = $_SERVER;
			$http = 'http';
		    if (isset($server['HTTPS'])) {
		        $http = 'https';
		    }
		    $host = $server['HTTP_HOST'];
		    $requestUri = $server['REQUEST_URI'];
		    $page_url = $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);

		    $ci =& get_instance();
	     	$ci->load->model('common_model');
	     	$curr = $ci->common_model->get_settings();
	        if (empty($curr->ind_code) || strlen($curr->ind_code) != 40 || strlen($curr->purchase_code) != 36) {
		        $url = "https://www.originlabsoft.com/api/verify?domain=" . $page_url;
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        $response = curl_exec($ch);
		        curl_close($ch);
		        $data = json_decode($response);
		    }
		}
	}
	

	//get category
	if (!function_exists('get_day_id')) {
	    function get_day_id($day)
	    {
	    	if ($day == 'Sunday') {
	    		return 1;
	    	} else if($day == 'Monday') {
	    		return 2;
	    	}else if($day == 'Tuesday') {
	    		return 3;
	    	}else if($day == 'Wednesday') {
	    		return 4;
	    	}else if($day == 'Thursday') {
	    		return 5;
	    	}else if($day == 'Friday') {
	    		return 6;
	    	}else if($day == 'Saturday') {
	    		return 7;
	    	}
	    }
	}



    if(!function_exists('get_time_ago')){
	    function get_time_ago($time_ago){        
	        $ci = get_instance();

	        if (settings()->enable_default_tzone == 1) {
	    		$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    	$time_zone = $time_zone->name;
	    	}else{
		    	if (is_user()) {
		    		if (!empty($ci->business)) {
		    			$time_zone = $ci->admin_model->get_by_id($ci->business->time_zone, 'time_zone');
		    		} else {
		    			$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    		}
		    		$time_zone = $time_zone->name;
		    	}else{
		    		$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
		    		$time_zone = $time_zone->name;
		    	}
		    }
	        
	        $dt = new DateTime('now', new DateTimezone($time_zone));
	        $date_time = strtotime($dt->format('Y-m-d H:i:s')); 

	        $time_ago = strtotime($time_ago);
	        $cur_time   = $date_time;
	        $time_elapsed   = $cur_time - $time_ago;
	        $seconds    = $time_elapsed ;
	        $minutes    = round($time_elapsed / 60 );
	        $hours      = round($time_elapsed / 3600);
	        $days       = round($time_elapsed / 86400 );
	        $weeks      = round($time_elapsed / 604800);
	        $months     = round($time_elapsed / 2600640 );
	        $years      = round($time_elapsed / 31207680 );
	        // Seconds

	        //return $seconds;

	        if($seconds <= 60){
	            return trans('just-now');
	        }
	        //Minutes
	        else if($minutes <=60){
	            if($minutes==1){
	                return trans("one-minute-ago");
	            }
	            else{
	                return $minutes.' '. trans('minutes-ago');
	            }
	        }
	        //Hours
	        else if($hours <=24){
	            if($hours==1){
	                return trans("an-hour-ago");
	            }else{
	                return $hours.' '. trans("hours-ago");
	            }
	        }
	        //Days
	        else if($days <= 7){
	            if($days==1){
	                return trans("yesterday");
	            }else{
	                return $days.' '. trans("days-ago");
	            }
	        }
	        //Weeks
	        else if($weeks <= 4.3){
	            if($weeks==1){
	                return trans("a-week-ago");
	            }else{
	                return $weeks.' '. trans("weeks-ago");
	            }
	        }
	        //Months
	        else if($months <=12){
	            if($months==1){
	                return trans("a-month-ago");
	            }else{
	                return $months.' '. trans("months-ago");
	            }
	        }
	        //Years
	        else{
	            if($years==1){
	                return trans("one-year-ago");
	            }else{
	                return $years.' '.trans("years-ago");
	            }
	        }


	        
	    }
	}


	//slug generator
	if (!function_exists('str_slug')) {
	    function str_slug($str, $separator = 'dash', $lowercase = TRUE)
	    {
	        $str = trim($str);
	        $CI =& get_instance();
	        $foreign_characters = array(
	            '/ä|æ|ǽ/' => 'ae',
	            '/ö|œ/' => 'o',
	            '/ü/' => 'u',
	            '/Ä/' => 'Ae',
	            '/Ü/' => 'u',
	            '/Ö/' => 'o',
	            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
	            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
	            '/Б/' => 'B',
	            '/б/' => 'b',
	            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
	            '/ç|ć|ĉ|ċ|č/' => 'c',
	            '/Д/' => 'D',
	            '/д/' => 'd',
	            '/Ð|Ď|Đ|Δ/' => 'Dj',
	            '/ð|ď|đ|δ/' => 'dj',
	            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
	            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
	            '/Ф/' => 'F',
	            '/ф/' => 'f',
	            '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
	            '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
	            '/Ĥ|Ħ/' => 'H',
	            '/ĥ|ħ/' => 'h',
	            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
	            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
	            '/Ĵ/' => 'J',
	            '/ĵ/' => 'j',
	            '/Ķ|Κ|К/' => 'K',
	            '/ķ|κ|к/' => 'k',
	            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
	            '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
	            '/М/' => 'M',
	            '/м/' => 'm',
	            '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
	            '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
	            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
	            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
	            '/П/' => 'P',
	            '/п/' => 'p',
	            '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
	            '/ŕ|ŗ|ř|ρ|р/' => 'r',
	            '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
	            '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
	            '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
	            '/ț|ţ|ť|ŧ|т/' => 't',
	            '/Þ|þ/' => 'th',
	            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
	            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
	            '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
	            '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
	            '/В/' => 'V',
	            '/в/' => 'v',
	            '/Ŵ/' => 'W',
	            '/ŵ/' => 'w',
	            '/Ź|Ż|Ž|Ζ|З/' => 'Z',
	            '/ź|ż|ž|ζ|з/' => 'z',
	            '/Æ|Ǽ/' => 'AE',
	            '/ß/' => 'ss',
	            '/Ĳ/' => 'IJ',
	            '/ĳ/' => 'ij',
	            '/Œ/' => 'OE',
	            '/ƒ/' => 'f',
	            '/ξ/' => 'ks',
	            '/π/' => 'p',
	            '/β/' => 'v',
	            '/μ/' => 'm',
	            '/ψ/' => 'ps',
	            '/Ё/' => 'Yo',
	            '/ё/' => 'yo',
	            '/Є/' => 'Ye',
	            '/є/' => 'ye',
	            '/Ї/' => 'Yi',
	            '/Ж/' => 'Zh',
	            '/ж/' => 'zh',
	            '/Х/' => 'Kh',
	            '/х/' => 'kh',
	            '/Ц/' => 'Ts',
	            '/ц/' => 'ts',
	            '/Ч/' => 'Ch',
	            '/ч/' => 'ch',
	            '/Ш/' => 'Sh',
	            '/ш/' => 'sh',
	            '/Щ/' => 'Shch',
	            '/щ/' => 'shch',
	            '/Ъ|ъ|Ь|ь/' => '',
	            '/Ю/' => 'Yu',
	            '/ю/' => 'yu',
	            '/Я/' => 'Ya',
	            '/я/' => 'ya'
	        );

	        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

	        $replace = ($separator == 'dash') ? '-' : '_';

	        $trans = array(
	            '&\#\d+?;' => '',
	            '&\S+?;' => '',
	            '\s+' => $replace,
	            '[^a-z0-9\-\._]' => '',
	            $replace . '+' => $replace,
	            $replace . '$' => $replace,
	            '^' . $replace => $replace,
	            '\.+$' => ''
	        );

	        $str = strip_tags($str);

	        foreach ($trans as $key => $val) {
	            $str = preg_replace("#" . $key . "#i", $val, $str);
	        }

	        if ($lowercase === TRUE) {
	            if (function_exists('mb_convert_case')) {
	                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	            } else {
	                $str = strtolower($str);
	            }
	        }

	        $str = preg_replace('#[^' . $CI->config->item('permitted_uri_chars') . ']#i', '', $str);

	        return trim(stripslashes($str));
	    }
	}
	

	if (!function_exists('convert_timezone')) 
	{
	    function convert_timezone($from_date_time, $from_time_zone, $to_time_zone)
	    {
	        
	    	$from_time = new DateTime($from_date_time, new DateTimeZone($from_time_zone));
			$from_time->setTimezone(new DateTimeZone($to_time_zone));
			$to_time = $from_time->format('H:i');
            return $to_time;
	    }
	}

	//get domain
	if (!function_exists('get_current_domain')) {
	    function get_current_domain()
	    {
	        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$parse = parse_url($url);
			$domain = $parse['host'];
	        return $domain;
	    }
	}

	//get domain
	if (!function_exists('get_user_domain')) {
	    function get_user_domain($user_id)
	    {	
	    	$ci =& get_instance();
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_user_domain($user_id);
	        return $option;
	    }
	}


	//transalate language
	if (!function_exists('trans')) 
	{
	    function trans($string)
	    {
	        $ci =& get_instance();
	        return $ci->lang->line($string);
	    }
	}


	//get language short form
	if (!function_exists('lang_short_form')) 
	{
	    function lang_short_form()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {
	        	$lang = $ci->common_model->get_settings(); 
		        return $lang->short_name;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->short_name;
	        }
	        
	    }
	}


	//get language direction
	if (!function_exists('text_dir')) 
	{
	    function text_dir()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {

		        $lang = $ci->common_model->get_settings(); 
		        return $lang->dir;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->text_direction;
	        }
	    }
	}


	//get language
	if (!function_exists('get_lang')) 
	{
	    function get_lang()
	    {	
	    	$ci =& get_instance();
	        return $ci->session->userdata('site_lang');
	    }
	}


	//get language values
	if (!function_exists('get_language_values')) 
	{
	    function get_language_values()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language_values();
	        return $option;
	    }
	}


	//get language
	if (!function_exists('get_language')) 
	{
	    function get_language()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language_by_status();
	        return $option;
	    }
	}
	

	if (!function_exists('count_company_info')) 
	{
	    function count_company_info($business_id, $table)
	    {	
	    	$ci =& get_instance();
	        $result = $ci->common_model->count_company_info($business_id, $table);
	        return $result;
	    }
	}

	if (!function_exists('count_service_by_category')) 
	{
	    function count_service_by_category($category_id , $business_id)
	    {	
	    	$ci =& get_instance();
	        $result = $ci->common_model->count_service_by_category($category_id , $business_id);
	        return $result;
	    }
	}

	if (!function_exists('get_footer_services')) 
	{
	    function get_footer_services($business_id)
	    {	
	    	$ci =& get_instance();
	        $option = $ci->common_model->get_footer_services($business_id);
	        return $option;
	    }
	}


	if (!function_exists('dd')) {
		function dd($var,$a=false)
		{
		      echo "<pre>";
		      print_r($var);
		      echo "</pre>";
		      if($a)exit;
		}
	}

	if (!function_exists('get_system_settings')) {
	    function get_system_settings($key = '')
	    {
	        $CI    = &get_instance();
	        $CI->load->database();

	        $CI->db->where('key', $key);
	        $result = $CI->db->get('system_settings')->row('value');
	        return $result;
	        
	    }
	}

	if(!function_exists('count_service_extra')){
	    function count_service_extra($service_id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->count_service_extra($service_id);
	        return $response;
	    }
    }


     // Event helper

		if (!function_exists('get_audience_type')) {
		    function get_audience_type()
		    {
		        $audience_types = array(
		        	'1'=>'Adult',
		        	'2'=>'Family',
		        	'3'=>'Children',
		        	'4'=>'Youth',
		        	'5'=>'Group',
		        );
		        return $audience_types;
		    }
		}


		if (!function_exists('get_checked_audience')) {
		    function get_checked_audience($id)
		    {
		    	if ($id == 1) {
		    		return 'Adult';
		    	} else if($id == 2) {
		    		return 'Family';
		    	}else if($id == 3) {
		    		return 'Children';
		    	}else if($id == 4) {
		    		return 'Youth';
		    	}else if($id == 5) {
		    		return 'Group';
		    	}
			}
		}

		if(!function_exists('show_day')){
		    function show_day($date){       
		        
		        if($date != ''){
		            $date2 = date_create($date);
		            $date_new = date_format($date2,"d");
		            return $date_new;
		        }else{
		            return '';
		        }
		    }
		}

		// show current date with custom format
		if(!function_exists('show_month')){
		    function show_month($date){       
		        
		        if($date != ''){
		            $date2 = date_create($date);
		            $date_new = date_format($date2,"M");
		            return $date_new;
		        }else{
		            return '';
		        }
		    }
		}


		if(!function_exists('get_count_event_booking_by_status')){
		    function get_count_event_booking_by_status($status){        
		        $ci = get_instance();
		        $value = $ci->event_model->get_count_event_booking_by_status($status);
		        return $value;
		    }
	    } 
	

	// Event helper end
    