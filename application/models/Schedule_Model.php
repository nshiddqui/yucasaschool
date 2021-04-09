<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_schedule_list($class_id){
        
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        } 
       
        $this->db->select('ES.*, E.title, C.name AS class_name, S.name AS subject, AY.session_year');
        $this->db->from('exam_schedules AS ES');
        $this->db->join('class AS C', 'C.class_id = ES.class_id', 'left');
        $this->db->join('subjects AS S', 'S.id = ES.subject_id', 'left');
        $this->db->join('exams AS E', 'E.id = ES.exam_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ES.academic_year_id', 'left');
        $this->db->where('AY.id', $this->academic_year_id);
        
        if($this->session->userdata('role_id') == TEACHER){
            $this->db->where('S.teacher_id', $this->session->userdata('profile_id'));
        }
        
        if($class_id){
            $this->db->where('ES.class_id', $class_id);            
        }
        $this->db->order_by('ES.id', 'DESC');            
        return $this->db->get()->result();
        
    }
     public function get_single_schedule($id){
         
        $this->db->select('ES.*, E.title, C.name AS class_name, S.name AS subject, AY.session_year');
        $this->db->from('exam_schedules AS ES');
        $this->db->join('classes AS C', 'C.id = ES.class_id', 'left');
        $this->db->join('subjects AS S', 'S.id = ES.subject_id', 'left');
        $this->db->join('exams AS E', 'E.id = ES.exam_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ES.academic_year_id', 'left');
        $this->db->where('AY.id', $this->academic_year_id);
        $this->db->where('ES.id', $id);
        return $this->db->get()->row();
        
    }

    
     function duplicate_check($exam_id, $class_id, $subject_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);        
        $this->db->where('academic_year_id', $this->academic_year_id);        
        return $this->db->get('exam_schedules')->num_rows();            
    }
    
     function duplicate_room_check($room_no, $exam_date, $start_time, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        
        $this->db->where('room_no', $room_no);
        $this->db->where('exam_date', $exam_date);
        $this->db->where('start_time', $start_time);        
        $this->db->where('academic_year_id', $this->academic_year_id);
        
        return $this->db->get('exam_schedules')->num_rows();            
    }


    function get_student_re_exam_schedule($student_id){
       //echo $this->year;

        $this->db->select('E.class_id, S.name, E.section_id');
        $this->db->from('enroll AS E');        
        $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
        $this->db->where('E.year', $this->year);       
        $this->db->where('E.student_id', $student_id);
        
        $result = $this->db->get()->row(); 
        $data   = "";
        if($result != ""){
         $data['class_id']  =  $result->class_id!=""?$result->class_id:'0';
         $data['name']      =  $result->name;
         $data['section_id']=  $result->section_id!=""?$result->section_id:'0';
         $data['re_exam_schedule']=  "";
         $data['re_exam_cancel']  =  "";
         $data['empty']     =  'true';


         $schedule = $this->db->query('select * from re_exam where  (student_id = 0 AND class_id ="'.$data['class_id'].'" AND section_id = 0) OR (student_id ="'.$student_id.'" AND class_id ="'.$data['class_id'].'" AND section_id =0) OR (student_id =0 AND class_id ="'.$data['class_id'].'" AND section_id ="'.$data['section_id'].'")')->result();
         if(sizeof($schedule) > 0){
           $data['re_exam_schedule'] = $schedule;
           $data['empty']     =  'false';
         }

         /* $re_exam_cancel = $this->db->query('select * from re_exam_cancel where  (student_id = 0 AND class_id ="'.$data['class_id'].'" AND section_id = 0) OR (student_id ="'.$student_id.'" AND class_id ="'.$data['class_id'].'" AND section_id =0) OR (student_id =0 AND class_id ="'.$data['class_id'].'" AND section_id ="'.$data['section_id'].'")')->result();
          if(sizeof($schedule) > 0){
            $data['re_exam_cancel'] = $re_exam_cancel;
            $data['empty']     =  'false';
          }*/
        }
      /*echo "<pre>";
       print_r($data;);
      echo "</pre>";*/
      return $data;
    }
  
  function scholarship_examlist_by_student_n_class($student){
        $this->db->select('O.*');
        $this->db->from('scholarship_student AS S');        
        $this->db->join('scholarship_online_exam AS O', 'O.class_id = S.class_id');
        $this->db->where('S.running_year', $this->year);
        $this->db->where('O.running_year', $this->year);       
        $this->db->where('S.student_id', $student);
        $result = $this->db->get()->result(); 
         
        return $result;
  }



}
