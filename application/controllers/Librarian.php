<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
 *  @author     : Creativeitem
 *  date        : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Librarian extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));

       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

    }

    public function index()
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('librarian_login') == 1)
            redirect(site_url('librarian/dashboard'), 'refresh');
    }

    // LIBRARIAN DASHBOARD
    function dashboard()
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('librarian_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    // MANAGE LIBRARY/BOOKS
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }
            if(!empty($_FILES["file_name"]["name"])) {
                $data['file_name'] = $_FILES["file_name"]["name"];
            }

            $this->db->insert('book', $data);

            if(!empty($_FILES["file_name"]["name"])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(site_url('librarian/book'), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            else{
               $data['description'] = null;
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            else{
                $data['price'] = null;
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }
            else{
               $data['author'] = null;
            }
            if ($this->input->post('total_copies') != null) {
               $data['total_copies'] = $this->input->post('total_copies');
            }
            else{
               $data['total_copies'] = null;  
            }
            if(!empty($_FILES["file_name"]["name"])) {
                $data['file_name'] = $_FILES["file_name"]["name"];
            }

            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);

            if(!empty($_FILES["file_name"]["name"])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(site_url('librarian/book'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array('book_id' => $param2))->result_array();
        }

        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');

            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(site_url('librarian/book'), 'refresh');
        }

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
    }

    // MANAGE BOOK REQUESTS
    function book_request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('librarian_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "accept")
        {
            $data['status'] = 1;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            // INCREMENT NUMBER OF ISSUED COPIES
            $book_id        = $this->db->get_where('book_request', array('book_request_id' => $param2))->row()->book_id;
            $issued_copies  = $this->db->get_where('book', array('book_id' => $book_id))->row()->issued_copies;

            $data2['issued_copies'] = $issued_copies + 1;

            $this->db->update('book', $data2, array('book_id' => $book_id));

            $this->session->set_flashdata('flash_message', get_phrase('request_accepted_successfully'));
            redirect(site_url('librarian/book_request'), 'refresh');
        }

        if ($param1 == "reject")
        {
            $data['status'] = 2;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('request_rejected_successfully'));
            redirect(site_url('librarian/book_request'), 'refresh');
        }

        $data['page_name']  = 'book_request';
        $data['page_title'] = get_phrase('book_request');
        $this->load->view('backend/index', $data);
    }

    // MANAGE OWN PROFILE AND CHANGE PASSWORD
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(site_url('login'), 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $validation = email_validation_for_edit($data['email'], $this->session->userdata('librarian_id'), 'librarian');
            if($validation == 1){
                $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
                $this->db->update('librarian', $data);
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('librarian/manage_profile'), 'refresh');
        }

        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('librarian', array(
                'librarian_id' => $this->session->userdata('librarian_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
                $this->db->update('librarian', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('librarian/manage_profile'), 'refresh');
        }

        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('librarian', array(
            'librarian_id' => $this->session->userdata('librarian_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_books() {
        if ($this->session->userdata('librarian_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'book_id',
            1 => 'name',
            2 => 'author',
            3 => 'description',
            4 => 'total_copies',
            5 => 'class',
            6 => 'download',
            7 => 'options',
            8 => 'book_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_books_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {            
            $books = $this->ajaxload->all_books($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 
            $books =  $this->ajaxload->book_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->book_search_count($search);
        }

        $data = array();
        if(!empty($books)) {
            foreach ($books as $row) {
                if ($row->file_name == null)
                    $download = '';
                else
                    $download = '<a href="'.base_url("uploads/document/$row->file_name").'" target="_blank" class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>'.get_phrase('download').'</a>';
                
                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="#" onclick="book_edit_modal('.$row->book_id.')"><i class="entypo-pencil"></i>&nbsp;'.get_phrase('edit').'</a></li><li class="divider"></li><li><a href="#" onclick="book_delete_confirm('.$row->book_id.')"><i class="entypo-trash"></i>&nbsp;'.get_phrase('delete').'</a></li></ul></div>';

                $nestedData['book_id'] = $row->book_id;
                $nestedData['name'] = $row->name;
                $nestedData['author'] = $row->author;
                $nestedData['description'] = $row->description;
                $nestedData['total_copies'] = $row->total_copies;
                $nestedData['class'] = $this->db->get_where('class', array('class_id' => $row->class_id))->row()->name;
                $nestedData['download'] = $download;
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
    /****Salary Dashboard*****/
    function salary_details()
    {
        $page_data['salary']  = $this->ajaxload->get_librarian_salary_details($this->session->userdata('login_user_id'));
		$page_data['page_name']  = 'salary_details';
        $page_data['page_title'] = get_phrase('salary_details');
        $this->load->view('backend/index', $page_data);
    }
    function salary_deduction()
    {
        $page_data['page_name']  = 'salary_deduction';
        $page_data['page_title'] = get_phrase('salary_deduction');
        $this->load->view('backend/index', $page_data);
    }
    function salary_payslips()
    {
        $page_data['page_name']  = 'salary_payslips';
        $page_data['page_title'] = get_phrase('salary_payslips');
        $this->load->view('backend/index', $page_data);
    }
	
	   function salary_update_status(){     
       $this->db->where('id',$this->input->post('id'));
       $this->db->update('salary_payments',array('payslip_status'=>$this->input->post('status')));
       echo 1;
     }
	 #book bulk Add functions start here 
	 	function books_bulk_add()
	{
		 if ($this->session->userdata('librarian_login') != 1)
            redirect(site_url('login'), 'refresh');

		$page_data['page_name']  = 'books_bulk_add';
		$page_data['page_title'] = get_phrase('Add Bulk Books');
		$this->load->view('backend/index', $page_data);
	}
	 function bulk_book_add_using_csv($param1 = '') {

        if ($this->session->userdata('librarian_login') != 1)
            redirect(site_url('login'), 'refresh');

       if ($param1 == 'import') {
         

              move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/library_book_bulk.csv');
              $csv = array_map('str_getcsv', file('uploads/library_book_bulk.csv'));
              $count = 1;
              $array_size = sizeof($csv);

             foreach ($csv as $row) {
                  if ($count == 1) {
                      $count++;
                      continue;
                  }
                      $data['name']      = $row[0];
	                  $data['description']     = $row[1];	                
	                  $data['author']     = $row[2];
	                  $data['class_id']   = $row[3];
	                  $data['price'] = $row[4];
	                  $data['total_copies'] = $row[5];                                          
                    $this->db->insert('book', $data);                                   
              }
              $this->session->set_flashdata('flash_message', get_phrase('Book_sucessfully_added'));
              redirect(site_url('librarian/books_bulk_add'), 'refresh');
        
        }
        $page_data['page_name']  = 'books_bulk_add';
        $page_data['page_title'] = get_phrase('books_bulk_add');
        $this->load->view('backend/index', $page_data);
    }
	    // MANAGE BOOK REQUESTS
    function issue_book_by_lib($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('librarian_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "accept")
        {
            $data['status'] = 1;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            // INCREMENT NUMBER OF ISSUED COPIES
            $book_id        = $this->db->get_where('book_request', array('book_request_id' => $param2))->row()->book_id;
            $issued_copies  = $this->db->get_where('book', array('book_id' => $book_id))->row()->issued_copies;

            $data2['issued_copies'] = $issued_copies + 1;

            $this->db->update('book', $data2, array('book_id' => $book_id));

            $this->session->set_flashdata('flash_message', get_phrase('request_accepted_successfully'));
            redirect(site_url('librarian/book'), 'refresh');
        }

        if ($param1 == "reject")
        {
            $data['status'] = 2;

            $this->db->update('book_request', $data, array('book_request_id' => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('request_rejected_successfully'));
            redirect(site_url('librarian/book_request'), 'refresh');
        }

        $data['page_name']  = 'book';
        $data['page_title'] = get_phrase('book_request');
        $this->load->view('backend/index', $data);
    }
	
		
    // RFID Book SEARCH
    public function book_rfid_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('book_rfid', true);
       
        if ($name) {
            $query = $this->db->query("SELECT book_id,name,description,book_code,total_copies FROM book WHERE book_code=$name");
            
            $result = $query->result_array();       
            foreach ($result as $row) {   
			$book_id=$row['book_id'];
           echo'<div class="book-details" style="display: block;">
                            <div class="row">
                                <div class="col-sm-5">
                                    Book Name : 
                                </div>  
                                <div class="col-sm-7">
                                  '.$row['name'].'
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    Book Quantity :  
                                </div>  
                                <div class="col-sm-7">
                                  '.$row['total_copies'].'
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    Book Descrition :  
                                </div>  
                                <div class="col-sm-7">
                                   '.$row['description'].'
                                </div> 
                            </div>
                        </div>'; 
 }		  
        }
      }
   
	    // RFID Student SEARCH Details
    public function student_rfid_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('name_rfid', true);
       
        if ($name) {
			 $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");
            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
                $enroll_code = $row3['enroll_code'];
                $student_id = $row3['student_id'];
                $class_id   = $row3['class_id'];
                $section_id = $row3['section_id'];
                $card_code = $row3['card_code'];
             }
			
            $query = $this->db->query("SELECT student_id,name,phone,email FROM student WHERE student_id=$student_id");
            
            $result = $query->result_array();       
            foreach ($result as $row) {   
			$student_id=$row['student_id'];
      $url = $this->crud_model->get_image_url('student',$student_id);
      $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
      $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
             
                   echo' <div class="student-details">
                            <div class="row">
                                <img alt="image" id="student_img" class="img-responsive" src="'.$url.'">
                                <div class="col-sm-5">
                                    Student Name : 
                                </div>  
                                <div class="col-sm-7">
                                   '.$row['name'].'
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    Enroll ID :  
                                </div>  
                                <div class="col-sm-7">
                                '.$enroll_code.'
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    Class :  
                                </div>  
                                <div class="col-sm-7">
                                   '.$class_name.'  '.$section_name.'
                                </div> 
                            </div>
                        </div>';
         
    
       
 }		  
        }
      }
      }
	    // MANAGE BOOK REQUESTS
    function book_request_by_lib($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('librarian_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "create")
        {
            //$this->crud_model->create_book_request_by_lib();
            //$this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
            //redirect(site_url('librarian/dashboard/'), 'refresh');
		$book_rfid   = $this->input->post('book_rfid');
        $name_rfid   = $this->input->post('name_rfid');
        $return_to_date   = $this->input->post('return_to_date');
		if($book_rfid){
	     $query3  = $this->db->query("SELECT book_id FROM book WHERE book_code = $book_rfid  LIMIT 1");
            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
             $book_id = $row3['book_id'];              
             }
	$query3  = $this->db->query("SELECT student_id FROM enroll WHERE card_code = $name_rfid  LIMIT 1");
            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
                $student_id = $row3['student_id'];              
             }
        $data['book_id']            = $book_id;
        $data['user_id']            = $student_id;       
        $data['role_id']            = 5;
        $data['status']            = 1;

        $data['issue_start_date']   = strtotime("now");
		if($return_to_date==''){
        $data['issue_end_date']     = strtotime("+1 week");
		}else{
			$data['issue_end_date']     = strtotime($this->input->post('issue_start_date'));
		}
		 $query3  = $this->db->query("SELECT book_id, user_id FROM book_request WHERE book_id = $book_id AND status=1 AND user_id=$student_id");
            $result3 = $query3->result_array(); 		
            if(sizeof($result3) < 1){   
         $this->db->insert('book_request', $data);
		 $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
         redirect(site_url('librarian/dashboard/'), 'refresh');
               }
			$this->session->set_flashdata('error_message', get_phrase('you_are_not_eligible_for_this_book'));
          redirect(site_url('librarian/dashboard/'), 'refresh');
    }
	}
	}
			
        }

        $this->load->view('backend/index', $data);
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

           $result = $this->db->get_where('librarian', array('librarian_id'=>$this->session->userdata('login_user_id')))->row();
        
        
        $user_code = 'librarian_'.$result->librarian_id;
        $role_id   = $result->role_id;
        $user_id   = $result->librarian_id;
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
               redirect(site_url('librarian/leaves_past_record/'), 'refresh');
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

