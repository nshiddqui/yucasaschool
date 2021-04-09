<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parents_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
	    public function get_guardian_list(){
        
        if($this->session->userdata('role_id') == PARENTT){
            
            $profile_id = $this->session->userdata('login_user_id');
            $student    = $this->get_single('student', array('parent_id'=>$profile_id),"",'student_id');
            if($student != ""){
            $this->db->select('G.*, U.email, U.role_id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->where('G.student_id', $student->student_id);
            }else{
                return "";
            }
            
        }else{            
            $this->db->select('G.*, U.email, U.role_id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
        }
        return $this->db->get()->result();
        
    }
	
	function scholarship_examlist_by_student_n_class($student){
        $this->db->select('O.*');
        $this->db->from('scholarship_student AS S');        
        $this->db->join('scholarship_online_exam AS O', 'O.class_id = S.class_id');
        //$this->db->where('O.section_id = S.section_id');    
        $this->db->where('S.running_year', $this->year);       
        $this->db->where('S.student_id', $student);
        $result = $this->db->get()->result(); 
    
    return $result;
    }
    function get_visitor_list_users($user_id,$role){
        $this->db->select('V.*,V.name as vistitor_name');
        $this->db->from('student AS S');
		$this->db->join('visitors AS V', 'V.user_id = S.student_id');
        $this->db->where('V.year', $this->year);
        $this->db->where('S.parent_id', $user_id);
        //$this->db->where('V.role_id', $role);
        $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
    }

 

   function _examlist_by_student_n_class($parnet){
        
        $this->db->select("E.*");
        $this->db->from('student AS S');
        $this->db->join('enroll AS E', 'S.student_id = E.student_id', 'left');
        $this->db->where('S.parent_id',$parnet);
        $resultStudent = $this->db->get()->result();
        if(sizeof($resultStudent) > 0){
           $arr_class_id   =  array();
           foreach ($resultStudent as  $dt) {
               $arr_class_id[]   =  $dt->class_id;
           }
          $class_id   = implode(',',$arr_class_id);
        }

        $this->db->select('EX.*,E.name as exam_name,S.name as subject_name,C.name as class_name');
        $this->db->from('exam_schedule AS EX');
        $this->db->join('exam AS E', 'E.exam_id = EX.exam_id', 'left');   
        $this->db->join('subject AS S', 'S.subject_id = EX.subject_id', 'left'); 
        $this->db->join('class AS C', 'C.class_id = EX.class_id', 'left');        
        $this->db->where("(EX.class_id IN (".$class_id."))", NULL, FALSE);    
        $this->db->order_by('EX.id', 'DESC');
        $result = $this->db->get()->result();       
        return $result;
    }
	
	 /* certificates data */

     function get_all_certificatesss($role_id){
     return  $question_details = $this->db->get_where('apply_certificates', array('status' => 0, 'role_id'=>$role_id))->result();
	  
     }
 function get_all_certificates($user_id,$role_id){
	 //print_r($user_id);exit;
        $this->db->select('AC.* ,V.name AS certificate_type, P.name AS parentname,S.student_code ,S.name, AC.status');
        $this->db->from('apply_certificates AS AC');
		$this->db->join('certificates AS V', 'V.id = AC.certificate_type');
		$this->db->join('student AS S', 'S.student_id = AC.student_id');
		$this->db->join('parent AS P', 'P.parent_id = AC.apply_by');
        $this->db->where('AC.year', $this->year);
        $this->db->where('AC.apply_by', $user_id);
        $this->db->where('AC.role_id', $role_id);
        //$this->db->where('V.role_id', $role);
        $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
 }

    function duplicate_check($email, $id = null) {
        if ($id) {
         $this->db->where_not_in('id', $id);
        }
         $this->db->where('email', $email);
         return $this->db->get('users')->num_rows();
    }

    function get_student_re_exam_list($parent_id){

        $this->db->select("E.*");
        $this->db->from('student AS S');
        $this->db->join('enroll AS E', 'S.student_id = E.student_id', 'left');
        $this->db->where('S.parent_id',$parent_id);
        $resultStudent = $this->db->get()->result();
        if(sizeof($resultStudent) > 0){
           $arr_class_id   =  array();
           $arr_section_id =  array();
           $arr_student_id =  array();
            foreach ($resultStudent as  $dt) {
               $arr_class_id[]   =  $dt->class_id;
               $arr_section_id[] =  $dt->section_id;
               $arr_student_id[] =  $dt->student_id;
            }
          $class_id   = implode(',',$arr_class_id);
          $section_id = implode(',',$arr_section_id);
          $student_id = implode(',',$arr_student_id);
        }

        $this->db->select("RE.*,C.name as class_name,S.name as subject_name,E.name as exam_name,SE.name as section_name,ST.name as student_name,ES.exam_date as examdate");
        $this->db->from('re_exam AS RE');
        $this->db->join('class AS C', 'RE.class_id = C.class_id', 'left');
        $this->db->join('exam_schedule AS ES', 'ES.id = RE.exam', 'left');
        $this->db->join('exam AS E', 'E.exam_id = RE.exam', 'left'); 
        $this->db->join('subject AS S', 'S.subject_id = ES.subject_id', 'left');
        $this->db->join('section AS SE', 'SE.section_id = RE.section_id', 'left');
        $this->db->join('student AS ST', 'ST.student_id = RE.student_id', 'left');
        
        if($class_id != "")
          $this->db->where('RE.class_id',$class_id);
        if($section_id != "")
          $this->db->where("(RE.section_id IN (".$section_id.") OR RE.section_id = 0)", NULL, FALSE);
        if($student_id != "")
          $this->db->where("(RE.student_id IN (".$student_id.") OR RE.student_id = 0)", NULL, FALSE);
        
        $this->db->order_by('RE.re_exam_id', 'DESC'); 
        $result = $this->db->get()->result();
       return $result;
    }
	
     function get_student_cancel_exam_list($parent_id){
        $this->db->select("E.*");
        $this->db->from('student AS S');
        $this->db->join('enroll AS E', 'S.student_id = E.student_id', 'left');
        $this->db->where('S.parent_id',$parent_id);
        $resultStudent = $this->db->get()->result();
        if(sizeof($resultStudent) > 0){
           $arr_class_id   =  array();
           $arr_section_id =  array();
           $arr_student_id =  array();
            foreach ($resultStudent as  $dt) {
               $arr_class_id[]   =  $dt->class_id;
               $arr_section_id[] =  $dt->section_id;
               $arr_student_id[] =  $dt->student_id;
            }
          $class_id   = implode(',',$arr_class_id);
          $section_id = implode(',',$arr_section_id);
          $student_id = implode(',',$arr_student_id);
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
        if($section_id != "")
          $this->db->where("(RE.section_id IN (".$section_id.") OR RE.section_id = 0)", NULL, FALSE);
        if($student_id != "")
          $this->db->where("(RE.student_id IN (".$student_id.") OR RE.student_id = 0)", NULL, FALSE);
        
        $this->db->order_by('RE.cancel_exam_id', 'DESC'); 
        $result = $this->db->get()->result();
       return $result;
    }
	
    function available_hostel_room($parent){
      $this->db->select('H.*, S.name, S.student_id');
      $this->db->from('hostel_members AS H');
      $this->db->join('student AS S', 'S.student_id = H.user_id', 'left');
      $this->db->where('S.parent_id',$parent);
     return $studentDetails  = $this->db->get()->result();
    }
    
	
	  function student_trans_details($parent){
      $this->db->select('GT.*, S.name, S.balance');
      $this->db->from('geopos_transactions AS GT');
      $this->db->join('student AS S', 'S.student_id = GT.payerid', 'left');
      $this->db->where('GT.payerid',$parent);
	  $this->db->order_by('GT.id', 'DESC'); 
     return $studentDetails  = $this->db->get()->result();
    }
    

}
    