<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

      function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->helper('form');
        $this->load->helper('url');
      }

      public function index() {
		  
        if ($this->session->userdata('admin_user') == 1)
            redirect(site_url('home'), 'refresh');
        if ($this->session->userdata('sub_user') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
               
		 $this->load->view('login');
     }

    function user_login() {
       $email        = $this->input->post('email');
       $password     = $this->input->post('password'); 
      $details = array('user_email' => $email, 'user_password' => md5($password),'user_status'=>1);
       $query = $this->db->get_where('user_login', $details);
	
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('user_id', $row->user_id); 
          $this->session->set_userdata('name', $row->user_name);
          $this->session->set_userdata('email', $row->user_email);        
          $this->session->set_userdata('user_type', 'Super Admin');
		 
		  if($row->user_role==1){
		 $this->session->set_userdata('admin_user', '1');
          $this->session->set_userdata('role_id', '1');
		  }else {		  
			$this->session->set_userdata('sub_user', '1');
			 $this->session->set_userdata('role_id', '2');  
		    }
       echo 'Login';   
       redirect(base_url('home'), 'refresh');
		
      }
  redirect(base_url('login'), 'refresh');

    }

 

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    function forgot_password()
    {
        $this->load->view('forgot_password');
    }

    function reset_password()
    {
        $email = $this->input->post('email');
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('user_login' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'Super admin';
            $this->db->where('user_email' , $email);
            $this->db->update('user_login' , array('user_password' => md5($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
     
        $this->session->set_flashdata('reset_error', get_phrase('password_reset_was_failed'));
        redirect(site_url('login/forgot_password'), 'refresh');
     
    }



    function logout(){
  
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url('login'), 'refresh'); 
       
    }

}
