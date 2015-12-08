<?php
class Inventory_model extends CI_Model
{
	//variable initialize
	var $title   = '';
	var $content = '';
	var $date    = '';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();

		//Load database connection
		$this->load->database();
	}
	
	function insert_userplan($type=false,$user_id=false,$inventory_id=false,$city_id=false,$project_id=false,$file=false,$start_date=false,$inventoryduration=false,$weightage=false,$remark=false,$campaignid=false,$date=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		
			if($filter)
			{
				$data=array('City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'Weightage'=>$weightage,'Remark'=>$remark);
				
				$db2->where($filter);
				$db2->update('dbho_planinventoryconsumption',$data);
				
			}
			else
			{
			
				$data2=array('inventoryID'=>$inventory_id,'UserID'=>$user_id,'UnitsConsumed'=>'','CampaignID'=>$campaignid,'City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'StartDate'=>$start_date,'Duration'=>$inventoryduration,'Weightage'=>$weightage,'Remark'=>$remark,'Status'=>'Created','DaysCompleted'=>'');
				
				$db2->insert('dbho_planinventoryconsumption',$data2);
				
					if($inventoryduration>1)
					{
						for($k=0;$k<=$inventoryduration-1;$k++)
						{
					
							if($k==0)
							{
								$datess=$start_date;	
							}
							else
							{
							
								$newdates=explode("/",$start_date);
								$add=$newdates[1]+$k;
								$datess="$newdates[0]/$add/$newdates[2]";
							}
							
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess);
											 
								$db2->insert('dbho_planinventoryconsumptiondates',$data3);
					
						}
					}
					else
					{
								$datess=$start_date;
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess);
								$db2->insert('dbho_planinventoryconsumptiondates',$data3);
								
					}
			}
	}
	
	function select_for_update($table=false,$filter=false)
   {		
			$db2 = $this->load->database('both', TRUE);
			
			$query = $db2->get_where($table, $filter);
			
			return $query->Result();
			
   }
	
	
	function get_company_name()
	{
			
			$qry = $this->db->query("select rp_users.userID,userCompanyName from rp_users,rp_user_details where
									rp_users.userID=rp_user_details.userID and rp_user_details.languageID='1'");	
									
			return $qry->Result();
			
	}
	
	function get_city()
	{
			$qry = $this->db->query("select rp_cities.cityID,cityName from rp_cities,rp_city_details where
									rp_cities.cityID=rp_city_details.cityID and rp_city_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function get_project()
	{
			$qry = $this->db->query("select rp_projects.projectID,projectName from rp_projects,rp_project_details where
									rp_projects.projectID=rp_project_details.projectID and rp_project_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function get_inventory()
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select dbho_inventorytype.inventorytypeID,inventoryDescription from dbho_inventorytype where
									dbho_inventorytype.inventorytypeID and dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
	
	function get_inventorylist($query=false)
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select planinventoryconsumptionID,dbho_inventorymaster.inventoryID,dbho_planinventoryconsumption.CampaignID,userCompanyName,userEmail,cityName,userPhone,inventoryDescription,projectName,dbho_planinventoryconsumption.StartDate,Duration,Weightage from homeonline_junction.dbho_inventorymaster,homeonline_junction.dbho_inventorytype,homeonline_junction.dbho_planinventoryconsumption,
						 homeonline.rp_users,homeonline.rp_user_details,homeonline.rp_city_details,homeonline.rp_project_details where
			dbho_inventorymaster.inventorytypeID=dbho_inventorytype.inventorytypeID and
			dbho_inventorymaster.inventoryID=dbho_planinventoryconsumption.inventoryID and
			dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			dbho_planinventoryconsumption.City=rp_city_details.cityID and
			dbho_planinventoryconsumption.ProjectID=rp_project_details.projectID and
			dbho_inventorytype.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1' and
			rp_project_details.languageID='1' $query");	
			//echo $db3->last_query();
			return $qry->Result();	
	}
	
	function check($table=false,$filter=false)
   {		
			$db2 = $this->load->database('both', TRUE);
			
			$query = $db2->get_where($table, $filter);
			
			return $query->Result();
   }
   
   function inventory_availablity($inventoryid=false,$date=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and date in ($date)");
			return $qry->Result();	
	}
	
	function get_campaigninventory($campaignid=false,$inventoryconsumptionid=false)
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select dbho_campaignmaster.campaignID,cityID,dbho_campaignmaster.userID,duration,userCompanyName,dbho_campaignmaster.created,dbho_campaigninventory.inventoryID,inventoryDescription from dbho_campaignmaster,homeonline.rp_user_details,dbho_campaigninventory,dbho_inventorymaster,dbho_inventorytype where
									dbho_campaignmaster.campaignID='$campaignid' and
									dbho_campaignmaster.campaignID=dbho_campaigninventory.campaignID and
									dbho_campaigninventory.inventoryID='$inventoryconsumptionid' and
									dbho_campaignmaster.userID=rp_user_details.userID and
									dbho_campaigninventory.inventoryID=dbho_inventorymaster.inventoryID and
									dbho_inventorymaster.inventorytypeID=dbho_inventorytype.inventorytypeID and 
									dbho_inventorytype.LanguageID='1' and
									rp_user_details.languageID='1'");	
			
			return $qry->Result();	
	}
	
	function get_campaigninventorydetails($campaignid=false,$user_id=false,$inventoryid=false)
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select quantity,duration,startDate from dbho_campaignmaster,dbho_campaigninventory where
									dbho_campaignmaster.campaignID='$campaignid' and
									dbho_campaignmaster.userID='$user_id' and
									dbho_campaignmaster.campaignID=dbho_campaigninventory.campaignID and
									dbho_campaigninventory.inventoryID='$inventoryid' ");	
			
			return $qry->Result();	
	}		
			
	function campaigninventory_availablity($inventoryid=false,$date=false,$campaignid=false,$user_id=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and 
									campaignid=$campaignid and
									userID=$user_id and
									date in ($date)");
			
			return $qry->Result();	
	}
	
	function campaigninventory_availablityquantity($inventoryid=false,$campaignid=false,$user_id=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and 
									campaignid=$campaignid and
									userID=$user_id ");
			
			return $qry->Result();	
	}
	
	function get_inventorytypelist()
	{		
			
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select dbho_inventorymaster.inventoryID,inventoryDescription,days,MaximumQuantity,OverdrawingAllowed,cityName from dbho_inventorymaster,dbho_inventorytype,homeonline.rp_city_details where
									dbho_inventorymaster.inventorytypeID=dbho_inventorytype.inventorytypeID and 
									dbho_inventorymaster.City=rp_city_details.cityID and 
									rp_city_details.languageID='1' and
									dbho_inventorytype.LanguageID='1'");
			
			return $qry->Result();	
	}
	
	function insert_addinventorytype($inventoryname=false,$inventoryunit=false,$maxquantity=false,$overdrawingallow=false,$city_id=false,$filter=false)
   {	
			$db2 = $this->load->database('both', TRUE);
		 
				if($filter)
				{
					$data=array('inventorytypeID'=>$inventoryname,'days'=>$inventoryunit,'MaximumQuantity'=>$maxquantity,'OverdrawingAllowed'=>$overdrawingallow,'City'=>$city_id);
					
					$db2->where($filter);
					
					$db2->update('dbho_inventorymaster',$data);
					
				}
				else
				{
			
					$data=array('inventorytypeID'=>$inventoryname,'days'=>$inventoryunit,'MaximumQuantity'=>$maxquantity,'OverdrawingAllowed'=>$overdrawingallow,'City'=>$city_id);
					
					$db2->insert('dbho_inventorymaster',$data);
					
				}
	}
	
	function get_inventoryname()
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select inventorytypeID,inventoryDescription from dbho_inventorytype where
									dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
		
}