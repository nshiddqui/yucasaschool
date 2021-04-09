<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Duefeeemailsms_Model extends MY_Model {
    public $runing_year = "";
    function __construct() {
        parent::__construct();
         $this->runing_year = $this->running_year();
    } 
    
    public function get_email_list(){
        $this->db->select('E.*, R.name AS receiver_type');
        $this->db->from('emails AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->where('E.year', $this->runing_year);
        $this->db->where('E.email_type', 'duefee');
        return $this->db->get()->result();    
    }
    
    public function get_sms_list(){
        $this->db->select('TM.*, R.name AS receiver_type, TM.year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->where('TM.year', $this->runing_year);
        $this->db->where('TM.sms_type', 'duefee');
        
        return $this->db->get()->result();    
    }
    
    public function get_single_email($id){
        $this->db->select('E.*, R.name AS receiver_type');
        $this->db->from('emails AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->where('year AS E', $this->runing_year);
        $this->db->where('E.id', $id);
        return $this->db->get()->row();    
    }
    
    public function get_single_sms($id){
        $this->db->select('TM.*, R.name AS receiver_type, AY.session_year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->where('TM.year', $this->runing_year);
        $this->db->where('TM.id', $id);
        return $this->db->get()->row();    
    }

/*    public function get_user_list( $role_id, $receiver_id, $class_id = null){
        
        $this->db->select('E.student_id, S.phone, S.name, S.parent_id, U.email, U.role_id,  U.id,  C.name AS class_name');
        $this->db->from('enrollments AS E');
        $this->db->join('student AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('class AS C', 'C.id = E.class_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);
        $this->db->where('E.class_id', $class_id);
            if($receiver_id > 0){
                $this->db->where('S.user_id', $receiver_id);
            }
            return $this->db->get()->result();         
    }*/
    
    public function get_user_list( $role_id, $receiver_id, $class_id = null){
       
           
        

        $this->db->select('S.student_id, S.phone, S.name, S.parent_id, S.email,  C.name AS class_name');
        $this->db->from('enroll AS E');
        $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
       // $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
        $this->db->where('E.year', $this->runing_year);
        $this->db->where('E.class_id', $class_id);
            if($receiver_id > 0){
                if($role_id == 4){
                $this->db->where('S.student_id', $receiver_id);
                }
                if($role_id == 8){
                $this->db->where('S.parent_id', $receiver_id);
                }
               
            }
            return $this->db->get()->result();   
            
             
    }

    /*public function get_single_student1($guardian_id, $class_id){
        
        $this->db->select('S.id');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');      
        $this->db->where('E.class_id', $class_id);
        $this->db->where('S.guardian_id', $guardian_id);
        return $this->db->get()->row();
        
    }*/
    
    public function get_due_fee($student_id, $class_id){
        
        $this->db->select('SUM(I.net_amount) AS net_amount, SUM(T.amount) AS paid_amount, SUM(I.net_amount) -SUM(T.amount) AS due_amount ');
        $this->db->from('invoices AS I');         
        $this->db->join('transactions AS T', 'T.invoice_id = I.id', 'left'); 
        $this->db->where('I.student_id', $student_id);       
        $this->db->where('I.class_id', $class_id); 
        return $this->db->get()->row();    
    }

}
