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

class Parents extends MY_Controller
{
   function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model('stripe_model');
        $this->load->model('paypal_model');
		$this->load->model('Guardian_Model', 'guardian', true);
		$this->load->model('Employee_Model', 'employee', true);
		$this->load->model('Event_Model', 'event', true);
		$this->load->model('Parents_Model', 'parents', true);
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
		$this->load->model('Assignment_Model', 'assignment', true);
		$this->load->model('Assignment_Individual_Model', 'assignment_individual', true);
        $this->load->model('Type_Model', 'type', true);
		  $this->load->model('customers_model', 'customers');
      
        $this->data['class'] = $this->type->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		  $running_year = $this->db->get_where('settings' , array('type' => 'running_year'
        ))->row()->description;

        // $ry = explode('-', $running_year);
        
        $academic_year_info = $this->db->get_where('academic_years',array('start_year' => $running_year))->result();
    
        $this->academic_year_id = $academic_year_info[0]->id;
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(site_url('parents/dashboard'), 'refresh');
    }

	
	
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('parent_dashboard');
        $this->load->view('backend/index', $page_data);
    }


    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }


    // ACADEMIC SYLLABUS
    function academic_syllabus($student_id ='')
    {
       if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
    
          $page_data['page_name']  = 'academic_syllabus';
		
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



    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
if($param1 ==''){
          $page_data['subjects']   = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
      }else{
          
     $page_data['subjects']   = $this->db->query("SELECT * FROM subject LEFT JOIN assign_subject ON subject.subject_id=assign_subject.subject_id where subject.class_id=$param1 AND subject.year='$this->year'")->result_array();
      }  
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }



    /****MANAGE EXAM MARKS*****/
    function marks($param1 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $children_ids       = array();
        $children_of_parent = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
        foreach($children_of_parent as $row)
            array_push($children_ids, $row['student_id']);

        if(!in_array($param1, $children_ids)) {
            $this->session->set_flashdata('error_message', get_phrase('no_direct_script_access_allowed'));
            redirect(site_url('parents/dashboard'), 'refresh');
        }

        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_marks');
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/parent/student_marksheet_print_view', $page_data);
    }


    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        
         $studentdetails = $this->db->get_where('enroll' ,array('student_id' => $param1,
                'year' => $this->year))->row();


         // echo "<pre>";
         //   print_r($studentdetails);
         // echo "</pre>";
        $page_data['class_id']        = $studentdetails->class_id;
        $page_data['section_id']      = $studentdetails->section_id;
        $page_data['student_id']      = $studentdetails->student_id;
        $page_data['template_data_result'] = $this->db->get_where('class_routine_template',array('class_id'=>$page_data['class_id'],'section_id'=>$page_data['section_id'],'status'=>1))->row();
       


       
        // $page_data['class_id']        = $studentdetails->class_id;
        // $page_data['section_id']      = $studentdetails->section_id;
        // $page_data['substitute_list'] =  $this->crud_model->substitute_details($page_data['class_id'],$page_data['section_id']);
        $page_data['student_idd'] = $param1;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/teacher/class_routine_print_view' , $page_data);
    }

    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($student_id = '' , $param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('parent_login')!=1)redirect(base_url() , 'refresh');
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
            $this->paypal->add_field('notify_url', site_url('parents/invoice/paypal_ipn'));
            $this->paypal->add_field('cancel_return', site_url('parents/invoice/paypal_cancel'));
            $this->paypal->add_field('return', site_url('parents/invoice/paypal_success'));

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
            redirect(site_url('parents/invoice/'. $student_id), 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(site_url('parents/invoice/'. $student_id), 'refresh');
        }
        $parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->row();
        $page_data['student_id'] = $student_id;
        $page_data['page_name']  = 'invoice';
        $page_data['customAccount'] = true;
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }
    
    
    public function staff() {

        //check_permission(VIEW);
       // die;
        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name'] = 'index_staff';
		$this->data['page_title'] = 'Employees';
        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_employee') . ' | ' . SMS);
        $this->load->view('backend/index', $this->data);     

    }
    
