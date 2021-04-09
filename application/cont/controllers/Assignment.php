<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Assignment.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Classview
 * @class name      : Assignment
 * @description     : Manage student assignment by class teacher.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Assignment extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();

        $this->load->model('Assignment_Model', 'assignment', true);
        $this->load->model('Assignment_Individual_Model', 'assignment_individual', true);
        $this->load->model('Ajax_Model', 'ajax', true);
        $this->load->model('Type_Model', 'type', true);
        $this->load->library('session');
        $this->data['class'] = $this->type->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');
		$this->data['exam'] = $this->type->get_list('exam', array('cancel_status' => 0), '','', '', 'exam_id', 'ASC');
		
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

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Assignment List" user interface                 
    *                    with class wise listing    
    * @param           : $class_id integer value
    * @return          : null 
    * ********************************************************** */
    public function index($class_id = null,$filter="") {
       
        if(isset($class_id) && !is_numeric($class_id)){
            error($this->lang->line('unexpected_error'));
             redirect('assignment/index');
        }

        if ($this->session->userdata('role_id') == STUDENT) {
            $student_id = $this->session->userdata('profile_id');        
            $enroll_student = $this->assignment->get_single('enroll', array('student_id' => $student_id, 'year' => $this->academic_year_id));
            $class_id = $enroll_student->class_id;
        }

        $sections   = $this->ajax->get_list('section', array('class_id' => $class_id,'sub_teacher_status' => 0), '', '', '', 'section_id', 'ASC');
        $str = null;
        
        if (!empty($sections)) {
            foreach ($sections as $obj) {
             /*   $selected = $class_id == $obj->section_id ? $select : '';*/
                $str .= '<option value="' . $obj->section_id . '" >' . $obj->name . '</option>';
            }
        }
        
       

        $this->data['sections'] = $sections;
        $this->data['assignments']   = $this->assignment->get_assignment_list($class_id);
        $this->data['filter_assignments']="";$this->data['assigment_id']="";
        if($filter == 'filter'){
              // print_r($_POST);
              // echo $class_id.','.$this->input->post('section_id').','.$this->input->post('subject_id').','.$this->input->post('assigment_id');
           $this->data['filter_assignments'] = $this->assignment->get_student_by_class_and_section($class_id,$this->input->post('section_id')); 
             // print_r($this->data['filter_assignments']);
          $this->data['assigment_id']  = $this->input->post('assigment_id');
          $this->data['listview']  = TRUE;  

        }else{
           $this->data['list']     = TRUE;  
        }
        
        $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id']    = $class_id;
        $this->data['examss'] = $this->db->query("select * from exam where cancel_status='0'");
        $this->data['page_name']   = 'index';
        $this->data['page_title']  = 'Assignment List';
        $this->data['folder']      = 'assignment';
        $this->load->view('backend/page', $this->data);


    }

    public function add_assignment() {
    
       $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['page_name']   = 'add_assignment';
        $this->data['page_title']  = 'Add Assignment';
        $this->data['folder']      = 'assignment';
         
        $this->load->view('backend/page', $this->data);


    }
     public function view_assignment($param='') {
       if($param=='filter'){
          $subject_id  = $this->input->post('subject_id');
         $section_id  = $this->input->post('section_id');
         $class_id    = $this->input->post('class_id');
       $assigment_id   = $this->input->post('assigment_id');
         $this->data['filter_assignments'] = $this->assignment->get_student_by_class_and_section($class_id,$section_id);   
          $this->data['assigment_id'] =$assigment_id;
       }
         
         $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
         $this->data['page_name']   = 'view_assignment';
         $this->data['page_title']  = 'View Assigment List';
         $this->data['folder']      = 'assignment';
        
        $this->load->view('backend/page', $this->data);


    }
    
    
    
    public function add_indiv_assignment() {
    
       $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['page_name']   = 'add_indiv_assignment';
        $this->data['page_title']  = 'Add individual Assignment';
        $this->data['folder']      = 'assignment';
         
        $this->load->view('backend/page', $this->data);


    }
     public function view_indiv_assignment($param='') {
       if($param=='filter'){
          $subject_id  = $this->input->post('subject_id');
         $section_id  = $this->input->post('section_id');
         $class_id    = $this->input->post('class_id');
       $assigment_id   = $this->input->post('assigment_id');
       $student_id   = $this->input->post('student_id');
         $this->data['filter_assignments'] = $this->assignment_individual->get_assignments_by_class_and_section_student($class_id,$section_id,$student_id);   
          $this->data['assigment_id'] =$assigment_id;
       }else{
          $this->data['filter_assignments'] = array();
       }
         
         $this->data['classes']     = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
         $this->data['page_name']   = 'view_indiv_assignment';
         $this->data['page_title']  = 'View individual Assigment List';
         $this->data['folder']      = 'assignment';
        
        $this->load->view('backend/page', $this->data);


    }
    
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Asignment" user interface                 
    *                    and process to store "Assignment" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

     //check_permission(ADD);

        if ($_POST) {
            $this->_prepare_assignment_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_assignment_data();

                $insert_id = $this->assignment->insert('assignments', $data);
                if ($insert_id) {
                    
                    create_log('Has been created an assignment : '.$data['title']);   
                    
                    success($this->lang->line('insert_success'));
                    redirect('assignment/index/'.$data['class_id']);
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('assignment/add/'.$data['class_id']);
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        
        $class_id = $this->uri->segment(4);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }
        
        if ($this->session->userdata('role_id') == STUDENT) {
            $student_id = $this->session->userdata('profile_id');        
            $enroll_student = $this->assignment->get_single('enrollments', array('student_id' => $student_id, 'academic_year_id' => $this->academic_year_id));
            $class_id = $enroll_student->class_id;
        }

        $this->data['assignments'] = $this->assignment->get_assignment_list($class_id);
        $this->data['classes'] = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id'] = $class_id;
        
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Student assignment';
        $this->data['folder'] = 'assignment';	
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('assignment') . ' | ' . SMS);
        //$this->layout->view('assignment/index', $this->data);
		$this->load->view('backend/page', $this->data); 
    }


