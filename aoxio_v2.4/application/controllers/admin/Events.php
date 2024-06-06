<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function index(){
        $data = array();
        $data['page_title'] = 'Events';     
        $data['page'] = 'Event';   
        $data['event'] = FALSE;
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->select_by_user('event_category');
        $data['venues'] = $this->admin_model->select_by_user('event_venue');
        $data['events'] = $this->admin_model->select_by_user('events');
        $data['main_content'] = $this->load->view('admin/events/events',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add(){	
        //echo "string";exit();
        check_status();

        if($_POST)
        {   
            $id = $this->input->post('id', true);

            $audience_type = implode(',', $this->input->post('audience_type', true));

            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'category' => $this->input->post('category', true),
                'venue' => $this->input->post('venue', true),
                'slug' => str_slug(trim($this->input->post('name'))),
                'details' => $this->input->post('details', true),
                'tags' => $this->input->post('tags', true),
                'date' => $this->input->post('date', true),
                'time' => $this->input->post('time', true),
                'audience_type' => $audience_type,
                'youtube_vedio_url' => $this->input->post('youtube_vedio_url', true),
                'external_link' => $this->input->post('external_link', true),
                'contact_number' => $this->input->post('contact_number', true),
                'artist' => $this->input->post('artists', true),
                'is_organizer' => $this->input->post('is_organizer', true),
                'organizer_name' => $this->input->post('organizer_name', true),
                'organizer_email' => $this->input->post('organizer_email', true),
                'organizer_phone' => $this->input->post('organizer_phone', true),
                'organizer_website' => $this->input->post('organizer_website', true),
                'meta_tags' => $this->input->post('meta_tags', true),
                'meta_description' => $this->input->post('meta_description', true),
                'status' => $this->input->post('status', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);

            //if id available info will be edited
            if ($id != '') {
                $this->event_model->delete_event_tickets($id,'event_ticket');
                $this->admin_model->edit_option($data, $id, 'events');
                $this->session->set_flashdata('msg', trans('updated-successfully')); 
            } else {
               
                
                $id = $this->admin_model->insert($data, 'events');
                $edata=array(
                    'image' => 'assets/front/img/no-image.png',
                    'thumb' => 'assets/front/img/no-image.png'
                );
                $this->admin_model->edit_option($edata, $id, 'events');
                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
            }



            $names = $this->input->post('ticket_name', true);
            $ticket_details = $this->input->post('ticket_details', true);
            $price = $this->input->post('price', true);
            $limit = $this->input->post('limit', true);
            $sales_start = $this->input->post('sales_start', true);
            $sales_end = $this->input->post('sales_end', true);
            $tickets_per_attendee = $this->input->post('tickets_per_attendee', true);
            
            $i=0;
            foreach ($names as $value) {
                $ticket_data=array(
                    'user_id' => user()->id,
                    'event_id' => $id,
                    'name' => $value,
                    'details' => $ticket_details[$i],
                    'price' => $price[$i],
                    'limit' => $limit[$i],
                    'sales_start' => $sales_start[$i],
                    'sales_end' => $sales_end[$i],
                    'tickets_per_attendee' => $tickets_per_attendee[$i],
                    'status' => 1,
                );
                //echo '<pre>', print_r( $this->input->post('name', true)); exit();
                $ticket_data = $this->security->xss_clean($ticket_data);
                $ticket_id = $this->admin_model->insert($ticket_data, 'event_ticket');
            $i++;}



            //upload image
            $data_img = $this->admin_model->do_upload('photo');
            if($data_img){
                $data_img = array(
                    'image' => $data_img['medium'],
                    'thumb' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, $id, 'events'); 
            }

            redirect(base_url('admin/events'));

        }      
        
    }

    public function edit($id){  
        
        $tags = "";
        $count = 0;
        $tags_array = explode(',', $this->admin_model->get_by_id($id, 'events')->tags);

        //echo "string"; print_r($tags_array) ; exit();
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item;
            $count++;
        }

        $artists = "";
        $count = 0;
        $artists_array = explode(',', $this->admin_model->get_by_id($id, 'events')->artist);

        //echo "string"; print_r($artists_array) ; exit();
        foreach ($artists_array as $item) {
            if ($count > 0) {
                $artists .= ",";
            }
            $artists .= $item;
            $count++;
        }

        $meta_tags = "";
        $count = 0;
        $meta_tags_array = explode(',', $this->admin_model->get_by_id($id, 'events')->meta_tags);

        //echo "string"; print_r($meta_tags_array) ; exit();
        foreach ($meta_tags_array as $item) {
            if ($count > 0) {
                $meta_tags .= ",";
            }
            $meta_tags .= $item;
            $count++;
        }


        $data = array(); 
        $data['page'] = 'Event';   
        $data['page_title'] = 'Edit';
        $data['tags'] = $tags;   
        $data['artists'] = $artists;   
        $data['meta_tags'] = $meta_tags;   
        $data['event'] = $this->admin_model->select_option($id, 'events');
        $data['categories'] = $this->admin_model->select_by_user('event_category');
        $data['venues'] = $this->admin_model->select_by_user('event_venue');
        $data['main_content'] = $this->load->view('admin/events/events',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function delete($id){
        $this->event_model->delete_event_tickets($id,'event_ticket');
        $this->admin_model->delete($id,'events'); 
        echo json_encode(array('st' => 1));
    }


    public function category(){
        $data = array();
        $data['page_title'] = 'Category';     
        $data['page'] = 'Event';   
        $data['event'] = FALSE;
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->select_by_user('event_category');
        $data['main_content'] = $this->load->view('admin/events/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function add_category(){	
        check_status();

        if($_POST)
        {   
            $id = $this->input->post('id', true);

                
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'details' => $this->input->post('details', true),
                'status' => $this->input->post('status', true),
            );
            $data = $this->security->xss_clean($data);
            if ($id != '') {
                $this->admin_model->edit_option($data, $id, 'event_category');
                $this->session->set_flashdata('msg', trans('updated-successfully')); 
            } else {
                $id = $this->admin_model->insert($data, 'event_category');
                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
            }

            

            redirect(base_url('admin/events/category'));

          
        }      
        
    }

    public function edit_category($id){  
        $data = array();
        $data['page_title'] = 'Edit Category';   
        $data['page'] = 'Event';   
        $data['category'] = $this->admin_model->select_option($id, 'event_category');
        $data['main_content'] = $this->load->view('admin/events/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function delete_category($id){
        $this->admin_model->delete($id,'event_category'); 
        echo json_encode(array('st' => 1));
    }

    public function tickets(){
        $data = array();
        $data['page_title'] = 'Tickets';     
        $data['page'] = 'Event';   
        $data['event'] = FALSE;
        $data['ticket'] = FALSE;
        $data['tickets'] = $this->event_model->get_all_event_tickets('event_ticket');
        $data['main_content'] = $this->load->view('admin/events/tickets',$data,TRUE);
        $this->load->view('admin/index',$data);
    }
    

    public function delete_ticket($id){
        $this->admin_model->delete($id,'event_ticket'); 
        echo json_encode(array('st' => 1));
    }


    public function venues(){
        $data = array();
        $data['page_title'] = 'Venues';     
        $data['page'] = 'Event';   
        $data['event'] = FALSE;
        $data['venues'] = FALSE;
        $data['venues'] = $this->admin_model->select_by_user('event_venue');
        $data['main_content'] = $this->load->view('admin/events/venues',$data,TRUE);
        $this->load->view('admin/index',$data);
    }
    

    public function add_venue(){   
        check_status();

        if($_POST)
        {   
            $id = $this->input->post('id', true);

                
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'vedio_url' => $this->input->post('vedio_url', true),
                'address' => $this->input->post('address', true),
                'website' => $this->input->post('website', true),
                'total_attendee' => $this->input->post('total_attendee', true),
                'details' => $this->input->post('details', true),
                'is_seatable' => $this->input->post('is_seatable', true),
                'total_seat' => $this->input->post('total_seat', true),
                'status' => $this->input->post('status', true),
            );
            $data = $this->security->xss_clean($data);
            if ($id != '') {
                $this->admin_model->edit_option($data, $id, 'event_venue');
                $this->session->set_flashdata('msg', trans('updated-successfully')); 
            } else {
                $id = $this->admin_model->insert($data, 'event_venue');
                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
            }

            

            //upload image
            $data_img = $this->admin_model->do_upload('photo');
            if($data_img){
                $data_img = array(
                    'image' => $data_img['medium'],
                    'thumb' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, $id, 'event_venue'); 
            }

            redirect(base_url('admin/events/venues'));

          
        }      
        
    }


    public function edit_venue($id){  
        $data = array();
        $data['page_title'] = 'Edit Venue';   
        $data['page'] = 'Event';   
        $data['venue'] = $this->admin_model->select_option($id, 'event_venue');
        $data['main_content'] = $this->load->view('admin/events/venues',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function delete_venue($id){
        $this->admin_model->delete($id,'event_venue'); 
        echo json_encode(array('st' => 1));
    }

     public function add_more_ticket(){  

        $data = array();   
        $data['page'] = 'Event';   
        $loaded = $this->load->view('admin/events/include/ticket_section', $data, true);
        echo json_encode(array('loaded' => $loaded));
    }


    public function booking(){
        $data = array();
        $data['page_title'] = 'Booking';     
        $data['page'] = 'Event';   
        $data['event'] = FALSE;
        $data['category'] = FALSE;


        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/events/booking');
        $total_row = $this->event_model->get_event_bookings(user()->id, 1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 8;
        $this->pagination->initialize($config);

        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['bookings'] = $this->event_model->get_event_bookings(user()->id, 0 , $config['per_page'], $page * $config['per_page']);
        $data['venues'] = $this->admin_model->select_by_user('event_venue');
        $data['events'] = $this->admin_model->select_by_user('events');
        $data['customers'] = $this->admin_model->get_customers();

        //echo "<pre>"; print_r($data['bookings']); exit();
        $data['main_content'] = $this->load->view('admin/events/bookings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


   

    public function load_ticket($id){
       

        $tickets = $this->event_model->get_tickets_by_event($id);
        
        if (empty($tickets)) {
            echo '<option value="0">'.trans('no-data-found').'</option>';
        }else{
            
            echo '<option value="">'.trans("select").'</option>';
            foreach ($tickets as $ticket) {

                if($ticket->limit > 0){
                    echo '<option value="'. $ticket->id.'">'. $ticket->name.''. '</option>';
                } 
                
            }
        }
    }


    public function booking_add(){   
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            $event = get_by_id($this->input->post('event_id', true),'events');
            $ticket = get_by_id($this->input->post('ticket_id', true),'event_ticket');
            $total_slot = $this->input->post('quantity', true);
            $total_price = $total_slot  * $ticket->price ;


           
            if ($total_slot > $ticket->tickets_per_attendee ) {
                 $this->session->set_flashdata('error', trans('ticket-limit-msg').' '.$ticket->tickets_per_attendee.' '.trans('tickets'));
                redirect($_SERVER['HTTP_REFERER']);
                
            }

            if($total_slot > $ticket->limit){
                $this->session->set_flashdata('error', trans('sorry-we-have-only').' '.$ticket->limit.' '.trans('more-tickets-available')); 
                redirect($_SERVER['HTTP_REFERER']);
            }

            
        
            $this->form_validation->set_rules('event_id', 'Event', 'required');
            $this->form_validation->set_rules('ticket_id', 'Ticket', 'required');
            

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/events/booking'));
            } else {

              

                $booking_data = array(
                    'booking_number' => random_string('numeric',5),
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'customer_id' => $this->input->post('customer_id', true),
                    'event_id' => $this->input->post('event_id', true),
                    'ticket_id' => $this->input->post('ticket_id', true),
                    'venue_id' => $event->venue,
                    'date' => $event->date,
                    'time' => $event->time,
                    'status' => 0,
                    'total_slot' => $this->input->post('quantity', true),
                    'total_price' => $total_price,
                    'created_at' => my_date_now(),
                );
                
                $booking_data = $this->security->xss_clean($booking_data);
                if ($id != '') {
                    $this->admin_model->edit_option($booking_data, $id, 'event_booking');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                    $this->status_update($this->input->post('status'), $id);
                } else {

                    // $total = get_total_value('appointments');
                    // if (ckeck_plan_limit('appointments', $total) == FALSE) {
                    //     $this->session->set_flashdata('error', trans('reached-maximum-limit'));
                    //     redirect(base_url('admin/appointments'));
                    //     exit();
                    // }
                    
                    $this->admin_model->insert($booking_data, 'event_booking');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 

                    $customer = $this->admin_model->get_by_id($this->input->post('customer_id'), 'customers');

                    if (!empty($this->input->post('notify_customer')) && $this->input->post('notify_customer') == 1) {

                        $company = $this->admin_model->get_business($this->business->uid);

                        if (user()->enable_sms_notify == 1) {
                            $this->load->model('sms_model');
                            $content = trans('event-booking-confirmation').' - '.$event->name.' '.trans('has-been-successfully-confirmed').' '.$event->date;
                            $response = $this->sms_model->send($customer->phone, $content);
                        }

                        // send whatsapp to customer
                        $this->load->model('sms_model');
                        $content = trans('event-booking-confirmation').' - '.$event->name.' '.trans('has-been-successfully-confirmed').' '.$event->date;
                            
                        // send whatsapp to customer
                        if ($company->enable_whatsapp_msg == 1 && settings()->global_wapp_msg == 0) {
                            $response = $this->sms_model->send_whatsapp_user($customer->phone, $content, $company);
                            
                        }
                        
                        if (settings()->global_wapp_msg == 1) {
                            $response = $this->sms_model->send_whatsapp_user($customer->phone, $message, 'settings');
                        }
                        
                        
                         $subject = trans('booking-confirmation').' - '.$company->name;
                        $content = trans('event-booking-confirmation').' - '.$event->name.' '.trans('has-been-successfully-confirmed').' '.$event->date;

                        $edata = array();
                        $edata['subject'] = $subject;
                        $edata['message'] = $msg;

                        $message = $this->load->view('email_template/appointment', $edata, true);
                        $this->email_model->send_email($customer->email, $subject, $content);
                        
                    }
                    
                }

                redirect(base_url('admin/events/booking'));

            }

        } 
        
    }

    public function edit_booking($id){  

        $booking = $this->admin_model->get_by_id($id,'event_booking');
        $event = $this->admin_model->get_by_id($booking->event_id,'events');

        $data = array();
        $data['page_title'] = 'Edit Booking';   
        $data['page'] = 'Event';   
        $data['booking'] = $this->admin_model->select_option($id, 'event_booking');
        $data['tickets'] = $this->event_model->get_tickets_by_event($event->id);
        $data['venues'] = $this->admin_model->select_by_user('event_venue');
        $data['events'] = $this->admin_model->select_by_user('events');
        $data['customers'] = $this->admin_model->get_customers();
        $data['main_content'] = $this->load->view('admin/events/bookings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function status_update($status, $id) {
        $data = array(
            'status' => $status
        );
        $this->admin_model->update($data, $id, 'event_booking');

        if($status == 1){
            $status_text = trans('confirmed');
        }

        if($status == 2){
            $status_text = trans('cancelled');
        }


        if ($status == 1 || $status == 2) {

            $booking = $this->admin_model->get_by_id($id, 'event_booking');
            $company = $this->admin_model->get_business($this->business->uid);
            $customer = $this->admin_model->get_by_id($booking->customer_id, 'customers');
            $event = $this->admin_model->get_by_id($booking->event_id, 'events');


            //notify customer
            $subject = trans('booking').' - '.$status_text;
            $customer_msg = trans('dear').' '.$customer->name.', '.trans('thank-you-for-your-booking-at-our').' '.$company->name.', 
        '.$event->name.' '.trans('at').' '.my_date_show($event->date).' '.trans('at').' '.$event->time.' '.trans('is').' '.$status_text;

            $edata = array();
            $edata['subject'] = $subject;
            $edata['message'] = $customer_msg;

            $message = $this->load->view('email_template/appointment', $edata, true);
            $this->email_model->send_email($customer->email, $subject, $message);


            
            //notify user
            $edata = array();
            $edata['subject'] = $subject;
            $edata['message'] = $message;

            $message = $this->load->view('email_template/appointment', $edata, true);
            $this->email_model->send_email(user()->email, $subject, $message);

            // send sms to customer
            if (user()->enable_sms_notify == 1) {
                $this->load->model('sms_model');
                $response = $this->sms_model->send_user($customer->phone, $customer_msg, user()->id);
            }
        }



        
        echo json_encode(array('st' => 1));
    }



    public function delete_booking($id)
    {
        $this->admin_model->delete($id,'event_booking'); 
        echo json_encode(array('st' => 1));
    }

   

}
	

