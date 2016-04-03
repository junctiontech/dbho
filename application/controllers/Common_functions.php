<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_functions extends CI_Controller {

	 /*
	 # Programmer : Rohit thakur
	 # Common_functions controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->load->model('inventory_model');
		$this->load->model('AddProperty_model');
		$this->data['base_url']=base_url();
		$this->load->model('manage_user_plan_model');
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$this->severname=$this->data['severname']=$_SERVER['HTTP_HOST'];
		
	}
	
	public function get_planpriority()
	{
		$plantypeid = $this->input->post('plantypeid');
		$plantypeid=explode("-",$plantypeid);
		$planpriority = $this->utilities->get_planpriority($plantypeid[0]);
		print_r($planpriority[0]->Priority);
	}
	
	public function get_usertype()
	{
		$userid = $this->input->post('userid');
		
		$user_type = $this->utilities->get_usertype($userid);
		if(!empty($user_type)){
		print_r($user_type[0]->userTypeName);
		}
	}
	
	public function getimagesafterupload()
	{
		$propertyID = $this->input->post('propertyID');
		$baseurl=base_url().'assests/images/cover.png';
		$propertyimages=$this->AddProperty_model->Getpropertyimages($propertyID);
		if(!empty($propertyimages)){
			
		//start....................
		
		
                                 echo' <div class="x_content ">
									<div class="row">';
									$i=1; foreach($propertyimages as $propertyimagess){ 
										echo"<div class=\"col-md-55 imagediv_$i\" id=\"imagediv_$i\">";
                                        echo'    <div class="thumbnail">
                                                <div class="image view view-first" style="relative">';
												 if($propertyimagess->isCoverImage=="Yes"){
											echo"	<div class=\"cover-img\" id=\"firsttimeimg_$propertyimagess->propertyImageID\"><img src=\"$baseurl\"/></div>";
												 }
										echo"		<div class=\"cover-img\" id=\"ajaxtimeimg_$propertyimagess->propertyImageID\" style=\"display:none;\"><img src=\"$baseurl\"/></div>
                                                    <img style=\"width: 100%; display: block;\" src=\"http://$this->severname/public/uploads/property/images/medium/$propertyimagess->propertyImageName\" alt=\"image\" />
                                                    <div class=\"mask\">
                                                        <div class=\"tools tools-bottom\">
														
														<a href=\"javascript:;\" onclick=\"return isCoverImage($propertyimagess->propertyImageID,$propertyimagess->propertyID)\">Set as Cover Image</a> 
                                                            <a href=\"javascript:;\" onClick=\"ConfirmDelete($propertyimagess->propertyImageID,'imagediv_$i')\"><i class=\"fa fa-times\"></i></a>
                                                        </div>";
                                         echo'           </div>
                                                </div>
												<script>function ConfirmDelete(aa,bb)
												{
												  var x = confirm("Are you sure you want to delete?");
												  if (x)
													 deleteiamge1(aa,bb);
												  else
													return false;
												}</script>
                                                <div class="caption">';
                                        echo"            <p><span id=\"textspan_$propertyimagess->propertyImageID\"> $propertyimagess->propertyImageTitle</span><span id=\"newtextspan_$propertyimagess->propertyImageID\"> </span><a href=\"javascript:void(0);\" onclick=\"return appImageEdit($propertyimagess->propertyImageID)\"><i class=\"fa fa-edit\"></i></a></p>
													<p><span id=\"textspan1_$propertyimagess->propertyImageID\">Priority- $propertyimagess->propertyImagePriority</span><span 
													id=\"newtextspan1_$propertyimagess->propertyImageID\"> </span><a href=\"javascript:void(0);\" onclick=\"return appImageEdit1($propertyimagess->propertyImageID)\"><i class=\"fa fa-edit\"></i></a></p>
										
										
										
										
											<div class=\"form-group editmode\" style=\"display:none;\" id=\"ajaxeditimg_$propertyimagess->propertyImageID\">											
												 <input type=\"text\" class=\"form-control\" value=\"$propertyimagess->propertyImageTitle\" id=\"imgtagedit_$propertyimagess->propertyImageID\">
												 <button type=\"button\" class=\"btn btn-primary\" onclick=\"return editImageTag($propertyimagess->propertyImageID);\">Edit</button>
												  <button type=\"button\" class=\"btn btn-primary imgtagclose\">Close</button>
											</div>
											<div class=\"form-group editmode\" style=\"display:none;\" id=\"ajaxeditimg1_$propertyimagess->propertyImageID\">											
												 <input type=\"text\" class=\"form-control\" value=\"$propertyimagess->propertyImagePriority\" id=\"imgtagedit1_$propertyimagess->propertyImageID\">
												 <button type=\"button\" class=\"btn btn-primary\" onclick=\"return editImageTag($propertyimagess->propertyImageID);\">Edit</button>
												  <button type=\"button\" class=\"btn btn-primary imgtagclose\">Close</button>
											</div>
										</div>
                                            </div>
                                        </div>";
										 $i++; } 
								echo'		</div>
										</div>';
                                  
		
		//End......................
		
		}else{
			echo"fail";
		}
	}
	
	public function get_planbyusertype()
	{ 
		$userid = $this->input->post('userid');
		$rowcount = $this->input->post('rowcount');
		if(!empty($rowcount)){
			
		}else{
			$rowcount=0;
		}
		//print_r($userid);die;
		if(!empty($userid)){
		$user_type = $this->utilities->get_usertype($userid);
		$usertypeid=$user_type[0]->userTypeID;
		$user_typeplan = $this->utilities->get_planbyusertype($usertypeid);
		if(!empty($user_typeplan)){
		echo"<select onchange='checkplanavailable(this.value,this.id)' id='plan_$rowcount' required name='planid[]' class='select2_group form-control newin'>"; 
		echo "<option value=''>Select Plan</option>";
		foreach($user_typeplan as $plan1){
		echo "<option value=".$plan1->planID.">$plan1->planTitle";
		echo "</option>";
		}
		echo"</select>";
		}else{
			echo"<select onchange='checkplanavailable(this.value,this.id)' id='plan_$rowcount' required name='planid[]' class='select2_group form-control newin'>"; 
		echo "<option value=''>Plan Not Found!!</option>";
		
		echo"</select>";
		}
		}
	}
	
	public function getcityforinventory()
	{
		$inventoryid = $this->input->post('inventoryid');
		if(!empty($inventoryid)){
			
			$cityid = $this->utilities->getcityidforinventory($inventoryid);
			
		if(!empty($cityid)){
			
			$citiesin='';
			$i=1;
			foreach($cityid as $cityids){
				$citiesin.="$cityids->City";
				if(count($cityid)-1>=$i){
					$citiesin.=",";
				}
				$i++;
			}
			
			$inventorycity = $this->utilities->getcityforinventory($citiesin);
			
			echo"<select required name='cityid[]' class='select2_group form-control'>"; 
			echo "<option value=''>Select City</option>";
			foreach($inventorycity as $inventorycitys){
			echo "<option  value=".$inventorycitys->cityID.">$inventorycitys->cityName";
			echo "</option>";
			}
			echo"</select>";
		}else{
			echo"<select required name='cityid[]' class='select2_group form-control'>"; 
			echo "<option value=''>City Not Found!!</option>";
			
			echo"</select>";
		}
		
		}
	}
	
	
	public function getprojectname()
	{
		$userid = $this->input->post('userid');
		$inventorytype = $this->input->post('inventorytype');
		if(!empty($userid)){
			
			if($inventorytype==7 ){
				
				$extraqry=" and rp_properties.userID=$userid";
				$propertyname = $this->inventory_model->get_property($extraqry);
				
				if(!empty($propertyname)){
					
					echo'<label class="control-label col-md-2 col-sm-2 col-xs-12">Property Name <span id="project_idmes"  aria-hidden="true"></span></label>';
                    
					echo'<div id="projectname" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="project_id" class="select2_group form-control" name="project_id">
                        <option value="">Select Property</option>';
                          foreach($propertyname as $property){
							  
                       echo" <option value=\"$property->propertyID\" >$property->propertyName</option>";
					   
						 } 
                    echo' </select>
                    </div>';
				}else{
					
					echo'<label class="control-label col-md-2 col-sm-2 col-xs-12">Property Name <span id="project_idmes"  aria-hidden="true"></span></label>';
					echo'<div id="projectname" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="project_id" class="select2_group form-control" name="project_id">
                        <option value="">Property Not Found!!</option>';
                    echo' </select>
                    </div>';
				}
				
				
			}else{
				
				$extraqry=" and rp_projects.userID=$userid";
				$projectname = $this->inventory_model->get_project($extraqry);
			
		if(!empty($projectname)){
			echo'<label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name <span id="project_idmes"  aria-hidden="true"></span></label>';
			echo'<div id="projectname" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="project_id" class="select2_group form-control" name="project_id">
                        <option value="">Select Project</option>';
			foreach($projectname as $projectnames){
			echo "<option  value=".$projectnames->projectID.">$projectnames->projectName";
			echo "</option>";
			}
			echo' </select>
                    </div>';
		}else{
			echo'<label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name <span id="project_idmes"  aria-hidden="true"></span></label>';
					echo'<div id="projectname" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="project_id" class="select2_group form-control" name="project_id">
                        <option value="">Project Not Found!!</option>';
                    echo' </select>
                    </div>';
		}
				
			}
			
		}
	}
	
	
	public function getcityforcalendarinventory()
	{
		$inventoryid = $this->input->post('inventoryid');
		if(!empty($inventoryid)){
			
			$cityid = $this->utilities->getcityidforinventory($inventoryid);
			
		if(!empty($cityid)){
			
			$citiesin='';
			$i=1;
			foreach($cityid as $cityids){
				$citiesin.="$cityids->City";
				if(count($cityid)-1>=$i){
					$citiesin.=",";
				}
				$i++;
			}
			
			$inventorycity = $this->utilities->getcityforinventory($citiesin);
			
			echo"<select onchange='fill();' id='city_id' required name='cityid' class='select2_group form-control'>"; 
			echo "<option value=''>Select City</option>";
			foreach($inventorycity as $inventorycitys){
			echo "<option  value=".$inventorycitys->cityID.">$inventorycitys->cityName";
			echo "</option>";
			}
			echo"</select>";
		}else{
			echo"<select required name='cityid' class='select2_group form-control'>"; 
			echo "<option value=''>City Not Found!!</option>";
			echo"</select>";
		}
		
		}
	}
	
	public function checkplanavailable()
	{
		$planid = $this->input->post('planid');
		$userid = $this->input->post('userid');
		
		$plandetails = $this->utilities->checkplanavailable($planid,$userid);
		
		
		if(!empty($plandetails)){
			$datearray='';
			$quantityarray='';
			foreach($plandetails as $plandetailss){
				
				$datearray[]=$plandetailss->currentExpiry;
				$quantityarray[]=$plandetailss->Quantity-$plandetailss->plan_unitconsumed;
			}
			
			$max = max(array_map('strtotime', $datearray));
			
			date_default_timezone_set("Asia/Kolkata");
			
			$date=date("m/d/Y");
			
			if($max>=strtotime($date))
			{
				$indexno=array_search(date("m/d/Y",$max),$datearray);
				$date1=date("m/d/Y",$max);
				$newarr[]=array('quantity'=>$quantityarray[$indexno],'currentExpiry'=>"$date1");
				print_r(json_encode($newarr));
			}
			
		
		}
		
	}
	
	 
}	
?>
