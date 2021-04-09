<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************User.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : User
 * @description     : Manage all type of systm users like student, employee, guardian and teacher.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class User extends MY_Controller {

   public function __construct() {
        parent::__construct();
                
        $this->load->model('Administrator_Model', 'administrator', true);
        $this->data['roles'] = $this->administrator->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
        $this->data['classes'] = $this->administrator->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');

        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public $data = array();

   

    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load user filtering interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index(){
        
        
        //check_permission(VIEW);
        
        $this->data['users'] = '';
        
         if ($_POST) {
             
            $role_id  = $this->input->post('role_id');
            $class_id = $this->input->post('class_id');
            $user_id  = $this->input->post('user_id');  
            $this->data['users'] = $this->administrator->get_user_list($role_id, $class_id, $user_id);
            $this->data['role_id'] = $role_id;
            $this->data['class_id'] = $class_id;
            $this->data['user_id'] = $user_id;
         }
         
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'user';
        $this->data['folder'] = 'administrator/user';
        $this->layout->title($this->lang->line('manage_user'). ' | ' . SMS);
        $this->load->view('backend/page', $this->data); 
    }

}
