<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('campaign_model');
		$this->load->model('inventory_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}

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
		
		$this->parser->parse('header',$this->data);
		$this->load->view('campaign',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*Campaign view Load End.............................................................................................................*/
	
/*Campaign create insert and update start .........................................................................................*/
	function addcampaign()
	{	
		
		if(@($this->input->post('submit')))
		{
			$campaignid='';
			$campaignstartdate=$this->input->post('campaignstartdate');
			$usertype=$this->input->post('usertype');
			$user_id=$this->input->post('user_id');
			$currentexpiry=$this->input->post('currentexpiry');
			
			$data=$this->input->post();
			if(@($data['inventoryid'])){
			for($z=0;$z<=count($data['inventoryid'])-1; $z++)
			{
				
			$inventorytypeid=$data['inventoryid'][$z];
			$cityid=$data['cityid'][$z];
			
			$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$cityid);
			$inventory_id=$this->campaign_model->check('dbho_inventorymaster',$filter);
			
			if(@($inventory_id))
			{
						$inventoryid=$inventory_id[0]->inventoryID;
				
			}else{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found For Selected City!!");
						redirect('Inventory');
			}
			
			
			$inventoryquantity=$data['inventoryquantity'][$z];
			$inventoryduration=$data['inventoryduration'][$z];
			$inventoryamount=$data['inventoryamount'][$z];
			
			
			if(@($campaignstartdate) && @($user_id) && @($currentexpiry) && @($inventoryid) && @($cityid) && @($inventoryquantity) && @($inventoryduration) && @($inventoryamount) ){
			
			$filter=array('inventoryID'=>$inventoryid);
			$inventory_details=$this->campaign_model->check('dbho_inventorymaster',$filter);
			
			if(@($inventory_details)){
				
				if($inventoryquantity>$inventory_details[0]->MaximumQuantity){
					$quan=$inventory_details[0]->MaximumQuantity;
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." The Maximum Quantity Of This Inventory Is $quan, Please Insert Quantity Less Than Or Equal To $quan!!");
					redirect('Campaign');
				}
				
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found!!");
					redirect('Campaign');
			}
			
			if(@($campaignid)){
				$id=$this->campaign_model->insert_campaign_only($campaignstartdate,$user_id,$currentexpiry);
				$campaignid=$id;
			}
			
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
				
					if(@($campaignid)){
						
							$this->campaign_model->insert_campaign_inventory($campaignid,$inventoryid,$cityid,$inventoryquantity,$inventoryduration,$inventoryamount);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Added Successfully!!");
					}else{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('message', $this->config->item("index")." Some thing wrong while creating campaign Inventory. Try Again..!!");
						redirect('Campaign');
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('Campaign');
			}
		
		}
		}
		if(@($data['planid'])){
		for($z=0;$z<=count($data['planid'])-1; $z++)
			{
				
			$planid=$data['planid'][$z];
			$planquantity=$data['planquantity'][$z];
			$planduration=$data['planduration'][$z];
			$planamount=$data['planamount'][$z];
			$plancarryforwrd=$data['plancarryforwrd'][$z];
			$currentexpiryplan=$data['currentexpiryplan'][$z];
			$lastexpiryplan=$data['lastexpiryplan'][$z];
			
			if(@($campaignstartdate) && @($user_id) && @($currentexpiry) && @($planid) && @($planquantity) && @($planduration) && @($planamount) ){
			
			if(@($campaignid)){
				$id=$this->campaign_model->insert_campaign_only($campaignstartdate,$user_id,$currentexpiry);
				$campaignid=$id;
			}
			
			if(@($campaignid)){
						
							$this->campaign_model->insert_campaign_plan($campaignid,$planid,$planquantity,$planduration,$planamount,$plancarryforwrd,$currentexpiryplan,$lastexpiryplan);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Campaign Added Successfully!!");
					}else{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('message', $this->config->item("index")." Some thing wrong while creating campaign Plans. Try Again..!!");
						redirect('Campaign');
					}
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('Campaign');
			}
		
		}
		}
		}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
					
		}
			redirect('Campaign/Campaign_listing');
	}
	
/*Campaign create insert and update End .........................................................................................*/

/*Campaign Listing view Load Start.............................................................................................................*/
	function Campaign_listing($action=false)
	{	
	
		if($action=="search"){
			
			$mobileno=$this->input->post('mobileno');
			$campaignname=$this->input->post('campaignname');
			$companyname=$this->input->post('companyname');
			$emailid=$this->input->post('email');
			$usertype=$this->input->post('usertype');
			
			
			$query="";
			if(@($mobileno)){ $query.="and `userPhone` like TRIM('%$mobileno%')"; }
			if(@($campaignname)){ $query.="and `userCompanyName` like TRIM('%$campaignname%')"; }
			if(@($companyname)){ $query.="and `userCompanyName` like TRIM('%$companyname%')"; }
			if(@($emailid)){ $query.="and `userEmail` like TRIM('%$emailid%')"; }
			if(@($usertype)){ $query.="and userTypeID='$usertype'"; }
			
			
			
			$this->data['campaignlist']=$this->campaign_model->get_campaignlist($query);
			
		}else{
				$this->data['campaignlist']=$this->campaign_model->get_campaignlist();
		}
			$this->data['user_type']=$this->campaign_model->get_user_type();
			
			$this->parser->parse('header',$this->data);
			$this->load->view('campaign_listing',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
/*Campaign Listing view Load End.............................................................................................................*/
	
	/*Campaign Listing modal Load Start.............................................................................................................*/
	function campaign_modal($id=false)
	{
		$this->data['inventorylist']=$this->campaign_model->get_inventorylist($id);
		$this->data['planlist']=$this->campaign_model->get_planlist($id);
		$this->load->view('campaignmodal',$this->data);
	}
	/*Campaign Listing modal Load End.............................................................................................................*/
	
		
}
