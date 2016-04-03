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
		$this->load->dbutil();
		$this->db->query('SET time_zone = "+05:30"');
	}
	
	function insert_userplan($type=false,$user_id=false,$inventory_id=false,$city_id=false,$project_id=false,$file=false,$start_date=false,$inventoryduration=false,$weightage=false,$remark=false,$campaignid=false,$date=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		
			if($filter)
			{
				$data=array('City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'Weightage'=>$weightage,'Remark'=>$remark);
				
				$db2->where($filter);
				$db2->update('rp_dbho_planinventoryconsumption',$data);
				$data1=array('planinventoryconsumptionID'=>$filter['planinventoryconsumptionID'],'status'=>'Edit','createdBy'=>'rohit');
				$db2->insert('rp_dbho_inventory_log',$data1);
			}
			else
			{
			
				$data2=array('inventoryID'=>$inventory_id,'UserID'=>$user_id,'CampaignID'=>$campaignid,'City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'StartDate'=>$start_date,'Duration'=>$inventoryduration,'Weightage'=>$weightage,'Remark'=>$remark,'Status'=>'Created','DaysCompleted'=>'');
				
				$db2->insert('rp_dbho_planinventoryconsumption',$data2);
				$id=$db2->insert_id();
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
									$date = strtotime("$k day", strtotime($start_date));
									$datess=date("m/d/Y", $date);
							}
							
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess,
											 'planinventoryconsumptionID'=>$id);
											 
								$db2->insert('rp_dbho_planinventoryconsumptiondates',$data3);
					
						}
					}
					else
					{
								$datess=$start_date;
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess,
											 'planinventoryconsumptionID'=>$id);
								$db2->insert('rp_dbho_planinventoryconsumptiondates',$data3);
								
					}
					
					$data1=array('planinventoryconsumptionID'=>$id,'status'=>'Created','createdBy'=>'rohit');
				$db2->insert('rp_dbho_inventory_log',$data1);
			}
	}
	
	function insert_unit_consumption_inventory($campaignid=false,$inventoryid=false){
		
		$this->db->query("update rp_dbho_campaigninventory set `UnitsConsumed`=`UnitsConsumed`+1 where `campaignID`='$campaignid' and `inventoryID`='$inventoryid'");	
	
				//echo $this->db->last_query();die;
		
		
	}
	
	function select_for_update($table=false,$filter=false)
   {		
			$db2 = $this->load->database('both', TRUE);
			
			$query = $db2->get_where($table, $filter);
			
			return $query->Result();
			
   }
	
	
	function get_company_name()
	{
			
			$qry = $this->db->query("select rp_users.userID,userCompanyName,userEmail from rp_users,rp_user_details where
									rp_users.userID=rp_user_details.userID and rp_users.userTypeID !='1' and rp_user_details.languageID='1' ORDER BY userCompanyName asc");	
									
			return $qry->Result();
			
	}
	
	function get_city()
	{
			$qry = $this->db->query("select rp_cities.cityID,cityName from rp_cities,rp_city_details where
									rp_cities.cityID=rp_city_details.cityID and rp_city_details.languageID='1' and rp_cities.cityStatus='Active' and rp_city_details.cityName !='' ");	
			return $qry->Result();	
	}
	
	function get_project($extraqry=false)
	{
			$qry = $this->db->query("select rp_projects.projectID,projectName from rp_projects,rp_project_details where
									rp_projects.projectID=rp_project_details.projectID and rp_project_details.languageID='1' and rp_projects.projectStatus='Active' $extraqry");	
			return $qry->Result();	
	}
	
	function get_property($extraqry=false)
	{
			$qry = $this->db->query("select rp_properties.propertyID,propertyName from rp_properties,rp_property_details where
									rp_properties.propertyID=rp_property_details.propertyID and rp_property_details.languageID='1' and rp_properties.propertyStatus='Active' $extraqry");	
			return $qry->Result();	
	}
	
	function get_inventory()
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select rp_dbho_inventorytype.inventorytypeID,inventoryDescription,inventoryname from rp_dbho_inventorytype where
									rp_dbho_inventorytype.inventorytypeID and rp_dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
	
	
	function get_inventorylist($query=false)
	{		
			
			
			if($this->input->post('submit') == 'Export to CSV') {
				$qry = $this->db->query("select userCompanyName as Company,userEmail as Email,userPhone as MobileNo,cityName as City,inventoryname as Inventory,projectName as Project,rp_dbho_planinventoryconsumption.StartDate,Duration,Weightage,Status from rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_dbho_planinventoryconsumption,
						 rp_users,rp_user_details,rp_city_details,rp_project_details where
			rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and
			rp_dbho_inventorymaster.inventoryID=rp_dbho_planinventoryconsumption.inventoryID and
			rp_dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			rp_dbho_planinventoryconsumption.City=rp_city_details.cityID and
			rp_dbho_planinventoryconsumption.ProjectID=rp_project_details.projectID and
			rp_dbho_inventorytype.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1' and
			rp_project_details.languageID='1' $query 
			ORDER BY planinventoryconsumptionID DESC");	
				return $this->dbutil->csv_from_result($qry); 
			}
			
			$qry = $this->db->query("select planinventoryconsumptionID,rp_dbho_inventorymaster.inventoryID,rp_dbho_planinventoryconsumption.CampaignID,userCompanyName,userEmail,cityName,userPhone,inventoryDescription,inventoryname,rp_dbho_planinventoryconsumption.ProjectID,rp_dbho_planinventoryconsumption.StartDate,Duration,Weightage,Status from rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_dbho_planinventoryconsumption,
						 rp_users,rp_user_details,rp_city_details where
			rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and
			rp_dbho_inventorymaster.inventoryID=rp_dbho_planinventoryconsumption.inventoryID and
			rp_dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			rp_dbho_planinventoryconsumption.City=rp_city_details.cityID and
			
			rp_dbho_inventorytype.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1'  $query 
			ORDER BY planinventoryconsumptionID DESC");	
			
			
			
			
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
			
			$qry = $db2->query("select * from rp_dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and date in ($date)");
			return $qry->Result();	
	}
	
	function get_campaigninventory($campaignid=false,$inventoryconsumptionid=false)
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select rp_dbho_campaignmaster.campaignID,rp_dbho_campaigninventory.cityID,rp_dbho_campaignmaster.userID,duration,userCompanyName,userEmail,rp_dbho_campaignmaster.created,rp_dbho_campaigninventory.inventoryID,inventoryDescription,inventoryname from rp_dbho_campaignmaster,rp_users,rp_user_details,rp_dbho_campaigninventory,rp_dbho_inventorymaster,rp_dbho_inventorytype where
									rp_dbho_campaignmaster.campaignID='$campaignid' and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaigninventory.campaignID and
									rp_dbho_campaigninventory.inventoryID='$inventoryconsumptionid' and
									rp_dbho_campaignmaster.userID=rp_user_details.userID and
									rp_users.userID=rp_user_details.userID and
									rp_dbho_campaigninventory.inventoryID=rp_dbho_inventorymaster.inventoryID and
									rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and 
									rp_dbho_inventorytype.LanguageID='1' and
									rp_user_details.languageID='1'");	
			//echo $db3->last_query();die;
			return $qry->Result();	
	}
	
	function get_campaigninventorydetails($campaignid=false,$user_id=false,$inventoryid=false)
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select quantity,duration,startDate,UnitsConsumed from rp_dbho_campaignmaster,rp_dbho_campaigninventory where
									rp_dbho_campaignmaster.campaignID='$campaignid' and
									rp_dbho_campaignmaster.userID='$user_id' and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaigninventory.campaignID and
									rp_dbho_campaigninventory.inventoryID='$inventoryid' ");	
			
			return $qry->Result();	
	}		
			
	function campaigninventory_availablity($inventoryid=false,$date=false,$campaignid=false,$user_id=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from rp_dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and 
									campaignid=$campaignid and
									userID=$user_id and
									date in ($date)");
			
			return $qry->Result();	
	}
	
	function campaigninventory_availablityquantity($inventoryid=false,$campaignid=false,$user_id=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from rp_dbho_planinventoryconsumption where
									inventoryID=$inventoryid and 
									campaignid=$campaignid and
									userID=$user_id ");
			
			return $qry->Result();	
	}
	
	function get_inventorytypelist()
	{		
			
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select rp_dbho_inventorymaster.inventoryID,inventoryDescription,inventoryname,days,MaximumQuantity,OverdrawingAllowed,cityName from rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_city_details where
									rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and 
									rp_dbho_inventorymaster.City=rp_city_details.cityID and 
									rp_city_details.languageID='1' and
									rp_dbho_inventorytype.LanguageID='1'");
			
			return $qry->Result();	
	}
	
	function insert_addinventorytype($inventoryname=false,$inventoryunit=false,$maxquantity=false,$overdrawingallow=false,$city_id=false,$filter=false)
   {	
			$db2 = $this->load->database('both', TRUE);
		 
				if($filter)
				{
					$data=array('inventorytypeID'=>$inventoryname,'days'=>$inventoryunit,'MaximumQuantity'=>$maxquantity,'OverdrawingAllowed'=>$overdrawingallow,'City'=>$city_id);
					
					$db2->where($filter);
					
					$db2->update('rp_dbho_inventorymaster',$data);
					
				}
				else
				{
			
					$data=array('inventorytypeID'=>$inventoryname,'days'=>$inventoryunit,'MaximumQuantity'=>$maxquantity,'OverdrawingAllowed'=>$overdrawingallow,'City'=>$city_id);
					
					$db2->insert('rp_dbho_inventorymaster',$data);
					
				}
	}
	
	function get_inventoryname()
	{		
			$db3 = $this->load->database('both', TRUE);
			
			$qry = $db3->query("select inventorytypeID,inventoryDescription,inventoryname from rp_dbho_inventorytype where
									rp_dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
	
	function inventory_availablity_calendar($inventoryid=false,$date=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select * from rp_dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and
									date in ($date)");
				//echo $db2->last_query();die;					
			return $qry->Result();	
	}
	
		
	function inventory_consumption_calendar($inventoryid=false)
	{		
			$db2 = $this->load->database('both', TRUE);
			
			$qry = $db2->query("select StartDate,Duration,inventoryID,City,CampaignID,userCompanyName from rp_dbho_planinventoryconsumption,rp_users,rp_user_details where
									inventoryID=$inventoryid and
										rp_dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID");
			return $qry->Result();	
	}
		
	
	function inventorylog($query=false,$limit=false,$start=false)
	{		
		
		if($this->input->post('submit') == 'Export to CSV') {
			$sql = "select userCompanyName as Company,rp_dbho_campaignmaster.created as CampaignDate,inventoryname as Inventory,cityName as City,projectName as Project,rp_dbho_inventory_log.status as Status,rp_dbho_inventory_log.createdBy as EditBy,rp_dbho_inventory_log.createdon as DateTime
			from 
			rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_dbho_planinventoryconsumption,
			rp_users,rp_user_details,rp_city_details,rp_project_details,rp_dbho_inventory_log,rp_dbho_campaignmaster 
			where
			rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and
			rp_dbho_inventorymaster.inventoryID=rp_dbho_planinventoryconsumption.inventoryID and
			rp_dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			rp_dbho_planinventoryconsumption.CampaignID=rp_dbho_campaignmaster.campaignID and
			rp_dbho_planinventoryconsumption.City=rp_city_details.cityID and
			rp_dbho_planinventoryconsumption.ProjectID=rp_project_details.projectID and
			rp_dbho_planinventoryconsumption.planinventoryconsumptionID=rp_dbho_inventory_log.planinventoryconsumptionID and
			rp_dbho_inventorytype.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1' and
			rp_project_details.languageID='1' $query ";
			
			$sql .= ' ORDER BY createdon DESC';
			
			$qry = $this->db->query($sql);
				return $this->dbutil->csv_from_result($qry); 
			}
			
		$sql = "select rp_dbho_planinventoryconsumption.planinventoryconsumptionID,rp_dbho_campaignmaster.created as campaigndate,userCompanyName,inventoryDescription,inventoryname,cityName,projectName,rp_dbho_inventory_log.status,rp_dbho_inventory_log.createdon,rp_dbho_inventory_log.createdBy 
			from 
			rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_dbho_planinventoryconsumption,
			rp_users,rp_user_details,rp_city_details,rp_project_details,rp_dbho_inventory_log,rp_dbho_campaignmaster 
			
			where
			rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and
			rp_dbho_inventorymaster.inventoryID=rp_dbho_planinventoryconsumption.inventoryID and
			rp_dbho_planinventoryconsumption.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			rp_dbho_planinventoryconsumption.CampaignID=rp_dbho_campaignmaster.campaignID and
			rp_dbho_planinventoryconsumption.City=rp_city_details.cityID and
			rp_dbho_planinventoryconsumption.ProjectID=rp_project_details.projectID and
			rp_dbho_planinventoryconsumption.planinventoryconsumptionID=rp_dbho_inventory_log.planinventoryconsumptionID and
			rp_dbho_inventorytype.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1' and
			rp_project_details.languageID='1' $query ";
			
			$sql .= ' ORDER BY createdon DESC';
			$sql .= " LIMIT  $start,$limit";
			
			
			$qry = $this->db->query($sql);
			
			
			//echo $this->db->last_query();die;
			return $qry->Result();	
	}
	
	function Delete($table=false,$filter=false)
	{		
			if($this->db->delete($table,$filter))
			{
				return true;
			}else
			{
				return false;
			}
			
	}
	
	function update($table=false,$data=false,$filter=false)
	{		
			$this->db->where($filter);
			$this->db->update($table,$data);
	}
	
	function insert($table=false,$data=false)
	{		
			$this->db->insert($table,$data);
	}
	
	function insert_playinventory($user_id=false,$inventory_id=false,$start_date=false,$inventoryduration=false,$campaignid=false,$date=false,$planinventoryconsumptionID=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		
		$data=array('Status'=>'Started');
		
		$filter=array('planinventoryconsumptionID'=>$planinventoryconsumptionID);
				
				$db2->where($filter);
				$db2->update('rp_dbho_planinventoryconsumption',$data);
				
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
									$date = strtotime("$k day", strtotime($start_date));
									$datess=date("m/d/Y", $date);
							}
							
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess,
											 'planinventoryconsumptionID'=>$planinventoryconsumptionID);
											 
								$db2->insert('rp_dbho_planinventoryconsumptiondates',$data3);
					
						}
					}
					else
					{
								$datess=$start_date;
								$data3=array('inventoryID'=>$inventory_id,
											 'userID'=>$user_id,
											 'campaignid'=>$campaignid,
											 'date'=>$datess,
											 'planinventoryconsumptionID'=>$planinventoryconsumptionID);
								$db2->insert('rp_dbho_planinventoryconsumptiondates',$data3);
								
					}
					
					$data1=array('planinventoryconsumptionID'=>$planinventoryconsumptionID,'status'=>'Started','createdBy'=>'rohit');
				$db2->insert('rp_dbho_inventory_log',$data1);
			
	}
	
	public function record_count($table=false) {
        return $this->db->count_all($table);
    }
	
}