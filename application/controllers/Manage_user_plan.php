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
		
		if (!$this->session->userdata('homeonline')){ 
			$this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); 
			redirect('Login');
		}
		
	//	print_r($this->session->userdata('homeonline'));die;
	}
	
// Manage_user_plan Started Here.................................................................................................................

/*Manage_user_plan view Load Start.............................................................................................................*/
	function index($action=false) {	
		if($action=="search") {
			$this->data['plantitle']=$plantitle=rtrim($this->input->post('plantitle'));
			$this->data['usertype']=$usertype=rtrim($this->input->post('username'));
			$this->data['listingType']=$listingType=rtrim($this->input->post('listingtype'));
			$this->data['plandetails']=$this->manage_user_plan_model->get_plandetails();
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type($plantitle,$usertype);
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans($plantitle,$usertype,$listingType);
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="UserPlans.csv"');
				print $this->manage_user_plan_model->get_userplans($plantitle,$usertype,$listingType);
				exit();
			}
			
		}else{
			$this->data['plandetails']=$this->manage_user_plan_model->get_plandetails();
			$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
			$this->data['userplans']=$this->manage_user_plan_model->get_userplans();
		}
		
		$this->parser->parse('header',$this->data);
		$this->load->view('manage_user_plan',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
	/*Manage_user_plan view Load End.............................................................................................................*/

	/*Manage_user_plan Modal view Load Start.............................................................................................................*/
	function loadmodal($planid=false)
	{	
		if(!empty($planid)){
		$this->data['planid']=$planid;
		$filter=$planid;
		$tittle=$this->data['updateplan']=$this->manage_user_plan_model->select_for_update($filter);
			$tittle=explode("For",$tittle[0]->planTitle);
			$plantypeid=$this->manage_user_plan_model->select_for_update_plantittle($tittle[0]);
			if(!empty($plantypeid)){
			$this->data['plantypeid']=$plantypeid[0]->planTypeID;
			}
		}
		$this->data['user_type']=$this->manage_user_plan_model->get_user_type();
		$this->data['plandetails']=$this->manage_user_plan_model->get_plandetails();
		$this->load->view('planmodal',$this->data);
	}
/*Manage_user_plan Modal view Load End.............................................................................................................*/


	
/*Manage_user_plan create insert and update start .........................................................................................*/
function adduserplan()
	{	
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
			redirect('Manage_user_plan');
	}
	
/*Manage_user_plan create insert and update End .........................................................................................*/

/*Add Plan Type view Load Start.............................................................................................................*/
	function AddPlanType()
	{	
		$this->data['plantypelist']=$this->manage_user_plan_model->get_plantypelist();
		
			$this->parser->parse('header',$this->data);
			$this->load->view('addplantype',$this->data);
			$this->parser->parse('footer',$this->data);
	}
/*Add Plan Type view Load End.............................................................................................................*/

/*Add Plan Type Modal view Load Start.............................................................................................................*/
	function Addplantypemodal($plantypeid=false)
	{	
		
		if(!empty($plantypeid))
		{
			$extraqry="where `planTypeID`=$plantypeid";
			$this->data['updateplantype']=$this->manage_user_plan_model->get_plantypelist($extraqry);
		}
		$this->load->view('addplantypemodal',$this->data);
	}
/*Add Plan Type Modal view Load End.............................................................................................................*/

/*Add Plan Type Insert Into Db Start.............................................................................................................*/
	function Insertplantype()
	{	
		$submit=$this->input->post('submit');
		if(!empty($submit)){
			
			$plantitle=$this->input->post('plantitle');
			$planpriority=$this->input->post('planpriority');
			$plantypeid=$this->input->post('plantypeid');
			
				if(!empty($plantitle) && !empty($planpriority)){
					
					if(!empty($plantypeid)){
						$filter=array('planTypeID'=>$plantypeid);
						$this->manage_user_plan_model->insert_plantype($plantitle,$planpriority,$filter);
						$this->session->set_flashdata('message_type', 'success');
						$this->session->set_flashdata('message', $this->config->item("index")." Plan Type Updated Successfully!!");
					}else{
					$this->manage_user_plan_model->insert_plantype($plantitle,$planpriority);
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('message', $this->config->item("index")." Plan Type Added Successfully!!");
					}
					
				}else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('manage_user_plan/AddPlanType');
				}
			
		}else{
			
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
		
			redirect('Manage_user_plan/AddPlanType');
	}
/*Add Plan Type Insert Into Db End.............................................................................................................*/


/*Plan Consumption Log view Load Start.............................................................................................................*/
	
	function PlanConsumptionLog($action=false,$campaignid=false) {
		$query = '';
		
		if(!empty($campaignid)) {
			$this->data['campaignid']=$campaignid;
			$query=" AND rp_dbho_campaignmaster.campaignID=$campaignid";
		}
		
		if($action=="search"){
			$this->data['campaignname']=$campaignname=$this->input->post('campaignname');
			$this->data['companyname']=$companyname=$this->input->post('companyname');
			$this->data['listingtype']=$listingtype=$this->input->post('listingtype');
			$this->data['planname']=$planname=$this->input->post('planname');
			
			if(!empty($campaignname)){ $query.=" and `userCompanyName` like TRIM('%$campaignname%')"; }
			if(!empty($companyname)){ $query.="  and `userCompanyName` like TRIM('%$companyname%')"; }
			if(!empty($listingtype)){ $query.=" and `objectType` like TRIM('%$listingtype%')"; }
			if(!empty($planname)){ $query.=" and `planTitle` like TRIM('%$planname%')"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				
				
				 header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="PlanConsumptionLog.csv"');
				 
					/* $planname='';
					$campaignname='';
					$campaignnamecreate='';
					$propertyproject='';
					$propertyproject='';
					$consumuedBy='';
					$consumuedon='';
					$consumuedtype='';
					$exportresultfinal='';
			$exportresultfinal.='"Plan Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Campaign Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Property/Project Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Object Type"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued BY"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued On"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued For" ';
										 
										 
				foreach($exportresults as $exportresult){
					
					if(!empty($exportresult->objectType) && !empty($exportresult->objectID)){ 
								if($exportresult->objectType=='project'){
									$filter=array('projectID'=>$exportresult->objectID,'languageID'=>'1');
									$objectname=$this->manage_user_plan_model->get_object_name('rp_project_details','projectName',$filter);
								}elseif($exportresult->objectType=='property'){
									$filter=array('propertyID'=>$exportresult->objectID,'languageID'=>'1');
									$objectname=$this->manage_user_plan_model->get_object_name('rp_property_details','propertyName',$filter);
								}
					  
					$planname=$exportresult->planTitle;
					$campaignname=$exportresult->userCompanyName;
					$campaignnamecreate=$exportresult->created;
					$propertyprojectname=isset($objectname[0]->name)?$objectname[0]->name:'';
					$propertyproject=$exportresult->objectType;
					$consumuedBy=$exportresult->createdBy;
					$consumuedon=$exportresult->createdon;
					$consumuedtype=$exportresult->UnitconsumuedType; 
					
			$exportresultfinal.='"Plan Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Campaign Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Property/Project Name"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Object Type"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued BY"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued On"';
			$exportresultfinal.=',';
			$exportresultfinal.='"Consumued For" '; 
						
				}
				}*/
				
				print $exportresults=$this->manage_user_plan_model->Planlog($query);
				exit(); 
				
			}
			
			$this->data['log_details']=$this->manage_user_plan_model->Planlog($query);
			
		}else{
			$this->data['log_details']=$this->manage_user_plan_model->Planlog($query);
		}
		$this->data['plandetails']=$this->manage_user_plan_model->get_plandetails();
		$this->parser->parse('header',$this->data);
		$this->load->view('planconsumptionlog',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
/*Plan Consumption Log view Load End.............................................................................................................*/


		
}
