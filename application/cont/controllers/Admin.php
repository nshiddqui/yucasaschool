<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  @author     : Creativeitem
 *  date        : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.comroomch
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends My_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
       
        $this->load->model('Vehicle_Model', 'vehicle', true);
        $this->load->model('Hostel_Model', 'hostel', true);
        $this->load->model('Route_Model', 'route', true);
        $this->load->model('Expenditure_Model', 'expenditure', true);
         $this->load->model('Invoice_Model', 'invoice', true);
        $this->load->model('Payment_Model', 'payment', true);
        $this->load->library('form_validation');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
     
        $this->load->model('Member_Model', 'member', true);
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //print_r($this->session->userdata);die;
        if ($this->uri->segment(2) != 'transport_dashboard'){
        if($this->session->userdata('login_user_id') == "" ){
             redirect(site_url(), 'refresh');
        }
        }

    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
          
            $page_data['facebook_settings']   = $this->db->get('facebook_settings')->result_array();
            $page_data['page_name']  = 'dashboard';
            $page_data['active_link']  = 'dashboard';
            $page_data['page_title'] = get_phrase('admin_dashboard');
            //print_r($this->session->userdata());
            $this->load->view('backend/index', $page_data);
     }

    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
    {
        //print_r($this->session->userdata());die;
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1){
            $page_data['field_arr']              = $this->crud_model->registration_form_fiels();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields();
        $page_data['page_name']  = 'student_add';
        $page_data['active_link']  = 'student_add';
        $page_data['page_title'] = get_phrase('add_student');
        $this->load->view('backend/index', $page_data);
        }else{
            redirect(site_url('login'), 'refresh');

        $page_data['field_arr']              = $this->crud_model->registration_form_fiels();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields();
        $page_data['page_name']  = 'student_add';
        $page_data['active_link']  = 'student_add';
        $page_data['page_title'] = get_phrase('add_student');
        $this->load->view('backend/index', $page_data);
        }
    }

    function student_bulk_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name']  = 'student_bulk_add';
        $page_data['active_link']  = 'student_bulk_add';
        $page_data['page_title'] = get_phrase('add_bulk_student');
        $this->load->view('backend/index', $page_data);
    }

  function student_profile($student_id)
  {
    if ($this->session->userdata('admin_login') != 1) {
      redirect(site_url('login'), 'refresh');
    }
    //ini_set('display_errors',1);

    $page_data['field_arr']  = $this->crud_model->registration_form_fiels();
    $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields();

    $page_data['page_name']  = 'student_profile';
    $page_data['active_link']  = 'student_profile';
    $page_data['page_title'] = get_phrase('student_profile');
    $page_data['student_id'] = $student_id;
        $this->load->view('backend/index', $page_data);
  }

    function get_sections($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/student_bulk_add_sections' , $page_data);
    }
    
    function get_section($class_id) {
          $page_data['class_id'] = $class_id;
          $this->load->view('backend/admin/manage_attendance_section_holder' , $page_data);
    }

    function get_employee($class_id) {
          $page_data['class_id'] = $class_id;
          $this->load->view('backend/admin/manage_employee_section_holder' , $page_data);
    }


    function designation_private_message()                                         
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name']  = 'sms_template';
        $page_data['active_link']  = 'sms_template';
        $page_data['page_title'] = get_phrase('sms_template');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        
        $this->load->view('backend/admin/designation_private_message',$page_data);

        // $page_data['class_id'] = "test";
//$this->load->view('backend/index');
        # code...
    }


    //  function message_designation($designation) {
    //       $page_data['designation_id'] = $designation;
    //       $this->load->view('backend/admin/designation_private_message' , $page_data);
    // }


    function student_information($class_id = '')
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1)
           {

        $page_data['page_name']     = 'student_information';
        $page_data['active_link']  = 'student_information';
        $page_data['status_code']     = '1';
        $page_data['page_title']    = get_phrase('student_information'). " - ".get_phrase('class')." : ".
                                    $this->crud_model->get_class_name($class_id);
        $page_data['class_id']  = $class_id;
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
           }
    }
    
    function student_information_inactive($class_id = '')
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1)
           {

        $page_data['page_name']     = 'student_information_inactive';
        $page_data['status_code']     = '0';
        $page_data['active_link']  = 'student_information_inactive';
        $page_data['page_title']    = get_phrase('student_information'). " - ".get_phrase('class')." : ".
                                    $this->crud_model->get_class_name($class_id);
        $page_data['class_id']  = $class_id;
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
           }
    }


    function get_students() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'student_id',
            1 => 'photo',
            2 => 'name',
            3 => 'class',
            4 => 'section',
            5 => 'house',
            6 => 'phone',
            7 => 'due_fee',
            8 => 'options',
            9 => 'student_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_students_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $books = $this->ajaxload->all_students($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $books =  $this->ajaxload->student_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->student_search_count($search);
        }

        $data = array();
        if(!empty($books)) {
            foreach ($books as $row) {
                 if ($row->student_id == null)
                    $download = '';
                else
                 $url=$this->crud_model->get_image_url('student',$row->student_id) ; 
                $download = '<img src="'.$url.'" class="img-circle" width="30">';

                $optionss = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <li><a href="#" onclick="book_edit_modal('.$row->student_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li>
                                    <li class="divider"></li><li><a href="#" onclick="book_delete_confirm('.$row->student_id.')"><i class="entypo-trash">
                                    </i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';


                  $options='<div class="btn-group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span> </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                       <li><a href="http://ijyaweb.com/college_erp/admin/student_marksheet_print_view/'.$row->student_id.'" target="_blank"><i class="entypo-chart-bar"></i>Mark Sheet </a> </li>
                                        <li><a href="http://ijyaweb.com/college_erp/admin/student_profile/'.$row->student_id.'"><i class="entypo-user"></i>Profile </a></li>
                                        <li><a href="#" onclick="book_edit_modal('.$row->student_id.')"><i class="entypo-pencil"></i> Edit</a></li>
                                         <li class="divider"></li>
                                       <li><a href="#" onclick="book_delete_confirm('.$row->student_id.')"><i class="entypo-trash">
                                    </i>&nbsp;'.get_phrase('delete').'</a></li>
                                    </ul>
                                </div>';
         $resultfee = @$this->db->query("select sum(gross_amount) as amount from invoices where student_id = ".$row->student_id." AND paid_status = 'unpaid'")->row();
         $student_ = @$this->db->query("select* from enroll where student_id = ".$row->student_id."")->row();  
         $house_id=$this->db->get_where('assign_house' , array('student_id' => $row->student_id ))->row()->house_id;
                                
                $nestedData['student_id'] = $row->student_id;
                $nestedData['photo'] =$download;
                $nestedData['name'] = $row->name;
                $nestedData['class_id'] = $this->db->get_where('class', array( 'class_id' =>$student_->class_id))->row()->name;
                $nestedData['section_id'] =$this->db->get_where('section', array( 'section_id' =>$student_->section_id))->row()->name;
                $nestedData['house'] =    $this->db->get_where('house_info' , array( 'house_id' => $house_id))->row()->name; 
                $nestedData['phone'] = $row->phone; 
                $nestedData['due_fee']  =@$resultfee->amount;
                $nestedData['options'] = $options;
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








    function student_marksheet($student_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
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
    
    

    function student_marksheet_print_view($student_id , $exam_id='') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }

    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'
        ))->row()->description;

        if ($param1 == 'create') {
              $data['name']         = $this->input->post('name');
            if($this->input->post('birthday') != null){
              $data['birthday']     = $this->input->post('birthday');
            }
            if($this->input->post('sex') != null){
              $data['sex']          = $this->input->post('sex');
            }
            if($this->input->post('address') != null){
              $data['address']      = $this->input->post('address');
            }
            if($this->input->post('phone') != null){
              $data['phone']        = $this->input->post('phone');
            }

            if($this->input->post('mother_name') != null){
              $data['mother_name']        = $this->input->post('mother_name');
              }
                $data['student_code'] = $this->input->post('student_code');
                $code_validation      = code_validation_insert($data['student_code']);
                if(!$code_validation) {
                    $this->session->set_flashdata('error_message' , get_phrase('this_id_no_is_not_available'));
                    redirect(site_url('admin/student_add'), 'refresh');
                }
       

            $data['email']        = $this->input->post('email');
            $data['password']     = sha1($this->input->post('password'));


            if($this->input->post('parent_id') != null){
                $data['parent_id']    = $this->input->post('parent_id');
            }
            if($this->input->post('dormitory_id') != null){
                $data['dormitory_id'] = $this->input->post('dormitory_id');
            }
             if($this->input->post('discount_id') != null){
                $data['discount_id'] = $this->input->post('discount_id');
            }
            if($this->input->post('transport_id') != null){
                $data['transport_id'] = $this->input->post('transport_id');
            }
            if($this->input->post('stop_id') != null){
                $data['transport_stop'] = $this->input->post('stop_id');
            }
            if($this->input->post('hostel_id') != null){
              $data['hostel_id']        = $this->input->post('hostel_id');
            }
            
            $data['otherfields'] = $this->addOtherFiels($this->input->post(),$_FILES);

            $validation = email_validation($data['email']);
            if($validation == 1) {
                
                $this->db->insert('student', $data);
                $student_id = $this->db->insert_id();
              

                $data2['student_id']     = $student_id;
                $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
                if($this->input->post('class_id') != null){
                  $data2['class_id']       = $this->input->post('class_id');
                }
                if ($this->input->post('section_id') != '') {
                    $data2['section_id'] = $this->input->post('section_id');
                }
                if ($this->input->post('roll') != '') {
                    $data2['roll']           = $this->input->post('roll');
                }
                if ($this->input->post('rf_id') != '') {
                    $data2['card_code']           = $this->input->post('rf_id');
                }
                $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
                $data2['year']           = $running_year;
                $this->db->insert('enroll', $data2);
               
                if($this->input->post('transport_id') != null && $this->input->post('stop_id')  != null){
                    $data_route['route_id']      = $this->input->post('transport_id');
                    $data_route['route_stop_id'] = $this->input->post('stop_id');
                    $data_route['user_id']       = $student_id;
                    $data_route['role_id']      = $this->session->userdata('role_id');
                    $data_route['created_by']    = $this->session->userdata('login_user_id');
                    $data_route['created_at']    = date('Y-m-d H:i:s');
                    $this->db->insert('transport_members',$data_route);

                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('is_transport_member'=>1));

                }
               
                if($this->input->post('dormitory_id') != null && $this->input->post('hostel_id')  != null){
                    $data_hostel['hostel_id']      = $this->input->post('hostel_id');
                    $data_hostel['room_id']        = $this->input->post('dormitory_id');
                    $data_hostel['user_id']        = $student_id;
                    $data_hostel['role_id']        = $this->session->userdata('role_id');
                    $data_hostel['created_by']     = $this->session->userdata('login_user_id');
                    $data_hostel['created_at']     = date('Y-m-d H:i:s');
                    $this->db->insert('hostel_members',$data_hostel);

                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('is_hostel_member'=>1));
                }
                ///////otherdb insert data /////////
                //$this->otherdb->insert('enroll', $data2);

                if(sizeof($_FILES) > 0)
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');

                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('admin/student_add'), 'refresh');
        }
        
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['email']          = $this->input->post('email');
            $data['parent_id']      = $this->input->post('parent_id');
            if ($this->input->post('birthday') != null) {
                $data['birthday']   = $this->input->post('birthday');
            }
            if ($this->input->post('sex') != null) {
                $data['sex']            = $this->input->post('sex');
            }
            if ($this->input->post('address') != null) {
               $data['address']        = $this->input->post('address');
            }
            if ($this->input->post('phone') != null) {
                $data['phone']          = $this->input->post('phone');
            }
            if ($this->input->post('dormitory_id') != null) {
               $data['dormitory_id']   = $this->input->post('dormitory_id');
            }
            
            if ($this->input->post('mother_name') != null) {
               $data['mother_name']   = $this->input->post('mother_name');
            }
            if ($this->input->post('transport_id') != null) {
                $data['transport_id']   = $this->input->post('transport_id');
            }
            if($this->input->post('hostel_id') != null){
              $data['hostel_id']        = $this->input->post('hostel_id');
            }
            if($this->input->post('stop_id') != null){
                $data['transport_stop'] = $this->input->post('stop_id');
            }
            if($this->input->post('status') != null){
                $data['status'] = $this->input->post('status');
            }
               
            //student id
            if($this->input->post('student_code') != null){
                $data['student_code'] = $this->input->post('student_code');
                $code_validation = code_validation_update($data['student_code'],$param2);
                if(!$code_validation){
                    $this->session->set_flashdata('error_message' , get_phrase('this_id_no_is_not_available'));
                    redirect(site_url('admin/student_information/' . $param3), 'refresh');
                }
            }

            $data['otherfields'] = $this->addOtherFiels($this->input->post(),$_FILES);
            $validation = email_validation_for_edit($data['email'], $param2, 'student');
            if($validation == 1){
                $this->db->where('student_id', $param2);
                $this->db->update('student', $data);

                $data2['section_id'] = $this->input->post('section_id');
                if ($this->input->post('roll') != null) {
                  $data2['roll'] = $this->input->post('roll');
                }
                else{
                  $data2['roll'] = null;
                }
                 if ($this->input->post('rf_id') != null) {
                  $data2['card_code'] = $this->input->post('rf_id');
                }
                else{
                  $data2['card_code'] = null;
                }
                $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                $this->db->where('student_id' , $param2);
                $this->db->where('year' , $running_year);
                $this->db->update('enroll' , array(
                    'section_id' => $data2['section_id'] , 'roll' => $data2['roll'],'card_code' => $data2['rf_id']
                ));


                if($this->input->post('transport_id') != null && $this->input->post('stop_id')  != null){
                    $data_route['route_id']      = $this->input->post('transport_id');
                    $data_route['route_stop_id'] = $this->input->post('stop_id');
                    $data_route['user_id']       = $param2;
                    $data_route['modified_by']   = $this->session->userdata('login_user_id');
                    $data_route['modified_at']   = date('Y-m-d H:i:s');

                    $this->db->where('user_id',$param2);
                    $this->db->update('transport_members',$data_route);
                }else{
                    $arr_transport = array('is_transport_member'=>0,'transport_id'=>"",'transport_stop'=>"");
                    $this->db->where('student_id', $param2);
                    $this->db->update('student',$arr_transport);

                    $this->db->where('user_id',$param2);
                    $this->db->delete('transport_members');
                }

                if($this->input->post('dormitory_id') != null && $this->input->post('hostel_id')  != null){
                    $data_hostel['hostel_id']      = $this->input->post('hostel_id');
                    $data_hostel['room_id']        = $this->input->post('dormitory_id');
                    $data_hostel['user_id']        = $param2;
                    $data_hostel['modified_by']    = $this->session->userdata('login_user_id');
                    $data_hostel['modified_at']    = date('Y-m-d H:i:s');
                    
                    
                    $this->db->where('student_id', $param2);
                    $this->db->update('student', array('is_hostel_member'=>1));
                }else{
                    $arr_hostel = array('is_hostel_member'=>0,'dormitory_id'=>"",'hostel_id'=>"");
                    $this->db->where('student_id', $param2);
                    $this->db->update('student', $arr_hostel);

                    $this->db->where('role_id',$this->session->userdata('role_id'));
                    $this->db->where('user_id', $param2);
                    $this->db->delete('hostel_members');
                }
                
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
                $this->crud_model->clear_cache();
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
           }
           else{
             $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
           }
            redirect(site_url('admin/student_information/' . $param3), 'refresh');
        }
    }


   function addOtherFiels($post,$files){
    
     $create_dianamic_field = $this->db->get_where('registration_form_setting',array('status'=>'1','created_html' => '0'))->result();
        $data_other_field_array = array();

        foreach ($create_dianamic_field as $htmlcode) { 
           $htmlcode = json_decode($htmlcode->json_field_elements);
           $data_j   = array();
           if(array_key_exists($htmlcode->name,$post) || array_key_exists($htmlcode->name,$_FILES)){
            //echo $htmlcode->type;
            //html_entity_decode
            if($htmlcode->type == 'documentupload' || $htmlcode->type == 'imageupload'){
                if($_FILES[$htmlcode->name]['name'] != "")
                    $filename = str_replace(" ", "_", $_FILES[$htmlcode->name]['name']);

             move_uploaded_file($_FILES[$htmlcode->name]['tmp_name'], 'uploads/other_student_image/' . $filename);  
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $filename; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j; 
            }else{
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $post[$htmlcode->name]; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j;
            }
         }
    }

    return $_otherFieldData =  json_encode($data_other_field_array);
    //echo $_otherFieldData =  json_encode($data_other_field_array);die;

   }

     function addOtherFiels_teacher($post,$files){
    
     $create_dianamic_field = $this->db->get_where('registration_form_setting_teacher',array('status'=>'1','created_html' => '0'))->result();
        $data_other_field_array = array();

        foreach ($create_dianamic_field as $htmlcode) { 
           $htmlcode = json_decode($htmlcode->json_field_elements);
           $data_j   = array();
           if(array_key_exists($htmlcode->name,$post) || array_key_exists($htmlcode->name,$_FILES)){
          
            if($htmlcode->type == 'documentupload' || $htmlcode->type == 'imageupload'){
                if($_FILES[$htmlcode->name]['name'] != "")
                    $filename = str_replace(" ", "_", $_FILES[$htmlcode->name]['name']);

             move_uploaded_file($_FILES[$htmlcode->name]['tmp_name'], 'uploads/other_teacher_image/' . $filename);  
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $filename; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j; 
            }else{
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $post[$htmlcode->name]; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j;
            }
         }
    }

    return $_otherFieldData =  json_encode($data_other_field_array);
    //echo $_otherFieldData =  json_encode($data_other_field_array);die;

   }


    function house($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

         if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['description']  = $this->input->post('description');
            if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
             }
            $this->db->insert('house_info', $data);
            //$student_id = $this->db->insert_id();

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(site_url('admin/house_information'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['description']  = $this->input->post('description');
             if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
             }
                $this->db->where('house_id', $param2);
                $this->db->update('house_info', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
          
            redirect(site_url('admin/house_information/' . $param3), 'refresh');
        }
    }
   
    /*****************Function _upload_photo**********************************
    * @type            : Function
    * @function name   : _upload_photo
    * @description     : Process to upload employee photo into server                  
    *                     and return photo name  
    * @param           : null
    * @return          : $return_photo string value 
    * ********************************************************** */ 
    private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/house_information/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
        /*****************Function add_to_hostel**********************************
    * @type            : Function
    * @function name   : add_to_hostel
    * @description     : Add student to Hostel via ajax call from user interface                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function add_to_house_list() {

        $user_id = $this->input->post('user_id');
        $house_id = $this->input->post('house_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        if ($user_id) {

            $member = $this->member->get_single('assign_house', array('student_id' => $user_id),'','assign_id');
        
                
            if (empty($member)) {

                $data['student_id'] = $user_id;              
                $data['house_id']  = $house_id;

                $data['class_id']    = $this->db->get_where('enroll' , array('student_id'=>$user_id))->row()->class_id;
                $data['section_id']    = $this->db->get_where('enroll' , array('student_id'=>$user_id))->row()->section_id;
                $data['status']     = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();
                $data['role_id'] = 1;
                $insert_id = $this->member->insert('assign_house', $data);
               $member = $this->member->get_single('student', array('student_id' => $user_id),'','student_id');
                create_log('Has been added a House Member : '.$member->name);
                echo TRUE;
            } else {
                echo FALSE;
            }
        } else {
            echo FALSE;
        }
    }
    
     function assign_house($param1 = '', $param2 = '', $param3 = '')
     {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

         if ($param1 == 'create') {
            $data['house_id']     = $this->input->post('house_id');
            $data['student_id']   = $this->input->post('user_id');
            $student_details      = $this->db->get_where('enroll',array('student_id'=>$data['student_id']))->row();
            $data['section_id']   = $student_details->section_id;
            $data['class_id']   = $student_details->class_id;
            
            $this->db->insert('assign_house', $data);
            //$student_id = $this->db->insert_id();

            echo get_phrase('data_added_successfully');
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            //redirect(site_url('admin/house_information'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['house_id']     = $this->input->post('house_id');
            $data['class_id']     = $this->input->post('class_id');
            $data['section_id']   = $this->input->post('section_id');
            $data['student_id']   = $this->input->post('student_id');
            
            $this->db->where('assign_id', $param2);
            $this->db->update('assign_house', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
          
            redirect(site_url('admin/house_information/' . $param3), 'refresh');
        }
    }


    function student_pre($param1 = '', $param2 = '', $param3 = '')
     {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

            $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
             ))->row()->description;

        if($param1 == 'create') {
               $data['name']      = $this->input->post('name');
            if($this->input->post('birthday') != null){
              $data['birthday']   = $this->input->post('birthday');
            }
            if($this->input->post('sex') != null){
              $data['sex']        = $this->input->post('sex');
            }
            if($this->input->post('address') != null){
              $data['address']    = $this->input->post('address');
            }
            if($this->input->post('phone') != null){
              $data['phone']      = $this->input->post('phone');
            }
         

            $data['email']        = $this->input->post('email');
            $data['password']     = sha1($this->input->post('password'));


            if($this->input->post('parent_id') != null){
                $data['parent_id']    = $this->input->post('parent_id');
            }
            if($this->input->post('dormitory_id') != null){
                $data['dormitory_id'] = $this->input->post('dormitory_id');
            }
            if($this->input->post('transport_id') != null){
                $data['transport_id'] = $this->input->post('transport_id');
            }
            $data['otherfields'] = $this->addOtherFiels($this->input->post(),$_FILES);
            $validation = email_validation($data['email']);
            if($validation == 1) {
                $this->db->insert('pre_student', $data);
                $student_id = $this->db->insert_id();

                $data2['student_id']     = $student_id;
                $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
                if($this->input->post('class_id') != null){
                  $data2['class_id']       = $this->input->post('class_id');
                }
                if ($this->input->post('section_id') != '') {
                    $data2['section_id'] = $this->input->post('section_id');
                }
                if ($this->input->post('roll') != '') {
                    $data2['roll']           = $this->input->post('roll');
                }
                $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
                $data2['year']           = $running_year;
                $this->db->insert('pre_enroll', $data2);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/pre_student_image/' . $student_id . '.jpg');
                move_uploaded_file($_FILES['upload_signature']['tmp_name'], 'uploads/pre_student_image/sign/' . $student_id . '.jpg');

                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('pre_student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('admin/pre_exam_student_registration'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['email']          = $this->input->post('email');
            $data['parent_id']      = $this->input->post('parent_id');
            if ($this->input->post('birthday') != null) {
                $data['birthday']   = $this->input->post('birthday');
            }
            if ($this->input->post('sex') != null) {
                $data['sex']            = $this->input->post('sex');
            }
            if ($this->input->post('address') != null) {
               $data['address']        = $this->input->post('address');
            }
            if ($this->input->post('phone') != null) {
                $data['phone']          = $this->input->post('phone');
            }
            if ($this->input->post('dormitory_id') != null) {
               $data['dormitory_id']   = $this->input->post('dormitory_id');
            }
            if ($this->input->post('transport_id') != null) {
                $data['transport_id']   = $this->input->post('transport_id');
            }

            $data['otherfields'] = $this->addOtherFiels($this->input->post(),$_FILES);
            $validation = email_validation_for_edit($data['email'], $param2, 'pre_student');
            if($validation == 1){
                $this->db->where('pre_student_id', $param2);
                $this->db->update('pre_student', $data);
                $data2['section_id'] = $this->input->post('section_id');
                if ($this->input->post('roll') != null) {
                $data2['roll'] = $this->input->post('roll');
                }
                else{
                  $data2['roll'] = null;
                }
                $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                $this->db->where('student_id' , $param2);
                $this->db->where('year' , $running_year);
                $this->db->update('pre_enroll' , array(
                    'section_id' => $data2['section_id'] , 'roll' => $data2['roll']
                ));

                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/pre_student_image/' . $param2 . '.jpg');
                move_uploaded_file($_FILES['upload_signature']['tmp_name'], 'uploads/pre_student_image/sign/' . $param2 . '.jpg');
                $this->crud_model->clear_cache();
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
           else{
             $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
           }
            redirect(site_url('admin/pre_exam_student_information/' . $param3), 'refresh');
        }
    }

    function delete_student($student_id = '', $class_id = ''){
      $this->crud_model->delete_student($student_id);
      $this->session->set_flashdata('flash_message' , get_phrase('student_deleted'));
      redirect(site_url('admin/student_information/' . $class_id), 'refresh');
    }
    
    function delete_house($house_id = ''){
      $this->crud_model->delete_house($house_id);
      $this->session->set_flashdata('flash_message' , get_phrase('house_deleted'));
      redirect(site_url('admin/house_information/'), 'refresh');
    }

    function delete_assign_house($assign_id = ''){
      $this->crud_model->delete_assign_house($assign_id);
      $this->session->set_flashdata('flash_message' , get_phrase('Assign_house_deleted'));
      redirect(site_url('admin/house_information/assign'), 'refresh');
    }

     ////// delete scholarship ///////////
    function delete_scholarship_student($student_id = '', $class_id = ''){
      $this->db->where('scholarship_exam_id', $student_id);
      $this->db->delete('scholarship_student');
      $this->session->set_flashdata('flash_message' , get_phrase('student_deleted'));
      redirect(site_url('admin/scholarship_exam_student_information/' . $class_id), 'refresh');
    }

     ////// delete pre ///////////
    function pre_delete_student($student_id = '', $class_id = ''){
      $this->crud_model->delete_pre_student($student_id);
      $this->session->set_flashdata('flash_message' , get_phrase('student_deleted'));
      redirect(site_url('admin/pre_exam_student_information/' . $class_id), 'refresh');
    }

    // STUDENT PROMOTION
    function student_promotion($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');
            $from_class_id =   $this->input->post('promotion_from_class_id');
            $students_of_promotion_class =   $this->db->get_where('enroll' , array(
                'class_id' => $from_class_id , 'year' => $running_year
            ))->result_array();
            foreach($students_of_promotion_class as $row) {
                $sections = $this->db->get_where('section', array('class_id' => $this->input->post('promotion_status_'.$row['student_id'])))->row_array();
                $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                $enroll_data['student_id']      =   $row['student_id'];
                $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
                $enroll_data['section_id']      =   $sections['section_id'];
                $enroll_data['year']            =   $this->input->post('promotion_year');
                $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                $this->db->insert('enroll' , $enroll_data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
            redirect(site_url('admin/student_promotion'), 'refresh');
        }

        $page_data['page_title']    = get_phrase('student_promotion');
        $page_data['active_link']  = 'student_promotion';
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector' , $page_data);
    }


     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1)
          {
        if ($param1 == 'create') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['password']               = sha1($this->input->post('password'));
            if ($this->input->post('phone') != null) {
               $data['phone'] = $this->input->post('phone');
            }
            if ($this->input->post('address') != null) {
               $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('profession') != null) {
               $data['profession'] = $this->input->post('profession');
            }
            $validation = email_validation($data['email']);
            if($validation == 1){
                $this->db->insert('parent', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('admin/parent'), 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            if ($this->input->post('phone') != null) {
               $data['phone'] = $this->input->post('phone');
            }
            else{
              $data['phone'] = null;
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            else{
               $data['address'] = null;
            }
            if ($this->input->post('profession') != null) {
                $data['profession'] = $this->input->post('profession');
            }
            else{
                $data['profession'] = null;
            }
            $validation = email_validation_for_edit($data['email'], $param2, 'parent');
            if ($validation == 1) {
                $this->db->where('parent_id' , $param2);
                $this->db->update('parent' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('admin/parent'), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/parent'), 'refresh');
        }
        $page_data['parent_list'] = $this->db->get_where('parent')->result_array();
        $page_data['page_title']    = get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $page_data['active_link']  = 'parent';
        $this->load->view('backend/index', $page_data);
          }else{
                redirect(site_url('login'), 'refresh');
          }
    }


          /****MANAGE PARENTS CLASSWISE*****/
    function parent_student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['password']               = sha1($this->input->post('password'));
            if ($this->input->post('phone') != null) {
               $data['phone'] = $this->input->post('phone');
            }
            if ($this->input->post('address') != null) {
               $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('profession') != null) {
               $data['profession'] = $this->input->post('profession');
            }
            $validation = email_validation($data['email']);
            if($validation == 1){
                $this->db->insert('parent', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
                redirect(site_url('admin/student_add'), 'refresh');
            }
        }

