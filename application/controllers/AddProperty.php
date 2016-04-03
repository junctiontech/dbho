<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProperty extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('Appointment_model');
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
		$this->languages=$this->AddProperty_model->getlanguage();
		$this->currencies=$this->AddProperty_model->getcurrency();
		$this->severname=$this->data['severname']=$_SERVER['HTTP_HOST'];
		
	}
	
// AddProperty Started Here.................................................................................................................

/*AddProperty view Load Start.............................................................................................................*/
	function index($propertyid=false)
	{
		
		if(!empty($propertyid))
			{
				$this->data['countdata']=0;
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
								if(!empty($userdetails)){
								$this->data['usertypeid']=$usertypeid=$userdetails[0]->userTypeID;
								$usertypedetails=$this->AddProperty_model->get_user_type(" and rp_user_types.userTypeID=$usertypeid");
								$this->data['useremail']=$userdetails[0]->userEmail;
								$this->data['usertype']=$usertypedetails[0]->userTypeName;}
					}
					
					$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter);
					if(!empty($getpropertyprice[0]->propertyPrice))
					{
						$this->data['propertyprice']=$getpropertyprice[0]->propertyPrice;}else{$propertyprice="Not Mentioned";
					}
					
					if(!empty($propertytabledetails[0]->isNegotiable))
					{
						$this->data['isNegotiable']=$propertytabledetails[0]->isNegotiable;
					}
					
					if(!empty($propertytabledetails[0]->propertyStatus))
					{
						$this->data['propertyStatus']=$propertytabledetails[0]->propertyStatus;
						
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
					
					if(!empty($propertytabledetails[0]->propertyAddress2))
					{
						$this->data['propertyAddress2']=$propertytabledetails[0]->propertyAddress2;
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
					if(!empty($propertytabledetails[0]->countryID)){$filter=array('countryID'=>$propertytabledetails[0]->countryID,'languageID'=>'1');$key='countryName';$countryname=$this->AddProperty_model->getcountryname('rp_country_details',$filter,$key);$this->data['countryname']=$countryname[0]->countryName;}
					if(!empty($propertytabledetails[0]->stateID)){ $filter1=array('stateID'=>$propertytabledetails[0]->stateID,'languageID'=>'1');$key='stateName';$statename=$this->AddProperty_model->getcountryname('rp_state_details',$filter1,$key); $this->data['statename']=$statename[0]->stateName;}
					if(!empty($propertytabledetails[0]->cityID)){ $filter2=array('cityID'=>$propertytabledetails[0]->cityID,'languageID'=>'1');$key='cityName';$cityname=$this->AddProperty_model->getcountryname('rp_city_details',$filter2,$key); $this->data['cityname']=$cityname[0]->cityName;}
					
					$this->data['propertyimages']=$this->AddProperty_model->Getpropertyimages($propertyid);
					
					$this->data['coveredarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>94));
					$this->data['plotarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>2));
					$this->data['carpetarea']=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>67));
                     
                   // print_r($this->data['propertyimages']);die;
					
					/*$getamenities=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>6,'attrOptionID'=>$Attributeoptions->attrOptionID));
                     
					if(!empty($getamenities)){echo"<p>YES </p>";}else{echo"<p>NO</p>";}
                          
                    /* $getroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')));
                     
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
			$userid=$this->input->post('usertypeID');
			if(!empty($userid))
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
			$userid=$this->input->post('userID');
			$propertyID=$this->input->post('PropertyID');
			if(!empty($userid))
			{
					$userplan=$this->AddProperty_model->GetUserplan($this->input->post('userID'));
					
					if(!empty($userplan)){
						echo"<option value=''>Select User</option>";
						foreach($userplan as $userplans){
							?><option value="<?=$userplans->planID?>" <?php if(!empty($propertyID)){ $PlaneDetail=$this->AddProperty_model->Getotherdata('rp_dbho_plan_mapping',array('objectID'=>$propertyID,'objectType'=>'property')); if(!empty($PlaneDetail[0]->planID)){if($PlaneDetail[0]->planID==$userplans->planID){ echo 'selected'; } }} ?>><?=$userplans->planTitle;?></option>
							
						<?php }
						
					}else{
						echo"<option value=''>No Plan Found!</option>";
					}
			}else{
				
			}
		
	}
/*AddProperty Get UserPlan End.............................................................................................................*/


/*AddProperty Get Attributes Start.............................................................................................................*/
	function Getattributes($propertyid=false)
	{		
			$propertytypeid=$this->input->post('propertytypeid');
			
			$propertypriceval='';
			$showno='';$showyes='';$showcall='';$passiondate='';$undercons='';$ready='';$upcoming='';$datedisplaynone='style="display:none"';$year='';$month='';$day='';
			$purpose='';$datecss='';$availablecss='';
			if(!empty($propertyid))
								{
								$propertyalldetails=$this->AddProperty_model->Getotherdata('rp_properties',array('propertyID'=>$propertyid));
								if(!empty($propertyalldetails)){
								$isNegotiable=$propertyalldetails[0]->isNegotiable;
								$priceOnReq=$propertyalldetails[0]->priceOnReq;
								$purpose=$propertyalldetails[0]->propertyPurpose;
								if($priceOnReq=='Yes'){
									$showcall='checked';
								}elseif($isNegotiable=='Yes'){
									$showyes='checked';
								}else{
									$showno='checked';
								}
								}
								$currentstatus=$propertyalldetails[0]->propertyCurrentStatus;
								$passiondate=$propertyalldetails[0]->possessionDate;
								
								if(!empty($passiondate)){
									$passiondate=explode(",",$passiondate);
									if(!empty($passiondate[1])){ $year=$passiondate[1]; }
									if(!empty($passiondate[0])){ $month=$passiondate[0]; }
									//if(!empty($passiondate[2])){ $day=$passiondate[2]; }
									
								}
								
								if($currentstatus=='Under Construction'){
									$undercons="checked";
								}elseif($currentstatus=='Ready to move'){
									$ready="checked";
								}elseif($currentstatus=='Upcoming'){
									$upcoming="checked";
								}
								
								if($currentstatus=='Upcoming' || $currentstatus=='Under Construction'){
									$datedisplaynone='style="display:block"';
									if($currentstatus=='Upcoming'){ $datecss='style="display:block"'; $availablecss='style="display:none"'; }elseif($currentstatus=='Under Construction'){ $availablecss='style="display:block"'; $datecss='style="display:none"';}
								}
								
								}
			
			if(!empty($propertytypeid))
			{
				$AttributesGroup=$this->AddProperty_model->Getattributesgroups($this->input->post('propertytypeid'));
					
					if(!empty($AttributesGroup)){
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							if($AttributesGroups->name !='FLOORING TYPE' && $AttributesGroups->name !='FURNISHING'){
							$pricegroupattri='';
							//$labelclassforprice='';
							$groupclassforprice='';
							$negotiable='';
							$transactiontypegroupattri='';
/* ............................price and other charges part start.................................................... */
							if($AttributesGroups->name=='PRICE &amp; OTHER CHARGES'){
								if(!empty($propertyid))
								{
								$propertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',array('propertyID'=>$propertyid));
								if(!empty($propertyprice)){
								$propertypriceval=$propertyprice[0]->propertyPrice;
								}
								}
								$pricegroupattri="<div class=\"form-group clearfix col-xs-12 col-sm-4\">
                                      <label class=\"control-label  expectedpricesellrent\">Expected Price <i class=\"fa fa-rupee text-right\"></i></label>
                                      
                                      
                                      
                                        <input id=\"expectedprice\" class=\"form-control \" placeholder=\"Enter Total Price\" value=\"$propertypriceval\"
										 type=\"text\" name=\"propertyPrice\" onchange=\"calculatepersqreft()\">
                                      
                                    </div>
                                    <div class=\"form-group clearfix col-xs-12 col-sm-4 disablesell\">
                                      <label class=\"control-label \">Price per Sq-ft <i class=\"fa fa-rupee text-right\"></i></label>
                                     
                                        <input readonly id=\"pricepersqrft\" class=\"form-control\" type=\"text\" name=\"pricepersqft\" value=\"\">
                                     
                                    </div>";

									$negotiable="<div class=\"form-group clearfix col-xs-12 col-sm-4\">
                                      <label class=\"control-label  price_as\">Show Price As<i class=\"fa fa-rupee text-right\"></i></label>
                                      
                                        <div class=\"radio mabott10\">
                                          <label>
                                            <input type=\"radio\" class=\"flat\" $showno  name=\"showpriceas\" >
                                            <span class=\"showpriceas\">$propertypriceval</span> <i class=\"fa fa-rupee text-right\"></i> </label>
                                          <label>
                                            <input type=\"radio\" class=\"flat\" $showyes name=\"showpriceas\" value=\"Yes\" >
                                            <span class=\"showpriceas\">$propertypriceval</span> <i class=\"fa fa-rupee text-right\"></i> Negotiable </label>
                                          <label>
                                            <input type=\"radio\" class=\"flat\" $showcall name=\"showpriceas\">
                                            Call For Price </label>
                                        </div>
                                      
                                    </div>";
									
									//$labelclassforprice='expectedpricesellrent';
									$groupclassforprice='class="slowlabelheading"';
								}
/* ............................price and other charges part end.................................................... */
 
/* ............................Transaction Type, Property Availability part start.................................................... */								
								if($AttributesGroups->name=='TRANSACTION TYPE, PROPERTY AVAILABILITY'){
								$datefordropdown='';
								
								$cutoff = date('Y')+35;
								// current year
								$now = date('Y');
								// build years menu
								$datefordropdown.= '<select name="year">' . PHP_EOL;
								$datefordropdown.= '  <option value=""  >Year</option>' . PHP_EOL;
								for ($y=$now; $cutoff>=$y; $y++) {
									$selectyear='';
									if($y==$year){ $selectyear='selected';}
									$datefordropdown.= '  <option value="' . $y . '" '.$selectyear.'>' . $y . '</option>' . PHP_EOL;
								}
								$datefordropdown.= '</select>' . PHP_EOL;
								// build months menu
								$datefordropdown.= '<select name="month">' . PHP_EOL;
								$datefordropdown.= '  <option value=""  >Month</option>' . PHP_EOL;
								for ($m=1; $m<=12; $m++) {
									$selectmonth='';
									if(date('F', mktime(0,0,0,$m))==$month){ $selectmonth='selected';}
									$datefordropdown.= '  <option value="' . date('F', mktime(0,0,0,$m)) . '"  '.$selectmonth.'>' . date('F', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
								}
								$datefordropdown.= '</select>' . PHP_EOL;
								// build days menu
								/* $datefordropdown.= '<select name="day">' . PHP_EOL;
								$datefordropdown.= '  <option value=""  >Day</option>' . PHP_EOL;
								for ($d=1; $d<=31; $d++) {
									$selectday='';
									if($d==$day){ $selectday='selected';}
									$datefordropdown.= '  <option value="' . $d . '"  '.$selectday.'>' . $d . '</option>' . PHP_EOL;
								}
								$datefordropdown.= '</select>' . PHP_EOL;
	  */
								$transactiontypegroupattri=" <div class=\"form-group clearfix col-xs-12 col-sm-4 disablesell\">
                                      <label class=\"control-label  \">Possession Status</label>
                                      
                                        <div class=\"radio mabott10\">
                                          <label >
                                            <input type=\"radio\" $undercons  id=\"underconstruction\" class=\"flat\" name=\"currentstatus\" value=\"Under Construction\">
                                            Under Construction </label>
                                          <label >
                                            <input type=\"radio\"  id=\"readytomove\" $ready class=\"flat\"  name=\"currentstatus\" value=\"Ready to move\">
                                            Ready To Move </label>
                                        
                                      </div>
                                    </div>
									
									<div class=\"form-group clearfix disablerent\" >
                                      <label class=\"control-label col-md-2 col-sm-2 col-xs-12 \">Available From</label>
                                      <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                        <div class=\"radio mabott10\">
                                          <label >
                                            <input type=\"radio\"  id=\"selectdate\" $upcoming value=\"Upcoming\" class=\"flat\" name=\"currentstatus\">
                                            Select Date </label>
                                          <label >
                                            <input type=\"radio\"  id=\"immediately\" $ready value=\"Ready to move\" class=\"flat\" name=\"currentstatus\">
                                            Immediately </label>
                                        </div>
                                      </div>
                                    </div>
									
									
									
									
									<div class=\"form-group clearfix calndr\" $datedisplaynone>
                                      <label class=\"control-label col-md-2 col-sm-2 col-xs-12 martop10\">Date</label>
                                      
									  $datefordropdown
									  
                                    </div>
									
									
									
									
									
			<script type=\"text/javascript\">
				$(document).ready(function () {
					
					$('#single_cal2').daterangepicker({
						singleDatePicker: true,
						calender_style: \"picker_2\"
					}, function (start, end, label) {
						console.log(start.toISOString(), end.toISOString(), label);
					});
					
					$(\"#underconstruction\").click(function() {
							$(\"#loader\").fadeIn();
							$(\".calndr\").css(\"display\",\"block\");
							$(\".dateshow\").css(\"display\",\"none\");
							$(\".available\").css(\"display\",\"block\");
							$(\".ageofconstruction\").css(\"display\",\"none\");
							$(\"#loader\").fadeOut();
						});
						
						$(\"#readytomove\").click(function() {
							$(\"#loader\").fadeIn();
							$(\".ageofconstruction\").css(\"display\",\"block\");
							$(\".dateshow\").css(\"display\",\"none\");
							$(\".calndr\").css(\"display\",\"none\");
							$(\".available\").css(\"display\",\"none\");
							$(\"#loader\").fadeOut();
						});
						
						$(\"#selectdate\").click(function() {
							$(\"#loader\").fadeIn();
							$(\".calndr\").css(\"display\",\"block\");
							$(\".available\").css(\"display\",\"none\");
							$(\".dateshow\").css(\"display\",\"block\");
							$(\".ageofconstruction\").css(\"display\",\"block\");
							$(\"#loader\").fadeOut();
							
						});
						
						$(\"#immediately\").click(function() {
							$(\"#loader\").fadeIn();
							$(\".calndr\").css(\"display\",\"none\");
							$(\".available\").css(\"display\",\"none\");
							$(\".dateshow\").css(\"display\",\"none\");
							$(\".ageofconstruction\").css(\"display\",\"block\");
							$(\"#loader\").fadeOut();
						});
					 
				});
				
				
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
			</script> 
									
                                    
                                    </div>";
								
							
									
									
									//$labelclassforprice='expectedpricesellrent';
									//$groupclassforprice='class="slowlabelheading"';
								}
/* ............................Transaction Type, Property Availability part End.................................................... */
					$css='';
							echo"<div class=\"panel\" > <a class=\"panel-heading\" role=\"tab\" id=\"headingOneA$atti\" data-toggle=\"collapse\" data-parent=\"#accordion1\" href=\"#collapseOneA$atti\" aria-expanded=\"false\" aria-controls=\"collapseOneA$atti\">";
                              echo"<h4 class=\"panel-title StepTitle\"><span $groupclassforprice>$AttributesGroups->name</span></h4>";
								echo"</a>";
									echo"<div id=\"collapseOneA$atti\" class=\"panel-collapse collapse \" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
										echo"<div class=\"panel-body black-filed\">";
										
											$Attribute=$this->AddProperty_model->GetAttributes($AttributesGroups->attributeGroupID);
											if(!empty($Attribute))
											{
												$not=0;
												echo $negotiable;
												echo $pricegroupattri;
												foreach($Attribute as $Attributes)
												{
													if($Attributes->attrName !="Amenities")
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if(!empty($propertyid))
													{
													$checkattri=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attributes->attributeID));
													}
													
													if(strcmp($Attributes->attributeKey,"food-preferences")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"pets-allowed")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"lease-type")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"price-includes")==0){  $class='disablesell';
													}elseif(strcmp($Attributes->attributeKey,"booking-amount")==0){  $class='disablesell';
													}elseif(strcmp($Attributes->attributeKey,"other-charges")==0){  $class='disablesell';
													}elseif(strcmp($Attributes->attributeKey,"security-deposit")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"security-negotiable")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"brokerage")==0){  $class='disablerent';
													}elseif(strcmp($Attributes->attributeKey,"age-of-construction")==0){  $class='ageofconstruction'; if($purpose=="Rent"){ }elseif($purpose=="Sell"){ if($currentstatus=='Ready to move'){}else{$css='style="display:none"';}}else{$css='style="display:none"';}
													}elseif(strcmp($Attributes->attributeKey,"sale-status")==0){  $class='disablesell'; }else{ $class='r';}

													
													
													///Dropdown start...................................................
													if($Attributes->attrInputType=="select"){

													

													  echo"<div class=\"form-group col-xs-12 col-sm-4   $class\"  $css>";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														if($Attributes->attributeKey=="bed-rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}
														
														echo"<select  name=\"select-$Attributes->attributeID\" class=\"form-control\" $call $id>";
														  echo"<optgroup label=\"Select\">";
														  echo"<option value=\"\">select</option>";
														  foreach($Attributeoption as $Attributeoptions){
														  echo"<option value=\"$Attributeoptions->attrOptionID#$Attributeoptions->attrOptName\"";
														  if(!empty($checkattri[0]->attrOptionID)){ if($checkattri[0]->attrOptionID==$Attributeoptions->attrOptionID){ echo"selected";}}
														 echo" >$Attributeoptions->attrOptName</option>";
														  }
														  echo"</optgroup>";
														echo"</select>";
													  echo"</div>";
													 
													  
													}
													
													///////////////textbox type................
													if($Attributes->attrInputType=="textbox"){
														
														
													
														if($Attributes->attributeKey=="built-up-area")
														{
														if($not ==0){
														$other=''; $call="onchange='generatenameproperty();'"; $id="id='coveredarea'";
														$not++;}
														}elseif($Attributes->attributeKey=="plot-area"){
														if($not ==0){
														$other=''; $call="onchange='generatenameproperty();'"; $id="id='coveredarea'";
														$not++;}
														}
														elseif($Attributes->attributeKey=="expected-price"){ $other=''; $call="onchange='calculatepersqreft();'"; $id="id='expectedprice'";}
														elseif($Attributes->attributeKey=="price-per-sq-ft"){ $other='readonly'; $call=""; $id="id='pricepersqrft'";}else{$other=''; $call=''; $id='';}
													  echo"<div class=\"form-group col-xs-12 col-sm-4 $class\">";
														echo"<label class=\"control-label\" for=\"last-name\">$Attributes->attrName </label>";
														echo"<input $call $id  class=\"form-control\" type=\"text\" name=\"text-$Attributes->attributeID\" $other value=\"";
														echo isset($checkattri[0]->attrDetValue)?$checkattri[0]->attrDetValue:'';
														echo "\">";
													  echo"</div>"; 
													  
													}
													/////////////////////textbox type end.................................
													
													///////////////////multicheck start.............................
													if($Attributes->attrInputType=="multiselect"){ 
													
													 
														
														echo"<div class=\"row $class\">";
														echo'	  <div class="col-xs-12">
																<div class="x_title-1">';
														echo"	  <h4>$Attributes->attrName</h4>";
														echo' </div>
																<div class="clearfix">';
																
																if(!empty($propertyid))
														  {
															$attmulti=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attributes->attributeID));
														  if(!empty($attmulti)){
															$multicheckvalues=explode("#|#",$attmulti[0]->attrOptionID);
														}
														  }
																
															foreach($Attributeoption as $Attributeoptions){
																
														  
														  
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\"  value=\"$Attributeoptions->attrOptionID#$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\"";
														if(!empty($multicheckvalues)){if(in_array($Attributeoptions->attrOptionID,$multicheckvalues)){echo"checked";}}
														echo">";
														echo"$Attributeoptions->attrOptName</span>";
														}
														echo'	  </div>
														  </div>
														</div>';
													
													}
													/////////////////multicheck end.................................................
													
												}
												}
												echo $transactiontypegroupattri;
		
											}else{
												echo"List Is !empty!!";
											}
								
                              echo"</div>";
                            echo"</div>";
							 echo"</div>";
							$atti++;
						}
						}
						
					}else{
						echo"List Is !empty!!";
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
		
		$date=date("Y-m-d h:i:s");
		
		if(!empty($formid))
		{
			$formname="form-";
			$formname.=$formid;
		}
		
		if(!empty($data) || $formname=="form-2")
			{
				$data1=array();
				$data2=array();
				$mappingtabledata=array();
				$mappingtableplanid='';
				
				if($formname=="form-1")
				{
					$propertyprice=array();
					$selectattribute=array();
					$selectattributeval=array();
					$textattribute=array();
					$multiattribute=array();
					$amenitiesdata=array();
					$amenitiesvalue=array();
					$newpassiondate='';
					$noofbedroom='';$propertytypename='';$coveredarea='';$projectname='';$propertypurpose='';$sublocality='';$locality='';
					foreach($data as $key=> $datas)
					{
						$datas=preg_replace('/\s\s+/', ' ',$datas);
						if($key=="userID"){
						 $data1['userID']=$datas;
						 
						}
						elseif($key=="propertyTypeID"){
						  $data1['propertyTypeID']= $datas;
						}
						elseif($key=="propertyPurpose"){
						  $data1['propertyPurpose']=$propertypurpose= $datas;
						}
						elseif($key=="propertyStatus"){
						  $data1['propertyStatus']= $datas;
						}
						elseif($key=="projectID"){
						  $data1['projectID']= $datas;
						}
						elseif($key=="type"){
						  $data1['type']= $datas;
						}
						elseif($key=="isNegotiable"){
						  $data1['isNegotiable']= $datas;
						}
						elseif($key=="propertyName")           //Data 2 start..................................................
						{
						  $data2['propertyName']= $datas;
						}
						elseif($key=="propertyDescription"){
						  $data2['propertyDescription']= $datas;
						}
						elseif($key=="showpriceas"){
						  $data1['isNegotiable']= $datas;
						}
						elseif($key=="lat"){
						  $data1['propertyLatitude']= $datas;
						  
						}
						elseif($key=="lng"){
						  $data1['propertyLongitude']= $datas;
						  
						}
						elseif($key=="postal_code"){
						  $data1['propertyZipCode']= $datas;
						  
						}
						elseif($key=="sublocality"){
						  $data2['propertyLocality']= $datas;
						  
						}
						elseif($key=="propertyAddress2"){
						  $data2['propertyAddress2']= $datas;
						  
						}
						elseif($key=="propertyAddress1"){
						  $data2['propertyAddress1']= $datas;
						}
						elseif($key=="propertyPrice"){
						  $propertyprice['propertyPrice']= $datas;
						} 
						elseif($key=="currentstatus"){
						  $data1['propertyCurrentStatus']= $datas;
						}
						elseif($key=="year"){
						  $year= $datas;
						}
						elseif($key=="month"){
						  $month= $datas;
						}
						elseif($key=="day"){
						  $day= $datas;
						}
						elseif($key=="propertyAddress"){
						  $add3= $datas;
						  
						}
						
						
						
/********************************Code for city,state,county,citylocality Get ID For insert start**********************************/
					/* if(!empty($add3))
					{ */
						if($key=="country"){
						  $addarray['country']= $datas;
						  
						}
						elseif($key=="administrative_area_level_1"){
						  $addarray['administrative_area_level_1']= $datas;
						  
						}
						elseif($key=="locality"){
						  $addarray['locality']=$locality= $datas;
						  
						}
						elseif($key=="sublocality"){
						  $addarray['sublocality']=$sublocality= $datas;
						  
						}
						elseif($key=="lat"){
						  $addarray['propertyLatitude']= $datas;
						  
						}
						elseif($key=="lng"){
						  $addarray['propertyLongitude']= $datas;
						  
						}
						
						$data1['propertyFeatured']= 'OFF';
					
					//}
/*******************************Code for city,state,county,citylocality Get ID For insert END*************************************/					
						
/*************************************paln id mapping with property***************************************************************/
						if($key=="planid")
						{
							$mappingtableplanid= $datas;
						}
						
/************************************paln id mapping with property*****************************************************************/
	
/***************************************Amenities Start***************************************************************************/
						elseif($key=="Amenities"){	
						
							$string1 = '';
							$string2 = '';
							
							if(!empty($datas)){
								
								foreach($datas as $amenities){
									
									$amenitiesarr=explode("#",$amenities);
									
									$string1.= rtrim($amenitiesarr[1]).'#|#';
									$string2.= rtrim($amenitiesarr[2]).'#|#';
								}
								
								$amenitiesdata[]=array('attributeID'=>$amenitiesarr[0],'attrOptionID'=>substr($string1,0,-3));
								$amenitiesvalue[]=array('attrDetValue'=>substr($string2,0,-3));
								
							}
							
						}
						else{											
/****************************************Attributes strat************************************************************************/
							
							if(!empty($key)){
									
									$typeofattribute=explode("-",$key);
									
									if(count($typeofattribute)>1){
										
										if($typeofattribute[0]=="select"){
											
											if(!empty($datas)){
												
													$optionidselect=explode("#",$datas);
													if($typeofattribute[1]==1){
														$noofbedroom=$optionidselect[1];
													}
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>$optionidselect[0]);
													$selectattributeval[]=array('attrDetValue'=>$optionidselect[1]);
													
											}
											
											
										}
										elseif($typeofattribute[0]=="text"){
											
											 if(!empty($datas)){
												 
												 $size='';
												 if($typeofattribute[1]==4){
													 $coveredarea=$datas;
												 }
												$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>0);
													
												$selectattributeval[]=array('attrDetValue'=>"$datas ");
													
												
													
											} 
											
										}
										elseif($typeofattribute[0]=="multi"){
											
											$stringmulti1 = '';
											$stringmulti2 = '';
											
											if(!empty($datas)){
												
												foreach($datas as $attributemulti){
															
													$multiarr=explode("#",$attributemulti);
															
													$stringmulti1.= rtrim($multiarr[0]).'#|#';
													$stringmulti2.= rtrim($multiarr[1]).'#|#';
													
												}
														
													$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>substr($stringmulti1,0,-3));
													$selectattributeval[]=array('attrDetValue'=>substr($stringmulti2,0,-3));
														
											}
											
											
										}
									}
							
									
							
							}
							
							
						}
						
						
						
					}
					
/*******************************************************Passession Date************************************************************/
					if(!empty($month)){
						$newpassiondate.=$month;
					}
					if(!empty($year)){ 
						$newpassiondate.=',';$newpassiondate.=$year;
					}
					if(!empty($day)){
						$newpassiondate.=',';$newpassiondate.=$day;
					}
					if(!empty($newpassiondate)){
							$data1['possessionDate']= $newpassiondate;
							}
					
					if(!empty($addarray))
					{
						$addressids=$this->AddProperty_model->Getaddressids($addarray);
						
						if(!empty($addressids)){
							
						  $data1['countryID']= $addressids['countryID'];
						  $data1['stateID']= $addressids['stateID'];
						  $data1['cityID']= $addressids['cityID'];
						  $data1['cityLocID']= $addressids['cityLocID'];
						}
						else{
							  $data1['countryID']= '99';
							  $data1['stateID']= '1';
							  $data1['cityID']= '1';
							  $data1['cityLocID']= '';
						} 
					}
					else{
						
							 
					}
					
					if(!empty($data['propertyID'])){
						
						$filter1=array('propertyID'=>$data['propertyID']);
						
						if(!empty($data1['projectID']))
						{
							$projectid=$data1['projectID'];
							$projectnames=$this->AddProperty_model->get_project(" and rp_projects.projectID=$projectid");
							if(!empty($projectnames)){
								
								if($projectnames[0]->cityID){
									
									$cityinfo=$this->AddProperty_model->Getotherdata('rp_city_details',array('cityID'=>$projectnames[0]->cityID,'languageID'=>1));
									
									$citylocinfo=$this->AddProperty_model->Getotherdata('rp_city_locations',array('cityLocID'=>$projectnames[0]->cityLocID));
									
									if(!empty($cityinfo)){
										$locality=$cityinfo[0]->cityName;
									}
									
									if(!empty($citylocinfo)){
										$sublocality=$citylocinfo[0]->googleLocName;
									}
								}
								$projectname=$projectnames[0]->projectName;
								
								
								$data1['propertyLatitude']= $projectnames[0]->projectLatitude;
								$data1['propertyLongitude']= $projectnames[0]->projectLongitude;
								$data1['propertyZipCode']= 	  $projectnames[0]->projectZipCode;
								$data2['propertyLocality']= $sublocality;
								$data2['propertyAddress2']= $projectnames[0]->projectAddress2;
								$data2['propertyAddress1']= $projectnames[0]->projectAddress1;
								$data1['countryID']= $projectnames[0]->countryID;
								$data1['stateID']= $projectnames[0]->stateID;
								$data1['cityID']= $projectnames[0]->cityID;
								$data1['cityLocID']= $projectnames[0]->cityLocID;
							}
						
						}
						
						$this->AddProperty_model->InsertProperty('rp_properties',$data1,$filter1);
						
/**************************************Meta Details autogenerate start********************************************************/						
						
						
						if(!empty($data1['propertyTypeID'])){
							
							$propertytypeid=$data1['propertyTypeID'];
							$propertytypenames=$this->AddProperty_model->getPropertyType(" AND t2.propertyTypeID=$propertytypeid");
							$propertytypename=$propertytypenames[0]->propertyTypeName;
						}
						
						$propertyMetaTitle="$noofbedroom BHK $propertytypename $coveredarea sqft for $propertypurpose in $projectname $sublocality $locality | Homeonline";
						$propertyMetaKeyword="$noofbedroom BHK $propertytypename for $propertypurpose in $projectname $locality,
						$noofbedroom BHK $propertytypename in $locality for $propertypurpose, $noofbedroom BHK $propertytypename
						for $propertypurpose in $projectname $sublocality $locality, $noofbedroom BHK $propertytypename for $propertypurpose in $sublocality $locality, $noofbedroom BHK $propertytypename in $projectname, $noofbedroom BHK $propertytypename $coveredarea sqft for $propertypurpose in $projectname $locality, $propertytypename for $propertypurpose in $locality.";
						$propertyMetaDescription="$noofbedroom BHK $propertytypename  $coveredarea sqft for $propertypurpose in $projectname $sublocality $locality with all modern amenities. Browse $noofbedroom BHK $propertytypename for $propertypurpose in $locality and get best deals from real estate agents at homeonline.com";
						
						$data2['propertyMetaTitle']= preg_replace('/\s\s+/', ' ',$propertyMetaTitle);
						$data2['propertyMetaKeyword']= preg_replace('/\s\s+/', ' ',$propertyMetaKeyword);
						$data2['propertyMetaDescription']= preg_replace('/\s\s+/', ' ',$propertyMetaDescription);
/**************************************Meta Details autogenerate END********************************************************/
						
						foreach($this->languages as $language){
							
							$filter2=array('languageID'=>$language->languageID,'propertyID'=>$data['propertyID']);
							$this->AddProperty_model->InsertProperty('rp_property_details',$data2,$filter2);
						}
						
						
						
						$localityid=$data1['cityLocID'];$lat=$data1['propertyLatitude'];$long=$data1['propertyLongitude'];
						
						if(empty($data1['projectID'])){
						$this->AddProperty_model->Insertareacode($localityid,$lat,$long,$data['propertyID']);
						}
						
						
						/*****************************Insert rp_dbho_plan_mapping Data start*************************************/
					
						$mappingdatafilter=array('objectID'=>$data['propertyID'],'objectType'=>'property');
						$oldplancheck=$this->AddProperty_model->Getotherdata('rp_dbho_plan_mapping',$mappingdatafilter);
						
						if(!empty($oldplancheck)){
							$oldplanID=$oldplancheck[0]->planID;
							
							if($oldplanID==$mappingtableplanid){
								$logdata=array('propertyID'=>$data['propertyID'],'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Edit','userAccessType'=>'Admin');
								$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							}elseif($oldplanID !='' && $mappingtableplanid==''){
								$logdata=array('propertyID'=>$data['propertyID'],'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Edit','userAccessType'=>'Admin');
								$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							}else{
								$this->AddProperty_model->InsertProperty('rp_properties',array('propertyStatus'=>'Draft'),array('propertyID'=>$data['propertyID']));
								$mappingtablefinaldata['planID']=$mappingtableplanid;
								$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$mappingtablefinaldata,$mappingdatafilter);
								
								$logdata=array('propertyID'=>$data['propertyID'],'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Update Plan And Status Draft','userAccessType'=>'Admin');
								$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
								
							}
						}else{
							$mappingtablefinaldata['planID']=$mappingtableplanid;
							$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$mappingtablefinaldata,$mappingdatafilter);
							$logdata=array('propertyID'=>$data['propertyID'],'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Update Plan','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);	
						}
						
						/*****************************Insert rp_dbho_plan_mapping Data END*************************************/
						
						if(!empty($propertyprice))
						{
							
							foreach($this->currencies as $currency){
							$filter3=array('currencyID'=>$currency->currencyID,'propertyID'=>$data['propertyID']);
							$this->AddProperty_model->InsertProperty('rp_property_price',$propertyprice,$filter3);
							}
						}
						$in="178,179,180,181,182,183,197";
						$this->AddProperty_model->deleteattributesandvalues($data['propertyID'],$in);
						if(!empty($amenitiesdata) && !empty($amenitiesvalue))
						{	$i=0;
							
							
							foreach($amenitiesdata as $amenitiesdatainsert)
							{	
								$amenitiesdatainsert['propertyID']=$data['propertyID'];
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$amenitiesdatainsert);
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								
								foreach($this->languages as $language){
								$amenitiesvalue[$i]['languageID']=$language->languageID;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$amenitiesvalue[$i]);
								}
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
								foreach($this->languages as $language){
								$selectattributeval[$j]['languageID']=$language->languageID;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval[$j]);
								}
								$j++;
							}
						}
						
						
					}
					else{
						
						$propertykey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
					
						$data1['propertyKey']= $propertykey;
						$data1['propertyAddedDate']= $date;
						$data1['propertyStatus']= 'Draft';
						
						if(!empty($data1['projectID']))
						{
							$projectid=$data1['projectID'];
							$projectnames=$this->AddProperty_model->get_project(" and rp_projects.projectID=$projectid");
							if(!empty($projectnames)){
								
								if($projectnames[0]->cityID){
									
									$cityinfo=$this->AddProperty_model->Getotherdata('rp_city_details',array('cityID'=>$projectnames[0]->cityID,'languageID'=>1));
									
									$citylocinfo=$this->AddProperty_model->Getotherdata('rp_city_locations',array('cityLocID'=>$projectnames[0]->cityLocID));
									
									if(!empty($cityinfo)){
										$locality=$cityinfo[0]->cityName;
									}
									
									if(!empty($citylocinfo)){
										$sublocality=$citylocinfo[0]->googleLocName;
									}
								}
								$projectname=$projectnames[0]->projectName;
								
								
								$data1['propertyLatitude']= $projectnames[0]->projectLatitude;
								$data1['propertyLongitude']= $projectnames[0]->projectLongitude;
								$data1['propertyZipCode']= 	  $projectnames[0]->projectZipCode;
								$data2['propertyLocality']= $sublocality;
								$data2['propertyAddress2']= $projectnames[0]->projectAddress2;
								$data2['propertyAddress1']= $projectnames[0]->projectAddress1;
								$data1['countryID']= $projectnames[0]->countryID;
								$data1['stateID']= $projectnames[0]->stateID;
								$data1['cityID']= $projectnames[0]->cityID;
								$data1['cityLocID']= $projectnames[0]->cityLocID;
							}
						
						}
						  
						
						
						$propertyid=$this->AddProperty_model->InsertProperty('rp_properties',$data1);
						
						$data2['propertyID']= $propertyid;
/**************************************Meta Details autogenerate start********************************************************/						
						
						
						if(!empty($data1['propertyTypeID'])){
							
							$propertytypeid=$data1['propertyTypeID'];
							$propertytypenames=$this->AddProperty_model->getPropertyType(" AND t2.propertyTypeID=$propertytypeid");
							$propertytypename=$propertytypenames[0]->propertyTypeName;
						}
						
						$propertyMetaTitle="$noofbedroom BHK $propertytypename $coveredarea sqft for $propertypurpose in $projectname $sublocality $locality | Homeonline";
						$propertyMetaKeyword="$noofbedroom BHK $propertytypename for $propertypurpose in $projectname $locality,
						$noofbedroom BHK $propertytypename in $locality for $propertypurpose, $noofbedroom BHK $propertytypename
						for $propertypurpose in $projectname $sublocality $locality, $noofbedroom BHK $propertytypename for $propertypurpose in $sublocality $locality, $noofbedroom BHK $propertytypename in $projectname, $noofbedroom BHK $propertytypename $coveredarea sqft for $propertypurpose in $projectname $locality, $propertytypename for $propertypurpose in $locality.";
						$propertyMetaDescription="$noofbedroom BHK $propertytypename  $coveredarea sqft for $propertypurpose in $projectname $sublocality $locality with all modern amenities. Browse $noofbedroom BHK $propertytypename for $propertypurpose in $locality and get best deals from real estate agents at homeonline.com";
						
						$data2['propertyMetaTitle']= preg_replace('/\s\s+/', ' ',$propertyMetaTitle);
						$data2['propertyMetaKeyword']= preg_replace('/\s\s+/', ' ',$propertyMetaKeyword);
						$data2['propertyMetaDescription']= preg_replace('/\s\s+/', ' ',$propertyMetaDescription);
/**************************************Meta Details autogenerate END********************************************************/							
						foreach($this->languages as $language){
							$data2['languageID']= $language->languageID;
						$this->AddProperty_model->InsertProperty('rp_property_details',$data2);
						}
						
						 if(empty($data1['projectID']))
						{ 
						$localityid=$data1['cityLocID'];$lat=$data1['propertyLatitude'];$long=$data1['propertyLongitude'];
						$this->AddProperty_model->Insertareacode($localityid,$lat,$long,$propertyid);
						}
						
						/*****************************Insert rp_dbho_plan_mapping Data start*************************************/
					
						
						if(!empty($mappingtableplanid))
						{
								$mappingtablefinaldata['planID']=$mappingtableplanid;
						}
						else{
								$mappingtablefinaldata['planID']='';
						}
						
						$mappingtablefinaldata['objectType']='property';
						$mappingtablefinaldata['objectID']= $propertyid;
						
						$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$mappingtablefinaldata);
						
						$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Add','userAccessType'=>'Admin');
						$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
						
						/*****************************Insert rp_dbho_plan_mapping Data END*************************************/
						if(!empty($propertyprice))
						{
							$propertyprice['propertyID']= $propertyid;
							foreach($this->currencies as $currency){
							$propertyprice['currencyID']=$currency->currencyID;
							$this->AddProperty_model->InsertProperty('rp_property_price',$propertyprice);
							}
						}
						
						$this->AddProperty_model->deleteallattributesandvalues($propertyid);
						
						if(!empty($amenitiesdata) && !empty($amenitiesvalue)){	
							
							$i=0;
							
							foreach($amenitiesdata as $amenitiesdatainsert)
							{	
								$amenitiesdatainsert['propertyID']=$propertyid;
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$amenitiesdatainsert);
								
								$amenitiesvalue[$i]['attrValueID']=$attributevalueId;
								foreach($this->languages as $language){
								
								$amenitiesvalue[$i]['languageID']=$language->languageID;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$amenitiesvalue[$i]);
								}
								$i++;
							}
						}
						
						if(!empty($selectattribute) && !empty($selectattributeval)){

							$j=0;
							
							foreach($selectattribute as $selectattributeinsert)
							{	
								$selectattributeinsert['propertyID']=$propertyid;
								
								$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$selectattributeinsert);
								$selectattributeval[$j]['attrValueID']=$attributevalueId;
								foreach($this->languages as $language){
								$selectattributeval[$j]['languageID']=$language->languageID;
								$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval[$j]);
								}
								$j++;
							}
						}
						
						
					}
						if(!empty($propertyid) && !empty($data1['propertyLatitude']) && !empty($data1['propertyLongitude']))
							{
								
								$this->googleLocalPropertyInfoAction($propertyid,$data1['propertyLatitude'], $data1['propertyLongitude']);
							}
						
				}
				elseif($formname=="form-2"){
					
					if(!empty($data['propertyID'])){
						
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
						///$filter1=array('propertyID'=>$data['propertyID']);
						/* foreach($this->languages as $language){
						$filter1=array('propertyID'=>$data['propertyID'],'languageID'=>$language->languageID);
						$this->AddProperty_model->InsertProperty('rp_property_details',$data1,$filter1);
						} */
					}
					
				}
				elseif($formname=="form-3"){
					
					if(!empty($data['propertyID']))
					{
						
						//..................................................................Bed Room
							if(!empty($data['flooringTypebedroom'])){
							$bedi=1;
							$this->AddProperty_model->deletestep3data('rp_dbho_bed_room',array('propertyID'=>$data['propertyID']));
							foreach($data['flooringTypebedroom'] as $flooringTypebedroom)
							{	$bedroom=array();
								$bedroom['bedroomKey']="BedRoom$bedi";
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
									$this->AddProperty_model->Insertotherinfo('rp_dbho_bed_room',$bedroom);
								}
								$bedi++;
							}
							}
							//.......................................................................Living Room
							if(!empty($data['flooringTypelivingroom'])){
							$livingi=1;
							$this->AddProperty_model->deletestep3data('rp_dbho_living_room',array('propertyID'=>$data['propertyID']));
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
									$this->AddProperty_model->Insertotherinfo('rp_dbho_living_room',$livingroom);
								}
								$livingi++;
							}
							}
							//.......................................................................................Bath  Room
							if(!empty($data['flooringTypebathroom'])){
							$bathi=1;
							$this->AddProperty_model->deletestep3data('rp_dbho_bath_room',array('propertyID'=>$data['propertyID']));
							foreach($data['flooringTypebathroom'] as $flooringTypebathroom)
							{	
								$bathroom=array();$kitchen=array();
								$bathroom['bathroomKey']="Toilet$bathi";
								if(!empty($flooringTypebathroom))
								{
									$bathroom['flooringType']=$flooringTypebathroom;
								}
								if(!empty($data['hotwatersupply'][$bathi-1]))
								{
									$bathroom['hotwatersupply']=$data['hotwatersupply'][$bathi-1];
								}
								if(!empty($data["toilet$bathi"]))
								{
									$bathroom['toilet']=$data["toilet$bathi"];
								}
								if(!empty($data["$bathi-othersbathroom"]))
								{
										$otherscomaseparated=implode(",",$data["$bathi-othersbathroom"]);
										$bathroom['others']=$otherscomaseparated;
								}
								
								if(!empty($bathroom))
								{
									$bathroom['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('rp_dbho_bath_room',$bathroom);
								}
								$bathi++;
							}
							}							
							//.......................................................................................................Kitchen
							if(!empty($data['platform'])){
							$kitcheni=1;
							$this->AddProperty_model->deletestep3data('rp_dbho_kitchen',array('propertyID'=>$data['propertyID']));
							foreach($data['platform'] as $platform)
							{	
								$kitchen=array();
								
								if(!empty($data['platform']))
								{
									$kitchen['platformType']=$platform;
								}
								if(!empty($data['Cabinet']))
								{
									$kitchen['cabinet']=$data['Cabinet'];
								}
								
								if(!empty($data["$kitcheni-otherskitchen"]))
								{
										$otherscomaseparated=implode(",",$data["$kitcheni-otherskitchen"]);
										$kitchen['others']=$otherscomaseparated;
								}
								
								if(!empty($kitchen))
								{
									$kitchen['propertyID']=$data['propertyID'];
									$this->AddProperty_model->Insertotherinfo('rp_dbho_kitchen',$kitchen);
								}
								$kitcheni++;
							}
							}
							//.....................................................................................................
							
					foreach($data as $key=> $datas)
					{ 
							if(!empty($key))
							{
								$typeofattribute=explode("-",$key);
									
									if(count($typeofattribute)>1)
									{
										$this->AddProperty_model->deleteattributesandvaluesflooring($data['propertyID'],$typeofattribute[1]);
									
										if($typeofattribute[0]=="multi")
													{
														$stringmulti1 = '';
														$stringmulti2 = '';
																if(!empty($datas))
																{
																	foreach($datas as $attributemulti){
																		
																		$multiarr=explode("#",$attributemulti);
																		
																		$stringmulti1.= rtrim($multiarr[0]).'#|#';
																		$stringmulti2.= rtrim($multiarr[1]).'#|#';
																	}
																	
																	$selectattribute[]=array('attributeID'=>$typeofattribute[1],'attrOptionID'=>substr($stringmulti1,0,-3));
																	$selectattributeval[]=array('attrDetValue'=>substr($stringmulti2,0,-3));
																	
																}
														
														
													}
													
										if(!empty($selectattribute) && !empty($selectattributeval))
										{	$j=0;
											
											
											foreach($selectattribute as $selectattributeinsert)
											{	
												$selectattributeinsert['propertyID']=$data['propertyID'];
												$attributevalueId=$this->AddProperty_model->InsertProperty('rp_property_attribute_values',$selectattributeinsert);
												$selectattributeval[$j]['attrValueID']=$attributevalueId;
												foreach($this->languages as $language){
												$selectattributeval[$j]['languageID']=$language->languageID;
												$this->AddProperty_model->InsertProperty('rp_property_attribute_value_details',$selectattributeval[$j]);
												}
												$j++;
											}
										}
							
									}
							}
					}
							
							//////////////
							
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
		$coverimage='No';
		$propertyID=$this->input->post('propertyID');
		$imagecategory=$this->input->post('imagecategory');
		$propertyImageTitle=$this->input->post('propertyImageTitle');
		/* if($propertyImageTitle=='Exterior View'){
			$coverimage='Yes';
		} */
		if(!empty($propertyID) && !empty($imagecategory))
		{
			
			if($_FILES['file']['name']!='')
			{
				
						$commonThumbWidth = 81;
						$commonThumbHeight = 54;
						$mediumWidth  = 618;
						$mediumHeight  = 412;
						$lightboxWidth    = 1098;
						$lightboxHeight   = 732;
						$largeWidth=300;
						$largeHeight=200;
						$maprightWidth=108;
						$maprightHeight=72;
						$mappopWidth=324;
						$mappopHeight=216;
						$sponsoredWidth   	= 210;
						$sponsoredHeight  	= 140;
						$timelineWidth   	= 93;
						$timelineHeight  	= 62;
						$defaultThumbWidth	= 72;
						$defaultThumbHeight	= 48;
						$smallWidth   		= 81;
						$smallHeight  		= 54;
						$galleryWidth   	= 618;
						$galleryHeight  	= 412;
						$imgName = uniqid(rand(1, 99999)) . '' . $_FILES["file"]["name"];
			   
						$originalPath  ="../public/uploads/property/images/original/".$imgName; 
						$commonThumbPath =  "../public/uploads/property/images/thumb/".$imgName;
						$mediumPath   = "../public/uploads/property/images/medium/".$imgName;
						$lightboxPath       = "../public/uploads/property/images/lightbox/".$imgName;
						$largePath       = "../public/uploads/property/images/default/large/".$imgName;
						$maprightPath       = "../public/uploads/property/images/default/mapRight/".$imgName;
						$mappopupPath       = "../public/uploads/property/images/default/mapPopup/".$imgName;
						$sponsoredPath       = "../public/uploads/property/images/default/sponsored/".$imgName;
						$timelinePath       = "../public/uploads/property/images/default/timeline/".$imgName;
						$defaultThumbPath       = "../public/uploads/property/images/default/thumb/".$imgName;
						$smallPath       = "../public/uploads/property/images/default/small/".$imgName;
						$galleryPath       = "../public/uploads/property/images/default/gallery/".$imgName;
						
					   copy($_FILES["file"]["tmp_name"], $originalPath);  
					   copy($_FILES["file"]["tmp_name"], $commonThumbPath);
					   copy($_FILES["file"]["tmp_name"], $mediumPath);
					   copy($_FILES["file"]["tmp_name"], $lightboxPath);
					   copy($_FILES["file"]["tmp_name"], $largePath);
					   copy($_FILES["file"]["tmp_name"], $maprightPath);
					   copy($_FILES["file"]["tmp_name"], $mappopupPath);
					   copy($_FILES["file"]["tmp_name"], $sponsoredPath);
					   copy($_FILES["file"]["tmp_name"], $timelinePath);
					   copy($_FILES["file"]["tmp_name"], $defaultThumbPath);
					   copy($_FILES["file"]["tmp_name"], $smallPath);
					   copy($_FILES["file"]["tmp_name"], $galleryPath);
					   
					   
					   $imgData = @getimagesize($originalPath);
					   $w          = $imgData[0];
					   $h          = $imgData[1];
					   
					   if ($w < $lightboxWidth && $h < $lightboxHeight) 
					   {
						$lightboxWidth = $w;
						$lightboxHeight = $h;
					   }
						
					   $this->AddProperty_model->resizeImage($mediumPath, $mediumWidth, $mediumHeight);
					   $this->AddProperty_model->resizeImage($commonThumbPath, $commonThumbWidth, $commonThumbHeight);
					   $this->AddProperty_model->resizeImage($lightboxPath, $lightboxWidth, $lightboxHeight);
					   $this->AddProperty_model->resizeImage($largePath, $largeWidth, $largeHeight);
					   $this->AddProperty_model->resizeImage($maprightPath, $maprightWidth, $maprightHeight);
					   $this->AddProperty_model->resizeImage($mappopupPath, $mappopWidth, $mappopHeight);
					   $this->AddProperty_model->resizeImage($sponsoredPath, $sponsoredWidth, $sponsoredHeight);
					   $this->AddProperty_model->resizeImage($timelinePath, $timelineWidth, $timelineHeight);
					   $this->AddProperty_model->resizeImage($defaultThumbPath, $defaultThumbWidth, $defaultThumbHeight);
					   $this->AddProperty_model->resizeImage($smallPath, $smallWidth, $smallHeight);
					   $this->AddProperty_model->resizeImage($galleryPath, $galleryWidth, $galleryHeight);
					   $resDefaultImg = $this->AddProperty_model->Getotherdata('rp_property_images',array('propertyID'=>$propertyID,'isCoverImage'=>'Yes'));
					   
					   if(!empty($resDefaultImg)){
						   $coverimage='No';
					   }else{
						    $coverimage='Yes';
					   }
					   
					if(!empty($imgName))
					{
				
						$data=array('propertyID'=>$propertyID,'imageCatID'=>$imagecategory,'propertyImageName'=>$imgName,'isCoverImage'=>$coverimage,'propertyImagePriority'=>'1','propertyImageStatus'=>'Active');
						$propertyImageID=$this->AddProperty_model->InsertProperty('rp_property_images',$data);
						
						foreach($this->languages as $language){
						$data1=array('propertyImageID'=>$propertyImageID,'languageID'=>$language->languageID,'propertyImageTitle'=>$propertyImageTitle,'propertyImageAltTag'=>$propertyImageTitle);
						$this->AddProperty_model->InsertProperty('rp_property_image_details',$data1);
						}		
					  
					}
			}
		
		}
		
		
		
		
		
	}
	
		
/*Property List view Load Start.............................................................................................................*/
	function PropertyListing($action=false)
	{	
		if($action=="search"){
			
			$this->data['usertype']=$usertype=$this->input->post('usertype');
			$this->data['account']=$account=$this->input->post('account');
			$this->data['activatedby']=$activatedby=$this->input->post('activatedby');
			$this->data['plan']=$plan=$this->input->post('plan');
			$this->data['status1']=$status=$this->input->post('status');
			$this->data['propertykey']=$propertykey=$this->input->post('propertykey');
			$this->data['propertyName']=$propertyName=$this->input->post('propertyName');	
			$query="";
			if(!empty($usertype)){ $query.="and `userTypeName` like TRIM('%$usertype%')"; }
			if(!empty($account)){ $query.="and `userEmail` like TRIM('%$account%')"; }
			if(!empty($activatedby)){ $query.="and `userEmail` like TRIM('%$activatedby%')"; }
			if(!empty($plan)){ $query.="and `planTitle` like TRIM('%$plan%')"; }
			if(!empty($status)){ $query.="and `propertyStatus` like TRIM('%$status%')"; }
			if(!empty($propertykey)){ $query.="and `propertyKey` like TRIM('%$propertykey%')"; }
			if(!empty($propertyName)){ $query.="and `propertyName` like TRIM('%$propertyName%')"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="PropertyList.csv"');
				print $this->AddProperty_model->get_propertylisting($query);
				exit();
				
			}
					
			$this->data['propertylisting']=$this->AddProperty_model->get_propertylisting($query);
			
			
		}else if($action=="RequestProperties"){
					
			$this->data['usertype']=$usertype=$this->input->post('usertype');
			$this->data['account']=$account=$this->input->post('account');
			$this->data['activatedby']=$activatedby=$this->input->post('activatedby');
			$this->data['plan']=$plan=$this->input->post('plan');
			$this->data['status1']=$status=$this->input->post('status');
			$this->data['RequestProperties'] = $RequestProperties = $this->uri->segment(3);		
			$query="";
			if(!empty($usertype)){ $query.="and `userTypeName` like TRIM('%$usertype%')"; }
			if(!empty($account)){ $query.="and `userEmail` like TRIM('%$account%')"; }
			if(!empty($activatedby)){ $query.="and `userEmail` like TRIM('%$activatedby%')"; }
			//if(!empty($plan)){ $query.="and `userEmail` like TRIM('%$plan%')"; }
			if(!empty($status)){ $query.="and `propertyStatus` like TRIM('%$status%')"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="log_download.csv"');
				print $this->AddProperty_model->get_propertylisting($query);
				exit();
				
			}
					
			$this->data['propertylisting']=$this->AddProperty_model->get_propertylisting($query,$this->data['RequestProperties']);
		}else{
		 $this->data['RequestProperties'] = $this->uri->segment(3);
				//echo "<pre>";print_r($this->data['pendingProperty']);die;
		$this->data['propertylisting']=$this->AddProperty_model->get_propertylisting($extraqry = false,$this->data['RequestProperties']);
		
		}
	
		foreach($this->data['propertylisting'] as $k=>$v){
			$this->data['status'][$v->propertyID] = $this->AddProperty_model->getAppStatus($v->propertyID);
		}
		
		$this->data['plandetails']=$this->AddProperty_model->get_plandetails();
		$this->parser->parse('header',$this->data);
		$this->load->view('propertylist',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*Property List view Load Start.............................................................................................................*/

/*Property Refresh Modal View Load Start............................................................................................ */
	function Propertyrefreshmodal($propertyID=false)
	{
		if(!empty($propertyID))
		{
			$this->data['propertyID']=$propertyID;
			
			$this->data['userplan']='';
			
			$PropertiesDetails=$this->AddProperty_model->Getotherdata('rp_properties',array('propertyID'=>$propertyID));
			
			if(!empty($PropertiesDetails)){
				
				$userID=$PropertiesDetails[0]->userID;
				
				$this->data['userplan']=$this->AddProperty_model->GetUserplan($userID);
				
				$Propertyoldplan=$this->AddProperty_model->Getotherdata('rp_dbho_plan_mapping',array('objectID'=>$propertyID,'objectType'=>'property'));
				
				if(!empty($Propertyoldplan)){
					
					$this->data['oldplan']=$Propertyoldplan[0]->planID;
				}
			
			}
		}else{
			$this->data['Errorfound']="No Data Found!!";
		}
			
		$this->load->view('propertyrefreshModal',$this->data); 
	}
	
/*Property Refresh Modal View Load END............................................................................................ */

/*Property Log view Load Start.............................................................................................................*/
	function PropertyLog($propertyid=false)
	{	
		$query='';
		if($propertyid=="search"){
			
			$this->data['usertype']=$usertype=$this->input->post('usertype');
			$this->data['account']=$account=$this->input->post('account');
			$this->data['activatedby']=$activatedby=$this->input->post('activatedby');
			$this->data['plan']=$plan=$this->input->post('plan');
			$this->data['status1']=$status=$this->input->post('status');
			$this->data['propertykey']=$propertykey=$this->input->post('propertykey');	
			$this->data['propertyID']=$propertyID=$this->input->post('propertyID');	
			$this->data['propertyName']=$propertyName=$this->input->post('propertyName');	
			
			if(!empty($usertype)){ $query.="and `userTypeName` like TRIM('%$usertype%')"; }
			if(!empty($account)){ $query.="and `propertyName` like TRIM('%$account%')"; }
			if(!empty($activatedby)){ $query.="and `adminUserEmail` like TRIM('%$activatedby%')"; }
			if(!empty($plan)){ $query.="and `planTitle` like TRIM('%$plan%')"; }
			if(!empty($status)){ $query.="and `actionType` like TRIM('%$status%')"; }
			if(!empty($propertykey)){ $query.="and `propertyKey` like TRIM('%$propertykey%')"; }
			if(!empty($propertyID)){ $query.="and rp_dbho_property_log.propertyID =$propertyID"; }
			if(!empty($propertyName)){ $query.="and `propertyName` like TRIM('%$propertyName%')"; }
			
			
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="PropertyLog.csv"');
				print $this->AddProperty_model->get_propertyloglisting($query);
				exit();
				
			}
					
		}
		elseif(!empty($propertyid)){
			if(is_numeric($propertyid)){
				$this->data['propertyID']=$propertyid;
				$query=" and rp_dbho_property_log.propertyID=$propertyid";
				
			}
		}
		
		
		$this->data['plandetails']=$this->AddProperty_model->get_plandetails();
		$this->data['log_details']=$this->AddProperty_model->get_propertyloglisting($query);
		$this->parser->parse('header',$this->data);
		$this->load->view('propertylog',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*Property Log view Load Start.............................................................................................................*/

/*Get No Of Bed Rooms Kitchens etc from db for insert Start.............................................................................................................*/
	function Shownoofbedrooms()
	{	
		$propertyid=$this->input->post('propertyid');
		if(!empty($propertyid))
			{
				
				$NoOfBedRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>1));
				$propertytype=$this->AddProperty_model->Getotherdata('rp_properties',array('propertyID'=>$this->input->post('propertyid')));
				
				$propertytypeid='';
				if(!empty($propertytype[0]->propertyTypeID)){
					$propertytypeid=$propertytype[0]->propertyTypeID;
				}
					if($propertytypeid !=64){
				if(!empty($NoOfBedRooms))
				{	
					if(!empty($NoOfBedRooms[0]->attrDetValue))
					{	$bedroomdata=$this->AddProperty_model->Getbedbathroomdata('rp_dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')),'bedroomKey');
						
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
							if(in_array("FalseCeiling", $bedothers)){ $FalseCeiling="checked";}else{$FalseCeiling="";}
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
										<select name="flooringTypebedroom[]" onchange="flooringtypebedroom(this.value)" class="form-control flooringbed">
										 <option value="">select</option>
										  <option value="Marble Flooring"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Marble Flooring'){echo"selected";}}
										  echo'>Marble Flooring</option>
										  <option value="Wooden Flooring"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Wooden Flooring'){echo"selected";}}
										 echo' >Wooden Flooring</option>
										  <option value="Ceramic - Vitrified Tiles"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Ceramic - Vitrified Tiles'){echo"selected";}}
										  echo'>Ceramic - Vitrified Tiles</option>
										  <option value="Stone Flooring"';
										 if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Stone Flooring'){echo"selected";}}
										  echo'>Stone Flooring</option>
										  <option value="Laminated Flooring"';
										  if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Laminated Flooring'){echo"selected";}}
										  echo'>Laminated Flooring</option>
										  <option value="Anti skid Tiles"';
										    if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Anti skid Tiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
										  <option value="Granite Flooring"';
										    if(!empty($bedroomdata[$i-1]->flooringType)){ if($bedroomdata[$i-1]->flooringType=='Granite Flooring'){echo"selected";}}
										  echo'>Granite Flooring</option>
										</select>
									  </div>
									</div>';
								echo"	<div class=\" clearfix\"> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"TV\" class=\"_TV\"  value=\"TV\" $TV name=\"$i-othersbedroom[]\">
									  TV</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"AC\" class=\"_AC\" value=\"AC\" $AC name=\"$i-othersbedroom[]\">
									  AC</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Bed\" class=\"_Bed\" value=\"Bed\" $Bed name=\"$i-othersbedroom[]\">
									  Bed</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Dressing_Table\" class=\"_Dressing_Table\"  value=\"DressingTable\" $DressingTable name=\"$i-othersbedroom[]\">
									  Dressing Table</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Wardrobe\" class=\"_Wardrobe\" value=\"Wardrobe\" $Wardrobe name=\"$i-othersbedroom[]\">
									  Wardrobe</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"False_Ceiling\" class=\"_False_Ceiling\"  value=\"FalseCeiling\" $FalseCeiling name=\"$i-othersbedroom[]\">
									  False Ceiling</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Attached_Balcony\" class=\"_Attached_Balcony\"  value=\"AttachedBalcony\" $AttachedBalcony name=\"$i-othersbedroom[]\">
									  Attached Balcony</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Attached_Bathroom\" class=\"_Attached_Bathroom\" value=\"AttachedBathroom\" $AttachedBathroom name=\"$i-othersbedroom[]\">
									  Attached Bathroom</span> <span class=\"checkbozsty-1\">
									  <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Ventilation\" class=\"_Ventilation\" value=\"Ventilation\" $Ventilation name=\"$i-othersbedroom[]\">
									  Ventilation</span> </div>
								  </div>
								</div>
							</div>";
						}
					}
					
				}
				
				//$NoOfLivingRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>28));
				
				//if(!empty($NoOfLivingRooms))
				//{	
					/* if(!empty($NoOfLivingRooms[0]->attrDetValue))
					{	 */
					$livingroomdata=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_living_room',array('propertyID'=>$this->input->post('propertyid')));
						
						/* for($i=1;$i<=$NoOfLivingRooms[0]->attrDetValue;$i++)
						{ */
							$livingothers=array();
							if(!empty($livingroomdata[0]->others)){
							$livingothers=explode(",",$livingroomdata[0]->others);
							}
							
							if(in_array("Sofa", $livingothers)){ $Sofa="checked";}else{$Sofa="";}
							if(in_array("DiningTable", $livingothers)){ $DiningTable="checked";}else{$DiningTable="";}
							if(in_array("AC", $livingothers)){ $AC="checked";}else{$AC="";}
							if(in_array("ShoeRack", $livingothers)){ $ShoeRack="checked";}else{$ShoeRack="";}
							if(in_array("TV", $livingothers)){ $TV="checked";}else{$TV="";}
							if(in_array("FalseCeiling", $livingothers)){ $FalseCeiling="checked";}else{$FalseCeiling="";}
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneL1\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"<h4 class=\"panel-title StepTitle\">Living Room </h4>
								</a>";
							echo"	<div id=\"collapseOneL1\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="form-group col-sm-2">
                                <label>Flooring Type</label>
                                <select name="flooringTypelivingroom[]" onchange="flooringtypelivingroom(this.value)" class="form-control ">
                                  <option value="">select</option>
								   <option value="Marble Flooring"';
										  if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Marble Flooring'){echo"selected";}}
										  echo'>Marble Flooring</option>
										  <option value="Wooden Flooring"';
										  if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Wooden Flooring'){echo"selected";}}
										 echo' >Wooden Flooring</option>
										  <option value="Ceramic - Vitrified Tiles"';
										  if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Ceramic - Vitrified Tiles'){echo"selected";}}
										  echo'>Ceramic - Vitrified Tiles</option>
										  <option value="Stone Flooring"';
										 if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Stone Flooring'){echo"selected";}}
										  echo'>Stone Flooring</option>
										  <option value="Laminated Flooring"';
										  if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Laminated Flooring'){echo"selected";}}
										  echo'>Laminated Flooring</option>
										  <option value="Anti skid Tiles"';
										    if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Anti skid Tiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
										  <option value="Granite Flooring"';
										    if(!empty($livingroomdata[0]->flooringType)){ if($livingroomdata[0]->flooringType=='Granite Flooring'){echo"selected";}}
										  echo'>Granite Flooring</option>
                                  
                                </select>
                              </div>
                            </div>
                            <div class=" clearfix"> <span class="checkbozsty-1">';
                           echo"   <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Sofa\" class=\"_Sofa\" value=\"Sofa\" $Sofa name=\"1-otherslivingroom[]\">
                              Sofa</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Dining_Table\" class=\"_Dining_Table\"  value=\"DiningTable\" $DiningTable name=\"1-otherslivingroom[]\">
                              Dining Table</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"AC\" class=\"_AC\" value=\"AC\" $AC name=\"1-otherslivingroom[]\">
                              AC</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"Shoe_Rack\" class=\"_Shoe_Rack\"  value=\"ShoeRack\" $ShoeRack name=\"1-otherslivingroom[]\">
                              Shoe Rack</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"TV\" class=\"_TV\" value=\"TV\" $TV name=\"1-otherslivingroom[]\">
                              TV</span> <span class=\"checkbozsty-1\">
                              <input type=\"checkbox\" onclick='checkfurnishing(this.id)' id=\"False_Ceiling\" class=\"_False_Ceiling\"   value=\"FalseCeiling\" $FalseCeiling name=\"1-otherslivingroom[]\">
                              False Ceiling</span> </div>
                          </div>
                        </div>
                      </div>";
						//}
					//}
					
				//}
				
				$NoOfBathRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>3));
				
				if(!empty($NoOfBathRooms))
				{	
					if(!empty($NoOfBathRooms[0]->attrDetValue))
					{	$bathroomdata=$this->AddProperty_model->Getbedbathroomdata('rp_dbho_bath_room',array('propertyID'=>$this->input->post('propertyid')),'bathroomKey');
						
						for($i=1;$i<=$NoOfBathRooms[0]->attrDetValue;$i++)
						{
							$bathothers=array();
							if(!empty($bathroomdata[$i-1]->others)){
							$bathothers=explode(",",$bathroomdata[$i-1]->others);
							}
							
							if(in_array("GlassPartition", $bathothers)){ $GlassPartition="checked";}else{$GlassPartition="";}
							if(in_array("BathTub", $bathothers)){ $BathTub="checked";}else{$BathTub="";}
							if(in_array("ExhaustFan", $bathothers)){ $ExhaustFan="checked";}else{$ExhaustFan="";}
							if(in_array("Windows", $bathothers)){ $Windows="checked";}else{$Windows="";}
							if(in_array("ShowerCurtain", $bathothers)){ $ShowerCurtain="checked";}else{$ShowerCurtain="";}
							if(in_array("Cabinet", $bathothers)){ $Cabinet="checked";}else{$Cabinet="";}
							if(in_array("Washingmachine", $bathothers)){ $Washingmachine="checked";}else{$Washingmachine="";}
							if(in_array("Geyser", $bathothers)){ $Geyser="checked";}else{$Geyser="";}
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneB$i\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Bath Room $i</h4>
								</a>";
							echo"	<div id=\"collapseOneB$i\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select name="flooringTypebathroom[]" onchange="flooringtypebathroom(this.value)" class="form-control flooringbath">
                                  <option value="">select</option>
                                  <option value="Marble Flooring"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Marble Flooring'){echo"selected";}}
										  echo'>Marble Flooring</option>
										  
										  <option value="Ceramic - Vitrified Tiles"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Ceramic - Vitrified Tiles'){echo"selected";}}
										  echo'>Ceramic - Vitrified Tiles</option>
										  <option value="Stone Flooring"';
										 if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Stone Flooring'){echo"selected";}}
										  echo'>Stone Flooring</option>
										  <option value="Granite Flooring"';
										  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Granite Flooring'){echo"selected";}}
										  echo'>Granite Flooring</option>
										  <option value="Anti skid Tiles"';
										    if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Anti skid Tiles'){echo"selected";}}
										  echo'>Anti Skid Tiles</option>
                                  </select>
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
                                        <input type="radio" class="flat _Indian"  id="Indian" onchange="checkfurnishing(this.id)" value="Indian" name="toilet'.$i.'"';
										if(!empty($bathroomdata[$i-1]->toilet)){ if($bathroomdata[$i-1]->toilet=='Indian'){echo"checked";}}
										echo'>
                                        Indian </label>
                                      <label>
                                        <input type="radio" class="flat _Western"  id="Western" onchange="checkfurnishing(this.id)" value="Western" name="toilet'.$i.'"';
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
                           echo"     <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Glass_Partition\" class=\"_Glass_Partition\"  value=\"GlassPartition\" $GlassPartition name=\"$i-othersbathroom[]\">
                                Glass Partition</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"BathTub\" class=\"_BathTub\"  value=\"BathTub\" $BathTub name=\"$i-othersbathroom[]\">
                                Bath Tub</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Exhaust_Fan\" class=\"_Exhaust_Fan\"   value=\"ExhaustFan\" $ExhaustFan name=\"$i-othersbathroom[]\">
                                Exhaust fan</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Windows\" class=\"_Windows\" value=\"Windows\" $Windows name=\"$i-othersbathroom[]\">
                                Windows</span> <span class=\"checkbozsty-1\"> 
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Shower_Curtain\" class=\"_Shower_Curtain\" value=\"ShowerCurtain\" $ShowerCurtain name=\"$i-othersbathroom[]\">
                                Shower Curtain</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Cabinet\" class=\"_Cabinet\" value=\"Cabinet\" $Cabinet name=\"$i-othersbathroom[]\">
                                Cabinet</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Washing_Machine\"  class=\"_Washing_Machine\" value=\"Washingmachine\" $Washingmachine name=\"$i-othersbathroom[]\">
                                Washing Machine</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Geyser\" class=\"_Geyser\" value=\"Geyser\" $Geyser name=\"$i-othersbathroom[]\">
                                Geyser</span></div>
                            </div>
                          </div>
                        </div>
                      </div>";
					  
					  }
					}
					
				}
				
				//$NoOfKitchenRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>27));
				
				/* if(!empty($NoOfKitchenRooms))
				{ */	
					/* if(!empty($NoOfKitchenRooms[0]->attrDetValue))
					{ */	
						$kitchendata=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_kitchen',array('propertyID'=>$this->input->post('propertyid')));
						
						/* for($i=1;$i<=$NoOfLivingRooms[0]->attrDetValue;$i++)
						{ */
							$kitchenothers=array();
							if(!empty($kitchendata[0]->others)){
							$kitchenothers=explode(",",$kitchendata[0]->others);
							}
							
							if(in_array("Refrigerator", $kitchenothers)){ $Refrigerator="checked";}else{$Refrigerator="";}
							if(in_array("Waterpurifier", $kitchenothers)){ $Waterpurifier="checked";}else{$Waterpurifier="";}
							if(in_array("Loft", $kitchenothers)){ $Loft="checked";}else{$Loft="";}
							if(in_array("GasPipeline", $kitchenothers)){ $GasPipline="checked";}else{$GasPipline="";}
							if(in_array("Microwave", $kitchenothers)){ $Microwave="checked";}else{$Microwave="";}
							if(in_array("Chimney", $kitchenothers)){ $Chimaey="checked";}else{$Chimaey="";}
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneK1\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Kitchen </h4>
								</a>";
							echo"	<div id=\"collapseOneK1\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select name="platform[]" onchange="flooringtypekitchen(this.value)" class="form-control">
									<option value="">Select</option>
                                    <option value="Stone Flooring"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Stone Flooring'){echo"selected";}}
									echo'>Stone Flooring</option>
                                    <option value="Anti skid Tiles"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Anti skid Tiles'){echo"selected";}}
									echo'>Anti skid Tiles</option>
                                    <option value="Marble Flooring"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Marble Flooring'){echo"selected";}}
									echo'>Marble Flooring</option>
                                    <option value="Wooden Flooring"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Wooden Flooring'){echo"selected";}}
									echo'>Wooden Flooring</option>
                                    <option value="Ceramic - Vitrified Tiles"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Ceramic - Vitrified Tiles'){echo"selected";}}
									echo'>Ceramic - Vitrified Tiles</option>
                                    <option value="Laminated Flooring"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Laminated Flooring'){echo"selected";}}
									echo'>Laminated Flooring</option>
									<option value="Granite  Flooring"';
									if(!empty($kitchendata[0]->platformType)){ if($kitchendata[0]->platformType=='Granite  Flooring'){echo"selected";}}
									echo'>Granite  Flooring</option>
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
                                        <input type="radio" class="flat _Modular_Kitchen"  id="Modular_Kitchen" onchange="checkfurnishing(this.id)" value="Modular" name="Cabinet"'; 
										if(!empty($kitchendata[0]->cabinet)){ if($kitchendata[0]->cabinet=='Modular'){echo"checked";}}
										echo'>
                                        Modular </label>
                                      <label>
                                        <input type="radio" class="_NA" onchange="checkfurnishing(this.value)" class="flat" value="NA" name="Cabinet"';
										if(!empty($kitchendata[0]->cabinet)){ if($kitchendata[0]->cabinet=='NA'){echo"checked";}}
										echo'>
                                        NA </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">';
                            echo"    <input type=\"checkbox\"  onclick=\"checkfurnishing(this.id)\" id=\"Refrigerator\" class=\"_Refrigerator\" value=\"Refrigerator\" $Refrigerator name=\"1-otherskitchen[]\">
                                Refrigerator</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Water_Purifier\"  class=\"_Water_Purifier\" value=\"Waterpurifier\" $Waterpurifier name=\"1-otherskitchen[]\">
                                Water purifier</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Loft\" class=\"_Loft\" value=\"Loft\" $Loft name=\"1-otherskitchen[]\">
                                Loft</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Gas_Pipline\" class=\"_Gas_Pipline\" value=\"GasPipeline\" $GasPipline name=\"1-otherskitchen[]\">
                                Gas Pipeline</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Microwave\" class=\"_Microwave\" value=\"Microwave\" $Microwave name=\"1-otherskitchen[]\">
                                Microwave</span> <span class=\"checkbozsty-1\">
                                <input type=\"checkbox\" onclick=\"checkfurnishing(this.id)\" id=\"Electric_Chimney\" class=\"_Electric_Chimney\"  value=\"Chimney\" $Chimaey name=\"1-otherskitchen[]\">
                                Electric Chimney</span> </div>
                            </div>
                          </div>
                        </div>
                      </div>";
						//}
					//}
					
				//}
				
				
				
				
				
			/*	$NoOfBathRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>3));
				
				 if(!empty($NoOfBathRooms))
				{	
					if(!empty($NoOfBathRooms[0]->attrDetValue))
					{	$bathroomdata=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_bath_room',array('propertyID'=>$this->input->post('propertyid')));
						
						for($i=1;$i<=$NoOfBathRooms[0]->attrDetValue;$i++)
						{
							$bathothers=array();
							if(!empty($bathroomdata[$i-1]->others)){
							$bathothers=explode(",",$bathroomdata[$i-1]->others);
							} */
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneBc\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Balcony Flooring</h4>
								</a>";
							echo"	<div id=\"collapseOneBc\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select name="flooringTypebalcony[]" onchange="flooringtypebalcony(this.value)" class="form-control flooringbalcony">
                                  <option value="">select</option>
                                  <option value="Marble Flooring"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Marble'){echo"selected";}} */
										  echo'>Marble Flooring</option>
										  <option value="Wooden Flooring"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Wooden Flooring'){echo"selected";}} */
										 echo' >Wooden Flooring</option>
										  <option value="Ceramic - Vitrified Tiles"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Ceramic - Vitrified Tiles'){echo"selected";}} */
										  echo'>Ceramic - Vitrified Tiles</option>
										  <option value="Stone Flooring"';
										 /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Stone Flooring'){echo"selected";}} */
										  echo'>Stone Flooring</option>
										  <option value="Laminated Flooring"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Laminated Flooring'){echo"selected";}} */
										  echo'>Laminated Flooring</option>
										  <option value="Anti skid Tiles"';
										    /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Anti skid Tiles'){echo"selected";}} */
										  echo'>Anti Skid Tiles</option>
										  <option value="Granite Flooring"';
										    /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Granite Flooring'){echo"selected";}} */
										  echo'>Granite Flooring</option>
                                  </select>
                                </div>
                              </div>
                             </div>
                          </div>
                        </div>
                      </div>';
					  
					//  }
					//}
					
				//}
				
				
				
				/* $NoOfBathRooms=$this->AddProperty_model->Shownoofbedrooms('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>3)); */
				
				/* if(!empty($NoOfBathRooms))
				{ */	
					 /* if(!empty($NoOfBathRooms[0]->attrDetValue))
					{ 	$bathroomdata=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_bath_room',array('propertyID'=>		$this->input->post('propertyid')));
						
						for($i=1;$i<=$NoOfBathRooms[0]->attrDetValue;$i++)
						{ */
							/* $bathothers=array();
							if(!empty($bathroomdata[$i-1]->others)){
							$bathothers=explode(",",$bathroomdata[$i-1]->others);
							} */
							
							echo "<div class=\"panel\"> <a class=\"panel-heading\" role=\"tab\" id=\"headingOne1\" data-toggle=\"collapse\" data-parent=\"#accordion3\" href=\"#collapseOneBcd\" aria-expanded=\"false\" aria-controls=\"collapseOne3\">";
                         
							echo"	<h4 class=\"panel-title StepTitle\">Common Area Flooring</h4>
								</a>";
							echo"	<div id=\"collapseOneBcd\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
							
								echo'<div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select name="flooringTypecommonarea[]" onchange="flooringtypecommonarea(this.value)" class="form-control flooringcommonarea">
                                  <option value="">select</option>
                                  <option value="Marble Flooring"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Marble Flooring'){echo"selected";}} */
										  echo'>Marble Flooring</option>
										  <option value="Wooden Flooring"';
										 /*  if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Wooden Flooring'){echo"selected";}} */
										 echo' >Wooden Flooring</option>
										  <option value="Ceramic - Vitrified Tiles"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Ceramic - Vitrified Tiles'){echo"selected";}} */
										  echo'>Ceramic - Vitrified Tiles</option>
										  <option value="Stone Flooring"';
										 /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Stone Flooring'){echo"selected";}} */
										  echo'>Stone Flooring</option>
										  <option value="Laminated Flooring"';
										  /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Laminated Flooring'){echo"selected";}} */
										  echo'>Laminated Flooring</option>
										  <option value="Anti skid Tiles"';
										    /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Anti skid Tiles'){echo"selected";}} */
										  echo'>Anti Skid Tiles</option>
										  <option value="Granite Flooring"';
										    /* if(!empty($bathroomdata[$i-1]->flooringType)){ if($bathroomdata[$i-1]->flooringType=='Granite Flooring'){echo"selected";}} */
										  echo'>Granite Flooring</option>
                                  </select>
                                </div>
                              </div>
                             </div>
                          </div>
                        </div>
                      </div>';
					  
					 // }
					//}
					
					
				//}
				
				
				
				
				//flooring and furnishing start..........................
				
					
					
					
					echo'<h4 class="panel-title StepTitle">FLOORING TYPE </h4>';
                              
                              
                        $Attribute=$this->AddProperty_model->GetAttributes(13);
											if(!empty($Attribute))
											{
												
												echo"<div class='clearfix'></div>";
												
												
												
												echo'<div id="multidiv">';
												
												foreach($Attribute as $Attributes)
												{
													if($Attributes->attrName !="Amenities" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if($Attributes->attrInputType=="multiselect"){ 
													
													 
														
														echo"<div class=\"row \">";
														echo'	  <div class="col-xs-12">
																<div class="x_title-1">';
														echo"	  <h4>$Attributes->attrName</h4>";
														
														$class=''; //$id='';
														if($Attributes->attrName=='Bed Room Flooring'){
															$class='class="bedroom"'; //$id='id="bedroom"';
														}elseif($Attributes->attrName=='Living Room Flooring'){
															$class='class="livingroom"'; //$id='id="bedroom"';
														}elseif($Attributes->attrName=='Bathroom Flooring'){
															$class='class="bathroom"'; //$id='id="bedroom"';
														}elseif($Attributes->attrName=='Kitchen Flooring'){
															$class='class="kitchen"'; //$id='id="bedroom"';
														}elseif($Attributes->attrName=='Common Area Flooring'){
															$class='class="commonarea"'; //$id='id="bedroom"';
														}elseif($Attributes->attrName=='Balcony Flooring'){
															$class='class="balcony"'; //$id='id="bedroom"';
														}
														
														echo' </div>
																<div class="clearfix">';
																
															foreach($Attributeoption as $Attributeoptions){
																
														  if(!empty($propertyid))
														  {
															$attmulti=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>$Attributes->attributeID));
														  
															if(!empty($attmulti)){
															$furnishingcheckvalues=explode("#|#",$attmulti[0]->attrOptionID);
															
															}
														  
														  }
														  
														echo"<span class=\"checkbozsty\">";
														echo"<input type=\"checkbox\" onclick=\"return false\" $class  id=\"$Attributeoptions->attrOptName\" value=\"$Attributeoptions->attrOptionID#$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\"";
														 if(!empty($furnishingcheckvalues)){ if(in_array($Attributeoptions->attrOptionID,$furnishingcheckvalues)){echo"checked";} }
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
												
												
											} 
											
											
										echo'	<h4 class="panel-title StepTitle">FURNISHING </h4>';
                              
                              
                        $Attribute=$this->AddProperty_model->GetAttributes(15);
											if(!empty($Attribute))
											{
												
												echo"<div class='clearfix'></div>";
												
												echo'<div id="multidiv">';
												
												foreach($Attribute as $Attributes)
												{
													
													if($Attributes->attrName !="Amenities" )
													{
													$Attributeoption=$this->AddProperty_model->GetAttributesoption($Attributes->attributeID);
													
													if($Attributes->attrInputType=="multiselect"){ 
													$noac='';$nobed='';$notv='';$nowardrobe='';$geyser='';
													if(!empty($propertyid))
														  {
															$attmulti=$this->AddProperty_model->Getflooringvaluesofproperty($propertyid,$Attributes->attributeID);
														 
														  if(!empty($attmulti)){
															 
															$flooringcheckvalues=explode("#|#",$attmulti[0]->attrOptionID);
															$flooringcheckvaluesdetails=explode("#|#",$attmulti[0]->attrDetValue);
															
															
															foreach($flooringcheckvaluesdetails as $flooringcheckvaluesdetail){
																$flooringspaceremove=explode(" ",$flooringcheckvaluesdetail);
																if(!empty($flooringspaceremove[1])){
																	$attarray[]=$flooringspaceremove[1];
																}
															}
															
														 if(!empty($attarray)){
															 
														 if(in_array('AC',$attarray)){ 
														 
														 }else{
															 $noac="checked";
														 }
														 }
														 
														 if(!empty($attarray)){
															 
														 if(in_array('TV',$attarray)){ 
														 
														 }else{
															 $notv="checked";
														 }
														 }
														 
														 if(!empty($attarray)){
															 
														 if(in_array('Bed',$attarray)){ 
														 
														 }else{
															 $nobed="checked";
														 }
														 }
														 
														 if(!empty($attarray)){
															 
														 if(in_array('Wardrobe',$attarray)){ 
														 
														 }else{
															 $nowardrobe="checked";
														 }
														 }
														 
														 if(!empty($attarray)){
															 
														 if(in_array('Geyser',$attarray)){ 
														 
														 }else{
															 $nogeyser="checked";
														 }
														 }
														
															
															}
														  
														  }
														  
														echo"<div class=\"row \">";
														echo'	  <div class="col-xs-12">
																<div class="x_title-1">';
														echo"	  <h4>$Attributes->attrName</h4>";
														
														echo' </div>
																<div class="clearfix">';
																
															foreach($Attributeoption as $Attributeoptions){
																
														  
														  
														echo"<span class=\"checkbozsty\">";
														$ids=explode(" ",$Attributeoptions->attrOptName);$class='fur';if(!empty($ids[1])){ if(is_numeric($ids[0])){$class.=$ids[1];}else{$class.=implode("_",$ids);}}elseif(!empty($ids[0])){$class.=implode("_",$ids);}
														$ids=implode("_",$ids);
														
														echo"<input type=\"checkbox\" onclick=\"return false\" id=\"$ids\"  class=\"$class $ids\" value=\"$Attributeoptions->attrOptionID#$Attributeoptions->attrOptName\" name=\"multi-$Attributes->attributeID[]\"";
														 if(!empty($flooringcheckvalues)){ if(in_array($Attributeoptions->attrOptionID,$flooringcheckvalues)){ echo"checked";
														 }else{
															
															if($Attributeoptions->attrOptName=='No AC'){echo $noac;}
															elseif($Attributeoptions->attrOptName=='No Bed'){echo $nobed;}
															elseif($Attributeoptions->attrOptName=='No TV'){echo $notv;}
															elseif($Attributeoptions->attrOptName=='No Wardrobe'){echo $nowardrobe;}
															elseif($Attributeoptions->attrOptName=='No Geyser'){echo $geyser;}
															 
														 }
														 }else{
															 if($Attributeoptions->attrOptName=='No AC'){echo"checked";}
															 elseif($Attributeoptions->attrOptName=='No Bed'){echo"checked";}
															 elseif($Attributeoptions->attrOptName=='No TV'){echo"checked";}
															 elseif($Attributeoptions->attrOptName=='No Wardrobe'){echo"checked";}
															 elseif($Attributeoptions->attrOptName=='No Geyser'){echo"checked";}
														 }
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
												
												
											} 
					
				}else{
					echo'<div class="alert alert-danger" >
			<strong>No Detailed Information In Residential Plots. Goto Next Step.</strong>  
			</div>';
				}
				//}
				//flooring and furnishing end...............................
				
			}
		
	}
/*Get No Of Bed Rooms Kitchens etc from db for insert End.............................................................................................................*/

/*Show preview on 4th Step from db inserted Data Start.............................................................................................................*/
	function Showpreview()
	{	
		$this->data['propertyid']=$propertyid=$this->input->post('propertyid');
		
		if(!empty($propertyid))
			{
				$filter=array('propertyID'=>$this->input->post('propertyid'));
				$propertytabledetails=$this->AddProperty_model->Shownpreview($this->input->post('propertyid'));
				$propertyplandetails=$this->AddProperty_model->getplandetailsofproperty($this->input->post('propertyid'));
				
				if(!empty($propertyplandetails)){
					$userplan=$propertyplandetails[0]->planTitle;
				}else{
						$userplan="Not Mentioned";
				}
				
				if(!empty($propertytabledetails))
				{
					if(!empty($propertytabledetails[0]->propertyPurpose)){$purpose=$propertytabledetails[0]->propertyPurpose;}else{$purpose="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->projectID))
					{
								$under="Property Under Project";
								$projectid=$propertytabledetails[0]->projectID;
								$projectnames=$this->AddProperty_model->get_project(" and rp_projects.projectID=$projectid");
								if(!empty($projectnames)){
								$projectname=$projectnames[0]->projectName;
								}else{ $under="Individual Property";$projectname="No"; }
					}else{ $under="Individual Property";$projectname="No"; }
					
					if(!empty($propertytabledetails[0]->propertyTypeID)){$propertytypeid=$propertytabledetails[0]->propertyTypeID;
						$propertytypenames=$this->AddProperty_model->getPropertyType(" AND t2.propertyTypeID=$propertytypeid");
						$propertytypename=$propertytypenames[0]->propertyTypeName;
					}else{$propertytypename="NO";}
					
					if(!empty($propertytabledetails[0]->propertyName)){$propertyname=$propertytabledetails[0]->propertyName;}else{$propertyname="NO";}
					
					if(!empty($propertytabledetails[0]->propertyCurrentStatus)){$propertyCurrentStatus=$propertytabledetails[0]->propertyCurrentStatus;}else{$propertyCurrentStatus="NO";}
					
					if(!empty($propertytabledetails[0]->possessionDate)){$propertydate=$propertytabledetails[0]->possessionDate;}else{$propertydate="NO";}
					
					if(!empty($propertytabledetails[0]->userID)){$userID=$propertytabledetails[0]->userID;
								$userdetails=$this->AddProperty_model->getuserforpreview($userID);
								$useremail='';$usertype='';
								if(!empty($userdetails)){
								$usertypeid=$userdetails[0]->userTypeID;
								$usertypedetails=$this->AddProperty_model->get_user_type(" and rp_user_types.userTypeID=$usertypeid");
								$useremail=$userdetails[0]->userEmail;$usertype=$usertypedetails[0]->userTypeName;}
					}else{$useremail="Not Mentioned";$usertype="Not Mentioned";}
					
					$getpropertyprice=$this->AddProperty_model->Getotherdata('rp_property_price',$filter);
					if(!empty($getpropertyprice[0]->propertyPrice)){$propertyprice=$getpropertyprice[0]->propertyPrice;}else{$propertyprice="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->isNegotiable)){$isNegotiable=$propertytabledetails[0]->isNegotiable;}else{$isNegotiable="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyDescription)){$propertyDescription=$propertytabledetails[0]->propertyDescription;}else{$propertyDescription="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLatitude)){$propertyLatitude=$propertytabledetails[0]->propertyLatitude;}else{$propertyLatitude="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLongitude)){$propertyLongitude=$propertytabledetails[0]->propertyLongitude;}else{$propertyLongitude="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyZipCode)){$propertyZipCode=$propertytabledetails[0]->propertyZipCode;}else{$propertyZipCode="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyLocality)){$propertyLocality=$propertytabledetails[0]->propertyLocality;}else{$propertyLocality="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyAddress1)){$propertyAddress1=$propertytabledetails[0]->propertyAddress1;}else{$propertyAddress1="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyAddress2)){$propertyAddress2=$propertytabledetails[0]->propertyAddress2;}else{$propertyAddress2="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaTitle)){$propertyMetaTitle=$propertytabledetails[0]->propertyMetaTitle;}else{$propertyMetaTitle="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaKeyword)){$propertyMetaKeyword=$propertytabledetails[0]->propertyMetaKeyword;}else{$propertyMetaKeyword="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyMetaDescription)){$propertyMetaDescription=$propertytabledetails[0]->propertyMetaDescription;}else{$propertyMetaDescription="Not Mentioned";}
					
					if(!empty($propertytabledetails[0]->propertyKey)){$propertykey=$propertytabledetails[0]->propertyKey;}
					
					if(!empty($propertytabledetails[0]->countryID)){$filter=array('countryID'=>$propertytabledetails[0]->countryID,'languageID'=>'1');$key='countryName';$countryname=$this->AddProperty_model->getcountryname('rp_country_details',$filter,$key);$countryname=$countryname[0]->countryName;}else{$countryname="Not Mentioned";}
					if(!empty($propertytabledetails[0]->stateID)){ $filter1=array('stateID'=>$propertytabledetails[0]->stateID,'languageID'=>'1');$key='stateName';$statename=$this->AddProperty_model->getcountryname('rp_state_details',$filter1,$key); $statename=$statename[0]->stateName;}else{$statename="Not Mentioned";}
					if(!empty($propertytabledetails[0]->cityID)){ $filter2=array('cityID'=>$propertytabledetails[0]->cityID,'languageID'=>'1');$key='cityName';$cityname=$this->AddProperty_model->getcountryname('rp_city_details',$filter2,$key); $cityname=$cityname[0]->cityName;}else{$cityname="Not Mentioned";}
					
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
                          <p>$propertyCurrentStatus </p>
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
                    </div>";
					
					
			if(!empty($propertytypeid))
			{
				$AttributesGroup=$this->AddProperty_model->Getattributesgroups($propertytypeid);
					
					if(!empty($AttributesGroup))
					{
						
						$atti=1;
						foreach($AttributesGroup as $AttributesGroups)
						{
							
							$Attribute=$this->AddProperty_model->GetAttributes($AttributesGroups->attributeGroupID);
											
							echo "  <div style=\"margin-top:20px;\" class=\"row labcol\">
										<h2 class=\"StepTitle\">$AttributesGroups->name</h2>";
										
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
													if(!empty($checkattri)){
														$attoptval=$checkattri[0]->attrDetValue;
														if($Attributes->attrInputType=="multiselect"){ 
														$attoptval1=explode('#|#',$checkattri[0]->attrDetValue);
														$attoptval=implode(',',$attoptval1);
													}
													}else{
														$attoptval='NO';
													}
													}else{
														$attoptval='No';
													}
													
													
													
														echo"<div class=\"col-sm-3 martop15\">
																<div class=\"form-group botbott\">
																	<label>$Attributes->attrName</label>
																		<p>$attoptval </p>
																</div>
															</div>";
													
													
												}
												}
												
											}else{
												echo"List Is !empty!!";
											}
                      
							
											
							echo'		</div>';
                             
							
						
						}
						
					}else{
						echo"List Is !empty!!";
					}
			}
					
                    
					
                  echo"  <div style=\"margin-top:20px;\" class=\"row labcol\">
                      <h2 class=\"StepTitle\">Amenities</h2>";
					  $Attributeoption=$this->AddProperty_model->GetAttributesoption(6);
					  $getamenities=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$this->input->post('propertyid'),'attributeID'=>6));
									if(!empty($getamenities)){
										$amenitiescheckvalues=explode("#|#",$getamenities[0]->attrOptionID);
									}
									foreach($Attributeoption as $Attributeoptions){
										
					 echo" <div class=\"col-sm-3 martop15\">
                        <div class=\"form-group botbott\">
                          <label> $Attributeoptions->attrOptName </label>";
						  
						  if(!empty($amenitiescheckvalues)){ if(in_array($Attributeoptions->attrOptionID,$amenitiescheckvalues)){echo"<p>YES </p>";}else{echo"<p>NO</p>";}}else{echo"<p>NO</p>";}
                          
                       echo" </div>
                      </div>";
									}
                  echo"</div>";
				  
                   echo' <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Property Location </h2>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Address1 </label>';
                       echo"   <p>$propertyAddress1 </p>";
                      echo'  </div>
                      </div>
					  <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Address2 </label>';
                       echo"   <p>$propertyAddress2 </p>";
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
                       echo"   <p>$countryname </p>";
                     echo'   </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>State </label>';
                        echo"  <p>$statename </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> City / Area </label>';
                          echo"<p>$cityname </p>";
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
					
					$getroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_bed_room',array('propertyID'=>$this->input->post('propertyid')));
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
						   if(in_array("FalseCeiling", $bedothers)){ $FalseCeiling="YES";}else{$FalseCeiling="NO";}
                          echo"<p>$FalseCeiling</p>";
                       echo' </div>
                      </div>
                    </div>';
							 
						$count++; }
					 }
					 
					 $getlivingroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_living_room',array('propertyID'=>$this->input->post('propertyid')));
                     if(!empty($getlivingroomdetails)){
						  $count=1;
						 foreach($getlivingroomdetails as $getlivingroomdetailss){
							$livingothers=explode(",",$getlivingroomdetailss->others);
                    echo'<div style="margin-top:20px;" class="row labcol">';
                   echo"   <h2 class=\"StepTitle\">Living Room </h2>";
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
                      
					
					$getbathroomdetails=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_bath_room',array('propertyID'=>$this->input->post('propertyid')));
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
						  if(in_array("ExhaustFan", $bathothers)){ $ExhaustFan="YES";}else{$ExhaustFan="NO";}
                          echo"<p>$ExhaustFan</p>";
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
					 
					 $getkitchendetails=$this->AddProperty_model->Getotherdatafromnewdb('rp_dbho_kitchen',array('propertyID'=>$this->input->post('propertyid')));
                     if(!empty($getbathroomdetails)){
						  $count=1;
						 foreach($getkitchendetails as $getkitchendetailss){
							$kitchenothers=explode(",",$getkitchendetailss->others);
                    echo'<div style="margin-top:20px;" class="row labcol">';
                   echo"   <h2 class=\"StepTitle\">Kitchen </h2>";
                    echo'  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Platform </label>';
                         echo" <p>$getkitchendetailss->platformType </p>";
                       echo' </div>
                      </div>';
					 
					 echo '<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Cabinet </label>';
                         echo" <p>$getkitchendetailss->cabinet </p>";
                       echo' </div>
                      </div>';
					  
					  /* echo '<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Toilet </label>';
                         echo" <p>$getkitchendetailss->toilet </p>";
                       echo' </div>
                      </div>'; */
						
                      echo'<div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Refrigerator </label>';
						  if(in_array("Refrigerator", $kitchenothers)){ $Refrigerator="YES";}else{$Refrigerator="NO";}
                         echo" <p>$Refrigerator </p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Water purifier </label>';
						   if(in_array("Waterpurifier", $kitchenothers)){ $Waterpurifier="YES";}else{$Waterpurifier="NO";}
                          echo"<p>$Waterpurifier</p>";
                      echo'  </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Loft </label>';
						  if(in_array("Loft", $kitchenothers)){ $Loft="YES";}else{$Loft="NO";}
                          echo"<p>$Loft</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Gas Pipline </label>';
						   if(in_array("GasPipline", $kitchenothers)){ $GasPipline="YES";}else{$GasPipline="NO";}
                         echo" <p>$GasPipline</p>";
                       echo' </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Microwave </label>';
						   if(in_array("Microwave", $kitchenothers)){ $Microwave="YES";}else{$Microwave="NO";}
                          echo"<p>$Microwave</p>";
                       echo' </div>
                      </div>
					  <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Chimaey </label>';
						   if(in_array("Chimaey", $kitchenothers)){ $Chimaey="YES";}else{$Chimaey="NO";}
                          echo"<p>$Chimaey</p>";
                       echo' </div>
                      </div>
                    </div>';
							 
						$count++; }
					 }
                   
					  if(!empty($propertykey)){
					echo'<div class="title_right">
            <div class="input-group pull-right"> ';
          echo" <a href=\"http://$this->severname/india/en/sale/apartment-for-sale.htm/$propertykey/srchdet/preview/\" target=\"_blank\" class=\"btn btn-success taright\">View Preview</a>";
			echo'   </div>
          </div>';
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
			$imageid=$this->input->post('imageid');
			if(!empty($imageid))
			{
					/* $imagename = $this->AddProperty_model->Getotherdata('rp_property_images',array('propertyImageID'=>$imageid));
					if(!empty($imagename)){  
					$imgName=$imagename[0]->propertyImageName; */
					$this->AddProperty_model->Deletepropertyimage($this->input->post('imageid'));
					
					/* $originalPath  = "/data/homeonline/$this->severname/public/uploads/property/images/original/".$imgName; 
					$commonThumbPath = "/data/homeonline/$this->severname/public/uploads/property/images/thumb/".$imgName;
					$mediumPath   =  "/data/homeonline/$this->severname/public/uploads/property/images/medium/".$imgName;
					$lightboxPath       = "/data/homeonline/$this->severname/public/uploads/property/images/lightbox/".$imgName;
					
					if (file_exists($originalPath)){unlink($originalPath);}
					if (file_exists($commonThumbPath)){unlink($commonThumbPath);}
					if (file_exists($mediumPath)){unlink($mediumPath);}
					if (file_exists($lightboxPath)){unlink($lightboxPath);} */
					
					echo"Image Deleted Successfully!!";
					//}
			}else{
					echo"Image Deletion Fail!!";
			}
		
	}
/*Delete property image End.............................................................................................................*/

/*Plan Checked And Consumued Start.............................................................................................................*/
	function checkandconsumuedplan($objectid=false,$lasturl=false,$objecttype=false,$userid=false,$status=false,$newplan=false)
	{	
		$date=date("Y-m-d");
		
		if(!empty($objectid) && !empty($lasturl) && !empty($objecttype) && !empty($userid) && !empty($status)){
			
			$planid='';
			
			if(!empty($objectid) && !empty($objecttype) && !empty($userid)){
				
				$propertyfilter=array('objectID'=>$objectid,'objectType'=>$objecttype);
				
				$propertydetails=$this->AddProperty_model->Getotherdata('rp_dbho_plan_mapping',$propertyfilter);
				
				if(!empty($propertydetails)){
					
					$planid=$propertydetails[0]->planID;
				}
				else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("PropertyListing").'No Plan Found For This Property!!!');
					redirect("$lasturl");
				}
				
				if(!empty($newplan)){
					$planid=$newplan;
				}
				/*............Get Plan Information Of this User Start...............*/
				if(!empty($planid) && !empty($userid)){
					
					$plandetails=$this->AddProperty_model->Getuserplandata($planid,$userid);
					
					if(!empty($plandetails)){
						
						$planquantity=$plandetails[0]->Quantity;
						$plancurrentexpiry1=$plandetails[0]->currentExpiry;
						$plancurrentexpiry=strtotime($plancurrentexpiry1);
						$planunitconsumued=$plandetails[0]->plan_unitconsumed;
						$planstatus=$plandetails[0]->status;
						$currentdate=strtotime($date);
						$campaignID=$plandetails[0]->campaignID;
						$planupdatefilter=array('campaignID'=>$campaignID,'planID'=>$planid);
						
						if($planstatus=='Active' && $plancurrentexpiry<$currentdate){
							
							$data=array('status'=>'Inactive');
							$this->AddProperty_model->InsertProperty('rp_dbho_campaignplan',$data,$planupdatefilter);
							$this->AddProject_model->InsertProject('rp_user_to_plan',array('planStatus'=>'Inactive'),array('userID'=>$userid,'planID'=>$planid,'planStatus'=>'Active','currencyID'=>3));
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing").'Your Plan Is Expired!!!');
							redirect("$lasturl");
						}
						elseif($planstatus=='Active' && $currentdate<=$plancurrentexpiry)
						{
							
							if($planquantity<=$planunitconsumued){
								
								$data=array('status'=>'Inactive');
								$this->AddProperty_model->InsertProperty('rp_dbho_campaignplan',$data,$planupdatefilter);
								$this->AddProject_model->InsertProject('rp_user_to_plan',array('planStatus'=>'Inactive'),array('userID'=>$userid,'planID'=>$planid,'planStatus'=>'Active','currencyID'=>3));
								$this->session->set_flashdata('message_type', 'error');
								$this->session->set_flashdata('message', $this->config->item("PropertyListing").'You Have Insufficient Balance. Please Update your Plan Or Use Another Plan!!!');
								redirect("$lasturl");
								
							}
							else{
								
								$Get_rp_user_to_plan_Details=$this->AddProperty_model->Getotherdata('rp_user_to_plan',array('userID'=>$userid,'planID'=>$planid,'planStatus'=>'Active'));
								
								if(empty($Get_rp_user_to_plan_Details)){
									
									$this->session->set_flashdata('message_type', 'error');
									$this->session->set_flashdata('message', $this->config->item("PropertyListing").'No Active Plan Found For This User!!!');
									redirect("$lasturl");
									
								}
								
								$data=array('plan_unitconsumed'=>$planunitconsumued+1);
								$this->AddProperty_model->InsertProperty('rp_dbho_campaignplan',$data,$planupdatefilter);
								
								if(!empty($Get_rp_user_to_plan_Details)){
									
								$rpuserstoplandata=array(
								'planUpdateDate'=>date("Y-m-d h:i:s"),
								'planPropertyCountBalance'=>$Get_rp_user_to_plan_Details[0]->planPropertyCountBalance-1,
								'planProjectCountBalance'=> $Get_rp_user_to_plan_Details[0]->planProjectCountBalance-1,
								'planFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planFeaturedCountBalance-1,
								'planProjectFeaturedCountBalance'=>$Get_rp_user_to_plan_Details[0]->planProjectFeaturedCountBalance-1,
								'totalPropSellCount'=>$Get_rp_user_to_plan_Details[0]->totalPropSellCount-1,
								'totalPropRentCount'=>$Get_rp_user_to_plan_Details[0]->totalPropRentCount-1,
								'totalPropLeaseCount'=>$Get_rp_user_to_plan_Details[0]->totalPropLeaseCount-1,
								'planEnquiryCountBalance'=>$Get_rp_user_to_plan_Details[0]->planEnquiryCountBalance-1
								 );
								 
								$this->AddProject_model->InsertProject('rp_user_to_plan',$rpuserstoplandata,array('userID'=>$userid,'planID'=>$planid,'planStatus'=>'Active','currencyID'=>3));
								
								}
								
								$planlogdata=array(			'campaignID'=>$campaignID,
															'planID'=>$planid,
															'objectID'=>$objectid,
															'objectType'=>$objecttype,
															'status'=>$status,
															'createdOn'=>date("Y-m-d h:i:s"),
															'createdBy'=>$this->userinfo['adminUserFirstName'],
															'createdById'=>$this->userinfo['adminUserID'],
															'userAccessType'=>'Admin'
														 );
								$this->AddProject_model->InsertProject('rp_dbho_plan_consumption_log',$planlogdata);
								
								if($planquantity==$planunitconsumued+1){
									
									$data=array('status'=>'Inactive');
									$this->AddProperty_model->InsertProperty('rp_dbho_campaignplan',$data,$planupdatefilter);
									$this->AddProject_model->InsertProject('rp_user_to_plan',array('planStatus'=>'Inactive'),array('userID'=>$userid,'planID'=>$planid,'planStatus'=>'Active','currencyID'=>3));
									$planlogdata1=array(	'campaignID'=>$campaignID,
															'planID'=>$planid,
															'objectID'=>0,
															'objectType'=>'All Unit Consumued',
															'status'=>'Inactive',
															'createdOn'=>date("Y-m-d h:i:s"),
															'createdBy'=>$this->userinfo['adminUserFirstName'],
															'createdById'=>$this->userinfo['adminUserID'],
															'userAccessType'=>'Admin'
														 );
									$this->AddProject_model->InsertProject('rp_dbho_plan_consumption_log',$planlogdata1);
								}
								
								return true;
								
							}
							
						}
						
					}
					else{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('message', $this->config->item("PropertyListing").'No Active Plan Found For This User!!!');
						redirect("$lasturl");
					}
					
					
				}
				/*............Get Plan Information Of this User Start...............*/
				
			}
			
		}
		else{
			
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message', $this->config->item("PropertyListing").'This Action Is Not Apply.Please Try Again!!!');
			redirect("$lasturl");	
		}	
		
	}
