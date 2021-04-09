<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Holiday_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_holiday_list(){
        $this->db->select('*');
        $this->db->from('holiday_leave');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result();
    }
    
    
    public function get_single_holiday($id){
        $this->db->select('*');
        $this->db->from('holiday_leave');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    
     function duplicate_check($title, $data, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('title', $title);
        $this->db->where('date', date('Y-m-d', strtotime($data)));
        return $this->db->get('holiday_leave')->num_rows();            
    }

}
