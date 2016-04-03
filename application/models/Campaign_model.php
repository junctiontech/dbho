<?php
class Campaign_model extends CI_Model
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
	
	function insert_campaign_only($campaignstartdate=false,$user_id=false,$currentexpiry=false,$soldby=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$db2->where($filter);
				$db2->update($table,$data);
				
		}else{
				$data=array('userID'=>$user_id,'startDate'=>$campaignstartdate,'expiry_date_campaign'=>$currentexpiry,'soldBy'=>$soldby);
				$db2->insert('rp_dbho_campaignmaster',$data);
				$last_id = $db2->insert_id();
				return($last_id);
			}
	}
	
	function insert_campaign_inventory($last_id=false,$inventoryid=false,$cityid=false,$inventoryquantity=false,$inventoryduration=false,$inventoryamount=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$db2->where($filter);
				$db2->update($table,$data);
				
		}else{
				
				$data1=array('campaignID'=>$last_id,
							 'inventoryID'=>$inventoryid,
							 'quantity'=>$inventoryquantity,
							 'amount'=>$inventoryamount,
							 'cityID'=>$cityid,
							 'duration'=>$inventoryduration);
				$db2->insert('rp_dbho_campaigninventory',$data1);
				
			}
	}
	
	
	
	function insert_campaign_plan($last_id=false,$planid=false,$planquantity=false,$planduration=false,$planamount=false,$plancarryforwrd=false,$currentexpiryplan=false,$lastexpiryplan=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$db2->where($filter);
				$db2->update($table,$data);
				
		}else{
				
				$data2=array('campaignID'=>$last_id,
							 'planID'=>$planid,
							 'Quantity'=>$planquantity,
							 'Duration'=>$planduration,
							 'Amount'=>$planamount,
							 'CarryForward'=>$plancarryforwrd,
							 'currentExpiry'=>$currentexpiryplan,'LastExpiry'=>$lastexpiryplan,'status'=>'Active');
				$db2->insert('rp_dbho_campaignplan',$data2);
				
			}
	}
	
	function get_user_type()
	{
			$qry = $this->db->query("select rp_user_types.userTypeID,userTypeName from rp_user_types,rp_user_type_details where
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function get_company_name()
	{
			$qry = $this->db->query("select rp_users.userID,userCompanyName,userEmail from rp_users,rp_user_details where
									rp_users.userID=rp_user_details.userID and rp_users.userTypeID !='2' and rp_users.userTypeID !='5' and rp_user_details.languageID='1' ORDER BY userCompanyName asc");	
			return $qry->Result();	
	}
	
	function get_city()
	{
			$qry = $this->db->query("select rp_cities.cityID,cityName from rp_cities,rp_city_details where
									rp_cities.cityID=rp_city_details.cityID and rp_city_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function get_inventory()
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select rp_dbho_inventorytype.inventorytypeID,inventoryDescription,inventoryname from rp_dbho_inventorytype where
									rp_dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
	
	function get_plan()
	{
			$qry = $this->db->query("select rp_user_plans.planID,planTitle from rp_user_plans,rp_user_plan_details where
									rp_user_plans.planID=rp_user_plan_details.planID and rp_user_plan_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function check($table=false,$filter=false)
   {		$query = $this->db->get_where($table,$filter);
			return $query->Result();
   }
   
   function inventory_availablity($inventoryid=false,$date=false)
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select * from rp_dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and date in ($date)");
		return $qry->Result();	
	}
	
	function get_campaignlist($query=false)
	{		
	
		if($this->input->post('submit') == 'Export to CSV') {
			
			$qry = $this->db->query("select userCompanyName as Company,userEmail as Email,userPhone as Mobile,startDate,expiry_date_campaign as ExpiryDate,rp_dbho_campaignmaster.created as CreatedDate from rp_dbho_campaignmaster,rp_users,rp_user_details where
									rp_dbho_campaignmaster.userID=rp_users.userID and 
									rp_users.userID=rp_user_details.userID and
									
									rp_user_details.languageID='1' $query
									ORDER BY rp_dbho_campaignmaster.campaignID DESC ");
									
										return $this->dbutil->csv_from_result($qry); 
									}
		
		$qry = $this->db->query("select rp_dbho_campaignmaster.campaignID,userCompanyName,userEmail,userPhone,startDate,expiry_date_campaign,rp_dbho_campaignmaster.created from rp_dbho_campaignmaster,rp_users,rp_user_details where
									rp_dbho_campaignmaster.userID=rp_users.userID and 
									rp_users.userID=rp_user_details.userID and
									
									rp_user_details.languageID='1' $query
									ORDER BY rp_dbho_campaignmaster.campaignID DESC ");
									
									
										
			return $qry->Result();	
	}
	
	function get_campaignname($campaignid=false)
	{		
			$qry = $this->db->query("select rp_dbho_campaignmaster.campaignID,expiry_date_campaign,userCompanyName,rp_dbho_campaignmaster.created,soldBy from rp_dbho_campaignmaster,rp_users,rp_user_details where
									rp_dbho_campaignmaster.userID=rp_users.userID and 
									rp_users.userID=rp_user_details.userID and
									rp_dbho_campaignmaster.campaignID=$campaignid and
									rp_user_details.languageID='1' 
									GROUP BY campaignID ORDER BY rp_dbho_campaignmaster.campaignID DESC ");
				return $qry->Result();	
	}
	
	function get_inventorylist($id=FALSE)
	{		$db2 = $this->load->database('both', TRUE);
		$qry = $db2->query("select rp_dbho_campaignmaster.userID,rp_dbho_campaigninventory.campaignID,rp_dbho_campaigninventory.inventoryID,inventoryDescription,inventoryname,cityName,quantity,amount,duration,UnitsConsumed from rp_dbho_campaignmaster,rp_dbho_campaigninventory,rp_dbho_inventorymaster,rp_dbho_inventorytype,rp_city_details where
									rp_dbho_campaigninventory.campaignID=$id and
									rp_dbho_campaignmaster.campaignID=$id and
									rp_dbho_campaigninventory.inventoryID=rp_dbho_inventorymaster.inventoryID and
									rp_dbho_inventorymaster.inventorytypeID=rp_dbho_inventorytype.inventorytypeID and
									rp_dbho_campaigninventory.cityID=rp_city_details.cityID and rp_city_details.languageID='1'");
	return $qry->Result();
	}
	
	function get_planlist($id=FALSE)
	{		$db2 = $this->load->database('both', TRUE);
	$qry = $db2->query("select rp_dbho_campaignplan.planID,planTitle,Quantity,Duration,CarryForward,LastExpiry,currentExpiry,Amount,plan_unitconsumed from rp_dbho_campaignplan,rp_user_plan_details where
									rp_dbho_campaignplan.campaignID=$id and
									rp_dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_user_plan_details.languageID='1'");
	return $qry->Result();
	}
	
	
	function get_campaignplanold($planid=false,$userid=FALSE)
	{		
			$qry = $this->db->query("select Quantity,currentExpiry from rp_dbho_campaignmaster,rp_dbho_campaignplan where
									rp_dbho_campaignmaster.userID='$userid' and 
									rp_dbho_campaignplan.planID='$planid' and 
									rp_dbho_campaignplan.status !='completed' and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID");
			return $qry->Result();
	
	}
	
	function update_campaignplanold($table=false,$data=FALSE,$filter=false)
	{		
			$planID=$filter['planID'];
			$userID=$filter['userID'];
			$status=$data['status'];
			$plan_unitconsumed=$data['plan_unitconsumed'];
									
			$this->db->query("update rp_dbho_campaignplan,rp_dbho_campaignmaster 
			set `status`='$status' ,`plan_unitconsumed`='$plan_unitconsumed'
			where rp_dbho_campaignmaster.userID='$userID' and 
				  rp_dbho_campaignplan.planID='$planID' and 
				  rp_dbho_campaignplan.status !='completed' and
				  rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID");	
			
			
	}
	
	function Insert_rp_user_to_plan($table=false,$data=false){
		$this->db->insert($table,$data);
	}
	
	function Update_rp_user_to_plan($table=false,$data=false,$filter=false)
   {	
		
		 if($filter){
			 
				$this->db->where($filter);
				$this->db->update($table,$data);
				return true;
		}
	}
	
	function Emptyalltables()
	{		
			$this->db->truncate('rp_dbho_campaigninventory');
			$this->db->truncate('rp_dbho_campaignlog');
			
			$this->db->truncate('rp_dbho_campaignmaster');
			$this->db->truncate('rp_dbho_campaignplan');
			//$this->db->truncate('rp_dbho_inventorymaster');
			//$this->db->truncate('rp_dbho_inventory_log');
			//$this->db->truncate('rp_dbho_planinventoryconsumption');
			//$this->db->truncate('rp_dbho_planinventoryconsumptiondates');
			$this->db->truncate('rp_dbho_plan_mapping');
			$this->db->truncate('rp_dbho_plan_consumption_log');
			$this->db->truncate('rp_dbho_property_log');
			//$this->db->truncate('rp_dbho_plantype');
			
			// These three tables should be deleted together
			//$this->db->truncate('rp_user_plan_details');
			//$this->db->truncate('rp_user_plans');
			//$this->db->truncate('rp_dbho_user_plans_subdetail');
			$this->db->truncate('rp_user_to_plan');
			$this->db->truncate('rp_dbho_bath_room');
			$this->db->truncate('rp_dbho_bed_room');
			$this->db->truncate('rp_dbho_kitchen');
			$this->db->truncate('rp_dbho_living_room');
			
			$this->db->truncate('rp_google_localinfo_to_property');
			$this->db->truncate('rp_properties');
			$this->db->truncate('rp_property_attribute_values');
			$this->db->truncate('rp_property_attribute_value_details');
			$this->db->truncate('rp_property_details');
			$this->db->truncate('rp_property_images');
			$this->db->truncate('rp_property_image_details');
			$this->db->truncate('rp_property_price');
			
			$this->db->truncate('rp_property_to_areas');
			$this->db->truncate('rp_property_image_details');
			$this->db->truncate('rp_property_image_details');
			
			
	}
	
		
}