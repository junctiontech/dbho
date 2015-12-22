<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProperty extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('AddProperty_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}

	}
	
// AddProperty Started Here.................................................................................................................

/*AddProperty view Load Start.............................................................................................................*/
	function index()
	{	
		$this->data['projects']=$this->AddProperty_model->get_project();
		$this->data['propertytype']=$this->AddProperty_model->getPropertyType();
		$this->data['user_type']=$this->AddProperty_model->get_user_type();
		$this->parser->parse('header',$this->data);
		$this->load->view('addproperty',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*AddProperty view Load End.............................................................................................................*/

/*AddProperty Get User Start.............................................................................................................*/
	function GetUser()
	{	
			if(!empty($this->input->post('usertypeID')))
			{
					$usertype=$this->AddProperty_model->getuser($this->input->post('usertypeID'));
					if(!empty($usertype)){
						echo"<option value=''>Select User</option>";
						foreach($usertype as $usertypes){
							echo"<option value=".$usertypes->userID.">$usertypes->userEmail</option>";
						}
						
					}else{
						echo"<option>No user Found!</option>";
					}
			}else{
				
			}
		
	}
/*AddProperty Get User End.............................................................................................................*/

/*AddProperty Get UserPlan Start.............................................................................................................*/
	function GetUserplan()
	{	
			if(!empty($this->input->post('userID')))
			{
					$userplan=$this->AddProperty_model->GetUserplan($this->input->post('userID'));
					
					if(!empty($userplan)){
						echo"<option value=''>Select User</option>";
						foreach($userplan as $userplans){
							echo"<option value=".$userplans->planID.">$userplans->planTitle</option>";
						}
						
					}else{
						echo"<option>No Plan Found!</option>";
					}
			}else{
				
			}
		
	}
/*AddProperty Get UserPlan End.............................................................................................................*/


/*AddProperty Get Attributes Start.............................................................................................................*/
	function Getattributes()
	{	
			if(!empty($this->input->post('propertytypeid')))
			{
					$AttributesGroup=$this->AddProperty_model->Getattributesgroups($this->input->post('propertytypeid'));
					
					if(!empty($AttributesGroup)){
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							
							echo"<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOneA$atti\" data-toggle=\"collapse\" data-parent=\"#accordionA$atti\" href=\"#collapseOneA$atti\" aria-expanded=\"false\" aria-controls=\"collapseOneA$atti\">";
                              echo"<h4 class=\"panel-title StepTitle\">$AttributesGroups->name</h4>";
								echo"</a>";
									echo"<div id=\"collapseOneA$atti\" class=\"panel-collapse collapse \" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
										echo"<div class=\"panel-body black-filed\">";
										
											$Attribute=$this->AddProperty_model->GetAttributes($AttributesGroups->attributeGroupID);
											if(!empty($Attribute))
											{
												foreach($Attribute as $Attributes)
												{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													if($Attributes->attrInputType=="select"){
													
													  echo"<div class=\"form-group col-xs-12 col-sm-4 martop20\">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														if($Attributes->attrName=="Bed Rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}
														echo"<select class=\"form-control\" $call $id>";
														  echo"<optgroup label=\"Select\">";
														  echo"<option value=\"\">select</option>";
														  foreach($Attributeoption as $Attributeoptions){
														  echo"<option value=\"$Attributeoptions->attrOptionID\">$Attributeoptions->attrOptName</option>";
														  }
														  echo"</optgroup>";
														echo"</select>";
													  echo"</div>";
													}
													 
													if($Attributes->attrInputType=="texbox"){
													  echo"<div class=\"form-group col-xs-12 col-sm-4 \">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														echo"<input id=\"middle-name\" class=\"form-control\" type=\"text\" name=\"middle-name\">";
													  echo"</div>";
													}
													  
													if($Attributes->attrInputType=="multiselect"){ 
													//echo"<br>";
													  echo"<div class=\"form-group col-xs-12 col-sm-4\">";
														echo"<label class=\"control-label\" for=\"last-name\" style=\"display:block;\">$Attributes->attrName</label>";
														foreach($Attributeoption as $Attributeoptions){
														  
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\"  value=\"$Attributeoptions->attrOptionID\" name=\"multiselect_Amenities_Security_6\">";
														echo"$Attributeoptions->attrOptName</span>";
														}
														echo"</div>";
														//echo"<br>";
													}
												}
											}
								
                              echo"</div>";
                            echo"</div>";
							 echo"</div>";
							$atti++;
						}
						
					}else{
						echo"List Is Empty!!";
					}
			}else{
				echo"Property Is Not Found!!";
			}
		
	}
/*AddProperty Get Attributes End.............................................................................................................*/
	
/*AddProperty Insert Data Start.............................................................................................................*/
	function InsertProperty()
	{	
		$data=$_POST;
		
		$date=date("Y-m-d");
		/*$formid=$this->input->post('formid');
		$formname="form-";
		$formname.=$formid;
		*/
		
		if(!empty($data))
			{
				
			/*if($formname="form-1")
				{*/	
					$data1=array();
					$data2=array();
					foreach($data as $key=> $datas)
					{
						if($key=="userID")
						{
						 $data1['userID']=$datas;
						}
						
						if($key=="propertyTypeID")
						{
						  $data1['propertyTypeID']= $datas;
						}
						
						if($key=="propertyPurpose")
						{
						  $data1['propertyPurpose']= $datas;
						}
						
						if($key=="lat")
						{
						  $data1['propertyLatitude']= $datas;
						}
						
						if($key=="lng")
						{
						  $data1['propertyLongitude']= $datas;
						}
						
						if($key=="countryID")
						{
						  $data1['countryID']= $datas;
						}
						
						if($key=="stateID")
						{
						  $data1['stateID']= $datas;
						}
						
						if($key=="cityID")
						{
						  $data1['cityID']= $datas;
						}
						
						if($key=="cityLocID")
						{
						  $data1['cityLocID']= $datas;
						}
						if($key=="postal_code")
						{
						  $data1['propertyZipCode']= $datas;
						}
						if($key=="propertyStatus")
						{
						  $data1['propertyStatus']= $datas;
						}
						if($key=="projectID")
						{
						  $data1['projectID']= $datas;
						}
						if($key=="type")
						{
						  $data1['type']= $datas;
						}
						if($key=="isNegotiable")
						{
						  $data1['isNegotiable']= $datas;
						}
						//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
						if($key=="propertyName")
						{
						  $data2['propertyName']= $datas;
						}
						
						if($key=="propertyAddress1")
						{
						  $data2['propertyAddress1']= $datas;
						}
						
						if($key=="sublocality")
						{
						  $data2['propertyAddress2']= $datas;
						}
						
						if($key=="propertyDescription")
						{
						  $data2['propertyDescription']= $datas;
						}
						
						if($key=="sublocality")
						{
						  $data2['propertyLocality']= $datas;
						}
						
						if($key=="propertyCurrentStatus")
						{
						  $data2['propertyCurrentStatus']= $datas;
						}
						
						
						
						
					}
					$propertykey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
					$data1['propertyKey']= $propertykey;
					$data1['propertyAddedDate']= $date;
					//print_r($data1);die;
					$propertyid=$this->AddProperty_model->InsertProperty('rp_properties',$data1);
					$data2['propertyID']= $propertyid;
					$data2['languageID']= 1;
					//print_r($data2);die;
					$this->AddProperty_model->InsertProperty('rp_property_details',$data2);
				//}
						
					
			}else{
				echo"Add Property Fail!!";
			}
		
	}
/*AddProperty Insert Data End.............................................................................................................*/

	
	
		
}
