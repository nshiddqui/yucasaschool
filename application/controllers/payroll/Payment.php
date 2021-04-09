<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Payment.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Payment
 * @description     : Manage Employee and Teacher Salary.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Payment extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Payment_Model', 'payment', true);  
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
     * @description     : Load "Employee & Teacher Payment" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function index($user_id = null,$payment_to="") {
        
       // check_permission(VIEW);
        
        $this->data['users'] = '';
        
         if ($_POST){
         
            $payment_to = $this->input->post('payment_to');		
            $user_id    = $this->input->post('user_id'); 
            $this->data['payment_to']    = $payment_to;
            $this->data['user_id'] = $user_id;      

            if($payment_to == 'teacher'){
             $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $user_id),'','teacher_id');
            }elseif($payment_to == 'driver' || $payment_to=='warden' || $payment_to=='security-gaurd'){ 
             $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $user_id),'','designation_users_id');
            }elseif($payment_to == 'librarian'){
             $this->data['user'] = $this->payment->get_single('librarian', array('librarian_id' => $user_id),'','librarian_id');
            }elseif($payment_to == 'accountant'){
             $this->data['user'] = $this->payment->get_single('accountant', array('accountant_id' => $user_id),'','accountant_id');
            }         
               		
            $payement = $this->data['payment'] = $this->payment->get_single_payment_user($this->data['user']->role_id, $user_id); 

            $this->data['add']  = TRUE;            
            $this->data['payments'] = $this->payment->get_payment_list($user_id, $payment_to);

			
	
         }else{
            
            if($user_id){
              
                if($payment_to == 'teacher'){
                   $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $user_id),'','teacher_id');
                }elseif($payment_to == 'driver' || $payment_to=='warden' || $payment_to=='security-gaurd'){ 
                    $this->data['user'] = $this->payment->get_single('designation_users', array('designation_users_id' => $user_id),'','designation_users_id');
             // print_r($this->data['user']);
			  }elseif($payment_to == 'librarian'){
                    $this->data['user'] = $this->payment->get_single('librarian', array('librarian_id' => $user_id),'','librarian_id');
                }elseif($payment_to == 'accountant'){
                    $this->data['user'] = $this->payment->get_single('accountant', array('accountant_id' => $user_id),'','accountant_id');
                }    
              
                //$payment_to  = $this->data['user']->role_id == TEACHER ? 'teacher' : 'employee';

                $this->data['payment_to'] = $payment_to;
                $this->data['user_id']    = $user_id;
                $this->data['payment']    = $this->payment->get_single_payment_user($this->data['user']->role_id, $user_id); 
                $this->data['payments']   = $this->payment->get_payment_list($user_id, $payment_to);
				//print_r($this->data['payments']);
            }
            
            $this->data['list'] = TRUE;
			
        }
	
        $this->data['page_name'] = 'index';
		$this->data['page_title']= 'Payment History';
        $this->data['folder']    = 'payroll/payment';	
        $this->data['exp_heads'] = $this->payment->get_list('expenditure_heads', array('status'=> 1));
        //$this->layout->title( $this->lang->line('manage_payment'). ' | ' . SMS);
        $this->load->view('backend/page', $this->data);            
       
    }


    
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Payment" user interface                 
     *                    and store "Payment" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {
        if ($_POST) {
            $this->_prepare_payment_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_payment_data();
                $insert_id = $this->payment->insert('salary_payments', $data);
                $payment_to = $this->input->post('payment_to');
                if ($insert_id) {
                    if($payment_to == 'teacher'){
                     $user =   $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $data['user_id']),'','teacher_id');
				
                    }elseif($payment_to == 'driver' ||$payment_to == 'worden'){ 
                       $user =  $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $data['user_id']),'','designation_users_id');
                    }elseif($payment_to == 'librarian'){
                      $user = $this->payment->get_single('librarian', array('librarian_id' => $user_id),'','librarian_id');
                    }elseif($payment_to == 'accountant'){
                      $user = $this->payment->get_single('accountant', array('accountant_id' => $user_id),'','accountant_id');
                    }

                    create_log('Has been process a Payment and save for : '.$user->email);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('payroll/payment/index/'.$this->input->post('user_id').'/'.$payment_to);
                } else {
                     $this->session->set_flashdata('error_message' , get_phrase('data_insert_failed'));
                    redirect('payroll/payment/index/'.$this->input->post('user_id').'/'.$payment_to);
                }
            } else {
                
                $payment_to  = $this->input->post('payment_to');
                $user_id     = $this->input->post('user_id');
                $this->data['payment_to'] = $payment_to;
                $this->data['user_id']    = $user_id;

                if($payment_to == 'teacher'){
                 $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $user_id),'','teacher_id');
                }elseif($payment_to == 'driver' ||$payment_to == 'worden'){ 
                 $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $user_id),'','designation_users_id');
                }elseif($payment_to == 'librarian'){
                 $this->data['user']    = $this->payment->get_single('librarian', array('librarian_id' => $user_id),'','librarian_id');
                }elseif($payment_to == 'accountant'){
                 $this->data['user']    = $this->payment->get_single('accountant', array('accountant_id' => $user_id),'','accountant_id');
                } 

               // $this->data['user']    = $this->payment->get_single('users', array('id' => $user_id));        
                $this->data['payment'] = $this->payment->get_single_payment_user($this->data['user']->role_id, $user_id); 
                $this->data['exp_heads']= $this->payment->get_list('expenditure_heads', array('status'=> 1));
                $this->data['payments'] = $this->payment->get_payment_list($user_id, $payment_to);
                $this->data['post']     = $_POST;
            }
        }

        $this->data['exp_heads'] = $this->payment->get_list('expenditure_heads', array('status'=> 1));          
         
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Payment History';
        $this->data['folder'] = 'payroll/payment';
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('payment'). ' | ' . SMS);
        //$this->load->view('payment/index', $this->data);
		$this->load->view('backend/page', $this->data);   
    }

    
        
    /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Payment" user interface                 
     *                    with populated "Payment" value 
     *                    and update "Payment" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {  
        
       //check_permission(EDIT);
       
        
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('payroll/payment');
        }
        
        if ($_POST) {
           
            $this->_prepare_payment_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_payment_data();
                $payment_to = $this->input->post('payment_to');
                $updated = $this->payment->update('salary_payments', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                   if($payment_to == 'teacher'){
                     $user =   $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $data['user_id']),'','teacher_id');
                    }elseif($payment_to == 'employee'){ 
                       $user =  $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $data['user_id']),'','designation_users_id');
                    }elseif($payment_to == 'librarian'){ 
                       $user =  $this->data['user']    = $this->payment->get_single('librarian', array('librarian_id' => $data['user_id']),'','librarian_id');
                    }elseif($payment_to == 'accountant'){ 
                       $user =  $this->data['user']    = $this->payment->get_single('accountant', array('accountant_id' => $data['user_id']),'','accountant_id');
                    }
                    //$user = $this->payment->get_single('users', array('id' => $data['user_id'])); 

                    create_log('Has been process a Payment and Update for : '.$user->email);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('payroll/payment');                
                } else {
                   
                    $this->session->set_flashdata('error_message' , get_phrase('data_update_failed'));
                    redirect('payroll/payment/edit/' . $this->input->post('id'));
                }
            } else {
                
                  error($this->lang->line('unexpected_error'));
                  redirect('payroll/payment/edit/' . $this->input->post('id'));
            }
        }
        
        if ($id) {
            $this->data['edit_payment'] = $this->payment->get_single('salary_payments', array('id' => $id));

            if (!$this->data['edit_payment']) {
                 redirect('payroll/payment');
            }
            $payment_to = $this->data['edit_payment']->payment_to;
            if($this->data['edit_payment']->payment_to == 'teacher'){
              $user =   $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $this->data['edit_payment']->user_id),'','teacher_id');
              $userid = $user->teacher_id; 
            }elseif($this->data['edit_payment']->payment_to == 'employee'){ 
              $user =  $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $this->data['edit_payment']->user_id),'','designation_users_id');
              $userid = $user->designation_users_id;
            }
            elseif($this->data['edit_payment']->payment_to == 'librarian'){ 
              $user =  $this->data['user']    = $this->payment->get_single('librarian', array('librarian_id' => $this->data['edit_payment']->user_id),'','librarian_id');
              $userid = $user->librarian_id;
            }
            elseif($this->data['edit_payment']->payment_to == 'accountant'){ 
              $user =  $this->data['user']    = $this->payment->get_single('accountant', array('accountant_id' => $this->data['edit_payment']->user_id),'','accountant_id');
              $userid = $user->accountant_id;
            }

            //$user = $this->payment->get_single('users', array('id' => $this->data['edit_payment']->user_id));
            
            $salary_grade = $this->payment->get_single('salary_grades', array('id' => $this->data['edit_payment']->salary_grade_id));
            $this->data['expenditure'] = $this->payment->get_single('expenditures', array('id' => $this->data['edit_payment']->expenditure_id));
            $this->data['edit_payment']->grade_name = $salary_grade->grade_name;
            
            //$payment_to  = $user->role_id == TEACHER ? 'teacher' : 'employee';
            $this->data['payment_to'] = $payment_to;
            $this->data['user_id']    = $userid;
            
            $this->data['payment'] = $this->payment->get_single_payment_user($user->role_id, $userid); 
            $this->data['exp_heads'] = $this->payment->get_list('expenditure_heads', array('status'=> 1));
            $this->data['payments'] = $this->payment->get_payment_list($userid, $payment_to);
        }
       
        
        $this->data['edit'] = TRUE;
        $this->data['page_name'] = 'index';
        $this->data['page_title'] = 'Payment History';
        $this->data['folder'] = 'payroll/payment';       
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('payment'). ' | ' . SMS);
        //$this->load->view('payment/index', $this->data);
		$this->load->view('backend/page', $this->data); 
    }
    
    
     /*****************Function _prepare_payment_validation**********************************
     * @type            : Function
     * @function name   : _prepare_payment_validation
     * @description     : Process "payment" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
     function _prepare_payment_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('salary_type', $this->lang->line('salary_type'), 'trim|required');   
        $this->form_validation->set_rules('salary_month', $this->lang->line('month'), 'trim|required|callback_salary_month'); 
        $this->form_validation->set_rules('gross_salary', $this->lang->line('gross_salary'), 'trim|required'); 
        $this->form_validation->set_rules('net_salary', $this->lang->line('net_salary'), 'trim|required'); 
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
    
    
     /*****************Function salary_month**********************************
     * @type            : Function
     * @function name   : salary_month
     * @description     : Unique check for "Salary payment" data/value                  
     *                       
     * @param           : null
     * @return          : boolean true/false 
     * ********************************************************** */  
   public function salary_month()
   {             
      if($this->input->post('id') == '')
      {   

          $payment = $this->payment->duplicate_check($this->input->post('salary_month'), $this->input->post('user_id'),'',$this->input->post('payment_to')); 
          if($payment){
                $this->form_validation->set_message('salary_month',  $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $payment = $this->payment->duplicate_check($this->input->post('salary_month'), $this->input->post('user_id'), $this->input->post('id'),$this->input->post('payment_to')); 
          if($payment){
                $this->form_validation->set_message('salary_month', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }


     /*****************Function _get_posted_payment_data**********************************
     * @type            : Function
     * @function name   : _get_posted_payment_data
     * @description     : Prepare "payment" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_payment_data() {

        $items   = array();
        $items[] = 'user_id';
        $items[] = 'salary_grade_id';       
        $items[] = 'salary_type';
        $items[] = 'salary_month';
        //$items[] = 'payment_to';
        
        if( strtolower($this->input->post('salary_type')) == 'monthly'){
            
            $items[] = 'basic_salary';
            $items[] = 'house_rent';
            $items[] = 'transport';
            $items[] = 'medical';
            $items[] = 'over_time_hourly_rate';
            $items[] = 'over_time_total_hour';
            $items[] = 'over_time_amount';
            $items[] = 'provident_fund';
            
        }else{
            
            $items[] = 'hourly_rate';
            $items[] = 'total_hour';
        }
        
        
        $items[] = 'bonus';
        $items[] = 'penalty';
        $items[] = 'gross_salary';
        $items[] = 'total_allowance';
        $items[] = 'total_deduction';
        $items[] = 'net_salary';
        $items[] = 'payment_method';
        $items[] = 'payment_to';
        
        $items[] = 'bank_name';
        $items[] = 'cheque_no';
        
        $items[] = 'note';
        
        $data = elements($items, $_POST);  
        
        if($this->input->post('payment_method') == 'cash'){
            $data['bank_name'] = ''; 
            $data['cheque_no'] = ''; 
        }
      
        
        if ($this->input->post('id')) {
            
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            
            // Update data into Expenditure table
            $exp_data = array();
            $exp_data['amount'] = $data['net_salary'];
            $exp_data['expenditure_via'] = $data['payment_method'];
            $exp_data['note'] = $data['note'];
            $exp_data['modified_at'] = $data['modified_at'];
            $exp_data['modified_by'] = $data['modified_by'];
            $this->payment->update('expenditures', $exp_data, array('id' => $this->input->post('expenditure_id')));
            
        } else {
            
            $data['status'] = 1;
            $data['academic_year_id'] = $this->year;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 

            
            // Insert data into Expenditure table
            $exp_data = array();
            
            $exp_data['expenditure_head_id'] = $this->input->post('expenditure_head_id');
            $exp_data['status'] = 1;
            $exp_data['expenditure_type'] = 'salary';
            $exp_data['date'] = date('Y-m-d');
            $exp_data['amount'] = $data['net_salary'];
            $exp_data['expenditure_via'] = $data['payment_method'];
            $exp_data['note'] = $data['note'];
            $exp_data['academic_year_id'] = $data['academic_year_id'];
            $exp_data['created_at'] = $data['created_at'];
            $exp_data['created_by'] = $data['created_by'];
                    
            $data['expenditure_id'] = $this->payment->insert('expenditures', $exp_data);
        }

        return $data;
    }

    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Salary Payment and Expenditure amount as Salary" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        //check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('payroll/payment/index');
        }
        
        $payment = $this->payment->get_single('salary_payments', array('id' => $id));
        
        if ($this->payment->delete('salary_payments', array('id' => $id))) {

            $this->payment->delete('expenditures', array('id' => $payment->expenditure_id)); 
            
            //$user = $this->payment->get_single('users', array('id' => $payment->user_id));

             
            if($payment->payment_to == 'teacher'){
              $user =   $this->data['user']    = $this->payment->get_single('teacher', array('teacher_id' => $payment->user_id),'','teacher_id');
              $userid = $user->teacher_id; 
            }elseif($payment->payment_to == 'employee'){ 
              $user =  $this->data['user']    = $this->payment->get_single('designation_users', array('designation_users_id' => $payment->user_id),'','designation_users_id');
              $userid = $user->designation_users_id;
            }
            elseif($payment->payment_to == 'librarian'){ 
              $user =  $this->data['user']    = $this->payment->get_single('librarian', array('librarian_id' => $payment->user_id),'','librarian_id');
              $userid = $user->librarian_id;
            }
            elseif($payment->payment_to == 'accountant'){ 
              $user =  $this->data['user']    = $this->payment->get_single('accountant', array('accountant_id' => $payment->user_id),'','accountant_id');
              $userid = $user->accountant_id;
            } 

            create_log('Has been deleted a Payment for : '.$user->email);
                    
           $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
            
        } else {
            $this->session->set_flashdata('error_message' , get_phrase('data_delete_failed'));
        }
        redirect('payroll/payment/index/'.$payment->user_id.'/'.$payment->payment_to);
    } 
    
    
    
     /*****************Function get_single_payment**********************************
     * @type            : Function
     * @function name   : get_single_payment
     * @description     : "Load single salary payment information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_payment(){
        
       $payment_id = $this->input->post('payment_id');
       $payment_to = $this->input->post('payment_to');
       
       $this->data['payment'] = $this->payment->get_single_payment($payment_id, $payment_to);
       //echo $this->load->view('get-single-payment', $this->data);
	   $this->load->view('backend/page', $this->data);
    }
    
    
    /*****************Function history**********************************
     * @type            : Function
     * @function name   : history
     * @description     : Load "Employee & Teacher Payment History" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function history() {
        
        check_permission(VIEW);
        
        $this->data['users'] = '';
        
         if ($_POST) {
             
            $payment_to  = $this->input->post('payment_to');
            $user_id  = $this->input->post('user_id');
        
            $this->data['payment_to'] = $payment_to;
            $this->data['user_id'] = $user_id;
            
            $this->data['payments'] = $this->payment->get_payment_list($user_id, $payment_to);
            
         }
        
        $this->data['list'] = TRUE;       
        $this->layout->title( $this->lang->line('manage_payment'). ' | ' . SMS);
        $this->layout->view('payment/history', $this->data);            
       
    }

   
}
