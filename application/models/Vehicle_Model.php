<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_vehicle_list(){
        
        $this->db->select('V.*');
        $this->db->from('vehicles AS V');
        return $this->db->get()->result();
        
    }
    public function get_vehicle_nullified($id){
        
        $this->db->set('status', '0');
$this->db->where('id', $id);
$this->db->update('vehicle_service');
        
        
    }
     public function get_vehicle_expenditure(){
        
        $this->db->select('V.*');
        $this->db->from('vehicle_service AS V');
        $this->db->where('status', '1');
        return $this->db->get()->result();
        
    }
    
    function duplicate_check($number, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('number', $number);
        return $this->db->get('vehicles')->num_rows();            
    }




   /* $this->db->select('S.*');
        $this->db->from('student AS S');
        return $this->db->get()->result();

        */

}
