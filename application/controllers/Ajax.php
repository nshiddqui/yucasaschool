<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * ***************Ajax.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Ajax
 * @description     : This class used to handle ajax call from view file 
 *                    of whole application.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Ajax extends My_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Ajax_Model', 'ajax', true);
        $this->load->library('session');
    }

    /**     * *************Function get_user_by_role**********************************
     * @type            : Function
     * @function name   : get_user_by_role
     * @description     : this function used to manage user role list for user interface   
     * @param           : null 
     * @return          : $str string value with user role list 
     * ********************************************************** */
    public function get_user_by_role() {

        $role_id  = $this->input->post('role_id');
        $class_id = $this->input->post('class_id');
        $user_id  = $this->input->post('user_id');
        $message  = $this->input->post('message');

        $users    = array();
        if ($role_id == TEACHER) {
//print_r($this->input->post());die;
            $users = $this->ajax->get_list('teacher', array('status' => 1), '', '', '', 'id', 'ASC');
        } elseif ($role_id == GUARDIAN) {
            $users = $this->ajax->get_list('guardians', array('status' => 1), '', '', '', 'id', 'ASC');
        } elseif ($role_id == PARENTT) {
            $users = $this->ajax->get_list('parent', array('status' => 1), '', '', '', 'id', 'ASC');
        }elseif ($role_id == ACCOUNTANT) {
            $users = $this->ajax->get_list('accountant', array('status' => 1), '', '', '', 'id', 'ASC');
        }elseif ($role_id == LIBRARIN) {
            $users = $this->ajax->get_list('librarian', array('status' => 1), '', '', '', 'id', 'ASC');
        }elseif ($role_id == LIBRARIN) {
            $users = $this->ajax->get_list('librarian', array('status' => 1), '', '', '', 'id', 'ASC');
        }elseif ($role_id == DRIVER || $role_id == WARDEN || $role_id == CANTEEN) {
            $users = $this->ajax->get_list('designation_users', array('status' => 1,'role_id'=>$role_id), '', '', '', 'id', 'ASC');
        } elseif ($role_id == STUDENT) {
            if ($class_id) {
                $users = $this->ajax->get_student_list($class_id);
            } else {
                 $users = $this->ajax->get_list('student', array('status' => 1), '', '', '', 'id', 'ASC');
            }
        } else {
            $this->db->select('E.*');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->where('U.role_id', $role_id);
            $users = $this->db->get()->result();
        }

        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (!$message) {
            $str .= '<option value="0">' . $this->lang->line('all') . '</option>';
        }

        $select = 'selected="selected"';

        if (!empty($users)) {
            foreach ($users as $obj) {
                if($role_id == STUDENT){
                $selected = $user_id == $obj->student_id ? $select : '';
                $str .= '<option value="' . $obj->student_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->student_code . ')</option>';
                }elseif($role_id == PARENTT){
                $selected = $user_id == $obj->parent_id ? $select : '';
                $str .= '<option value="' . $obj->parent_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->parent_id . ')</option>';
                }elseif($role_id == TEACHER){
                $selected = $user_id == $obj->teacher_id ? $select : '';
                $str .= '<option value="' . $obj->teacher_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->teacher_id . ')</option>';
                }elseif($role_id == TEACHER){
                $selected = $user_id == $obj->teacher_id ? $select : '';
                $str .= '<option value="' . $obj->teacher_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->teacher_id . ')</option>';
                }elseif($role_id == ACCOUNTANT){
                $selected = $user_id == $obj->accountant_id ? $select : '';
                $str .= '<option value="' . $obj->accountant_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->accountant_id . ')</option>';
                }elseif($role_id == LIBRARIN){
                $selected = $user_id == $obj->librarian_id ? $select : '';
                $str .= '<option value="' . $obj->librarian_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->librarian_id . ')</option>';
                }elseif($role_id == DRIVER || $role_id == WARDEN || $role_id == CANTEEN){
                
                $employees_name = $this->db->get_where('employees',array('user_id'=>$obj->designation_users_id))->row()->name;
               /* $str .=$employees_name; */
                $selected = $user_id == $obj->designation_users_id ? $select : '';
                $str .= '<option value="' . $obj->designation_users_id . '" ' . $selected . '>' . $employees_name . '(' . $obj->designation_users_id . ')</option>';
                }
                else{
                   $selected = $user_id == $obj->user_id ? $select : '';
                   $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->id . ')</option>';  
                }
            }
        }

        echo $str;
    }

    /*     * **************Function get_tag_by_role**********************************
     * @type            : Function
     * @function name   : get_tag_by_role
     * @description     : this function used to manage user role tag list for user interface   
     * @param           : null 
     * @return          : $str string value with user role tag list 
     * ********************************************************** */

    public function get_tag_by_role() {

        $role_id = $this->input->post('role_id');
        $tags = get_template_tags($role_id);
        $str = '';
        foreach ($tags as $value) {
            $str .= '<span> ' . $value . ' </span>';
        }

        echo $str;
    }

    /**     * *************Function update_user_status**********************************
     * @type            : Function
     * @function name   : update_user_status
     * @description     : this function used to update user status   
     * @param           : null 
     * @return          : boolean true/false 
     * ********************************************************** */
    public function update_user_status() {

        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        if ($this->ajax->update('users', array('status' => $status), array('id' => $user_id))) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    /**     * *************Function get_student_by_class**********************************
     * @type            : Function
     * @function name   : get_student_by_class
     * @description     : this function used to populate student list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */
    public function get_student_by_class() {

        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');   
        
        $students = $this->ajax->get_student_list($class_id);
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
           
        
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->student_id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->student_code . ']</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_exam_by_academic_year**********************************
     * @type            : Function
     * @function name   : get_exam_by_academic_year
     * @description     : this function used to populate section list by exam 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_exam_by_academic_year() {

        $academic_year_id = $this->input->post('academic_year_id');
        $exam_id = $this->input->post('exam_id');
        
        $exams = $this->ajax->get_list('exams', array('status' => 1, 'academic_year_id' => $academic_year_id), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        
        $select = 'selected="selected"';
        if (!empty($exams)) {
            foreach ($exams as $obj) {
                $selected = $exam_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
            }
        }

        echo $str;
    }

    

    /**     * *************Function get_section_by_class**********************************
     * @type            : Function
     * @function name   : get_section_by_class
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_section_by_class() {

        $class_id   = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $sections   = $this->ajax->get_list('sections', array('status' => 1, 'class_id' => $class_id), '', '', '', 'id', 'ASC');
        $str        = '<option value="">--' . $this->lang->line('select') . '--</option>';
        
        $select     = 'selected="selected"';

        if (!empty($sections)) {
            foreach ($sections as $obj) {
                $selected = $section_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }
        echo $str;
    }

     /**     * *************Function get_section_by_class**********************************
     * @type            : Function
     * @function name   : get_section_by_class
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_class_by_section() {

        $class_id  = $this->input->post('class_id');
        //$section_id = $this->input->post('section_id');
        $sections   = $this->ajax->get_list('section', array('class_id' => $class_id,'sub_teacher_status' => 0), '', '', '', 'section_id', 'ASC');
        $str        = '<option value="">--'.get_phrase('select').'--</option>';
        
        $select     = 'selected="selected"';
        
        if (!empty($sections)) {
            foreach ($sections as $obj) {
             /*   $selected = $class_id == $obj->section_id ? $select : '';*/
                $str .= '<option value="' . $obj->section_id . '" >' . $obj->name . '</option>';
            }
        }
        echo $str;
    }

    
     /**     * *************Function get_section_by_student**********************************
     * @type            : Function
     * @function name   : get_section_by_student
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_section_by_student() {

        $class_id    = $this->input->post('class_id');
        $section_id  = $this->input->post('section_id');

        if($section_id == "")
          $sections   = $this->ajax->get_list_student($class_id,$section_id);
        else
          $sections   = $this->ajax->get_list_student($class_id,$section_id); 

        $str        = '<option value="">--'.get_phrase('select').'--</option>';
        
        $select     = 'selected="selected"';
        if (!empty($sections)) {
            foreach ($sections as $obj) {
             /*   $selected = $class_id == $obj->section_id ? $select : '';*/
                $str .= '<option value="' . $obj->student_id . '" >' . $obj->name.' ('.$obj->enroll_code.' ) ' . '</option>';
            }
        }

        else{
            $str = '<option value="">--'.get_phrase('No Student Enrolled').'--</option>';
        }

        echo $str;
    }
    
    
    /*     * **************Function get_student_by_section**********************************
     * @type            : Function
     * @function name   : get_student_by_section
     * @description     : this function used to populate student list by section 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */

    public function get_student_by_section() {

        $student_id = $this->input->post('student_id');
        $section_id = $this->input->post('section_id');

        $students = $this->ajax->get_student_list_by_section($section_id);
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->roll_no . ']</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_subject_by_class**********************************
     * @type            : Function
     * @function name   : get_subject_by_class
     * @description     : this function used to populate subject list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with subject list
     * ********************************************************** */
    public function get_subject_by_class() {

        $class_id    = $this->input->post('class_id');
        $subject_id  = $this->input->post('subject_id');
       
        if($this->session->userdata('role_id') == TEACHER){
            $techer_id     = $this->session->userdata('login_user_id');
            //$subjects = $this->ajax->get_list('subjects', array('class_id' => $class_id, 'teacher_id'=>$this->session->userdata('login_user_id')), '', '', '', 'id', 'ASC');
            $subjects = $this->db->query("SELECT assign_subject.subject_id,subject.name FROM assign_subject LEFT JOIN subject ON subject.subject_id=assign_subject.subject_id  WHERE assign_subject.teacher_id=$techer_id AND subject.class_id=$class_id ")->result();
       
        }else{
        
            $subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result();
        }
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
       
        $select = 'selected="selected"';
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected = $subject_id == $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->subject_id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_assignment_by_subject**********************************
     * @type            : Function
     * @function name   : get_assignment_by_subject
     * @description     : this function used to populate assignment list by subject 
      for user interface
     * @param           : null 
     * @return          : $str string  value with assignment list
     * ********************************************************** */
    public function get_assignment_by_subject() {

        $subject_id = $this->input->post('subject_id');
        echo $assignment_id = $this->input->post('assignment_id');

        $assignments = $this->ajax->get_list('assignments', array('status' => 1, 'subject_id' => $subject_id, 'academic_year_id' => $this->academic_year_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($assignments)) {
            foreach ($assignments as $obj) {
                $selected = $assignment_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_guardian_by_id**********************************
     * @type            : Function
     * @function name   : get_guardian_by_id
     * @description     : this function used to populate guardian information/value by id 
      for user interface
     * @param           : null 
     * @return          : $guardina json  value
     * ********************************************************** */
    public function get_guardian_by_id() {

        header('Content-Type: application/json');
        $guardian_id = $this->input->post('guardian_id');

        $guardian = $this->ajax->get_single('guardians', array('id' => $guardian_id));
        echo json_encode($guardian);
        die();
    }

    /**     * *************Function get_room_by_hostel**********************************
     * @type            : Function
     * @function name   : get_room_by_hostel
     * @description     : this function used to populate room list by hostel  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_room_by_hostel() {

        $hostel_id = $this->input->post('hostel_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'type' => 1, 'hostel_id' => $hostel_id), '', '', '', 'id', 'ASC');

        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('room_no') . '--</option>';
        $selected = '';
        if (!empty($hostels)) {
            foreach ($hostels as $obj) {
                $countrow = 0;
                $roomCount   = $this->db->get_where('hostel_members', array('status' => 1, 'hostel_id' => $hostel_id,'room_id' => $obj->id))->result();
                if(sizeof($roomCount) > 0){
                 $countrow =  count($roomCount);
                }
                $availbleseat = ($obj->total_seat)-$countrow;
                if($availbleseat > 0){
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->room_no . ' [ ' . $this->lang->line($obj->room_type) . '-seats -'.$availbleseat.']</option>';
                }
            }
        }
        echo $str;
    }
    
    
    public function get_total_room_by_hostel() {
        $hostel_id = $this->input->post('hostel_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'type' => 1, 'hostel_id' => $hostel_id), '', '', '', 'id', 'ASC');

        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('room_no') . '--</option>';
        $selected = '';
        if (!empty($hostels)) {
            foreach ($hostels as $obj) {
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->room_no . '</option>';
            }
        }
        echo $str;
    }
    
    /**     * *************Function get_room_by_hostel_staff**********************************
     * @type            : Function
     * @function name   : get_room_by_hostel
     * @description     : this function used to populate room list by hostel  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_room_by_hostel_staff() {

        $hostel_id = $this->input->post('hostel_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'type' => 2, 'hostel_id' => $hostel_id), '', '', '', 'id', 'ASC');

        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('room_no') . '--</option>';
        $selected = '';
        if (!empty($hostels)) {
            foreach ($hostels as $obj) {
                $countrow = 0;
                $roomCount   = $this->db->get_where('hostel_members_staff', array('status' => 1, 'hostel_id' => $hostel_id,'room_id' => $obj->id))->result();
                if(sizeof($roomCount) > 0){
                 $countrow =  count($roomCount);
                }
                $availbleseat = ($obj->total_seat)-$countrow;
                if($availbleseat > 0){
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->room_no . ' [ ' . $this->lang->line($obj->room_type) . '-seats -'.$availbleseat.']</option>';
                }
            }
        }
        echo $str;
    }
    

      public function get_bed_by_room_hostel() {

        $hostel_id = $this->input->post('hostel_id');
        $room_id = $this->input->post('room_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'id' => $room_id), '', '', '', 'id', 'ASC');


        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('beds') . '--</option>';
        $selected = '';

        if (!empty($hostels)) {
            foreach ($hostels as $obj){

         for($i=1; $i < $obj->total_seat + 1; $i++){
             $roomCountStudent   = $this->db->get_where('hostel_members', array('status' => 1,'room_id' => $room_id,'beds'=>$i))->result();
             if(empty($roomCountStudent)){
                 $str .= '<option value="' . $i. '" ' . $selected . '>' . $i . '</option>';
             }
          }
         }
              
        }
        echo $str;
    }
    
    
     public function get_bed_by_room_hostel_staff() {

        $hostel_id = $this->input->post('hostel_id');
        $room_id = $this->input->post('room_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'id' => $room_id), '', '', '', 'id', 'ASC');


        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('beds') . '--</option>';
        $selected = '';

        if (!empty($hostels)) {
            foreach ($hostels as $obj){

         for($i=1; $i < $obj->total_seat + 1; $i++){
           $roomCount   = $this->db->get_where('hostel_members_staff', array('status' => 1,'room_id' => $room_id,'beds'=>$i))->result();
            $roomCountStudent   = $this->db->get_where('hostel_members', array('status' => 1,'room_id' => $room_id,'beds'=>$i))->result();
            //print_r($roomCount);
            //echo $this->db->last_query();
                if(empty($roomCount) && empty($roomCountStudent)){
          $str .= '<option value="' . $i. '" ' . $selected . '>' . $i . '</option>';
                }
          }
         }
              
        }
        echo $str;
    }
    
    
    /**     * *************Function get_bus_stop_by_route**********************************
     * @type            : Function
     * @function name   : get_bus_stop_by_route
     * @description     : this function used to populate bus stop list by route  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_bus_stop_by_route() {

        $route_id = $this->input->post('route_id');

        $stops = $this->ajax->get_list('route_stops', array('status' => 1, 'route_id' => $route_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('room_no') . ' --</option>';
        $selected = '';
        if (!empty($stops)) {
            foreach ($stops as $obj) {
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->stop_name . ' [' . $obj->stop_fare . ']</option>';
            }
        }

        echo $str;
    }
    
    
    /** * *************Function get_email_template_by_role**********************************
     * @type            : Function
     * @function name   : get_email_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_email_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('email_templates', array('status' => 1, 'role_id' => $role_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->template . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
    
    /** * *************Function get_sms_template_by_role**********************************
     * @type            : Function
     * @function name   : get_sms_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_sms_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('sms_templates', array('status' => 1, 'role_id' => $role_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->template . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
    
    
    /*****************Function get_user_list_by_type**********************************
     * @type            : Function
     * @function name   : get_user_list_by_type
     * @description     : Load "Employee or Teacher Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_list_by_type() {
        
         $payment_to  = $this->input->post('payment_to');
         $user_id  = $this->input->post('user_id');
       
         $users = $this->ajax->get_user_list($payment_to);
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
            if (!empty($users)) {
            foreach ($users as $obj) {  
                if($payment_to=='teacher'){			
                $selected = $user_id == $obj->teacher_id ? $select : '';
             $str .= '<option value="' . $obj->teacher_id . '" ' . $selected . '>' . $obj->name .'</option>';
              }elseif($payment_to=='librarian'){
			    $selected = $user_id == $obj->librarian_id ? $select : '';
             $str .= '<option value="' . $obj->librarian_id . '" ' . $selected . '>' . $obj->name .'</option>';	
				
			}elseif($payment_to=='accountant'){
			    $selected = $user_id == $obj->accountant_id ? $select : '';
             $str .= '<option value="' . $obj->accountant_id . '" ' . $selected . '>' . $obj->name .' </option>';	
				
			}
			else{
			   $selected = $user_id == $obj->user_id ? $select : '';
             $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name .' </option>';	
				
			}
			
			}
        }

        echo $str;
    }
    
    
	  public function get_cycle_list_by_exam() {
        
         $payment_to  ='exam';
           $user_id  = $this->input->post('exam_id');
         $users = $this->db->query("select * from exam_cycle where exam_id='$user_id'")->result();
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
            if (!empty($users)) {
            foreach ($users as $obj) {  
             
             $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name .'</option>';	
				
		
			
			}
        }

        echo $str;
    }
	    /*****************Function get_assignment_list_by_type**********************************
     * @type            : Function
     * @function name   : get_assignment_list_by_type
     * @description     : Load "Employee or Teacher Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_assignment_list_by_type() {
        
		$payment_to  = $this->input->post('payment_to');
        $users = $this->ajax->get_user_lists($payment_to);
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
            if (!empty($users)) {
            foreach ($users as $obj) {  
			  $selected = $payment_to == $obj->class_id ? $select : '';
              $str .= '<option value="' . $obj->class_id . '" ' . $selected . '>' . $obj->title .'</option>';	
	        }
        }
        echo $str;
    }
    
	
	
    /*****************Function get_user_single_payment**********************************
     * @type            : Function
     * @function name   : get_user_single_payment
     * @description     : validate the paymeny to user already paid for selected month               
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_single_payment() {
        
         $payment_to    = $this->input->post('payment_to');
         $user_id       = $this->input->post('user_id');
         $salary_month  = $this->input->post('salary_month');
         
         $exist = $this->ajax->get_single('salary_payments',array('user_id'=>$user_id, 'salary_month'=>$salary_month, 'payment_to'=>$payment_to ));
         
         if($exist){
             echo 1;
         }else{
             echo 2;
         }
         
    }
    
    public function get_class_section_wise_exam(){
        //print_r($this->input->post());

       $class_id   = $this->input->post('class_id');
       $section_id = $this->input->post('section_id');

       if($section_id != "" && $class_id != ""){
         $examval = $this->ajax->get_list('exam_schedule', array('class_id' => $class_id,'section_id' => $section_id), '', '', '', '', '');
       }elseif($class_id != "" && $section_id == ""){
         $examval = $this->ajax->get_list('exam_schedule', array('class_id' => $class_id), '', '', '', '', '');
       }

        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($examval)) {
            foreach ($examval as $obj) {
                $subjectname = $this->db->get_where('subject',array('subject_id'=>$obj->subject_id))->row()->name;
                $exam_name   = $this->db->get_where('exam',array('exam_id'=>$obj->exam_id))->row()->name;
                $selected    = "";
                //$selected = $student_id == $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $exam_name . ' [' .$subjectname . ']</option>';
            }
        }

        echo $str;
    }


    function get_student_details(){
            $student_id = $this->input->post('student_id');
            $data = $this->ajax->get_list_student_details($student_id);
            if($data != "")
              echo  json_encode($data);
    }

    function update_field_status(){
        //print_r($this->input->post('field_id'));
        $data = $this->ajax->update_field_status($this->input->post('field_id'));
        echo "Field status update succuss";
    }

    function update_card_field_status(){
        //print_r($this->input->post('field_id'));
        $data = $this->ajax->update_card_field_status($this->input->post('field_id'));
        echo "Field status update succuss";
    }

    function update_field_status_pre_student(){
       // print_r($this->input->post('field_id'));
        $data = $this->ajax->update_field_status_pre_student($this->input->post('field_id'));
        echo "Field status update succuss";
    }
        function update_field_status_teacher(){
        //print_r($this->input->post('field_id'));
        $data = $this->ajax->update_field_status_teacher($this->input->post('field_id'));
        echo "Field status update succuss";
    }
	
	
function update_field_pre_student_status(){
        $data = $this->ajax->update_field_pre_student_status($this->input->post('field_id'));
        echo "Field status update succuss";
    }
	
	
	 function update_status_pre_student_id(){
       // print_r($this->input->post('field_id'));
        $data = $this->ajax->update_status_pre_student_id($this->input->post('field_id'));
        echo "Field status update succuss";
    }
	
	
    function insert_registration_fields(){
        $items = array();
        $items[] = 'name';
        //$items[] = 'type';
        $items[] = 'json_field_elements';
        $items[] = 'html_code';
        $items[] = 'description';
       // echo $_POST['name'];
        $data    = elements($items, $_POST); 
       // print_r($data);
        $this->db->insert('registration_form_setting',$data);
       // print_r($data);

    }

    function insert_registration_fields_teacher(){
        $items = array();
        $items[] = 'name';
        //$items[] = 'type';
        $items[] = 'json_field_elements';
        $items[] = 'html_code';
        $items[] = 'description';
       // echo $_POST['name'];
        $data    = elements($items, $_POST); 
       // print_r($data);
        $this->db->insert('registration_form_setting_teacher',$data);
       // print_r($data);

    }
  function insert_registration_fields_pre_student(){
        $items = array();
        $items[] = 'name';      
        $items[] = 'json_field_elements';
        $items[] = 'html_code';
        $items[] = 'description';      
        $data    = elements($items, $_POST); 
        $this->db->insert('registration_form_setting_pre_student',$data);

    }
    

function check_registration_fields(){

   $postval =  $this->input->post('val');
   $result  =  $this->db->get_where('registration_form_setting',array('name'=>$postval))->row()->id;
   if($result != "")
     echo "1";
}
function check_registration_fields_pre_student(){

   $postval =  $this->input->post('val');
   $result  =  $this->db->get_where('registration_form_setting_pre_student',array('name'=>$postval))->row()->id;
   if($result != "")
     echo "1";
}
public function detele_fields_()
{
   $del_val =  $this->input->post('del_val');
   $this->db->where('id', $del_val);
   $this->db->delete('registration_form_setting');
   
   echo "1";

}

public function detele_fields_teacher()
{
   $del_val =  $this->input->post('del_val');
   $this->db->where('id', $del_val);
   $this->db->delete('registration_form_setting_teacher');
   echo "1";
}

public function detele_fields_pre_student()
{
   $del_val =  $this->input->post('del_val');
   $this->db->where('id', $del_val);
   $this->db->delete('registration_form_setting_pre_student');
   echo "1";
}
public function get_student_parent_by_class(){

        $role_id  = $this->input->post('role_id');
        $class_id = $this->input->post('class_id');
        $user_id  = $this->input->post('user_id');
        $message  = $this->input->post('message');

        

         $users    = array();
         if ($role_id == PARENTT) {
            // print_r($this->input->post());die;
            $users = $this->ajax->get_parent_by_class($class_id);
       } elseif ($role_id == STUDENT) {
            if ($class_id) {
                $users = $this->ajax->get_student_list($class_id);
            } 
         } else {
            $this->db->select('E.*');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->where('U.role_id', $role_id);
            $users = $this->db->get()->result();
        }

        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (!$message) {
            $str .= '<option value="0">' . $this->lang->line('all') . '</option>';
        }

        $select = 'selected="selected"';

        if (!empty($users)) {
            foreach ($users as $obj) {
                if($role_id == STUDENT){
                $selected = $user_id == $obj->student_id ? $select : '';
                $str .= '<option value="' . $obj->student_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->student_code . ')</option>';
                }elseif($role_id == PARENTT){
                $selected = $user_id == $obj->parent_id ? $select : '';
                $str .= '<option value="' . $obj->parent_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->student_name . ')</option>';
                }
                else{
                   $selected = $user_id == $obj->user_id ? $select : '';
                   $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->id . ')</option>';  
                }
            }
        }

        echo $str;
    }



     /**     * *************Function get_section_by_class**********************************
     * @type            : Function
     * @function name   : get_section_by_class
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_class_by_section_name() {

        $class_id  = $this->input->post('class_id');
        //$section_id = $this->input->post('section_id');
        $sections   = $this->ajax->get_list('section', array('class_id' => $class_id,'sub_teacher_status' => 0), '', '', '', 'section_id', 'ASC');
        $str        = '<option value="">--'.get_phrase('select').'--</option>';
        
        $select     = 'selected="selected"';
        
        if (!empty($sections)) {
            foreach ($sections as $obj) {
             /*   $selected = $class_id == $obj->section_id ? $select : '';*/
                $str .= '<option value="' . $obj->name . '" >' . $obj->name . '</option>';
            }
        }
        echo $str;
    }

    function get_student_hostel_details(){
     
        $page_data['hostel_data']= $this->crud_model->get_hostel_data($this->input->post('student_id'));
        $this->load->view('backend/parent/student_hostel_details' , $page_data);
    }

    function get_transportroute(){
        $route_id   = $this->input->post('route_id');
        //$section_id = $this->input->post('section_id');
        $route_stops= $this->db->get_where('route_stops', array('route_id' => $route_id))->result();
        $str        = '<option value="">--'.get_phrase('select').'--</option>';
        $select     = 'selected="selected"';
        
        if (!empty($route_stops)) {
            foreach ($route_stops as $obj) {
             /*$selected = $class_id == $obj->section_id ? $select : '';*/
             $str .= '<option value="' . $obj->id . '" >'. $obj->stop_name . '</option>';
            }
        }
        echo $str;
    }

    function  get_subject_by_teacher(){
        $teacher_id    = $this->input->post('teacher_id');
        //$section_id = $this->input->post('section_id');
        $route_stops = $this->db->get_where('subject', array('teacher_id' => $teacher_id))->result();
        $str         = '<option value="">--'.get_phrase('select').'--</option>';
        $select      = 'selected="selected"';
        
        if (!empty($route_stops)) {
            foreach ($route_stops as $obj) {
             $str .= '<option value="' . $obj->subject_id . '" >'. $obj->name . '</option>';
            }
        }
        echo $str; 
    }

    function fees_due(){
        $student_id  = $this->input->post('student_id');
        $invoices    = $this->db->get_where('invoices', array('student_id' => $student_id,'paid_status'=>'unpaid'))->result();
        if($invoices != ""){
           echo '1';
        }else{
            echo '0';    
        }
    }

    public function get_assignment_by_subjects(){
        
        $subject_id  = $this->input->post('subject_id');
        $section_id  = $this->input->post('section_id');
        $class_id    = $this->input->post('class_id');
        $assignments = $this->db->get_where('assignments',array('subject_id'=>$subject_id,'section_id'=>$section_id,'class_id'=>$class_id))->result();
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
            if (!empty($assignments)) {
            foreach ($assignments as $obj) {  
              $selected = $subject_id == $obj->id ? $select : '';
              $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title .'</option>';   
            }
        }
        echo $str;
    }

    public function get_section_by_subjects(){
        
        $class_id    = $this->input->post('class_id');
        $section_id  = $this->input->post('section_id');
       print_r($_POST);
       //$subjects = $this->ajax->get_list('subject', array('class_id' => $class_id,'section_id'=>$section_id), '', '', '', 'subject_id', 'ASC');

        $subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result();
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
       
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected  = $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->subject_id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }
        echo $str;
    }
    
    
    public function get_section_by_subjects_students(){
        
        $class_id    = $this->input->post('class_id');
        $section_id  = $this->input->post('section_id');
       //print_r($_POST);
       //$subjects = $this->ajax->get_list('subject', array('class_id' => $class_id,'section_id'=>$section_id), '', '', '', 'subject_id', 'ASC');

        $subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result();
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $etr = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
       
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected  = $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->subject_id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

                                $students   =   $this->db->get_where('enroll' , array(
                                    'class_id' => $class_id
                                ))->result_array();

                            
                                foreach($students as $row){
                                    $student_d = $this->db->get_where('student' , array(
                                    'student_id' => $row['student_id']
                                ))->row();
                                $selected  = $row['student_id'] ? $select : '';
                                $etr .= '<option value="' . $row['student_id'] . '" ' . $selected . '>' . $student_d->name . '</option>';
                                  
                                }
        echo $str.'~#~'.$etr;
    }
	
    public function get_subjectid_by_teacher(){
        $subject_id    = $this->input->post('subject_id');
        // $route_stops = $this->db->get_where('subject', array('subject_id' => $subject_id))->;
        
        $this->db->select('T.*');
        $this->db->from('assign_subject AS S');
        $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
        $this->db->where('S.subject_id',$subject_id );
        $route_stops = $this->db->get()->result();

        $str         = '<option value="">--'.get_phrase('select').'--</option>';
        $select      = 'selected="selected"';
        
        if (!empty($route_stops)) {
            foreach ($route_stops as $obj) {
             $str .= '<option value="' . $obj->teacher_id . '" >'. $obj->name . '</option>';
            }
        }
        echo $str; 
    }


    public function get_classroutine_subjectid_by_teacher(){
        $subject_id    = $this->input->post('subject_id');
        $start_time    = $this->input->post('timetable_time');
        $end_time      = $this->input->post('endtime_');
        $priode        = $this->input->post('period');
        $day           = $this->input->post('day_');
  
        $this->db->select('T.*');
        $this->db->from('assign_subject AS S');
        $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
        $this->db->where('S.subject_id',$subject_id );
        $teacher_f = $this->db->get()->result();

        $str         = '<option value="">--'.get_phrase('select').'--</option>';
        $select      = 'selected="selected"';
        
        if (!empty($teacher_f)) {
            foreach ($teacher_f as $obj) {
              $disabled = "";
             //$this->db->get_where('class_routine',array('period'=>$priode,'subject_id'=>$subject_id,'teacher_id'=>$obj->teacher_id,'day'=>$day,'template_id'=>));
                $class_routine = $this->db->query("select C.* from class_routine C,class_routine_template T where T.status = 1 AND C.day = '".$day."' AND C.teacher_id =".$obj->teacher_id." AND  C.time_start >='$start_time' AND C.time_end <='$end_time' ")->result();
                 if(count($class_routine) >0){
                    $disabled = "disabled";
                 }
                  $str .= '<option value="' . $obj->teacher_id . '" '.$disabled.'>'. $obj->name.'</option>';
            }
        }
        echo $str; 
    }

    
    function ajax_active_timetable_template($param=""){
       
        $this->db->update('class_routine_template',array('status'=>0));

        $this->db->where('id',$param);
        $this->db->update('class_routine_template',array('status'=>1));
        $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
        ///redirect(site_url('admin/timetable_template/'), 'refresh');
    }

    function get_class_by_subject(){

        $subject_id = $this->input->post('subject_id');
        $class_id   = $this->db->query("select * from subject where subject_id = $subject_id")->row()->class_id;
        if($class_id !=""){
        $class_val  = $this->db->query("select * from class where class_id IN ($class_id)")->result();
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
       
        if(!empty($class_val)) {
            foreach ($class_val as $obj) {
                $selected  = $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->class_id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
      }
    }

    function get_autogenrate_roll(){
        $section_id = $this->input->post('section_id');
        $class_id   = $this->input->post('class_id');
        
        $roll_no        = $this->db->order_by('enroll_id','DESC')->get_where('enroll',array('section_id'=>$section_id,'class_id'=>$class_id))->row()->roll;
        $school_perifix = $this->db->get_where('settings',array('type'=>'perifix_code'))->row()->description;
        $class_perifix  = $this->db->get_where('section',array('section_id'=>$section_id,'class_id'=>$class_id,'sub_teacher_status'=>0))->row()->perifix_code;

        if($roll_no == 0 && $roll_no != ""){
            $arr['roll_no'] = $select_roll =  0+1;
        }elseif($roll_no != ""){
            $arr['roll_no'] = $select_roll = $roll_no+1;
        }else{
            $arr['roll_no'] = 1;   
        }

        $arr['roll_no_perifix'] =  @$school_perifix.$class_perifix;
        echo json_encode($arr);
     }


     function get_edit_autogenrate_roll(){
        $section_id        = $this->input->post('section_id');
        $class_id          = $this->input->post('class_id');
        $edit_id           = $this->input->post('edit_id');
        $old_section_id    = $this->input->post('old_section_id');
        
        if($edit_id != "" && $section_id == $old_section_id){
          $roll_no        = $this->db->get_where('enroll',array('enroll_id'=>$edit_id))->row()->roll;
        }else{
           $roll_no        = $this->db->order_by('enroll_id','DESC')->get_where('enroll',array('section_id'=>$section_id,'class_id'=>$class_id))->row()->roll;
        }

        $school_perifix = $this->db->get_where('settings',array('type'=>'perifix_code'))->row()->description;
        $class_perifix  = $this->db->get_where('section',array('section_id'=>$section_id,'class_id'=>$class_id,'sub_teacher_status'=>0))->row()->perifix_code;
        
         if($roll_no != "" && $section_id == $old_section_id){
               $arr['roll_no'] = $roll_no;
            }elseif($roll_no != ""){
               $arr['roll_no'] = $select_roll = $roll_no+1;
         }else{
               $arr['roll_no']          = 1; 
         }

         $arr['roll_no_perifix'] =  @$school_perifix.$class_perifix;
         echo json_encode($arr);
      
    }

    function classAndSectionAutogenrateRoll($param = "" ,$param2=""){

        $school_perifix = $this->db->get_where('settings',array('type'=>'perifix_code'))->row()->description;
        $class_perifix  = $this->db->get_where('section',array('section_id'=>$param2,'class_id'=>$param,'sub_teacher_status'=>0))->row()->perifix_code;
        $enroll_data    = $this->db->order_by('enroll_id','ASC')->get_where('enroll',array('section_id'=>$param2,'class_id'=>$param))->result();
          $i = 1;
          foreach ($enroll_data as $key => $dt) {
            $this->db->where('enroll_id',$dt->enroll_id);
            $this->db->update('enroll',array('roll'=>$i));
            $i++;
          }
          echo 1;
    }
    
     public function get_subject_by_section() {

        $section_id    = $this->input->post('section_id');
       $subject_id = $this->input->post('subject_id');
        $subjects = $this->db->query("select * from subject where FIND_IN_SET($section_id,section_id) order by subject_id ASC")->result();
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
       
        $select = 'selected="selected"';
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected = $subject_id == $obj->subject_id ? $select : '';
                $str .= '<option value="' . $obj->subject_id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    

}
