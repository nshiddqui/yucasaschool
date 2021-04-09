<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Member.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Member
 * @description     : Manage hostel member from the student whose are resident in the hostel.  
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
        if(isset($_POST['class_id'])){
            $this->data['members'] = $this->member->get_hostel_member_list($is_hostel_member = 1);
            $this->data['non_members'] = $this->member->get_hostel_member_list($is_hostel_member = 0);
        }
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
    * @description     : Load "Hostel Hostel List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);
       
        $this->data['list']       = TRUE;
        $this->data['page_name']  = 'index';
		$this->data['page_title'] =  get_phrase('Members');
		$this->data['folder']     = 'member';
        $this->load->view('backend/page', $this->data);

    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Member" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        //check_permission(ADD);

        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('hostel') . ' ' . $this->lang->line('member') . ' | ' . SMS);
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Members';
		$this->data['folder'] = 'member';
        $this->load->view('backend/page', $this->data);
    }

    
        
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Student" data from hostel member list                   
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);
		$member = $this->member->get_single('hostel_members', array('id' => $id));
        if ($this->member->delete('hostel_members', array('id' => $id))) {

            $this->member->update('student', array('is_hostel_member' => 0), array('student_id' => $member->user_id));
            $student = $this->member->get_single('student', array('student_id' => $member->user_id),'','student_id');
            //create_log('Has been deleted a Hostel Member : '.$student->name);
            $this->session->set_flashdata('error_message', get_phrase('data_delete_success'));
         } else {
            $this->session->set_flashdata('error_message', get_phrase('data_delete_failed'));
            
        }
        redirect('member');
    }


    
    /*****************Function add_to_hostel**********************************
    * @type            : Function
    * @function name   : add_to_hostel
    * @description     : Add student to Hostel via ajax call from user interface                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function add_to_hostel() {

        $user_id = $this->input->post('user_id');
        $hostel_id = $this->input->post('hostel_id');
        $room_id = $this->input->post('room_id');
        $beds = $this->input->post('beds');

        if($beds == ''){
            $beds = 0;
        }

        if ($user_id) {

            $member = $this->member->get_single('hostel_members', array('user_id' => $user_id));
            if (empty($member)) {

                $data['user_id'] = $user_id;
                $data['custom_member_id'] = $this->member->get_custom_id('hostel_members', 'HM');
                $data['hostel_id']  = $hostel_id;
                $data['room_id']    = $room_id;
                $data['beds']    = $beds;
                $data['status']     = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();

                $insert_id = $this->member->insert('hostel_members', $data);
                $this->member->update('student', array('is_hostel_member' => 1), array('student_id' => $user_id));
                
                $member = $this->member->get_single('student', array('student_id' => $user_id),'','student_id');
                create_log('Has been added a Hostel Member : '.$member->name);
                echo TRUE;
            } else {
                echo FALSE;
            }
        } else {
            echo FALSE;
        }
    }
    
    
    /*****************Function add_to_hostel**********************************
    * @type            : Function
    * @function name   : add_to_hostel
    * @description     : Add student to Hostel via ajax call from user interface                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function add_to_hostel_staff() {

        $user_id = $this->input->post('user_id');
        $hostel_id = $this->input->post('hostel_id');
        $joining_date = date("Y-m-d", strtotime($this->input->post('joining_date')));
        $room_id = $this->input->post('room_id');
        $beds = $this->input->post('beds');
        $table = $this->input->post('table_name');
        $designation=$this->input->post('designation');
        //print_r($_POST);
        if($beds == ''){
            $beds = 0;
        }

        if ($user_id) {

            $member = $this->member->get_single('hostel_members_staff', array('user_id' => $user_id,'designation_id' => $designation));
            print_r($member);
            if (empty($member)) {

                $data['user_id'] = $user_id;
                $data['designation_id'] = $designation;
                $data['custom_member_id'] = $this->member->get_custom_id('hostel_members', 'HM');
                $data['hostel_id']  = $hostel_id;
                $data['room_id']    = $room_id;
                $data['joining_date'] = $joining_date;
                $data['beds']    = $beds;
                $data['status']     = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();
//print_r($data);
                $insert_id = $this->member->insert('hostel_members_staff', $data);
                if($table == 'transport_in'){
                    $this->member->update($table, array('is_hostel_member' => 1), array('transport_id' => $user_id));
                    $member = $this->member->get_single($table, array('transport_id' => $user_id),'','transport_id');
                }else{
                    $this->member->update($table, array('is_hostel_member' => 1), array($table.'_id' => $user_id));
                    echo $this->db->last_query();die;
                    $member = $this->member->get_single($table, array($table.'_id' => $user_id),'','transport_id');
                }
                //$this->member->update('student', array('is_hostel_member' => 1), array('student_id' => $user_id));
               // die;
                
                create_log('Has been added a Hostel Member : '.$member->name);
                echo TRUE;
            } else {
                echo FALSE;
            }
        } else {
            echo FALSE;
        }
    }
    
    

}