public function staff() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
//$page_data['parent_list'] = $this->db->get_where('parentss')->result_array();
       // print_r( $page_data['parent_list']);exit;
        $page_data['page_name']     = 'coming_soon';
        $page_data['active_link']  = 'parent';
        $page_data['page_title']    = get_phrase('parent_information');
        $this->load->view('backend/index', $page_data);

}


   public function staff_salary_paid() {
          //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('accountant_login')==1)
            {
        $page_data['active_link']  = 'staff_salary_paid';
        $page_data['page_name']  =  'staff_salary_paid';
        $page_data['page_title'] =  get_phrase('staff_salary_paid');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }

}
   public function staff_salary_unpaid() {
          //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('accountant_login')==1)
            {
        $page_data['active_link']  = 'staff_salary_unpaid';
        $page_data['page_name']  =  'staff_salary_unpaid';
        $page_data['page_title'] =  get_phrase('staff_salary_unpaid');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }

}


    function get_parents() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       /*  $columns = array(
            0 => 'parent_id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'student',
            5 => 'profession',
            6 => 'options',
            7 => 'parent_id'
        ); */

       /*  $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_parents_count();
        $totalFiltered = $totalData; */

      /*   if(empty($this->input->post('search')['value'])) {
            $parents = $this->ajaxload->all_parents($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $parents =  $this->ajaxload->parent_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->parent_search_count($search);
        } */

       /*  $data = array();
        if(!empty($parents)) {
            foreach ($parents as $row) {

                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="#" onclick="parent_edit_modal('.$row->parent_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="parent_delete_confirm('.$row->parent_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['parent_id'] = $row->parent_id;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['phone'] = $row->phone;
                
                $nestedData['student'] =Alok;
                
                $nestedData['profession'] = $row->profession;
                $nestedData['options'] = $options;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data); */
    
                                

        $page_data['parent_list'] = $this->db->get_where('parentss')->result_array();
        print_r( $page_data['parent_list']);exit;
        $page_data['page_name']     = 'parent';
        $page_data['active_link']  = 'parent';
        $page_data['page_title']    = get_phrase('parent_information');
        $this->load->view('backend/index', $page_data);

                                
                                
    }


    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']     = $this->input->post('name');
            $data['email']    = $this->input->post('email');
            $data['doj']    = date('Y-m-d',strtotime($this->input->post('timestamp')));

            
           
            $data['password'] = sha1($this->input->post('password'));
            if ($this->input->post('birthday') != null) {
                $data['birthday'] = $this->input->post('birthday');
            }
            if ($this->input->post('salary_type') != null) {
                $data['salary_type'] = $this->input->post('salary_type');
            }
            if ($this->input->post('salary_grade_id') != null) {
                $data['salary_grade_id'] = $this->input->post('salary_grade_id');
            }
            if ($this->input->post('sex') != null) {
               $data['sex'] = $this->input->post('sex');
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('phone') != null) {
                $data['phone'] = $this->input->post('phone');
            }
            if ($this->input->post('designation') != null) {
                $data['designation'] = $this->input->post('designation');
            }
            if ($this->input->post('show_on_website') != null) {
                $data['show_on_website'] = $this->input->post('show_on_website');
            }
            $data['rfid_code'] = $this->input->post('rfid');
            $links = array();
            $social['facebook'] = $this->input->post('facebook');
            $social['twitter'] = $this->input->post('twitter');
            $social['linkedin'] = $this->input->post('linkedin');
            array_push($links, $social);
            $data['social_links'] = json_encode($links);

            $validation = email_validation($data['email']);
            if($validation == 1){
                $data['otherfields'] = $this->addOtherFiels_teacher($this->input->post(),$_FILES);

                $this->db->insert('teacher', $data);
                $teacher_id = $this->db->insert_id();
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{

                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
                //print_r(validation_errors());die;
            }

            redirect(site_url('admin/teacher'), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            //$data['email']       = $this->input->post('email');

            if ($this->input->post('birthday') != null) {
                $data['birthday'] = $this->input->post('birthday');
            }
            else{
              $data['birthday'] = null;
            }
            if ($this->input->post('sex') != null) {
                $data['sex']         = $this->input->post('sex');
            }
               if ($this->input->post('salary_type') != null) {
                $data['salary_type']         = $this->input->post('salary_type');
            }
               if ($this->input->post('salary_grade_id') != null) {
                $data['salary_grade_id']         = $this->input->post('salary_grade_id');
            }
            if ($this->input->post('address') != null) {
                $data['address']     = $this->input->post('address');
            }
            else{
              $data['address'] = null;
            }
            if ($this->input->post('phone') != null) {
               $data['phone']       = $this->input->post('phone');
            }
            else{
              $data['phone'] = null;
            }
            if ($this->input->post('designation') != null) {
               $data['designation']       = $this->input->post('designation');
            }
          
            if ($this->input->post('show_on_website') != null) {
               $data['show_on_website']       = $this->input->post('show_on_website');
            }
            else{
              $data['show_on_website'] = null;
            }
            $data['rfid_code']  = $this->input->post('rfid');
            $links = array();
            $social['facebook'] = $this->input->post('facebook');
            $social['twitter']  = $this->input->post('twitter');
            $social['linkedin'] = $this->input->post('linkedin');
            array_push($links, $social);
            $data['social_links'] = json_encode($links);

                $data['otherfields'] = $this->addOtherFiels_teacher($this->input->post(),$_FILES);
                $this->db->where('teacher_id', $param2);
                $this->db->update('teacher', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
          

            redirect(site_url('admin/teacher'), 'refresh');
        }
        else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/teacher'), 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['active_link']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }

    function get_teachers() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'teacher_id',
            1 => 'photo',
            2 => 'name',
            3 => 'email',
            4 => 'phone',
            5 => 'rfid_code',
            6 => 'options',
            7 => 'teacher_id'
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

                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li>
                                    <a href="http://ijyaweb.com/college_erp/admin/teacher_profile/'.$row->teacher_id.'"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('profile').'</a></li><li class="divider"></li><li><a href="#" onclick="teacher_edit_modal('.$row->teacher_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="teacher_delete_confirm('.$row->teacher_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';
$name='<a href="http://ijyaweb.com/college_erp/admin/teacher_profile/'.$row->teacher_id.'">'.$row->name.'</a>';
                $nestedData['teacher_id'] = $row->teacher_id;
                $nestedData['photo'] = $photo;
                $nestedData['name'] = $name;
                $nestedData['email'] = $row->email;
                $nestedData['phone'] = $row->phone;
                $nestedData['rfid_code'] = $row->rfid_code;
                $nestedData['options'] = $options;

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


    /****ADD TEACHER*****/
    function teacher_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        
        $page_data['field_arr']              = $this->crud_model->registration_form_fiels_teacher();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields_teacher();
        $page_data['page_name']  = 'teacher_add';
        $page_data['active_link']  = 'teacher_add';
        $page_data['page_title'] = get_phrase('add_teacher');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {

       // echo $this->year;
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1){
        
     
        if ($param1 == 'create') {
             

            $data['name']       = $this->input->post('name');
            $links      = array();
            $arrayclass = $this->input->post('class_id');
            //$commaclass = implode(',', $arrayclass);
            //array_push($links, $social);
            //$data['class_id']   =  $commaclass;
            $data['section_id'] = $this->input->post('section_id');
            $data['year']       = $this->year;

            // if ($this->input->post('teacher_id') != null) {
            //   $data['teacher_id'] = $this->input->post('teacher_id');
            // }else{
            //   $this->session->set_flashdata('error_message' , get_phrase('Please_select_teacher'));
            //   redirect(site_url('admin/subject/'), 'refresh');   
            // }
            $count_class = count($arrayclass);
            for($i=0;$i<$count_class;$i++){
              $data['class_id']   =  $arrayclass[$i];  
              $this->db->insert('subject', $data);

            }
         
            //$this->db->insert('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //redirect(site_url('admin/subject/' . $data['class_id']), 'refresh');
            redirect(site_url('admin/subject/'), 'refresh');
            }else{
            redirect(site_url('login'), 'refresh');
            }
        }



        if ($param1 == 'competencie') {
            $data['name']       = $this->input->post('name');
             $data['marks']       = $this->input->post('mark');
            $data['weightage']       = $this->input->post('weightage');
            $links      = array();
            $arrayclass = $this->input->post('subject_id');
            $data['year']       = $this->year;
            $count_class = count($arrayclass);
            for($i=0;$i<$count_class;$i++){
              $data['subject_id']   =  $arrayclass[$i];  
              $this->db->insert('subject_competencies', $data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/subject/'), 'refresh');
        }

        if ($param1 == 'addpractial') {
            $data['name']       = $this->input->post('name');
             $data['marks']       = $this->input->post('mark');
             $data['weightage']       = $this->input->post('weightage');
            $links      = array();
            $arrayclass = $this->input->post('subject_id');
            $data['year']       = $this->year;
            $count_class = count($arrayclass);
            for($i=0;$i<$count_class;$i++){
              $data['subject_id']   =  $arrayclass[$i];  
              $this->db->insert('subject_practial', $data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/subject/'), 'refresh');
        }
        if ($param1 == 'assign') {
         

            $arrayteacher = $this->input->post('teacher_id');
            $data['subject_id']  = $this->input->post('subject_id');
            $data['section_id'] = $this->input->post('section_id');
            
            $data['year']       = $this->year;

            if($this->input->post('subject_id') != null){
           
            }else{
              $this->session->set_flashdata('error_message' , get_phrase('Please_select_teacher'));
              redirect(site_url('admin/subject/#assignlist'), 'refresh');   
            }

         
            foreach ($arrayteacher as $key => $dt){
               $data['teacher_id'] = $dt;
               $this->db->insert('assign_subject', $data);
            }
            //$this->db->insert('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //redirect(site_url('admin/subject/' . $data['class_id']), 'refresh');
            redirect(site_url('admin/subject/'), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
         
            $data['section_id'] = $this->input->post('section_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->year;
              $arrayclass = $this->input->post('class_id');
            $count_class = count($arrayclass);
            for($i=0;$i<$count_class;$i++){
              $data['class_id']   =  $arrayclass[$i];  
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);

            }
            
            

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/subject/' . $data['class_id']), 'refresh');

        }else if ($param1 == 'do_update_assign') {

             $links        = array();
            $arrayclass   = $this->input->post('subject_id');
           // $data['section_id'] = $this->input->post('section_id');
            $data['year'] = $this->year;
            
            if($this->input->post('teacher_id') != null){
              $data['teacher_id'] = $this->input->post('teacher_id');
            }else{
              $this->session->set_flashdata('error_message' , get_phrase('Please_select_teacher'));
              redirect(site_url('admin/subject/'), 'refresh');   
            }

            $data['subject_id']    = "";
            $this->db->where('teacher_id', $param2);
            $this->db->delete('assign_subject');

            foreach ($arrayclass as $key => $dt){
               $data['subject_id'] = $dt;
               $this->db->insert('assign_subject', $data);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/subject/' . $data['class_id']), 'refresh');

        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/subject/' . $param3), 'refresh');
         } 
         if ($param1 == 'delete_assign') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('assign_subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/subject/' . $param3), 'refresh');
         } 

            $page_data['class_id']  = $param1;  
            $this->db->select('*');
            $this->db->from('subject');
            //$this->db->where('entry_id', $id_entry);
           // $this->db->group_by('teacher_id');
            $result = $this->db->get()->result_array();

            $this->db->select('*');
            $this->db->from('assign_subject');
            //$this->db->where('entry_id', $id_entry);
            $this->db->group_by('teacher_id');
            $result_teacher = $this->db->get()->result_array();
            
            $this->db->select('*');
            $this->db->from('class');
            $class_subject = $this->db->get()->result_array();


        
           $this->db->select('SC.*,S.name as subject_name,C.name as class_name');
            $this->db->from('subject_competencies AS SC');
            $this->db->join('subject As S', 'S.subject_id = SC.subject_id', 'left');
            $this->db->join('class As C', 'C.class_id = S.class_id', 'left');
            $subject_competencies = $this->db->get()->result_array();
            //echo'<pre>';
            //print_r($subject_competencies);
            //echo'</pre>';
            //exit;
            $this->db->select('SP.*,S.name as subject_name,C.name as class_name');
            $this->db->from('subject_practial AS SP');
            $this->db->join('subject As S', 'S.subject_id = SP.subject_id', 'left');
            $this->db->join('class As C', 'C.class_id = S.class_id', 'left');
            $subject_practiallist = $this->db->get()->result_array();

            $page_data['subjects']   = $result; 
            $page_data['subject_competencies']= $subject_competencies;  
            $page_data['subject_practiallist']= $subject_practiallist;  
            $page_data['teacher_val']= $result_teacher; 
            $page_data['class_subject']= $class_subject;        
            $page_data['page_name']  = 'subject';
            $page_data['active_link']  = 'subject';
            $page_data['page_title'] = get_phrase('manage_subject');
            $this->load->view('backend/index', $page_data);
    }
    
   /****MANAGE CLASSE   Co-Scholastic Areas*****/  

   function co_scholastic_areas($param1 = '', $param2 = '' , $param3 = '')
   {
       if ($param1 == 'create') {
            $data['sub_name'] = $this->input->post('name');
            $links      = array();
            $arrayclass = $this->input->post('class_id'); 
            $data['year']       = $this->year;
            $count_class = count($arrayclass);
            for($i=0;$i<$count_class;$i++){
              $data['class_id']   =  $arrayclass[$i];  
              $this->db->insert('co_scholastic_subject', $data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/co_scholastic_areas/'), 'refresh');
        }  
            $this->db->select('*');
            $this->db->from('class');
            $class_subject = $this->db->get()->result_array();
            $page_data['subjects']   = $result; 
            $page_data['class_subject']= $class_subject;        
            $page_data['page_name']  = 'co_scholastic_areas';
            $page_data['active_link']  = 'co_scholastic_areas';

            $page_data['page_title'] = get_phrase('Co-Scholastic Areas');
            $this->load->view('backend/index', $page_data);
      
  }
    
   /****MANAGE CLASSE   Co-Scholastic Areas*****/    
    
    

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1){
            
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            if ($this->input->post('name_numeric') != null) {
                $data['name_numeric'] = $this->input->post('name_numeric');
                $exist_sortname =  $this->db->get_where('class',array('name_numeric'=>$data['name_numeric']))->num_rows();
                
                if($exist_sortname > 0){
                    $this->session->set_flashdata('error_message' , get_phrase('class_sort_name_already_exist_please_enter_unique_value'));
                    $this->session->set_flashdata('post_value' , $this->input->post());
                    redirect(site_url('admin/classes'), 'refresh');
                }
              

            }

            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            //create a section by default
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $data2['teacher_id']=  $data['teacher_id'];
            $this->db->insert('section' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/classes'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            if ($this->input->post('name_numeric') != null) {
                $data['name_numeric'] = $this->input->post('name_numeric');
                $exist_sortname =  $this->db->get_where('class',array('name_numeric'=>$data['name_numeric'],'class_id !='=>$param2))->num_rows();
                //print_r($exist_sortname);
                if($exist_sortname > 0){
                    $this->session->set_flashdata('error_message' , get_phrase('class_sort_name_already_exist_please_enter_unique_value'));
                    $this->session->set_flashdata('post_value' , $this->input->post());
                    redirect(site_url('admin/classes'), 'refresh');
                }

            }
            else{
               $data['name_numeric'] = null;
            }
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/classes'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/classes'), 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['active_link']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
        }else{
            redirect(site_url('login'), 'refresh');
        }
    }
    
    function get_subject($class_id)
    {
        $subject = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id)")->result_array();
        if(sizeof($subject) > 0){
            echo '<option value="">---select --</option>';
          foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
          }
        }else{
            echo '<option>Data not Found !</option>'; 
      }
    }
    
    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
           redirect(site_url('login'), 'refresh');
           // detect the first class
        if ($class_id == '')
            $class_id              =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['active_link']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['class_id']   = $class_id;
        
        $this->load->view('backend/index', $page_data);
    }

    function upload_academic_syllabus()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        if ($this->input->post('description') != null) {
           $data['description'] = $this->input->post('description');
        }
        $data['title']                  =   $this->input->post('title');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->year;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        //uploading file using codeigniter upload library
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/syllabus/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');

        $data['file_name'] = $_FILES['file_name']['name'];

        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
        redirect(site_url('admin/academic_syllabus/' . $data['class_id']), 'refresh');

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

    function delete_academic_syllabus($academic_syllabus_code) {
      $file_name = $this->db->get_where('academic_syllabus', array(
          'academic_syllabus_code' => $academic_syllabus_code
      ))->row()->file_name;
      if (file_exists('uploads/syllabus/'.$file_name)) {
        // unlink('uploads/syllabus/'.$file_name);
      }
      $this->db->where('academic_syllabus_code', $academic_syllabus_code);
      $this->db->delete('academic_syllabus');

      $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
      redirect(site_url('admin/academic_syllabus'), 'refresh');

    }

    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1){
            
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['active_link']  = 'admin_section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
        }else{
            redirect(site_url('login'), 'refresh');
        }
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']         =   $this->input->post('name');
            $data['class_id']     =   $this->input->post('class_id');
            $data['teacher_id']   =   $this->input->post('teacher_id');
            $data['perifix_code'] =   $this->input->post('perifix_code');
            if ($this->input->post('nick_name') != null) {
               $data['nick_name'] = $this->input->post('nick_name');
            }
            
            $sub_teacher = false;
            if ($this->input->post('sub_teacher') != null) {
               $data['sub_teacher_status'] = 1;
               $data['date'] = $this->input->post('date');
               //$data['section_id'] =   $this->input->post('section_id');
               $sub_teacher = true;
            }
            //print_r($data);die;
            $validation_teacher = $this->validation_teacher($data['teacher_id']);
            $validation         = duplication_of_section_on_create($data['class_id'], $data['name'],$sub_teacher);
            if($validation_teacher == 1){
                $this->db->insert('section' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            }
            else{
                if($validation_teacher == 0)
                $this->session->set_flashdata('error_message' , get_phrase('teacher_already_assigned'));
                else
                $this->session->set_flashdata('error_message' , get_phrase('duplicate_name_of_section_is_not_allowed'));

            }

            redirect(site_url('admin/section/' . $data['class_id']), 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']         =   $this->input->post('name');
            $data['class_id']     =   $this->input->post('class_id');
            $data['teacher_id']   =   $this->input->post('teacher_id');
            $data['perifix_code'] =   $this->input->post('perifix_code');
            if ($this->input->post('nick_name') != null) {
                $data['nick_name'] = $this->input->post('nick_name');
            }
            else{
                $data['nick_name'] = null;
            }
            $sub_teacher = false;
            if ($this->input->post('sub_teacher') != null) {
               $data['sub_teacher_status'] = 1;
               $sub_teacher = true;
            }

            $validation_teacher = $this->validation_teacher($data['teacher_id'],$param1);
       
            $validation         = duplication_of_section_on_edit($param2, $data['class_id'], $data['name'],$sub_teacher);
            if ($validation_teacher == 1) {
               $this->db->where('section_id' , $param2);
               $this->db->update('section' , $data);
               $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
             if($validation_teacher == 0)
                $this->session->set_flashdata('error_message' , get_phrase('teacher_already_assigned'));
             else
               $this->session->set_flashdata('error_message' , get_phrase('duplicate_name_of_section_is_not_allowed'));
            }

            redirect(site_url('admin/section/' . $data['class_id']), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/section'), 'refresh');
        }
    }

    function validation_teacher($teacher = "",$param1 = ""){
      if($param1 != ""){
        // $result = $this->db->get_where('sections',array('teacher_id'=>$teacher,'section_id != '=>$param1));
         $result = $this->db->get_where('section',array('teacher_id'=>$teacher));
        }else{
         $result = $this->db->get_where('section',array('teacher_id'=>$teacher));
        }
      
       if($result->num_rows() > 0){
        return 0;
       }else{
        return 1;
       }
    }

    function get_class_section($class_id)
    {
        echo $class_id;
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        foreach ($sections as $row) {
             $str .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
        echo $str;
    }

    function get_class_section_selectboxit($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id,'sub_teacher_status'=>0
        ))->result_array();

        print_r(json_encode($sections)); die();
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        foreach ($sections as $row) {
             $str .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
        echo $str;
    }

    function get_class_section_selector($class_id){
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/get_class_section_selector', $page_data);
    }

    function get_class_subject_selector($class_id){
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/get_class_subject_selector', $page_data);
    }

    function get_class_subject($class_id)
    {
        $subject = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id)")->result_array();
        if(sizeof($subject) > 0){
            echo '<option value="">---select --</option>';
          foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
          }
        }else{
            echo '<option>Data not Found !</option>'; 
      }
    }

    function get_class_students($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }

    function get_class_students_mass($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        echo '<div class="form-group">
                <label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
                <div class="col-sm-9">';
        foreach ($students as $row) {
             $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<div class="checkbox">
                    <label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $name .'</label>
                </div>';
        }
        echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
        echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
        echo '</div></div>';
    }



    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['deadline']= $this->input->post('deadline');
            $data['marks_submission']= $this->input->post('marks_submission');
            $data['year']    = $this->year;

            $notification_msg  = 'Add Question paper deadline OR marks submission Date.';
            $url               = json_encode(array('teacher/question_paper')); 
            $send_role         = json_encode(array(TEACHER));
            $this->add_notification($this->session->userdata('login_user_id'),1,$send_to,$send_role,$notification_msg,'question paper and marks/grades submission',$url);


            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            $this->db->insert('exam', $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/exam'), 'refresh');
        }
        
        
        if ($param1 == 'cycle') {
            $data['name']       = $this->input->post('name');
            $links      = array();
            $arrayexam = $this->input->post('exam_type');
            $data['year']       = $this->year;
            $count_exam = count($arrayexam);
            for($i=0;$i<$count_exam;$i++){
              $data['exam_id']   =  $arrayexam[$i];  
              
              $this->db->insert('exam_cycle', $data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/exam/'), 'refresh');
        }

        
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['deadline']            = $this->input->post('deadline');
            $data['marks_submission']    = $this->input->post('marks_submission');
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            else{
              $data['comment'] = null;
            }
            $data['year']    = $this->year;
            
           

            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);

            $notification_msg  = 'Update Question paper deadline OR marks submission Date.';
            $url               = json_encode(array('teacher/question_paper')); 
            $send_role         = json_encode(array(TEACHER));
            $this->add_notification($this->session->userdata('login_user_id'),1,$send_to,$send_role,$notification_msg,'question paper and marks/grades submission',$url);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/exam'), 'refresh');
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/exam'), 'refresh');
        }
            $this->db->select('EC.*,EC.name as cycle_name,E.name as exam_name');
            $this->db->from('exam_cycle AS EC');
            $this->db->join('exam As E', 'E.exam_id = EC.exam_id', 'left');
            $exam_cycle = $this->db->get()->result_array();
   
        $page_data['exams']      = $this->db->get_where('exam', array('year' => $this->year))->result_array();
        $page_data['exam_cycle']  = $exam_cycle;
        $page_data['page_name']  = 'exam';
        $page_data['active_link']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');
            if ($exam_id != '' && $class_id != '' && $receiver != '') {
            // get all the students of the selected class
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id,
                    'year' => $this->year
            ))->result_array();
            // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                
                 $receiver_phone = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
               
                if ($receiver == 'parent') {
                $parent_id =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                if($parent_id != '' || $parent_id != null) {
                 $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
                if($receiver_phone == null){
                  $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                  }
                    }
                }
                if ($receiver == 'all') {
              
                $parent_id =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;

               if($parent_id != '' || $parent_id != null) {
                 $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                             
                 if($receiver_phone == null){
                  $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                  }
                    }
                }
                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('year', $this->year);
                $marks = $this->db->get('mark')->result_array();

                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
                
                }
                // send sms
                
                $this->sms_model->send_sms( $message , $receiver_phone );
               
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
          }
          else{
            $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
          }
            redirect(site_url('admin/exam_marks_sms'), 'refresh');
        }

        $page_data['page_name']  = 'exam_marks_sms';
         $page_data['active_link']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage()
    {
        if ($this->session->userdata('admin_login') != 1)
            
            redirect(site_url('login'), 'refresh');
            $page_data['page_name']  = 'marks_manage';
            $page_data['active_link']  = 'marks_manage';
            $page_data['page_title'] = get_phrase('manage_exam_marks');
            $this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' ,$cycle_id='', $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['exam_id']    =   $exam_id;
         $page_data['cycle_id']    =   $cycle_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_manage_view';
        $page_data['active_link']  = 'marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $data['exam_id']    = $this->input->post('exam_id');
        $data['cycle_id']    = $this->input->post('cycle_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        if($data['class_id'] != '' && $data['exam_id'] != ''){
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                     'cycle_id' => $data['cycle_id'],
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']
                ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $data['student_id'] = $row['student_id'];
                     
      
                $this->db->insert('mark' , $data);
                $insert_id = $this->db->insert_id();
                
                $subject = $this->db->get_where('subject_competencies' , array('subject_id' =>$data['subject_id']))->result_array();
               foreach($subject as $row2) {
                $data1['mark_id']    = $insert_id;
                $data1['competencies_name']=$row2['name'];
                $this->db->insert('cat_mark' , $data1);
            } 
            
             $practial = $this->db->get_where('subject_practial' , array('subject_id' =>$data['subject_id']))->result_array();
               foreach($practial as $row22) {
                $data1['mark_id']    = $insert_id;
                $data1['competencies_name']=$row22['name'];
                $this->db->insert('cat_mark' , $data1);
            }
            }
        }
        redirect(site_url('admin/marks_manage_view/' . $data['exam_id'] . '/' . $data['cycle_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id']), 'refresh');
    }
    else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['active_link']  = 'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
}

    function marks_update($exam_id = '' , $cycle_id='', $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($class_id != '' && $exam_id != '') {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark' , array(
            'exam_id' => $exam_id,
              'cycle_id' => $cycle_id,
                'class_id' => $class_id,
                    'section_id' => $section_id,
                        'year' => $running_year,
                            'subject_id' => $subject_id
        ))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment));
            
            $subject = $this->db->get_where('subject_competencies' , array('subject_id' =>$row['subject_id']))->result_array();
          
             foreach($subject as $row2) { 
             $this->db->query("update cat_mark set competencies_marks='".$this->input->post('marks_'. str_replace(' ', '', $row2['name']).'_'.$row['mark_id'])."' where mark_id='".$row['mark_id']."' and competencies_name='".$row2['name']."'");
              //$this->db->query('cat_marks' , array($row['name'] => $obtained_markss ));
               } 
               
                 $practial = $this->db->get_where('subject_practial' , array('subject_id' =>$row['subject_id']))->result_array();
          
             foreach($practial as $row22) { 
             $this->db->query("update cat_mark set competencies_marks='".$this->input->post('marks_'. str_replace(' ', '', $row22['name']).'_'.$row['mark_id'])."' where mark_id='".$row['mark_id']."' and competencies_name='".$row22['name']."'");
             
               }
               
        }
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(site_url('admin/marks_manage_view/' . $exam_id . '/' . $cycle_id . '/' . $class_id . '/' . $section_id . '/' . $subject_id), 'refresh');
      }else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['active_link']  = 'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
     }
   }
    
    function marks_get_subject($class_id="",$section="")
     {
      $page_data['class_id']   = $class_id;
      $page_data['section_id'] = $section;
      $this->load->view('backend/admin/marks_get_subject' , $page_data);
    }
  function exam_get_cycle($exam_id="",$id="")
     {
      $page_data['exam_id']   = $exam_id;
      $page_data['id'] = $id;
      $this->load->view('backend/admin/marks_get_subject' , $page_data);
    }
    // TABULATION SHEET
    function tabulation_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(site_url('admin/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id']), 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(site_url('admin/tabulation_sheet'), 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name']  = 'tabulation_sheet';
        $page_data['active_link']  = 'tabulation_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);

    }

    function tabulation_sheet_print_view($class_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/admin/tabulation_sheet_print_view' , $page_data);
    }


    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');

            $validation_grade = $this->grade_validation($data);
            if ($this->input->post('comment') != null && $validation_grade == 0) {
                $data['comment'] = $this->input->post('comment');
            }

            if ($validation_grade == 0) {
             $this->db->insert('grade', $data);
             $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
             redirect(site_url('admin/grade'), 'refresh');
            }else{
             $this->session->set_flashdata('error_message' , get_phrase("Please_don\'t_enter_duplicate_value"));
             redirect(site_url('admin/grade'), 'refresh'); 
            }
           
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            else{
              $data['comment'] = null;
            }
            $validation_grade = $this->grade_validation($data,$param2);
             if ($validation_grade == 0) {
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/grade'), 'refresh');
        }else{
          $this->session->set_flashdata('error_message' , get_phrase("Please_don\'t_enter_duplicate_value"));
          redirect(site_url('admin/grade'), 'refresh');   
        }
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                'grade_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/grade'), 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['active_link']  = 'admin_grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }



    function grade_validation($grade_array,$param2=""){
     // print_r($grade_array);
    if($param2 != ""){
      $query = $this->db->query("select * FROM grade WHERE grade_id != '".$param2."' AND name = '".$grade_array['name']."' OR (mark_from >= ".$grade_array['mark_from']." AND mark_upto <= ".$grade_array['mark_upto'].")");
    }else{
       $query = $this->db->query("select * FROM grade WHERE name = '".$grade_array['name']."' OR (mark_from >= ".$grade_array['mark_from']." AND mark_upto <= ".$grade_array['mark_upto'].")");   
    }

      if($query->num_rows() > 0)
        return 1;
      else
        return 0;

    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
      
        if ($param1 == 'create') {
            if($this->input->post('class_id') != null){
               $data['class_id']       = $this->input->post('class_id');
            }
            $data['section_id']     = $this->input->post('section_id');
            $data['subject_id']     = $this->input->post('subject_id');
            // 12 AM for starting time
            if ($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 1) {
                $data['time_start'] = 24;
            }
            // 12 PM for starting time
            else if ($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 2) {
                $data['time_start'] = 12;
            }
            // otherwise for starting time
            else{
                $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            }
            // 12 AM for ending time
            if ($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 1) {
                $data['time_end'] = 24;
            }
            // 12 PM for ending time
            else if ($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 2) {
                $data['time_end'] = 12;
            }
            // otherwise for ending time
            else{
                $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            }

            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $time_start_min         = $this->input->post('time_start_min');
            $time_end_min           = $this->input->post('time_end_min');

            if($this->input->post('time_start_min') <10)
                $time_start_min = '0'.$this->input->post('time_start_min');
            if($this->input->post('time_end_min') <10)
                $time_end_min = '0'.$this->input->post('time_end_min');

            $data['com_start_min']  = $data['time_start'].'.'.$time_start_min;
            $data['com_end_min']    = $data['time_end'].'.'.$time_end_min;

            $data['day']            = $this->input->post('day');
            $data['year']           = $this->year;
            // checking duplication

            

            $array = array(
               'section_id'    => $data['section_id'],
               'class_id'      => $data['class_id'],
               'time_start'    => $data['time_start'],
               'time_end'      => $data['time_end'],
               'time_start_min'=> $data['time_start_min'],
               'time_end_min'  => $data['time_end_min'],
               'com_start_min' => $data['com_start_min'],
               'com_end_min'   => $data['com_end_min'],
               'day'           => $data['day'],
               'year'          => $data['year']
            );
            

            $validation = duplication_of_class_routine_on_create($array);
            $validation_teacher = $this->duplication_of_subject_teacher($array,$data,"");
           
            if ($validation == 1 && $validation_teacher == 1) {
                $this->db->insert('class_routine', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            }elseif($validation_teacher == 0 && $validation == 1){
                $this->session->set_flashdata('error_message' , get_phrase('already_assigned_teacher_between_time!'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('time_conflicts'));
            }

            redirect(site_url('admin/class_routine_add'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');

              // 12 AM for starting time
            if ($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 1) {
                $data['time_start'] = 24;
            }
              // 12 PM for starting time
            else if ($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 2) {
                $data['time_start'] = 12;
            }
              // otherwise for starting time
            else{
                $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            }
              // 12 AM for ending time
            if ($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 1) {
                $data['time_end'] = 24;
            }
              // 12 PM for ending time
            else if ($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 2) {
                $data['time_end'] = 12;
            }
              // otherwise for ending time
            else{
                $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            }

            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $time_start_min         = $this->input->post('time_start_min');
            $time_end_min           = $this->input->post('time_end_min');

            if($this->input->post('time_start_min') <10)
                $time_start_min = '0'.$this->input->post('time_start_min');
            if($this->input->post('time_end_min') <10)
                $time_end_min = '0'.$this->input->post('time_end_min');

            $data['com_start_min']  = $data['time_start'].'.'.$time_start_min;
            $data['com_end_min']    = $data['time_end'].'.'.$time_end_min;
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->year;
            if ($data['subject_id'] != '') {
            // checking duplication
            $array = array(
               'section_id'    => $data['section_id'],
               'class_id'      => $data['class_id'],
               'time_start'    => $data['time_start'],
               'time_end'      => $data['time_end'],
               'time_start_min'=> $data['time_start_min'],
               'time_end_min'  => $data['time_end_min'],
               'com_start_min' => $data['com_start_min'],
               'com_end_min'   => $data['com_end_min'],
               'day'           => $data['day'],
               'year'          => $data['year']
            );

            $validation        = duplication_of_class_routine_on_edit($array, $param2);
            $validation_teacher= $this->duplication_of_subject_teacher($array, $data,$param2);

            if ($validation == 1 && $validation_teacher == 1) {
                $this->db->where('class_routine_id', $param2);
                $this->db->update('class_routine', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }elseif($validation_teacher == 0 && $validation == 1){
                $this->session->set_flashdata('error_message' , get_phrase('already_assigned_teacher_this_time!'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('time_conflicts'));
            }
          }else{
            $this->session->set_flashdata('error_message' , get_phrase('subject_is_not_found'));
          }

            redirect(site_url('admin/class_routine_view/' . $data['class_id']), 'refresh');
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
            $this->db->where('class_routine_id', $param2);




            
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/class_routine_view/' . $class_id), 'refresh');
        }

    }

    function class_timetable($param1 = '', $param2 = '', $param3 = '',$param4 = '')
    {
        $page_data['page_name']       = 'class_timetable';
        $page_data['active_link']  = 'class_timetable';
        $page_data['template_data_result'] = @$this->db->get_where('class_routine_template',array('id'=>$param3))->row();
       
        $page_data['class_id']         = $param1;
        $page_data['section_id']       = $param2;
        $page_data['template_id_']     = $param3;
        $page_data['page_title']       = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }


     function duplication_of_subject_teacher($post,$data,$id=""){
       
       $qry = "select * FROM subject WHERE  teacher_id = (select teacher_id FROM subject WHERE subject_id = '".$data['subject_id']."' AND year = '".$post['year']."') AND year = '".$post['year']."'";

        $get_teacher = $this->db->query($qry)->result();
        if($get_teacher != ""){
         foreach ($get_teacher as $key => $dt) {
            if($post['time_start_min'] <10)
                $post['time_start_min']='0'.$post['time_start_min'];

            $start_time_p = $post['time_start'].'.'.$post['time_start_min'];
            
            $end_time_p   = $post['time_end'].'.'.$post['time_end_min'];
           

            if($id != ""){
              $get_value = $this->db->get_where('class_routine',array('subject_id' => $dt->subject_id,'day'=>$post['day'],'com_start_min <='=>$start_time_p,'com_end_min >' => $start_time_p,'class_routine_id !='=>$id))->num_rows();
            }else{
              $get_value = $this->db->get_where('class_routine',array('subject_id' => $dt->subject_id,'day'=>$post['day'],'com_start_min <='=>$start_time_p,'com_end_min >' => $start_time_p))->num_rows();  
            }

            if($get_value != 0){
               return 0;
            }
         }
       }
     return 1;
    }
 

    function exam_schedule($param = "", $param2 = ""){

      $class_id = "";
      $page_data['schedules']  = $this->crud_model->get_schedule_list($class_id);
      if($param == 'create'){
        $this->_prepare_schedule_validation();
        
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_schedule_data();

                $insert_id = $this->db->insert('exam_schedule', $data);
                if ($insert_id) {
                    
                    $class = $this->db->get_where('class', array('class_id'=>$data['class_id']))->row();
                    create_log('Has been created an exam schedule for class : '.$class->name);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_insert_successfully'));
                    redirect('admin/exam_schedule');
                } else {
                    $page_data['add']       = TRUE;
                    $this->session->set_flashdata('error_message' , get_phrase('data_insert_failed'));
                    redirect('admin/exam_schedule/create');
                }
            } else {
                    $page_data['post'] = $_POST;
            }
       
        }elseif($param == 'edit' && $param2 != ""){
          if ($_POST) {
            $this->_prepare_schedule_validation();
            if ($this->form_validation->run() === TRUE) {
                $data     = $this->_get_posted_schedule_data();
                $this->db->where('id',$this->input->post('id'));
                $updated = $this->db->update('exam_schedule', $data);

                if ($updated) {
                    $class = $this->db->get_where('class', array('class_id'=>$data['class_id']));
                    create_log('Has been updated an exam schedule for class : '.$class->name);
                    
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('admin/exam_schedule');
                } else {
                    $this->session->set_flashdata('error_message' , get_phrase('data_update_failed'));
                    redirect('admin/exam_schedule/edit/' . $this->input->post('id'));
                }
            } else {
               $page_data['post']     = $_POST;
               $page_data['schedule'] = $this->db->get_where('exam_schedule', array('id' => $param2))->row();
               $page_data['edit']     = TRUE; 
            }
        }else{
          $page_data['schedule'] = $this->db->get_where('exam_schedule', array('id' => $param2))->row();
          $page_data['edit']     = TRUE;
       }
    }elseif($param == 'delete' && $param2 != ""){
        $this->db->where('id', $param2);
        $this->db->delete('exam_schedule');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect('admin/exam_schedule');
    }

    if(!empty($_FILES["answersheet"]["name"])) {
        $datetime = strtotime(date('Y-m-d'));
        move_uploaded_file($_FILES["answersheet"]["tmp_name"], "uploads/exam_answer_sheet/".$datetime. $_FILES["answersheet"]["name"]);
        $data['answer_sheet_file'] = $datetime.$_FILES["answersheet"]["name"];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('exam_schedule',$data);
    }

     if($param =="")
        $page_data['list']      = TRUE;
     
        $page_data['classes']   = $this->db->get_where('class', array('status' => 1))->result();    
        $page_data['exams']     = $this->db->get('exam')->result();
        $page_data['page_name'] = 'exam_schedule';
        $page_data['active_link']  = 'exam_schedule';
        $page_data['page_title']= get_phrase('exam_schedule');
        $this->load->view('backend/index', $page_data);
}

    private function _prepare_schedule_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        $this->form_validation->set_rules('exam_marks', $this->lang->line('exam_marks'), 'trim|required');
        $this->form_validation->set_rules('subject_id', $this->lang->line('subject'), 'trim|required|callback_subject_id');
        $this->form_validation->set_rules('exam_date', $this->lang->line('exam_date'), 'trim|required');
        $this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'trim|required');
        $this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'trim|required');
        $this->form_validation->set_rules('room_no', $this->lang->line('room_no'), 'trim|required|callback_room_no');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

     private function _prepare_re_exam_schedule_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('exam', $this->lang->line('exam'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        //$this->form_validation->set_rules('subject_id', $this->lang->line('subject'), 'trim|required|callback_subject_id');
        $this->form_validation->set_rules('exam_date', $this->lang->line('exam_date'), 'trim|required');
        $this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'trim|required');
        $this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'trim|required');
        $this->form_validation->set_rules('room_no', $this->lang->line('room_no'), 'trim|required|callback_room_no');
        $this->form_validation->set_rules('comment', $this->lang->line('note'), 'trim');
    }

     public function subject_id() {

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');

        if ($this->input->post('id') == '') {
            $schedule = $this->crud_model->duplicate_check($exam_id, $class_id, $subject_id);
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $schedule = $this->crud_model->duplicate_check($exam_id, $class_id, $subject_id, $this->input->post('id'));
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

        private function _get_posted_schedule_data() {

        $items = array();
        $items[] = 'exam_id';
        $items[] = 'class_id';
        $items[] = 'subject_id';
        $items[] = 'start_time';
        $items[] = 'end_time';
        $items[] = 'exam_marks';
        $items[] = 'room_no';
        $items[] = 'note';
        $data = elements($items, $_POST);
        $data['exam_date'] = date('Y-m-d', strtotime($this->input->post('exam_date')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['year'] = $this->year;
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }

        /*****************Function room_no**********************************
    * @type            : Function
    * @function name   : room_no
    * @description     : Unique check for "room_no" in exam schedule data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function room_no() {

        $room_no = $this->input->post('room_no');
        $exam_date = date('Y-m-d', strtotime($this->input->post('exam_date')));
        $start_time = $this->input->post('start_time');

        if ($this->input->post('id') == '') {
            $schedule = $this->crud_model->duplicate_room_check($room_no, $exam_date, $start_time);
            if ($schedule) {
                $this->form_validation->set_message('room_no', $this->lang->line('this_room_already_allocated'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $schedule = $this->crud_model->duplicate_room_check($room_no, $exam_date, $start_time, $this->input->post('id'));
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('this_room_already_allocated'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }


    function class_routine_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'class_routine_add';
        $page_data['active_link']  = 'class_routine_add';
        $page_data['page_title'] = get_phrase('add_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['substitute_list'] =  $this->crud_model->substitute_details(); 
       
        $page_data['page_name']  = 'class_routine_view';
        $page_data['active_link']  = 'class_routine_view';
        $page_data['class_id']   =   $class_id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/admin/class_routine_print_view' , $page_data);
    }

    function get_class_section_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector' , $page_data);
    }
    
    

    function section_subject_edit($class_id , $class_routine_id)
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit' , $page_data);
    }

    function manage_attendance()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {
        $page_data['active_link']  = 'manage_attendance';
        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }



      
    function manage_employee_attendance()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {
        $page_data['active_link']  = 'manage_employee_attendance';
        $page_data['page_name']  =  'manage_employee_attendance';
        $page_data['page_title'] =  get_phrase('manage_employee_attendance');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


     function school_income()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('accountant_login')==1)
            {

        $page_data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
        //print_r($this->data['classes']);die();
        $page_data['income_heads'] = $this->invoice->get_fee_type();         
        $page_data['invoices']     = $this->invoice->get_invoice_list(); 
        $sum = $this->db->query('SELECT SUM(net_amount) as sum FROM `invoices`')->result_array(); 
        $page_data['sum_amount'] = $sum[0]['sum'];
        $page_data['unpaid']         = FALSE;
        $page_data['list']         = TRUE;
        $page_data['active_link']  = 'school_income';
        $page_data['page_name']  =  'school_income';
        $page_data['page_title'] =  get_phrase('school_income');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


       function export_school_income()
          {
        $classes = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
        //print_r($this->data['classes']);die();
        $income_heads = $this->invoice->get_fee_type();         
        $invoices     = $this->invoice->get_invoice_list();         
            
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'invoice number');
        $sheet->setCellValue('C1', 'student');
        $sheet->setCellValue('D1', 'class');
        $sheet->setCellValue('E1', 'fee type');
        $sheet->setCellValue('F1', 'gross_amount');
        $sheet->setCellValue('G1', 'discount');  
        $sheet->setCellValue('H1', 'net_amount');
        $sheet->setCellValue('I1', 'payment status');
        
        $rows = 2;
           $count = 1;
           if(isset($invoices) && !empty($invoices)){
              foreach($invoices as $obj){
                if(!$unpaid && $obj->paid_status=='paid'){
            $sheet->setCellValue('A' . $rows, $count++);
            $sheet->setCellValue('B' . $rows, $obj->custom_invoice_id);
           
            $sheet->setCellValue('C' . $rows, $obj->student_name);
            $sheet->setCellValue('D' . $rows, $obj->class_name);
             $sheet->setCellValue('E' . $rows, $obj->head);
           
            $sheet->setCellValue('F' . $rows, $obj->gross_amount);
            $sheet->setCellValue('G' . $rows, $obj->discount);

            $sheet->setCellValue('H' . $rows, $obj->net_amount);
            $sheet->setCellValue('I' . $rows, get_paid_status($obj->paid_status));


            $rows++;
        }
       }
      } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'School-income-report';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
    }
    
    
    

    function add_advance_pay()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('accountant_login')==1)
            {
        $page_data['active_link']  = 'add_advance_pay';
        $page_data['page_name']  =  'add_advance_pay';
        $page_data['page_title'] =  get_phrase('add_advance_pay');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }

      function manage_account_report()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('accountant_login')==1)
            {
        $page_data['active_link']  = 'manage_account_report';
        $page_data['page_name']  =  'manage_account_report';
        $page_data['page_title'] =  get_phrase('manage_account_report');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


         function manage_account_expenses_report()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {
        $page_data['active_link']  = 'manage_account_expenses_report';
        $page_data['page_name']  =  'manage_account_expenses_report';
        $page_data['page_title'] =  get_phrase('manage_account_expenses_report');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


      function manage_transport_report()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {
        $page_data['active_link']  = 'manage_transport_report';
        $page_data['page_name']  =  'manage_transport_report';
        $page_data['page_title'] =  get_phrase('manage_transport_report');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


         function manage_inventory_report()
    {
        //print_r($_SESSION);die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('role_id')==17)
            {
        $page_data['active_link']  = 'manage_inventory_report';
        $page_data['page_name']  =  'manage_inventory_report';
        $page_data['page_title'] =  get_phrase('manage_inventory_report');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }
    
    
     function manage_travel_report()
    {
        //print_r($this->session->userdata('teacher_login'));die;
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('transport_login')==1)
            {
        $page_data['active_link']  = 'manage_inventory_report';
        $page_data['page_name']  =  'manage_transport_report_new';
        $page_data['page_title'] =  'Manage Transport Report';
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }


      public function transport_school_excel()
      {

     if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('transport_login')==1)
            {
        $page_data['active_link']  = 'transport_school_excel';
        $page_data['page_name']  =  'transport_school_excel';
        $page_data['page_title'] =  'Manage Transport Report';
        $page_data['datefrm'] = $this->input->post('datefrm');
        $page_data['dateto'] = $this->input->post('dateto');

        // $page_data['month_name'] = date('F', mktime(0, 0, 0, $page_data['month'], 10));
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }

       }
       
       
        public function hostel_roomchange_excel()
      {

     if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {
                
        $page_data['active_link']  = 'hostel_roomchange_excel';
        $page_data['page_name']  =  'hostel_roomchange_excel';
        $page_data['page_title'] =  'Manage Transport Report';
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }

       }
       
       


    


    
    function teacher_manage_attendance()
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            {

        $page_data['page_name']  =  'teacher_manage_attendance';
        $page_data['active_link']  = 'teacher_manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_teacher');
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(site_url('login'), 'refresh');
            }
    }
    
    
    
    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
           {

        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id']  = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $page_data['active_link']  = 'manage_attendance_view';
        $section_name = $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('manage_attendance_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
            }
    }





    function manage_attendance_employee_view($class_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
           {

        $page_data['class_id']  = $class_id;
        $page_data['timestamp'] = time('Y-m-d');
        if(isset($timestamp)){
        $page_data['timestamp'] = $timestamp;    
        }
        $page_data['page_name'] = 'manage_attendance_employee_view';
        $page_data['active_link']  = 'manage_attendance_employee_view';
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
            }
    }

  function manage_attendance_employee_view_hostel($class_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('role_id')==13)
           {

        $page_data['class_id']  = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['mode']  = FALSE;
        $page_data['page_name'] = 'manage_attendance_employee_view_hostel';
        $page_data['active_link']  = 'manage_attendance_employee_view_hostel';
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
            }
    }
    
    function manage_attendance_employee_view_hostel_member($class_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 || $this->session->userdata('role_id')==13)
           {

        $page_data['class_id']  = $class_id;
        $page_data['mode']  = TRUE;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_employee_view_hostel';
        $page_data['active_link']  = 'manage_attendance_employee_view_hostel';
        $this->load->view('backend/index', $page_data);
           }else{
                redirect(site_url('login'), 'refresh');
            }
    }


    #teacher Attendence managed by view
        
    function teacher_manage_attendance_view( $timestamp = '')
    {
       if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
        {
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'teacher_manage_attendance_view';
        $page_data['active_link']  = 'teacher_manage_attendance_view';
    
        $page_data['page_title'] = get_phrase('manage_attendance_of_teacher');
        $this->load->view('backend/index', $page_data);
        }else{
                redirect(site_url('login'), 'refresh');
            }
    }
    
      function teacher_manage_attendance_out_time( $timestamp = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            redirect(site_url('login'), 'refresh');
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'teacher_manage_attendance_out_time';
        $page_data['active_link']  = 'teacher_manage_attendance_out_time';
    
        $page_data['page_title'] = get_phrase('teacher_manage_attendance_out_time');
        $this->load->view('backend/index', $page_data);
    }



       function attendance_employee_selector()
       {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        
        $mode= is_numeric($this->input->post('mode'))? $this->input->post('mode'): 2;
        $designations = $this->db->get_where('designations', array('id' => $data['class_id']
             ))->result_array();

         $designations_name = $designations[0]['name'];

        

        $designations_data = $this->db->get(lcfirst($designations_name))->result_array();

        $primary_id = lcfirst($designations_name)."_id";
// echo $data['timestamp'];
// //echo date('Y-m-d',strtotime($this->input->post('timestamp')));
// die;
         foreach($designations_data as $row){
                $query = $this->db->get_where('attendance_employee' ,array(
                   'designation_id' => $data['class_id'],
                     'employee_id' => $row[$primary_id],
                       'timestamp' => $data['timestamp'],

                    ));

             if($query->num_rows() < 1){
                $attn_data['designation_id']   = $data['class_id'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['date']  = date('Y-m-d',strtotime($this->input->post('timestamp')));
                $attn_data['employee_id'] = $row[$primary_id];
                $this->db->insert('attendance_employee' , $attn_data);
              }
        }
        if($mode==0){
            redirect(site_url('admin/manage_attendance_employee_view_hostel/' . $data['class_id'] . '/' . $data['timestamp']),'refresh');
        }
         if($mode==1){
            redirect(site_url('admin/manage_attendance_employee_view_hostel_member/' . $data['class_id'] . '/' . $data['timestamp']),'refresh');
        }
        redirect(site_url('admin/manage_attendance_employee_view/' . $data['class_id'] . '/' . $data['timestamp']),'refresh');
    }


    function advance_add_pay(){
        $data['designation_id']   = $this->input->post('class_id');
        $data['date']       = $this->input->post('timestamp');
        $data['employee_id']  = $this->input->post('section_id');
        $data['amount']  = $this->input->post('email');


                $attn_data['designation_id']   = $data['designation_id'];
                $attn_data['date']  = date('Y-m-d',strtotime($data['date']));
                $attn_data['amount']  = $data['amount'];
                $attn_data['employee_id'] = $data['employee_id'];
                $this->db->insert('advance_pay', $attn_data);
                $this->session->set_flashdata('flash_message' , get_phrase('Adavance_Payment _sucessfully_Added'));
             redirect(site_url('admin/add_advance_pay/','refresh'));
        }
        

        

    function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
        $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row){
                $query = $this->db->get_where('attendance' ,array(
                   'class_id' => $data['class_id'],
                     'section_id' => $data['section_id'],
                       'year' => $data['year'],
                        'timestamp' => $data['timestamp'],
                            'student_id'=> $row['student_id']
                ));

              if($query->num_rows() < 1){
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);
              }
        }
        redirect(site_url('admin/manage_attendance_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['timestamp']),'refresh');
    }
#teacher attendence selector by year
   function teacher_attendance_selector()
    {
      
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        $teacher = $this->db->get_where('teacher' , array(
                'status' => 1
            ))->result_array();
            foreach($teacher as $row){
                $query = $this->db->get_where('emp_attendance' ,array(
                 
                       'year' => $data['year'],
                       'timestamp' => $data['timestamp'],
                       'emp_id'=> $row['teacher_id'],
                       'role_id'=> 5
                ));

              if($query->num_rows() < 1){
               
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];            
                $attn_data['emp_id'] = $row['teacher_id'];              
                $attn_data['role_id'] = 5;
                $attn_data['create_emp_id']=logged_in_user_id();
                $attn_data['create_role_id'] = logged_in_role_id();
                $this->db->insert('emp_attendance' , $attn_data);
              }
        }
        redirect(site_url('admin/teacher_manage_attendance_view/' . $data['timestamp']),'refresh');
    }

    
    
    
    
    function teacher_attendance_update( $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_teacher = $this->db->get_where('emp_attendance' , array(
           'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_teacher as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $out_status = $this->input->post('outstatus_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('emp_attendance' , array('status' => $attendance_status));
            if($out_status==1){
                
                $out_time = date('Y-m-d h:i:s', time());
                $this->db->where('attendance_id' , $row['attendance_id']);
                $this->db->update('emp_attendance' , array('out_status' =>$out_status,'out_time'=>$out_time));
            }
            if($out_status==0){
                
                $this->db->where('attendance_id' , $row['attendance_id']);
                $this->db->update('emp_attendance' , array('out_status' =>$out_status,'out_time'=>0));
            }
            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $teacher_name   = $this->db->get_where('teacher' , array('teacher_id' => $row['emp_id']))->row()->name;   
           $admin_email = $this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;                   
           $receiver_phone = $this->db->get_where('settings' , array('type' => 'phone'))->row()->description;                   
                    $message        = 'Teacher ' . ' ' . $teacher_name . 'is absent today.';
                   
                    
                        if($receiver_phone != '' || $receiver_phone != null){
                            $this->sms_model->send_sms($message,$receiver_phone);
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(site_url('admin/teacher_manage_attendance_view/'.$timestamp) , 'refresh');
    }
    
    
    
    
  function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    if($parent_id != null && $parent_id != 0){
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        if($receiver_phone != '' || $receiver_phone != null){
                            $this->sms_model->send_sms($message,$receiver_phone);
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    }
                    else{
                        $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                    }
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(site_url('admin/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp) , 'refresh');
    }
       


  function attendance_employee_update($class_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance_employee' , array(
            'designation_id'=>$class_id,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance_employee' , array('status' => $attendance_status));
            if ($attendance_status == 2) {

                // if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                //     $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                //     $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                //     $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                //     if($parent_id != null && $parent_id != 0){
                //         $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                //         if($receiver_phone != '' || $receiver_phone != null){
                //             $this->sms_model->send_sms($message,$receiver_phone);
                //         }
                //         else{
                //             $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                //         }
                //     }
                //     else{
                //         $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                //     }
                // }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(site_url('admin/manage_attendance_employee_view/'.$class_id.'/'.$timestamp) , 'refresh');
    }





    /****** DAILY ATTENDANCE *****************/
    function manage_attendance2($date='',$month='',$year='',$class_id='' , $section_id = '' , $session = '')
    {
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
            redirect(site_url('login') , 'refresh');

        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        if($_POST)
        {
            // Loop all the students of $class_id
            $this->db->where('class_id' , $class_id);
            if($section_id != '') {
                $this->db->where('section_id' , $section_id);
            }
            //$session = base64_decode( urldecode( $session ) );
            $this->db->where('year' , $session);
            $students = $this->db->get('enroll')->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $date);
                $this->db->where('year' , $year);
                $this->db->where('class_id' , $row['class_id']);
                if($row['section_id'] != '' && $row['section_id'] != 0) {
                    $this->db->where('section_id' , $row['section_id']);
                }
                $this->db->where('session' , $session);

                $this->db->update('attendance' , array('status' => $attendance_status));

                if ($attendance_status == 2) {

                    if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        $this->sms_model->send_sms($message,$receiver_phone);
                    }
                }

            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id.'/'.$section_id.'/'.$session) , 'refresh');
        }
        $page_data['date']       =  $date;
        $page_data['month']      =  $month;
        $page_data['year']       =  $year;
        $page_data['class_id']   =  $class_id;
        $page_data['section_id'] =  $section_id;
        $page_data['session']    =  $session;

        $page_data['page_name']  =  'manage_attendance';
        $page_data['active_link']  = 'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_daily_attendance');
        $this->load->view('backend/index', $page_data);
    }
    function attendance_selector2()
    {
        //$session = $this->input->post('session');
        //$encoded_session = urlencode( base64_encode( $session ) );
        redirect(site_url('admin/manage_attendance/'.$this->input->post('date').'/'.
                    $this->input->post('month').'/'.
                        $this->input->post('year').'/'.
                            $this->input->post('class_id').'/'.
                                $this->input->post('section_id').'/'.
                                    $this->input->post('session')) , 'refresh');
    }
    
    ///////ATTENDANCE REPORT /////
    function attendance_report() {
        
        if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 )
{
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['active_link']  = 'attendance_report';
         $page_data['page_title']   = get_phrase('attendance_report');
         $this->load->view('backend/index',$page_data);
}else{
                redirect(site_url('login'), 'refresh');
            }
     }



         ///////ATTENDANCE EMPLOYEE REPORT /////
    function attendance_employee_report() {
        
      if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1)
         {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_employee_report';
         $page_data['active_link']  = 'attendance_employee_report';
         $page_data['page_title']   = get_phrase('attendance_employee_report');
         $this->load->view('backend/index',$page_data);
       } else {
                redirect(site_url('login'), 'refresh');
      }
    }

        ///////TEACHER ATTENDANCE REPORT /////
    function teacher_attendance_report() {
        
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

         $page_data['month']        = date('m');
         $page_data['page_name']    = 'teacher_attendance_report';
         $page_data['active_link']  = 'teacher_attendance_report';
         $page_data['page_title']   = get_phrase('teacher_attendance_report');
         $this->load->view('backend/index',$page_data);
     }

     
     
     function attendance_report_view($class_id = '',$section_id = '',$month = '',$sessional_year = '')
     {
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1){
            
        $class_id=$_POST['class_id'];
        $section_id=$_POST['section_id'];
        $to=$_POST['to'];
        $from=$_POST['from'];
        $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['to']             = $to;
        $page_data['from']    = $from;
        $page_data['page_name']         = 'attendance_report_view';
        $page_data['active_link']  = 'attendance_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/indexte', $page_data);
         }else{
             redirect(base_url() , 'refresh');
         }
     }


    function attendance_report_employee_view($class_id = '', $month = '', $sessional_year = '')
     {
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1){
            

        $class_name                     = $this->db->get_where('designations', array('id' => $class_id))->row()->name;
        
        $page_data['class_id']          = $class_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['page_name']         = 'attendance_employee_report_view';
        $page_data['active_link']  = 'attendance_employee_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_employee') . ' ' . $class_name;
        $this->load->view('backend/indexte', $page_data);
     }else{
         redirect(base_url() , 'refresh');
     }
     }
     function attendance_report_employee_single_view($class_id = '', $month = '', $sessional_year = '',$employee='')
     {
         if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $class_name                     = $this->db->get_where('designations', array('id' => $class_id))->row()->name;
        
        $page_data['class_id']          = $class_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['employee']    = $employee;
        $page_data['page_name']         = 'attendance_report_employee_single_view';
        $page_data['active_link']  = 'attendance_report_employee_single_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_employee') . ' ' . $class_name;
        $this->load->view('backend/admin/attendance_report_employee_single_view', $page_data);
     }

       function teacher_attendance_report_view( $month = '', $sessional_year = '')
     {
         if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['page_name']         = 'teacher_attendance_report_view';
        $page_data['active_link']  = 'teacher_attendance_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_teacher');
        $this->load->view('backend/index', $page_data);
     }
     
     function attendance_report_print_view($class_id ='' , $section_id = '' ,$from = '', $to = '',  $month = '', $sessional_year = '') {
          if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        
         $page_data['from']             = $from;
        $page_data['to']             = $to;
        $page_data['sessional_year']    = $sessional_year;
        $this->load->view('backend/admin/attendance_report_print_view' , $page_data);
    }
    function attendance_report_single_view($class_id ='' , $section_id = '' ,  $from = '', $to = '', $sessional_year = '', $student_id = '') {
          if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['from']             = $from;
        $page_data['to']             = $to;
        $page_data['sessional_year']    = $sessional_year;
         $page_data['student_id']    = $student_id;
        $this->load->view('backend/admin/attendance_report_single_view' , $page_data);
    }



     function attendance_report_employee_selector()
    {   if($this->input->post('class_id') == '' || $this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_employee_and_sessional_year_are_selected'));
            redirect(site_url('admin/attendance_employee_report'), 'refresh');
        }

        $data['class_id']       = $this->input->post('class_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(site_url('admin/attendance_report_employee_view/' . $data['class_id'] . '/' . $data['month'] . '/' . $data['sessional_year']), 'refresh');
    }
    
    

    function attendance_report_selector()
    {   if($this->input->post('class_id') == '' || $this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(site_url('admin/attendance_report'), 'refresh');
        }

        $data['class_id']       = $this->input->post('class_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(site_url('admin/attendance_report_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['sessional_year']), 'refresh');
    }
    
    
    function teacher_attendance_report_selector()
    {   if($this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(site_url('admin/attendance_report'), 'refresh');
        }
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(site_url('admin/teacher_attendance_report_view/' . $data['month'] . '/' . $data['sessional_year']), 'refresh');
    }

    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }

            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data2['description']    = $this->input->post('description');
            }
            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/student_payment'), 'refresh');
        }

        if ($param1 == 'create_mass_invoice') {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id']         = $id;
                $data['title']              = $this->input->post('title');
                $data['description']        = $this->input->post('description');
                $data['amount']             = $this->input->post('amount');
                $data['amount_paid']        = $this->input->post('amount_paid');
                $data['due']                = $data['amount'] - $data['amount_paid'];
                $data['status']             = $this->input->post('status');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));
                $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id']        =   $invoice_id;
                $data2['student_id']        =   $id;
                $data2['title']             =   $this->input->post('title');
                $data2['description']       =   $this->input->post('description');
                $data2['payment_type']      =  'income';
                $data2['method']            =   $this->input->post('method');
                $data2['amount']            =   $this->input->post('amount_paid');
                $data2['timestamp']         =   strtotime($this->input->post('date'));
                $data2['year']               =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('payment' , $data2);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/student_payment'), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/income'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
            $data['description']  =   $this->input->post('description');
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $data['year']         =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   $this->input->post('amount');
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(site_url('admin/income'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/income'), 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['active_link']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function income($param1 = 'invoices', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name'] = 'income';
        $page_data['active_link']  = 'income';
        $page_data['inner'] = $param1;
        $page_data['page_title'] = get_phrase('student_payments');
        $this->load->view('backend/index', $page_data);
    }

    function get_invoices() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'invoice_id',
            1 => 'student',
            2 => 'title',
            3 => 'total',
            4 => 'paid',
            5 => 'status',
            6 => 'date',
            7 => 'options',
            8 => 'invoice_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_invoices_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $invoices = $this->ajaxload->all_invoices($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $invoices =  $this->ajaxload->invoice_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->invoice_search_count($search);
        }

        $data = array();
        if(!empty($invoices)) {
            foreach ($invoices as $row) {

                if ($row->due == 0) {
                    $status = '<button class="btn btn-success btn-xs">'.get_phrase('paid').'</button>';
                    $payment_option = '';
                } else {
                    $status = '<button class="btn btn-danger btn-xs">'.get_phrase('unpaid').'</button>';
                    $payment_option = '<li><a href="#" onclick="invoice_pay_modal('.$row->invoice_id.')"><i class="entypo-bookmarks"></i>&nbsp;'.get_phrase('take_payment').'</a></li><li class="divider"></li>';
                }


                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu">'.$payment_option.'<li><a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.get_phrase('view_invoice').'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_edit_modal('.$row->invoice_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_delete_confirm('.$row->invoice_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['invoice_id'] = $row->invoice_id;
                $nestedData['student'] = $this->crud_model->get_type_name_by_id('student',$row->student_id);
                $nestedData['title'] = $row->title;
                $nestedData['total'] = $row->amount;
                $nestedData['paid'] = $row->amount_paid;
                $nestedData['status'] = $status;
                $nestedData['date'] = date('d M,Y', $row->creation_timestamp);
                $nestedData['options'] = $options;

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

    function get_payments() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'payment_id',
            1 => 'title',
            2 => 'description',
            3 => 'method',
            4 => 'amount',
            5 => 'date',
            6 => 'options',
            7 => 'payment_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_payments_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $payments = $this->ajaxload->all_payments($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $payments =  $this->ajaxload->payment_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->payment_search_count($search);
        }

        $data = array();
        if(!empty($payments)) {
            foreach ($payments as $row) {

                if ($row->method == 1)
                    $method = get_phrase('cash');
                else if ($row->method == 2)
                    $method = get_phrase('cheque');
                else if ($row->method == 3)
                    $method = get_phrase('card');
                else if ($row->method == 'Paypal')
                    $method = 'Paypal';
                else
                    $method = 'Stripe';


                $options = '<a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.get_phrase('view_invoice').'</a>';

                $nestedData['payment_id'] = $row->payment_id;
                $nestedData['title'] = $row->title;
                $nestedData['description'] = $row->description;
                $nestedData['method'] = $method;
                $nestedData['amount'] = $row->amount;
                $nestedData['date'] = date('d M,Y', $row->timestamp);
                $nestedData['options'] = $options;

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

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'student_payment';
        $page_data['active_link']  = 'student_payment';
        $page_data['page_title'] = get_phrase('create_student_payment');
        $this->load->view('backend/index', $page_data);
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']     =   $this->input->post('description');
            }
            $this->db->insert('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/expense'), 'refresh');
        }

        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']     =   $this->input->post('description');
            }
            else{
                $data['description']     =   null;
            }
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/expense'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/expense'), 'refresh');
        }

        $page_data['page_name']  = 'expense';
        $page_data['active_link']  = 'expense';
        $page_data['page_title'] = get_phrase('expenses');
        $this->load->view('backend/index', $page_data);
    }

    function get_expenses() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'payment_id',
            1 => 'title',
            2 => 'category',
            3 => 'method',
            4 => 'amount',
            5 => 'date',
            6 => 'options',
            7 => 'payment_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_expenses_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $expenses = $this->ajaxload->all_expenses($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $expenses =  $this->ajaxload->expense_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->expense_search_count($search);
        }

        $data = array();
        if(!empty($expenses)) {
            foreach ($expenses as $row) {
                $category = $this->db->get_where('expense_category', array('expense_category_id' => $row->expense_category_id))->row()->name;
                if ($row->method == 1)
                    $method = get_phrase('cash');
                else if ($row->method == 2)
                    $method = get_phrase('cheque');
                else
                    $method = get_phrase('card');
                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="#" onclick="expense_edit_modal('.$row->payment_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="expense_delete_confirm('.$row->payment_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['payment_id'] = $row->payment_id;
                $nestedData['title'] = $row->title;
                $nestedData['category'] = $category;
                $nestedData['method'] = $method;
                $nestedData['amount'] = $row->amount;
                $nestedData['date'] = date('d M,Y', $row->timestamp);
                $nestedData['options'] = $options;

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

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/expense_category'), 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/expense_category'), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/expense_category'), 'refresh');
        }

        $page_data['page_name']  = 'expense_category';
        $page_data['active_link']  = 'expense_category';
        $page_data['page_title'] = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }
            if(!empty($_FILES["file_name"]["name"])) {
                $data['file_name'] = $_FILES["file_name"]["name"];
            }

            $this->db->insert('book', $data);

            if(!empty($_FILES["file_name"]["name"])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/book'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            else{
               $data['description'] = null;
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            else{
                $data['price'] = null;
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }
            else{
               $data['author'] = null;
            }

            if(!empty($_FILES["file_name"]["name"])) {
                $data['file_name'] = $_FILES["file_name"]["name"];
            }

            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);

            if(!empty($_FILES["file_name"]["name"])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/book'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/book'), 'refresh');
        }
        // $this->output->enable_profiler(TRUE);
        $page_data['page_name']  = 'book';
        $page_data['active_link']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }

    function get_books() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'book_id',
            1 => 'name',
            2 => 'author',
            3 => 'description',
            4 => 'price',
            5 => 'class',
            6 => 'total_copies',
            7 => 'download',
            8 => 'options',
            9 => 'book_id'
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
                    $download = '<a href="'.base_url("uploads/document/$row->file_name").'" target="_blank" class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>'.get_phrase('download').'</a>';

                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="#" onclick="book_edit_modal('.$row->book_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="book_delete_confirm('.$row->book_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['book_id'] = $row->book_id;
                $nestedData['name'] = $row->name;
                $nestedData['author'] = $row->author;
                $nestedData['description'] = $row->description;
                $nestedData['price'] = $row->price;
                $nestedData['class'] = $this->db->get_where('class', array('class_id' => $row->class_id))->row()->name;
                $nestedData['total_copies'] = $row->total_copies;
                $nestedData['download'] = $download;
                $nestedData['options'] = $options;

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
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            if ($this->input->post('description') != null) {
               $data['description']    = $this->input->post('description');
            }
            if ($this->input->post('route_fare') != null) {
               $data['route_fare']     = $this->input->post('route_fare');
            }

            $this->db->insert('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/transport'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            if ($this->input->post('description') != null) {
               $data['description']    = $this->input->post('description');
            }
            else{
                $data['description'] = null;
            }
            if ($this->input->post('route_fare') != null) {
               $data['route_fare']   = $this->input->post('route_fare');
            }
            else{
                $data['route_fare']  = null;
            }

            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/transport'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/transport'), 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['active_link']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }

            $this->db->insert('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/dormitory'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }
            else{
                $data['description'] = null;
            }
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/dormitory'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
            ))->result_array();
        }

        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/dormitory'), 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
         $page_data['active_link']  = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);

    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        	 if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1|| $this->session->userdata('transport_login') == 1){
            

         if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['show_on_website']  = $this->input->post('show_on_website');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            if ($_FILES['image']['name'] != '') {
              $data['image']  = $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/frontend/noticeboard/'. $_FILES['image']['name']);
            }
            $this->db->insert('noticeboard', $data);
                $date = date('d-m-Y');
                
                $data_notics['title'] = 'New Notice ' .$date;
                $data_notics['create_by_role'] = 1;
                $data_notics['create_user_id'] = 1;
                $data_notics['status'] = 1;
                $data_notics['msg'] = 'New Notice name '  .$data['notice_title'];
     $send_to_all =$this->input->post('send_to_all');
          if($send_to_all==1){
             $this->db->insert('notification_alert', $data_notics);
          }
              $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/noticeboard'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $image = $this->db->get_where('noticeboard', array('notice_id' => $param2))->row()->image;
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['show_on_website']  = $this->input->post('show_on_website');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            if ($_FILES['image']['name'] != '') {
              $data['image']  = $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/frontend/noticeboard/'. $_FILES['image']['name']);
            } else {
              $data['image']  = $image;
            }

            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/noticeboard'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/noticeboard'), 'refresh');
        }
        if ($param1 == 'mark_as_archive') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 0));
            redirect(site_url('admin/noticeboard'), 'refresh');
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 1));
            redirect(site_url('admin/noticeboard'), 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['active_link']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $this->load->view('backend/index', $page_data);
        	 }else{
        	     redirect(site_url('login'), 'refresh');
        	 }
    }

    function noticeboard_edit($notice_id) {
      if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');

      $page_data['page_name']  = 'noticeboard_edit';
      $page_data['active_link']  = 'noticeboard_edit';
      $page_data['notice_id'] = $notice_id;
      $page_data['page_title'] = get_phrase('edit_notice');
      $this->load->view('backend/index', $page_data);
    }

    function reload_noticeboard() {
        $this->load->view('backend/admin/noticeboard');
    }
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $submit    = $this->input->post('submit');



        $max_size = 2097152;
        if ($param1 == 'send_new') {
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('admin/message/message_new'), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              } 
            }

            $message_thread_code = $this->crud_model->send_new_private_message();
        
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('admin/message/message_read/' . $message_thread_code), 'refresh');
        }

        if ($param1 == 'send_reply') {


         $reciever    = $this->input->post('reciever');
         

         //print_r($reciever); exit;
         $reciever = explode('-', $reciever);
           $reciever_type = $reciever[0];
            $reciever_id = $reciever[1];
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('admin/message/message_read/' . $param2), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }
          
            if($submit == 'sendsms'){
            $this->send_sms();
            } else {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            }

            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
         redirect(site_url('admin/message/message_read/' . $param2), 'refresh');
            //redirect(site_url('admin/message/'), 'refresh');
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

       function message_group_create_by_admin() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name'] = 'create_group';
        $page_data['active_link']  = 'create_group';
        
        $page_data['page_title'] = get_phrase('message_group_create');
        $this->load->view('backend/index', $page_data);
    }
    
    function group_message($param1 = "group_message_home", $param2 = ""){
      if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');
      $max_size = 2097152;
      if ($param1 == "create_group") {
        $this->crud_model->create_group();
      }
      elseif ($param1 == "edit_group") {
        $this->crud_model->update_group($param2);
      }
      elseif ($param1 == 'group_message_read') {
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
            redirect(site_url('admin/group_message/group_message_read/' . $param2), 'refresh');
          }
          else{
            $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
          }
        }

        $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(site_url('admin/group_message/group_message_read/' . $param2), 'refresh');
      }
      $page_data['message_inner_page_name']   = $param1;
      $page_data['page_name']                 = 'group_message';
      $page_data['active_link']  = 'group_message';
      $page_data['page_title']                = get_phrase('group_messaging');
      $this->load->view('backend/index', $page_data);
    }
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'do_update') {

            if (isset($_POST['disable_frontend'])) {
                $data['description'] = 1;
                $this->db->where('type', 'disable_frontend');
                $this->db->update('settings' , $data);
            }
            else{
              $data['description'] = 0;
              $this->db->where('type', 'disable_frontend');
              $this->db->update('settings' , $data);
            }
            
            
            
            if (isset($_POST['notifications_alert'])) {
                $data['description'] = 1;
                $this->db->where('type', 'notifications_alert');
                $this->db->update('settings' , $data);
            }
            else{
              $data['description'] = 0;
              $this->db->where('type', 'notifications_alert');
              $this->db->update('settings' , $data);
            }
            
            
            if (isset($_POST['subject_wise_attendence'])) {
                $data['description'] = 1;
                $this->db->where('type', 'subject_wise_attendence');
                $this->db->update('settings' , $data);
            }
            else{
              $data['description'] = 0;
              $this->db->where('type', 'subject_wise_attendence');
              $this->db->update('settings' , $data);
            }
            $this->update_default_controller();

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);
                 /* Address  start */
            $data['description'] = $this->input->post('route_start');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('route_start_lat');
            $this->db->where('type' , ' latitude');
            $this->db->update('settings' , $data);

             $data['description'] = $this->input->post('route_start_lng');
            $this->db->where('type' , 'longitude');
            $this->db->update('settings' , $data);

                 /* Address  end*/

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('code');
            $this->db->where('type' , 'perifix_code');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('purchase_code');
            $this->db->where('type' , 'purchase_code');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('marks_setting');
            $this->db->where('type' , 'marks_setting');
            $this->db->update('settings' , $data);
            
            $data['description'] = $this->input->post('board_setting');
            $this->db->where('type' , 'board_setting');
            $this->db->update('settings' , $data);
            $data['description'] = $this->input->post('school_start_time');
            $this->db->where('type' , 'school_start_time');
            $this->db->update('settings' , $data);
            
            $data['description'] = $this->input->post('school_end_time');
            $this->db->where('type' , 'school_end_time');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('school_session_end_date');
            $this->db->where('type' , 'school_session_end_date');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('registration_fees');
            $this->db->where('type' , 'registration_fees');
            $this->db->update('settings' , $data);
            
            $data_array['cname']    = $this->input->post('system_name');
            $data_array['email']    = $this->input->post('system_email');
            $data_array['address']  = $this->input->post('address');
            $data_array['lang'] = $this->input->post('language');
            $data_array['currency'] = $this->input->post('currency');
            $data_array['year']     = $this->input->post('running_year');
            $data_array['phone']    = $this->input->post('phone');
            
            $this->db->update('geopos_system' , $data_array);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/system_settings'), 'refresh');


        }
        if ($param1 == 'upload_logo') {
            if($_FILES['userfile']['tmp_name'] != ""){
             move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
             $this->db->update('geopos_system' , array('logo' =>'logo.png'));
             $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            }else{
             $this->session->set_flashdata('flash_message', get_phrase('upload file is empty !'));
            }
            redirect(site_url('admin/system_settings'), 'refresh');
        }
        
          if ($param1 == 'header_image') {
            if($_FILES['userfile']['tmp_name'] != ""){
             move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/header_image.png');
             $this->db->update('geopos_system' , array('header_image' =>'header_image.png'));
             $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            }else{
             $this->session->set_flashdata('flash_message', get_phrase('upload file is empty !'));
            }
            redirect(site_url('admin/system_settings'), 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['active_link']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

        /*****SITE/Assignmnet SETTINGS*********/
    function assignment_setting($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'do_update') {
    
            $data['description'] = $this->input->post('assignment_status');
            $this->db->where('type' , 'assignment_status');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('assignment_weightage');
            $this->db->where('type' , 'assignment_weightage');
            $this->db->update('settings' , $data);  
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/assignment_setting'), 'refresh');


        }
     
        $page_data['page_name']  = 'assignment_setting';
        $page_data['active_link']  = 'assignment_setting';
        $page_data['page_title'] = get_phrase('assignment_setting');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    
    
    
    // update default controller
    function update_default_controller() {
      $status = $this->db->get_where('settings' , array('type' =>'disable_frontend'))->row()->description;
      if ($status == 1) {
        $default_controller          = 'login';
        $previous_default_controller = 'home';
      }else{
        $default_controller          = 'home';
        $previous_default_controller = 'login';
      }
      // write routes.php
      $data = file_get_contents('./application/config/routes.php');
      $data = str_replace($previous_default_controller, $default_controller,    $data);
      file_put_contents('./application/config/routes.php', $data);
    }

    //Payment settings
    function payment_settings($param1 = ""){
      if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');
      if ($param1 == 'update_stripe_keys') {
            $this->crud_model->update_stripe_keys();
            $this->session->set_flashdata('flash_message', get_phrase('payment_settings_updated'));
            redirect(site_url('admin/payment_settings'), 'refresh');
      }
      if ($param1 == 'update_paypal_keys') {
          $this->crud_model->update_paypal_keys();
          $this->session->set_flashdata('flash_message', get_phrase('payment_settings_updated'));
          redirect(site_url('admin/payment_settings'), 'refresh');
      }
      if ($param1 == 'update_payumoney_keys') {
        $this->crud_model->update_payumoney_keys();
        $this->session->set_flashdata('flash_message', get_phrase('payment_settings_updated'));
        redirect(site_url('admin/payment_settings'), 'refresh');
      }
      $page_data['page_name']  = 'payment_settings';
      $page_data['active_link']  = 'payment_settings';
      $page_data['page_title'] = get_phrase('payment_settings');
      $page_data['settings']   = $this->db->get('settings')->result_array();
      $this->load->view('backend/index', $page_data);
    }
    // FRONTEND

    function frontend_pages($param1 = '', $param2 = '', $param3 = '') {
      if ($this->session->userdata('admin_login') != 1) {
        redirect(site_url('login'), 'refresh');
      }
      if ($param1 == 'events') {
        $page_data['page_content']  = 'frontend_events';
      }
      if ($param1 == 'gallery') {
        $page_data['page_content']  = 'frontend_gallery';
      }
      if ($param1 == 'privacy_policy') {
        $page_data['page_content']  = 'frontend_privacy_policy';
      }
      if ($param1 == 'about_us') {
        $page_data['page_content']  = 'frontend_about_us';
      }
      if ($param1 == 'terms_conditions') {
        $page_data['page_content']  = 'frontend_terms_conditions';
      }
      if ($param1 == 'homepage_slider') {
        $page_data['page_content']  = 'frontend_slider';
      }
      if ($param1 == '' || $param1 == 'general') {
        $page_data['page_content']  = 'frontend_general_settings';
      }
      if ($param1 == 'gallery_image') {
        $page_data['page_content']  = 'frontend_gallery_image';
        $page_data['gallery_id']  = $param2;
      }
      $page_data['page_name'] = 'frontend_pages';
      $page_data['active_link']  = 'frontend_pages';
      $page_data['page_title']  = get_phrase('pages');
      $this->load->view('backend/index', $page_data);
    }

    function frontend_events($param1 = '', $param2 = '') {
      if ($param1 == 'add_event') {
        $this->frontend_model->add_event();
        
        $this->session->set_flashdata('flash_message' , get_phrase('event_added_successfully'));
        redirect(site_url('admin/frontend_pages/events'), 'refresh');
      }
      if ($param1 == 'edit_event') {
        $this->frontend_model->edit_event($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('event_updated_successfully'));
        redirect(site_url('admin/frontend_pages/events'), 'refresh');
      }
      if ($param1 == 'delete') {
        $this->frontend_model->delete_event($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('event_deleted'));
        redirect(site_url('admin/frontend_pages/events'), 'refresh');
      }
    }


    
    
    function frontend_gallery($param1 = '', $param2 = '', $param3 = '') {
      if ($param1 == 'add_gallery') {
        $this->frontend_model->add_gallery();
        $this->session->set_flashdata('flash_message' , get_phrase('gallery_added_successfully'));
        redirect(site_url('admin/frontend_pages/gallery'), 'refresh');
      }
      if ($param1 == 'edit_gallery') {
        $this->frontend_model->edit_gallery($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('gallery_updated_successfully'));
        redirect(site_url('admin/frontend_pages/gallery'), 'refresh');
      }
      if ($param1 == 'upload_images') {
        $this->frontend_model->add_gallery_images($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('images_uploaded'));
        redirect(site_url('admin/frontend_pages/gallery_image/'.$param2), 'refresh');
      }
      if ($param1 == 'delete_image') {
        $this->frontend_model->delete_gallery_image($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('images_deleted'));
        redirect(site_url('admin/frontend_pages/gallery_image/'.$param3), 'refresh');
      }

    }

    function frontend_news($param1 = '', $param2 = '') {
      if ($param1 == 'add_news') {
        $this->frontend_model->add_news();
        $this->session->set_flashdata('flash_message' , get_phrase('news_added_successfully'));
        redirect(site_url('admin/frontend_pages/news'), 'refresh');
      }
      if ($param1 == 'edit_news') {

      }
      if ($param1 == 'delete') {
        $this->frontend_model->delete_news($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('news_was_deleted'));
        redirect(site_url('admin/frontend_pages/news'), 'refresh');
      }
    }

    function frontend_settings($task) {
      if ($task == 'update_terms_conditions') {
        $this->frontend_model->update_terms_conditions();
        $this->session->set_flashdata('flash_message' , get_phrase('terms_updated'));
        redirect(site_url('admin/frontend_pages/terms_conditions'), 'refresh');
      }
      if ($task == 'update_about_us') {
        $this->frontend_model->update_about_us();
        $this->session->set_flashdata('flash_message' , get_phrase('about_us_updated'));
        redirect(site_url('admin/frontend_pages/about_us'), 'refresh');
      }
      if ($task == 'update_privacy_policy') {
        $this->frontend_model->update_privacy_policy();
        $this->session->set_flashdata('flash_message' , get_phrase('privacy_policy_updated'));
        redirect(site_url('admin/frontend_pages/privacy_policy'), 'refresh');
      }
      if ($task == 'update_general_settings') {
        $this->frontend_model->update_frontend_general_settings();
        $this->session->set_flashdata('flash_message' , get_phrase('general_settings_updated'));
        redirect(site_url('admin/frontend_pages/general'), 'refresh');
      }
      if ($task == 'update_slider_images') {
        $this->frontend_model->update_slider_images();
        $this->session->set_flashdata('flash_message' , get_phrase('slider_images_updated'));
        redirect(site_url('admin/frontend_pages/homepage_slider'), 'refresh');
      }
    }

    function frontend_themes() {
      if ($this->session->userdata('admin_login') != 1) {
        redirect(site_url('login'), 'refresh');
      }
      $page_data['page_name'] = 'frontend_themes';
      $page_data['active_link']  = 'frontend_themes';
      $page_data['page_title']  = get_phrase('themes');
      $this->load->view('backend/index', $page_data);
    }

    // FRONTEND


    function get_session_changer()
    {
        $this->load->view('backend/admin/change_session');
    }

    function change_session()
    {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type' , 'running_year');
        $this->db->update('settings' , $data);
        $this->session->set_flashdata('flash_message' , get_phrase('session_changed'));
        redirect(site_url('admin/dashboard'), 'refresh');
    }

    /***** UPDATE PRODUCT *****/

    function update( $task = '', $purchase_code = '' ) {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);

        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;

        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);

        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }

        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);

        // Run php modifications
        require './update/' . $unzipped_file_name . '/update_script.php';

        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }

        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }

        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(site_url('admin/system_settings'), 'refresh');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/sms_settings'), 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/sms_settings'), 'refresh');
        }
        if ($param1 == 'msg91') {

            $data['description'] = $this->input->post('authentication_key');
            $this->db->where('type' , 'msg91_authentication_key');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('sender_ID');
            $this->db->where('type' , 'msg91_sender_ID');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('msg91_route');
            $this->db->where('type' , 'msg91_route');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('msg91_country_code');
            $this->db->where('type' , 'msg91_country_code');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/sms_settings'), 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/sms_settings'), 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['active_link']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile']  = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language   =   $param2;
            $total_phrase   =   $this->input->post('total_phrase');
            for($i = 1 ; $i < $total_phrase ; $i++)
            {
                //$data[$language]  =   $this->input->post('phrase').$i;
                $this->db->where('phrase_id' , $i);
                $this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
            }
            redirect(site_url('admin/manage_language/edit_phrase/'.$language), 'refresh');
        }
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(site_url('admin/manage_language'), 'refresh');
        }
        $page_data['page_name']        = 'manage_language';
        $page_data['active_link']  = 'manage_language';
        $page_data['page_title']       = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $admin_id = $param2;

            $validation = email_validation_for_edit($data['email'], $admin_id, 'admin');
            if($validation == 1){
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('admin/manage_profile'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('admin/manage_profile'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['active_link']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // VIEW QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == "create")
        {
            $this->crud_model->create_question_paper();
            $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
            redirect(site_url('admin/question_paper'), 'refresh');
        }

        if ($param1 == "update")
        {
            $this->crud_model->update_question_paper($param2);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(site_url('admin/question_paper'), 'refresh');
        }

        if ($param1 == "delete")
        {
            $this->crud_model->delete_question_paper($param2);
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(site_url('admin/question_paper'), 'refresh');
        }


        $data['page_name']  = 'question_paper';
        $data['active_link']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }

    // MANAGE LIBRARIANS
    function librarian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['email']      = $this->input->post('email');
            $data['salary_grade_id']      = $this->input->post('salary_grade_id');
            $data['salary_type']      = $this->input->post('salary_type');
            $data['password']   = sha1($this->input->post('password'));
            $validation = email_validation($data['email']);
            if ($validation == 1) {
                $this->db->insert('librarian', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('librarian', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('admin/librarian'), 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('email');
            $data['salary_grade_id'] = $this->input->post('salary_grade_id');
            $data['salary_type']  = $this->input->post('salary_type');
            $validation = email_validation_for_edit($data['email'], $param2, 'librarian');
            if ($validation == 1) {
                $this->db->where('librarian_id' , $param2);
                $this->db->update('librarian' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('admin/librarian'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('librarian_id' , $param2);
            $this->db->delete('librarian');

            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/librarian'), 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_librarians');
        $page_data['page_name']     = 'librarian';
        $page_data['active_link']  = 'librarian';
        $this->load->view('backend/index', $page_data);
    }

    // MANAGE ACCOUNTANTS
    function accountant($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['email']      = $this->input->post('email');
            $data['salary_grade_id']      = $this->input->post('salary_grade_id');
            $data['salary_type']      = $this->input->post('salary_type');
            $data['password']   = sha1($this->input->post('password'));

            $validation = email_validation($data['email']);
            if ($validation == 1) {
                $this->db->insert('accountant', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('accountant', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('admin/accountant'), 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('email');
            $data['salary_grade_id']  = $this->input->post('salary_grade_id');
            $data['salary_type']  = $this->input->post('salary_type');

            $validation = email_validation_for_edit($data['email'], $param2, 'accountant');
            if($validation == 1){
                $this->db->where('accountant_id' , $param2);
                $this->db->update('accountant' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(site_url('admin/accountant'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('accountant_id' , $param2);
            $this->db->delete('accountant');

            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/accountant'), 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_accountants');
        $page_data['page_name']     = 'accountant';
        $page_data['active_link']  = 'accountant';
        $this->load->view('backend/index', $page_data);
    }


    // bulk student_add using CSV
    function generate_bulk_student_csv($class_id = '', $section_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $data['class_id']   = $class_id;
        $data['section_id'] = $section_id;
        $data['year']       = $this->db->get_where('settings', array('type'=>'running_year'))->row()->description;
        $file   = fopen("uploads/bulk_student.csv", "w");
        $line   = array('StudentName', 'Id', 'RollNo','RFIDNO','Email', 'Password', 'Phone', 'Address', 'ParentID', 'Gender','birthday','DormitoryID','RoomID','HostelID','TransportMember','TransporRoutID','TransportStopID');
        fputcsv($file, $line, ',');
       echo $file_path = base_url() . 'uploads/bulk_student.csv';
    }


 



    // CSV IMPORT
    function bulk_student_add_using_csv($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
          if ($this->input->post('class_id') != '' && $this->input->post('section_id') != '') {

              move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/bulk_student.csv');
              $csv = array_map('str_getcsv', file('uploads/bulk_student.csv'));
              $count = 1;
              $array_size = sizeof($csv);

             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                  $password = $row[5];
                  $data['name']          = $row[0];
                  $data['student_code']  = $row[1];
                  $data['email']         = $row[4];
                  $data['password']      = sha1($row[5]);
                  $data['phone']         = $row[6];
                  $data['address']       = $row[7];
                  $data['parent_id']     = $row[8];
                  $data['sex']           = strtolower($row[9]);
                  $data['birthday']      = $row[10];
                  $data['dormitory_id']  = $row[11];
                  $data['is_hostel_member'] = $row[12];
                  $data['hostel_id']     = $row[13];
                  $data['is_transport_member']  = $row[14];               
                  $data['transport_id']  = $row[15];
                  $data['transport_stop'] = $row[16];
                  //$data['discount_id']   = $row[15];
                  
                  $code_validation = code_validation_insert($data['student_code']);
                 
                 if(!$code_validation){
                     $this->session->set_flashdata('error_message' , get_phrase('this_id_no_is_not_available'));
                     redirect(site_url('admin/student_bulk_add'), 'refresh');
                 }
                 
                 //student id validation ends
                  $validation = email_validation($data['email']);
                  if ($validation == 1) {
                   $this->db->insert('student', $data);
                  $student_id = $this->db->insert_id();

                    $data2['student_id']  = $student_id;
                    $data2['class_id']    = $this->input->post('class_id');
                    $data2['section_id']  = $this->input->post('section_id');
                    $data2['roll']        = $row[2];
                    $data2['card_code']        = $row[3];
                    $data2['enroll_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
                    $data2['date_added']  =   strtotime(date("Y-m-d H:i:s"));
                    $data2['year']        =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;             
                  $this->db->insert('enroll' , $data2);
                  }
                  else{
                    if ($array_size == 2) {
                      $this->session->set_flashdata('error_message', get_phrase('this_email_id_"').$data['email'].get_phrase('"_is_not_available'));
                      redirect(site_url('admin/student_bulk_add'), 'refresh');
                    }
                    elseif($array_size > 2){
                      $this->session->set_flashdata('error_message', get_phrase('some_email_IDs_are_not_available'));
                    }
                  }

              }


              $this->session->set_flashdata('flash_message', get_phrase('student_imported'));
              redirect(site_url('admin/student_bulk_add'), 'refresh');
           }
           else{
             $this->session->set_flashdata('error_message', get_phrase('please_make_sure_class_and_section_is_selected'));
             redirect(site_url('admin/student_bulk_add'), 'refresh');
           }
        }
        $page_data['page_name']  = 'student_bulk_add';
        $page_data['active_link']  = 'student_bulk_add';
        $page_data['page_title'] = get_phrase('add_bulk_student');
        $this->load->view('backend/index', $page_data);
    }

    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1)
          {

        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_saved_successfuly'));
            redirect(site_url('admin/study_material'), 'refresh');
        }

        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_updated_successfuly'));
            redirect(site_url('admin/study_material'), 'refresh');
        }

        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(site_url('admin/study_material'), 'refresh');
        }

        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        $data['page_name']              = 'study_material';
        $data['active_link']  = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
        }else{
          redirect(site_url('login'), 'refresh');
        }
    }

    //new code
    function print_id($id){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $data['id'] = $id;
        $this->load->view('backend/admin/print_id', $data);
    }

    function create_barcode($student_id)
    {

        return $this->Barcode_model->create_barcode($student_id);

    }

    // Details of searched student
    function student_details($param1 = ""){
      if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');

      $student_identifier = $this->input->post('student_identifier');
      $query_by_code = $this->db->get_where('student', array('student_code' => $student_identifier));

      if ($query_by_code->num_rows() == 0) {
        $this->db->like('name', $student_identifier);
        $query_by_name = $this->db->get('student');
        if ($query_by_name->num_rows() == 0) {
          $this->session->set_flashdata('error_message' , get_phrase('no_student_found'));
          redirect(site_url('admin/dashboard'), 'refresh');
        }
        else{
          $page_data['student_information'] = $query_by_name->result_array();
        }
      }
      else{
        $page_data['student_information'] = $query_by_code->result_array();
      }
      print_r($page_data);exit;
      $page_data['page_name']   = 'search_result';
      $page_data['active_link']  = 'search_result';
        $page_data['page_title']    = get_phrase('search_result');
        $this->load->view('backend/index', $page_data);
    }


    // online exam
    function manage_online_exam($param1 = "", $param2 = ""){
        $table = 'online_exam';
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $running_year = get_settings('running_year');

        if ($param1 == '') {
            $match = array('status !=' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'active';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('online_exam')->result_array();
        }

        if ($param1 == 'expired') {
            $match = array('status' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'expired';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('online_exam')->result_array();
        }

        if ($param1 == 'create') {

            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud_model->create_online_exam($table);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/manage_online_exam'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/manage_online_exam'), 'refresh');
            }
        }
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud_model->update_online_exam($table);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
                redirect(site_url('admin/manage_online_exam'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/manage_online_exam'), 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('online_exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/manage_online_exam'), 'refresh');
        }
        $page_data['page_name'] = 'manage_online_exam';
        $page_data['active_link']  = 'manage_online_exam';
        $page_data['page_title'] = get_phrase('manage_online_exam');
        $this->load->view('backend/index', $page_data);
    }

    
   function online_exam_questions_print_view($online_exam_id, $answers) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['answers'] = $answers;
        $page_data['page_title'] = get_phrase('questions_print');
        $this->load->view('backend/admin/online_exam_questions_print_view', $page_data);
    }

    function pre_exam_questions_print_view($online_exam_id, $answers) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['answers'] = $answers;
        $page_data['page_title'] = get_phrase('questions_print');
        $this->load->view('backend/admin/pre_exam_questions_print_view', $page_data);
    }


      function scholarship_exam_questions_print_view($online_exam_id, $answers) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['answers'] = $answers;
        $page_data['page_title'] = get_phrase('questions_print');
        $this->load->view('backend/admin/scholarship_exam_questions_print_view', $page_data);
    }


    function create_online_exam(){
        $page_data['page_name'] = 'add_online_exam';
        $page_data['active_link']  = 'add_online_exam';
        $page_data['page_title'] = get_phrase('add_an_online_exam');
        $this->load->view('backend/index', $page_data);
    }

    function update_online_exam($param1 = ""){
        $page_data['online_exam_id'] = $param1;
        $page_data['page_name'] = 'edit_online_exam';
        $page_data['active_link']  = 'edit_online_exam';
        $page_data['page_title'] = get_phrase('update_online_exam');
        $this->load->view('backend/index', $page_data);
    }

      function update_pre_online_exam($param1 = ""){
        $page_data['online_exam_id'] = $param1;
        $page_data['page_name'] = 'pre_edit_online_exam';
        $page_data['active_link']  = 'pre_edit_online_exam';
        $page_data['page_title'] = get_phrase('update_online_exam');
        $this->load->view('backend/index', $page_data);
    }

    function update_scholarship_online_exam($param1 = ""){
        $page_data['online_exam_id'] = $param1;
        $page_data['page_name'] = 'scholarship_edit_online_exam';
        $page_data['active_link']  = 'scholarship_edit_online_exam';
        $page_data['page_title'] = get_phrase('update_online_exam');
        $this->load->view('backend/index', $page_data);
    }

    function manage_online_exam_status($online_exam_id = "", $status = ""){
        $this->crud_model->manage_online_exam_status($online_exam_id, $status);
        redirect(site_url('admin/manage_online_exam'), 'refresh');
    }
   
    function pre_manage_online_exam_status($online_exam_id = "", $status = ""){
        $this->crud_model->manage_online_exam_status($online_exam_id, $status,'pre_online_exam');
        redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
    }

     function scholarship_manage_online_exam_status($online_exam_id = "", $status = ""){
        $this->crud_model->manage_online_exam_status($online_exam_id, $status,'scholarship_online_exam');
        redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
    }

    function load_question_type($type, $online_exam_id,$formurl = "") {
        $page_data['question_type'] = $type;
        $page_data['online_exam_id']= $online_exam_id;
        $page_data['formurl']       = $formurl;
        $this->load->view('backend/admin/online_exam_add_'.$type, $page_data);
    }
    
  

    function manage_online_exam_question($online_exam_id = "", $task = "", $type = ""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud_model->add_multiple_choice_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'true_false') {
                $this->crud_model->add_true_false_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'fill_in_the_blanks') {
                $this->crud_model->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }
            redirect(site_url('admin/manage_online_exam_question/'.$online_exam_id), 'refresh');
        }

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['page_name'] = 'manage_online_exam_question';
        $page_data['active_link']  = 'manage_online_exam_question';
        $page_data['page_title'] = $this->db->get_where('online_exam', array('online_exam_id'=>$online_exam_id))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

     function scholarship_manage_online_exam_question($online_exam_id = "", $task = "", $type = ""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud_model->add_multiple_choice_question_to_online_exam($online_exam_id,'scholarship_question_bank');
            }
            elseif ($type == 'true_false') {
                $this->crud_model->add_true_false_question_to_online_exam($online_exam_id,'scholarship_question_bank');
            }
            elseif ($type == 'fill_in_the_blanks') {
                $this->crud_model->add_fill_in_the_blanks_question_to_online_exam($online_exam_id,'scholarship_question_bank');
            }
            redirect(site_url('admin/scholarship_manage_online_exam_question/'.$online_exam_id), 'refresh');
        }

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['page_name']  = 'scholarship_manage_online_exam_question';
        $page_data['active_link']  = 'scholarship_manage_online_exam_question';
        $page_data['page_title'] = $this->db->get_where('scholarship_online_exam', array('online_exam_id'=>$online_exam_id))->row()->title;
        $this->load->view('backend/index', $page_data);
    }



    function pre_manage_online_exam_question($online_exam_id = "", $task = "", $type = ""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud_model->add_multiple_choice_question_to_online_exam($online_exam_id,'pre_question_bank');
            }
            elseif ($type == 'true_false') {
                $this->crud_model->add_true_false_question_to_online_exam($online_exam_id,'pre_question_bank');
            }
            elseif ($type == 'fill_in_the_blanks') {
                $this->crud_model->add_fill_in_the_blanks_question_to_online_exam($online_exam_id,'pre_question_bank');
            }
            redirect(site_url('admin/pre_manage_online_exam_question/'.$online_exam_id), 'refresh');
        }

        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['page_name'] = 'pre_manage_online_exam_question';
        $page_data['active_link']  = 'pre_manage_online_exam_question';
        $page_data['page_title'] = $this->db->get_where('pre_online_exam', array('online_exam_id'=>$online_exam_id))->row()->title;
        $this->load->view('backend/index', $page_data);
    }
    

    function update_online_exam_question($question_id = "", $task = "", $online_exam_id = "") {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud_model->update_multiple_choice_question($question_id);
            }
            elseif($type == 'true_false'){
                $this->crud_model->update_true_false_question($question_id);
            }
            elseif($type == 'fill_in_the_blanks'){
                $this->crud_model->update_fill_in_the_blanks_question($question_id);
            }
            redirect(site_url('admin/manage_online_exam_question/'.$online_exam_id), 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['active_link']  = 'update_online_exam_question';
        $page_data['page_title'] = get_phrase('update_question');
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_update_online_exam_question($question_id = "", $task = "", $online_exam_id = "") {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('scholarship_question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('scholarship_question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
            $this->crud_model->update_multiple_choice_question($question_id,'scholarship_question_bank');
            }
            elseif($type == 'true_false'){
            $this->crud_model->update_true_false_question($question_id,'scholarship_question_bank');
            }
            elseif($type == 'fill_in_the_blanks'){
                $this->crud_model->update_fill_in_the_blanks_question($question_id,'scholarship_question_bank');
            }
            redirect(site_url('admin/scholarship_manage_online_exam_question/'.$online_exam_id), 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'scholarship_update_online_exam_question';
        $page_data['active_link']  = 'scholarship_update_online_exam_question';
        $page_data['page_title'] = get_phrase('update_question');
        $this->load->view('backend/index', $page_data);
    }

     function pre_update_online_exam_question($question_id = "", $task = "", $online_exam_id = "") {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('pre_question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('pre_question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud_model->update_multiple_choice_question($question_id,'pre_question_bank');
            }
            elseif($type == 'true_false'){
                $this->crud_model->update_true_false_question($question_id,'pre_question_bank');
            }
            elseif($type == 'fill_in_the_blanks'){
                $this->crud_model->update_fill_in_the_blanks_question($question_id,'pre_question_bank');
            }
            redirect(site_url('admin/pre_manage_online_exam_question/'.$online_exam_id), 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['active_link']  = 'update_online_exam_question';
        $page_data['page_title'] = get_phrase('update_question');
        $this->load->view('backend/index', $page_data);
    }

    function delete_question_from_online_exam($question_id){
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud_model->delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message' , get_phrase('question_deleted'));
        redirect(site_url('admin/manage_online_exam_question/'.$online_exam_id), 'refresh');
    }
    

    function pre_delete_question_from_online_exam($question_id){
        $online_exam_id = $this->db->get_where('pre_question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud_model->pre_delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message' , get_phrase('question_deleted'));
        redirect(site_url('admin/pre_manage_online_exam_question/'.$online_exam_id), 'refresh');
    }

    function scholarship_delete_question_from_online_exam($question_id){
        $online_exam_id = $this->db->get_where('scholarship_question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud_model->scholarship_delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message' , get_phrase('question_deleted'));
        redirect(site_url('admin/scholarship_manage_online_exam_question/'.$online_exam_id), 'refresh');
    }


    function manage_multiple_choices_options() {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/admin/manage_multiple_choices_options', $page_data);
    }

    function get_sections_for_ssph($class_id) {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        $options = '';
        foreach ($sections as $row) {
            $options .= '<option value="'.$row['section_id'].'">'.$row['name'].'</option>';
        }
        echo '<select class="" name="section_id" id="section_id">'.$options.'</select>';
    }

    function get_students_for_ssph($class_id, $section_id) {
        $enrolls = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
        $options = '';
        foreach ($enrolls as $row) {
            $name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $options .= '<option value="'.$row['student_id'].'">'.$name.'</option>';
        }
        echo '<select class="" name="student_id" id="student_id">'.$options.'</select>';
    }

    function get_payment_history_for_ssph($student_id) {
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/admin/student_specific_payment_history_table', $page_data);
    }

    function view_online_exam_result($online_exam_id){
        $page_data['page_name'] = 'view_online_exam_results';
        $page_data['active_link']  = 'view_online_exam_results';
        $page_data['page_title'] = get_phrase('result');
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/index',$page_data);
    }
   
    function pre_view_online_exam_result($online_exam_id){
        $page_data['page_name'] = 'pre_view_online_exam_results';
        $page_data['active_link']  = 'pre_view_online_exam_results';
        $page_data['page_title'] = get_phrase('result');
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/index',$page_data);
    }

    function view_scholarship_exam_result($online_exam_id){
        $page_data['page_name'] = 'view_scholarship_exam_result';
        $page_data['active_link']  = 'view_scholarship_exam_result';
        $page_data['page_title'] = get_phrase('result');
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/index',$page_data);
    }
    //ADDED BY BHUVAN SINGH
    //ADDED BY BHUVAN SINGH

    function parent_bulk_add(){
        $page_data['page_name'] = 'parent_bulk_add';
        $page_data['active_link']  = 'parent_bulk_add';
        $page_data['page_title'] = get_phrase('Add Bulk Parent');
        $this->load->view('backend/index',$page_data);
    }
    
       function parent_bulk_add_using_csv($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
         

              move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_bulk_add.csv');
              $csv = array_map('str_getcsv', file('uploads/parent_bulk_add.csv'));
              $count = 1;
              $array_size = sizeof($csv);

             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                  $password = $row[3];

                  $data['name']      = $row[0];
                  $data['email']     = $row[1];
                  $data['password']  = sha1($row[2]);
                  $data['phone']     = $row[3];           
                  $data['address'] = $row[4];
                  $data['profession'] = $row[5];                 
              
                  $validation = email_validation($data['email']);
                  if ($validation == 1) {
                    $this->db->insert('parent', $data);
                   
                  }
                  else{
                    if ($array_size == 2) {
                      $this->session->set_flashdata('error_message', get_phrase('this_email_id_"').$data['email'].get_phrase('"_is_not_available'));
                      redirect(site_url('admin/parent_bulk_add'), 'refresh');
                    }
                    elseif($array_size > 2){
                      $this->session->set_flashdata('error_message', get_phrase('some_email_IDs_are_not_available'));
                    }
                  }

              }


              $this->session->set_flashdata('flash_message', get_phrase('parent_imported'));
              redirect(site_url('admin/parent_bulk_add'), 'refresh');
        
        }
        $page_data['page_name']  = 'parent_bulk_add';
        $page_data['active_link']  = 'parent_bulk_add';
        $page_data['page_title'] = get_phrase('parent_bulk_add');
        $this->load->view('backend/index', $page_data);
    }
    
    
function bulk_book_add_using_csv($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
         

              move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/library_book_bulk.csv');
              $csv = array_map('str_getcsv', file('uploads/library_book_bulk.csv'));
              $count = 1;
              $array_size = sizeof($csv);

             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                      $data['name']      = $row[0];
                      $data['description']     = $row[1];                   
                      $data['author']     = $row[2];
                      $data['class_id']   = $row[3];
                      $data['price'] = $row[4];
                      $data['total_copies'] = $row[5];              
            
                 
                    $this->db->insert('book', $data);
                   
                  

              }


              $this->session->set_flashdata('flash_message', get_phrase('Book_sucessfully_added'));
              redirect(site_url('admin/books_bulk_add'), 'refresh');
        
        }
        $page_data['page_name']  = 'books_bulk_add';
        $page_data['active_link']  = 'books_bulk_add';
        $page_data['page_title'] = get_phrase('books_bulk_add');
        $this->load->view('backend/index', $page_data);
    }
    
    
    function add_bulk_categories($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
    move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/assest_categories_bulk.csv');
              $csv = array_map('str_getcsv', file('uploads/assest_categories_bulk.csv'));
              $count = 1;
              $array_size = sizeof($csv);
             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                      $data['category']      = $row[0];
                      $data['description']     = $row[1];                   
                      $data['status']     = 1;
                      
                    $this->db->insert('asset_category', $data);              
              }

              $this->session->set_flashdata('flash_message', get_phrase('categories_sucessfully_added'));
              redirect(site_url('admin/add_bulk_category'), 'refresh');
        
        }
        $page_data['page_name']  = 'add_bulk_category';
        $page_data['active_link']  = 'add_bulk_category';
        $page_data['page_title'] = get_phrase('assest_bulk_add');
        $this->load->view('backend/index', $page_data);
    }
        function add_bulk_assets($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
    move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/add_bulk_assets.csv');
              $csv = array_map('str_getcsv', file('uploads/add_bulk_assets.csv'));
              $count = 1;
              $array_size = sizeof($csv);
             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                      $data['name']      = $row[0];
                      $data['number_asset']   = $row[1];
                      $data['category']      = $row[2];
                      $data['description']     = $row[3];                   
                      $data['status']     = 1;
                     
                    $this->db->insert('asset', $data);              
              }

              $this->session->set_flashdata('flash_message', get_phrase('categories_sucessfully_added'));
              redirect(site_url('admin/add_bulk_asset'), 'refresh');
        
        }
        $page_data['page_name']  = 'add_bulk_asset';
        $page_data['active_link']  = 'add_bulk_asset';
        $page_data['page_title'] = get_phrase('assest_bulk_add');
        $this->load->view('backend/index', $page_data);
    }

    function sales_voucher(){
        $page_data['page_name'] = 'sales_voucher';
        $page_data['active_link']  = 'sales_voucher';
        $page_data['page_title'] = get_phrase('Sales Voucher');
        $this->load->view('backend/index',$page_data);
    }

    function purchase_voucher(){
        $page_data['page_name'] = 'purchase_voucher';
        $page_data['active_link']  = 'purchase_voucher';
        $page_data['page_title'] = get_phrase('Purchase Voucher');
        $this->load->view('backend/index',$page_data);
    }

    function journal_voucher(){
        $page_data['page_name'] = 'journal_voucher';
        $page_data['active_link']  = 'journal_voucher';
        $page_data['page_title'] = get_phrase('Journal Voucher');
        $this->load->view('backend/index',$page_data);
    }

    function payroll(){
        $page_data['page_name'] = 'payroll';
        $page_data['active_link']  = 'payroll';
        $page_data['page_title'] = get_phrase('Payroll');
        $this->load->view('backend/index',$page_data);
    }

    function deductions(){
        $page_data['page_name'] = 'deductions';
        $page_data['active_link']  = 'deductions';
        $page_data['page_title'] = get_phrase('Deductions');
        $this->load->view('backend/index',$page_data);
    }

    function pre_exam_student_registration(){
        $page_data['field_arr']              = $this->crud_model->registration_form_fiels_pre_student();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields_pre_student();
        $page_data['page_name'] = 'pre_exam_student_registration';
        $page_data['active_link']  = 'pre_exam_student_registration';
        $page_data['page_title'] = get_phrase('Pre Exam Student Registration');
        $this->load->view('backend/index',$page_data);
    }

    function pre_exam_student_information($param = FALSE){
        $page_data['class_id'] =  $param;
        $page_data['page_name'] = 'pre_exam_student_information';
        $page_data['active_link']  = 'pre_exam_student_information';
        $page_data['page_title'] = get_phrase('Pre Exam Student Information');
        $this->load->view('backend/index',$page_data);
    }

    function pre_exam_online_create(){
        $page_data['page_name'] = 'pre_exam_online_create';
        $page_data['active_link']  = 'pre_exam_online_create';
        $page_data['page_title'] = get_phrase('Create Online Exam');
        $this->load->view('backend/index',$page_data);
    }


    /////online pre exam manage page /////////////////
    function pre_exam_online_manage($param1 = "", $param2 = ""){
        $table_pre = 'pre_online_exam';
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

            $running_year = get_settings('running_year');

        if ($param1 == '') {
            $match = array('status !=' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'active';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('pre_online_exam')->result_array();
        }

        if ($param1 == 'expired') {
            $match = array('status' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'expired';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('pre_online_exam')->result_array();
        }

        if ($param1 == 'create') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->create_online_exam($table_pre);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
            }
        }
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->update_online_exam($table_pre);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
                redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('pre_online_exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
        }

         $page_data['page_name'] = 'pre_exam_online_manage';
         $page_data['active_link']  = 'pre_exam_online_manage';
         $page_data['page_title'] = get_phrase('Manage Online Exam');
         $this->load->view('backend/index',$page_data);
    }
     
           ////////online pre exam manage page /////////////////
    function scholarship_exam_online_manage1($param1 = "", $param2 = ""){
        $table_pre = 'pre_online_exam';
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

            $running_year = get_settings('running_year');

        if ($param1 == '') {
            $match = array('status !=' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'active';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('pre_online_exam')->result_array();
        }

        if ($param1 == 'expired') {
            $match = array('status' => 'expired', 'running_year' => $running_year);
            $page_data['status'] = 'expired';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('pre_online_exam')->result_array();
        }

        if ($param1 == 'create') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->create_online_exam($table_pre);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
        }
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->update_online_exam($table_pre);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
        }
        
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('pre_online_exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
        }

         $page_data['page_name'] = 'pre_exam_online_manage';
         $page_data['active_link']  = 'pre_exam_online_manage';
         $page_data['page_title'] = get_phrase('Manage Online Exam');
         $this->load->view('backend/index',$page_data);
    }



    ///// re_exam manage page /////////////////

    function re_exam($param1 = "", $param2 = ""){
          if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
           
           $running_year = get_settings('running_year');
            if($param1 == 'create') {
                $this->_prepare_re_exam_schedule_validation();
                if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_reschedule_exam_data($this->input->post());
                $this->db->insert('re_exam', $data);

                //$this->db->where('id', $this->input->post('exam'));
                //$this->db->update('exam_schedule', array('exam_status' => 're_exam'));
                
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/reexam_and_cancellation'), 'refresh');
              }else {
                    $page_data['post'] = $_POST;
              }
            }

            if ($param1 == 'cancel') {
                $data = $this->_get_reschedule_exam_data($this->input->post());
                $this->db->insert('re_exam_cancel', $data);
                //$this->db->where('id', $this->input->post('exam'));
               // $this->db->update('exam_schedule', array('exam_status' => 'cancel'));
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/reexam_and_cancellation'), 'refresh');
            }
      
       
            /*if ($param1 == 'delete') {
                $this->db->where('online_exam_id', $param2);
                $this->db->delete('pre_online_exam');
                $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
                redirect(site_url('admin/pre_exam_online_manage'), 'refresh');
            }*/
         
         $page_data['page_name']  = 'reexam_and_cancellation';
         $page_data['active_link']  = 'reexam_and_cancellation';
         $page_data['page_title'] = get_phrase('Re Exam and Cancellation');
         $this->load->view('backend/index',$page_data);
    }


   
        function _get_reschedule_exam_data($post){
                  $data['class_id']     = $post['class_id'];
                  $data['section_id']   = $post['section_id'];
                  $data['student_id']   = $post['student_id'];
                  $data['exam']         = $post['exam'];
                  $data['comment']      = $post['comment'];
                  
                  if(isset($post['cancel_for'])){
                    $data['cancel_for'] = $post['cancel_for'];
                  }else{
                    $data['reschedule_date'] = $post['exam_date']; 
                    $data['reschedule_exam_for'] = $post['reschedule_for'];
                    $data['end_time']         = $post['end_time'];
                    $data['start_time']       = $post['start_time'];
                    $data['room_no']       = $post['room_no'];
                  } 
        
        return $data;
    }


    function assign_room_student(){
        $page_data['page_name'] = 'assign_room_student';
        $page_data['active_link']  = 'assign_room_student';
        $page_data['page_title'] = get_phrase('Assign Rooms');
        $this->load->view('backend/index',$page_data);
    }

     function dormitory_visitor(){
        $page_data['page_name'] = 'dormitory_visitor';
        $page_data['active_link']  = 'dormitory_visitor';
        $page_data['page_title'] = get_phrase('Domitory Visitors List');
        $this->load->view('backend/index',$page_data);
    }

    function dormitory_attendance(){
        $page_data['page_name'] = 'dormitory_attendance';
        $page_data['active_link']  = 'dormitory_attendance';
        $page_data['page_title'] = get_phrase('Domitory Attendance');
        $this->load->view('backend/index',$page_data);
    }

     function dormitory_report(){
        $page_data['page_name'] = 'dormitory_report';
        $page_data['active_link']  = 'dormitory_report';
        $page_data['page_title'] = get_phrase('Domitory Reports');
        $this->load->view('backend/index',$page_data);
    }

     function roomswitch_request(){
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('role_id')==13 || $this->session->userdata('student_login')==1){
        $page_data['roomswitch_list']  = $this->crud_model->get_room_switch_request();
        $page_data['page_name']        = 'roomswitch_request';
        $page_data['active_link']  = 'roomswitch_request';
        $page_data['page_title']       = get_phrase('Room Switch Requests');
        $this->load->view('backend/index',$page_data);
     }
    }


 function add_roomswitch_request($role_id,$user_id){
     //die;
    $this->_prepare_hostel_staff_validation();
                if($this->form_validation->run() === TRUE){
        $member = $this->db->get_where('room_change_request', array(
                                'role_id'  => $this->input->post ('role_id'),'student_id'  => $this->input->post('student_id'),'room_status'  => 'pending','type'  => 2
                            ))->result_array();
                           
                            
                            
                if(empty($member)){
                    $data['student_id']   = $this->input->post('student_id');
                    $data['role_id']  = $this->input->post('role_id');
                    $data['new_hostel_id']      = $this->input->post('new_hostel_id');
                    $data['new_room_id']  = $this->input->post('new_room_id');
                    $data['new_bed_id'] = $this->input->post('new_bed_id');
                    $data['prev_hostel_id'] = $this->input->post('prev_hostel_id');
          $data['prev_room_id']   = $this->input->post('prev_room_id');
           $data['reason']   = $this->input->post('reason');
                    $data['room_status'] = 'approve';
                    $data['type'] = 2;
                    $data['create_at']   = date('Y-m-d H:i:s');
                    $data['create_by']   = logged_in_user_id(); 
                    $this->db->insert('room_change_request', $data);
                    $this->db->set('hostel_id', $data['new_hostel_id']);
                    $this->db->set('room_id',$data['new_room_id']);
                    $this->db->set('beds', $data['new_bed_id']);
                    $this->db->where('user_id', $data['student_id']);
                    $this->db->where('designation_id', $data['role_id']);
                    $this->db->update('hostel_members_staff');
                    $this->session->set_flashdata('flash_message', 'Request is created and in pending state');
                }else{
                    echo '<script>alert("Request is still pending");</script>';
                    $this->session->set_flashdata('flash_message', 'Request is still in the queue');
                }
                
                    // $amount = $data['card_amount'];
                    // $this->db->set('balance', "balance+$amount", FALSE);
                    // $this->db->where('student_id', $data['student_id']);
                    // $this->db->update('student');

                    
                    
                    redirect(site_url('admin/add_roomswitch_request/'.$this->input->post('role_id').'/'.$this->input->post('student_id')), 'refresh');
                
    }
    // ini_set('display_errors',1);die;
        $page_data['roomswitch_list']  = $this->crud_model->get_room_switch_request();
        $page_data['page_name']        = 'add_roomswitch_request';
        $page_data['active_link']  = 'add_roomswitch_request';
        $page_data['role']  = $role_id;
        $page_data['user']  = $user_id;
        $page_data['page_title']       = get_phrase('Room Switch Requests');
        $this->load->view('backend/index',$page_data);
    }
    
    
    function add_roomswitch_list_request($role_id,$user_id){
        $page_data['roomswitch_list']  = $this->crud_model->get_room_switch_request();
        $page_data['page_name']        = 'add_roomswitch_list_request';
        $page_data['active_link']  = 'add_roomswitch_list_request';
        $page_data['page_title']       = get_phrase('Room Switch Requests');
        $this->load->view('backend/index',$page_data);
    }
    
    

    


     function reexam_and_cancellation(){
        $page_data['re_exam_list']     = $this->crud_model->get_re_exam_list();
        $page_data['cancel_exam_list'] = $this->crud_model->get_cancel_exam_list();
        $page_data['page_name']  = 'reexam_and_cancellation';
        $page_data['active_link']  = 'reexam_and_cancellation';
        $page_data['page_title'] = get_phrase('Re Exam and Cancellation');
        $this->load->view('backend/index',$page_data);
    }

     function leave_requests($param = "",$param2 = ""){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');
 
        if($param == "delete" && $param2 != ""){
         $this->db->where('leave_id',$param2);
         $this->db->delete('leave_request');
         $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
         redirect(site_url('admin/leave_requests'));   
        }

        $request_data            = $this->db->get_where('leave_request', array('year'=>$this->year))->result();
        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'leave_requests';
        $page_data['active_link']  = 'leave_requests';
        $page_data['page_title'] = get_phrase('Leave Requests');
        $this->load->view('backend/index',$page_data);
     }

     function leave_update_status(){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');

       $this->db->where('leave_id',$this->input->post('leave_id'));
       $this->db->update('leave_request',array('status'=>$this->input->post('status')));
       echo 1;
     }

     function leaves_report($param1 =""){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');
        
        $page_data['find_student_leave']= "";
        if($_POST !="" && $param1 == "find"){
         $request_data =  $this->crud_model->student_leave_record($_POST);
         $page_data['find_student_leave'] = "true";
         $page_data['leave_data'] =  $request_data;
        }
        $page_data['month']      = date('m');
        $page_data['page_name']  = 'leaves_report';
        $page_data['active_link']  = 'leaves_report';
        $page_data['page_title'] = get_phrase('Leave Reports');
        $this->load->view('backend/index',$page_data);
    }

      function leaves_report_employee($param1 =""){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh'); 
         $page_data['find_emp_leave']= "";
        if($_POST !="" && $param1 == "find"){
         $request_data =  $this->crud_model->employee_leave_record($_POST);
         $page_data['find_emp_leave'] = "true";
         $page_data['leave_data'] =  $request_data;
        }  
        //echo '<pre>';
//print_r($request_data);echo '</pre>';exit;        
        $page_data['month']      = date('m');       
        $page_data['page_name']  = 'leaves_report_employee';
        $page_data['active_link']  = 'leaves_report_employee';
        $page_data['page_title'] = get_phrase('Employee Leave Reports');
        $this->load->view('backend/index',$page_data);
    }
    
    
    
    function canteen_card_recharge(){
        if($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name'] = 'canteen_card_recharge';
        $page_data['active_link']  = 'canteen_card_recharge';
        $page_data['page_title'] = get_phrase('Canteen Card Recharge Process');
        $this->load->view('backend/index',$page_data);
    }
    
    function canteen_card_recharge_process($param =""){
        if($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if($_POST){
            $page_data['post_data']  = $this->input->post();
            $page_data['student_id'] = $this->input->post('student_id');
            $page_data['amount']     = $this->input->post('amount');
            $page_data['page_name']  = 'canteen_card_recharge_process';
            $page_data['active_link']  = 'canteen_card_recharge_process';
            if ($param == 'create'){
                $this->_prepare_canteen_validation();
                if($this->form_validation->run() === TRUE){
                    $data['student_id']   = $this->input->post('student_id');
                    $data['card_amount']  = $this->input->post('amount');
                    $data['role_id']      = $this->session->userdata('role_id');
                    $data['description']  = $this->input->post('description');
                    $data['payment_type'] = $this->input->post('payment_type');
                    $data['created_at']   = date('Y-m-d H:i:s');
                    $data['created_by']   = logged_in_user_id(); 
                    $this->db->insert('student_account', $data);
                    $amount = $data['card_amount'];
                    $this->db->set('balance', "balance+$amount", FALSE);
                    $this->db->where('student_id', $data['student_id']);
                    $this->db->update('student');

                    $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
                    redirect(site_url('admin/canteen_card_recharge'), 'refresh');
                }else{
                    redirect(site_url('admin/canteen_card_recharge_process'), 'refresh');
             }
      } 
        $page_data['page_title'] = get_phrase('Canteen Card Recharge Process');
        $this->load->view('backend/index',$page_data);
    }else{
        redirect(site_url('admin/canteen_card_recharge'), 'refresh');
   }
}

    private function _prepare_canteen_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-attendance" style="color: red;">', '</div>');

        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        
        $this->form_validation->set_rules('class_id','class_id', 'trim|required');
        $this->form_validation->set_rules('section_id','section_id', 'trim|required');
        $this->form_validation->set_rules('student_id','student_id', 'trim|required');
        $this->form_validation->set_rules('description','description', 'trim|required');
        $this->form_validation->set_rules('payment_type','payment_type', 'trim|required');
    }
     private function _prepare_hostel_staff_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-attendance" style="color: red;">', '</div>');

        
        
        $this->form_validation->set_rules('role_id','role_id', 'trim|required');
        $this->form_validation->set_rules('student_id','student_id', 'trim|required');
        $this->form_validation->set_rules('new_hostel_id','new_hostel_id', 'trim|required');
        $this->form_validation->set_rules('new_room_id','new_room_id', 'trim|required');
        $this->form_validation->set_rules('new_bed_id','new_bed_id', 'trim|required');
    }


    function canteen_inventory(){
        $page_data['page_name'] = 'canteen_inventory';
        $page_data['active_link']  = 'canteen_inventory';
        $page_data['page_title'] = get_phrase('Canteen Inventory');
        $this->load->view('backend/index',$page_data);
    }

    

  

    function scholarship_exam_student_regsitration($param1=FALSE,$param2 =FALSE,$param3 =FALSE){
           if ($this->session->userdata('admin_login') != 1)
             redirect(site_url('login'), 'refresh');
           
            $running_year = get_settings('running_year');
            if ($param1 == 'create') {
                $data = $this->_get_scholarship_exam_data($this->input->post(),$running_year);
                $this->db->insert('scholarship_student', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/scholarship_exam_student_regsitration'), 'refresh');
            }

            if ($param1 == 'edit') {
               /* $data = $this->_get_scholarship_exam_data($this->input->post());
                $this->db->insert('re_exam_cancel', $data);
                $this->db->where('exam_id', $this->input->post('exam'));
                $this->db->update('exam', array('cancel_status' => '1'));
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/reexam_and_cancellation'), 'refresh');*/
            }

        $page_data['page_name'] = 'scholarship_exam_student_regsitration';
        $page_data['active_link']  = 'scholarship_exam_student_regsitration';
        $page_data['page_title'] = get_phrase('Add Student');
        $this->load->view('backend/index',$page_data);
    }
    

    function _get_scholarship_exam_data($post,$running_year){
                $data['class_id']     = $post['class_id'];
                $data['section_id']   = $post['section_id'];
                $data['student_id']   = $post['student_list']; 
                $data['running_year'] = $running_year;
                return   $data;
    }



    function scholarship_exam_student_information($class_id = ''){
       if ($this->session->userdata('admin_login') != 1)
           redirect(site_url('login'), 'refresh');

        $page_data['page_name']     = 'scholarship_exam_student_information';
        $page_data['active_link']  = 'scholarship_exam_student_information';
        $page_data['page_title']    = get_phrase('student_information');
        $this->crud_model->get_class_name($class_id);
        $page_data['class_id']      = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function scholarship_exam_online_create(){
        $page_data['page_name'] = 'scholarship_exam_online_create';
        $page_data['active_link']  = 'scholarship_exam_online_create';
        $page_data['page_title'] = get_phrase('Create Online Exam');
        $this->load->view('backend/index',$page_data);
    }

    function scholarship_exam_online_manage($param1 = "",$param2 = ""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

            $running_year = get_settings('running_year');

        if($param1 == '') {
            $match = array('status !=' => 'expired', 'running_year' => $running_year);
            $page_data['status']       = 'active';
            $page_data['online_exams'] = $this->db->where($match)->get('scholarship_online_exam')->result_array();
          }
           
        if ($param1 == 'expired') {
            $match = array('status' => 'expired', 'running_year' => $running_year);
            $page_data['status']       = 'expired';
            $this->db->order_by("exam_date", "dsc");
            $page_data['online_exams'] = $this->db->where($match)->get('scholarship_online_exam')-> result_array();
         }

        if ($param1 == 'create') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->create_online_exam('scholarship_online_exam');
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
        }
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0) {
                $this->crud_model->update_online_exam('scholarship_online_exam');
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('scholarship_online_exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/scholarship_exam_online_manage'), 'refresh');
        }

        $page_data['page_name'] = 'scholarship_exam_online_manage';
        $page_data['active_link']  = 'scholarship_exam_online_manage';
        $page_data['page_title'] = get_phrase('Manage Online Exam');
        $this->load->view('backend/index',$page_data);
    }




     function tc_master_format(){
        $page_data['page_name'] = 'tc_master_format';
        $page_data['active_link']  = 'tc_master_format';
        $page_data['page_title'] = get_phrase('Uplaod Master Format');
        $this->load->view('backend/index',$page_data);
    }

    function tc_create(){
        $page_data['page_name'] = 'tc_create';
        $page_data['active_link']  = 'tc_create';
        $page_data['page_title'] = get_phrase('Create Certficate');
        $this->load->view('backend/index',$page_data);
    }

    function house_information($param=""){
        //$page_data['non_members'] = $this->ajaxload->get_hostel_member_list($is_hostel_member = 0);
        $page_data['list'] = 'list';
        if($param == 'add'){
           $page_data['list'] = 'add';
        }
        if($param == 'assign'){
           $page_data['list'] = 'assign';
        }
        if($param == 'non_member_list'){
           $page_data['list'] = 'non_member_list';
        }
    
        $assigned_student = $this->db->query("SELECT student_id FROM assign_house");

        foreach ($assigned_student as $student) {
            # code...
        }
        $query = $this->db->query("SELECT * FROM student WHERE  student_id NOT IN (SELECT student_id FROM assign_house)");

        $query_member = $this->db->query("SELECT * FROM student WHERE  student_id  IN (SELECT student_id FROM assign_house)");

        //print_r($assigned_student->result()); die();

        $page_data['non_members']    = $query->result();
        $page_data['assign_members'] = $query_member->result();
        $page_data['page_name']      = 'house_information';
        $page_data['active_link']  = 'house_information';
        $page_data['page_title']     = get_phrase('House Information');
        $this->load->view('backend/index',$page_data);
    }
    
    function books_bulk_add()
    {
         if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name']  = 'books_bulk_add';
        $page_data['active_link']  = 'books_bulk_add';
        $page_data['page_title'] = get_phrase('Add Bulk Books');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE Dormitory Visitory Add*****/
    function visitor_add()
    {
        $page_data['page_name']  = 'visitor_add';
        $page_data['active_link']  = 'visitor_add';
        $page_data['page_title'] = get_phrase('add_visitor');
        $this->load->view('backend/index', $page_data);
    }
    /****Asset Category Add*****/
    function add_asset_category($param1 = "",$param2 = "")
     {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data['category']     = $this->input->post('asset_category');
            $data['description']  = $this->input->post('description');
            if ($data['category'] != "") {
                $this->db->insert('asset_category',$data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/add_asset_category'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message',get_phrase('Please_add_asset_category'));
                redirect(site_url('admin/add_asset_category'), 'refresh');
            }
        }
        if($param1 == 'do_update' && $param2 != ""){
            $data['category']     = $this->input->post('asset_category');
            $data['description']  = $this->input->post('description');
            if ($data['category'] != "") {
                $this->db->where('asset_category_id',$param2);
                $this->db->update('asset_category',$data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                redirect(site_url('admin/add_asset_category'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message',get_phrase('Please_add_asset_category'));
                redirect(site_url('admin/add_asset_category'), 'refresh');
            }

        }
            if ($param1 == 'delete') {
                $this->db->where('asset_category_id', $param2);
                $this->db->delete('asset_category');
                $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
                redirect(site_url('admin/add_asset_category'), 'refresh');
            }
        $page_data['asset_category'] = $this->db->get_where('asset_category', array('status' => 1))->result();
        $page_data['page_name']  = 'add_asset_category';
        $page_data['active_link']  = 'add_asset_category';
        $page_data['page_title'] = get_phrase('asset_category');
        $this->load->view('backend/index', $page_data);
     }
    
  /****Asset Add*****/
    function add_asset($param1 ="",$param2=""){

        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'create') {
            $data = $this->asset_data($this->input->post());
            
           if ($data['name'] != "") {
                $this->db->insert('asset',$data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(site_url('admin/add_asset'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message',get_phrase('Please_add_asset_required_field !'));
                redirect(site_url('admin/add_asset'), 'refresh');
            }
        }
        if($param1 == 'do_update' && $param2 != ""){
            $data = $this->asset_data($this->input->post());
            if ($data['name'] != "") {
                $this->db->where('asset_id',$param2);
                $this->db->update('asset',$data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                redirect(site_url('admin/add_asset'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message',get_phrase('Please_add_asset_category'));
                redirect(site_url('admin/add_asset'), 'refresh');
            }

        }
        if ($param1 == 'delete') {
            $this->db->where('asset_id', $param2);
            $this->db->delete('asset');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/add_asset'), 'refresh');
        }

        $page_data['asset_data'] = $this->db->get_where('asset', array('status' => 1))->result();
        $page_data['page_name']  = 'add_asset';
        $page_data['active_link']  = 'add_asset';
        $page_data['page_title'] = get_phrase('Asset Management');
        $this->load->view('backend/index',$page_data);
    }
  
    function asset_report(){
        $page_data['asset_data'] = $this->db->get_where('asset', array('status' => 1))->result();
        $page_data['page_name'] = 'asset_report';
        $page_data['active_link']  = 'asset_report';
        $page_data['page_title'] = get_phrase('Asset Report');
        $this->load->view('backend/index',$page_data);
    }

    function asset_data($post){
   
       $data['name']         = $post['name'];
       $data['number_asset'] = $post['number_of_asset'];
       $data['category']     = $post['asset_category'];
       $data['description']  = $post['description'];   
      return $data;
   }


   // Hostel Attendance Management

   function manage_hostel_attendance()
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name']  =  'manage_hostel_attendance';
        $page_data['active_link']  = 'manage_hostel_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_hostel');
        $this->load->view('backend/index', $page_data);
    }


    function hostel_attendance_selector()
    {
        $data['hostel_id']  = $this->input->post('hostel_id');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
            
            $students = $this->db->get_where('hostel_members' , array(
                'hostel_id' => $data['hostel_id']))->result_array();

            foreach($students as $row) {
                $query = $this->db->get_where('hostel_attendance' ,array(
                   'hostel_id'=>$data['hostel_id'],
                     'timestamp'=>$data['timestamp'],
                        'student_id' => $row['user_id']
                ));

             if($query->num_rows() < 1) {
                $attn_data['hostel_id']  = $data['hostel_id'];
                $attn_data['year']       = $this->year;
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['student_id'] = $row['user_id'];
                $this->db->insert('hostel_attendance' , $attn_data);
            }
       }
        redirect(site_url('admin/manage_hostel_attendance_view/' . $data['hostel_id']. '/' . $data['timestamp']),'refresh');
    }

    function manage_hostel_attendance_view($hostel_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(site_url('login'), 'refresh');

        $class_name = $this->db->get_where('hostels' , array('id' => $hostel_id))->row()->name;
        $page_data['hostel_id'] = $hostel_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_hostel_attendance_view';
        $page_data['active_link']  = 'manage_hostel_attendance_view';
        $page_data['page_title'] = get_phrase('manage_attendance_of_hostel') . ' ' . $class_name;
        $this->load->view('backend/index', $page_data);
    }
   
    function hostel_attendance_update($hostel_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('hostel_attendance' , array(
            'hostel_id'=>$hostel_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();

        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('hostel_attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {
                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    if($parent_id != null && $parent_id != 0){
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        if($receiver_phone != '' || $receiver_phone != null){
                            $this->sms_model->send_sms($message,$receiver_phone);
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    }
                    else{
                     $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                    }
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('hostel_attendance_updated'));
        redirect(site_url('admin/manage_hostel_attendance_view/'.$hostel_id.'/'.$timestamp) , 'refresh');
    }

    function hostel_attendance_report() {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'hostel_attendance_report';
         $page_data['active_link']  = 'hostel_attendance_report';
         $page_data['page_title']   = get_phrase('hostel_attendance_report');
         $this->load->view('backend/index',$page_data);
     }

     function hostel_attendance_report_view($hostel_id = '', $month = '', $sessional_year = '')
     {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $hostel_name                    = $this->db->get_where('hostels', array('id' => $hostel_id))->row()->name;
        $page_data['hostel_id']         = $hostel_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['page_name']         = 'hostel_attendance_report_view';
        $page_data['active_link']  = 'hostel_attendance_report_view';
        $page_data['page_title']        = get_phrase('hostel_attendance_report_of_') . ' ' . $hostel_name;
        $this->load->view('backend/index', $page_data);
     }

    function hostel_attendance_report_print_view($hostel_id =''  , $month = '', $from = '', $to = '', $sessional_year = '') {
          if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['hostel_id']         = $hostel_id;
        $page_data['month']             = $month;
         $page_data['from']             = $from;
        $page_data['to']             = $to;
        $page_data['sessional_year']    = $sessional_year;
        $this->load->view('backend/admin/hostel_attendance_report_print_view' , $page_data);
    }

    function hostel_attendance_report_selector()
    {   
        
        if($this->input->post('hostel_id') == '' || $this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(site_url('admin/hostel_attendance_report'), 'refresh');
        }

        $data['hostel_id']      = $this->input->post('hostel_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');

        redirect(site_url('admin/hostel_attendance_report_view/' . $data['hostel_id'] .'/'. $data['month'] . '/' . $data['sessional_year']), 'refresh');
    }


   function room_switch_status(){
           
            
        if($this->input->post('status') =='approved'){      
        $data_hostel['user_id']        = $this->input->post('student_id');
        $data_hostel['room_id']        = $this->input->post('room_id');
        $data_hostel['hostel_id']      = $this->input->post('hostel_id');
 
        $data_hostel['modified_by']    = $this->session->userdata('login_user_id');
        $data_hostel['modified_at']    = date('Y-m-d H:i:s');

        $this->db->where('user_id',$this->input->post('student_id'));
        $this->db->update('hostel_members', $data_hostel);
        
        $hostel['dormitory_id']        = $this->input->post('room_id');
        $hostel['hostel_id']           = $this->input->post('hostel_id');
        
        $this->db->where('student_id',$this->input->post('student_id'));
        $this->db->update('student', $hostel);

        $this->db->where('id',$this->input->post('switch_id'));
        $data_hostel['status']         = 'approve';
        $this->db->update('room_change_request', array('room_status'=>'approve'));

    }else{
        $this->db->where('id',$this->input->post('switch_id'));
        $this->db->update('room_change_request', array('room_status'=>'reject'));
        echo 1;
    }
  }

    function substitute($param="",$param2=""){
     if($param=="create"){
       
       // Array ( [class_id] => 1 [section_id] => A [teacher_id] => 1 [subject_id] => 1 [date] => 11/27/2018 )
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('sectionval');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['date']       = $this->input->post('date');

        $this->db->insert('substitute_teacher',$data);
        $this->session->set_flashdata('flash_message' , get_phrase('added_data_successfully')); 
     }

      if($param=="delete" && $param2 != ""){

        $this->db->where('id',$param2);
        $this->db->delete('substitute_teacher');
        $this->session->set_flashdata('flash_message' , get_phrase('delete_data_successfully')); 
      }

      if($param=="edit" && $param2 != ""){
       
        //$this->db->where('id',$param2);
       // $this->db->delete('substitute_teacher');
       // $this->session->set_flashdata('flash_message' , get_phrase('delete_data_successfully')); 
      }

      redirect(site_url('admin/class_routine_view/'.$this->input->post('class_id')), 'refresh');
    }
     
    public function pos_c_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
    
        if ($name) {
           // echo "SELECT card_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name AND  card_code != null LIMIT 1";
            $query3  = $this->db->query("SELECT card_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");
            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
                $student_id = $row3['student_id'];
                $class_id   = $row3['class_id'];
                $section_id = $row3['section_id'];
             } 

            $query = $this->db->query("SELECT student_id,name,student_code,address,phone,email,parent_id FROM student WHERE student_id=$student_id");
            $result = $query->result_array();       
            foreach ($result as $row) {
             $parent_id = $row['parent_id'];
             $query2    = $this->db->query("SELECT name FROM parent WHERE parent_id=$parent_id");
             $result2   = $query2->result_array();
              foreach ($result2 as $row2) {
                 $parent_name = $row2['name'];  
              }
                $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                $stdnclass    = "<tr>
                   <td>Class</td>
                   <td>:</td>
                   <td> $class_name</td>
                   </tr>
                   <tr>
                       <td>Section</td>
                       <td>:</td>
                       <td>$section_name</td>
                   </tr>";
             
                   echo' <div class="id-card-holder" style="width: 225px;padding: 4px; margin: 0 auto; background-color: #1f1f1f;border-radius: 5px; position: relative;">
                    <div class="id-card" style="background-color: #fff;padding: 10px; border-radius: 10px; text-align: center;box-shadow: 0 0 1.5px 0px #b9b9b9;">
                        <div class="header" style="text-align: left;margin-left: 0px">
                            <img src="'.base_url('uploads/logo.png').'" style="max-height:60px;max-width: 60px">
                            <h2 style="display: inline;margin-left: 15px">Edurama</h2>
                        </div>
                        <div class="photo">
                            <img class="img-circle" src="'.base_url('uploads/student_image/').''.$row['student_id'].'.jpg" width="50">
                        </div>
                        <h2>54edf74</h2>
                        <div style="text-align: justify;margin-left: 7px">
                           <table class="">
                               <tbody><tr>
                                   <td>Name</td>
                                   <td>:</td>
                                   <td>'.$row['name'].' </td>
                               </tr>
                               <tr>
                                   <td>Parent</td>
                                   <td>:</td>
                                   <td>'.$parent_name.'</td>
                               </tr>
                             '.$stdnclass.'
                               <tr>
                                   <td>Contact </td>
                                   <td>:</td>
                                   <td> '. $row['phone'] . '</td>
                               </tr>

                           </tbody></table>
                           
                        </div>       

                    </div>
            </div>';
          }
        $counttotal=strlen($name);
         if($class_id !='' || $section_id !='' || $student_id !='') {
            if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);
                $attn_data['class_id']  =  $class_id;
                $attn_data['year']      =  $this->year;
                $attn_data['timestamp']  = $todays;
                $attn_data['section_id'] = $section_id;
                $attn_data['student_id'] = $student_id;
                $attn_data['status'] = 1;
            
                $attencence = $this->db->get_where('attendance' , array('timestamp' => $todays,'class_id'=>$attn_data['class_id'],'section_id'=>$attn_data['section_id'],'student_id'=>$attn_data['student_id']));

                if($attencence->num_rows() < 1) {                
                 $this->db->insert('attendance' , $attn_data);
                }else{
                $attendance_id = $attencence->row()->attendance_id;
                 $this->db->where('attendance_id',$attendance_id);
                 $this->db->update('attendance' ,array('status'=>1)); 
                }
            }
          }        
        }
      }
    }


    // RFID SEARCH
    public function rfid_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
       
        if ($name) {
            $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");

            if($query3 == 'null'){
                echo "RFID number not alloted to any student. Please check and try again!";
            }


            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
                $enroll_code = $row3['enroll_code'];
                $student_id = $row3['student_id'];
                $class_id   = $row3['class_id'];
                $section_id = $row3['section_id'];
             } 

            $query = $this->db->query("SELECT student_id,name,student_code,address,phone,email,parent_id FROM student WHERE student_id=$student_id");
             $url = $this->crud_model->get_image_url('student',$student_id);
            $result = $query->result_array();       
            foreach ($result as $row) {
             $parent_id = $row['parent_id'];
             $query2    = $this->db->query("SELECT name FROM parent WHERE parent_id=$parent_id");
             $result2   = $query2->result_array();
              foreach ($result2 as $row2) {
                 $parent_name = $row2['name'];  
              }
                $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                $stdnclass    = "<tr>
                   <td>Class</td>
                   <td>:</td>
                   <td> $class_name</td>
                   </tr>
                   <tr>
                       <td>Section</td>
                       <td>:</td>
                       <td>$section_name</td>
                   </tr>";
             
                   echo' <div class="id-card-holder rfid_search_card" style="width: auto;padding: 1%; margin: 0 auto; background-color: #fff;border-radius: 5px; position: relative;border-radius:5px;">
                   <div class="rfid_close"><i class="fas fa-times"></i></div>
                    <div class="id-card" style="background-color: #fff;padding: 0 10px 25px 10px; border-radius:2px; text-align: center; border:1px solid #f5f5f5">

                        
                        <div class="row" style="text-align: justify;margin-left: 0px;padding-top:3%;">
                           <div class="col-md-4 text-left" style="margin-top:5%">
                           <img class="img-responsive" style="max-width:100%" src="'.$url.'">
                           <h4>'.$enroll_code .'</h4>
                           </div>
                           <div class="col-md-8">
                           <table >
                               <tbody><tr>
                                   <td style="width:20%">Name</td>
                                   <td>:</td>
                                   <td>'.$row['name'].' </td>
                               </tr>
                               <tr>
                                   <td style="width:20%">Parent</td>
                                   <td>:</td>
                                   <td>'.$parent_name.'</td>
                               </tr>
                             '.$stdnclass.'
                               <tr>
                                   <td style="width:20%">Contact </td>
                                   <td>:</td>
                                   <td> '. $row['phone'] . '</td>
                               </tr>

                           </tbody></table>
                           </div>
                           
                        </div>       

                    </div>
            </div>';
          }
          $counttotal=strlen($name);
           if($class_id !='' || $section_id !='' || $student_id !='') {
              if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);
                $attn_data['class_id']  =  $class_id;
                $attn_data['year']      =  $this->year;
                $attn_data['timestamp']  = $todays;
                $attn_data['section_id'] = $section_id;
                $attn_data['student_id'] = $student_id;
                $attn_data['status'] = 1;
            
                $attencence = $this->db->get_where('attendance' , array('timestamp' => $todays,'class_id'=>$attn_data['class_id'],'section_id'=>$attn_data['section_id'],'student_id'=>$attn_data['student_id']));

                if($attencence->num_rows() < 1) {                
                 $this->db->insert('attendance' , $attn_data);
                }else{
                $attendance_id = $attencence->row()->attendance_id;
                 $this->db->where('attendance_id',$attendance_id);
                 $this->db->update('attendance' ,array('status'=>1)); 
                }
            }
          }        
        }
      }
    }

    
    
    
    
    // RFID SEARCH
    public function rfid_search_class_student()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
       
        if ($name) {
            $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");

            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
               
                $student_id = $row3['student_id'];
                $class_id   = $row3['class_id'];
                $section_id = $row3['section_id'];
             } 

            $query = $this->db->query("SELECT student_id,name,student_code,address,phone,email,parent_id FROM student WHERE student_id=$student_id");
             $url = $this->crud_model->get_image_url('student',$student_id);
            $result = $query->result_array();       
            foreach ($result as $row) {
             $parent_id = $row['parent_id'];
             $query2    = $this->db->query("SELECT name FROM parent WHERE parent_id=$parent_id");
             $result2   = $query2->result_array();
               $today = date("Y-m-d");
                $todays=  strtotime($today);
             $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
             $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
             $number_of_student_in_class = $this->db->get_where('enroll',array('class_id' =>$class_id,'section_id'=>$section_id))->num_rows();
             $number_of_attendence_student = $this->db->get_where('attendance',array('class_id' =>$class_id,'section_id'=>$section_id,'timestamp'=>$todays))->num_rows();
             $classnsection="<div class='col-sm-4 current-class text-left'><strong>Class : </strong><span> $class_name - $section_name</span></div>";
                   echo' <div class="row  mt-3">
             <div class="col-sm-4 current-class text-left"><strong>Class : </strong><span>  '.$class_name.'-  '.$section_name.'</span></div> 
          
             <div class="col-sm-4 marked-status"><strong>Marked : </strong><span>'.$number_of_attendence_student.'/'.$number_of_student_in_class.'</span></div> 
             </div>';
          }
           
                 
        }
      }
    }

    
    
    
    // RFID SEARCH
    public function teacher_rfid_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
       
        if ($name) {
            $query = $this->db->query("SELECT teacher_id,name,rfid_code,address,phone,email,designation FROM teacher WHERE rfid_code=$name");
            
            $result = $query->result_array();       
            foreach ($result as $row) {   
            $teacher_id=$row['teacher_id'];
       $url = $this->crud_model->get_image_url('teacher',$teacher_id);
           
             
                   echo'<div class="id-card-holder rfid_search_card" style="width: auto;padding: 1%; margin: 0 auto; background-color: #fff;border-radius: 5px; position: relative;border-radius:5px;">
                   <div class="rfid_close"><i class="fas fa-times"></i></div>
                    <div class="id-card" style="background-color: #fff;padding: 0 10px 25px 10px; border-radius:2px; text-align: center; border:1px solid #f5f5f5">

                        
                        <div class="row" style="text-align: justify;margin-left: 0px;padding-top:3%;">
                           <div class="col-md-4 text-left" style="margin-top:5%">
                           <img class="img-responsive" style="max-width:100%" src="'.$url.'">
                           <h4>'.$row['rfid_code'].'</h4>
                           </div>
                           <div class="col-md-8">
                           <table >
                               <tbody><tr>
                                   <td style="width:20%">Name</td>
                                   <td>:</td>
                                   <td>'.$row['name'].' </td>
                               </tr>
                               <tr>
                                   <td style="width:20%">Email</td>
                                   <td>:</td>
                                   <td>'.$row['email'].'</td>
                               </tr>
                           
                               <tr>
                                   <td style="width:20%">Contact </td>
                                   <td>:</td>
                                   <td> '. $row['phone'] . '</td>
                               </tr>
                              <tr>
                   <td>Designation</td>
                   <td>:</td>
                   <td> '.$row['designation'].'</td>
                   </tr>
                   <tr>
                       <td>Address</td>
                       <td>:</td>
                       <td>'.$row['address'].'</td>
                   </tr>
                           </tbody></table>
                           </div>
                           
                        </div>       

                    </div>
            </div>';
         
        $counttotal=strlen($name);
         if($teacher_id !='') {
            if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);               
                $attn_data['year']      =  $this->year;
                $attn_data['timestamp']  = $todays;           
                $attn_data['status'] = 1;
                $attn_data['emp_id'] = $teacher_id;
                $attn_data['role_id'] = 5;
                $attn_data['create_role_id'] = logged_in_role_id();;
                $attn_data['create_emp_id'] = logged_in_user_id();
            
                $attencence = $this->db->get_where('emp_attendance' , array('timestamp' => $todays,'emp_id'=>$teacher_id,'role_id'=>5));

                if($attencence->num_rows() < 1) {                
                 $this->db->insert('emp_attendance' , $attn_data);
                }else{
                $attendance_id = $attencence->row()->attendance_id;
                 $this->db->where('attendance_id',$attendance_id);
                 $this->db->update('emp_attendance' ,array('status'=>1)); 
                }
            }
          } 
 }        
        }
      }
   
    
      function teacher_get_ajax_attendence(){
        
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        $data['running_year']   = $this->year;

        $this->load->view('backend/admin/load_teacher_attendence_data', $data);
       // print_r($data);

    }
    

      function get_ajax_attendence(){
        $data['class_id']       = $this->input->post('class_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['to']          = $this->input->post('to');
        $data['from'] = $this->input->post('from');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        $data['running_year']   = $this->year;

        $this->load->view('backend/admin/load_attendence_data', $data);
       // print_r($data);

    }


         function get_ajax_employee_attendence(){
        $data['class_id']       = $this->input->post('class_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        $data['running_year']   = $this->year;



        $this->load->view('backend/admin/load_attendence_employee_data', $data);
       // print_r($data);

    }

    // MANAGE BOOK REQUESTS
    function book_request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "accept")
        {
            $data['status'] = 1;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            // INCREMENT NUMBER OF ISSUED COPIES
            $book_id        = $this->db->get_where('book_request', array('book_request_id' => $param2))->row()->book_id;
            $issued_copies  = $this->db->get_where('book', array('book_id' => $book_id))->row()->issued_copies;

            $data2['issued_copies'] = $issued_copies + 1;

            $this->db->update('book', $data2, array('book_id' => $book_id));

            $this->session->set_flashdata('flash_message', get_phrase('request_accepted_successfully'));
            redirect(site_url('admin/book'), 'refresh');
        }

        if ($param1 == "reject")
        {
            $data['status'] = 2;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('request_rejected_successfully'));
            redirect(site_url('librarian/book_request'), 'refresh');
        }

        $data['page_name']  = 'book_request';
        $page_data['active_link']  = 'book_request';
        $data['page_title'] = get_phrase('book_request');
        $this->load->view('backend/index', $data);
    }


    function invoice_template()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
            $page_data['page_name']  = 'invoice_template';
            $page_data['active_link']  = 'invoice_template';
            $page_data['page_title'] = get_phrase('invoice_template');
            $this->load->view('backend/index', $page_data);
    }

    function addclass_routine_data(){
      

       if ($_POST != '') {
          $count_vartical =  count($_POST['period']);
       if($count_vartical > 0){

            $count_horizontal = count($_POST['period'][0]); 
            $j=0;
            $data['section_id']       = $this->input->post('section_id');
            $data['class_id']         = $this->input->post('class_id');
            $this->db->where('class_id', $data['class_id']);
            $this->db->where('section_id',$data['section_id']);
            $this->db->update('class_routine',array('template_active' =>0));
            

            for($i=0;$i<$count_vartical;$i++){
                for($k=0;$k<$count_horizontal;$k++){
                    // $this->db->get_where
                    $editvalue                 = $this->input->post('editvalue')[$i][$k];
                    $data1['subject_id']       = $this->input->post('subject_id')[$i][$k];
                    $data1['teacher_id']       = $this->input->post('teacher')[$i][$k];
                    $data['template_active']   = 1;
                    $data1['create_at']        = date("Y-m-d H:i:s");
                    $data1['template_id']      = $this->input->post('template_id');

                    if($editvalue == ""){  
                       
                        $data['template_id']      = $this->input->post('template_id');
                        $data['period']           = $this->input->post('period')[$i][$k];
                        $data['day']              = $this->input->post('day')[$i][$k];
                        $data['year']             = $this->year;
                        $data['time_start']       = $this->input->post('time_start')[$i][$k];
                        $data['time_end']         = $this->input->post('endtime')[$i][$k];
                        $data['subject_id']       = $this->input->post('subject_id')[$i][$k];
                        $data['teacher_id']       = $this->input->post('teacher')[$i][$k];
                        $data['template_active']  = 1;
                        $data['create_at']        = date("Y-m-d H:i:s");

                    if($k == 0){
                        $this->db->where('class_id', $data['class_id']);
                        $this->db->where('section_id',$data['section_id']);
                        $this->db->where('template_id',$data['template_id']);
                        $this->db->update('class_routine',array('template_active' =>1));
                    }
                        
                        $this->db->insert('class_routine', $data); 

                    }else{
                        $data1['time_start']       = $this->input->post('time_start')[$i][$k];
                        $data1['time_end']         = $this->input->post('endtime')[$i][$k];

                        if($k == 0){
                         $this->db->where('class_id', $data['class_id']);
                         $this->db->where('section_id',$data['section_id']);
                         $this->db->where('template_id',$data1['template_id']);
                         $this->db->update('class_routine',array('template_active' =>1));
                        }

                        $this->db->where('class_routine_id',$editvalue);
                        $this->db->update('class_routine',$data1);
                }

                $data['class_id']         = $this->input->post('class_id');
                $data['section_id']       = $this->input->post('section_id');
                $data['template_id']      = $this->input->post('template_id');


            }
        }
      }
      redirect(site_url('admin/class_timetable/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['template_id']), 'refresh');
    
    }

    }
  
    
    function delete_classtimetable_data($param = "",$class="",$section =""){
        if($param != ''){
           $this->db->where('class_routine_id',$param);
           $this->db->delete('class_routine');
           $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
           redirect(site_url('admin/class_timetable/'.$class.'/'.$section), 'refresh');
         }

    }


    // DASHBOARD SCREENS
    function hostel_dashboard() {

        $this->data['hostels']    = $this->hostel->get_hostel_list();
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'hostel_dashboard';
        $this->data['active_link']  = 'hostel_dashboard';
        $this->data['page_title'] = 'Hostels';
        $this->data['folder']     = 'hostel';
        $this->load->view('backend/page', $this->data);
    }

    function admission_dashboard() {
        $this->data['list']       = TRUE;
        $this->data['active_main_menu'] = "admission";
        $this->data['active_sub_menu'] = " ";
        $this->data['page_name']  = 'admission_dashboard';
        $this->data['active_link']  = 'admission_dashboard';
        $this->data['page_title'] = 'Admissions';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    
    function student_dashboard() {
       // check_permission(VIEW);
        $this->data['active_link']  = 'student_dashboard';
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'student_dashboard';
        $this->data['page_title'] = 'Student';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    function teacher_dashboard() {
       // check_permission(VIEW);
        $this->data['active_link']  = 'teacher_dashboard';
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_dashboard';
        $this->data['page_title'] = 'Teacher';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function academic_dashboard($param="") {
       // check_permission(VIEW);
        if($param == "")
            $param =  $this->db->query('select * from class order by class_id asc limit 1')->row()->class_id;

        $this->data['list']       = TRUE;
        $this->data['class_id']   = $param;
       
        $this->data['page_name']  = 'academic_dashboard';
        $this->data['active_link']  = 'academic_dashboard';
        $this->data['page_title'] = 'Academics';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
   function transport_dashboard() {
       
       // check_permission(VIEW);
        $this->data['vehicles']   = $this->vehicle->get_vehicle_list();
        
        $this->data['list']       = TRUE;
        $this->data['list']       = TRUE;

        $routeList = $this->route->get_all_routes();

        foreach($routeList as $key => $obj){    
            $routeList[$key] -> vehicle_number = get_vehicle_by_ids($obj->vehicle_ids);

            /*$myData = json_decode($obj -> stop_details, false);
            $myData = json_decode($myData);*/
            $md = json_decode($obj -> stop_details);
            $ms = array();

            //print_r($md); 
            for($i = 0; $i < sizeof($md) - 1; $i++) {
                $ms[$i] = json_decode($md[$i]); 

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            $routeList[$key] -> stop_details = $ms;
        }
        // $data['status'] = 200;
        $this->data['routelist'] = $routeList;
        $this->data['page_name']  = 'transport_dashboard';
        $this->data['active_link']  = 'transport_dashboard';
        $this->data['page_title'] = 'Transport';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function facilities_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'facilities_dashboard';
        $this->data['active_link']  = 'facilities_dashboard';
        $this->data['page_title'] = 'Facilities';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    function human_resource_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'human_resource_dashboard';
        $this->data['active_link']  = 'human_resource_dashboard';
        $this->data['page_title'] = 'Human Resource';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    function assets_management_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'assets_management_dashboard';
        $this->data['active_link']  = 'assets_management_dashboard';
        $this->data['page_title'] = 'Assets Management';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function  card_settings() {
       // check_permission(VIEW);
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'card_settings';
        $this->data['active_link']  = 'card_settings';
        $this->data['page_title'] = 'Card Settings';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function  form_settings() {
       // check_permission(VIEW);
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'form_settings';
        $this->data['active_link']  = 'form_settings';
        $this->data['page_title'] = 'Form Settings';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }


    function accounts_payroll_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'accounts_payroll_dashboard';
        $this->data['active_link']  = 'accounts_payroll_dashboard';
        $this->data['page_title'] = 'Accounts & Payroll';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    function examination_results_dashboard($param = "") {
       // check_permission(VIEW);
        if($param =="")
           $param =  $this->db->query('select * from class order by class_id asc limit 1')->row()->class_id;

        $this->data['list']       = TRUE;
        $this->data['class_id']   = $param;
        $this->data['page_name']  = 'examination_results_dashboard';
        $this->data['active_link']  = 'examination_results_dashboard';
        $this->data['page_title'] = 'Examination Results';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    function extra_curricular_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'extra_curricular_dashboard';
        $this->data['active_link']  = 'extra_curricular_dashboard';
        $this->data['page_title'] = 'Extra Curricular';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    function scholarship_management_dashboard() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'scholarship_management_dashboard';
        $this->data['active_link']  = 'scholarship_management_dashboard';
        $this->data['page_title'] = 'Scholarship Management';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    function notification() {
       // check_permission(VIEW);
        //$this->crud_model->read_notification_status('admin','admin_id');

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
        $this->data['folder']       = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    

    function update_event_time(){

      $class_id   = $this->input->post('class_id');
      $this->data['active_link']  = 'event#tab_event_list';
      $section_id = $this->input->post('section_id');
      $event_start_time =  $this->input->post('event_start_time');
      $this->db->where('type','event_show_time');
      $this->db->update('settings',array('description'=>$event_start_time));
      redirect(site_url('admin/class_timetable/'.$class_id.'/'.$section_id), 'refresh');
    }
   
   function settime_for_classroutine(){
      // print_r($_POST);
      $data['start_time']    = $this->input->post('starttime');
      $data['interval_time'] = $this->input->post('intervaltime');
      $data['day']           = $this->input->post('day');

      $this->db->insert('class_routine_time',$data);
      $insert_id = $this->db->insert_id();
      if($insert_id != ""){
            $this->db->select('R.*');
            $this->db->from('class_routine AS R');
            $this->db->where('R.is_temporary', 'no');
            //$this->db->where('R.teacher_id', $teacher_id);
            //$this->db->where('R.day', $data['day']);
            $this->db->where('R.day', $data['day']); 
            $this->db->order_by('R.period', 'ASC');
            $period = $this->db->get()->result();
            print_r($period);

            foreach ($period as $key => $dt) {
                $dt->time_start;
                $selectedTime = "9:15:00";
                $endTime = strtotime("+15 minutes", strtotime($selectedTime));
                echo date('h:i:s', $endTime);



            }


            $selectedTime = "9:15:00";
            $endTime = strtotime("+15 minutes", strtotime($selectedTime));
           echo date('h:i:s', $endTime);
      }

   }
   function add_bulk_asset() {
       // check_permission(VIEW);
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'add_bulk_asset';
        $this->data['active_link']  = 'add_bulk_asset';
        $this->data['page_title'] = 'Add_Bulk_Asset';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    function add_bulk_category() {
       // check_permission(VIEW);

        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'add_bulk_category';
        $this->data['active_link']  = 'add_bulk_category';
        $this->data['page_title'] = 'Add_Bulk_Category';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }


    function ajax_updateAttendance(){
        //print_r($this->input->post());
        $data['status'] = $this->input->post('class_att');
        $data['gate_status']   = $this->input->post('gate_att');
        $data['bus_status']    = $this->input->post('bus_att');
        $data['attendence_by'] = 1;
        $id = $this->input->post('attendanceid');
       
         $this->db->where('attendance_id',$id);
         $this->db->update('attendance',$data);
         echo 1;
        
    }

    function syllabus_timeline($param = "") {
        // check_permission(VIEW);
         
         $this->data['syllabus_data']              = $this->db->get_where('academic_syllabus',array('academic_syllabus_id'=>$param))->row();
         $this->data['syllabus_module_info_data']  = $this->db->get_where('syllabus_module_info',array('syllabus_id'=>$param,'status'=>1))->result();

         $this->data['syllabus_id']                = $param ;
         $this->data['list']                      = TRUE;

         $this->data['page_name']                 = 'subject_timeline';
         $this->data['active_link']  = 'subject_timeline';
         $this->data['page_title']                = 'subject_timeline';
         $this->data['folder']                    = 'admin';

         $this->load->view('backend/page', $this->data);
    }

     function timetable_template($param="",$param2="") {
        $this->data['list']       = 'list'; $this->data['edit_']    = "";
        $this->data['edit_data']  = "";
        
         if($param =='create'){ 
          
           $data['name']          = $this->input->post('template_name');
           $data['start_time']    = $this->input->post('class_start_time');
           $data['time_interval'] = $this->input->post('period_interval'); 
           // $data['class_id']      = $this->input->post('class_id'); 
           // $data['section_id']    = $this->input->post('section_id');
           $data['numberofperiod']    = $this->input->post('number_of_periods'); 
           $this->db->insert('class_routine_template',$data);

           $last_insert = $this->db->insert_id(); 
           $this->session->set_flashdata('flash_message' , get_phrase('data_add_successfully'));
           redirect(site_url('admin/timetable_template/'.$last_insert), 'refresh');
         }

         if($param =='update_to'){
           $data['name']       = $this->input->post('template_name');
           $data['start_time'] = $this->input->post('class_start_time');
           $data['time_interval']= $this->input->post('period_interval');
           // $data['class_id']   = $this->input->post('class_id'); 
           // $data['section_id']    = $this->input->post('section_id'); 
           $data['numberofperiod']    = $this->input->post('number_of_periods'); 
           $this->db->where('id',$param2); 
           $this->db->update('class_routine_template',$data);
           $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
           redirect(site_url('admin/timetable_template/'), 'refresh');
         }

         if($param =='edit'){
            $this->data['list']     = 'edit';
            $this->data['edit_']    = $param2;
            $this->data['template_data_result']=  $this->db->get_where('class_routine_template',array('id'=>$param2))->row();
         }
          $this->data['template_data_result']   = "";
          //echo $param;die;
          if(isset($param) && is_numeric($param)){
            $this->data['template_data_result'] = $this->db->get_where('class_routine_template',array('id'=>$param))->row();
          }

         $data_name_ = $this->db->get('class_routine_template')->result();
        // $this->data['addTemplate']       = TRUE;
         $this->data['template_data']  = $data_name_;
         $this->data['page_name']  = 'timetable_template';
         $this->data['active_link']  = 'timetable_template';
         $this->data['page_title'] = 'timetable_template';
         $this->data['folder']     = 'admin';
         $this->load->view('backend/page', $this->data);
     }


     // GET Route List

     function search_input_student_info(){
        $card_code = $this->input->get('card_code');
        $data['card_code'] = $card_code;
        $data['page_name']  = 'quick_info';
        $data['active_link']  = 'quick_info';
        $data['page_title'] = '';
        $data['folder']     = 'admin';
        $this->load->view('backend/page', $data);
     }

     

     function universal_periods($param = ""){
        if($param == 'create'){
           $period_name =  count($this->input->post('period_name'));

           $this->db->where('template_id',$this->input->post('template_id'));
           $this->db->delete('universal_periods');

         for($i=0;$i < $period_name;$i++) {
              if($this->input->post('period_name')[$i] != ""){
                $data['template_id']   = $this->input->post('template_id');
                $data['name']          = $this->input->post('period_name')[$i];
                $data['interval_time'] = $this->input->post('uni_period_interval')[$i];
                $data['assign_period'] = $this->input->post('uni_period_placement')[$i];
                $this->db->insert('universal_periods', $data);
              }
         }  
      }
        redirect(site_url('admin/timetable_template/'.$data['template_id']), 'refresh');
             
     }

     function teacher_feedback() {
       // check_permission(VIEW);
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_feedback';
        $this->data['active_link']  = 'teacher_feedback';
        $this->data['page_title'] = 'Feedback';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }


    function teacher_feedback_manage() {
       // check_permission(VIEW);
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_feedback_manage';
        $this->data['active_link']  = 'teacher_feedback_manage';
        $this->data['page_title'] = 'Feedback Manage';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    // function load_feedback_question($type, $feedback_form_id,$formurl = "") {
    //     $page_data['question_type'] = $type;
    //     $page_data['feedback_form_id']= $feedback_form_id;
    //     $page_data['formurl']       = $formurl;
    //     $this->load->view('backend/admin/feedback_form_add'.$type, $page_data);
    // }

    function load_feedback_question($type, $form_id,$formurl = "") {
        $page_data['question_type'] = $type;
        $page_data['form_id']= $form_id;
        $page_data['formurl']  = $formurl;
        $this->load->view('backend/admin/feedback_form_add_'.$type, $page_data);
    }

    function teacher_feedback_response($type) {
        
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_feedback_response';
        $this->data['active_link']  = 'teacher_feedback_response';
        $this->data['page_title'] = 'Teacher Response';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function teacher_feedback_response_view($type) {
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_feedback_response_view';
        $this->data['active_link']  = 'teacher_feedback_response_view';
        $this->data['page_title'] = 'Teacher Response View';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function teacher_feedback_list($type) {
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'teacher_feedback_list';
        $this->data['active_link']  = 'teacher_feedback_list';
        $this->data['page_title'] = 'Teacher Feedback List';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }
    
    
  function teacher_feedback_by_student($param1 = "", $param2 = ""){
        $table_pre = 'teacher_feedback';
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

            $running_year = get_settings('running_year');

        if ($param1 == 'create') {
            if ($this->input->post('teacher_id') > 0) {             
                $this->crud_model->create_online_feedback($table_pre);
            #start here insert notification alert for feedback
            $links        = array();
            $arrayclass   = $this->input->post('teacher_id');
            $data1['title'] = 'Feedback Forms';
            $data1['send_to_role'] = 4;
            $data1['create_by_role'] = $this->session->userdata('role_id');
            $data1['create_user_id'] = $this->session->userdata('login_user_id');
            //$data1['title'] = 'Teacher Feedback';
            $data1['year']       = $this->year;          
           
            foreach ($arrayclass as $key => $dt){
                 $name= $this->db->get_where('teacher' , array('teacher_id' => $dt ))->row()->name; 
               $data1['msg'] ='Feedback For Teacher ' . $name;
               $this->db->insert('notification_alert', $data1);
            }
             $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('admin/teacher_feedback'), 'refresh');
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_'));
                redirect(site_url('admin/teacher_feedback'), 'refresh');
            }
        }
        if ($param1 == 'edit') {
            if ($this->input->post('teacher_id') > 0) {
                $this->crud_model->update_online_teacher_feedback($table_pre);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
                redirect(site_url('admin/teacher_feedback_list'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('make_sure_to_select_valid_class_').','.get_phrase('_section_and_subject'));
                redirect(site_url('admin/teacher_feedback_list'), 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('pre_online_exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('admin/teacher_feedback_list'), 'refresh');
        }

         $page_data['page_name'] = 'pre_exam_online_manage';
         $page_data['active_link']  = 'pre_exam_online_manage';
         $page_data['page_title'] = get_phrase('Manage Online Exam');
         $this->load->view('backend/index',$page_data);
    }   

    

    function teacher_feedback_manage_question($teacher_feedback_id = "", $task = "", $type = ""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud_model->add_question_teacher_feedback($teacher_feedback_id,'teacher_feedback_question');
            }
            redirect(site_url('admin/teacher_feedback_manage/'.$teacher_feedback_id), 'refresh');
        }

        $page_data['teacher_feedback_id'] = $teacher_feedback_id;
        $page_data['page_name'] = 'teacher_feedback_manage';
        $page_data['active_link']  = 'teacher_feedback_manage';
        $page_data['page_title'] = $this->db->get_where('teacher_feedback', array('id'=>$teacher_feedback_id))->row()->title;
        $this->load->view('backend/index', $page_data);
    }
  function feedback_delete_question_from_teacher($question_id){
        $online_exam_id = $this->db->get_where('teacher_feedback_question', array('question_id' => $question_id))->row()->question_id;
        $this->crud_model->delete_feedback_teacher_question($question_id);
        $this->session->set_flashdata('flash_message' , get_phrase('question_deleted'));
        redirect(site_url('admin/teacher_feedback_manage/'.$online_exam_id), 'refresh');
    }



    function date_sheet_view($param="") {
        $this->data['list']       = TRUE;
        $this->data['exam_id']    = $param;
        $this->data['page_name']  = 'date_sheet_view';
        $this->data['active_link']  = 'date_sheet_view';
        $this->data['page_title'] = 'Date Sheet';
        $this->data['folder']     = 'admin';
        $this->load->view('backend/page', $this->data);
    }

    function class_dailytimetable($param1="",$param2="",$param3=""){
      
        $page_data['page_name']            = 'class_dailyroutine';
        $page_data['active_link']  = 'class_dailyroutine';
        $page_data['template_data_result'] = $this->db->get_where('class_routine_template',array('class_id'=>$param1,'section_id'=>$param2))->row();
     
        $page_data['class_id']             = $param1;
        $page_data['section_id']           = $param2;
        $page_data['template_id']          = $param3;
        $page_data['page_title']           = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);

    }

   function update_teacher_feedback($param1 = ""){
        $page_data['id'] = $param1;
        $page_data['page_name'] = 'edit_teacher_feedback';
        $page_data['active_link']  = 'edit_teacher_feedback';
        $page_data['page_title'] = get_phrase('update_teacher_feedback');
        $this->load->view('backend/index', $page_data);
    }

    function update_assignment_marks(){

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        $count_row = count($this->input->post('marks'));
        $class = $this->input->post('class_id');
        for($i=0;$i<$count_row;$i++){
            if($this->input->post('marks')[$i] !=""){
                $student_id    = $this->input->post('student_id')[$i];
                $marks         = $this->input->post('marks')[$i];
                $assignment_id = $this->input->post('assignment_id')[$i];

                $this->db->where('assignment_id',$assignment_id);
                $this->db->where('student_id',$student_id);
                $this->db->update('submit_assignment',array('mark'=>$marks));
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('Update_marks_successfully'));
        redirect(site_url('assignment/index/'.$class.'/filter'), 'refresh');
    }


    function add_syllabus_module_data(){
         $module              =   $this->input->post('module_title');
         $data['syllabus_id'] = $this->input->post('syllabus_id');
         $data['year']        = $this->year;

         for($i=0;$i<count($module);$i++){
           $data['title']        = $this->input->post('module_title')[$i];
           if($data['title'] !=""){
             $data['persent_value']       = $this->input->post('persent_value')[$i];
             $data['module_no']           = $this->input->post('module_no')[$i];
             $data['decription']          = $this->input->post('module_description')[$i];
            if($this->input->post('editid')[$i] != ""){
              $this->db->where('id',$this->input->post('editid')[$i]);
              $this->db->update('syllabus_module_info',$data);
            }else{
              $this->db->insert('syllabus_module_info',$data);
             }
           }
         }

        $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
        redirect(site_url('admin/syllabus_timeline/'.$data['syllabus_id']));
    }
    function current_topic_syllabus_update($param = "",$param2=""){

      if($param == ""){
        $data['current_topic_title']       = $this->input->post('current_topic_title');
        $data['current_topic_desc']        = $this->input->post('current_topic_desc');
        $this->db->where('academic_syllabus_id',$this->input->post('syllabus_id'));
        $this->db->update('academic_syllabus',$data);
        $this->session->set_flashdata('flash_message', get_phrase('update_data_successfully'));
        redirect(site_url('admin/syllabus_timeline/'.$this->input->post('syllabus_id')));
      }else{
        $data['complete_syllabus']       = $param;
        $this->db->where('academic_syllabus_id',$param2);
        $this->db->update('academic_syllabus',$data);
        $this->session->set_flashdata('flash_message', get_phrase('update_data_successfully'));
        echo $param2;
      }

    }
    
    
function attendance_by_rfid($class_id = '', $section_id = '', $month = '', $sessional_year = '')
{
  if($this->session->userdata('admin_login')==1 || $this->session->userdata('teacher_login')==1 )
   {

$class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
$page_data['class_id']          = $class_id;
$page_data['section_id']        = $section_id;
$page_data['month']             = $month;
$page_data['sessional_year']    = $sessional_year;
$page_data['page_name']         = 'attendance_rfid';
$page_data['active_link']  = 'attendance_rfid';
$page_data['page_title']        = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
$this->load->view('backend/index', $page_data);
}else{
                redirect(site_url('login'), 'refresh');
            }
}

function teacher_profile($teacher_id)
  {
    if ($this->session->userdata('admin_login') != 1) {
      redirect(site_url('login'), 'refresh');
    }

    $page_data['field_arr']  = $this->crud_model->registration_form_fiels();
    $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields();

    $page_data['page_name']  = 'teacher_profile';
    $page_data['active_link']  = 'teacher_profile';
    $page_data['page_title'] = get_phrase('teacher_profile');
    $page_data['teacher_id'] = $teacher_id;
        $this->load->view('backend/index', $page_data);
  }

  // FACEBOOK SETTINGS page

  function facebook_settings(){
    if ($this->session->userdata('admin_login') != 1) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['facebook_settings']   = $this->db->get('facebook_settings')->result_array();
    $page_data['page_name']  = 'facebook_settings';
     $page_data['active_link']  = 'facebook_settings';
    $page_data['page_title'] = get_phrase('facebook_settings');
    $this->load->view('backend/index', $page_data);
  }

function update_facebook_settings(){
    $data['page_name'] = $this->input->post('page_name');
    $data['active_link']  = 'page_name';
    $data['page_width'] = $this->input->post('page_width');
    $data['page_height'] = $this->input->post('page_height');
    $data['tab_type'] = $this->input->post('tab_type');
    if($this->input->post('small_header') == 'on'){
        $data['small_header'] = 0;
    }
    else{
        $data['small_header'] = 1;
    }

    if($this->input->post('cover_photo') == 'on'){
        $data['cover_photo'] = 0;
    }
    else{
        $data['cover_photo'] = 1;
    }


    if($this->db->update('facebook_settings', $data)){
        echo 1;
    }   

    else{
        echo 0;
    }
    
  }


  function update_facebook_api_settings(){
    
    $data['user_id'] = $this->input->post('user_id');
    $data['access_token'] = $this->input->post('access_token');

    if($this->db->update('facebook_settings', $data)){
        echo 1;
    }   

    else{
        echo 0;
    }
    
  }
    
function holidays(){
    if ($this->session->userdata('admin_login') != 1) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name']  = 'holiday_registration';
    $page_data['active_link']  = 'holiday_registration';
    $page_data['page_title'] = get_phrase('holiday_registration');
    $this->load->view('backend/index', $page_data);
  }
  
  function add_holiday(){
      $data['title'] = $this->input->post('holiday_name');
      $data['date'] = $this->input->post('holiday_date');
      print_r( $data['date']);
      if($this->db->insert('holiday_leave', $data)){
          echo 1;
      }
      else{
          echo 0;
      }
      
  }
  function delete_holiday($id){
        $online_exam_id = $this->db->get_where('holiday_leave', array('id' => $id))->row()->id;
        $this->crud_model->delete_holidays_list($id);
        $this->session->set_flashdata('flash_message' , get_phrase('holiday_deleted'));
        redirect(site_url('admin/holidays'), 'refresh');
    }
    function registration_instructions($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'do_update') {
    
    
            $data['description'] = $this->input->post('registration_instructions');
            $this->db->where('type' , 'registration_instructions');
            $this->db->update('settings' , $data);  
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('admin/form_settings'), 'refresh');


        }
     
        $page_data['page_name']  = 'form_settings';
        $page_data['active_link']  = 'form_settings';
        $page_data['page_title'] = get_phrase('form_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }


     function message_template(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        
        $page_data['page_name']  = 'sms_template';
        $page_data['active_link']  = 'sms_template';
        $page_data['page_title'] = get_phrase('sms_template');
        $page_data['settings']   = $this->db->get('settings')->result_array();
            $this->load->view('backend/index',$page_data);
      
    }

    function message_template_add()
    {
        //  $title = $this->input->post('title');
        // $add_template = $this->input->post('add_template');
        $page_data  = $this->crud_model->insert_sms_template();
        redirect(site_url('backend/index'), 'refresh');

       

    }

        public function download_excel()
    {
        $month = $this->input->post('month');
        $year  = $this->input->post('sessional_year');

        $data = $this->db->query('SELECT * FROM travelled WHERE YEAR(created_at) = '. $year . ' AND MONTH(created_at) = '. $month)->result_array();

            
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Vechile');
        $sheet->setCellValue('D1', 'Vechile_type');
        $sheet->setCellValue('E1', 'Purpose');
        $sheet->setCellValue('F1', 'Start KM');
        $sheet->setCellValue('G1', 'End KM');    
        $sheet->setCellValue('H1', 'Total KM');
        $sheet->setCellValue('I1', 'Day');    
        $sheet->setCellValue('J1', 'Rent/Day');
        $sheet->setCellValue('K1', 'Fuel charge (10 Km/lt.)');    
        $sheet->setCellValue('L1', 'Total Bill Amount');
        $sheet->setCellValue('M1', 'Advance Paid');   
        $sheet->setCellValue('N1', 'Final Sttelment Amount');    
        $sheet->setCellValue('O1', 'Actual amt to be paid');
        $sheet->setCellValue('P1', 'Final Sttelment  Date');           
        $rows = 2;
        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['created_at']);
            $sheet->setCellValue('C' . $rows, $val['vehicle_no']);
            $sheet->setCellValue('D' . $rows, '');
            $sheet->setCellValue('E' . $rows, $val['vehicle_damage']);
            $sheet->setCellValue('F' . $rows, $val['start_km']);
            $sheet->setCellValue('G' . $rows, $val['end_km']);
            $sheet->setCellValue('H' . $rows, $val['total_distance']);
            $sheet->setCellValue('I' . $rows, '1');
            $sheet->setCellValue('J' . $rows, '');
            $sheet->setCellValue('K' . $rows, '');
            $sheet->setCellValue('L' . $rows, $val['cash'] + $val['diesel']+ $val['vechile_repairing']);
            $sheet->setCellValue('M' . $rows, '');
            $sheet->setCellValue('N' . $rows, '');
            $sheet->setCellValue('O' . $rows, '');
            $sheet->setCellValue('P' . $rows, '');

            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }


     function manage_account_section_holder($class_id = '', $datefrm = '', $dateto = '')
     {
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('admin_login')==1){
           

         
        $page_data['class_id']          = $class_id;
        $page_data['datefrm']             = $datefrm;
        $page_data['dateto']    = $dateto;

        $expenditure_heads = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $expenditures = $this->expenditure->get_expenditure_list(); 

         $page_data['expenditures']             = $expenditures;
        $page_data['expenditure_heads']    = $expenditure_heads;



        $page_data['page_name']         = 'manage_account_expenses_view';
        $page_data['active_link']  = 'manage_account_expenses_view';
      
        $this->load->view('backend/index', $page_data);
         }else{
             redirect(base_url() , 'refresh'); 
         }
     }



     function manage_account_expenses_section_holder($class_id = '', $month = '', $sessional_year = '')
     {
         if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $page_data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $page_data['expenditures'] = $this->expenditure->get_expenditure_list(); 

         
        $page_data['sessional_year']    = $sessional_year;

        $page_data['page_name']         = 'manage_account_expenses_view';
        $page_data['active_link']  = 'manage_account_expenses_view';
      
        $this->load->view('backend/index', $page_data);
     }


     function manage_account_section_paid_holder($datefrm = '', $dateto = '')
     {
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('accountant_login')==1)
            redirect(base_url() , 'refresh');
         
        $page_data['datefrm']             = $datefrm;
        $page_data['dateto']    = $dateto;
        $page_data['page_name']         = 'manage_account_section_paid_holder';
        $page_data['active_link']  = 'manage_account_section_paid_holder';
      
        $this->load->view('backend/index', $page_data);
     }


  function manage_account_section_unpaid_holder($datefrm = '', $dateto = '')
     {
         if($this->session->userdata('admin_login')==1 || $this->session->userdata('accountant_login')==1)
            {
         
        $page_data['datefrm']             = $datefrm;
        $page_data['dateto']    = $dateto;
        $page_data['page_name']         = 'manage_account_section_unpaid_holder';
        $page_data['active_link']  = 'manage_account_section_unpaid_holder';
      
        $this->load->view('backend/index', $page_data);
            }else{
                redirect(base_url() , 'refresh');
            }
     }

     function account_report_employee_selector()
    {   if($this->input->post('class_id') == '' || $this->input->post('datefrm') == '' || $this->input->post('dateto') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_employee_and_sessional_year_are_selected'));
            redirect(site_url('admin/manage_account_report'), 'refresh');
        }

        $data['class_id']       = $this->input->post('class_id');
        $data['datefrm']          = $this->input->post('datefrm');
        $data['dateto'] = $this->input->post('dateto');
        redirect(site_url('admin/manage_account_section_holder/' . $data['class_id'] . '/' . $data['datefrm'] . '/' . $data['dateto']), 'refresh');
    }



    function account_expenses_report_employee_selector()
    {   if($this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_employee_and_sessional_year_are_selected'));
            redirect(site_url('admin/manage_account_report'), 'refresh');
        }

     
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(site_url('admin/manage_account_expenses_section_holder/' . $data['sessional_year']), 'refresh');
    }



     function account_report_employee_paid_selector()
    {   if($this->input->post('datefrm') == '' || $this->input->post('dateto') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_date_are_selected'));
            redirect(site_url('admin/staff_salary_paid'), 'refresh');
        }

        $data['datefrm']          = $this->input->post('datefrm');
        $data['dateto'] = $this->input->post('dateto');
        redirect(site_url('admin/manage_account_section_paid_holder/' . $data['datefrm'] . '/' . $data['dateto']), 'refresh');
    }

     function account_report_employee_unpaid_selector()
    {   if($this->input->post('datefrm') == '' || $this->input->post('dateto') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_sessional_year_are_selected'));
            redirect(site_url('admin/staff_salary_unpaid'), 'refresh');
        }

        $data['datefrm']          = $this->input->post('datefrm');
        $data['dateto'] = $this->input->post('dateto');
        redirect(site_url('admin/manage_account_section_unpaid_holder/' . $data['datefrm'] . '/' . $data['dateto']), 'refresh');
    }

   

 
     public function export_account_expenses_excel()
      {
      $designation_id    = $this->input->get('class_id');
      $month = $this->input->get('month');
      $year  = $this->input->get('sessional_year');

      $expenditure_heads = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $expenditures = $this->expenditure->get_expenditure_list(); 
      
     
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial_no');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Accountant Name');
        $sheet->setCellValue('D1', 'Account Head');
        $sheet->setCellValue('E1', 'Particulars');
        $sheet->setCellValue('F1', 'Amount');
        $sheet->setCellValue('G1', 'Descriptions');
        $sheet->setCellValue('H1', 'Send to LKO date');
        $sheet->setCellValue('I1', 'Vochers Recieved AT RO');
        $sheet->setCellValue('J1', 'Remarks');
        $rows = 2;
        
            $count = 1; if(isset($expenditures) && !empty($expenditures)){
            foreach($expenditures as $obj){
            $sheet->setCellValue('A' . $rows, $count++);
            $sheet->setCellValue('B' . $rows, $obj->date);
            $sheet->setCellValue('C' . $rows, "Account Manager");
            $sheet->setCellValue('D' . $rows, "");
            $sheet->setCellValue('E' . $rows, $obj->head);
            $sheet->setCellValue('F' . $rows, $obj->amount);
            $sheet->setCellValue('G' . $rows, $obj->note);
            $sheet->setCellValue('H' . $rows, $obj->lko_date);
            $sheet->setCellValue('I' . $rows, $obj->voc_rec_at_ro);
            $sheet->setCellValue('J' . $rows, $obj->lko_remarks);
       
            $rows++;
         }            
        } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'Expenses';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file 
 
    }



     public function export_school_expenses_excel()
      {
      $datefrm = $this->input->get('datefrm');
      $dateto  = $this->input->get('dateto');
     
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial_no');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'POST');
        $sheet->setCellValue('D1', 'DOJ');
        $sheet->setCellValue('E1', 'Contact No');
        $sheet->setCellValue('F1', 'Monthly Salary');
        $sheet->setCellValue('G1', 'Total Advance Payment');
        $sheet->setCellValue('H1', 'No of Present');
        $sheet->setCellValue('I1', 'No of Absent');
        $sheet->setCellValue('J1', 'Total Number of days In Month');
        $sheet->setCellValue('K1', 'Total Payable Monthly Salary');
        
        $rows = 2;
            $designations = $this->db->get_where('designations')->result_array();
              foreach($designations as $desg){

                   $class_id = $desg['id'];
                   $designations_name = $desg['name'];
                   $primary_id = lcfirst($designations_name)."_id";
                   $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
                   $this->db->select('*');
                   $this->db->from(lcfirst($designations_name));
                   $query = $this->db->get()->result_array();
                foreach ($query as $val){
                  $total_salary_status = $this->db->query("SELECT * FROM employee_total_salary WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND employee_id = '$val[$primary_id]'")->result_array();

            $count = 1;
             if($total_salary_status[0]['status'] == '0') { 
         
        
            $sheet->setCellValue('A' . $rows, $count++);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $sheet->setCellValue('C' . $rows, $designations_name);
            $sheet->setCellValue('D' . $rows, $val['doj']);
            $sheet->setCellValue('E' . $rows, $val['phone']);
            $salary = $this->db->get_where('salary_payments', array('user_id' => $val[$primary_id]))->result_array();
                                    

            $sheet->setCellValue('F' . $rows, $salary[0]['basic_salary']);
              $total_advance = $this->db->query("SELECT SUM(amount) as total FROM advance_pay WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND employee_id = '$val[$primary_id]'")->result_array();

            $sheet->setCellValue('G' . $rows, $total_advance[0]['total']);

            $total_present = $this->db->query("SELECT Count(status) as present FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '1'")->result_array();

            $sheet->setCellValue('H' . $rows, $total_present[0]['present']);

             $total_absent = $this->db->query("SELECT Count(status) as absent FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '0'")->result_array();


            $sheet->setCellValue('I' . $rows, $total_absent[0]['absent']);

             $total_salary = $this->db->query("SELECT * FROM employee_total_salary WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();


                 $dateElements = explode('-', $total_salary_status[0]['date']);
                 $year = $dateElements[0];
                 $month=$dateElements[1];

               $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $sheet->setCellValue('J' . $rows, $number_of_days);

            $sheet->setCellValue('K' . $rows, $total_salary[0]['total_salary']);


           
            $rows++;
         }
         }
                   
        } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'Expenses';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file 
 
    }



        public function download_inventory_excel()
    {

        $datefrm = $this->input->post('datefrm');
        $dateto  = $this->input->post('dateto');

        $data = $this->db->query("SELECT * FROM inventory_warehouse WHERE created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
        $data_inventory = $this->db->query("SELECT inventory_type,created_at,SUM(name) as total FROM inventory WHERE  created_at  BETWEEN '$datefrm' AND '$dateto' group by inventory_type")->result_array();
        
            
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Class');
        $sheet->setCellValue('D1', 'Product Name');
        $sheet->setCellValue('E1', 'Total Purchased');
        $sheet->setCellValue('F1', 'Distributed');
        $sheet->setCellValue('G1', 'Total Available');    
                  
        $rows = 2;
        foreach ($data_inventory as $value){
            $sheet->setCellValue('A' . $rows, 'all');
            $sheet->setCellValue('B' . $rows, $value['created_at']);
            $class_name = $this->db->get_where('class', array('class_id' => $value['class_id']))->result_array();
                    if($value['inventory_type']==1){$invname='Chalk';$count_chalk=$value['total'];}if($value['inventory_type']==2){$invname='Duster';$count_duster=$value['total'];}
           
$sheet->setCellValue('C' . $rows, '');
            $sheet->setCellValue('D' . $rows, $invname);
            if($value['inventory_type']==1){
                        $sheet->setCellValue('E' . $rows, $count_chalk);
            }
            if($value['inventory_type']==2){
                        $sheet->setCellValue('E' . $rows, $count_duster);
            }
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet->setCellValue('F' . $rows, '');
            $sheet->setCellValue('G' . $rows, '');
            $rows++;
        }
        
        
        foreach ($data as $val){
             $name = $val['inven_id'] == 1 ? 'Chalk' : 'Duster';
            if($val['inven_id'] == 1){
                $count_chalk=$count_chalk-$val['quantity'];
            }
            if($val['inven_id'] == 2){
                $count_duster=$count_duster-$val['quantity'];
            }
            //$count = $val['inven_id'] == 1 ? 'Chalk' : 'Duster';
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
            $test = '';

            
            if($val['inven_id'] == 1){
            $cnt= $count_chalk;
            }
             if($val['inven_id'] == 2){
            $cnt=$count_duster;
            }
           
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
                   
            $sheet->setCellValue('C' . $rows, $class_name['0']['name']);
             
            $inventory_name = $this->db->get_where('inventory', array('id' => $val['inven_id']))->result_array();

            $sheet->setCellValue('D' . $rows, $name);
            $sheet->setCellValue('E' . $rows, '');
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet->setCellValue('F' . $rows, $val['quantity']);
            $sheet->setCellValue('G' . $rows, $cnt);
           

            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'chalk-duster-availability-'.$year.'-'.$month;
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }

       function update_advance_expeses_pay(){

        $update_field = $this->input->post('update_field');
        $user_id  = $this->input->post('user_id');
        $advance_update = $this->input->post('advance_update');
        
          $query = $this->db->get_where('expenditures' ,array(
                   'id' => $user_id,
                 ));

             if($query->num_rows() < 1){
                $attn_data[$update_field]   = $advance_update;
                $attn_data['id'] = $user_id;
                $this->db->insert('expenditures' , $attn_data);
              } else {
                
               $this->db->where('id',$user_id);  
                
                 $this->db->update('expenditures',array($update_field => $advance_update));

             }
}


    function update_advance_pay(){

        $month = $this->input->post('month');
        $year  = $this->input->post('year');
        $designation_id = $this->input->post('designation_id');
        $user_id = $this->input->post('user_id');
        $advance_salary = $this->input->post('advance_salary');

          $query = $this->db->get_where('employee_total_salary' ,array(
                   'designation_id' => $designation_id,
                     'employee_id' => $user_id,
                       'MONTH(date)' => $month,
                       'YEAR(date)' => $year

                    ));

             if($query->num_rows() < 1){
                $attn_data['designation_id']   = $designation_id;
                $attn_data['total_salary']  = $advance_salary;
                $date = $year . '-' . $month . '-01' ;
                $attn_data['date']  = $date;
                $attn_data['employee_id'] = $user_id;
                $this->db->insert('employee_total_salary' , $attn_data);
              } else {
                
               $this->db->where('designation_id',$designation_id)->where('employee_id',$user_id)->where('MONTH(date)',$month)->where('YEAR(date)',$year);              
                
                 $this->db->update('employee_total_salary',array('total_salary' => $advance_salary ));

             }
}


    function change_account_status(){

        $month = $this->input->post('month');
        $year  = $this->input->post('sessional_year');
        $designation_id = $this->input->post('designation_id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
       

          $query = $this->db->get_where('employee_total_salary' ,array(
                   'designation_id' => $designation_id,
                     'employee_id' => $user_id,
                       'MONTH(date)' => $month,
                       'YEAR(date)' => $year

                    ));

             if($query->num_rows() < 1){
                $attn_data['designation_id']   = $designation_id;
                $attn_data['total_salary']  = '';
                $date = $year . '-' . $month . '-01' ;
                $attn_data['date']  = $date;
                $attn_data['employee_id'] = $user_id;
                $attn_data['status'] = $status;
                $this->db->insert('employee_total_salary' , $attn_data);
              } else {

                $this->db->where('designation_id',$designation_id)->where('employee_id',$user_id)->where('MONTH(date)',$month)->where('YEAR(date)',$year);              
                
                $this->db->update('employee_total_salary',array('status' => $status));

             }
}

    
    //Transport Excel code for downloading excel
    
    public function download_transport_school_excel()
    {

        $datefrm = $this->input->get('datefrm');
        $dateto  = $this->input->get('dateto');
        //$month_name = date('F', mktime(0, 0, 0, $month, 10));
    
           $data = $this->db->query("SELECT * FROM travelled WHERE inventory_type=1 AND usage_location=2 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
        $data_inventory = $this->db->query("SELECT inventory_type,created_at,SUM(name) total FROM inventory_travel WHERE created_at  BETWEEN '$datefrm' AND '$dateto' group by inventory_type")->result_array();
            
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle('Filled in school');
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Month');
        $sheet->setCellValue('D1', 'Year');
        $sheet->setCellValue('E1', 'Vehicle number');
        $sheet->setCellValue('F1', 'Product Name');
        $sheet->setCellValue('G1', 'Total Purchased');
        $sheet->setCellValue('H1', 'Distributed');
        $sheet->setCellValue('I1', 'Total Available');    
                  
        $rows = 2;
        foreach ($data_inventory as $value){
            $sheet->setCellValue('A' . $rows, 'all');
            $sheet->setCellValue('B' . $rows, $value['created_at']);

            $dateValue = strtotime($value['created_at']);

                $month_name = date('F',$dateValue);
              
            $sheet->setCellValue('C' . $rows, $month_name);

            $parts = explode('-', $value['created_at']);
            $year =  $parts[0];
            $sheet->setCellValue('D' . $rows, $year);
            $class_name = $this->db->get_where('class', array('class_id' => $value['class_id']))->result_array();
                    if($value['inventory_type']==1){$invname='Diesel';$count_chalk=$value['total'];}if($value['inventory_type']==2){$invname='Mobil oil';$count_duster=$value['total'];}
           $sheet->setCellValue('E' . $rows, '');
            $sheet->setCellValue('F' . $rows, $invname);
            if($value['inventory_type']==1){
                        $sheet->setCellValue('G' . $rows, $count_chalk);
            }
            if($value['inventory_type']==2){
                        $sheet->setCellValue('G' . $rows, $count_duster);
            }
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet->setCellValue('H' . $rows, '');
            $sheet->setCellValue('I' . $rows, '');
            $rows++;
        }
        
        
        foreach ($data as $val){
             $name = $val['inventory_ty0pe'] == 1 ? 'Diesel' : 'Mobil oil';
            if($val['inventory_type'] == 1){
                $count_chalk=$count_chalk-$val['diesel'];
            }
            if($val['inventory_type'] == 2){
                $count_duster=$count_duster-$val['diesel'];
            }
            //$count = $val['inven_id'] == 1 ? 'Chalk' : 'Duster';
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
            $test = '';

            
            if($val['inventory_type'] == 1){
            $cnt= $count_chalk;
            }
             if($val['inventory_type'] == 2){
            $cnt=$count_duster;
            }
           
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();


                   
            $dateValue = strtotime($val['created_at']);

                $month_name = date('F',$dateValue);
              
            $sheet->setCellValue('C' . $rows, $month_name);

            $parts = explode('-', $val['created_at']);
            $year =  $parts[0];
            $sheet->setCellValue('D' . $rows, $year);

            $sheet->setCellValue('E' . $rows, $val['vehicle_no']);
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet->setCellValue('F' . $rows, $name);
            $sheet->setCellValue('G' . $rows, '');
            $sheet->setCellValue('H' . $rows, $val['diesel']);
            $sheet->setCellValue('I' . $rows, $cnt);
           

            $rows++;
        } 
        
         $spreadsheet->createSheet();

// Add some data to the second sheet, resembling some different data types
$spreadsheet->setActiveSheetIndex(1);
$sheet2=$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->setTitle('Filled at petrol pump');
 $data_new = $this->db->query("SELECT * FROM travelled WHERE inventory_type=2 AND usage_location=1 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();

 $sheet2->setCellValue('A1', 'Serial Number');
        $sheet2->setCellValue('B1', 'Date');
        $sheet2->setCellValue('C1', 'Month');
        $sheet2->setCellValue('D1', 'Year');
        $sheet2->setCellValue('E1', 'Vehicle number');
        $sheet2->setCellValue('F1', 'Product Name');
        $sheet2->setCellValue('G1', 'Total Purchased');
        $sheet2->setCellValue('H1', 'Distributed');
        $sheet2->setCellValue('I1', 'Cash given');  
 $rows = 2;
       
        
        foreach ($data_new as $val){
             $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
       
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet2->setCellValue('A' . $rows, $val['id']);
            $sheet2->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();

            $dateValue = strtotime($val['created_at']);
 
            $month_name = date('F',$dateValue);
  
            $sheet2->setCellValue('C' . $rows, $month_name);
            $parts = explode('-', $val['created_at']);
               $year = $parts[0];
             
            

            $sheet2->setCellValue('D' . $rows, $year);
            $sheet2->setCellValue('E' . $rows, $val['vehicle_no']);
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet2->setCellValue('F' . $rows, $name);
            $sheet2->setCellValue('G' . $rows, $val['diesel']);
            $sheet2->setCellValue('H' . $rows, $val['diesel']);
            $sheet2->setCellValue('I' . $rows, $val['cash']);
           

            $rows++;
        } 
        
        
        
       $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2);
$sheet3=$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->setTitle('Expenditure On Service');

           $data_vehicle = $this->db->query("SELECT * FROM vehicle_service WHERE status='1' AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
 $sheet3->setCellValue('A1', 'Serial Number');
        $sheet3->setCellValue('B1', 'Date');
        $sheet3->setCellValue('C1', 'Month');
        $sheet3->setCellValue('D1', 'Year');
        $sheet3->setCellValue('E1', 'Vehicle name');
        $sheet3->setCellValue('F1', 'Service Date');
        $sheet3->setCellValue('G1', 'Total Expenditure');
        $sheet3->setCellValue('H1', 'Next Service Date');
        $sheet3->setCellValue('I1', 'Remarks');
        $sheet3->setCellValue('J1', 'Fitness');
 $rows = 2;
       
        
        foreach ($data_vehicle as $val){
             
       
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet3->setCellValue('A' . $rows, $val['id']);
            $sheet3->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
                   
              $dateValue = strtotime($val['created_at']);
 
            $month_name = date('F',$dateValue);
  
            $sheet3->setCellValue('C' . $rows, $month_name);
            $parts = explode('-', $val['created_at']);
               $year = $parts[0];
             
            

            $sheet3->setCellValue('D' . $rows, $year);
            $sheet3->setCellValue('E' . $rows, $class_name[0]['number']);
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $sheet3->setCellValue('F' . $rows, $val['service_date']);
            $sheet3->setCellValue('G' . $rows, $val['total_cost']);
            $sheet3->setCellValue('H' . $rows, $val['next_service_date']);
            $sheet3->setCellValue('I' . $rows, $val['remark']);
            $sheet3->setCellValue('J' . $rows, $val['fitness']);
           

            $rows++;
        } 
        
        
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(3);
$sheet4=$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->setTitle('Total distance travelled bus');
  $data = $this->db->query("SELECT * FROM travelled WHERE inventory_type=1 AND usage_location=2 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
         $sheet4->setCellValue('A1', 'Serial Number');
        $sheet4->setCellValue('B1', 'Date');
        $sheet4->setCellValue('C1', 'Month');
        $sheet4->setCellValue('D1', 'Year');
        $sheet4->setCellValue('E1', 'Vehicle name');
        $sheet4->setCellValue('F1', 'Start run');
        $sheet4->setCellValue('G1', 'End run');
        $sheet4->setCellValue('H1', 'Total run');
        $sheet4->setCellValue('I1', 'Need to be paid');
        $sheet4->setCellValue('J1', 'Status');
 $rows = 2;
       
        
        foreach ($data as $val){
             
          $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
       
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet4->setCellValue('A' . $rows, $val['id']);
            $sheet4->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
                   
                      
              $dateValue = strtotime($val['created_at']);
 
            $month_name = date('F',$dateValue);
  
            $sheet4->setCellValue('C' . $rows, $month_name);
            $parts = explode('-', $val['created_at']);
               $year = $parts[0];
             
            

            $sheet4->setCellValue('D' . $rows, $year);
            $sheet4->setCellValue('E' . $rows, $val['vehicle_no']);
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            $paid='UNPAID';
            if($val['cash']!='' && is_numeric($val['cash'])){
                $paid='PAID';
            }
            $sheet4->setCellValue('F' . $rows, $val['start_km']);
            $sheet4->setCellValue('G' . $rows, $val['end_km']);
            $sheet4->setCellValue('H' . $rows, $val['start_km']-$val['end_km']);
            $sheet4->setCellValue('I' . $rows, $val['cash']);
            $sheet4->setCellValue('J' . $rows, $paid);

            $rows++;
        }
        
        
        
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(4);
$sheet5=$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->setTitle('Vehicle information');

$this->db->select('vehicles.*,routes.title,routes.id as ide,employees.name');
$this->db->from('vehicles');
$this->db->join('routes','vehicles.id=routes.vehicle_ids','Left');
$this->db->join('employees','employees.id=vehicles.driver','Left');
$query=$this->db->get();
$data=$query->result_array();
//echo $this->db->last_query();
//print_r($data);die;
//$data = $this->db->query('SELECT * FROM vehicles WHERE inventory_type=1 AND usage_location=2 AND YEAR(created_at) = '. $year . ' AND MONTH(created_at) = '. $month)->result_array();
         $sheet5->setCellValue('A1', 'Serial Number');
        $sheet5->setCellValue('B1', 'Date');
        $sheet5->setCellValue('C1', 'Month');
        $sheet5->setCellValue('D1', 'Year');
        $sheet5->setCellValue('E1', 'Vehicle name');
        $sheet5->setCellValue('F1', 'Owner name');
        $sheet5->setCellValue('G1', 'Contact no');
        $sheet5->setCellValue('H1', 'Alternate contact no');
        $sheet5->setCellValue('I1', 'Driver name');
        $sheet5->setCellValue('J1', 'Route');
 $rows = 2;
       
        
        foreach ($data as $val){
             
          $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
       
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet5->setCellValue('A' . $rows, $val['id']);
            $sheet5->setCellValue('B' . $rows, $val['created_at']);
            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
                   
                       
              $dateValue = strtotime($val['created_at']);
 
            $month_name = date('F',$dateValue);
  
            $sheet5->setCellValue('C' . $rows, $month_name);
            $parts = explode('-', $val['created_at']);
               $year = $parts[0];
             
            

            $sheet5->setCellValue('D' . $rows, $year);
            $sheet5->setCellValue('E' . $rows, $val['number']);
            
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            if($val['title']!=''){
                $paid='Not assigned';
            }else{
                $paid=$val['title'];
            }
            $sheet5->setCellValue('F' . $rows, $val['owner_name']);
            $sheet5->setCellValue('G' . $rows, $val['contact']);
            $sheet5->setCellValue('H' . $rows, $val['alternate_contact']);
            $sheet5->setCellValue('I' . $rows, $val['name']);
            $sheet5->setCellValue('J' . $rows, $paid);

            $rows++;
        }
        
        
        
        
        
        
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'diesel-mobil-oil-availability-school'.$year.'-'.$month;
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }

public function hostel_report_staff()
    {
        
        $hostel_room= $this->db->get_where('hostel_members_staff')->result_array();
        
    
                 
          if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
         
        $page_data['hostel_data']    = $hostel_room;
        $page_data['page_name']         = 'hostel_holder_staff';
        $page_data['active_link']  = 'hostel_report_staff';
      
        $this->load->view('backend/index', $page_data);
        
    }




    public function hostel_report()
    {
$year=date('Y');
          $this->db->select('hostel_members.*,student.name,student.phone,student.email,enroll.class_id ,enroll.section_id,hostels.name as hostel_name,hostels.type,rooms.room_no,rooms.cost,rooms.room_type,rooms.total_seat');
$this->db->from('hostel_members');
$this->db->join('student','student.student_id=hostel_members.user_id','Left');
$this->db->join('hostels','hostels.id=hostel_members.hostel_id','Left');
$this->db->join('rooms','rooms.hostel_id=hostel_members.hostel_id','Left');
$this->db->join('enroll','enroll.enroll_id=hostel_members.user_id','Left');
$query=$this->db->get();
//echo $this->db->last_query();die;
$data=$query->result_array();
            
          if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
         
        $page_data['hostel_data']    = $data;
        $page_data['page_name']         = 'hostel_holder';
        $page_data['active_link']  = 'hostel_holder';
      
        $this->load->view('backend/index', $page_data);
       //  $spreadsheet = new Spreadsheet();
       //  $spreadsheet->createSheet();
       //  $sheet = $spreadsheet->getActiveSheet();
       //  $sheet->setCellValue('A1', 'Serial Number');
       //  $sheet->setCellValue('B1', 'Student name');
       //  $sheet->setCellValue('C1', 'class');
       //  $sheet->setCellValue('D1', 'Section');
       //  $sheet->setCellValue('E1', 'Class teacher');
       //  $sheet->setCellValue('F1', 'Room no');
       //  $sheet->setCellValue('G1', 'Type');
       //  $sheet->setCellValue('H1', 'Total Seat');
       //   $sheet->setCellValue('I1', 'Room type'); 
       //    $sheet->setCellValue('J1', 'Hostel name');
       //  $sheet->setCellValue('K1', 'Hostel fee');
       //  $sheet->setCellValue('L1', 'Guardian name');
       //  $sheet->setCellValue('M1', 'Contact');
                  
       //  $rows = 2;
       
       //  //ini_set('display_errors',1);
       //  foreach ($data as $val){
             
       //      //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
       //      $sheet->setCellValue('A' . $rows, $val['id']);
       //      $sheet->setCellValue('B' . $rows, $val['name']);
       //      $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
       //      //if(isset($class_name) && )
       //      $section = $this->db->get_where('section', array('class_id' => $val['class_id']))->result_array();
       //      $teacher = $this->db->get_where('teacher', array('teacher_id' => $section[0]['teacher_id']))->result_array();
                   
       //      $sheet->setCellValue('C' . $rows, $class_name[0]['name']);
             
            

       //      $sheet->setCellValue('D' . $rows, $section[0]['name']);
       //      $sheet->setCellValue('E' . $rows, $teacher[0]['name']);
            
       //      $test = '';

       //      if($val['status'] == 1){
       //          $test = 'Paid';

       //      } else {
       //          $test = "Unpaid";

       //      }
       //      $sheet->setCellValue('F' . $rows, $val['room_no']);
       //      $sheet->setCellValue('G' . $rows, $val['type']);
       //      $sheet->setCellValue('H' . $rows, $val['total_seat']);
       //      $sheet->setCellValue('I' . $rows, $val['room_type']);

       //      $sheet->setCellValue('J' . $rows, $val['hostel_name']);
       //      $sheet->setCellValue('K' . $rows, $test);
       //      $sheet->setCellValue('L' . $rows, $val['phone']);
       //      $sheet->setCellValue('M' . $rows, $val['email']);
           

       //      $rows++;
       //  } 
       // // die;
       //  $writer = new Xlsx($spreadsheet);
 
       //  $filename = 'hostel-report-'.$year;
 
       //  header('Content-Type: application/vnd.ms-excel');
       //  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
       //  header('Cache-Control: max-age=0');
        
       //  $writer->save('php://output'); // download file 
 
    }


 /****Student Dormitory *****/
    function student_roomchange_request($param1 = "")
    {
       // echo !empty($_POST) && $param1 != "" && $param1=="create";die;
        if(!empty($_POST) && $param1 != "" && $param1=="create"){
             $member = $this->db->get_where('room_change_request', array(
                                'role_id'  => 21,'student_id'  => $this->input->post('student_id'),'room_status'  => 'pending','type'  => 1
                            ))->result_array();
                            
                            //$member = $this->db->query("Select * from hostel_members where role_id NOT IN ('1', '2', '3','4', '5', '6')")->result_array();
                          
                            
                            
                if(empty($member)){
          $student_id            = $this->input->post('student_id');
          $data['student_id']    = $student_id;
          $data['role_id']       = 21;
          $data['new_hostel_id'] = $this->input->post('hostel_id');
          $data['new_room_id']   = $this->input->post('room_id');
           $data['prev_hostel_id'] = $this->input->post('prev_hostel_id');
          $data['prev_room_id']   = $this->input->post('prev_room_id');
          $data['reason']   = $this->input->post('reason');
          $data['year']          = $this->year;
          $data['room_status']          = 'approve';
          $data['create_by']     = $this->session->userdata('login_user_id');
          $data['create_at']     = date('Y-m-d H:i:s');
          $this->db->insert('room_change_request',$data);
          //echo $this->db->last_query();
          $this->db->set('hostel_id', $data['new_hostel_id']);
                    $this->db->set('room_id',$data['new_room_id']);
                   
                    $this->db->where('user_id', $data['student_id']);
                    $this->db->where('role_id', 0);
                    $this->db->update('hostel_members');
                   // echo $this->db->last_query();die;
          $this->session->set_flashdata('flash_message', get_phrase('data_insert_successful'));
                }
          else{
                    echo '<script>alert("Request is still pending");</script>';
                    $this->session->set_flashdata('flash_message', 'Request is still in the queue');
                }
          
          redirect(site_url('admin/student_roomchange_request/'.$this->input->post('student_id')), 'refresh');
        }
        $page_data['hostel_data']= $this->crud_model->get_hostel_data($param1);
        $page_data['page_name']  = 'student_roomchange_request';
        $page_data['active_link']  = 'student_roomchange_request';
        $page_data['page_title'] = get_phrase('room_change_request');
        $this->load->view('backend/index', $page_data);
    }




    public function download_hostel_staff_report()
    {
$year=date('Y');
         $hostel_room= $this->db->get_where('hostel_members_staff')->result_array();
            
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'Staff name');
        $sheet->setCellValue('C1', 'Designation');
        $sheet->setCellValue('D1', 'Romm no');
        $sheet->setCellValue('E1', 'Bed no');
        
        $sheet->setCellValue('F1', 'Total Seat');
         $sheet->setCellValue('G1', 'Room type'); 
          $sheet->setCellValue('H1', 'Hostel name');
        $sheet->setCellValue('I1', 'Contact');
                  
        $rows = 2;
       
        //ini_set('display_errors',1);
        foreach ($hostel_room as $val){
             switch($val['designation_id']){
                        case 1:
                            $attendance_of_students = $this->db->get_where('driver', array(
                                'status'  => 1,'is_hostel_member'  => 1,'driver_id'  => $val['user_id']
                            ))->result_array();
                            $id='driver_';
                            $table='Driver';
                            break;
                        case 2:
                            $attendance_of_students = $this->db->get_where('warden', array(
                                'status'  => 1,'is_hostel_member'  => 1,'warden_id'  => $val['user_id']
                            ))->result_array();
                            $id='warden_';
                            $table='Warden';
                            break;
                        case 3:
                            $attendance_of_students = $this->db->get_where('inventory_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'inventory_manager_id'  => $val['user_id']
                            ))->result_array();
                            $id='inventory_manager_';
                            $table='Inventory manager';
                            break;
                        case 4:
                            $attendance_of_students = $this->db->get_where('transport_in', array(
                                'status'  => 1,'is_hostel_member'  => 1,'transport_id'  => $val['user_id']
                            ))->result_array();
                            
                            $id='transport_';
                            $table='Transport';
                            break;
                        case 5:
                            $attendance_of_students = $this->db->get_where('accountant', array(
                                'status'  => 1,'is_hostel_member'  => 1,'accountant_id'  => $val['user_id']
                            ))->result_array();
                            $id='accountant_';
                            $table='Accountant';
                            break;
                        case 6:
                            $attendance_of_students = $this->db->get_where('teacher', array(
                                'status'  => 1,'is_hostel_member'  => 1,'teacher_id'  => $val['user_id']
                            ))->result_array();
                            //echo $this->db->last_query();
                            $id='teacher_';
                            $table='Teacher';
                            break;
                        default:
                            $attendance_of_students =array();
                            $id='none';
                            $table='none';
                            break;
                    }
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            $hostel_name = $this->db->get_where('hostels',array('id'=>$val['hostel_id']))->row()->name;
                                 $subjectname = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->room_no;
                                 $total_seat = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->total_seat;
                                 $room_type = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->room_type;
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $attendance_of_students[0]['name']);
            
                   
            $sheet->setCellValue('C' . $rows, $table);
             
            

            $sheet->setCellValue('D' . $rows, $subjectname);
            $sheet->setCellValue('E' . $rows, $val['beds']);
           
            $sheet->setCellValue('F' . $rows, $room_type);
            $sheet->setCellValue('G' . $rows, $total_seat);
            $sheet->setCellValue('H' . $rows, $hostel_name);
            $sheet->setCellValue('I' . $rows, $attendance_of_students[0]['phone']);

            
           

            $rows++;
        } 
       // die;
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'hostel-report-staff-'.$year;
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }
    
    
    public function download_transport_school_room_excel()
    {

           $month = date('m');
        $year  = date('Y');
$month_name = date('F', mktime(0, 0, 0, $month, 10));
        $data = $this->db->query("SELECT * FROM room_change_request where role_id not in('1','2','3','4','5','6') and room_status='approve'")->result_array();
       
        $data_des = $this->db->query("SELECT * FROM room_change_request where role_id in('1','2','3','4','5','6') and room_status='approve'")->result_array();
        
        
            
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle('Room change request student');
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'Student name');
        $sheet->setCellValue('C1', 'Class');
        $sheet->setCellValue('D1', 'Guardian name');
        $sheet->setCellValue('E1', 'Previous hostel');
        $sheet->setCellValue('F1', 'Previous room no');
        $sheet->setCellValue('G1', 'Current hostel');
        $sheet->setCellValue('H1', 'Current room no');
        $sheet->setCellValue('I1', 'Year'); 
        $sheet->setCellValue('J1', 'Reason');    
                  
        $rows = 2;
        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $rows-1);
            $student_name = $this->db->get_where('student', array('student_id' => $val['student_id']))->row()->name;
            $sheet->setCellValue('B' . $rows, $student_name);
            
            $class_id = $this->db->get_where('enroll', array('student_id' => $val['student_id']))->row()->class_id;
            $parent_id = $this->db->get_where('student', array('student_id' => $val['student_id']))->row()->parent_id;
            $parent_name = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;
            $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
            $hostel_name = $this->db->get_where('hostels', array('id' => $val['new_hostel_id']))->row()->name;
            $room_name = $this->db->get_where('rooms', array('id' => $val['new_room_id']))->row()->room_no;
            if($val['prev_room_id']==0){
            $prev_room_name='not-specified';
            }else{
            $prev_room_name = $this->db->get_where('rooms', array('id' => $val['prev_room_id']))->row()->room_no;
            }
            if($val['prev_hostel_id']==0){
            $prev_hostel_name='not-specified';
            }else{
            $prev_hostel_name = $this->db->get_where('hostels', array('id' => $val['prev_hostel_id']))->row()->name;
            }


            
            $sheet->setCellValue('C' . $rows, $class_name);
            $sheet->setCellValue('D' . $rows, $parent_name);
            
           $sheet->setCellValue('E' . $rows, $prev_hostel_name);
            $sheet->setCellValue('F' . $rows, $prev_room_name);
           

           
            $sheet->setCellValue('G' . $rows, $hostel_name);
            $sheet->setCellValue('H' . $rows, $room_name);
            $sheet->setCellValue('I' . $rows, date('Y'));
            $sheet->setCellValue('J' . $rows, $val['reason']);
            $rows++;
        }
        
      
        
         $spreadsheet->createSheet();

// Add some data to the second sheet, resembling some different data types
$spreadsheet->setActiveSheetIndex(1);
$sheet2=$spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->setTitle('Room change request staff');

        $sheet2->setCellValue('A1', 'Serial Number');
        $sheet2->setCellValue('B1', 'Staff name');
        $sheet2->setCellValue('C1', 'Designation');
        $sheet2->setCellValue('D1', 'Previous hostel');
        $sheet2->setCellValue('E1', 'Previous room no');
        $sheet2->setCellValue('F1', 'Current hostel');
        $sheet2->setCellValue('G1', 'Current room no');
        $sheet2->setCellValue('H1', 'Year'); 
        $sheet2->setCellValue('I1', 'Reason');  
 $rows = 2;
       
        
        foreach ($data_des as $val){
            $sheet2->setCellValue('A'.$rows , $rows-1);
            switch($val['role_id']){
                        case 1:
                            $attendance_of_students = $this->db->get_where('driver', array(
                                'status'  => 1,'is_hostel_member'  => 1,'driver_id'  => $val['student_id']
                            ))->result_array();
                            $id='driver_';
                            $table='Driver';
                            break;
                        case 2:
                            $attendance_of_students = $this->db->get_where('warden', array(
                                'status'  => 1,'is_hostel_member'  => 1,'warden_id'  => $val['student_id']
                            ))->result_array();
                            $id='warden_';
                            $table='Warden';
                            break;
                        case 3:
                            $attendance_of_students = $this->db->get_where('inventory_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'inventory_manager_id'  => $val['student_id']
                            ))->result_array();
                            $id='inventory_manager_';
                            $table='Inventory manager';
                            break;
                        case 4:
                            $attendance_of_students = $this->db->get_where('transport_in', array(
                                'status'  => 1,'is_hostel_member'  => 1,'transport_id'  => $val['student_id']
                            ))->result_array();
                            
                            $id='transport_';
                            $table='Transport';
                            break;
                        case 5:
                            $attendance_of_students = $this->db->get_where('accountant', array(
                                'status'  => 1,'is_hostel_member'  => 1,'accountant_id'  => $val['student_id']
                            ))->result_array();
                            $id='accountant_';
                            $table='Accountant';
                            break;
                        case 6:
                            $attendance_of_students = $this->db->get_where('teacher', array(
                                'status'  => 1,'is_hostel_member'  => 1,'teacher_id'  => $val['student_id']
                            ))->result_array();
                            //echo $this->db->last_query();
                            $id='teacher_';
                            $table='Teacher';
                            break;
                        default:
                            $attendance_of_students =array();
                            $id='none';
                            $table='none';
                            break;
                    }
            $sheet2->setCellValue('B'.$rows, $attendance_of_students[0]['name']);
            $hostel_name = $this->db->get_where('hostels', array('id' => $val['new_hostel_id']))->row()->name;
            $room_name = $this->db->get_where('rooms', array('id' => $val['new_room_id']))->row()->room_no;
            if($val['prev_room_id']==0){
            $prev_room_name='not-specified';
            }else{
            $prev_room_name = $this->db->get_where('rooms', array('id' => $val['prev_room_id']))->row()->room_no;
            }
            if($val['prev_hostel_id']==0){
            $prev_hostel_name='not-specified';
            }else{
            $prev_hostel_name = $this->db->get_where('hostels', array('id' => $val['prev_hostel_id']))->row()->name;
            }       
            $sheet2->setCellValue('C'.$rows, $table);
            $sheet2->setCellValue('D'.$rows , $prev_hostel_name);
            $sheet2->setCellValue('E'.$rows , $prev_room_name);
           

           
            $sheet2->setCellValue('F'.$rows , $hostel_name);
            $sheet2->setCellValue('G'.$rows , $room_name);
            $sheet2->setCellValue('H'.$rows , date('Y'));
            $sheet2->setCellValue('I'.$rows , $val['reason']);
           

            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'room-change-request-'.$year.'-'.$month;
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }
    
    
    
    public function download_hostel_report()
    {
$year=date('Y');
          $this->db->select('hostel_members.*,student.name,student.phone,student.email,enroll.class_id ,enroll.section_id,hostels.name as hostel_name,hostels.type,rooms.room_no,rooms.cost,rooms.room_type,rooms.total_seat');
$this->db->from('hostel_members');
$this->db->join('student','student.student_id=hostel_members.user_id','Left');
$this->db->join('hostels','hostels.id=hostel_members.hostel_id','Left');
$this->db->join('rooms','rooms.hostel_id=hostel_members.hostel_id','Left');
$this->db->join('enroll','enroll.enroll_id=hostel_members.user_id','Left');
$query=$this->db->get();
//echo $this->db->last_query();die;
$data=$query->result_array();
            
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Serial Number');
        $sheet->setCellValue('B1', 'Student name');
        $sheet->setCellValue('C1', 'class');
        $sheet->setCellValue('D1', 'Section');
        $sheet->setCellValue('E1', 'Class teacher');
        $sheet->setCellValue('F1', 'Room no');
        $sheet->setCellValue('G1', 'Type');
        $sheet->setCellValue('H1', 'Total Seat');
         $sheet->setCellValue('I1', 'Room type'); 
          $sheet->setCellValue('J1', 'Hostel name');
        $sheet->setCellValue('K1', 'Hostel fee');
        $sheet->setCellValue('L1', 'Guardian name');
        $sheet->setCellValue('M1', 'Contact');
                  
        $rows = 2;
       
        //ini_set('display_errors',1);
        foreach ($data as $val){
             
            //echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
            //if(isset($class_name) && )
            $section = $this->db->get_where('section', array('class_id' => $val['class_id']))->result_array();
            $teacher = $this->db->get_where('teacher', array('teacher_id' => $section[0]['teacher_id']))->result_array();
                   
            $sheet->setCellValue('C' . $rows, $class_name[0]['name']);
             
            

            $sheet->setCellValue('D' . $rows, $section[0]['name']);
            $sheet->setCellValue('E' . $rows, $teacher[0]['name']);
            
            $test = '';

            if($val['status'] == 1){
                $test = 'Paid';

            } else {
                $test = "Unpaid";

            }
            $sheet->setCellValue('F' . $rows, $val['room_no']);
            $sheet->setCellValue('G' . $rows, $val['type']);
            $sheet->setCellValue('H' . $rows, $val['total_seat']);
            $sheet->setCellValue('I' . $rows, $val['room_type']);

            $sheet->setCellValue('J' . $rows, $val['hostel_name']);
            $sheet->setCellValue('K' . $rows, $test);
            $sheet->setCellValue('L' . $rows, $val['phone']);
            $sheet->setCellValue('M' . $rows, $val['email']);
           

            $rows++;
        } 
       // die;
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'hostel-report-'.$year;
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }
    
    

}