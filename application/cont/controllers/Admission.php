<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admission extends MY_Controller
{
  function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        $this->load->model('Assignment_Model', 'assignment', true);
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {

    }

    public function registration(){
		$page_data['field_arr']              = $this->crud_model->registration_form_fiels_pre_student();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_pre_student_admission();
        $page_data['page_name'] = 'registration_form';
        $page_data['page_title'] = get_phrase('Pre Exam Student Registration');
        $this->load->view('backend/registration',$page_data);
    }
    
        public function registration_preview(){
		$page_data['field_arr']              = $this->crud_model->registration_form_fiels_pre_student();
         $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields_pre_student();
        $page_data['page_name'] = 'registration_preview';
        $page_data['page_title'] = get_phrase('Pre Exam Student Registration');
        $this->load->view('backend/registration_preview',$page_data);
    }
    
    
   function student_pre($param1 = '', $param2 = '', $param3 = '')
     {
     
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
          
            $data['email']    = $this->input->post('email');
              $otp   = $this->input->post('otp');
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
            $otp_validation= $this->db->query("Select * from pre_student_verification_code where verification_code='$otp' AND status='0'")->num_rows();
           if($otp_validation !=''){
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

                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('pre_student', $data['email']); 
            }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
           
            }
            
           }
            else {
                $this->session->set_flashdata('error_message' , get_phrase('this_otp_not_valid_please_check_again_your_email'));
           
            }
            redirect(site_url('admission/registration'), 'refresh');
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
                $this->crud_model->clear_cache();
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
           else{
             $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
           }
            redirect(site_url('admission/registration/' . $param3), 'refresh');
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
   
      function otp_verification(){

      $data['user_email']    = $email1=$this->input->post('email');
      $data['verification_code']   =$six_digit_random_number = mt_rand(100000, 999999);
      $data['create_time'] = $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
      $this->db->insert('pre_student_verification_code',$data);
      $insert_id = $this->db->insert_id();
      
      if($insert_id != ""){
     $email= "$email1";

       $msg="Dear User Your Email Verification OTP is $six_digit_random_number";
       mail("$email","Email Id Verification OTP",$msg);
      }

   }
   
   
}