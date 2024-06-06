<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Orhanerday\OpenAi\OpenAi;
class Dashboard extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {

        $this->update_site_url();
        
        if (!is_admin()) {
            redirect(base_url());
        }

        $data = array();
        $data['page'] = 'Dashboard';
        $data['page_title'] = 'Dashboard';
        $data['currency'] = settings()->currency_symbol;
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_admin_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => $income);
        }

        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $income_data = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $income_data = str_replace('null', '0', $income_data);
        $data['income_data'] = $income_data;
        $data['net_income'] = $this->admin_model->get_admin_income_by_year();
        $data['upackages'] = $this->admin_model->get_users_packages();
        $data['users'] = $this->admin_model->get_latest_users();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //user dashboard
    public function user()
    { 
        
        //echo "<pre>"; print_r($this->input->cookie('remember_me_token')); exit();
        //echo "<pre>"; print_r($this->session->userdata('id')); exit();

        if (settings()->enable_wallet == 1) {
            $this->update_settings();
        }

        if (settings()->enable_openai == 1 && !empty(settings()->openai_key) && empty($this->business->details) && empty($this->business->keywords)) {
            $this->generate_ai_info();
        }

        $company = $this->admin_model->get_company(user()->id);
        if (empty($company)) {
            redirect(base_url('admin/dashboard/setup'));
        }

        $data = array();
        $data['page'] = 'Dashboard';
        $data['page_title'] = 'User Dashboard';
        if (is_user()) {
            $data['currency'] = $this->business->currency_symbol;
            for ($i = 1; $i <= 13; $i++) {
                $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
            }

            for ($i = 0; $i <= 11; $i++) {
                $income = $this->admin_model->get_user_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
                $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
                $incomes[] = array("total" => $income);
            }
        }

        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $income_data = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $income_data = str_replace('null', '0', $income_data);
        $data['income_data'] = $income_data;
        $data['net_income'] = $this->admin_model->get_user_income_by_year();
        $data['total_net_income'] = get_pres_values();
        $data['appointments'] = $this->admin_model->get_user_appointments(user()->id, 6);
        $data['main_content'] = $this->load->view('admin/user/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function setup()
    {
        if (!is_user()) {
            redirect(base_url());
        }

        $company = $this->admin_model->get_company(user()->id);
        if (!empty($company)) {
            redirect(base_url('admin/settings/company'));
        }

        $data = array();
        $data['page'] = 'Company Settings';
        $data['page_title'] = 'Setup Business';
        $data['categories'] = $this->admin_model->select_order_by_name('categories');
        $data['main_content'] = $this->load->view('admin/user/setup_business', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function update_setup()
    {
        $rand_uid = substr(random_string('numeric', 5).mt_rand(), 0, 12);
        $uid = ltrim($rand_uid, '0');

        $business_category = $this->input->post('category', true);
        
        if ($business_category == 2) {
            $template_style = '3';
        }elseif ($business_category == 6) {
            $template_style = '4';
        }elseif ($business_category == 3) {
            $template_style = '5';
        }elseif ($business_category == 7) {
            $template_style = '2';
        }else{
            $template_style = '2';
        }


        $company_data=array(
            'uid' => $uid,
            'user_id' => user()->id,
            'name' => $this->input->post('company_name', true),
            'email' => user()->email,
            'slug' => str_slug($this->input->post('company_slug', true)),
            'category' => $business_category,
            'details' => $this->input->post('details', true),
            'country' => 1,
            'type' => 1,
            'enable_location' => 0,
            'enable_category' => 0,
            'status' => 1,
            'enable_staff' => 0,
            'template_style' => $template_style,
            'created_at' => my_date_now()
        );
        $company_data = $this->security->xss_clean($company_data);
        $this->common_model->insert($company_data, 'business');

        $active_business = array('active_business' => $uid);
        $this->session->set_userdata($active_business);

        $plan = 'basic';
        $billing = 'monthly';

        $package = $this->common_model->get_by_slug($plan, 'package');
        if ($billing == 'monthly') {
            $price = $package->monthly_price;
            $expire = date('Y-m-d', strtotime('+1 month'));
        }else if($billing == 'lifetime'){
            $price = $package->lifetime_price;
            $expire = date('Y-m-d', strtotime('+824832 day'));
        } else {
            $price = $package->price;
            $expire = date('Y-m-d', strtotime('+12 month'));
        }
        
        $puid = random_string('numeric',5);
        //make payment
        $pay_data=array(
            'user_id' => user()->id,
            'puid' => $puid,
            'package_id' => $package->id,
            'amount' => $price,
            'billing_type' => $billing,
            'status' => 'pending',
            'created_at' => my_date_now(),
            'expire_on' => $expire
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $this->common_model->insert($pay_data, 'payment');


        redirect(base_url('admin/settings/company'));
    }



    //rating
    public function app_info()
    {
        $data = array();
        $data['page_title'] = 'Info';
        $data['main_content'] = $this->load->view('admin/about_info', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //rating
    public function rating()
    {
        $data = array();
        $data['page_title'] = 'Ratings';
        $data['ratings'] = $this->admin_model->get_all_ratings();
        $data['rating'] = $this->admin_model->get_ratings_info();
        $data['report'] = $this->admin_model->get_single_ratings();
        $data['main_content'] = $this->load->view('admin/user/rating_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function rating_update($status)
    {
        $data = array(
            'enable_rating' => $status
        );
        $this->admin_model->edit_option($data, user()->id, 'users');
        echo json_encode(array('st'=>1));
    }

    public function generate_ai_info()
    {

        $open_ai = new OpenAi(settings()->openai_key);
        $category = get_by_id($this->business->category, 'categories')->name;
        $title_prompt = 'Generate a business title for '.$category;
        $details_prompt = 'Generate a business short details on this topic '.$category;

        if (!empty(settings()->openai_key)) {
            
            $model = settings()->openai_model;
            
            $response1 = $open_ai->completion([
                'model'  => $model,
                'prompt' => $title_prompt,
                'max_tokens' => 100,
                'temperature' => 1.0,
                'n' => 1,
                'top_p' => 1
            ]);
            $response1 = json_decode($response1);
            $title = $response1->choices[0]->text;


            $response2 = $open_ai->completion([
                'model'  => $model,
                'prompt' => $details_prompt,
                'max_tokens' => 400,
                'temperature' => 1.0,
                'n' => 1,
                'top_p' => 1
            ]);
            $response2 = json_decode($response2);
            $details = $response2->choices[0]->text;

            $keyaord_prompt = 'Write SEO meta keywords using comma '.$title;
            $response3 = $open_ai->completion([
                'model'  => $model,
                'prompt' => $keyaord_prompt,
                'max_tokens' => 400,
                'temperature' => 1.0,
                'n' => 1,
                'top_p' => 1
            ]);
            $response3 = json_decode($response3);
            $seo_keyword = $response3->choices[0]->text;

            $metadesc_prompt = 'Write seo meta details on this topic '.$title;
            $response4 = $open_ai->completion([
                'model'  => $model,
                'prompt' => $keyaord_prompt,
                'max_tokens' => 500,
                'temperature' => 1.0,
                'n' => 1,
                'top_p' => 1
            ]);
            $response4 = json_decode($response4);
            $seo_desc = $response4->choices[0]->text;
            
            $data = array(
                'title' => $title,
                'details' => $details,
                'keywords' => $seo_keyword,
                'description' => $seo_desc
            );
            $this->admin_model->edit_option($data, $this->business->id, 'business');

        }
    }


    public function update_settings()
    {
        if (settings()->country != $this->business->country) {
            $data = array(
                'country' => settings()->country
            );
            $this->admin_model->edit_option($data,  $this->business->id, 'business');
        }
    }

    public function update_site_url()
    {
        $data = array(
            'site_url' => get_current_domain()
        );
        $this->admin_model->edit_option($data, 1, 'settings');
    }


}