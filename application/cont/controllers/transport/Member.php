<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Member.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Member
 * @description     : Manage transport member of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Member extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Member_Model', 'member', true);        
        $this->load->library('session');
        $this->load->helper('array');
		
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Transport Member List" user interface                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);
        
        $this->data['members'] = $this->member->get_transport_member_list($is_transport_member = 1);
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Members';
        $this->data['folder'] = 'transport/member';
        $this->layout->title($this->lang->line('transport') . ' ' . $this->lang->line('member') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Transport Member" user interface                 
    *                     
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

       // check_permission(ADD);

        $this->data['non_members'] = $this->member->get_transport_member_list($is_transport_member = 0);
        $this->data['routes'] = $this->member->get_list('routes', array('status' => 1));
        $this->data['add'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Members';
        $this->data['folder'] = 'transport/member';
        $this->layout->title($this->lang->line('transport') . ' ' . $this->lang->line('non_member') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

        
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Transport Member" data from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);

        if(!is_numeric($id)){
           $this->session->set_flashdata('error_message', $this->lang->line('unexpected_error'));
           redirect('transport/member/index');
        }
        
        $member = $this->member->get_single('transport_members', array('id' => $id));
        if ($this->member->delete('transport_members', array('id' => $id))) {

            $this->member->update('student', array('is_transport_member' => 0,'transport_id'=>0,'transport_stop'=>0), array('student_id' => $member->user_id));

            $student = $this->member->get_single('student', array('student_id' => $member->user_id),'','student_id');
            create_log('Has been deleted a Transport Member : '.$student->name);
            $this->session->set_flashdata('flash_message', get_phrase('data_delete_successfully'));
            
        } else {
            $this->session->set_flashdata('error_message', get_phrase('delete_failed'));
           
        }
        redirect('transport/member/index');
    }


   
    /*****************Function add_to_transport**********************************
    * @type            : Function
    * @function name   : add_to_transport
    * @description     : Process to save Transport member info into database                  
    *                       
    * @param           : null
    * @return          : boolean true/flase 
    * ********************************************************** */
    public function add_to_transport() {

        $user_id = $this->input->post('user_id');
        $route_id= $this->input->post('route_id');
        $stop_id = $this->input->post('stop_id');
        
        if ($user_id) {
            $member = $this->member->get_single('transport_members', array('user_id' => $user_id));
            if (empty($member)) {
                $data['user_id'] = $user_id;
                $data['route_id'] = $route_id;
                $data['route_stop_id'] = $stop_id;
                $data['status'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();

                $insert_id = $this->member->insert('transport_members', $data);
                $this->member->update('student', array('is_transport_member' => 1,'transport_id'=>$route_id,'transport_stop'=>$stop_id), array('student_id' => $user_id));
                
                $student = $this->member->get_single('student', array('student_id' => $member->user_id),'','student_id');
                create_log('Has been added a Transport Member : '.$student->name);
            
                echo TRUE;
            } else {
                echo FALSE;
            }
        } else {
            echo FALSE;
        }
    }

}
