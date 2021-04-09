<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achievement_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_achievement_list(){
        
        $this->db->select('A.*, T.name as teacher_name, S.name as student_name, C.name as class_name ');
        $this->db->from('achievements AS A');
        $this->db->join('student AS S', 'S.student_id = A.student_id', 'inner');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'inner');
        $this->db->join('teacher AS T', 'T.teacher_id = A.teacher_id', 'inner');
        $this->db->order_by('A.date', 'DESC');
        return $this->db->get()->result();
        
    }
    public function get_achievement_list_by_parent($parent_id = null , $student_id = null){
        $this->db->select('A.*, T.name as teacher_name, S.name as student_name, C.name as class_name ');
        $this->db->from('achievements AS A');
        $this->db->join('student AS S', 'S.student_id = A.student_id', 'inner');
        $this->db->join('class AS C', 'C.class_id = A.class_id', 'inner');
        $this->db->join('teacher AS T', 'T.teacher_id = A.teacher_id', 'inner');
        if(!empty($student_id)){
            $this->db->where('A.student_id',$student_id);
        }
        if(!empty($parent_id)){
            $this->db->where('S.parent_id',$parent_id);
        }
        $this->db->order_by('A.date', 'DESC');
        return $this->db->get()->result();
    }
    
}
