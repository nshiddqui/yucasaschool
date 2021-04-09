<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Creativeitem
 *	date		: 14 september, 2017
 *	Ekattor School Management System Pro
 *	http://codecanyon.net/user/Creativeitem
 *	http://support.creativeitem.com
 */

class Home extends CI_Controller{

    public function __construct() {
     parent::__construct();
		$this->load->database();
        $this->load->library('session');  
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url','user_validation'));
        $this->load->model('Upload_Model');
		//$this->load->model('Email_model', 'email_model', true);
		
    }

         public function index(){
	if ($this->session->userdata('admin_user') != 1)
       redirect(site_url('login'), 'refresh');
      
		$page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = "Dashboard | Edurama";
        $this->load->view('page', $page_data);
	}


    public function packages_list(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['package_list'] = $this->Upload_Model->get_package_list();
        $page_data['page_name']  = 'packages_list';
        $page_data['page_title'] = "Packages List | Edurama";
        $this->load->view('page', $page_data);
    }

    public function packages_features(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['feature_list'] = $this->Upload_Model->get_feature_list();
        $page_data['page_name']  = 'packages_features';
        $page_data['page_title'] = "Packages List | Edurama";
        $this->load->view('page', $page_data);
    }

    public function package_infomation($package_id =""){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['package_id'] = $package_id;
        $page_data['package_data'] = $this->Upload_Model->get_single_package_data($package_id);
        $page_data['package_feature'] = $this->Upload_Model->get_single_package_features($package_id);
        $page_data['feature_list_not_in_package'] = $this->Upload_Model->get_feature_list_not_in_package($package_id);
        $page_data['page_name']  = 'package_infomation';
        $page_data['page_title'] = "Packages Infomation | Edurama";
        $this->load->view('page', $page_data);
    }

    public function school_list(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
            
        $page_data['school_list'] = $this->Upload_Model->get_school_data();   
        $page_data['page_name']  = 'school_list';
        $page_data['page_title'] = "School List | Edurama";
        $this->load->view('page', $page_data);
    }

    public function add_school(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
          
        $page_data['page_name']  = 'add_school';
        $page_data['page_title'] = "Add School | Edurama";
        $this->load->view('page', $page_data);
    }

    public function edit_school($school_id = ""){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'edit_school';
        $page_data['page_title'] = "Edit School | Edurama";
        $this->load->view('page', $page_data);
    }

    public function home_page_video(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['home_video_data'] = $this->Upload_Model->get_home_video_data();
        $page_data['page_name']  = 'home_page_video';
        $page_data['page_title'] = "Home Page Video | Edurama";
        $this->load->view('page', $page_data);
    }
    
    public function blog_list(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        
        $page_data['posts_list'] = $this->Upload_Model->get_posts_from_db();
        $page_data['page_name']  = 'blog_list';
        $page_data['page_title'] = "Edurama Blogs | Edurama";
        $this->load->view('page', $page_data);
    }

    public function add_post(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'add_post';
        $page_data['page_title'] = "Add Post | Edurama";
        $this->load->view('page', $page_data);
    }

    public function edit_post($post_id = ""){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['post_id'] = $post_id;
        $page_data['post_data'] = $this->Upload_Model->get_single_post_data($post_id);
        $page_data['page_name']  = 'edit_post';
        $page_data['page_title'] = "Edit Post | Edurama";
        $this->load->view('page', $page_data);
    }

    public function client_list(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['client_list'] = $this->Upload_Model->get_clients_from_db();
        $page_data['page_name']  = 'client_list';
        $page_data['page_title'] = "Edurama Clients | Edurama";
        $this->load->view('page', $page_data);
    }

    public function add_client(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'add_client';
        $page_data['page_title'] = "Add Clients | Edurama";
        $this->load->view('page', $page_data);
    }

    public function edit_client($client_id = ""){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['client_id'] = $client_id;
        $page_data['client_data'] = $this->Upload_Model->get_single_client_data($client_id);
        $page_data['page_name']  = 'edit_client';
        $page_data['page_title'] = "Edit Client | Edurama";
        $this->load->view('page', $page_data);
    }

