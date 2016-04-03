<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProject extends CI_Controller {

	 function __construct() {
		parent::__construct();
		$this->data['LanguageId']='1';
		$this->data[]="";
		$this->data['global']=$_SERVER['SERVER_NAME'];
		$this->data['url'] = base_url();
		$this->load->model('AddProject_model');
		$this->load->model('AddProperty_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}
		$this->userinfo=$this->session->userdata('homeonline');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}
	


		/*......................Add Project view Load Start......................*/
	function index($filter=false) 
	{	
		if(!empty($filter)) 
		{
			$this->data['projectID']=$filter;
			$ProjectFilterData=$this->data['ProjectFilterData']=$this->AddProject_model->GetProjectDataDetail($filter,$this->data['LanguageId']);
			$ProjectPaymentInfo=$this->data['ProjectPaymentInfo']=$this->AddProject_model->GetProjectPaymentDetail($filter,$this->data['LanguageId']);
			$ProjectImageInfo=$this->data['ProjectImageInfo']=$this->AddProject_model->GetProjectImageDetail($filter,$this->data['LanguageId']);
			$ProjectVideoInfo=$this->data['ProjectVideoInfo']=$this->AddProject_model->GetProjectVideoDetail($filter,$this->data['LanguageId']);
			$ProjectLanguages=$this->data['ProjectLanguages']=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
			if(isset($ProjectFilterData)&&!empty($ProjectFilterData[0]->countryID))
			{
				$ProjectLocality=$this->data['ProjectLocality']=$this->AddProject_model->GetMultipleData('rp_city_locations',array('cityLocID'=>$ProjectFilterData[0]->cityLocID,'cityLocStatus'=>'Active'));
				$ProjectCountryId=$this->data['ProjectCountryId']=$this->AddProject_model->GetProjectCountryDetail($ProjectFilterData[0]->countryID,$this->data['LanguageId']);
				$ProjectStateId=$this->data['ProjectStateId']=$this->AddProject_model->GetProjectStateDetail($ProjectFilterData[0]->stateID,$this->data['LanguageId']);
				$ProjectCityId=$this->data['ProjectCityId']=$this->AddProject_model->GetProjectCityDetail($ProjectFilterData[0]->cityID,$this->data['LanguageId']);
				$projectUnitDetails=$this->data['projectUnitDetails']=$this->AddProject_model->PropertBedroomDetails($this->data['projectID'],'Unit');
				$PropertyUnitPriceRange=$this->AddProject_model->PropertyUnitPriceRange($this->data['projectID'],'Unit');
				if(!empty($PropertyUnitPriceRange))
				{
					foreach($PropertyUnitPriceRange as $list)
					{
						$propPrice[]=$list->propertyPrice;
					}
					$minRate=min($propPrice);
					$maxRate=max($propPrice);//echo $maxRate; echo $minRate;die;
					if(isset($maxRate))
					{
						if($maxRate>=10000000)
						{
							$resPropPrice   = $maxRate / 10000000 ; 
							$this->data['maxPrice']=round($resPropPrice, 2).' Cr'; 
						}
						elseif($maxRate>=100000)
						{
							$resPropPrice   = $maxRate / 100000 ; 
							 $this->data['maxPrice']=round($resPropPrice, 2).' Lac'; 
						}
						elseif($maxRate>=10000)
						{
							$resPropPrice   = $maxRate / 10000 ; 
							 $this->data['maxPrice']=round($resPropPrice, 2).' Thous'; 
						}
						else
						{
							 $this->data['maxPrice']=$maxRate;
						}
					}
					if(isset($minRate))
					{
						if($minRate>=10000000)
						{ 
							$resPropPrice   = $minRate / 10000000 ; 
						    $this->data['minPrice']=round($resPropPrice, 2).' Cr'; 
						}
						elseif($minRate>=100000)
						{ 
							$resPropPrice   = $minRate / 100000 ; 
							 $this->data['minPrice']=round($resPropPrice, 2).' Lac';
						}
						elseif($minRate>=10000)
						{ 
							$resPropPrice   = $minRate / 10000 ; 
							$this->data['minPrice']=round($resPropPrice, 2).' Thous'; 
						}
						else
						{
							$this->data['minPrice']=$minRate;
						}
					}
					//echo $this->data['maxPrice'];echo $this->data['minPrice'];die;
				}
			}
		}
		$UserType=$this->data['UserType']=$this->AddProject_model->GetMultipleData('rp_user_type_details',array('languageID'=>$this->data['LanguageId']));
		$ProjectType=$this->data['ProjectType']=$this->AddProject_model->GetMultipleData('rp_property_types',array('typeName'=>'Project','propertyTypeStatus'=>'Active'));
		$this->data['propertytype']=$this->AddProject_model->getPropertyType();
		$this->parser->parse('header',$this->data);
		$this->load->view('addproject',$this->data);
		$this->parser->parse('footer',$this->data);
	}
		/*.................................................Add Project view Load End.............................................................*/
	
		/*....................................Function Start For User Type Details Example:- Agent and Builders.......................................*/
	function UserTypeDetail()
	{
		$userids=$this->input->post('userid');
		$UserTypeId= $this->input->post('UserTypeId');
		$UserId=$this->data['UserId']=$this->AddProject_model->GetMultipleData('rp_user_type_details',array('userTypeID'=>$UserTypeId,'languageID'=>$this->data['LanguageId'])); if(isset($UserId[0]->userTypeName) && !empty($UserId[0]->userTypeName) && $UserId[0]->userTypeName=='Agency'){ $UserTypeName='Agent'; } else{ $UserTypeName='Builder'; }
		$UserId=$this->data['UserId']=$this->AddProject_model->GetMultipleData('rp_user_to_type',array('userTypeID'=>$UserTypeId));
		?>
		<div class="form-group col-xs-12 col-sm-3 martop20">
		   <label class="control-label" for="last-name"><?=$UserTypeName?> <span class="required">*</span></label>
			 <select class="select2_group form-control" id="userID" name="userID" onchange="UserPlane(this.value,this.id)">
			   <option value="0">Select</option>
			 <?php 
			 foreach ($UserId as $list)
			 {
				$UserDetail=$this->data['UserDetail']=$this->AddProject_model->GetMultipleData('rp_user_details',array('userID'=>$list->userID,'languageID'=>$this->data['LanguageId'])); //print_r($UserId);
			foreach ($UserDetail as $list){ 
			$UserEmail=$this->data['UserEmail']=$this->AddProject_model->GetMultipleData('rp_users',array('userID'=>$list->userID));
			 ?> 
			  <option value="<?php echo $list->userID; ?>" <?php if(!empty($userids) && $userids==$list->userID){ echo 'selected'; } ?> ><?php echo ucwords(str_replace('_', ' ', $list->userCompanyName)); ?>( <?php echo ucwords($UserEmail[0]->userEmail); ?> )</option>
			 <?php } }?>
		   </select>
		</div>
		<!-- select2 --> 
		<script>
					$(document).ready(function () {
						$(".select2_single").select2({
							placeholder: "Select a state",
							allowClear: true
						});
						$(".select2_group").select2({});
						$(".select2_multiple").select2({
							maximumSelectionLength: 4,
							placeholder: "With Max Selection limit 4",
							allowClear: true
						});
					});
					
					
					$(document).on('hidden.bs.modal', function (e) {
				var target = $(e.target);
				target.removeData('bs.modal')
					  .find(".modal-content").html('');
			});
		</script> 
		<!-- /select2 --> 
		<?php 
		
	}
		/*..................................................Function End For UserType Details........................................................*/
	
		/*..................................................Function Start For User Plan Details........................................................*/
	function UserPlaneDetail()
	{
		$UserId= $this->input->post('UserId');
		if(isset($UserId)&&!empty($UserId))
		{
			$PlaneId=$this->data['PlaneId']=$this->AddProject_model->GetUserplan($UserId,'Project');
			if(isset($PlaneId)&&!empty($PlaneId))
			{ ?>
				<div class="form-group col-xs-12 col-sm-3 martop20">
				   <label class="control-label" for="first-name">User Plan <span class="required">*</span></label>
					 <select class="select2_group form-control" id="ConsumesPlanID" name="UserPlaneDetail" onchange="ConsumePlanID(this.value)">
					   <option value="0">Select</option>
					 <?php 
					 foreach($PlaneId as $list){ 
					 
					 ?> 
						 <option value="<?php echo $list->planID; ?>" <?php if(!is_null($this->input->post('projectID'))){ $PlaneDetail=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$this->input->post('projectID'))); if(isset($PlaneDetail[0]->planID)&& $PlaneDetail[0]->planID==$list->planID){ echo 'selected'; } } ?> ><?php  echo ucwords(str_replace('_', ' ', $list->planTitle)); ?></option>
					 <?php } ?>
				   </select>
				</div>
				<?php 
			}
			else
			{ ?>
				<div class="form-group col-xs-12 col-sm-3 martop20">
			   <label class="control-label" for="first-name">User Plan <span class="required">*</span></label>
				 <select class="select2_group form-control" id="ConsumesPlanID" name="UserPlaneDetail" <?php if(!is_null($this->input->post('freelistingvalue')) && $this->input->post('freelistingvalue')=='1'){ echo 'disabled'; } ?> >
				   <option value="0">Select</option>
				   <option value="0">No More Plan Left</option>
				</select>
			</div>			
			<?php 
			}
		}
		else
		{ ?>
			<div class="form-group col-xs-12 col-sm-3 martop20">
			   <label class="control-label" for="first-name">User Plan <span class="required">*</span></label>
				 <select class="select2_group form-control" id="ConsumesPlanID" name="UserPlaneDetail" <?php if(!is_null($this->input->post('freelistingvalue')) && $this->input->post('freelistingvalue')=='1'){ echo 'disabled'; } ?> >
				   <option value="0">Select</option>
				   <option value="0">No Plane</option>
				</select>
			</div>
		<?php 
		} ?>
		<!-- select2 --> 
			<script>
						$(document).ready(function () {
							$(".select2_single").select2({
								placeholder: "Select a state",
								allowClear: true
							});
							$(".select2_group").select2({});
							$(".select2_multiple").select2({
								maximumSelectionLength: 4,
								placeholder: "With Max Selection limit 4",
								allowClear: true
							});
						});
						
						
						$(document).on('hidden.bs.modal', function (e) {
					var target = $(e.target);
					target.removeData('bs.modal')
						  .find(".modal-content").html('');
				});
			</script> 
		<!-- /select2 -->	
		<?php		
	}
		/*..................................................Function End For User Plan Details........................................................*/
		
		/*...............................Function Start For If Select Under Construction Then Date Picker Is Enable Other wise Disable ......................*/
	function StatusDatePicker()
	{
		$StatusValue= $this->input->post('StatusValue');//echo $UserId;die;
		?>
			<div class="form-group col-xs-12 col-sm-3">
				<label class="control-label" for="last-name">Date</label>
				<div class="">
					<input type="text" name="possessionDate"  class="form-control" <?php if($StatusValue=='Under Construction'){ ?> id="monthYearPicker" value="<?php if(!is_null($this->input->post('possessionDate'))){ echo $this->input->post('possessionDate'); }?>" <?php  }?> placeholder="Select Date" aria-describedby="inputSuccess2Status2" <?php if($StatusValue!=='Under Construction'){ ?> readonly <?php  }?>>
				</div>
			</div>
			<script type="text/javascript">
				$(function() {
						$('#monthYearPicker').datepicker({
							changeMonth: true,
							changeYear: true,
							changeDays: false,
							showButtonPanel: true,
							dateFormat: 'MM yy'
						}).focus(function() {
							var thisCalendar = $(this);
							$('.ui-datepicker-calendar').detach();
							$('.ui-datepicker-close').click(function() {
					var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
					thisCalendar.datepicker('setDate', new Date(year, month, 0));
							});
						});
					});
			</script>
		<?php 
	}
	/*............................................................. Function End For Date Picker .................................................*/
	
	/*..............................Function Start For Amenities And Project Specification Details In Add Project View......................................*/
	function ProjectType()
	{		
			$projectTypeId=$this->input->post('projectTypeId');
			$projectID=$this->input->post('projectID');
			if(!empty($projectTypeId))
			{
				$AttributesGroup=$this->AddProperty_model->Getattributesgroups($this->input->post('projectTypeId'));
					
					if(!empty($AttributesGroup)){
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							
							
							echo"<div class=\"panel\" > <a class=\"panel-heading\" role=\"tab\" id=\"headingOneA$atti\" data-toggle=\"collapse\" data-parent=\"#accordion1\" href=\"#collapseOneA$atti\" aria-expanded=\"false\" aria-controls=\"collapseOneA$atti\">";
                              echo"<h4 class=\"panel-title StepTitle\">$AttributesGroups->name</h4>";
								echo"</a>";
									echo"<div id=\"collapseOneA$atti\" class=\"panel-collapse collapse \" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
										echo"<div class=\"panel-body black-filed\">";
										
											$Attribute=$this->AddProperty_model->GetAttributes($AttributesGroups->attributeGroupID);
											if(!empty($Attribute))
											{
												echo'<div id="selectdiv">';
												foreach($Attribute as $Attributes)
												{
													if($Attributes->attrName !="Amenities" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if(!empty($projectID))
													{
													$checkattri=$this->AddProject_model->Shownoofbedrooms('rp_project_attribute_values',array('projectID'=>$projectID,'attributeID'=>$Attributes->attributeID));
													}
													
													if($Attributes->attrInputType=="select"){
													
													  echo"<div class=\"form-group col-xs-12 col-sm-4 martop20\">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														if($Attributes->attributeKey=="bed-rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}
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
													
													
												}
												}
												echo"</div>";
												echo"<div class='clearfix'></div>";
												
												echo'<div id="textdiv">';
												foreach($Attribute as $Attributes)
												{
													if($Attributes->attrName !="Amenities" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if(!empty($projectID))
													{
													$checkattri=$this->AddProject_model->Shownoofbedrooms('rp_project_attribute_values',array('projectID'=>$projectID,'attributeID'=>$Attributes->attributeID));
													}
													
													if($Attributes->attrInputType=="textbox"){
														if($Attributes->attributeKey=="covered-area"){ $other=''; $call="onchange='generatenameproperty();'"; $id="id='coveredarea'";}
														elseif($Attributes->attributeKey=="expected-price"){ $other=''; $call="onchange='calculatepersqreft();'"; $id="id='expectedprice'";}
														elseif($Attributes->attributeKey=="price-per-sq-ft"){ $other='readonly'; $call=""; $id="id='pricepersqrft'";}else{$other=''; $call=''; $id='';}
													  echo"<div class=\"form-group col-xs-12 col-sm-4 \">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														echo"<input $call $id  class=\"form-control\" type=\"text\" name=\"text-$Attributes->attributeID\" $other value=\"";
														echo isset($checkattri[0]->attrDetValue)?$checkattri[0]->attrDetValue:'';
														echo "\">";
													  echo"</div>"; 
													  
													}
													
													
												}
												}
												echo"</div>";
												
												
												echo'<div id="multidiv">';
												foreach($Attribute as $Attributes)
												{
													if($Attributes->attrName !="Amenities" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if(!empty($projectID))
													{
													$checkattri=$this->AddProject_model->Shownoofbedrooms('rp_project_attribute_values',array('projectID'=>$projectID,'attributeID'=>$Attributes->attributeID));
													}
													
													
													if($Attributes->attrInputType=="multiselect"){ 
													
													 /* echo"<div class=\"form-group col-xs-12 col-sm-4\">";
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
														echo"</div>";  */
														
														echo'<div class="row">
															  <div class="col-xs-12">
																<div class="x_title-1">';
														echo"	  <h4>$Attributes->attrName</h4>";
														echo' </div>
																<div class="clearfix">';
																
															foreach($Attributeoption as $Attributeoptions){
																
														  if(!empty($projectID))
														  {
															$attmulti=$this->AddProject_model->Getotherdata('rp_project_attribute_values',array('projectID'=>$projectID,'attributeID'=>$Attributes->attributeID));
															if(!empty($attmulti))
															{
																$tempVariable=explode('#|#',$attmulti[0]->attrOptionID);
															}
														  }
														  
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\"  value=\"$Attributeoptions->attrOptionID-$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\"";
														if(isset($tempVariable)&&!empty($attmulti)){ if(in_array($Attributeoptions->attrOptionID,$tempVariable)){echo"checked";}}
														echo">";
														echo"$Attributeoptions->attrOptName</span>";
														}
														echo'	  </div>
														  </div>
														</div>';
													
													}
													
												}
												}
												echo"</div>";
												
												
											}else{
												echo"List Is !empty!!";
											}
								
                              echo"</div>";
                            echo"</div>";
							 echo"</div>";
							$atti++;
						
						}
						
					}else{
						echo"List Is !empty!!";
					}
			}else{
				echo"";
			}
		
	}
	
		/*..................................Function For Insert Add Project Data 1st Step and 2nd Step.........................................*/
	function InsertProject($formid=false)
	{
		$data=$_POST;
		//print_r($data);die;
		$date=date('Y-m-d H:i:s');
		
		if(!empty($formid))
		{
			$formname="form-";
			$formname.=$formid;
		}
		
		if(!empty($data))
		{
			$data1=array();
			$data2=array();
			$data3=array();
			$data4=array();
			if($formname=="form-1")
			{
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
					}
		
					if($key=="projectTypeID")
					{
						$data1['projectTypeID']= $datas;
					}
		
					if($key=="lat")
					{
						$data1['projectLatitude']= $datas;
					}
		
					if($key=="lng")
					{
						$data1['projectLongitude']= $datas;
					}
					
					if($key=="languageID")
					{
						$languageID= $datas;
					}
		
					if($key=="postal_code")
					{
						$data1['projectZipCode']= $datas;
					}
					
					
					if($key=="possessionDate")
					{
						$data1['possessionDate']= $datas;
					}
					
					if($key=="projectCurrentStatus")
					{
						$data1['projectCurrentStatus']= $datas;
					}
					
					/*******************************Project Details Table Data ****************************************/
					if($key=="projectName")
					{
						$data2['projectName']= $datas;
					}
					
					if($key=="projectDescription")
					{
						$data2['projectDescription']= $datas;
					}
					
					if($key=="projectAddress1")
					{
						$data2['projectAddress1']= $datas;
					}
		
					if($key=="projectAddress2")
					{
						$data2['projectAddress2']= $datas;
					}
		
					if($key=="projectMetaTitle")
					{
						$data2['projectMetaTitle']= $datas;
					}
					
					if($key=="projectMetaKeyword")
					{
						$data2['projectMetaKeyword']= $datas;
					}
					
					if($key=="projectMetaDescription")
					{
						$data2['projectMetaDescription']= $datas; 
					}
					
					if($key=="projectOgTitle")
					{
						$data2['projectOgTitle']= $datas;
					}
					
					if($key=="projectOgDescription")
					{
						$data2['projectOgDescription']= $datas;
					}
					
					/***************************Code for city,state,county,citylocality Get ID For insert start*****************************/
	
						if($key=="country")
						{
						  $addarray['country']= $datas;
						  
						}elseif($key=="administrative_area_level_1")
						{
						  $addarray['administrative_area_level_1']= $datas;
						  
						}elseif($key=="locality")
						{
						  $addarray['locality']= $datas;
						  
						}elseif($key=="sublocality")
						{
						  $addarray['sublocality']= $datas;
						  
						}elseif($key=="lat")
						{
						  $addarray['projectLatitude']= $datas;
						  
						}elseif($key=="lng")
						{
						  $addarray['projectLongitude']= $datas;
						  
						}
						//echo $languageID; die;
					/**************************Code for city,state,county,citylocality Get ID For insert END********************************/	
					
					/*************************Campaign Log Inset*******************************************/
					if($key=="UserPlaneDetail")
					{
						$data3['planID']= $datas;
					}
					
					/*************************Amenities Start***************************************************/
					
					if($key=="Amenities")
					{					
						$string1 = '';
						$string2 = '';
						if(!empty($datas))
						{
							foreach($datas as $amenities){
								
								$amenitiesarr=explode("-",$amenities);
								
								$string1.= rtrim($amenitiesarr[1]).'#|#';
								$string2.= rtrim($amenitiesarr[2]).'#|#';
							}
							
							$amenitiesdata[]=array('attributeID'=>$amenitiesarr[0],'attrOptionID'=>substr($string1,0,-3));
							$amenitiesvalue[]=array('attrDetValue'=>substr($string2,0,-3));
							
						}
					}
					/***************************Attributes start***********************************************/
								
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
							}
							elseif($typeofattribute[0]=="text")
							{
								if(!empty($datas))
								{
									$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>0);
									$selectattributeval[]=array('attrDetValue'=>$datas);
									
								}
								
							}
							elseif($typeofattribute[0]=="multi")
							{
								$string1 = '';
								$string2 = '';
								if(!empty($datas))
								{
									foreach($datas as $attributemulti)
									{
					
									$optionidmulti=explode("-",$attributemulti);
									$string1.= rtrim($optionidmulti[0]).'#|#';
									$string2.= rtrim($optionidmulti[1]).'#|#';
									}
									$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>substr($string1,0,-3));
									$selectattributeval[]=array('attrDetValue'=>substr($string2,0,-3));
										
									
								}
							}
						}
					}
					
					if($key=="projectKey")
					{
						$projectKey= $datas;
					}
					
				}
					/******************* Insert Location Details ******************/	
				if(!empty($addarray))
					{
						$addressids=$this->AddProject_model->Getaddressids($addarray);
						if(!empty($addressids))
						{
						  $data1['countryID']= $addressids['countryID'];
						  $data1['stateID']= $addressids['stateID'];
						  $data1['cityID']= $addressids['cityID'];
						  $data1['cityLocID']= $addressids['cityLocID'];
						}else{
							  $data1['countryID']= '99';
							  $data1['stateID']= '1';
							  $data1['cityID']= '1';
							  $data1['cityLocID']= '';
						} 
					}else{
							/*  $data1['countryID']= '99';
							  $data1['stateID']= '1';
							  $data1['cityID']= '1';
							  $data1['cityLocID']= ''; */	
					}
					/******************* Insert Location Details End ******************/
					
				if(!empty($data['projectID']))
				{
					$data1['projectUpdateDate']= $date;
					if(isset($data3['planID']) && !empty($data3['planID']))
					{
						$CheckPlanDetail=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$data['projectID'],'objectType'=>'project'));
						if(count($CheckPlanDetail>0) && $CheckPlanDetail[0]->planID!==$data3['planID'])
						{
							$data1['projectStatus']='Draft';
						}
					}
					$this->AddProject_model->InsertProject('rp_projects',$data1,array('projectID'=>$data['projectID']));
					$this->AddProject_model->InsertProject('rp_project_details',$data2,array('projectID'=>$data['projectID'],'languageID'=>$languageID));
					$localityid=$data1['cityLocID'];$latitude=$data1['projectLatitude'];$longitude=$data1['projectLongitude'];
					$this->AddProject_model->Insertareacode($localityid,$latitude,$longitude,$data['projectID']);
					
					/*****************************Insert Data For Consumption*************************************/
					if(isset($data3['planID']) && !empty($data3['planID']))
					{
						$campaignID=$this->AddProject_model->GetCampaignIDPlaneDetail($data1['userID'],$data3['planID']);//echo count($campaignID); //echo $data['projectID'];die;
						if(count($campaignID)>0)
						{
							$data3['campaignID']=$campaignID[0]->campaignID;
							$data3['objectType']='project';
							$PlaneConsumptionDetail=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$data['projectID'],'objectType'=>'project'));//print_r($PlaneConsumptionDetail);die;
							if(count($PlaneConsumptionDetail)>0)
							{
								$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',$data3,array('objectID'=>$data['projectID']));
							}
							else
							{
								$data3['objectID']= $data['projectID'];
								$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',$data3);
							}
						}
					}
					
					/******************************** Payment Information Insert ***************************/
					if($data['paymentInfoLable'])
					{
						$delete=$this->AddProject_model->DeleteSingleData('rp_project_payment_info',array('projectID'=>$data['projectID']));
						if($delete)
						{
							for($i=0;$i<count($data['paymentInfoLable']);$i++)
							{
								$paymentLable=array(
												'projectID'=>$data['projectID'],
												'paymentInfoLabel'=>$data['paymentInfoLable'][$i],
												'paymentInfoValue'=>$data['paymentInfoValue'][$i],
												'languageID'=>$languageID,
											  );
								$paymentID=$this->AddProject_model->InsertProject('rp_project_payment_info',$paymentLable);
							}
						}
					}
					if(!empty($selectattribute) && !empty($selectattributeval))
					{	
						$this->AddProject_model->deleteattributesandvalues($data['projectID']);
						$j=0;
						foreach($selectattribute as $selectattributeinsert)
						{	
							$selectattributeinsert['projectID']=$data['projectID'];
							$attributevalueId=$this->AddProject_model->InsertProject('rp_project_attribute_values',$selectattributeinsert);//print_r($attributevalueId);
							$selectattributeval[$j]['attrValueID']=$attributevalueId;
							//$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
							//foreach($CheckLanguageDetail as $list)
							//{
								$selectattributeval[$j]['languageID']=$languageID; 
								$this->AddProject_model->InsertProject('rp_project_attribute_value_details',$selectattributeval[$j]);
						//	}
							$j++;
						}
					}
					if(!empty($amenitiesdata) && !empty($amenitiesvalue)) 
					{	
						$i=0;
						foreach($amenitiesdata as $amenitiesdatainsert)
						{	
							$amenitiesdatainsert['projectID']=$data['projectID'];
							$attributevalueId=$this->AddProject_model->InsertProject('rp_project_attribute_values',$amenitiesdatainsert);
							$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
						//	$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
						//	foreach($CheckLanguageDetail as $list)
						//	{
								$amenitiesvalue[$i]['languageID']=$languageID;
								$this->AddProject_model->InsertProject('rp_project_attribute_value_details',$amenitiesvalue[$i]);
						//	}
							$i++;
						}
					}
				}
				else
				{
					$projectKey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
					$data1['projectKey']= $projectKey;
					$data1['projectAddedDate']= $date;
					$data1['projectStatus']= 'Draft';
					$data1['projectFeatured']= 'OFF';
					$projectID=$this->AddProject_model->InsertProject('rp_projects',$data1);
					$data2['projectID']= $projectID;
					//$data2['languageID']= $this->data['LanguageId'];
					$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
					//print_r($CheckLanguageDetail);
					foreach($CheckLanguageDetail as $list)
					{
						$data2['languageID']= $list->languageID;
						$this->AddProject_model->InsertProject('rp_project_details',$data2);
					}
					/*********************************City Area Code Insert**********************************************/
					
					$localityid=$data1['cityLocID'];$latitude=$data1['projectLatitude'];$longitude=$data1['projectLongitude'];
					$this->AddProject_model->Insertareacode($localityid,$latitude,$longitude,$projectID);
					
					/*****************************Insert Data For Consumption*************************************/
					
					if(isset($data3['planID']) && !is_null($data3['planID']))
					{
						$campaignID=$this->AddProject_model->GetCampaignIDPlaneDetail($data1['userID'],$data3['planID']);//echo count($campaignID);die;
						if(count($campaignID)>0)
						{
							$data3['campaignID']=$campaignID[0]->campaignID;
							$data3['objectType']='project';
							$data3['objectID']= $projectID;
							$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',$data3);
						}
					}
					
					
					
					/************************** Payment Information Insert *************************************/
					$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
					foreach($CheckLanguageDetail as $list)
					{
						for($i=0;$i<count($data['paymentInfoLable']);$i++)
						{
							$paymentLable=array(
												'projectID'=>$projectID,
												'paymentInfoLabel'=>$data['paymentInfoLable'][$i],
												'paymentInfoValue'=>$data['paymentInfoValue'][$i],
												);
						
							$paymentLable['languageID']= $list->languageID;					
							$paymentID=$this->AddProject_model->InsertProject('rp_project_payment_info',$paymentLable);
						}
					}
					if(!empty($amenitiesdata) && !empty($amenitiesvalue))
					{	
						$i=0;
						foreach($amenitiesdata as $amenitiesdatainsert) 
						{	//print_r($amenitiesdata);die;
							$amenitiesdatainsert['projectID']=$projectID;
							//print_r($attributevalueDetails);die;
								$attributevalueId=$this->AddProject_model->InsertProject('rp_project_attribute_values',$amenitiesdatainsert);
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								
								$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
								foreach($CheckLanguageDetail as $list)
								{
									$amenitiesvalue[$i]['languageID']=$list->languageID;
									$this->AddProject_model->InsertProject('rp_project_attribute_value_details',$amenitiesvalue[$i]);
								}
							
							$i++;
						}
						//print_r($amenitiesdata);die;
					} 
							
					if(!empty($selectattribute) && !empty($selectattributeval)) 
					{	$j=0;
						foreach($selectattribute as $selectattributeinsert)
						{	
							$selectattributeinsert['projectID']=$projectID;
							
							$attributevalueId=$this->AddProject_model->InsertProject('rp_project_attribute_values',$selectattributeinsert);
							$selectattributeval[$j]['attrValueID']=$attributevalueId;
							//$selectattributeval[$j]['languageID']=1;
							$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
							foreach($CheckLanguageDetail as $list)
							{
								$selectattributeval[$j]['languageID']=$list->languageID;
								$this->AddProject_model->InsertProject('rp_project_attribute_value_details',$selectattributeval[$j]);
							}
							$j++;
						}
					}
							
				}
				/*************************Google Api Call**********************************/
				if(!isset($projectID)){ $projectID=$data['projectID']; }
				$projectID		= $projectID;
				$latitude   	= $data1['projectLatitude'];
				$longitude  	= $data1['projectLongitude'];
				$googleApiKey	= 'AIzaSyD6qxVW9JcJGXWjZ1j3h55YY1CANMqHqOQ';
				$radius			= '5000';
				$resLocalInfoTypes  = $this->AddProject_model->fetchLocalInfoTypes();
				if(count($resLocalInfoTypes)!= 0)
				{      
					for($i=0; $i<count($resLocalInfoTypes); $i++)
					{                
						$json = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$latitude.",".$longitude."&radius=".$radius."&types=".$resLocalInfoTypes[$i]->localinfoTypeUrlKey."&key=".$googleApiKey."");
						$data = json_decode($json);
						$this->AddProject_model->saveGoogleLocalInfos($data->results,$resLocalInfoTypes[$i]->localinfoTypeID,$projectID);
					}
				} 
					
					
			}
			//$_GET['']
			if(isset($projectID))
			{
				$projectIdKey=$projectID."#--#".$projectKey;
			}
			if(!empty($projectID)){ echo $projectIdKey; } else{ if(!empty($data['projectID'])){ echo $data['projectID']; }}
		}
		else
		{
			//if(!empty($projectID)){ echo $projectID; } else{ if(!empty($data['projectID'])){ echo $data['projectID']; }}
		}
	}
			/*................................End Function For Insert Project Data..............................*/
	
	
	/*...............................................function for elevation image insert.........................................................*/
	public function elevationImage()
	{  // echo $this->data['global']; die;
		$projectID=$this->input->post('projectID');
		$Elevationimagecategory=$this->input->post('ElevationImageCategory');
		if(@($projectID))
		{
			if($_FILES['file']['name']!='')
			{
				$elevationImgWidth	= 1920 ;
				$elevationImgHeight	= 540 ;
				$imgName = uniqid(rand(1, 99999)) . '' . $_FILES["file"]["name"];
				
				$ElevationPath	= "../public/uploads/project/images/elevation/".$imgName; 
				copy($_FILES["file"]["tmp_name"], $ElevationPath);  
				$imgData	= @getimagesize($ElevationPath);
				$w          = $imgData[0];
				$h          = $imgData[1];
			
				if ($w < $elevationImgWidth && $h < $elevationImgHeight) 
				{
					$elevationImgWidth	= $w;
					$elevationImgHeight	= $h;
				}
				$this->AddProperty_model->resizeImage($ElevationPath, $elevationImgWidth, $elevationImgHeight);
				if(!empty($imgName))
				{
					$projectElevationImage=array('projectID'=>$projectID,'projectElevationImage'=>$imgName);
					$projectElevationImage=$this->AddProject_model->InsertProject('rp_projects',$projectElevationImage,array('projectID'=>$projectID));
				}
				else
				{
						echo $this->upload->display_errors()."file upload failed";
				}
			}		
		}
	}
			/*.............................. End Function For Elevation Image Insert.........................................................*/
			
			
			/*...............................................function for 360Degree image insert.........................................................*/
	public function threesixtyImage()
	{
		$projectID=$this->input->post('projectID');
		$ThreeSixtyImageCategory=$this->input->post('ThreeSixtyImageCategory');
		if(@($projectID))
		{
			if($_FILES['file']['name']!='')
			{
				$data['image_z1']= $_FILES['file']['name'];
				$image=sha1($_FILES['file']['name']).time().rand(0, 9);
				
				if(@($_FILES['file']['name']))
				{
					$config =  array(
					'upload_path'	  => "../public/uploads/project/threesixtyviews/",
					'file_name'       => $image,
					'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
					'overwrite'       => true);					
					$this->upload->initialize($config);
					$this->load->library('upload');			 
					if($this->upload->do_upload("file"))
					{
						$upload_data = $this->upload->data();
						$image=$upload_data['file_name'];
						$projectThreeSixtyImage=array('projectID'=>$projectID,'projectThreeSixtyImage'=>$image);
						$projectThreeSixtyImage=$this->AddProject_model->InsertProject('rp_projects',$projectThreeSixtyImage,array('projectID'=>$projectID));
					}
					else
					{
							echo $this->upload->display_errors()."file upload failed";
					}
				}
			}
		}	
	}
		/*...............................................function for 360 Degree image insert.........................................................*/
		
		/*...............................................function for Thumb image insert.........................................................*/
	public function thumbImage()
	{
		$coverimage='No';
		$projectID=$this->input->post('projectID');
		$imagecategory=$this->input->post('imagecategory');
		$ProjectImageTitle=$this->input->post('ProjectImageTitle');
		if(@($projectID))
		{
			if($_FILES['file']['name']!='')
			{
				$commonThumbWidth	= 324;
				$commonThumbHeight	= 216;
				$smallPathWidth			= 81;
				$smallPathHeight		= 54;
				$lightboxWidth   	= 1098;
				$lightboxHeight  	= 732;
				$largeWidth =300;
				$largeHeight =200;
				$ProjectListAdminPanelHeight =138;
				$ProjectListAdminPanelWidth =92;
				$timelineWidth   	= 93;
				$timelineHeight  	= 62;
				$defaultThumbWidth	= 72;
				$defaultThumbHeight	= 48;
				$sponsoredWidth   	= 210;
				$sponsoredHeight  	= 140;
				$smallWidth   		= 81;
				$smallHeight  		= 54;
				$mapPopupWidth   	= 324;
				$mapPopupHeight  	= 216;
				$largeWidth   		= 300;
				$largeHeight  		= 200;
				$hotDealsWidth   	= 324;
				$hotDealsHeight  	= 216;
				$galleryWidth   	= 486;
				$galleryHeight  	= 324;
				$agentDetailWidth   = 210;
				$agentDetailHeight	= 140;
				$homeProjWidth   = 654;
				$homeprojHeight	= 436;
				$imgName = uniqid(rand(1, 99999)) . '' . $_FILES["file"]["name"];
				$originalPath		= "../public/uploads/project/images/original/".$imgName; 
				$smallPath			= "../public/uploads/project/images/small/".$imgName; 
				$commonThumbPath	= "../public/uploads/project/images/thumb/".$imgName;
				$lightboxPath       = "../public/uploads/project/images/lightbox/".$imgName;
				$largePath     = "../public/uploads/project/images/default/large/".$imgName;
				$ProjectListAdminPanelPath   = "../public/uploads/project/images/default/mapRight/".$imgName;
				$timelinePath			= "../public/uploads/project/images/default/timeline/".$imgName; 
				$defaultThumbPath	= "../public/uploads/project/images/default/thumb/".$imgName;
				$sponsoredPath       = "../public/uploads/project/images/default/sponsored/".$imgName;
				$small     = "../public/uploads/project/images/default/small/".$imgName;
				$mapPopupPath		= "../public/uploads/project/images/default/mapPopup/".$imgName; 
				$hotDealsPath	= "../public/uploads/project/images/default/hotDeals/".$imgName;
				$galleryPath       = "../public/uploads/project/images/default/gallery/".$imgName;
				$agentDetailPath     = "../public/uploads/project/images/default/agentDetail/".$imgName;
				$homeProjPath    = "../public/uploads/project/images/default/homeProj/".$imgName;
				copy($_FILES["file"]["tmp_name"], $originalPath);  
				copy($_FILES["file"]["tmp_name"], $commonThumbPath);
				copy($_FILES["file"]["tmp_name"], $smallPath);
				copy($_FILES["file"]["tmp_name"], $lightboxPath);
				copy($_FILES["file"]["tmp_name"], $ProjectListAdminPanelPath);
				copy($_FILES["file"]["tmp_name"], $small);  
				copy($_FILES["file"]["tmp_name"], $sponsoredPath);
				copy($_FILES["file"]["tmp_name"], $largePath);
				copy($_FILES["file"]["tmp_name"], $timelinePath);
				copy($_FILES["file"]["tmp_name"], $defaultThumbPath);
				copy($_FILES["file"]["tmp_name"], $mapPopupPath);  
				copy($_FILES["file"]["tmp_name"], $hotDealsPath);
				copy($_FILES["file"]["tmp_name"], $galleryPath);
				copy($_FILES["file"]["tmp_name"], $agentDetailPath);
				copy($_FILES["file"]["tmp_name"], $homeProjPath);
				$imgData = @getimagesize($originalPath);
			   $w          = $imgData[0];
			   $h          = $imgData[1];
			   
			   if ($w < $lightboxWidth && $h < $lightboxHeight) 
			   {
				$lightboxWidth = $w;
				$lightboxHeight = $h;
			   }
			   $this->AddProperty_model->resizeImage($smallPath, $smallPathWidth, $smallPathHeight);	
			   $this->AddProperty_model->resizeImage($commonThumbPath, $commonThumbWidth, $commonThumbHeight);
			   $this->AddProperty_model->resizeImage($lightboxPath, $lightboxWidth, $lightboxHeight);
			   $this->AddProperty_model->resizeImage($largePath, $largeWidth, $largeHeight);
			   $this->AddProperty_model->resizeImage($ProjectListAdminPanelPath, $ProjectListAdminPanelHeight, $ProjectListAdminPanelWidth);
			   $this->AddProperty_model->resizeImage($timelinePath, $timelineWidth, $timelineHeight);
			   $this->AddProperty_model->resizeImage($defaultThumbPath, $defaultThumbWidth, $defaultThumbHeight);
			   $this->AddProperty_model->resizeImage($sponsoredPath, $sponsoredWidth, $sponsoredHeight);
			   $this->AddProperty_model->resizeImage($small, $smallWidth, $smallHeight);
			   $this->AddProperty_model->resizeImage($mapPopupPath, $mapPopupWidth, $mapPopupHeight);
			   $this->AddProperty_model->resizeImage($hotDealsPath, $hotDealsWidth, $hotDealsHeight);
			   $this->AddProperty_model->resizeImage($galleryPath, $galleryWidth, $galleryHeight);
			   $this->AddProperty_model->resizeImage($agentDetailPath, $agentDetailWidth, $agentDetailHeight);
			   $this->AddProperty_model->resizeImage($homeProjPath, $homeProjWidth, $homeprojHeight);
			   $resDefaultImg = $this->AddProperty_model->Getotherdata('rp_project_images',array('projectID'=>$projectID,'isCoverImage'=>'Yes'));
			   
			   if(!empty($resDefaultImg)){
				   $coverimage='No';
			   }else{
					$coverimage='Yes';
			   }
				if(!empty($imgName))
				{
					$projectImage=array('projectID'=>$projectID,'imageCatID'=>$imagecategory,'projectImageName'=>$imgName,'isCoverImage'=>$coverimage,'projectImagePriority'=>'1','projectImageStatus'=>'Active');
					$propertyImageID=$this->AddProject_model->InsertProject('rp_project_images',$projectImage);
						/***************************** project Image Details insert *******************************/
					$projectImageDetails=array('projectImageID'=>$propertyImageID,'projectImageTitle'=>$ProjectImageTitle,'projectImageAltTag'=>$ProjectImageTitle);
					$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
					foreach($CheckLanguageDetail as $list)
					{
						$projectImageDetails['languageID']=$list->languageID;
						$this->AddProject_model->InsertProject('rp_project_image_details',$projectImageDetails);
					}
				}
			
			}
		}
	}
		/*...............................................function for Thumb image insert.........................................................*/
		
		/*...............................................Function For Upload Project Video .........................................................*/
	public function uploadvideo()
	{   
		$date=date('Y-m-d H:i:s');
		$projectID=$this->input->post('projectID');//echo $projectID;
		$videocategory=$this->input->post('videocategory');
	//	$ProjectVideoUrl=$this->input->post('projectVideo');
		if(@($projectID))
			{
				if($_FILES['file']['name']!='')
				{
					$data['image_z1']= $_FILES['file']['name'];
					$video=sha1($_FILES['file']['name']).time().rand(0, 9);
					if(!empty($_FILES['file']['name']))
					{
						$config =  array(
									'upload_path'	  => '..public/uploads/project/videos/',
									'file_name'       => $video,
									'allowed_types'   => "avi|mov|mp4|flv|mkv|vlc|wmv|3gp",
									'overwrite'       => true
									);
						$this->upload->initialize($config);
						$this->load->library('upload');
						if($this->upload->do_upload("file"))
						{
							$upload_data = $this->upload->data();
							$video=$upload_data['file_name'];
							
							/* project video insert */
							$projectVideo=array('projectID'=>$projectID,'projectVideo'=>$video,'projectVideoType'=>$this->input->post('projectVideoType'),'projectVideoPriority'=>'1','projectVideoStatus'=>'Active','projectVideoAddedDate'=>$date);
							$propertyVideoID=$this->AddProject_model->InsertProject('rp_project_videos',$projectVideo);
							/* project video Details insert */
							$projectVideoDetails=array('projectVideoID'=>$propertyVideoID,'projectVideoTitle'=>$this->input->post('projectVideoTitle'),'projectVideoDesc'=>$this->input->post('projectVideoDesc'));
							$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
							foreach($CheckLanguageDetail as $list)
							{
								$projectImageDetails['languageID']=$list->languageID;
								$this->AddProject_model->InsertProject('rp_project_video_details',$projectVideoDetails);
							}
						}
						else
						{
								echo $this->upload->display_errors()."file upload failed"; 
						}
					}
				}
			}
	}
		/*............................................... End Function For Upload Project Video .........................................................*/
	
	
	   /*................................................. Funtion For You Tube Video Insert ........................................................*/
	
	function ProjectInsertYoutubeVideo($formid=false)
	{
		$data=$_POST;
		$date=date("Y-m-d H:i:s");
		if(!empty($formid))
		{
			$formname="form-";
			$formname.=$formid;
		}
		if(!empty($data))
		{
			$data1=array();
			$data2=array();
			if($formname=="form-4")
			{
				foreach($data as $key=> $datas)
				{
					if($key=="projectID")
					{
					  $data1['projectID']= $datas;
					}
					if($key=="projectVideo")
					{
					  $data1['projectVideo']= $datas;
					}
					elseif($key=="projectVideoType")
					{
					  $data1['projectVideoType']= $datas;
					}
				}
			}
			if(isset($data1['propertyID'])&&!empty($data1['propertyID']))
			{
				// video update code here
			}
			else
			{
				$ExplodeProjectUrl=explode('=',$data1['projectVideo']);
				$data1['projectVideoAddedDate']= $date; 
				//print_r($ExplodeProjectUrl);die; 
				if(isset($ExplodeProjectUrl[1]) && $ExplodeProjectUrl[1]!=='')
				{
					$data1['projectVideoYoutubeID']= $ExplodeProjectUrl[1];
					$projectVideoID=$this->AddProject_model->InsertProject('rp_project_videos',$data1);
					
						/* project video Details insert */
					$jsonURL	= file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$data1['projectVideoYoutubeID']."&key=AIzaSyBvrUJDa-dDQ4fGk2I0KyMJBicjFRJs61A&fields=items(snippet(title),snippet(description))&part=snippet");
					$json		= json_decode($jsonURL);
					if (count($json) > 0)  
					{
						if(isset($json->items[0]->snippet->title) && isset($json->items[0]->snippet->description)) 
						{
							$projectVideoTitle	= str_replace(array('_','%','&amp;'), array('\_','\%','&'), addslashes($json->items[0]->snippet->title));
							$projectVideoDesc	= str_replace(array('_','%','&amp;'), array('\_','\%','&'), addslashes($json->items[0]->snippet->description));
							$projectVideoDetails=array('projectVideoID'=>$projectVideoID,'projectVideoTitle'=>$projectVideoTitle,'projectVideoDesc'=>$projectVideoDesc);
							$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
							foreach($CheckLanguageDetail as $list) 
							{ 
								$projectVideoDetails['languageID']=$list->languageID;
								$this->AddProject_model->InsertProject('rp_project_video_details',$projectVideoDetails);
							}
							?>
								<iframe width="250" height="205" src="http://www.youtube.com/embed/<?=$data1['projectVideoYoutubeID'];?>"></iframe>
							<?php
						}
						else
						{
							echo 'Please Enter Correct YouTube Video URL'; die; 
						}
					}
					else
					{
						echo 'Please Enter Correct YouTube Video URL'; die; 
					}
				}				
				else
				{
					echo 'Please Enter Correct YouTube Video URL'; die;
				}
				
			}
		}
	}
	
	   /*............................................... End Function For You Tube Video Insert .......................................................*/
		
		/*............................................... Function For Project List View Load .........................................................*/
	function ProjectList($action=false)
	{	
		if($action=="search"){
			
			$this->data['usertype']=$usertype=$this->input->post('usertype');
		    $this->data['projectName']=$projectName=$this->input->post('projectName');
			$this->data['projectKey']=$projectKey=$this->input->post('projectKey');
			$this->data['plan']=$plan=$this->input->post('plan');
			$this->data['status']=$status=$this->input->post('status'); 
			
			
			$query="";
			if(!empty($usertype)){ $query.="and `userTypeName` like TRIM('%$usertype%')"; }
			if(!empty($plan)){ $query.="and `planTitle` like TRIM('%$plan%')"; }
			if(!empty($projectKey)){ $query.="and `projectKey` like TRIM('%$projectKey%')"; }
			if(!empty($status)){ $query.="and `projectStatus` like TRIM('%$status%')"; }
			if(!empty($projectName)){ $query.="and `projectName` like TRIM('%$projectName%')"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				//echo  $query;die;				
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="ProjectList.csv"');
				 print  $this->AddProject_model->GetProjectFilterList($query);
				exit(); 
			}
			$ProjectList=$this->data['ProjectList']=$this->AddProject_model->GetProjectFilterList($query);  
		}
		else
		{
			$ProjectList=$this->data['ProjectList']=$this->AddProject_model->GetProjectList();
		}
			$this->parser->parse('header',$this->data);
			$this->load->view('ProjectList',$this->data);
			$this->parser->parse('footer',$this->data);
	}
		/*............................................... End Function For Project List View Load .........................................................*/
	
	
	/*................................................... function for project log search ............................................................*/
	function ProjectLog($action=false,$offset=false,$count=false)
	{	//echo $action; die;
		if($action=="search")
		{ 
			$this->data['projectName']=$projectName=$this->input->post('projectName');
			$this->data['projectKey']=$projectKey=$this->input->post('projectKey');
			$this->data['plan']=$plan=$this->input->post('plan');
			$this->data['status']=$status=$this->input->post('status'); 
			if(!is_null($this->input->post('projectID')))
			{
				$projectID=$this->input->post('projectID');
			}
			$query="";
			if(!empty($plan)){ $query.="and `planTitle` like TRIM('%$plan%')"; }
			if(!empty($projectKey)){ $query.="and `projectKey` like TRIM('%$projectKey%')"; }
			if(!empty($status)){ $query.="and `Action` like TRIM('%$status%')"; }
			if(!empty($projectName)){ $query.="and rp_project_details.projectName like TRIM('%$projectName%')"; }
			if(!empty($projectID)){ $query.="and rp_projects.projectID like TRIM('$projectID')" ;}
			
			if($this->input->post('submit') == 'Export to CSV'){
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="ProjectLog.csv"');
				 print  $this->AddProject_model->GetProjectFilterlog($query); 
				exit();
				}
				if($count==''){ $count='20'; $offset='0';}
			$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->GetProjectFilterlog($query,$offset,$count);
		}
		else
		{
			$this->data['projectID']=$action;
			$query="";
			if(!empty($action))
			{
				$query.="and rp_projects.projectID like TRIM('$action')";
			}
			if($count=='' && $offset==''){ $offset='0'; $count='20'; }
			$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->GetProjectFilterlog($query,$offset,$count);
		}
		$ProjectLogDetails=$this->data['ProjectLogDetails']=$this->AddProject_model->LogDetail('rp_project_log');//print_r($ProjectLogDetails);die;
		$this->parser->parse('header',$this->data);
		$this->load->view('ProjectLog',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
		
		/*............................................... Function For Project Log View Load .........................................................*/
	/*function ProjectLog($action=false)
	{
		if($projectID)
		{
			$filter=" and rp_project_log.projectID=$projectID";
			$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->get_Projectloglisting($filter);
			$this->data['projectID']=$filter;
		}
		else
		{
			$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->get_Projectloglisting();//print_r($ProjectLogFilterData);die;
		}
		$this->parser->parse('header',$this->data);
		$this->load->view('ProjectLog',$this->data);
		$this->parser->parse('footer',$this->data);
	}*/
		/*............................................... End Function For Project Log View Load .........................................................*/
		
	function ProjectStatusFinish()
	{
		$projectID=$this->input->post('projectID');
		$projectStatus=$this->input->post('projectStatus');//echo $projectID; echo $projectStatus;die;
		if(!empty($projectID))
		{
			$GetProjectDetails=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$projectID)); 
			$GetCampaignID=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$projectID,'objectType'=>'project'));
				/*.............. Check PlanID Details Behaf On ProjectID In Plan Mapping Table .......................*/
			if(!empty($projectStatus) && $projectStatus=='Active')
			{
				/*.............. Check If PlanID Details Avilable In Plane Maping Table So Plane Id Is Change By User Or Not  .......................*/
				if(!empty($GetProjectDetails[0]->projectStatus) && $GetProjectDetails[0]->projectStatus!=='Active')
				{		
					$Get_rp_user_to_plan_Details=$this->AddProject_model->GetMultipleData('rp_user_to_plan',array('userID'=>$GetProjectDetails[0]->userID,'planID'=>$this->input->post('PlanID'),'planStatus'=>'Active'));		
					if(count($Get_rp_user_to_plan_Details)>0)	
					{
						$GetPlanDuration=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$GetCampaignID[0]->campaignID,'planID'=>$GetCampaignID[0]->planID));
						$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',array('property_expiry_date'=>Date('Y-m-d', strtotime("+".$GetPlanDuration[0]->Duration." days"))),array('objectID'=>$projectID,'objectType'=>'project'));
						if(count($Get_rp_user_to_plan_Details)>0)
						{
							$GetCampaignplanDetails=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$GetCampaignID[0]->campaignID,'planID'=>$this->input->post('PlanID')));//print_r($GetCampaignplanDetails);
							if(!empty($GetCampaignplanDetails))
							{
								if( $GetCampaignplanDetails[0]->Quantity > $GetCampaignplanDetails[0]->plan_unitconsumed )
								{
									$newUnitConsumed=$GetCampaignplanDetails[0]->plan_unitconsumed+1;
									if($GetCampaignplanDetails[0]->Quantity==$newUnitConsumed)
									{
										$data=array(
													'plan_unitconsumed'=>$newUnitConsumed,
													'status'=>'Inactive',
													);
									}
									else
									{
										$data=array(
													'plan_unitconsumed'=>$newUnitConsumed,
													);
									}
									$this->AddProject_model->InsertProject('rp_dbho_campaignplan',$data,array('campaignID'=>$GetCampaignplanDetails[0]->campaignID,'planID'=>$this->input->post('PlanID')));
									$rpuserstoplandata=array(
										'planUpdateDate'=>date("Y-m-d h:i:s"),
										'planPropertyCountBalance'=>$Get_rp_user_to_plan_Details[0]->planPropertyCountBalance-1,
										 'planProjectCountBalance'=> $Get_rp_user_to_plan_Details[0]->planProjectCountBalance-1,
										 'planFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planFeaturedCountBalance-1,
										 'planProjectFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planProjectFeaturedCountBalance-1,
										 'totalPropSellCount'=>$Get_rp_user_to_plan_Details[0]->totalPropSellCount-1,
										 'totalPropRentCount'=>$Get_rp_user_to_plan_Details[0]->totalPropRentCount-1,
										 'totalPropLeaseCount'=>$Get_rp_user_to_plan_Details[0]->totalPropLeaseCount-1,
										 );
									$this->AddProject_model->InsertProject('rp_user_to_plan',$rpuserstoplandata,array('userID'=>$GetProjectDetails[0]->userID,'planID'=>$GetCampaignID[0]->planID,'planStatus'=>'Active','currencyID'=>3));
									$CunsumptionDetails=array(
																'campaignID'=>$GetCampaignID[0]->campaignID,
																'planID'=>$this->input->post('PlanID'),
																'objectID'=>$this->input->post('projectID'),
																'objectType'=>'project',
																'createdOn'=>date("Y-m-d h:i:s"),
																'status'=>'Active',
																'createdBy'=>'ANKIT SINGH'
															 );//print_r($CunsumptionDetails);//die;
									$this->AddProject_model->InsertProject('rp_dbho_plan_consumption_log',$CunsumptionDetails);
								}
							}
						}
					}
					$this->AddProject_model->InsertProject('rp_projects',array('projectStatus'=>$projectStatus,'projectUpdateDate'=>date("Y-m-d h:i:s"),'projectApprovedDate'=>date("Y-m-d h:i:s")),array('projectID'=>$projectID));
				}
				else
				{
					$this->AddProject_model->InsertProject('rp_projects',array('projectStatus'=>$projectStatus,'projectUpdateDate'=>date("Y-m-d h:i:s"),'projectApprovedDate'=>date("Y-m-d h:i:s")),array('projectID'=>$projectID));
					$projectStatus='Edit';
				}
			}
			if(!isset($projectStatus) || $projectStatus=='Draft')
			{
				if($projectStatus==''){ echo $projectStatus=='Draft'; }
				$this->AddProject_model->InsertProject('rp_projects',array('projectStatus'=>$projectStatus,'projectUpdateDate'=>date("Y-m-d h:i:s")),array('projectID'=>$projectID));
			
				/*********************************Project Log Insert**************************************/ 
			}
			$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->GetProjectDataDetail($projectID,$this->data['LanguageId']);//print_r($ProjectLogFilterData);die;
			$LogData=array(
						'projectID'=>$ProjectLogFilterData[0]->projectID,
						'projectName'=>$ProjectLogFilterData[0]->projectName,
						'email'=>$ProjectLogFilterData[0]->userEmail,
						'DateTime'=>date("Y-m-d h:i:s"),
						'Action'=>$projectStatus,
						'userID'=>$this->userinfo['adminUserID'],
						'planID'=>$this->input->post('PlanID'),
					  );
			$projectLogDetail=$this->AddProject_model->InsertProject('rp_project_log',$LogData);
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message','Project Key '.$GetProjectDetails[0]->projectKey.'  '.$projectStatus.' Successfully');
			redirect('AddProject/ProjectList');
		}
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message','Project Not Added Successfully');
		redirect('AddProject/ProjectList');		
			
	}
		
		/*......................... Function For Project List Status Update And Plan Consumption Code ...........................................*/
	function StatusUpdate($filter=false,$status=false,$ObjectType=false)
	{
		//if(!is_null($filter))
		
		//if($ProjectStatusData)
		//{
			$date=date('Y-m-d H:i:s');
							/*.................. If Used For Consumption Model ....................*/
			if(!is_null($this->input->post('status')) && $this->input->post('status')=='Refresh')
			{	
							/*.................... Update Date For Project Table ...........................*/
				if($this->input->post('PlanType')=='Project')
				{
					$this->AddProject_model->InsertProject('rp_projects',array('projectUpdateDate'=>$date,'projectStatus'=>'Active','projectApprovedDate'=>$date),array('projectID'=>$this->input->post('objectID')));//print_r($ProjectStatusData);die;
				}
				$status=$this->input->post('status');
				$filter=$this->input->post('objectID');
				$ObjectType=$this->input->post('PlanType');
				$adminrefresh=$this->input->post('adminconsumption');
				$GetCampaignID=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$filter,'objectType'=>'Project'));//print_r($GetCampaignID);
				if($GetCampaignID[0]->planID!==$this->input->post('UserPlaneDetail'))
				{
					$GetUserId=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));
					$campaignID=$this->AddProject_model->GetCampaignIDPlaneDetail($GetUserId[0]->userID,$this->input->post('UserPlaneDetail'));
					$GetPlanDuration=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$campaignID[0]->campaignID,'planID'=>$this->input->post('UserPlaneDetail')));
					$ProjectStatusData=$this->data['ProjectStatusData']=$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',array('planID'=>$this->input->post('UserPlaneDetail'),'campaignID'=>$campaignID[0]->campaignID,'property_expiry_date'=>Date('Y-m-d', strtotime("+".$GetPlanDuration[0]->Duration." days"))),array('objectID'=>$this->input->post('objectID'),'objectType'=>'Project'));//print_r($ProjectStatusData);
				}
				if($GetCampaignID[0]->planID==$this->input->post('UserPlaneDetail'))
				{
					$GetUserId=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));
					$campaignID=$this->AddProject_model->GetCampaignIDPlaneDetail($GetUserId[0]->userID,$this->input->post('UserPlaneDetail'));
					$GetPlanDuration=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$campaignID[0]->campaignID,'planID'=>$this->input->post('UserPlaneDetail')));
					$ProjectStatusData=$this->data['ProjectStatusData']=$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',array('property_expiry_date'=>Date('Y-m-d', strtotime("+".$GetPlanDuration[0]->Duration." days"))),array('objectID'=>$this->input->post('objectID'),'objectType'=>'project'));//print_r($ProjectStatusData);
				}
			}
			if($status=='Refresh' || $status=='Active')
			{	
				if(isset($ObjectType) && $ObjectType=='Project')
				{
					$GetProjectDetails=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));//print_r($GetProjectDetails);
					$GetPlnaConsumptionDetails=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$filter,'objectType'=>'project'));//print_r($GetPlnaConsumptionDetails);die;
					//$IdentityVariable='Project';
					
					$GetUserId=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));
					$campaignID=$this->AddProject_model->GetCampaignIDPlaneDetail($GetUserId[0]->userID,$GetPlnaConsumptionDetails[0]->planID);
					$GetPlanDuration=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$campaignID[0]->campaignID,'planID'=>$GetPlnaConsumptionDetails[0]->planID));
					$ProjectStatusData=$this->data['ProjectStatusData']=$this->AddProject_model->InsertProject('rp_dbho_plan_mapping',array('property_expiry_date'=>Date('Y-m-d', strtotime("+".$GetPlanDuration[0]->Duration." days"))),array('objectID'=>$filter,'objectType'=>'project'));//print_r($ProjectStatusData);
				} 
				if(count($GetPlnaConsumptionDetails)>0)
				{
					$Get_rp_user_to_plan_Details=$this->AddProject_model->GetMultipleData('rp_user_to_plan',array('userID'=>$GetProjectDetails[0]->userID,'planID'=>$GetPlnaConsumptionDetails[0]->planID,'planStatus'=>'Active'));
					if(count($Get_rp_user_to_plan_Details)>0)
					{
						//$GetCampaignID=$this->AddProject_model->GetUserplan($GetProjectDetails[0]->userID,$IdentityVariable);//print_r($GetCampaignID);
						if(count($GetPlnaConsumptionDetails)>0 && !isset($adminrefresh))
						{
							$GetCampaignplanDetails=$this->AddProject_model->GetMultipleData('rp_dbho_campaignplan',array('campaignID'=>$GetPlnaConsumptionDetails[0]->campaignID,'planID'=>$GetPlnaConsumptionDetails[0]->planID));//print_r($GetCampaignplanDetails);die;
							if(!empty($GetCampaignplanDetails))
							{
								if( $GetCampaignplanDetails[0]->Quantity > $GetCampaignplanDetails[0]->plan_unitconsumed )
								{
									$newUnitConsumed=$GetCampaignplanDetails[0]->plan_unitconsumed+1;
									if($GetCampaignplanDetails[0]->Quantity==$newUnitConsumed)
									{
										$data=array(
													'plan_unitconsumed'=>$newUnitConsumed,
													'status'=>'Inactive',
													);
									}
									else
									{
										$data=array(
													'plan_unitconsumed'=>$newUnitConsumed,
													);
									}
									$this->AddProject_model->InsertProject('rp_dbho_campaignplan',$data,array('campaignID'=>$GetCampaignplanDetails[0]->campaignID,'planID'=>$GetPlnaConsumptionDetails[0]->planID));
									$rpuserstoplandata=array(
										'planUpdateDate'=>date("Y-m-d h:i:s"),
										'planPropertyCountBalance'=>$Get_rp_user_to_plan_Details[0]->planPropertyCountBalance-1,
										 'planProjectCountBalance'=> $Get_rp_user_to_plan_Details[0]->planProjectCountBalance-1,
										 'planFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planFeaturedCountBalance-1,
										 'planProjectFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planProjectFeaturedCountBalance-1,
										 'totalPropSellCount'=>$Get_rp_user_to_plan_Details[0]->totalPropSellCount-1,
										 'totalPropRentCount'=>$Get_rp_user_to_plan_Details[0]->totalPropRentCount-1,
										 'totalPropLeaseCount'=>$Get_rp_user_to_plan_Details[0]->totalPropLeaseCount-1,
										 );
										$this->AddProject_model->InsertProject('rp_user_to_plan',$rpuserstoplandata,array('userID'=>$GetProjectDetails[0]->userID,'planID'=>$GetPlnaConsumptionDetails[0]->planID,'planStatus'=>'Active','currencyID'=>3));
										$CunsumptionDetails=array(
																'campaignID'=>$GetPlnaConsumptionDetails[0]->campaignID,
																'planID'=>$GetPlnaConsumptionDetails[0]->planID,
																'objectID'=>$filter,
																'objectType'=>$ObjectType,
																'createdOn'=>$date,
																'status'=>$status,
																'createdBy'=>'ANKIT SINGH'
															 );//print_r($CunsumptionDetails);
									$this->AddProject_model->InsertProject('rp_dbho_plan_consumption_log',$CunsumptionDetails);
								}
							}
						}
						if(isset($adminrefresh)&&$adminrefresh!=='') 
						{
								/*$CunsumptionDetails=array(
														'campaignID'=>$GetPlnaConsumptionDetails[0]->campaignID,
														'planID'=>$GetPlnaConsumptionDetails[0]->planID,
														'objectID'=>$filter,
														'objectType'=>$ObjectType,
														'createdOn'=>$date,
														'status'=>'Admin Refresh',
														'createdBy'=>'ANKIT SINGH'
													 );
							$this->AddProject_model->InsertProject('rp_dbho_plan_consumption_log',$CunsumptionDetails);*/
							$ProjectDetails=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));
							$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->GetProjectDataDetail($filter,$this->data['LanguageId']);//print_r($ProjectLogFilterData);die;
							$LogData=array('projectID'=>$ProjectLogFilterData[0]->projectID,
											'projectName'=>$ProjectLogFilterData[0]->projectName,
											'email'=>$ProjectLogFilterData[0]->userEmail,
											'DateTime'=>$date,
											'Action'=>'Admin Refresh',
											'userID'=>$this->userinfo['adminUserID'],
											'planID'=>$GetPlnaConsumptionDetails[0]->planID,
										  );
							$this->AddProject_model->InsertProject('rp_project_log',$LogData);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message','Project Key '.$ProjectDetails[0]->projectKey.' Admin Refresh  Successfully');
							redirect('AddProject/ProjectList');
									
						}
					}
				}
			}
			if($status=='Active' || $status=='Deleted' || $status=='Inactive') 
			{ 
				if($status=='Active')
				{
					$data=array(
								'projectStatus'=>$status,
								'projectApprovedDate'=>$date,
								'projectUpdateDate'=>$date,
								);
				}
				if($status=='Deleted')
				{
					$data=array(
								'projectStatus'=>$status,
								'projectUpdateDate'=>$date,
								);
				} 
				if($status=='Inactive')
				{
					$data=array(
								'projectStatus'=>$status,
								'projectUpdateDate'=>$date,
								);
				}
				$projectStatusUpdate=$this->AddProject_model->InsertProject('rp_projects',$data,array('projectID'=>$filter));
			}
			if($ObjectType=='Project')
			{
				$ProjectDetails=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$filter));
				$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->GetProjectDataDetail($filter,$this->data['LanguageId']);
				$GetPlnaConsumptionDetails=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$filter,'objectType'=>'project'));//print_r($GetPlnaConsumptionDetails);die;
				$LogData=array('projectID'=>$ProjectLogFilterData[0]->projectID,
								'projectName'=>$ProjectLogFilterData[0]->projectName, 
								'email'=>$ProjectLogFilterData[0]->userEmail,
								'DateTime'=>$date,
								'userID'=>$this->userinfo['adminUserID'],
								'Action'=>$status,
								'planID'=>$GetPlnaConsumptionDetails[0]->planID,
							  );
				$this->AddProject_model->InsertProject('rp_project_log',$LogData);
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('message','Project Key '.$ProjectDetails[0]->projectKey.' '.$status.' Successfully');
				redirect('AddProject/ProjectList');
			}
		//}
	}
		/*........................ End Function For Project List Status Update And Plan Consumption Code ......................................*/
	
	
	
		/*...................3rd Step In Project View Amenities And Project Specification On select Property Type ............................*/
	function Getattributes($propertyid=false)
	{	
			if(!is_null($this->input->post('propertytypeid')))
			{
					$AttributesGroup=$this->AddProperty_model->Getattributesgroups($this->input->post('propertytypeid'));
					
					if(!empty($AttributesGroup)){
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							if($AttributesGroups->name !="Flooring" && $AttributesGroups->name !="Fittings" && $AttributesGroups->name !="Walls" && $AttributesGroups->name !="Rent")
							{
												
							echo"<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingTwoA$atti\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseTwoA$atti\" aria-expanded=\"false\" aria-controls=\"collapseTwoA$atti\">";
                              echo"<h4 class=\"panel-title StepTitle\">Unit Specification</h4>";
								echo"</a>";
									echo"<div id=\"collapseTwoA$atti\" class=\"panel-collapse collapse \" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
										echo"<div class=\"panel-body black-filed\">";
										
											$Attribute=$this->AddProperty_model->GetAttributes($AttributesGroups->attributeGroupID);//print_r($Attribute[0]->attributeID);die;
											if(!empty($Attribute))
											{
												//foreach($Attribute as $Attributes)
												//{
													if($Attribute[0]->attrName ="Bed Rooms" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attribute[0]->attributeID);//print_r($Attributeoption);die;
													
													if(!empty($propertyid))
													{
													$checkattri=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attribute[0]->attributeID));
													}
													if($Attribute[0]->attrInputType=="select"){
													
													  echo"<div class=\"form-group col-xs-12 col-sm-4 martop20\">";
														?><label class="control-label" for="last-name"><?=$Attribute[0]->attrName;?> </label><?php
														if($Attribute[0]->attrName=="Bed Rooms"){ $call=""; $id="id='bedroom'";}else{$call=''; $id='';}
													?>	<select name="select-<?=$Attribute[0]->attributeID;?>" class="form-control" <?php echo $call; echo $id; ?> > <?php
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
													 
													/*if($Attributes->attrInputType=="texbox"){
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
													}*/
												}
											//}
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
				echo"";
			}
		
	}
/*AddProperty Get Attributes End.............................................................................................................*/

	
	/*AddProperty Insert Data Start.............................................................................................................*/
	function InsertProperty($formid=false) 
	{	
		error_reporting(1);
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
				
				if($formname=="form-3")
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
						if($key=="projectID")
						{
						  $data1['projectID']= $datas;
						}
						if($key=="propertyID")
						{
						  $data1['propertyID']= $datas;
						}
						elseif($key=="type")
						{
						  $data1['type']= $datas;
						}
						elseif($key=="isNegotiable")
						{
						  $data1['isNegotiable']= $datas;
						}
						elseif($key=="priceOnReq")
						{
						  $data1['priceOnReq']= $datas;
						}elseif($key=="propertyTypeID")
						{
						  $data1['propertyTypeID']= $datas;
						}elseif($key=="propertyPrice")
						{
						  $propertyprice['propertyPrice']= $datas;
						}
						elseif($key=="propertyName")
						{
						$data2['propertyName']= $datas;
						}
						/*elseif($key=="attrDetValue")
						{
						  $selectattributeval['attrDetValue']= $datas;
						}
						elseif($key=="Amenities")
						{					//Amenities Start.........................................
							if(!empty($datas))
							{
								foreach($datas as $amenities){
									
									$amenitiesarr=explode("-",$amenities);
									$amenitiesdata[]=array('attributeID'=>$amenitiesarr[0],'attrOptionID'=>$amenitiesarr[1]);
									$amenitiesvalue[]=array('attrDetValue'=>$amenitiesarr[2]);
								}
							}
						}*/
						else
						{											//Attributes start............................................
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
									}
									elseif($typeofattribute[0]=="text")
									{
										if(!empty($datas))
											{	
												$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>0);
												
												$selectattributeval[]=array('attrDetValue'=>"$datas");
												
											}
										
									}
									elseif($typeofattribute[0]=="multi")
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
					if(isset($data1['propertyID'])&&!is_null($data1['propertyID']))
					{
						if($data1['isNegotiable']=='')
						{
							$data1['isNegotiable']='No';
						}
						if($data1['priceOnReq']=='')
						{
							$data1['priceOnReq']='No';
						}
						$this->AddProject_model->InsertProject('rp_properties',$data1,array('propertyID'=>$data1['propertyID']));
					//	$data2['languageID']= $this->data['LanguageId'];
						//$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
						//foreach($CheckLanguageDetail as $list)
						//{
						//	$data2['languageID']= $list->languageID;
							$this->AddProject_model->InsertProject('rp_property_details',$data2,array('propertyID'=>$data['propertyID']));
						//}
						$this->AddProject_model->InsertProject('rp_property_price',$propertyprice,array('propertyID'=>$data1['propertyID']));
						
						if(!empty($selectattribute) && !empty($selectattributeval)) 
						{	
							$this->AddProject_model->deleteattributesandvaluesProjectUnit($data['propertyID']);
							$j=0;
							foreach($selectattribute as $selectattributeinsert)
							{	
								$selectattributeinsert['propertyID']=$data['propertyID'];
								
								$attributevalueId=$this->AddProject_model->InsertProject('rp_property_attribute_values',$selectattributeinsert);
								$selectattributeval[$j]['attrValueID']=$attributevalueId;
							//	$selectattributeval[$j]['languageID']=1;
								$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
								foreach($CheckLanguageDetail as $list)
								{
									$selectattributeval[$j]['languageID']=$list->languageID;
									$this->AddProject_model->InsertProject('rp_property_attribute_value_details',$selectattributeval[$j]);
								}
								$j++;
							}
						}
						$propertyid=$data['propertyID'];
					}
					else
					{
						$propertykey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
						$data1['propertyKey']= $propertykey;
						$data1['propertyAddedDate']= $date;
						$data1['propertyStatus']= 'Active';
						$data1['propertyPurpose']= 'Sell';
						$data1['propertyFeatured']= 'OFF';
						$ProjectUserId=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$data1['projectID']));
						$data1['userID']= $ProjectUserId[0]->userID;
						$propertyid=$this->AddProject_model->InsertProject('rp_properties',$data1);
						$data2['propertyID']= $propertyid;
						//$data2['languageID']= $this->data['LanguageId'];
						$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
						foreach($CheckLanguageDetail as $list)
						{
							$data2['languageID']= $list->languageID;
							$this->AddProject_model->InsertProject('rp_property_details',$data2);
						}
						if(!empty($propertyprice))
						{
							$propertyprice['currencyID']=3;
							$propertyprice['propertyID']= $propertyid;
							$this->AddProject_model->InsertProject('rp_property_price',$propertyprice);
						}
						/*if(!empty($selectattributeval))
						{
							$selectattributeinsert['propertyID']=$propertyid;
							$selectattributeinsert['attributeID']=1;
							$selectattributeinsert['attrOptionID']=$selectattributeval['attrDetValue'];
							$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$selectattributeinsert);
							$selectattributeval['attrValueID']=$attributevalueId;
							$selectattributeval['languageID']=1;
							$selectattributeval['attrDetValue']=$selectattributeval['attrDetValue'];
							$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval);
						}
						if(!empty($amenitiesdata) && !empty($amenitiesvalue))
						{	
							$i=0;
							foreach($amenitiesdata as $amenitiesdatainsert)
							{	
								$amenitiesdatainsert['propertyID']=$propertyid;
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$amenitiesdatainsert);
								
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								$amenitiesvalue[$i]['languageID']=1;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$amenitiesvalue[$i]);
								$i++;
							}
						}*/
						if(!empty($selectattribute) && !empty($selectattributeval))
						{	
							$this->AddProject_model->deleteattributesandvaluesProjectUnit($propertyid);
							$j=0;
							foreach($selectattribute as $selectattributeinsert)
							{	
								$selectattributeinsert['propertyID']=$propertyid;
								
								$attributevalueId=$this->AddProject_model->InsertProject('rp_property_attribute_values',$selectattributeinsert);
								$selectattributeval[$j]['attrValueID']=$attributevalueId;
								$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
								foreach($CheckLanguageDetail as $list)
								{
									$selectattributeval[$j]['languageID']=$list->languageID;
									$this->AddProject_model->InsertProject('rp_property_attribute_value_details',$selectattributeval[$j]);
								}
								$j++;
							}
						}
					}
				}
				if(is_null($this->input->post('projectID'))){ $data['projectID'] = $this->input->post('projectID');} else{  };
				$propertytype=$this->AddProject_model->getPropertyType();
				$unitpropertylist=$this->AddProject_model->Getunitdetails($data['projectID']);
				?>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                       
                    </div>
                    <div class="modal-body">
					 </div>
					
                  </div>
                </div>
              </div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h4 class="panel-title StepTitle">Unit List</h4>
						<div class="x_panel">
							<div class="x_content">
								<!--<div class="pull-right filter-con">
									<label>Filter by</label>
									<select>
										<option>Property Type</option>
										<option>Villa</option>
									</select>
									<select>
										<option>BHK</option>
										<option>2BHK</option>
									</select></div>-->
									<table id="myTable" class="table table-bordered table-hover vert-aliins">
									  <thead>
										<tr>
										  <th>BHK</th>
										  <th>Area Sq.Ft</th>
										  <th>Price/Sq.Ft</th>
										  <th>Price</th>
										  <th>Action</th>
										  <th>Floor Plan</th>
										 </tr>
									  </thead>
									<tbody>
								  <?php
								  $i=1;
								foreach($unitpropertylist as $unitpropertylists)
								{
										$filter=array('propertyID'=>$unitpropertylists->propertyID);
										$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter); 
										$coveredarea=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$unitpropertylists->propertyID,'attributeID'=>4));
										$bedroomno=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$unitpropertylists->propertyID,'attributeID'=>1));
										if(!empty($getpropertyprice[0]->propertyPrice) && !empty($coveredarea[0]->attrDetValue))
										{
												$propertyprice=$getpropertyprice[0]->propertyPrice;
												$propertysize=$coveredarea[0]->attrDetValue;
												$propertypricepersqr=$propertyprice/$propertysize;
										}
										
									echo'	<tr>
									  <td>';
									  if(!empty($bedroomno)){
									  echo $bedroomno[0]->attrDetValue;echo"BHK";}
									  echo'</td>
									  <td>';
									  echo $propertysize;
									  echo'Sq.Ft</td>
									  <td><i class="fa fa-rupee"></i>';
									  echo $propertypricepersqr;
										//echo $propertyprice;
									echo'  </td>
									  <td><i class="fa fa-rupee"></i>';
									  //echo $propertypricepersqr;
									  echo $propertyprice;
									?>  </td>
									<td>
										 <a href="javascript:void(0)" onclick="projectUnit(<?=$unitpropertylists->propertyID;?>,<?=$data['projectID']?>);"  title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
										 <a href="javascript:void(0)" onclick="ProjectDeleteUnit(<?=$unitpropertylists->propertyID;?>,<?=$data['projectID']?>)"  title="Delete" alt="Delete"><i class="fa fa-trash"></i></a>
									</td>
									<td><a href="<?=base_url();?>AddProject/floarPlanModel/<?=$unitpropertylists->propertyID;?>" data-toggle="modal" data-target=".bs-example-modal-lg" ><img src=" <?php   /*<-----onclick="temp();"*/
									  echo base_url(); 
									  echo 'images/floor.png"/></a></td>
									</tr>';
								   ?> 
									<!--<tr class="moreunits">
										<td colspan="6">
											<table id="myTable" class="table table-hover vert-aliins unit-sty">
												<tr>
													<?php  
														$attributeID=$this->AddProject_model->GetAminitiesDetail('rp_property_attribute_values',array('propertyID'=>$unitpropertylists->propertyID));//print_r($attributeID);//die;
														foreach($attributeID as $list)
														{
															if($list->attributeID!=='4' && $list->attributeID!=='1')
															{
																$attributeDetails=$this->AddProject_model->GetAttributeDeatilValueDetail($list->attributeID,$list->attrValueID);//print_r($attributeDetails);//die;
															
														?>
															<td><?=$attributeDetails[0]->attrName;?><span><?php echo $attributeDetails[0]->attrDetValue;?></span></td>
														<?php }  } ?> 
												</tr>
											</table>
										</td>
									</tr>-->
									<?php
									$i++;	
								}
								//$propertyImages=$this->AddProject_model->GetPropertyImageDetail($unitpropertylist[0]->propertyID,$this->data['LanguageId']); 
								?>
								  </tbody>
                            </table>
                            <!--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
								 
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Floor Plan</h4>
                                  </div>
                                  <div class="modal-body">
								  <div class="form-group col-xs-12 col-sm-12">
									<h4>Floor Plane view</h4>
								  </div>
								  <div class="form-group col-xs-12 col-sm-12">
									<form action="<?php echo base_url();?>AddProject/propertyImage" class="dropzone" style="border: 1px solid #e5e5e5;">
										<input type="hidden" name="propertyID" id="prop" value="<?php echo $unitpropertylist[0]->propertyID; //if(!empty($this->session->userdata('propertyID'))){ $tempvalue=$this->session->userdata('propertyID')+1; echo $tempvalue; } ?>" readonly  class=""/>
										<input type="hidden" name="floarplane" value="2" readonly />
									</form>
									<?php if(!empty($propertyImages[0]->propertyImageName)){ ?>
										<img src="<?=base_url();?>projectImages/<?=$ProjectFilterData[0]->projectElevationImage?>" width="100px" height="100px" />	
										<iframe src="<?=base_url();?>propertyImages/<?=$propertyImages[0]->propertyImageName;?>" style="border:0px; width:100%; height:430px;"></iframe>
									<?php } ?>
								  </div> 
                                  
                                  </div>
                                </div>
                              </div>
                            </div>-->
                          </div>
						 
                            <script>
							  $(document).ready(function(){
								  $(".more-uni-pri").click(function(){   <?php
								echo"	$('.moreunits').slideToggle();
									$('.fa-plus').toggleClass('fa-minus');
									  });";
									  
								echo'	  $(".more-uni-pri1").click(function(){';
								echo"	$('.moreunits1').slideToggle();
									
									  });
								  });
						  </script> 
                        </div>
                      </div>
                    </div>";
					//if(!empty($unitpropertylists->propertyID)){ $this->session->set_userdata('propertyID',$unitpropertylists->propertyID); }
					//if(!empty($unitpropertylists->propertyID)){ echo'#'.$unitpropertylists->propertyID; }
			}
			else
			{
				echo"Add Property Fail!!";
			}
	}
	
	/*.............................. Plan Consumption Model For Refresh Click............................... */
	function PlanConsumptionModel($id=false,$status=false,$IdentityVariable=false)
	{
		if($IdentityVariable=='Project')
		{
			$this->data['objectID']=$id;
			$this->data['PlaneType']=$IdentityVariable;
			$ProjectDetails=$this->AddProject_model->GetMultipleData('rp_projects',array('projectID'=>$id));
			$PlanDetails=$this->data['PlanDetails']=$this->AddProject_model->GetUserplan($ProjectDetails[0]->userID,$IdentityVariable);//print_r($PlanDetails);die;
		}
		else
		{	
			$this->data['objectID']=$id;
			$this->data['PlaneType']=$IdentityVariable;
			$PropertiesDetails=$this->AddProject_model->GetMultipleData('rp_properties',array('propertyID'=>$id));
			$PlanDetails=$this->data['PlanDetails']=$this->AddProject_model->GetUserplan($PropertiesDetails[0]->userID,$IdentityVariable);
		}
		$this->load->view('PlanConsumptionModel',$this->data); 
	}
	
	/*.............................. Floar Plan Image Model For Refresh Click............................... */
	function floarPlanModel($id=false)
	{
		$floarPlaneImages=$this->data['floarPlaneImages']=$this->AddProject_model->GetMultipleData('rp_property_images',array('propertyID'=>$id));//print_r($floarPlaneImages);die;
		$this->load->view('floarPlanModel',$this->data); 
	}
	
	function ProjectUnit()
	{
		if($this->input->post('propertyID'))
		{
			$propertytype=$this->data['propertytype']=$this->AddProject_model->getPropertyType();
			$projectUnitDetails=$this->AddProject_model->GetProjectUnitDetails($this->input->post('propertyID'),$this->data['LanguageId']);//print_r($projectUnitDetails);
			$projectUnitPrice=$this->AddProject_model->GetMultipleData('rp_property_price',array('propertyID'=>$this->input->post('propertyID')));
			$projectDetails=$this->AddProject_model->GetMultipleData('rp_properties',array('propertyID'=>$this->input->post('propertyID')));
			$propertyDetails=$this->AddProject_model->GetMultipleData('rp_property_details',array('propertyID'=>$this->input->post('propertyID')));
			//$projectBedroomDetailsUnit=$this->AddProject->GetBedroomDetailsUnit($this->input->post('propertyID'),$this->data['LanguageId']);print_r($projectBedroomDetailsUnit);die;
			?>
				<div class="col-md-12">
						   <form id="form-3" method="post" enctype="multipart/form-data">
								<input type="hidden" name="projectID" value="<?php if(!is_null($this->input->post('projectID'))){ echo $this->input->post('projectID'); }?>" readonly class="form1_id" />
								<input type="hidden" name="propertyID" value="<?php if(!is_null($this->input->post('propertyID'))){ echo $this->input->post('propertyID'); } ?>" readonly class="form1_id" />
								<input type="hidden" name="type" value="Unit" >
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label class="control-label" for="first-name">Property Type </label>  
								  <select name="propertyTypeID" class="form-control" id="propertydetailss" onchange="PropertyUnitName(); CheckPlotArea(this.value);" >
									<option value="">Select</option>
									<optgroup label="Residential Properties">
									 <?php foreach($propertytype as $propertytypes){ ?>
									<option value="<?=isset($propertytypes->propertyTypeID)?$propertytypes->propertyTypeID:''?>" <?php if(!empty($projectDetails[0]->propertyTypeID)){ if($projectDetails[0]->propertyTypeID==$propertytypes->propertyTypeID){ echo"selected";} } ?>><?=isset($propertytypes->propertyTypeName)?$propertytypes->propertyTypeName:''?></option> 
									<?php } ?>
									</optgroup>
								  </select>
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Area</label>
								  <input type="text" name="text-4" class="form-control" value="<?php if(isset($projectUnitDetails)){ echo $projectUnitDetails[0]->attrDetValue; }?>" id="size" onchange="PropertyUnitName(); CheckValidation(this.id);" >
								  <span class="sqft">sq/ft</span> 
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Price</label>
								  <input type="text" name="propertyPrice" class="form-control" onchange="CheckValidation(this.id);" value="<?php if(isset($projectUnitPrice)){ echo $projectUnitPrice[0]->propertyPrice; }?>" id="price">
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Property Name</label>
								  <input type="text" name="propertyName" class="form-control" value="<?php if(!empty($propertyDetails[0]->propertyName)){ echo $propertyDetails[0]->propertyName; } ?>" id="propertyName" readonly>
								</div>
								<div class="form-group">
								<!--<label class="control-label col-md-2 col-sm-2 col-xs-12">Floor Plan <span id="inputImagemes"  aria-hidden="true"></span></label>
								<div class="col-md-10 col-sm-10 col-xs-12">
								  <label class="btn btn-default btn-upload" for="inputImage" title="Upload image file">
											<input class="sr-only" id="inputImage" name="image" type="file" onchange="InsertPropertyproject()">
											
											  <span class="brous-bt" id="inputImagemes1">Brouse </span>
										   
								  </label>
								</div>-->
								
								
							<div class="row">
								<div class="form-group col-xs-12 col-sm-4 martop20">
								
								  <label class="control-label" for="first-name">Bed Rooms </label>
								  <select name="select-1" class="form-control" id="bedroom" onchange="PropertyUnitName();"  >
									<optgroup label="Select">
									<option value="">Select</option>
									<option value="1-1" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='1'){ echo 'selected'; }?> >1</option>
									<option value="2-2" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='2'){ echo 'selected'; }?> >2</option>
									<option value="3-3" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='3'){ echo 'selected'; }?> >3</option>
									<option value="4-4" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='4'){ echo 'selected'; }?> >4</option>
									<option value="5-5" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='5'){ echo 'selected'; }?> >5</option>
									<option value="21-6" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='6'){ echo 'selected'; }?> >6</option>
									<option value="461-7" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='7'){ echo 'selected'; }?> >7</option>
									<option value="462-8" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='8'){ echo 'selected'; }?> >8</option>
									<option value="463-9" <?php if(isset($projectUnitDetails[1]->attrDetValue)&&$projectUnitDetails[1]->attrDetValue=='9'){ echo 'selected'; }?> >9</option>
									</optgroup>
								  </select>
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
								  <label>
								   <input type="checkbox" name="isNegotiable" id="hobby1" value="Yes" class="flat" <?php if(!empty($projectDetails[0]->isNegotiable)&&$projectDetails[0]->isNegotiable=='Yes'){ echo 'checked'; }?> />  Is Negotiable
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
								  <label>
								  <input type="checkbox" name="priceOnReq" id="hobby1" value="Yes" class="flat" <?php if(!empty($projectDetails[0]->priceOnReq)&&$projectDetails[0]->priceOnReq=='Yes'){ echo 'checked'; }?> />  Price On Request
								</div>
						<!--	<div class="x_content"> 
								
								 start accordion
								<div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
								<div id="showattributes">
								</div>
								
								<!-- <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo33" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33">
									<h4 class="panel-title StepTitle">Amenities </h4>
									</a>
									<div id="collapseTwo33" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									  <div class="panel-body">
										<div class="form-group col-xs-12 col-sm-12 martop20">
										<?php $Attributeoption=$this->AddProject_model->GetAttributesoption(6);
										foreach($Attributeoption as $Attributeoptions){ 
										if(!empty($propertyid)){
										$getamenities=$this->AddProject_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>6,'attrOptionID'=>$Attributeoptions->attrOptionID));
										} ?>
										<span class="checkbozsty">
										<input type="checkbox" value="6-<?=$Attributeoptions->attrOptionID?>-<?=$Attributeoptions->attrOptName?>" <?php if(!empty($getamenities)){echo"checked";} ?> name="Amenities[]">
										<?=$Attributeoptions->attrOptName?></span>
										<?php } ?>
										</div>
									</div>
								  </div>
								</div>
								 end of accordion  
								
							    </div>-->
							</div>
							<div class="row">
							  <div class="col-md-12">
								<button type="button" class="btn btn-success" onclick="InsertPropertyproject();">Update Unit</button>
								<button type="button" class="btn btn-success" onclick="projectUnitInsert(<?=$this->input->post('projectID');?>);">Create New Unit</button>
							  </div>
							</div>
							 </div>
						</form>
					</div>
                    </div>
					 
			<?php
		}
	}
	
	/*................................Comment For Function Details .............................................*/
	function ProjectDeleteUnit()
	{
		if(!is_null($this->input->post('propertyID')))
		{
			$this->AddProject_model->ProjectUnitDelete($this->input->post('propertyID'),$this->input->post('projectID'));
			$unitpropertylist=$this->AddProject_model->Getunitdetails($this->input->post('projectID'));
			?>
			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
						 -</div>
						<div class="modal-body">
						</div>
					
					</div>
                </div>
            </div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h4 class="panel-title StepTitle">Unit List</h4>
				<div class="x_panel">
					<div class="x_content">
						<!--<div class="pull-right filter-con">
							<label>Filter by</label>
							<select>
								<option>Property Type</option>
								<option>Villa</option>
							</select>
							<select>
								<option>BHK</option>
								<option>2BHK</option>
							</select>
						</div>-->
						<table id="myTable" class="table table-bordered table-hover vert-aliins">
							<thead>
								<tr>
									<th>BHK</th>
									<th>Area Sq.Ft</th>
									<th>Price/Sq.Ft</th>
									<th>Price</th>
									<th>Action</th>
									<th>Floor Plan</th>
								 </tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach($unitpropertylist as $unitpropertylists)
								{
										$filter=array('propertyID'=>$unitpropertylists->propertyID);
										$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter); 
										$coveredarea=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$unitpropertylists->propertyID,'attributeID'=>4));
										$bedroomno=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$unitpropertylists->propertyID,'attributeID'=>1));//print_r();
										if(!empty($getpropertyprice[0]->propertyPrice) && !empty($coveredarea[0]->attrDetValue))
										{
												$propertyprice=$getpropertyprice[0]->propertyPrice;
												$propertysize=$coveredarea[0]->attrDetValue;
												$propertypricepersqr=$propertyprice/$propertysize;
										}
										
									echo'	<tr>
									  <td>';
									  if(!empty($bedroomno)){
									  echo $bedroomno[0]->attrDetValue;echo"BHK";}
									  echo'</td>
									  <td>';
									  echo $propertysize;
									  echo'Sq.Ft</td>
									  <td><i class="fa fa-rupee"></i>';
									  echo $propertypricepersqr;
										//echo $propertyprice;
									echo'  </td>
									  <td><i class="fa fa-rupee"></i>';
									  //echo $propertypricepersqr;
									  echo $propertyprice;
									?>  </td>
									<td>
										 <a href="javascript:void(0)" onclick="projectUnit(<?=$unitpropertylists->propertyID;?>,<?=$this->input->post('projectID');?>);"  title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
										  <a href="javascript:void(0)" onclick="ProjectDeleteUnit(<?=$unitpropertylists->propertyID;?>,<?=$this->input->post('projectID');?>)"  title="Delete" alt="Delete"><i class="fa fa-trash"></i></a>
									</td>
									  <td><a href="<?=base_url();?>AddProject/floarPlanModel/<?=$unitpropertylists->propertyID;?>" data-toggle="modal" data-target=".bs-example-modal-lg" ><img src=" <?php   /*<-----onclick="temp();"*/
									  echo base_url(); 
									  echo 'images/floor.png"/></a></td>
									</tr>';
									$i++;	
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
            </div>
		</div>
		<?php
		}
	}
	
	function ProjectUnitInsert()
	{
		if($this->input->post('projectID'))
		{
			$propertytype=$this->data['propertytype']=$this->AddProject_model->getPropertyType();
			//$propertytype=$this->data['ProjectType']=$this->AddProject_model->GetMultipleData('rp_property_types',array('typeName'=>'Property','propertyTypeStatus'=>'Active'));
			//$projectUnitDetails=$this->AddProject_model->GetProjectUnitDetails($this->input->post('propertyID'),$this->data['LanguageId']);
			//$projectUnitPrice=$this->AddProject_model->GetMultipleData('rp_property_price',array('propertyID'=>$this->input->post('propertyID')));
			$projectDetails=$this->AddProject_model->GetMultipleData('rp_properties',array('propertyID'=>$this->input->post('propertyID')));
			$propertyDetails=$this->AddProject_model->GetMultipleData('rp_property_details',array('propertyID'=>$this->input->post('propertyID')));
			?>
				<div class="col-md-12">
						   <form id="form-3" method="post" enctype="multipart/form-data">
								<input type="hidden" name="projectID" value="<?php if(!is_null($this->input->post('projectID'))){ echo $this->input->post('projectID'); }?>" readonly class="form1_id" />
								<input type="hidden" name="type" value="Unit" >
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label class="control-label" for="first-name">Property Type </label>
								  <select name="propertyTypeID" class="form-control" id="propertydetailss" onchange="CheckPlotArea(this.value);" >
									<option value="">Select</option>
									<optgroup label="Residential Properties">
									 <?php foreach($propertytype as $propertytypes){ ?>
									<option value="<?=isset($propertytypes->propertyTypeID)?$propertytypes->propertyTypeID:''?>" <?php if(!empty($projectDetails[0]->propertyTypeID)){ if($projectDetails[0]->propertyTypeID==$propertytypes->propertyTypeID){ echo"selected";} } ?>><?=isset($propertytypes->propertyTypeName)?$propertytypes->propertyTypeName:''?></option> 
									<?php } ?>
									</optgroup>
								  </select>
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Area</label>
								  <input type="text" name="text-4" class="form-control" value="" id="size" onchange="PropertyUnitName(); CheckValidation(this.id);" >
								  <span class="sqft">sq/ft</span> 
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Price</label>
								  <input type="text" name="propertyPrice" class="form-control" onchange="CheckValidation(this.id);" value="" id="price">
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20 ">
								  <label for="last-name" class="control-label">Property Name</label>
								  <input type="text" name="propertyName" class="form-control" value="<?php if(!empty($propertyDetails[0]->propertyName)){ echo $propertyDetails[0]->propertyName; } ?>" id="propertyName" readonly >
								</div>
								<div class="form-group">
								<div class="row">
								<div class="form-group col-xs-12 col-sm-4 martop20">
								
								  <label class="control-label" for="first-name">Bed Rooms </label>
								  <select name="select-1" class="form-control" id="bedroom" onchange="PropertyUnitName();" >
									<optgroup label="Select">
									<option value="">Select</option>
									<option value="1-1" >1</option>
									<option value="2-2" >2</option>
									<option value="3-3" >3</option>
									<option value="4-4" >4</option>
									<option value="5-5" >5</option>
									<option value="21-6" >6</option>
									<option value="461-7" >7</option>
									<option value="462-8" >8</option>
									<option value="463-9" >9</option>
									</optgroup>
								  </select>
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
								  <label>
								   <input type="checkbox" name="isNegotiable" id="hobby1" value="Yes" class="flat"  />  Is Negotiable
								</div>
								<div class="form-group col-xs-12 col-sm-4 martop20">
								  <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
								  <label>
								  <input type="checkbox" name="priceOnReq" id="hobby1" value="Yes" class="flat"  />   Price On Request
								</div>
								
						<!--	<div class="x_content"> 
								
								 start accordion
								<div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
								<div id="showattributes">
								</div>
								
								<!-- <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo33" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33">
									<h4 class="panel-title StepTitle">Amenities </h4>
									</a>
									<div id="collapseTwo33" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									  <div class="panel-body">
										<div class="form-group col-xs-12 col-sm-12 martop20">
										<?php $Attributeoption=$this->AddProject_model->GetAttributesoption(6);
										foreach($Attributeoption as $Attributeoptions){ 
										if(!empty($propertyid)){
										$getamenities=$this->AddProject_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>6,'attrOptionID'=>$Attributeoptions->attrOptionID));
										} ?>
										<span class="checkbozsty">
										<input type="checkbox" value="6-<?=$Attributeoptions->attrOptionID?>-<?=$Attributeoptions->attrOptName?>" <?php if(!empty($getamenities)){echo"checked";} ?> name="Amenities[]">
										<?=$Attributeoptions->attrOptName?></span>
										<?php } ?>
										</div>
									</div>
								  </div>
								</div>
								 end of accordion  
								
							    </div>-->
							</div>
							<div class="row">
							  <div class="col-md-12">
								<button type="button" class="btn btn-success" onclick="InsertPropertyproject();">Insert</button>
							  </div>
							</div>
							 </div>
						</form>
					</div>
                    </div>
			
			<?php
		}
	}
	
	public function floarPlanImage()
	{
		//error_reporting(1);
		$propertyID=$this->input->post('propertyID');
		$imagecategory=$this->input->post('imagecategory');
		//$propertyImageTitle=$this->input->post('propertyImageTitle');
		if(!empty($propertyID) && !empty($imagecategory))
		{
			
			if($_FILES['file']['name']!='')
			{
				$data['image_z1']= $_FILES['file']['name'];
				$image=sha1($_FILES['file']['name']).time().rand(0, 9);
				
					if(!empty($_FILES['file']['name']))
					{
						$config =  array(
							'upload_path'	  => '../public/uploads/property/images/thumb/',
							'file_name'       => $image,
							'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
							'overwrite'       => true);
							$this->upload->initialize($config);
							$this->load->library('upload');
							$this->upload->do_upload("file");
						$config =  array(
							'upload_path'	  => '../public/uploads/property/images/lightbox/',
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
									$floarPlaneImages=$this->AddProject_model->GetMultipleData('rp_property_images',array('propertyID'=>$propertyID));//print_r($floarPlaneImages);
									if(count($floarPlaneImages>0))
									{
										$propertyImageID=$this->AddProject_model->InsertProject('rp_property_images',$data,array('propertyID'=>$propertyID));
										$data1=array('propertyImageTitle'=>'Floar Plan','propertyImageAltTag'=>'Floar Plan');
										$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
										foreach($CheckLanguageDetail as $list)
										{
											$data1['languageID']= $list->languageID;
											$this->AddProject_model->InsertProject('rp_property_image_details',$data1,array('propertyImageID'=>$floarPlaneImages[0]->propertyImageID));
										}
									}
									if(count($floarPlaneImages<0))
									{
										$propertyImageID=$this->AddProject_model->InsertProject('rp_property_images',$data); 
										$data1=array('propertyImageID'=>$propertyImageID,'propertyImageTitle'=>'Floar Plan','propertyImageAltTag'=>'Floar Plan');
										$CheckLanguageDetail=$this->AddProject_model->GetMultipleData('rp_languages',array('languageStatus'=>'Active'));
										foreach($CheckLanguageDetail as $list)
										{
											$data1['languageID']= $list->languageID;
											$this->AddProject_model->InsertProject('rp_property_image_details',$data1); 
										}
									}
									
								}else
								{
										echo $this->upload->display_errors()."file upload failed";
								}
					}
			}
		
		}
	}
	function ProjectFinish()
	{
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', $this->config->item("projectList").' Project Added successfully');
		redirect('AddProject/ProjectList');
	}
	
	/*................................................. Start Function For Image Edit .............................................*/
	function editImageTag(){
		$imageID = $this->input->post('imageID');
		$imagetagText = $this->input->post('imagetagText');
		$imagetagText1 = $this->input->post('imagetagText1');
		echo $responce=$this->AddProject_model->editImageTag($imageID,$imagetagText,$imagetagText1);
		exit;
	}
	/*.................................................. End Function For Edit Image Tag ..............................................*/
	
	
	function DeleteProjectImage()
	{	
		$projectID=$this->input->post('projectID');
		if(!empty($projectID))
		{
			$this->AddProject_model->InsertProject('rp_projects',array($this->input->post('divid')=>''),array('projectID'=>$this->input->post('projectID')));
			echo 'Image Delete Successfully!!';
		}
		else
		{
				echo"Image Deletion Fail!!";
		}
	}
	
	function DeleteProjectGalery()
	{	
		$projectID=$this->input->post('projectID');
		if(!empty($projectID))
		{
			$this->AddProject_model->DeleteProjectGalery($projectID);
			echo "Image Delete Successfully!!";
		}
		else
		{
				echo"Image Deletion Fail!!";
		}
	}
	
	function DeleteProjectVideo()
	{	
		$projectVideoID=$this->input->post('projectVideoID');
		if(!empty($projectVideoID))
		{
			$this->AddProject_model->DeleteProjectVideo($projectVideoID);
			echo "Video Delete Successfully!!";
		}
		else
		{
				echo"Video Deletion Fail!!";
		}
	}
	
	function ProjectCoverImage() 
	{	
		$projectID=$this->input->post('projectID'); 
		$projectImageID=$this->input->post('projectImageID');	
		if(!empty($projectID))
		{
			$ProjectCoverImage=$this->AddProject_model->GetMultipleData('rp_project_images',array('isCoverImage'=>'Yes','projectID'=>$projectID));//print_r($ProjectCoverImage);die;
			if(count($ProjectCoverImage>0))
			{
				$this->AddProject_model->InsertProject('rp_project_images',array('isCoverImage'=>'No'),array('projectImageID'=>$ProjectCoverImage[0]->projectImageID));
				$this->AddProject_model->InsertProject('rp_project_images',array('isCoverImage'=>'Yes'),array('projectImageID'=>$projectImageID));
			}
			$this->AddProject_model->InsertProject('rp_project_images',array('isCoverImage'=>'Yes'),array('projectImageID'=>$projectImageID));
			echo 'Cover Image Set Successfully';
		}
		else
		{
				echo "Cover Image Not Set !!";
		}
	}
	
	/***************************************************Google Api For Nearest Place End**********************************************************/
	
	
	public function getprojectimagesafterupload()
	{
		$projectID = $this->input->post('projectID');
		$baseurl=base_url().'assests/images/cover.png';
		$projectImages=$this->AddProject_model->GetProjectImageDetail($projectID,1);
		if(!empty($projectImages)){
			
		//start....................
		
		?>
		 <style>
			.cover-img {position:absolute; top:0; left:0; z-index:999; width:90px;}
			.cover-img img {max-width:100%;}
		</style>
		 <div class="x_content">
			<div class="row">
				<?php $i=1; foreach($projectImages as $ProjectImages){ ?>
				<div class="col-md-55 imagediv_<?=$i?>" id="imagediv_<?=$i?>">
					<div class="thumbnail" style="height: 256px;">
						<div class="image view view-first" style="relative">
							<?php if($ProjectImages->isCoverImage=="Yes"){ ?>
							<div class="cover-img" id="firsttimeimg_<?php echo $ProjectImages->projectImageID?>"><img src="<?php echo base_url()?>assests/images/cover.png"/></div>
							<?php } ?>
							<div class="cover-img" id="ajaxtimeimg_<?php echo $ProjectImages->projectImageID?>" style="display:none;"><img src="<?php echo base_url()?>assests/images/cover.png"/></div>
							<img style="width: 100%; display: block;" src="http://staging.homeonline.com/public/uploads/project/images/thumb/<?=isset($ProjectImages->projectImageName)?$ProjectImages->projectImageName:''?>" alt="image" />
							<div class="mask">
								<div class="tools tools-bottom">
									<!--return confirm('Are you sure to delete this image? ');-->
									<a href="javascript:;" onClick="DeleteProjectGalery(<?=$ProjectImages->projectImageID?>,'imagediv_<?=$i?>');"><i class="fa fa-times"></i></a> 
									<a href="javascript:;" onClick="ProjectCoverImage(<?=$ProjectImages->projectID?>,<?=$ProjectImages->projectImageID?>);"><i class="glyphicon glyphicon-cog" title="Set Cover Image"></i></a> 
								</div>
							</div>
						</div>
						<div class="caption"> 
							<p><span id="textspan_<?php echo $ProjectImages->projectImageID?>"><?php echo $ProjectImages->projectImageTitle;?></span><span id="newtextspan_<?php echo $ProjectImages->projectImageID?>"> </span><a href="javascript:void(0);" onclick="return ProjectImageName(<?php echo $ProjectImages->projectImageID?>)"><i class="fa fa-edit"></i></a></p>
							<p><span id="textspan1_<?php echo $ProjectImages->projectImageID?>">Priority- <?php echo $ProjectImages->projectImagePriority;?></span><span id="newtextspan1_<?php echo $ProjectImages->projectImageID?>"> </span><a href="javascript:void(0);" onclick="return ProjectImagePriority(<?php echo $ProjectImages->projectImageID?>)"><i class="fa fa-edit"></i></a></p>
							<div class="form-group editmode" style="display:none;" id="ajaxeditimg_<?php echo $ProjectImages->projectImageID?>">											
								<input type="text" class="form-control" value="<?php echo $ProjectImages->projectImageTitle;?>" id="imgtagedit_<?php echo $ProjectImages->projectImageID;?>">
								<button type="button" class="btn btn-primary" onclick="return ProjectImageEdit(<?php echo $ProjectImages->projectImageID?>);">Edit</button>
								<button type="button" class="btn btn-primary imgtagclose">Close</button>
							</div>
							<div class="form-group editmode" style="display:none;" id="ajaxeditimg1_<?php echo $ProjectImages->projectImageID?>">											
								<input type="text" class="form-control" value="<?php echo $ProjectImages->projectImagePriority;?>" id="imgtagedit1_<?php echo $ProjectImages->projectImageID;?>">
								<button type="button" class="btn btn-primary" onclick="return ProjectImageEdit(<?php echo $ProjectImages->projectImageID?>);">Edit</button>
								<button type="button" class="btn btn-primary imgtagclose">Close</button>
							</div>
						</div>
					</div>
				</div>
				<?php $i++; }  ?>
			</div>
		</div>
		<?php
                                  
		
		//End......................
		
		}
	}
	/*function Pagination()
	{
		$offset=$this->input->post('offset');
		$limit=$this->input->post('limit');
		//$query='';
		$ProjectLogFilterData=$this->data['ProjectLogFilterData']=$this->AddProject_model->paination($offset,$limit);
		?>
				<?php foreach( $ProjectLogFilterData as $list ){
				?>
				<tr>
					<td><?=isset($list->projectKey)?$list->projectKey:''?></td>
					<td><?=isset($list->projectName)?$list->projectName:''?></td>
					<td><?=isset($list->adminUserEmail)?$list->adminUserEmail:''?></td>
					<td><?=isset($list->planTitle)?$list->planTitle:''?></td>
					<td><?=isset($list->DateTime)?$list->DateTime:''?></td>
					<td><?=isset($list->Action)?$list->Action:''?></td>
				 <?php } ?>
				</tr>
		<?php
	}*/
	
}
				