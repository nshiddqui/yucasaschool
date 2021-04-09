<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Student extends MY_Controller
{
    function __construct()
      {
        parent::__construct();
		$this->load->library('session');
        $this->load->model('stripe_model');
        $this->load->model('paypal_model');
        $this->load->model('schedule_Model');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
		$this->load->model('Assignment_Model', 'assignment', true);
        $this->load->model('Type_Model', 'type', true);
        $this->load->model('Pre_exam_modal', 'pre_model', true);
        $this->load->model('Room_Model', 'room', true);
        $this->data['class'] = $this->type->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$running_year = $this->db->get_where('settings' , array('type' => 'running_year'
        ))->row()->description;        
        $academic_year_info = $this->db->get_where('academic_years',array('start_year' => $running_year))->result();    
        $this->academic_year_id = $academic_year_info[0]->id;
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(site_url('student/dashboard'), 'refresh');
    }
	/***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['active_link']  = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    /***ADMIN DASHBOARD***/
    function student_dashboard()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'student_dashboard';
        $page_data['active_link']  = 'student_dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }


    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['active_link']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }


    /***********************************************************************************************************/



    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {

        //echo $this->year;die;
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');

        $student_profile         = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();

         $student_class_id  = @$this->db->get_where('enroll' , array('student_id' => $student_profile->student_id))->row()->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array('class_id'=>$student_class_id,'year' => $this->year))->result_array();
		
        $page_data['page_name']  = 'subject';
        $page_data['active_link']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }



    function student_marksheet($student_id = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

       // if($student_id != $this->session->userdata('student_login')) {
       //     $this->session->set_flashdata('error_message', get_phrase('no_direct_script_access_allowed'));
         //   redirect(site_url('student/dashboard'), 'refresh');
       // }

        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->year
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['active_link']  = 'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll',array('student_id' => $student_id , 'year' => $this->year
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/student/student_marksheet_print_view', $page_data);
    }


    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')
        ))->row();
        
        $studentdetails  = $this->db->get_where('enroll' ,array('student_id' => $student_profile->student_id,
                'year' => $this->db->get_where('settings',array('type' => 'running_year'))->row()->description
        ))->row();
       
        $page_data['class_id']        = $studentdetails->class_id;
        $page_data['section_id']      = $studentdetails->section_id;
        $page_data['student_id']      = $student_profile->student_id;
        $page_data['timetable_data'] = $this->crud_model->substitute_details($page_data['class_id'],$page_data['section_id']);
        $page_data['page_name']       = 'class_routine';
        $page_data['active_link']  = 'class_routine';
        $page_data['page_title']      = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS Timetable******************/
    function class_timetable($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
         redirect(base_url(), 'refresh');

        $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')
        ))->row();
        
        $studentdetails  = $this->db->get_where('enroll' ,array('student_id' => $student_profile->student_id,
                'year' => $this->year))->row();
       
        
        $page_data['class_id']        = $studentdetails->class_id;
        $page_data['section_id']      = $studentdetails->section_id;
        $page_data['student_id']      = $student_profile->student_id;
        $page_data['template_data_result'] = $this->db->get_where('class_routine_template',array('class_id'=>$page_data['class_id'],'section_id'=>$page_data['section_id'],'status'=>1))->row();
        //print_r($page_data['template_data_result']);
        //$page_data['timetable_data'] = $this->crud_model->get_class_timetable_routine($page_data['class_id'],$page_data['section_id']);
          $page_data['template_data_result'] = $this->db->query(" SELECT `id` FROM `class_routine_template` where status=1")->row();
        $page_data['page_name']       = 'class_timetable';
        $page_data['active_link']  = 'class_timetable';
        $page_data['page_title']      = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/admin/class_routine_print_view' , $page_data);
    }

    // ACADEMIC SYLLABUS
    function academic_syllabus($student_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['active_link']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }

    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('student_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();

            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', site_url('invoice/paypal_ipn'));
            $this->paypal->add_field('cancel_return', site_url('invoice/paypal_cancel'));
            $this->paypal->add_field('return', site_url('invoice/paypal_success'));

            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);

                $data2['method']       =   'paypal';
                $data2['invoice_id']   =   $_POST['custom'];
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                $this->db->insert('payment' , $data2);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(site_url('student/invoice/'), 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(site_url('student/invoice/'), 'refresh');
        }
        $student_profile         = $this->db->get_where('student', array('student_id'   => $this->session->userdata('student_id')))->row();
        $student_id              = $student_profile->student_id;
        $page_data['invoices']   = $this->db->get_where('invoices', array('student_id' => $student_id))->result_array();
      // print_r($page_data['invoices']);
        $page_data['page_name']  = 'invoice';
        $page_data['active_link']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }

    function paypal_checkout($student_id = '') {

      if ($this->session->userdata('student_login') != 1)
          redirect('login', 'refresh');

        $invoice_id = $this->input->post('invoice_id');
        $page_data['student_details'] = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $page_data['invoice_details'] = $this->db->get_where('invoice', array(
            'invoice_id' => $invoice_id
        ))->row();
        $this->load->view('backend/paypal_checkout', $page_data);
    }

    function stripe_checkout($student_id = ''){
      if ($this->session->userdata('student_login') != 1)
          redirect('login', 'refresh');

          $invoice_id = $this->input->post('invoice_id');
          $page_data['student_details'] = $this->db->get_where('student', array('student_id' => $student_id))->row();
          $page_data['invoice_details'] = $this->db->get_where('invoice', array(
              'invoice_id' => $invoice_id
          ))->row();
          $this->load->view('backend/stripe_checkout', $page_data);
    }

    function pay($gateway = '', $invoice_id = '') {

      if ($gateway == 'stripe') {
            $student_id = $this->input->post('student_id');
            $payment_success = $this->stripe_model->pay($invoice_id);
            if ($payment_success == true) {
                $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
                redirect(site_url('student/invoice/'.$student_id), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('payment_failed'));
                redirect(site_url('student/invoice/'.$student_id), 'refresh');
            }
        }
        else if ($gateway == 'paypal') {
            $this->paypal_model->pay($invoice_id);
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
        }
    }
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['active_link']  = 'book';
        $page_data['page_title'] = get_phrase('book_list');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        //$page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['transports'] =$this->crud_model->get_transports_data_by_student($this->session->userdata('login_user_id'),'student');
       

       // $page_data['transports'] = $this->vehicle->get_vehicle_list();
        $page_data['page_name']  = 'transport';
        $page_data['active_link']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);

    }

    
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['active_link']  = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);

    }

    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['notices']    = $this->db->get_where('noticeboard',array('status'=>1))->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['active_link']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);

    }

    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name']  = 'manage_document';
        $page_data['active_link']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $max_size = 2097152;
        if ($param1 == 'send_new') {
            // Folder creation
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('student/message/message_new/'), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('student/message/message_read/' . $message_thread_code), 'refresh');

        }

        if ($param1 == 'send_reply') {

            //making folder
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                  redirect(site_url('student/message/message_read/' . $param2), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('student/message/message_read/' . $param2), 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['active_link']  = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    //GROUP MESSAGE
    function group_message($param1 = "group_message_home", $param2 = ""){
      if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh');
      $max_size = 2097152;

      if ($param1 == 'group_message_read') {
        $page_data['current_message_thread_code'] = $param2;
      }
      else if($param1 == 'send_reply'){
        if (!file_exists('uploads/group_messaging_attached_file/')) {
          $oldmask = umask(0);  // helpful when used in linux server
          mkdir ('uploads/group_messaging_attached_file/', 0777);
        }
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          if($_FILES['attached_file_on_messaging']['size'] > $max_size){
            $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
              redirect(site_url('student/group_message/group_message_read/' . $param2), 'refresh');

          }
          else{
            $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
          }
        }

        $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
          redirect(site_url('student/group_message/group_message_read/' . $param2), 'refresh');
      }
      $page_data['message_inner_page_name']   = $param1;
      $page_data['page_name']                 = 'group_message';
      $page_data['active_link']  = 'group_message';
      $page_data['page_title']                = get_phrase('group_messaging');
      $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']     = $this->input->post('name');
            $data['email']    = $this->input->post('email');
            if ($this->input->post('phone') != null) {
                $data['phone']    = $this->input->post('phone');
            }
            if ($this->input->post('address') != null) {
                $data['address']  = $this->input->post('address');
            }
            if ($this->input->post('birthday') != null) {
               $data['birthday'] = $this->input->post('birthday');
            }
            if ($this->input->post('sex') != null) {
                $data['sex']      = $this->input->post('sex');
            }

            $validation = email_validation_for_edit($data['email'], $this->session->userdata('student_id'), 'student');
            if($validation == 1){

                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg');
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('student/manage_profile/'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('student', array(
                'student_id' => $this->session->userdata('student_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('student/manage_profile/'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['active_link']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****************SHOW STUDY MATERIAL / for students of a specific class*******************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('student_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        $data['study_material_info']    = $this->crud_model->select_study_material_info_for_student();
        $data['page_name']              = 'study_material';
        $data['active_link']  = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }

    // MANAGE BOOK REQUESTS
    function book_request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('student_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "create")
        {
            $this->crud_model->create_book_request();
            $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
            redirect(site_url('student/book_request/'), 'refresh');
        }

        $data['page_name']  = 'book_request';
        $data['active_link']  = 'book_request';
        $data['page_title'] = get_phrase('book_request');
        $this->load->view('backend/index', $data);
    }

    function pay_with_payumoney($param1 = "", $param2 = ""){
        $page_data['page_name']  = 'pay_with_payumoney';
        $page_data['active_link']  = 'pay_with_payumoney';
        $page_data['page_title'] = get_phrase('pay_with_payumoney');
        $page_data['student_id'] = $param1;
        $page_data['invoice_id'] = $param2;
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendace(){
      if ($this->session->userdata('student_login') != 1)
      {
        $this->session->set_userdata('last_page', current_url());
        redirect(base_url(), 'refresh');
      }

      $page_data['month']      = date('m');
      $page_data['page_name']  = 'manage_attendace';
      $page_data['active_link']  = 'manage_attendace';
      $page_data['page_title'] = get_phrase('manage_attendace');
      $this->load->view('backend/index', $page_data);
    }

    function attendance_report_selector(){

        $running_year 		            = $this->year;
        $student_name                   = $this->db->get_where('student', array('student_id' => $this->session->userdata('login_user_id')))->row()->name;

        $checker = array(
          'student_id' => $this->session->userdata('login_user_id'),
          'year'       => $this->year
        );

        $month                          = $this->input->post('month');
        $sessional_year                 = $this->input->post('sessional_year');
        $class_id                       = $this->db->get_where('enroll', $checker)->row()->class_id;
        $section_id                     = $this->db->get_where('enroll', $checker)->row()->section_id;
        $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['student_id']        = $this->session->userdata('login_user_id');
        $page_data['page_name']         = 'attendance_report_view';
        $page_data['active_link']  = 'attendance_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of') . ' ' . $student_name;
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_print_view($class_id ='' , $section_id = '' , $month = '', $sessional_year = '', $student_id = '') {
      if ($this->session->userdata('student_login') != 1)
      {
          $this->session->set_userdata('last_page', current_url());
          redirect(base_url(), 'refresh');
      }

     $page_data['class_id']          = $class_id;
     $page_data['section_id']        = $section_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['student_id']        = $student_id;
     $this->load->view('backend/student/attendance_report_print_view' , $page_data);
 }

 function get_teachers() {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'teacher_id',
            1 => 'photo',
            2 => 'name',
            3 => 'email',
            4 => 'phone',
            5 => 'teacher_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_teachers_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $teachers = $this->ajaxload->all_teachers($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $teachers =  $this->ajaxload->teacher_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->teacher_search_count($search);
        }

        $data = array();
        if(!empty($teachers)) {
            foreach ($teachers as $row) {

                $photo = '<img src="'.$this->crud_model->get_image_url('teacher', $row->teacher_id).'" class="img-circle" width="30" />';

                $nestedData['teacher_id'] = $row->teacher_id;
                $nestedData['photo'] = $photo;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['phone'] = $row->phone;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function get_books() {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'book_id',
            1 => 'name',
            2 => 'author',
            3 => 'description',
            4 => 'total_copies',
            5 => 'class',
            6 => 'download',
            7 => 'book_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_books_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $books = $this->ajaxload->all_books($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $books =  $this->ajaxload->book_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->book_search_count($search);
        }

        $data = array();
        if(!empty($books)) {
            foreach ($books as $row) {
                if ($row->file_name == null)
                    $download = '';
                else
                    $download = '<a href="'.site_url("uploads/document/$row->file_name").'" class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>'.get_phrase('download').'</a>';

                $nestedData['book_id'] = $row->book_id;
                $nestedData['name'] = $row->name;
                $nestedData['author'] = $row->author;
                $nestedData['description'] = $row->description;
                $nestedData['total_copies'] = $row->total_copies;
                $nestedData['class'] = $this->db->get_where('class', array('class_id' => $row->class_id))->row()->name;
                $nestedData['download'] = $download;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function online_exam($param1 = '', $param2 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }
        
        $page_data['page_name'] = 'online_exam';
        $page_data['active_link']  = 'online_exam';
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = '', $param2 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'result';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam_result';
        $page_data['active_link']  = 'online_exam_result';
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    function take_online_exam($online_exam_code) {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $student_id = $this->session->userdata('login_user_id');
        // check if the student has already taken the exam
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('online_exam_result')->num_rows();

        $this->crud_model->change_online_exam_status_to_attended_for_student($online_exam_id);

        $status = $this->crud_model->check_availability_for_student($online_exam_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'online_exam_take';
        }
        $page_data['page_title'] = get_phrase('online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info'] = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }

    

    function submit_online_exam($online_exam_id = ""){
         if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');

        $answer_script = array();
        $question_bank = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();

        foreach ($question_bank as $question) {

          $correct_answers  = $this->crud_model->get_correct_answer($question['question_bank_id']);
          $container_2 = array();
          if (isset($_POST[$question['question_bank_id']])) {

              foreach ($this->input->post($question['question_bank_id']) as $row) {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }

          array_push($answer_script, $container);
        }
        $this->crud_model->submit_online_exam($online_exam_id, json_encode($answer_script));
        redirect(site_url('student/online_exam'), 'refresh');
    }

    /*-------------MD-----------*/


   

    /****Student Leave Management*****/
    function student_leave_request($param1 ="",$param2="")
    {

       if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');

       
        $result = $this->db->get_where('student', array('student_id'=>$this->session->userdata('student_id')))->row();
        $student_code = $result->student_code;
        $student_id   = $result->student_id;
        if ($param1 == "create")
        {   
           
            $gen_code          = $this->genrate_uniqid('lve_');
            $data['id_no']     = $student_code;
            $data['request_by']= $student_id;
            $data['uniqid']    = $gen_code;
            $data['role_id']   = $this->session->userdata('role_id');
            $data['type']      = $this->input->post('leave_day');
            $data['from_date'] = $this->input->post('from_leave_date');
            $data['to_date']   = $this->input->post('to_leave_date');
            $data['reason']    = $this->input->post('reason');
            $data['leave_date']= $this->input->post('leave_date');
            $data['year']      = $this->year;
            $notification_msg  = $data['reason'];
            $url               = json_encode(array('teacher/student_leave_record','admin/add_notification','parents/student_leave_requests')); 
            $send_role         = json_encode(array(TEACHER,1,PARENTT));
            if($data['id_no'] != "" && $data['type'] != ""){
               $this->db->insert('leave_request',$data);
               
               $this->add_notification($student_id,STUDENT,$send_to,$send_role,$notification_msg,'Leave Request',$url);

               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('student/student_leaves_report/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               redirect(site_url('student/student_leave_request/'), 'refresh'); 
              }
            }
            
        $page_data['student_code']  =  $student_code;
        $page_data['page_name']     = 'student_leave_request';
        $page_data['active_link']  = 'student_leave_request';
        $page_data['page_title']    = get_phrase('leave_request_form');
        $this->load->view('backend/index', $page_data);
    }

    function student_leaves_report()
    {   
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');

        $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->session->userdata('student_id'),'year'=>$this->year,'role_id' => 4 ))->result();

        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'student_leaves_report';
        $page_data['active_link']  = 'student_leaves_report';
        $page_data['page_title'] = get_phrase('leaves_report');
        $this->load->view('backend/index', $page_data);
    }
    
    function genrate_uniqid($format){

      $code = substr(md5(uniqid(rand(), true)), 0, 7);
      $code_genrate = $format.$code;
      $rowdata = $this->db->get_where('leave_request', array('uniqid'=> $code_genrate))->row();
      if($rowdata != ""){
         $this->genrate_uniqid($format);
      }else{
        return $code_genrate;
      }
    }

    /****Scholarship Admission*****/
    function scholarship_exam_schedule()
    {

        //$page_data['pre_exam_info'] = $this->db->get_where('scholarship_student', array('running_year'=>$this->year,'student_id'=>$this->session->userdata('student_id')))->result();
        $request = $this->schedule_Model->scholarship_examlist_by_student_n_class($this->session->userdata('student_id'));
        $page_data['pre_exam_info'] = $request;
        $page_data['page_name']     = 'scholarship_exam_schedule';
        $page_data['active_link']  = 'scholarship_exam_schedule';
        $page_data['page_title']    = get_phrase('scholarship_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_online($param1 = "")
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $page_data['exams'] = $this->crud_model->available_scholarship_exams($this->session->userdata('student_id'));
        }
    //print_r($page_data['exams']);
        $page_data['page_name']  = 'scholarship_exam_online';
        $page_data['active_link']  = 'scholarship_exam_online';
        $page_data['page_title'] = get_phrase('scholarship_online_exams');
        $this->load->view('backend/index', $page_data);
    }


    /*  scholarship online_exam_result   */
    function scholarship_exam_result($param1 = "")
    {   
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'result';
            $page_data['exams'] = $this->crud_model->available_scholarship_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name']  = 'scholarship_exam_result';
        $page_data['active_link']  = 'scholarship_exam_result';
        $page_data['page_title'] = get_phrase('scholarship_exams_result');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_answer_sheet()
    {
        $page_data['page_name']  = 'scholarship_exam_answer_sheet';
        $page_data['active_link']  = 'scholarship_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Pre Admission*****/
    function pre_admission_exam_schedule()
    {
        $page_data['page_name']  = 'pre_admission_exam_schedule';
        $page_data['active_link']  = 'pre_admission_exam_schedule';
        $page_data['page_title'] = get_phrase('exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_student_registraion()
    {
        $page_data['page_name']  = 'pre_admission_student_registraion';
        $page_data['active_link']  = 'pre_admission_student_registraion';
        $page_data['page_title'] = get_phrase('student_registraion_form');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_admit_card()
    {
        $page_data['page_name']  = 'pre_admission_admit_card';
        $page_data['active_link']  = 'pre_admission_admit_card';
        $page_data['page_title'] = get_phrase('student_admit_card');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_online_exam()
    {
        $page_data['page_name']  = 'pre_admission_online_exam';
        $page_data['active_link']  = 'pre_admission_online_exam';
        $page_data['page_title'] = get_phrase('online_exam');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_result()
    {
        $page_data['page_name']  = 'pre_admission_exam_result';
        $page_data['active_link']  = 'pre_admission_exam_result';
        $page_data['page_title'] = get_phrase('exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_answer_sheet()
    {
        $page_data['page_name']  = 'pre_admission_exam_answer_sheet';
        $page_data['active_link']  = 'pre_admission_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('answer_sheet');
        $this->load->view('backend/index', $page_data);
    }

    /****Student Dormitory *****/
    function student_roomchange_request($param1 = "")
    {

        if($_POST != "" && $param1 != "" && $param1!="create"){
          $student_id            = $this->session->userdata('login_user_id');
          $data['student_id']    = $student_id;
          $data['role_id']       = $this->session->userdata('role_id');
          $data['new_hostel_id'] = $this->input->post('hostel_id');
          $data['new_room_id']   = $this->input->post('room_id');
          $data['year']          = $this->year;
          $data['create_by']     = $this->session->userdata('login_user_id');
          $data['create_at']     = date('Y-m-d H:i:s');
          $this->db->insert('room_change_request',$data);
          $this->session->set_flashdata('flash_message', get_phrase('data_insert_successful'));
          redirect(site_url('student/student_roomchange_request'), 'refresh');
        }
        $page_data['hostel_data']= $this->crud_model->get_hostel_data($param1);
        $page_data['page_name']  = 'student_roomchange_request';
        $page_data['active_link']  = 'student_roomchange_request';
        $page_data['page_title'] = get_phrase('room_change_request');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report()
    {
        $page_data['page_name']  = 'attendance_report';
        $page_data['active_link']  = 'attendance_report';
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }
    function visitors_list()
    {   
        $page_data['visitors']  = $this->crud_model->get_visitor_list_users($this->session->userdata('login_user_id'),$this->session->userdata('role_id'));
        
        $page_data['page_name']  = 'visitors_list';
        $page_data['active_link']  = 'visitors_list';
        $page_data['page_title'] = get_phrase('visitors_list');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Canteen *****/
    function card_recharge()
    {
        $page_data['page_name']  = 'card_recharge';
        $page_data['active_link']  = 'card_recharge';
        $page_data['page_title'] = get_phrase('student_canteen_card_recharge');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Exam *****/
    function exam_schedule()
    {   
        $exam_data = "";
          $studentDetails  = $this->db->get_where('enroll',array('student_id'=>$this->session->userdata('login_user_id'),'year'=>$this->year))->row();
        if($studentDetails->class_id != "")
      $exam_data = $this->db->get_where('exam_schedule',array('status'=>1,'class_id'=>$studentDetails->class_id,'year'=>$this->year))->result();

        $page_data['exam_data']  = $exam_data;
        $page_data['page_name']  = 'exam_schedule';
        $page_data['active_link']  = 'exam_schedule';
        $page_data['page_title'] = get_phrase('student_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }

    function exam_result()
    {   
        $result_data = $this->db->get_where('mark',array('student_id'=>$this->session->userdata('login_user_id'),'year'=>$this->year))->result();
        $page_data['result_data']=  $result_data;
        $page_data['page_name']  = 'exam_result';
        $page_data['active_link']  = 'exam_result';
        $page_data['page_title'] = get_phrase('student_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    
    function exam_answer_sheet()
    {
        $page_data['page_name']  = 'exam_answer_sheet';
        $page_data['active_link']  = 'exam_answer_sheet';
        $page_data['page_title'] = get_phrase('exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Re-Exam *****/
    function re_exam_schedule()
    {   
        $page_data['schedule_data']    = $this->crud_model->get_student_re_exam_list($this->session->userdata('student_id'));
        $page_data['exam_cancel_data'] = $this->crud_model->get_student_cancel_exam_list($this->session->userdata('student_id'));
        $page_data['page_name']        = 're_exam_schedule';
        $page_data['active_link']  = 're_exam_schedule';
        $page_data['page_title']       = get_phrase('student_re_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }

    function re_exam_result()
    {
        $page_data['page_name']  = 're_exam_result';
        $page_data['active_link']  = 're_exam_result';
        $page_data['page_title'] = get_phrase('student_re_exam_result');
        $this->load->view('backend/index', $page_data);
    }

    function re_exam_answer_sheet()
    {
        $page_data['page_name']  = 're_exam_answer_sheet';
        $page_data['active_link']  = 're_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('re_exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }

    /****Student Certificate Management *****/
    function view_all_certificates( )
    {   
        $page_data['all_certificates']  = $this->crud_model->get_all_certificates();
      // print_r($page_data['all_certificates']);
        $page_data['page_name']  = 'view_all_certificates';
        $page_data['active_link']  = 'view_all_certificates';
        $page_data['page_title'] = get_phrase('student_view_all_certificates');
        $this->load->view('backend/index', $page_data);
    }

    function apply_for_certificates($param = "")
    {  
        $studentDetails = $this->db->get_where('student',array('student_id'=>$this->session->userdata('student_id')))->row(); 
       
        if($param == 'create'){
          $data = $this->apply_post_data($studentDetails);
          $this->db->insert('apply_certificates',$data);
          $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
          redirect('student/apply_for_certificates');
        }

        $page_data['page_name']  = 'apply_for_certificates';
        $page_data['active_link']  = 'apply_for_certificates';
        $page_data['page_title'] = get_phrase('student_apply_for_certificates');
        $this->load->view('backend/index', $page_data);
    }

    function apply_post_data($studentDetails){
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } 
        $data['student_id']       = $studentDetails->student_id;
        $data['certificate_type'] = $this->input->post('certificate_type');
        $data['apply_by']         = logged_in_user_id();
        $data['role_id']          = $studentDetails->role_id;
        $data['description']      = $this->input->post('description');
        $data['year']             = $this->year;
       // $data['createdate']       = date('Y-m-d H:i:s');
        return $data;
      
    }


    /* take scholarship exam */
    function take_scholarship_exam($online_exam_code) {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('scholarship_online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $student_id = $this->session->userdata('login_user_id');
        // check if the student has already taken the exam
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('scholarship_online_exam_result')->num_rows();

        $this->crud_model->change_scholarship_exam_status_to_attended_for_student($online_exam_id);

        $status = $this->crud_model->check_availability_for_student_in_scholarship($online_exam_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'scholarship_exam_take';
        }
        $page_data['active_link']  = 'scholarship_exam_take';
        $page_data['page_title']     = get_phrase('scholarship_online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info']      = $this->db->get_where('scholarship_online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }

     /* scholarship exam submit */
    function scholarship_submit_online_exam($online_exam_id = ""){
        $answer_script = array();
        $question_bank = $this->db->get_where('scholarship_question_bank', array('online_exam_id' => $online_exam_id))->result_array();

        foreach ($question_bank as $question) {

          $correct_answers  = $this->crud_model->scholarship_get_correct_answer($question['question_bank_id']);
          $container_2      = array();
          if (isset($_POST[$question['question_bank_id']])) {

              foreach ($this->input->post($question['question_bank_id']) as $row) {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }

          array_push($answer_script, $container);
        }
        $this->crud_model->scholarship_submit_online_exam($online_exam_id, json_encode($answer_script));
        redirect(site_url('student/scholarship_exam_online'), 'refresh');
    }


    function manage_hostel_attendace(){
      if ($this->session->userdata('student_login') != 1)
      {
        $this->session->set_userdata('last_page', current_url());
        redirect(base_url(), 'refresh');
      }

      $page_data['month']      = date('m');
      $page_data['page_name']  = 'manage_hostel_attendace';
      $page_data['active_link']  = 'manage_hostel_attendace';
      $page_data['page_title'] = get_phrase('manage_hostel_attendace');
      $this->load->view('backend/index', $page_data);
    }

    function hostel_attendance_report_selector(){
        echo $this->session->userdata('login_user_id');
       $hostel       = $this->db->get_where('hostel_members', array('user_id'=> $this->session->userdata('login_user_id'),'status'=>1))->row();

       if($hostel == ""){
         $this->session->set_flashdata('flash_message' , get_phrase('hostel_not_assigned'));
         redirect(site_url('student/manage_hostel_attendace'));   
       }

        $running_year                   = $this->year;
        $student_name                   = $this->db->get_where('student', array('student_id' => $this->session->userdata('login_user_id')))->row()->name;

        $checker = array(
          'student_id' => $this->session->userdata('login_user_id'),
          'year'       => $this->year
        );

        $month                          = $this->input->post('month');
        $sessional_year                 = $this->input->post('sessional_year');
        $hostel_id                      = $this->db->get_where('hostel_members', array('user_id'=>$this->session->userdata('login_user_id'),'status'=>1))->row()->hostel_id;
        $hostel                         = $this->db->get_where('hostels', array('id' => $hostel_id))->row();
      
        $page_data['hostel_id']         = $hostel->id;
        $page_data['hostel_name']         = $hostel->name;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['student_id']        = $this->session->userdata('login_user_id');
        $page_data['page_name']         = 'hostel_attendance_report_view';
        $page_data['active_link']  = 'hostel_attendance_report_view';
        $page_data['page_title']        = get_phrase('hostel_attendance_report_view') . ' ' . $hostel->name;
        $this->load->view('backend/index', $page_data);
    }

    function hostel_attendance_report_print_view($hostel_id ='' , $month = '', $sessional_year = '', $student_id = '') {
      if ($this->session->userdata('student_login') != 1)
      {
          $this->session->set_userdata('last_page', current_url());
          redirect(base_url(), 'refresh');
      }

     $page_data['hostel_id']          = $hostel_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['student_id']        = $student_id;
     $this->load->view('backend/student/hostel_attendance_report_print_view' , $page_data);
   }

    function assignment($class_id = null,$student_id = null) {
        
        if(isset($class_id) && !is_numeric($class_id)){
            error($this->lang->line('unexpected_error'));
             redirect('assignment');
        }
        
        $class_id= $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->class_id;
        $section_id= $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->section_id;
        $this->data['assignments'] = $this->assignment->get_assignment_list($class_id,$section_id);
        $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id']    = $class_id;
        $this->data['list']        = TRUE;
        $this->data['student_id']  = $this->session->userdata('student_id');
        $this->data['page_name']   = 'assignment';
        $this->data['active_link']  = 'assignment';
        $this->data['page_title']  = 'Assignment List';
        $this->data['folder']      = 'student';

        $this->load->view('backend/index', $this->data);


    }
	    /*****************Function add_assignment**********************************
    * @type            : Function
    * @function name   : add_assignment
    * @description     : Load "Add new Asignment" user interface                 
    *                    and process to store "Assignment" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add_assignment() {
        //check_permission(ADD);
        if ($_POST) {
            $this->_prepare_assignment_validation();
           
           
            if ($this->form_validation->run() === TRUE) {
             
                $data = $this->_get_posted_assignment_data();
                $insert_id = $this->assignment->insert('submit_assignment', $data);
                if ($insert_id) {
                  create_log('Has been created an assignment : '.$data['title']);   
                  $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                  redirect('student/assignment/'.$data['class_id']);
                } else {
                  error($this->lang->line('insert_failed'));
                  redirect('student/assignment/'.$data['class_id']);
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        
        
    }
    
    /*****************Function _get_posted_assignment_data**********************************
    * @type            : Function
    * @function name   : _get_posted_assignment_data
    * @description     : Prepare "Assignment" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_assignment_data() {
        $items   = array();
        $items[] = 'assignment_id';
        $items[] = 'student_id';
        $items[] = 'class_id';
        $data    = elements($items, $_POST);  
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['student_id'] = logged_in_user_id();
            $data['year'] = $this->year;

        if ($_FILES['assignment']['name']) {
            $data['assignment_file'] = $this->_upload_assignment();
        }
        return $data;
    }
   /*****************Function _prepare_assignment_validation**********************************
    * @type            : Function
    * @function name   : _prepare_assignment_validation
    * @description     : Process "assignment" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_assignment_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

       // $this->form_validation->set_rules('title', $this->lang->line('assignment') . ' ' . $this->lang->line('title'), 'trim|required');
        $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        //$this->form_validation->set_rules('deadline', $this->lang->line('deadline'), 'trim|required');
        //$this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
        $this->form_validation->set_rules('assignment_id', $this->lang->line('assignment'), 'trim|required');
    }
        
    /*****************Function _upload_assignment**********************************
    * @type            : Function
    * @function name   : _upload_assignment
    * @description     : Process upload assignment document into server                  
    *                    and return document name   
    * @param           : $return_assignment string value
    * @return          : null 
    * ********************************************************** */
    private function _upload_assignment() {

        $prev_assignment = $this->input->post('prev_assignment');
        $assignment = $_FILES['assignment']['name'];
        $assignment_type = $_FILES['assignment']['type'];

        //print_r($_FILES); die();
        $return_assignment = '';

        if ($assignment != "") {
            if ($assignment_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    $assignment_type == 'application/msword' || $assignment_type == 'text/plain' ||
                    $assignment_type == 'application/vnd.ms-office' || $assignment_type == 'application/pdf') {

                $destination = 'assets/uploads/assignment_upload/';

                $assignment_type = explode(".", $assignment);
                $extension = strtolower($assignment_type[count($assignment_type) - 1]);
                $assignment_path = 'assignment-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['assignment']['tmp_name'], $destination . $assignment_path);

                // need to unlink previous assignment
                if ($prev_assignment != "") {
                    if (file_exists($destination . $prev_assignment)) {
                        @unlink($destination . $prev_assignment);
                    }
                }

                $return_assignment = $assignment_path;
            }
        } else {
            $return_assignment = $prev_assignment;
        }

        return $return_assignment;
    }

  function rf_id_card_block()
    {
		  if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
		//$page_data['detailss'] = $this->room->get_block_user_list();
	
		$page_data['card_user'] ='';
        $page_data['page_name']  = 'rf_id_card_block';
        $page_data['active_link']  = 'rf_id_card_block';
        $page_data['page_title'] = 'Block RFID Card';
        $this->load->view('backend/index', $page_data);
    }
           function block_rf_id_card(){
	         $data1['card_code_status'] = $this->input->post('card_status');
             $data['apply_by'] = logged_in_user_id();
             $data['card_user'] = logged_in_user_id();
             $data['card_user_role'] = 4;
             $data['card_no'] = $this->input->post('card_code');
			 $data['role_id']= 4; 
          $insert_id = $this->room->insert('block_rfid_card_request', $data); 
   if ($insert_id) {	
	  $updated = $this->room->update('enroll', $data1, array('card_code' => $this->input->post('card_code')));
	 }
	  redirect('student/rf_id_card_block');
}


// function class_timetable($param1 = '', $param2 = '', $param3 = '')
//     {
//         $page_data['page_name']       = 'class_timetable';
//         $page_data['timetable_data']  = $this->crud_model->get_class_timetable_routine($param1,$param2);
//         //$page_data['timetable_data']  ="";
//         $page_data['class_id']        = $param1;
//         $page_data['section_id']      = $param2;
//         $page_data['page_title']      = get_phrase('class_routine');
//         $this->load->view('backend/index', $page_data);
//     }


	
	/***subjects DASHBOARD***/
    function subjects_dashboard()
    {   
        $page_data['page_name']  = 'subjects_dashboard';
        $page_data['active_link']  = 'subjects_dashboard';
        $page_data['page_title'] = get_phrase('Subjects_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***facilities DASHBOARD***/
    function facilities_dashboard()
    {   
        $page_data['page_name']  = 'facilities_dashboard';
        $page_data['active_link']  = 'facilities_dashboard';
        $page_data['page_title'] = get_phrase('Facilities_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Scholarship DASHBOARD***/
    function scholarship_dashboard()
    {   
        $page_data['page_name']  = 'scholarship_dashboard';
        $page_data['active_link']  = 'scholarship_dashboard';
        $page_data['page_title'] = get_phrase('Scholarship_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Exam DASHBOARD***/
    function exam_dashboard()
    {   
        $page_data['page_name']  = 'exam_dashboard';
        $page_data['active_link']  = 'exam_dashboard';
        $page_data['page_title'] = get_phrase('Exam_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	/***Academic DASHBOARD***/
    function academic_dashboard()
    {   
        $page_data['page_name']  = 'academic_dashboard';
        $page_data['active_link']  = 'academic_dashboard';
        $page_data['page_title'] = get_phrase('Academic_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Extra Curricular DASHBOARD***/
    function extra_curricular_dashboard()
    {   
        $page_data['page_name']  = 'extra_curricular_dashboard';
        $page_data['active_link']  = 'extra_curricular_dashboard';
        $page_data['page_title'] = get_phrase('Extra_Curricular_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Message DASHBOARD***/
    function message_dashboard()
    {   
        $page_data['page_name']  = 'message_dashboard';
        $page_data['active_link']  = 'message_dashboard';
        $page_data['page_title'] = get_phrase('Message_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	function notification() {

        $this->data['list']       = TRUE;
        $this->db->select('*');
        $this->db->from('notification_alert');
        //$this->db->where('status',0);$this->session->userdata('role_id')
      $this->db->where('send_to_role',$this->session->userdata('role_id'));
     $this->db->where("(send_to = '".$this->session->userdata('login_user_id')."' OR send_to  IS NULL)");
        $this->db->order_by('id','DESC');
        $notification_data          =  $this->db->get()->result();
        $this->data['notification'] =  $notification_data;
        $this->data['page_name']    = 'notification';
        $this->data['active_link']  = 'notification';
        $this->data['page_title']   = 'Notification';
        $this->data['folder']       = 'student';
        $this->load->view('backend/page', $this->data);
    }

    /***subjects DASHBOARD***/
    function teacher_feedback_list()
    {   
        $page_data['page_name']  = 'teacher_feedback_list';
        $page_data['active_link']  = 'teacher_feedback_list';
        $page_data['page_title'] = get_phrase('teacher_feedback_list');
        $this->load->view('backend/index', $page_data);
    }
    function teacher_feedback_listssss($id) {
     
      
        $this->load->view('backend/index', $page_data);
    }
    /***subjects DASHBOARD***/
    function teacher_feedback($id,$teacher_id)
    {   
	
	    $online_id = $this->db->get_where('teacher_feedback', array('id' => $id))->row()->id;
        $student_id = $this->session->userdata('login_user_id');
 
        $check = array('student_id' => $student_id, 'feedback_id' => $online_id,'teacher_id' => $teacher_id);
        $taken = $this->db->where($check)->get('student_online_feedback_result')->num_rows();

        $this->pre_model->change_teacher_feedback_status_to_attended_for_student($online_id,$teacher_id);

        $status = $this->pre_model->teacher_feedback_for_student($online_id,$teacher_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'teacher_feedback';
        }
        $page_data['active_link']  = 'teacher_feedback';
        $page_data['teacher_id_'] = $teacher_id;
        $page_data['page_title'] = get_phrase('teacher_feedback');
        $page_data['online_exam_id'] = $online_id;
        $page_data['exam_info'] = $this->db->get_where('teacher_feedback', array('id' => $online_id));
	
	
	
        //$page_data['page_name']  = 'teacher_feedback';
       // $page_data['page_title'] = get_phrase('teacher_feedback');
        $this->load->view('backend/index', $page_data);
    }
		
	function student_online_feedback($feedback_id = "",$teacher_id =""){
		
        $any_note      = $this->input->post('any_note');
        $answer_script = array();
        $question_bank = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $feedback_id))->result_array();
       
        foreach ($question_bank as $question) {   
		  $correct_answers  = $this->pre_model->get_feedback_answer($question['question_id']);
          $container_2   = array();
          if (isset($_POST[$question['question_id']])) {

              foreach ($this->input->post($question['question_id']) as $row) {
                $submitted_answer = "";
                    
                array_push($container_2, strtolower($row));
                $submitted_answer = json_encode($container_2);
               
                $container = array(
                    "question_bank_id" => $question['question_id'],
                    "submitted_answer" => $submitted_answer
                );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['feed_back_id'],
                  "submitted_answer" => ""
              );
          }

          array_push($answer_script, $container);
		
        }
        
        $this->pre_model->submit_online_feedback($feedback_id, json_encode($answer_script),$teacher_id);
        redirect(site_url('student/teacher_feedback_list'), 'refresh');
    }


    

    function syllabus_module_info($param = "")
    {   
        $page_data['syllabus_data']              = $this->db->get_where('academic_syllabus',array('academic_syllabus_id'=>$param))->row();
        $page_data['syllabus_module_info_data']  = $this->db->get_where('syllabus_module_info',array('syllabus_id'=>$param,'status'=>1))->result();
        $page_data['syllabus_id']                = $param ;
        $page_data['page_name']                  = 'syllabus_module_info';
        $page_data['active_link']  = 'syllabus_module_info';
        $page_data['page_title']                 = get_phrase('syllabus_module_info');
        $this->load->view('backend/index', $page_data);

    }

}
