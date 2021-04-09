<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    // insert new data

    function insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);

        return $this->db->insert_id();
    }

    // insert new data

    function insert_batch($table_name, $data_array) {

        $this->db->insert_batch($table_name, $data_array);

        return $this->db->insert_id();
    }

    // update data by index

    function update($table_name, $data_array, $index_array) {

        $this->db->update($table_name, $data_array, $index_array);

        return $this->db->affected_rows();
    }

    // delete data by index

    function delete($table_name, $index_array) {
        $this->db->delete($table_name, $index_array);

        return $this->db->affected_rows();
    }

    public function get_list($table_name, $index_array, $columns = null, $limit = null, $offset = 0, $order_field = null, $order_type = null) {

        if ($columns)
            $this->db->select($columns);

        if ($limit)
            $this->db->limit($limit, $offset);

        if ($order_type) {
            $this->db->order_by($order_field, $order_type);
        } else {
            $this->db->order_by('id', 'DESC');
        }

        return $this->db->get_where($table_name, $index_array)->result();
    }

    // get data list by index order

    function get_list_order($table_name, $index_array, $order_array, $limit = null) {

        if ($limit) {

            $this->db->limit($limit);
        }

        if ($order_array) {

            $this->db->order_by($order_array['by'], $order_array['type']);
        } else {

            $this->db->order_by('created', 'desc');
        }

        return $this->db->get_where($table_name, $index_array)->result();
    }

    // get single data by index

    function get_single($table_name, $index_array, $columns = null,$idval = null) {
        if($idval != '')
           $id = $idval;
        else
           $id = 'id';


        if ($columns)
         $this->db->select($columns);
         $this->db->order_by($id, 'desc');
         $this->db->limit(1);
         $row = $this->db->get_where($table_name, $index_array)->row();

        return $row;
    }
    
    function get_single_student($table_name, $index_array, $columns = null) {

        if ($columns)
            $this->db->select($columns);

        $this->db->order_by('student_id', 'desc');
        $this->db->limit(1);

        $row = $this->db->get_where($table_name, $index_array)->row();

        return $row;
    }

    function get_single_random($table_name, $index_array, $columns = null) {

        if ($columns)
            $this->db->select($columns);

        $this->db->order_by('rand()');
        $this->db->limit(1);
        $row = $this->db->get_where($table_name, $index_array)->row();
        return $row;
    }

    // get number of rows in database

    function count_all($table_name, $index_array = null) {

        if ($index_array) {
            $this->db->where($index_array);
        }
        return $this->db->count_all_results($table_name);
    }

    // get data with paging

    function get_paged_list($table_name, $index_array, $url, $segment, $offset = 0, $order_by = null) {

        $result = array('rows' => array(), 'total_rows' => 0);



        $this->load->library('pagination');



        $limit = $this->config->item('admin_per_page');



        $this->db->where($index_array);



        $this->db->order_by('id', 'desc');


        /* if($order_by){
          $this->db->order_by('sort_order', 'ASC');
          }else{
          $this->db->order_by('modified', 'desc');
          } */


        $result['rows'] = $this->db->get($table_name, $limit, $offset)->result();


        $this->db->where($index_array);

        $result['total_rows'] = $total_rows = $this->db->count_all_results($table_name);


        $config['uri_segment'] = $segment;

        $config['base_url'] = site_url() . $url;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $this->config->item('admin_per_page');



        $this->pagination->initialize($config);

        $result['pagination'] = $this->pagination->create_links();



        return $result;
    }

