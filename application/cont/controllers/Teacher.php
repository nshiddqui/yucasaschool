<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Teacher extends MY_Controller
{
  function __construct()
    {
        //die();
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        $this->load->model('Assignment_Model', 'assignment', true);
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         if($this->session->userdata('login_user_id') == "" ){
             redirect(base_url(), 'refresh'); 
          }
    }

    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(site_url('teacher/dashboard'), 'refresh');
    }

    /***TEACHER DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url(login), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }

function student_add()
    {
        //print_r($this->session->userdata());die;

        $page_data['field_arr']              = $this->crud_model->registration_form_fiels();
        $page_data['create_dianamic_field']  = $this->crud_model->get_registration_fields();
        $page_data['page_name']  = 'student_add';
        $page_data['active_link']  = 'student_add';
        $page_data['page_title'] = get_phrase('add_student');
        $this->load->view('backend/index', $page_data);
    }
    /*ENTRY OF A NEW STUDENT*/


    /****MANAGE STUDENTS CLASSWISE*****/

	function student_information($class_id = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');

		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
		$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}

  function student_profile($student_id)
  {
    if ($this->session->userdata('teacher_login') != 1) {
      redirect(base_url(), 'refresh');
    }
    $page_data['page_name']  = 'student_profile';
		$page_data['page_title'] = get_phrase('student_profile');
    $page_data['student_id']  = $student_id;
		$this->load->view('backend/index', $page_data);
  }

	function student_marksheet($student_id = '') {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/student_marksheet_print_view', $page_data);
    }



    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_subject($class_id)
    {
         $techer_id     = $this->session->userdata('login_user_id');
       // $subject = $this->db->get_where('subject' , array(
           // 'class_id' => $class_id ,'teacher_id'=>$this->session->userdata('teacher_id')
      //  ))->result_array();
        
        $subject = $this->db->query("SELECT assign_subject.subject_id,subject.name FROM assign_subject LEFT JOIN subject ON subject.subject_id=assign_subject.subject_id  WHERE assign_subject.teacher_id=$techer_id AND subject.class_id=$class_id ")->result_array();
       
        
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');

            if ($this->input->post('teacher_id') != null) {
                $data['teacher_id'] = $this->input->post('teacher_id');
            }
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($data['class_id'] != '') {
                $this->db->insert('subject', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('select_class'));
            }

            redirect(site_url('teacher/subject/'.$data['class_id']), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');

            if ($this->input->post('teacher_id') != null) {
                $data['teacher_id'] = $this->input->post('teacher_id');
            }
            else{
                $data['teacher_id'] = null;
            }
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($data['class_id'] != '') {
               $this->db->where('subject_id', $param2);
               $this->db->update('subject', $data);
               $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('select_class'));
            }

            redirect(site_url('teacher/subject/'.$data['class_id']), 'refresh');
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(site_url('teacher/subject/'.$param3), 'refresh');
        }
        $teacher_id=$this->session->userdata('teacher_id');
        $year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1,'teacher_id'=>$this->session->userdata('teacher_id'),'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
       
        $this->db->select('AE.*');
        $this->db->select('AE.*,C.name as class_name,C.class_id as class_id,S.name as subject_name, S.subject_id as subject_id');
        $this->db->from('assign_subject AS AE');
        $this->db->join('subject AS S', 'S.subject_id = AE.subject_id');
        $this->db->join('class AS C', 'C.class_id = S.class_id');
        $this->db->where('AE.year', '2018-2019');
        $this->db->where('AE.teacher_id', $this->session->userdata('login_user_id'));  
        $classes= $this->db->get()->result();
         $page_data['class_by'] =$classes;
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }



    /****MANAGE EXAM MARKS*****/
    function marks_manage()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        if($data['class_id'] != '' && $data['exam_id'] != ''){
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']
                ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(site_url('teacher/marks_manage_view/'. $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id']) , 'refresh');

    }
else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
}
}
    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        if ($class_id != '' && $exam_id != '') {
        $marks_of_students = $this->db->get_where('mark' , array(
            'exam_id' => $exam_id,
                'class_id' => $class_id,
                    'section_id' => $section_id,
                        'year' => $running_year,
                            'subject_id' => $subject_id
        ))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment));
        }
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(site_url('teacher/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id), 'refresh');
    }
    else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
    }

    function marks_get_subject($class_id="",$section="")
    {
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section;
        $this->load->view('backend/teacher/marks_get_subject' , $page_data);
    }


    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

       
        $subject_id              = $this->db->query("select subject_id from subject where FIND_IN_SET($class_id,class_id) AND year ='".$this->year."'")->result();
        $page_data['subject_id'] = $subject_id;
        $page_data['page_name']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function upload_academic_syllabus()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['no_of_modules']          =   $this->input->post('no_of_modules');
        if ($this->input->post('subject_id') != null) {
           $data['subject_id']          =   $this->input->post('subject_id');
        }
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        //uploading file using codeigniter upload library
        $files = $_FILES['file_name'];
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

        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
        redirect(site_url('teacher/academic_syllabus/'. $data['class_id']) , 'refresh');

    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(site_url('teacher/backup_restore'), 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(site_url('teacher/backup_restore'), 'refresh');
        }

        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            $validation = email_validation_for_edit($data['email'], $this->session->userdata('teacher_id'), 'teacher');
            if ($validation == 1) {
                $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
                $this->db->update('teacher', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(site_url('teacher/manage_profile/'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('teacher', array(
                'teacher_id' => $this->session->userdata('teacher_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
                $this->db->update('teacher', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(site_url('teacher/manage_profile/'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('teacher', array(
            'teacher_id' => $this->session->userdata('teacher_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($class_id)
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

      /**********MANAGING CLASS ROUTINE******************/
    function class_timetable($param1 = '', $param2 = '', $param3 = '')
    {
        //$page_data['page_name']       = 'class_timetable';
        //$page_data['template_data_result'] = $this->db->get_where('class_routine_template',array('id'=>$param3))->row();
        //$page_data['class_id']         = $param1;
        //$page_data['section_id']       = $param2;
        //$page_data['template_id']      = $param3;
       // $page_data['page_title']       = get_phrase('class_routine');
       // $this->load->view('backend/index', $page_data);
        
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $page_data['template_data_result'] = $this->db->query(" SELECT `id` FROM `class_routine_template` where status=1")->row();
        $page_data['page_name']       = 'class_timetable';
         $page_data['page_title']       = get_phrase('daily_class_routine');
        $page_data['teacher_id'] = $this->session->userdata('login_user_id');
        $this->load->view('backend/index' , $page_data);
       
    }



    function addclass_routine_data(){
      if ($_POST != '') {
          //echo "<pre>";print_r($_POST);die;
        $count_vartical =  count($_POST['period']);
        if($count_vartical > 0){
            $count_horizontal = count($_POST['period'][0]); 
            $j=0;
            for($i=0;$i<$count_vartical;$i++){
                for($k=0;$k<$count_horizontal;$k++){
                   // $this->db->get_where
                    $editvalue                = $this->input->post('editvalue')[$i][$k];
                    $data1['subject_id']       = $this->input->post('subject_id')[$i][$k];
                    $data1['teacher_id']       = $this->input->post('teacher')[$i][$k];
                    $data1['create_at']        = date("Y-m-d H:i:s");

                    if($editvalue == ""){  
                        $data['section_id']       = $this->input->post('section_id');
                        $data['template_id']      = $this->input->post('template_id');
                        $data['class_id']         = $this->input->post('class_id');
                        $data['period']           = $this->input->post('period')[$i][$k];
                        $data['day']              = $this->input->post('day')[$i][$k];
                        $data['year']             = $this->year;
                        $data['time_start']       = strtotime($this->input->post('time_start')[$i][$k]);
                        $data['time_end']         = strtotime($this->input->post('endtime')[$i][$k]);
                        $data['subject_id']       = $this->input->post('subject_id')[$i][$k];
                        $data['teacher_id']       = $this->input->post('teacher')[$i][$k];
                        $data['create_at']        = date("Y-m-d H:i:s");

                    $this->db->insert('class_routine', $data); 
                }else{
                  $this->db->where('class_routine_id',$editvalue);
                  $this->db->update('class_routine',$data1);
                }

            $data['class_id']         = $this->input->post('class_id');
            $data['section_id']       = $this->input->post('section_id');
            $data['template_id']      = $this->input->post('template_id');
           }
        }
    }
    redirect(site_url('teacher/class_timetable/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['template_id']), 'refresh');
  }
}

    function class_dailytimetable($param1="",$param2="",$param3=""){
      
        $page_data['page_name']            = 'class_dailyroutine';
        $page_data['template_data_result'] = $this->db->get_where('class_routine_template',array('class_id'=>$param1,'section_id'=>$param2))->row();
        $page_data['class_id']             = $param1;
        $page_data['section_id']           = $param2;
       // $page_data['template_id']          = $param3;
        $page_data['page_title']           = get_phrase('teacher_routine');
        $this->load->view('backend/index', $page_data);

    }


    function class_routine_print_view()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $page_data['teacher_id'] = $this->session->userdata('login_user_id');
        $this->load->view('backend/teacher/class_routine_print_view' , $page_data);
    }

	/****** DAILY ATTENDANCE *****************/

   function manage_attendance()
    {
        if($this->session->userdata('teacher_login')!=1)
            redirect(site_url('login'), 'refresh');

        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class');
        $this->load->view('backend/index', $page_data);
    }

    /****** DAILY ATTENDANCE *****************/
    function manage_attendance_rfid()
    {
        if($this->session->userdata('teacher_login')!=1)
            redirect(base_url() , 'refresh');   
        $page_data['page_name']  =  'manage_attendance_rfid';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class');
        $this->load->view('backend/index', $page_data);
    }



    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('teacher_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('manage_attendance_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
    }

   function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
        
       
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();

            foreach($students as $row) {
                $query = $this->db->get_where('attendance' ,array(
                 'class_id'=>$data['class_id'],
                    'section_id'=>$data['section_id'],
                      'year'=>$data['year'],
                        'timestamp'=>$data['timestamp'],
                           'student_id'=>$row['student_id']
                ));
              
                if($query->num_rows() < 1) {
                    $attn_data['class_id']   = $data['class_id'];
                    $attn_data['year']       = $data['year'];
                    $attn_data['timestamp']  = $data['timestamp'];
                    $attn_data['section_id'] = $data['section_id'];
                    $attn_data['student_id'] = $row['student_id'];

                   // print_r($attn_data); die;
                    $this->db->insert('attendance' , $attn_data);
                }

        }
        redirect(site_url('teacher/manage_attendance_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['timestamp']),'refresh');
    }
	
	    function attendance_report_selector()
    {   if($this->input->post('class_id') == '' || $this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(site_url('teacher/attendance_report'), 'refresh');
        }
        $data['class_id']       = $this->input->post('class_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(site_url('teacher/attendance_report_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['sessional_year']), 'refresh');
    }
     function attendance_report_view($class_id = '', $section_id = '', $month = '', $sessional_year = '')
     {
         if($this->session->userdata('teacher_login')!=1)
            redirect(base_url() , 'refresh');

        $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['page_name']         = 'attendance_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
     }

     function attendance_report_print_view($class_id ='' , $section_id = '' , $month = '', $sessional_year = '') {
          if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $this->load->view('backend/admin/attendance_report_print_view' , $page_data);
    }
	
        ///////ATTENDANCE REPORT /////
     function attendance_report() {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['page_title']   = get_phrase('attendance_report');
         $this->load->view('backend/index',$page_data);
     }
    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    if($parent_id != null && $parent_id != 0){
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        if($receiver_phone != '' || $receiver_phone != null){
                            //$this->sms_model->send_sms($message,$receiver_phone);
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    }
                    else{
                        $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                    }
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(site_url('teacher/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp ), 'refresh');
    }


    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }

     function book_request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "create")
        {
            $this->crud_model->create_book_request();
            $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
            redirect(site_url('teacher/book_request/'), 'refresh');
        }

        $data['page_name']  = 'book_request';
        $data['page_title'] = get_phrase('book_request');
        $this->load->view('backend/index', $data);
    }

    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');

        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);

    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(site_url('teacher/noticeboard/'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(site_url('teacher/noticeboard/'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(site_url('teacher/noticeboard/'), 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get_where('noticeboard',array('status'=>1))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(site_url('teacher/manage_document'), 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(site_url('teacher/manage_document'), 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*********MANAGE STUDY MATERIAL************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_saved_successfuly'));
            redirect(site_url('teacher/study_material/'), 'refresh');
        }

        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , get_phrase('study_material_info_updated_successfuly'));
            redirect(site_url('teacher/study_material/'), 'refresh');
        }

        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(site_url('teacher/study_material/'), 'refresh');
        }

        $data['study_material_info']    = $this->crud_model->select_study_material_info_for_teacher();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $max_size = 2097152;
        if ($param1 == 'send_new') {

            // Folder creation
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                  redirect(site_url('teacher/message/message_new/'), 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('teacher/message/message_read/'.$message_thread_code), 'refresh');
        }

        if ($param1 == 'send_reply') {

            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                  redirect(site_url('teacher/message/message_read/'.$param2), 'refresh');

              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('teacher/message/message_read/'.$param2), 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    //GROUP MESSAGE
    function group_message($param1 = "group_message_home", $param2 = ""){
      if ($this->session->userdata('teacher_login') != 1)
          redirect(base_url(), 'refresh');
      $max_size = 2097152;

      if ($param1 == 'group_message_read') {
        $page_data['current_message_thread_code'] = $param2;
      }
      else if($param1 == 'send_reply'){
        if (!file_exists('uploads/group_messaging_attached_file/')) {
          $oldmask = umask(0);  // helpful when used in linux server
          mkdir ('uploads/group_messaging_attached_file/', 0777);
        }
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          if($_FILES['attached_file_on_messaging']['size'] > $max_size){
            $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
              redirect(site_url('teacher/group_message/group_message_read/'.$param2), 'refresh');
          }
          else{
            $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
          }
        }

        $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
          redirect(site_url('teacher/group_message/group_message_read/'.$param2), 'refresh');
      }
      $page_data['message_inner_page_name']   = $param1;
      $page_data['page_name']                 = 'group_message';
      $page_data['page_title']                = get_phrase('group_messaging');
      $this->load->view('backend/index', $page_data);
    }

    // MANAGE QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == "create")
        {
            $this->crud_model->create_question_paper();
            $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
            redirect(site_url('teacher/question_paper'), 'refresh');
        }

        if ($param1 == "update")
        {
            $this->crud_model->update_question_paper($param2);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(site_url('teacher/question_paper'), 'refresh');
        }

        if ($param1 == "delete")
        {
            $this->crud_model->delete_question_paper($param2);
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(site_url('teacher/question_paper'), 'refresh');
        }

        $data['page_name']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }



    function question_paper_reset_password($param1 = "", $param2 = "")
    {
       
   
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 != "")
        {
          
            $email=$this->session->userdata('email');

           $data1['password'] =$random= substr(md5(mt_rand()), 0, 7);
           $this->db->where('question_paper_id',$param1);
           $this->db->update('question_paper',$data1);
      $msg = "Dear User Please click Below Link and Reset Password\n  Your Reset Password is $random ";

       mail("$email","Reset Question Pepar Password",$msg);
            $this->session->set_flashdata('flash_message', get_phrase('Please_check_your_email'));
            redirect(site_url('teacher/question_paper'), 'refresh');
        }
        $data['page_name']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }



    function question_paper_password($param1 = "", $param2 = "")
    {

   
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 != "")
        {
      $msg = "Dear User Please click Below Link and Reset Password\n<a href='https://www.edurama.in/unityerp/index.php/teacher/question_paper_password?question_pepar_id=$param2'></a>";

       mail("developer.team1@cyberworx.in","Reset Question Pepar Password",$msg);
            $this->session->set_flashdata('flash_message', get_phrase('Please_check_your_email'));
            redirect(site_url('teacher/question_paper'), 'refresh');
        }

       

        $data['page_name']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }





    // Details of searched student
    function student_details(){
      if ($this->session->userdata('teacher_login') != 1)
          redirect(base_url(), 'refresh');

      $student_identifier = $this->input->post('student_identifier');
      $query_by_code = $this->db->get_where('student', array('student_code' => $student_identifier));

      if ($query_by_code->num_rows() == 0) {
        $this->db->like('name', $student_identifier);
        $query_by_name = $this->db->get('student');
        if ($query_by_name->num_rows() == 0) {
          $this->session->set_flashdata('error_message' , get_phrase('no_student_found'));
            redirect(site_url('teacher/dashboard'), 'refresh');
        }
        else{
          $page_data['student_information'] = $query_by_name->result_array();
        }
      }
      else{
        $page_data['student_information'] = $query_by_code->result_array();
      }
      $page_data['page_name']  	= 'search_result';
  		$page_data['page_title'] 	= get_phrase('search_result');
  		$this->load->view('backend/index', $page_data);
    }

    function get_teachers() {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'teacher_id',
            1 => 'photo',
            2 => 'name',
            3 => 'email',
            4 => 'phone',
            5 => 'teacher_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData     = $this->ajaxload->all_teachers_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {            
            $teachers = $this->ajaxload->all_teachers($limit,$start,$order,$dir);
        }
        else {
            $search        = $this->input->post('search')['value']; 
            $teachers      =  $this->ajaxload->teacher_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->teacher_search_count($search);
        }

        $data = array();
        if(!empty($teachers)) {
            foreach ($teachers as $row) {

                $photo = '<img src="'.$this->crud_model->get_image_url('teacher', $row->teacher_id).'" class="img-circle" width="30" />';

                $nestedData['teacher_id'] = $row->teacher_id;
                $nestedData['photo'] = $photo;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['phone'] = $row->phone;
                
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

    function get_books() {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');

        $columns = array(
            0 => 'book_id',
            1 => 'name',
            2 => 'author',
            3 => 'description',
            4 => 'price',
            5 => 'class',
            6 => 'download',
            7 => 'book_id'
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
                    $download = '<a href="'.site_url("uploads/document/$row->file_name").'" class="btn btn-blue btn-icon icon-left"><i class="entypo-download"></i>'.get_phrase('download').'</a>';

                $nestedData['book_id'] = $row->book_id;
                $nestedData['name'] = $row->name;
                $nestedData['author'] = $row->author;
                $nestedData['description'] = $row->description;
                $nestedData['price'] = $row->price;
                $nestedData['class'] = $this->db->get_where('class', array('class_id' => $row->class_id))->row()->name;
                $nestedData['download'] = $download;
                
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

    /*-------------MD-----------*/

    /****Leave Management*****/
    function teacher_leave_request($param1 ="")
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');

       
        $result = $this->db->get_where('teacher', array('teacher_id'=>$this->session->userdata('login_user_id')))->row();
        $teacher_code = 'teacher_'.$result->teacher_id;
        $teacher_id   = $result->teacher_id;
        if ($param1 == "create")
        {   
           
            $gen_code          = $this->genrate_uniqid('lve_');
            $data['id_no']     = $teacher_code;
            $data['request_by']= $teacher_id;
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
            $send_role         = json_encode(array(5));
            if($data['id_no'] != "" && $data['type'] != ""){
               $this->db->insert('leave_request',$data);
			   $this->add_notification($teacher_id,TEACHER,1,5,$notification_msg,'Leave Request',$url);
               $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
               redirect(site_url('teacher/teacher_leaves_past_record/'), 'refresh');
              }else{
               $this->session->set_flashdata('flash_message', get_phrase('Please_fill_mandatory_fields.'));
               //redirect(site_url('teacher/teacher_leave_request/'), 'refresh'); 
              }
            }
        $page_data['teacher_code']  = $teacher_code;
        $page_data['page_name']  = 'teacher_leave_request';
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

    function teacher_leaves_past_record()
    {
        if ($this->session->userdata('teacher_login') != 1)
         redirect(site_url('login'), 'refresh');

        $request_data = $this->db->get_where('leave_request', array('request_by'=>$this->session->userdata('login_user_id'),'year'=>$this->year,'role_id' => 5 ))->result();
        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'teacher_leaves_past_record';
        $page_data['page_title'] = get_phrase('leaves_past_record');
        $this->load->view('backend/index', $page_data);
    }
    
    function student_leave_record($param1 = "")
    {   
        if ($this->session->userdata('teacher_login') != 1)
         redirect(site_url('login'), 'refresh');

        $page_data['find_student_leave']= "";
        if($_POST !="" && $param1 == "find"){

         $request_data =  $this->crud_model->student_leave_record($_POST);
         $page_data['find_student_leave'] = "true";
         $page_data['leave_data'] =  $request_data;
        }
        $page_data['teacherClass']= $this->db->get_where('section', array('teacher_id'=>$this->session->userdata('login_user_id'),'sub_teacher_status'=>0))->result();
        $page_data['month']      = date('m');
        $page_data['page_name']  = 'student_leave_record';
        $page_data['page_title'] = get_phrase('student_leave_record');
        $this->load->view('backend/index', $page_data);
    }

    function student_leave_schedule()
    {   
        $request_data =  $this->crud_model->student_leave_Schedule($this->session->userdata('login_user_id'));
        $page_data['leave_data'] =  $request_data;
        $page_data['page_name']  = 'student_leave_schedule';
        $page_data['page_title'] = get_phrase('student_leave_schedule');
        $this->load->view('backend/index', $page_data);
    }

    /****Dormitory*****/
    function room_change_request($param1="")
    {  

     if($_POST != "" && $param1 != ""){
          $student_id            = $this->session->userdata('login_user_id');
          $data['student_id']    = $student_id;
          $data['role_id']       = $this->session->userdata('role_id');
          $data['new_hostel_id'] = $this->input->post('hostel_id');
          $data['new_room_id']   = $this->input->post('room_id');
          $data['year']          = $this->year;
          $this->db->insert('room_change_request',$data);
          $this->session->set_flashdata('flash_message', get_phrase('data_insert_successful'));
          redirect(site_url('student/student_roomchange_request'), 'refresh');
        }
        $page_data['hostel_data']= $this->crud_model->get_teacher_hostel_data($this->session->userdata('login_user_id'));
        $page_data['page_name']  = 'room_change_request';
        $page_data['page_title'] = get_phrase('room_change_request');
        $this->load->view('backend/index', $page_data);
    }
    
    function teacher_attendance_report()
    {
        $page_data['page_name']  = 'teacher_attendance_report';
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }
    function visitors_list()
    {
        $page_data['page_name']  = 'visitors_list';
        $page_data['page_title'] = get_phrase('visitors_list');
        $this->load->view('backend/index', $page_data);
    }
    /****Canteen*****/
    function card_recharge()
    {
        $page_data['page_name']  = 'card_recharge';
        $page_data['page_title'] = get_phrase('teacher_card_recharge');
        $this->load->view('backend/index', $page_data);
    }
    /****Tearcher Daily Attendance*****/
    function all_teacher_attendance()
    {
        $page_data['page_name']  = 'all_teacher_attendance';
        $page_data['page_title'] = get_phrase('all_teacher_attendance');
        $this->load->view('backend/index', $page_data);
    }
    /****Re-Exam*****/
    function create_re_exam()
    {
        $page_data['page_name']  = 'create_re_exam';
        $page_data['page_title'] = get_phrase('create_re_exam');
        $this->load->view('backend/index', $page_data);
    }
    /****Salary Dashboard*****/
    function salary_details()
    {	
		$page_data['salary']  = $this->crud_model->get_teacher_salary_details($this->session->userdata('login_user_id'));
	//print_r($this->session->userdata('login_user_id'));exit;
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

     function assignment($class = "",$filter=""){
        if ($this->session->userdata('teacher_login') != 1)
         redirect(site_url('login'), 'refresh');

      if(!is_numeric($class)){
            error($this->lang->line('unexpected_error'));
             redirect('assignment/index');
        }
        
        $sections   = $this->db->get_where('section', array('class_id' => $class,'sub_teacher_status' => 0))->result();
        $str = null;
        $this->data['sections']           =  $sections;
        $this->data['filter_assignments'] =  "";

        if($filter == 'filter'){
          $this->data['filter_assignments'] = $this->assignment->get_assignment_filter($class,$this->input->post('section_id'),$this->input->post('subject_id'),$this->input->post('assigment_id'));      
        }

        $this->data['class_id']    = $class;
        $this->data['list']        = TRUE;
        $this->data['page_name']   = 'assignment';
        $this->data['page_title']  = 'Assignment List';
        $this->load->view('backend/index', $this->data);
     }
function daily_bulk_attendence(){
$today = date("Y-m-d");
 $todays=  strtotime($today);
 $attendence = $this->db->get_where('daily_bulk_attendance_report' , array('date/time' => $today))->result_array();
$i=0; 

  foreach($attendence as $row1) { 
   $cell=$row1['rf_id_no'];
	$attendancee=array();
    // echo $id=$row1['id'];
	$string = preg_replace('/\s+/', '', $cell);
$output = str_split($string, 10);
foreach($output as $out){
	array_push($attendancee,$out);
	

     $students = $this->db->get_where('enroll' , array('card_code' => $out))->result_array();
              foreach($students as $row) {
                $attn_data['class_id']  = $row['class_id'];
                $attn_data['year']      = $row['year'];
                $attn_data['timestamp']  = $todays;
                $attn_data['section_id'] = $row['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $attn_data['status'] = 1;
       $attencence = $this->db->get_where('attendance' , array('timestamp' => $todays,'class_id'=>$attn_data['class_id'],
     'section_id'=>$attn_data['section_id'],'status'=>1,'student_id'=>$attn_data['student_id']));
            if($attencence->num_rows() < 1) {
				
          $this->db->insert('attendance' , $attn_data);
			 
            }
			}
}
$i++;			
	}
	//print_r($attendancee);	
}

function daily_bulk_attendance_reports()
    {
        $data['rf_id_no']  =$this->input->post('attendance_rfid');
        $data['role_id']   =$this->session->userdata('role_id');
        $data['user_id']  = $this->session->userdata('login_user_id');
        $data['date/time']   = date("Y-m-d");
        $this->db->insert('daily_bulk_attendance_report' , $data);
		  $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
       redirect(site_url('teacher/manage_attendance_rfid/'));
    }
	
 public function pos_c_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
    
        if ($name) {
           // echo "SELECT card_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name AND  card_code != null LIMIT 1";
			$query3  = $this->db->query("SELECT card_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");
            $result3 = $query3->result_array();	
            if(sizeof($result3) > 0){	
		     foreach ($result3 as $row3) {
				$student_id = $row3['student_id'];
				$class_id   = $row3['class_id'];
				$section_id = $row3['section_id'];
			 } 

            $query = $this->db->query("SELECT student_id,name,student_code,address,phone,email,parent_id FROM student WHERE student_id=$student_id");
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
			    $stdnclass    = "<tr>
                   <td>Class</td>
                   <td>:</td>
                   <td> $class_name</td>
                   </tr>
                   <tr>
                       <td>Section</td>
                       <td>:</td>
                       <td>$section_name</td>
                   </tr>";
			 
        		   echo' <div class="id-card-holder" style="width: 225px;padding: 4px; margin: 0 auto; background-color: #1f1f1f;border-radius: 5px; position: relative;">
                    <div class="id-card" style="background-color: #fff;padding: 10px; border-radius: 10px; text-align: center;box-shadow: 0 0 1.5px 0px #b9b9b9;">
                        <div class="header" style="text-align: left;margin-left: 0px">
                            <img src="'.base_url('uploads/logo.png').'" style="max-height:60px;max-width: 60px">
                            <h2 style="display: inline;margin-left: 15px">Edurama</h2>
                        </div>
                        <div class="photo">
                            <img class="img-circle" src="'.base_url('uploads/student_image/').''.$row['student_id'].'.jpg" width="50">
                        </div>
                        <h2>54edf74</h2>
                        <div style="text-align: justify;margin-left: 7px">
                           <table class="">
                               <tbody><tr>
                                   <td>Name</td>
                                   <td>:</td>
                                   <td>'.$row['name'].' </td>
                               </tr>
                               <tr>
                                   <td>Parent</td>
                                   <td>:</td>
                                   <td>'.$parent_name.'</td>
                               </tr>
                             '.$stdnclass.'
                               <tr>
                                   <td>Contact </td>
                                   <td>:</td>
                                   <td> '. $row['phone'] . '</td>
                               </tr>

                           </tbody></table>
                           
                        </div>       

                    </div>
            </div>';
          }
        $counttotal=strlen($name);
         if($class_id !='' || $section_id !='' || $student_id !='') {
            if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);
                $attn_data['class_id']  =  $class_id;
                $attn_data['year']      =  $this->year;
                $attn_data['timestamp']  = $todays;
                $attn_data['section_id'] = $section_id;
                $attn_data['student_id'] = $student_id;
                $attn_data['status'] = 1;
            
                $attencence = $this->db->get_where('attendance' , array('timestamp' => $todays,'class_id'=>$attn_data['class_id'],'section_id'=>$attn_data['section_id'],'student_id'=>$attn_data['student_id']));

                if($attencence->num_rows() < 1) {                
                 $this->db->insert('attendance' , $attn_data);
                }else{
                $attendance_id = $attencence->row()->attendance_id;
                 $this->db->where('attendance_id',$attendance_id);
                 $this->db->update('attendance' ,array('status'=>1)); 
                }
            }
         }        
		  
		}
      }
	}

    function get_ajax_attendence(){
        $data['class_id']       = $this->input->post('class_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        $data['running_year']   = $this->year;
        $this->load->view('backend/teacher/load_attendence_data', $data);
        //print_r($data);
    }

    function notification() {
        // check_permission(VIEW);
       // $this->crud_model->read_notification_status('teacher','teacher_id');


        $this->data['list']       = TRUE;
        $this->db->select('*');
        $this->db->from('notification_alert');
        //$this->db->where('status',0);$this->session->userdata('role_id')
        $this->db->where('send_to_role',$this->session->userdata('role_id'));
        $this->db->where("(send_to = '".$this->session->userdata('login_user_id')."' OR send_to  IS NULL)");
        $this->db->order_by('id','DESC');
        $notification_data          =  $this->db->get()->result();
        $this->data['notification'] =  $notification_data;

        $this->data['page_name']  = 'notification';
        $this->data['page_title'] = 'Notification'; 
        $this->data['folder']     = 'teacher';
        $this->load->view('backend/page', $this->data);
    }
	
	//aftaab ---- teacher new menu pages----------
	
    /***TEACHER DASHBOARD***/
    function teacher_dashboard()
    {
        $page_data['page_name']  = 'teacher_dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Student DASHBOARD***/
    function student_dashboard()
    {
        $page_data['page_name']  = 'student_dashboard';
        $page_data['page_title'] = get_phrase('Student_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Extra Curricular DASHBOARD***/
    function extra_curricular_dashboard()
    {
        $page_data['page_name']  = 'extra_curricular_dashboard';
        $page_data['page_title'] = get_phrase('Extra_Curricular_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Facilities DASHBOARD***/
    function facilities_dashboard()
    {
        $page_data['page_name']  = 'facilities_dashboard';
        $page_data['page_title'] = get_phrase('Facilities_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Exam DASHBOARD***/
    function exam_dashboard()
    {
        $page_data['page_name']  = 'exam_dashboard';
        $page_data['page_title'] = get_phrase('Exam_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Academic DASHBOARD***/
    function academic_dashboard()
    {   
        $page_data['page_name']  = 'academic_dashboard';
        $page_data['page_title'] = get_phrase('Academic_Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/***Academic DASHBOARD***/
    function message_dashboard()
    {   
        $page_data['page_name']  = 'message_dashboard';
        $page_data['page_title'] = get_phrase('Message_Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /***Academic DASHBOARD***/
    function syllabus_module_info($param = "")
    {   
        $page_data['syllabus_data']              = $this->db->get_where('academic_syllabus',array('academic_syllabus_id'=>$param))->row();
        $page_data['syllabus_module_info_data']  = $this->db->get_where('syllabus_module_info',array('syllabus_id'=>$param,'status'=>1))->result();
        $page_data['syllabus_id']                = $param ;
        $page_data['page_name']                  = 'syllabus_module_info';
        $page_data['page_title']                 = get_phrase('syllabus_module_info');
        $this->load->view('backend/index', $page_data);

    }


    function this_teacher_classes(){
      $subject_id =  $this->db->get_where('assign_subject',array('teacher_id'=>$this->session->userdata('login_user_id')))->result();   
      echo "<pre>";
        print_r($subject_id);
      echo "<pre>";
      // foreach ($subject_id as $key => $dt) {
      //     $this->db->get_di
      // }
    }

    function add_syllabus_module_data(){
         $module              =   $this->input->post('module_title');
         $data['syllabus_id'] = $this->input->post('syllabus_id');
         $data['year']        = $this->year;

         for($i=0;$i<count($module);$i++){
           $data['title']        = $this->input->post('module_title')[$i];
           if($data['title'] !=""){
             $data['persent_value']       = $this->input->post('persent_value')[$i];
             $data['module_no']           = $this->input->post('module_no')[$i];
             $data['decription']          = $this->input->post('module_description')[$i];
            if($this->input->post('editid')[$i] != ""){
              $this->db->where('id',$this->input->post('editid')[$i]);
              $this->db->update('syllabus_module_info',$data);
            }else{
              $this->db->insert('syllabus_module_info',$data);
             }
           }
         }

        $this->session->set_flashdata('flash_message', get_phrase('data_created_successfully'));
        redirect(site_url('teacher/syllabus_module_info/'.$data['syllabus_id']));
    }
    function current_topic_syllabus_update(){
 
        $data['current_topic_title']       = $this->input->post('current_topic_title');
        $data['current_topic_desc']        = $this->input->post('current_topic_desc');
        $this->db->where('academic_syllabus_id',$this->input->post('syllabus_id'));
        $this->db->update('academic_syllabus',$data);
        $this->session->set_flashdata('flash_message', get_phrase('update_data_successfully'));
        redirect(site_url('teacher/syllabus_module_info/'.$data['syllabus_id']));
    }
	
	function attendance_by_rfid($class_id = '', $section_id = '', $month = '', $sessional_year = '')
{


$class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
$page_data['class_id']          = $class_id;
$page_data['section_id']        = $section_id;
$page_data['month']             = $month;
$page_data['sessional_year']    = $sessional_year;
$page_data['page_name']         = 'attendance_rfid';
$page_data['page_title']        = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
$this->load->view('backend/index', $page_data);
}

    // RFID SEARCH
    public function rfid_search()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
       
        if ($name) {
            $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");

            if($query3 == 'null'){
                echo "RFID number not alloted to any student. Please check and try again!";
            }


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
                $stdnclass    = "<tr>
                   <td>Class</td>
                   <td>:</td>
                   <td> $class_name</td>
                   </tr>
                   <tr>
                       <td>Section</td>
                       <td>:</td>
                       <td>$section_name</td>
                   </tr>";
             
                   echo' <div class="id-card-holder rfid_search_card" style="width: auto;padding: 1%; margin: 0 auto; background-color: #fff;border-radius: 5px; position: relative;border-radius:5px;">
                   <div class="rfid_close"><i class="fas fa-times"></i></div>
                    <div class="id-card" style="background-color: #fff;padding: 0 10px 25px 10px; border-radius:2px; text-align: center; border:1px solid #f5f5f5">

                        
                        <div class="row" style="text-align: justify;margin-left: 0px;padding-top:3%;">
                           <div class="col-md-4 text-left" style="margin-top:5%">
                           <img class="img-responsive" style="max-width:100%" src="'.$url.'">
                           <h4>'.$enroll_code .'</h4>
                           </div>
                           <div class="col-md-8">
                           <table >
                               <tbody><tr>
                                   <td style="width:20%">Name</td>
                                   <td>:</td>
                                   <td>'.$row['name'].' </td>
                               </tr>
                               <tr>
                                   <td style="width:20%">Parent</td>
                                   <td>:</td>
                                   <td>'.$parent_name.'</td>
                               </tr>
                             '.$stdnclass.'
                               <tr>
                                   <td style="width:20%">Contact </td>
                                   <td>:</td>
                                   <td> '. $row['phone'] . '</td>
                               </tr>

                           </tbody></table>
                           </div>
                           
                        </div>       

                    </div>
            </div>';
          }
          $counttotal=strlen($name);
           if($student_id !='') {
              if($counttotal=10){
                $today = date("Y-m-d");
                $todays=  strtotime($today);
                $days= date('l', strtotime($today));
               
                $time = date("H:i",time());
                $endTime = date("H:i",time() + 3600);
                $attn_data['year']  =$this->year;
                $attn_data['date']  =$todays;
               // select * from class_routine where class_id=1 AND section_id=1 AND day='Thursday' AND time_start BETWEEN '11:02' AND '11:32'  AND time_start <= '14:11' AND time_end >= '14:11'
                $periodtime= $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND   time_start >= '$time' AND time_start <= '$endTime'")->row()->period;
              
                $attn_data['class_period'] = $periodtime;
                $attn_data['student_id'] = $student_id;
                $attn_data['class_id'] = $class_id;
                $attn_data['section_id'] = $section_id;
                $attn_data['status'] = 1;
                $attn_data['time'] = date('h:i', time());
               
                if($periodtime!=''){
                $attencence = $this->db->get_where('class_attendance' , array('date' => $todays,'student_id'=>$attn_data['student_id'],'class_period'=>$attn_data['class_period']));

                if($attencence->num_rows() < 1) {                
                 $this->db->insert('class_attendance' , $attn_data);
                }else{
                    echo '<span style=" text-align: center;color: red;margin-left:20%;">This Class Attendence Alredy Submitted</span>';
                // $attendance_id = $attencence->row()->attendance_id;
                // $this->db->where('attendance_id',$attendance_id);
                // $this->db->update('attendance' ,array('status'=>1)); 
                }
                }else {
                    
                    echo '<span style=" text-align: center;color: red;margin-left:20%;">All class Over</span>';
                }
            }
          }        
        }
      }
    }

	
	
	
	
    // RFID SEARCH
    public function rfid_search_class_student()
    {
        $result = array();
        $out    = array();
        $name   = $this->input->get('card_code', true);
        $today = date("Y-m-d");
                $todays=  strtotime($today);
                $days= date('l', strtotime($today));
               
                $time = date("H:i",time());
                $endTime = date("H:i",time() + 3600);
        if ($name) {
            $query3  = $this->db->query("SELECT card_code,enroll_code,student_id,class_id,section_id FROM enroll WHERE card_code = $name  LIMIT 1");

            $result3 = $query3->result_array(); 
            if(sizeof($result3) > 0){   
             foreach ($result3 as $row3) {
               
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
             $today = date("Y-m-d");
             $todays=  strtotime($today);
             $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
             $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
	         $number_of_student_in_class = $this->db->get_where('enroll',array('class_id' =>$class_id,'section_id'=>$section_id))->num_rows();
		     $number_of_attendence_student = $this->db->get_where('class_attendance',array('class_id' =>$class_id,'section_id'=>$section_id,'date'=>$todays))->num_rows();
		      //$subject_id= $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND   time_start BETWEEN '$time' AND '$endTime'")->row()->subject_id;
             $subject_id= $this->db->query("select * from class_routine where class_id=$class_id AND section_id=$section_id AND day='$days' AND  time_start >= '$time' AND time_start <= '$endTime'")->row()->subject_id;
              
            
             //$classnsection="<div class='col-sm-4 current-class text-left'><strong>Class : </strong><span> $class_name - $section_name</span></div>";
               $subject_name   = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
                   echo' <div class="row  mt-3">
             <div class="col-sm-4 current-class text-left"><strong>Class : </strong><span>  '.$class_name.'-'.$section_name.'</span></div> 
            <div class="col-sm-4 current-period"><strong>Period :'.$subject_name.' </strong><span></span></div>
             <div class="col-sm-4 marked-status"><strong>Marked : </strong><span>'.$number_of_attendence_student.'/'.$number_of_student_in_class.'</span></div> 
             </div>';
          }
           
                 
        }
      }
    }	
	
    function update_assignment_marks(){

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        $count_row = count($this->input->post('marks'));
        $class = $this->input->post('class_id');
        for($i=0;$i<$count_row;$i++){
            if($this->input->post('marks')[$i] !=""){
                $student_id    = $this->input->post('student_id')[$i];
                $marks         = $this->input->post('marks')[$i];
                $assignment_id = $this->input->post('assignment_id')[$i];

                $this->db->where('assignment_id',$assignment_id);
                $this->db->where('student_id',$student_id);
                $this->db->update('submit_assignment',array('mark'=>$marks));
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('Update_marks_successfully'));
        redirect(site_url('teacher/assignment/'.$class.'/filter'), 'refresh');
    }	
	
}
