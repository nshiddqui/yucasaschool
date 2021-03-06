<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenditure_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    public function get_expenditure_list($startDate = null,$endDate=null){
        $this->db->select('E.*, H.title AS head, H.id AS expenditure_head_id, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        if(!empty($startDate) && !empty($endDate)){
            $this->db->where('date >=', $startDate);
            $this->db->where('date <=', $endDate);
        }
       
        return $this->db->get()->result();        
    }
    public function get_single_expenditure($id){
        
        $this->db->select('E.*, H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.id', $id); 
        return $this->db->get()->row();        
    }
}