/*add individual student assignment*/

public function add_individual() {

     //check_permission(ADD);
//print_r($_POST);die;
        if ($_POST) {
            $this->_prepare_assignment_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_assignment_data();

                $insert_id = $this->assignment_individual->insert('assignments_individual', $data);
                //die;
                if ($insert_id) {
                    
                    create_log('Has been created an assignment : '.$data['title']);   
                    
                    success($this->lang->line('insert_success'));
                    redirect('assignment/view_indiv_assignment');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('assignment/add_indiv_individual');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        
        $class_id = $this->uri->segment(4);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }
        
        if ($this->session->userdata('role_id') == STUDENT) {
            $student_id = $this->session->userdata('profile_id');        
            $enroll_student = $this->assignment->get_single('enrollments', array('student_id' => $student_id, 'academic_year_id' => $this->academic_year_id));
            $class_id = $enroll_student->class_id;
        }

        $this->data['assignments'] = $this->assignment->get_assignment_list($class_id);
        $this->data['classes'] = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id'] = $class_id;
        
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Student assignment';
        $this->data['folder'] = 'assignment';	
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('assignment') . ' | ' . SMS);
        //$this->layout->view('assignment/index', $this->data);
		$this->load->view('backend/page', $this->data); 
    }
    
    /*add individual assignment end*/
    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Assignment" user interface                 
    *                    with populated "Assignment" value 
    *                    and process to update "Assignment" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

      

        if(!is_numeric($id)){
             $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
             redirect('assignment/index');
        }
        
        if ($_POST) {
            $this->_prepare_assignment_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_assignment_data();
                $updated = $this->assignment->update('assignments', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated an assignment : '.$data['title']);
                    
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('assignment/index/'.$data['class_id']);
                } else {
                    $this->session->set_flashdata('error_message' , get_phrase('data_update_failed'));
                    redirect('assignment/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['assignment'] = $this->assignment->get_single('assignments', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['assignment'] = $this->assignment->get_single('assignments', array('id' => $id));

            if (!$this->data['assignment']) {
                redirect('assignment/index');
            }
        }

        $class_id = $this->data['assignment']->class_id;
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        } 

        if ($this->session->userdata('role_id') == STUDENT) {
            $student_id = $this->session->userdata('profile_id');        
            $enroll_student = $this->assignment->get_single('enrollments', array('student_id' => $student_id, 'academic_year_id' => $this->academic_year_id));
            $class_id = $enroll_student->class_id;
        }
        
        $this->data['assignments'] = $this->assignment->get_assignment_list($class_id);
        $this->data['classes'] = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['class_id'] = $class_id;
        
        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'edit assignment';
        $this->data['folder'] = 'assignment';
        $this->load->view('backend/page', $this->data); 
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific assignment data                 
    *                       
    * @param           : $assignment_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($assignment_id = null) {

        check_permission(VIEW);

        if(!is_numeric($assignment_id)){
             error($this->lang->line('unexpected_error'));
             redirect('assignment/index');
        }
        
        $this->data['assignment'] = $this->assignment->get_single_assignment($assignment_id);
        $class_id = $this->data['assignment']->class_id;
        
        if ($this->session->userdata('role_id') == STUDENT) {
            $student_id = $this->session->userdata('profile_id');        
            $enroll_student = $this->assignment->get_single('enrollments', array('student_id' => $student_id, 'academic_year_id' => $this->academic_year_id));
            $class_id = $enroll_student->class_id;
        }
        
        $this->data['assignments'] = $this->assignment->get_assignment_list($class_id);
        $this->data['classes'] = $this->assignment->get_list('class', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['class_id'] = $class_id;
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('assignment') . ' | ' . SMS);
        $this->layout->view('assignment/index', $this->data);
    }
    
    
           
     /*****************Function get_single_assignment**********************************
     * @type            : Function
     * @function name   : get_single_assignment
     * @description     : "Load single assignment information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_assignment(){
        
       $assignment_id = $this->input->post('assignment_id');
       
        $this->data['assignment'] = $this->assignment->get_single_assignment($assignment_id);
        $this->load->view('get-single-assignment', $this->data);
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

        $this->form_validation->set_rules('title', $this->lang->line('assignment') . ' ' . $this->lang->line('title'), 'trim|required');
        
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        $this->form_validation->set_rules('subject_id', $this->lang->line('subject'), 'trim|required');
        $this->form_validation->set_rules('deadline', 'deadline', 'trim|required');
        $this->form_validation->set_rules('assignment_marks', 'assignment_mark', 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
        $this->form_validation->set_rules('assignment', $this->lang->line('assignment'), 'trim|callback_assignment');
    }

    
    
    /*****************Function assignment**********************************
    * @type            : Function
    * @function name   : assignment
    * @description     : Process/check assignment document validation                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function assignment() {

        if ($this->input->post('id')) {

            if ($_FILES['assignment']['name']) {
                $name = $_FILES['assignment']['name'];
                $arr = explode('.', $name);
                $ext = end($arr);
                if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'txt') {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('assignment', $this->lang->line('select_valid_file_format'));
                    return FALSE;
                }
            }
        } else {

            if ($_FILES['assignment']['name']) {                
           
                $name = $_FILES['assignment']['name'];
                $arr = explode('.', $name);
                $ext = end($arr);
                if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'txt') {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('assignment', $this->lang->line('select_valid_file_format'));
                    return FALSE;
                }
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

        $items = array();
        $items[] = 'class_id';
        $items[] = 'subject_id';
        //$items[] = 'section_id';
        $items[] = 'title';
        $items[] = 'note';
        $items[] = 'assignment_marks';

        $data = elements($items, $_POST);

        $sectionval = $this->input->post('section_id');
        $section_arr= array();
        foreach ($sectionval as $key => $dt) {
             $section_arr[] = $dt;
        }
        $section_implode =  implode(',', $section_arr);
        $data['section_id'] = $section_implode;

        $data['deadline'] = date('Y-m-d', strtotime($this->input->post('deadline')));
        $data['student_id'] = $this->input->post('student_id');

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['year'] = $this->year;
        }


        if ($_FILES['assignment']['name']) {
            $data['assignment'] = $this->_upload_assignment();
        }

        return $data;
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
        $return_assignment = '';

        if ($assignment != "") {
            if ($assignment_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    $assignment_type == 'application/msword' || $assignment_type == 'text/plain' ||
                    $assignment_type == 'application/vnd.ms-office' || $assignment_type == 'application/pdf') {

                $destination = 'assets/uploads/assignment/';

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

    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Assignment" from database                  
    *                    and unlink assignment document from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(VIEW);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             redirect('assignment/index');
        }
        
        $assignment = $this->assignment->get_single('assignments', array('id' => $id));
        if ($this->assignment->delete('assignments', array('id' => $id))) {

            // delete assignment assignment
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/assignment/' . $assignment->assignment)) {
                @unlink($destination . '/assignment/' . $assignment->assignment);
            }

            create_log('Has been deleted an assignment : '.$assignment->title);
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('assignment/index/' . $assignment->class_id);
    }

}
