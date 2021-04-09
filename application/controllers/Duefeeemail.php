<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Duefeeemail.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Duefeeemail
 * @description     : Manage email which are send to all type of system users.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Duefeeemail extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();

        $this->load->model('Duefeeemailsms_Model', 'mail', true);

        $this->data['emails']  = $this->mail->get_email_list();
        $this->data['classes'] = $this->mail->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['roles_details']   = $this->mail->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
		$this->load->library('session');
        $this->load->helper('array');

    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Sent Duefeeemail List" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);
        //$r = $this->mail->get_due_fee(5,1);
        // print_r($r);
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Due Fee Mail';
		$this->data['folder'] = 'mail';
        $this->layout->title($this->lang->line('manage_email') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data); 
    }

    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Send new Email" user interface                 
    *                    and process to send "Email"
    *                    and store email into database
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        //check_permission(ADD);
        if ($_POST) {
            $this->_prepare_email_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_email_data();

                $insert_id = $this->mail->insert('emails', $data);
                if ($insert_id) {
                    $data['email_id'] = $insert_id;
                    $this->_send_email($data);
                    //create_log('Has been sent a Due Fee Email : '.$data['subject']);

                    success($this->lang->line('insert_success'));
                    $this->session->set_flashdata('flash_message' , get_phrase('insert_success'));
                    redirect('duefeeemail/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('duefeeemail/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Due Fee Mail';
        $this->data['folder'] = 'mail';
        $this->layout->title($this->lang->line('send') . ' ' . $this->lang->line('email') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

        
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific email data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        //check_permission(VIEW);

        if ($id) {
            $this->data['email'] = $this->mail->get_single_email($id);

            if (!$this->data['email']) {
                redirect('duefeeemail/index');
            }
        }

        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Due Fee Mail';
        $this->data['folder'] = 'mail';
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('email') . ' | ' . SMS);
        $this->layout->view('backend/page', $this->data);
    }

    
    
    /*****************Function get_single_email**********************************
     * @type            : Function
     * @function name   : get_single_email
     * @description     : "Load single email information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_email(){
        
      echo  $email_id = $this->input->post('email_id');die;
       
       $this->data['email'] = $this->mail->get_single_email($email_id);
       echo $this->load->view('mail/get-single-email', $this->data);
    }
    
    /*****************Function _prepare_email_validation**********************************
    * @type            : Function
    * @function name   : _prepare_email_validation
    * @description     : Process "Email" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_email_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-attendance" style="color: red;">', '</div>');

        $this->form_validation->set_rules('role_id', $this->lang->line('receiver_type'), 'trim|required');
        if ($this->input->post('role_id') == STUDENT) {
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        }
        $this->form_validation->set_rules('receiver_id', $this->lang->line('receiver'), 'trim|required');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required');
        $this->form_validation->set_rules('body', $this->lang->line('email_body'), 'trim|required');
    }

       
    /*****************Function _get_posted_email_data**********************************
    * @type            : Function
    * @function name   : _get_posted_email_data
    * @description     : Prepare "Email" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_email_data() {

        $items = array();
        $items[] = 'role_id';
        $items[] = 'subject';
        $items[] = 'body';
        $data = elements($items, $_POST);
        
        $data['body'] = nl2br($data['body']);

        $data['year'] = $this->mail->running_year();
        $data['sender_role_id']   = $this->session->userdata('role_id');
        $data['status'] = 1;
        $data['email_type'] = 'duefee';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        return $data;
    }

          
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Email" data from database                  
    *                    and unlink attachmnet document form server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {
           //check_permission(DELETE);
        $mail = $this->mail->get_single('emails', array('id' => $id));
        if ($this->mail->delete('emails', array('id' => $id))) {
          // create_log('Has been deleted a Due Fee Email : '.$mail->subject);
          success($this->lang->line('delete_success'));
          $this->session->set_flashdata('flash_message' , get_phrase('delete_success'));
        } else {
          error($this->lang->line('delete_failed'));
        }
          redirect('duefeeemail/index');
    }

    
        
    /*****************Function _send_email**********************************
    * @type            : Function
    * @function name   : _send_email
    * @description     : Process to send email to the users                  
    *                    
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    private function _send_email($data) {
       
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $setting    = $this->mail->get_single('settings', array('status' => 1),'','settings_id');
        $from_email = $setting->email;
        $from_name  = $setting->school_name;
    
        $receivers  = '';       
        $users      = $this->mail->get_user_list($data['role_id'], $this->input->post('receiver_id'), $this->input->post('class_id'));

        
        foreach ($users as $obj) {
            
            // check is there due fee or not            
            $is_due = false;
            $due_amount = 0;
            $user_id = '';
            $receiver = '';
            
            if($data['role_id'] == STUDENT){                
                
                $due = $this->mail->get_due_fee($obj->student_id, $this->input->post('class_id'));
                if(!empty($due) && $due->due_amount > 0){
                    $is_due = TRUE;
                    $due_amount = 'Amount: '. $due->due_amount;
                }

                $user_id  = $obj->student_id;
                $receiver = $obj->name;
                
             }elseif($data['role_id'] == PARENTT){
                
                $parent = $this->mail->get_single('parent', array('parent_id' =>$obj->parent_id),'','parent_id'); 
                $due = $this->mail->get_due_fee($obj->student_id, $this->input->post('class_id'));
                if(!empty($due) && $due->due_amount > 0){
                    $is_due = TRUE;
                    $due_amount = 'Amount: '. $due->due_amount;
                }
               
                $user_id  = $parent->parent_id;
                $receiver = $parent->name;
            }            
            
            // if($is_due){
               
            //    // echo  $user_id;
            //     $body = get_formatted_body($data['body'], $data['role_id'], $user_id);
              
            //     $body = str_replace('[due_amount]', $due_amount, $body);
                
            //     $receivers .= $receiver.',';

            //     $this->email->from($from_email, $from_name);
            //     $this->email->reply_to($from_email, $from_name);
              
            //     //$this->email->from('ankit.rke1@gmail.com', 'gaurav');
            //    // $this->email->reply_to('ankit.rke1@gmail.com', 'gaurav');  
            //     $this->email->to($obj->email);
            //     $this->email->to($obj->email);                
            //     $this->email->subject($data['subject']);
            //     $this->email->message($body);
            //     $this->email->send();

            // //print_r($body);die;
            // }            
        }

        // update emails table 
       
        $this->mail->update('emails', array('receivers' => $user_id), array('id' => $data['email_id']));
       
    }

}