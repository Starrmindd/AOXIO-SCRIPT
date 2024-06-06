<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    //expire payments
    public function expire_payments()
    {   

        $this->recurring_services();
        $payments = $this->common_model->get_expire_payments();
        foreach ($payments as $payment) {
            $data = array(
                'status' => 'expire'
            );
            $data = $this->security->xss_clean($data);
            if ($payment->billing_type != 'lifetime') {
                $this->common_model->update($data, $payment->id, 'payment');
            }
        }

        //check trial expire users
        $trial_users = $this->common_model->get_trial_users();
        foreach ($trial_users as $user) {
            $user_data = array(
                'status' => 1,
                'user_type' => 'registered',
                'trial_expire' => '1971-01-01'
            );
            $user_data = $this->security->xss_clean($user_data);
            $this->common_model->update($user_data, $user->id, 'users');
        }

        if (isset(settings()->reminder_before)) {
            $reminder_before = settings()->reminder_before;
        } else {
            $reminder_before = 1;
        }

        $appointments = $this->common_model->today_appointments($reminder_before);

        if (!empty($appointments)) {
            $company = $this->common_model->get_by_uid($appointments[0]->business_id, 'business');

            foreach ($appointments as $appointment) {
                $subject = trans('appointment-reminder').' - '.settings()->site_name;
                $content = trans('you-have-an-appointment').' '.$company->name.' - '.$appointment->service_name.' '.trans('at').' '.my_date_show($appointment->date).' '.$appointment->time.'<br>'.trans('booking-number').': #'.$appointment->number;;

                $edata = array();
                $edata['subject'] = $subject;
                $edata['message'] = $content;

                $message = $this->load->view('email_template/appointment', $edata, true);
                if (!empty($appointment->customer_email)) {
                    $this->email_model->send_email($appointment->customer_email, $subject, $message);
                }

                if (!empty($appointment->customer_phone)) {
                    $this->load->model('sms_model');
                    $response = $this->sms_model->send_cron($appointment->customer_phone, $content, $appointment->user_id);
                }
            }
        }
        
    }





    public function recurring_services()
    {  
        
        $recurr_services = $this->admin_model->get_recurr_service_by_date();
        if(!empty($recurr_services)){
            foreach ($recurr_services as $value) {
                unset($value->id);
                $this->db->insert('appointments', $value);
                $recurr_row_id = $this->db->insert_id();

                $service_repeat = get_by_id($value->service_id,'services')->service_repeat;
                $service_number = get_by_id($value->service_id,'services')->number_of_service;
                $date = new DateTime($value->next_recur_date);
                $date->modify('+'.$service_repeat.'day');
                $next_date = $date->format('Y-m-d');

                if(($service_number - 1) == $value->recurring_count){
                    $is_completed = 1;
                }else{
                    $is_completed = 0;;
                }

                $data = array(
                    'date' => $next_date,
                    'next_recur_date' => $next_date,
                    'recurring_count' => $value->recurring_count +1,
                    'is_completed' => $is_completed,
                );
                $data = $this->security->xss_clean($data);

                $this->admin_model->edit_option($data, $recurr_row_id, 'appointments');
            }
        }
        
    }


}