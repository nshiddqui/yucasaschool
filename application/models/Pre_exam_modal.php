<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pre_exam_modal extends CI_Model {

    function __construct() {
        parent::__construct();
    }
     

    function available_exams($student_id) {
        $running_year = get_settings('running_year');
        $class_id     = $this->db->get_where('pre_enroll', array('student_id' => $student_id))->row()->class_id;
        $section_id   = $this->db->get_where('pre_enroll', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'status' => 'published');
        $this->db->order_by("exam_date", "dsc");
        $exams = $this->db->where($match)->get('pre_online_exam')->result_array();
        return $exams;
    }

   



    function change_online_exam_status_to_attended_for_student($online_exam_id = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('pre_online_exam_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('pre_online_exam_result', $inserted_array);
        }
    }
    function change_teacher_feedback_status_to_attended_for_student($online_id = "",$teacher_id){

        $checker = array(
            'feedback_id' => $online_id,
            'teacher_id' => $teacher_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('student_online_feedback_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status' => 'attended',
                'feedback_id' => $online_id,
				  'teacher_id' => $teacher_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('student_online_feedback_result', $inserted_array);
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
        $this->db->update('pre_online_exam_result', $updated_array);

        $this->calculate_exam_mark($online_exam_id);
    }


    function calculate_exam_mark($online_exam_id) {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );


        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('pre_online_exam_result', $checker);
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
        $query = $this->db->get_where('pre_online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];

        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('pre_online_exam_result', $data);
    }
    
    function get_total_mark($online_exam_id){
        $added_question_info = $this->db->get_where('pre_question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0){
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }

    function get_question_details_by_id($question_bank_id, $column_name = "") {

        return $this->db->get_where('pre_question_bank', array('question_bank_id' => $question_bank_id))->row()->$column_name;
    }


    function check_availability_for_student($online_exam_id){
        $result = $this->db->get_where('pre_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }




    function get_correct_answer($question_bank_id = ""){

        $question_details = $this->db->get_where('pre_question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }
    
    function get_online_exam_result($student_id){
        $match = array('student_id' => $student_id, 'status' => 'submitted');
        $exams = $this->db->where($match)->get('pre_online_exam_result')->result_array();
        return $exams;
    }

    function pre_examlist_by_student_n_class($class){
        $this->db->select('O.*');
        $this->db->from('pre_online_exam AS O');  
        $this->db->where('O.running_year', $this->year);
        $this->db->where('O.class_id', $class);
        $result = $this->db->get()->result(); 
        return $result;
    }

    function submit_online_feedback($feedback_id = "", $answer_script = "",$teacher_id=""){

        $checker = array(
            'feedback_id' => $feedback_id,
            'student_id' => $this->session->userdata('login_user_id'),
            'teacher_id' => $teacher_id
        );

		$updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );

        // echo "<pre>";
        //   print_r($updated_array);
        // echo "</pre>";

        $this->db->where($checker);
        $this->db->update('student_online_feedback_result', $updated_array);
        $this->calculate_exam_mark($feedback_id);
    }

    function get_feedback_answer($question_id = ""){
        $question_details = $this->db->get_where('teacher_feedback_question', array('question_id' => $question_id))->row_array();
        return $question_details['correct_answers'];
    }
	
	function teacher_feedback_for_student($online_id,$teacher_id){
        $result = $this->db->get_where('student_online_feedback_result', array('feedback_id' => $online_id,'teacher_id' => $teacher_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }
}
