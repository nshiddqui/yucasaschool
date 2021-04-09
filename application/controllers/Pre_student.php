<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @author   : Creativeitem
 *  date    : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Pre_student extends MY_Controller
{


    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
       // $this->load->model('stripe_model');
       // $this->load->model('paypal_model');
        //$this->load->model('schedule_Model');
        $this->load->model('pre_exam_modal');
       // $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('pre_student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('pre_student_login') == 1)
            redirect(site_url('pre_student/dashboard'), 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('pre_student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }
  
     function pre_admission_exam_schedule()
     {   
        $class_id = $this->db->get_where('pre_enroll',array('student_id'=>$this->session->userdata('pre_student_id')))->row()->class_id;
        $request = $this->pre_exam_modal->pre_examlist_by_student_n_class($class_id);

        $page_data['pre_exam_info'] = $request;
        $page_data['page_name']  = 'pre_admission_exam_schedule';
        $page_data['page_title'] = get_phrase('exam_schedule');
        $this->load->view('backend/index', $page_data);
     }
     
    function pre_admission_admit_card()
     {
        $page_data['page_name']  = 'pre_admission_admit_card';
        $page_data['page_title'] = get_phrase('student_admit_card');
        $this->load->view('backend/index', $page_data);
     }
 

    function online_exam($param1 = '', $param2 = '') {
        if ($this->session->userdata('pre_student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $page_data['exams'] = $this->pre_exam_modal->available_exams($this->session->userdata('login_user_id'));
        }
       // print_r($page_data);
        $page_data['page_name'] = 'online_exam';
        $page_data['page_title'] = get_phrase('pre_online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = '', $param2 = '') {
        if ($this->session->userdata('pre_student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'result';
            $page_data['exams'] = $this->pre_exam_modal->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam_result';
        $page_data['page_title'] = get_phrase('pre_online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    function take_online_exam($online_exam_code) {
        if ($this->session->userdata('pre_student_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('pre_online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $student_id = $this->session->userdata('login_user_id');
        // check if the student has already taken the exam
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('pre_online_exam_result')->num_rows();

        $this->pre_exam_modal->change_online_exam_status_to_attended_for_student($online_exam_id);

        $status = $this->pre_exam_modal->check_availability_for_student($online_exam_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'online_exam_take';
        }
        $page_data['page_title'] = get_phrase('pre_online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info'] = $this->db->get_where('pre_online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }


    function submit_online_exam($online_exam_id = ""){
        $answer_script = array();
        $question_bank = $this->db->get_where('pre_question_bank', array('online_exam_id' => $online_exam_id))->result_array();

        foreach ($question_bank as $question) {

          $correct_answers  = $this->pre_exam_modal->get_correct_answer($question['question_bank_id']);
          $container_2 = array();
          if (isset($_POST[$question['question_bank_id']])) {

              foreach ($this->input->post($question['question_bank_id']) as $row) {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }

          array_push($answer_script, $container);
        }
        $this->pre_exam_modal->submit_online_exam($online_exam_id, json_encode($answer_script));
        redirect(site_url('pre_student/online_exam'), 'refresh');
    }
    
    /****Student Exam *****/
    function exam_schedule()
    {
        $page_data['page_name']  = 'exam_schedule';
        $page_data['page_title'] = get_phrase('pre_student_exam_schedule');
        $this->load->view('backend/index', $page_data);
    }
    function exam_result()
    {
        $page_data['page_name']  = 'exam_result';
        $page_data['page_title'] = get_phrase('pre_student_exam_result');
        $this->load->view('backend/index', $page_data);
    }
    function exam_answer_sheet()
    {
        $page_data['page_name']  = 'exam_answer_sheet';
        $page_data['page_title'] = get_phrase('pre_exam_answer_sheet');
        $this->load->view('backend/index', $page_data);
    }
}
