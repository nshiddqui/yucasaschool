<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Room.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Room
 * @description     : Manage hostel room.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Transport extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Transport_Model', 'transport', true);  
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
    * @description     : Load "Hostel Room List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        //check_permission(VIEW);

        $this->data['inventories'] = $this->transport->get_inventory_list();
        //$this->data['hostels'] = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index';
		$this->data['page_title'] = 'Inventory';
		$this->data['folder'] = 'inventory';
        $this->layout->title($this->lang->line('manage_inventory') . ' | ' . SMS);
        
        $this->load->view('backend/page', $this->data);
    }


    public function magnitude() {

        //check_permission(VIEW);

        
        $this->data['inventories'] = $this->inventory->get_inventory_list_quantity();
        //print_r($this->data['inventories']);
        //die;
        //$this->data['hostels'] = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
		$this->data['page_name'] = 'index_add';
		$this->data['page_title'] = 'Inventory';
		$this->data['folder'] = 'inventory';
        //$this->layout->title($this->lang->line('manage_inventory') . ' | ' . SMS);
        //print_r($this->data);die;
        $this->load->view('backend/page', $this->data);
    }

  
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Hostel Room" user interface                 
    *                    and process to store "Hostel Room" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_room_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_room_data();
                //print_r($data);die;
                $insert_id = $this->inventory->insert('inventory', $data);
                if ($insert_id) {
                    
                    //$hostel = $this->inventory->get_single('hostels', array('id' => $data['hostel_id']));
                   // create_log('Has been added a room no : '.$data['room_no']. ' of '. $hostel->name );
                    
                    success($this->lang->line('insert_success'));
                    redirect('inventory/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('inventory/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        
        $this->data['inventories'] = $this->inventory->get_inventory_list();
        //$this->data['hostels']     = $this->inventory->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['add']         = TRUE;
        $this->data['page_name']   = 'add-type';
        $this->data['page_title']  = 'inventory';
        $this->data['folder']      = 'inventory';

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }
    


public function add_inventory() {

       // check_permission(ADD);

        if ($_POST) {
            $this->_prepare_inventory_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_inventory_data();
                //print_r($data);die;
                $insert_id = $this->inventory->insert('inventory_warehouse', $data);
                if ($insert_id) {
                    
                    //$hostel = $this->inventory->get_single('hostels', array('id' => $data['hostel_id']));
                   // create_log('Has been added a room no : '.$data['room_no']. ' of '. $hostel->name );
                    
                    success($this->lang->line('insert_success'));
                    redirect('inventory/magnitude');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('inventory/magnitude');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['invens'] = $this->inventory->get_inventory_list();
        //$this->data['hostels']     = $this->inventory->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['add']         = TRUE;
        $this->data['page_name']   = 'add-inventory';
        $this->data['page_title']  = 'inventory';
        $this->data['folder']      = 'inventory';

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }


        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Hostel Room" user interface                 
    *                    with populate "Hostel Room" value 
    *                    and process to update "Hostel Room" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        //check_permission(EDIT);

        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          redirect('inventory/index');
        }
        
        if ($_POST) {
            $this->_prepare_room_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_room_data();
                $updated = $this->room->update('inventory', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    //$hostel = $this->room->get_single('hostels', array('id' => $data['hostel_id']));
                    //create_log('Has been updated a room no : '.$data['room_no']. ' of '. $hostel->name );
                    
                    success($this->lang->line('update_success'));
                    redirect('inventory/index');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('inventory/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['inventory'] = $this->inventory->get_single_inventory('inventory', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['room'] = $this->inventory->get_single_inventory('inventory', array('id' => $id));

            if (!$this->data['room']) {
                redirect('inventory/index');
            }
        }

        $this->data['rooms']      = $this->inventory->get_inventory_list();
        //$this->data['hostels']    = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['edit']       = TRUE;
        $this->data['page_name']  = 'add-type';
        $this->data['page_title'] = 'Inventory';
        $this->data['folder']     = 'inventory';
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

    
        
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Hostel Room data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        //check_permission(VIEW);
        
        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          redirect('room/index');
        }
        
        $this->data['rooms']   = $this->inventory->get_inventory_list();
        //$this->data['hostels'] = $this->room->get_list('hostels', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['inventory']       = $this->room->get_single_inventory($id);
        $this->data['detail']     = TRUE;
        $this->data['page_name']  = 'index';
        $this->data['page_title'] = 'Inventory';
        $this->data['folder']     = 'inventory';
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('room') . ' | ' . SMS);
        $this->load->view('backend/page', $this->data);
    }

        
    /*****************Function _prepare_room_validation**********************************
    * @type            : Function
    * @function name   : _prepare_room_validation
    * @description     : Process "HOstel Room" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_room_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        //$this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('inventory_name', 'Inventory name', 'trim|required');
       // $this->form_validation->set_rules('inventory_slug', $this->lang->line('cost_per_seat'), 'trim');
        
    }
    
    private function _prepare_inventory_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        //$this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('inven_id', 'Inventory type', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
       // $this->form_validation->set_rules('inventory_slug', $this->lang->line('cost_per_seat'), 'trim');
        
    }

    
        
    
    /*****************Function room_no**********************************
    * @type            : Function
    * @function name   : room_no
    * @description     : Unique check for "Hostel Room No" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function room_no() {
        if ($this->input->post('id') == '') {
            $room = $this->room->duplicate_check($this->input->post('hostel_id'), $this->input->post('room_no'));
            if ($room) {
                $this->form_validation->set_message('room_no', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $room = $this->room->duplicate_check($this->input->post('hostel_id'), $this->input->post('room_no'), $this->input->post('id'));
            if ($room) {
                $this->form_validation->set_message('room_no', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    
       
    /*****************Function _get_posted_room_data**********************************
    * @type            : Function
    * @function name   : _get_posted_room_data
    * @description     : Prepare "Hostel Room No" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_room_data() {

        $items = array();
        $items[] = 'inventory_name';
        $items[] = 'inventory_slug';

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            $data['inventory_name'] = $this->input->post('inventory_name');
            $data['inventory_slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['inventory_name']));
            $data['status'] = 1;
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['inventory_name'] = $this->input->post('inventory_name');
            $data['inventory_slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($data['inventory_name']));
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }
    
    
    private function _get_posted_inventory_data() {

        $items = array();
        $items[] = 'inven_id';
        $items[] = 'quantity';
        $items[] = 'condition';

        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
                    $data['inven_id'] = $this->input->post('inven_id');
            $data['quantity'] = $this->input->post('quantity');
            $data['condition'] = $this->input->post('inven_id');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['inven_id'] = $this->input->post('inven_id');
            $data['quantity'] = $this->input->post('quantity');
            $data['condition'] = $this->input->post('inven_id');
             $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        return $data;
    }



  function get_section($class_id) {
          $page_data['class_id'] = $class_id;
          $this->load->view('backend/admin/manage_attendance_section_holder' , $page_data);
    }
         
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Hostel Room" data from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        //check_permission(DELETE);

        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          redirect('inventory/index');
        }
        
        $room = $this->inventory->get_single_inventory('inventory', array('id' => $id));
        
        if ($this->inventory->delete('inventory', array('id' => $id))) {
            
            //$hostel = $this->room->get_single('hostels', array('id' => $room->hostel_id));
            //create_log('Has been deleted a room no : '.$room->room_no. ' of '. $hostel->name );
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
         redirect('inventory/index');
    }

}
