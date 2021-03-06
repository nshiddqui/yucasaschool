<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Password.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Password
 * @description     : Reset users password by System administrator.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Password extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Administrator_Model', 'administrator', true);
         $this->data['roles'] = $this->administrator->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
         $this->data['years'] = $this->administrator->get_list('academic_years', array('status' => 1), '','', '', 'id', 'ASC');

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
    * @description     : Load reset password user interface                 
    *                    and reset user password processing    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */ 
   public function index() {

       //check_permission(EDIT);
       
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
            $this->form_validation->set_rules('role_id', $this->lang->line('user'). ' ' .$this->lang->line('type'), 'trim|required');
            if($this->input->post('role_id') == STUDENT){
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');  
            }
            $this->form_validation->set_rules('user_id', $this->lang->line('user'), 'trim|required');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('conf_password', $this->lang->line('password').' '.$this->lang->line('confirm'), 'trim|required|matches[password]');
            
             if ($this->form_validation->run() === TRUE) {
                $data['password']      = md5($this->input->post('password'));
                $data['temp_password'] = base64_encode($this->input->post('password'));
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = logged_in_user_id();
                $this->administrator->update('users', $data, array('id'=> $this->input->post('user_id')));
                success($this->lang->line('update_success'));
                
                $user = $this->administrator->get_single('users', array('id' => $this->input->post('user_id')));
                create_log('Has been updated password for user : '. $user->email);
                
                redirect('administrator/password');
             }
        }
        
        $this->data['classes'] = $this->administrator->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');

        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Password';
        $this->data['folder'] = 'administrator/password';
        $this->layout->title($this->lang->line('reset_user_password'). ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    
}
