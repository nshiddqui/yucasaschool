<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assignment_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_assignment_list($class_id = null,$section_id = null ){
        $this->db->select('A.*, C.name AS class_name, S.name AS subject');
        $this->db->from('assignments AS A');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
        $this->db->where('A.year', $this->year);
        if($class_id){
            $this->db->where('A.class_id', $class_id);
            //$this->db->where('A.section_id', $section_id);
        }
       /* if($student_id != null)
            $this->db->where('A.student_id', $student_id);*/
        
        return $this->db->get()->result();
    }

    public function get_assignment_filter($class_id="",$section_id="",$subject_id="",$assigment_id=""){

        $this->db->select('ST.student_id,ST.name as student_name,C.name as class_name,S.name as subject_name,S.section_id,A.id,A.title,A.deadline,S.name as subject_name,A.assignment');
        $this->db->from('enroll AS E');
        $this->db->join('assignments AS A', 'A.class_id = E.class_id');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.subject_id = A.subject_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = E.student_id');
         if($assigment_id != "")
           $this->db->where('A.id', $assigment_id); 

        if($class_id != "")
           $this->db->where('E.class_id', $class_id);
       
        if($section_id !="")
          $this->db->where('E.section_id', $section_id);
        
        if($subject_id !="")
         $this->db->where('S.subject_id', $subject_id);

         $this->db->where('S.subject_id = A.subject_id');
         // $this->db->where('ST.student_id= A.student_id');
         $this->db->where('E.class_id   = S.class_id');
         $this->db->where('S.section_id = E.section_id');
         $this->db->where('A.section_id = E.section_id');
        
       

        $this->db->order_by("ST.student_id", "desc");

        $dataval = $this->db->get()->result();
        print_r($dataval);
        return $dataval;
    }
    
    public function get_single_assignment($id){
        
        $this->db->select('A.*, C.name AS class_name, S.name AS subject');
        $this->db->from('assignments AS A');
        $this->db->join('class AS C', 'C.id = A.class_id', 'left');
        $this->db->join('subject AS S', 'S.id = A.subject_id', 'left');
        $this->db->where('A.id', $id);
        return $this->db->get()->row();        
    } 


    public function get_student_by_class_and_section($class_id="",$section_id = ""){
        $this->db->select('A.*, S.name AS student_name, S.name AS subject');
        $this->db->from('enroll AS A');
        $this->db->join('student AS S', 'S.student_id = A.student_id', 'left');
        $this->db->where('A.section_id', $section_id);
        $this->db->where('A.class_id', $class_id);
        $dataval = $this->db->get()->result();
       // print_r($dataval);
        return $dataval; 
    }

    
}


