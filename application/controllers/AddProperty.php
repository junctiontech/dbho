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
	function index($propertyid=false)
	{
		
		if(!empty($propertyid))
			{
				$this->data['propertyid']=$propertyid;
				$filter=array('propertyID'=>$propertyid);
				$propertytabledetails=$this->AddProperty_model->Shownpreview($propertyid);
				
				if(!empty($propertytabledetails))
				{
					if(!empty($propertytabledetails[0]->propertyPurpose))
					{
						$this->data['purpose']=$propertytabledetails[0]->propertyPurpose;
					}
					
					
					if(!empty($propertytabledetails[0]->projectID))
					{
								$this->data['under']="1";
								$this->data['projectid']=$propertytabledetails[0]->projectID;
					}else
					{ 
								$this->data['under']="2"; 
					}
					
					if(!empty($propertytabledetails[0]->propertyTypeID))
					{
						$this->data['propertytypeid']=$propertytabledetails[0]->propertyTypeID;
					}
					
					if(!empty($propertytabledetails[0]->propertyName))
					{
						$this->data['propertyname']=$propertytabledetails[0]->propertyName;
					}
					
					if(!empty($propertytabledetails[0]->propertyStatus))
					{
						$this->data['propertystatus']=$propertytabledetails[0]->propertyStatus;
					}
					
					if(!empty($propertytabledetails[0]->propertyAddedDate))
					{
						$this->data['propertydate']=$propertytabledetails[0]->propertyAddedDate;
					}
					
					if(!empty($propertytabledetails[0]->userID))
					{
								$this->data['userID']=$userID=$propertytabledetails[0]->userID;
								$userdetails=$this->AddProperty_model->getuserforpreview($userID);
								$this->data['usertypeid']=$usertypeid=$userdetails[0]->userTypeID;
								$usertypedetails=$this->AddProperty_model->get_user_type(" and rp_user_types.userTypeID=$usertypeid");
								$this->data['useremail']=$userdetails[0]->userEmail;$this->data['usertype']=$usertypedetails[0]->userTypeName;;
					}
					
					$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter);
					if(!empty($getpropertyprice[0]->propertyPrice))
					{
						$this->data['propertyprice']=$getpropertyprice[0]->propertyPrice;}else{$propertyprice="Not Mentioned";
					}
					
					if(!empty($propertytabledetails[0]->isNegotiable))
					{
						$isNegotiable=$propertytabledetails[0]->isNegotiable;}else{$isNegotiable="Not Mentioned";
					}
					
					if(!empty($propertytabledetails[0]->propertyDescription))
					{
						$this->data['propertyDescription']=$propertytabledetails[0]->propertyDescription;
					}
					
					if(!empty($propertytabledetails[0]->propertyLatitude))
					{
						$this->data['propertyLatitude']=$propertytabledetails[0]->propertyLatitude;
					}
					
					if(!empty($propertytabledetails[0]->propertyLongitude))
					{
						$this->data['propertyLongitude']=$propertytabledetails[0]->propertyLongitude;
					}
					
					if(!empty($propertytabledetails[0]->propertyZipCode))
					{
						$this->data['propertyZipCode']=$propertytabledetails[0]->propertyZipCode;
					}
					
					if(!empty($propertytabledetails[0]->propertyLocality))
					{
						$this->data['propertyLocality']=$propertytabledetails[0]->propertyLocality;
					}
					
					if(!empty($propertytabledetails[0]->propertyAddress1))
					{
						$this->data['propertyAddress1']=$propertytabledetails[0]->propertyAddress1;
					}
					
					if(!empty($propertytabledetails[0]->propertyMetaTitle))
					{
						$this->data['propertyMetaTitle']=$propertytabledetails[0]->propertyMetaTitle;
					}
					
					if(!empty($propertytabledetails[0]->propertyMetaKeyword))
					{
						$this->data['propertyMetaKeyword']=$propertytabledetails[0]->propertyMetaKeyword;
					}
					
					if(!empty($propertytabledetails[0]->propertyMetaDescription))
					{
						$this->data['propertyMetaDescription']=$propertytabledetails[0]->propertyMetaDescription;
					}
					
					$this->data['propertyimages']=$this->AddProperty_model->Getotherdata('rp_property_images',array('propertyID'=>$propertyid));
					
					$this->data['coveredarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>94));
					$this->data['plotarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>2));
					$this->data['carpetarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>67));
                     
                   // print_r($this->data['propertyimages']);die;
					
					/*$getamenities=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>6,'attrOptionID'=>$Attributeoptions->attrOptionID));
                     
					if(!empty($getamenities)){echo"<p>YES </p>";}else{echo"<p>NO</p>";}
                          
                    /* $getroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')));
                     
						 if(in_array("AC", $bedothers)){ $ac="YES";}else{$ac="NO";}*/
                       
				}	
				
			}

	
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
	function Getattributes($propertyid=false)
	{	
			if(!empty($this->input->post('propertytypeid')))
			{
					$AttributesGroup=$this->AddProperty_model->Getattributesgroups($this->input->post('propertytypeid'));
					
					if(!empty($AttributesGroup)){
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							if($AttributesGroups->name !="Flooring" && $AttributesGroups->name !="Fittings" && $AttributesGroups->name !="Walls" && $AttributesGroups->name !="Rent")
							{
												
							echo"<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOneA$atti\" data-toggle=\"collapse\" data-parent=\"#accordion1\" href=\"#collapseOneA$atti\" aria-expanded=\"false\" aria-controls=\"collapseOneA$atti\">";
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
													
													if(!empty($propertyid))
													{
													$checkattri=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attributes->attributeID));
													}
													if($Attributes->attrInputType=="select"){
													
													  echo"<div class=\"form-group col-xs-12 col-sm-4 martop20\">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														if($Attributes->attrName=="Bed Rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}
														echo"<select name=\"select-$Attributes->attributeID\" class=\"form-control\" $call $id>";
														  echo"<optgroup label=\"Select\">";
														  echo"<option value=\"\">select</option>";
														  foreach($Attributeoption as $Attributeoptions){
														  echo"<option value=\"$Attributeoptions->attrOptionID-$Attributeoptions->attrOptName\"";
														  if(!empty($checkattri[0]->attrOptionID)){ if($checkattri[0]->attrOptionID==$Attributeoptions->attrOptionID){ echo"selected";}}
														 echo" >$Attributeoptions->attrOptName</option>";
														  }
														  echo"</optgroup>";
														echo"</select>";
													  echo"</div>";
													}
													 
													if($Attributes->attrInputType=="texbox"){
													  echo"<div class=\"form-group col-xs-12 col-sm-4 \">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														echo"<input id=\"middle-name\" class=\"form-control\" type=\"text\" name=\"text-$Attributes->attributeID\" value=\"isset($checkattri[0]->attrDetValue)?$checkattri[0]->attrDetValue:''\">";
													  echo"</div>";
													}
													  
													if($Attributes->attrInputType=="multiselect"){ 
													//echo"<br>";
													  echo"<div class=\"form-group col-xs-12 col-sm-4\">";
														echo"<label class=\"control-label\" for=\"last-name\" style=\"display:block;\">$Attributes->attrName</label>";
														foreach($Attributeoption as $Attributeoptions){
														  if(!empty($propertyid)){
														$attmulti=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attributes->attributeID,'attrOptionID'=>$Attributeoptions->attrOptionID));
														}
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\"  value=\"$Attributeoptions->attrOptionID-$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\"";
														if(!empty($attmulti)){echo"checked";}
														echo">";
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
		//print_r($data);
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
					$selectattribute=array();
					$selectattributeval=array();
					$textattribute=array();
					$multiattribute=array();
					$amenitiesdata=array();
					$amenitiesvalue=array();
					
					foreach($data as $key=> $datas)
					{
						if($key=="userID")
						{
						 $data1['userID']=$datas;
						 
						}elseif($key=="propertyTypeID")
						{
						  $data1['propertyTypeID']= $datas;
						}elseif($key=="propertyPurpose")
						{
						  $data1['propertyPurpose']= $datas;
						}elseif($key=="lat")
						{
						  $data1['propertyLatitude']= $datas;
						}elseif($key=="lng")
						{
						  $data1['propertyLongitude']= $datas;
						}elseif($key=="countryID")
						{
						  $data1['countryID']= $datas;
						}elseif($key=="stateID")
						{
						  $data1['stateID']= $datas;
						}elseif($key=="cityID")
						{
						  $data1['cityID']= $datas;
						}elseif($key=="cityLocID")
						{
						  $data1['cityLocID']= $datas;
						}elseif($key=="postal_code")
						{
						  $data1['propertyZipCode']= $datas;
						}elseif($key=="propertyStatus")
						{
						  $data1['propertyStatus']= $datas;
						}elseif($key=="projectID")
						{
						  $data1['projectID']= $datas;
						}elseif($key=="type")
						{
						  $data1['type']= $datas;
						}elseif($key=="isNegotiable")
						{
						  $data1['isNegotiable']= $datas;
						}elseif($key=="propertyName")           //Data 2 start..................................................
						{
						  $data2['propertyName']= $datas;
						}elseif($key=="propertyAddress1")
						{
						  $data2['propertyAddress1']= $datas;
						}elseif($key=="sublocality")
						{
						  $data2['propertyAddress2']= $datas;
						}elseif($key=="propertyDescription")
						{
						  $data2['propertyDescription']= $datas;
						}elseif($key=="sublocality")
						{
						  $data2['propertyLocality']= $datas;
						}elseif($key=="propertyCurrentStatus")
						{
						  $data2['propertyCurrentStatus']= $datas;
						}elseif($key=="propertyPrice")
						{
						  $propertyprice['propertyPrice']= $datas;
						}elseif($key=="Amenities"){					//Amenities Start.........................................
							
							if(!empty($datas))
							{
								foreach($datas as $amenities){
									
									$amenitiesarr=explode("-",$amenities);
									$amenitiesdata[]=array('attributeID'=>$amenitiesarr[0],'attrOptionID'=>$amenitiesarr[1]);
									$amenitiesvalue[]=array('attrDetValue'=>$amenitiesarr[2]);
									
								}
							}
							
						}else{											//Attributes strat............................................
							
							
							if(!empty($key))
							{
									
									$typeofattribute=explode("-",$key);
									
									if(count($typeofattribute)>1)
									{
										
										if($typeofattribute[0]=="select")
										{
											if(!empty($datas))
												{
													$optionidselect=explode("-",$datas);
													
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>$optionidselect[0]);
													$selectattributeval[]=array('attrDetValue'=>$optionidselect[1]);
													
												}
											
											
										}elseif($typeofattribute[0]=="text")
										{
											if(!empty($datas))
												{	$size='';
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>0);
													if($typeofattribute[1]==94){
														$size=$data['coveredarea'];
													}elseif($typeofattribute[1]==2){
														$size=$data['plotarea'];
													}elseif($typeofattribute[1]==67){
														$size=$data['carpetarea'];
													}
													$selectattributeval[]=array('attrDetValue'=>"$datas $size");
													
												}
											
										}elseif($typeofattribute[0]=="multi")
										{
											if(!empty($datas))
												{
													foreach($datas as $attributemulti)
													{
									
													$optionidmulti=explode("-",$attributemulti);
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>$optionidmulti[0]);
													$selectattributeval[]=array('attrDetValue'=>$optionidmulti[1]);
														
													}
												}
											
											
										}
									}
							
									
							
							}
							
							
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
						$this->AddProperty_model->deleteattributesandvalues($data['propertyID']);
						if(!empty($amenitiesdata) && !empty($amenitiesvalue))
						{	$i=0;
							
							
							foreach($amenitiesdata as $amenitiesdatainsert)
							{	
								$amenitiesdatainsert['propertyID']=$data['propertyID'];
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$amenitiesdatainsert);
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								$amenitiesvalue[$i]['languageID']=1;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$amenitiesvalue[$i]);
								$i++;
							}
						}
						
						if(!empty($selectattribute) && !empty($selectattributeval))
						{	$j=0;
							
							
							foreach($selectattribute as $selectattributeinsert)
							{	
								$selectattributeinsert['propertyID']=$data['propertyID'];
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$selectattributeinsert);
								$selectattributeval[$j]['attrValueID']=$attributevalueId;
								$selectattributeval[$j]['languageID']=1;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval[$j]);
								$j++;
							}
						}
						
						
					}else
					{
						$propertykey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
					
						$data1['propertyKey']= $propertykey;
						$data1['propertyAddedDate']= $date;
						$data1['propertyAddedDate']= $date;
						$data1['propertyStatus']= 'Draft';
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
						
						if(!empty($amenitiesdata) && !empty($amenitiesvalue))
						{	$i=0;
							
							foreach($amenitiesdata as $amenitiesdatainsert)
							{	
								$amenitiesdatainsert['propertyID']=$propertyid;
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$amenitiesdatainsert);
								
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								$amenitiesvalue[$i]['languageID']=1;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$amenitiesvalue[$i]);
								$i++;
							}
						}
						
						if(!empty($selectattribute) && !empty($selectattributeval))
						{	$j=0;
							
							foreach($selectattribute as $selectattributeinsert)
							{	
								$selectattributeinsert['propertyID']=$propertyid;
								
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$selectattributeinsert);
								$selectattributeval[$j]['attrValueID']=$attributevalueId;
								$selectattributeval[$j]['languageID']=1;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval[$j]);
								$j++;
							}
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
						
						
							//..................................................................Bed Room
							if(!empty($data['flooringTypebedroom'])){
							$bedi=1;
							$this->AddProperty_model->deletestep3data('dbho_bed_room',array('propertyID'=>$data['propertyID']));
							foreach($data['flooringTypebedroom'] as $flooringTypebedroom)
							{	$bedroom=array();
								if(!empty($flooringTypebedroom))
								{
									$bedroom['flooringType']=$flooringTypebedroom;
								}
								if(!empty($data["$bedi-othersbedroom"]))
								{
										$otherscomaseparated=implode(",",$data["$bedi-othersbedroom"]);
										$bedroom['others']=$otherscomaseparated;
								}
								
								if(!empty($bedroom))
								{
									$bedroom['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('dbho_bed_room',$bedroom);
								}
								$bedi++;
							}
							}
							//.......................................................................Living Room
							if(!empty($data['flooringTypelivingroom'])){
							$livingi=1;
							$this->AddProperty_model->deletestep3data('dbho_living_room',array('propertyID'=>$data['propertyID']));
							foreach($data['flooringTypelivingroom'] as $flooringTypelivingroom)
							{
								$livingroom=array();
								if(!empty($flooringTypelivingroom))
								{
									$livingroom['flooringType']=$flooringTypelivingroom;
								}
								if(!empty($data["$livingi-otherslivingroom"]))
								{
										$otherscomaseparated=implode(",",$data["$livingi-otherslivingroom"]);
										$livingroom['others']=$otherscomaseparated;
								}
								
								if(!empty($livingroom))
								{
									$livingroom['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('dbho_living_room',$livingroom);
								}
								$livingi++;
							}
							}
							//.......................................................................................Bath  Room
							if(!empty($data['flooringTypebathroom'])){
							$bathi=1;
							$this->AddProperty_model->deletestep3data('dbho_bath_room',array('propertyID'=>$data['propertyID']));
							foreach($data['flooringTypebathroom'] as $flooringTypebathroom)
							{	
								$bathroom=array();$kitchen=array();
								
								if(!empty($flooringTypebathroom))
								{
									$bathroom['flooringType']=$flooringTypebathroom;
								}
								if(!empty($data['hotwatersupply'][$bathi-1]))
								{
									$bathroom['hotwatersupply']=$data['hotwatersupply'][$bathi-1];
								}
								if(!empty($data['toilet'][$bathi-1]))
								{
									$bathroom['toilet']=$data['toilet'][$bathi-1];
								}
								if(!empty($data["$bathi-othersbathroom"]))
								{
										$otherscomaseparated=implode(",",$data["$bathi-othersbathroom"]);
										$bathroom['others']=$otherscomaseparated;
								}
								
								if(!empty($bathroom))
								{
									$bathroom['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('dbho_bath_room',$bathroom);
								}
								$bathi++;
							}
							}							
							//.......................................................................................................Kitchen
							if(!empty($data['platform'])){
							$kitcheni=1;
							$this->AddProperty_model->deletestep3data('dbho_kitchen',array('propertyID'=>$data['propertyID']));
							foreach($data['platform'] as $platform)
							{	
								$kitchen=array();
								
								if(!empty($data['platform']))
								{
									$kitchen['platformType']=$platform;
								}
								if(!empty($data['Cabinet'][$kitcheni]))
								{
									$kitchen['cabinet']=$data['Cabinet'][$kitcheni];
								}
								
								if(!empty($data["$kitcheni-otherskitchen"]))
								{
										$otherscomaseparated=implode(",",$data["$kitcheni-otherskitchen"]);
										$kitchen['others']=$otherscomaseparated;
								}
								
								if(!empty($kitchen))
								{
									$kitchen['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('dbho_kitchen',$kitchen);
								}
								$kitcheni++;
							}
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
	
		
/*Property List view Load Start.............................................................................................................*/
	function PropertyListing()
	{	
		$this->data['propertylisting']=$this->AddProperty_model->get_propertylisting();
		$this->parser->parse('header',$this->data);
		$this->load->view('propertylist',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*Property List view Load Start.............................................................................................................*/

/*Property Log view Load Start.............................................................................................................*/
	function PropertyLog()
	{	
		//$this->data['projects']=$this->AddProperty_model->get_project();
		//$this->data['propertytype']=$this->AddProperty_model->getPropertyType();
		//$this->data['user_type']=$this->AddProperty_model->get_user_type();
		$this->parser->parse('header',$this->data);
		$this->load->view('propertylog',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*Property Log view Load Start.............................................................................................................*/

/*Get No Of Bed Rooms Kitchens etc from db for insert Start.............................................................................................................*/
	function Shownoofbedrooms()
	{	
		if(!empty($this->input->post('propertyid')))
			{
				$NoOfBedRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>1));
				
				if(!empty($NoOfBedRooms))
				{	
					if(!empty($NoOfBedRooms[0]->attrDetValue))
					{	$bedroomdata=$this->AddProperty_model->Getotherdatafromnewdb('dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')));
						
						for($i=1;$i<=$NoOfBedRooms[0]->attrDetValue;$i++)
						{	
							$bedothers=array();
							if(!empty($bedroomdata[$i-1]->others)){
							$bedothers=explode(",",$bedroomdata[$i-1]->others);
							}
							
							if(in_array("AC", $bedothers)){ $AC="checked";}else{$AC="";}
							if(in_array("Bed", $bedothers)){ $Bed="checked";}else{$Bed="";}
							if(in_array("TV", $bedothers)){ $TV="checked";}else{$TV="";}
							if(in_array("DressingTable", $bedothers)){ $DressingTable="checked";}else{$DressingTable="";}
							if(in_array("Wardrobe", $bedothers)){ $Wardrobe="checked";}else{$Wardrobe="";}
							if(in_array("FalseSeiling", $bedothers)){ $FalseSeiling="checked";}else{$FalseSeiling="";}
							if(in_array("AttachedBalcony", $bedothers)){ $AttachedBalcony="checked";}else{$AttachedBalcony="";}
							if(in_array("AttachedBathroom", $bedothers)){ $AttachedBathroom="checked";}else{$AttachedBathroom="";}
							if(in_array("Ventilation", $bedothers)){ $Ventilation="checked";}else{$Ventilation="";}
						
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneR$i\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Bed Room $i</h4>
								</a>";
							echo"	<div id=\"collapseOneR$i\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
								echo'  <div class="panel-body">
									<div class="row">
									  <div class="form-group col-sm-2">
										<label>Flooring Type</label>
										<select name="flooringTypebedroom[]" class="form-control">
										 <option value="">select</option>
										  <option value="Marble"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Marble'){echo"selected";}}
										  echo'>Marble</option>
										  <option value="Wood"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Wood'){echo"selected";}}
										 echo' >Wood</option>
										  <option value="Ceramic"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Ceramic'){echo"selected";}}
										  echo'>Ceramic</option>
										  <option value="Stone"';
										 if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Stone'){echo"selected";}}
										  echo'>Stone</option>
										  <option value="Laminate"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Laminate'){echo"selected";}}
										  echo'>Laminate</option>
										  <option value="AntiSkidTiles"';
										    if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='AntiSkidTiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
										</select>
									  </div>
									</div>';
								echo"	<div class=\" clearfix\"> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"TV\" $TV name=\"$i-othersbedroom[]\">
									  TV</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AC\" $AC name=\"$i-othersbedroom[]\">
									  AC</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Bed\" $Bed name=\"$i-othersbedroom[]\">
									  Bed</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" value=\"DressingTable\" $DressingTable name=\"$i-othersbedroom[]\">
									  Dressing Table</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Wardrobe\" $Wardrobe name=\"$i-othersbedroom[]\">
									  Wardrobe</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"FalseSeiling\" $FalseSeiling name=\"$i-othersbedroom[]\">
									  False Seiling</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AttachedBalcony\" $AttachedBalcony name=\"$i-othersbedroom[]\">
									  Attached Balcony</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AttachedBathroom\" $AttachedBathroom name=\"$i-othersbedroom[]\">
									  Attached Bathroom</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Ventilation\" $Ventilation name=\"$i-othersbedroom[]\">
									  Ventilation</span> </div>
								  </div>
								</div>
							</div>";
						}
					}
					
				}
				
				$NoOfLivingRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>28));
				
				if(!empty($NoOfLivingRooms))
				{	
					if(!empty($NoOfLivingRooms[0]->attrDetValue))
					{	$livingroomdata=$this->AddProperty_model->Getotherdatafromnewdb('dbho_living_room',array('propertyID'=>$this->input->post('propertyid')));
						
						for($i=1;$i<=$NoOfLivingRooms[0]->attrDetValue;$i++)
						{
							$livingothers=array();
							if(!empty($livingroomdata[$i-1]->others)){
							$livingothers=explode(",",$livingroomdata[$i-1]->others);
							}
							
							if(in_array("Sofa", $livingothers)){ $Sofa="checked";}else{$Sofa="";}
							if(in_array("DiningTable", $livingothers)){ $DiningTable="checked";}else{$DiningTable="";}
							if(in_array("AC", $livingothers)){ $AC="checked";}else{$AC="";}
							if(in_array("ShoeRack", $livingothers)){ $ShoeRack="checked";}else{$ShoeRack="";}
							if(in_array("TV", $livingothers)){ $TV="checked";}else{$TV="";}
							if(in_array("FalseSeiling", $livingothers)){ $FalseSeiling="checked";}else{$FalseSeiling="";}
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneL$i\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"<h4 class=\"panel-title StepTitle\">Living Room $i</h4>
								</a>";
							echo"	<div id=\"collapseOneL$i\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="form-group col-sm-2">
                                <label>Flooring Type</label>
                                <select name="flooringTypelivingroom[]" class="form-control">
                                  <option value="">select</option>
								   <option value="Marble"';
										  if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='Marble'){echo"selected";}}
										  echo'>Marble</option>
										  <option value="Wood"';
										  if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='Wood'){echo"selected";}}
										 echo' >Wood</option>
										  <option value="Ceramic"';
										  if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='Ceramic'){echo"selected";}}
										  echo'>Ceramic</option>
										  <option value="Stone"';
										 if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='Stone'){echo"selected";}}
										  echo'>Stone</option>
										  <option value="Laminate"';
										  if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='Laminate'){echo"selected";}}
										  echo'>Laminate</option>
										  <option value="AntiSkidTiles"';
										    if(!empty($livingroomdata[$i-1]->flooringType)){ if($livingroomdata[$i-1]->flooringType=='AntiSkidTiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
                                  
                                </select>
                              </div>
                            </div>
                            <div class=" clearfix"> <span class="checkbozsty-1">';
                           echo"   <input type=\"checkbox\"  value=\"Sofa\" $Sofa name=\"$i-otherslivingroom[]\">
                              Sofa</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"DiningTable\" $DiningTable name=\"$i-otherslivingroom[]\">
                              Dining Table</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"AC\" $AC name=\"$i-otherslivingroom[]\">
                              AC</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" value=\"ShoeRack\" $ShoeRack name=\"$i-otherslivingroom[]\">
                              Shoe Rack</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"TV\" $TV name=\"$i-otherslivingroom[]\">
                              TV</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"FalseSeiling\" $FalseSeiling name=\"$i-otherslivingroom[]\">
                              False Seiling</span> </div>
                          </div>
                        </div>
                      </div>";
						}
					}
					
				}
				
				$NoOfBathRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>3));
				
				if(!empty($NoOfBathRooms))
				{	
					if(!empty($NoOfBathRooms[0]->attrDetValue))
					{	$bathroomdata=$this->AddProperty_model->Getotherdatafromnewdb('dbho_bath_room',array('propertyID'=>$this->input->post('propertyid')));
						
						for($i=1;$i<=$NoOfBathRooms[0]->attrDetValue;$i++)
						{
							$bathothers=array();
							if(!empty($bathroomdata[$i-1]->others)){
							$bathothers=explode(",",$bathroomdata[$i-1]->others);
							}
							
							if(in_array("GlassPartition", $bathothers)){ $GlassPartition="checked";}else{$GlassPartition="";}
							if(in_array("BathTub", $bathothers)){ $BathTub="checked";}else{$BathTub="";}
							if(in_array("Axhaustfan", $bathothers)){ $Axhaustfan="checked";}else{$Axhaustfan="";}
							if(in_array("Windows", $bathothers)){ $Windows="checked";}else{$Windows="";}
							if(in_array("ShowerCurtain", $bathothers)){ $ShowerCurtain="checked";}else{$ShowerCurtain="";}
							if(in_array("Cabinet", $bathothers)){ $Cabinet="checked";}else{$Cabinet="";}
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneB$i\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Bath Room $i</h4>
								</a>";
							echo"	<div id=\"collapseOneB$i\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select name="flooringTypebathroom[]" class="form-control">
                                  <option value="">select</option>
                                  <option value="Marble"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Marble'){echo"selected";}}
										  echo'>Marble</option>
										  <option value="Wood"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Wood'){echo"selected";}}
										 echo' >Wood</option>
										  <option value="Ceramic"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Ceramic'){echo"selected";}}
										  echo'>Ceramic</option>
										  <option value="Stone"';
										 if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Stone'){echo"selected";}}
										  echo'>Stone</option>
										  <option value="Laminate"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Laminate'){echo"selected";}}
										  echo'>Laminate</option>
										  <option value="AntiSkidTiles"';
										    if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='AntiSkidTiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Hot Water Supply</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat"  value="Geyser" name="hotwatersupply[]"';
										if(!empty($bathroomdata[$i-1]->hotwatersupply)){ if($bathroomdata[$i-1]->hotwatersupply=='Geyser'){echo"checked";}}
										echo'>
                                        Geyser </label>
                                      <label>
                                        <input type="radio" class="flat" value="Gas"  name="hotwatersupply[]"';
										if(!empty($bathroomdata[$i-1]->hotwatersupply)){ if($bathroomdata[$i-1]->hotwatersupply=='Gas'){echo"checked";}}
										echo'>
                                        Gas </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Toilet</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat" value="Indian" name="toilet[]"';
										if(!empty($bathroomdata[$i-1]->toilet)){ if($bathroomdata[$i-1]->toilet=='Indian'){echo"checked";}}
										echo'>
                                        Indian </label>
                                      <label>
                                        <input type="radio" class="flat" value="Western" name="toilet[]"';
										if(!empty($bathroomdata[$i-1]->toilet)){ if($bathroomdata[$i-1]->toilet=='Western'){echo"checked";}}
										echo'>
                                        Western </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">';
                           echo"     <input type=\"checkbox\"  value=\"GlassPartition\" $GlassPartition name=\"$i-othersbathroom[]\">
                                Glass Partition</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"BathTub\" $BathTub name=\"$i-othersbathroom[]\">
                                Bath Tub</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Axhaustfan\" $Axhaustfan name=\"$i-othersbathroom[]\">
                                Axhaust fan</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" value=\"Windows\" $Windows name=\"$i-othersbathroom[]\">
                                Windows</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"ShowerCurtain\" $ShowerCurtain name=\"$i-othersbathroom[]\">
                                Shower Curtain</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Cabinet\" $Cabinet name=\"$i-othersbathroom[]\">
                                Cabinet</span> </div>
                            </div>
                          </div>
                        </div>
                      </div>";
						}
					}
					
				}
				
				$NoOfKitchenRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>27));
				
				if(!empty($NoOfKitchenRooms))
				{	
					if(!empty($NoOfKitchenRooms[0]->attrDetValue))
					{	
						for($i=1;$i<=$NoOfKitchenRooms[0]->attrDetValue;$i++)
						{
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneK$i\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Kitchen $i</h4>
								</a>";
							echo"	<div id=\"collapseOneK$i\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Platform</label>
                                  <select name="platform[]" class="form-control">
									<option value="">Select</option>
                                    <option value="Simple">Simple</option>
                                    <option value="Granite">Granite</option>
                                    <option value="Marble">Marble</option>
                                    <option value="Wooden">Wooden</option>
                                    <option value="Ceramic">Ceramic</option>
                                    <option value="Kotasin">Kota Sin</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Cabinet</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat" value="Modular" name="Cabinet[]">
                                        Modular </label>
                                      <label>
                                        <input type="radio" class="flat" value="NA" name="Cabinet[]">
                                        NA </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">';
                            echo"    <input type=\"checkbox\"  value=\"Refrigerator\" name=\"$i-otherskitchen[]\">
                                Refrigerator</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Waterpurifier\" name=\"$i-otherskitchen[]\">
                                Water purifier</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Loft\" name=\"$i-otherskitchen[]\">
                                Loft</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" value=\"GasPipline\" name=\"$i-otherskitchen[]\">
                                Gas Pipline</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Microwave\" name=\"$i-otherskitchen[]\">
                                Microwave</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Chimaey\" name=\"$i-otherskitchen[]\">
                                Chimaey</span> </div>
                            </div>
                          </div>
                        </div>
                      </div>";
						}
					}
					
				}
				
			}
		
	}
