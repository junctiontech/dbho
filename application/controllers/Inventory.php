<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('inventory_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
// Inventory Started Here.................................................................................................................

/*Inventory view Load Start.............................................................................................................*/

	function index($inventoryconsumptionid=FALSE,$campaignid=false)
	{	
		if(!empty($campaignid) && !empty($inventoryconsumptionid)){
			
			$this->data['campaigninventoryid']=$inventoryconsumptionid;
			$this->data['campaignid']=$campaignid;
			$this->data['campaigndetails']=$this->inventory_model->get_campaigninventory($campaignid,$inventoryconsumptionid);
			
		}elseif(!empty($inventoryconsumptionid))
		{
			$this->data['inventoryconsumptionid']=$inventoryconsumptionid;
			$filter=array('planinventoryconsumptionID'=>$inventoryconsumptionid);
			$this->data['inventoryupdate']=$inventoryupdate=$this->inventory_model->select_for_update('dbho_planinventoryconsumption',$filter);
			
			$filter1=array('inventoryID'=>$inventoryupdate[0]->inventoryID);
			$this->data['inventoryupdateid']=$this->inventory_model->select_for_update('dbho_inventorymaster',$filter1);
		}
		
			$this->data['inventory']=$this->inventory_model->get_inventory();
			$this->data['company_name']=$this->inventory_model->get_company_name();
			$this->data['cities']=$this->inventory_model->get_city();
			$this->data['projects']=$this->inventory_model->get_project();
			
			$this->parser->parse('header',$this->data);
			$this->load->view('inventory',$this->data);
			$this->parser->parse('footer',$this->data);
	}
	
/*Inventory view Load End.............................................................................................................*/
	
/*Inventory create insert and update start .........................................................................................*/

	function Add_inventory()
	{	
		if(!empty($this->input->post('submit')))
		{
			$campaignid=$this->input->post('campaignid');
			$type=$this->input->post('type');
			$user_id=$this->input->post('user_id');
			$inventorytypeid=$this->input->post('inventoryid');
			$city_id=$this->input->post('city_id');
			$project_id=$this->input->post('project_id');
			$start_date=$this->input->post('start_date');
			$duration=$this->input->post('duration');
			$weightage=$this->input->post('weightage');
			$remark=$this->input->post('remark');
			
			if(empty($campaignid))
			{
				$filter=array('inventorytypeID'=>$inventorytypeid,'City'=>$city_id);
				$inventory_id=$this->inventory_model->check('dbho_inventorymaster',$filter);
				
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
						'upload_path'	  => './upload_banner/',
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
				
					if(empty($this->input->post('inventoryconsumptionid')))
					{
					
						if(!empty($campaignid))
						{
						
							$campaigninventorydetails=$this->inventory_model->get_campaigninventorydetails($campaignid,$user_id,$inventoryid);
						
								if(!empty($campaigninventorydetails))
								{
													if(strtotime($start_date)<strtotime($campaigninventorydetails[0]->startDate))
													{	$camDate=$campaigninventorydetails[0]->startDate;
												
														$this->session->set_flashdata('message_type', 'error');
														$this->session->set_flashdata('message', $this->config->item("index")."Start Date Should Not Before Campaign Start Date. Campaign Start Date Is $camDate !!");
														redirect('Inventory');
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
																	
																	redirect('Inventory');
													}
													
													if($duration>$campaigninventorydetails[0]->duration){
														print_r($duration);echo"<br>";
														print_r($campaigninventorydetails[0]->duration);die;
																	$due=$campaigninventorydetails[0]->duration;
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory Has Max Duration $due . Please Insert Duration Less Than Or Equal To $due !!");
																	
																	redirect('Inventory');
													}
													
													$inventory_availablity=$this->inventory_model->campaigninventory_availablity($inventoryid,$datess,$campaignid,$user_id);
						
														if(!empty($inventory_availablity))
														{
					
															if(count($inventory_availablity) >= $campaigninventorydetails[0]->quantity)
															{
						
																$dates=$inventory_availablity[0]->date;
							
						
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date. !!");
																	
																	redirect('Inventory');
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
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date. !!");
															
															redirect('Inventory');
														}
					
													}
					
										}
								}else
								{
						
										$this->session->set_flashdata('message_type', 'error');
										$this->session->set_flashdata('message', $this->config->item("index")." This Campaign Is Not Found!!");
										
										redirect('Inventory');
						
								}	
						
						}
						else
						{
					
							$filter=array('inventoryID'=>$inventoryid);
							$inventory_details=$this->inventory_model->check('dbho_inventorymaster',$filter);
			
								if(!empty($inventory_details))
								{
				
									/*$filter1=array('inventoryID'=>$inventoryid);
									$inventory_consumption=$this->inventory_model->check('dbho_planinventoryconsumption',$filter1);
				
										if(!empty($inventory_consumption))
										{
					
											if(count($inventory_consumption)>=$inventory_details[0]->MaximumQuantity)
											{
												
												$quan=$inventory_details[0]->MaximumQuantity;
												
													if($inventory_details[0]->OverdrawingAllowed!='Yes')
													{
														$this->session->set_flashdata('message_type', 'error');
														$this->session->set_flashdata('message', $this->config->item("index")." The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Please Select DIfferent Inventory!!");
														
														redirect('Inventory');
														
													}
													else
													{
														
														$this->session->set_flashdata('category_error',"Warning: The Maximum Quantity Of This Inventory Is $quan And All Are Booked, Overdrawing Is Allowed !!");
													}
					
											}
										}*/
				
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
					
																if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity)
																{
						
																	$dates=$inventory_availablity[0]->date;
							
						
																	$this->session->set_flashdata('message_type', 'error');
																	$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date. !!");
																	redirect('Inventory');
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
					
														if(count($inventory_availablity) >= $inventory_details[0]->MaximumQuantity)
														{
						
															$dates=$inventory_availablity[0]->date;
							
						
															$this->session->set_flashdata('message_type', 'error');
															$this->session->set_flashdata('message', $this->config->item("index")."This Inventory is Already Booked For $dates, Please Choose DIfferent Date. !!");
															redirect('Inventory');
															
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
					
						if(!empty($this->input->post('inventoryconsumptionid')))
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
			
			$inventoryname=$this->input->post('inventoryname');
			$status=$this->input->post('status');
			$companyname=$this->input->post('companyname');
			$emailid=$this->input->post('emailid');
			$weightage=$this->input->post('weightage');
			$city=$this->input->post('city');
			
			$query="";
			if(!empty($inventoryname)){ $query.="and `inventoryDescription` like TRIM('%$inventoryname%')"; }
			if(!empty($status)){ $query.="and `Status` like TRIM('%$status%')"; }
			if(!empty($companyname)){ $query.="and `userCompanyName` like TRIM('%$companyname%')"; }
			if(!empty($emailid)){ $query.="and `userEmail` like TRIM('%$emailid%')"; }
			if(!empty($weightage)){ $query.="and `Weightage` like TRIM('%$weightage%')"; }
			if(!empty($city)){ $query.="and dbho_planinventoryconsumption.City='$city'"; }
			
			
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
		
		if(!empty($this->input->post('submit')))
		{
			
			$inventoryname=$this->input->post('inventoryname');
			$inventoryunit=$this->input->post('inventoryunit');
			$maxquantity=$this->input->post('maxquantity');
			$overdrawingallow=$this->input->post('overdrawingallow');
			$city_id=$this->input->post('city_id');
			
				if(!empty($inventoryname) && !empty($inventoryunit) && !empty($maxquantity) && !empty($overdrawingallow) && !empty($city_id))
				{
					
					$this->inventory_model->insert_addinventorytype($inventoryname,$inventoryunit,$maxquantity,$overdrawingallow,$city_id);
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('message', $this->config->item("index")." Inventory Type Added Successfully!!");
					
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

		
}
