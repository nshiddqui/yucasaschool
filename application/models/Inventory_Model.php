<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_inventory_list(){
        
        $this->db->select('R.*');
        $this->db->from('inventory AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    
     public function get_inventory_travel_list(){
        
        $this->db->select('R.*');
        $this->db->from('inventory_travel AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    
    public function get_asset_list(){
        
        $this->db->select('R.*');
        $this->db->from('asset_type AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
   
     public function get_asset_inv_list(){
        
        $this->db->select('asset_warehouse.*, asset_type.asset_name');
        $this->db->from('asset_warehouse')
        ->join('asset_type', 'asset_type.id = asset_warehouse.asset_id');
        $this->db->where('asset_warehouse.asset_mode', 0);
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    
    public function get_asset_damage_list_per_class($mode){
        
        $this->db->select('asset_warehouse.*, asset_type.asset_name');
        $this->db->from('asset_warehouse')
        ->join('asset_type', 'asset_type.id = asset_warehouse.asset_id');
        $this->db->where('asset_warehouse.asset_mode', $mode);
        
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();  
        //echo $this->db->last_query();die;
    }
     public function get_asset_inv_damaged_list(){
        
        $this->db->select('asset_warehouse.*, asset_type.asset_name');
        $this->db->from('asset_warehouse')
        ->join('asset_type', 'asset_type.id = asset_warehouse.asset_id');
        $this->db->where('asset_warehouse.asset_mode', 1);
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    public function get_inventory_list_new($id){
        
        $this->db->select('R.*');
        $this->db->from('inventory AS R where inventory.inventory_type='.$id);
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    public function get_inventory_list_quantity(){
        
        $this->db->select('inventory_warehouse.*');
        $this->db->from('inventory_warehouse')
        ->join('inventory', 'inventory_warehouse.inven_id = inventory.id');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        return $this->db->get()->result();        
    }
    
    public function get_single_inventory($id){
        
        $this->db->select('R.*');
        $this->db->from('inventory AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        $this->db->where('R.id', $id);
        return $this->db->get()->row();        
    }
    public function get_single_inventory_asset($id){
        
        $this->db->select('R.*');
        $this->db->from('asset_warehouse AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        $this->db->where('R.id', $id);
     return $this->db->get()->row();    
     //echo $this->db->last_query();die;
    }
    
    
    public function get_single_inventory_actual($id){
        
        $this->db->select('R.*');
        $this->db->from('inventory_warehouse AS R');
        //$this->db->join('hostels AS H', 'H.id = R.hostel_id', 'left');
        $this->db->where('R.id', $id);
        return $this->db->get()->row();        
    }
    
   function duplicate_check($hostel_id, $room_no, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('hostel_id', $hostel_id);
        $this->db->where('room_no', $room_no);
        return $this->db->get('rooms')->num_rows();            
    }

// 	  public function get_block_user_list(){
        
//         $this->db->select('S.*, S.name, E.card_code' );
//         $this->db->from('student AS S');
//         $this->db->join('enroll AS E', 'E.student_id = S.student_id', 'left');
//         $this->db->join('block_rfid_card_request AS B', 'B.card_user = S.student_id', 'left');
//         $this->db->where('S.student_id', logged_in_user_id());
//         return $this->db->get()->row();        
//     }
	
	
	
}
