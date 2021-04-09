<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Vehicle.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Vehicle
 * @description     : Manage transport vehicle.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Travel extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Travel_Model', 'travel', true);
        $this->load->model('Vehicle_Model', 'vehicle', true);
        $this->load->model('Inventory_Model', 'inventory', true); 
        $this->load->library('session');
        $this->load->helper('array');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");			
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Vehicle List" user interface                 
    *                     
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        //check_permission(VIEW);
        $this->data['vehicles']   = $this->travel->get_travel_list();
        $this->data['list']       = TRUE;
		$this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);  
        $this->load->view('backend/page', $this->data);
    }
    
    public function index_vehicle_service() {
        //check_permission(VIEW);
        if(isset($_GET['transdel'])){
            $v_id=$_GET['transdel'];
            $this->vehicle->get_vehicle_nullified($v_id);
            redirect('transport/travel/index_vehicle_service');
        }
        $this->data['vehicles']   = $this->vehicle->get_vehicle_expenditure();
        $this->data['liste']       = TRUE;
		$this->data['page_name']  = 'index';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);  
        $this->load->view('backend/page', $this->data);
    }
    
    public function report() {
        $date=$this->input->post('dated');
        $this->data['vehicles']   = $this->travel->get_travel_list_date($date);
        $this->data['list']       = TRUE;
		$this->data['page_name']  = 'index_report';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);  
        $this->load->view('backend/page', $this->data);
    }
    
    public function get_date_data() {
        //check_permission(VIEW);
        $date=$this->input->post('dated');
        $this->data['vehicles']   = $this->travel->get_travel_list_date($date);
        //print_r($this->data['vehicles']);die;
        $this->data['list']       = TRUE;
		$this->data['page_name']  = 'index_ajax';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);
        $this->load->view('backend/transport/travel/index_ajax', $this->data);
        //$this->set_output($data);
    }
    
    public function get_date_data_report() {
        //check_permission(VIEW);
        $date=$this->input->post('dated');
        $this->data['vehicles']   = $this->travel->get_travel_list_date($date);
        //print_r($this->data['vehicles']);die;
        $this->data['list']       = TRUE;
		$this->data['page_name']  = 'index_ajax';
		$this->data['page_title'] = 'Travelled distance';
        $this->data['folder']     = 'transport/travel';
        $this->layout->title($this->lang->line('manage_travel') . ' | ' . SMS);
        $this->load->view('backend/transport/travel/index_ajax_report', $this->data);
        //$this->set_output($data);
    }

    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Vehicle" user interface                 
    *                    and process to store "Vehicle" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_travel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_travel_data();
