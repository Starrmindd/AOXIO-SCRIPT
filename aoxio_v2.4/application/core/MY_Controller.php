<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings();
        $this->settings = $global_data['settings'];

        $global_data['selected_lang'] = $this->settings->lang;
        $this->selected_lang = $global_data['selected_lang'];
        $this->lang->load('website', $global_data['settings']->lang_slug);

        $active_business = $this->session->userdata('active_business');
        if (empty($active_business)) {
            $global_data['business'] = $this->admin_model->get_business(0);
        } else {
            $global_data['business'] = $this->admin_model->get_business($active_business);
        }
        $this->business = $global_data['business'];
        $this->load->vars($global_data);
        $this->db->query("SET sql_mode=''");

        if (settings()->version == '1.8') {
            $data = array(
                'version' => '1.9'
            );
            $this->admin_model->edit_option($data, 1, 'settings');
        }
    }

}


class Home_Controller extends MY_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings();
        $this->settings = $global_data['settings'];

        if (get_lang() == '') {
            $this->lang->load('website', $this->settings->lang_slug);
        }else{
            $this->lang->load('website', get_lang());
        }
        $this->load->vars($global_data);

        $this->remember_me();
    }

    //verify recaptcha
    public function recaptcha_verify_request()
    {
        if ($this->settings->enable_captcha == 0) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                $this->session->set_userdata('captcha_submit', 'true');
                return true;
            }
        }

        if (!empty($this->session->userdata('captcha_submit')) && $this->session->userdata('captcha_submit') == 'true') {
            return true;
        }

        return false;
    }

    public function remember_me(){
        $this->load->helper('cookie');
        $auto_login_cookie = $this->input->cookie('remember_me_token');
        $user = $this->admin_model->get_user_by_remember_token($auto_login_cookie);
        if (!empty($user) && !empty($auto_login_cookie)) {

            if ($user->role == 'user') {
                $parent_id = 0;
            }elseif ($user->role == 'staff') {
                $parent_id = $user->user_id;
            }elseif ($user->role == 'customer') {
                $parent_id = 0;
            }else{
                $parent_id = 0;
            }

            $data = array(
                'id' => $user->id,
                'name' => $user->name,
                'slug' => $user->slug,
                'thumb' => $user->thumb,
                'email' =>$user->email,
                'role' =>$user->role,
                'parent' =>$parent_id,
                'logged_in' => TRUE
            );
            $data = $this->security->xss_clean($data);
            $this->session->set_userdata($data);
        }
    }

}