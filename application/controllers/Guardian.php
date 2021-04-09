<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Guardian.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Guardian
 * @description     : Manage guardian information.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Guardian extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Guardian_Model', 'guardian', true);

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
    * @description     : Load "Guardian List" user interface                 
    *                     
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
// 		 if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('teacher_login') == 1 || $this->session->userdata('role_id') == 13 || $this->session->userdata('role_id') == 17){
            
       //check_permission(VIEW);
        $this->data['guardians'] = $this->guardian->get_guardian_list();
        $this->data['rolesdata'] = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Guardian';
		$this->data['folder'] = 'guardian';
        $this->load->view('backend/page', $this->data);
    // }else{
    //             redirect(site_url('login'), 'refresh');
    //       }
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Guardian" user interface                 
    *                    and process to store "Guardian" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

      //  check_permission(ADD);
        
        if ($_POST) {
            $validationval = $this->_prepare_guardian_validation();
            if ($this->form_validation->run() === TRUE) {
                $dataval = $this->_get_posted_guardian_data();
                $insert_id = $this->guardian->insert('guardians', $dataval);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('guardian');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('guardian/add');
                }
            } else {
               $this->data['post'] = $_POST;
            }
        }

        $this->data['guardians']  = $this->guardian->get_guardian_list();
        $this->data['rolesdata']      = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Guardian';
        $this->data['folder']     = 'guardian';
        $this->data['add']        = TRUE;
        $this->load->view('backend/page', $this->data);
         
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Guardian" user interface                 
    *                    with populate "Guardian" value 
    *                    and process to update "Guardian" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = FALSE) {

        //check_permission(EDIT);

        if(!is_numeric($id)){
              $this->session->set_flashdata('error_message', get_phrase($this->lang->line('unexpected_error')));
              redirect('guardian');
        }
        
        if ($_POST) {
            $this->_prepare_guardian_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_guardian_data();
                $updated = $this->guardian->update('guardians', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    create_log('Has been updated a Guardian : '.$data['name']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('guardian');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('guardian/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['guardian'] = $this->guardian->get_single_guardian($this->input->post('id'));
            }
        }

        if ($id) {
            $this->data['guardian'] = $this->guardian->get_single_guardian($id);

            if (!$this->data['guardian']) {
                redirect('guardian/index');
            }
        }

        $this->data['guardians'] = $this->guardian->get_guardian_list();
        //$this->data['rolesdata'] = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Guardian';
        $this->data['folder'] = 'guardian';
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('guardian') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Guardian data                 
    *                       
    * @param           : $guardian_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($guardian_id = null) {

       // check_permission(VIEW);

        if(!is_numeric($guardian_id)){
             error($this->lang->line('unexpected_error'));
             redirect('guardian/index');
        }
        
        $this->data['guardians'] = $this->guardian->get_guardian_list();
        $this->data['rolesdata'] = $this->guardian->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
        
        $this->data['guardian'] = $this->guardian->get_single_guardian($guardian_id);
        
        
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('guardian') . ' | ' . SMS);
        $this->layout->view('guardian/index', $this->data);
    }
    
    
    /*****************Function get_single_guardian**********************************
     * @type            : Function
     * @function name   : get_single_guardian
     * @description     : "Load single guardian information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */

    public function get_single_guardian($guardian_id = FALSE){
        
       //$guardian_id = $this->input->post('guardian_id');
       
       $this->data['guardian'] = $this->guardian->get_single_guardian($guardian_id);
       $this->data['students'] = $this->guardian->get_student_list($guardian_id);
       $this->data['invoices'] = $this->guardian->get_invoice_list($guardian_id);  
       
       echo $this->load->view('get-single-guardian', $this->data);
    }
    
        
    /*****************Function _prepare_guardian_validation**********************************
    * @type            : Function
    * @function name   : _prepare_guardian_validation
    * @description     : Process "Guardian" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_guardian_validation() {

        //echo "validation";
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
       // if (!$this->input->post('id')) {
        //$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email');
           // $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
       // }
        $this->form_validation->set_rules('relation', $this->lang->line('relation'), 'trim|required');
        $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required');
        // $this->form_validation->set_rules('role_id', $this->lang->line('role'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('profession', $this->lang->line('profession'), 'trim');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        
        $this->form_validation->set_rules('relation', $this->lang->line('relation'), 'trim');
        $this->form_validation->set_rules('photo', $this->lang->line('photo'), 'trim');
        $this->form_validation->set_rules('doc_prev_photo', $this->lang->line('doc_prev_photo'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');


    }

                        
    /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Guardian Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
   /* public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->guardian->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', 'Email-Id is already_exist');
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->guardian->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', 'Email-Id is already_exist');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }*/
       
    /*****************Function _get_posted_guardian_data**********************************
    * @type            : Function
    * @function name   : _get_posted_guardian_data
    * @description     : Prepare "Guardian" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_guardian_data() {

        $items = array();

        $items[] = 'name';
       //$items[] = 'national_id';
        $items[] = 'phone';
        $items[] = 'profession';
        $items[] = 'present_address';
       // $items[] = 'permanent_address';
       // $items[] = 'religion';
        $items[] = 'other_info';
        $items[] = 'student_id';
        $items[] = 'relation';
       // $items[] = 'email';
        

        $data = elements($items, $_POST);
        // print_r($data);
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status']     = 1;
            $data['year']       = $this->guardian->running_year();
            // create user 
            //$data['user_id'] = $this->guardian->create_user_guardian();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }
        if ($_FILES['doc_photo']['name']) {
            $data['doc_photo'] = $this->_doc_upload_photo();
        }
       

        return $data;
    }

    
          
    /*****************Function _upload_photo**********************************
    * @type            : Function
    * @function name   : _upload_photo
    * @description     : Process to upload "Guardian" photo in the server                  
    *                    and return photo name    
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

                $destination = 'assets/uploads/guardian-photo/';

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
 

        private function _doc_upload_photo() {

        $prev_photo = $this->input->post('doc_prev_photo');
        $photo = $_FILES['doc_photo']['name'];
        $photo_type = $_FILES['doc_photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/guardian-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'doc-photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['doc_photo']['tmp_name'], $destination . $photo_path);

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
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Guardian" data from database                  
    *                    and unlink guardian photo from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             redirect('guardian/index');
        }
        
        $guardian = $this->guardian->get_single('guardians', array('id' => $id));
        if (!empty($guardian)) {

            // delete guardian data
            $this->guardian->delete('guardians', array('id' => $id));
            // delete guardian login data
            //$this->guardian->delete('users', array('id' => $guardian->user_id));

            // delete guardian resume and photo
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/guardian-photo/' . $guardian->photo)) {
                @unlink($destination . '/guardian-photo/' . $guardian->photo);
            }
            
           // create_log('Has been deleted a Guardian : '.$guardian->name);

            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
       redirect('guardian/index');
    }

    /*****************Function due**********************************
    * @type            : Function
    * @function name   : due
    * @description     : Load "Due Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function invoice() {    
        
        if(GUARDIAN != logged_in_role_id()){
             error($this->lang->line('unexpected_error'));
             redirect('dashboard');
        }
         
        $this->data['invoices'] = $this->guardian->get_invoice_list($this->session->userdata('profile_id'));  
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/invoice', $this->data);            
       
    }
}
