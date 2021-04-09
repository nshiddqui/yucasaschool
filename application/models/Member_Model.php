<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
     public function get_hostel_member_list($is_hostel_member = 1) {

        $this->db->select('ST.*, HM.id AS hm_id, H.name AS hostel_name, R.room_no, R.room_type, R.cost, E.roll, C.name AS class_name, S.name AS section,HM.beds AS beds');
        $this->db->from('student AS ST');
        $this->db->join('enroll AS E', 'E.student_id = ST.student_id', 'left');
        $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
        $this->db->join('section AS S', 'S.section_id = E.section_id', 'left');
        $this->db->join('hostel_members AS HM', 'HM.user_id = ST.student_id', 'left');
        $this->db->join('hostels AS H', 'H.id = HM.hostel_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('E.year', $this->year);
        $this->db->where('ST.is_hostel_member', $is_hostel_member);
        if(isset($_POST['class_id']) && !empty($_POST['class_id'])){
            $this->db->where('E.class_id', $_POST['class_id']);
        }
        if(isset($_POST['section_id']) && !empty($_POST['section_id'])){
            $this->db->where('E.section_id', $_POST['section_id']);
        }
        $this->db->order_by('HM.id', 'DESC');
        $result =  $this->db->get()->result();
       /* echo "<pre>";
         print_r($result);
        echo "</pre>";*/
       
        return $result;
    }


    public function get_hostel_member_list_mobile($is_hostel_member = 1, $year) {

        $this->db->select('ST.*, HM.id AS hm_id, H.name AS hostel_name, R.room_no, R.room_type, R.cost, E.roll, C.name AS class_name, S.name AS section');
        $this->db->from('student AS ST');
        $this->db->join('enroll AS E', 'E.student_id = ST.student_id', 'left');
        $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
        $this->db->join('section AS S', 'S.section_id = E.section_id', 'left');
        $this->db->join('hostel_members AS HM', 'HM.user_id = ST.student_id', 'left');
        $this->db->join('hostels AS H', 'H.id = HM.hostel_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('E.year', $year);
        $this->db->where('ST.is_hostel_member', $is_hostel_member);
        $this->db->order_by('HM.id', 'DESC');
        $result =  $this->db->get()->result();
       /* echo "<pre>";
         print_r($result);
        echo "</pre>";*/
       
        return $result;
    }
	
	 public function get_transport_member_list($is_transport_member = 1) {

        $this->db->select('ST.*, R.title AS route_name, RS.stop_name, RS.stop_fare, TM.id AS tm_id, TM.route_id, E.roll, C.name AS class_name, S.name AS section');
        $this->db->from('student AS ST');
        $this->db->join('enroll AS E', 'E.student_id = ST.student_id', 'left');
        $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
        $this->db->join('section AS S', 'S.section_id = E.section_id', 'left');
        $this->db->join('transport_members AS TM', 'TM.user_id = ST.student_id', 'left');
        $this->db->join('route_stops AS RS', 'RS.id = TM.route_stop_id', 'left');
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('E.year', $this->year);
        $this->db->where('ST.is_transport_member', $is_transport_member);
        $this->db->order_by('TM.id', 'DESC');
        return $this->db->get()->result();
    }
	
}
