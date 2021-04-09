<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_Model extends MY_Model {
    public $runing_year = "";
    function __construct() {
        parent::__construct();
          $this->runing_year = $this->running_year();
    }
    
    public function get_fee_type(){
        
        $this->db->select('IH.*');
        $this->db->from('income_heads AS IH'); 
        $this->db->where('IH.head_type', 'fee'); 
        $this->db->or_where('IH.head_type', 'hostel'); 
        $this->db->or_where('IH.head_type', 'transport'); 
             
        return $this->db->get()->result();  
    }
    
    public function get_hostel_fee($student_id){
        
        $this->db->select('R.cost');
        $this->db->from('student AS S'); 
        $this->db->join('hostel_members AS HM', 'HM.user_id = S.user_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('S.student_id', $student_id); 
        $this->db->where('S.is_hostel_member', 1);
        return $this->db->get()->row(); 
    }
    
    public function get_transport_fee($student_id){
        
        $this->db->select('RS.stop_fare');
        $this->db->from('student AS S'); 
        $this->db->join('transport_members AS TM', 'TM.user_id = S.user_id', 'left');
        $this->db->join('route_stops AS RS', 'RS.id = TM.route_stop_id', 'left');
        $this->db->where('S.student_id', $student_id); 
        $this->db->where('S.is_transport_member', 1);
        return $this->db->get()->row(); 
    }

    public function get_student_discount($student_id){
        
        $this->db->select('D.*');
        $this->db->from('student AS S'); 
        $this->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
        $this->db->where('S.student_id', $student_id);         
        return $this->db->get()->row();
    }

    public function get_invoice_list($due = null,$class=null,$month = null,$year = null,$section = null){
        $this->db->select('I.*, IH.title AS head, S.name AS student_name, I.year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('class AS C', 'C.class_id = I.class_id', 'left');
        $this->db->join('student AS S', 'S.student_id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        if($section){
            $this->db->join('enroll AS E', 'E.student_id = I.student_id', 'inner');
            $this->db->where('E.section_id', $section);  
        }
        
        //$this->db->where('I.year',$this->runing_year); 
        $this->db->where('I.invoice_type !=', 'income'); 
        if($due){
            $this->db->where('I.paid_status !=', 'paid');  
        }
        if($class){
            $this->db->where('I.class_id', $class);  
        }
        if($month){
            $month = '21-'.$month.'-'.$year;
            $month = date('m-Y',strtotime($month));
            $this->db->where('I.month', $month);  
        }
        if($year){
             $this->db->where('YEAR(I.date)', $year);  
        }
        //$this->db->or_where('I.invoice_type', 'hostel'); 
        //$this->db->or_where('I.invoice_type', 'transport'); 
        
        
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
        }        
        //$this->db->where('I.academic_year_id', $this->academic_year_id);       
        $this->db->order_by('I.id', 'DESC');  
        return $this->db->get()->result();        
    }

    public function get_invoice_list_mobile($student = 0, $due = null){
        $this->db->select('I.*, IH.title AS head, S.name AS student_name, I.year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('class AS C', 'C.class_id = I.class_id', 'left');
        $this->db->join('student AS S', 'S.student_id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        //$this->db->where('I.year',$this->runing_year); 
        $this->db->where('I.invoice_type !=', 'income'); 
        if($due){
            $this->db->where('I.paid_status !=', 'paid');  
        }

        //print_r($student); die();
        
        //$this->db->or_where('I.invoice_type', 'hostel'); 
        //$this->db->or_where('I.invoice_type', 'transport'); 
        
        
        if($student == 1){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
        }        
        //$this->db->where('I.academic_year_id', $this->academic_year_id);       
        $this->db->order_by('I.id', 'DESC');  
        return $this->db->get()->result();        
    }
    
    public function get_single_invoice($id){
        
        $this->db->select('I.*, IH.title AS head, I.discount AS inv_discount, I.id AS inv_id , S.*, I.year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('class AS C', 'C.class_id = I.class_id', 'left');
        $this->db->join('student AS S', 'S.student_id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        //$this->db->where('I.year',$this->runing_year); 
       // $this->db->where('I.invoice_type', 'fee'); 
       // $this->db->or_where('I.invoice_type', 'hostel'); 
       // $this->db->or_where('I.invoice_type', 'transport');
        $this->db->where('I.id', $id);       
       
        return $this->db->get()->row();        
    }
    
    public function get_student_list($class_id){
        
        $this->db->select('E.enroll_code,  S.student_id, S.user_id, S.discount_id, S.name, S.is_hostel_member, S.is_transport_member');
        $this->db->from('enroll AS E');        
        $this->db->join('student AS S', 'S.student_id= E.student_id', 'left');
        $this->db->where('E.year', $this->runing_year);       
        $this->db->where('E.class_id', $class_id); 
        return $this->db->get()->result();   
        
    }
    
    public function get_student_hostel_cost($user_id){
         $this->db->select('R.cost');
        $this->db->from('hostel_members AS HM');        
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('HM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
    public function get_student_transport_fare($user_id){
        
        
        $this->db->select('R.fare');
        $this->db->from('transport_members AS TM');        
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('TM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
    public function get_invoice_log_list($invoice_id){
                
        $this->db->select('IL.*, IH.title');
        $this->db->from('invoice_logs AS IL');        
        $this->db->join('income_heads AS IH', 'IH.id = IL.income_head_id', 'left');
        $this->db->where('IL.invoice_id', $invoice_id);                  
        return $this->db->get()->result();
    }
    
     function get_setting_data($table_name, $index_array, $columns = null) {

        if ($columns)
        $this->db->select($columns);
        //$this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $row = $this->db->get_where($table_name, $index_array)->row();

        return $row;
    }
    
}
