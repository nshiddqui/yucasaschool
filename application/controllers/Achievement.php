<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Event.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Event
 * @description     : Manage school event for guardian, student, teacher and employee.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Achievement extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Achievement_Model', 'achievement', true);    
        $this->load->library('session');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  		
    }


    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Event List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);

        $this->data['achievements'] = $this->achievement->get_achievement_list();
        if($_GET['action']==='add'){
            $this->data['add'] = TRUE;
        }else{
            $this->data['list'] = TRUE;
        }
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Achievement';
		$this->data['folder'] = 'achievement';
        $this->layout->title($this->lang->line('manage_achievement') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    
    public function student_achievement($studentId = null){
        if($this->session->userdata('student_login') == 1){
            $this->data['student_id'] = $this->session->userdata('login_user_id');
            $this->data['achievements'] = $this->achievement->get_achievement_list_by_parent(null,$this->session->userdata('login_user_id'));
        } else {
            $this->data['student_id'] = $studentId;
            $this->data['achievements'] = $this->achievement->get_achievement_list_by_parent($this->session->userdata('login_user_id'),$studentId);
        }
        $this->data['page_name'] = 'student_achievement';
		$this->data['page_title'] = 'Achievement';
		$this->data['folder'] = 'achievement';
        $this->layout->title($this->lang->line('manage_achievement') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Event" user interface                 
    *                    and process to store "Event" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

       // check_permission(ADD);
         if ($_POST) {
            $this->_prepare_achievement_validation();
            if ($this->form_validation->run() === TRUE) {
                $data         = $this->_get_posted_achievement_data();
                $insert_id = $this->achievement->insert('achievements', $data);
			
		  
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('achievement');
                } else {
                  $this->session->set_flashdata('error_message' , get_phrase('data_insert_failed'));
                  redirect('achievement/add');
                }
            } else {
                //print_r(validation_errors());
                $this->data['post'] = $_POST;
            }
        }

        $this->data['achievements']     = $this->achievement->get_achievement_list();
        $this->data['add']        = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Achievement';
        $this->data['folder']     = 'achievement';
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function _prepare_achievement_validation**********************************
    * @type            : Function
    * @function name   : _prepare_achievement_validation
    * @description     : Process "event" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_achievement_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class_id'), 'trim|required');
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');
        $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required');
    }
    
    
    /*****************Function _get_posted_event_data**********************************
    * @type            : Function
    * @function name   : _get_posted_event_data
    * @description     : Prepare "event" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_achievement_data() {

        $items = array();
        $items[] = 'student_id';
        $items[] = 'class_id';
        $items[] = 'title';
        $items[] = 'description';
        $items[] = 'date';

        $data = elements($items, $_POST);
        $data['teacher_id'] = $this->session->userdata('teacher_id');

        return $data;
    }
    
    
    public function delete($id = null) {

        //check_permission(DELETE);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('achievement');
        }
        
        $event = $this->achievement->get_single('achievements', array('id' => $id));
        if ($this->achievement->delete('achievements', array('id' => $id))) {

             
            $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('achievement');
    }
    
    
}
