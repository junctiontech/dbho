<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_user_plan extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('manage_user_plan_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
// Manage_user_plan Started Here.................................................................................................................

/*Manage_user_plan view Load Start.............................................................................................................*/
	function index($action=false)
	{	if($action=="search"){
		
			$plantitle=$this->input->post('plantitle');
			$usertype=$this->input->post('username');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		}
		$this->load->view('manage_user_plan',$this->data);
	}
/*Manage_user_plan view Load End.............................................................................................................*/

/*Manage_user_plan Modal view Load Start.............................................................................................................*/
	function loadmodal($planid=false)
	{	if(!empty($planid)){
		$this->data['planid']=$planid;
		$filter=$planid;
		$tittle=$this->data['updateplan']=$this->manage_user_plan_model->select_for_update($filter);
			$tittle=explode("For",$tittle[0]->planTitle);
			$plantypeid=$this->manage_user_plan_model->select_for_update_plantittle($tittle[0]);
			$this->data['plantypeid']=$plantypeid[0]->planTypeID;
		}
		$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
		$this->data['plandetails']=$this->manage_user_plan_model->get_plandetails();
		$this->load->view('planmodal',$this->data);
	}
/*Manage_user_plan Modal view Load End.............................................................................................................*/


	
/*Manage_user_plan create insert and update start .........................................................................................*/
	function adduserplan()
	{	
	
		if(!empty($this->input->post('submit')))
		{
			
			$plantitle=explode("-",$this->input->post('plantitle'));
			$planusertype=$this->input->post('planusertype');
			$planorder=$this->input->post('planorder');
			$listingtype=$this->input->post('listingtype');
			$planstatus=$this->input->post('planstatus');
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
			if(!empty($plantitle[1]) && !empty($planusertype) && !empty($planorder) && !empty($listingtype) && !empty($planstatus)){
				
					if(!empty($this->input->post('planid'))){
						
							$filter=array('planID'=>$this->input->post('planid'));
							$this->manage_user_plan_model->insert_userplan($plantitle[1],$planusertype,$planorder,$plantype,$planstatus,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." User Plan Updated Successfully!!");
							
					}else{
							$this->manage_user_plan_model->insert_userplan($plantitle[1],$planusertype,$planorder,$plantype,$planstatus,$date);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." User Plan Added Successfully!!");
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
			}
		}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
			redirect('manage_user_plan');
	}
	
/*Manage_user_plan create insert and update End .........................................................................................*/

/*Add Plan Type view Load Start.............................................................................................................*/
	function AddPlanType()
	{	
		$this->data['plantypelist']=$this->manage_user_plan_model->get_plantypelist();
		$this->load->view('addplantype',$this->data);
	}
/*Add Plan Type view Load End.............................................................................................................*/

/*Add Plan Type Modal view Load Start.............................................................................................................*/
	function Addplantypemodal()
	{	
		$this->load->view('addplantypemodal',$this->data);
	}
/*Add Plan Type Modal view Load End.............................................................................................................*/

/*Add Plan Type Insert Into Db Start.............................................................................................................*/
	function Insertplantype()
	{	
		if(!empty($this->input->post('submit'))){
			
			$plantitle=$this->input->post('plantitle');
			$planpriority=$this->input->post('planpriority');
			
			
				if(!empty($plantitle) && !empty($planpriority)){
					
					$this->manage_user_plan_model->insert_plantype($plantitle,$planpriority);
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('message', $this->config->item("index")." Plan Type Added Successfully!!");
					
				}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('manage_user_plan/AddPlanType');
				}
			
		}else{
			
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
		
			redirect('manage_user_plan/AddPlanType');
	}
/*Add Plan Type Insert Into Db End.............................................................................................................*/

		
}
