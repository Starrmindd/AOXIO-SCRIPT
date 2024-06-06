<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Custom Form';      
        $data['page'] = 'Custom Form';   
        $data['coupon'] = FALSE;
        $data['forms'] = $this->admin_model->select_by_user('custom_form');
        $data['services'] = $this->admin_model->select_by_user('services');
        $data['main_content'] = $this->load->view('admin/user/form',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs

            
            if (empty($this->input->post('is_required'))) {
                $is_required = 0;
            }else {
                $is_required = $this->input->post('is_required');
            }
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'service_id' => $this->input->post('service_id', true),
                'input_type' => $this->input->post('input_type', true),
                'input_title' => $this->input->post('input_title', true),
                'input_name' => str_slug(trim($this->input->post('input_name'))),
                'is_required' => $is_required,
                'status' => $this->input->post('status'),
                //'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);

            if (!empty($id)) {
                $this->admin_model->edit_option($data, $id, 'custom_form');
                $this->session->set_flashdata('msg', trans('updated-successfully')); 
            } else {
                $this->admin_model->insert($data, 'custom_form');
                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
            }

            redirect(base_url('admin/form'));

            
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['form'] = $this->admin_model->select_option($id, 'custom_form');
        $data['services'] = $this->admin_model->select_by_user('services');
        $data['main_content'] = $this->load->view('admin/user/form',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'custom_form'); 
        echo json_encode(array('st' => 1));
    }



}
	