/*Plan Checked And Consumued End.............................................................................................................*/


/* Property Action Start.............................................................................................................*/
	function PropertyAction($action=false,$propertyid=false)
	{	
			$idproperty=$this->input->post('propertyID');
			if(!empty($idproperty)){
				$propertyid=$idproperty;
			}
			
			if(!empty($action) && !empty($propertyid))
			{
				$filter=array('propertyID'=>$propertyid);
				
				$propertyoldstatus='';
				$userid='';
				$propertykey='';
				$propertydetails=$this->AddProperty_model->Getotherdata('rp_properties',$filter);
				
				if(!empty($propertydetails)){
					
					$propertyoldstatus=$propertydetails[0]->propertyStatus;
					$userid=$propertydetails[0]->userID;
					$propertykey=$propertydetails[0]->propertyKey;
				}
				
				if($action=="propertystatus")
				{
					$statusproperty=$this->input->post('propertystatus');
					$idproperty=$this->input->post('propertyID');
					
					if(!empty($statusproperty) && !empty($propertyid)){
						
						if($statusproperty=='Active'){
							
							if($propertyoldstatus=='Active'){
								
								$this->session->set_flashdata('message_type', 'success');
								$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Updated successfully");
							
							}
							else{
								
							if($this->checkandconsumuedplan($propertyid,'AddProperty/PropertyListing','property',$userid,'Active')==true){	
							$data=array('propertyStatus'=>'Active','propertyUpdateDate'=>date("Y-m-d h:i:s"));
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							
							$propertyfilter=array('objectID'=>$propertyid,'objectType'=>'property');
							$expirydate=strtotime("60 day",strtotime(date("Y-m-d")));
							$propertyexpirydate=array('property_expiry_date'=>date("Y-m-d",$expirydate));
							$propertydetails=$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$propertyexpirydate,$propertyfilter);
							
							$planmappingdata=array('propertyStatus'=>'Active');
							$this->AddProperty_model->InsertProperty('rp_properties',$planmappingdata,$filter);
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Active','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Activated successfully");
							}
							
							}
						}
						elseif($statusproperty=='Draft'){
							
							if($propertyoldstatus=='Draft'){
								
								$this->session->set_flashdata('message_type', 'success');
								$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Updated successfully");
							
							}
							else{
							
							$data=array('propertyStatus'=>'Draft');
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Draft','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Added To Draft Successfully");
						
							}
						}
						else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing").'This Action Is Not Apply.Please Try Again!!!');
						}
					}
					else{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('message', $this->config->item("PropertyListing").'This Action Is Not Apply.Please Try Again!!!');
					}
				}
				elseif($action=="Active"){
					
						if($propertyoldstatus=='Active'){
								
								$this->session->set_flashdata('message_type', 'success');
								$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Updated successfully");
							
							}
							else{
								
							if($this->checkandconsumuedplan($propertyid,'AddProperty/PropertyListing','property',$userid,'Active')==true){	
							$data=array('propertyStatus'=>'Active','propertyUpdateDate'=>date("Y-m-d h:i:s"));
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							
							$propertyfilter=array('objectID'=>$propertyid,'objectType'=>'property');
							$expirydate=strtotime("60 day",strtotime(date("Y-m-d")));
							$propertyexpirydate=array('property_expiry_date'=>date("Y-m-d",$expirydate));
							$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$propertyexpirydate,$propertyfilter);
							
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Active','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Activated successfully");
							}
							
							}	
				}
				elseif($action=="Draft"){
					
						if($propertyoldstatus=='Draft'){
								
								$this->session->set_flashdata('message_type', 'success');
								$this->session->set_flashdata('message', $this->config->item("PropertyListing")."This Property $propertykey Is Already In Draft !!");
							
							}
							else{
					
							$data=array('propertyStatus'=>'Draft');
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Draft','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Inactivated Successfully");
							
							}	
				}
				elseif($action=="Refresh"){
					
						$withoutplan =$this->input->post('withplan');
						$planid      =$this->input->post('userplanID');
						if($withoutplan=='Yes'){
							
							$data=array('propertyUpdateDate'=>date("Y-m-d h:i:s"));
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							$propertyfilter=array('objectID'=>$propertyid,'objectType'=>'property');
							$expirydate=strtotime("60 day",strtotime(date("Y-m-d")));
							$propertyexpirydate=array('property_expiry_date'=>date("Y-m-d",$expirydate));
							$propertydetails=$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$propertyexpirydate,$propertyfilter);
							
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Admin Refresh','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Refresh successfully Without Plan!!");
							
							
						}
						else{
							
							if($this->checkandconsumuedplan($propertyid,'AddProperty/PropertyListing','property',$userid,'Refresh',$planid)==true){	
							$data=array('propertyUpdateDate'=>date("Y-m-d h:i:s"));
							$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
							$propertyfilter=array('objectID'=>$propertyid,'objectType'=>'property');
							$expirydate=strtotime("60 day",strtotime(date("Y-m-d")));
							$propertyexpirydate=array('property_expiry_date'=>date("Y-m-d",$expirydate),'planID'=>$planid);
							$propertydetails=$this->AddProperty_model->InsertProperty('rp_dbho_plan_mapping',$propertyexpirydate,$propertyfilter);
							
							$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Refresh','userAccessType'=>'Admin');
							$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Refresh successfully");
							}
							
						}
					
							
							
					
				}
				elseif($action=="Delete"){
					$data=array('propertyStatus'=>'Deleted');
					$this->AddProperty_model->InsertProperty('rp_properties',$data,$filter);
					$logdata=array('propertyID'=>$propertyid,'userName'=>$this->userinfo['adminUserFirstName'],'userID'=>$this->userinfo['adminUserID'],'createdBy'=>$this->userinfo['adminUserFirstName'],'actionType'=>'Deleted','userAccessType'=>'Admin');
					$this->AddProperty_model->Insert_data('rp_dbho_property_log',$logdata);
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('message', $this->config->item("PropertyListing")."Property $propertykey Deleted successfully");
				
				}
				else{
					
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("PropertyListing").'This Action Is Not Apply.Please Try Again!!!');
				}
				
			}
			else{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("PropertyListing").'Invalid Data Post.Please Try Again!!!');
			}
		redirect('AddProperty/PropertyListing');
	}