// get data with paging

    function get_paged_list_order($table_name, $index_array, $order_array, $limit = 10, $offset = 0) {

        $result = array('rows' => array(), 'total_rows' => 0);



        if ($order_array) {

            $this->db->order_by($order_array['by'], $order_array['type']);
        } else {

            $this->db->order_by('created', 'desc');
        }



        $this->db->where($index_array);

        $result['rows'] = $this->db->get($table_name, $limit, $offset)->result();



        $this->db->where($index_array);

        $result['total_rows'] = $this->db->count_all_results($table_name);



        return $result;
    }

    public function send_email($mail_info) {



        $this->load->library('email');



        $config['mailtype'] = 'html';

        $config['charset'] = 'iso-8859-1';

        $config['wordwrap'] = TRUE;



        $this->email->initialize($config);



        $from = $mail_info['from'] ? $mail_info['from'] : '';

        $from_name = $mail_info['from_name'] ? $mail_info['from_name'] : '';

        $to = $mail_info['to'] ? $mail_info['to'] : 'yousuf361@gmail.com';

        $cc = $mail_info['cc'] ? $mail_info['cc'] : '';

        $bcc = $mail_info['bcc'] ? $mail_info['bcc'] : '';

        $subject = $mail_info['subject'] ? $mail_info['subject'] : '';

        $message = $mail_info['message'] ? $mail_info['message'] : '';



        $this->email->from($from, $from_name);

        $this->email->to($to);

        $this->email->cc($cc);

        $this->email->bcc($bcc);

        $this->email->subject($subject);

        $this->email->message($message);



        return ($this->email->send()) ? TRUE : FALSE;



        //echo $this->email->print
    }

    // get single data by index

    function get_single_order($table_name, $index_array, $order_array, $columns = null) {

        if ($columns)
            $this->db->select($columns);

        $this->db->limit(1);

        if ($order_array) {

            $this->db->order_by($order_array['by'], $order_array['type']);
        } else {

            $this->db->order_by('created', 'desc');
        }

        $row = $this->db->get_where($table_name, $index_array)->row();

        return $row;
    }


    public function get_table_fields($table) {

        return $this->db->list_fields($table);
    }
    
    public function create_user(){
        
        $data = array();
        $data['role_id']    = $this->input->post('role_id');
        $data['password']   = sha1($this->input->post('password'));
        $data['temp_password'] = base64_encode($this->input->post('password'));
        $data['email']      = $this->input->post('email');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        $data['status']     = 1; // by default would not be able to login
        $this->db->insert('designation_users', $data);
        return $this->db->insert_id();
    }

     public function create_user_guardian(){
        
        $data = array();
        $data['role_id']    = $this->input->post('role_id');
        $data['password']   = sha1($this->input->post('password'));
        $data['temp_password'] = base64_encode($this->input->post('password'));
        $data['email']      = $this->input->post('email');
        $data['year']       = $this->running_year();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        $data['status']     = 1; // by default would not be able to login
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    
    public function create_log($activity = null){
        print_r($this->session->userdata());die;
        $data = array();
        $data['user_id']    = logged_in_user_id();
        $data['role_id']    = logged_in_role_id();
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['activity']   = $activity;
        $data['status']     = 1; 
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        //$this->db->insert('activity_logs', $data);       
    }
    
   public function get_custom_id($table, $prefix)
   {
      $max_id = '';
      $this->db->select_max('id');
      $max_id = $this->db->get($table)->row()->id;
      
      if(isset($max_id) && $max_id > 0)
      {
        $max_id = $max_id+1;
      }else{
          $max_id = 1;
      }
      
      if(!$max_id){
        $max_id = '0000'.$max_id;
      }elseif($max_id > 0 && $max_id < 10){
          $max_id = '0000'.$max_id;      
      }elseif($max_id >= 10 && $max_id < 100){
          $max_id = '000'.$max_id;
      }elseif($max_id >= 100 && $max_id < 1000){
          $max_id = '00'.$max_id;
      }elseif($max_id >= 1000 && $max_id < 10000){
          $max_id = '0'.$max_id;
      }else{
          $max_id = $max_id;
      }      
      return $prefix.$max_id;
   }    
    
    function running_year(){
        $academic_year = $this->db->get_where('settings', array('type'=>'running_year'))->row();
        if($academic_year){
          return  $running_year = $academic_year->description;
        }
    }
    function running_year_id(){
        $academic_year = $this->db->get_where('settings', array('type'=>'running_year'))->row();
        if($academic_year){
          return  $running_year = $academic_year->settings_id;
        }
    }

   
}

?>