    public function school_data(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
     
        $page_data['page_name']  = 'school_data';
        $page_data['page_title'] = "School Data | Edurama";
        $this->load->view('page', $page_data);
    }

    public function admin_list(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
		$page_data['admin_data'] = $this->Upload_Model->get_admin_user_data();
		
        $page_data['page_name']  = 'admin_list';
        $page_data['page_title'] = "Admin List | Edurama";
        $this->load->view('page', $page_data);
    }

    public function add_admin(){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        $page_data['page_name']  = 'add_members';
        $page_data['page_title'] = "Add Admin | Edurama";
        $this->load->view('page', $page_data);
    }

    public function admin_profile(){
		if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
		$page_data['client_datass'] = $this->Upload_Model->get_admin_profile_data();
        $page_data['page_name']  = 'admin_profile';
        $page_data['page_title'] = "Admin Profile | Edurama";
        $this->load->view('page', $page_data);
    }

    public function edit_admin($user_id){
        if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
	    $page_data['edit_admin_data'] = $this->Upload_Model->get_single_admin_data($user_id);
	
        $page_data['page_name']  = 'edit_admin';
        $page_data['page_title'] = "Edit Admin Details | Edurama";
        $this->load->view('page', $page_data);
    }
	
    function add_new_admin($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'create') {
              $data['user_name']         = $this->input->post('user_name');
              $data['user_email']     = $this->input->post('user_email');
              $data['user_phone']        = $this->input->post('user_phone');
              $data['user_role']        = $this->input->post('user_role');
             $data['user_password']     = sha1($this->input->post('password'));       
            $validation = email_validation($data['user_email']);
            if($validation == 1) {
                
                $this->db->insert('user_login', $data);
                $admin_user_id = $this->db->insert_id();


                if(sizeof($_FILES) > 0)
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/admin_image/' . $admin_user_id . '.jpg');
                $this->email_model->account_opening_email('user_login', $data['user_email']);
				echo 'success';
            }
            else {
				
               $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('home/add_admin'), 'refresh');
        }
        