/****MANAGE STUDENTS CLASSWISE*****/

	function student_information($class_id = '')
	{
		

		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
		$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
    function paypal_checkout($student_id = '') {
      if ($this->session->userdata('parent_login') != 1)
          redirect('login', 'refresh');

        $invoice_id = $this->input->post('invoice_id');
        $page_data['student_details'] = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $page_data['invoice_details'] = $this->db->get_where('invoice', array(
            'invoice_id' => $invoice_id
        ))->row();
        $this->load->view('backend/paypal_checkout', $page_data);
    }
    function stripe_checkout($student_id = ''){
      if ($this->session->userdata('parent_login') != 1)
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
                redirect(site_url('parents/invoice/'. $student_id), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('payment_failed'));
                redirect(site_url('parents/invoice/'. $student_id), 'refresh');
            }
        }
        else if ($gateway == 'paypal') {
            $this->paypal_model->pay($invoice_id);
            $this->session->set_flashdata('flash_message', get_phrase('package_changed_successfully'));
        }
      $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
    }
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');


        $page_data['transports'] =$this->crud_model->get_transports_data_by_student($this->session->userdata('login_user_id'));
      
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);

    }


    public function event() {
    
            //check_permission(VIEW);
    
            $this->data['events'] = $this->event->get_event_list();
            $this->data['roles'] = $this->event->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
            $this->data['list'] = TRUE;
    		$this->data['page_name'] = 'index_parent';
    		$this->data['page_title'] = 'Events';
    		$this->data['folder'] = 'parent';
            $this->layout->title($this->lang->line('manage_event') . ' | ' . SMS);
            $this->load->view('backend/index', $this->data);
        }


    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['notices']    = $this->db->get_where('noticeboard',array('status'=>1))->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);

    }

    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $max_size = 2097152;
       if ($param1 == 'send_new') {
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('parents/message/message_new'), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('parents/message/message_read/' . $message_thread_code), 'refresh');
        }

        if ($param1 == 'send_reply') {

            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('parents/message/message_read/' . $param2), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('parents/message/message_read/' . $param2), 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }
	  

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    //GROUP MESSAGE
    function group_message($param1 = "group_message_home", $param2 = ""){
      if ($this->session->userdata('parent_login') != 1)
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
              redirect(site_url('parents/group_message/group_message_read/'. $param2), 'refresh');
          }
          else{
            $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
          }
        }

        $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
          redirect(site_url('parents/group_message/group_message_read/'. $param2), 'refresh');
      }

      $page_data['message_inner_page_name']   = $param1;
      $page_data['page_name']                 = 'group_message';
      $page_data['page_title']                = get_phrase('group_messaging');
      $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            $validation = email_validation_for_edit($data['email'], $this->session->userdata('parent_id'), 'parent');
            if ($validation == 1) {
                $this->db->where('parent_id', $this->session->userdata('parent_id'));
                $this->db->update('parent', $data);
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('parents/manage_profile/'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('parent', array(
                'parent_id' => $this->session->userdata('parent_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('parent_id', $this->session->userdata('parent_id'));
                $this->db->update('parent', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('parents/manage_profile/'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function pay_with_payumoney($param1 = "", $param2 = ""){
        $page_data['page_name']  = 'pay_with_payumoney';
        $page_data['page_title'] = get_phrase('pay_with_payumoney');
        $page_data['student_id'] = $param1;
        $page_data['invoice_id'] = $param2;
        $this->load->view('backend/index', $page_data);
    }

    // Attendance report view
  function attendance_report($student_id = ""){
    if ($student_id != "") {
      $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $page_data['student_id']        = $student_id;
    }else{
         $page_data['student_id'] = $this->input->post('student_id');
       }
      $page_data['customAccount'] = true;
      $page_data['student_id']        = $student_id;
      $page_data['month']             = date('m');
      $page_data['page_name']         = 'attendance_report';
      $page_data['page_title']        = get_phrase('attendance_report_of_') . ' ' . $student_name . ' : ';
      $this->load->view('backend/index', $page_data);
    }
    

  function attendance_report_selector($student_id = "")
  {
      if($student_id ==''){
          $student_id = $this->input->post('student_id');
   
      }
       if($student_id != ""){
        $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $sessional_year_array = explode("-", $running_year);
         $sessional_year = $sessional_year_array[0];
        
        $array = array(
          'student_id' => $student_id,
          'year'       => $running_year
        );
        $class_id               = $this->db->get_where('enroll', $array)->row()->class_id;
        $section_id             = $this->db->get_where('enroll', $array)->row()->section_id;
        $data['class_id']       = $class_id;
        $data['section_id']     = $section_id;
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        $data['student_id']     = $student_id;
        //print_r($data);
        redirect(site_url('parents/attendance_report_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['sessional_year'] .'/'.$data['student_id']), 'refresh');
      }
  }
  function attendance_report_view($class_id = '', $section_id = '', $month = '', $sessional_year = '', $student_id = '')
  {
      if($this->session->userdata('parent_login')!=1)
         redirect(base_url() , 'refresh');
     $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
     $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
     $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
     $page_data['student_id']        = $student_id;
     $page_data['class_id']          = $class_id;
     $page_data['section_id']        = $section_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['customAccount']    = true;
     $page_data['page_name']         = 'attendance_report_view';
     $page_data['page_title']        = get_phrase('attendance_report_of') . ' '.$student_name;
     $this->load->view('backend/index', $page_data);
  }
  function attendance_report_print_view($class_id ='' , $section_id = '' , $month = '', $sessional_year = '', $student_id = '') {
       if ($this->session->userdata('parent_login') != 1)
         redirect(base_url(), 'refresh');

     $page_data['class_id']          = $class_id;
     $page_data['section_id']        = $section_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['student_id']        = $student_id;
     $this->load->view('backend/parent/attendance_report_print_view' , $page_data);
 }

    function get_teachers() {
        if ($this->session->userdata('parent_login') != 1)
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
                $nestedData['subject'] = $row->name;
                
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
        if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'book_id',
            1 => 'name',
            2 => 'author',
            3 => 'description',
            4 => 'price',
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
                $nestedData['price'] = $row->price;
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

    /*-------------MD-----------*/

    /****Leave Management*****/
    function student_leave_requests($param1 ="",$param2="")
    {
		
	 if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');

       
        $result = $this->db->get_where('parent', array('parent_id'=>$this->session->userdata('parent_id')))->row();
     
        $parent_id   = $result->parent_id;
	
        if ($param1 == "create")
        {   
           
            $gen_code          = $this->genrate_uniqid('lve_');
            $data['id_no']     = $this->input->post('student_code');
            $data['request_by']= $parent_id;
            $data['uniqid']    = $gen_code;
            $data['role_id']   = $this->session->userdata('role_id');
            $data['type']      = $this->input->post('leave_day');
            echo $this->input->post('role_id'); 
            $data['from_date'] = $this->input->post('from_leave_date');
            $data['to_date']   = $this->input->post('to_leave_date');
            $data['reason']    = $this->input->post('reason');
            $data['leave_date']= $this->input->post('leave_date');
            $data['year']      = $this->year;
             $notification_msg  = $data['reason'];
            $url               = json_encode(array('teacher/student_leave_record','admin/add_notification','student/student_leave_report')); 
            $send_role         = json_encode(array(TEACHER,1,STUDENT));
            if($data['id_no'] != "" && $data['type'] != ""){
               $this->db->insert('leave_request',$data);
			   //$this->add_notification($teacher_id,PARENTT,1,$send_role,$notification_msg,'Leave Request',$url);
               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('parents/student_leaves_past_record/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               redirect(site_url('parents/student_leave_requests/'), 'refresh'); 
              }
            }
		
		
        $page_data['page_name']  = 'student_leave_requests';
        $page_data['page_title'] = get_phrase('leave_request_form');
        $this->load->view('backend/index', $page_data);
    }
    function student_leaves_past_recordss()
    {
        $page_data['page_name']  = 'student_leaves_past_record';
        $page_data['page_title'] = get_phrase('student_leaves_past_record');
        $this->load->view('backend/index', $page_data);
    }
	
	
	    function student_leaves_past_record()
    {   
        if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');

        $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->session->userdata('parent_id'),'year'=>$this->year,'role_id' => 8 ))->result();

        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'student_leaves_past_record';
        $page_data['page_title'] = get_phrase('student_leaves_past_record');
        $this->load->view('backend/index', $page_data);
    }
	
	 function student_leaves_delete_record($param = "",$param2 = ""){
        if ($this->session->userdata('parent_login') != 1)
          redirect(site_url('login'), 'refresh');
 
        if($param == "delete" && $param2 != ""){
         $this->db->where('leave_id',$param2);
         $this->db->delete('leave_request');
         $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
         redirect(site_url('parents/student_leaves_past_record'));   
        }

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
		$request = $this->parents->scholarship_examlist_by_student_n_class($this->session->userdata('parent_id'));
	
        $page_data['pre_exam_info'] = $request;
        $page_data['page_name']     = 'scholarship_exam_schedule';
        $page_data['page_title']    = get_phrase('exam_schedule');
      ///  $this->load->view('backend/index', $page_data);
		
      //  $page_data['page_name']  = 'scholarship_exam_schedule';
      //  $page_data['page_title'] = get_phrase('scholarship_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function scholarship_exam_result($param1 = "")
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'result';
            $page_data['exams'] = $this->crud_model->available_scholarship_exams($this->session->userdata('login_user_id'));
        }
        $page_data['page_name']  = 'scholarship_exam_result';
        $page_data['page_title'] = get_phrase('scholarship_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function scholarship_exam_answer_sheet()
    {
        $page_data['page_name']  = 'scholarship_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('scholarship_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Pre Admission*****/
    function pre_admission_exam_schedule()
    {
        $page_data['page_name']  = 'pre_admission_exam_schedule';
        $page_data['page_title'] = get_phrase('pre_admission_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_admit_card()
    {
        $page_data['page_name']  = 'pre_admission_admit_card';
        $page_data['page_title'] = get_phrase('pre_admission_admit_card');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_result()
    {
        $page_data['page_name']  = 'pre_admission_exam_result';
        $page_data['page_title'] = get_phrase('pre_admission_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_answer_sheet()
    {
        $page_data['page_name']  = 'pre_admission_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('pre_admission_exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }

    function parent_attendance_report()
    {   
    
      if ($this->session->userdata('parent_login') != 1)
      {
        redirect(base_url(), 'refresh');
      }
        $page_data['studentDetails']= $this->parents->available_hostel_room($this->session->userdata('login_user_id'));
        $page_data['month']      = date('m');
        $page_data['page_name']  = 'hostel_attendance_report';
        $page_data['page_title'] = get_phrase('hostel_attendance_report');
        $this->load->view('backend/index', $page_data);
    }
    function visitors_list()
    {
		 $page_data['visitors']  = $this->parents->get_visitor_list_users($this->session->userdata('login_user_id'),$this->session->userdata('role_id'));
      
	   $page_data['page_name']  = 'visitors_list';
        $page_data['page_title'] = get_phrase('visitors_list');
        $this->load->view('backend/index', $page_data);
    }
    /****Canteen*****/
    function card_recharge($student_id = '')
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
		
        $page_data['student_idd'] = $student_id;
        $page_data['details'] = $this->customers->student_details($student_id);
        $page_data['trans']   = $this->parents->student_trans_details($student_id);
	
        $page_data['page_name']  = 'card_recharge';
        $page_data['page_title'] = get_phrase('student_card_recharge');
        $this->load->view('backend/index', $page_data);
    }
	
  
	   public function transactions($student_id='')
    {
        
        $data['details'] = $this->customers->student_details($student_id);
		
        $data['money']   = $this->customers->money_student_details($student_id);
      
        $data['page_name']  = 'card_recharge';
        $data['page_title'] = get_phrase('student_card_recharge');
        $this->load->view('backend/index', $data);
    }
	
	

    function card_recharge_process($param = ""){
       if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        if($param == "create"){
          $data['student_id'] = $this->input->post('student_id');
          //$data['student_id'] = $this->input->post('student_id');  
          $data['card_amount']     = $this->input->post('amount');
          $total_amount = $data['card_amount'];

          $result = $this->db->get_where('student_account',array('student_id'=>$data['student_id']))->row();
          if($result != ""){
           // $this->db->where('student_id', $data['student_id']);
           // $this->db->update('student_account', array('card_amount'=>$data['card_amount']));
            $sql = 'update student_account set card_amount=card_amount+'.$data['card_amount'].' where student_id=?';
            $this->db->query($sql, array($data['student_id']));
            
            
            $this->db->set('balance', "balance-$total_amount", FALSE);
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('student');

            $this->session->set_flashdata('flash_message' , get_phrase('recharge_success'));
            redirect(site_url('parents/card_recharge/'.$data['student_id']), 'refresh');
          }else{
           
            $this->db->set('balance', "balance-$total_amount", FALSE);
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('student');

            $this->db->insert('student_account', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('recharge_success'));
            redirect(site_url('parents/card_recharge/'.$data['student_id']), 'refresh');  
          } 
          $this->session->set_flashdata('error_message' , get_phrase('Please_try_again_and_enter_correct_details'));
          redirect(site_url('parents/card_recharge/'.$data['student_id']), 'refresh');
        }
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['amount']     = $this->input->post('amount');
        $page_data['page_name']  = 'card_recharge_process';
        $page_data['page_title'] = get_phrase('student_card_recharge_process');
        $this->load->view('backend/index', $page_data);
    }
    /****Exam*****/
    function exam_schedule()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        $request = $this->parents->_examlist_by_student_n_class($this->session->userdata('parent_id'));
        $page_data['schedule_data']    = $this->parents->get_student_re_exam_list($this->session->userdata('login_user_id'));

        $page_data['exam_cancel_data'] = $this->parents->get_student_cancel_exam_list($this->session->userdata('login_user_id'));

        $page_data['exam_data']     = $request;
        $page_data['page_name']     = 'exam_schedule';
        $page_data['page_title']    = get_phrase('student_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }

    function exam_result()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'exam_result';
        $page_data['page_title'] = get_phrase('student_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function exam_answer_sheet()
    {
        $page_data['page_name']  = 'exam_answer_sheet';
        $page_data['page_title'] = get_phrase('answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Re-Exam*****/
    function re_exam_schedule()
    {   
        $page_data['schedule_data']    = $this->parents->get_student_re_exam_list($this->session->userdata('login_user_id'));
        $page_data['exam_cancel_data'] = $this->parents->get_student_cancel_exam_list($this->session->userdata('login_user_id'));
        
        $page_data['page_name']  = 're_exam_schedule';
        $page_data['page_title'] = get_phrase('student_re_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function re_exam_result()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 're_exam_result';
        $page_data['page_title'] = get_phrase('student_re_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function re_exam_answer_sheet()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 're_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('re_exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Certificate Management*****/
    function view_all_certificates()
    {	   
if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');	
	   $user_id = $this->session->userdata('parent_id');
	   $role_id = $this->session->userdata('role_id');	 
		$page_data['all_certificates']  = $this->parents->get_all_certificates($user_id,$role_id);
        $page_data['page_name']  = 'view_all_certificates';
        $page_data['page_title'] = get_phrase('view_all_certificates');
        $this->load->view('backend/index', $page_data);
    }
    function apply_for_certificates()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'apply_for_certificates';
        $page_data['page_title'] = get_phrase('apply_for_certificates');
        $this->load->view('backend/index', $page_data);
    }
    function apply_certificates(){
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');		  
            $data['student_id'] = $this->input->post('student_id');
            $data['apply_by']=  $this->session->userdata('parent_id');           
            $data['role_id']   = $this->session->userdata('role_id');
            $data['certificate_type'] = $this->input->post('certificate_type');        
            $data['description'] = $this->input->post('description');        
            $data['year']    = $this->year;
          
              if($data['student_id'] != "" && $data['apply_by'] != ""){
               $this->db->insert('apply_certificates',$data);
               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('parents/view_all_certificates/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               redirect(site_url('parents/apply_for_certificates/'), 'refresh'); 
              }
		
	}
    function guardian_list()
    {
  if ($_POST) {
           
            $validationval = $this->_prepare_guardian_validation();
       
            if ($this->form_validation->run() === TRUE) {
                $dataval = $this->_get_posted_guardian_data();
            
                $insert_id = $this->guardian->insert('guardians', $dataval);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('parents/guardian_list');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('parents/guardian_list');
                }
            } else {
                   $this->data['post'] = $_POST;
            }
        }
         
        
        $this->data['guardians'] = $this->guardian->get_guardian_list();
        $this->data['roles'] = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
       	$this->data['page_name'] = 'guardian_list';
		$this->data['page_title'] = 'Guardian';
		$this->data['folder'] = 'parents';
         $this->data['list'] = TRUE;
        $this->load->view('backend/index', $this->data);;
         
    }
 public function get_single_guardian($guardian_id = FALSE){
        
      	if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
       
       $this->data['guardian'] = $this->guardian->get_single_guardian($guardian_id);
       $this->data['students'] = $this->guardian->get_student_list($guardian_id);
       $this->data['invoices'] = $this->guardian->get_invoice_list($guardian_id);  
       
       echo $this->load->view('get-single-guardian', $this->data);
    }
    function assign_guardian()
    {
		if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
		$page_data['guardians']  = $this->guardian->get_assign_guardian_list();

		$page_data['list'] = TRUE;
        $page_data['page_name']  = 'assign_guardian';
        $page_data['page_title'] = get_phrase('assign_guardian');
        $this->load->view('backend/index', $page_data);
    }
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Guardian" user interface                 
    *                    and process to store "Guardian" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function assign_guardian_add() {     
        if ($_POST) {
			      $data['student_id'] = $this->input->post('select_student');
			      $data['guardian_id'] = $this->input->post('select_guardian');
			      $data['date_from'] = $this->input->post('from_date');
			      $data['date_to'] = $this->input->post('to_date');
			      $data['role_id'] = 8;
                  $data['create_date'] = date('Y-m-d H:i:s');
                  $data['create_by'] = logged_in_user_id();
                  $data['year'] = $this->guardian->running_year();
                  $insert_id = $this->guardian->insert('assign_guardian_list', $data);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('parents/assign_guardian');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('parents/assign_guardian_add');
                }
            
        }
         
        
        $this->data['guardians']  = $this->guardian->get_guardian_list();
        $this->data['rolesdata']  = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name']  = 'assign_guardian';
        $this->data['page_title'] = 'Guardian Assign';
        $this->data['folder']     = 'parent';
        $this->data['add']        =  TRUE;
        $this->load->view('backend/page', $this->data);
         
    }
  public function guardian_list_add() {

      //  check_permission(ADD);
        
        if ($_POST) {
           
            $validationval = $this->_prepare_guardian_validation();
       
            if ($this->form_validation->run() === TRUE) {
                $dataval = $this->_get_posted_guardian_data();
            
                $insert_id = $this->guardian->insert('guardians', $dataval);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('parents/guardian_list');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('parents/guardian_list_add');
                }
            } else {
                   $this->data['post'] = $_POST;
            }
        }
         
        
        $this->data['guardians'] = $this->guardian->get_guardian_list();
        $this->data['roles'] = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
       	$this->data['page_name'] = 'guardian_list';
		$this->data['page_title'] = 'Guardian';
		$this->data['folder'] = 'parents';
        $this->data['add'] = TRUE;
        $this->load->view('backend/index', $this->data);;
         
    }


    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Guardian" user interface                 
    *                    with populate "Guardian" value 
    *                    and process to update "Guardian" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function guardian_edit($id = FALSE) {

        //check_permission(EDIT);

        if(!is_numeric($id)){
              $this->session->set_flashdata('error_message', get_phrase($this->lang->line('unexpected_error')));
              redirect('guardian_list');
        }
        
        if ($_POST) {
            $this->_prepare_guardian_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_guardian_data();
                $updated = $this->guardian->update('guardians', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    create_log('Has been updated a Guardian : '.$data['name']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('parents/guardian_list');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('parents/guardian_edit' . $this->input->post('id'));
                }
            } else {
                $this->data['guardian'] = $this->guardian->get_single_guardian($this->input->post('id'));
            }
        }

        if ($id) {
            $this->data['guardian'] = $this->guardian->get_single_guardian($id);

            if (!$this->data['guardian']) {
                redirect('parents/guardian_list');
            }
        }

        $this->data['guardians'] = $this->guardian->get_guardian_list();
        $this->data['roles']     = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['edit']      = TRUE;
        $this->data['page_name'] = 'guardian_list';
        $this->data['page_title']= 'Guardian';
        $this->data['folder']    = 'parent';
        $this->load->view('backend/page', $this->data);
    }


      
    /*****************Function _prepare_guardian_validation**********************************
    * @type            : Function
    * @function name   : _prepare_guardian_validation
    * @description     : Process "Guardian" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_guardian_validation() {

        //echo "validation";
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        if (!$this->input->post('id')) {
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email');
           // $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
        }
        $this->form_validation->set_rules('relation', $this->lang->line('relation'), 'trim|required');
        $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required');
        $this->form_validation->set_rules('role_id', $this->lang->line('role'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('profession', $this->lang->line('profession'), 'trim');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('permanent_address', $this->lang->line('permanent') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('religion', $this->lang->line('religion'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');


    }
	
	
	      /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Guardian Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->guardian->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', 'Email-Id is already_exist');
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->guardian->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', 'Email-Id is already_exist');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    /*****************Function _get_posted_guardian_data**********************************
    * @type            : Function
    * @function name   : _get_posted_guardian_data
    * @description     : Prepare "Guardian" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_guardian_data() {

        $items = array();

        $items[] = 'name';
        $items[] = 'national_id';
        $items[] = 'phone';
        $items[] = 'profession';
        $items[] = 'present_address';
        $items[] = 'permanent_address';
        $items[] = 'religion';
        $items[] = 'other_info';
        $items[] = 'student_id';
        $items[] = 'relation';
        

        $data = elements($items, $_POST);
      // print_r($data);
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['role_id'] = 8;
            $data['status']     = 1;
            $data['year']       = $this->guardian->running_year();
            // create user 
            $data['user_id'] = $this->guardian->create_user_guardian();
        }

        if ($_FILES['photo']['name']) {
            //$data['photo'] = $this->_upload_photo();
        }
      return $data;
    }
   function certificate_detail($param = "",$param2 = ""){
      	if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
 
        if($param == "delete" && $param2 != ""){
         $this->db->where('id',$param2);
         $this->db->delete('apply_certificates');
         $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
         redirect(site_url('parents/view_all_certificates'));   
        }
	 }



     // Hostel Attendance report view
  function hostel_attendance_report($student_id = ""){

    if ($student_id != "") {
      $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
      $page_data['student_id']        = $student_id;
      $page_data['month']             = date('m');
      $page_data['page_name']         = 'hostel_attendance_report';
      $page_data['page_title']        = get_phrase('hostel_attendance_report_of_') . ' ' . $student_name . ' : ';
      $this->load->view('backend/index', $page_data);
    }
  }


  function hostel_attendance_report_selector($student_id = "")
  {
       $hostel                      = $this->db->get_where('hostel_members', array('user_id'=>$this->input->post('student_id'),'status'=>1))->row();

       if($hostel == ""){
         $this->session->set_flashdata('flash_message' , get_phrase('hostel_not_assigned_of_your_student'));
         redirect(site_url('parents/parent_attendance_report'));   
       }

        $hostel_id =  $hostel->hostel_id;
        $running_year                   = $this->year;
        $parent_name                    = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('login_user_id')))->row()->name;

        $studentname                    = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->name;
        $month                          = $this->input->post('month');
        $sessional_year                 = $this->input->post('sessional_year');
       
        $hostel                         = $this->db->get_where('hostels', array('id' => $hostel_id))->row();
      
        $page_data['hostel_id']         = $hostel_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['student_id']        = $this->input->post('student_id');
        $page_data['student_name']      = $studentname;
        $page_data['page_name']         = 'hostel_attendance_report_view';
        $page_data['page_title']        = get_phrase('hostel_attendance_report_view') . ' ' . $studentname;

        $this->load->view('backend/index', $page_data);
  }

  function hostel_attendance_report_view($class_id = '', $section_id = '', $month = '', $sessional_year = '', $student_id = '')
  {
      if($this->session->userdata('parent_login')!=1)
         redirect(base_url() , 'refresh');
     $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
     $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
     $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
     $page_data['student_id']        = $student_id;
     $page_data['class_id']          = $class_id;
     $page_data['section_id']        = $section_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['page_name']         = 'hostel_attendance_report_view';
     $page_data['page_title']        = get_phrase('hostel_attendance_report_of') . ' '.$student_name;
     $this->load->view('backend/index', $page_data);
  }
  function hostel_attendance_report_print_view($hostel_id ='' , $month = '', $sessional_year = '', $student_id = '') {
       if ($this->session->userdata('parent_login') != 1)
         redirect(base_url(), 'refresh');

     $page_data['hostel_id']          = $hostel_id;
     $page_data['month']             = $month;
     $page_data['sessional_year']    = $sessional_year;
     $page_data['student_id']        = $student_id;
     $this->load->view('backend/parent/hostel_attendance_report_print_view' , $page_data);
 }

    /****Student Dormitory *****/
    function student_roomchange_request($param1 = "")
       {

        
        //$page_data['hostel_data']= $this->crud_model->get_hostel_data($this->session->userdata('login_user_id'));
       // $page_data['page_name']  = 'student_roomchange_request';
       // $page_data['page_title'] = get_phrase('room_change_request');
       // $this->load->view('backend/index', $page_data);
    }

	/****Dormitory*****/
    function room_change_request($param1 = "")
    {
       if($_POST != "" && $param1 != ""){
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
          redirect(site_url('parents/room_change_request'), 'refresh');
        }
        
        $page_data['page_name']  = 'room_change_request';
        $page_data['page_title'] = get_phrase('room_change_request');
        $this->load->view('backend/index', $page_data);
    }
	    function assignment($student_id = null,$class_id = null) {
        
        // if(isset($class_id) && !is_numeric($class_id)){
        //     error($this->lang->line('unexpected_error'));
        //      redirect('assignment/index');
        // }
        $parent_id= $this->session->userdata('parent_id');
        if(empty($student_id)){
            $classId = null;
            $studentId = array();
            $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id")->result_array();
            foreach ($children_of_parent as $key=> $row){
                $classId[] = $row['class_id'];
                if(is_null($student_id)){
                    $studentId[] = $row['student_id'];
                }
            }
            if(empty($studentId)){
                $studentId = $student_id;
            }
        }else{
            $classId = $this->db->get_where('enroll',['student_id'=>$student_id])->row()->class_id;
            $studentId = $student_id;
        }
        $this->data['assignments'] = array_merge($this->assignment_individual->get_assignment_list($classId,$studentId),
                                        $this->assignment_individual->get_assignments_by_class_and_section_student('','',$studentId)
        );
        $this->data['classes'] = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id'] = $class_id;
        $this->data['student_id'] = $student_id;
        $this->data['list'] = TRUE;

        $this->data['page_name'] = 'assignment';
        $this->data['page_title'] = 'Assignment List';
        $this->data['folder'] =  'parent';

        $this->layout->title($this->lang->line('get-single-assignment') . ' | ' . SMS);
        $this->load->view('backend/index', $this->data);


    }
	/*-----aftaab ---------*/
	
	/***Class Timetable***/
    function class_timetable()
    {
        $page_data['page_name']  = 'class_timetable';
        $page_data['page_title'] = get_phrase('class_timetable');
        $this->load->view('backend/index', $page_data);
    }
    
    /***Study Material***/
    function study_material()
    {
        $page_data['page_name']  = 'study_material';
        $page_data['page_title'] = get_phrase('study_material');
        $this->load->view('backend/index', $page_data);
    }
	
    function syllabus_module_info($param = "")
    {   
        $page_data['syllabus_data']              = $this->db->get_where('academic_syllabus',array('academic_syllabus_id'=>$param))->row();
        $page_data['syllabus_module_info_data']  = $this->db->get_where('syllabus_module_info',array('syllabus_id'=>$param,'status'=>1))->result();
        $page_data['syllabus_id']                = $param ;
        $page_data['page_name']                  = 'syllabus_module_info';
        $page_data['page_title']                 = get_phrase('syllabus_module_info');
        $this->load->view('backend/index', $page_data);

    }
	
	  function rf_id_card_block()
    {
		  if ($this->session->userdata('parent_login') != 1)
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
function online_exam(){
    if ($this->session->userdata('parent_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $this->db->where('student.parent_id',$this->session->userdata('login_user_id'));
            $this->db->join('student','enroll.student_id = student.student_id');
            $student = $this->db->get_where('enroll')->result();
            $this->db->where('running_year' , get_settings('running_year'));
            $this->db->where('status','published');
            $query = [];
            foreach($student as $class_id){
                $query[]   = "(class_id = '{$class_id->class_id}' AND section_id = '{$class_id->section_id}')";
            }
            if(!empty($query)){
                $queryString = implode(' OR ',$query);
                $this->db->where($queryString);
            }
            $this->db->order_by("exam_date", "desc");
            $page_data['exams'] = $this->db->get('online_exam')->result_array();
        }
        
        $page_data['page_name'] = 'online_exam';
        $page_data['active_link']  = 'online_exam';
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
}
	
	
}
