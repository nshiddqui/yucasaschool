<?php
header('Content-Type: text/html');
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
class Marksheet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
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
        date_default_timezone_set("Asia/Calcutta");
        //$this->load->library("Aauth");

        //Authenticate data manipulation with the user level security key
      
    }
    
function test() {
	echo "this is a test";
}
function student_marksheet_print_view_mobile($student_id, $exam_id) {
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }

}


/*Cpanel URL: http://www.edurama.in/cpanel
cpanel username: edurama
cpanel password: z@2dy2dTzuUUNhmf
*/