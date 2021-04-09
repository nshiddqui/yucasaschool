<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Invoice.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Invoice
 * @description     : Manage invoice for all type of student payment.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Invoice extends MY_Controller {

    public $data = array();    
     function __construct() {
        parent::__construct();
        $this->load->model('Invoice_Model', 'invoice', true);
        $this->load->model('Payment_Model', 'payment', true);
		$this->theme = $this->frontend_model->get_frontend_general_settings('theme');
		$this->load->library('session');
        /*cache control*/
		/*$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");*/
     }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        if(isset($_POST['class_id'])){
            $this->data['class'] = $_POST['class_id']; 
        }
        if(isset($_POST['month'])){
            $this->data['month'] = $_POST['month']; 
        }
       // check_permission(VIEW);
        
        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
		//print_r($this->data['classes']);die();
        $this->data['income_heads'] = $this->invoice->get_fee_type(); 
        // $this->data['invoices']     = $this->invoice->get_invoice_list(null, $_POST['class_id'], $_POST['month'],$_POST['sessional_year'],$_POST['section_id']);
        if(!empty($_POST['class_id']) && !empty($_POST['section_id'])) {
            $this->data['invoices']     = $this->invoice->get_invoice_list(null, $_POST['class_id'], $_POST['month'],$_POST['sessional_year'],$_POST['section_id']);
        } else {
            $this->data['invoices'] = array();
        }
        $this->data['page_name']    = 'index';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'invoice';
		$this->data['unpaid']         = FALSE;
        $this->data['list']         = TRUE;
        $this->layout->title('SMS');
        $this->load->view('backend/page', $this->data); 
		 
		 
		 
       // $this->data['list'] = TRUE;
       // $this->layout->title($this->lang->line('manage_invoice'). ' | ' . SMS);
        //$this->layout->view('invoice/index', $this->data); 
    }
    public function invoice_unpaid() {
        if(isset($_POST['class_id'])){
            $this->data['class'] = $_POST['class_id'];
        }
        if(isset($_POST['month'])){
            $this->data['month'] = $_POST['month']; 
        }
       // check_permission(VIEW);
        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
		//print_r($this->data['classes']);die();
        $this->data['income_heads'] = $this->invoice->get_fee_type();  
        // $this->data['invoices']     = $this->invoice->get_invoice_list(null, $_POST['class_id'], $_POST['month']);
        if(!empty($_POST['class_id']) && !empty($_POST['section_id'])) {
            $this->data['invoices']     = $this->invoice->get_invoice_list(null, $_POST['class_id'], $_POST['month'],$_POST['sessional_year'],$_POST['section_id']);
        } else {
            $this->data['invoices'] = array();
        }
        $this->data['page_name']    = 'index';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'invoice';
        $this->data['list']         = TRUE;
        $this->data['unpaid']         = TRUE;
        $this->layout->title('SMS');
        $this->load->view('backend/page', $this->data); 
		 
		 
		 
       // $this->data['list'] = TRUE;
       // $this->layout->title($this->lang->line('manage_invoice'). ' | ' . SMS);
        //$this->layout->view('invoice/index', $this->data); 
    }
    
    
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific invoice data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {
        
        //check_permission(VIEW);
        
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('invoice');
        }
        
        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');        
        $this->data['income_heads'] = $this->invoice->get_fee_type(); 
        $this->data['invoices'] = $this->invoice->get_invoice_list();  
        $this->data['settings'] = $this->invoice->get_setting_data('settings', array('status'=>1));
        /*echo "<pre>";
         print_r($this->data['invoices']);
        echo "</pre>";*/
        $invoice                = $this->payment->get_invoice_amount($id);
        
        $this->data['paid_amount'] = $invoice->paid_amount;
        $this->data['invoice']   = $this->invoice->get_single_invoice($id);        
        $this->data['list'] = TRUE;
        $this->data['page_name'] = 'view';
        $this->data['page_title']= 'Invoice';
        $this->data['folder']    = 'invoice';

        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->load->view('backend/page', $this->data);            
       
    }
    
    
     /*****************Function due**********************************
    * @type            : Function
    * @function name   : due
    * @description     : Load "Due Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function due() {    
        
       // check_permission(VIEW);
        $this->data['invoices']   = $this->invoice->get_invoice_list(true);  
        $this->data['list']       = TRUE;
        $this->layout->title($this->lang->line('due_invoice'). ' | ' . SMS);
        $this->data['page_name']  = 'due';
		$this->data['page_title'] = 'Invoice';
		$this->data['folder']     = 'invoice';
        $this->layout->title('SMS');
        $this->load->view('backend/page', $this->data);           
       
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Create new Invoice" user interface                 
    *                    and store "Invoice" data into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {
//print_r($_POST);die;
        // check_permission(ADD);
        if ($_POST) {
            
            //echo validation_errors();die;
            $this->_prepare_invoice_validation();
            //var_dump($this->form_validation->run());die;
            if ($this->form_validation->run() === TRUE) {
                $_POST['amount'] = $_POST['total_fee'];
                $data      = $this->_get_posted_invoice_data();
                $data['invoice_type']='student';
                //print_r($data);die;
                $insert_id = $this->invoice->insert('invoices', $data);
                //echo $this->db->last_query();die;
                if ($insert_id) { 
                    // save transction table data
                    $data['invoice_id'] = $insert_id;
                    $this->_save_transaction($data);
                    //create_log('Has been created a invoice : '. $data['net_amount']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    if(isset($_POST['print']) && $_POST['print'] == '1'){
                        redirect('invoice/view/'.$insert_id);
                    } else {
                        redirect('invoice');
                    }
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('invoice/add');
                }
            } else {
                $this->data['post'] = $_POST;
                //print_r(validation_errors());
            }
        }
         $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC'); 
        $this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Invoice';
		$this->data['folder']     = 'invoice';
		$this->data['income_heads'] = $this->invoice->get_fee_type();         
        if(!empty($_POST['class_id']) && !empty($_POST['section_id'])) {
            $this->data['invoices']     = $this->invoice->get_invoice_list(null, $_POST['class_id'], $_POST['month'],$_POST['sessional_year'],$_POST['section_id']);
        } else {
            $this->data['invoices'] = array();
        }
		$this->data['unpaid']         = FALSE;
        $this->layout->title('SMS');
		$this->data['single']     = TRUE;
        $this->load->view('backend/page', $this->data); 
    }

        
    /*****************Function bulk**********************************
    * @type            : Function
    * @function name   : bulk
    * @description     : Load "Create new bulk Invoice" user interface                 
    *                    and store "Invoice" data into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function bulk() {

        //check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_invoice_validation();           
            if ($this->form_validation->run() === TRUE) {
               
                $status = $this->_get_create_bulk_invoice();
				
                if ($status) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('invoice');
                    
                } else {                  
                   $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('invoice/bulk');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');       
        $this->data['income_heads'] = $this->invoice->get_fee_type(); 
        $this->data['invoices']     = $this->invoice->get_invoice_list();  
        $this->data['bulk']         = TRUE;
        $this->data['page_name']    = 'index';
        $this->data['page_title']   = 'Invoice';
        $this->data['folder']       = 'invoice';
        $this->load->view('backend/page', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Invoice" user interface                 
    *                    with populated "Invoice" value 
    *                    and update "Invoice" database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {       
       
        //check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/invoice');
        }
        
        if ($_POST) {
            $this->_prepare_invoice_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_invoice_data();
                $updated = $this->invoice->update('invoices', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    //create_log('Has been updated a invoice : '. $data['net_amount']);
                    
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('accounting/invoice');                   
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('accounting/invoice/edit/' . $this->input->post('id'));
                }
            } else {
                 $this->data['invoice'] = $this->invoice->get_single('invoices', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['invoice'] = $this->invoice->get_single('invoices', array('id' => $id));

            if (!$this->data['invoice']) {
                 redirect('accounting/invoice/index');
            }
        }
        
        $this->data['classes'] = $this->invoice->get_list('classes', array('status'=> 1), '', '', '', 'id', 'ASC');       
        $this->data['income_heads'] = $this->invoice->get_fee_type();        
        $this->data['invoices'] = $this->invoice->get_invoice_list();  

        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);
    }

    
    /*****************Function _prepare_invoice_validation**********************************
    * @type            : Function
    * @function name   : _prepare_invoice_validation
    * @description     : Process "Invoice" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_invoice_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required'); 
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required'); 
        $this->form_validation->set_rules('paid_status', $this->lang->line('paid').' '.$this->lang->line('status'), 'trim|required'); 
        
        if($this->input->post('type')== 'single'){
            $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required'); 
        }

        // $this->form_validation->set_rules('is_applicable_discount', $this->lang->line('is_applicable_discount'), 'trim|required');   
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required');   
        //$this->form_validation->set_rules('income_head_id', $this->lang->line('fee_type'),'required', array('required' => $this->lang->line('check_at_least_one')));
              
    }


    
    /*****************Function _get_posted_invoice_data**********************************
     * @type            : Function
     * @function name   : _get_posted_invoice_data
     * @description     : Prepare "Invoice" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_invoice_data() {

        $items = array();
        $items[] = 'income_head_id';
        $items[] = 'class_id';
        $items[] = 'student_id';
        // $items[] = 'section_id';
        // $items[] = 'is_applicable_discount';  
        $items[] = 'month';        
        $items[] = 'paid_status';        
        $items[] = 'note';
        $items[] = 'admission_fee';
        $items[] = 'tution_fee';
        $items[] = 'book_fee';
        $items[] = 'dress_fee';  
        $items[] = 'education_fee';        
        $items[] = 'event_fee';   
        $items[] = 'total_fee';
        $items[] = 'hostel_fee';
        
        $data = elements($items, $_POST); 
        $income_head = $this->invoice->get_single('income_heads', array('id' => $this->input->post('income_head_id')));
        $data['discount']     = $this->input->post('discount')?:0;
        $data['gross_amount'] = $this->input->post('amount') + $this->input->post('discount');
        $data['net_amount']   = $this->input->post('amount');
        
        // if($data['is_applicable_discount']){
        //     $discount = $this->invoice->get_student_discount($data['student_id']);
        //     if(!empty($discount)){
        //         $data['discount']   = $discount->amount/100*$data['gross_amount'];
        //         $data['net_amount'] = $data['gross_amount'] - $data['discount'];
        //     }
        // }
        
        $data['date'] = date('Y-m-d');
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['custom_invoice_id'] = $this->invoice->get_custom_id('invoices', 'INV');            
            $data['status']            = 1;
            $data['invoice_type']      = $income_head->head_type;
            $data['year']              = $this->invoice->running_year();
            $data['created_at']        = date('Y-m-d H:i:s');
            $data['created_by']        = logged_in_user_id();                       
        }        
        return $data;
    }

        /*****************Function _get_create_bulk_invoice**********************************
     * @type            : Function
     * @function name   : _get_create_bulk_invoice
     * @description     : Prepare "Invoice" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_create_bulk_invoice() {
        
        $items = array();
        $items[] = 'income_head_id';
        $items[] = 'class_id';       
        $items[] = 'is_applicable_discount';  
        $items[] = 'month'; 
        $items[] = 'paid_status';
        $items[] = 'note';
        
        $data = elements($items, $_POST); 
        
        $income_head = $this->invoice->get_single('income_heads', array('id' => $this->input->post('income_head_id')));
        
        $data['date'] = date('Y-m-d');            
        $data['discount'] = 0.00;
        $data['status'] = 1;
       
        foreach ($this->input->post('students') as $key=>$value){
        
            $data['student_id'] = $key;            
            $data['gross_amount'] = $value;
            $data['net_amount'] = $value;

            if($data['is_applicable_discount']){

                $discount = $this->invoice->get_student_discount($data['student_id']);
                if(!empty($discount)){
                    $data['discount']   = $discount->amount/100*$data['gross_amount'];
                    $data['net_amount'] = $data['gross_amount'] - $data['discount'];
                }
            }

            $data['custom_invoice_id'] = $this->invoice->get_custom_id('invoices', 'INV');
            
            $data['invoice_type'] = $income_head->head_type;
            $data['year']         = $this->invoice->running_year();
            $data['created_at']   = date('Y-m-d H:i:s');
            $data['created_by']   = logged_in_user_id(); 
			
        
           $insert_id = $this->invoice->insert('invoices', $data);
            
            // save transction table data
            $txn = array(); 
            $txn = $data;
            $txn['invoice_id'] = $insert_id;
            $this->_save_transaction($txn);
            
            create_log('Has been created a invoice : '. $data['net_amount']);
        }
        
        return TRUE;        
    }

    
    /***************** Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Invoice" from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    
    public function delete($id = null) {
        
       // check_permission(DELETE);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
             redirect('invoice');
        } 
        
        $invoice = $this->invoice->get_single('invoices', array('id' => $id));
                
        if ($this->invoice->delete('invoices', array('id' => $id))) { 
            
           // create_log('Has been deleted a invoice : '. $invoice->net_amount);
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        $refer = $_SERVER['HTTP_REFERER'];
          if(!empty($refer)){
              redirect($refer);
          } else {
            redirect('invoice');
          }
    }
    
    
    /*****************Function _save_transaction**********************************
     * @type            : Function
     * @function name   : _save_transaction
     * @description     : transaction data save/update into database 
     *                    while add/update income data into database                
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    private function _save_transaction($data){
        
        if($data['paid_status'] == 'paid'){
        
            $txn = array();
			
            $txn['amount'] = $data['net_amount'];  
            $txn['note'] = $data['note'];
            $txn['payment_date'] = $data['date'];
            $txn['payment_method'] = $this->input->post('payment_method');
            $links      = array();
            $arraybank = $this->input->post('bank_name');
            $arraycheck = $this->input->post('cheque_no');
          
            $txn['bank_name']   =  $arraybank;
            $txn['cheque_no']   =  $arraycheck;
            if ($this->input->post('id')) {

                $txn['modified_at'] = date('Y-m-d H:i:s');
                $txn['modified_by'] = logged_in_user_id();
                $this->invoice->update('transactions', $txn, array('invoice_id'=>$this->input->post('id')));

            } else {            

                $txn['invoice_id'] = $data['invoice_id'];
                $txn['status'] = 1;
                $txn['year'] = $data['year'];            
                $txn['created_at'] = $data['created_at'];
                $txn['created_by'] = $data['created_by'];
			//print_r($txn);
			
                $this->invoice->insert('transactions', $txn);
            }  
            
        }
    }
    
    
    
    /* AJAX*/
    
    public function get_fee_amount(){
        
        $class_id       = $this->input->post('class_id');       
        $student_id     = $this->input->post('student_id'); 
        $income_head_id = $this->input->post('income_head_id');
        $income_head = $this->invoice->get_single('income_heads', array('id' => $income_head_id));
        
        $amount = 0.00;
        
        if($income_head->head_type == 'hostel'){
            
            $fee = $this->invoice->get_hostel_fee($student_id);            
            if(!empty($fee)){
                $amount = $fee->cost;
            }            
            
        }elseif($income_head->head_type == 'transport'){
            
            $fee = $this->invoice->get_transport_fee($student_id);            
            if(!empty($fee)){
                $amount = $fee->stop_fare;
            }
            
        }else{
            
            $fee = $this->invoice->get_single('fees_amount', array('class_id' => $class_id, 'income_head_id'=>$income_head_id));
            $amount = $fee->fee_amount;
        }
        
        echo $amount;
    }
    
    public function get_student_and_fee_amount(){
        
        $class_id       = $this->input->post('class_id');       
        $income_head_id = $this->input->post('income_head_id');
        $income_head    = $this->invoice->get_single('income_heads', array('id' => $income_head_id));
        $amount         = 0.00;
        $students       = $this->invoice->get_student_list($class_id); 
        
        $str = '';
     // echo "<pre>";
     //   print_r($students);
      //  echo "</pre>";
	///	exit;
        if(!empty($students)){
            
            $fee = $this->invoice->get_single('fees_amount', array('class_id' => $class_id, 'income_head_id' => $income_head_id));
           
            foreach($students as $obj){
                // when fee is transport and hostel then need to check
                // that student is eligible for fee
                if($income_head->head_type == 'hostel' && $obj->is_hostel_member == 0){
                    continue;
                }elseif($income_head->head_type == 'transport' && $obj->is_transport_member == 0){
                    continue;
                }               
                 
                if($income_head->head_type == 'hostel'){
                    $fee = $this->invoice->get_hostel_fee($obj->id);
                    if (!empty($fee)) {
                        $amount = $fee->cost;
                    }
                } elseif ($income_head->head_type == 'transport') {

                    $fee = $this->invoice->get_transport_fee($obj->id);
                    if (!empty($fee)) {
                        $amount = $fee->stop_fare;
                    }
                } else {                    
                    $amount = $fee->fee_amount;
                }
                // making student string....
                $str .= '<div class="multi-check"><input type="checkbox" data-sname="'.$obj->name.'" name="students['.$obj->student_id.']" value="'.$amount.'" /> '.$obj->name.' ['.$amount.']</div>';
            }
        }
        
        echo $str;
    }
    
    public function paid_invoice($id){
        $refer = $_SERVER['HTTP_REFERER'];
        $this->db->where('id',$id);
         $this->db->update("invoices",array('paid_status'=>"paid",'modified_by'=>$user_id));
        if(!empty($refer)){
              redirect($refer);
          } else {
            redirect('invoice');
          }
    }
}
