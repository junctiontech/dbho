<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lead extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('Lead_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}
	}
	
// Lead Management Started Here.................................................................................................................

/*Calling Lead Creation view Load Start.............................................................................................................*/
	function Callingleadcreate($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('callinglead',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Calling Lead Creation view Load End.............................................................................................................*/


	
/*Calling Lead create insert and update start .........................................................................................*/
function Createcallinglead()
	{	/* //print_r($_POST);die;
		$submit=$this->input->post('submit');
		if(!empty($submit))
		{
			
			$plantitle=explode("-",$this->input->post('plantitle'));
			$planusertype=$this->input->post('planusertype');
			$planorder=$this->input->post('planorder');
			$listingtype=$this->input->post('listingtype');
			$planstatus=$this->input->post('planstatus');
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
			if(!empty($plantitle[1]) && !empty($planusertype) && !empty($planorder) && !empty($listingtype) && !empty($planstatus)){
				
				$planid=$this->input->post('planid');
					if(!empty($planid)){
						
							$filter=array('planID'=>$this->input->post('planid'));
							$this->manage_user_plan_model->insert_userplan($plantitle[1],$planusertype,$planorder,'',$planstatus,$date,$listingtype,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." User Plan Updated Successfully!!");
							
					}else{
							$this->manage_user_plan_model->insert_userplan($plantitle[1],$planusertype,$planorder,'',$planstatus,$date,$listingtype);
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
			redirect('Lead/Callingleadlisting'); */
	}
	
/*Calling Lead create insert and update End .........................................................................................*/

/*Calling Lead Listing view Load Start.............................................................................................................*/
	function Callingleadlisting($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('callingleadlisting',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Calling Lead Listing view Load End.............................................................................................................*/


/*Admin Locality view Load Start.............................................................................................................*/
	function Adminlocality($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('admin_locality',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Admin Locality view Load End.............................................................................................................*/

/*Lead Logs view Load Start.............................................................................................................*/
	function LeadLogs($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('builder_agent_log',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Lead Logs view Load End.............................................................................................................*/

/*Lead Management List view Load Start.............................................................................................................*/
	function Leadmanagementlist($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('lead_management_list',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Lead Management List view Load End.............................................................................................................*/

/*Builder Agent Enquiry List view Load Start.............................................................................................................*/
	function Enquirylist($action=false)
	{	/* if($action=="search"){
		
			$this->data['plantitle']=$plantitle=$this->input->post('plantitle');
			$this->data['usertype']=$usertype=$this->input->post('username');
			$this->data['listingtype']=$usertype=$this->input->post('listingtype');
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype);
			
		}else{
			
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
			
		} */
		
			$this->parser->parse('header',$this->data);
			$this->load->view('builder_agent_enquiry',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Builder Agent Enquiry List view Load End.............................................................................................................*/



/*Lead Management End Here..........................................................................................................*/
		
}
