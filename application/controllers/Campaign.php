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
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
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
	{	//print_r($_POST);
		$submit=$this->input->post('submit');
		if(!empty($submit))
		{
			$campaignid='';
			$campaignstartdate=$this->input->post('campaignstartdate');
			$usertype=$this->input->post('usertype');
			$user_id=$this->input->post('user_id');
			$currentexpiry=$this->input->post('currentexpiry');
			$campaignexpiry=$this->input->post('campaignexpiry');
			$soldby=$this->input->post('soldby');
			
			$data=$this->input->post();
			if(!empty($data['inventoryid'])){
			for($z=0;$z<=count($data['inventoryid'])-1; $z++)
			{
				
			$inventorytypeid=$data['inventoryid'][$z];
			$cityid=$data['cityid'][$z];
			
			$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$cityid);
			$inventory_id=$this->campaign_model->check('dbho_inventorymaster',$filter);
			
			if(!empty($inventory_id))
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
			
			
			if(!empty($campaignstartdate) && !empty($user_id) &&  !empty($inventoryid) && !empty($cityid) && !empty($inventoryquantity) && !empty($inventoryduration) && !empty($inventoryamount) ){
			
			$filter=array('inventoryID'=>$inventoryid);
			$inventory_details=$this->campaign_model->check('dbho_inventorymaster',$filter);
			
			if(!empty($inventory_details)){
				
				/*if($inventoryquantity>$inventory_details[0]->MaximumQuantity){
					$quan=$inventory_details[0]->MaximumQuantity;
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." The Maximum Quantity Of This Inventory Is $quan, Please Insert Quantity Less Than Or Equal To $quan!!");
					redirect('Campaign');
				}*/
				
			}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found!!");
					redirect('Campaign');
			}
			
			if(empty($campaignid)){
				$id=$this->campaign_model->insert_campaign_only($campaignstartdate,$user_id,$campaignexpiry,$soldby);
				$campaignid=$id;
				
			}
			
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
				
					if(!empty($campaignid)){
						
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
		if(!empty($data['planid'])){
			
		for($z=0;$z<=count($data['planid'])-1; $z++)
			{
				
			$planid=$data['planid'][$z];
			$planquantity=$data['planquantity'][$z];
			$planduration=$data['planduration'][$z];
			$planamount=$data['planamount'][$z];
			$plancarryforwrd=$data['plancarryforwrd'][$z];
			$currentexpiryplan=$data['currentexpiryplan'][$z];
			$lastexpiryplan=$data['lastexpiryplan'][$z];
			
			
			if(!empty($campaignstartdate) && !empty($user_id) && !empty($currentexpiry) && !empty($planid) && !empty($planquantity) && !empty($planduration) && !empty($planamount) ){
			
			if(empty($campaignid)){
				$id=$this->campaign_model->insert_campaign_only($campaignstartdate,$user_id,$campaignexpiry,$soldby);
				$campaignid=$id;
			}
			
			if(!empty($plancarryforwrd)){
				
				$oldplandetails=$this->campaign_model->get_campaignplanold($planid,$user_id);
				
				if(!empty($oldplandetails)){
					
					$status='Inactive';
					$unitconsumptionoldplan=$oldplandetails[0]->Quantity;
					$filter=array('planID'=>$planid,'userID'=>$user_id);
					$data1=array('status'=>$status,'plan_unitconsumed'=>$unitconsumptionoldplan);
					$this->campaign_model->update_campaignplanold('rp_dbho_campaignplan',$data1,$filter);
					
					/////////////////////rp_user_to_plan table modify start.........................................
					$filter1=array('planID'=>$planid,'userID'=>$user_id);
					
					$data2=array('planStatus'=>'Inactive');
					
					$this->campaign_model->Update_rp_user_to_plan('rp_user_to_plan',$data2,$filter1);
					/////////////////////rp_user_to_plan table modify End.........................................
					
				}
				$planquantity=$planquantity+$plancarryforwrd;
			}
			
			if(!empty($campaignid)){
						
							$this->campaign_model->insert_campaign_plan($campaignid,$planid,$planquantity,$planduration,$planamount,$plancarryforwrd,$currentexpiryplan,$lastexpiryplan);
							
							/////////////////////rp_user_to_plan table modify start.........................................
					
					date_default_timezone_set("Asia/Kolkata");
					$date=date("Y-m-d h:i:s");
					
					$filter1=array('planID'=>$planid,'planStatus'=>'Active');
					$plantemplatedetails=$this->campaign_model->check('rp_user_plans',$filter1);
					$currentexpiryplan1=strtotime($currentexpiryplan);
					if(!empty($plantemplatedetails)){
						
					$data2=array('userID'=>$user_id,
								 'planID'=>$planid,
								 'currencyID'=>3,
								 'planPrice'=>$plantemplatedetails[0]->planPrice,
								 'planPurchaseDate'=>$date,
								 'planExpiryDate'=>date("Y-m-d h:i:s",$currentexpiryplan1),
								 'planUpdateDate'=>$date,
								 'planPropertyCount'=>$plantemplatedetails[0]->planPropertyCount,
								 'planProjectCount'=>$plantemplatedetails[0]->planProjectCount,
								 'planAgentCount'=>$plantemplatedetails[0]->planAgentCount,
								 'planEmployeeCount'=>$plantemplatedetails[0]->planEmployeeCount,
								 'planEnquiry'=>$plantemplatedetails[0]->planEnquiry,
								 'planEnquiryCount'=>$plantemplatedetails[0]->planEnquiryCount,
								 'planFeatured'=>$plantemplatedetails[0]->planFeatured,
								 'planFeaturedCount'=>$plantemplatedetails[0]->planFeaturedCount,
								 'planProjectFeatured'=>$plantemplatedetails[0]->planProjectFeatured,
								 'planProjectFeaturedCount'=>$plantemplatedetails[0]->planProjectFeaturedCount,
								 'planPropertyDetails'=>'Yes',
								 'planBusinessLogo'=>'Yes',
								 'planPropertyPerformance'=>'Yes',
								 'planAgentCountBalance'=>0,
								 'planEmployeeCountBalance'=>0,
								 'planPropertyCountBalance'=>$planquantity,
								 'planProjectCountBalance'=>$planquantity,
								 'planFeaturedCountBalance'=>$planquantity,
								 'planProjectFeaturedCountBalance'=>$planquantity,
								 'totalPropSellCount'=>$planquantity,
								 'totalPropRentCount'=>$planquantity,
								 'totalPropLeaseCount'=>$planquantity,
								 'planStatus'=>'Active',
								 'planEnquiryCountBalance'=>10000
								 );
					
					$this->campaign_model->Insert_rp_user_to_plan('rp_user_to_plan',$data2);
			}
					/////////////////////rp_user_to_plan table modify End.........................................
							
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
			
			$this->data['mobileno']=$mobileno=$this->input->post('mobileno');
			$this->data['campaignname']=$campaignname=$this->input->post('campaignname');
			$this->data['companyname']=$companyname=$this->input->post('companyname');
			$this->data['emailid']=$emailid=$this->input->post('email');
			$this->data['usertype']=$usertype=$this->input->post('usertype');
			
			
			$query="";
			if(!empty($mobileno)){ $query.="and `userPhone` like TRIM('%$mobileno%')"; }
			if(!empty($campaignname)){ $query.="and `userCompanyName` like TRIM('%$campaignname%')"; }
			if(!empty($companyname)){ $query.="and `userCompanyName` like TRIM('%$companyname%')"; }
			if(!empty($emailid)){ $query.="and `userEmail` like TRIM('%$emailid%')"; }
			if(!empty($usertype)){ $query.="and userTypeID='$usertype'"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="CampaignList.csv"');
				print $this->campaign_model->get_campaignlist($query);
				exit();
			}
			
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
		$this->data['campaignname']=$this->campaign_model->get_campaignname($id);
		$this->data['inventorylist']=$this->campaign_model->get_inventorylist($id);
		$this->data['planlist']=$this->campaign_model->get_planlist($id);
		$this->load->view('campaignmodal',$this->data);
	}
	/*Campaign Listing modal Load End.............................................................................................................*/
	
	/*Campaign Expirty date extend modal Load Start.............................................................................................................*/
	function Extendcampaignexpirydate($campaignID=false)
	{
		$this->data['campaignID']=$campaignID;
		$this->load->view('extendcampaingexpirydatemodal',$this->data);
	}
	/*Campaign Expirty date extend modal Load End.............................................................................................................*/
	
	/*Insert New Expirty date Start.............................................................................................................*/
	function Insertnewexpirydate()
	{
		$campaignID=$this->input->post('campaignID');
		$newexpirydate=$this->input->post('newexpirydate');
		
		if(!empty($campaignID) && !empty($newexpirydate)){
			
			$filter=array('campaignID'=>$campaignID);
			$data=array('expiry_date_campaign'=>$newexpirydate);
			if($this->campaign_model->Update_rp_user_to_plan('rp_dbho_campaignmaster',$data,$filter)){
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message', $this->config->item("index")."Your Campaign Expiry Date Extend To $newexpirydate Successfully!!");
			
			}else{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('message', $this->config->item("index")."Date Extend Is Fail. Please Try Again!!");
			}
			}else{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message', $this->config->item("index")."All Fields Are Mendatory!!");
		}
		redirect('Campaign/Campaign_listing');
	}
	/*Insert New Expirty date End.............................................................................................................*/
	
	
	/*Empty Tables Start.............................................................................................................*/
	function Emptytables()
	{
		echo"Run";echo"<br>";
		$this->campaign_model->Emptyalltables();
		echo"All Table Empty successfully";
	}
	/*Empty Tables End.............................................................................................................*/
	
		
}
