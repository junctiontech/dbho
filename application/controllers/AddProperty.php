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
							if($AttributesGroups->name !="Flooring" && $AttributesGroups->name !="Fittings" && $AttributesGroups->name !="Walls")
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
													if($Attributes->attrName !="Amenities" )
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
											}
								
                              echo"</div>";
                            echo"</div>";
							 echo"</div>";
							$atti++;
						}
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
	function InsertProperty($formid=false)
	{	
		$data=$_POST;
		//print_r();die;
		$date=date("Y-m-d");
		
		if(!empty($formid))
		{
			$formname="form-";
			$formname.=$formid;
		}
		if(!empty($data))
			{
				$data1=array();
				$data2=array();
				
				if($formname=="form-1")
				{
					$propertyprice=array();
				
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
						
						
						if($key=="propertyPrice")
						{
						  $propertyprice['propertyPrice']= $datas;
						}
						
					}
					
					if(!empty($data['propertyID'])){
						
						$data1['propertyUpdateDate']= $date;
						$filter=array('propertyID'=>$data['propertyID']);
						$this->AddProperty_model->InsertProperty('rp_properties',$data1,$filter);
						
						$filter1=array('propertyID'=>$data['propertyID']);
						$data2['languageID']= 1;
						$this->AddProperty_model->InsertProperty('rp_property_details',$data2,$filter1);
						
						if(!empty($propertyprice))
						{
							$propertyprice['currencyID']=3;
							$this->AddProperty_model->InsertProperty('rp_property_price',$propertyprice,$filter1);
						}
						
					}else
					{
						$propertykey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
					
						$data1['propertyKey']= $propertykey;
						$data1['propertyAddedDate']= $date;
						
						$propertyid=$this->AddProperty_model->InsertProperty('rp_properties',$data1);
						
						$data2['propertyID']= $propertyid;
						$data2['languageID']= 1;
						
						$this->AddProperty_model->InsertProperty('rp_property_details',$data2);
						
						if(!empty($propertyprice))
						{
							$propertyprice['currencyID']=3;
							$propertyprice['propertyID']= $propertyid;
							$this->AddProperty_model->InsertProperty('rp_property_price',$propertyprice);
						}
					}
					
				}
				elseif($formname=="form-2")
				{
					if(!empty($data['propertyID']))
					{
						foreach($data as $key=> $datas)
					{
						if($key=="propertyMetaTitle")
						{
						 $data1['propertyMetaTitle']=$datas;
						}
						
						if($key=="propertyMetaKeyword")
						{
						  $data1['propertyMetaKeyword']= $datas;
						}
						
						if($key=="propertyMetaDescription")
						{
						  $data1['propertyMetaDescription']= $datas;
						}
					}
						$filter1=array('propertyID'=>$data['propertyID']);
						$this->AddProperty_model->InsertProperty('rp_property_details',$data1,$filter1);
					}
					
				}
				elseif($formname=="form-3")
				{
					
					if(!empty($data['propertyID']))
					{
						$bedroom=array();
						$livingroom=array();$bathroom=array();$kitchen=array();
							//..................................................................Bed Room
							if(!empty($data['flooringTypebedroom']))
							{
								$bedroom['flooringType']=$data['flooringTypebedroom'];
							}
							if(!empty($data['othersbedroom']))
							{
									$otherscomaseparated=implode(",",$data['othersbedroom']);
									$bedroom['others']=$otherscomaseparated;
							}
							
							if(!empty($bedroom))
							{
								$bedroom['propertyID']=$data['propertyID'];
								$this->AddProperty_model->Insertotherinfo('dbho_bed_room',$bedroom);
							}
							//.......................................................................Living Room
							if(!empty($data['flooringTypelivingroom']))
							{
								$livingroom['flooringType']=$data['flooringTypelivingroom'];
							}
							if(!empty($data['otherslivingroom']))
							{
									$otherscomaseparated=implode(",",$data['otherslivingroom']);
									$livingroom['others']=$otherscomaseparated;
							}
							
							if(!empty($livingroom))
							{
								$livingroom['propertyID']=$data['propertyID'];
								$this->AddProperty_model->Insertotherinfo('dbho_living_room',$livingroom);
							}
							//.......................................................................................Bath  Room
							if(!empty($data['flooringTypebathroom']))
							{
								$bathroom['flooringType']=$data['flooringTypebathroom'];
							}
							if(!empty($data['hotwatersupply']))
							{
								$bathroom['hotwatersupply']=$data['hotwatersupply'];
							}
							if(!empty($data['toilet']))
							{
								$bathroom['toilet']=$data['toilet'];
							}
							if(!empty($data['othersbathroom']))
							{
									$otherscomaseparated=implode(",",$data['othersbathroom']);
									$bathroom['others']=$otherscomaseparated;
							}
							
							if(!empty($bathroom))
							{
								$bathroom['propertyID']=$data['propertyID'];
								$this->AddProperty_model->Insertotherinfo('dbho_bath_room',$bathroom);
							}
							//.......................................................................................................
							if(!empty($data['platform']))
							{
								$kitchen['platformType']=$data['platform'];
							}
							if(!empty($data['Cabinet']))
							{
								$kitchen['cabinet']=$data['Cabinet'];
							}
							
							if(!empty($data['otherskitchen']))
							{
									$otherscomaseparated=implode(",",$data['otherskitchen']);
									$kitchen['others']=$otherscomaseparated;
							}
							
							if(!empty($kitchen))
							{
								$kitchen['propertyID']=$data['propertyID'];
								$this->AddProperty_model->Insertotherinfo('dbho_kitchen',$kitchen);
							}
							//.....................................................................................................
							
							
					}
					
					
				}
				elseif($formname=="form-4")
				{
					
					
				}
				
					if(!empty($propertyid)){ echo $propertyid;	}else{ if(!empty($data['propertyID'])){ echo $data['propertyID']; }}
					
			}else{
				echo"Add Property Fail!!";
			}
		
	}
