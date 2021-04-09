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
class temp_controller extends CI_Controller
{
	function __construct()
		{
			parent::__construct();
			$this->load->database();
	        $this->load->library('session');
	        $this->load->model('Barcode_model');
	        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
	        $this->otherdb = $this->load->database('otherdb', TRUE); 

	       /*cache control*/
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');

	    }


	     public function index()
		    {
		       

		        if ($this->session->userdata('admin_login') != 1)
		            redirect(site_url('login'), 'refresh');
		        if ($this->session->userdata('admin_login') == 1)
		            redirect(site_url('admin/dashboard'), 'refresh');
		    }


		// bulk parent_add using CSV
	    function generate_bulk_parent_csv($class_id = '', $section_id = '')
	    {
	        if ($this->session->userdata('admin_login') != 1)
	            redirect(site_url('login'), 'refresh');

	        $data['class_id']   = $class_id;
	        $data['section_id'] = $section_id;
	        $data['year']       = $this->db->get_where('settings', array('type'=>'running_year'))->row()->description;

	        $file   = fopen("uploads/parent_bulk.csv", "w");
	        $line   = array('ParentName', 'Email', 'Password', 'Phone', 'Address', 'Profession');
	        fputcsv($file, $line, ',');
	        echo $file_path = base_url() . 'uploads/parent_bulk.csv';
	    }

	
	    function bulk_parent_add_using_csv($param1 = '') {

	        if ($this->session->userdata('admin_login') != 1)
	            redirect(site_url('login'), 'refresh');

	       	if ($param1 == 'import') {
	         	if ($this->input->post('class_id') != '' && $this->input->post('section_id') != '') {
	              move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/bulk_parent.csv');
	              $csv = array_map('str_getcsv', file('uploads/bulk_parent.csv'));
	              $count = 1;
	              $array_size = sizeof($csv);

	             	foreach ($csv as $row) {
	                  if ($count == 1) {
	                      $count++;
	                      continue;
	                }
	                  $password = $row[3];
	                  $data['name']      = $row[0];
	                  $data['email']     = $row[2];
	                  $data['password']  = sha1($row[3]);
	                  $data['phone']     = $row[4];
	                  $data['address']   = $row[5];
	                  $data['profession'] = $row[6];
	                  

	                 //student id (code) validation
	                 $code_validation = parent_email_validation($data['email']);
	                 if(!$code_validation){
	                     $this->session->set_flashdata('error_message' , get_phrase('this_id_no_is_not_available'));
	                     redirect(site_url('admin/parent'), 'refresh');
	                 }
	                 //student id validation ends

	                  $validation = email_validation($data['email']);
	                  if ($validation == 1) {
	                    $this->db->insert('parent', $data);
	                  }
	                  else{
	                    if ($array_size == 2) {
	                      $this->session->set_flashdata('error_message', get_phrase('this_email_id_"').$data['email'].get_phrase('"_is_not_available'));
	                      redirect(site_url('admin/parent_bulk_add'), 'refresh');
	                    }
	                    elseif($array_size > 2){
	                      $this->session->set_flashdata('error_message', get_phrase('some_email_IDs_are_not_available'));
	                    }
	                  }

	              }


	              $this->session->set_flashdata('flash_message', get_phrase('student_imported'));
	              redirect(site_url('admin/parent_bulk_add'), 'refresh');
	           }
	           else{
	             $this->session->set_flashdata('error_message', get_phrase('please_make_sure_class_and_section_is_selected'));
	             redirect(site_url('admin/parent_bulk_add'), 'refresh');
	           }
	        }
	        $page_data['page_name']  = 'student_bulk_add';
	        $page_data['page_title'] = get_phrase('add_bulk_parent');
	        $this->load->view('backend/index', $page_data);
	    }

		
		
		// bulk parent_add using CSV
	    function generate_bulk_book_csvsss($class_id = '', $section_id = '')
	    {
	        if ($this->session->userdata('admin_login') != 1)
	            redirect(site_url('login'), 'refresh');

	        $data['class_id']   = $class_id;
	        $data['section_id'] = $section_id;
	        $data['year']       = $this->db->get_where('settings', array('type'=>'running_year'))->row()->description;

	        $file   = fopen("uploads/library_book_bulk.csv", "w");
	        $line   = array('BookName','BookCode', 'Description', 'Author', 'Class', 'Price', 'TotalBook');
	        fputcsv($file, $line, ',');
	        echo $file_path = base_url() . 'uploads/library_book_bulk.csv';
	    }

		
		
		
		
	function bulk_book_add_using_csv($param1 = '') {

	        if ($this->session->userdata('admin_login') != 1)
	            redirect(site_url('login'), 'refresh');

	       	if ($param1 == 'import') {
	         	if ($this->input->post('class_id') != '' && $this->input->post('section_id') != '') {
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
	                  

	                 //student id (code) validation
	                 $code_validation = parent_email_validation($data['email']);
	                 if(!$code_validation){
	                     $this->session->set_flashdata('error_message' , get_phrase('this_id_no_is_not_available'));
	                     redirect(site_url('admin/books_bulk_add'), 'refresh');
	                 }
	                 //student id validation ends

	                  $validation = email_validation($data['email']);
	                  if ($validation == 1) {
	                    $this->db->insert('book', $data);
	                  }
	                  else{
	                    if ($array_size == 2) {
	                      $this->session->set_flashdata('error_message', get_phrase('this_email_id_"').$data['email'].get_phrase('"_is_not_available'));
	                      redirect(site_url('admin/books_bulk_add'), 'refresh');
	                    }
	                    elseif($array_size > 2){
	                      $this->session->set_flashdata('error_message', get_phrase('some_email_IDs_are_not_available'));
	                    }
	                  }

	              }


	              $this->session->set_flashdata('flash_message', get_phrase('student_imported'));
	              redirect(site_url('admin/books_bulk_add'), 'refresh');
	           }
	           else{
	             $this->session->set_flashdata('error_message', get_phrase('please_make_sure_class_and_section_is_selected'));
	             redirect(site_url('admin/books_bulk_add'), 'refresh');
	           }
	        }
	        $page_data['page_name']  = 'books_bulk_add';
	        $page_data['page_title'] = get_phrase('add_bulk_book');
	        $this->load->view('backend/index', $page_data);
	    }

		
		





}