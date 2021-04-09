<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
 *  @author   : Creativeitem
 *  date    : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Login extends CI_Controller {

      function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
         
      }

     //Default function, redirects to logged in user area
      public function index() {
        // $this->session->set_userdata('admin_login', '1');
        // $this->session->set_userdata('admin_id', 'pramod@cyberworx.in');
        // $this->session->set_userdata('login_user_id', '1');
        // $this->session->set_userdata('name', 'Pramod Lamba');
        // $this->session->set_userdata('login_type', 'admin');

        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(site_url('teacher/dashboard'), 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(site_url('student/dashboard'), 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(site_url('parents/dashboard'), 'refresh');

        if ($this->session->userdata('librarian_login') == 1)
            redirect(site_url('librarian/dashboard'), 'refresh');

        if ($this->session->userdata('accountant_login') == 1)
            redirect(site_url('accountant/dashboard'), 'refresh');

        if ($this->session->userdata('pre_student_login') == 1)
           redirect(site_url('pre_student/dashboard'), 'refresh');

          $this->load->view('backend/login');
     }

    //Validating login from ajax request
    function validate_login() {
      $email        = $this->input->post('email');
      $password     = $this->input->post('password');
      $credential   = array('email' => $email, 'password' => sha1($password));
      $credentialss = array('email' => $email, 'password' => sha1($password),'islogin'=>1);
      // Checking login credential for admin
      $query = $this->db->get_where('admin', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('admin_login', '1');
          $this->session->set_userdata('admin_id', $row->admin_id);
          $this->session->set_userdata('login_user_id', $row->admin_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('email', $row->email);
          $this->session->set_userdata('admin_pass', $row->admin_pass);
          $this->session->set_userdata('login_type', 'admin');
          $this->session->set_userdata('role_id', '1');
          create_log('Has been logged in');
          redirect(site_url('admin/dashboard'), 'refresh');
      }

      // Checking login credential for teacher
    //   $query = $this->db->get_where('teacher', $credential);
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       $this->session->set_userdata('teacher_login', '1');
    //       $this->session->set_userdata('teacher_id', $row->teacher_id);
    //       $this->session->set_userdata('login_user_id', $row->teacher_id);
    //       $this->session->set_userdata('name', $row->name);
    //         $this->session->set_userdata('email', $row->email);
    //       $this->session->set_userdata('login_type', 'teacher');
    //       $this->session->set_userdata('role_id', '5');
    //       create_log('Has been logged in');
    //       redirect(site_url('teacher/dashboard'), 'refresh');
    //   }

      // Checking login credential for student
      $query = $this->db->get_where('student', $credential+['status'=>1]);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('student_login', '1');
          $this->session->set_userdata('student_id', $row->student_id);
          $this->session->set_userdata('login_user_id', $row->student_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'student');
          $this->session->set_userdata('role_id', '4');
          create_log('Has been logged in');
          redirect(site_url('student/dashboard'), 'refresh');
      }
      // Checking login credential for student
    //   $query = $this->db->get_where('inventory_manager', $credential);
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       $this->session->set_userdata('inventory_login', '1');
    //       $this->session->set_userdata('inventory_id', $row->inventory_manager_id);
    //       $this->session->set_userdata('login_user_id', $row->inventory_manager_id);
    //       $this->session->set_userdata('name', $row->name);
    //       $this->session->set_userdata('login_type', 'inventory_manager');
    //       $this->session->set_userdata('role_id', '17');
    //       create_log('Has been logged in');
    //       redirect(site_url('admin/dashboard'), 'refresh');
    //   }
    //   $query = $this->db->get_where('transport_manager', $credential);
    //   //print_r($query);die;
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       //print_r($row);die;
    //       $this->session->set_userdata('transport_login', '1');
    //       $this->session->set_userdata('transport_id', $row->transport_id);
    //       $this->session->set_userdata('login_user_id', $row->transport_id);
    //       $this->session->set_userdata('name', $row->name);
    //       $this->session->set_userdata('login_type', 'transport_manager');
    //       $this->session->set_userdata('transport_manager_id', $row->transport_id);
    //       $this->session->set_userdata('designation_users_login', '1');
    //       $this->session->set_userdata('role_id', '18');
    //       create_log('Has been logged in');
    //       redirect(site_url('designation_users/dashboard'), 'refresh');
    //   }

      // Checking login credential for parent
      $query = $this->db->get_where('parent', $credential);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $this->session->set_userdata('parent_login', '1');
          $this->session->set_userdata('parent_id', $row->parent_id);
          $this->session->set_userdata('login_user_id', $row->parent_id);
          $this->session->set_userdata('name', $row->name);
          $this->session->set_userdata('login_type', 'parent');
		      $this->session->set_userdata('role_id', '8');
          create_log('Has been logged in');
          redirect(site_url('parents/dashboard'), 'refresh');
      }

      // Checking login credential for librarian
    //   $query = $this->db->get_where('librarian', $credential);
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       $this->session->set_userdata('librarian_login', '1');
    //       $this->session->set_userdata('librarian_id', $row->librarian_id);
    //       $this->session->set_userdata('login_user_id', $row->librarian_id);
    //       $this->session->set_userdata('name', $row->name);
    //       $this->session->set_userdata('login_type', 'librarian');
		  //    $this->session->set_userdata('role_id', '7');
    //       create_log('Has been logged in');
    //       redirect(site_url('librarian/dashboard'), 'refresh');
    //   }

      // Checking login credential for accountant
    //   $query = $this->db->get_where('accountant', $credential);
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       $this->session->set_userdata('accountant_login', '1');
    //       $this->session->set_userdata('accountant_id', $row->accountant_id);
    //       $this->session->set_userdata('login_user_id', $row->accountant_id);
    //       $this->session->set_userdata('name', $row->name);
    //       $this->session->set_userdata('login_type', 'accountant');
		  //    $this->session->set_userdata('role_id', '6');
    //       create_log('Has been logged in');
    //       redirect(site_url('accountant/dashboard'), 'refresh');
    //   }

    //   // Checking login credential for pre student
    //   $query = $this->db->get_where('pre_student', $credentialss);
    //   if ($query->num_rows() > 0) {
    //       $row = $query->row();
    //       $this->session->set_userdata('pre_student_login', '1');
    //       $this->session->set_userdata('pre_student_id', $row->pre_student_id);
    //       $this->session->set_userdata('login_user_id', $row->pre_student_id);
    //       $this->session->set_userdata('name', $row->name);
    //       $this->session->set_userdata('login_type', 'pre_student');
    //       $this->session->set_userdata('role_id', '10');
    //       create_log('Has been logged in');
    //       redirect(site_url('pre_student/dashboard'), 'refresh');
    //   }
        
      // Checking login credential for pre student
      $query = $this->db->get_where('designation_users', $credential+['role_id !='=>'9']);
      if ($query->num_rows() > 0) {
          $row = $query->row();
          $employee = $this->db->get_where('employees', array('user_id' => $row->designation_users_id))->row();  

          $this->session->set_userdata('designation_users_login', '1');
          $this->session->set_userdata('designation_users_id', $row->designation_users_id);
          $this->session->set_userdata('login_user_id', $row->designation_users_id);
          $this->session->set_userdata('name', $employee->name);
          $this->session->set_userdata('login_type', lcfirst($this->db->get_where('designations',['id' => $employee->designation_id])->row()->name));
          $this->session->set_userdata('role_id', $row->role_id);
          create_log('Has been logged in');
          redirect(site_url('designation_users/dashboard'), 'refresh');
      }

      $this->session->set_flashdata('login_error', get_phrase('invalid_login'));
      redirect(site_url('login'), 'refresh');
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function reset_password()
    {
        $email = $this->input->post('email');
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
        // Checking credential for teacher
        // $query = $this->db->get_where('teacher' , array('email' => $email));
        // if ($query->num_rows() > 0)
        // {
        //     $reset_account_type     =   'teacher';
        //     $this->db->where('email' , $email);
        //     $this->db->update('teacher' , array('password' => sha1($new_password)));
        //     // send new password to user email
        //     $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
        //     $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
        //     redirect(site_url('login/forgot_password'), 'refresh');
        // }
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
        $query = $this->db->get_where('designation_users', array('email' => $email));
          if ($query->num_rows() > 0) {
              $designation = lcfirst($this->db->get_where('designations',['id' => $employee->designation_id])->row()->name);
              $reset_account_type     =   $designation;
            $this->db->where('email' , $email);
            $this->db->update('designation_users' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
          }
        $this->session->set_flashdata('reset_error', get_phrase('password_reset_was_failed'));
        redirect(site_url('login/forgot_password'), 'refresh');
        // Checking credential for librarian
        $query = $this->db->get_where('librarian' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'librarian';
            $this->db->where('email' , $email);
            $this->db->update('librarian' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
        // Checking credential for accountant
        $query = $this->db->get_where('accountant' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'accountant';
            $this->db->where('email' , $email);
            $this->db->update('accountant' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            $this->session->set_flashdata('reset_success', get_phrase('please_check_your_email_for_new_password'));
            redirect(site_url('login/forgot_password'), 'refresh');
        }
        $this->session->set_flashdata('reset_error', get_phrase('password_reset_was_failed'));
        redirect(site_url('login/forgot_password'), 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout(){
       if($this->session->userdata('login_user_id') == "" ){
          redirect(base_url(), 'refresh'); 
        }

        create_log('Has been logged out');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'login', 'refresh');
       
    }

}