//die;
                $insert_id = $this->vehicle->insert('travelled', $data);
                if ($insert_id) {
                    
                   // create_log('Has been added a Vehicle : '.$data['number']);
                    success($this->lang->line('insert_success'));
                    redirect('transport/travel/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('transport/travel/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['vehicles'] = $this->vehicle->get_vehicle_list();
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index_add';
        $this->data['page_title'] = 'Vehicles';
        $this->data['folder'] = 'transport/travel';
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('vehicle') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Vehicle" user interface                 
    *                    and process to store "Vehicle" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add_vehicle_service(){

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_travel_vehicle_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_travel_vehicle_data();
//die;
                $insert_id = $this->vehicle->insert('vehicle_service', $data);
                
                if ($insert_id) {
                    
                   // create_log('Has been added a Vehicle : '.$data['number']);
                    success($this->lang->line('insert_success'));
                    redirect('transport/travel/index_vehicle_service');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('transport/travel/add_vehicle_service');
                }
            } else {
                $this->data['post'] = $_POST;
            }die;
        }

        $this->data['vehicles'] = $this->vehicle->get_vehicle_list();
        $this->data['add'] = TRUE;
        $this->data['page_name'] = 'index_vehicle_service';
        $this->data['page_title'] = 'Vehicles';
        $this->data['folder'] = 'transport/travel';
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('vehicle') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    
    
    public function list_travel() {

        //check_permission(VIEW);

        $this->data['inventories'] = $this->inventory->get_inventory_travel_list();
        //print_r($this->data['inventories']); die;
        //$this->data['hostels'] = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'add-index';
		$this->data['page_title'] = 'Inventory';
		$this->data['folder'] = 'inventory';
        $this->layout->title($this->lang->line('manage_inventory') . ' | ' . SMS);
        
        $this->load->view('backend/page', $this->data);
    }
    public function add_travel() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_room_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_room_data();
                //print_r($data);die;
                $insert_id = $this->inventory->insert('inventory_travel', $data);
                if ($insert_id) {
                    
                    //$hostel = $this->inventory->get_single('hostels', array('id' => $data['hostel_id']));
                   // create_log('Has been added a room no : '.$data['room_no']. ' of '. $hostel->name );
                    
                    success($this->lang->line('insert_success'));
                    redirect('transport/travel/list_travel');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('transport/travel/list_travel');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        ini_set('display_errors',1);
        $this->data['inventories'] = $this->inventory->get_inventory_travel_list();
        //$this->data['hostels']     = $this->inventory->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['add']         = TRUE;
        $this->data['page_name']   = 'add-type-travel-inventory';
        $this->data['page_title']  = 'inventory';
        $this->data['folder']      = 'inventory';

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    
    private function _prepare_room_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        //$this->form_validation->set_rules('id', 'ID', 'trim|required');
        
        $this->form_validation->set_rules('inventory_type', 'Inventory type', 'trim|required');
        $this->form_validation->set_rules('inventory_name', 'Inventory name', 'trim|required');
       // $this->form_validation->set_rules('inventory_slug', $this->lang->line('cost_per_seat'), 'trim');
        
    }
     private function _get_posted_room_data() {

        $items = array();
        //$items[] = 'name';
        //$items[] = 'inventory_slug';

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            $data['name'] = $this->input->post('inventory_name');
            $data['inventory_type'] = $this->input->post('inventory_type');
            //$data['inventory_slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['inventory_name']));
            $data['status'] = 1;
            $data['modified_at'] = date('Y-m-d');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['name'] = $this->input->post('inventory_name');
            $data['inventory_type'] = $this->input->post('inventory_type');
            //$data['inventory_slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['inventory_name']));
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }
    
    
    
    
    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Vehicle" user interface                 
    *                    with populate "Vehicle" value 
    *                    and process to update "Vehicle" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

       // check_permission(EDIT);

        if(!is_numeric($id)){
           error($this->lang->line('unexpected_error'));
          redirect('transport/vehicle/index');
        }
        
        if ($_POST) {
            $this->_prepare_vehicle_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_vehicle_data();
                $updated = $this->vehicle->update('vehicles', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a Vehicle : '.$data['number']);
                    $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
                    redirect('transport/vehicle/index');
                } else {
                    $this->session->set_flashdata('error_message' , get_phrase('update_failed'));
                   
                    redirect('transport/vehicle/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['vehicle'] = $this->vehicle->get_single('vehicles', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['vehicle'] = $this->vehicle->get_single('vehicles', array('id' => $id));

            if (!$this->data['vehicle']) {
                redirect('transport/vehicle/index');
            }
        }

        $this->data['vehicles']   = $this->vehicle->get_vehicle_list();
        $this->data['edit']       = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Vehicles';
        $this->data['page_title'] = 'Vehicles';
        $this->data['folder']     = 'transport/vehicle';
        $this->load->view('backend/page', $this->data);
    }
    
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Vehicle data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        check_permission(VIEW);
        if(!is_numeric($id)){
           error($this->lang->line('unexpected_error'));
          redirect('transport/vehicle/index');
        }
        
        $this->data['vehicle'] = $this->vehicle->get_single('vehicles', array('id' => $id));
        $this->data['vehicles'] = $this->vehicle->get_vehicle_list();
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('vehicle') . ' | ' . SMS);
        $this->layout->view('vehicle/index', $this->data);
    }
    
    /*****************Function _prepare_vehicle_validation**********************************
    * @type            : Function
    * @function name   : _prepare_vehicle_validation
    * @description     : Process "Vehicle" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_travel_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div vehicle="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('vehicle_no', 'Vehicle number' , 'trim');
        $this->form_validation->set_rules('start_km', 'Start km', 'trim|required');
        $this->form_validation->set_rules('end_km', 'End km', 'trim');
        $this->form_validation->set_rules('total_distance', 'Total distance', 'trim');
        $this->form_validation->set_rules('created_at', 'Created at', 'trim');
      
    }
    
    private function _prepare_travel_vehicle_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div vehicle="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('vehicle_no', 'Vehicle number' , 'trim');
        
        $this->form_validation->set_rules('total_cost', 'Total cost', 'trim');
        $this->form_validation->set_rules('created_at', 'Created at', 'trim');
      
    }

        
    /*****************Function number**********************************
    * @type            : Function
    * @function name   : number
    * @description     : Unique check for "Vehicle Number" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function number() {
        if ($this->input->post('id') == '') {
            $vehicle = $this->vehicle->duplicate_check($this->input->post('number'));
            if ($vehicle) {
                $this->form_validation->set_message('number', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $vehicle = $this->vehicle->duplicate_check($this->input->post('number'), $this->input->post('id'));
            if ($vehicle) {
                $this->form_validation->set_message('number', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
   
   
    /*****************Function _get_posted_vehicle_data**********************************
    * @type            : Function
    * @function name   : _get_posted_vehicle_data
    * @description     : Prepare "Vehicle" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_travel_vehicle_data() {

        $items = array();
        $items[] = 'vehicle_no';
        $items[] = 'total_cost';
        $items[] = 'next_service_date';
        $items[] = 'fitness';
        $items[] = 'remark';
       

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
                        $data['vehicle_no'] = $this->input->post('vehicle_no');
            $data['total_cost'] = $this->input->post('total_cost');
            $data['next_service_date'] = $this->input->post('next_service_date');
            $data['service_date'] = $this->input->post('service_date');
            $data['fitness'] = $this->input->post('fitness');
            $data['remark'] = $this->input->post('remark');
            //$data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = logged_in_user_id();
        } else {
           $data['vehicle_no'] = $this->input->post('vehicle_no');
            $data['total_cost'] = $this->input->post('total_cost');
            $data['next_service_date'] = $this->input->post('next_service_date');
            $data['service_date'] = $this->input->post('service_date');
            $data['fitness'] = $this->input->post('fitness');
            $data['remark'] = $this->input->post('remark');
            $data['status'] = '1';
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['created_at'] = date('Y-m-d H:i:s');
            
        }

        return $data;
    }
    
    
     /*****************Function _get_posted_vehicle_data**********************************
    * @type            : Function
    * @function name   : _get_posted_vehicle_data
    * @description     : Prepare "Vehicle" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_travel_data() {

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

        if ($this->input->post('id')) {
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
            //$data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = logged_in_user_id();
        } else {
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
            //$data['is_allocated'] = 0;
            
            $data['status'] = 1;
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = logged_in_user_id();
        }

        return $data;
    }
    
    
    

        
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Vehicle" data from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);
        if(!is_numeric($id)){
           error($this->lang->line('unexpected_error'));
          redirect('transport/vehicle/index');
        }
        
        $vehicle = $this->vehicle->get_single('vehicles', array('id' => $id));
        if ($this->vehicle->delete('vehicles', array('id' => $id))) {
            create_log('Has been deleted a Vehicle : '.$vehicle->number);
            $this->session->set_flashdata('flash_message' , get_phrase('data_delete_successfully'));
        } else {
            $this->session->set_flashdata('error_message' , get_phrase('data_delete_failed'));
        }
        redirect('transport/vehicle/index');
    }

     function getLocationOfDriver() {
        $driverId = $this->input->post('driver_id');

        $query = $this->db->get_where('vehicle_location', array('driver_id' => $driverId)) -> row();
       
        if($query != ""){
          echo json_encode($query);
        }else{
            echo '0';
        }
    }
    
    
    
    
    
    
    

}