/*Get No Of Bed Rooms Kitchens etc from db for insert End.............................................................................................................*/

/*Show preview on 4th Step from db inserted Data Start.............................................................................................................*/
	function Showpreview()
	{	
		if(!empty($this->input->post('propertyid')))
			{
				$filter=array('propertyID'=>$this->input->post('propertyid'));
				$propertytabledetails=$this->AddProperty_model->Shownpreview($this->input->post('propertyid'));
				
				if(!empty($propertytabledetails))
				{
					if(!empty($propertytabledetails[0]->propertyPurpose)){$purpose=$propertytabledetails[0]->propertyPurpose;}else{$purpose="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->projectID))
					{
								$under="Property Under Project";
								$projectid=$propertytabledetails[0]->projectID;
								$projectnames=$this->AddProperty_model->get_project(" and rp_projects.projectID=$projectid");
								$projectname=$projectnames[0]->projectName;
					}else{ $under="Individual Property";$projectname="No"; }
					
					if(!empty($propertytabledetails[0]->propertyTypeID)){$propertytypeid=$propertytabledetails[0]->propertyTypeID;
						$propertytypenames=$this->AddProperty_model->getPropertyType(" AND t2.propertyTypeID=$propertytypeid");
						$propertytypename=$propertytypenames[0]->propertyTypeName;
					}else{$propertytypename="NO";}
					
					if(!empty($propertytabledetails[0]->propertyName)){$propertyname=$propertytabledetails[0]->propertyName;}else{$propertyname="NO";}
					
					if(!empty($propertytabledetails[0]->propertyStatus)){$propertystatus=$propertytabledetails[0]->propertyStatus;}else{$propertystatus="NO";}
					
					if(!empty($propertytabledetails[0]->propertyAddedDate)){$propertydate=$propertytabledetails[0]->propertyAddedDate;}else{$propertydate="NO";}
					
					if(!empty($propertytabledetails[0]->userID)){$userID=$propertytabledetails[0]->userID;
								$userdetails=$this->AddProperty_model->getuserforpreview($userID);
								$usertypeid=$userdetails[0]->userTypeID;
								$usertypedetails=$this->AddProperty_model->get_user_type(" and rp_user_types.userTypeID=$usertypeid");
								$useremail=$userdetails[0]->userEmail;$usertype=$usertypedetails[0]->userTypeName;$userplan="Not Mentioned";
					}else{$useremail="Not Mentioned";$usertype="Not Mentioned";$userplan="Not Mentioned";}
					
					$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter);
					if(!empty($getpropertyprice[0]->propertyPrice)){$propertyprice=$getpropertyprice[0]->propertyPrice;}else{$propertyprice="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->isNegotiable)){$isNegotiable=$propertytabledetails[0]->isNegotiable;}else{$isNegotiable="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyDescription)){$propertyDescription=$propertytabledetails[0]->propertyDescription;}else{$propertyDescription="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLatitude)){$propertyLatitude=$propertytabledetails[0]->propertyLatitude;}else{$propertyLatitude="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLongitude)){$propertyLongitude=$propertytabledetails[0]->propertyLongitude;}else{$propertyLongitude="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyZipCode)){$propertyZipCode=$propertytabledetails[0]->propertyZipCode;}else{$propertyZipCode="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLocality)){$propertyLocality=$propertytabledetails[0]->propertyLocality;}else{$propertyLocality="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyAddress1)){$propertyAddress1=$propertytabledetails[0]->propertyAddress1;}else{$propertyAddress1="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaTitle)){$propertyMetaTitle=$propertytabledetails[0]->propertyMetaTitle;}else{$propertyMetaTitle="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaKeyword)){$propertyMetaKeyword=$propertytabledetails[0]->propertyMetaKeyword;}else{$propertyMetaKeyword="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaDescription)){$propertyMetaDescription=$propertytabledetails[0]->propertyMetaDescription;}else{$propertyMetaDescription="Not Mentioned";}
					
					echo"<div style=\"margin-top:20px;\" class=\"row labcol\">
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label>$purpose</label>
                          <p>$purpose</p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> $under</label>
                          <p>$under </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label>Select Project</label>
                          <p>$projectname</p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label>Property Type</label>
                          <p>$propertytypename </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> Property Name</label>
                          <p>$propertyname </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> Current Status</label>
                          <p>$propertystatus </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> Date</label>
                          <p>$propertydate </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> User Type</label>
                          <p>$usertype </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> $usertype</label>
                          <p>$useremail </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> User Plan</label>
                          <p>$userplan </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> Price</label>
                          <p>$propertyprice </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3\">
                        <div class=\"form-group botbott\">
                          <label> Negotiable </label>
                          <p>$isNegotiable </p>
                        </div>
                      </div>
                    </div>
                    <div style=\"margin-top:20px;\" class=\"row labcol\">
                      <div class=\"col-md-12 col-sm-12 col-xs-12\">
                        <div class=\"form-group botbott\">
                          <label>Description</label>
                          <p>$propertyDescription.</p>
                        </div>
                      </div>
                    </div>
                    <div style=\"margin-top:20px;\" class=\"row labcol\">
                      <h2 class=\"StepTitle\">Property Specification</h2>
                      <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label>Bed Rooms </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label>Bath Rooms </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label>Balcony </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label>Wash Dry Area </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label>Parking </label>
                          <p>2 </p>
                        </div>";
                   echo'   </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Structure </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Solar Water Heater </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Built Up Area </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Society Name </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Ownership Type </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Main Entrance Facing </label>
                          <p>North </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Servant Room </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Gated Community </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Plot Area </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Registered Society </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Sale Status </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Furnishing Status </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Carpet Area </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Age of Building </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Water Supply </label>
                          <p>Muncipal Corp </p>
                        </div>
                      </div>
                    </div>';
					
                  echo"  <div style=\"margin-top:20px;\" class=\"row labcol\">
                      <h2 class=\"StepTitle\">Amenities</h2>";
					  $Attributeoption=$this->AddProperty_model->GetAttributesoption(6);
									foreach($Attributeoption as $Attributeoptions){
										$getamenities=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>6,'attrOptionID'=>$Attributeoptions->attrOptionID));
                     
					 echo" <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label> $Attributeoptions->attrOptName </label>";
						  
						  if(!empty($getamenities)){echo"<p>YES </p>";}else{echo"<p>NO</p>";}
                          
                       echo" </div>
                      </div>";
									}
                  echo"</div>";
				  
                   echo' <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Property Location </h2>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Location Info </label>';
                       echo"   <p>$propertyAddress1 </p>";
                      echo'  </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Locality </label>';
                        echo"  <p>$propertyLocality </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Country </label>';
                       echo"   <p>India </p>";
                     echo'   </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>State </label>';
                        echo"  <p>MP </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> City / Area </label>';
                          echo"<p>Bhopal </p>";
                        echo'</div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Zip / Postal Code </label>';
                         echo" <p>$propertyZipCode </p>";
                     echo'   </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Latitude </label>';
                         echo" <p>$propertyLongitude </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Longitude </label>';
                         echo" <p>$propertyLatitude </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Status </label>
                          <p>Active </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Meta Details </h2>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Title </label>';
                         echo" <p>$propertyMetaTitle</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Meta Keywords </label>';
                         echo" <p>$propertyMetaKeyword </p>";
                        echo'</div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Meta Description </label>';
                          echo"<p>$propertyMetaDescription </p>";
						  
				
							 
							 echo'  </div>
                      </div>
                    </div>';
					
					$getroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')));
                     if(!empty($getroomdetails)){
						  $count=1;
						 foreach($getroomdetails as $getroomdetailss){
							$bedothers=explode(",",$getroomdetailss->others);
                    echo'<div style="margin-top:20px;" class="row labcol">';
                   echo"   <h2 class=\"StepTitle\">Bed Room $count</h2>";
                    echo'  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Flooring Type </label>';
                         echo" <p>$getroomdetailss->flooringType </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>AC </label>';
						  if(in_array("AC", $bedothers)){ $ac="YES";}else{$ac="NO";}
                         echo" <p>$ac </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Bed </label>';
						   if(in_array("Bed", $bedothers)){ $Bed="YES";}else{$Bed="NO";}
                          echo"<p>$Bed</p>";
                      echo'  </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Dressing Table </label>';
						  if(in_array("DressingTable", $bedothers)){ $DressingTable="YES";}else{$DressingTable="NO";}
                          echo"<p>$DressingTable</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Wardrobe </label>';
						   if(in_array("Wardrobe", $bedothers)){ $Wardrobe="YES";}else{$Wardrobe="NO";}
                         echo" <p>$Wardrobe</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>False Seiling </label>';
						   if(in_array("FalseSeiling", $bedothers)){ $FalseSeiling="YES";}else{$FalseSeiling="NO";}
                          echo"<p>$FalseSeiling</p>";
                       echo' </div>
                      </div>
                    </div>';
							 
						$count++; }
					 }
					 
					 $getlivingroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('dbho_living_room',array('propertyID'=>$this->input->post('propertyid')));
                     if(!empty($getlivingroomdetails)){
						  $count=1;
						 foreach($getlivingroomdetails as $getlivingroomdetailss){
							$livingothers=explode(",",$getlivingroomdetailss->others);
                    echo'<div style="margin-top:20px;" class="row labcol">';
                   echo"   <h2 class=\"StepTitle\">Living Room $count</h2>";
                    echo'  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Flooring Type </label>';
                         echo" <p>$getlivingroomdetailss->flooringType </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Sofa </label>';
						  if(in_array("Sofa", $livingothers)){ $Sofa="YES";}else{$Sofa="NO";}
                         echo" <p>$Sofa </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Dining Table </label>';
						   if(in_array("DiningTable", $livingothers)){ $DiningTable="YES";}else{$DiningTable="NO";}
                          echo"<p>$DiningTable</p>";
                      echo'  </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>AC </label>';
						  if(in_array("AC", $livingothers)){ $AC="YES";}else{$AC="NO";}
                          echo"<p>$AC</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Shoe Rack </label>';
						   if(in_array("ShoeRack", $livingothers)){ $ShoeRack="YES";}else{$ShoeRack="NO";}
                         echo" <p>$ShoeRack</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>TV </label>';
						   if(in_array("TV", $livingothers)){ $TV="YES";}else{$TV="NO";}
                          echo"<p>$TV</p>";
                       echo' </div>
                      </div>
                    </div>';
							 
						$count++; }
					 }
                      
					
					$getbathroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('dbho_bath_room',array('propertyID'=>$this->input->post('propertyid')));
                     if(!empty($getbathroomdetails)){
						  $count=1;
						 foreach($getbathroomdetails as $getbathroomdetailss){
							$bathothers=explode(",",$getbathroomdetailss->others);
                    echo'<div style="margin-top:20px;" class="row labcol">';
                   echo"   <h2 class=\"StepTitle\">Bath Room $count</h2>";
                    echo'  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Flooring Type </label>';
                         echo" <p>$getbathroomdetailss->flooringType </p>";
                       echo' </div>
                      </div>';
					 
					 echo '<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Hot Water Supply </label>';
                         echo" <p>$getbathroomdetailss->hotwatersupply </p>";
                       echo' </div>
                      </div>';
					  
					  echo '<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Toilet </label>';
                         echo" <p>$getbathroomdetailss->toilet </p>";
                       echo' </div>
                      </div>';
						
                      echo'<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Glass Partition </label>';
						  if(in_array("GlassPartition", $bathothers)){ $GlassPartition="YES";}else{$GlassPartition="NO";}
                         echo" <p>$GlassPartition </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Bath Tub </label>';
						   if(in_array("BathTub", $bathothers)){ $BathTub="YES";}else{$BathTub="NO";}
                          echo"<p>$BathTub</p>";
                      echo'  </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Axhaust fan </label>';
						  if(in_array("Axhaustfan", $bathothers)){ $Axhaustfan="YES";}else{$Axhaustfan="NO";}
                          echo"<p>$Axhaustfan</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Windows </label>';
						   if(in_array("Windows", $bathothers)){ $Windows="YES";}else{$Windows="NO";}
                         echo" <p>$Windows</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Shower Curtain </label>';
						   if(in_array("ShowerCurtain", $bathothers)){ $ShowerCurtain="YES";}else{$ShowerCurtain="NO";}
                          echo"<p>$ShowerCurtain</p>";
                       echo' </div>
                      </div>
					  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Cabinet </label>';
						   if(in_array("Cabinet", $bathothers)){ $Cabinet="YES";}else{$Cabinet="NO";}
                          echo"<p>$Cabinet</p>";
                       echo' </div>
                      </div>
                    </div>';
							 
						$count++; }
					 }
                   
					
					
					
				}
				
			}
	}
/*Show preview on 4th Step from db inserted Data End.............................................................................................................*/


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

	
/*Delete property image Start.............................................................................................................*/
	function Deletepropertyimage()
	{	
			if(!empty($this->input->post('imageid')))
			{
					$this->AddProperty_model->Deletepropertyimage($this->input->post('imageid'));
					
					echo"Image Deleted Successfully!!";
			}else{
					echo"Image Deletion Fail!!";
			}
		
	}
/*Delete property image End.............................................................................................................*/

	

}
?>