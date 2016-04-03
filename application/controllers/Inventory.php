<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('inventory_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->load->library("pagination");
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!empty!empty Please Login Again. "); redirect('Login');}
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

	}
	
// Inventory Started Here.................................................................................................................

/*Inventory view Load Start.............................................................................................................*/

	function index($inventoryconsumptionid=FALSE,$campaignid=false)
	{	
		$userid='';
		if(!empty($campaignid) && !empty($inventoryconsumptionid)){
			
			$this->data['campaigninventoryid']=$inventoryconsumptionid;
			$this->data['campaignid']=$campaignid;
			$this->data['campaigndetails']=$campaigndetails=$this->inventory_model->get_campaigninventory($campaignid,$inventoryconsumptionid);
			if(!empty($campaigndetails)){
				$user=$campaigndetails[0]->userID;
				if(!empty($user)){
					$userid="and rp_projects.userID=$user ";
				}
			
			}
		
		}elseif(!empty($inventoryconsumptionid))
		{
			$this->data['inventoryconsumptionid']=$inventoryconsumptionid;
			$filter=array('planinventoryconsumptionID'=>$inventoryconsumptionid);
			$this->data['inventoryupdate']=$inventoryupdate=$this->inventory_model->select_for_update('dbho_planinventoryconsumption',$filter);
			
			$filter1=array('inventoryID'=>$inventoryupdate[0]->inventoryID);
			$this->data['inventoryupdateid']=$this->inventory_model->select_for_update('dbho_inventorymaster',$filter1);
			
			$this->data['Duration']=$inventoryupdate[0]->Duration-$inventoryupdate[0]->DaysCompleted;
		}
		
			$this->data['inventory']=$this->inventory_model->get_inventory();
			$this->data['company_name']=$this->inventory_model->get_company_name();
			$this->data['cities']=$this->inventory_model->get_city();
			$this->data['projects']=$this->inventory_model->get_project($userid);
			
			$this->parser->parse('header',$this->data);
			$this->load->view('inventory',$this->data);
			$this->parser->parse('footer',$this->data);
	}
	
/*Inventory view Load End.............................................................................................................*/
	
