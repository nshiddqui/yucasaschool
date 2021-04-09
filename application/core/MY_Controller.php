<?php
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');


class My_Controller extends CI_Controller {

    public $year = '';
    public $first_class = '';
    public $gsms_setting = array();
    public $lang_path   = 'application/language/english/sms_lang.php';
    public $config_path = 'application/config/custom.php';
    
    function __construct() {
        parent::__construct();
        //if (!logged_in_user_id()) {
        //    redirect('welcome');
        //    exit;
        //  }
       $this->load->database();
       $academic_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row();
       if($academic_year){
        $this->year = $academic_year->description;
       }
        
       /*$gsms_setting = $this->db->get_where('settings',array('status'=>1))->row();
       if($gsms_setting){
           $this->gsms_setting = $gsms_setting;
           date_default_timezone_set($this->gsms_setting->default_time_zone);
       }*/
       // $this->config->load('custom');
      $this->first_class = $this->db->order_by('class_id','ASC')->get_where('class',array('status'=>1),1,0)->row()->class_id;
    date_default_timezone_set("Asia/Calcutta");
    }
    
   
    public function update_lang() {
        
        $data = array();
        $language = $this->db->get_where('settings', array('status'=>1))->row()->language; 
        $this->db->select("id, label, $language");
        $this->db->from('languages');        
        $this->db->order_by('id' , 'ASC');
        $languages = $this->db->get()->result(); 
        
        foreach($languages as $obj){
            $data[$obj->label] = $obj->$language;
        }        
        if (!is_array($data) && count($data) == 0) {
            return FALSE;
        }

        @chmod($this->lang_path, FILE_WRITE_MODE);

        // Is the config file writable?
        if (!is_really_writable($this->lang_path)) {
            show_error($this->lang_path . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        } 
        // Read the config file as PHP
        require $this->lang_path;  

        // load the file helper
        $this->CI = & get_instance();
        $this->CI->load->helper('file');

        // Read the config data as a string
        //$lang_file = read_file($this->lang_path);
        // Trim it
        //$lang_file = trim($lang_file);

        $lang_file = '<?php ';

        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                //$pattern = '/\$lang\[\\\'' . $key . '\\\'\]\s+=\s+[^\;]+/';  
                $lang_file .= "\n";
                //$lang_file .= "\$lang['$key'] = '".$val."';"; 
                $lang_file .= "\$lang['$key'] = ".'"'.$val.'";';    
                //$config_file = preg_replace($pattern, $replace, $config_file);
            }
        }
        
        if (!$fp = fopen($this->lang_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return FALSE;
        }
        
        flock($fp, LOCK_EX);
        fwrite($fp, $lang_file, strlen($lang_file));
        flock($fp, LOCK_UN);
        fclose($fp);

        
        @chmod($this->lang_path, FILE_READ_MODE);
  
        return TRUE;
    }
    
    public function update_config() {

        $data = array();

        $this->db->select('P.*, M.module_slug, O.operation_slug');
        $this->db->from('privileges AS P');
        $this->db->join('operations AS O', 'O.id = P.operation_id', 'left');
        $this->db->join('modules AS M', 'M.id = O.module_id', 'left');
        $results = $this->db->get()->result();
        foreach ($results as $obj) {
            // $data[][$obj->operation_slug][$obj->role_id] = $obj->is_add .'|'.$obj->is_edit.'|'.$obj->is_view.'|'.$obj->is_delete;
            $data[] = $obj;
        }
        if (!is_array($data) && count($data) == 0) {
            return FALSE;
        }

        @chmod($this->config_path, FILE_WRITE_MODE);

        // Is the config file writable?
        if (!is_really_writable($this->config_path)) {
            show_error($this->config_path . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        }
        // Read the config file as PHP
        require $this->config_path;

        // load the file helper
        $this->CI = & get_instance();
        $this->CI->load->helper('file');

        // Read the config data as a string
        //$lang_file = read_file($this->lang_path);
        // Trim it
        //$lang_file = trim($lang_file);

        $config_file = '<?php ';

        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                //$pattern = '/\$lang\[\\\'' . $key . '\\\'\]\s+=\s+[^\;]+/';  
                $config_file .= "\n";
                $config_file .= "\$config['my_$val->module_slug']['$val->operation_slug']['$val->role_id'] = '" . $val->is_add . "|" . $val->is_edit . "|" . $val->is_view . "|" . $val->is_delete . "';";
                //$config_file = preg_replace($pattern, $replace, $config_file);
            }
        }

        if (!$fp = fopen($this->config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return FALSE;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $config_file, strlen($config_file));
        flock($fp, LOCK_UN);
        fclose($fp);


        @chmod($this->config_path, FILE_READ_MODE);

        return TRUE;
    }
    
    function add_notification($sender_user,$sender_role,$send_to="",$send_role,$msg,$title,$url){
       $data['year']           = $this->year;
       $data['create_at']      = date("Y-m-d H:i:s"); 
       $data['title']          = $title;
       $data['msg']            = $msg; 
       $data['create_by_role'] = $sender_role;
       $data['create_user_id'] = $sender_user; 
       $data['send_to']        = $send_to; 
       
       if($send_to == ""){
         $decodedata = json_decode($send_role);
         $url = json_decode($url);
         $i   = 0;
            foreach ($decodedata as  $dt) {
               // $this->notification_by_role($dt);
                $data['send_to_role']   = $dt;
                $data['url_link']       = $url[$i];
                $this->db->insert('notification_alert',$data);
                $i++;
            } 
        }else{
                $data['url_link']       = $url;
               // $this->notification_by_role($send_role);
                $data['send_to_role'] = $send_role;
                $this->db->insert('notification_alert',$data);
        }
       

    }


    function notification_by_role($dt){
       // echo $dt;
        if($dt == TEACHER)
          $this->crud_model->read_notification_status('teacher',1);
         // echo $dt;

        if($dt == SUPER_ADMIN)
         $this->crud_model->read_notification_status('admin',1);

     die;
    }


     function send_sms(){
       $message    = $this->input->post('message');
       $reciever    = $this->input->post('reciever');
       $multiuser_phone    = $this->input->post('multiuser_phone');
       $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $reciever = explode('-', $reciever);
        $reciever_type = $reciever[0];
        $reciever_id = $reciever[1];

       if(ucfirst($reciever_type) ==  "Student"){
       
       $phone_number_user  = $this->db->get_where('student', array('student_id' => $reciever_id))->row()->phone;
       } elseif(ucfirst($reciever_type) == "Teacher") {
        $phone_number_user  = $this->db->get_where('teacher', array('teacher_id' => $reciever_id))->row()->phone;

       } else {
        $phone_number_user  = $this->db->get_where('parent', array('parent_id' => $reciever_id))->row()->phone;

       }

       $data['user']        = "102065";
       $data['key']    = "010Z32kV408mgwWnrybq"; 
      if(empty($multiuser_phone)){
       $data['mobile']      = $phone_number_user;
       }else {
       $data['mobile']      = $multiuser_phone;
       }
       $data['sender']         = "SCHPAL"; 
       $data['text'] = $message;
     //  $data['fl'] = "0"; 

       foreach($data as $key=>$value) { 
        $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

         $url = "http://www.nimbusit.info/api/pushsms.php/";
        $custom_url = $url."?".$fields_string;
       $custom_url = substr($custom_url, 0, -1);

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => false,
            CURLOPT_POSTFIELDS => $fields_string
                //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

       //get response
        $output = curl_exec($ch);
                
        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

         }

   
}
