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

class Holiday extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Holiday_Model', 'holiday', true);    
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
    * @description     : Load "Holiday List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);

        $this->data['holiday'] = $this->holiday->get_holiday_list();
        if($_GET['action']==='add'){
            $this->data['add'] = TRUE;
        }else{
            $this->data['list'] = TRUE;
        }
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Holiday';
		$this->data['folder'] = 'holiday';
        $this->layout->title($this->lang->line('manage_holiday') . ' | ' . SMS);
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
            $this->_prepare_event_validation();
            if ($this->form_validation->run() === TRUE) {
                $data         = $this->_get_posted_event_data();
                $insert_id           = $this->holiday->insert('holiday_leave', $data);
				if ($insert_id) {
                    create_log('Has been creted an Event : '.$data['title']);   
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('holiday');
                } else {
                  $this->session->set_flashdata('error_message' , get_phrase('data_insert_failed'));
                  redirect('holiday/add');
                }
            } else {
                //print_r(validation_errors());
                $this->data['post'] = $_POST;
            }
        }

        $this->data['events']     = $this->holiday->get_holiday_list();
        $this->data['add']        = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Holiday';
        $this->data['folder']     = 'holiday';
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Event" user interface                 
    *                    with populated "Event" value 
    *                    and process to update "Event" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        //check_permission(EDIT);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('holiday');
        }
        if ($_POST) {
            $this->_prepare_event_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_event_data();
                $updated = $this->holiday->update('holiday_leave', $data, array('id' => $this->input->post('id')));
                if ($updated) {
                   create_log('Has been updated an Holiday : '.$data['title']);   
                   $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                   redirect('holiday');
                } else {
                   $this->session->set_flashdata('error_message' , get_phrase('data_update_failed'));
                   redirect('holiday/edit/' . $this->input->post('id'));
                }
            }else {
                $this->data['holiday'] = $this->holiday->get_single('holiday_leave', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['holiday'] = $this->holiday->get_single('holiday_leave', array('id' => $id));
            if (!$this->data['holiday']) {
                redirect('holiday');
            }
        }
        $this->data['edit']       = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Holiday';
        $this->data['folder'] = 'holiday';
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific event data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id) {

        //check_permission(VIEW);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('event/index');
        }
        
        $this->data['holiday'] = $this->holiday->get_single_event($id);
        $this->data['holidays'] = $this->holiday->get_event_list();
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('holiday') . ' | ' . SMS);
        $this->layout->view('event/index', $this->data);
    }
    
    
        
           
     /*****************Function get_single_event**********************************
     * @type            : Function
     * @function name   : get_single_event
     * @description     : "Load single event information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_event(){
        
       $event_id = $this->input->post('event_id');
       
       $this->data['event'] = $this->holiday->get_single_event($event_id);
       echo $this->load->view('get-single-event', $this->data);
    }

    
    /*****************Function _prepare_event_validation**********************************
    * @type            : Function
    * @function name   : _prepare_event_validation
    * @description     : Process "event" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_event_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|callback_title');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim');
    }

    
    /*****************Function title**********************************
    * @type            : Function
    * @function name   : title
    * @description     : Unique check for "event title" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function title() {
        if ($this->input->post('id') == '') {
            $event = $this->holiday->duplicate_check($this->input->post('title'), $this->input->post('date'));
            if ($event) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $event = $this->holiday->duplicate_check($this->input->post('title'), $this->input->post('date'), $this->input->post('id'));
            if ($event) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    
    

      
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "event" from database                  
    *                    and unlink event image from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('holiday');
        }
        
        if ($this->holiday->delete('holiday_leave', array('id' => $id))) {
 
            $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('holiday');
    }

 /*****************Function _get_posted_event_data**********************************
    * @type            : Function
    * @function name   : _get_posted_event_data
    * @description     : Prepare "event" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_event_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'date';

        $data = elements($items, $_POST);
       
        if ($this->input->post('id')) {
        } else {
            $data['status'] = 1;
        }
        return $data;
    }


}
