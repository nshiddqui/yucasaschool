<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guardian_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_guardian_list(){
        
        if($this->session->userdata('role_id') == STUDENT){
            
            $profile_id = $this->session->userdata('profile_id');
            $student = $this->get_single('students', array('id'=>$profile_id));
            $this->db->select('G.*');
            $this->db->from('guardians AS G');
            //$this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->where('G.id', $student->guardian_id);
            
        } elseif($this->session->userdata('role_id') == PARENTT){     

            $this->db->select('G.*');
            $this->db->from('guardians AS G');
            //$this->db->join('users AS U', 'U.id = G.user_id', 'left');

        } else { 
            if(!empty($this->input->post('class_id'))){
                $this->db->where('E.class_id',$this->input->post('class_id'));
            }
            if(!empty($this->input->post('section_id'))){
                $this->db->where('E.section_id',$this->input->post('section_id'));
            }
            if(!empty($this->input->post('student_id'))){
                $this->db->where('E.student_id',$this->input->post('student_id'));
            }
            $this->db->select('G.*,E.class_id as class_id,E.section_id as section_id');
            $this->db->from('guardians AS G');
            $this->db->join('enroll AS E', 'E.student_id = G.student_id');
        }
        return $this->db->get()->result();
        
    }

    public function get_guardian_list_mobile($roleId, $id){
        if($roleId == 'student'){
            $profile_id = $id;
            $student = $this->get_single('students', array('id'=>$profile_id));
            $this->db->select('G.*');
            $this->db->from('guardians AS G');
            //$this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->where('G.id', $student->guardian_id);
        } else if($roleId == 'parent'){
            $profile_id = $id;

            $this->db->select('G.*');
            $this->db->from('guardians AS G');
            $this->db->where("(created_by = $id OR role_id = 8)");
        } else{            
            $this->db->select('G.*');
            $this->db->from('guardians AS G');
           // $this->db->join('users AS U', 'U.id = G.user_id', 'left');
        }
        return $this->db->get()->result();
        
    }
    
	
	   public function get_assign_guardian_list(){ 
	   
            $this->db->select('GA.*, G.name AS guardians_name, G.id as guardians_id,G.relation,G.photo,G.doc_photo,G.profession,S.name AS student, GA.date_from, GA.date_to, G.phone');
            $this->db->from('assign_guardian_list AS GA');
            $this->db->join('guardians AS G', 'G.id = GA.guardian_id', 'left');
            $this->db->join('student AS S', 'S.student_id = GA.student_id', 'left');
            $this->db->where('GA.create_by', logged_in_user_id());
            return $this->db->get()->result();
        
    }
	
	
    public function get_single_guardian($id){
        $this->db->select('G.*,E.class_id as class_id,E.section_id as section_id');
        $this->db->join('enroll AS E', 'E.student_id = G.student_id');
        $this->db->from('guardians AS G');
        //$this->db->join('users AS U', 'U.id = G.user_id', 'left');
       // $this->db->join('roles AS R', 'R.id = G.role_id', 'left');
        $this->db->where('G.id', $id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($email, $id = null) {
        if ($id) {
         $this->db->where_not_in('id', $id);
        }
         $this->db->where('email', $email);
         return $this->db->get('users')->num_rows();
    }
    
     public function get_invoice_list($guardian_id = null){ 
        
        $this->db->select('I.*, IH.title AS head, S.name AS student_name, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');        
        $this->db->where('I.invoice_type !=', 'income'); 
        $this->db->where('I.paid_status !=', 'paid'); 
        $this->db->where('S.guardian_id', $guardian_id);       
        $this->db->order_by('I.id', 'DESC'); 
       
        return $this->db->get()->result();        
        //echo $this->db->last_query();
    }
    
        public function get_student_list($guardian_id){
        
        $this->db->select('S.*, E.roll_no, E.class_id, C.name AS class_name, SE.name AS section');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
       // $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);
        $this->db->where('S.guardian_id', $guardian_id);
        return $this->db->get()->result();
   }
   
    

}
