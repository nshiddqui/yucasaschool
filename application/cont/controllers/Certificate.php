<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Generate.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Generate
 * @description     : Manage all type of system student listing.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Certificate extends MY_Controller {

    public $data = array();
      
   public function __construct() {
        parent::__construct();
                
        $this->load->model('Type_Model', 'type', true);
        $this->data['certificates'] = $this->type->get_list('certificates', array('status' => 1), '','', '', 'id', 'ASC'); 
        $this->data['class'] = $this->type->get_list('class', array('status' => 1), '','', '', 'class_id', 'ASC');
		
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
     * @description     : Load user filtering interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index(){
        
        
        //check_permission(VIEW);
        
        $this->data['students'] = '';       
         if ($_POST) {             
            $class_id = $this->input->post('class_id');
            $certificate_id = $this->input->post('certificate_id');
			$year=$this->type->running_year();
			//print_r($year);exit;
            $this->data['students'] = $this->type->get_student_list( $class_id,$year);
			//print_r($students);exit;
            $this->data['class_id'] = $class_id;
            $this->data['certificate_id'] = $certificate_id;
         }
		 
        $this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Certificates';
        $this->data['folder'] = 'certificate';
        $this->layout->title($this->lang->line('generate') .' ' . $this->lang->line('certificate') .' | ' . SMS);
        $this->load->view('backend/page', $this->data); 
    }

    
    /*****************Function generate**********************************
     * @type            : Function
     * @function name   : generate
     * @description     : Load certificate generete interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function generate($student_id, $class_id, $certificate_id){
        
        
        //check_permission(VIEW);
       	
        $this->data['settings'] = $this->type->get_single('settings', array('status'=>1),'','settings_id');
        $this->data['student'] = $this->type->get_student($student_id, $class_id);  
		
        $this->data['certificate'] = $this->type->get_single('certificates', array('id' => $certificate_id));
        $this->data['certificate']->main_text = get_formatted_certificate_text($this->data['certificate']->main_text,
		$this->data['student']->role_id, 
		$this->data['student']->student_id,
		$this->data['student']->birthday);
        
        //create_log('Has been generate a certificate for : '.$this->data['student']->name);   
        
        $this->layout->title($this->lang->line('generate') .' ' . $this->lang->line('certificate') .' | ' . SMS);
        //$this->load->view('certificate/generate', $this->data); 
		$this->data['page_name'] = 'generate';
		$this->data['page_title'] = 'Generate Certificates';
        $this->data['folder'] = 'certificate';
		$this->load->view('backend/page', $this->data); 
        
    }

    public function certificate_requests(){
		$this->data['all_certificates']  = $this->type->get_all_certificates();
		//print_r($this->data['all_certificates']);
        $this->layout->title($this->lang->line('certificate') .' ' . $this->lang->line('requests') .' | ' . SMS);
        $this->data['page_name'] = 'certificate_requests';
        $this->data['page_title'] = 'Certificates Requests';
        $this->data['folder'] = 'certificate';
		
        $this->load->view('backend/page', $this->data);
    }
	
	   function certificate_update_status(){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');

       $this->db->where('id',$this->input->post('id'));
       $this->db->update('apply_certificates',array('status'=>$this->input->post('status')));
       echo 1;
     }
     function certificate_detail($param = "",$param2 = ""){
        if ($this->session->userdata('admin_login') != 1)
          redirect(site_url('login'), 'refresh');
 
        if($param == "delete" && $param2 != ""){
         $this->db->where('id',$param2);
         $this->db->delete('apply_certificates');
         $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
         redirect(site_url('certificate/certificate_requests'));   
        }
	 }
}
