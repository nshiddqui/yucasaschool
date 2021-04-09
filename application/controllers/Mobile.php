<?php
header('Content-Type: application/json');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  @author     : Creativeitem
 *  date        : 14 september, 2017
 *  Specification    :    Mobile app response, JSON formatted data for iOS & android app
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */
class Mobile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Achievement_Model', 'achievement', true);
        $this->load->model('Type_Model', 'type', true);
        $this->load->model('Visitor_Model', 'visitor', true);
        $this->load->model('Guardian_Model', 'guardian', true);
        $this->load->model('Parents_Model', 'parents', true);
        $this->load->model('Route_Model', 'route', true);
        $this->load->model('Member_Model', 'member', true);
        $this->load->model('Vehicle_Model', 'vehicle', true);
        $this->load->model('Grade_Model', 'grade', true);
        $this->load->model('Payment_Model', 'payment', true);
        $this->load->model('Designation_Model', 'designation', true);
        $this->load->model('Employee_Model', 'employee', true);
        $this->load->model('Hostel_Model', 'hostel', true);
        $this->load->model('Room_Model', 'room', true);
        $this->load->model('Event_Model', 'event', true);
        $this->load->model('Feetype_Model', 'feetype', true);
        $this->load->model('Discount_Model', 'discount', true);
        $this->load->model('Invoice_Model', 'invoice', true);
        $this->load->model('Duefeeemailsms_Model', 'mail', true);
        $this->load->model('Incomehead_Model', 'incomehead', true);
        $this->load->model('Exphead_Model', 'exphead', true);
        $this->load->model('Schedule_Model', 'schedule', true);
        $this->load->model('Ajax_Model', 'ajax', true);
        $this->load->model('Expenditure_Model', 'expenditure', true);
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        $this->load->model('Assignment_Model', 'assignment', true);
        $this->load->model('Inventory_Model', 'inventory', true);
        $this->load->model('Assignment_Individual_Model', 'assignment_individual', true);
        $this->load->library('session');
        date_default_timezone_set("Asia/Calcutta");
        //$this->load->library("Aauth");

        //Authenticate data manipulation with the user level security key
        // if ($this->validate_auth_key() != 'success') {
        //     $data['status'] = 408;
        //     $data['message'] = 'Session Expired';
        //     echo json_encode($data);
        //     die();
        // }
    }
    // response of class list
    function get_class()
    {
        $response = array();
        $classes  = $this->db->get('class')->result_array();
        foreach ($classes as $row) {
            $data['class_id']     = $row['class_id'];
            $data['name']         = $row['name'];
            $data['name_numeric'] = $row['name_numeric'];
            $data['teacher_id']   = $row['teacher_id'];
            $sections             = $this->db->get_where('section', array(
                'class_id' => $row['class_id'], 'sub_teacher_status' => 0
            ))->result_array();
            $data['sections']     = $sections;
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // returns image of user, returns blank image if not found.
    function get_image_url($type = '', $id = '')
    {
        $type     = $this->input->post('user_type');
        $id       = $this->input->post('user_id');
        $response = array();
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $response['image_url'] = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $response['image_url'] = base_url() . 'uploads/user.jpg';
        echo json_encode($response);
    }
    // returns system name and logo as public call
    function get_system_info()
    {
        $response['system_name'] = $this->db->get_where('settings', array(
            'type' => 'system_name'
        ))->row()->description;
        echo json_encode($response);
    }
    // returns the students of a specific class according to requested class_id
    // ** class_id, year required to get students from enroll table
    function get_students_of_class()
    {
        $response     = array();
        $class_id     = $this->input->post('class_id');
        $section_id     = $this->input->post('section_id');
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        if ($class_id != "") {
            if($section_id ==null){
            $students     = $this->db->get_where('enroll', array(
                'class_id' => $class_id,
                'year' => $running_year
            ))->result_array();
        }else{
             $students     = $this->db->get_where('enroll', array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'year' => $running_year
            ))->result_array();
        }
        } else {
            $students     = $this->db->get_where('enroll', array(
                'year' => $running_year
            ))->result_array();
        }
        foreach ($students as $row) {
            $data['student_id']  = $row['student_id'];
            $data['roll']        = $row['roll'];
            $data['name']        = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $data['birthday']    = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->birthday;
            $data['gender']      = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->sex;
            $data['address']     = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->address;
            $data['phone']       = @$this->db->get_where('student', array( 
                'student_id' => $row['student_id']
            ))->row()->phone;
            $data['email']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->email;
            $data['status']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->status;
            
               $data['reason']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->reason;
            
            $data['class']       = @$this->db->get_where('class', array(
                'class_id' => $row['class_id']
            ))->row()->name;
            $data['section']     = @$this->db->get_where('section', array(
                'section_id' => $row['section_id']
            ))->row()->name;
            
            $parent_id           = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->parent_id;

            $parent_name = $this->db->get_where('parent', array(
                'parent_id' => $parent_id))->row();
            if ($parent_name) {
                $data['parent_name'] = $this->db->get_where('parent', array(
                    'parent_id' => $parent_id))->row()->name;
            }
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // get students basic info
    function get_student_profile_information()
    {
        $response        = array();
        $running_year    = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $student_id      = $this->input->post('student_id');
        $roll            = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->roll;
        $class_id        = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->class_id;
        $section_id      = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->section_id;
        $student_profile = $this->db->get_where('student', array(
            'student_id' => $student_id
        ))->result_array();
        foreach ($student_profile as $row) {
            $data['student_id']  = $row['student_id'];
            $data['name']        = $row['name'];
            $data['birthday']    = $row['birthday'];
            $data['gender']      = $row['sex'];
            $data['address']     = $row['address'];
            $data['phone']       = $row['phone'];
            $data['email']       = $row['email'];
            $data['roll']        = $roll;
            $data['class']       = $class_id;
            $data['section']     = $section_id;
            $data['parent_name'] = $this->db->get_where('parent', array(
                'parent_id' => $row['parent_id']
            ))->row()->name;
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            $data['other_fields'] = json_decode($this->db->get_where('student', array('student_id' => $row['student_id'])) -> row() -> otherfields);
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    
    function get_pre_student_profile_information()
    {
        $response        = array();
        $running_year    = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $student_id      = $this->input->post('student_id');
        $roll            = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->roll;
        $class_id        = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->class_id;
        $section_id      = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $running_year
        ))->row()->section_id;
        $student_profile = $this->db->get_where('pre_student', array(
            'pre_student_id' => $student_id
        ))->result_array();
        foreach ($student_profile as $row) {
            $data['student_id']  = $row['student_id'];
            $data['name']        = $row['name'];
            $data['birthday']    = $row['birthday'];
            $data['gender']      = $row['sex'];
            $data['address']     = $row['address'];
            $data['phone']       = $row['phone'];
            $data['email']       = $row['email'];
            $data['roll']        = $roll;
            $data['class']       = $class_id;
            $data['section']     = $section_id;
            $data['parent_name'] = $this->db->get_where('parent', array(
                'parent_id' => $row['parent_id']
            ))->row()->name;
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            $data['other_fields'] = json_decode($this->db->get_where('student', array('student_id' => $row['student_id'])) -> row() -> otherfields);
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // get student's mark info
    // ** exam_id, student_id, year required to get students from mark table
    function get_student_mark_information() 
    {
        $response            = array();
        $mark_array          = array();
        $exam_id             = $this->input->post('exam_id');
        $student_id          = $this->input->post('student_id');
        $running_year        = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $student_marks       = $this->db->get_where('mark', array(
            'exam_id' => $exam_id,
            'student_id' => $student_id,
            'year' => $running_year
        ))->result_array();
        $response['exam_id'] = $exam_id;
        foreach ($student_marks as $row) {
            //print_r($row);
            $data['mark_obtained'] = $row['mark_obtained'];
            $data['subject']       = $this->db->get_where('subject', array(
                'subject_id' => $row['subject_id'],
                'year' => $running_year
            ))->row()->name;
            $grade                 = $this->crud_model->get_grade($row['mark_obtained']);

            $data['grade']         = $grade['name'];
            //$data['heighest_marks'] = $this->crud_model->get_highest_marks_mobile( $row['exam_id'] , $row['class_id'] , $row['subject_id'] );
            $data['heighest_marks'] = $row['mark_total'];
            array_push($mark_array, $data);
        }
        $response['marks'] = $mark_array;
        echo json_encode($response);
    }
    // teacher list of the school
    function get_teachers()
    {
        $response = array();
        $teachers = $this->db->get('teacher')->result_array();
        foreach ($teachers as $row) {
            $data['teacher_id'] = $row['teacher_id'];
            $data['name']       = $row['name'];
            $data['birthday']   = $row['birthday'];
            $data['gender']     = $row['sex'];
            $data['address']    = $row['address'];
            $data['phone']      = $row['phone'];
            $data['email']      = $row['email'];
            $data['image_url']  = $this->crud_model->get_image_url('teacher', $row['teacher_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // teacher profile information
    function get_teacher_profile()
    {
        $response   = array();
        $teacher_id = $this->input->post('teacher_id');
        $response   = $this->db->get_where('teacher', array(
            'teacher_id' => $teacher_id
        ))->row();
        echo json_encode($response);
    }
    // get parent list
    function get_parents()
    {
        $response = array();
        $parents  = $this->db->get('parent')->result_array();
        foreach ($parents as $row) {
            $data['parent_id']  = $row['parent_id'];
            $data['name']       = $row['name'];
            $data['profession'] = $row['profession'];
            $data['address']    = $row['address'];
            $data['phone']      = $row['phone'];
            $data['email']      = $row['email'];
            $data['image_url']  = $this->crud_model->get_image_url('parent', $row['parent_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_admins() {
        $response = array();
        $admins = $this->db->get('admin')->result_array();
        //print_r($admins); die();
        foreach ($admins as $row) {
            $data['id'] =   $row['admin_id'];
            $data['type'] =   'admin';
            $data['name'] =   $row['name'];
            $data['email'] = $row['email'];
            $data['image_url']  = $this->crud_model->get_image_url('admin', $row['admin_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // get single parent profile
    function get_parent_profile()
    {
        $response  = array();
        $parent_id = $this->input->post('parent_id');
        $response  = $this->db->get_where('parent', array(
            'parent_id' => $parent_id
        ))->row();
        echo json_encode($response);
    }
    // income or expense history of school of submitted month
    function get_accounting()
    {
        $response        = array();
        $month           = $this->input->post('month');
        $year            = $this->input->post('year');
        $type            = $this->input->post('type');
        $start_timestamp = strtotime("1-" . $month . "-" . $year);
        $end_timestamp   = strtotime("30-" . $month . "-" . $year);
        $this->db->where("timestamp >=", $start_timestamp);
        $this->db->where("timestamp <=", $end_timestamp);
        $this->db->where("payment_type", $type);
        $response = $this->db->get('payment')->result_array();
        echo json_encode($response);
    }
    // attendance data response
    // ** timestamp, year, class_id, section_id, student_id to get attendance from attendance table
    function get_attendance()
    {
        $response     = array();
        $date         = $this->input->post('date');
        $month        = $this->input->post('month');
        $year         = $this->input->post('year');
        $class_id     = $this->input->post('class_id');
        $timestamp    = strtotime($date . '-' . $month . '-' . $year);
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $students     = $this->db->get_where('enroll', array(
            'class_id' => $class_id,
            'section_id' => $this->input->post('section_id'),
            'year' => $running_year
        ))->result_array();
        foreach ($students as $row) {
            $data['student_id'] = $row['student_id'];

            $data['roll']       = $row['roll'];
            $data['name']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $attendance_query   = $this->db->get_where('attendance', array(
                'timestamp' => $timestamp,
                'student_id' => $row['student_id']
            ));
            if ($attendance_query->num_rows() > 0) {
                $attendance_result_row = $attendance_query->row();
                $data['status']        = $attendance_result_row->status;
                $data['attendance_id'] = $attendance_result_row->attendance_id;
            } else {
                $data['status'] = '0';
            }
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // class routine : class and weekly day wise
    // ** class_id, section_id, subject_id, year to get section wise class routine from class_routine table
    function get_class_routine()
    {
        $response       = array();
        $class_id       = $this->input->post('class_id');
        $section_id     = $this->input->post('section_id');
        $day            = $this->input->post('day');
        $running_year   = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $class_routines = $this->db->get_where('class_routine', array(
            'class_id' => $class_id,
            'section_id' => $section_id,
            'day' => $day,
            'year' => $running_year
        ))->result_array();
        foreach ($class_routines as $row) {
            $data['class_id']       = $row['class_id'];
            $data['subject']        = $this->db->get_where('subject', array(
                'subject_id' => $row['subject_id'],
                'year' => $running_year
            ))->row()->name;
            $data['time_start']     = $row['time_start'];
            $data['time_end']       = $row['time_end'];
            $data['time_start_min'] = $row['time_start_min'];
            $data['time_end_min']   = $row['time_end_min'];
            $data['day']            = $row['day'];
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    // get subject name of subject_id
    function get_subject_name()
    {
        $response   = array();
        $subject_id = $this->input->post('subject_id');
        $response   = $this->db->get_where('subject', array(
            'subject_id' => $subject_id
        ))->row();
        echo json_encode($response);
    }
    // event calendar or noticeboard event list
    function get_event_calendar()
    {
        $response = array();

        $response = $this->db->order_by('create_timestamp', 'DESC')->get('noticeboard')->result_array();

        foreach ($response as $key => $value) {
            if ($response[$key]['image'] != '') {
                $response[$key]['image'] = base_url().'uploads/frontend/noticeboard/'.$response[$key]['image'];
            } else {
                $response[$key]['image'] = '';
            }

            if (strtotime(date('y-m-d') < $response[$key]['create_timestamp'])) {
                $response[$key]['active_status'] = 'Active';
            } else {
                $response[$key]['active_status'] = 'Past';
            }
        }
        echo json_encode($response);
    }
    // exam list
    // **  year required to get exam list from exam table
    function get_exam_list()
    {
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $response     = array();
        $response     = $this->db->get_where('exam', array(
            'year' => $running_year
        ))->result_array();
        echo json_encode($response);
    }
    // get subjects of a class
    // ** class_id, year required to get subjects of a class from subject table
    function get_subject_of_class()
    {
        $response     = array();
        $class_id     = $this->input->post('class_id');
        $section_id     = $this->input->post('section_id');
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        /*$subjects     = $this->db->get_where('subject', array(
            'class_id' => $class_id,
            'year' => $running_year
        ))->result_array();*/
        $this->db->select('*');
        if($class_id){
              $this->db->where('class_id',$class_id);
        }
        if($section_id){
             $this->db->where('section_id',$section_id);
        }
        
        $this->db->from('subject');
        $class_ids = $this->db->get()->result_array();
        $option = array();
        //print_r($class_ids); die;
        foreach ($class_ids as $key => $value) {
            $id_array = explode (",", $value['class_id']);
            //print_r($id_array); die();
            if (in_array($class_id, $id_array)) {
                $data['subject_id'] = $value['subject_id'];
                $data['name']       = $value['name'];
                /*$teacher_query      = $this->db->get_where('teacher', array(
                'teacher_id' => $value['teacher_id']));*/
                if(!empty($section_id)){
                     $option = array('subject_id'=>$value['subject_id'],'section_id'=>$section_id);
                }else{
                    $option = array('subject_id'=>$value['subject_id']);
                }
                $teacher_query =  $this->db->get_where('assign_subject',$option)->result();
                //print_r($teacher_query);


                $teacher_names = array();
                 $teacher_id = array();
            //if ($teacher_query) {
               
                foreach ($teacher_query as $key => $teacher_data) {
                    //print_r($teacher_data);
                    if ($teacher_data -> teacher_id != '') {
                        array_push($teacher_id,$teacher_data -> teacher_id);
                        array_push($teacher_names, $this->crud_model->get_type_name_by_id('teacher',$teacher_data -> teacher_id)."(".$this->crud_model->get_type_name_by_id('section',$teacher_data->section_id).")");
                    } else {
                         array_push($teacher_id,'');
                        array_push($teacher_names, '');
                    }
                }
                
                $data['teacher_name'] = implode(', ', $teacher_names);
                $data['teacher_id'] = implode(', ', $teacher_id);
               /* $teacher_query_row    = $teacher_query->row();
                $data['teacher_name'] = $teacher_query_row->name;
            } else {
                array_push($teacher_names, '');
            }*/

            //print_r($teacher_names); die();
            array_push($response, $data);
        }
    }
        //}

        /*foreach ($subjects as $row) {
            $data['subject_id'] = $row['subject_id'];
            $data['name']       = $row['name'];
            $teacher_query      = $this->db->get_where('teacher', array(
                'teacher_id' => $row['teacher_id']
            ));
            if ($teacher_query->num_rows() > 0) {
                $teacher_query_row    = $teacher_query->row();
                $data['teacher_name'] = $teacher_query_row->name;
            } else {
                $data['teacher_name'] = '';
            }
            array_push($response, $data);
        }*/
        echo json_encode($response);
    }
    // student mark list, subject, class, exam wise
    // ** exam_id, class_id, subject_id, year required to get student wise marks
    function get_marks()
    {
        $response     = array();
        $exam_id      = $this->input->post('exam_id');
        $class_id     = $this->input->post('class_id');
        $subject_id   = $this->input->post('subject_id');
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $marks        = $this->db->get_where('mark', array(
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'year' => $running_year
        ))->result_array();
        foreach ($marks as $row) {
            $data['class_id']      = $row['class_id'];
            $data['student_id']    = $row['student_id'];
            $data['student_name']  = $this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $data['student_roll']  = $this->db->get_where('enroll', array(
                'student_id' => $row['student_id'],
                'year' => $running_year
            ))->row()->roll;
            $data['exam_id']       = $row['exam_id'];
            $data['mark_obtained'] = $row['mark_obtained'];
            array_push($response, $data);
        }
        echo json_encode($response);
    }
    function get_loggedin_user_profile()
    {
        $response      = array();
        $login_type    = $this->input->post('login_type');
        $login_user_id = $this->input->post('login_user_id');

        if($login_type != 'driver' && $login_type != 'warden' && $login_type != 'guard' && $login_type != 'inventory' && $login_type != 'transport') {

            $user_profile  = $this->db->get_where($login_type, array(
                $login_type . '_id' => $login_user_id
            ))->result_array();
            foreach ($user_profile as $row) {
                $data['name']      = $row['name'];
                $data['email']     = $row['email'];
                $data['image_url'] = $this->crud_model->get_image_url($login_type, $login_user_id);
                if ($login_type == 'parent') {
                    $data['address'] = $row['address'];
                    $data['phone'] = $row['phone'];
                    $data['profession'] = $row['profession'];
                }
                break;
            }
            array_push($response, $data);
        } else {
            $user_profile  = $this->db->get_where('employees', array('user_id' => $login_user_id))->result_array();
            $email = $this->db->get_where('designation_users', array('designation_users_id' => $login_user_id)) -> row() -> email;

            foreach ($user_profile as $row) {
                $data['name']      = $row['name'];
                $data['email']     = $email;
                $data['image_url'] = $this->crud_model->get_image_url($login_type, $login_user_id);
                break;
            }
            array_push($response, $data);

        }
        echo json_encode($response);
    }

    function update_user_image()
    {
        $response  = array();
        $user_type = $this->input->post('login_type');
        $user_id   = $this->input->post('login_user_id');
        $directory = 'uploads/' . $user_type . '_image/' . $user_id . '.jpg';
        move_uploaded_file($_FILES['user_image']['tmp_name'], $directory);
        $response = array(
            'update_status' => 'success'
        );
        echo json_encode($response);
    }
    function update_user_info()
    {
        $response      = array();
        $user_type     = $this->input->post('login_type');
        $user_id       = $this->input->post('login_user_id');

        if ($user_type != 'driver' && $user_type != 'warden' && $user_type != 'guard' && $user_type != 'inventory' && $user_type != 'transport') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $this->db->where($user_type . '_id', $user_id);
            $this->db->update($user_type, $data);
            $response = array(
                'update_status' => 'success'
            );
        } else {
            $data['name'] = $this->input->post('name');
            $data2['email'] =  $this->input->post('email');

            $this->db->where('user_id', $user_id);
            $query = $this->db->update('employees', $data);
            if ($query) {
                $this->db->where('designation_users_id', $user_id);
                $this->db->update('designation_users', $data2);
                $response = array(
                    'update_status' => 'success'
                );
            }
        }
        echo json_encode($response);
    }
    function update_user_password()
    {
        $response         = array();
        $user_type        = $this->input->post('login_type');
        $user_id          = $this->input->post('login_user_id');
        $old_password     = sha1($this->input->post('old_password'));
        $data['password'] = sha1($this->input->post('new_password'));
        // verify if old password matches

        if ($user_type != 'driver' && $user_type != 'guard' && $user_type != 'warden' && $user_type != 'inventory' && $user_type != 'transport'){
            $this->db->where($user_type . '_id', $user_id);
            $this->db->where('password', $old_password);
            $verify_query = $this->db->get($user_type);
            if ($verify_query->num_rows() > 0) {
                $this->db->where($user_type . '_id', $user_id);
                $this->db->update($user_type, $data);
                $response = array(
                    'update_status' => 'success'
                );
            } else {
                $response = array(
                    'update_status' => 'failed'
                );
            }
        } else {
           $this->db->where('designation_users_id', $user_id);
           $this->db->where('password', $old_password);
           $verify_query = $this->db->get('designation_users');
           if ($verify_query->num_rows() > 0) {
            $this->db->where('designation_users_id', $user_id);
            $this->db->update('designation_users', $data);
            $response = array(
                'update_status' => 'success'
            );
        } else {
            $response = array(
                'update_status' => 'failed'
            );
        }
    }
    echo json_encode($response);
}
    // total number of students
    // ** year required to get total student from enrollment table
    // ** timestamp, status required to get todays present students from student table
function get_total_summary()
{
    $response     = array();
    $running_year = $this->db->get_where('settings', array(
        'type' => 'running_year'
    ))->row()->description;
    $this->db->where('year', $running_year);
    $this->db->from('enroll');
    $response['total_student']       = $this->db->count_all_results();
    $response['total_teacher']       = $this->db->count_all('teacher');
    $response['total_parent']        = $this->db->count_all('parent');
        // student present today
    $check                           = array(
        'timestamp' => strtotime(date('d-m-Y')),
        'status' => '1'
    );
    $query                           = $this->db->get_where('attendance', $check);
    $present_today                   = $query->num_rows();
    $response['total_present_today'] = $present_today;
    echo json_encode($response);
}
    // dummy function
function getdata()
{
    $response = array();
    $postvar  = $this->input->post('postvar');
    $response = $this->db->get_where('table', array(
        'postvar' => $postvar
    ))->result_array();
    echo json_encode($response);
}
    // Parents functions : own child list, class routine, exam marks of child, invoice of child, event schedule
function get_children_of_parent()
{
    $response             = array();
    $parent_id            = $this->input->post('parent_id');
    $response['children'] = $this->db->get_where('student', array(
        'parent_id' => $parent_id
    ))->result_array();
    echo json_encode($response);
}
function get_child_class_routine()
{
}
function get_child_exam_marks()
{
}
function get_child_accounting()
{
}
    // Students functions : own child list, class routine, exam marks of child, invoice of child, event schedule
function get_own_subjects()
{
}
function get_own_class_routine()
{
}
function get_own_marks()
{
}
function get_single_student_accounting()
{
    $response   = array();
    $student_id = $this->input->post("student_id");
    $this->db->where("student_id", $student_id);
    $response = $this->db->get('invoice')->result_array();
    echo json_encode($response);
}
    // user login matching with db
// function login()
// {
//     $response = array();
//     $email    = $this->input->post("email");
//     $password = sha1($this->input->post("password"));

//         // Checking login credential for admin
//     $query    = $this->db->get_where('admin', array(
//         'email' => $email,
//         'password' => $password
//     ));
//     if ($query->num_rows() > 0) {
//         $row                            = $query->row();
//         $authentication_key             = md5(rand(10000, 1000000));
//         $response['status']             = 'success';
//         $response['login_type']         = 'admin';
//         $response['login_user_id']      = $row->admin_id;
//         $response['name']               = $row->name;
//         $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//         $this->db->where('admin_id', $row->admin_id);
//         $this->db->update('admin', array(
//             'authentication_key' => $authentication_key
//         ));
//         echo json_encode($response);
//         return;
//     }
//         // Checking login credential for teacher
//     $query = $this->db->get_where('teacher', array(
//         'email' => $email,
//         'password' => $password
//     ));
//     if ($query->num_rows() > 0) {
//         $row                            = $query->row();
//         $authentication_key             = md5(rand(10000, 1000000));
//         $response['status']             = 'success';
//         $response['login_type']         = 'teacher';
//         $response['login_user_id']      = $row->teacher_id;
//         $response['name']               = $row->name;
//         $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//         $this->db->where('teacher_id', $row->teacher_id);
//         $this->db->update('teacher', array(
//             'authentication_key' => $authentication_key
//         ));
//         echo json_encode($response);
//         return;
//     }


//          // Checking login credential for librarian
//     $query = $this->db->get_where('librarian', array(
//         'email' => $email,
//         'password' => $password
//     ));
//     if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'librarian';
//       $response['login_user_id']      = $row->librarian_id;
//       $response['name']               = $row->name;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('librarian_id', $row->librarian_id);
//       $this->db->update('librarian', array(
//         'authentication_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }

//       // Checking login credential for ACCOUNTANT
//   $query = $this->db->get_where('accountant', array(
//     'email' => $email,
//     'password' => $password
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'accountant';
//       $response['login_user_id']      = $row->accountant_id;
//       $response['name']               = $row->name;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('accountant_id', $row->accountant_id);
//       $this->db->update('accountant', array(
//         'authentication_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }


//       // Checking login credential for DRIVER
//   $query = $this->db->get_where('designation_users', array(
//     'email' => $email,
//     'password' => $password,
//     'role_id' => 9
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
//           //print_r($query2);
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'driver';
//       $response['login_user_id']      = $row->designation_users_id;
//       $response['name']               = $query2->name;
//       $response['phone']               = $query2->phone;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('designation_users_id', $row->designation_users_id);
//       $this->db->update('designation_users', array(
//         'reset_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }

//       // Checking login credential for WARDEN
//   $query = $this->db->get_where('designation_users', array(
//     'email' => $email,
//     'password' => $password,
//     'role_id' => 13
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
//           //print_r($query2);
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'warden';
//       $response['login_user_id']      = $row->designation_users_id;
//       $response['name']               = $query2->name;
//       $response['phone']               = $query2->phone;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('designation_users_id', $row->designation_users_id);
//       $this->db->update('designation_users', array(
//         'reset_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }


//       // Checking login credential for SECURITY GUARD
//   $query = $this->db->get_where('designation_users', array(
//     'email' => $email,
//     'password' => $password,
//     'role_id' => 16
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
//           //print_r($query2);
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'guard';
//       $response['login_user_id']      = $row->designation_users_id;
//       $response['name']               = $query2->name;
//       $response['phone']               = $query2->phone;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('designation_users_id', $row->designation_users_id);
//       $this->db->update('designation_users', array(
//         'reset_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }
  
//   // Checking login credential for INVENTORY
//   $query = $this->db->get_where('designation_users', array(
//     'email' => $email,
//     'password' => $password,
//     'role_id' => 17
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
//           //print_r($query2);
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'inventory';
//       $response['login_user_id']      = $row->designation_users_id;
//       $response['name']               = $query2->name;
//       $response['phone']               = $query2->phone;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('designation_users_id', $row->designation_users_id);
//       $this->db->update('designation_users', array(
//         'reset_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }
  
//   // Checking login credential for TRANSPORT
//   $query = $this->db->get_where('designation_users', array(
//     'email' => $email,
//     'password' => $password,
//     'role_id' => 18
// ));
//   if ($query->num_rows() > 0) {
//       $row                            = $query->row();
//       $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
//           //print_r($query2);
//       $authentication_key             = md5(rand(10000, 1000000));
//       $response['status']             = 'success';
//       $response['login_type']         = 'transport';
//       $response['login_user_id']      = $row->designation_users_id;
//       $response['name']               = $query2->name;
//       $response['phone']               = $query2->phone;
//       $response['authentication_key'] = $authentication_key;
//             // update the new authentication key into user table
//       $this->db->where('designation_users_id', $row->designation_users_id);
//       $this->db->update('designation_users', array(
//         'reset_key' => $authentication_key
//     ));
//       echo json_encode($response);
//       return;
//   }

//         // Checking login credential for student
//   $query = $this->db->get_where('student', array(
//     'email' => $email,
//     'password' => $password,
//     'status' => 1
// ));
//   if ($query->num_rows() > 0) {
//     $running_year                   = $this->db->get_where('settings', array(
//         'type' => 'running_year'
//     ))->row()->description;
//     $row                            = $query->row();
//     $authentication_key             = md5(rand(10000, 1000000));
//     $response['status']             = 'success';
//     $response['login_type']         = 'student';
//     $response['is_transport_member'] = $row->is_transport_member;
//     $response['login_user_id']      = $row->student_id;
//     $response['name']               = $row->name;
//     $response['student_code']       = $row->student_code;
//     $response['hostel_id']          = $row->hostel_id;
//     $response['authentication_key'] = $authentication_key;
//     if ($row -> is_transport_member == 1) {
//         $response['transport_id'] = $row->transport_id;
//     } else {
//         $response['transport_id'] = '0';
//     }
//     $response['class_id']           = $this->db->get_where('enroll', array(
//         'student_id' => $row->student_id,
//         'year' => $running_year
//     ))->row()->class_id;
//     $response['section_id']         = $this->db->get_where('enroll', array(
//         'student_id' => $row->student_id,
//         'year' => $running_year
//     ))->row()->section_id;
//     $response['card_code']         = @$this->db->get_where('enroll', array(
//         'student_id' => $row->student_id
//     ))->row()->card_code;
//     $response['card_status']         = @$this->db->get_where('enroll', array(
//         'student_id' => $row->student_id
//     ))->row()->card_code_status;
//             // update the new authentication key into user table
//     $this->db->where('student_id', $row->student_id);
//     $this->db->update('student', array(
//         'authentication_key' => $authentication_key
//     ));
//     echo json_encode($response);
//     return;
// }
//         // Checking login credential for parent
// $query = $this->db->get_where('parent', array(
//     'email' => $email,
//     'password' => $password
// ));
// if ($query->num_rows() > 0) {
//     $row                            = $query->row();
//     $authentication_key             = md5(rand(10000, 1000000));
//     $response['status']             = 'success';
//     $response['login_type']         = 'parent';
//     $response['login_user_id']      = $row->parent_id;
//     $response['name']               = $row->name;
//     $response['authentication_key'] = $authentication_key;
//     $response['children']           = $this->db->get_where('student', array(
//         'parent_id' => $row->parent_id
//     ))->result_array();
//             // update the new authentication key into user table
//     $this->db->where('parent_id', $row->parent_id);
//     $this->db->update('parent', array(
//         'authentication_key' => $authentication_key
//     ));
//     echo json_encode($response);
//     return;
// } else {
//     $response['status'] = 'failed';
// }
// echo json_encode($response);
// }



function login(){
    $response = array();
    $email    = $this->input->post("email");
    $password = sha1($this->input->post("password"));
    // Checking login credential for admin
    $query    = $this->db->get_where('admin', array(
        'email' => $email,
        'password' => $password
    ));
    if ($query->num_rows() > 0) {
        $row                            = $query->row();
        $authentication_key             = md5(rand(10000, 1000000));
        $response['status']             = 'success';
        $response['login_type']         = 'admin';
        $response['login_user_id']      = $row->admin_id;
        $response['name']               = $row->name;
        $response['authentication_key'] = $authentication_key;
            // update the new authentication key into user table
        $this->db->where('admin_id', $row->admin_id);
        $this->db->update('admin', array(
            'authentication_key' => $authentication_key
        ));
        echo json_encode($response);
        return;
    }
    // Checking login credential for student
    $query = $this->db->get_where('student', array(
        'email' => $email,
        'password' => $password,
        'status' => 1
    ));
    if ($query->num_rows() > 0) {
        $running_year                   = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $row                            = $query->row();
        $authentication_key             = md5(rand(10000, 1000000));
        $response['status']             = 'success';
        $response['login_type']         = 'student';
        $response['is_transport_member'] = $row->is_transport_member;
        $response['login_user_id']      = $row->student_id;
        $response['name']               = $row->name;
        $response['student_code']       = $row->student_code;
        $response['hostel_id']          = $row->hostel_id;
        $response['authentication_key'] = $authentication_key;
        if ($row -> is_transport_member == 1) {
            $response['transport_id'] = $row->transport_id;
        } else {
            $response['transport_id'] = '0';
        }
        $response['class_id']           = $this->db->get_where('enroll', array(
            'student_id' => $row->student_id,
            'year' => $running_year
        ))->row()->class_id;
        $response['section_id']         = $this->db->get_where('enroll', array(
            'student_id' => $row->student_id,
            'year' => $running_year
        ))->row()->section_id;
        $response['card_code']         = @$this->db->get_where('enroll', array(
            'student_id' => $row->student_id
        ))->row()->card_code;
        $response['card_status']         = @$this->db->get_where('enroll', array(
            'student_id' => $row->student_id
        ))->row()->card_code_status;
                // update the new authentication key into user table
        $this->db->where('student_id', $row->student_id);
        $this->db->update('student', array(
            'authentication_key' => $authentication_key
        ));
        echo json_encode($response);
        return;
    }
    // Checking login credential for parent
    $query = $this->db->get_where('parent', array(
        'email' => $email,
        'password' => $password
    ));
    if ($query->num_rows() > 0) {
        $row                            = $query->row();
        $authentication_key             = md5(rand(10000, 1000000));
        $response['status']             = 'success';
        $response['login_type']         = 'parent';
        $response['login_user_id']      = $row->parent_id;
        $response['name']               = $row->name;
        $response['authentication_key'] = $authentication_key;
        $response['children']           = $this->db->get_where('student', array(
            'parent_id' => $row->parent_id
        ))->result_array();
                // update the new authentication key into user table
        $this->db->where('parent_id', $row->parent_id);
        $this->db->update('parent', array(
            'authentication_key' => $authentication_key
        ));
        echo json_encode($response);
        return;
    }
    // Checking login credential for Staff
    $query = $this->db->get_where('designation_users', array(
        'email' => $email,
        'password' => $password
    ));
    if ($query->num_rows() > 0) {
        $row                            = $query->row();
        $query2 = $this->db->get_where('employees', array('user_id' => $row->designation_users_id)) -> row();
          //print_r($query2);
        $authentication_key             = md5(rand(10000, 1000000));
        $response['status']             = 'success';
        $response['login_type']         = lcfirst($this->db->get_where('designations',['id' => $query2->designation_id])->row()->name);
        $response['login_user_id']      = $row->designation_users_id;
        $response['name']               = $query2->name;
        $response['phone']               = $query2->phone;
        $response['authentication_key'] = $authentication_key;
            // update the new authentication key into user table
        $this->db->where('designation_users_id', $row->designation_users_id);
        $this->db->update('designation_users', array(
            'reset_key' => $authentication_key
        ));
        echo json_encode($response);
        return;
    } else {
        $response['status'] = 'failed';
    }
    echo json_encode($response);
}
    // forgot password link
function reset_password()
{
    $response           = array();
    $response['status'] = 'false';
    $email              = $_POST["email"];
    $reset_account_type = '';
        //resetting user password here
    $new_password       = substr((rand(100000, 2000000)), 0, 7);
        // Checking credential for admin
    $query              = $this->db->get_where('admin', array(
        'email' => $email
    ));
    if ($query->num_rows() > 0) {
        $reset_account_type = 'admin';
        $this->db->where('email', $email);
        $this->db->update('admin', array(
            'password' => sha1($new_password)
        ));
        $response['status'] = 'true';
        @$this->email_model->password_reset_email($new_password, $reset_account_type, $email);
    }
        // Checking credential for student
    $query = $this->db->get_where('student', array(
        'email' => $email
    ));
    if ($query->num_rows() > 0) {
        $reset_account_type = 'student';
        $this->db->where('email', $email);
        $this->db->update('student', array(
            'password' => sha1($new_password)
        ));
        $response['status'] = 'true';
        @$this->email_model->password_reset_email($new_password, $reset_account_type, $email);
    }
        // Checking credential for teacher
    // $query = $this->db->get_where('teacher', array(
    //     'email' => $email
    // ));
    // if ($query->num_rows() > 0) {
    //     $reset_account_type = 'teacher';
    //     $this->db->where('email', $email);
    //     $this->db->update('teacher', array(
    //         'password' => sha1($new_password)
    //     ));
    //     $response['status'] = 'true';
    //     @$this->email_model->password_reset_email($new_password, $reset_account_type, $email);
    // }
        // Checking credential for parent
    $query = $this->db->get_where('parent', array(
        'email' => $email
    ));
    if ($query->num_rows() > 0) {
        $reset_account_type = 'parent';
        $this->db->where('email', $email);
        $this->db->update('parent', array(
            'password' => sha1($new_password)
        ));
        $response['status'] = 'true';
        @$this->email_model->password_reset_email($new_password, $reset_account_type, $email);
    }
    $query = $this->db->get_where('designation_users', array('email' => $email));
      if ($query->num_rows() > 0) {
          $designation = lcfirst($this->db->get_where('designations',['id' => $employee->designation_id])->row()->name);
          $reset_account_type     =   $designation;
        $this->db->where('email' , $email);
        $this->db->update('designation_users' , array('password' => sha1($new_password)));
        // send new password to user email
        $response['status'] = 'true';
        @$this->email_model->password_reset_email($new_password, $reset_account_type, $email);
      }
        // send new password to user email
    //if ($query->num_rows() > 0) {
    	
	//}
    echo json_encode($response);
}
function get_notices()
{
    $response = array();
    $query    = $this->db->get("noticeboard")->result_array();
    foreach ($query as $row) {
        $data['notice_id']    = $row['notice_id'];
        $data['notice_title'] = $row['notice_title'];
        $data['notice']       = $row['notice'];
        $data['date']         = date('d-M-Y', $row['create_timestamp']);
        array_push($response, $data);
    }
    echo json_encode($response);
}

    // private messaging
    // @ $user -> user_type-user_id -> admin-1
function get_message_threads() {
    $response = array();
    $user = $this->input->post('user');
    $this->db->where('sender', $user);
    $this->db->or_where('reciever', $user);
    $threads = $this->db->get('message_thread')->result_array();
    foreach ($threads as $row) {
        $sender   = explode('-', $row['sender']);
        $receiver = explode('-', $row['reciever']);
        $sender_name = $this->db->get_where($sender[0], array($sender[0].'_id' => $sender[1]))->row()->name;
        $receiver_name = $this->db->get_where($receiver[0], array($receiver[0].'_id' => $receiver[1]))->row()->name;
        $user_type = ($user == $row['sender']) ? $receiver[0] : $sender[0];
        $user_name = ($user == $row['sender']) ? $receiver_name : $sender_name;
        $user_id = ($user == $row['sender']) ? $receiver[1] : $sender[1];
        if (file_exists('uploads/'.$user_type.'_image/'.$user_id.'.jpg'))
            $image_url = base_url('uploads/'.$user_type.'_image/'.$user_id.'.jpg');
        else
            $image_url = base_url('uploads/user.jpg');
        $data['message_thread_code']    =   $row['message_thread_code'];
        $data['user_type']              =   $user_type;
        $data['user_name']              =   $user_name;
        $data['image_url']              =   $image_url;
        array_push($response, $data);
    }
    echo json_encode($response);
}
function get_messages() {
    $response = array();
    $message_thread_code = $this->input->post('message_thread_code');
    $this->db->where('message_thread_code', $message_thread_code);
    $this->db->order_by('timestamp', 'asc');
    $messages = $this->db->get('message')->result_array();
    foreach ($messages as $row) {
        $sender = explode('-', $row['sender']);
        $sender_name = $this->db->get_where($sender[0], array($sender[0].'_id' => $sender[1]))->row()->name;
        $data['sender']         =   $row['sender'];
        $data['sender_type']    =   $sender[0];
        $data['sender_id']      =   $sender[1];
        $data['sender_name']    =   $sender_name;
        $data['message']        =   $row['message'];
        $data['date']           =   date('d M, Y', $row['timestamp']);
        array_push($response, $data);
    }
    echo json_encode($response);
}
function get_receivers() {
    $student_array = array();
    $teacher_array = array();
    $parent_array = array();
    $admin_array = array();
    $response = array();
    $for_user = $this->input->post('for_user');
    $for_user = explode('-', $for_user);
    $type = $for_user[0];
        // students
    $this->db->order_by('name', 'asc');
    $students = $this->db->get('student')->result_array();
    foreach ($students as $row) {
        $data['id'] =   $row['student_id'];
        $data['type'] =   'student';
        $data['name'] =   $row['name'];
        array_push($student_array, $data);
    }
        // teachers
    $this->db->order_by('name', 'asc');
    $teachers = $this->db->get('teacher')->result_array();
    foreach ($teachers as $row) {
        $data['id'] =   $row['teacher_id'];
        $data['type'] =   'teacher';
        $data['name'] =   $row['name'];
        array_push($teacher_array, $data);
    }
        // parents
    $this->db->order_by('name', 'asc');
    $parents = $this->db->get('parent')->result_array();
    foreach ($parents as $row) {
        $data['id'] =   $row['parent_id'];
        $data['type'] =   'parent';
        $data['name'] =   $row['name'];
        array_push($parent_array, $data);
    }
        // admins
    $this->db->order_by('name', 'asc');
    $admins = $this->db->get('admin')->result_array();
    foreach ($admins as $row) {
        $data['id'] =   $row['admin_id'];
        $data['type'] =   'admin';
        $data['name'] =   $row['name'];
        array_push($admin_array, $data);
    }
    if ($type == 'admin') {
        $response = array_merge($teacher_array, $parent_array, $student_array);
        echo json_encode($response);
    } else if ($type == 'teacher') {
        $response = array_merge($admin_array, $parent_array, $student_array);
        echo json_encode($response);
    } else if ($type == 'student') {
        $response = array_merge($admin_array, $teacher_array);
        echo json_encode($response);
    } else {
        $response = array_merge($admin_array, $teacher_array);
        echo json_encode($response);
    }
}
function send_new_message() {
    $response   =   array();
    $message    =   $this->input->post('message');
    $receiver   =   $this->input->post('receiver');
    $sender     =   $this->input->post('sender');
    $timestamp  =   strtotime(date("Y-m-d H:i:s"));
        //check if the thread between those 2 users exists, if not create new thread
    $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $receiver))->num_rows();
    $num2 = $this->db->get_where('message_thread', array('sender' => $receiver, 'reciever' => $sender))->num_rows();
    if ($num1 == 0 && $num2 == 0) {
        $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data_message_thread['message_thread_code'] = $message_thread_code;
        $data_message_thread['sender']              = $sender;
        $data_message_thread['reciever']            = $receiver;
        $this->db->insert('message_thread', $data_message_thread);
    }
    if ($num1 > 0)
        $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $receiver))->row()->message_thread_code;
    if ($num2 > 0)
        $message_thread_code = $this->db->get_where('message_thread', array('sender' => $receiver, 'reciever' => $sender))->row()->message_thread_code;
    $data_message['message_thread_code']    = $message_thread_code;
    $data_message['message']                = $message;
    $data_message['sender']                 = $sender;
    $data_message['timestamp']              = $timestamp;
    $this->db->insert('message', $data_message);
    $data['message_thread_code']    =   $message_thread_code;
    array_push($response, $data);
    echo json_encode($response);
}
function send_reply() {
    $message_thread_code    =   $this->input->post('message_thread_code');
    $message                =   $this->input->post('message');
    $timestamp              =   strtotime(date("Y-m-d H:i:s"));
    $sender                 =   $this->input->post('sender');

    $data_message['message_thread_code']    = $message_thread_code;
    $data_message['message']                = $message;
    $data_message['sender']                 = $sender;
    $data_message['timestamp']              = $timestamp;
    $this->db->insert('message', $data_message);
    $data['message_thread_code']    =   $message_thread_code;
    echo 'success';
}

    // authentication_key validation
function validate_auth_key()
{

        /*
         * Ignore the authentication and returns success by default to constructor
         * For pubic calls: login, forget password.
         * Pass post parameter 'authenticate' = 'false' to ignore the user level authentication
         */
        if ($this->input->post('authenticate') == 'false')
            return 'success';
        $response           = array();
        $authentication_key = $this->input->post("authentication_key");
        $user_type          = $this->input->post("user_type");

        if ($user_type != 'driver' && $user_type != 'warden' && $user_type != 'guard' && $user_type != 'inventory' && $user_type != 'inventory') {
            $query              = $this->db->get_where($user_type, array(
                'authentication_key' => $authentication_key
            ));
            if ($query->num_rows() > 0) {
                $row                    = $query->row();
                $response['status']     = 'success';
                $response['login_type'] = 'admin';
                if ($user_type == 'admin')
                    $response['login_user_id'] = $row->admin_id;
                if ($user_type == 'teacher')
                    $response['login_user_id'] = $row->teacher_id;
                if ($user_type == 'student')
                    $response['login_user_id'] = $row->student_id;
                if ($user_type == 'parent')
                    $response['login_user_id'] = $row->parent_id;
                if ($user_type == 'librarian')
                    $response['login_user_id'] = $row->librarian_id;
                $response['authentication_key'] = $authentication_key;
            } else {
                $response['status'] = 'failed';
            }
        //return json_encode($response);
            return $response['status'];
        } else {

            $query = $this->db->get_where('designation_users', array('reset_key' => $authentication_key));
            if ($query->num_rows() > 0) {
                $row                    = $query->row();
                $response['status']     = 'success';
                $response['login_user_id'] = $row->designation_users_id;
                $response['authentication_key'] = $authentication_key;
            } else {
                $response['status'] = 'failed';
            }

            return $response['status'];
        }
    }

    function test() {
        echo('success');
    }

    function get_guardians() {
        $timenow = strtotime(date('Y-m-d H:i:s'));
       // echo $timenow; die;
       if($this->input->post('user_type') !== 'student'){
           if(!empty($this->input->post('student_id'))){
                $this->guardian->db->where('student_id',$this->input->post('student_id'));
           }
       }
        if ($this->input->post('user_type') == 'parent') {
            if ($this->input->post('is_assigning') == 1) {
                $guardianList = $this->guardian->get_guardian_list_mobile($this->input->post('user_type'), $this->input->post('user_id'));
            }  else {
            //Getting all students for parent
                $students = $this->db->get_where('student' , array('parent_id' => $this->input->post('user_id')))->result_array();
                if (sizeof($students) > 0) {
                    $student_ids = array();
                    foreach ($students as $key => $value) {
                        array_push($student_ids, $value['student_id']);
                    }

                    $this->db->select('*');
                    $this->db->from('assign_guardian_list');
                   // $this->db->where('date_from >=', $timenow);
                    $this->db->where_in('student_id', $student_ids);
                    
                    
                    $assigned_guardians = $this->db->get()->result_array();
                    if (sizeof($assigned_guardians) > 0) {
                        $guardian_ids = array();
                        foreach ($assigned_guardians as $key2 => $value2) {
                           // print_r($value2['date_from']); die;
                           if ($timenow >= strtotime($value2['date_from']) && $timenow <= strtotime($value2['date_to'])) {
                               echo $value2['date_from'].'\n';
                                array_push($guardian_ids, $value2['guardian_id']);
                           }
                        }
                        
                       // die;
                       if ($guardian_ids) {
                        $this->db->select('*');
                        $this->db->from('guardians');
                        $this->db->where_in('id', $guardian_ids);
                        //print_r($guardian_ids);
                        $guardianList = $this->db->get()->result();
                       } else {
                           $guardianList = array();
                       }
                    } else {
                        $guardianList = array();
                    }
                }  else {
                    $guardianList = array();
                }
            }
        } else {
            $guardianList = $this->guardian->get_guardian_list_mobile($this->input->post('user_type'), $this->input->post('user_id'));
        }
        foreach ($guardianList as $key => $obj) {
            $guardianList[$key] -> student_data = $this->db->get_where('student', array('student_id' => $obj -> student_id)) -> result()[0];
            $guardianList[$key] -> photo = base_url() . 'assets/uploads/guardian-photo/'. $guardianList[$key] -> photo;
        }
        $data['status'] = 200;
        $data['guardians'] = $guardianList;

        echo json_encode($data);
    }

    function get_assigned_guardians() {
        if ($this->input->post('user_type') == 'parent') {
            $this->db->select('GA.*, G.name AS guardians, G.id as guardians_id,G.relation,G.photo,G.doc_photo,G.profession,S.name AS student, GA.date_from, GA.date_to, G.phone');
            $this->db->from('assign_guardian_list AS GA');
            $this->db->join('guardians AS G', 'G.id = GA.guardian_id', 'left');
            $this->db->join('student AS S', 'S.student_id = GA.student_id', 'left');
            $this->db->where('GA.create_by', $this->input->post('user_id'));
            $guardianList =  $this->db->get()->result();
            
        } else {
            $guardianList = $this->guardian->get_guardian_list_mobile($this->input->post('user_type'), $this->input->post('user_id'));
        }
        foreach ($guardianList as $key => $obj) {
            $guardianList[$key] -> student_data = $this->db->get_where('student', array('student_id' => $obj -> student_id)) -> result()[0];
            $guardianList[$key] -> photo = base_url() . 'assets/uploads/guardian-photo/'. $guardianList[$key] -> photo;
        }
        $data['status'] = 200;
        $data['guardians'] = $guardianList;

        echo json_encode($data);

    }
/*    
    function getClassTeacherList(){
        $section_details=array();
        $section=$this->db->get('section')->result_array();
        for($i=0;$i<sizeof($section);$i++){
            $teacher_id=$section[$i]['teacher_id'];
            $section_details[$i]=$section[$i];
            $section_details['teacher']=$this->db->get_where('teacher',array('teacher_id',$teacher_id))->result_array();
            break;
            
        }
        $data['status'] = 200;
        $data['teachers'] = $section_details;

        echo json_encode($data);
        
        
       
    }*/

    function unassign_class_teacher(){
        $section_id=$this->input->post('id');
        $this->db->where('section_id',$section_id);
        $this->db->update("section",array('teacher_id'=>null));
         $data['status'] = 200;
        echo json_encode($data);
    }
    
    function assign_class_teacher(){
        $section_id=$this->input->post('id');
        $teacher_id=$this->input->post('teacher_id');
        
        $validation_teacher = $this->validation_teacher($teacher_id);
            if($validation_teacher == 1){
                if(!empty($this->input->post('id'))){
                    $this->db->where('section_id',$section_id);
                    $this->db->update("section",array('teacher_id'=>$teacher_id));
                    $data['status'] = 200;
                   
                }
               
            } else{
                if($validation_teacher == 0) {
                    $data = array('status'=>401,'error'=>'teacher_already_assigned');
                }

            }
             echo json_encode($data);
            
    }

    
    function get_routes() {
        $routeList = $this->route->get_all_routes();

        foreach($routeList as $key => $obj){
            $routeList[$key] -> vehicle_number = get_vehicle_by_ids($obj->vehicle_ids);

            /*$myData = json_decode($obj -> stop_details, false);
            $myData = json_decode($myData);*/
            $md = json_decode($obj -> stop_details);
            $ms = array();

            //print_r($md);
            for($i = 0; $i < sizeof($md); $i++) {
                $ms[$i] = json_decode($md[$i]);

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            $routeList[$key] -> stop_details = $ms;
        }
        $data['status'] = 200;
        $data['data'] = $routeList;
        echo json_encode($data);
    }
    
    function addRoutes(){
        
    
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required');
        $this->form_validation->set_rules('route_start', $this->lang->line('route_start'), 'trim|required');
         $this->form_validation->set_rules('route_end', $this->lang->line('route_end'), 'trim|required');
         $this->form_validation->set_rules('source_lat', $this->lang->line('source_lat'), 'trim|required');
         $this->form_validation->set_rules('source_long', $this->lang->line('source_long'), 'trim|required');
         $this->form_validation->set_rules('dest_lat', $this->lang->line('dest_lat'), 'trim|required');
         $this->form_validation->set_rules('dest_long', $this->lang->line('dest_long'), 'trim|required');
       
       
        if ($this->form_validation->run() === TRUE) {
        
        $data['title'] = $this->input->post('title');
        $data['route_start']   = $this->input->post('route_start');
        $data['route_end']  = $this->input->post('route_end');
        $data['note']= $this->input->post('note');
         $data['status']= 1;
         $data['created_by']= $this->input->post('user_id');
         $data['source_lat']= $this->input->post('source_lat');
        $data['source_long']= $this->input->post('source_long');
         $data['dest_lat']= $this->input->post('dest_lat');
          $data['dest_long']= $this->input->post('dest_long');
         $data['created_at'] = date('y-m-d h:i:s');



            if(!empty($this->input->post('id'))){
                $insert_id = $this->vehicle->update('routes', $data, array('id' => $this->input->post('id')));
            }else{
                $insert_id = $this->vehicle->insert('routes', $data);
            }
            if ($insert_id) {
                 $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    

    }

    function get_transport_members() {
        $memberList = $this->member->get_transport_member_list();
        print_r($memberList);
    }



    function add_librarian() {

       $this->db->select('*');
       $this->db->from('librarian');
       $this->db->where('email', $this->input->post('email'));
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           echo '401';

       } else {

         $email = $this->input->post('email');
         $name = $this->input->post('name');
         $password = $this->input->post('password');
         $insertData = array(
          'name'=> $name,
          'email' => $email,
          'password' => sha1($password)
      );

         $this->db->insert('librarian', $insertData);
         echo '200';
     }
 }

 function get_librarians() {
    $this->db->select('*');
    $this->db->from('librarian');
    $query = $this->db->get();
    $respons['status'] = 200;
    $respons['data'] = $query->result();
    //print_r($respons);

    echo json_encode($respons);
}

function delete_librarian() {
 $response['status'] = 200;
 $id = $this->input->post('id');
 $this->db->where('librarian_id', $id);
 $this->db->delete('librarian');

 echo json_encode($response);
}

function edit_librarian() {
 $response['status'] = 200;
 $email = $this->input->post('email');
 $name = $this->input->post('name');
 $id = $this->input->post('id');

 $updateData = array(
  'name'=> $name,
  'email' => $email
);

 $this->db->where('librarian_id', $id);
 $this->db->update('librarian', $updateData);
 echo json_encode($response);
}

function getBooks() {
    $limit = $this->input->post('limit');
    $skip = $this->input->post('skip');

    $this->db->select('*');
    $this->db->from('book');
    $this->db->limit($limit, $skip);
    $query = $this->db->get();

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data']['books'] = $query->result();

    foreach($data['data']['books'] as $key => $datum) {
       $this->db->select('name');
       $this->db->from('class');
       $this->db->where('class_id', $datum -> class_id);
       $classData = $this->db->get()->result();
       $className = $classData[0] -> name;
       $data['data']['books'][$key] -> class_name = $className;
   }

   echo json_encode($data);
}

function searchBooks() {
    $searchString = $this->input->post('searchString');
    $this->db->select('*');
    $this->db->from('book');
    $this->db->like('name', $searchString, 'both');
    $query = $this->db->get();
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data']['books'] = $query->result();

    foreach($data['data']['books'] as $key => $datum) {
        $this->db->select('name');
        $this->db->from('class');
        $this->db->where('class_id', $datum -> class_id);
        $classData = $this->db->get()->result();
        $className = $classData[0] -> name;
        $data['data']['books'][$key] -> class_name = $className;
    }
    echo json_encode($data);
}

function getLibrarianDashboardData() {

    $output['status'] = 200;
    //Total books
    $output['total_books'] = $this->db->count_all('book').'';

    //Pending Book Requests
    $output['pending_book_requests'] = (string) $this->db->get_where('book_request', array('status' => 0))->num_rows();

    //Total Copies
    $this->db->select_sum('total_copies', 'total_copies');
    $query = $this->db->get('book');
    $result = $query->result();
    $total_copies = $result[0]->total_copies;
    if ($total_copies) {
        $output['total_copies'] = $total_copies;
    } else {
        $output['total_copies'] = "0";
    }

    //Issued copies
    $this->db->select_sum('issued_copies', 'issued_copies');
    $query = $this->db->get('book');
    $result = $query->result();
    $issued_copies = $result[0]->issued_copies;

    if ($issued_copies) {
        $output['issued_copies'] = $issued_copies;
    } else {
        $output['issued_copies'] = 0;
    }

    echo json_encode($output);
}

function getBookRequests() {
    $this->db->order_by('book_request_id', 'desc');

    if ($this->input->post('user_type') == 'student') {
        $book_requests = $this->db->get_where('book_request', array('user_id' => $this->input->post('user_id'), 'role_id' => 4))->result_array();
    } else if ($this->input->post('user_type') == 'teacher'){
        $book_requests = $this->db->get_where('book_request', array('user_id' => $this->input->post('user_id'), 'role_id' => 5))->result_array();
    } else {
        $book_requests = $this->db->get('book_request')->result_array();
    }

    foreach ($book_requests as $key => $value) {
        $book_requests[$key]['issue_start_date'] = date('d M Y', $value['issue_start_date']);
        $book_requests[$key]['issue_end_date'] = date('d M Y', $value['issue_end_date']);

        if ($value['role_id'] == 'teacher') {
            $book_requests[$key]['student_name'] = $this->db->get_where('teacher', array('teacher_id' => $value['user_id']))->row()->name;
        } else {
            $book_requests[$key]['student_name'] = $this->db->get_where('student', array('student_id' => $value['user_id']))->row()->name;
        }
        $book_requests[$key]['book_name'] = $this->db->get_where('book', array('book_id' => $value['book_id']))->row()->name;

        if (is_null($book_requests[$key]['status'])) {
            $book_requests[$key]['status'] = '0';
        }
    }

    $output['status'] = 200;
    $output['message'] = 'success';
    $output['bookRequestsData'] = $book_requests;

    echo json_encode($output);
        //print_r($book_requests);
}

function getCertificateTypes() {
    $data['status'] = 200;
    $certificates = $this->type->get_list('certificates', array('status' => 1), '','', '', 'id', 'ASC');
    foreach ($certificates as $key => $row) {
        $certificates[$key] -> background = base_url(). 'assets/uploads/certificate/' . $row -> background;
    }
    $data['certificates'] = $certificates;
    echo json_encode($data);
}

function getVehicles() {
    $data['status'] = 200;
    if ($this->input->post('user_type') == 'driver') {
        $vehicles = $this->db->get_where('vehicles' , array('driver' => $this->input->post('user_id')))->result_array();

        
        foreach ($vehicles as $key => $value) {
            $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));

            $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $value['driver'])) -> row() -> on_duty;
            if ($is_driver_on_route_active) {
                $vehicles[$key]['is_driver_on_route_active'] = $is_driver_on_route_active;
            } else {
                $vehicles[$key]['is_driver_on_route_active'] = '0';
            }

            $vehicles[$key]['driver_name'] = $this->db->get_where('employees', array('user_id' => $vehicles[$key]['driver'])) -> row() -> name;



            $md = json_decode($vehicles[$key]['route'] -> stop_details);
            $ms = array();

            //print_r($md);
            for($i = 0; $i < sizeof($md); $i++) {
                $ms[$i] = json_decode($md[$i]);

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            $vehicles[$key]['route'] -> stop_details = $ms;

            $vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');

        }
    } else if ($this->input->post('user_type') == 'student') {
        $vehicleAssigned = @$this->db->get_where('routes', array('id' => $this->input->post('transport_id'))) -> row() -> vehicle_ids;
        $vehicles = $this->db->get_where('vehicles' , array('id' => $vehicleAssigned))->result_array();



        foreach ($vehicles as $key => $value) {
            $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));

            $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $value['driver'])) -> row() -> on_duty;
            if ($is_driver_on_route_active) {
                $vehicles[$key]['is_driver_on_route_active'] = $is_driver_on_route_active;
            } else {
                $vehicles[$key]['is_driver_on_route_active'] = '0';
            }

            $vehicles[$key]['driver_name'] = $this->db->get_where('employees', array('user_id' => $vehicles[$key]['driver'])) -> row() -> name;


            $md = json_decode($vehicles[$key]['route'] -> stop_details);
            $ms = array();

            //print_r($md);
            for($i = 0; $i < sizeof($md); $i++) {
                $ms[$i] = json_decode($md[$i]);

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            $vehicles[$key]['route'] -> stop_details = $ms;

            $vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');

        }

    } else if ($this->input->post('user_type') == 'parent') {
        $transport_id = $this->db->get_where('student', array('student_id' => $this->input->post('transport_id')))->row() -> transport_id;


        $vehicleAssigned = @$this->db->get_where('routes', array('id' => $transport_id)) -> row() -> vehicle_ids;
        $vehicles = $this->db->get_where('vehicles' , array('id' => $vehicleAssigned))->result_array();


        foreach ($vehicles as $key => $value) {
            $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));

            $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $value['driver'])) -> row() -> on_duty;
            if ($is_driver_on_route_active) {
                $vehicles[$key]['is_driver_on_route_active'] = $is_driver_on_route_active;
            } else {
                $vehicles[$key]['is_driver_on_route_active'] = '0';
            }

            $vehicles[$key]['driver_name'] = $this->db->get_where('employees', array('user_id' => $vehicles[$key]['driver'])) -> row() -> name;


            $md = json_decode($vehicles[$key]['route'] -> stop_details);
            $ms = array();

            //print_r($md);
            for($i = 0; $i < sizeof($md); $i++) {
                $ms[$i] = json_decode($md[$i]);

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            $vehicles[$key]['route'] -> stop_details = $ms;

            $vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');

        }

    } /*else if ($this->input->post('user_type') == 'parent') {
         $dtt = array();
        $this->db->select('*');
        $this->db->from('student S');
        $this->db->join('routes R','R.id = S.transport_id');
        $this->db->where('parent_id',$this->input->post('user_id'));
        $res = $this->db->get()->result();
        foreach ($res as $key => $dt) {
            $dtt[] = $dt->vehicle_ids;
        }
         $dtt_implode = implode(',', $dtt);
        //$vehicleAssigned = $this->db->get_where('routes', array('id' => $this->input->post('transport_id'))) -> row() -> vehicle_ids;
        //echo $arr = '['. $dtt_implode.']';
        //$vehicles = $this->db->get_where('vehicles' , array("id IN " => $dtt_implode))->result_array();
         // $this->db->select('*');
         // $this->db->from('vehicles1');
         // $vehicles = $this->db->where_in($dtt_implode)-> get() -> result_array();
        $vehicles = @$this->db->query("select * from vehicles where id IN ($dtt_implode)")->result_array();
         // print_r($vehicles); die;

        if(sizeof($vehicles) > 0){
        foreach ($vehicles as $key => $value) {
            $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));


            $md = @json_decode($vehicles[$key]['route'] -> stop_details);
            $ms = array();

            //print_r($md);
            for($i = 0; $i < sizeof($md); $i++) {
                $ms[$i] = @json_decode($md[$i]);

                $ms[$i] -> lat = $ms[$i] -> lat .'';
                $ms[$i] -> lng = $ms[$i] -> lng .'';
                $ms[$i] -> distance = $ms[$i] -> distance .'';
            }
           // $md = json_decode($md[0]);


            @$vehicles[$key]['route'] -> stop_details = $ms;

            @$vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');
        }
      }
  }*/ else {
    $vehicles = $this->vehicle->get_vehicle_list();
    foreach ($vehicles as $key => $value) {
        $vehicles[$key] -> route       = $this->route->get_single('routes', array('vehicle_ids' => $value -> id));

        $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $value -> driver)) -> row() -> on_duty;
        if ($is_driver_on_route_active) {
            $vehicles[$key] -> is_driver_on_route_active = $is_driver_on_route_active;
        } else {
            $vehicles[$key] -> is_driver_on_route_active = '0';
        }

        $vehicles[$key] -> driver_name = $this->db->get_where('employees', array('user_id' => $value -> driver)) -> row() -> name;
          //  $vehicles[$key] -> route_stops = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$value -> id), '','', '','','id','ASC');

           // print_r( $vehicles[$key]); die;
        $md = @json_decode($vehicles[$key] -> route -> stop_details);
        $ms = array();

            //print_r($md);
        for($i = 0; $i < sizeof($md); $i++) {
            $ms[$i] = json_decode($md[$i]);

            $ms[$i] -> lat = $ms[$i] -> lat .'';
            $ms[$i] -> lng = $ms[$i] -> lng .'';
            $ms[$i] -> distance = $ms[$i] -> distance .'';
        }
           // $md = json_decode($md[0]);


        @$vehicles[$key] -> route -> stop_details = $ms;
        @$vehicles[$key] -> route_stops = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key] -> route -> id), '','', '','','id','ASC');

    }
}




$data['vehicles'] = $vehicles;
echo json_encode($data);
}

function getPayrollGrades() {
    $data['status'] = 200;
    $data['grades'] = $this->grade->get_list('salary_grades', array('status'=> 1));
    echo json_encode($data);
}


////ADD
public function addPayrollGrade(){
    
        $this->form_validation->set_rules('grade_name', $this->lang->line('grade_name'), 'trim|required');
        $this->form_validation->set_rules('basic_salary', $this->lang->line('basic_salary'), 'trim|required');
         $this->form_validation->set_rules('net_salary', $this->lang->line('net_salary'), 'trim|required');
       
       
        if ($this->form_validation->run() === TRUE) {
        
        $data['grade_name'] = $this->input->post('grade_name');
        $data['basic_salary']   = $this->input->post('basic_salary');
        
         $data['house_rent']   = $this->input->post('house_rent');
          $data['transport']   = $this->input->post('transport');
           $data['medical']   = $this->input->post('medical');
           
        $data['provident_fund']  = $this->input->post('provident_fund');
        $data['total_deduction']= $this->input->post('total_deduction');
         $data['total_allowance']= $this->input->post('total_allowance');
         $data['gross_salary']= $this->input->post('gross_salary');
         $data['net_salary']= $this->input->post('net_salary');
        $data['note']= $this->input->post('note');
         $data['status'] = 1;
         $data['created_at'] = date('y-m-d h:i:s');
         $data['created_by']=$this->input->post('user_id');
   


            if(!empty($this->input->post('id'))){
                $insert_id = $this->vehicle->update('salary_grades', $data, array('id' => $this->input->post('id')));
            }else{
                $insert_id = $this->vehicle->insert('salary_grades', $data);
            }
            if ($insert_id) {
                 $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    
}

//DELETE PAYROLL
public function deletePayrollGrade(){
     $this->db->where('id', $this->input->post('id'));
       $this->db->delete('salary_grades');
       $data['status'] = "200";
       echo json_encode($data);
    
}

public function get_user_list() {

    $type = $this->input->post('type');

    $data['status'] = 200;

    if ($type == 'teacher') {

        $this->db->select('T.name, T.teacher_id, T.designation, SG.grade_name, T.email, T.role_id');
        $this->db->from('teacher AS T');
           // $this->db->join('users AS U', 'U.id = T.user_id', 'left');
           // $this->db->join('designations AS D', 'D.id = T.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
        $this->db->where('T.teacher_id >', 0);
        $this->db->order_by('T.teacher_id', 'ASC');
        $query = $this->db->get();

        $data['user_list'] = $query->result();
        echo json_encode($data);
            //return $this->db->get()->result();

    } elseif ($type == 'employee') {

        $this->db->select('E.name, E.user_id, SG.grade_name, U.email, U.role_id, D.name AS designation');
        $this->db->from('employees AS E');
        $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
        $this->db->where('E.id >', 0);
        $this->db->order_by('E.id', 'ASC');

        $query = $this->db->get();

        $data['user_list'] = $query->result();
        echo json_encode($data);
            //return $this->db->get()->result();

    } else {
        return array();
    }
}


function getHouseInformation() {
    $query = $this->db->get_where('house_info');
    $house_data = $query->result_array();

    foreach ($house_data as $key => $row){
        $house_data[$key]['student_count'] = $this->db->get_where('assign_house',array('house_id'=>$row['house_id'])) -> num_rows().'';
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['house_list'] = $house_data;
    echo json_encode($data);
}

function getStudentHouses() {
    $query = $this->db->get_where('assign_house');
    $house_data = $query->result_array();
    foreach ($house_data as $key => $row) {
        $house_data[$key]['student_name'] = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
        $house_data[$key]['house_name'] = $this->db->get_where('house_info' , array('house_id' => $row['house_id']))->row()->name;
        $house_data[$key]['class'] =  $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;
        $house_data[$key]['section'] = $this->db->get_where('section' , array( 'section_id' => $row['section_id']))->row()->name;

    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['house_list'] = $house_data;
    echo json_encode($data);
}

function getGuardianList() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['guardians'] = $this->guardian->get_guardian_list();

    echo json_encode($data);
}

function getClasses() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $option = array();
    if(!empty($this->input->post('id'))){
        $option['id'] = $this->input->post('id');
    }
    $data['classes'] = $this->db->get_where('class',$option)->result_array();

    echo json_encode($data);
}

function getClassSections() {
    $data['status'] = 200;
    $data['message'] = 'success';

    $class_id = $this->input->post('class_id');

    $classes = $this->db->get('class')->result_array();
    $data['classes'] = $classes;

    if ($class_id == null) {
      $class_id = $classes[0]['class_id'];
  }

  $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
  foreach ($sections as $key => $row) {
    $sections[$key]['teacher'] = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
}
$data['sections'] = $sections;



echo json_encode($data);
}

function getAccountants() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $accountants = $this->db->get('accountant')->result_array();
    $data['accountants'] = $accountants;

    echo json_encode($data);
}

function getExams() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['exams'] = $exams;

    echo json_encode($data);
}

function getExamGrades() {
    $grades = $this->db->get('grade')->result_array();
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['grades'] = $grades;

    echo json_encode($data);
}

    /*function getTabulationSheet() {
        $data['status'] = 200;
        $class_id = $this->input->post('class_id');

        $classes = $this->db->get('class')->result_array();
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
        $subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();

        $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();

        foreach($students as $row) {
            $total_marks = 0;
            $total_grade_point = 0;
                foreach($subjects as $row2) {
                    $obtained_mark_query =  $this->db->get_where('mark' , array(
                                                    'class_id' => $class_id ,
                                                        'exam_id' => $exam_id ,
                                                            'subject_id' => $row2['subject_id'] ,
                                                                'student_id' => $row['student_id'],
                                                                    'year' => $running_year
                                                ));
                            if ( $obtained_mark_query->num_rows() > 0) {
                                $obtained_marks = $obtained_mark_query->row()->mark_obtained;
                                echo $obtained_marks;
                                if ($obtained_marks >= 0 && $obtained_marks != '') {
                                    $grade = $this->crud_model->get_grade($obtained_marks);
                                    $total_grade_point += $grade['grade_point'];
                                }
                                $total_marks += $obtained_marks;
                            }
                }
        }

        $data['subjects'] = $subjects;

        echo json_encode($data);

    }*/


    function getQuestionPapers() {
        $this->db->order_by('question_paper_id', 'desc');

        if ($this->input->post('user_type') == 'teacher') {
            $question_papers = $this->db->get_where('question_paper', array('teacher_id' => $this->input->post('user_id')))->result_array();
        } else {
            $question_papers = $this->db->get_where('question_paper', array('status' => 1))->result_array();
        }

        foreach ($question_papers as $key => $row) {
            $question_papers[$key]['class'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $question_papers[$key]['exam'] = $this->db->get_where('exam', array('exam_id' => $row['exam_id']))->row()->name;
            $question_papers[$key]['teacher'] = $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->row()->name;
        }
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['question_papers'] = $question_papers;

        echo json_encode($data);
    }

    function getPreExamList() {
        $running_year = get_settings('running_year');
        $current_time = $this->input->post('current_time');
        if($this->input->post('user_type')=="student" || $this->input->post('user_type')=="parent"){
             $match = array('status !=' => 'expired', 'running_year' => $running_year, 'status' => "published");
        }else{
             $match = array('status !=' => 'expired', 'running_year' => $running_year);
        }
       
        $page_data['status'] = 'active';
        $this->db->order_by("exam_date", "DESC");
        $result = $page_data['online_exams'] = $this->db->where($match)->get('online_exam')->result_array();

        foreach($result as $key => $row) {
            $result[$key]['class_name'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $result[$key]['date'] = date('M d, Y', $row['exam_date']);
            $result[$key]['time'] = $row['time_start'].' - '.$row['time_end'];
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['exams'] = $result;

        echo json_encode($data);
    }
     function getExpiredExamList() {
        $running_year = get_settings('running_year');
        $match = array('status'  => 'expired', 'running_year' => $running_year);
        if(!empty($this->input->post('class_id'))){
            $match['class_id'] = $this->input->post('class_id');
        }
        if(!empty($this->input->post('section_id'))){
            $match['section_id'] = $this->input->post('section_id');
        }
        $page_data['status'] = 'active';
        $this->db->order_by("exam_date", "dsc");
        $result = $page_data['online_exams'] = $this->db->where($match)->get('online_exam')->result_array();

        foreach($result as $key => $row) {
            $result[$key]['class_name'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $result[$key]['date'] = date('M d, Y', $row['exam_date']);
            $result[$key]['time'] = $row['time_start'].' - '.$row['time_end'];
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['exams'] = $result;

        echo json_encode($data);
    }
    
    function changeStatusOfOnlineExam(){
        $online_exam_id = $this->input->post('online_exam_id');
        $statusId = $this->input->post('status');
        if($statusId==0){
            $status='published';
        }else if($statusId==1){
             $status='expired';
        }
        $this->db->where('online_exam_id',$online_exam_id);
        $this->db->update("online_exam",array('status'=>$status));
         $data['status'] = 200;
        $data['message'] = 'success';

        echo json_encode($data);
    
    }

    function getPreExamResult() {

        $online_exam_id = $this->input->post('online_exam_id');
        if(!empty($this->input->post('class_id'))){
            $this->db->where('class_id',$this->input->post('class_id'));
        }
        if(!empty($this->input->post('section_id'))){
            $this->db->where('section_id', $this->input->post('section_id'));
        }
        $online_exam_details = $this->db->get_where('pre_online_exam', array('online_exam_id' => $online_exam_id))->row_array();

        $students_array = $this->db->get_where('pre_enroll', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 'year' => $online_exam_details['running_year']))->result_array();

        $subject_info        = $this->crud_model->get_subject_info($online_exam_details['subject_id']);
        $total_marks         = $this->crud_model->get_total_mark($online_exam_id);

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['title'] = $online_exam_details['title'];
        $data['total_marks'] = $total_marks;
        $data['minimum_percentage'] = $online_exam_details['minimum_percentage'];

        foreach ($students_array as $key => $row) {
            $student_details = $this->db->get_where('pre_student', array('pre_student_id' => $row['student_id']))->row_array();

            $students_array[$key]['student_name'] = $student_details['name'];

            $query = $this->db->get_where('pre_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
            if ($query->num_rows() > 0){
                $query_result = $query->row_array();
                $students_array[$key]['obtained_marks'] = $query_result['obtained_mark'];
            }
            else {
                $students_array[$key]['obtained_marks'] = 0;
            }

            $query = $this->db->get_where('pre_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
            if ($query->num_rows() > 0){
                $query_result = $query->row_array();
                $students_array[$key]['result'] = get_phrase($query_result['result']);
            }
            else {
                $students_array[$key]['result'] = get_phrase('fail').' ( '.get_phrase('absent').' )';
            }
        }

        $data['student_details'] = $students_array;

        echo json_encode($data);

        //echo json_encode($students_array);
    }


    function getPreExamStudentList() {
        $running_year = get_settings('running_year');
        $class_id = $this->input->post('class_id');
        $students = $this->db->get_where('pre_enroll' , array(
            'class_id' => $class_id , 'year' => $running_year
        ))->result_array();

        foreach($students as $key => $row) {
            $students[$key]['name'] = $this->db->get_where('pre_student' , array(
                'pre_student_id' => $row['student_id']
            ))->row()->name;
            $students[$key]['address'] = $this->db->get_where('pre_student' , array(
                'pre_student_id' => $row['student_id']
            ))->row()->address;
            $students[$key]['email'] = $this->db->get_where('pre_student' , array(
                'pre_student_id' => $row['student_id']
            ))->row()->email;
            $students[$key]['image'] = $this->crud_model->get_image_url('pre_student',$row['student_id']);
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['students'] = $students;

        echo json_encode($data);
    }

    function getOnlineExamList() {
        $running_year = get_settings('running_year');
        $match = array('status !=' => 'expired', 'running_year' => $running_year);
        $page_data['status'] = 'active';
        $this->db->order_by("exam_date", "dsc");
        $result = $page_data['online_exams'] = $this->db->where($match)->get('online_exam')->result_array();

        foreach($result as $key => $row) {
            $result[$key]['class_name'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $result[$key]['date'] = date('M d, Y', $row['exam_date']);
            $result[$key]['time'] = $row['time_start'].' - '.$row['time_end'];
            $result[$key]['section_name'] = $this->db->get_where('section' , array( 'section_id' => $row['section_id']))->row()->name;

            $result[$key]['subject_name'] = $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['exams'] = $result;

        echo json_encode($data);
    }


    function getOnlineExamResult() {

        $online_exam_id = $this->input->post('online_exam_id');
        $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();

        $students_array = $this->db->get_where('enroll', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 'year' => $online_exam_details['running_year']))->result_array();

        $subject_info        = $this->crud_model->get_subject_info($online_exam_details['subject_id']);
        $total_marks         = $this->crud_model->get_total_mark($online_exam_id);

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['title'] = $online_exam_details['title'];
        if ($total_marks) {
            $data['total_marks'] = $total_marks.'';
        } else {
            $data['total_marks'] = '0';
        }
        $data['minimum_percentage'] = $online_exam_details['minimum_percentage'];

        foreach ($students_array as $key => $row) {
            $student_details = $this->crud_model->get_student_info_by_id($row['student_id']);

            $students_array[$key]['student_name'] = $student_details['name'];

            $query = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
            if ($query->num_rows() > 0){
                $query_result = $query->row_array();
                $students_array[$key]['obtained_marks'] = $query_result['obtained_mark'];
            }
            else {
                $students_array[$key]['obtained_marks'] = 0;
            }

            $query = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
            if ($query->num_rows() > 0){
                $query_result = $query->row_array();
                $students_array[$key]['result'] = get_phrase($query_result['result']);
            }
            else {
                $students_array[$key]['result'] = get_phrase('fail').' ( '.get_phrase('absent').' )';
            }
        }

        $data['student_details'] = $students_array;

        echo json_encode($data);

        //echo json_encode($students_array);
    }

    function getRescheduleAndCancelData() {

        if ($this->input->post('user_type') == 'student') {

            $get_reschedule_for = $this->crud_model->get_student_re_exam_list($this->input->post('user_id'));
            $get_cancel_for = $this->crud_model->get_student_cancel_exam_list($this->input->post('user_id'));

            //print_r($get_reschedule_for); die();
        } else if ($this->input->post('user_type') == 'parent') {
            $get_reschedule_for = $this->parents->get_student_re_exam_list($this->input->post('user_id'));
            $get_cancel_for = $this->parents->get_student_cancel_exam_list($this->input->post('user_id'));

        } else {
            $get_reschedule_for = $this->crud_model->get_re_exam_list($this->input->post('class_id'));
            $get_cancel_for = $this->crud_model->get_cancel_exam_list($this->input->post('class_id'));
        }

        /*if(isset($get_reschedule_for) && !empty($get_reschedule_for)){
            foreach($get_reschedule_for as $key => $dt) {

                $exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $dt->exam))->row();
                if ($exam_details) {
                $get_reschedule_for[$key] -> exam_name = $exam_details -> title;
                } else {
                    $get_reschedule_for[$key] -> exam_name = '';
                }

                $student = $this->db->get_where('student', array('student_id' => $dt->student_id))->row();
                if ($student) {
                    $get_reschedule_for[$key] -> student = $student -> name;
                } else {
                    $get_reschedule_for[$key] -> student = '';
                }

                 $get_reschedule_for[$key] -> class_name = $this->db->get_where('class', array('class_id' => $dt->class_id))->row()->name;

                 $section = $this->db->get_where('section', array('section_id' => $dt->section_id))->row();

                 if ($section) {
                     $get_reschedule_for[$key] -> section = $section -> name;
                 } else {
                    $get_reschedule_for[$key] -> section = '';
                 }
            }
        }


       // print_r($get_cancel_for); die();
        if(isset($get_cancel_for) && !empty($get_cancel_for)){
            foreach($get_cancel_for as $key => $dt){
                $exam_details =  $this->db->get_where('online_exam', array('online_exam_id' => $dt->exam))->row();
                if ($exam_details) {
                $get_cancel_for[$key] -> title = $exam_details -> title;
                } else {
                    $get_cancel_for[$key] -> title = '';
                }


                $student = $this->db->get_where('student', array('student_id' => $dt->student_id))->row();
                if ($student) {
                    $get_cancel_for[$key] -> student = $student -> name;
                } else {
                    $get_cancel_for[$key] -> student = '';
                }

                 $get_cancel_for[$key] -> class_name = $this->db->get_where('class', array('class_id' => $dt->class_id))->row()->name;

                 $section = $this->db->get_where('section', array('section_id' => $dt->section_id))->row();

                 if ($section) {
                     $get_cancel_for[$key] -> section = $section -> name;
                 } else {
                    $get_cancel_for[$key] -> section = '';
                 }
            }

        }*/

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['rescheduled_exams'] = $get_reschedule_for;
        $data['cancelled_exams'] = $get_cancel_for;

        echo json_encode($data);
    }

    function getStudyMaterial() {
        if ($this->input->post('user_type') == 'teacher') {
            $study_material = $this->db->get_where('document',array('teacher_id'=>$this->input->post('user_id')))->result_array();
        } else {
            $study_material  = $this->crud_model->select_study_material_info();
        }

        foreach ($study_material as $key => $row) {
            $study_material[$key]['date'] = date("d M, Y", $row['timestamp']);
            $study_material[$key]['class'] = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
            $study_material[$key]['subject'] = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name;
        }
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['study_material'] = $study_material;

        echo json_encode($data);
    }

    function getTransportMembers() {

        $running_year = get_settings('running_year');
        $data['status'] = 200;
        $data['message'] = 'success';

        $this->db->select('ST.*, R.title AS route_name, RS.stop_name, RS.stop_fare, TM.id AS tm_id, TM.route_id, E.roll, C.name AS class_name, S.name AS section');
        $this->db->from('student AS ST');
        $this->db->join('enroll AS E', 'E.student_id = ST.student_id', 'left');
        $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
        $this->db->join('section AS S', 'S.section_id = E.section_id', 'left');
        $this->db->join('transport_members AS TM', 'TM.user_id = ST.student_id', 'left');
        $this->db->join('route_stops AS RS', 'RS.id = TM.route_stop_id', 'left');
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('E.year', $running_year);
        $this->db->where('ST.is_transport_member', 1);
        $this->db->order_by('TM.id', 'DESC');
        $members = $this->db->get()->result();

        foreach($members as $key => $obj){
            $members[$key] -> image_url = $this->crud_model->get_image_url('student',$obj -> student_id);
        }

        $data['students'] = $members;

        echo json_encode($members);
    }

    function getDesignations() {
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['designations'] = $this->designation->get_list('designations', array('status' => 1), '','', '', 'id', 'ASC');
        echo json_encode($data);
    }

    function getEmployees() {
        $data['status'] = 200;
        $data['message'] = 'success';
        $des_id="";
        if(!empty($this->input->post('designation_id'))){
          $des_id=$this->input->post('designation_id');
        }
        //$employees = $this->employee->get_employee_list();
         $employees = $this->employee->get_employee_list_by_designation_id($des_id);

        foreach($employees as $key => $obj){
            $employees[$key]->image_path = UPLOAD_PATH.'/employee-photo/'.$obj->photo;
            $employees[$key]->salary = $this->db->get_where('salary_grades',['id'=>$obj->salary_grade_id])->row()->net_salary;
        }

        $data['employees'] = $employees;

        echo json_encode($data);
    }

    function getHostels() {
        $hostels = $this->hostel->get_hostel_list();

        foreach ($hostels as $key => $row) {
            $hostels[$key] -> rooms = $this->db->get_where('rooms', array('hostel_id' => $row -> id)) -> result_array();
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['hostels'] = $hostels;
        echo json_encode($data);
    }

    function getHostelRooms() {
        if(!empty($this->input->post('id'))){
            $this->room->db->where('R.hostel_id',$this->input->post('id'));
        }
        $rooms = $this->room->get_room_list();

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['rooms'] = $rooms;
        echo json_encode($data);
    }

    function getEvents() {
        $this->db->select('*');
        $this->db->from('events');
        $events = $this->db->get()->result_array();

        foreach ($events as $key => $value) {
            $this->db->select('image');
            $this->db->from('event_images');
            $this->db->where('event_id', $value['id']);
            $imageRaw = $this->db->get()->result_array();

            $images = array();
            foreach ($imageRaw as $key2 => $value) {
                array_push($images, base_url().'assets/uploads/event/'.$imageRaw[$key2]['image']);
            }
           // $events[$key]['image'] = base_url().'assets/uploads/event/'.$events[$key]['image'];
            $events[$key]['images'] = $images;
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['events'] = $events;
        echo json_encode($data);
    }

    function getScholarshipExamStudents() {
        $students = $this->db->get_where('scholarship_student' , array('status' => 1))->result_array();

        foreach($students as $key => $row) {
            $students[$key]['student_code'] = $this->db->get_where('student' , array(
                'student_id' => $row['student_id']
            ))->row()->student_code;
            $students[$key]['student_name'] = $this->db->get_where('student' , array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $students[$key]['student_address'] = $this->db->get_where('student' , array(
                'student_id' => $row['student_id']
            ))->row()->address;
            $students[$key]['student_email'] = $this->db->get_where('student' , array(
                'student_id' => $row['student_id']
            ))->row()->email;
            $students[$key]['image'] = $this->crud_model->get_image_url('student',$row['student_id']);
            $students[$key]['section'] = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['students'] = $students;
        echo json_encode($data);
    }

    function getScholarshipExams() {
        $running_year = get_settings('running_year');
        $match = array('status !=' => 'expired', 'running_year' => $running_year);
        $online_exams = $this->db->where($match)->get('scholarship_online_exam')->result_array();

        foreach($online_exams as $key => $row) {
            $online_exams[$key]['class_name'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $online_exams[$key]['section_name'] = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;
            $subject = $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row();

            if ($subject) {
                $online_exams[$key]['subject'] = $subject -> name;
            } else {
                $online_exams[$key]['subject'] = '';
            }

            $online_exams[$key]['date'] = date('M d, Y', $row['exam_date']);
            $online_exams[$key]['time'] = $row['time_start'].' - '.$row['time_end'];
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['online_exams'] = $online_exams;
        echo json_encode($data);
    }

    function getFeeTypes() {
        $classes = $this->feetype->get_list('class', array('status'=> 1), '', '', '', 'class_id', 'ASC');
        $data['status'] = 200;
        $data['message'] = 'success';
        $feetypes = $this->feetype->get_fee_type();

        foreach ($feetypes as $key => $row) {

            $fees = array();
            foreach ($classes as $key2 => $obj) {
            //print_r( $obj -> class_id); die();
                $fee_amount = get_fee_amount($row->id, $obj -> class_id);

                $this->db->select('name');
                $this->db->from('class');
                $this->db->where('class_id', $obj -> class_id);
                $class_name = $this->db->get()->row_array();
                $fee_amount->class_name = $class_name['name'];
                array_push($fees, $fee_amount);
            }

            $feetypes[$key] -> details = $fees;
            //$feetypes[$key] -> details = $this->feetype->get_single('income_heads', array('id' => $row -> id));
        }

        $data['feetypes'] = $feetypes;
        echo json_encode($data);
    }

    function getDiscounts() {
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['discounts'] = $this->discount->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'DESC');

        echo json_encode($data);
    }

    function getInvoices() {
        $userType = 0;
        if ($this->input->post('user_type') == 'student') {
            $userType = 1;
        }
        
        // if(!empty($this->input->post('class_id'))){
        //     $this->invoice->db->where('I.class_id', $this->input->post('class_id')); 
        // }
        // if(!empty($this->input->post('section_id'))){
        //     $this->invoice->join('enroll AS E', 'E.student_id = I.student_id', 'inner');
        //     $this->invoice->db->where('E.section_id', $this->input->post('section_id'));  
        // }
        // if(!empty($this->input->post('month '))){
        //     $this->invoice->db->where('I.class_id', $this->input->post('month ')); 
        // }
        // if(!empty($this->input->post('month '))){
        //     $this->invoice->db->where('I.class_id', $this->input->post('month ')); 
        // }
        $invoices = $this->invoice->get_invoice_list(false,$this->input->post('class_id'),$this->input->post('month'),$this->input->post('year'),$this->input->post('section_id'));
        // $invoices = $this->invoice->get_invoice_list_mobile($userType);
        foreach ($invoices as $key => $obj) {
            $invoices[$key] -> status = get_paid_status($obj->paid_status);
        }


        $data['status'] = 200;
        $data['message'] = 'success';
        $data['invoices'] = $invoices;

        echo json_encode($data);
    }
    
    public function changesInvoiceStatus(){
        $id=$this->input->post('id');
        $status=$this->input->post('status');
         $user_id=$this->input->post('user_id');
        $this->db->where('id',$id);
        if($status==0){
         $this->db->update("invoices",array('paid_status'=>"paid",'modified_by'=>$user_id));
        }else{
            $this->db->update("invoices",array('paid_status'=>"unpaid",'modified_by'=>$user_id));
        }
         $data['status'] = 200;
        $data['message'] = 'success';

        echo json_encode($data);
    }

    function getDueFeeEmails() {
        $emails = $this->mail->get_email_list();
        $classes= $this->mail->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $roles = $this->mail->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        foreach($emails as $key => $obj){
            if($obj->role_id == 8) {
                $table = 'parent';
                $reciverid = 'parent_id';
            } elseif($obj->role_id == 4){
                $table = 'student';
                $reciverid = 'student_id';
            }

            $emails[$key] -> receiver = $this->db->get_where($table,array($reciverid => $obj->receivers))->row()->name;
            $emails[$key] -> nice_time = get_nice_time($obj->created_at);
        }

        $data['status'] = 200;
        $data['message'] = 'success';
        $data['emails'] = $emails;

        echo json_encode($data);
    }

    function getDueFeeSms() {
        $texts = $this->mail->get_sms_list();
        $classes = $this->mail->get_list('class', array('status' => 1), '', '', '', 'class_id', 'ASC');
        $roles = $this->mail->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        foreach($texts as $key => $obj) {
            if($obj->role_id == 8){
                $table = 'parent';
                $reciverid = 'parent_id';
            } elseif($obj->role_id == 4) {
                $table = 'student';
                $reciverid = 'student_id';
            }

            $receiver = $this->db->get_where($table,array($reciverid => $obj->receivers))->row();

            if ($receiver) {
                $texts[$key] -> receiver = $receiver->name;
            } else {
               $texts[$key] -> receiver = '';
           }

           $texts[$key] -> nice_time = get_nice_time($obj->created_at);
       }


       $data['status'] = 200;
       $data['message'] = 'success';
       $data['sms'] = $texts;

       echo json_encode($data);

   }

   function getIncomeHeads() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['incomeheads'] = $this->incomehead->get_list('income_heads', array('status'=> 1, 'head_type'=>'income'), '', '', '', '', '');
    echo json_encode($data);
}

function getExpHeads() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['incomeheads'] = $this->exphead->get_list('expenditure_heads', array('status'=> 1));

    echo json_encode($data);
}

function getPaymentList() {
    $payment_to = $this->input->post('payment_to');
    $user_id  = $this->input->post('user_id');

    $data['status'] = 200;
    $data['message'] = 'success';
    $payments = $this->payment->get_payment_list($user_id, $payment_to);

    foreach($payments as $key => $obj){
        if (@$obj-> photo != null) {
            $payments[$key] -> image_path = UPLOAD_PATH.'/employee-photo/'.$obj->photo;
        } else {
            $payments[$key] -> image_path = '';
        }
    }

    $data['payments'] = $payments;

        //$test = get_user_list('teacher', 5);
        //print_r($test); die();

    echo json_encode($data);
}

function getPaymentHistoryList() {
    $payment_to = $this->input->post('payment_to');
    $user_id  = $this->input->post('user_id');
}

function getTeachersAndEmployees(){
    $data['status'] = 200;
    $data['message'] = 'success';

    $this->db->select('name, teacher_id as user_id, designation_id');
    $this->db->from('teacher');
    $query = $this->db->get();
    $teachers = $query->result();

    foreach ($teachers as $key => $obj) {

        $teachers[$key] -> designation = "";
    }


    $this->db->select('name, user_id, designation_id');
    $this->db->from('employees');
    $query = $this->db->get();
    $employees = $query->result();

    foreach ($employees as $key => $obj) {
            //print_r($employees[$key] -> designation_id); die();
        $this->db->select('name');
        $this->db->from('designations');
        $this->db->where('id', $employees[$key] -> designation_id);
        $employees[$key] -> designation = '['.$this->db->get()->result()[0] -> name.']';
    }

    $data['teachers'] = $teachers;
    $data['employees'] = $employees;

    echo json_encode($data);
}

function getLeaveRequests() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $leave_data = $this->db->get_where('leave_request', array('year'=>$running_year))->result();

    foreach ($leave_data as $key => $dt) {
        if($dt->from_date != "" && $dt->to_date != ""){
            $fdate = date('Y-m-d',strtotime($dt->from_date));
            $tdate = date('Y-m-d',strtotime($dt->to_date));
            $date1 = new DateTime("$fdate");
            $date2 = new DateTime("$tdate");
            $diff  = date_diff($date1,$date2);
            $diff_date = $diff->format('%a days');
            $leave_data[$key] -> diff_date = $diff_date;
        } else {
            $leave_data[$key] -> diff_date = '';
        }

        $student = $this->crud_model->get_student_info_by_id($dt->request_by);
        $leave_data[$key] -> student_name = $student['name'];
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['leave_data'] = $leave_data;

    echo json_encode($data);
}

function getAssetCategories() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $asset_category = $this->db->get_where('asset_category', array('status' => 1))->result();

    foreach($asset_category as $key => $dt){
        $count = $this->db->query('select sum(number_asset) as sum_number_asset from asset where category = ?',array($dt->asset_category_id))->row();
        if ($count->sum_number_asset) {
            $asset_category[$key] -> count = $count->sum_number_asset;
        } else {
            $asset_category[$key] -> count = '0';
        }

        $count->sum_number_asset;
    }

    $data['assets'] = $asset_category;

    echo json_encode($data);
}

function getHostelMembers() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $members = $this->member->get_hostel_member_list_mobile($is_hostel_member = 1, $year = $running_year);

    foreach($members as $key => $obj){
        $members[$key] -> image = $this->crud_model->get_image_url('student',$obj->student_id);
    }

    $data['members'] = $members;

    echo json_encode($data);
}

function getAcademicSyllabus() {
    $class_id = $this->input->post('class_id');
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $syllabus = $this->db->get_where('academic_syllabus' , array('class_id' => $class_id , 'year' => $running_year))->result_array();

    foreach ($syllabus as $key => $row) {
        $subject = $this->db->get_where('subject' , array(
            'subject_id' => $row['subject_id']
        ))->row();
        if ($subject) {
            $syllabus[$key]['subject'] = $this->db->get_where('subject' , array(
                'subject_id' => $row['subject_id']
            ))->row()->name;
        }
        $syllabus[$key]['uploader_name'] = !empty($row['uploader_type'])?$this->db->get_where($row['uploader_type'] , array(
            $row['uploader_type'].'_id' => $row['uploader_id']
        ))->row()->name:'';
        $syllabus[$key]['date'] = date("d/m/Y" , $row['timestamp']);


           // print_r($row['file_name']); die();
        $syllabus[$key]['file'] = site_url('teacher/download_academic_syllabus/'.$row['academic_syllabus_code']);
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['syllabus'] = $syllabus;
    echo json_encode($data);
}

function getStudentLeaveReports() {
    $data['status'] = 200;
    $data['message'] = 'success';

        //STUDENT
    $roleId = 4;

    if ($this->input->post('user_type') == 'teacher') {
        $roleId = 5;
    }

    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

    $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->input->post('user_id'),'year'=>$running_year, 'role_id' => $roleId))->result();

    $data['reports'] = $request_data;

    echo json_encode($data);
}

function getOnlineExamResultsForStudents() {

    $data['status'] = 200;
    $data['message'] = 'success';
    $exams = $this->crud_model->available_exams($this->input->post('user_id'));

    foreach ($exams as $key => $row) {
        $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row_array();
        $exams[$key]['title'] = $online_exam_details['title'];
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);

        $subject = $this->db->get_where('subject', array('subject_id' => $online_exam_details['subject_id']))->row();

        if ($subject) {
            $exams[$key]['subject'] = $subject -> name;
        } else {
            $exams[$key]['subject'] = '';
        }

        $exams[$key]['date'] = date('M d, Y', $online_exam_details['exam_date']);
        $exams[$key]['time'] = $online_exam_details['time_start'].' - '.$online_exam_details['time_end'];
        $exams[$key]['total_marks'] = $this->crud_model->get_total_mark($row['online_exam_id']).'';

        if ($current_time > $exam_end_time){
            $query = $this->db->get_where('online_exam_result', array('student_id' => $this->input->post('user_id'), 'online_exam_id' => $row['online_exam_id']));
            if ($query->num_rows() > 0) {
                $query_result = $query->row_array();
                $obtained_marks = $query_result['obtained_mark'].'';
            }
            else {
               $obtained_marks = '0';
           }
           $exams[$key]['obtained_marks'] = $obtained_marks;
       }

       if ($current_time > $exam_end_time){
        $query = $this->db->get_where('online_exam_result', array('student_id' => $this->input->post('user_id'), 'online_exam_id' => $row['online_exam_id']));
        if ($query->num_rows() > 0) {
            $query_result = $query->row_array();
            $result = get_phrase($query_result['result']);
        }
        else {
            $result = get_phrase('fail').'( '.get_phrase('absent').' )';
        }

        $exams[$key]['result'] = $result;
    }
}

$data['exams'] = $exams;
echo json_encode($data);
}

function getSections() {
    $class_id = $this->input->post('class_id');
    $sections = $this->db->get_where('section' , array('class_id' => $class_id,'sub_teacher_status' => 0))->result_array();

    foreach ($sections as $key => $row) {
        if ($row['teacher_id'] != '' || $row['teacher_id'] != 0) {
           $sections[$key]['teacher'] = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
       } else {
        $sections[$key]['teacher'] = '';
    }
}


$substitute = $this->db->get_where('section' , array('class_id' => $class_id,'sub_teacher_status' => 1))->result_array();
foreach ($substitute as $key => $row){
    if ($row['teacher_id'] != '' || $row['teacher_id'] != 0){
        $substitute[$key]['teacher'] = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
    } else {
        $substitute[$key]['teacher'] = '';
    }
}

$data['status'] = 200;
$data['message'] = 'success';
$data['sections'] = $sections;
$data['substitute'] = $substitute;

echo json_encode($data);
}

function getActiveExams() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $exams = $this->crud_model->available_exams($this->input->post('user_id'));

    foreach ($exams as $key => $row) {


        $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row_array();
        $exams[$key]['title'] = $online_exam_details['title'];
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);

        $subject = $this->db->get_where('subject', array('subject_id' => $online_exam_details['subject_id']))->row();

        if ($subject) {
            $exams[$key]['subject'] = $subject -> name;
        } else {
            $exams[$key]['subject'] = '';
        }

        $exams[$key]['date'] = date('M d, Y', $online_exam_details['exam_date']);
        $exams[$key]['time'] = $online_exam_details['time_start'].' - '.$online_exam_details['time_end'];
        $exams[$key]['total_marks'] = $this->crud_model->get_total_mark($row['online_exam_id']).'';

        if ($current_time > $exam_end_time){
            $query = $this->db->get_where('online_exam_result', array('student_id' => $this->input->post('user_id'), 'online_exam_id' => $row['online_exam_id']));
            if ($query->num_rows() > 0) {
                $query_result = $query->row_array();
                $obtained_marks = $query_result['obtained_mark'].'';
            }
            else {
               $obtained_marks = '0';
           }
           $exams[$key]['obtained_marks'] = $obtained_marks;
       }


       $current_time    = time();
       $exam_start_time = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_start']);
       $exam_end_time   = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_end']);
       if ($current_time > $exam_end_time) {
        $exams[$key]['available'] = false;
    } else {
        $exams[$key]['available'] = true;
    }
}

$data['exams'] = $exams;

echo json_encode($data);
}

function getScholarshipActiveExams() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $exams = $this->crud_model->available_exams($this->input->post('user_id'));

    foreach ($exams as $key => $row) {


        $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row_array();
        $exams[$key]['title'] = $online_exam_details['title'];
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);

        $subject = $this->db->get_where('subject', array('subject_id' => $online_exam_details['subject_id']))->row();

        if ($subject) {
            $exams[$key]['subject'] = $subject -> name;
        } else {
            $exams[$key]['subject'] = '';
        }

        $exams[$key]['date'] = date('M d, Y', $online_exam_details['exam_date']);
        $exams[$key]['time'] = $online_exam_details['time_start'].' - '.$online_exam_details['time_end'];
        $exams[$key]['total_marks'] = $this->crud_model->get_total_mark($row['online_exam_id']).'';

        if ($current_time > $exam_end_time){
            $query = $this->db->get_where('online_exam_result', array('student_id' => $this->input->post('user_id'), 'online_exam_id' => $row['online_exam_id']));
            if ($query->num_rows() > 0) {
                $query_result = $query->row_array();
                $obtained_marks = $query_result['obtained_mark'].'';
            }
            else {
               $obtained_marks = '0';
           }
           $exams[$key]['obtained_marks'] = $obtained_marks;
       }


       $current_time    = time();
       $exam_start_time = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_start']);
       $exam_end_time   = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_end']);
       if ($current_time > $exam_end_time) {
        $exams[$key]['available'] = false;
    } else {
        $exams[$key]['available'] = true;
    }
}

$data['exams'] = $exams;

echo json_encode($data);
}

function getActiveScholarshipExams() {
    $data['status'] = 200;
    $data['message'] = 'success';
    $exams = $this->crud_model->available_scholarship_exams($this->input->post('user_id'));

    foreach ($exams as $key => $row) {

        $online_exam_details = $this->db->get_where('scholarship_online_exam', array('online_exam_id' => $row['online_exam_id']))->row_array();
        $exams[$key]['title'] = $online_exam_details['title'];
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);

        $subject = $this->db->get_where('subject', array('subject_id' => $online_exam_details['subject_id']))->row();

        if ($subject) {
            $exams[$key]['subject'] = $subject -> name;
        } else {
            $exams[$key]['subject'] = '';
        }

        $exams[$key]['date'] = date('M d, Y', $online_exam_details['exam_date']);
        $exams[$key]['time'] = $online_exam_details['time_start'].' - '.$online_exam_details['time_end'];
        $exams[$key]['total_marks'] = $this->crud_model->get_total_mark($row['online_exam_id']).'';

        if ($current_time > $exam_end_time){
            $query = $this->db->get_where('scholarship_online_exam_result', array('student_id' => $this->input->post('user_id'), 'online_exam_id' => $row['online_exam_id']));
            if ($query->num_rows() > 0) {
                $query_result = $query->row_array();
                $obtained_marks = $query_result['obtained_mark'].'';
                $exams[$key]['result'] = get_phrase($query_result['result']);
                    //print_r($query_result); die();
            }
            else {
               $obtained_marks = '0';
               $exams[$key]['result'] = get_phrase('fail').'( '.get_phrase('absent').' )';
           }
           $exams[$key]['obtained_marks'] = $obtained_marks;
       }


       $current_time    = time();
       $exam_start_time = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_start']);
       $exam_end_time   = strtotime(date('Y-m-d', $row['exam_date']).' '.$row['time_end']);
       if ($current_time > $exam_end_time) {
        $exams[$key]['available'] = false;
    } else {
        $exams[$key]['available'] = true;
    }
}

$data['exams'] = $exams;

echo json_encode($data);
}

function getScholarshipExamsResultForStudent() {
   $online_exam_id = $this->input->post('exam_id');
   $online_exam_details = $this->db->get_where('scholarship_online_exam', array('online_exam_id' => $online_exam_id))->row_array();
   $students_array      = $this->db->get_where('scholarship_student', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 'running_year' => $online_exam_details['running_year']))->result_array();
    // $subject_info        = $this->crud_model->get_subject_info($online_exam_details['subject_id']);
   $total_mark          = $this->crud_model->get_total_mark($online_exam_id);

   $data['total_marks'] = $total_mark;
   $data['title'] = $online_exam_details['title'];
   $data['minimum_percentage'] = $online_exam_details['minimum_percentage'];

   $current_time = time();
   $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);
   if ($current_time < $exam_end_time) {
    $data['exam_running_status'] = 'exam_has_not_finished_yet';
} else {
    $data['exam_running_status'] = 'exam_is_over';
}

foreach ($students_array as $key => $row) {
    $student_details = $this->crud_model->get_student_info_by_id($row['student_id']);
    $students_array[$key]['student_name'] =  $student_details['name'];

    $query = $this->db->get_where('scholarship_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
    if ($query->num_rows() > 0){
        $query_result = $query->row_array();
        $students_array[$key]['obtained_marks'] = $query_result['obtained_mark'];
    }
    else {
        $students_array[$key]['obtained_marks'] = '';
    }

    $query = $this->db->get_where('scholarship_online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $row['student_id']));
    if ($query->num_rows() > 0){
        $query_result = $query->row_array();
        $students_array[$key]['result'] = get_phrase($query_result['result']);
    }
    else {
        $students_array[$key]['result'] =  get_phrase('fail').' ( '.get_phrase('absent').' )';
    }
}

$data['student_details'] = $students_array;
echo json_encode($data);
}

function getSessionYears() {
    $data['status'] = 200;
    $data['message'] = 'success';

    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $sessional_year_options = explode('-', $running_year);

    $data['years'] = $sessional_year_options;
    echo json_encode($data);
}

function getStudentAttendance() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $month = $this->input->post('month');
    $sessional_year = $this->input->post('year');
    $student_id = $this->input->post('user_id');

    $data['status'] = 200;
    $data['message'] = 'success';

    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;

    if ($month == 1)
        $m = 'January';
    else if ($month == 2)
        $m = 'February';
    else if ($month == 3)
        $m = 'March';
    else if ($month == 4)
        $m = 'April';
    else if ($month == 5)
        $m = 'May';
    else if ($month == 6)
        $m = 'June';
    else if ($month == 7)
        $m = 'July';
    else if ($month == 8)
        $m = 'August';
    else if ($month == 9)
        $m = 'Sepetember';
    else if ($month == 10)
        $m = 'October';
    else if ($month == 11)
        $m = 'November';
    else if ($month == 12)
        $m = 'December';

    $data['class_name'] = $class_name;
    $data['section_name'] = $section_name;
    $data['month'] = $m;
    $data['year'] = $sessional_year;

    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);

    $monthNumbers = array();

    for ($i = 1; $i <= $days; $i++) {
       array_push($monthNumbers, $i.'');
   }

   $data['month_numbers'] = $monthNumbers;

   $data2 = array();
   $students = $this->db->get_where('enroll', array('student_id' => $student_id,'class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
   if (sizeof($students) > 0){
     foreach ($students as $key => $row) {
        $data2[$key]['student'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;

        $attendanceStatus = array();
        for ($i = 1; $i <= $days; $i++) {
            
            $timestamp =  strtotime($i . '-' . $month . '-' . $sessional_year); 
             $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $student_id))->result_array();

             if ($attendance[0]['status']) {
                  array_push($attendanceStatus, $attendance[0]['status']);
             } else {
                 array_push($attendanceStatus, '0');
             }
        }
        $data2[$key]['status'] = $attendanceStatus;
    }

}

$data['attendance'] = $data2;

echo json_encode($data);

}

function getStudentVisitorList() {

    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    if ($this->input->post('user_type') == 'student') {
        $role_id = 4;
    } else {
        $role_id = 5;
    }

        //$visitors  = $this->crud_model->get_visitor_list_users($this->input->post('user_id'), $role_id);
    $this->db->select('V.*');
    $this->db->from('visitors AS V');
    $this->db->where('V.year', $running_year);
    $this->db->where('V.user_id', $this->input->post('user_id'));
    $this->db->where('V.role_id', $role_id);
    $this->db->order_by('V.id', 'DESC');
    $visitors = $this->db->get()->result();

    foreach ($visitors as $key => $dt) {
        $visitors[$key] -> date = date('d F Y',strtotime($dt->created_at));
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data'] = $visitors;

    echo json_encode($data);
}


public function getExamSchedule() {

    if ($this->input->post('user_type') == 'student') {

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exam_data = "";
        $studentDetails  = $this->db->get_where('enroll',array('student_id'=>$this->input->post('user_id'),'year'=>$running_year))->row();
        if(@$studentDetails->class_id != "")
            $exams = $this->db->get_where('exam_schedule',array('status'=>1,'class_id'=>$studentDetails->class_id))->result();

        foreach ($exams as $key => $dt) {
            $exams[$key] -> name = $this->db->get_where('exam',array('exam_id'=>$dt->exam_id))->row()->name;
            $exams[$key] -> subject = $this->db->get_where('subject',array('subject_id'=>$dt->subject_id))->row()->name;
            $exams[$key] -> class_name = $this->db->get_where('class',array('class_id'=>$dt->class_id))->row()->name;
        }

    } else {
        $class_id = $this->input->post('cid');
        if ($class_id == 0) {
            $class_id = '';
        }
        $exams = $this->crud_model->get_schedule_list_mobile($class_id);
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['exams'] = $exams;
    echo json_encode($data);
}

function getHostelAttendance() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $dataa['status'] = 200;
    $dataa['message'] = 'success';
    $hostel_id = $this->input->post('hostel_id');
    $login_type = $this->input->post('login_type');
    $login_user_id = $this->input->post('login_user_id');
    $month = $this->input->post('month');
    $sessional_year = $this->input->post('year');



    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
    $dataa['totalDates'] = $days;

    $data = array();
    $this->db->select('*');
    $this->db->where('hostel_id',$hostel_id);
    $this->db->where('year' , $running_year);
    $this->db->group_by('student_id');
    $hosteldata = $this->db->get('hostel_attendance')->result_array();

    $dataa['hosteldata'] = $hosteldata;

    foreach ($hosteldata as $key => $row){


     $hosteldata[$key]['student_name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
     $hosteldata[$key]['picture'] = $this->crud_model->get_image_url($login_type, $login_user_id);

     $status = 0;

     $available = array();
     for ($i = 1; $i <= $days; $i++) {
        $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
        $attendance = $this->db->get_where('hostel_attendance', array('hostel_id' => $hostel_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->row_array();

                                //$hosteldata[$key]['attendance'] = $attendance;

        if ($attendance) {
            $attendance['original_date'] = date('d', $attendance['timestamp']);
            array_push($available, $attendance);
        }

                                //$dataa[$key][$i]['attendance'] = $attendance;
                                /*foreach ($attendance as $row1){
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                    $status = $row1['status'];


                                }*/


                                if ($status == 1) {

                                } if($status == 2)  {

                                }

                                $status =0;



                            }

                            $hosteldata[$key]['attendance'] = $available;
          //print_r($available);die();

                        }

                        $dataa['hosteldata'] = $hosteldata;
                        echo json_encode($dataa);
                    }

                    function get_visitor_info() {
                        $visitorList = $this->visitor->get_visitor_list();
                        $data['status'] = 200;
                        $data['data'] = $visitorList;

                        foreach ($visitorList as $key => $value) {
                            $visitorList[$key] -> toMeet = (get_user_by_role($value -> role_id,$value -> user_id) -> name);
                        }

                        echo json_encode($data);
                    }

                    function getLeaveReports() {
                        $class_id = "";$section_id="";$student="";$month="";
                        $class_id  = $this->input->post('class_id');
                        $section_id  = $this->input->post('section_id');

                        if(isset($post['student']))
                            $student  = $this->input->post('student');
                        $month  = $this->input->post('month');

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
                   $result =  $this->db->get()->result();

                   foreach ($result as $key => $row) {
                    $result[$key] -> name = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->name;
                    $result[$key] -> phone = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->phone;
                    $result[$key] -> email = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->email;
                    $result[$key] -> role = $this->db->get_where('roles', array('id' => $row -> role_id))->row()->name;
                }

                $data['status'] = 200;
                $data['data'] = $result;

                echo json_encode($data);
            }

            function getAssetReport() {
                $assets = $this->db->get_where('asset', array('status' => 1))->result();
                foreach ($assets as $key => $dt) {
                    $assets[$key] -> category_name = $this->db->get_where('asset_category', array('asset_category_id' => $dt->category))->row()->category;
                }
                $data['assets'] = $assets;
                $data['status'] = 200;
                echo json_encode($data);
            }

            function getCertificateRequests() {

                $data['status'] = 200;
                $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                $this->db->select('AC.* ,V.name AS certificate_type, P.name AS parentname,S.student_code ,S.name, AC.status');
                $this->db->from('apply_certificates AS AC');
                $this->db->join('certificates AS V', 'V.id = AC.certificate_type');
                $this->db->join('student AS S', 'S.student_id = AC.student_id');
                $this->db->join('parent AS P', 'P.parent_id = AC.apply_by');
                $this->db->where('AC.year', $running_year);

                if ($this->input->post('user_type') == 'student') {
            //echo "string";
                    $this->db->where('AC.student_id', $this->input->post('user_id'));
                }

                $this->db->order_by('AC.id', 'DESC');
                $allCertificates =  $this->db->get()->result();

                foreach ($allCertificates as $key => $row) {
                    $allCertificates[$key] -> phone = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->phone;
                    $allCertificates[$key] -> email = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->email;
                    $allCertificates[$key] -> role = $this->db->get_where('roles', array('id' => $row -> role_id))->row()->name;
                }

                $data['all_certificates'] = $allCertificates;
                echo json_encode($data);
            }

            function getStudentBalance() {
                $studentId = $this->input->post('student_id');

                $this->db->select('*');
                $this->db->from('student');
                $this->db->where('student_id', $studentId);

                $query = $this->db->get()->row_array();

                $data['status'] = 200;
                if ($query) {
                    $data['balance'] = $query['balance'];
                } else {
                    $data['balance'] = '0.00';
                }

                $data['card_code'] = @$this->db->get_where('enroll', array('student_id' => $studentId)) -> row() -> card_code;
                $data['card_status'] = @$this->db->get_where('enroll', array('student_id' => $studentId)) -> row() -> card_code_status;

                echo json_encode($data);
            }

            function getStudentPaymentData() {
                $studentId = $this->input->post('student_id');
                if(!empty($this->input->post('paid_status'))){
                    if($this->input->post('paid_status')==1){
                        $this->db->where('paid_status','paid');
                    }else{
                        $this->db->where('paid_status','unpaid');
                    }
                }
                $invoices = $this->db->get_where('invoices', array('student_id' => $studentId))->result_array();

                foreach ($invoices as $key => $value) {
                    $invoices[$key]['student_name'] = $this->db->get_where('student', array('student_id' => $value['student_id']))->row()->name;
                    $invoices[$key]['title'] = $this->db->get_where('income_heads',array('id' => $value['income_head_id']))->row()->title;
          //  $allCertificates[$key] -> email = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->email;
          //  $allCertificates[$key] -> role = $this->db->get_where('roles', array('id' => $row -> role_id))->row()->name;
                }

                $data['status'] = 200;
                $data['invoices'] = $invoices;

                echo json_encode($data);
            }

            function getStudentBookRequests() {
                $this->db->order_by('book_request_id', 'desc');
                $book_requests = $this->db->get_where('book_request', array('user_id' => $this->input->post('student_id')))->result_array();

                foreach ($book_requests as $key => $row) {
                    $book_requests[$key]['book_name'] = $this->db->get_where('book', array('book_id' => $row['book_id']))->row()->name;
                    $book_requests[$key]['student_name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                    $book_requests[$key]['start_date'] = date('d/m/Y', $row['issue_start_date']);
                    $book_requests[$key]['end_date'] = date('d/m/Y', $row['issue_end_date']);

                    if($row['status'] == 0)
                        $book_requests[$key]['status_text'] = get_phrase('pending');
                    else if($row['status'] == 1)
                        $book_requests[$key]['status_text'] = get_phrase('issued');
                    else
                        $book_requests[$key]['status_text'] = get_phrase('rejected');
                }

                $data['status'] = 200;
                $data['requests'] = $book_requests;
                echo json_encode($data);
            }

            function getScholarshipExamSchedule() {
                $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

                if ($this->input->post('user_type') == 'parent') {
                    $this->db->select('O.*');
                    $this->db->from('scholarship_student AS S');
                    $this->db->join('scholarship_online_exam AS O', 'O.class_id = S.class_id');
                    $this->db->join('student AS ST', 'ST.student_id = S.student_id');
                    $this->db->where('S.section_id = O.section_id');
                    $this->db->where('S.running_year', $running_year);
                    $this->db->where('ST.parent_id', $this->input->post('user_id'));
                    $result = $this->db->get()->result();
                } else {
                    $this->db->select('O.*');
                    $this->db->from('scholarship_student AS S');
                    $this->db->join('scholarship_online_exam AS O', 'O.class_id = S.class_id');
                    $this->db->where('S.running_year', $running_year);
                    $this->db->where('O.running_year', $running_year);
                    $this->db->where('S.student_id', $this->input->post('user_id'));
                    $result = $this->db->get()->result();
                }

                foreach ($result as $key => $value) {
                    $result[$key] -> day_and_date = date('F, d - Y ( l )',$value->exam_date);
                }

                $data['status'] = 200;
                $data['exams'] = $result;
                echo json_encode($data);

            }

            function getStudentHostelAttendance() {
                $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                $dataa['status'] = 200;
                $dataa['message'] = 'success';
                $hostel_id = $this->input->post('hostel_id');
                $login_type = $this->input->post('login_type');
                $login_user_id = $this->input->post('login_user_id');
                $month = $this->input->post('month');
                $sessional_year = $this->input->post('year');



                $year = explode('-', $running_year);
                $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
                $dataa['totalDates'] = $days;

                $data = array();
                $this->db->select('*');
                $this->db->where('hostel_id',$hostel_id);
                $this->db->where('year' , $running_year);
                $this->db->group_by('student_id');
                $hosteldata = $this->db->get('hostel_attendance')->result_array();

                $dataa['hosteldata'] = $hosteldata;

                foreach ($hosteldata as $key => $row){


                 $hosteldata[$key]['student_name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                 $hosteldata[$key]['picture'] = $this->crud_model->get_image_url($login_type, $login_user_id);

                 $status = 0;

                 $available = array();
                 for ($i = 1; $i <= $days; $i++) {
                    $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                    $attendance = $this->db->get_where('hostel_attendance', array('hostel_id' => $hostel_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->row_array();

                                //$hosteldata[$key]['attendance'] = $attendance;

                    if ($attendance) {
                        $attendance['original_date'] = date('d', $attendance['timestamp']);
                        array_push($available, $attendance);
                    }

                                //$dataa[$key][$i]['attendance'] = $attendance;
                                /*foreach ($attendance as $row1){
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                    $status = $row1['status'];


                                }*/


                                if ($status == 1) {

                                } if($status == 2)  {

                                }

                                $status =0;



                            }

                            $hosteldata[$key]['attendance'] = $available;
          //print_r($available);die();

                        }

                        $dataa['hosteldata'] = $hosteldata;
                        echo json_encode($dataa);
                    }


                    function getTeachersWithStudents() {
                        $teacherClass = $this->db->get_where('section', array('teacher_id'=>$this->input->post('user_id'),'sub_teacher_status'=>0))->result();

                        if($teacherClass){
                            foreach($teacherClass as $key => $dt){
                                $class_name   = $this->db->get_where('class', array('class_id'=>$dt->class_id))->row()->name;
                                $classdetails = $dt->class_id.'^'.$dt->section_id;
                                $teacherClass[$key] -> display_name = $class_name .'('.$dt->name.')';

                                $sections   = $this->ajax->get_list_student($teacherClass[$key] -> class_id, $teacherClass[$key] -> section_id);
                                $teacherClass[$key] -> students = $sections;
                            }
                        }

                        $data['data'] = $teacherClass;
                        $data['status'] = 200;

                        echo json_encode($data);
                    }

                    function getAcademicYears() {
       // $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                        $total_years  = $this->db->query("select * from academic_years where status = 1 order by session_year asc")->result();
                        $data['years'] = $total_years;
                        $data['status'] = 200;

                        echo json_encode($data);
                    }

                    function getStudentLeaveReportForTeacher() {
                        $class_id = "";$section_id="";$student="";$month="";
       // if($post != ""){
                        $class_id   = $this->input->post('class_id');
                        $section_id = $this->input->post('section_id');
     //   if(isset($post['student']))
                        $student    = $this->input->post('student');

                        $month      = $this->input->post('month');
       // }
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
                   $result =  $this->db->get()->result();

        //print_r($result); die();
                   foreach ($result as $key => $row) {
                    $result[$key] -> email = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->email;
                    $result[$key] -> phone = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->phone;
                    $result[$key] -> role = $this->db->get_where('roles', array('id' => $row -> role_id))->row()->name;
                }

                $data['data'] = $result;
                $data['status'] = 200;

                echo json_encode($data);
            }

            function getStudentLeaveSchedule() {
                $tid = $this->input->post('tid');
                $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

                if ($this->input->post('user_type') == 'parent') {
                    $result = $this->db->get_where('leave_request', array('id_no'=>$this->input->post('student_code'),'year'=>$running_year))->result();
                    foreach ($result as $key => $value) {
                        @$result[$key] -> student_id = $this->db->get_where('student', array('student_code' => $value -> id_no)) -> row() -> student_id;
                        @$result[$key] -> class_id = $this->db->get_where('enroll', array('student_id' => $result[$key] -> student_id)) -> row() -> class_id;
                        @$result[$key] -> section_id = $this->db->get_where('enroll', array('student_id' => $result[$key] -> student_id)) -> row() -> section_id;
                    }
            //print_r($result); die;
                } else if ($this->input->post('user_type') == 'student') {
                    $result = $this->db->get_where('leave_request', array('id_no'=>$this->input->post('student_code'),'year'=>$running_year))->result();
                    foreach ($result as $key => $value) {
                        @$result[$key] -> student_id = $this->db->get_where('student', array('student_code' => $value -> id_no)) -> row() -> student_id;
                        @$result[$key] -> class_id = $this->db->get_where('enroll', array('student_id' => $result[$key] -> student_id)) -> row() -> class_id;
                        @$result[$key] -> section_id = $this->db->get_where('enroll', array('student_id' => $result[$key] -> student_id)) -> row() -> section_id;
                    }
                } else {
                    $this->db->select('L.*,S.name as student_name,E.*');
                    $this->db->from('leave_request AS L');
                    $this->db->join('student AS S', 'S.student_code = L.id_no');
                    $this->db->join('enroll AS E', 'E.student_id = S.student_id');
                    $this->db->join('section AS SC', 'SC.class_id = E.class_id');
                    $this->db->where('S.student_id = E.student_id');
                    $this->db->where('SC.section_id = E.section_id');
                    $this->db->where('SC.teacher_id',$tid);
                    $this->db->where('L.year',$running_year);
                    $this->db->where("(L.role_id = ".PARENTT ." OR L.role_id =".STUDENT.")");
                    $result =  $this->db->get()->result();
                }

                foreach ($result as $key => $row) {
                    @$result[$key] -> email = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->email;
                    @$result[$key] -> phone = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->phone;

                    if ($this->input->post('user_type') == 'parent') {
                        @$result[$key] -> student_name = $this->db->get_where('student', array('student_id' => $row -> student_id))->row()->name;
                    }

                    @$result[$key] -> role = $this->db->get_where('roles', array('id' => $row -> role_id))->row()->name;
                    @$result[$key] -> class_name =  $this->db->get_where('class', array('class_id' => $row -> class_id))->row()->name;

                    @$result[$key] -> section_id = $this->db->get_where('section', array('section_id' => $row -> section_id))->row()->name;
                }

                $data['data'] = $result;
                $data['status'] = 200;

                echo json_encode($data);
            }

            function getClassesWithSectionsAndSubjects() {
                $classes = $this->db->query("select * from class")->result_array();


                foreach ($classes as $key => $class) {
                    $sections = $this->db->get_where('section', array('class_id' => $class['class_id']))->result_array();
                    $classes[$key]['sections'] = $sections;

                    foreach ($sections as $key2 => $section) {
                        $subjects = $this->db->get_where('subject', array('class_id' => $class['class_id'], 'section_id' => $section['section_id'], 'teacher_id' => $this->input->post('user_id'), 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result();

                        $classes[$key]['sections'][$key2]['subjects'] = $subjects;
                    }
           // print_r($sections); die();
                }

                $data['data'] = $classes;
                $data['status'] = 200;
                echo json_encode($data);
            }

            function getMarksForTeacher() {

                $exam_id   = $this->input->post('exam_id');
                $class_id   = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $subject_id = $this->input->post('subject_id');
                $running_year      = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                $data['exam_id']    = $exam_id;
                $data['class_id']   = $class_id;
                $data['section_id'] = $section_id;
                $data['subject_id'] = $subject_id;
                $data['year']       = $running_year;
                $query = $this->db->get_where('mark' , array(
                    'exam_id' => $exam_id,
                        'class_id' => $class_id,
                            'section_id' => $section_id,
                                'subject_id' => $subject_id,
                                    'year' => $running_year
                ));
            if($query->num_rows() < 1) {
                $students = $this->db->get_where('enroll' , array(
                    'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
                ))->result_array();
                foreach($students as $row) {
                    $data['student_id'] = $row['student_id'];
                         
          
                    $this->db->insert('mark' , $data);
                    $insert_id = $this->db->insert_id();
                    
                    $subject = $this->db->get_where('subject_competencies' , array('subject_id' =>$data['subject_id']))->result_array();
                    $data1 = array();
                   foreach($subject as $row2) {
                        $data1['mark_id']    = $insert_id;
                        $data1['competencies_name']=$row2['name'];
                        $this->db->insert('cat_mark' , $data1);
                    } 
                
                    $practial = $this->db->get_where('subject_practial' , array('subject_id' =>$data['subject_id']))->result_array();
                    $data1 = array();
                    foreach($practial as $row22) {
                        $data1['mark_id']    = $insert_id;
                        $data1['competencies_name']=$row22['name'];
                        $this->db->insert('cat_mark' , $data1);
                    }
                }
            }
                $marks_of_students = $this->db->get_where('mark' , array(
                    'class_id' => $class_id,
                    'section_id' => $section_id ,
                    'year' => $running_year,
                    'subject_id' => $subject_id,
                    'exam_id' => $exam_id
                ))->result_array();
                foreach($marks_of_students as $key => $row) {
                    $marks = $this->db->get_where('cat_mark', array('mark_id'=>$row['mark_id']))->result_array();
                    $marks_of_students[$key]['student_name'] = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $marks_of_students[$key]['student_code'] = $this->db->get_where('student', array('student_id'=>$row['student_id']))->row()->student_code;
                    foreach($marks as $mark){
                        $marks_of_students[$key][$mark['competencies_name']] = $mark['competencies_marks'];
                    }
                }

                $data['data'] = $marks_of_students;
                $data['status'] = 200;

                echo json_encode($data);

                /*redirect(site_url('teacher/marks_manage_view/'. $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id']) , 'refresh');*/
            }

            function getStudentsForParent() {
                $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                $query = $this->db->get_where('student' , array('parent_id' => $this->input->post('user_id')))->result_array();

                foreach ($query as $key => $row) {
                    $query[$key]['class_id'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'])) -> row() -> class_id;
                    $query[$key]['section_id'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'])) -> row() -> section_id;
                    $query[$key]['student_roll'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'])) -> row() -> roll;

                    $this->db->select('*');
                    $this->db->from('attendance');
                    $this->db->where('timestamp >=', strtotime("-1 month"));
                    $this->db->where('student_id', $row['student_id']);
                    $this->db->where('status', '1');
                    $query[$key]['present_count_month'] = $this->db->get()->num_rows();

                    $this->db->select('*');
                    $this->db->from('attendance');
                    $this->db->where('timestamp >=', strtotime("-1 month"));
                    $this->db->where('student_id', $row['student_id']);
                    $this->db->where('status !=', '1');
                    $query[$key]['absent_count_month'] = $this->db->get()->num_rows();

                    $query[$key]['photo'] = $this->crud_model->get_image_url('student', $row['student_id']);
                    $query[$key]['class_name'] =  $this->db->get_where('class', array('class_id' => $query[$key]['class_id'])) -> row() -> name;
                    $query[$key]['section_name'] =  $this->db->get_where('section', array('section_id' => $query[$key]['section_id'])) -> row() -> name;

                    if ($query[$key]['is_hostel_member'] == '1' ) {
                        $query[$key]['hostel_name'] = $this->db->get_where('hostels', array('id' => $row['hostel_id'])) -> row() -> name;
                    } else {
                        $query[$key]['hostel_name'] = '';
                    }

                        //Getting Average Marks
                    $exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
                    $examData = array();
                    foreach ($exams as $key2 => $exam) {
                        $student_marks = $this->db->get_where('mark', array('exam_id' => $exam['exam_id'],'student_id' => $row['student_id'], 'year' => $running_year))->result_array();
                        $totalMarks = 0;
                        $totalHighestMarks = 0;
                        foreach ($student_marks as $row2) {
                            $totalMarks = $totalMarks + $row2['mark_obtained'];
                            /*$totalHighestMarks = $totalHighestMarks + $this->crud_model->get_highest_marks_mobile($row2['exam_id'] , $row2['class_id'] , $row2['subject_id'] );*/
                            $totalHighestMarks = $totalHighestMarks + $row2['mark_total'];
                        }

                        $markcal['total'] = $totalMarks;
                        $markcal['highest'] = $totalHighestMarks;
                        $markcal['name'] = $exam['name'];

                        if ($totalMarks == 0 || $totalHighestMarks == 0) {
                            $markcal['percent'] = '0';
                        } else {
                            $markcal['percent'] = ($totalMarks/$totalHighestMarks) * 100;
                        }
                        array_push($examData, $markcal);
                    }

                    $query[$key]['exam_data'] = $examData;

                        //Getting last 5 transactions
                    $this->db->select('*');
                    $this->db->from('payment');
                    $this->db->where('student_id', $row['student_id']);
                    $this->db->limit(5);
                    $this->db->order_by('timestamp', 'DESC');

                    $query[$key]['payments'] = $this->db->get()->result_array();

                        //GETTING ONBOARD STATUS
                    $timestamp = $this->db->query("select max(timestamp) as max_timestamp from attendance where student_id = ".$row['student_id']." AND bus_status = 1 limit 1")->row()->max_timestamp;
                    if ($row['is_transport_member']) {
                        $query[$key]['last_boarded_at'] = date('h:i:s', $timestamp);
                        $query[$key]['last_boarded_on'] = date('d-M-Y', $timestamp);
                    } else {
                        $query[$key]['last_boarded_at'] = "N/A";
                        $query[$key]['last_boarded_on'] = "N/A";
                    }

                        //VEHICLE STATUS
                    if ($row['is_transport_member']) {
                            $vehicle_assigned_to_route = $this->db->get_where('routes', array('id' => $row['transport_id']))->row()->vehicle_ids; // 2 for 8
                            $driver_assigned_to_vehicle = $this->db->get_where('vehicles', array('id' => $vehicle_assigned_to_route)) -> row() -> driver;
                            $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $driver_assigned_to_vehicle)) -> row() -> on_duty;
                            if ($is_driver_on_route_active) {
                                $query[$key]['is_driver_on_route_active'] = $is_driver_on_route_active;
                            } else {
                                $query[$key]['is_driver_on_route_active'] = '0';
                            }
                        } else {
                            $query[$key]['is_driver_on_route_active'] = '0';
                        }

                       // echo $row['is_transport_member'];

                        //VEHICLE DETAILS
                        if ($row['is_transport_member']) {
                        //$vehicleAssigned = @$this->db->get_where('routes', array('id' => $this->input->post('transport_id'))) -> row() -> vehicle_ids;
                            $vehicles = $this->db->get_where('vehicles' , array('id' => $vehicle_assigned_to_route))->result_array();
                            foreach ($vehicles as $key => $value) {
                                $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));


                                $md = json_decode($vehicles[$key]['route'] -> stop_details);
                                $ms = array();

            //print_r($md);
                                for($i = 0; $i < sizeof($md); $i++) {
                                    $ms[$i] = json_decode($md[$i]);

                                    $ms[$i] -> lat = $ms[$i] -> lat .'';
                                    $ms[$i] -> lng = $ms[$i] -> lng .'';
                                    $ms[$i] -> distance = $ms[$i] -> distance .'';
                                }
           // $md = json_decode($md[0]);


                                $vehicles[$key]['route'] -> stop_details = $ms;

                                $vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');

                                $vehicles[$key]['driver_name'] = @$this->db->get_where('employees', array('user_id' => $vehicles[$key]['driver'])) -> row() -> name;
                            }

                            $query[$key]['vehicles'] = $vehicles;
                        } else {
                        	$query[$key]['vehicles'] = array();
                        }

                        //GETTING PERIOD ATTENDANCE
                        $today = date("Y-m-d");

                        $todays=  strtotime($today);
                        //echo $todays; die;
                        $days= date('l', strtotime($today));

                        $time = date("H:i",time());
                        $endTime = date("H:i",time() + 3600);

                        $class_id = $query[$key]['class_id'];
                        $section_id = $query[$key]['section_id'];
                        /*$class_id = 1;
                        $section_id = 1;
                        $days = "monday";*/

                        $periodtime = $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND   time_start >= '$time' AND time_start <= '$endTime'")->row()->period;
                        if ($periodtime) {
                        	$query[$key]['are_classes_ongoing'] = true;
                        	$query[$key]['current_period'] = $periodtime;
                        	//$isCurrentlyPresent = $this->db->get_where('class_attendance', array('student_id' => $row['student_id'], ));
                        	$this->db->select('*');
                        	$this->db->from('class_attendance');
                        	$this->db->where('student_id', $row['student_id']);
                        	$this->db->where('time >=',  $time);
                        	$this->db->where('time <=',  $endTime);
                        	$this->db->where('date',  $todays);
                        	if ($this->db->get()->num_rows() > 0) {
                        		$query[$key]['is_present'] = true;
                        	} else {
                        		$query[$key]['is_present'] = false;
                        	}
                        } else {
                        	$query[$key]['are_classes_ongoing'] = false;
                        }
                       // echo $timestamp; die;

                    }
                    //die;
                    $data['academid_year'] = $running_year;
                    $data['status'] = 200;
                    $data['students'] = $query;
                    echo json_encode($data);
                }

                function studentExamScheduleForParent() {
                    $exam_data = $this->parents->_examlist_by_student_n_class($this->input->post('user_id'));
                    foreach ($exam_data as $key => $dt) {
                        $reexam = @$this->db->get_where('re_exam',array('exam'=>$dt->id))->row()->re_exam_id;
                        $re_exam_cancel  = @$this->db->get_where('re_exam_cancel',array('exam'=>$dt->id))->row()->cancel_exam_id;
                        if($reexam !="" && $re_exam_cancel == 0)
                            $exam_data[$key] -> exam_status = "rescheduled";
                        elseif($re_exam_cancel != "")
                            $exam_data[$key] -> exam_status = "canceled";
                        else
                            $exam_data[$key] -> exam_status = "";

                        $exam_data[$key] -> answer_sheet = base_url() . 'uploads/exam_answer_sheet/' . $dt->answer_sheet_file;
                        $exam_data[$key] -> subject = $dt -> subject_name;
                        $exam_data[$key] -> name = $dt -> exam_name;


                    }
        /*$data['schedule_data']    = $this->parents->get_student_re_exam_list($this->input->post('login_user_id'));
        $data['exam_cancel_data'] = $this->parents->get_student_cancel_exam_list($this->input->post('login_user_id'));*/

        $data['status'] = 200;
        $data['exams'] = $exam_data;
        echo json_encode($data);
    }

    function getParentReExamSchedule() {
        $rescheduled_exams = $this->parents->get_student_re_exam_list($this->input->post('user_id'));
        $cancelled_exams = $this->parents->get_student_cancel_exam_list($this->input->post('user_id'));

        foreach ($rescheduled_exams as $key => $value) {
            $rescheduled_exams[$key] -> section = $value -> section_name;
            $rescheduled_exams[$key] -> exam = $value -> exam_name;
        }
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['rescheduled_exams'] = $rescheduled_exams;
        $data['cancelled_exams'] = $cancelled_exams;
        echo json_encode($data);

    }

    function getAllParentCertificates() {
      //  $all_certificates  = $this->parents->get_all_certificates($this->input->post('user_id'), 8);
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $this->db->select('AC.* ,V.name AS certificate_type, P.name AS parentname,S.student_code ,S.name, AC.status');
        $this->db->from('apply_certificates AS AC');
        $this->db->join('certificates AS V', 'V.id = AC.certificate_type');
        $this->db->join('student AS S', 'S.student_id = AC.student_id');
        $this->db->join('parent AS P', 'P.parent_id = AC.apply_by');
        $this->db->where('AC.year', $running_year);
        $this->db->where('AC.apply_by', $this->input->post('user_id'));
        $this->db->where('AC.role_id', 8);
        //$this->db->where('V.role_id', $role);
        $this->db->order_by('V.id', 'DESC');
        $all_certificates = $this->db->get()->result();

        $data['status'] = 200;
        $data['certificates'] = $all_certificates;

        echo json_encode($data);
    }

    function applyForCertificate() {

        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

        $role_id = 4;
        if ($this->input->post('user_type') == 'parent') {
            $role_id = 8;
        }


        $data['student_id'] = $this->input->post('student_id');
        $data['apply_by']=  $this->input->post('user_id');
        $data['role_id']   = $role_id;
        $data['certificate_type'] = $this->input->post('certificate_type');
        $data['description'] = $this->input->post('description');
        $data['year']    = $running_year;

        if($data['student_id'] != "" && $data['apply_by'] != ""){
            $query = $this->db->insert('apply_certificates',$data);

            if ($query) {
                $data2['status'] = 200;
                $data2['message'] = 'success';
            }
        } else {
            $data2['status'] = 400;
            $data2['message'] = 'error occured';
        }

        echo json_encode($data2);
    }

    function getVisitorListParent() {
        $visitors  = $this->parents->get_visitor_list_users($this->input->post('user_id'), '8');

        $data['status'] = 200;
        $data['data'] = $visitors;

        echo json_encode($data);
    }

    function hostelChangeRequest() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;


        $data['student_id']    = $this->input->post('student_id');
        // if ($this->input->post('user_type') == 'parent') {
        //     $data['role_id'] = 8;
        // } else {
        $data['role_id'] = $this->input->post('role_id');
        // }
        $member = $this->member->get_single('hostel_members', array('user_id' => $data['student_id']));
        if(!empty($member)){
            $data['prev_hostel_id'] = $member->hostel_id;
            $data['prev_room_id']   = $member->room_id;
        }else {
            $data['status'] = 400;
            $data['message'] = 'Error. Feature Available for Old Hostel Students';
            echo json_encode($data);
            die;
        }

        $data['new_hostel_id'] = $this->input->post('hostel_id');
        $data['new_room_id']   = $this->input->post('room_id');
        $data['new_bed_id']   = $this->input->post('bed_no');
        $data['year']          = $running_year;
        $data['create_by']     = $this->input->post('user_id');
        $data['create_at']     = date('Y-m-d H:i:s');
        $query = $this->db->insert('room_change_request',$data);

        if ($query) {
            $data['status'] = 200;
            $data['message'] = 'success';
        } else {
            $data['status'] = 400;
            $data['message'] = 'An error occured';
        }

        echo json_encode($data);
    }

    function getLibrarianSalaryDetails() {
        $data['status'] = 200;
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

        if ($this->input->post('user_type') == 'librarian') {
            $role='librarian';
            $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
            $this->db->from('salary_payments AS S');
            $this->db->join('librarian AS V', 'V.librarian_id = S.user_id');
            $this->db->where('S.academic_year_id', $running_year);
            $this->db->where('S.payment_to', $role);
            $this->db->where('S.user_id', $this->input->post('user_id'));
            $data['salary'] = $this->db->get()->result();
        } else if($this->input->post('user_type') == 'accountant') {
            $role='accountant';
            $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
            $this->db->from('salary_payments AS S');
            $this->db->join('accountant AS V', 'V.accountant_id = S.user_id');
            $this->db->where('S.academic_year_id', $running_year);
            $this->db->where('S.payment_to', $role);
            $this->db->where('S.user_id', $this->input->post('user_id'));
            $data['salary'] = $this->db->get()->result();
        } else if ($this->input->post('user_type') == 'teacher') {
            $role='teacher';
            $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
            $this->db->from('salary_payments AS S');
            $this->db->join('teacher AS V', 'V.teacher_id = S.user_id');
            $this->db->where('S.academic_year_id', $running_year);
            $this->db->where('S.payment_to', $role);
            $this->db->where('S.user_id', $this->input->post('user_id'));
            $data['salary'] = $this->db->get()->result();
        } else if ($this->input->post('user_type') == 'driver' || $this->input->post('user_type') == 'warden' || $this->input->post('user_type') == 'guard' || $this->input->post('user_type') == 'inventory' || $this->input->post('user_type') == 'transport') {
            //$role=$this->session->userdata('role_id');
            $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
            $this->db->from('salary_payments AS S');
            $this->db->join('employees AS V', 'V.user_id = S.user_id');
            $this->db->where('S.academic_year_id', $running_year);
           // if ($role=='13')
            if ($this->input->post('user_type') != 'guard')
                $this->db->where('S.payment_to', $this->input->post('user_type'));
            //if ($role=='9')
              //  $this->db->where('S.payment_to', 'driver');
            $this->db->where('S.user_id', $this->input->post('user_id'));
       // $this->db->order_by('V.id', 'DESC');
            $data['salary'] = $this->db->get()->result();
        }
        echo json_encode($data);
    }

    function getAccountantDashboard() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $unpaid_invoices = 0;
        $payments = $this->db->get_where('invoice', array('year' => $running_year))->result_array();
        foreach($payments as $row)
            $unpaid_invoices += $row['due'];


        $total_income = 0;
        $payments = $this->db->get_where('payment', array('year' => $running_year, 'payment_type' => 'income'))->result_array();
        foreach($payments as $row)
            $total_income += $row['amount'];

        $total_expense = 0;
        $payments = $this->db->get_where('payment', array('year' => $running_year, 'payment_type' => 'expense'))->result_array();
        foreach($payments as $row)
            $total_expense += $row['amount'];

        $data['status'] = 'success';
        $data['unpaid_invoices'] = $unpaid_invoices;
        $data['total_income'] = $total_income;
        $data['total_expense'] = $total_expense;

        echo json_encode($data);
    }

    function hello() {
        echo 'hello';
    }

    function getExpenditures() {
        if(!empty($this->input->post('expenditure_head_id'))){
            $this->expenditure->db->where('E.expenditure_head_id',$this->input->post('expenditure_head_id'));
        }
        $expheads  = $this->expenditure->get_expenditure_list($this->input->post('date_to'),$this->input->post('date_from'));

        $data['status'] = 200;
        $data['data'] = $expheads;

        echo json_encode($data);
    }

    function getSalaryPayslipRequests() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $this->db->select('S.* ,S.created_at , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');

        $this->db->where('S.academic_year_id', $running_year);
        $this->db->where('S.payslip_status', 1);

       // $this->db->order_by('V.id', 'DESC');
        $qurey = $this->db->get()->result();

        foreach ($qurey as $key => $value) {
           $user_id= $value -> user_id;
           if ($value -> payment_to == 'librarian'){
            $qurey[$key] -> request_by = $this->db->get_where('librarian',array('librarian_id'=>$user_id))->row() -> name;
        } elseif($value -> payment_to == 'teacher'){
            $qurey[$key] -> request_by = $this->db->get_where('teacher',array('teacher_id'=>$user_id))->row() -> name;
        } elseif($value -> payment_to == 'accountant'){
            $qurey[$key] -> request_by = $this->db->get_where('accountant',array('accountant_id'=>$user_id))->row() -> name;
            }/*  elseif($value -> payment_to == 'driver'){
                $qurey[$key] -> request_by = $this->db->get_where('driver',array('driver_id'=>$user_id))->row();
            } */
            //TODO
        }

        $data['status'] = 200;
        $data['payslip_requests'] = $qurey;

        echo json_encode($data);
    }

    function updateSalaryPayslipStatus() {
        //approve 2, reject 3
        $this->db->where('id',$this->input->post('id'));
        $query = $this->db->update('salary_payments',array('payslip_status'=>$this->input->post('status')));
        if ($query) {
            $data['status'] = 200;
            $data['message'] = 'Success';
        } else {
            $data['status'] = 400;
            $data['message'] = 'Some error occured';
        }

        echo json_encode($data);
    }

    function updateSalaryStatus() {
     $this->db->where('id',$this->input->post('id'));
     $query = $this->db->update('salary_payments',array('payslip_status'=>$this->input->post('status')));
     if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
    }
    echo json_encode($data);
}

function updateDriverLocation() {
    $driverId = $this->input->post('driver_id');
    $latitude = $this->input->post('latitude');
    $longitude = $this->input->post('longitude');

    $query = $this->db->get_where('vehicle_location', array('driver_id' => $driverId));

    if ($query->num_rows() > 0) {
        $data = array('latitude' => $latitude, 'longitude' => $longitude);
        $this->db->where('driver_id', $driverId);
        $this->db->update('vehicle_location', $data);
    } else {
        $data = array('driver_id' => $driverId, 'latitude' => $latitude, 'longitude' => $longitude);
        $this->db->insert('vehicle_location', $data);
    }

    $result['status'] = 200;
    $result['message'] = 'success';
    echo json_encode($result);
}

function submitRfidData() {
    $result = array();
    $out    = array();

    $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

    $today = date("Y-m-d");
    $todays=  strtotime($today);
    $days= date('l', strtotime($today));

    $time = date("H:i",time());
    $endTime = date("H:i",time() + 3600);


    $userId = $this->input->post('user_id');
    $type = $this->input->post('type');
    $attendanceString = $this->input->post('data');
    $cardCode = $this->input->post('data');

    /*$data = array(
        'rf_id_no' => $attendanceString,
        'date/time' => date('Y-m-d'),
        'role_id' => 5,
        'user_id' => $userId
    );

    $query = $this->db->insert('daily_bulk_attendance_report', $data);*/
//__MARKING ATTENDANCE___/
    if ($cardCode) {
        $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $cardCode  LIMIT 1");

        if($query3 == 'null'){
            $resultt['status'] = 401;
            $resultt['message'] = 'RFID card not alloted to any student';
        } else {
            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
               foreach ($result3 as $row3) {
                $enroll_code = $row3['enroll_code'];
                $student_id = $row3['student_id'];
                $class_id   = $row3['class_id'];
                $section_id = $row3['section_id'];
            } 

            $query = $this->db->query("SELECT student_id,name,student_code,address,phone,email,parent_id FROM student WHERE student_id=$student_id");
            $url = $this->crud_model->get_image_url('student',$student_id);
            $result = $query->result_array();       
            foreach ($result as $row) {
               $parent_id = $row['parent_id'];
               $query2    = $this->db->query("SELECT name FROM parent WHERE parent_id=$parent_id");
               $result2   = $query2->result_array();
               foreach ($result2 as $row2) {
                   $parent_name = $row2['name'];  
               }
               $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
               $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
               $resultt['parent_name'] = $parent_name;
           }
           $counttotal=strlen($cardCode);
           if($class_id !='' || $section_id !='' || $student_id !='') {
              if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);

                $days= date('l', strtotime($today));
               
                $time = date("H:i",time());
                $endTime = date("H:i",time() + 3600);
                $attn_data['year']  = $running_year;
                $attn_data['date']  = $todays;

                $periodtime= $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND   time_start >= '$time' AND time_start <= '$endTime'")->row()->period;

                $attn_data['class_period'] = $periodtime;
                $attn_data['student_id'] = $student_id;
                $attn_data['class_id'] = $class_id;
                $attn_data['section_id'] = $section_id;
                $attn_data['status'] = 1;
                $attn_data['time'] = date('h:i', time());

                $attencence = $this->db->get_where('attendance' , array('timestamp' => $todays,'class_id'=>$attn_data['class_id'],'section_id'=>$attn_data['section_id'],'student_id'=>$attn_data['student_id']));

                if($periodtime!=''){
                $attencence = $this->db->get_where('class_attendance' , array('date' => $todays,'student_id'=>$attn_data['student_id'],'class_period'=>$attn_data['class_period']));

                if($attencence->num_rows() < 1) {     
                 $this->db->insert('class_attendance' , $attn_data);
                 $resultt['status_text'] = "Attendance marked";
                }else{
                    $resultt['status_text'] = "This student's attendance is already submitted";
                }
                }else {
                    $resultt['status_text'] = "All classes are over";
                }

               /* if($attencence->num_rows() < 1) {                
                 $this->db->insert('attendance' , $attn_data);
             }else{
                $attendance_id = $attencence->row()->attendance_id;
                $this->db->where('attendance_id',$attendance_id);
                $this->db->update('attendance' ,array('status'=>1)); 
            }*/
        }
    }        
}
}
}

$todays=  strtotime($today);
$today = date("Y-m-d");
$todays=  strtotime($today);
$days= date('l', strtotime($today));
$time = date("H:i",time());
$endTime = date("H:i",time() + 3600);


$resultt['number_of_attendence_student'] = $this->db->get_where('class_attendance',array('class_id' =>$class_id,'section_id'=>$section_id,'date'=>$todays))->num_rows();
$resultt['number_of_student_in_class'] = $this->db->get_where('enroll',array('class_id' =>$class_id,'section_id'=>$section_id))->num_rows().'';
    //__________________RETURNING DATA______________________//
$query = $this->db->get_where('enroll', array('card_code' => $cardCode));
if ($query->num_rows() > 0) {
    $query = $query -> row();
    $resultt['student'] = $this->db->get_where('student', array('student_id'=>$query -> student_id))->row();

    $subject_id= $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND  time_start >= '$time' AND time_start <= '$endTime'")->row()->subject_id;


    $resultt['subject_name']   = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;

    $resultt['image_url'] = $this->crud_model->get_image_url('student', $query -> student_id);
    $resultt['status'] = 200;
    $resultt['message'] = 'success';
}
else {
    $resultt['status'] = 401;
    $resultt['message'] = 'RFID card not alloted to any student';
}
    echo json_encode($resultt);
}

function getLocationOfDriver() {
    $driverId = $this->input->post('driver_id');

    $query = $this->db->get_where('vehicle_location', array('driver_id' => $driverId)) -> row();

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['location_data'] = $query;
    echo json_encode($data);
}

function setDriverDutyStatus() {
    $driverId = $this->input->post('user_id');
    $status = $this->input->post('status');

       // $status = 1;

    $query = $this->db->get_where('vehicle_location', array('driver_id' => $driverId));
    if ($query -> num_rows() > 0) {
        $data = array(
            'on_duty' => $status
        );
        $this->db->where('driver_id', $driverId);
        $query = $this->db->update('vehicle_location', $data);
    } else {
        $data = array(
            'on_duty' => $status,
            'driver_id' => $driverId
        );
        $query = $this->db->insert('vehicle_location', $data);
    }

    if ($query) {
        $dataa['status'] = 200;
        $dataa['message'] = 'success';
    } else {
        $dataa['status'] = 400;
        $dataa['message'] = 'false';
    }

    echo json_encode($dataa);
}

function getEmployeeDetails() {
    $query = $this->db->get_where('employees', array('user_id' => $this->input->post('user_id'))) -> row();


    $query -> email = $this->db->get_where('designation_users', array('designation_users_id' => $this->input->post('user_id'))) -> row() -> email;

    $data['status'] = 200;
    $data['details'] = $query;

    if ($this->input->post('user_type') == 'driver') {
        $data['vehicle_details'] = $this->db->get_where('vehicles', array('driver' => $this->input->post('user_id')))->row();
        $data['route_details'] = $this->db->get_where('routes', array('vehicle_ids' => $data['vehicle_details'] -> id))->row();
    }

    echo json_encode($data);
}

function markStudentAttendanceByDriver() {
    $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    $cardCode = $this->input->post('card_code');
    $query = $this->db->get_where('enroll', array('card_code' => $cardCode));
    if ($query->num_rows() > 0) {
        $query = $query -> row();
        $query -> student = $this->db->get_where('student', array('student_id'=>$query -> student_id))->row();
            //$user_profile  = $this->db->get_where('student', array('student_id' => $query -> student_id))->row();
        $query -> image_url = $this->crud_model->get_image_url('student', $query -> student_id);



            //echo strtotime(date("y-m-d")); die;
        $data = array(
            'timestamp' => strtotime(date("Y-m-d H:i:s")),
            'year' => $running_year,
            'class_id' => $query -> class_id,
            'section_id' => $query -> section_id,
            'student_id' => $query -> student_id,
            'bus_status' => 1
        );

        //echo date('d-M-Y h:i:s', '1547107543'); die;

        $this->db->insert('attendance', $data);

        $parentData = $this->db->get_where('parent', array('parent_id' => $query -> student -> parent_id)) -> row();
        if ($parentData -> fcm_token) {
            $this->sendNotification($parentData -> fcm_token, $query -> student -> name);
        }

        echo json_encode($query);

    } else {
           //TODO: Dasas
    }
}

function getRoomSwitchRequests() {
    $query = $this->crud_model->get_room_switch_request();

    foreach ($query as $key => $value) {
       $query[$key] -> parent_name = @$this->db->get_where('parent',array('parent_id'=>$value->screate_by))->row()->name;
   }

   $data['status'] = 200;
   $data['requests'] = $query;

   echo json_encode($data);
}

function changeRoomSwitchrequestStatus() {
    $data['status'] = 200;
    $data['status'] = 'success';
    if($this->input->post('status') !='reject'){
        $dataRepsosne =  $this->db->get_where('room_change_request',['student_id'=>$this->input->post('student_id'),'id'=>$this->input->post('switch_id')])->row();
        //$data_hostel['id']      = $this->input->post('switch_id');
        if(empty($dataRepsosne)){
            echo json_encode(['status'=>400,'error'=>'id not found']);
            die;
        }
        $data_hostel['user_id']        = $this->input->post('student_id');
        $data_hostel['room_id']        = $dataRepsosne->new_room_id;
        $data_hostel['beds']        =   $dataRepsosne->new_bed_id;
        $data_hostel['hostel_id']      = $dataRepsosne->new_hostel_id;
        $data_hostel['status']         = 1;
        $data_hostel['modified_by']    = $this->input->post('user_id');
        $data_hostel['modified_at']    = date('Y-m-d H:i:s');

        $this->db->where('user_id',$this->input->post('student_id'));
        $this->db->update('hostel_members', $data_hostel);

        $hostel['dormitory_id']        = $this->input->post('room_id');
        $hostel['hostel_id']           = $this->input->post('hostel_id');

        $this->db->where('student_id',$this->input->post('student_id'));
        $this->db->update('student', $hostel);

        $this->db->where('id',$this->input->post('switch_id'));
        $this->db->update('room_change_request', array('room_status'=>'approve'));
        
        $data['message'] = "Approved";
    }else{
        $this->db->where('id',$this->input->post('switch_id'));
        $this->db->update('room_change_request', array('room_status'=>'reject'));
        $data['message'] = "Rejected";
    }

    echo json_encode($data);

}


function sendNotification($token, $studentName) {
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    /*$token='drc-CzKcw5c:APA91bHNOl2s8DgediilC7Q-Dm5iVdTOv3Z4jNk6zCZeGTx3iv57DG0cJWJ5NrMhDQkcolKi7SZQnE61lcnOLeYmm2AG7jF_8qLDrixwYMD7VIUMvVRnYc_omjBEvmzlLsIWFrtpg3ro';*/

    $notification = [
        'title' =>'YUCASA SCHOOL',
        'body' => 'Your ward ' .$studentName.' is on board on the bus',
        'icon' =>'myIcon',
        'sound' => 'mySound'
    ];
    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . "AAAAVe0T45s:APA91bGFWImpJssqyEyk8zY9_TbZhqguwSH-3t7qVyG54BJ69TYitlLUt-tzwQylPwSd_4WsAjWkY2OO6Ry-hIWHWdwrQ8eWTvIQ8xbZObFZifcM14277_QO_rLW8JCjF7zRDX1fepzv",
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        //echo $result;
    }

    function updateFcmToken() {
        $this->db->where($this->input->post('user_type').'_id', $this->input->post('user_id'));
        $query = $this->db->update($this->input->post('user_type'), array('fcm_token' => $this->input->post('fcm_token')));

        if ($query) {
            $data['status'] = 200;
            $data['message'] = 'success';
        } else {
            $data['status'] = 400;
            $data['message'] = 'failure';
        }

        echo json_encode($data);
    }
    
    function getStudentAssignments2() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $classId = $this->input->post('class_id');

        $this->db->select('A.*, C.name AS class_name, S.name AS subject');
        $this->db->from('assignments AS A');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
        $this->db->where('A.year', $running_year);
        if($classId){
           $this->db->where('A.class_id', $classId);
       }
       $data['status'] = 200;
       $data['message'] = 'success';
       $assignments = $this->db->get()->result();
       foreach ($assignments as $key => $value) {
       $assignments[$key] -> status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value->id,))->row()->status;


       //__________COUNT LOGIC_____________

    $this->db->select('ST.student_id,ST.name as student_name,C.name as class_name,S.name as subject_name,A.id,A.title,A.deadline,S.name as subject_name,A.assignment');
    $this->db->from('enroll AS E');
    $this->db->join('assignments AS A', 'A.class_id = E.class_id');
    $this->db->join('student AS ST', 'ST.student_id = E.student_id');
    $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
    $this->db->join('subject AS S', 'S.class_id = E.class_id', 'left');
    $this->db->where('S.subject_id = A.subject_id');
    $this->db->where('A.section_id = E.section_id');
    $this->db->where('A.class_id', $value->class_id);
     $this->db->where('A.section_id', $value -> section_id);
     $this->db->where('A.id', $value->id);
     $students = $this->db->get()->result();

     $assignments[$key] -> total = sizeof($students).'';

     $submitted = 0;
     foreach ($students as $key2 => $value2) {
        $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value2->id,'student_id'=>$value2->student_id))->row()->status;

        if ($status) {
            $submitted += 1;
        }
    }
    $assignments[$key] -> submitted = $submitted.'';

       //__________________________________

$section_val = $this->db->get_where("section", array("section_id" => $value->section_id)) -> result();
      //  $section_val = $this->db->query("select name from section where section_id IN ($value->section_id)")->result();
        
        $sectionString = "";
        foreach ($section_val as $key2 => $value_of_section) {
        	if($i>0) {
        		$sectionString = $sectionString . ' , ';
        	}

        	$sectionString = $sectionString . $value_of_section->name;

        	$i++;
        }
        $assignments[$key] -> sections = $sectionString;
        $i = 0;
    }

    $data['assignments']  = $assignments;



    echo json_encode($data);
}


 function getStudentAssignmentsIndividual() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $classId = $this->input->post('class_id');

        $this->db->select('A.*, C.name AS class_name, S.name AS subject');
        $this->db->from('assignments_individual AS A');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
        $this->db->where('A.year', $running_year);
        if($classId){
           $this->db->where('A.class_id', $classId);
       }
       $data['status'] = 200;
       $data['message'] = 'success';
       $assignments = $this->db->get()->result();
       foreach ($assignments as $key => $value) {
       $assignments[$key] -> status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value->id,))->row()->status;


       //__________COUNT LOGIC_____________

    $this->db->select('ST.student_id,ST.name as student_name,C.name as class_name,S.name as subject_name,A.id,A.title,A.deadline,S.name as subject_name,A.assignment');
    $this->db->from('enroll AS E');
    $this->db->join('assignments AS A', 'A.class_id = E.class_id');
    $this->db->join('student AS ST', 'ST.student_id = E.student_id');
    $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
    $this->db->join('subject AS S', 'S.class_id = E.class_id', 'left');
    $this->db->where('S.subject_id = A.subject_id');
    $this->db->where('A.section_id = E.section_id');
    $this->db->where('A.class_id', $value->class_id);
     $this->db->where('A.section_id', $value -> section_id);
     $this->db->where('A.id', $value->id);
     $students = $this->db->get()->result();

     $assignments[$key] -> total = sizeof($students).'';

     $submitted = 0;
     foreach ($students as $key2 => $value2) {
        $status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value2->id,'student_id'=>$value2->student_id))->row()->status;

        if ($status) {
            $submitted += 1;
        }
    }
    $assignments[$key] -> submitted = $submitted.'';

       //__________________________________

$section_val = $this->db->get_where("section", array("section_id" => $value->section_id)) -> result();
      //  $section_val = $this->db->query("select name from section where section_id IN ($value->section_id)")->result();
        
        $sectionString = "";
        foreach ($section_val as $key2 => $value_of_section) {
        	if($i>0) {
        		$sectionString = $sectionString . ' , ';
        	}

        	$sectionString = $sectionString . $value_of_section->name;

        	$i++;
        }
        $assignments[$key] -> sections = $sectionString;
        $i = 0;
    }

    $data['assignments']  = $assignments;



    echo json_encode($data);
}

function deleteStudentAssignments2(){
      $this->db->where('id', $this->input->post('id'));
       $this->db->delete('assignments');
       $data['status'] = "200";
       echo json_encode($data);
}


    function getStudentAssignments() {
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $classId = $this->input->post('class_id');

        $this->db->select('A.*, C.name AS class_name, S.name AS subject');
        $this->db->from('assignments AS A');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
        $this->db->where('A.year', $running_year);
        if($classId){
           $this->db->where('A.class_id', $classId);
       }
       $data['status'] = 200;
       $data['message'] = 'success';
       $assignments = $this->db->get()->result();
       foreach ($assignments as $key => $value) {
        $assignments[$key] -> status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value->id,))->row()->status;

        $section_val = $this->db->query("select name from section where section_id IN ($value->section_id)")->result();
        $sectionString = "";
        foreach ($section_val as $key2 => $value_of_section) {
        	if($i>0) {
        		$sectionString = $sectionString . ' , ';
        	}

        	$sectionString = $sectionString . $value_of_section->name;

        	$i++;
        }
        $assignments[$key] -> sections = $sectionString;
        $i = 0;
    }
    
    $data['assignments']  = $assignments;



    echo json_encode($data);
}

function getSectionsSubjectsAndAssignmentsForClass() {
    $sections = $this->db->get_where('section', array('class_id' => $this->input->post('class_id'))) -> result_array();
    $class_id =  $this->input->post('class_id');
    foreach ($sections as $key => $value) {
        $sections[$key]['subjects'] = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result_array();
        foreach ($sections[$key]['subjects'] as $key2 => $value2) {
            $sections[$key]['subjects'][$key2]['assignments'] = $this->db->get_where('assignments', array('class_id' => $this->input->post('class_id'), 'section_id' => $sections[$key]['section_id'], 'subject_id' => $sections[$key]['subjects'][$key2]['subject_id'])) -> result_array();
        }
    }

    $data['status'] = 200;
    $data['data'] = $sections;

    echo json_encode($data);
}

function getSectionsSubjectsAndAssignmentsForClassIndividual() {
    $sections = $this->db->get_where('section', array('class_id' => $this->input->post('class_id'))) -> result_array();
    $class_id =  $this->input->post('class_id');
    foreach ($sections as $key => $value) {
        $sections[$key]['subjects'] = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result_array();
        foreach ($sections[$key]['subjects'] as $key2 => $value2) {
            $sections[$key]['subjects'][$key2]['assignments'] = $this->db->get_where('assignments_individual', array('class_id' => $this->input->post('class_id'), 'section_id' => $sections[$key]['section_id'], 'subject_id' => $sections[$key]['subjects'][$key2]['subject_id'])) -> result_array();
        }
    }

    $data['status'] = 200;
    $data['data'] = $sections;

    echo json_encode($data);
}

function getAssignmentsBySubjects() {
    $class_id = $this->input->post('class_id');
    $subject_id  = $this->input->post('subject_id');
    $section_id  = $this->input->post('section_id');
    $assigment_id = $this->input->post('assignment_id');
    $student_id = $this->input->post('student_id');

    $this->db->select('ST.student_id,ST.name as student_name,C.name as class_name,S.name as subject_name,A.id,A.title,A.deadline,S.name as subject_name,A.assignment');
    $this->db->from('enroll AS E');
    if($student_id==""){
    $this->db->join('assignments AS A', 'A.class_id = E.class_id');
    }else{
        $this->db->join('assignments_individual AS A', 'A.class_id = E.class_id');
    }
    $this->db->join('student AS ST', 'ST.student_id = E.student_id');
    $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
    $this->db->join('subject AS S', 'S.class_id = E.class_id', 'left');
    $this->db->where('S.subject_id = A.subject_id');
    $this->db->where('A.section_id = E.section_id');
    if($class_id != "")
     $this->db->where('A.class_id', $class_id);

 if($section_id !="")
  $this->db->where('A.section_id', $section_id);

if($subject_id !="")
   $this->db->where('S.subject_id', $subject_id);

if($assigment_id != "")
   $this->db->where('A.id', $assigment_id);

if ($student_id != "")
   $this->db->where('ST.student_id', $student_id);

$this->db->order_by("ST.student_id", "desc");
$assignments = $this->db->get()->result();

foreach ($assignments as $key => $value) {
    $assignments[$key] -> status = @$this->db->get_where('submit_assignment',array('assignment_id'=>$value->id,'student_id'=>$value->student_id))->row()->status;
    $assignments[$key] -> assignment = base_url().'assets/uploads/assignment_upload/'.$assignments[$key] -> assignment;

    $query = $this->db->get_where('submit_assignment', array('student_id' => $assignments[$key] -> student_id, 'assignment_id' => $assignments[$key] -> id));

    if ($query->num_rows() > 0) {
        $query = $query->row();
        $assignments[$key] -> uploaded = base_url().'assets/uploads/assignment_upload/'.$query -> assignment_file;
    } else {
        $assignments[$key] -> uploaded = "";
    }
}

$data['status'] = 200;
$data['assignments'] = $assignments;

echo json_encode($data);
}

function blockUnblockCard() {
    $status = $this->input->post('status');
    $student_id = $this->input->post('student_id');
    $card_no = $this->input->post('card_no');
    $reason = $this->input->post('reason');
    $this->db->where('student_id', $student_id);
    $this->db->update('enroll', array('card_code_status' => $status));

    if ($this->input->post('user_type') == 'student') {
        $data = array(
            'apply_by' => $this->input->post('user_id'),
            'role_id' => 4,
            'card_no' => $card_no,
            'card_user' => $this->input->post('user_id'),
            'card_user_role' => 4,
            'status' => $status,
            'reason' => $reason
        );

        $this->db->insert('block_rfid_card_request', $data);
    } else if ($this->input->post('user_type') == 'parent') {
      $data = array(
        'apply_by' => $this->input->post('user_id'),
        'role_id' => 8,
        'card_no' => $card_no,
        'card_user' => $this->input->post('student_id'),
        'card_user_role' => 4,
        'status' => $status,
        'reason' => $reason
    );

      $this->db->insert('block_rfid_card_request', $data);
  }

  $data['status'] = 200;
  $data['message'] = 'success';

  echo json_encode($data);
}

function getUserListByType() {
    $type = $this->input->post('payment_to');

    if ($type == 'teacher') {

        $this->db->select('T.name, T.teacher_id as id, T.designation, T.email, T.role_id');
        $this->db->from('teacher AS T');
        $this->db->join('users AS U', 'U.id = T.teacher_id', 'left');
        $this->db->join('designations AS D', 'D.id = T.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
        $this->db->where('T.teacher_id >', 0);
        $this->db->order_by('T.teacher_id', 'ASC');
        $users = $this->db->get()->result();


    } elseif ($type == 'warden' || $type== 'driver' || $type== 'security guard' || $type == 'inventory' || $type == 'transport') {

        $this->db->select('E.name, E.user_id as id, SG.grade_name, U.email, U.role_id, D.name AS designation');
        $this->db->from('employees AS E');
        $this->db->join('designation_users AS U', 'U.designation_users_id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
        $this->db->where('E.id >', 0);
        if ($type=='warden')
            $this->db->where('U.role_id', WARDEN);
        if ($type=='driver')
            $this->db->where('U.role_id', DRIVER);
        if ($type=='security-gaurd')
            $this->db->where('U.role_id', 16);
        if ($type == 'inventory')
            $this->db->where('U.role_id', 17);
        if ($type == 'transport')
            $this->db->where('U.role_id', 18);
        $this->db->order_by('E.id', 'ASC');
        $users =  $this->db->get()->result();

    }  elseif ($type == 'librarian') {

        $this->db->select('L.name, L.librarian_id as id, SG.grade_name, L.email, L.role_id');
        $this->db->from('librarian AS L');
            //$this->db->join('designation_users AS U', 'U.designation_users_id = L.librarian_id', 'left');
            //$this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = L.salary_grade_id', 'left');
        $this->db->where('L.librarian_id >', 0);
        $this->db->order_by('L.librarian_id', 'ASC');
        $users =  $this->db->get()->result();

    }
    elseif ($type == 'accountant') {

        $this->db->select('L.name, L.accountant_id as id, SG.grade_name, L.email, L.role_id');
        $this->db->from('accountant AS L');
            //$this->db->join('designation_users AS U', 'U.designation_users_id = L.librarian_id', 'left');
            //$this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = L.salary_grade_id', 'left');
        $this->db->where('L.accountant_id >', 0);
        $this->db->order_by('L.accountant_id', 'ASC');
        $users =  $this->db->get()->result();

    }
    else {
       $users =  array();
   }

   $data['status'] = 200;
   $data['message'] = 'success';
   $data['users'] = $users;

   echo json_encode($data);
}

    //___________________________________________________________________________________//


function getPosInvoices() {

        //echo "string"; die();
    $this->db->select('*');
    $this->db->from('geopos_invoices');
    $this->db->where('i_class', 1);
    $query = $this->db->get()->result_array();

    foreach ($query as $key => $row) {

            //print_r($row['csd']); die();
        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('student_id', $row['csd']);

        $customer = $this->db->get();
        if ($customer) {
            $query[$key]['customer'] = $customer->result()[0] -> name;
                //print_r($customer -> result()[0]); die;
            $query[$key]['phone'] = $customer->result()[0] -> phone;
            $query[$key]['email'] = $customer->result()[0] -> email;
            $query[$key]['download'] = base_url().'edurama_pos/mobile/printinvoice?id='.$query[$key]['id'].'&d=1';
        } else {
            $query[$key]['customer'] = '';
        }


    }

    $data['status'] = 200;
    $data['data'] = $query;

       //print_r($query);
    echo json_encode($data);die;
}

function requestBook() {
    $data['book_id']            = $this->input->post('book_id');
    $data['user_id']            = $this->input->post('user_id');

    if ($this->input->post('user_type') == 'student') {
        $data['role_id']            = 4;
    } else if ($this->input->post('user_type') == 'teacher') {
        $data['role_id']            = 5;
    }

    $data['issue_start_date']   = strtotime($this->input->post('issue_start_date'));
    $data['issue_end_date']     = strtotime($this->input->post('issue_end_date'));

    $query = $this->db->insert('book_request', $data);

    if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
    }

    echo json_encode($data);
}

function requestForLeave() {
    $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    $gen_code          = $this->genrate_uniqid('lve_');

    if ($this->input->post('user_type') == 'parent') {
        $data['id_no']     = $this->input->post('student_code');
        $data['request_by']= $this->input->post('user_id');
        $data['uniqid']    = $gen_code;
        $data['role_id']   = 8;
        $data['type']      = $this->input->post('leave_type');
            //echo $this->input->post('role_id'); die;
        $data['from_date'] = $this->input->post('from_leave_date');
        $data['to_date']   = $this->input->post('to_leave_date');
        $data['reason']    = $this->input->post('reason');
        $data['leave_date']= $this->input->post('leave_date');
        $data['year']      = $running_year;
    } else if ($this->input->post('user_type') == 'student') {
        $data['id_no']     = $this->input->post('student_code');
        $data['request_by']= $this->input->post('user_id');
        $data['uniqid']    = $gen_code;
        $data['role_id']   = 4;
        $data['type']      = $this->input->post('leave_type');
            //echo $this->input->post('role_id'); die;
        $data['from_date'] = $this->input->post('from_leave_date');
        $data['to_date']   = $this->input->post('to_leave_date');
        $data['reason']    = $this->input->post('reason');
        $data['leave_date']= $this->input->post('leave_date');
        $data['year']      = $running_year;
    }
            //print_r($data);
    if($data['id_no'] != "" && $data['type'] != ""){
     $this->db->insert('leave_request',$data);
     $resp['status'] = 200;
     $resp['message'] = 'success';
 } else {
     $resp['status'] = 400;
     $resp['message'] = 'failed';
 }

 echo json_encode($resp);
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



function getStudentAssignmentsWithStatus() {
    $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $student_id = $this->input->post('student_id');

    $this->db->select('A.*, C.name AS class_name, S.name AS subject');
    $this->db->from('assignments AS A');
    $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
    $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
    $this->db->where('A.year', $running_year);
    if($class_id){
        $this->db->where('A.class_id', $class_id);
    }

    if ($section_id) {
        $this->db->where('A.section_id', $section_id);
    }

    $assignments = $this->db->get()->result_array();
    $this->db->select('A.*, C.name AS class_name, S.name AS subject');
    $this->db->from('assignments_individual AS A');
    $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
    $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
    $this->db->where('A.year', $running_year);
    if($class_id){
        $this->db->where('A.class_id', $class_id);
    }

    if ($section_id) {
        $this->db->where('A.section_id', $section_id);
    }
    if ($student_id) {
        $this->db->where('A.student_id', $student_id);
    }

    $assignment_individual = $this->db->get()->result_array();
    $assignments = array_merge($assignments,$assignment_individual);
    foreach ($assignments as $key => $value) {
        $query = $this->db->get_where('submit_assignment', array('student_id' => $student_id, 'assignment_id' => $value['id']));
        if ($query->num_rows() > 0) {
            $assignments[$key]['is_submitted'] = true;
        } else {
            $assignments[$key]['is_submitted'] = false;
        }

        $assignments[$key]['assignment'] = base_url().'assets/uploads/assignment/'.$assignments[$key]['assignment'];
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['assignments'] = $assignments;

    echo json_encode($data);
}

function uploadAssignment() {
    $prev_assignment = $this->input->post('prev_assignment');
    $assignment = $_FILES['assignment']['name'];
    $assignment_type = $_FILES['assignment']['type'];

        //echo json_encode($_FILES);
    $return_assignment = '';

    if ($assignment != "") {
        if ($assignment_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
            $assignment_type == 'application/msword' || $assignment_type == 'text/plain' ||
            $assignment_type == 'application/vnd.ms-office' || $assignment_type == 'application/pdf' || $assignment_type == 'image/jpeg' || $assignment_type == 'image/png' || $assignment_type == 'image/jpg' || $assignment_type == 'image/gif') {

            $destination = 'assets/uploads/assignment_upload/';

        $assignment_type = explode(".", $assignment);
        $extension = strtolower($assignment_type[count($assignment_type) - 1]);
        $assignment_path = 'assignment-' . time() . '-sms.' . $extension;

        move_uploaded_file($_FILES['assignment']['tmp_name'], $destination . $assignment_path);

                // need to unlink previous assignment
        if ($prev_assignment != "") {
            if (file_exists($destination . $prev_assignment)) {
                @unlink($destination . $prev_assignment);
            }
        }

        $return_assignment = $assignment_path;

        $data = array(
            'assignment_id' => $this->input->post('assignment_id'),
            'class_id' => $this->input->post('class_id'),
            'student_id' => $this->input->post('student_id'),
            'created_at' => date('y-m-d h:i:s'),
            'assignment_file' => $assignment_path,
            'status' => 1

        );
        $query = $this->db->insert('submit_assignment', $data);

        if ($query) {
            $data1['status'] = 200;
            $data1['message'] = 'success';
        } else {
            $data1['status'] = 400;
            $data1['message'] = 'failure';
        }

        echo json_encode($data1); die;
    }
} else {
    $return_assignment = $prev_assignment;
    $data1['status'] = 200;
    $data1['message'] = 'success';
    echo json_encode($data1); die;
}
}

function getClassRoutine() {
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $template_id = $this->db->get_where('class_routine_template',array('class_id'=>$class_id,'section_id'=>$section_id,'status'=>1))->row()->id;
    //print_r($template_id);
    $routine = $this->crud_model->get_class_timetable_routine($class_id,$section_id,$template_id);

    $horizontal = "";
    $last = 1;

    if($routine > 0){
        $j=0;
        $d = array();
        foreach ($routine as $key => $dt_v) {

         $horizontal = $dt_v['horizontal'];

         $data = array();
         for($i=0;$i<6;$i++){
           if(@$horizontal[$i]->day == 'monday'){
            $monday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $monday -> time_start = date('H:i', $monday -> time_start);
            $monday -> time_end = date('H:i', $monday -> time_end);
            $data['monday'] = $monday;
        }elseif(@$horizontal[$i]->day == 'tuesday'){
            $tuesday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $tuesday -> time_start = date('H:i', $tuesday -> time_start);
            $tuesday -> time_end = date('H:i', $tuesday -> time_end);
            $data['tuesday'] = $tuesday;
        }elseif(@$horizontal[$i]->day == 'wednesday'){
            $wednesday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $wednesday -> time_start = date('H:i', $wednesday -> time_start);
            $wednesday -> time_end = date('H:i', $wednesday -> time_end);
            $data['wednesday'] = $wednesday;
        }elseif(@$horizontal[$i]->day == 'thursday'){
            $thursday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $thursday -> time_start = date('H:i', $thursday -> time_start);
            $thursday -> time_end = date('H:i', $thursday -> time_end);
            $data['thursday'] = $thursday;
        }elseif(@$horizontal[$i]->day == 'friday'){
            $friday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $friday -> time_start = date('H:i', $friday -> time_start);
            $friday -> time_end = date('H:i', $friday -> time_end);
            $data['friday'] = $friday;
        }elseif(@$horizontal[$i]->day == 'saturday'){
            $saturday = $this->calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id);
            $saturday -> time_start = date('H:i', $saturday -> time_start);
            $saturday -> time_end = date('H:i', $saturday -> time_end);
            $data['saturday'] = $saturday;
        }else{
            $data[$i]['day'] =  "";
        }

    }
    $d[$j] = json_decode(json_encode($data, true));

    $j++;

}
$data1['status'] = 200;
$data1['message'] = 'success';
$data1['routine'] = $d;

echo json_encode($data1);

}
}

function calculateTimeTableForEvents($horizontal, $i, $section_id, $class_id) {
    $date  = date("Y-m-d");
    $temp_date = "";
    $ThatTime  = "12:38:40";
    $day       = $horizontal[$i]->day;
    $period    = $horizontal[$i]->period;
    // if (time() <= strtotime($ThatTime)) {
    //     $temp_date = $this->crud_model->class_timetable_by_date($horizontal[$i]->period,$horizontal[$i]->day,$date,$class_id,$section_id);
    // }else{
    $stop_date = $date;
    $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
    $temp_date = $this->crud_model->class_timetable_by_date($horizontal[$i]->period,$horizontal[$i]->day,$stop_date,$class_id,$section_id);

    //}
    if($temp_date != ""){
        return $temp_date;
    }else{
        return $horizontal[$i];
    }
}


function getMessageSenders() {
    $current_user = $this->input->post('user_type') . '-' . $this->input->post('user_id');

    $this->db->where('sender', $current_user);
    $this->db->or_where('reciever', $current_user);
    $message_threads = $this->db->get('message_thread')->result_array();
    $data = array();
            //print_r($message_threads); die;
    foreach ($message_threads as $row) {

        $datum['message_thread_code'] = $row['message_thread_code'];

                // defining the user to show
        if ($row['sender'] == $current_user) {
            $user_to_show = explode('-', $row['reciever']);
            $datum['is_sender'] = true;
                    //$datum['user_to_show'] = $user_to_show;
        }
        if ($row['reciever'] == $current_user) {
            $user_to_show = explode('-', $row['sender']);
            $datum['is_sender'] = false;
                    //$datum['user_to_show'] = $user_to_show;
        }

        $datum['user_to_show_type'] = $user_to_show[0];
        $datum['user_to_show_id'] = $user_to_show[1];
        $datum['user_name'] = $this->db->get_where($datum['user_to_show_type'], array($datum['user_to_show_type'] . '_id' => $datum['user_to_show_id']))->row()->name;

        if (file_exists('uploads/' . $datum['user_to_show_type'] . '_image/' . $datum['user_to_show_id'] . '.jpg'))
            $datum['image_url'] = base_url() . 'uploads/' . $datum['user_to_show_type'] . '_image/' . $datum['user_to_show_id'] . '.jpg';
        else
            $datum['image_url'] = base_url() . 'uploads/user.jpg';

               // $datum['unread_message_number'] = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);

        array_push($data, $datum);
    }

    $response['status'] = 200;
    $response['message'] = 'success';
    $response['data'] = $data;

    echo json_encode($response);
}


function getMessageGroupsForAdmin() {
    $group_messages = $this->db->get('group_message_thread')->result_array();
    $groups = array();
    foreach ($group_messages as $key => $row) {
        if (isset($current_message_thread_code) && $current_message_thread_code == $row['group_message_thread_code']) {
            $group_messages[$key]['is_active'] = true;
        } else {
            $group_messages[$key]['is_active'] = false;
        }
        $group_messages[$key]['members'] = json_decode($group_messages[$key]['members']);

        if (in_array($this->input->post('user_type').'_'.$this->input->post('user_id'), $group_messages[$key]['members'])) {
            array_push($groups, $group_messages[$key]);
        }
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data'] = $groups;

    echo json_encode($data);
}

function readMessages() {
    $current_message_thread_code = $this->input->post('message_thread_code');
    $username=$this->input->post('current_user_type');
    $userid=$this->input->post('current_user_id');
    $current_user = $username . '-' . $userid;
    $sender_user = $this->input->post('user_type') . '-' . $this->input->post('user_id');

    $this->db->select('E.*');
    $this->db->from('message AS E');
    $this->db->where('E.message_thread_code', $current_message_thread_code);
    $this->db->where("( E.sender = '".$sender_user."' AND E.reciever = '".$current_user ."') OR ( E.sender = '".$current_user."' AND E.reciever = '".$sender_user ."')");
    $this->db->order_by('E.timestamp', 'DESC');
    $messages    = $this->db->get()->result_array();

    foreach ($messages as $key => $row) {
        $sender = explode('-', $row['sender']);
        $sender_account_type = $sender[0];
        $sender_id = $sender[1];
        $messages[$key]['image'] = $this->crud_model->get_image_url($sender_account_type, $sender_id);

        $messages[$key]['name'] = $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name;
        $messages[$key]['time'] = date("d M, Y H:s", $row['timestamp']);
    }

    //Updating status
    $this->db->where('message_thread_code', $current_message_thread_code);
    $this->db->where('sender', $sender_user);
    $this->db->where('reciever', $current_user);
    $this->db->update('message', array('read_status' => 1));

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data'] = $messages;

    echo json_encode($data);
}

function readGroupMessage() {
    $current_message_thread_code = $this->input->post('message_thread_code');
    $data['group_name'] = $this->db->get_where('group_message_thread', array('group_message_thread_code' => $current_message_thread_code))->row()->group_name;
    $messages = $this->db->get_where('group_message', array('group_message_thread_code' => $current_message_thread_code))->result_array();

    foreach ($messages as $key => $row) {
        $sender = explode('-', $row['sender']);
        $sender_account_type = $sender[0];
        $sender_id = $sender[1];

        $origMessage = $messages[$key]['message'];
        $messages[$key]['message'] = base64_decode($messages[$key]['message'], true);
        if ($messages[$key]['message'] == false) {
            $messages[$key]['message'] = $origMessage;
        }

        $messages[$key]['image'] = $this->crud_model->get_image_url($sender_account_type, $sender_id);
        $messages[$key]['name'] = $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name;
        $messages[$key]['time'] = date("d M, Y", $row['timestamp']);
        $messages[$key]['attached_file_name'] = @base_url('uploads/group_messaging_attached_file/'.$row['attached_file_name']);
    }

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['data'] = $messages;

    echo json_encode($data);
}

function send_reply_message() {
    $message    = $this->input->post('message');
    $reciever    = $this->input->post('reciever');
    $timestamp  = strtotime(date("Y-m-d H:i:s"));
    $message_thread_code = $this->input->post('message_thread_code');
    $sender     = $this->input->post('user_type') . '-' . $this->input->post('user_id');
        //check if file is attached or not
    if ($_FILES['attached_file_on_messaging']['name'] != "") {
      $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
  }
  $data_message['message_thread_code']    = $message_thread_code;
  $data_message['message']                = $message;
  $data_message['sender']                 = $sender;
  $data_message['reciever']               = $reciever;
  $data_message['timestamp']              = $timestamp;
  $query = $this->db->insert('message', $data_message);

  $token = @$this->db->get_where($this->input->post('receiver_type'), array($this->input->post('receiver_type').'_id' => $this->input->post('receiver_id')))->row()->fcm_token;
  $receiverName = @$this->db->get_where($this->input->post('receiver_type'), array($this->input->post('receiver_type').'_id' => $this->input->post('receiver_id')))->row()->name;
  if ($token) {
    $this->sendMessageNotification($token, $receiverName, $message);
}


if ($query) {
    $response['status'] = 200;
    $response['message'] = "Message Sent Successfully";
} else {
    $response['status'] = 400;
    $response['message'] = "There was some problem sending the reply";
}
echo json_encode($response);
}

function send_reply_group_message() {
    $message    = $this->input->post('message');
    $timestamp  = strtotime(date("Y-m-d H:i:s"));
    $sender     = $this->input->post('user_type') . '-' . $this->input->post('user_id');
    $message_thread_code = $this->input->post('message_thread_code');
        //check if file is attached or not
    if ($_FILES['attached_file_on_messaging']['name'] != "") {
      $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
  }
  $data_message['group_message_thread_code']    = $message_thread_code;
  $data_message['message']                = base64_encode($message);
  $data_message['sender']                 = $sender;
  $data_message['timestamp']              = $timestamp;
  $query = $this->db->insert('group_message', $data_message);
  if ($query) {
    $response['status'] = 200;
    $response['message'] = "Message Sent Successfully";
} else {
    $response['status'] = 400;
    $response['message'] = "There was some problem sending the reply";
}
echo json_encode($response);
}

function send_new_private_message() {
    $message    = $this->input->post('message');
    $timestamp  = strtotime(date("Y-m-d H:i:s"));

    $reciever   = $this->input->post('reciever');
    $sender     = $this->input->post('user_type') . '-' . $this->input->post('user_id');

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
$query = $this->db->insert('message', $data_message);

        //if ($this->input->post('receiver_type') == 'parent') {

$token = @$this->db->get_where($this->input->post('receiver_type'), array($this->input->post('receiver_type').'_id' => $this->input->post('receiver_id')))->row()->fcm_token;
$receiverName = @$this->db->get_where($this->input->post('receiver_type'), array($this->input->post('receiver_type').'_id' => $this->input->post('receiver_id')))->row()->name;
if ($token) {
    $this->sendMessageNotification($token, $receiverName, $message);
}
        //}

        // notify email to email reciever
//        $this->email_model->notify_email('new_message_notification', $this->db->insert_id());
if ($query) {
    $response['status'] = 200;
    $response['message'] = 'success';
    $response['message_thread_code'] = $message_thread_code;
} else {
    $response['status'] = 400;
    $response['message'] = 'failed';
}

echo json_encode($response);
}

function create_group(){
  $data = array();
  $data['group_message_thread_code'] = substr(md5(strtotime(date("Y-m-d H:i:s"))), 0, 15);
  $data['created_timestamp'] = strtotime(date("Y-m-d H:i:s"));
  $data['group_name'] = $this->input->post('group_name');
  $data['members'] = $this->input->post('members');
  $query = $this->db->insert('group_message_thread', $data);
  if ($query) {
    $response['status'] = 200;
    $response['message'] = 'success';
} else {
    $response['status'] = 400;
    $response['message'] = 'failure';
}

echo json_encode($response);
}

function sendMessageNotification($token, $sender, $message) {
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    /*$token='drc-CzKcw5c:APA91bHNOl2s8DgediilC7Q-Dm5iVdTOv3Z4jNk6zCZeGTx3iv57DG0cJWJ5NrMhDQkcolKi7SZQnE61lcnOLeYmm2AG7jF_8qLDrixwYMD7VIUMvVRnYc_omjBEvmzlLsIWFrtpg3ro';*/

    $notification = [
        'title' =>'You have a new text message',
        'body' => $sender . ' sent you a new text message : ' .$message,
        'icon' =>'myIcon',
        'sound' => 'mySound'
    ];
    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . "AAAA6UOPwdY:APA91bFKYv-9DbxzVsE7JdnbRdbIdbq-bETaYIAtrnWkHYRZNmHiGNGSsXlRlAm3C0j04bwGYeXI-pKhfOZ8Xeg8-3UnlolqSvR7taIR4QP7jvXLqS8Yb-i5x8huhX35MTl5GChbZw56",
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    function logout(){
        @$this->db->where($this->input->post('user_type').'_id', $this->input->post('user_id'));
        $query = @$this->db->update($this->input->post('user_type'), array('fcm_token'=>''));
        if($query){
            $data['status'] = 200;
            $data['message'] = 'success';
        }

        else{
            $data['status'] = 400;
            $data['message'] = 'failure';
        }

        echo json_encode($data);
    }

    function updateBookRequestStatus() {
        $newStatus = $this->input->post('new_status');
        $requestId = $this->input->post('request_id');

        $this->db->where('book_request_id', $requestId);
        $query = $this->db->update('book_request', array('status' => $newStatus));

        if($query){
            $data['status'] = 200;
            $data['message'] = 'success';
        }

        else{
            $data['status'] = 400;
            $data['message'] = 'failure';
        }

        echo json_encode($data);
    }

    function getStudentStopPoints() {
        $user_id = $this->input->post('user_id');
        $locationName = $this->db->get('student');
    }

    function markAttendance() {
        
        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $class_id   = $this->input->post('class_id');
        $year      = $this->input->post('year');
        //strtotime("-45 minutes", strtotime($thestime))
        // $timestamp  = strtotime("-30 minutes", strtotime($this->input->post('timestamp')));
        $timestamp  = strtotime($this->input->post('timestamp')); //dd-mm-yyyy
        $section_id = $this->input->post('section_id');
        $studentId      = $this->input->post('student_id');
        $status      = $this->input->post('status');
        $id = $this->input->post('attendance_id');
        $query = $this->db->get_where('attendance' ,array(
                   'timestamp' => $timestamp,
                   'student_id' => $studentId
                ));
            if($query->num_rows() < 1){
                    $attn_data['class_id']   = $class_id;
                    $attn_data['year']       = $running_year;
                    $attn_data['timestamp']  = $timestamp;
                    $attn_data['section_id'] = $section_id;
                    $attn_data['student_id'] = $studentId;
                    $attn_data['status'] = $status;
                    $query = $this->db->insert('attendance' , $attn_data);
                    $data['inserting'] = true;
            }else {
                    $this->db->where('student_id', $studentId)->where('timestamp', $timestamp);
                    $query = $this->db->update('attendance', array('status' => $status));
                    $data['inserting'] = false;
            }

        if ($query) {
            $data['status'] = 200;
            $data['message'] = 'success';
        } else {
            $data['status'] = 400;
            $data['message'] = 'failure';
        }
        echo json_encode($data);
    }

    function getStudentLatLng() {
        $transport_stop = $this->db->get_where('student', array('student_id' => $this->input->post('user_id')))->row()->transport_stop;
        $route_id = $this->db->get_where('route_stops', array('id' => $transport_stop))->row()->route_id;
        $stop_name = $this->db->get_where('route_stops', array('id' => $transport_stop))->row()->stop_name;

        //print_r($stop_name); die;

        $stop_details = $this->db->get_where('routes', array('id' => $route_id))->row()->stop_details;
        $stop_details = json_decode($stop_details);
        //print_r($stop_details); die();
        foreach ($stop_details as $key => $obj) {
            $jsonData = json_decode($obj);
            if ($jsonData -> address == $stop_name) {
                $data['json_position'] = $key;
                $data['lat'] = $jsonData -> lat;
                $data['lng'] = $jsonData -> lng;
            }
        }

        echo json_encode($data);
    }

    function getStudentDashboardData() {
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $this->db->where('year', $running_year);
        $this->db->from('enroll');
        $response['total_student']       = $this->db->count_all_results();
        $total_student_ = $response['total_student'];
        // student present today
        $check                           = array(
            'timestamp' => strtotime(date('d-m-Y')),
            'status' => '1'
        );
        $query                           = $this->db->get_where('attendance', $check);
        $present_today                   = $query->num_rows();
        $response['total_present_today'] = $present_today;

        //______________________________________//
        $classes = $this->db->get('class')->result_array();
        $noOfStudents = array();
        foreach ($classes as $key => $value) {
            $data['class_name'] = $value['name'];
            $data['no_of_students'] = $this->db->get_where('enroll', array('class_id' => $value['class_id'], 'year' => $running_year)) -> num_rows();
            array_push($noOfStudents, $data);
        }
        $response['graph_data'] = $noOfStudents;


        $this->db->select('*');
        $this->db->from('attendance A');
           $this->db->where('MONTH(defult_date)', date('m')); //For current month
           $this->db->where('YEAR(defult_date)', date('Y'));
           $this->db->where("A.status = '1' AND A.bus_status = '1' AND A.gate_status = '1'");
           $monthly_parsent = $this->db->get()->result();
           $montly_parsent_val = count($monthly_parsent);
           $monthlyparsent = 0;$monthlyparsent_ = "";
           if(!empty($total_student_) && !empty($montly_parsent_val)) {
             $monthlyparsent    = (($montly_parsent_val * 100)/ $total_student_);
             $response['monthly_present'] = round($monthlyparsent,2).'%';
         } else {
            $response['monthly_present'] = '0%';
        }

        $total_student_ = $this->db->get_where('enroll',array('year'=>$running_year))->result();

        $bal_total = 0;

        foreach ($total_student_ as $key => $amount_sum) {
         $balance_val = $this->db->get_where('student',array('student_id'=>$amount_sum->student_id))->row()->balance;
         $bal_total  = $bal_total + $balance_val;
     }
     $total_student_ = count($total_student_);
     $balance_total  = 0;$avrg_amount = 0;

     if(!empty($bal_total) && !empty($total_student_)) {
         $avrg_amount    = (($bal_total)/ $total_student_);
         $response['avrg_amount'] = round($avrg_amount,2).'';
     } else {
        $response['avrg_amount'] = '0';
    }

    $total_house  = $this->db->get('house_info')->result();
    $response['total_house'] = count($total_house).'';



    echo json_encode($response);
}

function getUpcomingEvents() {
        //$current_date = strtotime(date('y-m-d'));
   $this->db->select('*');
   $this->db->from('events');
   $this->db->where('event_from >=', date('y-m-d'));
   $events = $this->db->get()->result_array();

   foreach ($events as $key => $value) {
    $this->db->select('image');
    $this->db->from('event_images');
    $this->db->where('event_id', $value['id']);
    $imageRaw = $this->db->get()->result_array();

    $images = array();
    foreach ($imageRaw as $key2 => $value) {
        array_push($images, base_url().'assets/uploads/event/'.$imageRaw[$key2]['image']);
    }
           // $events[$key]['image'] = base_url().'assets/uploads/event/'.$events[$key]['image'];
    $events[$key]['images'] = $images;
}

$data['status'] = 200;
$data['message'] = 'success';
$data['events'] = $events;
echo json_encode($data);
}

function getStudentOwnDashboardData() {
    $query = $this->db->get_where('student' , array('student_id' => $this->input->post('user_id')))->result_array();

    foreach ($query as $key => $row) {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $query[$key]['class_id'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'])) -> row() -> class_id;
        $query[$key]['section_id'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'])) -> row() -> section_id;

        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->where('timestamp >=', strtotime("-1 month"));
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('status', '1');
        $query[$key]['present_count_month'] = $this->db->get()->num_rows();

        $this->db->select('*');
        $this->db->from('attendance');
        $this->db->where('timestamp >=', strtotime("-1 month"));
        $this->db->where('student_id', $row['student_id']);
        $this->db->where('status !=', '1');
        $query[$key]['absent_count_month'] = $this->db->get()->num_rows();

        $query[$key]['photo'] = $this->crud_model->get_image_url('student', $row['student_id']);
        $query[$key]['class_name'] =  $this->db->get_where('class', array('class_id' => $query[$key]['class_id'])) -> row() -> name;
        $query[$key]['section_name'] =  $this->db->get_where('section', array('section_id' => $query[$key]['section_id'])) -> row() -> name;

        if ($query[$key]['is_hostel_member'] == '1' ) {
            $query[$key]['hostel_name'] = $this->db->get_where('hostels', array('id' => $row['hostel_id'])) -> row() -> name;
        } else {
            $query[$key]['hostel_name'] = '';
        }

        //Getting Average Marks
        $exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
        $examData = array();
        foreach ($exams as $key2 => $exam) {
            $student_marks = $this->db->get_where('mark', array('exam_id' => $exam['exam_id'],'student_id' => $row['student_id'], 'year' => $running_year))->result_array();
            $totalMarks = 0;
            $totalHighestMarks = 0;
            foreach ($student_marks as $row2) {
                $totalMarks = $totalMarks + $row2['mark_obtained'];
                /*$totalHighestMarks = $totalHighestMarks + $this->crud_model->get_highest_marks_mobile($row2['exam_id'] , $row2['class_id'] , $row2['subject_id'] );*/
                $totalHighestMarks = $totalHighestMarks + $row2['mark_total'];
            }

            $markcal['total'] = $totalMarks;
            $markcal['highest'] = $totalHighestMarks;
            $markcal['name'] = $exam['name'];

            if ($totalMarks == 0 || $totalHighestMarks == 0) {
                $markcal['percent'] = '0';
            } else {
                $markcal['percent'] = ($totalMarks/$totalHighestMarks) * 100;
            }
            array_push($examData, $markcal);
        }

        $query[$key]['exam_data'] = $examData;

        //GETTING ONBOARD STATUS
        $timestamp = $this->db->query("select max(timestamp) as max_timestamp from attendance where student_id = ".$row['student_id']." AND bus_status = 1 limit 1")->row()->max_timestamp;
        if ($row['is_transport_member']) {
            $query[$key]['last_boarded_at'] = date('h:i:s', $timestamp);
            $query[$key]['last_boarded_on'] = date('d-M-Y', $timestamp);
        } else {
            $query[$key]['last_boarded_at'] = "N/A";
            $query[$key]['last_boarded_on'] = "N/A";
        }

                        //VEHICLE STATUS
        if ($row['is_transport_member']) {
                            $vehicle_assigned_to_route = $this->db->get_where('routes', array('id' => $row['transport_id']))->row()->vehicle_ids; // 2 for 8
                            $driver_assigned_to_vehicle = $this->db->get_where('vehicles', array('id' => $vehicle_assigned_to_route)) -> row() -> driver;
                            $is_driver_on_route_active = $this->db->get_where('vehicle_location', array('driver_id' => $driver_assigned_to_vehicle)) -> row() -> on_duty;
                            if ($is_driver_on_route_active) {
                                $query[$key]['is_driver_on_route_active'] = $is_driver_on_route_active;
                            } else {
                                $query[$key]['is_driver_on_route_active'] = '0';
                            }
                        } else {
                            $query[$key]['is_driver_on_route_active'] = '0';
                        }

                        //VEHICLE DETAILS
                        if ($row['is_transport_member']) {
                        //$vehicleAssigned = @$this->db->get_where('routes', array('id' => $this->input->post('transport_id'))) -> row() -> vehicle_ids;
                            $vehicles = $this->db->get_where('vehicles' , array('id' => $vehicle_assigned_to_route))->result_array();
                            foreach ($vehicles as $key => $value) {
                                $vehicles[$key]['route']       = $this->route->get_single('routes', array('vehicle_ids' => $value['id']));


                                $md = json_decode($vehicles[$key]['route'] -> stop_details);
                                $ms = array();

            //print_r($md);
                                for($i = 0; $i < sizeof($md); $i++) {
                                    $ms[$i] = json_decode($md[$i]);

                                    $ms[$i] -> lat = $ms[$i] -> lat .'';
                                    $ms[$i] -> lng = $ms[$i] -> lng .'';
                                    $ms[$i] -> distance = $ms[$i] -> distance .'';
                                }
           // $md = json_decode($md[0]);


                                $vehicles[$key]['route'] -> stop_details = $ms;

                                $vehicles[$key]['route_stops'] = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key]['route'] -> id), '','', '','','id','ASC');

                            }

                            $query[$key]['vehicles'] = $vehicles;
                        } else {
                            $query[$key]['vehicles'] = array();
                        }

                        //Getting last 5 transactions
                        $this->db->select('*');
                        $this->db->from('payment');
                        $this->db->where('student_id', $row['student_id']);
                        $this->db->limit(5);
                        $this->db->order_by('timestamp', 'DESC');

                        $query[$key]['payments'] = $this->db->get()->result_array();

                        //GETTING PERIOD ATTENDANCE
                        $today = date("Y-m-d");

                        $todays=  strtotime($today);
                        //echo $todays; die;
                        $days= date('l', strtotime($today));

                        $time = date("H:i",time());
                        $endTime = date("H:i",time() + 3600);

                        $class_id = $query[$key]['class_id'];
                        $section_id = $query[$key]['section_id'];
                        /*$class_id = 1;
                        $section_id = 1;
                        $days = "monday";*/

                        $periodtime = $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND   time_start >= '$time' AND time_start <= '$endTime'")->row()->period;
                        if ($periodtime) {
                        	$query[$key]['are_classes_ongoing'] = true;
                        	$query[$key]['current_period'] = $periodtime;
                        	//$isCurrentlyPresent = $this->db->get_where('class_attendance', array('student_id' => $row['student_id'], ));
                        	$this->db->select('*');
                        	$this->db->from('class_attendance');
                        	$this->db->where('student_id', $row['student_id']);
                        	$this->db->where('time >=',  $time);
                        	$this->db->where('time <=',  $endTime);
                        	$this->db->where('date',  $todays);
                        	if ($this->db->get()->num_rows() > 0) {
                        		$query[$key]['is_present'] = true;
                        	} else {
                        		$query[$key]['is_present'] = false;
                        	}
                        } else {
                        	$query[$key]['are_classes_ongoing'] = false;
                        }
                    }

                    $data['status'] = 200;
                    $data['students'] = $query;
                    echo json_encode($data);
                }

                function getAdminOwnDashboardData() {
                    $today = strtolower(date("l"));
                    $query2    = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year");
                    $result2   = $query2->result_array();

                    $query3    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='male' GROUP BY year");
                    $result3   = $query3->result_array();

                    $query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' GROUP BY year");
                    $result4   = $query4->result_array();
                    $students_num=array();
                    $students_session=array();
                    foreach ($result2 as $row2) {
                      array_push($students_num,$row2['student_id']);
                      array_push($students_session,$row2['year']);
                  }
                  $students_num1=array();
                  foreach ($result3 as $row2) {
                      array_push($students_num1,$row2['student_id']);
                  }
                  $students_num2=array();
                  foreach ($result4 as $row2) {
                      array_push($students_num2,$row2['student_id']);
                  }

                  $admissions['total'] = $students_num;
                  $admissions['years'] = $students_session;
                  $admissions['male'] = $students_num1;
                  $admissions['female'] = $students_num2;
                  $data['admissions'] = $admissions;

                  $timenow = date('d-m-Y');
                  $timestamp = strtotime($timenow);

                  $this->db->select('*');
                  $this->db->from('attendance');
                $this->db->where('timestamp', $timestamp); //For current month
                $this->db->where("status = '1' ");
                $monthly_parsent = $this->db->get()->result();
                $data['today_present_students'] = count($monthly_parsent);

                $this->db->select('*');
                $this->db->from('emp_attendance');
                $this->db->where('timestamp', $timestamp); //For current month
                $this->db->where("status = '1' ");
                $monthly_parsent = $this->db->get()->result();
                $data['daily_parsent_teacher'] = count($monthly_parsent);      

                $timenow1 = date('G:i');
                $timestamp1 = strtotime($timenow1);
                $template_val = $this->db->query("select * from class_routine_template where status=1 LIMIT 1"  )->result();
                $data['is_closed'] = true;
              //  print_r($template_val);
                foreach($template_val as $dtt){
                   $template_id = $dtt->id;
                   $total = $dtt->numberofperiod;
                   $current_period = $this->db->query("select * from class_routine where template_id='$template_id'  AND day ='$today' AND time_start>='$timenow1' LIMIT 1")->result();
          // echo '<pre>';
          // print_r($current_period);
            //echo '<pre>';
            
                   foreach ($current_period  as $key => $ass_mark) {
                     $time_start=$ass_mark->time_start;
                     $class_period = $ass_mark->period;
                     $date = date('d-m-Y', $time_start);
                     $time = date('G:i:s', $time_start);
                   /*  if( $timenow1 >=$time ){
                        $data['is_closed'] = false;
                        if($ass_mark->time_start == ""){
                            $data['class_period'] = $ass_mark->period;
                        }

                    } */
                    
                    
                    
                     if( $class_period !='' ){
                     
                            $data['class_period'] = $ass_mark->period + 0;
                            $data['is_closed'] = false;
                      }
                    else {
                      $data['is_closed'] = true;
                  }
              }
          }
          $data['total_classes'] = $total + 0;


          echo json_encode($data);
      }

      function getHostelDashboardData() {
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $query2    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.is_hostel_member=1 GROUP BY year");
        $result2   = $query2->result_array();

        $query3    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='male'  AND student.is_hostel_member=1 GROUP BY year");
        $result3   = $query3->result_array();

        $query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' AND student.is_hostel_member=1 GROUP BY year");
        $result4   = $query4->result_array();
        $students_num=array();
        $students_session=array();
        foreach ($result2 as $row2) {
          array_push($students_num,$row2['student_id']);
          array_push($students_session,$row2['year']);
      }
      $students_num1=array();
      foreach ($result3 as $row2) {
          array_push($students_num1,$row2['student_id']);
      }
      $students_num2=array();
      foreach ($result4 as $row2) {
          array_push($students_num2,$row2['student_id']);
      }

      $occupacy['total_students'] = $students_num;
      $occupacy['years'] = $students_session;
      $occupacy['male'] = $students_num1;
      $occupacy['female'] = $students_num2;

      $response['occupacy'] = $occupacy;

      $response['number_of_total_hostel'] = $this->db->get_where('hostels',array('status' =>1))->num_rows().'';
      $response['total_no_of_student'] = $this->db->get_where('student',array('status' =>1))->num_rows().'';
      $response['number_of_total_member_in_hostel'] = $this->db->get_where('hostel_members')->num_rows().'';
      $response['room_change_member_no'] = $this->db->get_where('room_change_request',array('year' => $running_year,'room_status'=>'pending'))->num_rows().'';
      $response['total_hostel_room_capacity'] = $this->db->get_where('rooms',array('total_seat' =>1))->num_rows().'';

      $this->db->select_sum('total_seat');
      $this->db->from('rooms');
      $query=$this->db->get();
      $response['total_seats']=$query->row()->total_seat.'';

      echo json_encode($response);
  }

  function getHumanResourceDashboardData() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
   // $response['number_of_leave_accepted_current_session'] = $this->db->get_where('leave_request', array('status' =>'accept','year'=>$running_year))->num_rows();
   $response['number_of_leave_accepted_current_session'] = $this->db->get_where('leave_request', array('status' =>'approved','year'=>$running_year))->num_rows();
    $response['number_of_leave_reject_current_session'] = $this->db->get_where('leave_request', array('status' => 'reject','year'=>$running_year))->num_rows();
    $response['number_of_leave_pending_current_session'] = $this->db->get_where('leave_request', array('status' =>'pending','year'=>$running_year))->num_rows();

    $response['number_of_certificate_apply_current_session'] = $this->db->get_where('apply_certificates', array('year'=>$running_year))->num_rows();
    $response['number_of_leave_pending'] = $this->db->get_where('leave_request', array('status' =>'pending','year'=>$running_year))->num_rows();
    $response['total_of_leave_accepted'] = $this->db->get_where('leave_request', array('year'=>$running_year))->num_rows();
    $response['number_of_total_employee'] = $this->db->get_where('designation_users')->num_rows();
    $response['number_of_total_accountant'] = $this->db->get_where('accountant')->num_rows();
    $response['number_of_total_librarian'] = $this->db->get_where('librarian')->num_rows();
    $response['total_emp_list'] = $response['number_of_total_employee'] + $response['number_of_total_accountant'] + $response['number_of_total_librarian'];

    echo json_encode($response);
}

function getAccountingDashboardData() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $this->db->select_sum('net_amount');
    $this->db->from('invoices');
    $this->db->where('invoice_type' ,'fee' );
    $this->db->where('paid_status' , 'paid');
    $this->db->where('year' , $running_year);
    $query=$this->db->get();
    $data['total_recievable']=(string)(float)$query->row()->net_amount;

    $this->db->select_sum('net_amount');
    $this->db->from('invoices');
    $this->db->where('invoice_type' ,'fee' );
    $this->db->where('paid_status' , 'unpaid');
    $this->db->where('year' , $running_year);
    $query=$this->db->get();
    $data['overdue_fee']=(string)(float)$query->row()->net_amount;

    $this->db->select_sum('net_salary');
    $this->db->from('salary_payments');
    $this->db->where('academic_year_id' , $running_year);
    $query=$this->db->get();
    $data['salary']=(string)(float)$query->row()->net_salary;
    
    $this->db->select_sum('amount');
    $this->db->from('expenditures AS E');        
    $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
    $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
    $running_years = explode('-',$running_year);
    $startDate = $running_years[0];
    $endDate = $running_years[1];
    $this->db->where('YEAR(date) >=', $startDate);
    $this->db->where('YEAR(date) <=', $endDate);
    $query=$this->db->get();
    $data['expenses'] = (string)(float)$query->row()->amount;



    $query2    = $this->db->query("SELECT count(*) as net_amount , month from invoices GROUP BY month Limit 5");
    $result2   = $query2->result_array();
    $query3    = $this->db->query("SELECT count(*) as amount , date from expenditures GROUP BY date Limit 5");
    $result3   = $query3->result_array();


    $query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' GROUP BY year");
    $result4   = $query4->result_array();
      //print_r($result2);
    $students_num=array();
    $students_session=array();
    foreach ($result2 as $row2) {
        if ($row2['month']) {
            array_push($students_num,(string)(int)$row2['net_amount']);
            array_push($students_session,$row2['month']);
        }

    }
    $students_num1=array();
      //$students_session1=array();
    foreach ($result3 as $row2) {
        array_push($students_num1,(string)(int)$row2['amount']);

    }
    $students_num2=array();
      //$students_session2=array();
    foreach ($result4 as $row2) {
        array_push($students_num2,$row2['student_id']);

    }


    $chart_data['income'] = $students_num;
    $chart_data['lables'] = $students_session;
    $chart_data['expanse'] = $students_num1;

    $data['chart_data'] = $chart_data;
      //$var_female = $students_num2;

    echo json_encode($data);
}

function getTeacherDashboardData() {
    $month = date('m');
    $year = date('Y');
    $data['present'] = $this->db->get_where('emp_attendance', array('status' => 1,'role_id'=>5,'MONTH(default_time)' =>$month))->num_rows();
    $data['absent'] = $this->db->get_where('emp_attendance', array('status' => 2,'role_id'=>5,'MONTH(default_time)' =>$month))->num_rows();
    $data['total_teachers'] = $this->db->get_where('teacher',array('status' =>1))->num_rows();
    $data['teachers_absent_avg'] = $this->db->get_where('emp_attendance', array('status' => 2,'role_id'=>5,'MONTH(default_time)' =>$month,'YEAR(default_time)' =>$year))->num_rows();
       //$data['late'] = $this->db->get_where('settings' , array('type' => 'school_start_time'))->row();
    $query= $this->db->query("SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(default_time))) AS avg_time FROM emp_attendance where MONTH(default_time) = MONTH(CURDATE()) AND status=1");
    $result  = $query->result_array();
    foreach ($result as $row) {
      $avg_teacher_time=$row['avg_time'];
      $data['avg_entry_time'] =  date("h:i a", strtotime("$avg_teacher_time"));
  }


  echo json_encode($data);
}

function getPreExamDashboardData() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $query2    = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year");
    $result2   = $query2->result_array();

    $query3    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='male' GROUP BY year");
    $result3   = $query3->result_array();

    $query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' GROUP BY year");
    $result4   = $query4->result_array();
    $students_num=array();
    $students_session=array();
    foreach ($result2 as $row2) {
      array_push($students_num,$row2['student_id']);
      array_push($students_session,$row2['year']);
  }
  $students_num1=array();
  foreach ($result3 as $row2) {
      array_push($students_num1,$row2['student_id']);
  }
  $students_num2=array();
  foreach ($result4 as $row2) {
      array_push($students_num2,$row2['student_id']);
  }

  $admissions['total'] = $students_num;
  $admissions['years'] = $students_session;
  $admissions['male'] = $students_num1;
  $admissions['female'] = $students_num2;

  $data['admissions'] = $admissions;

  $data['new_admissions'] = $this->db->get_where('enroll', array('year' => $running_year))->num_rows().'';
  $data['pre_exam_registrations'] = $this->db->get_where('pre_enroll', array('year' => $running_year))->num_rows().'';


  echo json_encode($data);
}

function re_exam(){
      $class_id = $this->input->post('class_id');
      $start_time = $this->input->post('start_time');
      $end_time = $this->input->post('end_time');
      $room_no = $this->input->post('room_no');
      $reschedule_date = $this->input->post('reschedule_date');
      $exam_id = $this->input->post('exam_id');
      $comment= $this->input->post('comment');
      $examMarks = $this->input->post('exam_marks');
       
       
    $data = array(
        'reschedule_exam_for' => 'class',
        'class_id' => $class_id,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'room_no' => $room_no,
        'exam' => $exam_id,
        'reschedule_date' => $reschedule_date,
        'comment' => $comment
    );
     $this->db->where('exam',$exam_id);
      $this->db->where('class_id',$class_id);
      $querys =  $this->db->get("re_exam");
      if($querys->num_rows() > 0){
            $this->db->where('exam',$exam_id);
            $this->db->where('class_id',$class_id);
           $query = $this->db->update('re_exam', $data);
           if($query){
               $this->db->where('id',$exam_id);
               $this->db->update('exam_schedule', [
                    'exam_date' => $reschedule_date, 
                    'start_time' => $start_time, 
                    'end_time' => $end_time,
                    'exam_marks'=> $examMarks,
                    'room_no'=>$room_no
                   ]);
           }
      }else{
         $query = $this->db->insert('re_exam', $data);
      }
     $datas['status'] = 200;
    $datas['message'] = 'success';

    echo json_encode($datas);
}
function cancel_exam(){
      $class_id = $this->input->post('class_id');
    $exam_id = $this->input->post('exam_id');
      $comment= $this->input->post('comment');
       
       
    $data = array(
        'cancel_for' => 'class',
        'class_id' => $class_id,
        'exam' => $exam_id,
        'comment' => $comment,
        'defult_date' => date('Y-m-d h:i:s')
    );

    $query = $this->db->insert('re_exam_cancel', $data);
     if ($this->db->delete('exam_schedule', array('id' => $exam_id))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
    
    echo json_encode($response);
}

function getAllVehicles() {

    $vehicles = $this->vehicle->get_vehicle_list();
    foreach ($vehicles as $key => $value) {
        $vehicles[$key] -> route       = $this->route->get_single('routes', array('vehicle_ids' => $value -> id));
          //  $vehicles[$key] -> route_stops = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$value -> id), '','', '','','id','ASC');

           // print_r( $vehicles[$key]); die;
        $md = @json_decode($vehicles[$key] -> route -> stop_details);
        $ms = array();

            //print_r($md);
        for($i = 0; $i < sizeof($md); $i++) {
            $ms[$i] = json_decode($md[$i]);

            $ms[$i] -> lat = $ms[$i] -> lat .'';
            $ms[$i] -> lng = $ms[$i] -> lng .'';
            $ms[$i] -> distance = $ms[$i] -> distance .'';
        }
           // $md = json_decode($md[0]);


        @$vehicles[$key] -> route -> stop_details = $ms;
        @$vehicles[$key] -> route_stops = $this->route->get_list('route_stops', array('status' => 1,'route_id'=>$vehicles[$key] -> route -> id), '','', '','','id','ASC');

    }

    $data['vehicles'] = $vehicles;
    echo json_encode($data);
}


function updateDriverJourneyDetails() {
    $newVehicleId = $this->input->post('new_vehicle_id');
    $newRouteId = $this->input->post('new_route_id');
    $userId = $this->input->post('user_id');

    $this->db->where('driver', $userId);
    $this->db->update('vehicles', array('driver' => '0'));

    $this->db->where('id', $newVehicleId);
    $this->db->update('vehicles', array('driver' => $userId));



    $this->db->where('vehicle_ids', $newVehicleId);
    $this->db->update('routes', array('vehicle_ids' => '0'));

    $this->db->where('id', $newRouteId);
    $this->db->update('routes', array('vehicle_ids' => $newVehicleId));

    $data['status'] = 200;
    $data['message'] = 'success';

    echo json_encode($data);
}

function getExaminationResultDashboardData() {
    $this->db->select('*');
    $this->db->from('subject S');
      //$this->db->group_by('C.class_id','ASC');
    $subject = $this->db->get()->result();
    foreach($subject as $sub_dt){
       $subject_id = $sub_dt->subject_id;
       $subject_name = $sub_dt->name;
       $max_mark = $this->db->query("select MAX(mark_obtained) as hightmark from mark where subject_id =$subject_id")->row();
       $min_mark = $this->db->query("select MIN(mark_obtained) as min_mark from mark where subject_id =$subject_id")->row();

       $arr_subject[]    = $subject_name;
       $arr_heightmark[] = $max_mark->hightmark;
       $arr_minmark[] = $min_mark->min_mark;

   }

   $data_['labels']   = $arr_subject;
   $data_['highest'] = $arr_heightmark;
   $data_['lowest'] = $arr_minmark;
   /*$data_['datasets'] = array(array('label'=>'Highest Marks','backgroundColor'=>"#3e95cd",'data' => $arr_heightmark),array('label'=>'Lowest Marks','backgroundColor'=>"#8e5ea2",'data' => $arr_minmark));*/
   $data['graph_data'] = $data_;

   echo json_encode($data);
}

function getBookDetailsUsingCode() {
    $book_details = $this->db->get_where('book', array('book_code' => $this->input->post('book_code'))) -> row();
    $book_details -> copies_left = ($book_details -> total_copies - $book_details -> issued_copies).'';
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['book_details'] = $book_details;

    echo json_encode($data);
}

function getStudentDetaisUsingCardCode() {
    $cardCode = $this->input->post('card_code');
    $query = $this->db->get_where('enroll', array('card_code' => $cardCode));
    if ($query->num_rows() > 0) {
        $query = $query -> row();
        $query -> student = $this->db->get_where('student', array('student_id'=>$query -> student_id))->row();
            //$user_profile  = $this->db->get_where('student', array('student_id' => $query -> student_id))->row();
        $query -> image_url = $this->crud_model->get_image_url('student', $query -> student_id);
        $query -> status = 200;
        $query -> message = 'success';
        $query -> class_name =  $this->db->get_where('class', array('class_id' => $query -> class_id)) -> row() -> name;
        $query -> section_name =  $this->db->get_where('section', array('section_id' => $query -> section_id)) -> row() -> name;

        echo json_encode($query);
    } else {
        $data['status'] = 200;
        $data['message'] = 'success';
        echo json_encode($data);
    }
}

function issueBookByRfidCard() {
    $book_rfid   = $this->input->post('book_code');
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
                /*$data['issue_end_date']     = strtotime($this->input->post('issue_start_date'));*/
                $data['issue_end_date']     = strtotime($this->input->post('return_to_date'));
            }
            $query3  = $this->db->query("SELECT book_id, user_id FROM book_request WHERE book_id = $book_id AND status=1 AND user_id=$student_id AND return_status = 0");
            $result3 = $query3->result_array();
            if(sizeof($result3) < 1) {


               $issued = $this->db->get_where('book', array('book_code' => $book_rfid)) -> row() -> issued_copies;
             //print_r($issued); die;
               $this->db->where('book_code', $book_rfid);
               $this->db->update('book', array('issued_copies' => ($issued + 1)));

               $this->db->insert('book_request', $data);
               $data['status'] = 200;
               $data['message'] = 'Successfully issued';

           } else {
             $data['status'] = 406;
             $data['message'] = 'You are not eligible for this book';
         }
     }
 }
}

echo json_encode($data);

}

function getDateSheet() {
    $exam_id = $this->input->post('exam_id');
    $class_id = $this->input->post('class_id');

    $this->db->select('*');
    $this->db->from('exam_schedule');
    $this->db->where('exam_id',$exam_id);
    $this->db->where('class_id',$class_id);
    $this->db->order_by('exam_date','ASC');
    $this->db->group_by('exam_date');
    $exam_schedule =  $this->db->get()->result();

    $data['status'] = 200;
    $data['message'] = 'success';
           //$data['date_sheet'] = $exam_schedule;

    $date_array = array();
    foreach ($exam_schedule as $key => $exam_dt) {
        $temp['date'] = $exam_dt->exam_date;
        $re_exam_cancel = $this->db->get_where('re_exam_cancel',array('exam'=>$exam_id,'cancel_for'=>'class','class_id'=>$class_id))->row();
        if($re_exam_cancel == ""){
            $exam_details   = $this->db->get_where('exam_schedule',array('exam_id'=>$exam_id,'exam_date'=>$exam_dt->exam_date,'class_id'=>$class_id))->result();
        }

        if(sizeof($exam_details) > 0){
            $i=0;
            $arr = array();
            $temp['name'] = '';
            foreach($exam_details as $details){
             $subjectname = $this->db->get_where('subject',array('subject_id'=>$details->subject_id))->row()->name;
             $datetime = $details->start_time.' - '.$details->end_time;

             if ($temp['name'] == '') {
                $temp['name'] = $subjectname.' -- '.$datetime;
            } else {
                $temp['name'] = $temp['name'] ."\n" .$subjectname.' -- '.$datetime;
            }

                       //$temp['date_time'] = $temp['date_time'] .'/' .$datetime;
                           /*$t['subject'] = $subjectname;

                          $t['date_time'] = $datetime;
                          array_push($arr, $t);*/

                      }


                // $temp['exams'] = $arr;
                  }

                  array_push($date_array, $temp);
              }

              $data['dates'] = $date_array;
              echo json_encode($data);
          }

          function getExaminationDashboardData() {
            $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $class_id = $this->input->post('class_id');
            $this->db->select('*');
            $this->db->from('subject S');
           
            if($class_id != ""){
                $where = "FIND_IN_SET(".$class_id.",S.class_id) is NOT NULL";
                $this->db->where($where);
            }
      $this->db->group_by('S.name','ASC');
            $subject_arr = $this->db->get()->result();
      //print_r($subject_arr);
            $arr_heightmark=array();$arr_minmark=array();$arr_subject=array();
            if(sizeof($subject_arr) > 0){
              foreach($subject_arr as $sub_dt){
               $subject_id   = $sub_dt->subject_id;
               $subject_name = $sub_dt->name;

               $max_mark = $this->db->query("select MAX(mark_obtained) as hightmark from mark where subject_id = $subject_id AND class_id = $class_id")->row();
               $min_mark = $this->db->query("select MIN(mark_obtained) as min_mark from mark where subject_id = $subject_id AND class_id = $class_id")->row();

               $arr_subject[]    = $subject_name;
               if($max_mark->hightmark != "")
                  $arr_heightmark[] = $max_mark->hightmark + 0;
              else
                  $arr_heightmark[] = 0;

              if($min_mark->min_mark != "")
               $arr_minmark[]    = $min_mark->min_mark + 0;
           else
               $arr_minmark[]    = 0;

       }
   }
   if(sizeof($arr_subject) > 0){
    $graph_data['lables'] = $arr_subject;
    $graph_data['highest'] = $arr_heightmark;
    $graph_data['minimum'] = $arr_minmark;
}

$data['graph_data'] = $graph_data;
$data['total_student'] = count($this->db->get('enroll')->result()).'';
$data['total_student_this_year'] = count($this->db->get_where('enroll',array('year'=>$running_year))->result()).'';
$data['total_pre_exam_registrations'] = count($this->db->get_where('pre_enroll',array('year'=>$running_year))->result()).'';
$data['total_pre_exam'] = count($this->db->get_where('pre_online_exam',array('running_year'=>$running_year))->result()).'';

echo json_encode($data);
}

function getFeedbackForms() {
    $feedbackForms = $this->db->get('teacher_feedback')->result_array();

    $data['status'] = 200;
    $data['message'] = 'success';
    foreach ($feedbackForms as $key => $form) {
       $feedbackForms[$key]['responses'] = $this->db->get_where('student_online_feedback_result', array('feedback_id' => $form['id']))->num_rows().'';
       $feedbackForms[$key]['teacher_id'] = explode(',', $feedbackForms[$key]['teacher_id']);
       $teacherNames = array();
       foreach ($feedbackForms[$key]['teacher_id'] as $key2 => $id) {
        $name = $this->db->get_where('teacher', array('teacher_id' => $id))->row()->name;
        $this->db->get_where('student_online_feedback_result', array('feedback_id' => $id))->num_rows();
        array_push($teacherNames, $name);
    }
    $feedbackForms[$key]['teacher_names'] = $teacherNames;
}
$data['feedback_forms'] = $feedbackForms;

echo json_encode($data);
}

function getFeedbackQuestions() {
    $data['feedback_questions'] = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $this->input->post('feedback_id'))) -> result_array();
    $data['status'] = 200;
    $data['message'] = 'success';

    echo json_encode($data);
}

function getAcademicDashboardData() {
    $class_id = $this->input->post('class_id');
    //$section_id = $this->input->post('class_id');
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $this->db->select('*');
    $this->db->from('subject S');
    if($class_id != ""){
        $where = "FIND_IN_SET(".$class_id.",S.class_id) is NOT NULL";
        $this->db->where($where);
    }
    $subject_arr = $this->db->get()->result();
    $arr_heightmark=array();
    $arr_minmark=array();
    $arr_subject=array();
    $assign=0;
    //print_r($subject_arr); die;
    if(sizeof($subject_arr) > 0){
      foreach($subject_arr as $sub_dt){
        //print_r($sub_dt); die;
         $subject_id   = $sub_dt->subject_id;
         $subject_name = $sub_dt->name;
         $assignment_val = $this->db->get_where('assignments',array('class_id'=>$class_id,'subject_id'=>$subject_id))->result();
         $assignment_persent = 0; 
         foreach($assignment_val as $dtt){
        //print_r($assignment_val); die;
           $assignment_id = $dtt->id;
           $max_mark = $this->db->query("select MAX(mark) as hightmark from submit_assignment where assignment_id = $assignment_id AND class_id = $class_id")->row();
           $min_mark = $this->db->query("select MIN(mark) as min_mark from submit_assignment where assignment_id = $assignment_id AND class_id = $class_id")->row();

           $submit_assignment = $this->db->get_where('submit_assignment',array('assignment_id'=> $assignment_id,'class_id' => $class_id))->result();
         //print_r($max_mark); die;
           foreach ($submit_assignment  as $key => $ass_mark) {
            if($ass_mark->mark != ""){
                $assignment_persent = ($ass_mark->mark*100)/$dtt->assignment_marks;
                if($assignment_persent > 50)
                    $assign++;
            }
        }

        $response['less_than_fifty'] = $assign.'';
    }
    $arr_subject[]    = $subject_name;
    if($max_mark->hightmark != "")
      $arr_heightmark[] = $max_mark->hightmark + 0;
  else
      $arr_heightmark[] = 0;

  if($min_mark->min_mark != "")
     $arr_minmark[]    = $min_mark->min_mark + 0;
 else
     $arr_minmark[]    = 0;

}
}
if(sizeof($arr_subject) > 0){
    /*$data_['labels']   = $arr_subject;
    $data_['datasets'] = array(array('label'=>'Highest Marks','backgroundColor'=>"#3e95cd",'data' => $arr_heightmark),array('label'=>'Lowest Marks','backgroundColor'=>"#8e5ea2",'data' => $arr_minmark));
    $graph_data = json_encode($data_);*/
    $chart_data['label'] = $arr_subject;
    $chart_data['heighest_marks'] = $arr_heightmark;
    $chart_data['minimum_marks'] = $arr_minmark;
    $response['graph_data'] = $chart_data;
} 

$count_student_result   = $this->db->get_where('enroll',array('year'=>$running_year))->result();
$total_studentof_school = count($count_student_result);

$count_student = $this->db->get_where('enroll',array('class_id'=>$class_id,'year'=>$running_year))->result();
$total_student = count($count_student);
$response['student_avrage'] = ($total_studentof_school/$total_student).'';



$assignment_issue = $this->db->get_where('submit_assignment',array('class_id'=>$class_id,'status'=>1))->result();

$response['assignment_issue_value'] = count($assignment_issue).'';

//$response['assignment_persent_value'] = count($assignment_persent);

echo json_encode($response);
}

function getTeacherSyllabusStatusData() {

    $syllabus_id = $this->input->post('syllabus_id');
    $syllabus_info = $this->db->get_where('syllabus_module_info',array('syllabus_id'=>$syllabus_id,'status'=>1))->result();

    $data['syllabus_info'] = $syllabus_info;
    $data['status'] = 200;
    $data['message'] = 'success';
    echo json_encode($data);
}

function getFeedbackFormsForStudents() {
    $classes = $this->db->get('teacher_feedback')->result_array();
    $myData = array();
    foreach ($classes as $row){
        $teacher_id= $row['teacher_id'];
        $teacher_data = $this->db->query("select * from teacher where teacher_id IN ($teacher_id)")->result(); 
        foreach ($teacher_data as $key => $dt){
            $data['id'] = $row['id']; 
            $data['name'] = $dt->name;
            $data['title'] = $row['title'];
            $data['teacher_id'] = $dt->teacher_id;

            array_push($myData, $data);
        } 
    } 

    $dataum['status'] = 200;
    $dataum['message'] = 'success';
    $dataum['feedback_forms'] = $myData;

    echo json_encode($dataum);
}

function getSyllabusModuleData() {
    //$syllabus_module_data = $this->db->get_where('syllabus_module_info', array('syllabus_id' => $this->input->post('syllabus_id'))) -> result_array();
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $this->db->select('*');
    $this->db->from('syllabus_module_info');
    $this->db->where('syllabus_id', $this->input->post('syllabus_id'));
    $this->db->where('year', $running_year);
    $this->db->order_by('module_no', 'ASC');
    $syllabus_module_data = $this->db->get()->result_array();

    $data['status'] = 200;
    $data['message'] = 'success';
    $data['syllabus_module_data'] = $syllabus_module_data;
    echo json_encode($data);
}

function getFeedbackQuestionsForStudent() {
    $feedback_id = $this->input->post('feedback_id');
    $teacher_id = $this->input->post('teacher_id');
    $questions = $this->db->get_where('teacher_feedback_question', array('feed_back_id' => $feedback_id))->result_array();
    $total_marks = 0;
    $form_name= $this->db->get_where('teacher_feedback' , array('id' => $feedback_id ))->row()->title;
    $teacher_name= $this->db->get_where('teacher' , array('teacher_id' => $teacher_id ))->row()->name;
    foreach ($questions as $key => $row) {
        $total_marks += $row['mark'];
        $questions[$key]['options'] = json_decode($questions[$key]['options']);
    }
    $data['status'] = 200;
    $data['message'] = 'success';
    $data['questions'] = $questions;
    $data['form_name'] = $form_name;
    $data['teacher_name'] = $teacher_name;

    echo json_encode($data);
}

function submitFeedbackByStudent() {
    $feedback_id = $this->input->post('feedback_id');
    $student_id = $this->input->post('user_id');
    $teacher_id = $this->input->post('teacher_id');
    $answer_script = $this->input->post('answer_script');

    $query = $this->db->get_where('student_online_feedback_result', array('feedback_id' => $feedback_id, 'student_id' => $student_id, 'teacher_id' => $teacher_id, 'status' => 'submitted'));
    if ($query->num_rows() > 0) {
        $data['status'] = 405;
        $data['message'] = 'You have already submitted this feedback';
    } else {
        $query = $this->db->get_where('student_online_feedback_result', array('feedback_id' => $feedback_id, 'student_id' => $student_id, 'teacher_id' => $teacher_id, 'status !=' => 'submitted'));
        if ($query->num_rows() > 0) {
            $data['status'] = 200;
            $data['message'] = 'Feedback Submitted';

            $feedback = array('feedback_id' => $feedback_id,
               'student_id' => $student_id,
               'teacher_id' => $teacher_id,
               'answer_script' => $answer_script,
               'status' => 'submitted'
           );

            $this->db->where('feedback_id', $feedback_id);
            $this->db->where('student_id', $student_id);
            $this->db->where('teacher_id', $teacher_id);
            $this->db->update('student_online_feedback_result', $feedback);
        } else {
            $data['status'] = 200;
            $data['message'] = 'Feedback Submitted';

            $feedback = array('feedback_id' => $feedback_id,
               'student_id' => $student_id,
               'teacher_id' => $teacher_id,
               'answer_script' => $answer_script,
               'status' => 'submitted'
           );

            $this->db->insert('student_online_feedback_result', $feedback);
        }
    }

    echo json_encode($data);
}

function updateSyllabusProgress() {
    $syllabus_id = $this->input->post('syllabus_id');
    $topic = $this->input->post('topic');
    $description = $this->input->post('description');
    $complete = $this->input->post('complete');

    $this->db->where('academic_syllabus_id', $syllabus_id);
    $query = $this->db->update('academic_syllabus', array('complete_syllabus' => $complete, 'current_topic_title' => $topic, 'current_topic_desc' => $description));
    if ($query) {
        $data['status'] = 200;
        $data['message'] = 'success';
    } else {
        $data['status'] = 400;
        $data['message'] = 'failed to update';
    }

    echo json_encode($data);
}

function getFeedbackFormsResponses() {
    $online_exam_id = $this->input->post('feedback_id');
    $online_exam_details = $this->db->get_where('teacher_feedback', array('id' => $online_exam_id))->row_array();
      //print_r($online_exam_details);
    $students_array = $this->db->query("select * from student_online_feedback_result where feedback_id = ".$online_exam_details['id']."  GROUP BY  teacher_id" )->result_array(); 
    $total_mark = $this->crud_model->get_total_mark($online_exam_id);

    $data = array();
    foreach ($students_array as $row) {

        $total_student =  $this->db->get_where('student_online_feedback_result ', array('teacher_id' => $row['teacher_id'],'feedback_id' =>$online_exam_details['id']))->result();

        $question_title =  $this->db->get_where('teacher_feedback',array('id'=>$row['feedback_id']))->row()->title;

        $datum['teacher_name'] =  $this->db->get_where('teacher',array('teacher_id'=>$row['teacher_id']))->row()->name; 

        $rating_total = 0;$student_value = 0;
        foreach ($total_student as $key => $total_student_row) {
            $answer_json =   json_decode($total_student_row->answer_script);

            foreach($answer_json as $dt){
             $submitted_answer =  json_decode($dt->submitted_answer);
             $rating =  implode(" ", $submitted_answer);
             $total_rating = $total_rating+$rating;
             $student_value++;
         }
     } 
                      //echo $total_rating/$student_value;
     $datum['average_rating'] =  $total_rating/$student_value;
     $datum['question_title'] =  $question_title;
     array_push($data, $datum);

 }

 $response['status'] = 200;
 $response['message'] = 'success';
 $response['responses'] = $data;
 echo json_encode($response);
}

function returnBookByRfidCard() {
    $book_rfid   = $this->input->post('book_code');
    $name_rfid   = $this->input->post('name_rfid');
    
    $book  = $this->db->query("SELECT * FROM book WHERE book_code = $book_rfid  LIMIT 1") -> row();
    $student_id = $this->db->query("SELECT student_id FROM enroll WHERE card_code = $name_rfid  LIMIT 1") -> row();

    $isAlreadyReturned = $this->db->get_where('book_request', array('book_id' => $book -> book_id, 'user_id' => $student_id -> student_id, 'return_status' => 1));
    if ($isAlreadyReturned->num_rows() > 0) {
       $response['status'] = 406;
       $response['message'] = 'You have not issued this book';
   } else {
    //print_r($student_id); die;
    $this->db->where('book_id', $book -> book_id);
    $this->db->update('book', array('issued_copies' =>($book -> issued_copies) - 1));

    $this->db->where('book_id', $book -> book_id);
    $this->db->where('user_id', $student_id -> student_id);
    $this->db->where('return_status', 0);
    $query = $this->db->update('book_request', array('return_status' => 1));
    if ($query) {
        $response['status'] = 200;
        $response['message'] = 'Book returned !';
    } else {
        $response['status'] = 400;
        $response['message'] = 'Failed, Please try again !';
    }
}

echo json_encode($response);

}

function getTeacherOwnDashboardData() {
    $month = date('m');
    $year = date('Y');
    $user_id = $this->input->post('user_id');
    $teacherData = $this->db->get_where('teacher', array('teacher_id' => $user_id)) -> row();
    $teacherData -> social_links = json_decode($teacherData -> social_links);
    $teacherData -> password = '';


    $teacherData -> present_this_month = $this->db->get_where('emp_attendance', array('status' => 1,'role_id'=>5,'MONTH(default_time)' =>$month, 'emp_id' => $user_id))->num_rows();
    $teacherData -> absent_this_month = $this->db->get_where('emp_attendance', array('status' => 2,'role_id'=>5,'MONTH(default_time)' =>$month, 'emp_id' => $user_id))->num_rows();
    $teacherData -> total_book_requests = $this->db->get_where('book_request', array('role_id' => 5, 'user_id' => $user_id)) -> num_rows();

    $teacherData -> total_leave_requests = $this->db->get_where('leave_request', array('role_id'=>5, 'request_by' => $user_id))->num_rows();

    $this->db->select('*');
    $this->db->from('salary_payments');
    $this->db->where('payment_to', 'teacher');
    $this->db->where('user_id', $user_id);
    $this->db->limit(5);
    $teacherData -> last_five_payments = $this->db->get() -> result_array();

    $response['status'] = 200;
    $response['message'] = 'success';
    $response['teacher_data'] = $teacherData;

    echo json_encode($response);
}

function updateLeaveRequestStatus() {
    $status = $this->input->post('status');
    $this->db->where('uniqid', $this->input->post('uniqid'));
    $query = $this->db->update('leave_request', array('status' => $status));
    if ($query) {
        $response['status'] = 200;
        $response['message'] = 'Success';
    } else {
        $response['status'] = 400;
        $response['message'] = 'Failed';
    }

    echo json_encode($response);
}

function addGuardian() {
        // print_r($data);
        /*if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $data['status']     = 1;
            $data['year']       = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        }*/

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }
        if ($_FILES['doc_photo']['name']) {
            $data['doc_photo'] = $this->_doc_upload_photo();
        }

        $data_array = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'profession' => $this->input->post('profession'),
            'present_address' => $this->input->post('present_address'),
            'other_info' => $this->input->post('other_info'),
            'student_id' => $this->input->post('student_id'),
            'relation' => $this->input->post('relation'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->input->post('user_id'),
            'status' => 1,
            'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description,
            'photo' => $data['photo']

        );

        $query = $this->db->insert('guardians', $data_array);
        
        if ($query) {
            $response['status'] = 200;
            $response['message'] = 'Success';
        } else {
            $response['status'] = 400;
            $response['message'] = 'Failed';
        }

        echo json_encode($response);
    }

    private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/guardian-photo/';

            $file_type = explode(".", $photo);
            $extension = strtolower($file_type[count($file_type) - 1]);
            $photo_path = 'photo-' . time() . '-sms.' . $extension;

            move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
            if ($prev_photo != "") {
                if (file_exists($destination . $prev_photo)) {
                    @unlink($destination . $prev_photo);
                }
            }

            $return_photo = $photo_path;
        }
    } else {
        $return_photo = $prev_photo;
    }

    return $return_photo;
}


private function _doc_upload_photo() {

    $prev_photo = $this->input->post('doc_prev_photo');
    $photo = $_FILES['doc_photo']['name'];
    $photo_type = $_FILES['doc_photo']['type'];
    $return_photo = '';
    if ($photo != "") {
        if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
            $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
            $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

            $destination = 'assets/uploads/guardian-photo/';

        $file_type = explode(".", $photo);
        $extension = strtolower($file_type[count($file_type) - 1]);
        $photo_path = 'doc-photo-' . time() . '-sms.' . $extension;

        move_uploaded_file($_FILES['doc_photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
        if ($prev_photo != "") {
            if (file_exists($destination . $prev_photo)) {
                @unlink($destination . $prev_photo);
            }
        }

        $return_photo = $photo_path;
    }
} else {
    $return_photo = $prev_photo;
}

return $return_photo;
}

function assignGuardian() {
    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    $student_id = $this->input->post('student_id');
    $guardian_id = $this->input->post('guardian_id');
    $date_from = $this->input->post('date_from').'00:00:00';
    $date_to = $this->input->post('date_to').'00:00:00';

    /*$this->db->where('student_id', $student_id);
    $this->db->delete('assign_guardian_list');

    $this->db->where('guardian_id', $guardian_id);
    $this->db->delete('assign_guardian_list');*/
    
  //  $this->db->get_where()

    $data = array(
        'student_id' => $student_id,
        'guardian_id' => $guardian_id,
        'date_from' => $date_from,
        'date_to' => $date_to,
        'create_by' => $this->input->post('user_id'),
        'role_id' => 8,
        'status' => 1,
        'year' => $running_year
    );

    $query = $this->db->insert('assign_guardian_list', $data);
    if ($query) {
        $response['status'] = 200;
        $response['message'] = 'Success';
    } else {
        $response['status'] = 400;
        $response['message'] = 'Failed';
    }
    echo json_encode($response);
}

function getTimeTableDataForStudentDemo() {
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $student_id = $this->input->post('student_id');
    $template_id =$this->db->get_where('class_routine',array('class_id'=>$class_id,'section_id'=>$section_id,'template_active'=>1))->row()->template_id;
    //$day = 'monday';
    $day = $this->input->post('day');
    $template_data_result = $this->db->get_where('class_routine_template',array('id'=>$template_id,'status'=>1))->row();

    // print_r($template_data_result);
    $data['start_time'] = $template_data_result -> start_time;
    $data['interval'] = $template_data_result -> time_interval;
    $timetable_name = $template_data_result -> name;
    $timetable_time = $template_data_result -> start_time;
    $interval_      = $template_data_result -> time_interval;
//echo $template_data_result -> id;
    $universal_periods_ = $this->db->get_where('universal_periods',array('template_id'=>$template_data_result -> id))->result();
//echo  $template_data_result -> numberofperiod;
    //print_r($universal_periods_);
    $numberofperiod_    = $template_data_result -> numberofperiod;
    $k=0;
    $mt=array(); 
    $p=0;
    $nt=array();
    $numberofperiod_sum   = $numberofperiod_;
    $count_total_period   =    $numberofperiod_sum + count($universal_periods_);    

    $ttData = array();
    $periods = array();
  /*  for($t = 1;$t<= $count_total_period;$t++){
        $temp['period'] = array_push($periods, $t);
    }*/


    $date      = date("Y-m-d");
    $temp_date = "";
    $date_time = strtotime(date("H:i:s"));
    $day_      = $day;
    $universal_name_val = "Empty";

    $data['day'] = $day_; 
    $data['start_time'] = $timetable_time;
    $data['interval'] = $interval_;

    $count = 1;
    $selectedTime        = $timetable_time;
    $ttData = array();

    for($i = 1;$i <= $numberofperiod_sum;$i++) {
        $kk=$i;
        $before_period =   'b_'.$kk;

          $universal_periods_data  = $this->db->order_by('id','ASC')->get_where('universal_periods',array('template_id'=>$template_data_result -> id,'assign_period'=>$before_period))->result();
          
          $k=0;
          if(count($universal_periods_data)>0){
            
           foreach($universal_periods_data as $datae){

               $class_routine_value =  $this->db->get_where('class_routine',array('period'=>$i,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_data_result -> id,'day'=>$day_))->row(); 
//echo $this->db->last_query();
               $subjectsdata = new stdClass();
$subjectsdata -> teacher = 'Not assigned';
$subjectsdata -> name = $datae->name;  
 $minutes_       = '+'.$datae->interval_time." minutes"; 
        $endTime        = strtotime($minutes_, strtotime($selectedTime));
        $endtime_       = date('H:i',$endTime);
$subjectsdata-> period = $datae->assign_period;

        $subjectsdata-> selected_time = $selectedTime;
        $subjectsdata-> end_time = $endtime_;
        $subjectsdata-> is_universal = true;
        $temp2 = $subjectsdata;
        $selectedTime=$subjectsdata-> end_time;
        if($k<count($universal_periods_data)){
    array_push($ttData, $temp2);
}
$k++;
}

          }



        $class_routine_value =  $this->db->get_where('class_routine',array('period'=>$i,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_data_result -> id,'day'=>$day_))->row(); 

       if($class_routine_value->subject_id){
          $subjectsdata = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) and subject_id= $class_routine_value->subject_id  order by subject_id ASC")->row();
      } else {
       // $subjectsdata=array();
        $subjectsdata = new stdClass();
        $subjectsdata -> name = "Not Assigned";
      }

      $this->db->select('T.*');
        $this->db->from('assign_subject AS S');
        $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
        $this->db->where('S.subject_id',$class_routine_value->subject_id );
        $this->db->where('S.teacher_id',$class_routine_value->teacher_id );
        $teacherdata = $this->db->get()->row()->name;

        if (!empty($teacherdata)) {
            // foreach ($teacherdata as $obj) {
                $subjectsdata -> teacher = $teacherdata;
            // }
        }else{
             $subjectsdata -> teacher = 'Not Assigned';
        }

    
    $minutes_       = '+'.$interval_." minutes"; 
        $endTime        = strtotime($minutes_, strtotime($selectedTime));
        $endtime_       = date('H:i',$endTime);
$subjectsdata-> period = $i;

        $subjectsdata-> selected_time = $selectedTime;
        $subjectsdata-> end_time = $endtime_;
        $subjectsdata-> is_universal = false;
        $temp = $subjectsdata;
        $selectedTime=$subjectsdata-> end_time;
    array_push($ttData, $temp);


$after_period =   'a_'.$i;

          $universal_periods_data_after  = $this->db->order_by('id','ASC')->get_where('universal_periods',array('template_id'=>$template_data_result -> id,'assign_period'=>$after_period))->result();
          //print_r($universal_periods_data);
          if(!empty($universal_periods_data_after)){
           foreach($universal_periods_data_after as $data){
$subjectsdatae = new stdClass();
               $class_routine_value =  $this->db->get_where('class_routine',array('period'=>$i,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_data_result -> id,'day'=>$day_))->row(); 

      //  if($class_routine_value->subject_id){
      //     $subjectsdata = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) and subject_id= $class_routine_value->subject_id  order by subject_id ASC")->row();
      // } else {
      //   $subjectsdata=array();
      // }

      // $this->db->select('T.*');
      //   $this->db->from('assign_subject AS S');
      //   $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
      //   $this->db->where('S.subject_id',$class_routine_value->subject_id );
      //   $this->db->where('S.teacher_id',$class_routine_value->teacher_id );
      //   $teacherdata = $this->db->get()->row()->name;

      //   if (!empty($teacherdata)) {
      //       // foreach ($teacherdata as $obj) {
      //           $subjectsdata -> teacher = $teacherdata;
      //       // }
      //   }else{
      //        $subjectsdata -> teacher = 'Not assigned';
      //   }
$subjectsdatae -> teacher = 'Not assigned';
$subjectsdatae -> name = $data->name;  
 $minutes_       = '+'.$data->interval_time." minutes"; 
        $endTime        = strtotime($minutes_, strtotime($selectedTime));
        $endtime_       = date('H:i',$endTime);
$subjectsdatae-> period = $data->assign_period;

        $subjectsdatae-> selected_time = $selectedTime;
        $subjectsdatae-> end_time = $endtime_;
        $subjectsdatae-> is_universal = true;
        $temp3 = $subjectsdatae;
        $selectedTime=$subjectsdatae-> end_time;
    array_push($ttData, $temp3);

}
          }


}

$response['status'] = 200;
$response['message'] = 'success';
$response['time_table'] = $ttData;
echo json_encode($response);

}





function getTimeTableDataForStudent1() {
    $class_id = $this->input->post('class_id');
    $section_id = $this->input->post('section_id');
    $student_id = $this->input->post('student_id');
    $template_id =$this->db->get_where('class_routine',array('class_id'=>$class_id,'section_id'=>$section_id,'template_active'=>1))->row()->template_id;
    $day = 'monday';

    $template_data_result = $this->db->get_where('class_routine_template',array('id'=>$template_id,'status'=>1))->row();

    // print_r($template_data_result);
    $data['start_time'] = $template_data_result -> start_time;
    $data['interval'] = $template_data_result -> time_interval;
    $timetable_name = $template_data_result -> name;
    $timetable_time = $template_data_result -> start_time;
    $interval_      = $template_data_result -> time_interval;
//echo $template_data_result -> id;
    $universal_periods_ = $this->db->get_where('universal_periods',array('template_id'=>$template_data_result -> id))->result();
//echo  $template_data_result -> numberofperiod;
    //print_r($universal_periods_);
    $numberofperiod_    = $template_data_result -> numberofperiod;
    $k=0;
    $mt=array(); 
    $p=0;
    $nt=array();
    $numberofperiod_sum   = $numberofperiod_;
    $count_total_period   =    $numberofperiod_sum + count($universal_periods_);    

    $ttData = array();
    $periods = array();
  /*  for($t = 1;$t<= $count_total_period;$t++){
        $temp['period'] = array_push($periods, $t);
    }*/


    $date      = date("Y-m-d");
    $temp_date = "";
    $date_time = strtotime(date("H:i:s"));
    $day_      = $day;
    $universal_name_val = "Empty";

    $data['day'] = $day_; 
    $data['start_time'] = $timetable_time;
    $data['interval'] = $interval_;

    $count = 1;
    $selectedTime        = $timetable_time;
//$selected_time        = $timetable_time;

                // $minutes_         =   '+'.$interval_." minutes"; 
    //$GLOBALS['minutes_'] = '+'.$interval_." minutes";
//$numberofperiod_sum;
  
    for($i = 0;$i < $count_total_period;$i++){
        
        $temp['i']=$i; 
        $kk = $i+1;
        $universal_name_val = "Empty";
        $universal_periods_data = array();
$bool=false;
        if($i==0){ 
          $before_period =   'b_'.$kk;
          $universal_periods_data  = $this->db->order_by('id','ASC')->get_where('universal_periods',array('template_id'=>$template_data_result -> id,'assign_period'=>'b_1'))->result();    
      }elseif($kk == $numberofperiod){
          $afterperiod =   'a_'.$numberofperiod;
          $universal_periods_data  = $this->db->order_by('id','ASC')->get_where('universal_periods',array('template_id'=>$template_data_result -> id,'assign_period'=>$afterperiod))->result();  
      }
      else{
          $before_period =   'b_'.$kk;
          $universal_periods_data  = $this->db->order_by('id','ASC')->get_where('universal_periods',array('template_id'=>$template_data_result -> id,'assign_period'=>$before_period))->result();  
      }
//print_r($universal_periods_data);
      if(sizeof($universal_periods_data) > 0){  
          $selectedTime       = $selectedTime;
          $last_universal_period=array();
          $l = 0;
          foreach($universal_periods_data  as $universal_dt){
          // echo "hi".$i;
              $placement_period = $universal_dt->assign_period;

              $universal_name_val = $universal_dt->name;

              if($placement_period == 'b_'.$kk){
                  $minutes_       = '+'.$universal_dt->interval_time." minutes"; 
                  $endTime        = strtotime($minutes_, strtotime($selectedTime));
                  $endtime_       = date('H:i',$endTime);
              } elseif($placement_period == 'a_'.$numberofperiod){

                  $last_universal_period[$l]['time'] =  $universal_dt->interval_time;
                  $last_universal_period[$l]['name'] =  $universal_dt->name;;
                  $l++;

              } 
              $temp['period'] = $i+1;
              $temp['day'] = $day_;
              $temp['time_start'] = $selectedTime;

              $temp['selected_time'] = $selectedTime;
              $temp['end_time'] = $endtime_;
              $temp['universal_name_val'] = $universal_name_val;

              $count++; 
              $minutes_       = '+'.$universal_dt->interval_time." minutes"; 
              $endTime        = strtotime($minutes_, strtotime($selectedTime));
              $selectedTime   = $endtime_;  
              array_push($ttData, $temp);
$bool=true;
          }

                                  // $minutes_       = '+'.$universal_dt->interval_time." minutes"; 
                                  // $endTime        = strtotime($minutes_, strtotime($selectedTime));
      }
$temp['selected_time'] = $selectedTime;
  $minutes_       = '+'.$interval_." minutes"; 
  $endTime        = strtotime($minutes_, strtotime($selectedTime));
  $endtime_       = date('H:i',$endTime);   

  $class_routine_value =  $this->db->get_where('class_routine',array('period'=>$i+1,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_data_result -> id,'day'=>$day_))->row(); 
  //print_r($class_routine_value);
//echo $this->db->last_query();die;
//echo "select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC";
  if($class_routine_value->subject_id){
  $subjectsdata = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) and subject_id=$class_routine_value->subject_id  order by subject_id ASC")->row();
}else{
    $subjectsdata=array();
}
 // print_r($subjectsdata);
if($bool!=true){
  if($subjectsdata){
  
    

    $temp['subject'] = $subjectsdata->name;
//print_r($class_routine_value);
    if($class_routine_value != ""){ 
        $this->db->select('T.*');
        $this->db->from('assign_subject AS S');
        $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
        $this->db->where('S.subject_id',$class_routine_value->subject_id );
        $this->db->where('S.teacher_id',$class_routine_value->teacher_id );
        $teacherdata = $this->db->get()->row()->name;

        if (!empty($teacherdata)) {
            // foreach ($teacherdata as $obj) {
                $temp['teacher'] = $teacherdata;
            // }
        }else{
             $temp['teacher'] = 'Not assigned';
        }
    }
//echo $selectedTime;
    
    $selectedTime = $endtime_;  
    $temp['end_time'] = $endtime_;
 $temp['period'] = $i+1;
    

     
//print_r($last_universal_period);
    if(sizeof($last_universal_period) > 0){

     foreach($last_universal_period as $dt){
        $minutes_       = '+'.$dt['time']." minutes"; 
        $endTime        = strtotime($minutes_, strtotime($selectedTime));
        $endtime_       = date('H:i',$endTime);
$temp['period'] = $i+1;

        $temp['selected_time'] = $selectedTime;
        $temp['end_time'] = $endtime_;
        $temp['subject'] = $dt['name'];

        array_push($ttData, $temp);



        $count++;
        $selectedTime = $endtime_; 

       // array_push($ttData, $temp);
    }
}




}
else{
    $temp['period'] = $i+1;
    $temp['teacher'] = 'Not assigned';
    $temp['subject'] = 'Not assigned';
    $temp['selected_time'] = $selectedTime;
        $temp['end_time'] = $endtime_;
         $selectedTime = $endtime_; 
}
array_push($ttData, $temp);
}

}



$data['timetable'] = $ttData;



        //print_r($universal_periods_);

echo json_encode($data);
}

function getEmployeeLeaveReports() {
    $emp_type = $this->input->post('emp_type');
    $user_id = $this->input->post('emp_id');
    $year = $this->input->post('year');

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
} elseif($emp_type=='driver' || $emp_type=='warden' || $emp_type=='security-gaurd' || $emp_type == 'inventory' || $emp_type == 'transport'){
 $this->db->join('employees AS T', 'T.id = L.request_by');     
 $this->db->where('L.request_by', $user_id);    

}

$result =  $this->db->get()->result();

foreach ($result as $key => $dt) {
        if($dt->from_date != "" && $dt->to_date != ""){
            $fdate = date('Y-m-d',strtotime($dt->from_date));
            $tdate = date('Y-m-d',strtotime($dt->to_date));
            $date1 = new DateTime("$fdate");
            $date2 = new DateTime("$tdate");
            $diff  = date_diff($date1,$date2);
            $diff_date = $diff->format('%a days');
            $result[$key] -> diff_date = $diff_date;
        } else {
            $result[$key] -> diff_date = '';
        }
    }

$response['status'] = 200;
$response['message'] = 'Success';

$response['leave_data'] = $result;


echo json_encode($response);

}

function getHolidays() {
	$date = date('Y-m-d');

	$this->db->select('*');
	$this->db->from('holiday_leave');
	$this->db->where('status', 1);
	$this->db->where('date >=', $date);

	$holidays = $this->db->get()->result_array();

	$data['status'] = 200;
	$data['message'] = 'success';
	$data['holidays'] = $holidays;

	echo json_encode($data);
}

function getTransportManagementDashboardData() {
	$data['total_active'] =  $this->db->get_where('routes',array('status'=>1))->result();
    $total_member =  $this->db->get_where('student',array('transport_id'=>1))->result();
    if(count($total_member) != ""){
         $member_avg = count($total_member)/count($data['total_active']);
         $data['member_avg_per_route'] = round($member_avg ,2);
    }
    $total_route_stops = array();
       foreach ($data['total_active'] as $key => $stops) {
        $route_stops =  $this->db->get_where('route_stops',array('route_id'=>$stops->id))->result();
        $total_route_stops[] = count($route_stops);
    }

    $data['total_routes'] = $this->db->get('routes')->num_rows();
    $data['highest_route_capacity'] = max($total_route_stops);
    $data['total_active'] = count($data['total_active']);

    echo json_encode($data);   
}

function student_marksheet_print_view_mobile($student_id, $exam_id) {
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }
    
    function getTeacherRoutine() {
        $teacherId = $this->input->post('teacher_id');
        $day = $this->input->post('day');
        
        $activeTemplateId = $this->db->get_where('class_routine_template', array('status' => 1)) -> row() -> id;
        
        $teacherRoutine = $this->db->get_where('class_routine', array('teacher_id' => $teacherId, 'template_id' => $activeTemplateId, 'day' => $day)) -> result();

        foreach ($teacherRoutine as $key => $teacherData) {
           
        	$teacherRoutine[$key] -> class_name = $this->db->get_where('class' , array('class_id' => $teacherData -> class_id))->row()->name;
        	$teacherRoutine[$key] -> section_name = $this->db->get_where('section' , array('section_id' => $teacherData -> section_id))->row()->name;
        	$teacherRoutine[$key] -> subject_name = $this->db->get_where('subject', array('subject_id' => $teacherData -> subject_id))->row()-> name;
        }
        
        $data['status'] = 200;
        $data['message'] = 'success';
        $data['routine'] = $teacherRoutine;
        
        echo json_encode($data);
    }
    
    function getPracticals() {
     //   $practicals = $this->db->get('subject_practial')->result_array();
       $this->db->select('SP.*,S.name as subject_name,C.name as class_name');
            $this->db->from('subject_practial AS SP');
            $this->db->join('subject As S', 'S.subject_id = SP.subject_id', 'left');
            $this->db->join('class As C', 'C.class_id = S.class_id', 'left');
            $practicals = $this->db->get()->result_array();
        $data['status'] = 200;
        $data['message'] = 'success';
        
        
        foreach($practicals as $key => $data2) {
            $practicals[$key]['subject_name'] = $this->db->get_where('subject', array('subject_id' => $data2['subject_id']))->row()->name;
        }
        
         $data['practicals'] = $practicals;
        
        echo json_encode($data);
    }
    
    function getCompetencies() {
     //   $competencies = $this->db->get('subject_competencies')->result_array();
        $data['status'] = 200;
        $data['message'] = 'success';
       
        
         $this->db->select('SC.*,S.name as subject_name,C.name as class_name');
            $this->db->from('subject_competencies AS SC');
            $this->db->join('subject As S', 'S.subject_id = SC.subject_id', 'left');
            $this->db->join('class As C', 'C.class_id = S.class_id', 'left');
            $competencies = $this->db->get()->result_array();
            
         $data['competencies'] = $competencies;
        
        echo json_encode($data);
    }
    
    function getAchievements() {
        if ($this->input->post('user_type') == "parent") {
            $data['achievements'] = $this->achievement->get_achievement_list_by_parent($this->input->post('user_id'), $this->input->post('child_id'));
        } else if ($this->input->post('user_type') == "student") {
            $data['achievements'] = $this->achievement->get_achievement_list_by_parent(null, $this->input->post('user_id'));
        } else {
            $data['achievements'] = $this->achievement->get_achievement_list();
        }
        $data['status'] = 'success';
        echo json_encode($data);
    }
    
    function deleteAchievement(){
         $this->db->where('id', $this->input->post('id'));
       $this->db->delete('achievements');
       $data['status'] = "200";
       echo json_encode($data);
    }
    
    function addStudent(){
            $running_year = $this->db->get_where('settings', array(
                'type' => 'running_year'
            ))->row()->description;
            $data['name'] = $this->input->post('name');
            if($this->input->post('birthday') != null){
              $data['birthday']     = $this->input->post('birthday');
            }
            if($this->input->post('sex') != null){
              $data['sex']          = $this->input->post('sex');
            }
            if($this->input->post('address') != null){
              $data['address']      = $this->input->post('address');
            }
            if($this->input->post('phone') != null){
              $data['phone']        = $this->input->post('phone');
            }

            if($this->input->post('mother_name') != null){
              $data['mother_name']        = $this->input->post('mother_name');
              }
              $perfix_code =  @$this->db->get_where('settings' , array('type' =>'perifix_code'))->row()->description;
            $data['student_code'] = $perfix_code.'_'.substr(md5(uniqid(rand(), true)), 0, 5);
            $code_validation      = code_validation_insert($data['student_code']);
            if(!$code_validation) {
                $data['student_code'] = $perfix_code.'_'.substr(md5(uniqid(rand(), true)), 0, 5);
                $code_validation      = code_validation_insert($data['student_code']);
                if(!$code_validation) {
                    $data['status'] = 500;
                    $data['message'] = get_phrase('regenrate_student_code_failed');
                    $data['data'] = $this->input->post();
                    echo json_encode($data);
                    die();
                }
            }
       

            $data['email']        = $this->input->post('email');
            $data['password']     = sha1($this->input->post('password'));


            // if($this->input->post('parent_id') != null){
            //     $data['parent_id']    = $this->input->post('parent_id');
            // }
            
            if(!empty($this->input->post('parent_email'))){
                $parent = $this->db->get_where('parent',['email'=>$this->input->post('parent_email')])->row();
                if(empty($parent)){
                    $this->db->insert('parent',[
                            'email'=>$this->input->post('parent_email'),
                            'name'=>$this->input->post('parent_name'),
                            'password'=>sha1($this->input->post('parent_password')),
                            'address'=>$this->input->post('address'),
                            'phone'=>$this->input->post('parent_phone'),
                            'profession'=>$this->input->post('parent_proffession')
                        ]);
                    $parent_insert_id = $this->db->insert_id();
                    $this->email_model->account_opening_email('parent', $this->input->post('parent_email')); //SEND EMAIL ACCOUNT OPENING EMAIL
                } else {
                    $parent_insert_id = $parent->parent_id;
                }
                
                $data['parent_id']    = $parent_insert_id;
            }
            
            if($this->input->post('dormitory_id') != null){
                $data['dormitory_id'] = $this->input->post('dormitory_id');
            }
             if($this->input->post('discount_id') != null){
                $data['discount_id'] = $this->input->post('discount_id');
            }
            if($this->input->post('transport_id') != null){
                $data['transport_id'] = $this->input->post('transport_id');
            }
            if($this->input->post('stop_id') != null){
                $data['transport_stop'] = $this->input->post('stop_id');
            }
            if($this->input->post('hostel_id') != null){
              $data['hostel_id']        = $this->input->post('hostel_id');
            }
            if($this->input->post('blood_group') != null){
              $data['blood_group']        = $this->input->post('blood_group');
            }
            
            $data['otherfields'] = $this->addOtherFiels($this->input->post(),$_FILES);
            $validation =  $this->db->get_where('student',array('email'=>$data['email']))->num_rows();
            if($validation == 0) {
                
                $this->db->insert('student', $data);
                $student_id = $this->db->insert_id();
                $_POST['student_id'] = $student_id;

                $data2['student_id']     = $student_id;
                $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
                if($this->input->post('class_id') != null){
                  $data2['class_id']       = $this->input->post('class_id');
                }
                if ($this->input->post('section_id') != '') {
                    $data2['section_id'] = $this->input->post('section_id');
                }
                if ($this->input->post('rf_id') != '') {
                    $data2['card_code']           = $this->input->post('rf_id');
                }
                $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
                $data2['year']           = $running_year;
                $roll_no        = $this->db->order_by('enroll_id','DESC')->get_where('enroll',array('section_id'=>$this->input->post('section_id'),'class_id'=>$this->input->post('class_id')))->row()->roll;
                if($roll_no == 0 && $roll_no != ""){
                    $data2['roll'] = $select_roll =  0+1;
                }elseif($roll_no != ""){
                    $data2['roll'] = $select_roll = $roll_no+1;
                }else{
                    $data2['roll'] = 1;   
                }
                $this->db->insert('enroll', $data2);
               
                if($this->input->post('transport_id') != null && $this->input->post('stop_id')  != null){
                    $data_route['route_id']      = $this->input->post('transport_id');
                    $data_route['route_stop_id'] = $this->input->post('stop_id');
                    $data_route['user_id']       = $student_id;
                    $data_route['role_id']      = $this->session->userdata('role_id');
                    $data_route['created_by']    = $this->session->userdata('login_user_id');
                    $data_route['created_at']    = date('Y-m-d H:i:s');
                    $this->db->insert('transport_members',$data_route);

                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('is_transport_member'=>1));

                }
               
                if($this->input->post('dormitory_id') != null && $this->input->post('hostel_id')  != null){
                    $data_hostel['hostel_id']      = $this->input->post('hostel_id');
                    $data_hostel['room_id']        = $this->input->post('dormitory_id');
                    $data_hostel['user_id']        = $student_id;
                    $data_hostel['role_id']        = $this->session->userdata('role_id');
                    $data_hostel['created_by']     = $this->session->userdata('login_user_id');
                    $data_hostel['created_at']     = date('Y-m-d H:i:s');
                    $this->db->insert('hostel_members',$data_hostel);

                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('is_hostel_member'=>1));
                }

                if(sizeof($_FILES) > 0)
                    move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
                
                $this->email_model->account_opening_email('student', $data['email'],$this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
                $data['status'] = 200;
                echo json_encode($data);
                die();
            }
            else {
                $data['status'] = 500;
                $data['message'] = get_phrase('this_email_id_is_not_available');
                $data['data'] = $this->input->post();
                echo json_encode($data);
                die();
            }
            $this->get_student_profile_information();
            die();
            
    }
    
    protected function addOtherFiels($post,$files){
    
     $create_dianamic_field = $this->db->get_where('registration_form_setting',array('status'=>'1','created_html' => '0'))->result();
        $data_other_field_array = array();

        foreach ($create_dianamic_field as $htmlcode) { 
           $htmlcode = json_decode($htmlcode->json_field_elements);
           $data_j   = array();
           if(array_key_exists($htmlcode->name,$post) || array_key_exists($htmlcode->name,$_FILES)){
            //echo $htmlcode->type;
            //html_entity_decode
            if($htmlcode->type == 'documentupload' || $htmlcode->type == 'imageupload'){
                if($_FILES[$htmlcode->name]['name'] != "")
                    $filename = str_replace(" ", "_", $_FILES[$htmlcode->name]['name']);

             move_uploaded_file($_FILES[$htmlcode->name]['tmp_name'], 'uploads/other_student_image/' . $filename);  
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $filename; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j; 
            }else{
             $data_j['name']  = $htmlcode->name; 
             $data_j['value'] = $post[$htmlcode->name]; 
             $data_j['type']  = $htmlcode->type; 
             $data_j['description'] = $htmlcode->description; 
             $data_other_field_array[] = $data_j;
            }
         }
    }

    return $_otherFieldData =  json_encode($data_other_field_array);
    //echo $_otherFieldData =  json_encode($data_other_field_array);die;

   }
   
   function getClasswiseStudents() {
       $classes = $this->db->get("class")->result_array();
       
       
       foreach($classes as $key => $class) {
           
           $this->db->select('S.*');
            $this->db->from('student AS S');
            $this->db->join('enroll AS E', 'E.student_id = S.student_id', 'left');
            $this->db->where('E.class_id', $class["class_id"]);
           $classes[$key]['students'] = $this->db->get()->result_array();
       }
       
       $data['status'] = "success";
       $data['classes'] = $classes;
       echo json_encode($data);
   }
   
   function createAchievement() {
       $student_id = $this->input->post('student_id');
       $class_id = $this->input->post('class_id');
       $title = $this->input->post('title');
       $description = $this->input->post('description');
       $teacher_id = $this->input->post('teacher_id');
       $date = $this->input->post('date');
       
       $query = $this->db->insert('achievements', array('student_id' => $student_id, 'class_id' => $class_id, 'title' =>  $title, 'description' => $description, 'teacher_id' => $teacher_id, 'date' => $date));
       if ($query) {
           $data['status'] = 'success';
       } else {
           $data['status'] = 'failed';
        
       }
       
       echo json_encode($data);
   }
   
   function getInventoryList() {
       $inventory = $this->data['inventories'] = $this->inventory->get_inventory_list();
       $data['inventory'] = $inventory;
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   //Start implementing from here
   function addInventoryType() {
      // echo "Hello"; die;
      $name = $this->input->post('name');
      
       $this->db->insert('inventory_type', array('name' => $name));
       $data['status'] = 201;
        $data['message'] = "created";
        echo json_encode($data);
        die;
   }
   
   function getIntentoryTypes() {
       $inventories = $this->db->get('inventory_type')->result_array();
       $data['inventories'] = $inventories;
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function addNewEntryInInventory() {
       $inventoryId = $this->input->post('inventory_id'); 
       $quantity = $this->input->post('quantity');
       
       $dataToAdd['inventory_type'] = $inventoryId;
       $dataToAdd['name'] = $quantity;
       $dataToAdd['created_by'] = $this->input->post('user_id');
       $this->db->insert('inventory', $dataToAdd);
       
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function distributeInventory() {
       $dataToAdd['inven_id'] = $this->input->post('inventory_id');
       $dataToAdd['quantity'] = $this->input->post('quantity');
       $dataToAdd['class_id'] = $this->input->post('class_id');
       $dataToAdd['section_id'] = $this->input->post('section_id');
       $dataToAdd['created_by'] = $this->input->post('user_id');
        $dataToAdd['distributed_to'] = $this->input->post('staff_id');
       
       $this->db->insert('inventory_warehouse', $dataToAdd);
       
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function addAssetType() {
       $dataToAdd['asset_name'] = $this->input->post('asset_name');
       $dataToAdd['asset_slug'] = $this->input->post('asset_slug');
       $dataToAdd['created_by'] = $this->input->post('user_id');
       
       $this->db->insert('asset_type', $dataToAdd);
       
       $data['status'] = "success";
       echo json_encode($data);
   }
   function editAssetType() {
       $dataToAdd['asset_name'] = $this->input->post('asset_name');
       $id = $this->input->post('id');
   
       $this->db->where('id',$id);
       $this->db->update('asset_type', $dataToAdd);
       
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function getAssetTypes() {
       $asset_types = $this->db->get('asset_type')->result_array();
       $data['asset_types'] = $asset_types;
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function deleteAssetType() {
       $this->db->where('id', $this->input->post('asset_id'));
       $this->db->delete('asset_type');
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function addAssetToWarehouse() {
       $dataToAdd['asset_id'] = $this->input->post('asset_id');
       $dataToAdd['quantity'] = $this->input->post('quantity');
       $dataToAdd['class_id'] = $this->input->post('class_id');
       $dataToAdd['section_id'] = $this->input->post('section_id');
       $dataToAdd['created_by'] = $this->input->post('user_id');
       $dataToAdd['asset_mode'] = $this->input->post('asset_mode'); //0 = New, 1 == Damaged
       
       $this->db->insert('asset_warehouse', $dataToAdd);
       
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function getDamagedAssets() {
     //  $this->db->where('asset_mode',  1);
        $option = array();
        $option['asset_mode'] = 1;
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['DATE(created_at) <='] = $this->input->post('date_to');
            $option['DATE(created_at) >='] = $this->input->post('date_from');
        }
       $assets = $this->db->get_where('asset_warehouse', $option) -> result_array();
       
       foreach($assets as $key => $asset) {
           if(!empty($assent_name = $this->db->get_where('asset_type',array('id'=>$assets[$key]["asset_id"]))->row())){
               $assets[$key]['asset_name'] = $assent_name->asset_name;
               $assets[$key]['class_name'] = $this->db->get_where('class',array('class_id'=>$assets[$key]["class_id"]))->row()->name;
               $assets[$key]['section_name'] = $this->db->get_where('section', array('section_id' => $assets[$key]["section_id"]))->row()->name;
                $assets[$key]['hostel_name'] = @$this->db->get_where('hostels', array('id' => $assets[$key]["hostel_id"]))->row()->name;
               
            if($assets[$key]["room_id"]!=0){
            $assets[$key]['room_name'] = @$this->db->get_where('rooms', array('id' => $assets[$key]["room_id"]))->row()->room_no." (".$this->db->get_where('rooms', array('id' => $assets[$key]["room_id"]))->row()->room_type.")";
            }else{
                 $assets[$key]['room_name']="";
            }
            
           } else {
               unset($assets[$key]);
           }
       }
       $assets = array_values($assets);
       $data -> assets = $assets;
       $data -> message = "success";
       echo json_encode($data);
   }
   
   function getAllAssets() {
       $assets = $this->db->get('asset_warehouse') -> result_array();
       
       foreach($assets as $key => $asset) {
           $assets[$key]['asset_name'] = @$this->db->get_where('asset_type',array('id'=>$assets[$key]["asset_id"]))->row()->asset_name;
           $assets[$key]['class_name'] = $this->db->get_where('class',array('class_id'=>$assets[$key]["class_id"]))->row()->name;
           $assets[$key]['section_name'] = $this->db->get_where('section', array('section_id' => $assets[$key]["section_id"]))->row()->name;
       }
       
       $data -> assets = $assets;
       $data -> message = "success";
       echo json_encode($data);
   }
   
   //TRANSPORT
   
   function getVehicleTravelDetails() {
       $option  = array(
                        'usage_location'=> $this->input->post('type')
                    );
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['DATE(created_at) <='] = $this->input->post('date_to');
            $option['DATE(created_at) >='] = $this->input->post('date_from');
        } else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
            $session_year = explode('-',$session_year);
            $option['YEAR(created_at) >='] = $session_year[0];
            $option['YEAR(created_at) <='] = $session_year[1];
        }
       $travelled = $this->db->get_where('travelled', $option) -> result_array();
       
       $this->db->select_sum('diesel');
        $this->db->where('inventory_type','1');
        $useDiesel = $this->db->get('travelled')->row()->diesel;
        
        $this->db->select_sum('diesel');
        $this->db->where('inventory_type','2');
        $useMobil = $this->db->get('travelled')->row()->diesel; 
        
        $this->db->select_sum('name');
        $this->db->where('inventory_type','1');
        $totalDiesel = $this->db->get('inventory_travel')->row()->name;
       
        $this->db->select_sum('name');
        $this->db->where('inventory_type','2');
        $totalMobil = $this->db->get('inventory_travel')->row()->name; 
        
        $data['diesel_left'] = $totalDiesel - $useDiesel;
       $data['mobil_left'] = $totalMobil - $useMobil;
       $data['status'] = 'success';
       $data['travelled'] = $travelled;
       echo json_encode($data);
       
   }
   
   function addFuel() {
       // 1 -> Diesel
       // 2 -> Mobil Oaccoil
       $type = $this->input->post('type');
       $quantity = $this->input->post('quantity');
       $user_id = $this->input->post('user_id');
        $id = $this->input->post('id');
        $cost = $this->input->post('cost');
        if($id){
            $this->db->where('id',$id);
             $this->db->update('inventory_travel', array('inventory_type' => $type, 'name' => $quantity, 'status' => '1', 'created_by' => $user_id,'cost' => $cost));
 
        }else{
             $this->db->insert('inventory_travel', array('inventory_type' => $type, 'name' => $quantity, 'status' => '1', 'created_by' => $user_id,'cost' => $cost));
        }
       
       $data['status'] = "200";
       echo json_encode($data);
   }
   
   function getTravelInventory() {
       $option = array();
       if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['DATE(created_at) <='] = $this->input->post('date_to');
            $option['DATE(created_at) >='] = $this->input->post('date_from');
        }
       $inventory = $this->db->get_where('inventory_travel', $option) -> result_array();
       $data['status'] = "success";
       $data['travel_inventory'] = $inventory;
       echo json_encode($data);
   }
   
   function deleteTravelInventory() {
       $id = $this->input->post('inventory_id');
       $this->db->where('id', $id)->delete('inventory_travel');
       $data['status'] = "200";
       echo json_encode($data);
   }
   
   function addServiceExpenditure() {
       $vehicleId = $this->input->post('vehicle_id');
       $totalCost = $this->input->post('total_cost');
       $serviceDate = $this->input->post('service_date');
       $nextServiceDate = $this->input->post('next_service_date');
       $fitness = $this->input->post('fitness');
       $remark = $this->input->post('remark');
       $status = '1';
       
       $this->db->insert('vehicle_service', array('vehicle_no' => $vehicleId, 'total_cost' => $totalCost, 'service_date' => $serviceDate, 'next_service_date' => $nextServiceDate, 'fitness' => $fitness, 'remark' => $remark, 'status' => $status));
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function getTotalExpenditure() {
       $option  = array();
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['DATE(created_at) <='] = $this->input->post('date_to');
            $option['DATE(created_at) >='] = $this->input->post('date_from');
        } else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
            $session_year = explode('-',$session_year);
            $option['YEAR(created_at) >='] = $session_year[0];
            $option['YEAR(created_at) <='] = $session_year[1];
        }
       $expenditure = $this->db->get_where('vehicle_service',$option)->result_array();
       foreach($expenditure as $key => $exp) {
           $expenditure[$key]['vehicle_name'] = $this->db->get_where('vehicles', array('id' => $exp["vehicle_no"])) -> row() -> number;
       }
       $data['expenditure'] = $expenditure;
       $data['status'] = "success";
       echo json_encode($data);
   }
   
   function addEvent() {
            $data = $this->_get_posted_event_data();
            $role_id = $this->input->post('role_id');
                $array_images = $data['image'];
                unset($data['image']);
                if ($role_id == 'teacher-and-parents') {

                    //For Teacher
                    $data['role_id'] = $this->db->get_where('roles', array('slug' => "teacher")) -> row() -> id;
                    $insert_id    = $this->event->insert('events', $data);
				$date = date('d-m-Y');

		        $send_to_all = $this->input->post('send_to_all');

				$data2['event_id']  = $this->db->insert_id();
                for($i=0;$i<count($array_images);$i++) {
                  if($array_images[$i]) {
                    $data2['image'] = $array_images[$i].'';
                    $this->event->insert('event_images', $data2);
                  }
                }

                if ($insert_id) {

                    $send_to     = "";
                    $title       = $data['title'];
                	$role_id     = $data['role_id'];
    				$for_type    = 'event';
    				$class_id    = $data['class_id'];
    				$section_id  = $data['section_id'];
    				$event_place = $data['event_place'];
    				$event_from  = $data['event_from'];
    				$event_to    = $data['event_to'];
    				$note        = $this->input->post('note');
    				$send_to_all = $this->input->post('send_to_all');
    				$alert_type  = 'event';

				    if($role_id == 0){
				       $roles = $this->db->get_where('roles' , array('status' => '1'))->result();
				       foreach($roles as $role_val){
				           $arr_role[] = $role_val->id;
				       }
				      $arr_role = json_encode($arr_role);
				    }else{
				        $arr_role = $role_id;
				    }

                    if($send_to_all == 1){
                        $notification_msg  = $note;
                        $url               = "/notification?alert_type=event";
                        $send_role         = $arr_role;
                       // $this->add_notification($this->input->post('user_id'),1,$send_to,$send_role,$notification_msg,$title,$url,$for_type,$class_id,$section_id,$alert_type);
                    }
                 }

                 //For Parent
                 $data['role_id'] = $this->db->get_where('roles', array('slug' => "parent")) -> row() -> id;
                 $insert_id    = $this->event->insert('events', $data);
				$date = date('d-m-Y');

		        $send_to_all = $this->input->post('send_to_all');

				$data2['event_id']  = $this->db->insert_id();
                for($i=0;$i<count($array_images);$i++) {
                  if($array_images[$i]) {
                    $data2['image'] = $array_images[$i].'';
                    $this->event->insert('event_images', $data2);
                  }
                }

                if ($insert_id) {

                    $send_to     = "";
                    $title       = $data['title'];
                	$role_id     = $data['role_id'];
    				$for_type    = 'event';
    				$class_id    = $data['class_id'];
    				$section_id  = $data['section_id'];
    				$event_place = $data['event_place'];
    				$event_from  = $data['event_from'];
    				$event_to    = $data['event_to'];
    				$note        = $this->input->post('note');
    				$send_to_all = $this->input->post('send_to_all');
    				$alert_type  = 'event';

				    if($role_id == 0){
				       $roles = $this->db->get_where('roles' , array('status' => '1'))->result();
				       foreach($roles as $role_val){
				           $arr_role[] = $role_val->id;
				       }
				      $arr_role = json_encode($arr_role);
				    }else{
				        $arr_role = $role_id;
				    }

                    if($send_to_all == 1){
                        $notification_msg  = $note;
                        $url               = "/notification?alert_type=event";
                        $send_role         = $arr_role;
                       // $this->add_notification($this->input->post('user_id'),1,$send_to,$send_role,$notification_msg,$title,$url,$for_type,$class_id,$section_id,$alert_type);
                    }
                 }

                } else {
                    $data['role_id'] = $this->db->get_where('roles', array('slug' => $this->input->post('role_id'))) -> row() -> id;
                    $insert_id    = $this->event->insert('events', $data);
				$date = date('d-m-Y');

		        $send_to_all = $this->input->post('send_to_all');

				$data2['event_id']  = $this->db->insert_id();
                for($i=0;$i<count($array_images);$i++) {
                  if($array_images[$i]) {
                    $data2['image'] = $array_images[$i].'';
                    $this->event->insert('event_images', $data2);
                  }
                }

                if ($insert_id) {

                    $send_to     = "";
                    $title       = $data['title'];
                	$role_id     = $data['role_id'];
    				$for_type    = 'event';
    				$class_id    = $data['class_id'];
    				$section_id  = $data['section_id'];
    				$event_place = $data['event_place'];
    				$event_from  = $data['event_from'];
    				$event_to    = $data['event_to'];
    				$note        = $this->input->post('note');
    				$send_to_all = $this->input->post('send_to_all');
    				$alert_type  = 'event';

				    if($role_id == 0){
				       $roles = $this->db->get_where('roles' , array('status' => '1'))->result();
				       foreach($roles as $role_val){
				           $arr_role[] = $role_val->id;
				       }
				      $arr_role = json_encode($arr_role);
				    }else{
				        $arr_role = $role_id;
				    }

                    if($send_to_all == 1){
                        $notification_msg  = $note;
                        $url               = "/notification?alert_type=event";
                        $send_role         = $arr_role;
                       // $this->add_notification($this->input->post('user_id'),1,$send_to,$send_role,$notification_msg,$title,$url,$for_type,$class_id,$section_id,$alert_type);
                    }
                }
                }


                $data['status'] = 200;
                echo json_encode($data);
        }

   /*****************Function _get_posted_event_data**********************************
    * @type            : Function
    * @function name   : _get_posted_event_data
    * @description     : Prepare "event" user input data to save into database
    *
    * @param           : null
    * @return          : $data array(); value
    * ********************************************************** */
    private function _get_posted_event_data() {

        $items = array();
        $items[] = 'role_id';
        $items[] = 'title';
        $items[] = 'event_place';
        $items[] = 'note';
        $items[] = 'class_id';
        $items[] = 'section_id';
        $items[] = 'event_from';
        $items[] = 'event_to';
        $items[] = 'start_time';
        $items[] = 'end_time';

        $data = elements($items, $_POST);
        $data['event_from'] = date('Y-m-d', strtotime($this->input->post('event_from')));
        $data['event_to']   = date('Y-m-d', strtotime($this->input->post('event_to')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
        }

         $files = array();
         if ($_FILES['image1']) {
             array_push($files, $_FILES['image1']);
         }

         if ($_FILES['image2']) {
             array_push($files, $_FILES['image2']);
         }

         if ($_FILES['image3']) {
             array_push($files, $_FILES['image3']);
         }

         if ($_FILES['image4']) {
             array_push($files, $_FILES['image4']);
         }
        // print_r($files); die;
             $cpt = count($files);
                for($i=0; $i<$cpt; $i++)
                {
                  $data['image'][$i] = $this->_upload_event_image($i, $files);
                }


        return $data;
    }

    private function _upload_event_image($i, $files) {

        $prev_image   = $this->input->post('prev_image')[$i];
        $image        = $files[$i]['name'];
        $image_type   = $files[$i]['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'assets/uploads/event/';
                $file_type   = explode(".", $image);
                $extension   = strtolower($file_type[count($file_type) - 1]);
                $image_path  = 'event-' . time() .'-'.$i.'-sms.' . $extension;

                move_uploaded_file($files[$i]['tmp_name'], $destination . $image_path);

                // need to unlink previous image
                if ($prev_image != "") {
                    if (file_exists($destination . $prev_image)) {
                        @unlink($destination . $prev_image);
                    }
                }

                $return_image = $image_path;
            }
        } else {
            $return_image = $prev_image;
        }

        return $return_image;
    }

    function getSubAdminPrivilages() {
        $userId = $this->input->post('user_id');
        $privileges = $this->db->get_where('privileges', array('user_id' => $userId)) -> result_array();
        foreach($privileges as $key => $privilege) {
            $privileges[$key]['module_name'] = $this->db->get_where('modules', array('id' => $privilege['modules_id'])) -> row() -> module_name;
        }

        $data['status'] = 200;
        $data['privileges'] = $privileges;
        echo json_encode($data);
    }
    
    function addHoliday() {
        $title = $this->input->post('title');
        $date = $this->input->post('date');

        $query = $this->db->insert('holiday_leave', array('title' => $title, 'date' => $date));

        if($query) {
            $data['status'] = 200;
        } else {
            $data['status'] = 401;
        }
        echo json_encode($data);
    }
    
    function deleteHoliday(){
        $id = $this->input->post('id');
        $this->db->delete('holiday_leave', array('id' => $id));
        if($query) {
            $data['status'] = 200;
        } else {
            $data['status'] = 401;
        }
         echo json_encode($data);
    }
    function deleteEvent(){
        $id = $this->input->post('id');
        $this->db->delete('events', array('id' => $id));
        if($query) {
            $data['status'] = 200;
        } else {
            $data['status'] = 401;
        }
         echo json_encode($data);
    }
    
    
    function generateInvoice(){
            $response = array();
            $this->_prepare_invoice_validation();
            if ($this->form_validation->run() === TRUE) {
                $_POST['amount'] = $_POST['total_fee'];
                $data      = $this->_get_posted_invoice_data();
                $data['invoice_type']='student';
                $insert_id = $this->invoice->insert('invoices', $data);
                if ($insert_id) { 
                    // save transction table data
                    $data['invoice_id'] = $insert_id;
                    $this->_save_transaction($data);
                    $response['invoice'] = $data;
                    $response['status'] = 200;
                } else {
                    $response['status'] = 401;
                }
            } else {
                    $response['status'] = 401;
                    $response['error'] = strip_tags(validation_errors());
            }
            echo json_encode($response);
    }
    
    private function _prepare_invoice_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required'); 
        $this->form_validation->set_rules('paid_status', $this->lang->line('paid').' '.$this->lang->line('status'), 'trim|required'); 
        if($this->input->post('type')== 'single'){
            $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required'); 
        }
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required');          
    }
    
     private function _get_posted_invoice_data() {

        $items = array();
        $items[] = 'class_id';
        $items[] = 'student_id';
        // $items[] = 'is_applicable_discount';  
        $items[] = 'month';        
        $items[] = 'paid_status';        
        $items[] = 'note';
        $items[] = 'admission_fee';
        $items[] = 'tution_fee';
        $items[] = 'book_fee';
        $items[] = 'dress_fee';  
        $items[] = 'education_fee';        
        $items[] = 'event_fee';   
        $items[] = 'total_fee';
        $items[] = 'hostel_fee';
        
        $data = elements($items, $_POST); 
        $income_head = $this->invoice->get_single('income_heads', array('id' => $this->input->post('income_head_id')));
        $data['discount']     = $this->input->post('discount')?:0;
        $data['gross_amount'] = $this->input->post('amount') + $this->input->post('discount');
        $data['net_amount']   = $this->input->post('amount');
        
        $data['date'] = date('Y-m-d');
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['custom_invoice_id'] = $this->invoice->get_custom_id('invoices', 'INV');            
            $data['status']            = 1;
            $data['invoice_type']      = $income_head->head_type;
            $data['year']              = $this->invoice->running_year();
            $data['created_at']        = date('Y-m-d H:i:s');
            $data['created_by']        = $this->input->post('user_id');                       
        }        
        return $data;
    }
    
     private function _save_transaction($data){
        
        if($data['paid_status'] == 'paid'){
        
            $txn = array();
			
            $txn['amount'] = $data['net_amount'];  
            $txn['note'] = $data['note'];
            $txn['payment_date'] = $data['date'];
            $txn['payment_method'] = $this->input->post('payment_method');
            $links      = array();
            $arraybank = $this->input->post('bank_name');
            $arraycheck = $this->input->post('cheque_no');
          
            $txn['bank_name']   =  $arraybank;
            $txn['cheque_no']   =  $arraycheck;
            if ($this->input->post('id')) {

                $txn['modified_at'] = date('Y-m-d H:i:s');
                $txn['modified_by'] = $this->input->post('user_id');    
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
    
   public function getFeePaidClassWise(){
        $data = array();
        $this->load->library('session');
        if(!empty($this->input->post('sessional_year'))){
            $session_year = $this->input->post('sessional_year');
        }else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
        }
        $data['status'] = 200;
        $data['fee_paid'] = $this->invoice->get_invoice_list(null, $this->input->post('class_id'), $this->input->post('month'),$session_year,$this->input->post('section_id'));
        echo json_encode($data);
    }
    
    public function getFeeUnpaidClassWise(){
        $data = array();
        $this->load->library('session');
        if(!empty($this->input->post('sessional_year'))){
            $session_year = $this->input->post('sessional_year');
        }else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
        }
        $data['status'] = 200;
        $data['fee_unpaid'] = $this->invoice->get_invoice_list(true, $this->input->post('class_id'), $this->input->post('month'),$session_year,$this->input->post('section_id'));
        echo json_encode($data);
    }
    
    public function totalFeeDeposited(){
        $this->load->library('session');
        $data = array();
        $data['status'] = 200;
        $data['invoices']     = $this->invoice->get_invoice_list(); 
        $sum = $this->db->query('SELECT SUM(net_amount) as sum FROM `invoices`')->result_array(); 
        $data['total_amount'] = $sum[0]['sum'];
        echo json_encode($data);
    }
    
    public function createExpenditureHead(){
        $this->_prepare_exphead_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_exphead_data();

            $insert_id = $this->exphead->insert('expenditure_heads', $data);
            if ($insert_id) {
                
                $response['status'] = 200;
                $response['expenditure'] = $data;
            } else {
                $response['status'] = 401;
            }
        } else {
            $response['status'] = 401;
            $response['error'] = strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    
    private function _prepare_exphead_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', $this->lang->line('user_id'), 'trim|required');
        $this->form_validation->set_rules('title', $this->lang->line('expenditure_head'), 'trim|required|callback_title');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
    
    public function title()
   {             
      if($this->input->post('id') == '')
      {   
          $exphead = $this->exphead->duplicate_check('title',$this->input->post('title')); 
          if($exphead){
                $this->form_validation->set_message('title',  $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $exphead = $this->exphead->duplicate_check('title',$this->input->post('title'), $this->input->post('id')); 
          if($exphead){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }
    
    private function _get_posted_exphead_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');                    
        }

        return $data;
    }
    
    public function getExpanseReport(){
        $data['status'] = 200;
        if(!empty($this->input->post('sessional_year'))){
            $session_year = $this->input->post('sessional_year');
        }else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
        }
        
        $session_year = explode('-',$session_year);
        $this->db->select('E.*, H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('YEAR(date) >=', $session_year[0]);
        $this->db->where('YEAR(date) <=', $session_year[1]);
     
        $data['expenditures'] = $this->db->get()->result();  
        echo json_encode($data);
    }
    
    public function getPaidSalary(){
        $data = array();
        $key = 0;
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $datefrm = str_replace("'","",$this->input->post('date_to'));
            $dateto = str_replace("'","",$this->input->post('date_from'));
        }else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
                            $session_year = explode('-',$session_year);
                            $datefrm = $session_year[0].'-01-01';
                            $dateto = $session_year[1].'-12-31';
        }
        if(!empty($this->input->post('designation_id'))){
            $this->db->where('id',$this->input->post('designation_id'));
        }
        $designations = $this->db->get_where('designations')->result_array();
        foreach($designations as $desg){


            $class_id = $desg['id'];
            $designations_name = $desg['name'];
            $primary_id = lcfirst($designations_name)."_id";
    
            if (!$this->db->table_exists(lcfirst($designations_name))){
                continue;
            }
            $this->db->select('*');
            $this->db->from(lcfirst($designations_name));
            $query = $this->db->get()->result_array();
            foreach ($query as $val){
                $total_salary_status = $this->db->query("SELECT * FROM employee_total_salary WHERE status=0 AND `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                if($total_salary_status[0]['status'] == '0') {
                    $data[$key]['user_id'] = $val[$primary_id];
                    $data[$key]['designation_id'] = $class_id;
                    $data[$key]['Name'] =   $val['name'];
                    $data[$key]['POST'] =   $designations_name;
                    $data[$key]['DOJ'] =   $val['doj'];
                    $data[$key]['Contact_No'] =   $val['phone'];
                    $salary = $this->db->get_where('salary_grades', array('id' => $this->db->get_where('employees',['id'=>$val[$primary_id]])->row()->salary_grade_id))->result_array();
                    $data[$key]['Monthly_Salary'] =   $salary[0]['net_salary'];
                    $total_advance = $this->db->query("SELECT * ,SUM(amount) as total FROM advance_pay WHERE `date` BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                    $data[$key]['Total_Advance_Payment'] =   (int)$total_advance[0]['total'];
                    $total_present = $this->db->query("SELECT Count(status) as present FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '1'")->result_array();
                    $data[$key]['No_of_Present'] =   $total_present[0]['present'];
                    $total_absent = $this->db->query("SELECT Count(status) as absent FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '0'")->result_array();
                    $data[$key]['No_of_Absent'] =   $total_absent[0]['absent'];
                    $dateElements = explode('-', $total_salary_status[0]['date']);
                    $year = $dateElements[0];
                    $month=$dateElements[1];
                    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    $data[$key]['Total_Number_of_days_In_Month'] =   $number_of_days;
                    $time1=strtotime($datefrm);
                    $month1=date("m",$time1);
                    $year1=date("Y",$time1);
                    $total_salary = $this->db->query("SELECT * FROM employee_total_salary WHERE MONTH(`date`) = '$month1' AND YEAR(`date`) = '$year1'  AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                    $data[$key]['Total_Payable_Monthly_Salary'] =   (int)$total_salary[0]['total_salary'];
                    $key++;
                } 
            }
           
       }
       $response = array();
       $response['status'] = 200;
       $response['paid_salary'] = $data;
       echo json_encode($response);
       
    }
    
    public function getUnpaidSalary(){
        $data = array();
        $key = 0;
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $datefrm = str_replace("'","",$this->input->post('date_to'));
            $dateto = str_replace("'","",$this->input->post('date_from'));
        }else {
            $session_year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
                            $session_year = explode('-',$session_year);
                            $datefrm = $session_year[0].'-01-01';
                            $dateto = $session_year[1].'-12-31';
        }
        if(!empty($this->input->post('designation_id'))){
            $this->db->where('id',$this->input->post('designation_id'));
        }
        $designations = $this->db->get_where('designations')->result_array();
        foreach($designations as $desg){


            $class_id = $desg['id'];
            $designations_name = $desg['name'];
            $primary_id = lcfirst($designations_name)."_id";
    
            if (!$this->db->table_exists(lcfirst($designations_name))){
                continue;
            }
            $this->db->select('*');
            $this->db->from(lcfirst($designations_name));
            $query = $this->db->get()->result_array();
            foreach ($query as $val){
                $total_salary_status = $this->db->query("SELECT * FROM employee_total_salary WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                if(empty($total_salary_status) || $total_salary_status[0]['status'] == '1') {
                    $data[$key]['Name'] =   $val['name'];
                    $data[$key]['user_id'] = $val[$primary_id];
                    $data[$key]['designation_id'] = $class_id;
                    $data[$key]['POST'] =   $designations_name;
                    $data[$key]['DOJ'] =   (string)$val['doj'];
                    $data[$key]['Contact_No'] =   $val['phone'];
                    $salary = $this->db->get_where('salary_grades', array('id' => $this->db->get_where('employees',['id'=>$val[$primary_id]])->row()->salary_grade_id))->result_array();
                    $data[$key]['Monthly_Salary'] =   (int)$salary[0]['net_salary'];
                    $total_advance = $this->db->query("SELECT * ,SUM(amount) as total FROM advance_pay WHERE `date` BETWEEN '$datefrm' AND '$dateto' AND designation_id ='$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                    $data[$key]['Total_Advance_Payment'] =   (int)$total_advance[0]['total'];
                    $total_present = $this->db->query("SELECT Count(status) as present FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '1'")->result_array();
                    $data[$key]['No_of_Present'] =   $total_present[0]['present'];
                    $total_absent = $this->db->query("SELECT Count(status) as absent FROM attendance_employee WHERE `date`  BETWEEN '$datefrm' AND '$dateto' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]' AND status = '0'")->result_array();
                    $data[$key]['No_of_Absent'] =   $total_absent[0]['absent'];
                    if(empty($total_salary_status)){
                        $dateElements=strtotime($datefrm);
                        $month=date("m",$dateElements);
                        $year=date("Y",$dateElements);
                    }else{
                        $dateElements = explode('-', $total_salary_status[0]['date']);
                        $year = $dateElements[0];
                        $month=$dateElements[1];
                    }
                    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    $data[$key]['Total_Number_of_days_In_Month'] =   (int)$number_of_days;
                    $time1=strtotime($datefrm);
                    $month1=date("m",$time1);
                    $year1=date("Y",$time1);
                    $total_salary = $this->db->query("SELECT * FROM employee_total_salary WHERE MONTH(`date`) = '$month1' AND YEAR(`date`) = '$year1' AND designation_id = '$class_id' AND employee_id = '$val[$primary_id]'")->result_array();
                    $data[$key]['Total_Payable_Monthly_Salary'] =   (int)$total_salary[0]['total_salary'];
                    $key++;
                } 
            }
           
       }
       $response = array();
       $response['status'] = 200;
       $response['unpaid_salary'] = $data;
       echo json_encode($response);
       
    }
    
    public function getUnPaidIndividual(){
        $user_id=$this->input->post("user_id");
        $this->db->where('employee_id',$user_id);
        $query = $this->db->get("employee_total_salary")->result_array();
        $response = array();
       $response['status'] = 200;
       $response['data'] = $query;
       echo json_encode($response);
        
    }
    
    public function addAdvancePayment(){
        $response = array();
        $this->form_validation->set_rules('designation_id', 'designation_id', 'trim|required');
        if($this->form_validation->run() === TRUE){
            $attn_data['designation_id']   = $this->input->post('designation_id');
            $attn_data['date']  = $this->input->post('date');
            $attn_data['amount']  = $this->input->post('amount');
            $attn_data['employee_id'] = $this->input->post('employee_id');
            $this->db->insert('advance_pay', $attn_data);
            $response['advance_payment'] = $attn_data;
            $response['status'] = 200;
                
        }else{
            $response['status'] = 401;
            $response['error'] = strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    
    public function getAdvancePayment(){
        $option = array();
         if(!empty($this->input->post('designation_id'))){
            $option['designation_id'] = $this->input->post('designation_id');
        }
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['DATE(date) <='] = $this->input->post('date_to');
            $option['DATE(date) >='] = $this->input->post('date_from');
        }
        $response['status'] = 200;
        $data = $this->db->get_where('advance_pay',$option)->result_array();
        foreach($data as $key => $value){
            $this->db->select('*');
            $this->db->from('designations');
            $this->db->where('id', $value['designation_id']);
            $designation = $this->db->get()->row();
            if(!empty($designation)){
                $primary_id = lcfirst($designation->name)."_id";
                $designations_data = $this->db->get(lcfirst($designation->name),[$primary_id=>$value['employee_id']])->row();
                $data[$key]['employee_name'] = $designations_data->name;
            } else {
                $data[$key]['employee_name'] = '';
            }
        }
        
        $response['advance_payment'] = $data;
        echo json_encode($response);
    }
    
    function getClassSubjectsForTeacher() {
        $teacher_id = $this->input->post('teacher_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $subjects = $this->db->get_where('class_routine', array('teacher_id' => $teacher_id, 'class_id' => $class_id, 'section_id' => $section_id)) -> result_array();

        $subjectIds = array();
        foreach($subjects as $key => $subject) {
            array_push($subjectIds, $subject['subject_id']);
        }

        $finalSubjects = array();
        if ($subjectIds) {
            $this->db->select('*');
            $this->db->from('subject');
            $this->db->where_in('subject_id', $subjectIds);
            $finalSubjects = $this->db->get()->result_array();
        }


        echo json_encode($finalSubjects);
    }
    
    public function addAssignment(){
        $response = array();
        $this->_prepare_assignment_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_assignment_data();

            $insert_id = $this->assignment->insert('assignments', $data);
            if ($insert_id) {
                
                create_log('Has been created an assignment : '.$data['title']);   
                $response['assignment'] = $data;
                $response['status'] = 200;
            } else {
                 $response['status'] = 401;
            }
        } else {
            $response['status'] = 401;
            $response['error'] = strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    
    public function addIndividualAssignment(){
        $response = array();
        $this->_prepare_assignment_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_assignment_data();

            $insert_id = $this->assignment_individual->insert('assignments_individual', $data);
            if ($insert_id) {
                
                create_log('Has been created an assignment : '.$data['title']);   
                
                $response['individual_assignment'] = $data;
                $response['status'] = 200;
            } else {
                $response['status'] = 401;
            }
        } else {
            $response['status'] = 401;
            $response['error'] = strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    
    private function _prepare_assignment_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', $this->lang->line('assignment') . ' ' . $this->lang->line('title'), 'trim|required');
        
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        $this->form_validation->set_rules('subject_id', $this->lang->line('subject'), 'trim|required');
        $this->form_validation->set_rules('deadline', 'deadline', 'trim|required');
        $this->form_validation->set_rules('assignment_marks', 'assignment_mark', 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
        $this->form_validation->set_rules('assignment', $this->lang->line('assignment'), 'trim|callback_assignment');
    }
    
    public function assignment() {

        if ($this->input->post('id')) {

            if ($_FILES['assignment']['name']) {
                $name = $_FILES['assignment']['name'];
                $arr = explode('.', $name);
                $ext = end($arr);
                if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'txt') {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('assignment', $this->lang->line('select_valid_file_format'));
                    return FALSE;
                }
            }
        } else {

            if ($_FILES['assignment']['name']) {                
           
                $name = $_FILES['assignment']['name'];
                $arr = explode('.', $name);
                $ext = end($arr);
                if ($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'txt') {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('assignment', $this->lang->line('select_valid_file_format'));
                    return FALSE;
                }
            }
        }
    }
    
    private function _get_posted_assignment_data() {

        $items = array();
        $items[] = 'class_id';
        $items[] = 'subject_id';
        $items[] = 'title';
        $items[] = 'note';
        $items[] = 'assignment_marks';

        $data = elements($items, $_POST);

       /* $sectionval = $this->input->post('section_id');
        $section_arr= array();
        foreach ($sectionval as $key => $dt) {
             $section_arr[] = $dt;
        }
        $section_implode =  implode(',', $section_arr);
        $data['section_id'] = $section_implode;*/
        //MY CODE BISHWA
         $data['section_id'] =  $this->input->post('section_id');
        //END

        $data['deadline'] = date('Y-m-d', strtotime($this->input->post('deadline')));
        $data['student_id'] = $this->input->post('student_id');

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $data['year'] = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;
        }


        if ($_FILES['assignment']['name']) {
            $data['assignment'] = $this->_upload_assignment();
        }

        return $data;
    }
    
    public function getIndividualAssignment(){
        $data = array();
        $data['status'] = 200;
        $data['individual_assignment'] = $this->assignment_individual->get_assignments_by_class_and_section_student(); 
        echo json_encode($data);
    }
    
    private function _upload_assignment() {

        $prev_assignment = $this->input->post('prev_assignment');
        $assignment = $_FILES['assignment']['name'];
        $assignment_type = $_FILES['assignment']['type'];
        $return_assignment = '';

        if ($assignment != "") {
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            if ($assignment_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    $assignment_type == 'application/msword' || $assignment_type == 'text/plain' ||
                    $assignment_type == 'application/vnd.ms-office' || $assignment_type == 'application/pdf' ||$assignment_type == 'image/jpeg' || $assignment_type == 'image/png'|| in_array($assignment_type, $allowedTypes) ) {

                $destination = 'assets/uploads/assignment/';

                $assignment_type = explode(".", $assignment);
                $extension = strtolower($assignment_type[count($assignment_type) - 1]);
                $assignment_path = 'assignment-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['assignment']['tmp_name'], $destination . $assignment_path);

                // need to unlink previous assignment
                if ($prev_assignment != "") {
                    if (file_exists($destination . $prev_assignment)) {
                        @unlink($destination . $prev_assignment);
                    }
                }

                $return_assignment = $assignment_path;
            }
        } else {
            $return_assignment = $prev_assignment;
        }

        return $return_assignment;
    }
    
    public function getStudentDetails(){
        $response = array();
        $student_details = array();
        $response['status'] = 200;
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $this->db->select('*');
         $this->db->where('year',$running_year);
        if(!empty($class_id = $this->input->post('class_id'))){
            $this->db->where('class_id',$class_id);
        }
        if(!empty($section_id = $this->input->post('section_id'))){
            $this->db->where('section_id',$section_id);
        }
        $this->db->from('enroll');
        $students     =  $query = $this->db->get()->result_array();
        
        foreach ($students as $row) {
            $data['student_id']  = $row['student_id'];
            $data['roll']        = $row['roll'];
            $data['name']        = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $data['birthday']    = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->birthday;
            $data['gender']      = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->sex;
            $data['address']     = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->address;
            $data['phone']       = @$this->db->get_where('student', array( 
                'student_id' => $row['student_id']
            ))->row()->phone;
            $data['email']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->email;
            $data['status']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->status;
            $data['class']       = @$this->db->get_where('class', array(
                'class_id' => $row['class_id']
            ))->row()->name;
              $data['student_code']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->student_code;
            $data['section']     = @$this->db->get_where('section', array(
                'section_id' => $row['section_id']
            ))->row()->name;
            
            $parent_id           = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->parent_id;

            $parent_name = $this->db->get_where('parent', array(
                'parent_id' => $parent_id))->row();
            if ($parent_name) {
                $data['parent_name'] = $this->db->get_where('parent', array(
                    'parent_id' => $parent_id))->row()->name;
            }
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            array_push($student_details, $data);
        }
        $response['student_details'] = $student_details;
        echo json_encode($response);
    }
    
       public function getStudentDetailsByClass(){
        $response = array();
        $student_details = array();
        $response['status'] = 200;
        $running_year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
        $this->db->select('*');
         $this->db->where('year',$running_year);
        if(!empty($class_id = $this->input->post('class_id'))){
            $this->db->where('class_id',$class_id);
        }
      
        $this->db->from('enroll');
        $students     =  $query = $this->db->get()->result_array();
        
        foreach ($students as $row) {
            $data['student_id']  = $row['student_id'];
            $data['roll']        = $row['roll'];
            $data['name']        = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->name;
            $data['birthday']    = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->birthday;
            $data['gender']      = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->sex;
            $data['address']     = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->address;
            $data['phone']       = @$this->db->get_where('student', array( 
                'student_id' => $row['student_id']
            ))->row()->phone;
            $data['email']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->email;
            $data['status']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->status;
            $data['class']       = @$this->db->get_where('class', array(
                'class_id' => $row['class_id']
            ))->row()->name;
           $data['student_code']       = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->student_code;
            
            $parent_id           = @$this->db->get_where('student', array(
                'student_id' => $row['student_id']
            ))->row()->parent_id;

            $parent_name = $this->db->get_where('parent', array(
                'parent_id' => $parent_id))->row();
            if ($parent_name) {
                $data['parent_name'] = $this->db->get_where('parent', array(
                    'parent_id' => $parent_id))->row()->name;
            }
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            array_push($student_details, $data);
        }
        $response['student_details'] = $student_details;
        echo json_encode($response);
    }
    
    public function addNotice(){
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['show_on_website']  = $this->input->post('show_on_website');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            if ($_FILES['image']['name'] != '') {
              $data['image']  = $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/frontend/noticeboard/'. $_FILES['image']['name']);
            }
            $this->db->insert('noticeboard', $data);
                $date = date('d-m-Y');
                
                $data_notics['title'] = 'New Notice ' .$date;
                $data_notics['create_by_role'] = 1;
                $data_notics['create_user_id'] = 1;
                $data_notics['status'] = 1;
                $data_notics['msg'] = 'New Notice name '  .$data['notice_title'];
                $send_to_all =$this->input->post('send_to_all');
              if($send_to_all==1){
                 $this->db->insert('notification_alert', $data_notics);
              }
              $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            echo json_encode(['status'=>200]);
    }
    
    public function getLatestApp(){
        // $this->super_db  = $this->load->database('super_admin', TRUE);
        $data['latest_update'] = $this->db->query("SELECT * FROM ijyawebc_super_admin.app WHERE type='android' ORDER BY created DESC LIMIT 1 ")->row();
        $data['status'] = 200;
        echo json_encode($data);
    }
    
    public function getSchoolDetails(){
        $school_details=array();
         $details = $this->db->get('settings')->result_array();
         // echo json_encode($details);
          for($i=0;$i<sizeof($details);$i++){
             if($details[$i]['type']=="address"){
                   $data[$details[$i]['type']]=$details[$i]['description'];
                   array_push($school_details,$data);
             }
             if($details[$i]['type']=="latitude"){
                   $data[$details[$i]['type']]=$details[$i]['description'];
                   array_push($school_details,$data);
             }
             if($details[$i]['type']=="longitude"){
                   $data[$details[$i]['type']]=$details[$i]['description'];
                   array_push($school_details,$data);
             }
          }
           echo json_encode(['status'=>200,'data'=>$school_details[2]]);
         
    }
    
    function getStaff(){
        $staffData = array();
        if($this->input->post('designation_id')){
            $this->db->select('*');
            $this->db->from('designations');
            $this->db->where('id', $this->input->post('designation_id'));
            $designations = $this->db->get()->result_array();
        } else {
            $designations = $this->db->get('designations')->result_array();
        }
        
        foreach($designations as $designation){
            $designations_name = $designation['name'];
            if(!$this->db->table_exists(lcfirst($designations_name))){
                continue;
            }
            $designations_data = $this->db->get(lcfirst($designations_name))->result_array();
            $primary_id = lcfirst($designations_name)."_id";
            foreach($designations_data as $row){
                if($this->input->post('timestamp')){
                    $attendanceDetails = $this->db->get_where('attendance_employee' ,array(
                        'timestamp' => strtotime($this->input->post('timestamp')),
                        'employee_id' => $row[$primary_id],
                        'designation_id' => $designation['id']
                    ))->row();
                    if(!empty($attendanceDetails)){
                        $staffData[] = ['id' => $row[$primary_id], 'attendance' => $attendanceDetails->status ] + $row;
                    }else{
                        $staffData[] = ['id' => $row[$primary_id], 'attendance' => "0" ] + $row;
                    }
                } else {
                    $staffData[] = ['id' => $row[$primary_id], 'attendance' => "0" ] + $row;
                }
                
            }
             
        }
        echo json_encode($staffData);
    }
    
    function markEmployeeAttendance(){
        $this->form_validation->set_rules('timestamp', 'timestamp', 'trim|required');
       // $this->form_validation->set_rules('designation_id', 'designation_id', 'trim|required');
        $this->form_validation->set_rules('employee_id', 'employee_id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        if($this->form_validation->run() === TRUE){
            /*$attendanceExist = $this->db->get_where('attendance_employee' ,array(
                       'timestamp' => strtotime($this->input->post('timestamp')),
                        'employee_id' => $row[$primary_id],
                        'designation_id' => $designation['id']
                        ));*/
                      
                    if(!$this->input->post('designation_id')){
                        $designation_id=$this->db->get_where('employees',array('id' => $this->input->post('employee_id')))->row()->designation_id;
                    }else{
                        $designation_id=$this->input->post('designation_id');
                    }
                $timestamp = strtotime($this->input->post('timestamp'));
                $attendanceExist = $this->db->get_where('attendance_employee', array('timestamp' => $timestamp, 'employee_id' => $this->input->post('employee_id'), 'designation_id' =>$designation_id));
    
             if($attendanceExist->num_rows() < 1){
                $attn_data['status'] = $this->input->post('status');
                $attn_data['attendence_by'] = $this->input->post('attendance_by');
                $attn_data['designation_id']   = $designation_id;
                $attn_data['timestamp']  = strtotime($this->input->post('timestamp'));
                $attn_data['date']  = date('Y-m-d',strtotime($this->input->post('timestamp')));
                $attn_data['employee_id'] = $this->input->post('employee_id');
                $this->db->insert('attendance_employee' , $attn_data);
            } else {
                $this->db->where('attendance_id',$attendanceExist->row()->attendance_id);
                $this->db->update('attendance_employee',['status'=> $this->input->post('status')]);   
            }
            $data = array('status'=>200);
        } else {
            $data = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($data);
    }
    
    function getEmployeeAttendance(){
        $option = array();
        if(!empty($this->input->post('designation_id'))){
            $option['designation_id'] = $this->input->post('designation_id');
        }
        if(!empty($this->input->post('attendence_by'))){
            $option['attendence_by'] = $this->input->post('attendence_by');
        }
        if(!empty($this->input->post('employee_id'))){
            $option['employee_id'] = $this->input->post('employee_id');
        }
        if(!empty($this->input->post('date'))){
            $option['date'] = $this->input->post('date');
        }
        echo json_encode($this->db->get_where('attendance_employee' ,$option)->result_array());
    }
    
    function addFuelAvaibility(){
        $this->form_validation->set_rules('inventory_type', 'Inventory type', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('user_id', 'User Id is required', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $data['name'] = $this->input->post('quantity');
            $data['inventory_type'] = $this->input->post('inventory_type');
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d');
            $data['created_by'] = $this->input->post('user_id');
            $insert_id = $this->inventory->insert('inventory_travel', $data);
            if ($insert_id) {
                $response['status'] = 200;
            } else {
                $response['status'] = 401;
            }
        } else {
            $response['status'] = 401;
            $response['error'] = strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    function getExpenditureOnService(){
            $option  = array(
                            'status'=> 1
                        );
            if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
                $option['DATE(created_at) >='] = $this->input->post('date_to');
                $option['DATE(created_at) <='] = $this->input->post('date_from');
            } else {
                $session_year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
                $session_year = explode('-',$session_year);
                $option['YEAR(created_at) >='] = $session_year[0];
                $option['YEAR(created_at) <='] = $session_year[1];
            }
            $data_vehicle = $this->db->get_where('vehicle_service' ,$option)->result_array();
            $response_data = array();
            foreach ($data_vehicle as $val){
                $data = array();
                $data['serial_number'] = $val['id'];
                $data['date'] = $val['created_at'];
                $data['month'] = date('F',strtotime($val['created_at']));
                $data['year'] = explode('-', $val['created_at'])[0];
                $data['vehicle_number'] = $val['vehicle_no'];
                $data['service_date'] = $val['service_date'];
                $data['total_expenditure'] = $val['total_cost'];
                $data['next_service_date'] = $val['next_service_date'];
                $data['remarks'] = $val['remark'];
                $data['fitness'] = $val['fitness'];
                array_push($response_data,$data);
            }
            echo json_encode(['status'=>200,'data'=>$response_data]);
    }
    
    function getTotalDistanceTravelledByBus(){
            $option  = array(
                            'inventory_type'=> 1
                        );
            if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
                $option['DATE(created_at) >='] = $this->input->post('date_to');
                $option['DATE(created_at) <='] = $this->input->post('date_from');
            } else {
                $session_year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
                $session_year = explode('-',$session_year);
                $option['YEAR(created_at) >='] = $session_year[0];
                $option['YEAR(created_at) <='] = $session_year[1];
            }
            $datas = $this->db->get_where('travelled' ,$option)->result_array();
            $response_data = array();
            
            foreach ($datas as $val){
                $data = array();
                $data['serial_number'] = $val['id'];
                $data['date'] = $val['created_at'];
                $data['month'] = date('F',strtotime($val['created_at']));
                $data['year'] = explode('-', $val['created_at'])[0];
                $data['vehicle_number'] = $val['vehicle_no'];
                $data['start_run'] = $val['start_km'];
                $data['end_run'] = $val['end_km'];
                $data['total_run'] = $val['total_distance'];
                $data['need_to_be_filed'] = $val['cash'];
                $data['total_advanced_payment'] = (int)$val['advanced_payment'];
                $data['status'] = ($val['cash']!='' && is_numeric($val['cash']))?'PAID':'UNPAID';
                array_push($response_data,$data);
            }
            echo json_encode(['status'=>200,'data'=>$response_data]);

    }
    
    function addVehicleTravelledDetails(){
            $this->form_validation->set_rules('vehicle_no', 'Vehicle number' , 'trim|required');
            $this->form_validation->set_rules('start_km', 'Start km', 'trim|required');
            $this->form_validation->set_rules('end_km', 'End km', 'trim|required');
            $this->form_validation->set_rules('total_distance', 'Total distance', 'trim|required');
            $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_travel_data();
                $insert_id = $this->vehicle->insert('travelled', $data);
                if ($insert_id) {
                    $data = array('status' => 200);
                } else {
                    $data = array('status' => 400);
                }
            } else {
                $data = array(
                    'status' => 400,
                    'error' => strip_tags(validation_errors())
                );
            }
            echo json_encode($data);
    }
    
    function _get_posted_travel_data(){
        $items = array();
        $items[] = 'vehicle_no';
        $items[] = 'end_km';
        $items[] = 'start_km';
        $items[] = 'total_distance';
        $items[] = 'created_at';
        $items[] = 'cash';
        $items[] = 'diesel';
        $items[] = 'vehicle_damage';
        $items[] = 'vehicle_repairing';

        $data = elements($items, $_POST);

        $data['vehicle_no'] = $this->input->post('vehicle_no');
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['start_km'] = $this->input->post('start_km');
        $data['end_km'] = $this->input->post('end_km');
        $data['total_distance'] = $this->input->post('total_distance');
        $data['cash'] = $this->input->post('cash');
        $data['diesel'] = $this->input->post('diesel');
        $data['inventory_type'] = $this->input->post('inventory_type');
        $data['usage_location'] = $this->input->post('usage_location');
        $data['vehicle_damage'] = $this->input->post('vehicle_damage');
        $data['vehicle_repairing'] = $this->input->post('vehicle_repairing');
        $data['advanced_payment'] = $this->input->post('advanced_payment');
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->input->post('user_id');
        return $data;
    }
    function getSchoolExpensesReport(){
        $option  = array(
                        'payment_type' => 'expense'
                    );
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option['timestamp >='] = strtotime($this->input->post('date_to'));
            $option['timestamp <='] = strtotime($this->input->post('date_from'));
        } else {
            // $session_year = $this->db->get_where('settings', array(
            //                     'type' => 'running_year'
            //                 ))->row()->description;
            // $session_year = explode('-',$session_year);
            // $option['YEAR(timestamp) >='] = $session_year[0];
            // $option['YEAR(timestamp) <='] = $session_year[1];
        }
        $datas = $this->db->get_where('payment' ,$option)->result();
        $response_data = array();
        
        foreach ($datas as $row){
            if ($row->method == 1){
                $method = 'Cash';
            } else if ($row->method == 2){
                $method = 'Cheque';
            }else {
                $method = 'Card';
            }
            $nestedData = array();
            $nestedData['payment_id'] = $row->payment_id;
            $nestedData['title'] = $row->title;
            $nestedData['category'] = $category;
            $nestedData['method'] = $method;
            $nestedData['amount'] = $row->amount;
            $nestedData['date'] = date('d M,Y', $row->timestamp);
            array_push($response_data,$nestedData);
        }
        echo json_encode(['status'=>200,'data'=>$response_data]);
    }
    
    function addExam(){
        $this->form_validation->set_rules('name', 'name' , 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');
        $this->form_validation->set_rules('deadline', 'deadline', 'trim|required');
        $this->form_validation->set_rules('marks_submission', 'marks_submission', 'trim|required');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['deadline']= $this->input->post('deadline');
            $data['marks_submission']= $this->input->post('marks_submission');
            $data['year']    = $this->year;
    
            $notification_msg  = 'Add Question paper deadline OR marks submission Date.';
            $url               = json_encode(array('teacher/question_paper')); 
            $send_role         = json_encode(array(TEACHER));
            $this->add_notification($this->input->post('user_id'),1,$send_to,$send_role,$notification_msg,'question paper and marks/grades submission',$url);
    
    
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            if(!empty($this->input->post('id'))){
                $insert_id = $this->db->update('exam', $data,['exam_id'=>$this->input->post('id')]);
            }else {
                $insert_id = $this->db->insert('exam', $data);
            }
            if($insert_id){
                $response = array('status'=>200);
            }else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function add_notification($sender_user,$sender_role,$send_to="",$send_role,$msg,$title,$url){
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
    
    function addSchedule(){
        $this->form_validation->set_rules('exam_id', 'exam', 'trim|required');
        $this->form_validation->set_rules('class_id', 'class', 'trim|required');
        $this->form_validation->set_rules('exam_marks', 'exam_marks', 'trim|required');
        $this->form_validation->set_rules('subject_id', 'subject', 'trim|required|callback_subject_id');
        $this->form_validation->set_rules('exam_date', 'exam_date', 'trim|required');
        $this->form_validation->set_rules('start_time', 'start_time', 'trim|required');
        $this->form_validation->set_rules('end_time', 'end_time', 'trim|required');
        $this->form_validation->set_rules('room_no','room_no', 'trim|required|callback_room_no');
        $this->form_validation->set_rules('note','note', 'trim');
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
            $items = array();
            $items[] = 'exam_id';
            $items[] = 'class_id';
            $items[] = 'subject_id';
            $items[] = 'start_time';
            $items[] = 'end_time';
            $items[] = 'exam_marks';
            $items[] = 'room_no';
            $items[] = 'note';
            $data = elements($items, $_POST);
            $data['exam_date'] = date('Y-m-d', strtotime($this->input->post('exam_date')));
            $data['year'] = $this->year;
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            if(!empty($this->input->post('id'))){
                $insert_id = $this->db->update('exam_schedule', $data,['id'=>$this->input->post('id')]);
            }else {
                $insert_id = $this->db->insert('exam_schedule', $data);
            }
            if ($insert_id) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function room_no() {

        $room_no = $this->input->post('room_no');
        $exam_date = date('Y-m-d', strtotime($this->input->post('exam_date')));
        $start_time = $this->input->post('start_time');

        if ($this->input->post('id') == '') {
            $schedule = $this->crud_model->duplicate_room_check($room_no, $exam_date, $start_time);
            if ($schedule) {
                $this->form_validation->set_message('room_no', $this->lang->line('this_room_already_allocated'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $schedule = $this->crud_model->duplicate_room_check($room_no, $exam_date, $start_time, $this->input->post('id'));
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('this_room_already_allocated'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    public function subject_id() {

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');

        if ($this->input->post('id') == '') {
            $schedule = $this->crud_model->duplicate_check($exam_id, $class_id, $subject_id);
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $schedule = $this->crud_model->duplicate_check($exam_id, $class_id, $subject_id, $this->input->post('id'));
            if ($schedule) {
                $this->form_validation->set_message('subject_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    function addGrade(){
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('grade_point','grade_point', 'trim|required');
        $this->form_validation->set_rules('mark_from', 'mark_from', 'trim|required');
        $this->form_validation->set_rules('mark_upto', 'mark_upto', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
    
            $validation_grade = $this->grade_validation($data,$this->input->post('id'));
            if ($this->input->post('comment') != null && $validation_grade == 0) {
                $data['comment'] = $this->input->post('comment');
            }
    
            if ($validation_grade == 0) {
                if(!empty($this->input->post('id'))){
                    $this->db->update('grade', $data, ['grade_id'=>$this->input->post('id')]);
                }else {
                    $this->db->insert('grade', $data);
                }
                $response = array('status'=>200);
            }else{
                 $response = array('status'=>400,'error'=>'duplicate entry');
            }
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function grade_validation($grade_array,$param2=""){
        if($param2 != ""){
            $query = $this->db->query("select * FROM grade WHERE grade_id != '".$param2."' AND (name = '".$grade_array['name']."' OR (mark_from >= ".$grade_array['mark_from']." AND mark_upto <= ".$grade_array['mark_upto']."))");
        }else{
            $query = $this->db->query("select * FROM grade WHERE name = '".$grade_array['name']."' OR (mark_from >= ".$grade_array['mark_from']." AND mark_upto <= ".$grade_array['mark_upto'].")");   
        }
        if($query->num_rows() > 0)
            return 1;
        else
            return 0;

    }
    
    function createResult(){
        $marks_type    = marks_type();
        $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
        $response = array();
        $option = array('year'=>$this->year);
        if(!empty($this->input->post('class_id'))){
            $option['class_id'] = $this->input->post('class_id');
        }
        $students = $this->db->get_where('enroll' ,$option)->result_array();
		foreach($students as $row){
		    $studentData = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row();
		    $subjects = $this->db->get_where('subject' , array('class_id' => $row['class_id'] , 'year' => $this->year))->result_array();
		    $data = array();
		    $data['name'] = $studentData->name;
		    $data['roll_no'] = $studentData->student_code;
		    $data['subjects'] = $subjects;
		    $total_marks = 0;
			$total_grade_point = 0;
			$inc=1;
			$mark_total=0;
			$total_marks_from=0;
		    foreach($subjects as $subject){
        		        $marksAttach  ='';
        		        if(!empty($this->input->post('exam_id'))){
        		            $obtained_mark_query = 	$this->db->get_where('mark' , array(
													'class_id' => $row['class_id'] , 
														'exam_id' =>$this->input->post('exam_id'), 
															'subject_id' => $subject['subject_id'] , 
																'student_id' => $row['student_id'],
																	'year' => $this->year
												));
        		        } else {
        		            $obtained_mark_query = 	$this->db->get_where('mark' , array(
													'class_id' => $row['class_id'] , 
														'subject_id' => $row2['subject_id'] , 
																'student_id' => $row['student_id'],
																	'year' => $this->year
												));
        		        }
        		        
						if($marks_type =='marks_and_grade' || $marks_type =='only_marks'){ 
							if ( $obtained_mark_query->num_rows() > 0) {
								$obtained_marks = $obtained_mark_query->row()->mark_obtained;
								$mark_total = $obtained_mark_query->row()->mark_total ? $obtained_mark_query->row()->mark_total : 100;
								$marksAttach .= $obtained_marks;
								if ($obtained_marks >= 0 && $obtained_marks != '') {
									$grade = $this->crud_model->get_grade($obtained_marks);
									$total_grade_point += $grade['grade_point'];
								}
								$total_marks += $obtained_marks;
								$total_marks_from += $mark_total;
							}
							if($marks_type =='only_marks'){
							 if($obtained_mark_query->num_rows() > 0) {
                                $marks = $obtained_mark_query->result_array();
								if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
	                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);
	                                $marksAttach .= " ";
	                                $marksAttach .= $grade['name'];
	                                $total_grade_point += $grade['grade_point'];
	                            }
                            }
                          }
                        }						

                        if($marks_type =='marks_and_grade' || $marks_type =='only_grade'){ 
                        	if($marks_type !='only_grade'){
                        	if ( $obtained_mark_query->num_rows() > 0) {
								$obtained_marks = $obtained_mark_query->row()->mark_obtained;
								$mark_total = $obtained_mark_query->row()->mark_total ? $obtained_mark_query->row()->mark_total : 100;
								$marksAttach .= $obtained_marks;
								 $marksAttach .= " ";
								if ($obtained_marks >= 0 && $obtained_marks != '') {
									$grade = $this->crud_model->get_grade($obtained_marks);
									$total_grade_point += $grade['grade_point'];
								}
								$total_marks += $obtained_marks;
								$total_marks_from += $mark_total;
							 }
						    }   

                            if($obtained_mark_query->num_rows() > 0) {
                                $marks = $obtained_mark_query->result_array();
								foreach ($marks as $row4) {
	                                $row4['mark_obtained'];
	                                $total_marks += $row4['mark_obtained'];
	                                $total_marks_from += $row4['mark_obtained'];
	                            }
								if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
	                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);

	                                $marksAttach .= $grade['name'];
	                                $total_grade_point += $grade['grade_point'];
	                            }
                            }
						}	
				$inc++;
		        $data[$subject['name']] = $marksAttach;
		    }
		    $data['marks_and_grade'] = $total_marks.'/'.$total_marks_from;
		    $data['maximum_marks'] = $total_marks_from;
		    $data['total_marks_obtained'] = $total_marks;
		    $data['percentage'] = (int)(($total_marks/$total_marks_from)*100);
		    $data['grade'] = $this->getGrade((int)(($total_marks/$total_marks_from)*100));
		    array_push($response,$data);
		}
        var_dump(json_encode(['status'=>200,'data'=>$response]));
    }
    
    function getGrade($percentage){
        $grade='';
        if($percentage<100 && $percentage>90){
            $grade='Outstanding';
        }elseif($percentage<90 && $percentage>80){
            $grade='Excellent';
        }elseif($percentage<80 && $percentage>70){
            $grade='Very good';
        }elseif($percentage<70 && $percentage>60){
            $grade='Good';
        }elseif($percentage<60 && $percentage>50){
            $grade='Fair';
        }else{
            $grade='Poor';
        }
    return $grade; 
    }
    
    function addHostel(){
        $response = array();
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('type',  'type', 'trim|required');
        $this->form_validation->set_rules('address',  'address', 'trim|required');
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('note', 'note', 'trim');
        if ($this->form_validation->run() === TRUE) {
            if($this->input->post('id')){
                $data['name']        = $this->input->post('name');
            $data['type'] = $this->input->post('type');
            $data['address']   = $this->input->post('address');
            $data['note']   = $this->input->post('note');
            $data['status'] = 1;
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
            $this->db->where('id',$this->input->post('id'));
            $insert_id = $this->db->update('hostels', $data);
            if ($insert_id) {
                $response = array('status'=>200);
            }else{
                 $response = array('status'=>400,'error'=>'duplicate entry');
            }
                
            }else{
            $data['name']        = $this->input->post('name');
            $data['type'] = $this->input->post('type');
            $data['address']   = $this->input->post('address');
            $data['note']   = $this->input->post('note');
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $insert_id = $this->db->insert('hostels', $data);
            if ($insert_id) {
                $response = array('status'=>200);
            }else{
                 $response = array('status'=>400,'error'=>'duplicate entry');
            }
          }
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function deletehostel(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('hostels', array('id' => $id))) {
                $this->db->delete('rooms', array('hostel_id' => $id));
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
     function deleteroom(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('rooms', array('id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function addRoom(){
        $response = array();
        $this->form_validation->set_rules('hostel_id', 'hostel_id', 'trim|required');
        $this->form_validation->set_rules('room_type',  'room_type', 'trim|required');
        $this->form_validation->set_rules('cost',  'cost', 'trim|required');
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('total_seat',  'total_seat', 'trim|required');
        $this->form_validation->set_rules('room_no',  'room_no', 'trim|required|callback_room_no');
        $this->form_validation->set_rules('note', 'note', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $id=$this->input->post('id');
            if($this->input->post('id')){
                $data['hostel_id']        = $this->input->post('hostel_id');
            $data['room_no'] = $this->input->post('room_no');
            $data['room_type']   = $this->input->post('room_type');
            $data['cost']   = $this->input->post('cost');
            $data['total_seat']   = $this->input->post('total_seat');
            $data['note']   = $this->input->post('note');
            $data['beds']   = $this->input->post('beds');
            $data['type']   = $this->input->post('type');
            $data['status'] = 1;
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
            $this->db->where('id',$id);
            $insert_id = $this->db->update('rooms', $data);
            if ($insert_id) {
                $response = array('status'=>200);
            }else{
                 $response = array('status'=>400,'error'=>'duplicate entry');
            }
            
            }else{
            $data['hostel_id']        = $this->input->post('hostel_id');
            $data['room_no'] = $this->input->post('room_no');
            $data['room_type']   = $this->input->post('room_type');
            $data['cost']   = $this->input->post('cost');
            $data['total_seat']   = $this->input->post('total_seat');
            $data['note']   = $this->input->post('note');
            $data['beds']   = $this->input->post('beds');
            $data['type']   = $this->input->post('type');
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $insert_id = $this->db->insert('rooms', $data);
            if ($insert_id) {
                $response = array('status'=>200);
            }else{
                 $response = array('status'=>400,'error'=>'duplicate entry');
            }
          }
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function assignHostelStudent(){
        $response = array();
        $this->form_validation->set_rules('hostel_id', 'hostel_id', 'trim|required');
        $this->form_validation->set_rules('room_id',  'room_id', 'trim|required');
        $this->form_validation->set_rules('beds',  'beds', 'trim|required');
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('created_by',  'created_by', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $user_id = $this->input->post('user_id');
            $hostel_id = $this->input->post('hostel_id');
            $room_id = $this->input->post('room_id');
            $beds = $this->input->post('beds');
            $member = $this->member->get_single('hostel_members', array('user_id' => $user_id));
            if (empty($member)) {

                $data['user_id'] = $user_id;
                $data['custom_member_id'] = $this->member->get_custom_id('hostel_members', 'HM');
                $data['hostel_id']  = $hostel_id;
                $data['room_id']    = $room_id;
                $data['beds']    = $beds;
                $data['status']     = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->input->post('created_by');

                $insert_id = $this->member->insert('hostel_members', $data);
                if($insert_id){
                    $response = array('status'=>200);
                    $this->member->update('student', array('is_hostel_member' => 1), array('student_id' => $user_id));
                } else {
                    $response = array('status'=>400);
                }
            } else {
                $response = array('status'=>400,'error'=>'user already in hostel');
            }
         } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function assignHostelStaff(){
        $response = array();
        $this->form_validation->set_rules('hostel_id', 'hostel_id', 'trim|required');
        $this->form_validation->set_rules('room_id',  'room_id', 'trim|required');
        $this->form_validation->set_rules('beds',  'beds', 'trim|required');
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('created_by',  'created_by', 'trim|required');
        $this->form_validation->set_rules('designation',  'designation', 'trim|required');
        $this->form_validation->set_rules('joining_date',  'joining_date', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $user_id = $this->input->post('user_id');
            $hostel_id = $this->input->post('hostel_id');
            $joining_date = date("Y-m-d", strtotime($this->input->post('joining_date')));
            $room_id = $this->input->post('room_id');
            $beds = $this->input->post('beds');
            $table = $this->input->post('table_name');
            $designation=$this->input->post('designation');
            $member = $this->member->get_single('hostel_members_staff', array('user_id' => $user_id,'designation_id' => $designation));
            if (empty($member)) {
                $data['user_id'] = $user_id;
                $data['designation_id'] = $designation;
                $data['custom_member_id'] = $this->member->get_custom_id('hostel_members', 'HM');
                $data['hostel_id']  = $hostel_id;
                $data['room_id']    = $room_id;
                $data['joining_date'] = $joining_date;
                $data['beds']    = $beds;
                $data['status']     = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->input->post('created_by');
                $insert_id = $this->member->insert('hostel_members_staff', $data);
                if($insert_id){
                    $response = array('status'=>200);
                    $designations = $this->db->get_where('designations',['id'=>$designation])->row();
                    $table = $designations->name;
                    $this->db->set('is_hostel_member', '1');
                    if($table == 'Transport'){
                        $this->db->where('transport_manager_id', $user_id);
                        $this->db->update('transport_manager');
                    }else{
                        $this->db->where($table.'_id', $user_id);
                        $this->db->update(lcfirst($table));
                    }
                } else {
                    $response = array('status'=>400);
                }
            } else {
                $response = array('status'=>400,'error'=>'user already in hostel');
            }
         } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function getHostelStaff(){
        $option = array();
        if(!empty($this->input->post('user_id'))){
            $option['user_id'] = $this->input->post('user_id');
        }
        if(!empty($this->input->post('designation_id'))){
            $option['designation_id'] = $this->input->post('designation_id');
        }
        $datas = $this->db->get_where('hostel_members_staff',$option)->result_array();
        foreach($datas as $key => $data){
            $datas[$key]['user_name'] = '';
            $datas[$key]['hostel_name'] = $this->db->get_where('hostels',['id'=>$data['hostel_id']])->row()->name;
            $datas[$key]['room_name'] = $this->db->get_where('rooms',['id'=>$data['room_id']])->row()->room_no;
            $designations = $this->db->get_where('designations',['id'=>$data['designation_id']])->row();
            $designations_name = $designations->name;
            $primary_id = lcfirst($designations_name)."_id";
    
            if (!$this->db->table_exists(lcfirst($designations_name))){
                continue;
            }
            $this->db->select('name');
            $this->db->where($primary_id,$data['user_id']);
            $this->db->from(lcfirst($designations_name));
            $datas[$key]['user_name'] = (string)$this->db->get()->row()->name;
        }
        echo json_encode([
            'status' => 200,
            'data' => $datas
            ]);
    }
    
    function getTabulationSheet() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');

        $exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
		$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		if(!empty($this->input->post('section_id'))){
	        $this->db->where('section_id',$this->input->post('section_id'));
	    }
		$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();

		foreach($subjects as $key => $row) {
		    if(!empty($this->input->post('student_id'))){
		        $this->db->where('student_id',$this->input->post('student_id'));
		    }
		    if(!empty($this->input->post('section_id'))){
    	        $this->db->where('section_id',$this->input->post('section_id'));
    	    }
		    $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
		    $subjects[$key]['students'] = $students;

		    $total_marks = 0;
			$total_grade_point = 0;
		    foreach($students as $key2 => $row2) {
		        $subjects[$key]['students'][$key2]['student_name'] = $this->db->get_where('student', array('student_id' => $row2['student_id']))->row()->name;
		        $obtained_mark_query = 	$this->db->get_where('mark' , array(
													'class_id' => $class_id ,
														'exam_id' => $exam_id ,
															'subject_id' => $row['subject_id'] ,
																'student_id' => $row2['student_id'],
																	'year' => $running_year
												));
			    $obtained_marks = $obtained_mark_query->row()->mark_obtained;
			     $mark_total = $obtained_mark_query->row()->mark_total;
			    $grade = $this->crud_model->get_grade($obtained_marks);
			    if ($obtained_marks >= 0 && $obtained_marks != '') {
						$grade = $this->crud_model->get_grade($obtained_marks);
						$total_grade_point += $grade['grade_point'];
					}
				$total_marks += $obtained_marks;
				$subjects[$key]['students'][$key2]['marks'] =  $obtained_marks;
				$subjects[$key]['students'][$key2]['marks_total'] =  $mark_total;
				$subjects[$key]['students'][$key2]['grade_points'] =  $grade;
		    }
		}


		$data['exam_name'] = $exam_name;
		$data['class_name'] = $class_name;
		$data['subjects'] = $subjects;

		echo json_encode($data);
    }
    
    function createOnlineExam(){
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('class_id',  'created_by', 'trim|required');
        $this->form_validation->set_rules('section_id',  'designation', 'trim|required');
        $this->form_validation->set_rules('subject_id',  'joining_date', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->crud_model->create_online_exam('online_exam');
            $response = array('status'=>200);
        } else {
            $response = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function assignMarks(){
        $response = array('status'=>200);
        $json = file_get_contents('php://input');

        // Converts it into a PHP Array
        $marks = json_decode($json,true);
        foreach($marks as $row) {
            $obtained_marks = $row['marks_obtained'];
            $mark_total = $row['max_marks'];
            $comment = $row['comment'];
            $grade_id = $row['grade_id'];
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment,'mark_total'=>$mark_total,'grade_id'=>$grade_id));
            $subject = $this->db->get_where('subject_competencies' , array('subject_id' =>$row['subject_id']))->result_array();
            $this->db->query("update cat_mark set competencies_marks='".$row['Reading']."' where mark_id='".$row['mark_id']."' and competencies_name='Reading'");
            $this->db->query("update cat_mark set competencies_marks='".$row['Writing']."' where mark_id='".$row['mark_id']."' and competencies_name='Writing'");
            $this->db->query("update cat_mark set competencies_marks='".$row['Spelling']."' where mark_id='".$row['mark_id']."' and competencies_name='Spelling'");
            $this->db->query("update cat_mark set competencies_marks='".$row['HANDWRITING']."' where mark_id='".$row['mark_id']."' and competencies_name='HANDWRITING'");
        
        }
        echo json_encode($response);
    }
    
    function getCycle(){
        $option = array();
        if(!empty($this->input->post('exam_id'))){
            $option['exam_id'] = $this->input->post('exam_id');
        }
        echo json_encode(['status'=>200,'data'=> $this->db->get_where('exam_cycle',$option)->result_array()]);
    }
    
    function getAttendanceReport(){
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $from = $this->input->post('start_date');
        $to = $this->input->post('end_date');
        // $sessional_year = $this->input->post('year');
    
        $data['status'] = 200;
        $data['message'] = 'success';
        
        $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        
        $data['class_name'] = $class_name;
        $data['section_name'] = $section_name;
        $data['start-date'] = $from;
        $data['end-date'] = $to;
        $data['year'] = $running_year;
        
        $start    = new DateTime($from);
        $end      = (new DateTime($to))->modify('+1 day');
        $interval = new DateInterval('P1D');
        $period   = new DatePeriod($start, $interval, $end);
        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
        $data2 = array();
        if (sizeof($students) > 0){
            foreach ($students as $key => $row) {
                $data2[$key]['student'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                $k = 0;
                $attendanceStatus = array();
                foreach ($period as $dt) {
                    $month=explode('-',$dt->format("d-m-Y"));
                    $date = $month[0] . '-' . $month[1] . '-' . $month[2];
                   
        
                    $timestamp = strtotime($date);
                    $attendanceStatus[$k]['date'] = $date;
                    $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
                    if ($attendance[0]['status']) {
                        $attendanceStatus[$k]['status'] =  $attendance[0]['status'];
                    } else {
                        $attendanceStatus[$k]['status'] =  '0';
                    }
                    $k++;
                }
                $data2[$key]['attendance'] = $attendanceStatus;
            }
        }
    
        $data['data'] = $data2;
        
        echo json_encode($data);
    }
    
    function getAttendanceStaffReport(){
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $designation_id = $this->input->post('designation_id');
        $from = $this->input->post('start_date');
        $to = $this->input->post('end_date');
    
        $response['status'] = 200;
        $response['message'] = 'success';
        
        
        $response['designation_id'] = $designation_id;
        $response['start-date'] = $from;
        $response['end-date'] = $to;
        $response['year'] = $running_year;
        
        $start    = new DateTime($from);
        $end      = (new DateTime($to))->modify('+1 day');
        $interval = new DateInterval('P1D');
        $period   = new DatePeriod($start, $interval, $end);
        $option = array();
        if(!empty($this->input->post('designation_id'))){
            $option['id'] = $this->input->post('designation_id');
        }
        $key = 0;
        $designations = $this->db->get_where('designations', $option)->result_array();
        foreach($designations as $designation){
            $designations_name = $designation['name'];

            $designations_data = $this->db->get(lcfirst($designations_name))->result_array();
            foreach($designations_data as $data){
                $primary_id = lcfirst($designations_name)."_id";
                $data2[$key]['Name'] = $data['name'];
                $data2[$key]['Role'] = lcfirst($designations_name);
                $k = 0;
                $attendanceStatus = array();
                foreach ($period as $dt) {
                    $month=explode('-',$dt->format("d-m-Y"));
                    $date = $month[0] . '-' . $month[1] . '-' . $month[2];
                   
        
                    $timestamp = strtotime($date);
                    $attendance = $this->db->get_where('attendance_employee', array( 'designation_id' => $designation['id'], 'timestamp' => $timestamp, 'employee_id' => $data[$primary_id]))->result_array();
                    $attendanceStatus[$k]['date'] = $date;
                    if ($attendance[0]['status']) {
                        $attendanceStatus[$k]['status'] =  $attendance[0]['status'];
                    } else {
                        $attendanceStatus[$k]['status'] =  '0';
                    }
                    $k++;
                }
                $data2[$key]['attendance'] = $attendanceStatus;
                $key++;
            }
        }
        $response['data'] = $data2;
        
        echo json_encode($response);
    }
    
    function deleteFeeType(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->feetype->delete('income_heads', array('id' => $id))) {
                $this->feetype->delete('fees_amount', array('income_head_id' => $id));            
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function addEditFeeType(){
        $response = array('status'=>200);
        $this->_prepare_feetype_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_feetype_data();
            if(!empty($this->input->post('id'))){
                $updated = $this->feetype->update('income_heads', $data, array('id' => $this->input->post('id')));
                $insert_id = $this->input->post('id');
            } else {
                $updated = $this->feetype->insert('income_heads', $data);
                $insert_id = $this->db->insert_id();
            }

            if ($updated) {
                if(!$this->_save_fee_amount($insert_id)){
                    $response = array('status'=>401,'error'=>'unable to hit save_amount process');  
                }else{
                    $response = array('status'=>200);  
                }
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    private function _save_fee_amount($income_head_id){
        if(empty($this->input->post('fee_amount'))){
            echo json_encode(['status'=>401,'error'=>'fee_amount is empty']);
        }
        $_POST['fee_amount'] = json_decode($this->input->post('fee_amount'),true);
        $_POST['amount_id'] = json_decode($this->input->post('amount_id'),true);
        $_POST['class_id'] = json_decode($this->input->post('class_id'),true);
        foreach($this->input->post('fee_amount') as $key=>$value){
            $classExists = $this->db->get_where('class',['class_id'=>$_POST['class_id'][$key]])->row();
            if(empty($classExists)){
                continue;
            }
            $data = array();
            $exist = '';
            //$amount_id = @$this->input->post('amount_id')[$key];
            $amount_id = @$_POST['amount_id'][$key];
            
            if($amount_id){
               $exist = $this->feetype->get_single('fees_amount', array('class_id'=>$_POST['class_id'][$key], 'id'=>$amount_id)); 
               
            }            
            
            
            //$data['fee_amount'] = $this->input->post('fee_amount')[$key];
            $data['fee_amount'] = @$_POST['fee_amount'][$key];
            
            if ($this->input->post('id') && $exist) {                
                
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = $this->input->post('user_id');             
                $this->feetype->update('fees_amount', $data, array('id'=>$exist->id));
                
            } else {
                
                $data['income_head_id'] = $income_head_id;
                $data['class_id'] = $_POST['class_id'][$key];                
                $data['status'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->input->post('user_id');  
                $id = $this->feetype->insert('fees_amount', $data);
                if(!$id){
                    echo json_encode(['status'=>401,'error'=>'unable to save fee_type '.json_encode($data)]);
                }
            }
        }
        return true;
    }
    
    private function _prepare_feetype_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'fee_type', 'trim|required|callback_title_feetype');   
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required'); 
        $this->form_validation->set_rules('fee_amount', 'fee_amount', 'trim'); 
        $this->form_validation->set_rules('note', 'note', 'trim');   
    }
    
    public function title_feetype()
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
   
   private function _get_posted_feetype_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';
        $data = elements($items, $_POST);  
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['year']       = $this->feetype->running_year();
            $data['head_type']  = 'fee';
            $data['status']     = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');                
        }

        return $data;
    }
    
    public function addEditExpHeads(){
        $this->form_validation->set_rules('title', 'expenditure_head', 'trim|required|callback_expenditure_head_title');   
        $this->form_validation->set_rules('note','note', 'trim');   
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');   
            if ($this->form_validation->run() === TRUE) {
                $items = array();
                $items[] = 'title';
                $items[] = 'note';
                $data = elements($items, $_POST);  
            
                if ($this->input->post('id')) {
                    $data['modified_at'] = date('Y-m-d H:i:s');
                    $data['modified_by'] = $this->input->post('user_id');
                    $insert_id = $this->exphead->update('expenditure_heads', $data, array('id'=>$this->input->post('id')));
                } else {
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = $this->input->post('user_id'); 
                    $insert_id = $this->exphead->insert('expenditure_heads', $data);
                }
                if ($insert_id) {
                    
                     $response= array('status'=>200);
                } else {
                    $response= array('status'=>400);
                }
            } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function expenditure_head_title()
   {             
      if($this->input->post('id') == '')
      {   
          $exphead = $this->exphead->duplicate_check('title',$this->input->post('title')); 
          if($exphead){
                $this->form_validation->set_message('title',  $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $exphead = $this->exphead->duplicate_check('title',$this->input->post('title'), $this->input->post('id')); 
          if($exphead){
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }
   
   function updateAdvanceExpesesPay(){
        $this->form_validation->set_rules('update_field', 'update_field', 'trim|required');   
        $this->form_validation->set_rules('advance_update','advance_update', 'trim');   
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');   
            if ($this->form_validation->run() === TRUE) {
                $update_field = $this->input->post('update_field');
                if($update_field=='send'){
                    $update_field = 'lko_date';
                } else if($update_field=='recieved') {
                    $update_field = 'voc_rec_at_ro';
                } else {
                    $update_field = 'lko_remarks';
                }
                $user_id  = $this->input->post('user_id');
                $advance_update = $this->input->post('advance_update');
                
                $query = $this->db->get_where('expenditures' ,array(
                           'id' => $user_id,
                         ));
        
                 if($query->num_rows() < 1){
                    $attn_data[$update_field]   = $advance_update;
                    $attn_data['id'] = $user_id;
                    $this->db->insert('expenditures' , $attn_data);
                  } else {
                    
                    $this->db->where('id',$user_id);  
                    
                    $this->db->update('expenditures',array($update_field => $advance_update));
    
                 }
                 $response = array('status'=>200);
            } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
}

public function deleteExpHead(){
    $this->form_validation->set_rules('id', 'id', 'trim|required');   
    if ($this->form_validation->run() === TRUE) {
            if ($this->exphead->delete('expenditure_heads', array('id' => $this->input->post('id')))) { 
                    $response = array('status'=>200);
            } else {
                    $response = array('status'=>400);
            }
    } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
    }
    echo json_encode($response);
}

    public function ListDamageInventory(){
        $response = $this->inventory->get_asset_inv_damaged_list();
        foreach($response as $key => $value){
            $response[$key]->class_name = @$this->db->get_where('class', array('class_id' => $value->class_id))->row()->name;
            $response[$key]->section_name = @$this->db->get_where('section', array('section_id' => $value->section_id))->row()->name;
            $response[$key]->hostel_name = @$this->db->get_where('hostels', array('id' => $value->hostel_id))->row()->name;
            if($value->room_id!=0){
            $response[$key]->room_name = @$this->db->get_where('rooms', array('id' => $value->room_id))->row()->room_no." (".$this->db->get_where('rooms', array('id' => $value->room_id))->row()->room_type.")";
            }else{
                 $response[$key]->room_name="";
            }
        }
        echo json_encode(['status'=>200,'data'=>$response]);
    } 
    
    public function addEditListDamageInventory(){
        //1- School
        //2- Hostel
        //3- Others
        $this->form_validation->set_rules('asset_id', 'Asset id', 'trim|required');
        $this->form_validation->set_rules('asset_loc', 'Asset location', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $items = array();
            $items[] = 'asset_id';
            $items[] = 'asset_loc';
    
            $data = elements($items, $_POST);
    
            if ($this->input->post('id')) {
                $data['asset_id'] = $this->input->post('asset_id');
                $data['asset_loc'] = $this->input->post('asset_loc');
                $data['quantity'] = $this->input->post('quantity');
                $data['condition'] = $this->input->post('inven_id');
                $data['class_id'] = $this->input->post('class_id');
                $data['section_id'] = $this->input->post('section_id');
                 $data['hostel_id'] = $this->input->post('hostel_id');
                  $data['room_id'] = $this->input->post('room_id');
                   $data['description'] = $this->input->post('description');
                $data['status'] = 1;
                $data['asset_mode'] = 1;
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = $this->input->post('user_id');
                $updated = $this->inventory->update('asset_warehouse', $data, array('id' => $this->input->post('id')));
            } else {
                $data['asset_id'] = $this->input->post('asset_id');
                $data['asset_loc'] = $this->input->post('asset_loc');
                $data['quantity'] = $this->input->post('quantity');
                $data['class_id'] = $this->input->post('class_id');
                $data['section_id'] = $this->input->post('section_id');
                 $data['hostel_id'] = $this->input->post('hostel_id');
                  $data['room_id'] = $this->input->post('room_id');
                  $data['description'] = $this->input->post('description');
                $data['status'] = 1;
                $data['asset_mode'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->input->post('user_id');
                $updated = $this->inventory->insert('asset_warehouse', $data);
            }

            if ($updated) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        } 
        echo json_encode($response);
    }
    
    public function deleteListDamageInventory(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->db->where('id',$this->input->post('id'));
            if ($this->db->delete('asset_warehouse')) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        } 
        echo json_encode($response);
    }
    
    public function issueInventoryAssetreport(){
        $datefrm = $this->db->escape($this->input->post('date_from'));
        $dateto = $this->db->escape($this->input->post('date_to'));
        $inventory_type = $this->inventory->get_list('inventory_type', array(), '', '', '', 'id', 'ASC');
        $inventryAsset = array();
        foreach($inventory_type as $invetryType){
            $inventryAsset[$invetryType->id] = $invetryType->name;
        }
        $data_warehouse = $this->db->query("SELECT * FROM inventory_warehouse WHERE DATE(created_at)  BETWEEN $datefrm AND $dateto")->result_array();
        $data_inventory = $this->db->query("SELECT inventory_type,created_at,SUM(name) total FROM inventory WHERE DATE(created_at)  BETWEEN $datefrm AND $dateto group by inventory_type")->result_array();
        $data = array();
        $key = 0;
        foreach ($data_inventory as $value){
            $invname = $inventryAsset[$value['inventory_type']];
            ${$inventryAsset[$value['inventory_type']]} = $value['total'];
            $data[$key]['serial_no']=$key+1;
            $data[$key]['date']=$value['created_at'];
            $data[$key]['class']= "";
            $data[$key]['product_name']=$invname;
            $data[$key]['total_purchased']=$value['total'];
            $data[$key]['distributed']="";
            $data[$key]['total_available']="";
            $key++;
        }
        
        foreach ($data_warehouse as $val){
            $name = $inventryAsset[$val['inven_id']];
            ${$inventryAsset[$val['inven_id']]}=${$inventryAsset[$val['inven_id']]}-$val['quantity'];
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->row();
             $section_name = $this->db->get_where('section', array('section_id' => $val['section_id']))->row()->name;
            $test = '';
            $cnt=${$inventryAsset[$val['inven_id']]};
            $data[$key]['serial_no']=$key+1;
            $data[$key]['date']=$val['created_at'];
            $data[$key]['class']= $class_name->name;
             $data[$key]['section']= $section_name;
            $data[$key]['product_name']=$name;
            $data[$key]['total_purchased']="";
            $data[$key]['distributed']=$val['quantity'];
            $data[$key]['total_available']=$cnt;
            if($val['distributed_to']!=0){
             $user_name  = $this->db->get_where('employees', array('user_id' => $val['distributed_to']))->result_array();
              $data[$key]['staff_name']=$user_name[0]['name'];
            }else{
                $data[$key]['staff_name']="";
            }
             
            $key++;
        }
        $AssetLeft = array();
        foreach($inventryAsset as $key =>$val){
            $AssetLeft[] = [
                        'key'=> $val,
                        'value'=>(int)${$inventryAsset[$key]}
                 ];   
        }
        echo json_encode(['status'=>200,'data'=>$data,'asset_left'=>$AssetLeft]);
    }
    
    public function changeStudentStatus(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->db->where('student_id',$this->input->post('id'));
            if ($this->db->update('student',['status'=>$this->input->post('status'),'reason'=>$this->input->post('reason')])) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        } 
        echo json_encode($response);
    }
    
    public function changeStatusOfAccomodation(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->db->where('id',$this->input->post('id'));
            if ($this->db->update('room_change_request',['room_status'=>$this->input->post('status')])) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        } 
        echo json_encode($response);
    }
    
     public function deleteStatusOfAccomodation(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->db->where('id',$this->input->post('id'));
            if ($this->db->delete('room_change_request')) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        } 
        echo json_encode($response);
    }
    
    public function hostelChangeRequestReport(){
        $reponse = array();
        $key = 0;
        $option = '';
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option = 'AND DATE(create_at) BETWEEN "'. date('Y-m-d', strtotime($this->input->post('date_from'))). '" and "'. date('Y-m-d', strtotime($this->input->post('date_to'))).'"';
        }
        if($this->input->post('student')){
                $data = $this->db->query("SELECT * FROM room_change_request where type = '1' and room_status='approve' {$option}")->result_array();
            foreach ($data as $val){
                $student_name = $this->db->get_where('student', array('student_id' => $val['student_id']))->row()->name;
           
            
                $class_id = $this->db->get_where('enroll', array('student_id' => $val['student_id']))->row()->class_id;
                
                $parent_id = $this->db->get_where('student', array('student_id' => $val['student_id']))->row()->parent_id;
                $parent_name = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;
                $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                
                $hostel_name = $this->db->get_where('hostels', array('id' => $val['new_hostel_id']))->row()->name;
                $room_name = $this->db->get_where('rooms', array('id' => $val['new_room_id']))->row()->room_no;
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
                if($val['prev_room_id']==0){
                    $prev_room_name='not-specified';
                } else {
                    $prev_room_name = $this->db->get_where('rooms', array('id' => $val['prev_room_id']))->row()->room_no;
                }
                if($val['prev_hostel_id']==0){
                    $prev_hostel_name='not-specified';
                }else{
                    $prev_hostel_name = $this->db->get_where('hostels', array('id' => $val['prev_hostel_id']))->row()->name;
                }
                $reponse[$key]['serial_number'] = ($key+1);
                $reponse[$key]['student_name'] = $student_name;
                $reponse[$key]['class'] = $class_name;
                $reponse[$key]['previouse_hostel'] = $prev_hostel_name;
                $reponse[$key]['previous_room_no'] = $prev_room_name;
                $reponse[$key]['current_hostel'] = $hostel_name;
                $reponse[$key]['current_roon_no'] = $room_name;
                $reponse[$key]['year'] = date('Y');
                $reponse[$key]['reason'] = $val['reason'];
                $reponse[$key]['current_bed_no'] = $val['new_bed_id'];
                $reponse[$key]['create_at'] = $val['create_at'];
                $key++;
            }
        }else {
            $data_des = $this->db->query("SELECT * FROM room_change_request where type = '2' and room_status='approve' {$option}")->result_array();
            foreach($data_des as $val){
            switch($val['role_id']){
                        case 1:
                            $attendance_of_students = $this->db->get_where('driver', array(
                                'status'  => 1,'is_hostel_member'  => 1,'driver_id'  => $val['student_id']
                            ))->result_array();
                            $id='driver_';
                            $table='Driver';
                            break;
                        case 2:
                            $attendance_of_students = $this->db->get_where('warden', array(
                                'status'  => 1,'is_hostel_member'  => 1,'warden_id'  => $val['student_id']
                            ))->result_array();
                            $id='warden_';
                            $table='Warden';
                            break;
                        case 3:
                            $attendance_of_students = $this->db->get_where('inventory_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'inventory_manager_id'  => $val['student_id']
                            ))->result_array();
                            $id='inventory_manager_';
                            $table='Inventory manager';
                            break;
                        case 4:
                           
                            $attendance_of_students = $this->db->get_where('transport_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'transport_manager_id'  => $val['student_id']
                            ))->result_array();
                            $id='transport_';
                            $table='Transport';
                            break;
                        case 5:
                            $attendance_of_students = $this->db->get_where('accountant', array(
                                'status'  => 1,'is_hostel_member'  => 1,'accountant_id'  => $val['student_id']
                            ))->result_array();
                            $id='accountant_';
                            $table='Accountant';
                            break;
                        case 6:
                            $attendance_of_students = $this->db->get_where('teacher', array(
                                'status'  => 1,'is_hostel_member'  => 1,'teacher_id'  => $val['student_id']
                            ))->result_array();
                            //echo $this->db->last_query();
                            $id='teacher_';
                            $table='Teacher';
                            break;
                        default:
                            $attendance_of_students =array();
                            $id='none';
                            $table='none';
                            break;
                    }
                    $hostel_name = $this->db->get_where('hostels', array('id' => $val['new_hostel_id']))->row()->name;
                    $room_name = $this->db->get_where('rooms', array('id' => $val['new_room_id']))->row()->room_no;
                    if($val['prev_room_id']==0){
                    $prev_room_name='not-specified';
                    }else{
                    $prev_room_name = $this->db->get_where('rooms', array('id' => $val['prev_room_id']))->row()->room_no;
                    }
                    if($val['prev_hostel_id']==0){
                    $prev_hostel_name='not-specified';
                    }else{
                    $prev_hostel_name = $this->db->get_where('hostels', array('id' => $val['prev_hostel_id']))->row()->name;
                    } 
                    $reponse[$key]['serial_number'] = ($key+1);
                    $reponse[$key]['staff_number'] = $attendance_of_students[0]['name'];
                    $reponse[$key]['designation'] = $table;
                    $reponse[$key]['previouse_hostel'] = $prev_hostel_name;
                    $reponse[$key]['previous_room_no'] = $prev_room_name;
                    $reponse[$key]['current_hostel'] = $hostel_name;
                    $reponse[$key]['current_roon_no'] = $room_name;
                    $reponse[$key]['year'] = date('Y');
                    $reponse[$key]['reason'] = $val['reason'];
                    $reponse[$key]['current_bed_no'] = $val['new_bed_id'];
                     $reponse[$key]['create_at'] = $val['create_at'];
                    $key++;
            }
        }
        echo json_encode(['status'=>200,'data'=>$reponse]);
    }
    
    public function hostelReport(){
        $reponse = array();
        $this->db->select('hostel_members.*,student.name,student.phone,student.email,enroll.class_id ,enroll.section_id,hostels.name as hostel_name,hostels.type,rooms.room_no,rooms.cost,rooms.room_type,rooms.total_seat');
        $this->db->from('hostel_members');
        $this->db->join('student','student.student_id=hostel_members.user_id','Left');
        $this->db->join('hostels','hostels.id=hostel_members.hostel_id','Left');
        $this->db->join('rooms','rooms.id=hostel_members.room_id','Left');
        $this->db->join('enroll','enroll.student_id=student.student_id','Left');
        $this->db->group_by('hostel_members.id');
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $this->db->where('DATE(hostel_members.created_at) BETWEEN "'. date('Y-m-d', strtotime($this->input->post('date_from'))). '" and "'. date('Y-m-d', strtotime($this->input->post('date_to'))).'"');
        }
        if(!empty($this->input->post('class_id'))){
            $this->db->where('enroll.class_id',$this->input->post('class_id'));
        }
        if(!empty($this->input->post('section_id'))){
            $this->db->where('enroll.section_id',$this->input->post('section_id'));
        }
        $query=$this->db->get();
        $hostel_data=$query->result_array();
        $key = 0;
        $response = array();
        foreach ($hostel_data as $val){
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->row();
            $section = $this->db->get_where('section', array('class_id' => $val['class_id']))->row();
            $teacher = $this->db->get_where('teacher', array('teacher_id' => $section->teacher_id))->row();
            $test = '';
            if($val['status'] == 1){
                $test = 'Paid';
            } else {
                $test = "Unpaid";
            }
            $response[$key]['serial_no']= ($key+1);
            $response[$key]['student_name']= $val['name'];
            $response[$key]['class']= $class_name->name;
            $response[$key]['section']= $section->name;
            $response[$key]['class_teacher']= (string)$teacher->name;
            $response[$key]['room_no']=$val['room_no'];
            $response[$key]['type']=$val['type'];
            $response[$key]['total_seat']=$val['total_seat'];
            $response[$key]['room_type']=$val['room_type'];
            $response[$key]['hostel_name']=$val['hostel_name'];
            $response[$key]['bed_no']=$val['beds'];
            $response[$key]['hostel_fee']=$test;
            $response[$key]['guardian_name']=$val['phone'];
            $response[$key]['contact']=$val['email']; 
            $key++;
        }
        echo json_encode(['status'=>200,'data'=>$response]);
    }
    
    public function hostelReportStaff(){
        $option = array();
        if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
            $option = 'DATE(created_at) BETWEEN "'. date('Y-m-d', strtotime($this->input->post('date_from'))). '" and "'. date('Y-m-d', strtotime($this->input->post('date_to'))).'"';
        }
        if(!empty($this->input->post('designation_id'))){
            $this->db->where('designation_id',$this->input->post('designation_id'));
        }
        $hostel_data = $this->db->get_where('hostel_members_staff',$option)->result_array();
        $response = array();
        $key=0;
        foreach ($hostel_data as $k => $val){
            switch($val['designation_id']){
                        case 1:
                            $attendance_of_students = $this->db->get_where('driver', array(
                                'status'  => 1,'is_hostel_member'  => 1,'driver_id'  => $val['user_id']
                            ))->result_array();
                            $id='driver_';
                            $table='Driver';
                            break;
                        case 2:
                            $attendance_of_students = $this->db->get_where('warden', array(
                                'status'  => 1,'is_hostel_member'  => 1,'warden_id'  => $val['user_id']
                            ))->result_array();
                            $id='warden_';
                            $table='Warden';
                            break;
                        case 3:
                            $attendance_of_students = $this->db->get_where('inventory_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'inventory_manager_id'  => $val['user_id']
                            ))->result_array();
                            $id='inventory_manager_';
                            $table='Inventory manager';
                            break;
                        case 4:
                            $attendance_of_students = $this->db->get_where('transport_manager', array(
                                'status'  => 1,'is_hostel_member'  => 1,'transport_manager_id'  => $val['user_id']
                            ))->result_array();
                            
                            $id='transport_manager_';
                            $table='Transport';
                            break;
                        case 5:
                            $attendance_of_students = $this->db->get_where('accountant', array(
                                'status'  => 1,'is_hostel_member'  => 1,'accountant_id'  => $val['user_id']
                            ))->result_array();
                            $id='accountant_';
                            $table='Accountant';
                            break;
                        case 6:
                            $attendance_of_students = $this->db->get_where('teacher', array(
                                'status'  => 1,'is_hostel_member'  => 1,'teacher_id'  => $val['user_id']
                            ))->result_array();
                            //echo $this->db->last_query();
                            $id='teacher_';
                            $table='Teacher';
                            break;
                        default:
                            $attendance_of_students =array();
                            $id='none';
                            $table='none';
                            break;
                }
                if(!empty($attendance_of_students)){
                    $hostel_name = $this->db->get_where('hostels',array('id'=>$val['hostel_id']))->row()->name;
                    $subjectname = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row();
                    $total_seat = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->total_seat;
                    $room_type = $this->db->get_where('rooms',array('id'=>$val['room_id'],'hostel_id'=>$val['hostel_id']))->row()->room_type;
                    $response[$key]['serial_no'] = ($key+1);
                    $response[$key]['staff_name'] = $attendance_of_students[0]['name'];
                    $response[$key]['designation'] = $table;
                    $response[$key]['room_no'] = $subjectname->room_no;
                    $response[$key]['bed_no'] = $val['beds'];;
                    $response[$key]['total_seat'] = $subjectname->total_seat;
                    $response[$key]['room_type'] = $subjectname->room_type;
                    $response[$key]['hostel_name'] = $hostel_name;
                    $response[$key]['contact'] = $attendance_of_students[0]['phone'];
                    $key++;
                }
        }
        echo json_encode(['status'=>200,'data'=>$response]);
    }
    
    function deleteStaff(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        $this->form_validation->set_rules('designation_id',  'designation_id', 'trim|required');
        $this->form_validation->set_rules('email',  'email', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            $employee = $this->employee->get_single('employees', array('id' => $id));
            if (!empty($employee)) {
                
                $tableName = $this->db->get_where('designations',['id'=>$employee->designation_id])->row()->name;
                if ($this->db->table_exists(lcfirst($tableName))){
                    $this->employee->delete(lcfirst($tableName), array('id' => $id));
                }
    
                // delete employee data
                $this->employee->delete('employees', array('id' => $id));
                // delete employee login data
                $this->employee->delete('users', array('id' => $employee->user_id));
                
                 $tableName = $this->db->get_where('designations',['id'=>$this->input->post('designation_id')])->row()->name;
                if ($this->db->table_exists(lcfirst($tableName))){
                    if($this->db->field_exists('email',lcfirst($tableName))){
                        $this->employee->delete(lcfirst($tableName), array('email' => $this->input->post('email')));
                    }
                }
    
                // delete employee resume and photo
                $destination = 'assets/uploads/';
                if (file_exists($destination . '/employee-resume/' . $employee->resume)) {
                    @unlink($destination . '/employee-resume/' . $employee->resume);
                }
                if (file_exists($destination . '/employee-photo/' . $employee->photo)) {
                    @unlink($destination . '/employee-photo/' . $employee->photo);
                }          
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function deleteGuardian(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->employee->delete('guardians', array('id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function addEditStaff(){
        $this->_prepare_employee_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_employee_data();
            if($this->input->post('id')){
                $insert_id = $this->employee->update('employees', $data, array('id' => $this->input->post('id')));
            }else {
                $insert_id = $this->employee->insert('employees', $data);
            }
            if ($insert_id) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function addEditDriver(){
        
            $data['name']              =   $this->input->post('name');
            $data['birthday']          =   $this->input->post('birthday');
            $data['sex']               =   $this->input->post('sex');
            $data['email']               =   $this->input->post('email');
            $data['password']          =   md5($this->input->post('password'));
            $this->db->where('email',$data['email']);
            $query =$this->db->get('driver')->result_array();
           if(sizeof($query)==0){
               $this->db->insert('driver',$data);
               $response = array('status'=>200);
               
           }else{
               $response = array('status'=>209);
           }
        echo json_encode($response);
    }
    
    public function addEditGurdian(){
        $validationval = $this->_prepare_guardian_validation();
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_guardian_data();
            if($this->input->post('id')){
                $insert_id = $this->employee->update('guardians', $data, array('id' => $this->input->post('id')));
            }else {
                $insert_id = $this->employee->insert('guardians', $data);
            }
            if ($insert_id) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    private function _prepare_guardian_validation() {

        $this->form_validation->set_rules('relation', $this->lang->line('relation'), 'trim|required');
        $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('user_id', $this->lang->line('user_id'), 'trim|required');
        $this->form_validation->set_rules('profession', $this->lang->line('profession'), 'trim');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        
        $this->form_validation->set_rules('relation', $this->lang->line('relation'), 'trim');
        $this->form_validation->set_rules('photo', $this->lang->line('photo'), 'trim');
        $this->form_validation->set_rules('doc_prev_photo', $this->lang->line('doc_prev_photo'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');


    }
    
    private function _get_posted_guardian_data() {

        $items = array();

        $items[] = 'name';
        $items[] = 'phone';
        $items[] = 'profession';
        $items[] = 'present_address';
        $items[] = 'other_info';
        $items[] = 'student_id';
        $items[] = 'relation';
        

        $data = elements($items, $_POST);
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $data['status']     = 1;
            $data['year']       = $this->guardian->running_year();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_gurdian_upload_photo();
        }
        if ($_FILES['doc_photo']['name']) {
            $data['doc_photo'] = $this->_doc_gurdia_upload_photo();
        }
       

        return $data;
    }
    
    private function _gurdian_upload_photo(){
        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/guardian-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
    private function _doc_gurdia_upload_photo(){
        $prev_photo = $this->input->post('doc_prev_photo');
        $photo = $_FILES['doc_photo']['name'];
        $photo_type = $_FILES['doc_photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/guardian-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'doc-photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['doc_photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
    private function _get_posted_employee_data() {

        $items = array();
        $items[] = 'designation_id';
        $items[] = 'national_id';
        $items[] = 'name';
        $items[] = 'father_name';
        $items[] = 'mother_name';
        $items[] = 'phone';
        $items[] = 'present_address';
        $items[] = 'permanent_address';
        $items[] = 'gender';
        $items[] = 'blood_group';
        $items[] = 'religion';
        $items[] = 'other_info';
        $items[] = 'salary_grade_id';
        $items[] = 'salary_type';
        $items[] = 'facebook_url';
        $items[] = 'linkedin_url';
        $items[] = 'google_plus_url';
        $items[] = 'instagram_url';
        $items[] = 'pinterest_url';
        $items[] = 'twitter_url';
        $items[] = 'youtube_url';
        
        $data = elements($items, $_POST);  
        

        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['joining_date'] = date('Y-m-d', strtotime($this->input->post('joining_date')));
        $data['is_view_on_web'] = $this->input->post('is_view_on_web') ? 1 : 0;

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
            $data['status'] = 1;
             $data['year']      = $this->employee->running_year();
            // create user 
            $data['user_id'] = $this->employee->create_user();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_staff_upload_photo();
        }
        if ($_FILES['resume']['name']) {
            $data['resume'] = $this->_upload_resume();
        }
        return $data;
    }
    
    private function _staff_upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/employee-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
    private function _upload_resume() {
        
        $prev_resume = $this->input->post('prev_resume');
        $resume = $_FILES['resume']['name'];
        $resume_type = $_FILES['resume']['type'];
        $return_resume = '';

        if ($resume != "") {
            if ($resume_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    $resume_type == 'application/msword' || $resume_type == 'text/plain' ||
                    $resume_type == 'application/vnd.ms-office' || $resume_type == 'application/pdf') {

                $destination = 'assets/uploads/employee-resume/';

                $file_type = explode(".", $resume);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $resume_path = 'resume-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['resume']['tmp_name'], $destination . $resume_path);

                // need to unlink previous photo
                if ($prev_resume != "") {
                    if (file_exists($destination . $prev_resume)) {
                        @unlink($destination . $prev_resume);
                    }
                }

                $return_resume = $resume_path;
            }
        } else {
            $return_resume = $prev_resume;
        }

        return $return_resume;
    }
    
    private function _prepare_employee_validation() {
        if (!$this->input->post('id')) {       
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_staff_email');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
        }
        
        $this->form_validation->set_rules('role_id', $this->lang->line('role'), 'trim|required');
        $this->form_validation->set_rules('designation_id', $this->lang->line('designation'), 'trim|required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('permanent_address', $this->lang->line('permanent') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required');
        $this->form_validation->set_rules('user_id', $this->lang->line('user_id'), 'trim|required');
        $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim');
        $this->form_validation->set_rules('religion', $this->lang->line('religion'), 'trim');
        $this->form_validation->set_rules('dob', $this->lang->line('birth_date'), 'trim|required');
        $this->form_validation->set_rules('joining_date', $this->lang->line('join_date'), 'trim|required');
        $this->form_validation->set_rules('salary_grade_id', $this->lang->line('salary_grade'), 'trim|required');
        $this->form_validation->set_rules('salary_type', $this->lang->line('salary_type'), 'trim|required');
        $this->form_validation->set_rules('facebook_url', $this->lang->line('facebook_url'), 'trim');
        $this->form_validation->set_rules('linkedin_url', $this->lang->line('linkedin_url'), 'trim');
        $this->form_validation->set_rules('google_plus_url', $this->lang->line('google_plus_url'), 'trim');
        $this->form_validation->set_rules('instagram_url', $this->lang->line('instagram_url'), 'trim');
        $this->form_validation->set_rules('pinterest_url', $this->lang->line('pinterest_url'), 'trim');
        $this->form_validation->set_rules('twitter_url', $this->lang->line('twitter_url'), 'trim');
        $this->form_validation->set_rules('youtube_url', $this->lang->line('youtube_url'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');
    }
    
    public function staff_email(){
        if ($this->input->post('id') == '') {
            $email = $this->employee->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->employee->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
    function addEditExpenditures() {
        $response = array('status'=>200);
        $this->form_validation->set_rules('expenditure_head_id', $this->lang->line('expenditure_head'), 'trim|required');   
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|numeric');   
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');   
        $this->form_validation->set_rules('expenditure_via', $this->lang->line('expenditure') .' '. $this->lang->line('method'), 'trim|required');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
        $this->form_validation->set_rules('user_id', $this->lang->line('user_id'), 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_expenditure_data();
            if(!empty($this->input->post('id'))){
                $updated = $this->expenditure->update('expenditures', $data, array('id' => $this->input->post('id')));
                $insert_id = $this->input->post('id');
            } else {
                $updated = $this->expenditure->insert('expenditures', $data);
                $insert_id = $this->db->insert_id();
            }

            if ($updated) {
                $this->_save_fee_amount($insert_id);
                $response = array('status'=>200);                 
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    private function _get_posted_expenditure_data() {

        $items = array();
        $items[] = 'expenditure_head_id';
        $items[] = 'amount';
        $items[] = 'expenditure_via';
        $items[] = 'item_name';
        $items[] = 'rate';
        $items[] = 'qty';
        $items[] = 'tax';
        $items[] = 'discount';
        $items[] = 'note';
        
        $data = elements($items, $_POST);  
        $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['status'] = 1;
            $data['expenditure_type'] = 'general';
            $data['academic_year_id'] = $this->expenditure->running_year();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');                       
        }

        return $data;
    }
    
    function deleteExpenditures() {
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->expenditure->delete('expenditures', array('id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function addEditClass(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('name',  'id', 'trim|required');
        $this->form_validation->set_rules('name_numeric',  'name_numeric', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $data = array();
            $data['name']         = $this->input->post('name');
            if ($this->input->post('name_numeric') != null) {
                $data['name_numeric'] = $this->input->post('name_numeric');
                $exist_sortname =  $this->db->get_where('class',array('name_numeric'=>$data['name_numeric']))->num_rows();
                
                if($exist_sortname > 0){
                    echo json_encode(array(
                        'status' => 401,
                        'error' => strip_tags(validation_errors())
                    ));
                    die();
                }
            }
            if(!empty($this->input->post('id'))){
                $insert_id = $this->db->update('class', $data, array('class_id' => $this->input->post('id')));
            } else {
                $insert_id = $this->db->insert('class', $data);
                if($insert_id){
                    $class_id = $this->db->insert_id();
                    //create a section by default
                    $data2['class_id']  =   $class_id;
                    $data2['name']      =   'A';
                    $data2['teacher_id']=  NULL;
                    $this->db->insert('section' , $data2);
                }
            }

            if ($insert_id) {
                $response = array('status'=>200);                 
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function deleteClass(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('class', array('class_id' => $id))) {
                $this->db->delete('section', array('class_id' => $id));
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function addEditSection(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('name',  'id', 'trim|required');
        $this->form_validation->set_rules('class_id',  'class_id', 'trim|required');
        $this->form_validation->set_rules('teacher_id',  'teacher_id', 'trim|required');
        //$this->form_validation->set_rules('perifix_code',  'perifix_code', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $data = array();
            $data['name']         =   $this->input->post('name');
            $data['class_id']     =   $this->input->post('class_id');
            $data['teacher_id']   =   $this->input->post('teacher_id');
            $data['perifix_code'] =   uniqid();//$this->input->post('perifix_code');
            $data['name']         = $this->input->post('name');
            if ($this->input->post('nick_name') != null) {
                $data['nick_name'] = $this->input->post('nick_name');
            }
            if ($this->input->post('sub_teacher') != null) {
                $data['sub_teacher_status'] = 1;
               $data['date'] = $this->input->post('date');
               $sub_teacher = true;
            }
            $validation_teacher = $this->validation_teacher($data['teacher_id']);
            $validation         = duplication_of_section_on_create($data['class_id'], $data['name'],$sub_teacher);
            if($validation_teacher == 1){
                //$this->db->insert('section' , $data);
                if(!empty($this->input->post('id'))){
                    $insert_id = $this->db->update('section', $data, array('section_id' => $this->input->post('id')));
                } else {
                    $insert_id = $this->db->insert('section', $data);
                }
                if ($insert_id) {
                    $response = array('status'=>200);                 
                } else {
                    $response = array('status'=>400);
                }
            } else{
                if($validation_teacher == 0) {
                    $response = array('status'=>401,'error'=>'teacher_already_assigned');
                } else {
                    $response = array('status'=>401,'error'=>'duplicate_name_of_section_is_not_allowed');
                }

            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function validation_teacher($teacher = "",$param1 = ""){
      if($param1 != ""){
         $result = $this->db->get_where('section',array('teacher_id'=>$teacher));
        }else{
         $result = $this->db->get_where('section',array('teacher_id'=>$teacher));
        }
      
       if($result->num_rows() > 0){
        return 0;
       }else{
        return 1;
       }
    }
    
    public function deleteSection(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('section', array('section_id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function addEditSyllabus() {
        $response = array('status'=>200);
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('class_id', 'class_id', 'trim|required');
        $this->form_validation->set_rules('subject_id', 'subject_id', 'trim|required');
        $this->form_validation->set_rules('login_type', 'login_type', 'trim|required');
        $this->form_validation->set_rules('login_user_id', 'login_user_id', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
            $data = array();
            $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            $data['title']                  =   $this->input->post('title');
            $data['class_id']               =   $this->input->post('class_id');
            $data['subject_id']             =   $this->input->post('subject_id');
           // $data['uploader_type']          =   $this->session->userdata('login_type');
            $data['uploader_type']          =    $this->input->post('login_type');
            $data['uploader_id']            =   $this->input->post('login_user_id');
            $data['year']                   =   $this->year;
            $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
            //uploading file using codeigniter upload library
            $files = $_FILES['file_name'];
            if($files){
                $this->load->library('upload');
                $config['upload_path']   =  'uploads/syllabus/';
                $config['allowed_types'] =  '*';
                $_FILES['file_name']['name']     = $files['name'];
                $_FILES['file_name']['type']     = $files['type'];
                $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
                $_FILES['file_name']['size']     = $files['size'];
                $this->upload->initialize($config);
                $this->upload->do_upload('file_name');
                $data['file_name'] = $_FILES['file_name']['name'];
            }
            if(!empty($this->input->post('id'))){
                $insert_id =  $this->db->update('academic_syllabus', $data, array('academic_syllabus_id' => $this->input->post('id')));
            } else {
                $insert_id = $this->db->insert('academic_syllabus', $data);
            }

            if ($insert_id) {
                $response = array('status'=>200);                 
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function deleteSyllabus(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('academic_syllabus', array('academic_syllabus_id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function addEditSubject() {
        $response = array('status'=>200);
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('class_id', 'class_id', 'trim|required');
        $this->form_validation->set_rules('section_id', 'section_id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
            $data = array();
            $data['name']       = $this->input->post('name');
            $data['section_id'] = $this->input->post('section_id');
            $data['year']       = $this->year;
            $data['class_id']   =  $this->input->post('class_id');
            $data['year']     =   $this->year;
            if(!empty($this->input->post('id'))){
                $insert_id =  $this->db->update('subject', $data, array('subject_id' => $this->input->post('id')));
            } else {
                $insert_id = $this->db->insert('subject', $data);
            }

            if ($insert_id) {
                $response = array('status'=>200);                 
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function deleteSubject(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('subject', array('subject_id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    function addEditAssignSubject() {
        $response = array('status'=>200);
        $this->form_validation->set_rules('section_id', 'section_id', 'trim|required');
        $this->form_validation->set_rules('teacher_id', 'teacher_id', 'trim|required');
        $this->form_validation->set_rules('subject_id', 'subject_id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $this->year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
            $data = array();
            $alreadyExists = $this->db->get_where('assign_subject',array('section_id'=>$this->input->post('section_id'),'subject_id'=>$this->input->post('subject_id')))->row();
            $id = $this->input->post('id');
            if(!empty($alreadyExists)){
                $id = $alreadyExists->assign_id;
            }
            $data['subject_id']  = $this->input->post('subject_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['year']       = $this->year;
            $data['teacher_id'] = $this->input->post('teacher_id');
            if(!empty($id)){
                $insert_id =  $this->db->update('assign_subject', $data, array('assign_id' => $id));
            } else {
                $insert_id = $this->db->insert('assign_subject', $data);
            }
            if ($insert_id) {
                $response = array('status'=>200);                 
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function deleteAssignSubject(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $id = $this->input->post('id');
            if ($this->db->delete('assign_subject', array('assign_id' => $id))) {
                $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function getStaffBirthday(){
        $data = array();
        if(!empty($this->input->post('date_from')) && !empty($this->input->post('date_to'))){
            $this->employee->db->where('DATE_FORMAT(dob,"%m-%d") BETWEEN "'. date('m-d', strtotime($this->input->post('date_from'))). '" and "'. date('m-d', strtotime($this->input->post('date_to'))).'"');
        }
        if(!empty($this->input->post('designation_id'))){
            $this->employee->db->where('designation_id',$this->input->post('designation_id'));
        }
        $data = $this->employee->get_employee_list();
        $response = array();
        foreach($data as $obj){
            $staff = array();
             if($obj->photo != ''){ 
                $staff['photo']= UPLOAD_PATH."/employee-photo/".$obj->photo;
            } else {
                $staff['photo']= IMG_URL."/default-user.png";
            }
            $staff['name']=ucfirst($obj->name);
            $staff['designation']=$obj->designation;
            $staff['phone']=$obj->phone;
            $staff['email']=$obj->email;
            $staff['join_date']= $obj->joining_date;
            $staff['is_view_on_web']=$obj->is_view_on_web ?'yes' : 'no';
            $staff['dob']=$obj->dob; 
            array_push($response,$staff);
        }
        $this->db->select('T.*');
        $this->db->from('teacher AS T');  
        if(!empty($this->input->post('date_from')) && !empty($this->input->post('date_to'))){
            $this->db->where('DATE_FORMAT(STR_TO_DATE(REPLACE(birthday,"/","-"),"%m-%d-%Y"),"%m-%d") BETWEEN "'. date('m-d', strtotime($this->input->post('date_from'))). '" and "'. date('m-d', strtotime($this->input->post('date_to'))).'"');
        }
        $data = $this->db->get()->result();
        foreach($data as $obj){
            $staff = array();
            $staff['photo']= $this->crud_model->get_image_url('teacher', $obj->teacher_id);
            $staff['name']=ucfirst($obj->name);
            $staff['designation']='Teacher';
            $staff['phone']=$obj->phone;
            $staff['email']=$obj->email;
            $staff['join_date']= $obj->doj;
            $staff['is_view_on_web']='yes';
            $staff['dob']=$obj->birthday; 
            array_push($response,$staff);
        }
        echo json_encode(['sattus'=>200,'data'=>$response]);;
    }
    
    public function getStudentBirthday(){
        $option = array(
            'status' => 1,
            'year' => $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description,
            );
        if(!empty($this->input->post('date_from')) && !empty($this->input->post('date_from'))){
            $option = 'DATE_FORMAT(STR_TO_DATE(REPLACE(birthday,"/","-"),"%m-%d-%Y"),"%m-%d") BETWEEN "'. date('m-d', strtotime($this->input->post('date_from'))). '" and "'. date('m-d', strtotime($this->input->post('date_to'))).'"';
        }
        $students = $this->db->get_where('student',$option)->result_array();
        $response=array();
        foreach ($students as $row) {
            if(!empty($this->input->post('section_id'))){
                $this->db->where('section_id',$this->input->post('section_id'));    
            }
            
            if(!empty($this->input->post('class_id'))){
                $this->db->where('class_id',$this->input->post('class_id'));   
            }
            $enrol = @$this->db->get_where('enroll', array(
                'student_id' => $row['student_id']
            ))->row();
            if(empty($enrol)){
                continue;
            }
            $data['student_id']  = $enrol->student_id;
            $data['roll']        = $enrol->roll;
            $data['name']        = $row['name'];
            $data['birthday']    = $row['birthday'];
            $data['gender']      = $row['sex'];
            $data['address']     = $row['address'];
            $data['phone']       = $row['phone'];
            $data['email']       = $row['email'];
            $data['status']      = $row['status'];
            $data['class']       = @$this->db->get_where('class', array(
                'class_id' => $enrol->class_id
            ))->row()->name;
            $data['section']     = @$this->db->get_where('section', array(
                'section_id' => $enrol->section_id
            ))->row()->name;
            $parent_id           = $row['parent_id'];

            $parent_name = $this->db->get_where('parent', array(
                'parent_id' => $parent_id))->row();
            if ($parent_name) {
                $data['parent_name'] = $this->db->get_where('parent', array(
                    'parent_id' => $parent_id))->row()->name;
            }
            $data['image_url']   = $this->crud_model->get_image_url('student', $row['student_id']);
            array_push($response, $data);
        }
        echo json_encode(['status'=>200,'data'=>$response]);
    }
    
    public function updateAdvancePayment(){
        $response = array('status'=>200);
        $this->form_validation->set_rules('month',  'month', 'trim|required');
        $this->form_validation->set_rules('year',  'year', 'trim|required');
        $this->form_validation->set_rules('designation_id',  'designation_id', 'trim|required');
        $this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
        $this->form_validation->set_rules('advance_salary',  'advance_salary', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $month = $this->input->post('month');
            $year  = $this->input->post('year');
            $designation_id = $this->input->post('designation_id');
            $user_id = $this->input->post('user_id');
            $advance_salary = $this->input->post('advance_salary');
            $query = $this->db->get_where('employee_total_salary' ,array(
                   'designation_id' => $designation_id,
                     'employee_id' => $user_id,
                       'MONTH(date)' => $month,
                       'YEAR(date)' => $year

                    ));

            if($query->num_rows() < 1){
                $attn_data['designation_id']   = $designation_id;
                $attn_data['total_salary']  = $advance_salary;
                $date = $year . '-' . $month . '-01' ;
                $attn_data['date']  = $date;
                $attn_data['employee_id'] = $user_id;
                $this->db->insert('employee_total_salary' , $attn_data);
            } else {
                $this->db->where('designation_id',$designation_id)->where('employee_id',$user_id)->where('MONTH(date)',$month)->where('YEAR(date)',$year);              
                $this->db->update('employee_total_salary',array('total_salary' => $advance_salary ));
            }
            $response = array('status'=>200);
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function getHostelByStudent(){
        $this->form_validation->set_rules('id',  'id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $response = [
                'status'=>200,
                'data'=>$this->db->get_where('hostel_members',['user_id'=>$this->input->post('id')])->result_array()];
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($response);
    }
    
    public function getBedByHOstelRoom(){
        $response = array();
        $this->form_validation->set_rules('hostel_id',  'hostel_id', 'trim|required');
        $this->form_validation->set_rules('room_id',  'room_id', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
        
        $hostel_id = $this->input->post('hostel_id');
        $room_id = $this->input->post('room_id');
        $hostels   = $this->ajax->get_list('rooms', array('status' => 1,'id' => $room_id), '', '', '', 'id', 'ASC');    if (!empty($hostels)) {
                foreach ($hostels as $obj){
    
                     for($i=1; $i < $obj->total_seat + 1; $i++){
                       $roomCount   = $this->db->get_where('hostel_members_staff', array('status' => 1,'room_id' => $room_id,'beds'=>$i))->result();
                        $roomCountStudent   = $this->db->get_where('hostel_members', array('status' => 1,'room_id' => $room_id,'beds'=>$i))->result();
                            if(empty($roomCount) && empty($roomCountStudent)){
                                array_push($response,['room_id'=>$obj->id,'beds'=>$i]);
                            }
                      }
                }
            }
        } else {
            $response = array(
                'status' => 401,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode(['status'=>200,'data'=>$response]);
    }
    
    public function deleteExam(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
                if ($this->db->delete('exam', array('exam_id' => $this->input->post('id')))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    public function deleteExamSchedule(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
                if ($this->db->delete('exam_schedule', array('id' => $this->input->post('id')))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    public function deleteExamGrades(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
                if ($this->db->delete('grade', array('grade_id' => $this->input->post('id')))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    public function addEditVehicles(){
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
        $this->form_validation->set_rules('contact', $this->lang->line('vehicle_contact'), 'trim|required');
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('license', $this->lang->line('vehicle_license'), 'trim');
        $this->form_validation->set_rules('driver', $this->lang->line('driver'), 'trim');
        $this->form_validation->set_rules('model', $this->lang->line('vehicle_model'), 'trim');
        $this->form_validation->set_rules('number', $this->lang->line('vehicle') . ' ' . $this->lang->line('number'), 'required|trim|callback_vehicle_number');
        if ($this->form_validation->run() === TRUE) {
            $data = $this->_get_posted_vehicle_data();
            if(!empty($this->input->post('id'))){
                $insert_id = $this->vehicle->update('vehicles', $data, array('id' => $this->input->post('id')));
            }else{
                $insert_id = $this->vehicle->insert('vehicles', $data);
            }
            if ($insert_id) {
                 $response = array('status'=>200);
            } else {
                $response = array('status'=>400);
            }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    private function _get_posted_vehicle_data() {

        $items = array();
        $items[] = 'number';
        $items[] = 'model';
        $items[] = 'driver';
        $items[] = 'license';
        $items[] = 'contact';
        $items[] = 'note';
        $items[] = 'owner_name';
        $items[] = 'owner_mobile';
        $items[] = 'owner_address';

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['owner_name'] = $_POST['owner_name'];
            $data['alternate_contact'] = $_POST['alternate_contact'];
             $data['vehicle_owned'] = $_POST['vehicle_owned'];
             $data['license'] = $_POST['license'];
            $data['modified_by'] = $this->input->post('user_id');
        } else {
            $data['status'] = 1;
            $data['is_allocated'] = 0;
            $data['owner_name'] = $_POST['owner_name'];
             $data['alternate_contact'] = $_POST['alternate_contact'];
             $data['license'] = $_POST['license'];
             $data['vehicle_owned'] = $_POST['vehicle_owned'];
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->input->post('user_id');
        }

        return $data;
    }
    
    public function getDrivers(){
         $driver  = $this->db->get('driver')->result_array();
          $data['status'] = 200;
        $data['message'] = 'success';
        $data['drivers'] = $driver;

    echo json_encode($data);
    }
     public function getDriversById(){
         $this->db->where('driver_id',$this->input->post('driver_id'));
         $driver  = $this->db->get('driver')->result_array();
          $data['status'] = 200;
        $data['message'] = 'success';
        $data['drivers'] = $driver;

    echo json_encode($data);
    }
    
    public function deleteVehicles(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
                if ($this->db->delete('vehicles', array('id' => $this->input->post('id')))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    public function vehicle_number() {
        if ($this->input->post('id') == '') {
            $vehicle = $this->vehicle->duplicate_check($this->input->post('number'));
            if ($vehicle) {
                $this->form_validation->set_message('number', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $vehicle = $this->vehicle->duplicate_check($this->input->post('number'), $this->input->post('id'));
            if ($vehicle) {
                $this->form_validation->set_message('number', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
   /* public function updateVehicleOfRoute(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        $this->form_validation->set_rules('vehicle_id', 'vehicle_id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
                if ($this->db->update('vehicles', ['vehicle_id'=>$this->input->post('vehicle_id')], array('id' => $this->input->post('id')))) { 
                        $response = array('status'=>200);
                } else {
                        $response = array('status'=>400);
                }
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }*/
    
    public function updateVehicleOfRoute(){
        $this->form_validation->set_rules('id', 'id', 'trim|required');   
        $this->form_validation->set_rules('vehicle_id', 'vehicle_id', 'trim|required');   
        if ($this->form_validation->run() === TRUE) {
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('routes',array('vehicle_ids'=>$this->input->post('vehicle_id')));
            $response = array('status'=>200);
            
        } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
        echo json_encode($response);
    }
    
    public function getStudentOfClass(){
         $this->form_validation->set_rules('id', 'id', 'trim|required');   
    }
    
    public function updateTransportId(){
         $this->form_validation->set_rules('route_id', 'route_id', 'trim|required');   
        $this->form_validation->set_rules('student_id', 'student_id', 'trim|required');   
         if ($this->form_validation->run() === TRUE) {
              $this->db->where('student_id',$this->input->post('student_id'));
            $this->db->update('student',array('transport_id'=>$this->input->post('route_id')));
            $this->db->update('student',array('is_transport_member'=>1));
            $response = array('status'=>200);
     
             
             
         } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
         echo json_encode($response);
       
    }
       public function unassign_vehicle(){
        $this->form_validation->set_rules('student_id', 'student_id', 'trim|required');   
         if ($this->form_validation->run() === TRUE) {
              $this->db->where('student_id',$this->input->post('student_id'));
            $this->db->update('student',array('transport_id'=>null));
            $this->db->update('student',array('is_transport_member'=>0));
            $response = array('status'=>200);
     
             
             
         } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
         echo json_encode($response);
       
    }
    
    public function getParentsByStudent(){
        $this->form_validation->set_rules('student_id', 'student_id', 'trim|required');   
         if ($this->form_validation->run() === TRUE) {
             $this->db->select('parent.*');
            $this->db->where('student.student_id',$this->input->post('student_id'));
            $this->db->join('parent', 'parent.parent_id = student.parent_id','left');
            // $this->db->join('guardians', 'guardians.student_id = student.parent_id','left');
            $response = array(
                'status'=>200,
                'data' => $this->db->get('student')->result_array()
                );
             
             
         } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
         echo json_encode($response);
    }
    
    public function getAssignSectionForTeacher(){
        $this->form_validation->set_rules('teacher_id', 'teacher_id', 'trim|required');   
         if ($this->form_validation->run() === TRUE) {
            $response = array(
                'status'=>200,
                'data' => $this->db->get_where('section',['teacher_id'=>$this->input->post('teacher_id')])->result_array()
                );
             
             
         } else {
                $response = array(
                    'status' => 401,
                    'error' => strip_tags(validation_errors())
                );
        }
         echo json_encode($response);
    }
    
    public function getClassDetails(){
        $response = $this->crud_model->getClassDetails();
        echo json_encode(['status'=>200,'data'=>$response]);
    }
    
    
    
    // function assignMarks(){
    //     $response = array('status'=>200);
    //     $this->form_validation->set_rules('exam_id',  'exam_id', 'trim|required');
    //     $this->form_validation->set_rules('cycle_id',  'cycle_id', 'trim|required');
    //     $this->form_validation->set_rules('class_id',  'class_id', 'trim|required');
    //     $this->form_validation->set_rules('section_id',  'section_id', 'trim|required');
    //     $this->form_validation->set_rules('subject_id',  'subject_id', 'trim|required');
    //     if ($this->form_validation->run() === TRUE) {
    //         $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    //         $marks_of_students = $this->db->get_where('mark' , array(
    //             'exam_id' => $this->input->post('exam_id'),
    //               'cycle_id' => $this->input->post('cycle_id'),
    //                 'class_id' => $this->input->post('class_id'),
    //                     'section_id' => $this->input->post('section_id'),
    //                         'year' => $running_year,
    //                             'subject_id' => $this->input->post('subject_id')
    //         ))->result_array();
    //         foreach($marks_of_students as $row) {
    //             $this->form_validation->set_rules('marks_obtained/'.$row['mark_id'], "marks_obtained", "trim|required");
    //             $this->form_validation->set_rules('max_marks/'.$row['mark_id'], "max_marks", "trim|required");
    //             $this->form_validation->set_rules('comment/'.$row['mark_id'], "comment", "trim");
    //             $this->form_validation->set_rules('grade_id/'.$row['mark_id'], "grade_id", "trim|required");
    //             if ($this->form_validation->run() === TRUE) {
    //                 $obtained_marks = $this->input->post('marks_obtained/'.$row['mark_id']);
    //                 $mark_total = $this->input->post('max_marks/'.$row['mark_id']);
    //                 $comment = $this->input->post('comment/'.$row['mark_id']);
    //                  $grade_id = $this->input->post('grade_id/'.$row['mark_id']);
    //                 $this->db->where('mark_id' , $row['mark_id']);
    //                 $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment,'mark_total'=>$mark_total,'grade_id'=>$grade_id));
    //                 $subject = $this->db->get_where('subject_competencies' , array('subject_id' =>$row['subject_id']))->result_array();
                  
    //                 foreach($subject as $row2) { 
    //                     $this->form_validation->set_rules('marks_'. str_replace(' ', '', $row2['name']).'_'.$row['mark_id'], 'marks_'. str_replace(' ', '', $row2['name']).'/'.$row['mark_id'], "trim|required");
    //                     if ($this->form_validation->run() === TRUE) {
    //                         $this->db->query("update cat_mark set competencies_marks='".$this->input->post('marks_'. str_replace(' ', '', $row2['name']).'_'.$row['mark_id'])."' where mark_id='".$row['mark_id']."' and competencies_name='".$row2['name']."'");
    //                     } else {
    //                         $response = array(
    //                             'status' => 400,
    //                             'error' => strip_tags(validation_errors())
    //                         );
    //                         echo json_encode($response);die;
    //                     }
    //                 } 
                       
    //                 $practial = $this->db->get_where('subject_practial' , array('subject_id' =>$row['subject_id']))->result_array();
                  
    //                 foreach($practial as $row22) { 
    //                     $this->form_validation->set_rules('marks_'. str_replace(' ', '', $row22['name']).'/'.$row['mark_id'], 'marks_'. str_replace(' ', '', $row22['name']).'/'.$row['mark_id'], "trim|required");
    //                     if ($this->form_validation->run() === TRUE) {
    //                         $this->db->query("update cat_mark set competencies_marks='".$this->input->post('marks/'. str_replace(' ', '', $row22['name']).'/'.$row['mark_id'])."' where mark_id='".$row['mark_id']."' and competencies_name='".$row22['name']."'");
    //                     } else {
    //                         $response = array(
    //                             'status' => 400,
    //                             'error' => strip_tags(validation_errors())
    //                         );
    //                         echo json_encode($response);die;
    //                     }
    //                 }
    //             } else {
    //                 $response = array(
    //                     'status' => 400,
    //                     'error' => strip_tags(validation_errors())
    //                 );
    //                 echo json_encode($response);die;
    //             }
                   
    //         }
    //     } else {
    //         $response = array(
    //             'status' => 401,
    //             'error' => strip_tags(validation_errors())
    //         );
    //     }
    //     echo json_encode($response);
    // }
    
    // function addAdvancePayment(){
    //     $this->form_validation->set_rules('designation_id', $this->lang->line('designation_id'), 'trim|required');
    //     $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');
    //     $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required');
    //     $this->form_validation->set_rules('user_id', $this->lang->line('user_id'), 'trim|required');
    //     if($this->form_validation->run() === TRUE){
    //         $data['designation_id']   = $this->input->post('designation_id');
    //         $data['date']       = $this->input->post('date');
    //         $data['employee_id']  = $this->input->post('user_id');
    //         $data['amount']  = $this->input->post('amount');
    //         $insert_id = $this->db->insert('advance_pay', $data);
    //         if ($insert_id) {
    //             $response = array('status' => 200);
    //         } else {
    //             $response = array('status' => 400);
    //         }
    //     }else { 
    //         $response = array(
    //                 'status' => 400,
    //                 'error' => strip_tags(validation_errors())
    //             );
    //     }
    //     echo json_encode($response);
    // }
    
    // function getAdvancePayment(){
    //     if(!empty($this->input->post('designation_id'))){
    //         $data = array('status'=>200,'data'=>$this->db->get_where('advance_pay',['designation_id'=>$this->input->post('designation_id')]));
    //     }else {
    //         $data = array('status'=>200,'data'=>$this->db->get_where('advance_pay'));
    //     }
    //     echo json_encode($data);
    // }
}
