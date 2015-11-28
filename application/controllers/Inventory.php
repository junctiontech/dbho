<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('inventory_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
// Inventory Started Here.................................................................................................................

/*Inventory view Load Start.............................................................................................................*/
	function index($inventoryid=FALSE)
	{	
		$this->data['inventoryid']=$inventoryid;
		$this->data['inventory']=$this->inventory_model->get_inventory();
		$this->data['company_name']=$this->inventory_model->get_company_name();
		$this->data['cities']=$this->inventory_model->get_city();
		$this->data['projects']=$this->inventory_model->get_project();
		
		$this->load->view('inventory',$this->data);
	}
/*Inventory view Load End.............................................................................................................*/
	
/*Inventory create insert and update start .........................................................................................*/
	function Add_inventory()
	{	
		
		if(!empty($this->input->post('submit')))
		{
			
			$type=$this->input->post('type');
			$user_id=$this->input->post('user_id');
			$inventory_des=$this->input->post('inventory_des');
			$city_id=$this->input->post('city_id');
			$project_id=$this->input->post('project_id');
			$start_date=$this->input->post('start_date');
			$duration=$this->input->post('duration');
			$weightage=$this->input->post('weightage');
			$remark=$this->input->post('remark');
			
			if($_FILES['file']['name']!=''){
			$data['image_z1']= $_FILES['file']['name'];
			 
			$image=sha1($_FILES['file']['name']).time().rand(0, 9);
			if(!empty($_FILES['file']['name'])){
				
				$config =  array(
						'upload_path'	  => './upload_banner/',
						'file_name'       => $image,
						'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
						'overwrite'       => true);
				$this->upload->initialize($config);
				$this->load->library('upload');
				 
				if($this->upload->do_upload("file")){
					
					$upload_data = $this->upload->data();
					$image=$upload_data['file_name'];
				}
				else
				{
					$this->upload->display_errors()."file upload failed";
					$image    ="";
				}}}
				
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			if(!empty($type) && !empty($user_id) && !empty($inventory_des) && !empty($city_id) && !empty($project_id)  && !empty($start_date) && !empty($duration) && !empty($weightage) && !empty($remark)){
				
				if(!empty($this->input->post('inventory_id'))){
						
							$filter=array('inventoryID'=>$this->input->post('inventory_id'));
							$this->inventory_model->insert_userplan($type,$user_id,$inventory_des,$city_id,$project_id,$image,$start_date,$duration,$weightage,$remark,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Updated Successfully!!");
							
					}else{
							$this->inventory_model->insert_userplan($type,$user_id,$inventory_des,$city_id,$project_id,$image,$start_date,$duration,$weightage,$remark);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Added Successfully!!");
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('Inventory');
			}
		}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
			redirect('Inventory/Inventory_listing');
	}
	
/*Inventory create insert and update End .........................................................................................*/

/*Inventory_listing view Load Start.............................................................................................................*/
	function Inventory_listing($class=false,$section=false,$subject=false,$date=false)
	{	
		
		$this->data['inventory_list']=$this->inventory_model->get_inventorylist();
		
		$this->load->view('inventory_listing',$this->data);
	}
/*Inventory_listing view Load End.............................................................................................................*/
	
		
}
