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
														echo"<select name=\"select-$Attributes->attributeID\" class=\"form-control\" $call $id>";
														  echo"<optgroup label=\"Select\">";
														  echo"<option value=\"\">select</option>";
														  foreach($Attributeoption as $Attributeoptions){
														  echo"<option value=\"$Attributeoptions->attrOptionID-$Attributeoptions->attrOptName\">$Attributeoptions->attrOptName</option>";
														  }
														  echo"</optgroup>";
														echo"</select>";
													  echo"</div>";
													}
													 
													if($Attributes->attrInputType=="texbox"){
													  echo"<div class=\"form-group col-xs-12 col-sm-4 \">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														echo"<input id=\"middle-name\" class=\"form-control\" type=\"text\" name=\"text-$Attributes->attributeID\">";
													  echo"</div>";
													}
													  
													if($Attributes->attrInputType=="multiselect"){ 
													//echo"<br>";
													  echo"<div class=\"form-group col-xs-12 col-sm-4\">";
														echo"<label class=\"control-label\" for=\"last-name\" style=\"display:block;\">$Attributes->attrName</label>";
														foreach($Attributeoption as $Attributeoptions){
														  
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\"  value=\"$Attributeoptions->attrOptionID-$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\">";
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
		//print_r($data);die;
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
												{
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>0);
													$selectattributeval[]=array('attrDetValue'=>$datas);
													
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
						
						if(!empty($amenitiesdata) && !empty($amenitiesvalue))
						{	$i=0;
							
							$this->AddProperty_model->deleteattributesandvalues($data['propertyID']);
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
							
							$this->AddProperty_model->deleteattributesandvalues($data['propertyID']);
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
					{	
						for($i=1;$i<=$NoOfBedRooms[0]->attrDetValue;$i++)
						{
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
										  <option value="Marble">Marble</option>
										  <option value="Wood">Wood</option>
										  <option value="Ceramic">Ceramic</option>
										  <option value="Stone">Stone</option>
										  <option value="Laminate">Laminate</option>
										  <option value="AntiSkidTiles">Anti Skid Tiles</option>
										</select>
									  </div>
									</div>';
								echo"	<div class=\" clearfix\"> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"TV\" name=\"$i-othersbedroom[]\">
									  TV</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AC\" name=\"$i-othersbedroom[]\">
									  AC</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Bed\" name=\"$i-othersbedroom[]\">
									  Bed</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" value=\"DressingTable\" name=\"$i-othersbedroom[]\">
									  Dressing Table</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Wardrobe\" name=\"$i-othersbedroom[]\">
									  Wardrobe</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"FalseSeiling\" name=\"$i-othersbedroom[]\">
									  False Seiling</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AttachedBalcony\" name=\"$i-othersbedroom[]\">
									  Attached Balcony</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"AttachedBathroom\" name=\"$i-othersbedroom[]\">
									  Attached Bathroom</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\"  value=\"Ventilation\" name=\"$i-othersbedroom[]\">
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
					{	
						for($i=1;$i<=$NoOfLivingRooms[0]->attrDetValue;$i++)
						{
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
                                  <option value="Marble">Marble</option>
                                  <option value="Wood">Wood</option>
                                  <option value="Ceramic">Ceramic</option>
                                  <option value="Stone">Stone</option>
                                  <option value="Laminate">Laminate</option>
                                  <option value="AntiSkidTiles">Anti Skid Tiles</option>
                                </select>
                              </div>
                            </div>
                            <div class=" clearfix"> <span class="checkbozsty-1">';
                           echo"   <input type=\"checkbox\"  value=\"Sofa\" name=\"$i-otherslivingroom[]\">
                              Sofa</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"DiningTable\" name=\"$i-otherslivingroom[]\">
                              Dining Table</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"AC\" name=\"$i-otherslivingroom[]\">
                              AC</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" value=\"ShoeRack\" name=\"$i-otherslivingroom[]\">
                              Shoe Rack</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"TV\" name=\"$i-otherslivingroom[]\">
                              TV</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\"  value=\"FalseSeiling\" name=\"$i-otherslivingroom[]\">
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
					{	
						for($i=1;$i<=$NoOfBathRooms[0]->attrDetValue;$i++)
						{
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
                                  <option value="Marble">Marble</option>
                                  <option value="Wood">Wood</option>
                                  <option value="Ceramic">Ceramic</option>
                                  <option value="Stone">Stone</option>
                                  <option value="Laminate">Laminate</option>
                                  <option value="AntiSkidTiles">Anti Skid Tiles</option>
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
                                        <input type="radio" class="flat" value="Geyser" name="hotwatersupply[]">
                                        Geyser </label>
                                      <label>
                                        <input type="radio" class="flat" value="Gas"  name="hotwatersupply[]">
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
                                        <input type="radio" class="flat" value="Indian" name="toilet[]">
                                        Indian </label>
                                      <label>
                                        <input type="radio" class="flat" value="Western" name="toilet[]">
                                        Western </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">';
                           echo"     <input type=\"checkbox\"  value=\"GlassPartition\" name=\"$i-othersbathroom[]\">
                                Glass Partition</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"BathTub\" name=\"$i-othersbathroom[]\">
                                Bath Tub</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Axhaustfan\" name=\"$i-othersbathroom[]\">
                                Axhaust fan</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" value=\"Windows\" name=\"$i-othersbathroom[]\">
                                Windows</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"ShowerCurtain\" name=\"$i-othersbathroom[]\">
                                Shower Curtain</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\"  value=\"Cabinet\" name=\"$i-othersbathroom[]\">
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