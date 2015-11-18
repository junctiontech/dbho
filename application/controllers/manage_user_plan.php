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
	function index($class=false,$section=false,$subject=false,$date=false)
	{	
		$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
		$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
		
		$this->load->view('manage_user_plan',$this->data);
	}
/*Manage_user_plan view Load End.............................................................................................................*/
	
/*Manage_user_plan create insert and update start .........................................................................................*/
	function adduserplan()
	{	
	
		if(!empty($this->input->post('submit')))
		{
			
			$plantitle=$this->input->post('plantitle');
			$planusertype=$this->input->post('planusertype');
			$planorder=$this->input->post('planorder');
			$plantype=$this->input->post('plantype');
			$planstatus=$this->input->post('planstatus');
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			if(!empty($plantitle) && !empty($planusertype) && !empty($planorder) && !empty($plantype) && !empty($planstatus)){
				
					if(!empty($this->input->post('planid'))){
						
							$filter=array('planID'=>$this->input->post('planid'));
							$this->manage_user_plan_model->insert_userplan($plantitle,$planusertype,$planorder,$plantype,$planstatus,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." User Plan Updated Successfully!!");
							
					}else{
							$this->manage_user_plan_model->insert_userplan($plantitle,$planusertype,$planorder,$plantype,$planstatus,$date);
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

		
}
