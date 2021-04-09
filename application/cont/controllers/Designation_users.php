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

class Designation_users extends MY_Controller
{
     

    function __construct()
    {

        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model('stripe_model');
        $this->load->model('paypal_model');
        $this->load->model('Designation_Model');
		$this->load->model('Hostel_Model', 'hostel', true);  
	    $this->load->model('Member_Model', 'member', true);
	    $this->load->model('Travel_Model', 'travel', true);
	    $this->load->model('Room_Model', 'room', true);  
		$this->load->model('Visitor_Model', 'visitor', true);
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    }

public function travel_index() {
        //check_permission(VIEW);
        //print_r($_SESSION);die;
        $this->data['vehicles']   = $this->travel->get_travel_list();
        $this->data['list']       = TRUE;
		$this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Vehicle" user interface                 
    *                    and process to store "Vehicle" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function travel_add() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_travel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_travel_data();
//die;
                $insert_id = $this->vehicle->insert('travelled', $data);
                if ($insert_id) {
                    
                   // create_log('Has been added a Vehicle : '.$data['number']);
                    success($this->lang->line('insert_success'));
                    redirect('designation_users/travel_index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('designation_users/travel_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['vehicles'] = $this->vehicle->get_vehicle_list();
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Vehicles';
        $this->data['folder'] = 'transport/vehicle';
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('vehicle') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Vehicle" user interface                 
    *                    with populate "Vehicle" value 
    *                    and process to update "Vehicle" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function travel_edit($id = null) {

       // check_permission(EDIT);

        if(!is_numeric($id)){
           error($this->lang->line('unexpected_error'));
          redirect('designation_users/travel_index');
        }
        
        if ($_POST) {
            $this->_prepare_vehicle_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_vehicle_data();
                $updated = $this->vehicle->update('vehicles', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a Vehicle : '.$data['number']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
                    redirect('designation_users/travel_index');
                } else {
                    $this->session->set_flashdata('error_message' , get_phrase('update_failed'));
                   
                    redirect('designation_users/travel_edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['vehicle'] = $this->vehicle->get_single('vehicles', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['vehicle'] = $this->vehicle->get_single('vehicles', array('id' => $id));

            if (!$this->data['vehicle']) {
                redirect('designation_users/travel_index');
            }
        }

        $this->data['vehicles']   = $this->vehicle->get_vehicle_list();
        $this->data['edit']       = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Vehicles';
        $this->data['page_title'] = 'Vehicles';
        $this->data['folder']     = 'transport/vehicle';
        $this->load->view('backend/page', $this->data);
    }


    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('designation_users_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('designation_users_login') == 1)
            redirect(site_url('designation_users/dashboard'), 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
//print_r($this->session->userdata());die;
        $designation_desboard = "";
        if($this->session->userdata('role_id') == 9)
            $designation_desboard = 'Driver_dashboard';

        if($this->session->userdata('role_id') == 13)
            $designation_desboard = 'Warden_dashboard';
        
        if($this->session->userdata('role_id') == 15)
            $designation_desboard = 'canteen_dashboard';
        if($this->session->userdata('role_id') == 18)
            $designation_desboard = 'transport_dashboard';
            
        if ($this->session->userdata('designation_users_login') != 1 )
         redirect(base_url(), 'refresh');
         $page_data['page_name']  = 'dashboard';
         $page_data['page_title'] = get_phrase($designation_desboard);
         $this->load->view('backend/index', $page_data);
    }


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
      $page_data['page_title']                = get_phrase('group_messaging');
      $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
      
        if ($param1 == 'update_profile_info') {
           $data['name']     = $this->input->post('name');
           $data1['email']    = $this->input->post('email');
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

            $validation = email_validation_for_edit($data1['email'], $this->session->userdata('designation_users_id'), 'designation_users');
            if($validation == 1){

                $this->db->where('user_id', $this->session->userdata('designation_users_id'));
                $this->db->update('employees', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/employee-photo/' . $this->session->userdata('designation_users_id') . '.jpg');
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('designation_users/manage_profile/'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('designation_users', array(
                'designation_users_id' => $this->session->userdata('designation_users_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('designation_users_id', $this->session->userdata('designation_users_id'));
                $this->db->update('designation_users', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('designation_users/manage_profile/'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
	
         $page_data['edit_data']  = $this->db->get_where('designation_users', array(
           'designation_users_id' => $this->session->userdata('designation_users_id')
        ))->result_array();
		
        $page_data['edit_datas']  = $this->db->get_where('employees', array(
           'user_id' => $this->session->userdata('designation_users_id')
        ))->result_array();

        $this->load->view('backend/index', $page_data);
    }

   

    

    /****Scholarship Admission*****/
    function scholarship_exam_schedule()
    {
        $page_data['page_name']  = 'scholarship_exam_schedule';
        $page_data['page_title'] = get_phrase('exam_schedule');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_online()
    {
        $page_data['page_name']  = 'scholarship_exam_online';
        $page_data['page_title'] = get_phrase('scholarship_online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_result()
    {
        $page_data['page_name']  = 'scholarship_exam_result';
        $page_data['page_title'] = get_phrase('exams_result');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_answer_sheet()
    {
        $page_data['page_name']  = 'scholarship_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Pre Admission*****/
    function pre_admission_exam_schedule()
    {
        $page_data['page_name']  = 'pre_admission_exam_schedule';
        $page_data['page_title'] = get_phrase('exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_student_registraion()
    {
        $page_data['page_name']  = 'pre_admission_student_registraion';
        $page_data['page_title'] = get_phrase('student_registraion_form');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_admit_card()
    {
        $page_data['page_name']  = 'pre_admission_admit_card';
        $page_data['page_title'] = get_phrase('student_admit_card');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_online_exam()
    {
        $page_data['page_name']  = 'pre_admission_online_exam';
        $page_data['page_title'] = get_phrase('online_exam');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_result()
    {
        $page_data['page_name']  = 'pre_admission_exam_result';
        $page_data['page_title'] = get_phrase('exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function pre_admission_exam_answer_sheet()
    {
        $page_data['page_name']  = 'pre_admission_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Dormitory *****/
    function student_roomchange_request()
    {
        $page_data['page_name']  = 'student_roomchange_request';
        $page_data['page_title'] = get_phrase('room_change_request');
        $this->load->view('backend/index', $page_data);
    }
    function attendance_report()
    {
        $page_data['page_name']  = 'attendance_report';
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }
    function visitors_list()
    {
        $page_data['page_name']  = 'visitors_list';
        $page_data['page_title'] = get_phrase('visitors_list');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Canteen *****/
    function card_recharge()
    {
        $page_data['page_name']  = 'card_recharge';
        $page_data['page_title'] = get_phrase('student_canteen_card_recharge');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Exam *****/
    function exam_schedule()
    {
        $page_data['page_name']  = 'exam_schedule';
        $page_data['page_title'] = get_phrase('student_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function exam_result()
    {
        $page_data['page_name']  = 'exam_result';
        $page_data['page_title'] = get_phrase('student_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function exam_answer_sheet()
    {
        $page_data['page_name']  = 'exam_answer_sheet';
        $page_data['page_title'] = get_phrase('exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Re-Exam *****/
    function re_exam_schedule()
    {
        $page_data['page_name']  = 're_exam_schedule';
        $page_data['page_title'] = get_phrase('student_re_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function re_exam_result()
    {
        $page_data['page_name']  = 're_exam_result';
        $page_data['page_title'] = get_phrase('student_re_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function re_exam_answer_sheet()
    {
        $page_data['page_name']  = 're_exam_answer_sheet';
        $page_data['page_title'] = get_phrase('re_exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
    /****Student Certificate Management *****/
    function view_all_certificates()
    {
        $page_data['page_name']  = 'view_all_certificates';
        $page_data['page_title'] = get_phrase('student_view_all_certificates');
        $this->load->view('backend/index', $page_data);
    }
    function apply_for_certificates()
    {
        $page_data['page_name']  = 'apply_for_certificates';
        $page_data['page_title'] = get_phrase('student_apply_for_certificates');
        $this->load->view('backend/index', $page_data);
    }




    public function visitor() {

       // check_permission(VIEW);
	     $page_data['visitors'] = $this->visitor->get_visitor_list();
         $page_data['roles_details'] = $this->visitor->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
         $page_data['page_name']  = 'visitor';
         $page_data['page_title'] = 'Visitor Info';
         $page_data['folder']     = 'designation_users';
         $page_data['list'] = TRUE;
         $this->layout->title($this->lang->line('manage_visitor') . ' | ' . SMS);
         $this->load->view('backend/index', $page_data);
    }
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Visitor Info" user interface                 
    *                    and process to store "Visitor Info" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function visitor_add() {

        //check_permission(ADD);

        if ($_POST) {
            $this->_prepare_visitor_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_visitor_data();

                $insert_id = $this->visitor->insert('visitors', $data);
                if ($insert_id) {
                    
                    //create_log('Has been added a Visitor : '.$data['name']);
                    $this->session->set_flashdata('flash_message', get_phrase('data_insert_successful'));
                    redirect('designation_users/visitor');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('designation_users/visitor_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['add'] = TRUE;
        $this->data['page_name']  = 'visitor';
        $this->data['page_title'] = 'Visitor Info';
        $this->data['folder']     = 'designation_users';
        $this->load->view('backend/index', $this->data);
    }

    
    /*****************Function _prepare_visitor_validation**********************************
    * @type            : Function
    * @function name   : _prepare_visitor_validation
    * @description     : Process "Visitor Info" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_visitor_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('role_id', $this->lang->line('user') . ' ' . $this->lang->line('type'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('coming_from', $this->lang->line('coming_from'), 'trim');
        $this->form_validation->set_rules('user_id', $this->lang->line('to_meet'), 'trim|required');
        $this->form_validation->set_rules('reason', $this->lang->line('reason_to_meet'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }
   
    /*****************Function _get_posted_visitor_data**********************************
    * @type            : Function
    * @function name   : _get_posted_visitor_data
    * @description     : Prepare "Visitor Info" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_visitor_data() {

        $items = array();
        $items[] = 'role_id';
        $items[] = 'name';
        $items[] = 'phone';
        $items[] = 'coming_from';
        $items[] = 'user_id';
        $items[] = 'reason';
        $items[] = 'note';

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
           // $data['check_out']   = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['year'] = $this->year;
            $data['check_in'] = date('Y-m-d H:i:s');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }
    
     public function hostel() {

        $page_data['hostels']    = $this->hostel->get_hostel_list();
        $page_data['list']       = TRUE;
        $page_data['page_name']  = 'hostel';
        $page_data['page_title'] = 'Hostels';
        $page_data['folder']     = 'designation_users';
        $this->load->view('backend/index', $page_data);
    }
	
	
	    public function hostal_add() {

        //check_permission(ADD);

        if ($_POST) {
            $this->_prepare_hostel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_hostel_data();

                $insert_id = $this->hostel->insert('hostels', $data);
                if ($insert_id) {
                    create_log('Has been added a Hostel : '.$data['name']);
                    $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
                    redirect('designation_users/hostel');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('designation_users/hostal_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['hostels'] = $this->hostel->get_hostel_list();
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'hostel';
        $this->data['page_title'] = 'Hostels';
        $this->data['folder'] = 'designation_users';
        $this->load->view('backend/index', $this->data);
    }

           
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Hostel" user interface                 
    *                    with populate "Hostel" value 
    *                    and process to update "Hostel" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function hostel_edit($id = null) {

       // check_permission(EDIT);
        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          redirect('designation_users/hostel');
        }
        
        if ($_POST) {
            $this->_prepare_hostel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data    = $this->_get_posted_hostel_data();
                $updated = $this->hostel->update('hostels', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a Hostel : '.$data['name']);
                    $this->session->set_flashdata('flash_message', get_phrase('data_update_successfully'));
                    redirect('designation_users/hostel');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('designation_users/hostel_edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['hostel'] = $this->hostel->get_single('hostels', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['hostel'] = $this->hostel->get_single('hostels', array('id' => $id));

            if (!$this->data['hostel']) {
                redirect('designation_users/hostel');
            }
        }

        $this->data['hostels']    = $this->hostel->get_hostel_list();
        $this->data['edit']       = TRUE;
        $this->data['page_name']  = 'hostel';
        $this->data['page_title'] = 'Hostels';
        $this->data['folder']     = 'designation_users';
        $this->load->view('backend/page', $this->data);
    }

         
    /*****************Function _prepare_hostel_validation**********************************
    * @type            : Function
    * @function name   : _prepare_hostel_validation
    * @description     : Process "Hostel" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_hostel_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('name', $this->lang->line('hostel') . ' ' . $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('type', $this->lang->line('hostel_type'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }
	
	      
   
    /*****************Function _get_posted_hostel_data**********************************
    * @type            : Function
    * @function name   : _get_posted_hostel_data
    * @description     : Prepare "Hostel" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_hostel_data() {

        $items = array();
        $items[] = 'name';
        $items[] = 'type';
        $items[] = 'address';
        $items[] = 'note';
        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }

    
    public function member() {

        //check_permission(VIEW);
	
        $page_data['list']       = TRUE;
	    $page_data['members'] = $this->member->get_hostel_member_list($is_hostel_member = 1);
       
        $page_data['page_name']  = 'member';
        $page_data['page_title'] =  get_phrase('Members');
        //$page_data['folder']     = 'member';
        $this->load->view('backend/index', $page_data);

    }


    public function member_add() {

        //check_permission(ADD);

        $page_data['add'] = TRUE;
		 $page_data['non_members'] = $this->member->get_hostel_member_list($is_hostel_member = 0);
        $this->layout->title($this->lang->line('hostel') . ' ' . $this->lang->line('member') . ' | ' . SMS);
        $page_data['page_name'] = 'member';
        $page_data['page_title'] = 'Members';
        //$page_data['folder'] = 'member';
        $this->load->view('backend/index', $page_data);
    }


    public function room() {

        //check_permission(VIEW);
        if ($this->session->userdata('designation_users_login') != 1)
            redirect(site_url('login'), 'refresh');
        
        $page_data['rooms'] = $this->room->get_room_list();
        $page_data['hostels'] = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $page_data['list'] = TRUE;
        $page_data['page_name'] = 'room';
        $page_data['page_title'] = 'Rooms';
        $page_data['folder'] = 'designation_users';
        $this->layout->title($this->lang->line('manage_room') . ' | ' . SMS);
        $this->load->view('backend/index', $page_data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Hostel Room" user interface                 
    *                    and process to store "Hostel Room" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function room_add() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_room_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_room_data();

                $insert_id = $this->room->insert('rooms', $data);
                if ($insert_id) {
                    
                    $hostel = $this->room->get_single('hostels', array('id' => $data['hostel_id']));
                   // create_log('Has been added a room no : '.$data['room_no']. ' of '. $hostel->name );
                    
                    success($this->lang->line('insert_success'));
                    redirect('designation_users/room');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('designation_users/room_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['rooms']       = $this->room->get_room_list();
        $this->data['hostels']     = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['add']         = TRUE;
        $this->data['page_name']   = 'room';
        $this->data['page_title']  = 'Rooms';
        $this->data['folder']      = 'designation_users';

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
        
    /*****************Function _prepare_room_validation**********************************
    * @type            : Function
    * @function name   : _prepare_room_validation
    * @description     : Process "HOstel Room" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_room_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('hostel_id', $this->lang->line('hostel'), 'trim|required');
        $this->form_validation->set_rules('room_type', $this->lang->line('room') . ' ' . $this->lang->line('type'), 'trim|required');
        $this->form_validation->set_rules('cost', $this->lang->line('cost_per_seat'), 'trim');
        $this->form_validation->set_rules('total_seat', $this->lang->line('seat_total'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
        $this->form_validation->set_rules('room_no', $this->lang->line('room_no'), 'required|trim|callback_room_no');
    }
    /*****************Function room_no**********************************
    * @type            : Function
    * @function name   : room_no
    * @description     : Unique check for "Hostel Room No" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function room_no() {
        if ($this->input->post('id') == '') {
            $room = $this->room->duplicate_check($this->input->post('hostel_id'), $this->input->post('room_no'));
            if ($room) {
                $this->form_validation->set_message('room_no', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $room = $this->room->duplicate_check($this->input->post('hostel_id'), $this->input->post('room_no'), $this->input->post('id'));
            if ($room) {
                $this->form_validation->set_message('room_no', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
       
    /*****************Function _get_posted_room_data**********************************
    * @type            : Function
    * @function name   : _get_posted_room_data
    * @description     : Prepare "Hostel Room No" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_room_data() {

        $items = array();
        $items[] = 'hostel_id';
        $items[] = 'room_no';
        $items[] = 'room_type';
        $items[] = 'cost';
        $items[] = 'total_seat';
        $items[] = 'note';
        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Hostel Room" data from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function room_delete($id = null) {

        //check_permission(DELETE);

        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          redirect('designation_users/room');
        }
        
        $room = $this->room->get_single('rooms', array('id' => $id));
        
        if ($this->room->delete('rooms', array('id' => $id))) {
            
            $hostel = $this->room->get_single('hostels', array('id' => $room->hostel_id));
            //create_log('Has been deleted a room no : '.$room->room_no. ' of '. $hostel->name );
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
         redirect('designation_users/room');
    }


        
   function roomswitch_request(){
        $page_data['roomswitch_list']  = $this->crud_model->get_room_switch_request();
        $page_data['page_name']        = 'roomswitch_request';
        $page_data['page_title']       = get_phrase('Room Switch Requests');
		$this->data['folder']      = 'designation_users';
        $this->load->view('backend/index',$page_data);
    }


    function salary_details()
    {
      
        $page_data['salary'] = $this->crud_model->get_emp_salary_details($this->session->userdata('login_user_id'));

		$page_data['page_name']  = 'salary_details';
        $page_data['page_title'] = get_phrase('salary_details');
        $this->load->view('backend/index', $page_data);
    }

    function route_list()
    {
           $page_data['page_name']  = 'route_list';
        $page_data['page_title'] = get_phrase('route_list');
        $this->load->view('backend/index', $page_data);
    }


   function salary_update_status(){     
       $this->db->where('id',$this->input->post('id'));
       $this->db->update('salary_payments',array('payslip_status'=>$this->input->post('status')));
       echo 1;
     }
    

    function popup($page_name = '' , $param2 = '' , $param3 = '')
    {
        $account_type               =   $this->session->userdata('login_type');
        $page_data['param2']        =   $param2;
        $page_data['param3']        =   $param3;
        //$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);die;
        // echo  'backend/'.$account_type.'/'.$page_name.'.php';
        $this->load->view( 'backend/designation_users/'.$page_name.'.php' ,$page_data);
        if ($page_name != "create_group" && $page_name != "edit_group" && $page_name != "group_info") {
            echo '<script src="'. base_url(). 'assets/js/neon-custom-ajax.js"></script>';
        }
    }

       /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
       if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('designation_users/roomswitch_request'), 'refresh');
        }
        

    }
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('designation_users_login') != 1)
            redirect('login', 'refresh');

        $page_data['notices']    = $this->db->get_where('noticeboard',array('status'=>1))->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);

    }
    
    function leaves_past_record($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('designation_users_login') != 1)
            redirect('login', 'refresh');

        $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->session->userdata('login_user_id'),'year'=>$this->year,'role_id' => $this->session->userdata('role_id') ))->result();
        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'leaves_past_record';
        $page_data['page_title'] = get_phrase('leaves_past_record');
        $this->load->view('backend/index', $page_data);

    }
    
    
      /****Leave Management*****/
    function leave_request($param1 ="")
    {

        $result = $this->db->get_where('employees', array('id'=>$this->session->userdata('login_user_id')))->row();
          $result2 = $this->db->get_where('designation_users', array('designation_users_id'=>$this->session->userdata('login_user_id')))->row();
        
        $user_code = 'user_'.$result->id;
        $role_id   = $result->role_id;
        $user_id   = $result->id;
       $role_name = $this->db->get_where('roles', array('id' => $user_id))->row()->name;
        if ($param1 == "create")
        {   
           
            $gen_code          = $this->genrate_uniqid('lve_');
            $data['id_no']     = $user_code;
            $data['request_by']= $user_id;
            $data['uniqid']    = $gen_code;
            $data['role_id']   = $this->session->userdata('role_id');
            $data['type']      = $this->input->post('leave_day');
            $data['from_date'] = $this->input->post('from_leave_date');
            $data['to_date']   = $this->input->post('to_leave_date');
            $data['reason']    = $this->input->post('reason');
            $data['leave_date']= $this->input->post('leave_date');
            $data['year']      = $this->year;
            $notification_msg  = $data['reason'];
            $url               = json_encode(array('admin/add_notification')); 
            $send_role         = $role_id;
            if($data['id_no'] != "" && $data['type'] != ""){
               $this->db->insert('leave_request',$data);
			 //  $this->add_notification($user_id,$role_name,$role_id,$notification_msg,'Leave Request',$url);
               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('designation_users/leaves_past_record/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               //redirect(site_url('teacher/teacher_leave_request/'), 'refresh'); 
              }
            }
        $page_data['teacher_code']  = $user_code;
        $page_data['page_name']  = 'leave_request';
        $page_data['page_title'] = get_phrase('leave_request');
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

}
