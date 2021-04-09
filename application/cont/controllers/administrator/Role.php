<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Role.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Role
 * @description     : Manage system user role.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Role extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Role_Model', 'role', true);

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
    * @description     : Load "User Role List" user interface                 
    *                        
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index() {
        
        //check_permission(VIEW);
        
        $this->data['roles'] = $this->role->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
        
        $this->data['list'] = TRUE;

        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Role';
        $this->data['folder'] = 'administrator/role';
        $this->layout->title($this->lang->line('user_role'). ' | ' . SMS);
        $this->load->view('backend/page', $this->data);          
       
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Role" user interface                 
    *                    and store "Role" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {
        
        //check_permission(ADD);

        if ($_POST) {
            $this->_prepare_role_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_role_data();

                $insert_id = $this->role->insert('roles', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a user role : '.$data['name']);   
                    $this->session->set_flashdata('flash_message', get_phrase('data_insert_successfully'));
                    redirect('administrator/role');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('administrator/role/add');
                }
            } else {
                $this->data = $_POST;
            }
        }

        $this->data['roles'] = $this->role->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
        $this->data['add']   = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Role';
        $this->data['folder'] = 'administrator/role';
        $this->load->view('backend/page', $this->data);
    }

    
    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Role" user interface                 
    *                    with populated "Role" value 
    *                    and update "Role" database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) { 
        
        //check_permission(EDIT);

        if ($_POST) {
            $this->_prepare_role_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_role_data();
                $updated = $this->role->update('roles', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a user role : '.$data['name']);  
                    $this->session->set_flashdata('flash_message', get_phrase('data_update_successfully'));
                    redirect('administrator/role');                   
                } else {
                   $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                   redirect('administrator/role/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['roles'] = $this->role->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
                $this->data['role']  = $this->role->get_single('roles', array('id' => $this->input->post('id')));
            }
        } else {
            if ($id) {
                $this->data['role'] = $this->role->get_single('roles', array('id' => $id));

                if (!$this->data['role']) {
                     redirect('administrator/role');
                }
            }
        }

        $this->data['roles'] = $this->role->get_list('roles', array('status' => 1), '','', '', 'id', 'ASC');
        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Role';
        $this->data['folder'] = 'administrator/role';       
        $this->load->view('backend/page', $this->data);
    }


    /*****************Function _prepare_role_validation**********************************
    * @type            : Function
    * @function name   : _prepare_role_validation
    * @description     : Process "role" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_role_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('name', $this->lang->line('role').' '.$this->lang->line('name'), 'trim|required|callback_name');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

                
    /*****************Function name**********************************
    * @type            : Function
    * @function name   : name
    * @description     : Unique check for "Role Name" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function name() {
        if ($this->input->post('id') == '') {
            $role = $this->role->duplicate_check($this->input->post('name'));
            if ($role) {
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $role = $this->role->duplicate_check($this->input->post('name'), $this->input->post('id'));
            if ($role) {
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
    /*****************Function _get_posted_role_data**********************************
    * @type            : Function
    * @function name   : _get_posted_role_data
    * @description     : Prepare "Role" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */ 
    private function _get_posted_role_data() {

        $items = array();
        $items[] = 'name';
        $items[] = 'note';        
        $data = elements($items, $_POST);  
        $data['slug'] = get_slug($data['name']);
        
        if ($this->input->post('id')) {           
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['is_default'] = 0;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }

    
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Role" from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {
        
        
        check_permission(DELETE);
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('administrator/role');            
        }
        
        $role = $this->role->get_single('roles', array('id' => $id));
        
        if ($this->role->delete('roles', array('id' => $id))) { 
            create_log('Has been created a user role : '.$role->name);  
            $this->session->set_flashdata('flash_message' , get_phrase('delete_data_successfully'));
        } else {
            $this->session->set_flashdata('error_message' , get_phrase('delete_data_failed'));
        }
        redirect('administrator/role');
    }
    
    
}