/*AddProperty Insert Data End.............................................................................................................*/

	public function uploadimage()
	{
		
		$propertyID=$this->input->post('propertyID');
		$imagecategory=$this->input->post('imagecategory');
		
		if(!empty($propertyID) && !empty($imagecategory))
		{
			
			if($_FILES['file']['name']!='')
			{
				$data['image_z1']= $_FILES['file']['name'];
				$image=sha1($_FILES['file']['name']).time().rand(0, 9);
				
					if(!empty($_FILES['file']['name']))
					{
				
						$config =  array(
						'upload_path'	  => './propertyImages/',
						'file_name'       => $image,
						'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
						'overwrite'       => true);
						
							$this->upload->initialize($config);
							$this->load->library('upload');
				 
								if($this->upload->do_upload("file"))
								{
									$upload_data = $this->upload->data();
									$image=$upload_data['file_name'];
									$data=array('propertyID'=>$propertyID,'imageCatID'=>$imagecategory,'propertyImageName'=>$image,'isCoverImage'=>'No','propertyImagePriority'=>'1','propertyImageStatus'=>'Active');
									$propertyImageID=$this->AddProperty_model->InsertProperty('rp_property_images',$data);
									$data1=array('propertyImageID'=>$propertyImageID,'languageID'=>'1','propertyImageTitle'=>'','propertyImageAltTag'=>'');
									$this->AddProperty_model->InsertProperty('rp_property_image_details',$data1);
								}else
								{
										echo $this->upload->display_errors()."file upload failed";
								}
					}
			}
		
		}
		
		
		
		
		
	}
	
		


/*Preview Of Added Property...................................................................................................................................................*/
public function propertyPreview(){
			$data = array();
			
			$propertyID = $this->uri->segment(3);
			$this->load->model('Properties_model');
			
			$data['individualUserList'] = $this->Properties_model->IndividualUserList();
			
			$data['property'] = $this->Properties_model->getPropertyName($propertyID);
			
			$data['propertyImage'] = $this->Properties_model->getPropertyImage($propertyID);
			//echo "<pre>====";print_r($data['propertyImage']);
			
			$data['usertype'] = $this->Properties_model->getUserType($data['property'][0]->userID);

			$data['userTypeDropdown'] = $this->Properties_model->getUser($data['property'][0]->userID,$data['usertype'][0]->userTypeID);

			$data['propertyPrice'] = $this->Properties_model->getPropertyPrice($data['property'][0]->propertyID);
			//echo "<pre>1====";print_r($data['propertyPrice']);			
		
			$data['userAddress'] = $this->Properties_model->getUserAddress($data['property'][0]->userID);
	
			$data['propertyLoc'] = $this->Properties_model->getPropertyLoc($data['property'][0]->propertyID);
			//echo "<li>======> ".$data['propertyLoc'][0]->cityLocID;
			if(!empty($data['propertyLoc'][0]->cityLocID)){
			$data['cityname'] = $this->Properties_model->getPropertyCityName($data['propertyLoc'][0]->cityLocID);
			}
			$data['type'] = $this->Properties_model->getPropertyPreviewType($propertyID);
			
			/************************** get all attributes ************************************************/
			$data['PropertySpecInfo'] = $this->Properties_model->getPropertySpecInfo($data['property'][0]->propertyID);
			//echo "<pre>1====";print_r($data['PropertySpecInfo']);
			$data['PropertyAttributes'] = $this->Properties_model->getPropertyAttributes($data['property'][0]->propertyTypeID,$data['property'][0]->propertyID);
			$data['PropertyAmenitiesInfo'] = $this->Properties_model->getPropertyAmenitiesInfo($data['property'][0]->propertyID);
			//echo "<pre>AM====";print_r($data['PropertyAmenitiesInfo']);
			$this->load->view('PropertyPreview',$data);

	}


}
?>