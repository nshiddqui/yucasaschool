<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Awardee extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
		$data['page'] = 'awardee/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
		$data["site_data"] =$this->MASC->getData();		
		
		try
		{
			$searchpartners=isset($_POST['searchpartners'])? $_POST['searchpartners']:"";
			
			$data['searchpartners']   = $searchpartners;
			if($searchpartners!="")
			{
					$totalrecord=$this->AWD->getcountdata($searchpartners,1);
			}
			else
			{
				$totalrecord=$this->AWD->getcountdata("",0);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/awardee",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
				//$data['pages_d'] =$this->MCAP->getAllPages();
			$data['awardee_arr'] =$this->AWD->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
			$data['onpage']=$this->uri->segment($pagingConfig['uri_segment']);
			$this->load->view($this->_admin_container,$data);
		}
		catch (Exception $err)
		{
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
		
		
	}
	public function add()
	{
		$this->checkloginsession();
		$data["page"] = "awardee/add.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data['pages_arr'] =$this->MCAP->getAllPages();
		$data['user_group_array']= $this->UG->getAllUserGroup();
		$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function adddata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
                       if($this->AWD->checkData($_POST['awardee_slug'])=='1'){
$this->session->set_flashdata('action_message', 'Awardee Alredy Exists with the slug');
				redirect("catalog/awardee");
}
			$data=array(
				'awardee_name'=>$_POST['awardee_name'],
				'awardee_slug'=>$_POST['awardee_slug'],
				
				);
			
			if ($_POST['awardee_name'])
			{
				$data_return = $this->AWD->insertData($data);
			}
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Awardee Added Successfully');
				redirect("catalog/awardee");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/awardee");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/awardee");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$partners_id=$this->uri->segment(4);
		$data["header"]="Welcome in reco Admin ";
		$data["page"] = "awardee/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["single_data"]=$this->AWD->getSingalData($partners_id);
		$data['user_group_array']= $this->UG->getAllUserGroup();
		$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function updatedata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{

if($this->AWD->checkData($_POST['awardee_slug'])=='1'){
$this->session->set_flashdata('action_message', 'Awardee Alredy Exists with the slug');
				redirect("catalog/awardee");
}
			$data=array(
				'awardee_name'=>$_POST['awardee_name'],
				'awardee_slug'=>$_POST['awardee_slug'],
				
				);
			
			if ($data)
			{
				$partners_id=$_POST['id'];
				$data_return = $this->AWD->updateData($data,$partners_id);
			}
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Awardee Updated Successfully');
				redirect("catalog/awardee");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/awardee");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/awardee");
		}
	}
}