/*Property Action End.............................................................................................................*/



public function editImageTag(){
		$imageID = $this->input->post('imageID');
		$imagetagText = $this->input->post('imagetagText');
		$imagetagText1 = $this->input->post('imagetagText1');
		echo $responce=$this->AddProperty_model->editImageTag($imageID,$imagetagText,$imagetagText1);
		exit;
	}
	
	/***************************************************Google Api For Nearest Place start*********************************************************/
	public function googleLocalPropertyInfoAction($propertyID=false,$latitude=false,$longitude=false)
	{
		$propertyID		= $propertyID;
        $latitude   	= $latitude;
        $longitude  	= $longitude;
		$googleApiKey	= 'AIzaSyD6qxVW9JcJGXWjZ1j3h55YY1CANMqHqOQ';
		$radius			= '5000';
		
		$resLocalInfoTypes  = $this->AddProperty_model->fetchLocalInfoTypes();
		
		if(count($resLocalInfoTypes)!= 0)
        {     
            for($i=0; $i<count($resLocalInfoTypes); $i++)
            {                
                $json = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$latitude.",".$longitude."&radius=".$radius."&types=".$resLocalInfoTypes[$i]->localinfoTypeUrlKey."&key=".$googleApiKey."");
                $data = json_decode($json);
				$this->AddProperty_model->saveGoogleLocalInfos($data->results,$resLocalInfoTypes[$i]->localinfoTypeID,$propertyID);
            }
        } 
	}
	
	
	/***************************************************Google Api For Nearest Place End**********************************************************/
	
	/*...........................................Set As Cover Image For Property Start........................................*/
	public function isCoverImage(){
		$imageID = $this->input->post('imageID');
		$propertyid = $this->input->post('propertyid');
		echo $responce = $this->AddProperty_model->isCoverImage($imageID,$propertyid);
		exit;
	}
	/*...........................................Set As Cover Image For Property End........................................*/

}
?>