<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Creativeitem
 *	date		: 14 september, 2017
 *	Ekattor School Management System Pro
 *	http://codecanyon.net/user/Creativeitem
 *	http://support.creativeitem.com
 */

class Accountant extends MY_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		 $this->load->model('Feetype_Model', 'feetype', true);
        $this->load->model('Discount_Model', 'discount', true);	
		 $this->load->model('Invoice_Model', 'invoice', true);
        $this->load->model('Payment_Model', 'payment', true);
		  $this->load->model('Duefeeemailsms_Model', 'mail', true);
		   $this->load->model('Duefeeemailsms_Model', 'sms', true);
		   $this->load->model('Incomehead_Model', 'incomehead', true);   
		    $this->load->model('Exphead_Model', 'exphead', true);  
			 $this->load->model('Expenditure_Model', 'expenditure', true);     
          $this->data['texts'] = $this->sms->get_sms_list();
        $this->data['emails']  = $this->mail->get_email_list();
        $this->data['classes'] = $this->mail->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $this->data['roles']   = $this->mail->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
	//print_r($this->data['emails']); exit;
        $this->data['classes'] = $this->feetype->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC'); 
		 $this->load->library('twilio');
        $this->load->library('clickatell');
        $this->load->library('bulk');
        $this->load->library('msg91');
        $this->load->library('plivo');
        //$this->load->library('smscountry');
        $this->load->library('textlocalsms');
        $this->load->library('session');
		 $this->load->helper('array');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no accountant logged in yet***/
    public function index()
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('accountant_login') == 1)
            redirect(site_url('accountant/dashboard'), 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('accountant_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            if ($this->input->post('description') != null) {
                $data['description']        = $this->input->post('description');
            }
            
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            if ($this->input->post('description') != null) {
                $data['description']        = $this->input->post('description');
            }
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('accountant/student_payment'), 'refresh');
        }

        if ($param1 == 'create_mass_invoice') {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id']         = $id;
                $data['title']              = $this->input->post('title');
                if ($this->input->post('description') != null) {
                    $data['description']        = $this->input->post('description');
                }
                $data['amount']             = $this->input->post('amount');
                $data['amount_paid']        = $this->input->post('amount_paid');
                $data['due']                = $data['amount'] - $data['amount_paid'];
                $data['status']             = $this->input->post('status');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));
                $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                
                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id']        =   $invoice_id;
                $data2['student_id']        =   $id;
                $data2['title']             =   $this->input->post('title');
                if ($this->input->post('description') != null) {
                  $data['description']        = $this->input->post('description');
                }
                $data2['payment_type']      =  'income';
                $data2['method']            =   $this->input->post('method');
                $data2['amount']            =   $this->input->post('amount_paid');
                $data2['timestamp']         =   strtotime($this->input->post('date'));
                $data2['year']               =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('payment' , $data2);
            }
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('accountant/student_payment'), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            if ($this->input->post('description') != null) {
                $data['description']        = $this->input->post('description');
            }
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('accountant/income'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
           if ($this->input->post('description') != null) {
                $data['description']        = $this->input->post('description');
            }
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $data['year']         =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   $this->input->post('amount');
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(site_url('accountant/income'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('accountant/income'), 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**********ACCOUNTING********************/
    function income($param1 = 'invoices', $param2 = '', $param3 = '') {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name'] = 'income';
        $page_data['inner'] = $param1;
        $page_data['page_title'] = get_phrase('student_payments');
        $this->load->view('backend/index', $page_data);
    }

    function get_invoices() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'invoice_id',
            1 => 'student',
            2 => 'title',
            3 => 'total',
            4 => 'paid',
            5 => 'status',
            6 => 'date',
            7 => 'options',
            8 => 'invoice_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_invoices_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {            
            $invoices = $this->ajaxload->all_invoices($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $invoices =  $this->ajaxload->invoice_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->invoice_search_count($search);
        }

        $data = array();
        if(!empty($invoices)) {
            foreach ($invoices as $row) {

                if ($row->due == 0) {
                    $status = '<button class="btn btn-success btn-xs">'.get_phrase('paid').'</button>';
                    $payment_option = '';
                } else {
                    $status = '<button class="btn btn-danger btn-xs">'.get_phrase('unpaid').'</button>';
                    $payment_option = '<li><a href="#" onclick="invoice_pay_modal('.$row->invoice_id.')"><i class="entypo-bookmarks"></i>&nbsp;'.get_phrase('take_payment').'</a></li><li class="divider"></li>';
                }
                    
                
                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu">'.$payment_option.'<li><a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.get_phrase('view_invoice').'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_edit_modal('.$row->invoice_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_delete_confirm('.$row->invoice_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['invoice_id'] = $row->invoice_id;
                $nestedData['student'] = $this->crud_model->get_type_name_by_id('student',$row->student_id);
                $nestedData['title'] = $row->title;
                $nestedData['total'] = $row->amount;
                $nestedData['paid'] = $row->amount_paid;
                $nestedData['status'] = $status;
                $nestedData['date'] = date('d M,Y', $row->creation_timestamp);
                $nestedData['options'] = $options;
                
                $data[] = $nestedData;
                
            }
        }
          
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data);
    }

    function get_payments() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'payment_id',
            1 => 'title',
            2 => 'description',
            3 => 'method',
            4 => 'amount',
            5 => 'date',
            6 => 'options',
            7 => 'payment_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_payments_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {            
            $payments = $this->ajaxload->all_payments($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $payments =  $this->ajaxload->payment_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->payment_search_count($search);
        }

        $data = array();
        if(!empty($payments)) {
            foreach ($payments as $row) {

                if ($row->method == 1)
                    $method = get_phrase('cash');
                else if ($row->method == 2)
                    $method = get_phrase('cheque');
                else if ($row->method == 3)
                    $method = get_phrase('card');
                else if ($row->method == 'Paypal')
                    $method = 'Paypal';
                else
                    $method = 'Stripe';
                    
                
                $options = '<a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.get_phrase('view_invoice').'</a>';

                $nestedData['payment_id'] = $row->payment_id;
                $nestedData['title'] = $row->title;
                $nestedData['description'] = $row->description;
                $nestedData['method'] = $method;
                $nestedData['amount'] = $row->amount;
                $nestedData['date'] = date('d M,Y', $row->timestamp);
                $nestedData['options'] = $options;
                
                $data[] = $nestedData;
                
            }
        }
          
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data);
    }

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'student_payment';
        $page_data['page_title'] = get_phrase('create_student_payment');
        $this->load->view('backend/index', $page_data); 
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            if ($this->input->post('description') != null) {
               $data['description']         =   $this->input->post('description');
            }
            
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('accountant/expense'), 'refresh');
        }

        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            if ($this->input->post('description') != null) {
               $data['description']         =   $this->input->post('description');
            }
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('accountant/expense'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('accountant/expense'), 'refresh');
        }

        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('expenses');
        $this->load->view('backend/index', $page_data); 
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(site_url('accountant/expense_category'), 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('accountant/expense_category'), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('accountant/expense_category'), 'refresh');
        }

        $page_data['page_name']  = 'expense_category';
        $page_data['page_title'] = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);
    }
    
    // MANAGE OWN PROFILE AND CHANGE PASSWORD
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $validation = email_validation_for_edit($data['email'], $this->session->userdata('accountant_id'), 'accountant');
            if ($validation == 1) {
                $this->db->where('accountant_id', $this->session->userdata('accountant_id'));
                $this->db->update('accountant', $data);
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('accountant/manage_profile'), 'refresh');
        }

        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('accountant', array(
                'accountant_id' => $this->session->userdata('accountant_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('accountant_id', $this->session->userdata('accountant_id'));
                $this->db->update('accountant', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('accountant/manage_profile'), 'refresh');
        }
        
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('accountant', array(
            'accountant_id' => $this->session->userdata('accountant_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_expenses() {
        if ($this->session->userdata('accountant_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'payment_id',
            1 => 'title',
            2 => 'category',
            3 => 'method',
            4 => 'amount',
            5 => 'date',
            6 => 'options',
            7 => 'payment_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_expenses_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {            
            $expenses = $this->ajaxload->all_expenses($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $expenses =  $this->ajaxload->expense_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->expense_search_count($search);
        }

        $data = array();
        if(!empty($expenses)) {
            foreach ($expenses as $row) {
                $category = $this->db->get_where('expense_category', array('expense_category_id' => $row->expense_category_id))->row()->name;
                if ($row->method == 1)
                    $method = get_phrase('cash');
                else if ($row->method == 2)
                    $method = get_phrase('cheque');
                else 
                    $method = get_phrase('card');
                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="#" onclick="expense_edit_modal('.$row->payment_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="expense_delete_confirm('.$row->payment_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['payment_id'] = $row->payment_id;
                $nestedData['title'] = $row->title;
                $nestedData['category'] = $category;
                $nestedData['method'] = $method;
                $nestedData['amount'] = $row->amount;
                $nestedData['date'] = date('d M,Y', $row->timestamp);
                $nestedData['options'] = $options;
                
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
            
        echo json_encode($json_data);
    }

    function get_sections_for_ssph($class_id) {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        $options = '';
        foreach ($sections as $row) {
            $options .= '<option value="'.$row['section_id'].'">'.$row['name'].'</option>';
        }
        echo '<select class="" name="section_id" id="section_id">'.$options.'</select>';
    }

    function get_students_for_ssph($class_id, $section_id) {
        $enrolls = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
        $options = '';
        foreach ($enrolls as $row) {
            $name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $options .= '<option value="'.$row['student_id'].'">'.$name.'</option>';
        }
        echo '<select class="" name="student_id" id="student_id">'.$options.'</select>';
    }

    function get_payment_history_for_ssph($student_id) {
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/admin/student_specific_payment_history_table', $page_data);
    }
	
	
	  function feetypess() {
        $page_data['feetypes'] = $this->feetype->get_fee_type();
        $page_data['list'] = TRUE;	
	    $page_data['folder'] = 'accountant';
		$page_data['page_name']  = 'feetype';
        $page_data['page_title'] = get_phrase('fee_type');
        $this->load->view('backend/index', $page_data);
    }
	
	
	   public function feetype() {
        $this->data['feetypes'] = $this->feetype->get_fee_type();
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'feetype';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder'] = 'accountant';
        $this->layout->title('SMS');
        $this->load->view('backend/index', $this->data);
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
    public function feetype_edit($id = null) {       
       
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
                    redirect('accountant/feetype');                   
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_update_failed'));
                    redirect('accountant/feetype_edit/' . $this->input->post('id'));
                }
            } else {
                    $this->data['feetype'] = $this->feetype->get_single('income_heads', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
                   $this->data['feetype'] = $this->feetype->get_single('income_heads', array('id' => $id));

            if (!$this->data['feetype']) {
                redirect('accountant/feetype');
            }
        }

        $this->data['feetypes']   = $this->feetype->get_fee_type();  
        $this->data['edit']       = TRUE;  
		$this->data['page_name'] = 'feetype';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder'] = 'accountant';
      
        $this->load->view('backend/index', $this->data);
    }
	    public function feetype_add() {
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
                    redirect('accountant/feetype');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('accountant/feetype_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['feetypes']   = $this->feetype->get_fee_type();  
        $this->data['add']        = TRUE;
		$this->data['page_name']  = 'feetype';
		$this->data['page_title'] = 'Fee type';
		$this->data['folder']     = 'accountant';
        $this->load->view('backend/index', $this->data);
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
       echo $this->load->view('accountant/get-single-feetype', $this->data);
    }
	
	
	    private function _prepare_feetype_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('title', $this->lang->line('fee_type'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
	
	
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
    public function feetype_delete($id = null) {
        
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
        redirect('accountant/feetype');
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
	     /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Discount List" user interface                 
     *                     
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function discount() {
        
       //check_permission(VIEW);
        $this->data['discounts'] = $this->discount->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'DESC');  
        $this->data['list'] = TRUE;
		$this->data['page_name']  = 'discount';
		$this->data['page_title'] = 'Discount';
		$this->data['folder']     = 'accountant';
        $this->load->view('backend/index', $this->data);            
       
    }
	
	    
     /*****************Function discount_add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Discount" user interface                 
     *                    and store "Discount" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function discount_add() {
      
        if ($_POST) {
            $this->_prepare_discount_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_discount_data();

                $insert_id = $this->discount->insert('discounts', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a discount : '.$data['title']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_insert_successfully'));
                    redirect('accountant/discount');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accountant/discount_add');
                }
            } else {
			
                $this->data['post'] = $_POST;

            }
        }
 
        $this->data['discounts'] = $this->discount->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'DESC');  
        $this->data['add']        = TRUE;
        $this->data['page_name']  = 'discount';
        $this->data['page_title'] = 'Discount';
        $this->data['folder']     = 'accountant';
        $this->load->view('backend/index', $this->data);
    }
   /*****************Function _prepare_discount_validation**********************************
     * @type            : Function
     * @function name   : _prepare_discount_validation
     * @description     : Process "Discount" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_discount_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required');   
    }
         /*****************Function _get_posted_discount_data**********************************
     * @type            : Function
     * @function name   : _get_posted_discount_data
     * @description     : Prepare "Discount" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_discount_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'amount';
        $items[] = 'note';
       
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status']     = 1;
            $data['year']       = $this->discount->running_year();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
		
    }
	
	    
     /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Discount" user interface                 
     *                    with populated "Discount" value 
     *                    and update "Discount" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function discount_edit($id = null) {       
       
       //check_permission(EDIT);
        
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('accountant/discount');   
        }
        
        if ($_POST) {
            $this->_prepare_discount_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_discount_data();
                $updated = $this->discount->update('discounts', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    create_log('Has been updated a discount : '.$data['title']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_update_successfully'));
                    redirect('accountant/discount');                   
                } else {
                    $this->session->set_flashdata('error_message' , get_phrase('data_update_failed'));
                    redirect('accountant/discount_edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['discount'] = $this->discount->get_single('discounts', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['discount'] = $this->discount->get_single('discounts', array('id' => $id));
            if (!$this->data['discount']) {
                redirect('accountant/discount');
            }
        }

        $this->data['discounts'] = $this->discount->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'DESC');  
        $this->data['edit'] = TRUE;
       $this->data['page_name']  = 'discount';
        $this->data['page_title'] = 'Discount';
        $this->data['folder']     = 'accountant';      
        $this->load->view('backend/index', $this->data);
    }

  /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function invoice_list() {
        
       // check_permission(VIEW);
        
        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
		//print_r($this->data['classes']);die();
        $this->data['income_heads'] = $this->invoice->get_fee_type();         
        $this->data['invoices']     = $this->invoice->get_invoice_list();  
        $this->data['page_name']    = 'invoice_list';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'accountant';
        $this->data['list']         = TRUE;
        $this->layout->title('SMS');
        $this->load->view('backend/index', $this->data); 
	
    }    
	    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific invoice data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function invoice_view($id = null) {
        
        //check_permission(VIEW);
        
        if(!is_numeric($id)){
            $this->session->set_flashdata('error_message' , get_phrase($this->lang->line('unexpected_error')));
            redirect('invoice_list');
        }
        
        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');        
        $this->data['income_heads'] = $this->invoice->get_fee_type(); 
        $this->data['invoices'] = $this->invoice->get_invoice_list();  
        $this->data['settings'] = $this->invoice->get_setting_data('settings', array('status'=>1));
    
        $invoice                = $this->payment->get_invoice_amount($id);
        
        $this->data['paid_amount'] = $invoice->paid_amount;
        $this->data['invoice']   = $this->invoice->get_single_invoice($id);        
        $this->data['list'] = TRUE;
        $this->data['page_name'] = 'invoice_view';
        $this->data['page_title']= 'Invoice';
        $this->data['folder']    = 'accountant';

        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);            
       
    }
	
	    
     /*****************Function due**********************************
    * @type            : Function
    * @function name   : due
    * @description     : Load "Due Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function invoice_due() {    
        
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
    public function invoice_add() {

        if ($_POST) {
            $this->_prepare_invoice_validation();
            if ($this->form_validation->run() === TRUE) {
                $data      = $this->_get_posted_invoice_data();
                $insert_id = $this->invoice->insert('invoices', $data);
                if ($insert_id) { 
                    $data['invoice_id'] = $insert_id;
                    $this->_save_transaction($data);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('accountant/invoice_list');
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('accountant/invoice_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

     $this->data['page_name']    = 'invoice_list';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'accountant';
		$this->data['single']     = TRUE;
        $this->load->view('backend/index', $this->data); 
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
        $this->form_validation->set_rules('paid_status', $this->lang->line('paid').' '.$this->lang->line('status'), 'trim|required'); 
        
        if($this->input->post('type')== 'single'){
            $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required'); 
        }

        $this->form_validation->set_rules('is_applicable_discount', $this->lang->line('is_applicable_discount'), 'trim|required');   
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required');   
        $this->form_validation->set_rules('income_head_id', $this->lang->line('fee_type'),'required', array('required' => $this->lang->line('check_at_least_one')));
              
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
        $items[] = 'is_applicable_discount';  
        $items[] = 'month';        
        $items[] = 'paid_status';        
        $items[] = 'note';
        
        $data = elements($items, $_POST); 
        $income_head = $this->invoice->get_single('income_heads', array('id' => $this->input->post('income_head_id')));
        $data['discount']     = 0.00;
        $data['gross_amount'] = $this->input->post('amount');
        $data['net_amount']   = $this->input->post('amount');
        
        if($data['is_applicable_discount']){
            $discount = $this->invoice->get_student_discount($data['student_id']);
            if(!empty($discount)){
                $data['discount']   = $discount->amount/100*$data['gross_amount'];;
                $data['net_amount'] = $data['gross_amount'] - $data['discount'];
            }
        }
        
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
            $txn['bank_name'] = $this->input->post('bank_name');
            $txn['cheque_no'] = $this->input->post('cheque_no');

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
                $this->invoice->insert('transactions', $txn);
            }        
        }
    }
        /*****************Function bulk**********************************
    * @type            : Function
    * @function name   : bulk
    * @description     : Load "Create new bulk Invoice" user interface                 
    *                    and store "Invoice" data into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function invoice_bulk() {

        //check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_invoice_validation();           
            if ($this->form_validation->run() === TRUE) {
               
                $status = $this->_get_create_bulk_invoice();
                if ($status) {
                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect('accountant/invoice');
                    
                } else {                  
                   $this->session->set_flashdata('error_message', get_phrase('data_insert_failed'));
                    redirect('accountant/invoice_bulk');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['classes'] = $this->invoice->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');       
        $this->data['income_heads'] = $this->invoice->get_fee_type(); 
        $this->data['invoices']     = $this->invoice->get_invoice_list();  
        $this->data['bulk']         = TRUE;
       $this->data['page_name']    = 'invoice_list';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'accountant';
        $this->load->view('backend/page', $this->data);
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
		 $this->data['page_name']    = 'due';
		$this->data['page_title']   = 'Invoice';
		$this->data['folder']       = 'accountant';
        $this->layout->title('SMS');
        $this->load->view('backend/index', $this->data);           
       
    }
    /*****************Function duefeeemail**********************************
    * @type            : Function
    * @function name   : duefeeemail
    * @description     : Load "Sent Duefeeemail List" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function duefeeemail() {

        //check_permission(VIEW);
        //$r = $this->mail->get_due_fee(5,1);
        // print_r($r);
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'duefeeemail';
		$this->data['page_title'] = 'Due Fee Mail';
		$this->data['folder'] = 'accountant';
        $this->layout->title($this->lang->line('manage_email') . ' | ' . SMS);
        $this->load->view('backend/index', $this->data); 
    }
	
	    /*****************Function get_single_email**********************************
     * @type            : Function
     * @function name   : get_single_email
     * @description     : "Load single email information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function duefeeemail_get_single_email(){
        
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

	
	
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Send new Email" user interface                 
    *                    and process to send "Email"
    *                    and store email into database
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function duefeeemail_add() {

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
                    redirect('accountant/duefeeemail');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accountant/duefeeemail_add');
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
        $this->load->view('backend/index', $this->data);
    }
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Sent SMS List" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function duefeesms() {
        //check_permission(VIEW);
        $this->data['page_name'] = 'duefeesms';
		$this->data['page_title']= 'Invoice';
		$this->data['folder']    = 'accountant';
        $this->data['list']      = TRUE;
        $this->layout->title($this->lang->line('manage_sms') . ' | ' . SMS);
        $this->load->view('backend/index', $this->data); 
    }
	
	
	     /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Income Head List" user interface                 
     *                     
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function incomehead() {
        
       // check_permission(VIEW);
        $this->data['incomeheads'] = $this->incomehead->get_list('income_heads', array('status'=> 1, 'head_type'=>'income'), '', '', '', '', '');  
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_income_head'). ' | ' . SMS);
		$this->data['page_name'] = 'incomehead';
		$this->data['page_title'] = 'Income Head';
		$this->data['folder'] = 'accountant';
        $this->load->view('backend/index', $this->data); 
   
    }
   
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Income Head" user interface                 
     *                    and store "Income Head" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function incomehead_add() {

      //  check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_incomehead_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_incomehead_data();

                $insert_id = $this->incomehead->insert('income_heads', $data);
                if ($insert_id) {
                    
                  //create_log('Has been created a income head : '. $data['title']);
                    success($this->lang->line('insert_success'));
                    redirect('accountant/incomehead');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accountant/incomehead_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

    $this->data['incomeheads'] = $this->incomehead->get_list('income_heads', array('status'=> 1, 'head_type'=>'income'), '', '', '', '', '');  
    $this->data['add'] = TRUE;
    $this->data['page_name'] = 'incomehead';
    $this->data['page_title'] = 'Income Head';
    $this->data['folder'] = 'accountant';
    $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('income_head'). ' | ' . SMS);
    $this->load->view('backend/index', $this->data);
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

    public function incomehead_edit($id = null) {       
       
       // check_permission(EDIT);
        
          
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accountant/incomehead');   
        }
        
        if ($_POST) {
            $this->_prepare_incomehead_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_incomehead_data();
                $updated = $this->incomehead->update('income_heads', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                   // create_log('Has been updated a income head : '. $data['title']);
                    
                    success($this->lang->line('update_success'));
                    redirect('accountant/incomehead');                   
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('accountant/incomehead_edit/' . $this->input->post('id'));
                }
            } else {
                 $this->data['incomehead'] = $this->incomehead->get_single('income_heads', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['incomehead'] = $this->incomehead->get_single('income_heads', array('id' => $id));

            if (!$this->data['incomehead']) {
                 redirect('accountant/incomehead');
            }
        }

        $this->data['incomeheads'] = $this->incomehead->get_list('income_heads', array('status'=> 1, 'head_type'=>'income'), '', '', '', '', '');  
        $this->data['edit'] = TRUE;   
        $this->data['page_name'] = 'incomehead';
        $this->data['page_title'] = 'Income Head';
        $this->data['folder'] = 'accountant';   
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('income_head'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);
    }
    
    /*****************Function _prepare_incomehead_validation**********************************
     * @type            : Function
     * @function name   : _prepare_incomehead_validation
     * @description     : Process "Incoem Head" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_incomehead_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('title', $this->lang->line('income_head'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
    
     /*****************Function _get_posted_incomehead_data**********************************
     * @type            : Function
     * @function name   : _get_posted_incomehead_data
     * @description     : Prepare "Income Head" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_incomehead_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['head_type'] = 'income';
            $data['year']   = $this->incomehead->running_year();
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }
         
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Expenditure Head Listing" user interface                 
     *                        
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function exphead() {
        // check_permission(VIEW);
        $this->data['expheads'] = $this->exphead->get_list('expenditure_heads', array('status'=> 1));     
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'exphead';
		$this->data['page_title'] = 'Expenditure Heads';
		$this->data['folder'] = 'accountant';
        $this->layout->title($this->lang->line('manage_expenditure_head'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);           
       
    }
   
       /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Expenditure Head" user interface                 
     *                    and store "Expenditure Head" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function exphead_add() {

        //check_permission(ADD);
        if ($_POST) {
            $this->_prepare_exphead_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_exphead_data();

                $insert_id = $this->exphead->insert('expenditure_heads', $data);
                if ($insert_id) {
                    
                    //create_log('Has been created a expenditure head : '. $data['title']);
                    
                    success($this->lang->line('insert_success'));
                    redirect('accountant/exphead');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accountant/exphead_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['expheads']   = $this->exphead->get_list('expenditure_heads', array('status'=> 1));     
        $this->data['add']        = TRUE;
        $this->data['page_name']  = 'exphead';
		$this->data['page_title'] = 'Expenditure Heads';
		$this->data['folder']     = 'accountant';
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('expenditure_head'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);
    }

    
     /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Expenditure Head" user interface                 
     *                    with populated "Expenditure Head" value 
     *                    and update "Expenditure Head" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function exphead_edit($id = null) {       
       
       // check_permission(EDIT);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accountant/exphead');
        }
                
        if ($_POST) {
           $this->_prepare_exphead_validation();
           if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_exphead_data();
            $updated = $this->exphead->update('expenditure_heads', $data, array('id' => $this->input->post('id')));
			if ($updated) {
                    
                    //create_log('Has been updated a expenditure head : '. $data['title']);
                success($this->lang->line('update_success'));
                redirect('accountant/exphead');                   
            } else {
                error($this->lang->line('update_failed'));
                redirect('accountant/exphead_edit/' . $this->input->post('id'));
            }
          } else {
                 $this->data['exphead'] = $this->exphead->get_single('expenditure_heads', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['exphead'] = $this->exphead->get_single('expenditure_heads', array('id' => $id));

            if (!$this->data['exphead']) {
                 redirect('accountant/exphead');
            }
        }

        $this->data['expheads'] = $this->exphead->get_list('expenditure_heads', array('status'=> 1));     
        $this->data['edit'] = TRUE;
        $this->data['page_name']  = 'exphead';
		$this->data['page_title'] = 'Expenditure Heads';
		$this->data['folder']     = 'accountant';       
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('expenditure_head'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);
    }
    
     /*****************Function _prepare_exphead_validation**********************************
     * @type            : Function
     * @function name   : _prepare_exphead_validation
     * @description     : Process "Expenditure Head" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_exphead_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('title', $this->lang->line('expenditure_head'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
       
    /*****************Function _get_posted_exphead_data**********************************
     * @type            : Function
     * @function name   : _get_posted_exphead_data
     * @description     : Prepare "Expenditure Head" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_exphead_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }

      
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Expenditure Listing" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function expenditure() {
        
        //check_permission(VIEW);
        
        $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list();  
        $this->data['list'] = TRUE;
		 $this->data['page_name'] = 'expenditure';
		$this->data['page_title'] = 'Expenditure';
		$this->data['folder'] = 'accountant';
        $this->layout->title( $this->lang->line('manage_expenditure'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);           
       
    }
 
 
  
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Expenditure" user interface                 
     *                    and store "Expenditure" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function expenditure_add() {
        
        //check_permission(ADD);
        if ($_POST) {
            $this->_prepare_expenditure_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_expenditure_data();

                $insert_id = $this->expenditure->insert('expenditures', $data);
                if ($insert_id) {
                    
                  //  create_log('Has been added expenditure : '.$data['amount']);
                    
                    success($this->lang->line('insert_success'));
                    redirect('accountant/expenditure');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accountant/expenditure_add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list();  
         
        $this->data['add']        = TRUE;
        $this->data['page_name']  = 'expenditure';
        $this->data['page_title'] = 'Expenditure';
        $this->data['folder']     = 'accountant';
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('expenditure'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);
    }

    
        
    /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Expenditure" user interface                 
     *                    with populated "Expenditure" value 
     *                    and update "Expenditure" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function expenditure_edit($id = null) {  
        
      // check_permission(EDIT);
       
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accountant/expenditure');
        }
        
        if ($_POST) {
            $this->_prepare_expenditure_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_expenditure_data();
                $updated = $this->expenditure->update('expenditures', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    ///create_log('Has been updated expenditure : '.$data['amount']);
                    
                    success($this->lang->line('update_success'));
                    redirect('accountant/expenditure');                   
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('accountant/expenditure_edit/' . $this->input->post('id'));
                }
            } else {
                 $this->data['expenditure'] = $this->expenditure->get_single('expenditures', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['expenditure'] = $this->expenditure->get_single('expenditures', array('id' => $id));

            if (!$this->data['expenditure']) {
                 redirect('accountant/expenditure');
            }
        }
        
        $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list();  
        $this->data['edit'] = TRUE;
        $this->data['page_name']  = 'expenditure';
        $this->data['page_title'] = 'Expenditure';
        $this->data['folder']     = 'accountant';   

        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('expenditure'). ' | ' . SMS);
        $this->load->view('backend/index', $this->data);
    }
    
    
     /*****************Function view**********************************
     * @type            : Function
     * @function name   : view
     * @description     : Load user interface with specific expenditure data                 
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function expenditure_view($id = null){
        
        check_permission(VIEW);
        
         
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accountant/expenditure');
        }
        
        $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', array('status'=> 1));        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list();  
        $this->data['expenditure'] = $this->expenditure->get_single_expenditure($id);
        $this->data['detail'] = TRUE;       
        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('expenditure'). ' | ' . SMS);
        $this->layout->view('accountant/expenditure', $this->data); 
    }
    
        
           
     /*****************Function get_single_expenditure**********************************
     * @type            : Function
     * @function name   : get_single_slider
     * @description     : "Load single expenditure information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_expenditure(){
        
       $expenditure_id = $this->input->post('expenditure_id');       
       $this->data['expenditure'] = $this->expenditure->get_single_expenditure($expenditure_id);
       echo $this->load->view('expenditure/get-single-expenditure', $this->data);
    }

    
     /*****************Function _prepare_expenditure_validation**********************************
     * @type            : Function
     * @function name   : _prepare_expenditure_validation
     * @description     : Process "expenditure" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_expenditure_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('expenditure_head_id', $this->lang->line('expenditure_head'), 'trim|required');   
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|numeric');   
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');   
        $this->form_validation->set_rules('expenditure_via', $this->lang->line('expenditure') .' '. $this->lang->line('method'), 'trim|required');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }


     /*****************Function _get_posted_expenditure_data**********************************
     * @type            : Function
     * @function name   : _get_posted_expenditure_data
     * @description     : Prepare "expenditure" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_expenditure_data() {

        $items = array();
        $items[] = 'expenditure_head_id';
        $items[] = 'amount';
        $items[] = 'expenditure_via';
        $items[] = 'note';
        
        $data = elements($items, $_POST);  
        $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['expenditure_type'] = 'general';
            $data['academic_year_id'] = $this->expenditure->running_year();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }

    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Expenditure" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function expenditure_delete($id = null) {
        
        //check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accountant/expenditure');
        }
        
        $expenditure = $this->expenditure->get_single('expenditures', array('id' => $id));
        
        if ($this->expenditure->delete('expenditures', array('id' => $id))) {  
            
          //  create_log('Has been deleted expenditure : '.$expenditure->amount);            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('accountant/expenditure');
    }    
 
     function salary_details()
    {
        $page_data['salary']  = $this->ajaxload->get_accountant_salary_details($this->session->userdata('login_user_id'));
		//print_r($this->session->userdata('login_user_id'));
		$page_data['page_name']  = 'salary_details';
        $page_data['page_title'] = get_phrase('salary_details');
        $this->load->view('backend/index', $page_data);
    }


    function salary_payslips()
    {
        $page_data['page_name']  = 'salary_payslips';
        $page_data['page_title'] = get_phrase('salary_payslips');
        $this->load->view('backend/index', $page_data);
    }

    function salary_payslips_request()
    {
		$page_data['salarys']  = $this->ajaxload->get_accountant_salary_details_all();	
		//print_r($page_data['salarys']);
        $page_data['page_name']  = 'salary_payslips_request';
        $page_data['page_title'] = get_phrase('salary_payslips_request');
        $this->load->view('backend/index', $page_data);
    }
	   function salary_update_status(){     
       $this->db->where('id',$this->input->post('id'));
       $this->db->update('salary_payments',array('payslip_status'=>$this->input->post('status')));
       echo 1;
     }
     
     
         
    function leaves_past_record($param1 = '', $param2 = '', $param3 = '')
    {
       

        $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->session->userdata('login_user_id'),'year'=>$this->year,'role_id' => $this->session->userdata('role_id') ))->result();
        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'leaves_past_record';
        $page_data['page_title'] = get_phrase('leaves_past_record');
        $this->load->view('backend/index', $page_data);

    }
    
    
      /****Leave Management*****/
    function leave_request($param1 ="")
    {

        $result = $this->db->get_where('accountant', array('accountant_id'=>$this->session->userdata('login_user_id')))->row();
      
        
        $user_code = 'accountant_'.$result->accountant_id;
        $role_id   = $result->role_id;
        $user_id   = $result->accountant_id;
       $role_name = $this->db->get_where('roles', array('id' => $user_id))->row()->name;
        if ($param1 == "create")
        {   
           
            $gen_code          = $this->genrate_uniqid('lve_');
            $data['id_no']     = $user_code;
            $data['request_by']= $user_id;
            $data['uniqid']    = $gen_code;
            $data['role_id']   = $this->session->userdata('role_id');
            $data['type']      = $this->input->post('leave_day');
            $data['from_date'] = $this->input->post('from_leave_date');
            $data['to_date']   = $this->input->post('to_leave_date');
            $data['reason']    = $this->input->post('reason');
            $data['leave_date']= $this->input->post('leave_date');
            $data['year']      = $this->year;
            $notification_msg  = $data['reason'];
            $url               = json_encode(array('admin/add_notification')); 
            $send_role         = $role_id;
            if($data['id_no'] != "" && $data['type'] != ""){
               $this->db->insert('leave_request',$data);
			 //  $this->add_notification($user_id,$role_name,$role_id,$notification_msg,'Leave Request',$url);
               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('accountant/leaves_past_record/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               //redirect(site_url('teacher/teacher_leave_request/'), 'refresh'); 
              }
            }
        $page_data['teacher_code']  = $user_code;
        $page_data['page_name']  = 'leave_request';
        $page_data['page_title'] = get_phrase('leave_request');
        $this->load->view('backend/index', $page_data);
    }
  function genrate_uniqid($format){

      $code = substr(md5(uniqid(rand(), true)), 0, 7);
      $code_genrate = $format.$code;
      $rowdata = $this->db->get_where('leave_request', array('uniqid'=> $code_genrate))->row();
      if($rowdata != ""){
         $this->genrate_uniqid($format);
      }else{
        return $code_genrate;
      }
    }

}
















