<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxdataload_model extends CI_Model
{
	function __construct() {
        parent::__construct(); 
    }

	/*----------------------------- BOOKS -------------------------------*/

	function all_books_count()
	{
		$query = $this->db->get('book');
		return $query->num_rows();
	}

	function all_books($limit, $start, $col, $dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('book');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
        
    }

    function book_search($limit, $start, $search, $col, $dir)
    {
        $query = $this
                ->db
                ->like('name', $search)
                ->or_like('author', $search)
                ->or_like('book_id', $search)
                ->or_like('price', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('book');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function book_search_count($search)
    {
        $query = $this
                ->db
                ->like('name', $search)
                ->or_like('book_id', $search)
                ->or_like('author', $search)
                ->or_like('price', $search)
                ->get('book');
    
        return $query->num_rows();
    }

	/*----------------------------- BOOKS -------------------------------*/


	/*----------------------------- student -------------------------------*/

	function all_students_count()
	{
		$query = $this->db->get('student');
		return $query->num_rows();
	}

	function all_students($limit, $start, $col, $dir)
    {   
      $query = $this->db->limit($limit,$start)->order_by($col,$dir) ->get('student');
        
       if($query->num_rows() > 0)
            return $query->result();
        else
           return null;
         //  $this->db->select('S.*,E.*');
         //$this->db->from('student S');
        // $this->db->join('enroll E','E.student_id = S.student_id');
        // $this->db->like('S.name',$search);
        // $this->db->or_like('S.email',$search);
        // $this->db->or_like('S.student_id',$search);
        // $this->db->or_like('S.address',$search);
       //  $this->db->limit($limit, $start);
       //  $this->db->order_by($col, $dir);
         //$query = $this->db->get()->result();
         //if(sizeof($query) > 0)
        //     return $query;
        // else
        //     return null;
    }
    
      

    function student_search($limit, $start, $search, $col, $dir)
    {
       // $query = $this
            //    ->db
             //   ->like('name', $search)
             //   ->or_like('email', $search)
             //   ->or_like('student_id', $search)
             //   ->or_like('class', $search)
             //   ->limit($limit, $start)
            //    ->order_by($col, $dir)
            //    ->get('student');
                
                
        
     //   if($query->num_rows() > 0)
      //      return $query->result();
      //  else
        //    return null;
            
            
            
               $this->db->select('E.*, S.email, S.name, S.phone, E.class_id, E.section_id, S.student_id, S.status');
               $this->db->from('student AS S');
               $this->db->join('enroll AS E', 'E.student_id = S.student_id', 'left');
               $this->db->join('class AS C', 'C.class_id = E.class_id', 'left');
                  $this->db->or_like('C.name',$search);
                    $this->db->or_like('S.name',$search);
                    $this->db->or_like('S.phone',$search);
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
                    if($query->num_rows() > 0)
                    return $query->result();
                    else
                    return null; 
    }

    function student_search_count($search)
    {
       
                    $this->db->select('*');
                    $this->db->from('student');
                    $this->db->join('enroll', 'enroll.student_id = student.student_id');
                    $this->db->join('class', 'class.class_id = enroll.class_id');
                    $this->db->or_like('class.name',$search);
                    $this->db->or_like('student.name',$search);
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
        return $query->num_rows();
        
        
        
    }

	/*----------------------------- student -------------------------------*/

    /*----------------------------- TEACHERS -------------------------------*/

    function all_teachers_count()
    {
        //$query = $this->db->get('teacher');
        $this->db->select('T.*, T.email, T.name, T.phone,T.status AS login_status ');
        $this->db->from('teacher AS T');
       // $this->db->join('subject AS S', 'S.teacher_id = T.teacher_id', 'left');
        //$this->db->join('users AS U', 'U.id = S.user_id', 'left');
       // $this->db->limit($limit,$start) ->order_by($col,$dir);                
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	
	

    function all_teachers12($limit, $start, $col, $dir)
    {   
       $query = $this->db->limit($limit,$start) ->order_by($col,$dir)->get('teacher');
        		
        if($query->num_rows() > 0)
            return $query->result();
		
        else
            return null;
        
    }
	  public function all_teachers ($limit, $start, $col, $dir) {

            $this->db->select('T.*, T.email, T.name, T.phone, T.status AS login_status ');
            $this->db->from('teacher AS T');
           // $this->db->join('subject AS S', 'S.teacher_id = T.teacher_id', 'left');
            //$this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->limit($limit,$start) ->order_by($col,$dir);                
            return $this->db->get()->result();
               	
    }
	
	

    function teacher_search($limit, $start, $search, $col, $dir)
    {
        $query = $this
                ->db
                ->like('teacher_id', $search)
                ->or_like('name', $search)
                ->or_like('email', $search)
                ->or_like('phone', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('teacher');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function teacher_search_count($search)
    {
        $query = $this
                ->db
                ->like('teacher_id', $search)
                ->or_like('name', $search)
                ->or_like('email', $search)
                ->or_like('phone', $search)
                ->get('teacher');
    
        return $query->num_rows();
    }

    /*----------------------------- TEACHERS -------------------------------*/


    /*----------------------------- PARENTS -------------------------------*/

    function all_parents_count()
    {
        $query = $this->db->get('parent');
        return $query->num_rows();
    }

    function all_parents($limit, $start, $col, $dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('parent');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
        
    }

    function parent_search($limit, $start, $search, $col, $dir)
    {
        $query = $this
                ->db
                ->like('parent_id', $search)
                ->or_like('name', $search)
                ->or_like('email', $search)
                ->or_like('phone', $search)
                ->or_like('profession', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('parent');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function parent_search_count($search)
    {
        $query = $this
                ->db
                ->like('parent_id', $search)
                ->or_like('name', $search)
                ->or_like('email', $search)
                ->or_like('phone', $search)
                ->or_like('profession', $search)
                ->get('parent');
    
        return $query->num_rows();
    }

	
		
	function children_of_parent(){
	$this->db->select('E.*, S.email, S.name, S.phone, S.role_id, S.status AS login_status ');
            $this->db->from('enroll AS E');
            $this->db->join('student AS S', 'S.student_id = E.student_id', 'left');
    $this->db->where('S.parent_id',$this->session->userdata('parent_id'));
    $query = $this->db->get();
      return $query->result();
	 $this->db->last_query();	
	
	}
	
    /*----------------------------- PARENTS -------------------------------*/

    /*----------------------------- EXPENSES -------------------------------*/

    function all_expenses_count()
    {
        $array = array('payment_type' => 'expense', 'year' => get_settings('running_year'));
        $query = $this
                ->db
                ->where($array)
                ->get('payment');
        return $query->num_rows();
    }

    function all_expenses($limit, $start, $col, $dir)
    {
        $array = array('payment_type' => 'expense', 'year' => get_settings('running_year'));
        if($this->datefrm && $this->dateto){
            $this->db->where('timestamp >=', $this->datefrm);
            $this->db->where('timestamp <=', $this->dateto);
        }
        if($this->category_id){
            $this->db->where('expense_category_id', $this->category_id);
        }
        $query = $this
                ->db
                ->where($array)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('payment');
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
        
    }

    function expense_search($limit, $start, $search, $col, $dir)
    {
        if($this->datefrm && $this->dateto){
            $this->db->where('timestamp >=', $this->datefrm);
            $this->db->where('timestamp <=', $this->dateto);
        }
        if($this->category_id){
            $this->db->where('expense_category_id', $this->category_id);
        }
        $query = $this
                ->db
                ->like('payment_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('payment');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function expense_search_count($search)
    {
        if($this->datefrm && $this->dateto){
            $this->db->where('timestamp >=', $this->datefrm);
            $this->db->where('timestamp <=', $this->dateto);
        }
        if($this->category_id){
            $this->db->where('expense_category_id', $this->category_id);
        }
        $query = $this
                ->db
                ->like('payment_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->get('payment');
    
        return $query->num_rows();
    }

    /*----------------------------- EXPENSES -------------------------------*/


    /*----------------------------- INVOICES -------------------------------*/

    function all_invoices_count()
    {
        $array = array('year' => get_settings('running_year'));
        $query = $this
                ->db
                ->where($array)
                ->get('invoice');
        return $query->num_rows();
    }

    function all_invoices($limit, $start, $col, $dir)
    {
        $array = array('year' => get_settings('running_year'));
        $query = $this
                ->db
                ->where($array)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('invoice');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
        
    }

    function invoice_search($limit, $start, $search, $col, $dir)
    {
        $query = $this
                ->db
                ->like('invoice_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->or_like('status', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('invoice');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function invoice_search_count($search)
    {
        $query = $this
                ->db
                ->like('invoice_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->or_like('status', $search)
                ->get('invoice');
    
        return $query->num_rows();
    }

    /*----------------------------- INVOICES -------------------------------*/


    /*----------------------------- PAYMENTS -------------------------------*/

    function all_payments_count()
    {
        $array = array('payment_type' => 'income', 'year' => get_settings('running_year'));
        $query = $this
                ->db
                ->where($array)
                ->get('payment');
        return $query->num_rows();
    }

    function all_payments($limit, $start, $col, $dir)
    {
        $array = array('payment_type' => 'income', 'year' => get_settings('running_year'));
        $query = $this
                ->db
                ->where($array)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('payment');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
        
    }

    function payment_search($limit, $start, $search, $col, $dir)
    {
        $query = $this
                ->db
                ->like('payment_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get('payment');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function payment_search_count($search)
    {
        $query = $this
                ->db
                ->like('payment_id', $search)
                ->or_like('title', $search)
                ->or_like('amount', $search)
                ->get('payment');
    
        return $query->num_rows();
    }
    function get_librarian_salary_details($user_id){
	 //print_r($user_id);exit;
	    $role='librarian';
        $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');
		$this->db->join('librarian AS V', 'V.librarian_id = S.user_id');
        $this->db->where('S.academic_year_id', $this->year);
        $this->db->where('S.payment_to', $role);
        $this->db->where('S.user_id', $this->session->userdata('login_user_id'));
       // $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
 } 
     function get_accountant_salary_details($user_id){
	 //print_r($user_id);exit;
	     $role='accountant';
        $this->db->select('S.* , S.created_at,V.name , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');
		$this->db->join('accountant AS V', 'V.accountant_id = S.user_id');
        $this->db->where('S.academic_year_id', $this->year);
        $this->db->where('S.payment_to', $role);
        $this->db->where('S.user_id', $this->session->userdata('login_user_id'));
       // $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
 } 
      function get_accountant_salary_details_all(){
        $this->db->select('S.* ,S.created_at , S.net_salary,S.total_deduction, S.note');
        $this->db->from('salary_payments AS S');
		
        $this->db->where('S.academic_year_id', $this->year);
        $this->db->where('S.payslip_status', 1);
       
       // $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
 } 
  
    /*----------------------------- PAYMENTS -------------------------------*/
}