/*Inventory create insert and update start .........................................................................................*/

	function Add_inventory()
	{	$submit=$this->input->post('submit');
		
		if(!empty($submit))
		{
			$campaignid=$this->input->post('campaignid');
			$type=$this->input->post('type');
			$user_id=$this->input->post('user_id');
			$inventorytypeid=$this->input->post('inventoryid');
			$city_id=$this->input->post('cityid');
			$project_id=$this->input->post('project_id');
			$start_date=$this->input->post('start_date');
			$duration=$this->input->post('duration');
			$weightage=$this->input->post('weightage');
			$remark=$this->input->post('remark');
			$image1=$this->input->post('image1');
			$image='';
			if(!empty($image1)){
				$image=$image1;
			}
			
			if(empty($campaignid))
			{
				$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$city_id);
				
				$inventory_id=$this->inventory_model->check('rp_dbho_inventorymaster',$filter);
				
				if(!empty($inventory_id))
				{
							$inventoryid=$inventory_id[0]->inventoryID;
					
				}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found For Selected City!!");
							redirect('Inventory');
				}
			}else{
				$inventoryid=$inventorytypeid;
			}
			
				if($_FILES['file']['name']!='')
				{
					$data['image_z1']= $_FILES['file']['name'];
					$image=sha1($_FILES['file']['name']).time().rand(0, 9);
				
					if(!empty($_FILES['file']['name']))
					{
				
						$config =  array(
						'upload_path'	  => '/data/homeonline/staging.homeonline.com/public/uploads/projectOfMonth',
						'file_name'       => $image,
						'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
						'overwrite'       => true);
						
							$this->upload->initialize($config);
							$this->load->library('upload');
				 
								if($this->upload->do_upload("file"))
								{
					
									$upload_data = $this->upload->data();
									$image=$upload_data['file_name'];
								}else
								{
										$this->upload->display_errors()."file upload failed";
										$image    ="";
								}
					}
				}
				
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
				if(!empty($user_id) && !empty($inventoryid) && !empty($city_id) && !empty($project_id)  && !empty($start_date) && !empty($duration) && !empty($weightage)  )
				{
					$invntorycomptionid=$this->input->post('inventoryconsumptionid');
					if(empty($invntorycomptionid))
					{
							$filter=array('inventoryID'=>$inventoryid);
							$inventory_details=$this->inventory_model->check('dbho_inventorymaster',$filter);
			
						if(!empty($campaignid))
						{
						
							$campaigninventorydetails =$this->inventory_model->get_campaigninventorydetails($campaignid,$user_id,$inventoryid);
						
								if(!empty($campaigninventorydetails))
								{
													if(strtotime($start_date)<strtotime($campaigninventorydetails[0]->startDate))
													{	$camDate=$campaigninventorydetails[0]->startDate;
												
														$this->session->set_flashdata('message_type', 'error');
														$this->session->set_flashdata('message', $this->config->item("index")."Start Date Should Not Before Campaign Start Date. Campaign Start Date Is $camDate!!");
														redirect('Inventory/index/'.$inventoryid."/".$campaignid);
													}
									$datess="";
									
										if($duration>1)
										{
					
											for($k=0;$k<=$duration;$k++)
											{
												if($k==0)
												{
													$datess.="'$start_date'";
													
												}else
												{
							
													$date = strtotime("$k day", strtotime($start_date));
														$dated=date("m/d/Y", $date);
														$datess.="'$dated'";
													
												}
													$inventory_availablityquantity=$this->inventory_model->campaigninventory_availablityquantity($inventoryid,$campaignid,$user_id);
													
													if(count($inventory_availablityquantity)>=$campaigninventorydetails[0]->quantity){
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For All Slotes !!");
																	
																	redirect('Inventory/index/'.$inventoryid."/".$campaignid);
													}
													
													if($duration>$campaigninventorydetails[0]->duration){
																	$due=$campaigninventorydetails[0]->duration;
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory Has Max Duration $due . Please Insert Duration Less Than Or Equal To $due !!");
																	
																	redirect('Inventory/index/'.$inventoryid."/".$campaignid);
													}
													
													$inventory_availablity=$this->inventory_model->campaigninventory_availablity($inventoryid,$datess,$campaignid,$user_id);
						
														if(!empty($inventory_availablity))
														{
					
															if(count($inventory_availablity) >= $campaigninventorydetails[0]->quantity && $inventory_details[0]->OverdrawingAllowed !='Yes' )
															{
						
																$dates=$inventory_availablity[0]->date;
							
						
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
																	
																	redirect('Inventory/index/'.$inventoryid."/".$campaignid);
															}
					
														}
														
														$inventory_availablity1=$this->inventory_model->inventory_availablity($inventoryid,$datess);
												
													if(!empty($inventory_availablity1))
													{
														
														if(count($inventory_availablity1) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
														{
						
															$dates=$inventory_availablity1[0]->date;
															$quan=$inventory_details[0]->MaximumQuantity;
						
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
															redirect('Inventory/index/'.$inventoryid."/".$campaignid);
															
														}elseif(count($inventory_availablity1) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
														{
														
														$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
														}
					
													}
					
											}
										}else
										{
												$datess="'$start_date'";
												
												$inventory_availablity=$this->inventory_model->campaigninventory_availablity($inventoryid,$datess,$campaignid,$user_id);
					
													if(!empty($inventory_availablity))
													{
														
					
														if(count($inventory_availablity) >= $campaigninventorydetails[0]->quantity)
														{
						
															$dates=$inventory_availablity[0]->date;
							
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
															
															redirect('Inventory/index/'.$inventoryid."/".$campaignid);
														}
					
													}
													
													$inventory_availablity1=$this->inventory_model->inventory_availablity($inventoryid,$datess);
												
													if(!empty($inventory_availablity1))
													{
														
														if(count($inventory_availablity1) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
														{
						
															$dates=$inventory_availablity1[0]->date;
															$quan=$inventory_details[0]->MaximumQuantity;
						
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
															redirect('Inventory/index/'.$inventoryid."/".$campaignid);
															
														}elseif(count($inventory_availablity1) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
														{
														
														$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
														}
					
													}
													
													
					
										}
										
										
										if($campaigninventorydetails[0]->quantity > $campaigninventorydetails[0]->UnitsConsumed)
										{
											$filter=array('campaignID'=>$campaignid,'inventoryID'=>$inventoryid);
											$this->inventory_model->insert_unit_consumption_inventory($campaignid,$inventoryid);
											//print_r($filter);die;
										}
										//print_r($campaigninventorydetails[0]->UnitsConsumed); print_r($campaigninventorydetails[0]->quantity);die;
								}else
								{
						
										$this->session->set_flashdata('message_type', 'error');
										$this->session->set_flashdata('message', $this->config->item("index")." This Campaign Is Not Found!!");
										
										redirect('Inventory/index/'.$inventoryid."/".$campaignid);
						
								}	
						
						}
						else
						{
					
							$filter=array('inventoryID'=>$inventoryid);
							$inventory_details=$this->inventory_model->check('dbho_inventorymaster',$filter);
			
								if(!empty($inventory_details))
								{
				
									$datess="";
											
											if($duration>1)
											{
					
												for($k=0;$k<=$duration;$k++)
												{
													
													if($k==0)
													{
														$datess.="'$start_date'";
														
													}
													else
													{
							
														$date = strtotime("$k day", strtotime($start_date));
														$dated=date("m/d/Y", $date);
														$datess.="'$dated'";
													}
						
														$inventory_availablity=$this->inventory_model->inventory_availablity($inventoryid,$datess);
						
															if(!empty($inventory_availablity))
															{
					
																if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
																{
						
																	$dates=$inventory_availablity[0]->date;
							
						
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
																	redirect('Inventory');
																}elseif(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
																{
																$quan=$inventory_details[0]->MaximumQuantity;
																$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
																}
					
															}
					
												}
											}
											else
											{
												
												$datess="'$start_date'";
												$inventory_availablity=$this->inventory_model->inventory_availablity($inventoryid,$datess);
												
													if(!empty($inventory_availablity))
													{
														
														if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
														{
						
															$dates=$inventory_availablity[0]->date;
							
						
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
															redirect('Inventory');
															
														}elseif(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
														{
														$quan=$inventory_details[0]->MaximumQuantity;
														$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
														}
					
													}
					
											}
				
				
				
				
				
								}
								else
								{
									$this->session->set_flashdata('message_type', 'error');
									$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found!!");
									redirect('Inventory');
								}
			
						}
			
					}
						$ivntryid=$this->input->post('inventoryconsumptionid');
						if(!empty($ivntryid))
						{
						
							$filter=array('planinventoryconsumptionID'=>$this->input->post('inventoryconsumptionid'));
							$this->inventory_model->insert_userplan($type,$user_id,$inventoryid,$city_id,$project_id,$image,$start_date,$duration,$weightage,$remark,$campaignid,$date,$filter);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Updated Successfully!!");
							
						}
						else
						{
						
							$this->inventory_model->insert_userplan($type,$user_id,$inventoryid,$city_id,$project_id,$image,$start_date,$duration,$weightage,$remark,$campaignid);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Added Successfully!!");
						}
				}
				else
				{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
							redirect('Inventory');
				}
		}
		else
		{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
							redirect('Inventory/Inventory_listing');
	}
	
/*Inventory create insert and update End .........................................................................................*/

/*Inventory_listing view Load Start.............................................................................................................*/

	function Inventory_listing($action=false)
	{	
		if($action=="search"){
			
			$this->data['inventoryname']=$inventoryname=$this->input->post('inventoryname');
			$this->data['status']=$status=$this->input->post('status');
			$this->data['companyname']=$companyname=$this->input->post('companyname');
			$this->data['emailid']=$emailid=$this->input->post('emailid');
			$this->data['weightage']=$weightage=$this->input->post('weightage');
			$this->data['city']=$city=$this->input->post('city');
			$this->data['projectname']=$projectname=$this->input->post('projectname');
			$this->data['startdate']=$startdate=$this->input->post('startdate');
			$this->data['enddate']=$enddate=$this->input->post('enddate');
			
			$query="";
			if(!empty($inventoryname)){ $query.="and `inventoryname` like TRIM('%$inventoryname%')"; }
			if(!empty($status)){ $query.="and `Status` like TRIM('%$status%')"; }
			if(!empty($companyname)){ $query.="and `userCompanyName` like TRIM('%$companyname%')"; }
			if(!empty($emailid)){ $query.="and `userEmail` like TRIM('%$emailid%')"; }
			if(!empty($weightage)){ $query.="and `Weightage` like TRIM('%$weightage%')"; }
			if(!empty($city)){ $query.="and rp_dbho_planinventoryconsumption.City='$city'"; }
			if(!empty($projectname)){ $query.="and `projectName` like TRIM('%$projectname%')"; }
			if(!empty($startdate)){ $query.="and StartDate>='$startdate'"; }
			//if(!empty($enddate)){ $query.="and StartDate<='strtotime('`StartDate` day', strtotime($enddate))'"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="InventoryList.csv"');
				print $this->inventory_model->get_inventorylist($query);
				exit();
			}
			
			
			$this->data['inventory_list']=$this->inventory_model->get_inventorylist($query);
			
		}else{
			
			$this->data['inventory_list']=$this->inventory_model->get_inventorylist();
			
		}	
			$this->data['cities']=$this->inventory_model->get_city();
			
			$this->parser->parse('header',$this->data);
			$this->load->view('inventory_listing',$this->data);
			$this->parser->parse('footer',$this->data);
	}
	
/*Inventory_listing view Load End.............................................................................................................*/

/*Add Inventory Type view Load Start.............................................................................................................*/

	function AddInventoryType()
	{	
		
			$this->data['inventorytypelist']=$this->inventory_model->get_inventorytypelist();
			
			$this->parser->parse('header',$this->data);
			$this->load->view('addinventorytype',$this->data);
			$this->parser->parse('footer',$this->data);
		
	}
	
/*Add Inventory Type view Load End.............................................................................................................*/
	
/*Add Inventory Type Modal view Load Start.............................................................................................................*/
	
	function loadmodal()
	{	
		$this->data['inventoryname']=$this->inventory_model->get_inventoryname();
		$this->data['cities']=$this->inventory_model->get_city();
		$this->load->view('addinventorytypemodal',$this->data);
	}
	
/*Add Inventory Type Modal view Load End.............................................................................................................*/

/*Add Inventory Type Insert Into Db Start.............................................................................................................*/
	
	function Insertinventorytype()
	{
		$submit=$this->input->post('submit');
		if(!empty($submit))
		{
			
			$inventoryname=$this->input->post('inventoryname');
			$inventoryunit=$this->input->post('inventoryunit');
			$maxquantity=$this->input->post('maxquantity');
			$overdrawingallow=$this->input->post('overdrawingallow');
			$city_id=$this->input->post('city_id');
			
				if(!empty($inventoryname) && !empty($inventoryunit) && !empty($maxquantity) && !empty($overdrawingallow) && !empty($city_id))
				{
					if(!empty($inventoryname) && !empty($city_id)){
						$filter=array('inventorytypeID'=>$inventoryname,'City'=>$city_id);
						$iventoryvalidation=$this->inventory_model->select_for_update('rp_dbho_inventorymaster',$filter);
						if(!empty($iventoryvalidation)){
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")."Can Not Create Same Inventory For Same City!!");
						}else{
							$this->inventory_model->insert_addinventorytype($inventoryname,$inventoryunit,$maxquantity,$overdrawingallow,$city_id);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Type Added Successfully!!");
						}
					}
					
					
				}
				else
				{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
					redirect('Inventory/AddInventoryType');
				}
			
		}
		else
		{
			
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
		
			redirect('Inventory/AddInventoryType');
	}
/*Add Inventory Type Insert Into Db End.............................................................................................................*/


/*InventoryAvailability view Load Start.............................................................................................................*/
	
	function InventoryAvailability()
	{	
		$submit=$this->input->post('submit');
		if(!empty($submit) ){
			$this->data['inventorytypeid']=$inventorytypeid=$this->input->post('inventoryid');
			$this->data['cityid']=$cityid=$this->input->post('cityid');
			if(!empty($inventorytypeid) && !empty($cityid))
			{
				$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$cityid);
				$inventory_id=$this->inventory_model->check('dbho_inventorymaster',$filter);
				$event='';
				if(!empty($inventory_id))
				{
							$inventoryid=$inventory_id[0]->inventoryID;
							$filter1=array('inventoryID'=>$inventoryid);
							$inventory_details=$this->inventory_model->check('dbho_inventorymaster',$filter1);
							
							$maxquantity=$inventory_details[0]->MaximumQuantity;
							$startingmonth=11;
							$startingyear=2015;
							$datesettting=date("m/d/Y");
							$dateexplode=explode("/",$datesettting);
							$endyear=$dateexplode[2]+1;
							for($startingyear;$startingyear<=$endyear;$startingyear++)
							{
								$year=$startingyear;
							  for($month=1;$month<=12;$month++)
							  { $DaysInMonth=cal_days_in_month(CAL_GREGORIAN,$month,$year);
								for($i=1;$i<=$DaysInMonth;$i++)
								{
									
									$date="$month/$i/$year";
									$date=strtotime($date);
									$date=date("m/d/Y",$date);
									$date="'$date'";
									$inventory_availablity=$this->inventory_model->inventory_availablity_calendar($inventoryid,$date);
									$countinventory=count($inventory_availablity);
									if($countinventory>=$maxquantity)
									{
										$event.="{title: 'Booked',start: new Date(new Date($date).setTime(new Date($date).getTime()-1 +  ( 24 * 60 * 60 * 1000))),color:'Red'}";
									}elseif($countinventory<$maxquantity && $countinventory !=0)
									{
										$available=$maxquantity-$countinventory;
										$event.="{title: '$available Available',start: new Date(new Date($date).setTime(new Date($date).getTime()-1 +  ( 24 * 60 * 60 * 1000))),color:'Yellow'}";
									}elseif($countinventory==0){
									$event.="{title: 'Available',start: new Date(new Date($date).setTime(new Date($date).getTime()-1 +  ( 24 * 60 * 60 * 1000))),color:'green'}";
									}
									
									if($i<$DaysInMonth){
										$event.=",";
									}
								}
								if($month<12){
										$event.=",";
									}
							  }
							  
							  if($startingyear<$endyear){
										$event.=",";
									}
							
							}
							$this->data['event']=$event;
							//print_r($event);die;
					
				}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found For Selected City!!");
							redirect('Inventory/InventoryAvailability');
				}
			}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
							redirect('Inventory/InventoryAvailability');
			}
			
		}
		$this->data['cities']=$this->inventory_model->get_city();
		$this->data['inventory']=$this->inventory_model->get_inventory();
		$this->parser->parse('header',$this->data);
		$this->load->view('inventoryavailability',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
/*InventoryAvailability view Load End.............................................................................................................*/


/*InventoryConsumption view Load Start.............................................................................................................*/
	
	function InventoryConsumption()
	{	$submit=$this->input->post('submit');
		if(!empty($submit) ){
			$this->data['inventorytypeid']=$inventorytypeid=$this->input->post('inventoryid');
			$this->data['cityid']=$cityid=$this->input->post('cityid');
			if(!empty($inventorytypeid) && !empty($cityid))
			{
				$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$cityid);
				$inventory_id=$this->inventory_model->check('dbho_inventorymaster',$filter);
				$event='';
				if(!empty($inventory_id))
				{
							$inventoryid=$inventory_id[0]->inventoryID;
							
							$inventory_consumption=$this->inventory_model->inventory_consumption_calendar($inventoryid);
							$count=count($inventory_consumption);
							$i=1;
							foreach($inventory_consumption as $inventory_consumption){
										$startdate=$inventory_consumption->StartDate;
										$duro=$inventory_consumption->Duration-1; $date = strtotime("$duro day", strtotime($inventory_consumption->StartDate));
										$enddate= date("m/d/Y", $date);
										if(!empty($inventory_consumption->CampaignID)){
										$campaign_name=$this->utilities->get_campaign_name($inventory_consumption->CampaignID); 
										
										if(!empty($campaign_name)){
											$company=$inventory_consumption->userCompanyName;
											$created=$campaign_name[0]->created;
											$campaignname= "$company   $created";
										}else{
										$campaignname="Free";
										}
										}else{
											$campaignname="Free";
										}
										$color= sprintf('#%06X', mt_rand(0, 0xFFFFFF));
										
										
									$event.="{title: '$campaignname',start: new Date(new Date('$startdate').setTime(new Date('$startdate').getTime()-1 +  ( 24 * 60 * 60 * 1000))),end:new Date(new Date('$enddate').setTime(new Date('$enddate').getTime()-1 +  ( 24 * 60 * 60 * 1000))),color:'$color'}";
									
									
									if($i<$count){
										$event.=",";
									}
									$i++;
								
								}
							  
							$this->data['event']=$event;
							//print_r($event);die;
					
				}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found For Selected City!!");
							redirect('Inventory/InventoryConsumption');
				}
			}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
							redirect('Inventory/InventoryConsumption');
			}
			
		}
		$this->data['cities']=$this->inventory_model->get_city();
		$this->data['inventory']=$this->inventory_model->get_inventory();
		$this->parser->parse('header',$this->data);
		$this->load->view('consumptionofinventory',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
/*InventoryConsumption view Load End.............................................................................................................*/

/*InventoryConsumption Log view Load Start.............................................................................................................*/
	
	function Inventorylog($action=false,$campaignid=false)
	{	
		
		
		$config = array();
        $config["base_url"] = base_url() . "Inventory/Inventorylog";
        $config["total_rows"] = $this->inventory_model->record_count('rp_dbho_inventory_log');
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li ><a class="active" >';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $this->data["links"] = $this->pagination->create_links();
		
		
		
		$query='';
		if(!empty($campaignid)){
			$this->data['campaignid']=$campaignid;
			$query.=" and rp_dbho_planinventoryconsumption.CampaignID=$campaignid";
		}
		
		if($action=="search"){
			
			$this->data['campaignname']=$campaignname=$this->input->post('campaignname');
			$this->data['companyname']=$companyname=$this->input->post('companyname');
			$this->data['inventoryname']=$inventoryname=$this->input->post('inventoryname');
			$this->data['projectname']=$projectname=$this->input->post('projectname');
			
			if(!empty($campaignname)){ $query.=" and `userCompanyName` like TRIM('%$campaignname%')"; }
			if(!empty($companyname)){ $query.="  and `userCompanyName` like TRIM('%$companyname%')"; }
			if(!empty($projectname)){ $query.=" and `projectName` like TRIM('%$projectname%')"; }
			if(!empty($inventoryname)){ $query.=" and `inventoryname` like TRIM('%$inventoryname%')"; }
			
			if($this->input->post('submit') == 'Export to CSV') {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="InventoryLog.csv"');
				
				print $this->inventory_model->inventorylog($query);
				exit();
			}
			
			$this->data['log_details']=$this->inventory_model->inventorylog($query,$config["per_page"], $page);
			
		}else{
		
		$this->data['log_details']=$this->inventory_model->inventorylog($query,$config["per_page"], $page);
		}
		$this->parser->parse('header',$this->data);
		$this->load->view('Inventorylog',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
/*InventoryConsumption Log view Load End.............................................................................................................*/


/*Paused Inventory Start.............................................................................................................*/
	
	function PausedInventory($planinventoryconsumptionID=false)
	{	
		if(!empty($planinventoryconsumptionID) )
		{
			$filter=array('planinventoryconsumptionID'=>$planinventoryconsumptionID,'status !='=>'Finished');
			if($this->inventory_model->Delete('rp_dbho_planinventoryconsumptiondates',$filter))
			{
				$filter1=array('planinventoryconsumptionID'=>$planinventoryconsumptionID);
				$data=array('status'=>'Paused');
				$this->inventory_model->update('rp_dbho_planinventoryconsumption',$data,$filter1);
				
				$data1=array('planinventoryconsumptionID'=>$planinventoryconsumptionID,'status'=>'Paused','createdBy'=>'rohit');
				$this->inventory_model->insert('rp_dbho_inventory_log',$data1);
				
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Paused Successfully!!");
							redirect('Inventory/Inventory_listing');
				
			}else{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Paused Fails!!");
							redirect('Inventory/Inventory_listing');
			}
				
		}else
		{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request, Inventory Consumption Id Is Missing!!");
							redirect('Inventory/Inventory_listing');
		}
			
		
	}
	
/*Paused Inventory End.............................................................................................................*/


/*Play Inventory Start.............................................................................................................*/
	
	function PlayInventoryModal($planinventoryconsumptionID=false)
	{	
		if(!empty($planinventoryconsumptionID) )
		{
			$this->data['planinventoryconsumptionID']=$planinventoryconsumptionID;
			$this->load->view('playinventorymodal',$this->data);
				
		}else
		{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request, Inventory Consumption Id Is Missing!!");
							$this->load->view('playinventorymodal',$this->data);
		}
			
		
	}
	
/*Play Inventory End.............................................................................................................*/

/*Play Inventory Creation Start.............................................................................................................*/
	
	function PlayInventoryCreation($planinventoryconsumptionID=false)
	{	
		$submit=$this->input->post('submit');
		
		if(!empty($submit))
		{
			$planinventoryconsumptionID=$this->input->post('planinventoryconsumptionID');
			$start_date=$this->input->post('start_date');
			
			date_default_timezone_set("Asia/Kolkata");
			$date=date("Y-m-d h:i:s");
			
				if(!empty($planinventoryconsumptionID) && !empty($start_date) )
				{
					$filter1=array('planinventoryconsumptionID'=>$planinventoryconsumptionID);
					$invntorycomptiondetails=$this->inventory_model->check('rp_dbho_planinventoryconsumption',$filter1);
					
					if(!empty($invntorycomptiondetails))
					{
						$duration=$invntorycomptiondetails[0]->Duration-$invntorycomptiondetails[0]->DaysCompleted;
						$filter=array('inventoryID'=>$invntorycomptiondetails[0]->inventoryID);
						$inventoryid=$invntorycomptiondetails[0]->inventoryID;
						$user_id=$invntorycomptiondetails[0]->UserID;
							$inventory_details=$this->inventory_model->check('dbho_inventorymaster',$filter);
			
								if(!empty($inventory_details))
								{
				
									$datess="";
											
											if($duration>1)
											{
					
												for($k=0;$k<=$duration;$k++)
												{
													
													if($k==0)
													{
														$datess.="'$start_date'";
														
													}
													else
													{
							
														$date = strtotime("$k day", strtotime($start_date));
														$dated=date("m/d/Y", $date);
														$datess.="'$dated'";
													}
						
														$inventory_availablity=$this->inventory_model->inventory_availablity($inventoryid,$datess);
						
															if(!empty($inventory_availablity))
															{
					
																if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
																{
						
																	$dates=$inventory_availablity[0]->date;
							
						
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
																	redirect('Inventory');
																}elseif(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
																{
																$quan=$inventory_details[0]->MaximumQuantity;
																$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
																}
					
															}
					
												}
											}
											else
											{
												
												$datess="'$start_date'";
												$inventory_availablity=$this->inventory_model->inventory_availablity($inventoryid,$datess);
												
													if(!empty($inventory_availablity))
													{
														
														if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed !='Yes')
														{
						
															$dates=$inventory_availablity[0]->date;
							
						
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date.!!");
															redirect('Inventory');
															
														}elseif(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity && $inventory_details[0]->OverdrawingAllowed =='Yes')
														{
														$quan=$inventory_details[0]->MaximumQuantity;
														$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
														}
					
													}
					
											}
				
				
				
				
				
								}
								else
								{
									$this->session->set_flashdata('message_type', 'error');
									$this->session->set_flashdata('message', $this->config->item("index")." This Inventory Is Not Found!!");
									redirect('Inventory');
								}
			
						
			
					}
						
						if(!empty($planinventoryconsumptionID))
						{
						
							$campaignid=$invntorycomptiondetails[0]->CampaignID;
							
							$this->inventory_model->insert_playinventory($user_id,$inventoryid,$start_date,$duration,$campaignid,$date,$planinventoryconsumptionID);
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('message', $this->config->item("index")." Inventory Started Successfully!!");
							
						}
						
				}
				else
				{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." All Fields Are Mendatory!!");
							redirect('Inventory');
				}
		}
		else
		{
							$this->session->set_flashdata('message_type', 'error');
							$this->session->set_flashdata('message', $this->config->item("index")." Invalid Request!!");
		}
							redirect('Inventory/Inventory_listing');
			
		
	}
	
/*Play Inventory Creation End.............................................................................................................*/



		
}
