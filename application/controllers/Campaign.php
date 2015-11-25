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
		$this->data['user_type']=$this->campaign_model->get_user_type();
		$this->data['company_name']=$this->campaign_model->get_company_name();
		$this->data['cities']=$this->campaign_model->get_city();
		$this->data['inventory']=$this->campaign_model->get_inventory();
		$this->data['plan']=$this->campaign_model->get_plan();
		
		$this->load->view('campaign',$this->data);
	}
/*Campaign view Load End.............................................................................................................*/
	
/*Campaign create insert and update start .........................................................................................*/
	function addcampaign()
	{	
		
		if(!empty($this->input->post('submit')))
		{
			
			$campaignstartdate=$this->input->post('campaignstartdate');
			$usertype=$this->input->post('usertype');
			$user_id=$this->input->post('user_id');
			
			$inventoryid=$this->input->post('inventoryid');
			$cityid=$this->input->post('cityid');
			$inventoryquantity=$this->input->post('inventoryquantity');
			$inventoryduration=$this->input->post('inventoryduration');
			$inventoryamount=$this->input->post('inventoryamount');
			
			$planid=$this->input->post('planid');
			$planquantity=$this->input->post('planquantity');
			$planduration=$this->input->post('planduration');
			$planamount=$this->input->post('planamount');
			$plancarryforwrd=$this->input->post('plancarryforwrd');
			
			if(!empty($campaignstartdate) && !empty($user_id) && !empty($inventoryid) && !empty($cityid) && !empty($inventoryquantity) && !empty($inventoryduration) && !empty($inventoryamount) && !empty($planid) && !empty($planquantity) && !empty($planduration) && !empty($planamount) && !empty($plancarryforwrd)){
			
			$filter=array('inventoryID'=>$inventoryid);
			$inventory_details=$this->campaign_model->check('dbho_inventorymaster',$filter);
			
			if(!empty($inventory_details)){
				
				if($inventoryquantity>$inventory_details[0]->MaximumQuantity){
					$quan=$inventory_details[0]->MaximumQuantity;
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." The Maximum Quantity Of This Inventory Is $quan, Please Insert Quantity Less Than Or Equal To $quan!!");
					redirect('Campaign');
				}
				if($inventoryduration>$inventory_details[0]->MaximumQuantity){
					$quan=$inventory_details[0]->MaximumQuantity;
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." The Maximum Quantity Of This Inventory Is $quan, Please Insert Duration Less Than Or Equal To $quan!!");
					redirect('Campaign');
				}
				$datess="";
				if($inventoryduration>1){
					
					for($k=0;$k<=$inventoryduration;$k++){
						if($k==0){
						$datess.="'$campaignstartdate'";	
						}else{
							
					$newdates=explode("/",$campaignstartdate);
					$add=$newdates[1]+$k;
					$datess.="'$newdates[0]/$add/$newdates[2]'";
						}
					if($inventoryduration>$k){
						$datess.=",";
					}
					}
				}else{
					$datess="'$campaignstartdate'";
				}
				
				$inventory_availablity=$this->campaign_model->inventory_availablity($inventoryid,$datess);
				
				if(!empty($inventory_availablity)){
					//print_r(count($inventory_availablity));die;
					if(count($inventory_availablity)==$inventoryduration){
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")."These Date Are Already Booked , Please Choose DIfferent Date Or Inventory!!");
					redirect('Campaign');
					}
					if(count($inventory_availablity)<$inventoryduration){
						$i=0;
						foreach($inventory_availablity as $inventory_availablity){
							$dates.=$inventory_availablity->date;
							if(count($inventory_availablity)-1>=$i){
								$dates.=",";
							}
							$i++;
						}
						$free=$inventoryduration-count($inventory_availablity);
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")."These Date Are Already Booked For $dates, Please Choose DIfferent Date. There Is Only $free Available Slotes!!");
					redirect('Campaign');
					}
				}
				
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found!!");
					redirect('Campaign');
			}
			
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
				
					if(!empty($this->input->post('campaignid'))){
						
							$filter=array('campaignID'=>$this->input->post('campaignid'));
							$this->campaign_model->insert_campaign($campaignstartdate,$user_id,$inventoryid,$cityid,$inventoryquantity,$inventoryduration,$inventoryamount,$planid,$planquantity,$planduration,$planamount,$plancarryforwrd,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Updated Successfully!!");
							
					}else{
							$this->campaign_model->insert_campaign($campaignstartdate,$user_id,$inventoryid,$cityid,$inventoryquantity,$inventoryduration,$inventoryamount,$planid,$planquantity,$planduration,$planamount,$plancarryforwrd,$date);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Added Successfully!!");
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('Campaign');
			}
		}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
					
		}
			redirect('Campaign/Campaign_listing');
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