        if ($param1 == 'do_update') {
		
            $data['user_name']           = $this->input->post('user_name');
               $user_id       = $this->input->post('user_id');
            $data['user_email']          = $this->input->post('user_email');
            $data['user_phone']          = $this->input->post('user_phone');
            $data['user_role']          = $this->input->post('user_role');
           
           
                $this->db->where('user_id', $user_id);
                $this->db->update('user_login', $data);

                
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/admin_image/' . $user_id . '.jpg');
               // $this->crud_model->clear_cache();
                //$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
				 //redirect(site_url('home/admin_list/'), 'refresh');
          echo'success';
        }
    }

            function add_new_school_with_subdomain($param1 = '', $param2 = '', $param3 = '')
            {
            if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
            
            
            if ($param1 == 'create_school') {
            $data['school_name']   = $this->input->post('school_name');
            $school_name = $this->input->post('school_name');
            $school_name= strtolower($school_name);
            $slugname=str_replace(' ', '-', $school_name);
            $data['school_slug'] = str_replace(' ', '-', $school_name);
            $data['school_email']     = $this->input->post('school_email');
            $data['school_phone']        = $this->input->post('school_phone');
            $data['school_contact_persion']  = $this->input->post('school_contact_persion');
            $data['school_address']   = $this->input->post('school_address');
            $data['school_package']   = $this->input->post('school_package');
            $db_name=$this->input->post('db_name');
            $db_name= strtolower($db_name);
            $data['db_name']   = str_replace(' ', '-', $db_name);
            $db_user=$this->input->post('db_user');
            $db_user= strtolower($db_user);
            $data['db_user']   =  str_replace(' ', '-', $db_user);
            $data['db_password']  = $this->input->post('db_password');
            $password  = $this->input->post('db_password');
            $db_password_confirm  = $this->input->post('db_password_confirm');
            $member = $this->db->get_where('school_list', array('school_slug' => $slugname))->row();
            
            if (empty($member)) {
            if($password==$db_password_confirm){
            
            $validation = email_validation($data['school_email']);
            if($validation == 1) {
            
            $this->db->insert('school_list', $data);
            $school_id = $this->db->insert_id();
            
            
            if(sizeof($_FILES) > 0)
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/school_logo/' . $school_id . '.jpg');
            //$this->email_model->account_opening_email('user_login', $data['user_email']);
            echo 'success';
            
            if($school_id !=''){
            // domain name register here 				
            $cpanelsername ="ijyawebc";
            $cpanelpassword ="bishwa@123";
            $subdomain =$data['school_slug'];
            $domain = 'ijyaweb.com';
            $directory = "/public_html/$subdomain";
            $query = "https://$domain:2082/json-api/cpanel?cpanel_jsonapi_func=addsubdomain&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_version=2&domain=$subdomain&rootdomain=$domain&dir=$directory";
            $curl = curl_init();                                // Create Curl Object
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
            curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec
            $header[0] = "Authorization: Basic " . base64_encode("ijyawebc".":"."bishwa@123") . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
            curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
            $result = curl_exec($curl);
            
            if ($result == false) {
            error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");   
            }
                                
            curl_close($curl);
            
            $optsu='ijyawebc';
            $optsp='bishwa@123';
            require("xmlapi.php"); 
            $xmlapi = new xmlapi("ijyaweb.com");   
            $xmlapi->set_port( 2082 );   
            $xmlapi->password_auth($optsu,$optsp);    
            $xmlapi->set_debug(0);//output actions in the error log 1 for true and 0 false 
            
            $cpaneluser=$optsu;
            $databasename=$data['db_name'];
            $databaseuser=$data['db_user'];
            $databasepass=$password;
            
            //create database    
            $createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
            //create user 
            $usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
            //add user 
            
            $addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$databasename."", "".$databaseuser."", 'all'));
            
            $mysqlImportFilename ='dummy.sql';
            $mysqlHostName='localhost';
            //DONT EDIT BELOW THIS LINE
            //Export the database and output the status to the page
            $command='mysql -h' .$mysqlHostName .' -u' .$databaseuser .' -p' .$databasepass .' ' .$databasename .' < ' .$mysqlImportFilename;
            exec($command,$output=array(),$worked);
            switch($worked){
            case 0:
            echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$databasename .'</b>';
            break;
            case 1:
            echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
            break;
            }
            }				
            
            
            }
            else {
            
            echo 'error';
            }
            redirect(site_url('home/add_school'), 'refresh');
            }else{
            echo 'password_not_match'; 
            
            }
            } else{
            echo 'slug_name_or_school_name_alredy_exits';
            }
            }
            
            
            if ($param1 == 'do_update') {
            
            $data['user_name']           = $this->input->post('user_name');
            $user_id       = $this->input->post('user_id');
            $data['user_email']          = $this->input->post('user_email');
            $data['user_phone']          = $this->input->post('user_phone');
            $data['user_role']          = $this->input->post('user_role');
            
            
            $this->db->where('school_id', $user_id);
            $this->db->update('school_list', $data);
            
            
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/school_logo/' . $school_id . '.jpg');
            // $this->crud_model->clear_cache();
            //$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            //redirect(site_url('home/add_school/'), 'refresh');
            echo'success';
            }
            }


            function delete_school_subdomain()  { 
            $subdomainname=  $this->uri->segment(3);
            $cpanelsername ="damndr94";
            $cpanelpassword ="Bhu@hg1999_$";
            $subdomain =$subdomainname;
            $domain = 'digitalflares.com';
            $directory = "/public_html/$subdomain";  // A valid directory path, relative to the user's home directory. Or you can use "/$subdomain" depending on how you want to structure your directory tree for all the subdomains.
            
            $deletesub =  "https://$domain:2082/json-api/cpanel?cpanel_jsonapi_func=delsubdomain&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_version=2&domain=".$subdomain.'.'.$domain."&dir=$directory";  //Note: To delete the subdomain of an addon domain, separate the subdomain with an underscore (_) instead of a dot (.). For example, use the following format: subdomain_addondomain.tld
            
            $curl = curl_init();                                // Create Curl Object
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
            curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec
            $header[0] = "Authorization: Basic " . base64_encode("damndr94".":"."Bhu@hg1999_$") . "\n\r";
            
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
            curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
            
            $result = curl_exec($curl);
            
            if ($result == false) {
            error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");   
            // log error if curl exec fails
            }
            curl_close($curl);
            
            $this->db->where('school_slug', $subdomainname);
            $this->db->delete('school_list');
            
            redirect(site_url('home/school_list/'), 'refresh');
            
            }
            function update_all_records(){
            $query= $this->db->get_where('school_list', array('status' =>'1'))->result_array();
            foreach($query as $mydata){
            $slug_url= $mydata['school_slug'];
            $url = "https://digitalflares.com/$slug_url/Web_api/getStudentOwnDashboardData";
            $content = file_get_contents($url);
            $json_data = json_decode($content);
            foreach($json_data as $mydata){
            foreach($mydata as $mydata1){  
            
            }
            }
            echo sizeof($mydata);
            }
            
            }


            public function install_file_zip(){
            
            if ($this->session->userdata('admin_user') != 1)
            redirect(site_url('login'), 'refresh');
            $url="new.zip";
            
            $schoolname= $this->uri->segment(3);
            
            $school= "../../dav-school/";
            $zip = new ZipArchive;
            $res = $zip->open($url);
            
            if ($res === TRUE) {
            $zip->extractTo($school);
            
            $zip->close();
            echo 'woot!';
            } else {
            echo 'doh!';
            }
            exit;  
            $page_data['edit_admin_data'] = $this->Upload_Model->get_single_admin_data($user_id);
            
            $page_data['page_name']  = 'edit_admin';
            $page_data['page_title'] = "Edit Admin Details | Edurama";
            $this->load->view('page', $page_data);
            }
           public function update_file_zip_status(){ 
               
                $school_slug= $this->uri->segment(3);
               $data['install_status']=1;
            if($school_slug !=''){
                $this->db->where('school_slug', $school_slug);
                $this->db->update('school_list', $data);
                echo'hello';
           }
           }  
           
           public function  upload_apk(){
               if($this->input->post('version')){
                    $app_name = 'apk-'.$this->input->post('version').'.apk';
                    if($this->updateAPK($this->input->post('version'),$app_name)){
                        $data = array(
                           'version' => $this->input->post('version'),
                           'path' => 'uploads/school_logo/'.$this->input->post('version'),
                           'force_download' => $this->input->post('force')
                        );
                        $this->db->insert('app', $data);
                        $app_id = $this->db->insert_id();
                        if($app_id){
                            $this->session->set_flashdata('flash_message' , 'Data Uploaded');
                            redirect(site_url('home/upload_apk'), 'refresh');
                        }else {
                            if(file_exists($_SERVER['DOCUMENT_ROOT'].'uploads/school_logo/' . $app_name . '.apk')){
                                unlink($_SERVER['DOCUMENT_ROOT'].'uploads/school_logo/' . $app_name . '.apk');
                            }
                            $this->session->set_flashdata('error_message' , 'Data Not Uploaded');
                        }
                   }else {
                       $this->session->set_flashdata('error_message' , 'Extension Not Allowed');
                   }
               }
                $page_data['page_name']  = 'upload_apk';
                $page_data['page_title'] = "Upload Apk | Edurama";
                $this->load->view('page', $page_data);
           }
           
           protected function updateAPK($id,$name){
               $temp = $_FILES["file"]["tmp_name"];
               $extension = array("application/octet-stream","application/vnd.android.package-archive");
               $DIR = __DIR__."\\..\\android\\{$id}\\";
            
                // apk format validation
                if(in_array($_FILES["file"]["type"],$extension )){
            
                    //create directory if not exist
                    if (!file_exists($DIR)) {
                        mkdir($DIR, 0777, true);
                    }
            
                    if(move_uploaded_file($temp,$DIR."\\{$name}")){
                        return true;
                    }
                }
                return false;
            }

}

