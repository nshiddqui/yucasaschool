<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_student_list($class_id){
        $this->db->select('S.student_id, E.roll, S.student_code, S.name, E.class_id, E.section_id');
        $this->db->from('enroll AS E');        
        $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
        //$this->db->where('E.academic_year_id', $this->academic_year_id);       
        $this->db->where('E.class_id', $class_id);       
        return $this->db->get()->result();       
    }

    public function get_list($table_name, $index_array, $columns = null, $limit = null, $offset = 0, $order_field = null, $order_type = null) {

        if ($columns)
            $this->db->select($columns);
       
        return $this->db->get_where($table_name, $index_array)->result();
    }
    
    public function get_student_list_by_section($section_id = null){
        
        $this->db->select('E.roll_no, S.name, S.id');
        $this->db->from('enrollments AS E');        
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);       
        $this->db->where('E.section_id', $section_id);
       
        if($this->session->userdata('role_id') == GUARDIAN){
            $this->db->where('S.guardian_id', $this->session->userdata('profile_id'));
        }
        
        return $this->db->get()->result();        
    }
    
    function get_list_student($class_id,$section_id){
       if($section_id == "") 
        $qry = "select * from student S,enroll E where E.class_id = $class_id AND S.student_id = E.student_id";
       else
        $qry = "select * from student S,enroll E where E.class_id = $class_id AND E.section_id = $section_id AND S.student_id = E.student_id";

      return  $result  = $this->db->query($qry)->result(); 

    }

    public function get_user_list($type) {
        
        if ($type == 'teacher') {
          
            $this->db->select('T.name, T.teacher_id, T.designation, T.email, T.role_id');
            $this->db->from('teacher AS T');
            $this->db->join('users AS U', 'U.id = T.teacher_id', 'left');  
			$this->db->join('designations AS D', 'D.id = T.designation_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
            $this->db->where('T.teacher_id >', 0);
            $this->db->order_by('T.teacher_id', 'ASC');
            return $this->db->get()->result();
			
            
        } elseif ($type == 'warden' || $type== 'driver' || $type== 'security-gaurd') { 
            
            $this->db->select('E.name, E.user_id, SG.grade_name, U.email, U.role_id, D.name AS designation');
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
            $this->db->order_by('E.id', 'ASC');
            return $this->db->get()->result();
            
        }  elseif ($type == 'librarian') { 
            
            $this->db->select('L.name, L.librarian_id, SG.grade_name, L.email, L.role_id');
            $this->db->from('librarian AS L');
            //$this->db->join('designation_users AS U', 'U.designation_users_id = L.librarian_id', 'left');
            //$this->db->join('designations AS D', 'D.id = E.designation_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = L.salary_grade_id', 'left'); 
            $this->db->where('L.librarian_id >', 0);
            $this->db->order_by('L.librarian_id', 'ASC');
            return $this->db->get()->result();
            
        } 
		 elseif ($type == 'accountant') {
            
            $this->db->select('L.name, L.accountant_id, SG.grade_name, L.email, L.role_id');
            $this->db->from('accountant AS L');
            //$this->db->join('designation_users AS U', 'U.designation_users_id = L.librarian_id', 'left');
            //$this->db->join('designations AS D', 'D.id = E.designation_id', 'left'); 
            $this->db->join('salary_grades AS SG', 'SG.id = L.salary_grade_id', 'left'); 
            $this->db->where('L.accountant_id >', 0);
            $this->db->order_by('L.accountant_id', 'ASC');
            return $this->db->get()->result();
            
        } 
		else {
            return array();
        }
    }
      public function get_user_lists($type) {
         
     // print_r($payment_to);
            $this->db->select('A.title, A.deadline');
            $this->db->from('assignments AS A');
            //$this->db->join('users AS U', 'U.id = T.teacher_id', 'left');  
			//$this->db->join('designations AS D', 'D.id = T.designation_id', 'left'); 
            //$this->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
           // $this->db->where('T.teacher_id >', 0);
		     $this->db->where('A.class_id', $type);
            $this->db->order_by('A.id', 'ASC');
            return $this->db->get()->result();
	  }
    function get_list_student_details($student_id){
            $this->db->select('S.name, S.student_code, S.birthday,S.email,p.name as parent_name');
            $this->db->from('student AS S');
            $this->db->join('parent AS P', 'P.parent_id = S.parent_id', 'left');
            $this->db->where('S.student_id', $student_id);
          return  $data = $this->db->get()->result();
    }

    function update_field_status($id){
       $this->db->query("UPDATE registration_form_setting SET status = CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 END WHERE id = $id");
    }

    function update_card_field_status($id){
       $this->db->query("UPDATE registration_form_setting SET genrate_id = CASE WHEN genrate_id = 1 THEN 0 WHEN genrate_id = 0 THEN 1 END WHERE id = $id");
    }
   //function update_field_status_pre_student($id){
   //    $this->db->query("UPDATE registration_form_setting_pre_student SET genrate_id = CASE WHEN genrate_id = 1 THEN 0 WHEN genrate_id = 0 THEN 1 END WHERE id = $id");
   // }
    function update_field_status_teacher($id){
       $this->db->query("UPDATE registration_form_setting_teacher SET status = CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 END WHERE id = $id");
    }

	
	   function update_field_pre_student_status($id){
       $this->db->query("UPDATE registration_form_setting_pre_student SET status = 1 WHERE json_field_elements != ''");
    }
	
	
	  function update_field_status_pre_student($id){
       $this->db->query("UPDATE registration_form_setting_pre_student SET status = CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 END WHERE id = $id");
    }
	
 function update_status_pre_student_id($id){
       $this->db->query("UPDATE pre_student SET islogin = CASE WHEN islogin = 1 THEN 0 WHEN islogin = 0 THEN 1 END WHERE pre_student_id = $id");
    }
	
    public function get_parent_by_class($class)
    {
        $sql = "select P.name, P.parent_id,S.name as student_name  from parent  P ,student  S,enroll E where E.student_id = S.student_id AND S.parent_id = P.parent_id AND E.class_id = $class";
         return $data = $this->db->query($sql)->result();
    }
  
    
}
