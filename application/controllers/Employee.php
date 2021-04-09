<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Employee.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Employee
 * @description     : Manage employee information of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Employee extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Employee_Model', 'employee', true);   
        $this->load->library('session');
        $this->load->helper('array');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");		
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Employeet List" user interface                 
    *                      
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);
        
        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Employees';
        $this->data['folder'] = 'employee';
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);     

    }
     public function add_user($action ='') {

        //check_permission(VIEW);
        
        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Employees';
        $this->data['folder'] = 'employee';
        
        $this->data['list'] = FALSE;
        $this->data['action'] = $action;
        //$this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);     

    }
    
    public function staff() {

        //check_permission(VIEW);
        
        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name'] = 'index_staff';
		$this->data['page_title'] = 'Employees';
        $this->data['folder'] = 'employee';
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);     

    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Employee" user interface                 
    *                    and process to store "Empoyee" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {
        if ($_POST) {
            $this->_prepare_employee_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_employee_data();

                $insert_id = $this->employee->insert('employees', $data);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , $this->lang->line('insert_success'));
                    redirect('employee/index');
                } else {
                    $this->session->set_flashdata('error_message' , $this->lang->line('insert_failed'));
                    redirect('employee/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Employees';
        $this->data['folder'] = 'employee';

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);    
    }

    
    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Employee" user interface                 
    *                    with populate "Employee" value 
    *                    and process to update "Employee" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        //check_permission(EDIT);

        if ($_POST) {
            $this->_prepare_employee_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_employee_data();
                $updated = $this->employee->update('employees', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    if(!empty($this->input->post('password'))){
                        $this->db->update('designation_users',['password'=>$this->input->post('password')],['designation_users_id'=>$this->input->post('id')]);
                    }
                    if(!empty($this->input->post('designation_id'))){
                        $tableName = $this->db->get_where('designations',['id'=>$this->input->post('designation_id')])->row()->name;
                        if ($this->db->table_exists(lcfirst($tableName))){
                            $columnList = $this->db->list_fields(lcfirst($tableName));
                            $datatoInsert = elements($columnList, $_POST);
                            if(array_key_exists('birthday',$datatoInsert)){
                                $datatoInsert['birthday'] = $this->input->post('dob');
                            }
                            if(array_key_exists('sex',$datatoInsert)){
                                $datatoInsert['sex'] = $this->input->post('gender');
                            }
                            if(array_key_exists('address',$datatoInsert)){
                                $datatoInsert['address'] = $this->input->post('present_address');
                            }
                            if(array_key_exists('password',$datatoInsert)){
                                $datatoInsert['password'] = sha1($this->input->post('password'));
                            }
                            $primary_id = lcfirst($tableName)."_id";
                            if(!$this->db->update(lcfirst($tableName),array_filter($datatoInsert) , [$primary_id=>$this->input->post('id')])){
                                throw new Exception("Please try again later");
                            }
                        }
                        
                    }
                    //create_log('Has been updated a Employee : '.$data['name']);
                    $this->session->set_flashdata('flash_message' , $this->lang->line('update_success'));
                    redirect('employee/add_user/edit');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('employee/edit/' . $this->input->post('id'));
                }
            } else {                
                $this->data['employee'] = $this->employee->get_single_employee($this->input->post('id'));
            }
        } else {
            if ($id) {
                $this->data['employee'] = $this->employee->get_single_employee($id);
                $tableName = $this->db->get_where('designations',['id'=>$this->data['employee']->designation_id])->row()->name;
                $primary_id = lcfirst($tableName)."_id";
                if ($this->db->table_exists(lcfirst($tableName))){
                    $this->data['user'] = $this->db->get_where(lcfirst($tableName),[$primary_id => $this->data['employee']->id])->row();
                }

                if (!$this->data['employee']) {
                    redirect('employee/index');
                }
            }
        }

        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data'] = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
       
        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Employees';
        $this->data['folder'] = 'employee';
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

        
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Employee data                 
    *                       
    * @param           : $employee_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($employee_id = null) {

        //check_permission(VIEW);

        if(!is_numeric($employee_id)){
             error($this->lang->line('unexpected_error'));
             redirect('dashboard');  
        }
        
        $this->data['employees'] = $this->employee->get_employee_list();
        $this->data['roles_data']     = $this->employee->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['designations'] = $this->employee->get_list('designations', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['employee']  = $this->employee->get_single_employee($employee_id);
        $this->data['grades']    = $this->employee->get_list('salary_grades', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->data['detail']    = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title']= 'Employees';
        $this->data['folder']    = 'employee';
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('employee') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    
        
     /*****************Function get_single_employee**********************************
     * @type            : Function
     * @function name   : get_single_employee
     * @description     : "Load single employee information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_employee(){
        
       $employee_id = $this->input->post('employee_id');
       $this->data['employee'] = $this->employee->get_single_employee($employee_id);
      // print_r($this->data['employee']);
       echo $this->load->view('employee/get-single-employee', $this->data);
    }
    
    
    
    /*****************Function _prepare_employee_validation**********************************
    * @type            : Function
    * @function name   : _prepare_employee_validation
    * @description     : Process "Employee" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_employee_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        if (!$this->input->post('id')) {       
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
        }
        
        $this->form_validation->set_rules('designation_id', $this->lang->line('designation'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('father_name', 'father_name', 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('permanent_address', $this->lang->line('permanent') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required');
        $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim');
        $this->form_validation->set_rules('religion', $this->lang->line('religion'), 'trim');
        $this->form_validation->set_rules('dob', $this->lang->line('birth_date'), 'trim|required');
        $this->form_validation->set_rules('joining_date', $this->lang->line('join_date'), 'trim|required');
        $this->form_validation->set_rules('salary_grade_id', $this->lang->line('salary_grade'), 'trim|required');
        $this->form_validation->set_rules('facebook_url', $this->lang->line('facebook_url'), 'trim');
        $this->form_validation->set_rules('linkedin_url', $this->lang->line('linkedin_url'), 'trim');
        $this->form_validation->set_rules('google_plus_url', $this->lang->line('google_plus_url'), 'trim');
        $this->form_validation->set_rules('instagram_url', $this->lang->line('instagram_url'), 'trim');
        $this->form_validation->set_rules('pinterest_url', $this->lang->line('pinterest_url'), 'trim');
        $this->form_validation->set_rules('twitter_url', $this->lang->line('twitter_url'), 'trim');
        $this->form_validation->set_rules('youtube_url', $this->lang->line('youtube_url'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');
    }
   
    
                    
    /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Employee Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->employee->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->employee->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
        
   
    /*****************Function _get_posted_employee_data**********************************
    * @type            : Function
    * @function name   : _get_posted_employee_data
    * @description     : Prepare "Employee" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */ 
    private function _get_posted_employee_data() {

        $items = array();
        $items[] = 'designation_id';
        $items[] = 'national_id';
        $items[] = 'name';
        $items[] = 'phone';
        $items[] = 'present_address';
        $items[] = 'permanent_address';
        $items[] = 'gender';
        $items[] = 'father_name';
        $items[] = 'mother_name';
        $items[] = 'blood_group';
        $items[] = 'religion';
        $items[] = 'other_info';
        $items[] = 'salary_grade_id';
        
        $data = elements($items, $_POST);  
        
        switch($this->input->post('designation_id')){
            case "1":
                $_POST['role_id'] = '9';
                break;
            case "2":
                $_POST['role_id'] = '13';
                break;
            case "3":
                $_POST['role_id'] = '17';
                break;
            case "4":
                $_POST['role_id'] = '18';
                break;
            case "5":
                $_POST['role_id'] = '6';
                break;
            case "8":
                $_POST['role_id'] = '5';
                break;
            default:
                $_POST['role_id'] = $this->input->post('designation_id');
        }
        $data['salary_type'] = 'monthly';
        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['joining_date'] = date('Y-m-d', strtotime($this->input->post('joining_date')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status'] = 1;
             $data['year']      = $this->employee->running_year();
            // create user 
            $data['user_id'] = $this->employee->create_user();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }
        return $data;
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

                $destination = 'assets/uploads/employee-photo/';

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

           
    /*****************Function _upload_resume**********************************
    * @type            : Function
    * @function name   : _upload_resume
    * @description     : Process to upload employee resume into server                  
    *                     and return resume file name  
    * @param           : null
    * @return          : $return_resume string value 
    * ********************************************************** */ 
    private function _upload_resume() {
        
        $prev_resume = $this->input->post('prev_resume');
        $resume = $_FILES['resume']['name'];
        $resume_type = $_FILES['resume']['type'];
        $return_resume = '';

        if ($resume != "") {
            if ($resume_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    $resume_type == 'application/msword' || $resume_type == 'text/plain' ||
                    $resume_type == 'application/vnd.ms-office' || $resume_type == 'application/pdf') {

                $destination = 'assets/uploads/employee-resume/';

                $file_type = explode(".", $resume);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $resume_path = 'resume-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['resume']['tmp_name'], $destination . $resume_path);

                // need to unlink previous photo
                if ($prev_resume != "") {
                    if (file_exists($destination . $prev_resume)) {
                        @unlink($destination . $prev_resume);
                    }
                }

                $return_resume = $resume_path;
            }
        } else {
            $return_resume = $prev_resume;
        }

        return $return_resume;
    }

        
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Employee" data from database                  
    *                     and unlink employee photo and Resume from server  
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);

        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             redirect('employee/add_user/delete');       
        }
        
        $employee = $this->employee->get_single('employees', array('id' => $id));
        if (!empty($employee)) {
            $tableName = $this->db->get_where('designations',['id'=>$employee->designation_id])->row()->name;
            if ($this->db->table_exists(lcfirst($tableName))){
                $this->employee->delete(lcfirst($tableName), array(lcfirst($tableName).'_id' => $id));
            }
            // delete employee data
            $this->employee->delete('employees', array('id' => $id));
            // delete employee login data
            $this->employee->delete('users', array('id' => $employee->user_id));

            // delete employee resume and photo
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/employee-resume/' . $employee->resume)) {
                @unlink($destination . '/employee-resume/' . $employee->resume);
            }
            if (file_exists($destination . '/employee-photo/' . $employee->photo)) {
                @unlink($destination . '/employee-photo/' . $employee->photo);
            }            
            
            create_log('Has been deleted a Employee : '.$employee->name);
            $this->session->set_flashdata('flash_message' , $this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('employee/add_user/delete');
    }

}
