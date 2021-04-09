<?php
error_reporting(0);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type = '', $type_id = '', $field = 'name') {
        if ($type_id != null && $type_id != 0){
            return $this->db->get_where($type, array($type.'_id' => $type_id))->row()->$field;
        }

    }
    
    

    ////////STUDENT/////////////
    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

    function get_student_info_by_id($student_id) {
        
        $query = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        return $query;
    }

    /////////TEACHER/////////////
    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    //////////SUBJECT/////////////
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    ////////////CLASS///////////
    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    //////////EXAMS/////////////
    function get_exams() {
        $query = $this->db->get_where('exam' , array(
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ));
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    //////////GRADES/////////////
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks( $exam_id , $class_id , $subject_id , $student_id) {
        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $subject_id,
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();

        foreach ($marks as $row) {
            echo $row['mark_obtained'];
        }
    }
    function get_lowest_marks( $exam_id , $class_id , $subject_id , $student_id) {
        $this->db->where('exam_id' , $exam_id);
        $this->db->where('class_id' , $class_id);
        $this->db->where('subject_id' , $subject_id);
        $this->db->select_min('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }
    function get_highest_marks( $exam_id , $class_id , $subject_id ) {

        $this->db->where('exam_id' , $exam_id);
        $this->db->where('class_id' , $class_id);
        $this->db->where('subject_id' , $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_highest_marks_mobile( $exam_id , $class_id , $subject_id ) {
        
        $this->db->where('exam_id' , $exam_id);
        $this->db->where('class_id' , $class_id);
        $this->db->where('subject_id' , $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach($highest_marks as $row) {
            return $row['mark_obtained'];
        }
    }


    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => base_url().'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = ''){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url('uploads/' . $type . '_image/' . $id . '.jpg');
        else
            $image_url = base_url('uploads/user.jpg');

        return $image_url;
    }
    function get_image_url_emp($type = '', $id = ''){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url('uploads/' . $type . '_image/' . $id . '.jpg');
        else
            $image_url = base_url('uploads/user.jpg');

        return $image_url;
    }

    ////////STUDY MATERIAL//////////
    function save_study_material_info()
    {

        $sectionval = $this->input->post('section_id');
        $section_arr= array();
        foreach ($sectionval as $key => $dt) {
             $section_arr[] = $dt;
        }
        $section_implode =  implode(',', $section_arr);

        $data['timestamp']    = strtotime($this->input->post('timestamp'));
        $data['title'] 		  = $this->input->post('title');
        $data['teacher_id']   = $this->session->userdata('teacher_id');
        $data['section_id']   = $section_implode;
        $data['description']  = $this->input->post('description');
        $data['file_name'] 	  = $_FILES["file_name"]["name"];
        $data['file_type']    = $this->input->post('file_type');
        $data['class_id'] 	  = $this->input->post('class_id');
        $data['subject_id']   = $this->input->post('subject_id');
        $this->db->insert('document',$data);

        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }

    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document')->result_array();
    }
    //selecting study material info for specific teacher

    function select_study_material_info_for_teacher()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document',array('teacher_id'=>$this->session->userdata('teacher_id')))->result_array();
    }

    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->row()->class_id;
             $section_id   = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->row()->section_id;
      
    
     return $this->db->query("SELECT * FROM `document` WHERE class_id='$class_id' AND  `section_id` IN ($section_id)")->result_array();
     
        //return $this->db->get_where('documents', array('class_id' => $class_id))->result_array();
    }

    function update_study_material_info($document_id)
    {
         $sectionval = $this->input->post('section_id');
        $section_arr= array();
        foreach ($sectionval as $key => $dt) {
             $section_arr[] = $dt;
        }
        $section_implode =  implode(',', $section_arr);

        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		    = $this->input->post('title');
        $data['section_id']     = $section_implode;
        $data['description']    = $this->input->post('description');
        $data['class_id'] 	    = $this->input->post('class_id');
        $data['subject_id']     = $this->input->post('subject_id');
        $this->db->where('document_id',$document_id);
        $this->db->update('document',$data);
    }

    function delete_study_material_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }

    ////////private message//////
    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('user_type').'-'.$this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code    = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['reciever']               = $reciever;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
//        $this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $reciever    = $this->input->post('reciever');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['reciever']               = $reciever;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function send_reply_group_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }
        $data_message['group_message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('group_message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
  
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    // QUESTION PAPER
    function create_question_paper()
    {
        $data['title']          = $this->input->post('title');
        $data['password']       = $this->input->post('password');
        $data['class_id']       = $this->input->post('class_id');
        $data['subject_id']       = $this->input->post('subject_id');
        $data['exam_id']        = $this->input->post('exam_id');
        $data['question_paper'] = $this->input->post('question_paper');
        $data['teacher_id']     = $this->session->userdata('login_user_id');
        $this->db->insert('question_paper', $data);
    }

    function update_question_paper($question_paper_id = '')
    {
        $data['title']          = $this->input->post('title');
        $data['password']       = $this->input->post('password');
        $data['class_id']       = $this->input->post('class_id');
        $data['subject_id']     = $this->input->post('subject_id');
        $data['exam_id']        = $this->input->post('exam_id');
        $data['question_paper'] = $this->input->post('question_paper');
        $this->db->update('question_paper', $data, array('question_paper_id' => $question_paper_id));
    }

    function delete_question_paper($question_paper_id = '')
    {
        $this->db->where('question_paper_id', $question_paper_id);
        $this->db->delete('question_paper');
    }

    // BOOK REQUEST
    function create_book_request()
    {
        $data['book_id']            = $this->input->post('book_id');
        $data['user_id']            = $this->session->userdata('login_user_id');
        $data['role_id']            = $this->session->userdata('role_id');

        $data['issue_start_date']   = strtotime($this->input->post('issue_start_date'));
        $data['issue_end_date']     = strtotime($this->input->post('issue_end_date'));

        $this->db->insert('book_request', $data);
    }
	
	   function create_book_request_by_lib()
    {
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
               }
    }
	}
	}
	}
    function curl_request($code = '') {

        $product_code = $code;

        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
        $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . $personal_token;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$product_code.'.json';
        $ch_verify = curl_init( $verify_url . '?code=' . $product_code );

        curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec( $ch_verify );
        curl_close( $ch_verify );

        $response = json_decode($cinit_verify_data, true);

        if (count($response['verify-purchase']) > 0) {
            return true;
        } else {
            return false;
        }

  	}


    function delete_student($student_id) {
      // deleting data of student from all associated tables
      $tables = array('student', 'attendance', 'enroll', 'invoice', 'mark');
      $this->db->delete($tables, array('student_id' => $student_id));
      // deleting data from messages
      $threads = $this->db->get('message_thread')->result_array();
      if (count($threads) > 0) {
        foreach ($threads as $row) {
          $sender = explode('-', $row['sender']);
          $receiver = explode('-', $row['reciever']);
          if (($sender[0] == 'student' && $sender[1] == $student_id) || ($receiver[0] == 'student' && $receiver[1] == $student_id)) {
            $thread_code = $row['message_thread_code'];
            $this->db->delete('message', array('message_thread_code' => $thread_code));
            $this->db->delete('message_thread', array('message_thread_code' => $thread_code));
          }
        }
      }
    }
    
    function delete_pre_student($student_id) {
      // deleting data of student from all associated tables
      $tables = array('pre_student');
      $this->db->delete('pre_enroll', array('student_id' => $student_id));
      $this->db->delete($tables, array('pre_student_id' => $student_id));
      // deleting data from messages
     /* $threads = $this->db->get('message_thread')->result_array();
      if (count($threads) > 0) {
        foreach ($threads as $row) {
          $sender   = explode('-', $row['sender']);
          $receiver = explode('-', $row['reciever']);
          if (($sender[0] == 'student' && $sender[1] == $student_id) || ($receiver[0] == 'student' && $receiver[1] == $student_id)) {
            $thread_code = $row['message_thread_code'];
            $this->db->delete('message', array('message_thread_code' => $thread_code));
            $this->db->delete('message_thread', array('message_thread_code' => $thread_code));
          }
        }
      }*/
    }

    
    // Group messaging portion
    function create_group(){
      $data = array();
      $data['group_message_thread_code'] = substr(md5(rand(100000000, 20000000000)), 0, 15);
      $data['created_timestamp'] = strtotime(date("Y-m-d H:i:s"));
      $data['group_name'] = $this->input->post('group_name');
      $group_name = $this->input->post('group_name');
	    
                        
           
      if(!empty($_POST['user'])) {
          array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('admin_id'));
          $data['members'] = json_encode($_POST['user']);
      }
      else{
        $_POST['user'] = array();
        array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('admin_id'));
        $data['members'] = json_encode($_POST['user']);
      }
      $this->db->insert('group_message_thread', $data);
      redirect(site_url('admin/group_message'), 'refresh');
	
    }
    // Group messaging portion
    function update_group($thread_code = ""){
      $data = array();
      $data['group_name'] = $this->input->post('group_name');
      if(!empty($_POST['user'])) {
          array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('admin_id'));
          $data['members'] = json_encode($_POST['user']);
      }
      else{
        $_POST['user'] = array();
        array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('admin_id'));
        $data['members'] = json_encode($_POST['user']);
      }
      $this->db->where('group_message_thread_code', $thread_code);
      $this->db->update('group_message_thread', $data);
        redirect(site_url('admin/group_message'), 'refresh');
    }

    function get_settings($type)
    {
        $des = $this->db->get_where('settings', array('type' => $type))->row()->description;
        return $des;
    }

    function update_payumoney_keys(){
      $data['description'] = $this->input->post('payumoney_merchant_key');
      $this->db->where('type' , 'payumoney_merchant_key');
      $this->db->update('settings' , $data);

      $data['description'] = $this->input->post('payumoney_salt_id');
      $this->db->where('type' , 'payumoney_salt_id');
      $this->db->update('settings' , $data);
    }

    // update paypal keys
    function update_paypal_keys() {
        $info = array();

        $paypal['active'] = $this->input->post('paypal_active');
        $paypal['mode'] = $this->input->post('paypal_mode');
        $paypal['sandbox_client_id'] = $this->input->post('sandbox_client_id');
        $paypal['production_client_id'] = $this->input->post('production_client_id');

        array_push($info, $paypal);

        $data['description']    =   json_encode($info);
        $this->db->where('type', 'paypal');
        $this->db->update('settings', $data);
    }

    // update stripe keys
    function update_stripe_keys() {
        $info = array();

        $stripe['active'] = $this->input->post('stripe_active');
        $stripe['testmode'] = $this->input->post('testmode');
        $stripe['public_key'] = $this->input->post('public_key');
        $stripe['secret_key'] = $this->input->post('secret_key');
        $stripe['public_live_key'] = $this->input->post('public_live_key');
        $stripe['secret_live_key'] = $this->input->post('secret_live_key');

        array_push($info, $stripe);

        $data['description']    =   json_encode($info);
        $this->db->where('type', 'stripe_keys');
        $this->db->update('settings', $data);
    }


    function create_online_exam($table =FALSE){
        $data['code']       = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title']      = $this->input->post('exam_title');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction']= $this->input->post('instruction');
        $data['exam_date']  = strtotime($this->input->post('exam_date'));
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end']   = $this->input->post('time_end');
        $data['duration']   = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);
        $data['running_year'] = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

        /*print_r($data);
        echo '<br/>';
        echo gmdate("H:i:s", '18305');
        die();*/
        if($table != "")
           $this->db->insert($table, $data);
        else
           $this->db->insert('online_exam', $data);  
    }

    function update_online_exam($table =FALSE){

        $data['title'] = $this->input->post('exam_title');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction'] = $this->input->post('instruction');
        $data['exam_date'] = strtotime($this->input->post('exam_date'));
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end'] = $this->input->post('time_end');
        $data['duration'] = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);

        $this->db->where('online_exam_id', $this->input->post('online_exam_id'));
        if($table != "")
         $this->db->update($table, $data);
        else
         $this->db->update('online_exam', $data);   
    }

    // multiple_choice_question crud functions
    function add_multiple_choice_question_to_online_exam($online_exam_id,$table_question_bank = ""){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode(array_map('htmlspecialchars',$this->input->post('options')));
        $data['correct_answers']    = json_encode($correct_answers);

        if($table_question_bank == "pre_question_bank")
            $this->db->insert('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
            $this->db->insert('scholarship_question_bank', $data);
        else
            $this->db->insert('question_bank', $data);

        $this->session->set_flashdata('flash_message' , get_phrase('question_added'));
    }

    function update_multiple_choice_question($question_id,$table_question_bank = ""){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }

        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }

        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['options']            = json_encode(array_map('htmlspecialchars',$this->input->post('options')));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->where('question_bank_id', $question_id);
        
        if($table_question_bank == "pre_question_bank")
            $this->db->update('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
           $this->db->update('scholarship_question_bank', $data);
        else
            $this->db->update('question_bank', $data);

      
        $this->session->set_flashdata('flash_message' , get_phrase('question_updated'));
    }

    // true false questions crud functions
    function add_true_false_question_to_online_exam($online_exam_id,$table_question_bank = ""){
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['type']               = 'true_false';
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = $this->input->post('true_false_answer');
        if($table_question_bank == "pre_question_bank")
            $this->db->insert('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
           $this->db->insert('scholarship_question_bank', $data);
        else
            $this->db->insert('question_bank', $data);
       
        $this->session->set_flashdata('flash_message' , get_phrase('question_added'));
    }

    function update_true_false_question($question_id,$table_question_bank = ""){
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = $this->input->post('true_false_answer');

        $this->db->where('question_bank_id', $question_id);
       // $this->db->update('question_bank', $data);

        if($table_question_bank == "pre_question_bank")
             $this->db->update('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
           $this->db->update('scholarship_question_bank', $data);
        else
             $this->db->update('question_bank', $data);

        $this->session->set_flashdata('flash_message' , get_phrase('question_updated'));
    }

    // fill in the blanks question portion
    function add_fill_in_the_blanks_question_to_online_exam($online_exam_id,$table_question_bank = ""){
        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
          array_push($suitable_words, strtolower($row));
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['type']               = 'fill_in_the_blanks';
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = json_encode(array_map('trim',array_map('htmlspecialchars',$suitable_words)));
        if($table_question_bank == "pre_question_bank")
            $this->db->insert('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
           $this->db->insert('scholarship_question_bank', $data);
        else
            $this->db->insert('question_bank', $data);

        $this->session->set_flashdata('flash_message' , get_phrase('question_added'));
    }
    function update_fill_in_the_blanks_question($question_id,$table_question_bank = ""){
        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
          array_push($suitable_words, strtolower($row));
        }
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = json_encode(array_map('trim',array_map('htmlspecialchars',$suitable_words)));

        $this->db->where('question_bank_id', $question_id);
        if($table_question_bank == "pre_question_bank")
             $this->db->update('pre_question_bank', $data);
        elseif($table_question_bank == "scholarship_question_bank")
           $this->db->update('scholarship_question_bank', $data);
        else
             $this->db->update('question_bank', $data);
        
        $this->session->set_flashdata('flash_message' , get_phrase('question_updated'));
    }
    function delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('question_bank');
    }

    function pre_delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('pre_question_bank');
    }

    function scholarship_delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('scholarship_question_bank');
    }

    function manage_online_exam_status($online_exam_id = "", $status = "",$table = ""){
        $checker = array(
            'online_exam_id' => $online_exam_id
        );
        $updater = array(
            'status' => $status
        );
        
        if($table =="pre_online_exam")
            $table = 'pre_online_exam';
        elseif($table =="scholarship_online_exam")
            $table = 'scholarship_online_exam';
        else
           $table = 'online_exam';

            
        $this->db->where($checker);
        $this->db->update($table, $updater);
        $this->session->set_flashdata('flash_message' , get_phrase('exam').' '.$status);
    }



    function available_exams($student_id) {
        $running_year = get_settings('running_year');
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        $section_id   = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'status' => 'published');
        $this->db->order_by("exam_date", "desc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
       
        return $exams;
    }

   



    function change_online_exam_status_to_attended_for_student($online_exam_id = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('online_exam_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('online_exam_result', $inserted_array);
        }
    }

    

    function submit_online_exam($online_exam_id = "", $answer_script = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );

        $this->db->where($checker);
        $this->db->update('online_exam_result', $updated_array);

        $this->calculate_exam_mark($online_exam_id);
    }
  
    function scholarship_submit_online_exam($online_exam_id = "", $answer_script = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );

        $this->db->where($checker);
        $this->db->update('scholarship_online_exam_result', $updated_array);

        $this->scholarship_calculate_exam_mark($online_exam_id);
    }


    function calculate_exam_mark($online_exam_id) {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );


        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {

            $data['obtained_mark'] = 0;
        }
        else{
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {

                if ($row['submitted_answer'] == $row['correct_answers']) {

                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark($online_exam_id);
        $query = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];

        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('online_exam_result', $data);
    }
    

    function scholarship_calculate_exam_mark($online_exam_id) {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );


        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('scholarship_online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {

            $data['obtained_mark'] = 0;
        }
        else{
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {

                if ($row['submitted_answer'] == $row['correct_answers']) {

                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark($online_exam_id);
        $query = $this->db->get_where('scholarship_online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];

        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('scholarship_online_exam_result', $data);
    }


    function get_total_mark($online_exam_id){
        $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0){
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }

    function get_question_details_by_id($question_bank_id, $column_name = "") {

        return $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row()->$column_name;
    }
    
    function scholarship_get_question_details_by_id($question_bank_id, $column_name = "") {

        return $this->db->get_where('scholarship_question_bank', array('question_bank_id' => $question_bank_id))->row()->$column_name;
    }

    function check_availability_for_student($online_exam_id){
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }




    function get_correct_answer($question_bank_id = ""){

        $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }
    


    function get_online_exam_result($student_id){
        $match = array('student_id' => $student_id, 'status' => 'submitted');
        $exams = $this->db->where($match)->get('online_exam_result')->result_array();
        return $exams;
    }

    
    function delete_house($house_id) {
       // deleting data of student from all associated tables
       $tables = array('house_info','assign_house');
       $this->db->delete($tables, array('house_id' => $house_id));
       //$this->db->delete('assign_house', array('house_id' => $house_id));       
    }

    function delete_assign_house($assign_id) {
       // deleting data of student from all associated tables
       $tables = array('assign_house');
       $this->db->delete($tables, array('assign_id' => $assign_id));
    }
    
    function registration_form_fiels()
     {
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting',array('status'=>'0','created_html' => '1'))->result();
      foreach ($create_status as $key => $field_dt) {
         $field_arr[] = $field_dt->name;
      }
      
     return $field_arr;
    }
	
	 function registration_form_fiels_pre_student()
     {
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_pre_student',array('status'=>'0','created_html' => '1'))->result();
      foreach ($create_status as $key => $field_dt) {
         $field_arr[] = $field_dt->name;
      }
      
     return $field_arr;
    }
	
     function registration_form_fiels_teacher()
     {
     $field_arr = array();
     $create_status = $this->db->get_where('registration_form_setting_teacher',array('status'=>'0','created_html' => '1'))->result();
      foreach ($create_status as $key => $field_dt) {
         $field_arr[] = $field_dt->name;
      }
      
     return $field_arr;
    }


    function get_registration_fields(){
     return $create_dianamic_field = $this->db->get_where('registration_form_setting',array('status'=>'1','created_html' => '0'))->result();
    }
   
    function get_registration_fields_teacher(){
     return $create_dianamic_field = $this->db->get_where('registration_form_setting_teacher',array('status'=>'1','created_html' => '0'))->result();
    }
  function get_registration_fields_pre_student(){
     return $create_dianamic_field = $this->db->get_where('registration_form_setting_pre_student',array('created_html' => '0'))->result();
    }
function get_registration_pre_student_admission(){
     return $create_dianamic_field = $this->db->get_where('registration_form_setting_pre_student',array('status'=>'1','created_html' => '0'))->result();
    }
	
   /*    scholarship functions  */
    function available_scholarship_exams($student_id) {
        $running_year = get_settings('running_year');
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        $match        = array('running_year' => $running_year, 'class_id' => $class_id,'status' => 'published');
        $this->db->order_by("exam_date", "desc");
        $exams = $this->db->where($match)->get('scholarship_online_exam')->result_array();
        return $exams;
    }

    function change_scholarship_exam_status_to_attended_for_student($online_exam_id = ""){

         $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('scholarship_online_exam_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status'         => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id'     => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('scholarship_online_exam_result', $inserted_array);
        }
    }

    function check_availability_for_student_in_scholarship($online_exam_id){

        $result = $this->db->get_where('scholarship_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();

        return $result['status'];
    }

    function scholarship_get_correct_answer($question_bank_id = ""){

        $question_details = $this->db->get_where('scholarship_question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }

    /* certificates data */

     function get_all_certificatess(){
      return  $question_details = $this->db->get_where('certificates', array('status' => 1))->result();
     }

	 function get_all_certificates(){

        $this->db->select('AC.* ,V.name AS certificate_type, P.name AS parentname,S.student_code ,S.name, AC.status');
        $this->db->from('apply_certificates AS AC');
		$this->db->join('certificates AS V', 'V.id = AC.certificate_type');
		$this->db->join('student AS S', 'S.student_id = AC.student_id');
		$this->db->join('parent AS P', 'P.parent_id = AC.apply_by');
        $this->db->where('AC.year', $this->year);
        $this->db->where('AC.student_id', $this->session->userdata('student_id'));
        $this->db->order_by('AC.id', 'DESC');
        return $this->db->get()->result();
 }
     /*get_hostel_data*/

     function get_hostel_data($table_id){
        $this->db->select('ST.name as student_name,ST.student_id as student_id,ST.student_code,ST.is_hostel_member,HM.id AS hm_id, H.name AS hostel_name, H.id as ide, R.room_no, R.id as room_id, R.room_type, R.cost');
        $this->db->from('student AS ST');
        $this->db->join('enroll AS E', 'E.student_id = ST.student_id', 'left');
        $this->db->join('hostel_members AS HM', 'HM.user_id = ST.student_id', 'left');
        $this->db->join('hostels AS H', 'H.id = HM.hostel_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('E.year', $this->year);
        if($this->session->userdata('student_login')==1){
            
        } else {
            $this->db->where('ST.student_id', $table_id);   
        }
        $this->db->where('ST.is_hostel_member', '1');
        $this->db->order_by('HM.id', 'DESC');
        $result =  $this->db->get()->row();
        /*echo "<pre>";
         print_r($result);
        echo "</pre>";*/
       return $result;
     }
    
    function get_visitor_list_users($user_id,$role){
        $this->db->select('V.*');
        $this->db->from('visitors AS V');
        $this->db->where('V.year', $this->year);
        $this->db->where('V.user_id', $user_id);
        $this->db->where('V.role_id', $role);
        $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
    }

    function get_teacher_hostel_data($table_id){
        $this->db->select('T.name as teacher_name,T.is_hostel_member,HM.id AS hm_id, H.name AS hostel_name, R.room_no, R.room_type, R.cost');
        $this->db->from('teacher AS T');
        $this->db->join('hostel_members AS HM', 'HM.user_id = T.teacher_id', 'left');
        $this->db->join('hostels AS H', 'H.id = HM.hostel_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('T.teacher_id', $table_id);
        $this->db->where('T.is_hostel_member', '1');
        $this->db->order_by('HM.id', 'DESC');
        $result =  $this->db->get()->row();
        echo "<pre>";
         print_r($result);
        echo "</pre>";
       return $result;
     }

    function  student_leave_record($post =""){
        $class_id = "";$section_id="";$student="";$month="";
        if($post != ""){
        $class_id   = $post['class_id'];
        $section_id = $post['section_id'];
        if(isset($post['student']))
        $student    = $post['student'];
    
        $month      = $post['month'];
        }
        $this->db->select('L.*,S.name as student_name,E.*');
        $this->db->from('leave_request AS L');
        $this->db->join('student AS S', 'S.student_code = L.id_no');
        $this->db->join('enroll AS E', 'E.student_id = S.student_id');
        $this->db->where('S.student_id = E.student_id');
        if($student != "")
          $this->db->where('E.student_id', $student);
        if($section_id != "")
         $this->db->where('E.section_id', $section_id);  
        if($class_id != "") 
         $this->db->where('E.class_id', $class_id);
        if($month != "") 
         $this->db->like('L.from_date', $month.'/', 'both');
        
        // $this->db->where();
        $this->db->where("(L.role_id = ".PARENTT ." OR L.role_id =".STUDENT.")");
        return  $result =  $this->db->get()->result();
        
    }

	// emp leave_request functions
	
	   function employee_leave_record($post =""){
		  //print_r($post);
        $emp_type = "";$section_id="";$student="";$month="";
        if($post != ""){
        $emp_type   = $post['emp_type'];
        $user_id   = $post['user_id'];
        $section_id = $post['section_id'];        
        }
        $this->db->select('L.*,T.name');
        $this->db->from('leave_request AS L');
    	if($emp_type=='teacher'){
        $this->db->join('teacher AS T', 'T.teacher_id = L.request_by');	
		 $this->db->where('L.role_id', 5); 
if($user_id){		 
		 $this->db->where('L.request_by', $user_id);
}		 
	    }elseif($emp_type=='accountant'){
        $this->db->join('accountant AS T', 'T.accountant_id = L.request_by');	
		 $this->db->where('L.role_id', 6); 
if($user_id){		 
		 $this->db->where('L.request_by', $user_id);    
}
	    }
         elseif($emp_type=='librarian'){
        $this->db->join('librarian AS T', 'T.librarian_id = L.request_by');	
		 $this->db->where('L.role_id', 7);    
		if($user_id){		 
		 $this->db->where('L.request_by', $user_id);    
}
	    } elseif($emp_type=='driver' || $emp_type=='warden' || $emp_type=='security-gaurd' ){
         $this->db->join('employees AS T', 'T.id = L.request_by');	   
		 $this->db->where('L.request_by', $user_id);    
		
	    }
       
             
        return  $result =  $this->db->get()->result();
        
    }
	
	
    function  student_leave_Schedule($tid){
        
        $this->db->select('L.*,S.name as student_name,E.*');
        $this->db->from('leave_request AS L');
        $this->db->join('student AS S', 'S.student_code = L.id_no');
        $this->db->join('enroll AS E', 'E.student_id = S.student_id');
        $this->db->join('section AS SC', 'SC.class_id = E.class_id');
        $this->db->where('S.student_id = E.student_id');
        $this->db->where('SC.section_id = E.section_id');
        $this->db->where('SC.teacher_id',$tid);
        $this->db->where('L.year',$this->year);
        $this->db->where("(L.role_id = ".PARENTT ." OR L.role_id =".STUDENT.")");
        return  $result =  $this->db->get()->result();
        
    }

     public function get_schedule_list($class_id){
        
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        } 
       
        $this->db->select('ES.*, E.name, C.name AS class_name, S.name AS subject');
        $this->db->from('exam_schedule AS ES');
        $this->db->join('class AS C', 'C.class_id = ES.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left');
        
        if($this->session->userdata('role_id') == TEACHER){
            $this->db->where('S.teacher_id', $this->session->userdata('login_user_id'));
        }
        
        if($class_id){
            $this->db->where('ES.class_id', $class_id);            
        }
        $this->db->order_by('ES.id', 'DESC');            
        return $this->db->get()->result();
        
    }

    public function get_schedule_list_mobile($class_id){
        
       
        $this->db->select('ES.*, E.name, C.name AS class_name, S.name AS subject');
        $this->db->from('exam_schedule AS ES');
        $this->db->join('class AS C', 'C.class_id = ES.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left');
        
        if($this->input->post('role_id') == 'teacher'){
            $this->db->where('S.teacher_id', $this->input->post('tid'));
        }
        
        if($class_id){
            $this->db->where('ES.class_id', $class_id);            
        }
        $this->db->order_by('ES.id', 'DESC');            
        return $this->db->get()->result();
        
    }

     function duplicate_room_check($room_no, $exam_date, $start_time, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        
        $this->db->where('room_no', $room_no);
        $this->db->where('exam_date', $exam_date);
        $this->db->where('start_time', $start_time);        
        $this->db->where('year', $this->year);
        
        return $this->db->get('exam_schedule')->num_rows();            
    }

     function duplicate_check($exam_id, $class_id, $subject_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);        
        $this->db->where('year', $this->year);        
        return $this->db->get('exam_schedule')->num_rows();            
    }

    function get_re_exam_list($class_id=null){
        $this->db->select("RE.*,C.name as class_name,S.name as subject_name,E.name as exam_name,SE.name as section_name,ST.name as student_name,ES.exam_date as examdate");
        $this->db->from('re_exam AS RE');
        $this->db->join('class AS C', 'RE.class_id = C.class_id', 'left');
        $this->db->join('exam_schedule AS ES', 'ES.id = RE.exam', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left'); 
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('section AS SE', 'SE.section_id = RE.section_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = RE.student_id', 'left');
        if(!empty($class_id)){
            $this->db->where('RE.class_id',$class_id);
        }
        $result = $this->db->get()->result();
       return $result;
    }

    function get_cancel_exam_list($class_id=null){
        $this->db->select("RE.*,C.name as class_name,S.name as subject_name,E.name as exam_name,SE.name as section_name,ST.name as student_name,ES.exam_date as examdate");
        $this->db->from('re_exam_cancel AS RE');
        $this->db->join('class AS C', 'RE.class_id = C.class_id', 'left');
        $this->db->join('exam_schedule AS ES', 'ES.id = RE.exam', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left'); 
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('section AS SE', 'SE.section_id = RE.section_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = RE.student_id', 'left');
        if(!empty($class_id)){
            $this->db->where('RE.class_id',$class_id);
        }
        $result = $this->db->get()->result();
        /*echo "<pre>";
         print_r($result);
        echo "</pre>";*/
       return $result;
    }
   
    function get_student_cancel_exam_list($student_id){
        $studentdetails = $this->db->get_where('enroll',array('student_id'=>$student_id))->row();
        if($studentdetails != ""){
         $class_id   =  $studentdetails->class_id;
         $section_id =  $studentdetails->section_id;
        }
        $this->db->select("RE.*,C.name as class_name,S.name as subject_name,E.name as exam_name,SE.name as section_name,ST.name as student_name,ES.exam_date as examdate");
        $this->db->from('re_exam_cancel AS RE');
        $this->db->join('class AS C', 'RE.class_id = C.class_id', 'left');
        $this->db->join('exam_schedule AS ES', 'ES.id = RE.exam', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left'); 
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('section AS SE', 'SE.section_id = RE.section_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = RE.student_id', 'left');
        if($class_id != "")
          $this->db->where('RE.class_id',$class_id);
        if($class_id != "")
          $this->db->where("(RE.section_id = '".$section_id."' OR RE.section_id = 0)", NULL, FALSE);
        if($student_id != "")
          $this->db->where("(RE.student_id = '".$student_id."' OR RE.student_id = 0)", NULL, FALSE);
        
        $this->db->order_by('RE.cancel_exam_id', 'DESC'); 
        $result = $this->db->get()->result();
       
       return $result;
    }


    function get_student_re_exam_list($student_id){
        $studentdetails = $this->db->get_where('enroll',array('student_id'=>$student_id))->row();
        if($studentdetails != ""){
         $class_id   =  $studentdetails->class_id;
         $section_id =  $studentdetails->section_id;
        }
        $this->db->select("RE.*,C.name as class_name,S.name as subject_name,E.name as exam_name,SE.name as section_name,ST.name as student_name,ES.exam_date as examdate");
        $this->db->from('re_exam AS RE');
        $this->db->join('class AS C', 'RE.class_id = C.class_id', 'left');
        $this->db->join('exam_schedule AS ES', 'ES.id = RE.exam', 'left');
        $this->db->join('exam AS E', 'E.exam_id = ES.exam_id', 'left'); 
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('section AS SE', 'SE.section_id = RE.section_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = RE.student_id', 'left');
        
        if($class_id != "")
          $this->db->where('RE.class_id',$class_id);
        if($class_id != "")
          $this->db->where("(RE.section_id = '".$section_id."' OR RE.section_id = 0)", NULL, FALSE);
        if($student_id != "")
          $this->db->where("(RE.student_id = '".$student_id."' OR RE.student_id = 0)", NULL, FALSE);
        
        $this->db->order_by('RE.re_exam_id', 'DESC'); 
        $result = $this->db->get()->result();
       return $result;
    }

    function get_teacher_salary_details($user_id){
	 //print_r($user_id);exit;
	     $role='teacher';
        $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');
		$this->db->join('teacher AS V', 'V.teacher_id = S.user_id');
        $this->db->where('S.academic_year_id', $this->year);
        $this->db->where('S.payment_to', $role);
        $this->db->where('S.user_id', $this->session->userdata('login_user_id'));
       // $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
 }


    function get_emp_salary_details($user_id){
	 
	     $role=$this->session->userdata('role_id');

        $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');
		$this->db->join('employees AS V', 'V.user_id = S.user_id');
        $this->db->where('S.academic_year_id', $this->year);
		if ($role=='13')
        $this->db->where('S.payment_to', 'warden');
	    if ($role=='9')
        $this->db->where('S.payment_to', 'driver');
        $this->db->where('S.user_id', $this->session->userdata('login_user_id'));
      
         return $this->db->get()->result();
 } 

 function get_room_switch_request(){
  
   $this->db->select('*,R.role_id as role_id,R.reason as reason, R.id as rId,R.create_by as screate_by,H.name as hostel_name,RM.room_type as room_name,RM.room_no as room_no,IF(R.type=2,E.name,S.name) as student_name,
   CH.name as current_hostel_name,CRM.room_type as current_room_type,CRM.room_no as current_room_no,
   H.name as new_hostel_name,RM.room_type as new_room_type,RM.room_no as new_room_no , IF(R.type=2,D.name,"Student") as designation_name
   ');
   $this->db->from('room_change_request as R');
   $this->db->join('hostels as H','H.id=R.new_hostel_id');
   $this->db->join('rooms as RM','RM.id=R.new_room_id');
   $this->db->join('hostels as CH','CH.id=R.prev_hostel_id');
   $this->db->join('rooms as CRM','CRM.id=R.prev_room_id');
   $this->db->join('student as S','S.student_id=R.student_id','left');
   $this->db->join('employees as E','E.id=R.student_id','left');
   $this->db->join('designations as D','D.id=R.role_id','left');
   $this->db->order_by("R.id", "desc");
   return $this->db->get()->result();
 }

 function substitute_details($class_id = "",$section_id = "")
 {

    $this->db->select('S.*,C.name as class_name,SC.name as section_name,T.name as teacher_name,SB.name as subject_name');
    $this->db->from('substitute_teacher S');
    $this->db->join('class C','C.class_id=S.class_id');
    $this->db->join('section SC','SC.section_id=S.section_id');
    $this->db->join('subject SB','SB.subject_id=S.subject_id');
    $this->db->join('teacher T','T.teacher_id = S.teacher_id');
    if($class_id != ""&&$section_id != ""){
     $this->db->where('S.class_id',$class_id);
     $this->db->where('S.section_id',$section_id);
    }
    return $this->db->get()->result();
 }

 function get_transports_data_by_student($user_id,$type = ""){
    if($type == ""){
        $this->db->select('*');
        $this->db->from('student S');
        $this->db->join('routes R','R.id = S.transport_id');
        $this->db->where('parent_id',$user_id);
        return $this->db->get()->result();
    }elseif($type == "student"){
        $this->db->select('*');
        $this->db->from('student S');
        $this->db->join('routes R','R.id = S.transport_id');
        $this->db->where('student_id',$user_id);
        return $this->db->get()->result();
    }
   
 }
 
    function get_attendance_by_rfid($user_id){
		//print($user_id);
        $this->db->select('S.* , E.card_code,S.name, S.blood_group,P.name AS parent_name');
        $this->db->from('enroll AS E');
		$this->db->join('student AS S', 'S.student_id = E.student_id');
		$this->db->join('parent AS P', 'P.parent_id = S.parent_id');
        $this->db->where('E.year', $this->year);
        $this->db->where('E.card_code', $user_id);      
        return $this->db->get()->result();
 }

 function get_class_timetable_routine($class_id,$section_id,$template){
  //return  $this->db->get_where('class_routine',array('is_temporary'=>'no','class_id'=>$class_id,'section_id'=>$section_id))->row();
  
   $data = array();
   $this->db->select('R.*');
   $this->db->from('class_routine AS R');
   $this->db->where('R.template_id', $template);
   $this->db->where('R.class_id', $class_id);
   $this->db->where('R.section_id', $section_id);
   $this->db->group_by('R.period');
   $this->db->order_by('R.period', 'ASC'); 
   $period = $this->db->get()->result();
   $i = 0;
   foreach ($period as $key => $dt) {
    $data[$i]['vertical'] = $dt->period;
    $data[$i]['v_day']    = $dt->day;
    $this->db->select('R.*,S.name as subject_name,T.name as teacher_name');
    $this->db->from('class_routine AS R');
    $this->db->join('subject AS S', 'S.subject_id = R.subject_id','left');
    $this->db->join('teacher AS T', 'T.teacher_id = R.teacher_id','left');
    $this->db->where('R.template_id', $template);
    $this->db->where('R.class_id', $class_id);
    $this->db->where('R.section_id', $section_id);
    $this->db->where('R.period', $dt->period);
    $this->db->order_by('R.day', 'ASC');

    $data[$i]['horizontal'] = $this->db->get()->result();
    $i++;
   }

  // echo "<pre>";
  //   print_r($data);
  // echo "</pre>";

   return $data;
 }

 function get_class_timetable_temporary($class_id,$section_id){
   $this->db->select('R.*');
   $this->db->from('class_routine AS R');
   $this->db->where('R.is_temporary', 'yes');
   $this->db->where('R.class_id', $class_id);
   $this->db->where('R.section_id', $section_id);
   //$this->db->group_by('R.period');
   $this->db->order_by('R.period', 'ASC'); 
   return  $period = $this->db->get()->result();

 }

 function class_timetable_by_date($period,$day,$date,$class_id,$section_id){

    $this->db->select('R.*,S.name as subject_name,T.name as teacher_name');
    $this->db->from('class_routine AS R');
    $this->db->join('subject AS S', 'S.subject_id = R.subject_id','left');
    $this->db->join('teacher AS T', 'T.teacher_id = R.teacher_id','left');
    //$this->db->where('R.is_temporary', 'yes');
    $this->db->where('R.class_id', $class_id);
    $this->db->where('R.section_id', $section_id);
    $this->db->where('R.period', $period);
    $this->db->where('R.day', $day);
   // $this->db->where('R.tem_date', $date);
    $this->db->order_by('R.class_routine_id', 'ASC'); 
    return $temp_date = $this->db->get()->row();

 }

 function get_class_timetable_routine_by_teacher($teacher_id){
    $data = array();
    $this->db->select('R.*');
    $this->db->from('class_routine AS R');
    $this->db->where('R.is_temporary', 'no');
    //$this->db->where('R.class_id', $class_id);
    $this->db->where('R.teacher_id', $teacher_id);
    $this->db->group_by('R.period');
    $this->db->order_by('R.period', 'ASC'); 
    $period = $this->db->get()->result();
    $i = 0;
   foreach ($period as $key => $dt) {
    $data[$i]['vertical'] = $dt->period;
    $this->db->select('R.*,S.name as subject_name,C.name as class_name,SC.name as section_name');
    $this->db->from('class_routine AS R');
    $this->db->join('subject AS S', 'S.subject_id = R.subject_id','left');
    //$this->db->join('teacher AS T', 'T.teacher_id = R.teacher_id','left');
    $this->db->join('class AS C', 'C.class_id = R.class_id','left');
    $this->db->join('section AS SC', 'SC.section_id = R.section_id','left');
    $this->db->where('R.is_temporary', 'no');
    // $this->db->where('R.class_id', $class_id);
    // $this->db->where('R.section_id', $section_id);
    $this->db->where('R.period', $dt->period);
    $this->db->order_by('R.day', 'ASC');
    $data[$i]['horizontal'] = $this->db->get()->result();
    $i++;
   }

  /* echo "<pre>";
    print_r($data);
   echo "</pre>";*/

   return $data;

 }

 //  function class_timetable_by_date_for_teacher($period,$day,$date,$class_id,$section_id){

 //         $this->db->select('R.*,S.name as subject_name,T.name as teacher_name');
 //         $this->db->from('class_routine AS R');
 //         $this->db->join('subject AS S', 'S.subject_id = R.subject_id','left');
 //         $this->db->join('teacher AS T', 'T.teacher_id = R.teacher_id','left');
 //         $this->db->where('R.is_temporary', 'yes');
 //         $this->db->where('R.class_id', $class_id);
 //         $this->db->where('R.section_id', $section_id);
 //         $this->db->where('R.period', $period);
 //         $this->db->where('R.day', $day);
 //         $this->db->where('R.tem_date', $date);
 //         $this->db->order_by('R.class_routine_id', 'ASC'); 
 //        return $temp_date = $this->db->get()->row();

 // }
     function _get_class_timetable_routine_($class_id,$section_id){
              $data = array();
               $this->db->select('R.*');
               $this->db->from('class_routine AS R');
               $this->db->where('R.is_temporary', 'no');
               $this->db->where('R.class_id', $class_id);
               $this->db->where('R.section_id', $section_id);
               $this->db->group_by('R.period');
               $this->db->order_by('R.period', 'ASC'); 
               $period = $this->db->get()->result();
               $i = 0;
               foreach ($period as $key => $dt) {
                $data[$i]['vertical'] = $dt->period;
                $data[$i]['v_day']    = $dt->day;
                $this->db->select('R.*,S.name as subject_name,T.name as teacher_name');
                $this->db->from('class_routine AS R');
                $this->db->join('subject AS S', 'S.subject_id = R.subject_id','left');
                $this->db->join('teacher AS T', 'T.teacher_id = R.teacher_id','left');
                $this->db->where('R.is_temporary', 'no');
                $this->db->where('R.class_id', $class_id);
                $this->db->where('R.section_id', $section_id);
                $this->db->where('R.period', $dt->period);
                $this->db->order_by("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')");
               // $this->db->order_by('class_routine_id',"desc")->limit(1);
                //$this->db->order_by('R.id', 'DESC'); 


                $data[$i]['horizontal'] = $this->db->get()->result();
                $i++;


     }
     // echo "<pre>";
     // print_r($data);

    return $data;

}

    function read_notification_status($table,$Colm="",$rstatus = ""){
        if($rstatus == "")
            $rstatus = 0;

         //echo $rstatus;
        if($Colm == "")
          $this->db->where($Colm,$this->session->userdata('login_user_id'));

        $this->db->where('role_id',$this->session->userdata('role_id'));
        $this->db->update($table,array('read_notification'=>$rstatus));
    }
    function create_online_feedback($table =FALSE){
       // $data['code']       = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title']      = $this->input->post('exam_title');
        $arrayclass = $this->input->post('teacher_id');
        $commaclass = implode(',', $arrayclass);
        $data['teacher_id']   =  $commaclass;
       // $data['teacher_id']   = $this->input->post('teacher_id');
        $data['year'] = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        if($table != "")
           $this->db->insert($table, $data);
        else
           $this->db->insert($table, $data);  
    }
      function delete_feedback_teacher_question($question_id){
        $this->db->where('question_id', $question_id);
        $this->db->delete('teacher_feedback_question');
    }
	
	   function delete_holidays_list($id){
        $this->db->where('id', $id);
        $this->db->delete('holiday_leave');
    }
	
	   // multiple_choice_question crud functions
    function add_question_teacher_feedback($online_exam_id,$table_question_bank = ""){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['feed_back_id']     = $online_exam_id;
        $data['question_title']     = htmlspecialchars($this->input->post('question_title'));
        //$data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode(array_map('htmlspecialchars',$this->input->post('options')));
        $data['correct_answers']    = json_encode($correct_answers);

        if($table_question_bank == "teacher_feedback_question")
      
            $this->db->insert('teacher_feedback_question', $data);
        elseif($table_question_bank == "scholarship_question_bank")
            $this->db->insert('scholarship_question_bank', $data);
        else
            $this->db->insert('question_bank', $data);

        $this->session->set_flashdata('flash_message' , get_phrase('question_added'));
    }
	
	  function update_online_teacher_feedback($table =FALSE){

        $data['title'] = $this->input->post('exam_title');
        $arrayclass = $this->input->post('teacher_id');
        $commaclass = implode(',', $arrayclass);
        $data['teacher_id']   =  $commaclass;
        $this->db->where('id', $this->input->post('id'));
        if($table != "")
         $this->db->update($table, $data);
        else
         $this->db->update('teacher_feedback', $data);   
    }
	 function get_total_feedback($online_exam_id){
        $added_question_info = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0){
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }

     function get_sms_templates(){
        $query = $this->db->get("sms_template");
        return $query->result();
    }

     public function insert_sms_template()
    {    
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('template')
        );
        return $this->db->insert('sms_template', $data);
    }
    
    public function getClassDetails(){
        
        if(!empty($this->input->post('class_id'))){
            $this->db->where('class_id',$this->input->post('class_id'));
             if(!empty($this->input->post('section_id'))){
                $section_id=$this->input->post('section_id');
             }
        }
        
        
        
        $response = array();
        $datas = $this->db->get('class')->result_array();
        foreach($datas as $key => $data){
            unset($data['teacher_id']);
            $response[$key] = $data;
            if($section_id){
                 $sections = $this->db->get_where('section',['class_id'=>$data['class_id'],'section_id'=>$section_id])->result_array();
            }else{
            $sections = $this->db->get_where('section',['class_id'=>$data['class_id']])->result_array();
            }
            foreach($sections as $i => $section){
                $response[$key]['section'][$i] = $section;
                $studentDetails = $this->db->get_where('enroll',['class_id'=>$data['class_id'],'section_id'=>$section['section_id']]);
                $studentIds = array();
                foreach($studentDetails->result_array() as $student){
                    array_push($studentIds,$student['student_id']);
                }
                $response[$key]['section'][$i]['total_student'] = $studentDetails->num_rows();
                if(!empty($studentIds)){
                    $this->db->where_in('student_id',$studentIds);
                    $this->db->where('LOWER(sex)','male');
                    $maleStudent = $this->db->get('student')->num_rows();
                    $this->db->where_in('student_id',$studentIds);
                    $this->db->where('LOWER(sex)','female');
                    $femaleStudent = $this->db->get('student')->num_rows();
                    $this->db->select_sum('net_amount');
                    $this->db->where_in('student_id',$studentIds);
                    $this->db->where('paid_status','paid');
                    $feeAmount = $this->db->get('invoices')->row()->net_amount;
                    $this->db->where_in('student_id',$studentIds);
                    $this->db->where('status','1');
                    $present = $this->db->get('attendance')->num_rows();
                    $this->db->where_in('student_id',$studentIds);
                    $this->db->where('status','2');
                    $absent = $this->db->get('attendance')->num_rows();
                    if($present == 0){
                        $attendance = 0;
                    } else {
                        $attendance = number_format(((float)($present / ($absent + $present)) * 100), 2, '.', '');;
                    }
                } else {
                    $maleStudent = 0;
                    $femaleStudent = 0;
                    $feeAmount = 0;
                    $attendance = 0;
                }
                $response[$key]['section'][$i]['total_male_student'] = $maleStudent;
                $response[$key]['section'][$i]['total_female_student'] = $femaleStudent;
                $response[$key]['section'][$i]['class_teacher'] = $this->db->get_where('teacher',['teacher_id' => $section['teacher_id']])->row()->name;
                $response[$key]['section'][$i]['total_collection_fee_amount'] = $feeAmount;
                $response[$key]['section'][$i]['attandance_percentage'] = $attendance;
            }
        }
        return $response;
    }
}
