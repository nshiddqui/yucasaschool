<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth_Model
 *
 * @author Nafeesa
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function duplicate_check($name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('certificates')->num_rows();            
    }
    
    public function get_student_list($class_id = null, $year=null ) {

            $this->db->select('E.*, S.email, S.name, S.phone, S.role_id, S.status AS login_status ');
            $this->db->from('enroll AS E');
            $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
            //$this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->where('E.year', $year);
            
            if($class_id){
                $this->db->where('E.class_id', $class_id);
            }                        
            return $this->db->get()->result();
//echo $this->db->last_query();				
    }

    public function get_student($student_id = null, $class_id = null ) {

           $this->db->select('E.*, S.email, S.name, S.phone,S.birthday, S.role_id, S.status AS login_status ');
            $this->db->from('enroll AS E');
            $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
            //$this->db->join('users AS U', 'U.id = S.user_id', 'left');
          
            $this->db->where('S.student_id', $student_id);
            $this->db->where('E.class_id', $class_id);
                   
             
          return  $this->db->get()->row();
		//echo $this->db->last_query();		
    }
	
	 function get_all_certificates(){

        $this->db->select('AC.* ,V.name AS certificate_type, P.name AS parentname,S.student_code ,S.name, AC.status');
        $this->db->from('apply_certificates AS AC');
		$this->db->join('certificates AS V', 'V.id = AC.certificate_type');
		$this->db->join('student AS S', 'S.student_id = AC.student_id');
		$this->db->join('parent AS P', 'P.parent_id = AC.apply_by');
        // /$this->db->where('AC.year', $this->year);
        $this->db->order_by('AC.id', 'DESC');
        return $this->db->get()->result();
 }
	
	
}
