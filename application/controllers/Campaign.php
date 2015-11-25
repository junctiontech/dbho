<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('campaign_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
// Campaign Started Here.................................................................................................................

/*Campaign view Load Start.............................................................................................................*/
	function index()
	{	
		
		//$this->data['user_type']=$this->campaign_model->get_user_type();
		//$this->data['userplans']=$this->campaign_model->get_userplans();
		
		$this->load->view('campaign',$this->data);
	}
/*Campaign view Load End.............................................................................................................*/
	
/*Campaign create insert and update start .........................................................................................*/
	function adduserplan()
	{	
	
		if(!empty($this->input->post('submit')))
		{
			
			$compaigndate=$this->input->post('compaigndate');
			$userid=$this->input->post('userid');
			$companyname=$this->input->post('companyname');
			$inventoryid=$this->input->post('inventoryid');
			$inventoryquan=$this->input->post('inventoryquan');
			
			$inventoryamoun=$this->input->post('inventoryamoun');
			$planid=$this->input->post('planid');
			$planquan=$this->input->post('planquan');
			$planduration=$this->input->post('planduration');
			$planamoun=$this->input->post('planamoun');
			$plancarry=$this->input->post('plancarry');
			$lastexpiry=$this->input->post('lastexpiry');
			$currentexpiry=$this->input->post('currentexpiry');
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			if(!empty($plantitle) && !empty($planusertype) && !empty($planorder) && !empty($plantype) && !empty($planstatus)){
				
					if(!empty($this->input->post('planid'))){
						
							$filter=array('planID'=>$this->input->post('planid'));
							$this->campaign_model->insert_userplan($plantitle,$planusertype,$planorder,$plantype,$planstatus,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Updated Successfully!!");
							
					}else{
							$this->campaign_model->insert_userplan($plantitle,$planusertype,$planorder,$plantype,$planstatus,$date);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Added Successfully!!");
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
			}
		}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
			redirect('Campaign_listing');
	}
	
/*Campaign create insert and update End .........................................................................................*/

/*Campaign Listing view Load Start.............................................................................................................*/
	function Campaign_listing()
	{	
		//$this->data['user_type']=$this->campaign_model->get_user_type();
		//$this->data['userplans']=$this->campaign_model->get_userplans();
		
		$this->load->view('campaign_listing',$this->data);
	}
/*Campaign Listing view Load End.............................................................................................................*/
	
		
}
