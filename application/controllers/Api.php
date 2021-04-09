<?php
header('Content-Type: application/json');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  @author     : Creativeitem
 *  date        : 14 september, 2017
 *  Specification    :    Mobile app response, JSON formatted data for iOS & android app
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */
class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Achievement_Model', 'achievement', true);
        $this->load->model('Type_Model', 'type', true);
        $this->load->model('Visitor_Model', 'visitor', true);
        $this->load->model('Guardian_Model', 'guardian', true);
        $this->load->model('Parents_Model', 'parents', true);
        $this->load->model('Route_Model', 'route', true);
        $this->load->model('Member_Model', 'member', true);
        $this->load->model('Vehicle_Model', 'vehicle', true);
        $this->load->model('Grade_Model', 'grade', true);
        $this->load->model('Payment_Model', 'payment', true);
        $this->load->model('Designation_Model', 'designation', true);
        $this->load->model('Employee_Model', 'employee', true);
        $this->load->model('Hostel_Model', 'hostel', true);
        $this->load->model('Room_Model', 'room', true);
        $this->load->model('Event_Model', 'event', true);
        $this->load->model('Feetype_Model', 'feetype', true);
        $this->load->model('Discount_Model', 'discount', true);
        $this->load->model('Invoice_Model', 'invoice', true);
        $this->load->model('Duefeeemailsms_Model', 'mail', true);
        $this->load->model('Incomehead_Model', 'incomehead', true);
        $this->load->model('Exphead_Model', 'exphead', true);
        $this->load->model('Schedule_Model', 'schedule', true);
        $this->load->model('Ajax_Model', 'ajax', true);
        $this->load->model('Expenditure_Model', 'expenditure', true);
        $this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
        $this->load->model('Assignment_Model', 'assignment', true);
        $this->load->model('Inventory_Model', 'inventory', true);
        $this->load->model('Assignment_Individual_Model', 'assignment_individual', true);
        $this->load->library('session');
        date_default_timezone_set("Asia/Calcutta");
    }
    
    function getStaff(){
        $staffData = array();
        if($this->input->post('designation_id')){
            $designations = $this->db->get('designations',array('id'=>$this->input->post('designation_id')))->result_array();
        } else {
            $designations = $this->db->get('designations')->result_array();
        }
        foreach($designations as $designation){
            $designations_name = $designation['name'];
            if(!$this->db->table_exists(lcfirst($designations_name))){
                continue;
            }
            $designations_data = $this->db->get(lcfirst($designations_name))->result_array();
            $primary_id = lcfirst($designations_name)."_id";
            foreach($designations_data as $row){
                if($this->input->post('timestamp')){
                    $attendanceDetails = $this->db->get_where('attendance_employee' ,array(
                        'timestamp' => strtotime($this->input->post('timestamp')),
                        'employee_id' => $row[$primary_id],
                        'designation_id' => $designation['id']
                    ))->row();
                    if(!empty($attendanceDetails)){
                        $staffData[] = ['id' => $row[$primary_id], 'attendance' => (int)$attendanceDetails->status ] + $row;
                    }else{
                        $staffData[] = ['id' => $row[$primary_id], 'attendance' => 0 ] + $row;
                    }
                } else {
                    $staffData[] = ['id' => $row[$primary_id], 'attendance' => 0 ] + $row;
                }
                
            }
             
        }
        echo json_encode($staffData);
    }
    
    function markEmployeeAttendance(){
        $this->form_validation->set_rules('timestamp', 'timestamp', 'trim|required');
        $this->form_validation->set_rules('designation_id', 'designation_id', 'trim|required');
        $this->form_validation->set_rules('employee_id', 'employee_id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        if($this->form_validation->run() === TRUE){
            $attendanceExist = $this->db->get_where('attendance_employee' ,array(
                       'timestamp' => strtotime($this->input->post('timestamp')),
                        'employee_id' => $row[$primary_id],
                        'designation_id' => $designation['id']
                        ));
    
             if($attendanceExist->num_rows() < 1){
                $attn_data['status'] = $this->input->post('status');
                $attn_data['attendence_by'] = $this->input->post('attendance_by');
                $attn_data['designation_id']   = $this->input->post('designation_id');
                $attn_data['timestamp']  = strtotime($this->input->post('timestamp'));
                $attn_data['date']  = date('Y-m-d',strtotime($this->input->post('timestamp')));
                $attn_data['employee_id'] = $this->input->post('employee_id');
                $this->db->insert('attendance_employee' , $attn_data);
            } else {
                $this->db->where('attendance_id',$attendanceExist->row()->attendance_id);
                $this->db->update('attendance_employee',['status'=> $this->input->post('status')]);   
            }
            $data = array('status'=>200);
        } else {
            $data = array(
                'status' => 400,
                'error' => strip_tags(validation_errors())
            );
        }
        echo json_encode($data);
    }
    
    function getEmployeeAttendance(){
        $option = array();
        if(!empty($this->input->post('designation_id'))){
            $option['designation_id'] = $this->input->post('designation_id');
        }
        if(!empty($this->input->post('attendence_by'))){
            $option['attendence_by'] = $this->input->post('attendence_by');
        }
        if(!empty($this->input->post('employee_id'))){
            $option['employee_id'] = $this->input->post('employee_id');
        }
        if(!empty($this->input->post('date'))){
            $option['date'] = $this->input->post('date');
        }
        echo json_encode($this->db->get_where('attendance_employee' ,$option)->result_array());
    }
    
    function getExpenditureOnService(){
            $option  = array(
                            'status'=> 1
                        );
            if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
                $option['created_at >='] = $this->input->post('date_to');
                $option['created_at <='] = $this->input->post('date_from');
            } else {
                $session_year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
                $session_year = explode('-',$session_year);
                $option['YEAR(created_at) >='] = $session_year[0];
                $option['YEAR(created_at) <='] = $session_year[1];
            }
            $data_vehicle = $this->db->get_where('vehicle_service' ,$option)->result_array();
            $response_data = array();
            foreach ($data_vehicle as $val){
                $data = array();
                $data['serial_number'] = $val['id'];
                $data['date'] = $val['created_at'];
                $data['month'] = date('F',strtotime($val['created_at']));
                $data['year'] = explode('-', $val['created_at'])[0];
                $data['vehicle_number'] = $val['vehicle_no'];
                $data['service_date'] = $val['service_date'];
                $data['total_expenditure'] = $val['total_cost'];
                $data['next_service_date'] = $val['next_service_date'];
                $data['remarks'] = $val['remark'];
                $data['fitness'] = $val['fitness'];
                array_push($response_data,$data);
            }
            echo json_encode($response_data);
    }
    
    function getTotalDistanceTravelledByBus(){
            $option  = array(
                            'inventory_type'=> 1
                        );
            if(!empty($this->input->post('date_to')) && !empty($this->input->post('date_from'))){
                $option['created_at >='] = $this->input->post('date_to');
                $option['created_at <='] = $this->input->post('date_from');
            } else {
                $session_year = $this->db->get_where('settings', array(
                                    'type' => 'running_year'
                                ))->row()->description;
                $session_year = explode('-',$session_year);
                $option['YEAR(created_at) >='] = $session_year[0];
                $option['YEAR(created_at) <='] = $session_year[1];
            }
            $datas = $this->db->get_where('travelled' ,$option)->result_array();
            $response_data = array();
            
            foreach ($datas as $val){
                $data = array();
                $data['serial_number'] = $val['id'];
                $data['date'] = $val['created_at'];
                $data['month'] = date('F',strtotime($val['created_at']));
                $data['year'] = explode('-', $val['created_at'])[0];
                $data['vehicle_number'] = $val['vehicle_no'];
                $data['start_run'] = $val['start_km'];
                $data['end_run'] = $val['end_km'];
                $data['total_run'] = $val['total_distance'];
                $data['need_to_be_filed'] = $val['cash'];
                $data['total_advanced_payment'] = (int)$val['advanced_payment'];
                $data['status'] = ($val['cash']!='' && is_numeric($val['cash']))?'PAID':'UNPAID';
                array_push($response_data,$data);
            }
            echo json_encode($response_data);

    }
    
    function addVehicleTravelledDetails(){
            $this->form_validation->set_rules('vehicle_no', 'Vehicle number' , 'trim|required');
            $this->form_validation->set_rules('start_km', 'Start km', 'trim|required');
            $this->form_validation->set_rules('end_km', 'End km', 'trim|required');
            $this->form_validation->set_rules('total_distance', 'Total distance', 'trim|required');
            $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_travel_data();
                $insert_id = $this->vehicle->insert('travelled', $data);
                if ($insert_id) {
                    $data = array('status' => 200);
                } else {
                    $data = array('status' => 400);
                }
            } else {
                $data = array(
                    'status' => 400,
                    'error' => strip_tags(validation_errors())
                );
            }
            echo json_encode($data);
    }
    
    function _get_posted_travel_data(){
        $items = array();
        $items[] = 'vehicle_no';
        $items[] = 'end_km';
        $items[] = 'start_km';
        $items[] = 'total_distance';
        $items[] = 'created_at';
        $items[] = 'cash';
        $items[] = 'diesel';
        $items[] = 'vehicle_damage';
        $items[] = 'vehicle_repairing';

        $data = elements($items, $_POST);

        $data['vehicle_no'] = $this->input->post('vehicle_no');
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['start_km'] = $this->input->post('start_km');
        $data['end_km'] = $this->input->post('end_km');
        $data['total_distance'] = $this->input->post('total_distance');
        $data['cash'] = $this->input->post('cash');
        $data['diesel'] = $this->input->post('diesel');
        $data['inventory_type'] = $this->input->post('inventory_type');
        $data['usage_location'] = $this->input->post('usage_location');
        $data['vehicle_damage'] = $this->input->post('vehicle_damage');
        $data['vehicle_repairing'] = $this->input->post('vehicle_repairing');
        $data['advanced_payment'] = $this->input->post('advanced_payment');
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->input->post('user_id');
        return $data;
    }
}