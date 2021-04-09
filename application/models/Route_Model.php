<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_vehicle_list($route_id = null ){
            $routelist = $this->db->get('routes')->result();
            $routes = array();
            foreach ($routelist as $key => $dt) {
                $routes[] = $dt->vehicle_ids;
            }
            $imp_routes = implode(',', $routes);

        $route = $this->route->get_single('routes', array('id' => $route_id));
        if(isset($route->vehicle_ids) && $route->vehicle_ids != '' && $route_id){
            //$sql = "SELECT * FROM `vehicles` WHERE `id` IN($route->vehicle_ids) OR is_allocated = 0";
            $sql = "SELECT * FROM `vehicles` WHERE  status = 1 AND (`id` IN($route->vehicle_ids) )";
            if($imp_routes != "")
              $sql .=" OR id NOT IN($imp_routes)";
        } else {
           
            //$sql = "SELECT * FROM `vehicles` WHERE is_allocated = 0";

            $sql = "SELECT * FROM `vehicles` WHERE status = 1";
            if($imp_routes != "")
              $sql .=" AND id NOT IN($imp_routes)";
        }
        return $this->db->query($sql)->result();
    }

    function duplicate_check($number, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('title', $number);
        return $this->db->get('routes')->num_rows();            
    }
    
    function get_all_routes() {
        if($this->session->userdata('student_login') == 1){
            $this->db->join('student','student.transport_id = routes.id');
            $this->db->where('student.student_id', $this->session->userdata('login_user_id'));
        }
        
        if($this->session->userdata('parent_login') == 1){
            $this->db->join('student','student.transport_id = routes.id');
            $this->db->where('student.parent_id', $this->session->userdata('login_user_id'));
        }
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->where('routes.status', 1);
        return $this->db->get()->result();
    }

}
