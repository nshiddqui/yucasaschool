<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Incomehead.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Incomehead
 * @description     : Manage all income type/head/title as per accounting term.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Feetype extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('Feetype_Model', 'feetype', true);
        $this->load->model('Discount_Model', 'discount', true);	
        $this->data['classes'] = $this->feetype->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');  
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
     * @description     : Load "Income Head List" user interface                 
     *                     
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index() {
        $this->data['feetypes'] = $this->feetype->get_fee_type();
        //$this->data['feetypes'] = $this->discount->get_list('income_heads', array('status'=> 1), '', '', '', 'id', 'DESC');  
     // echo   logged_in_user_id();die;
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder'] = 'fee_type';
        $this->layout->title('SMS');
        $this->load->view('backend/page', $this->data);
    }

    
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Income Head" user interface                 
     *                    and store "Income Head" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {
        //check_permission(ADD);
        if ($_POST) {
            $this->_prepare_feetype_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_feetype_data();
                $insert_id = $this->feetype->insert('income_heads', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a fee type : '. $data['title']);
                    $this->_save_fee_amount($insert_id);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('feetype/index');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('feetype/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['feetypes']   = $this->feetype->get_fee_type();  
        $this->data['add']        = TRUE;
		$this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder']     = 'fee_type';
        $this->load->view('backend/page', $this->data);
    }

    
     /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Income Head" user interface                 
     *                    with populated "Income Head" value 
     *                    and update "Income Head" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {       
       
       //check_permission(EDIT);
     if(!is_numeric($id)){
        $this->session->set_flashdata('error_message', get_phrase($this->lang->line('unexpected_error')));
        redirect('feetype');   
     }
        
        if ($_POST) {
            $this->_prepare_feetype_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_feetype_data();
                $updated = $this->feetype->update('income_heads', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    create_log('Has been updated a fee type : '. $data['title']);
                    $this->_save_fee_amount($this->input->post('id'));
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('feetype');                   
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('feetype/edit/' . $this->input->post('id'));
                }
            } else {
                    $this->data['feetype'] = $this->feetype->get_single('income_heads', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
                   $this->data['feetype'] = $this->feetype->get_single('income_heads', array('id' => $id));

            if (!$this->data['feetype']) {
                redirect('feetype');
            }
        }

        $this->data['feetypes']   = $this->feetype->get_fee_type();  
        $this->data['edit']       = TRUE;  
		$this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder']     = 'fee_type';
      
        $this->load->view('backend/page', $this->data);
    }

               
     /*****************Function get_single_feetype**********************************
     * @type            : Function
     * @function name   : get_single_feetype
     * @description     : "Load single assignment information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_feetype(){
       $feetype_id = $this->input->post('feetype_id');
       $this->data['feetype'] = $this->feetype->get_single('income_heads', array('id' => $feetype_id));
       echo $this->load->view('fee_type/get-single-feetype', $this->data);
    }
    
    
    /*****************Function _prepare_feetype_validation**********************************
     * @type            : Function
     * @function name   : _prepare_feetype_validation
     * @description     : Process "Incoem Head" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    private function _prepare_feetype_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('title', $this->lang->line('fee_type'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
    
    
    
        
    /*****************Function title**********************************
     * @type            : Function
     * @function name   : title
     * @description     : Unique check for "Income head title" data/value                  
     *                       
     * @param           : null
     * @return          : boolean true/false 
     * ********************************************************** */ 
   public function title()
   {             
      if($this->input->post('id') == '')
      {   
          $feetype = $this->feetype->duplicate_check('title',$this->input->post('title')); 
          if($feetype){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $feetype = $this->feetype->duplicate_check('title', $this->input->post('title'), $this->input->post('id')); 
          if($feetype){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }

   
     /*****************Function _get_posted_feetype_data**********************************
     * @type            : Function
     * @function name   : _get_posted_feetype_data
     * @description     : Prepare "Income Head" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_feetype_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['year']       = $this->feetype->running_year();
            $data['head_type']  = 'fee';
            $data['status']     = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }

    
    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Income head" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
       // check_permission(DELETE);
        
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('feetype');   
        }
        $fee_type = $this->feetype->get_single('income_heads', array('id' => $id));
        if ($this->feetype->delete('income_heads', array('id' => $id))) {
            $this->feetype->delete('fees_amount', array('income_head_id' => $id));            
            create_log('Has been deleted a fee type : '. $fee_type->title);
            $this->session->set_flashdata('flash_message' , get_phrase('delete_data_successfully'));
        } else {
            $this->session->set_flashdata('error_message' , get_phrase('delete_data_failed'));
        }
        redirect('feetype');
    }
    
    
    
    private function _save_fee_amount($income_head_id){
        
        foreach($this->input->post('class_id') as $key=>$value){
            
            $data = array();
            $exist = '';
            //$amount_id = @$this->input->post('amount_id')[$key];
            $amount_id = @$_POST['amount_id'][$key];
            
            if($amount_id){
               $exist = $this->feetype->get_single('fees_amount', array('class_id'=>$key, 'id'=>$amount_id)); 
               
            }            
            
            
            //$data['fee_amount'] = $this->input->post('fee_amount')[$key];
            $data['fee_amount'] = @$_POST['fee_amount'][$key];
            
            if ($this->input->post('id') && $exist) {                
                
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = logged_in_user_id();                
                $this->feetype->update('fees_amount', $data, array('id'=>$exist->id));
                
            } else {
                
                $data['income_head_id'] = $income_head_id;
                $data['class_id'] = $key;                
                $data['status'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id(); 
                $this->feetype->insert('fees_amount', $data);
            }
        }
    }

}
