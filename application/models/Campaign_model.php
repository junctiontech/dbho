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
	
	function insert_campaign_only($campaignstartdate=false,$user_id=false,$currentexpiry=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$db2->where($filter);
				$db2->update($table,$data);
				
		}else{
				$data=array('userID'=>$user_id,'startDate'=>$campaignstartdate,'expiry_date_campaign'=>$currentexpiry);
				$db2->insert('dbho_campaignmaster',$data);
				$last_id = $db2->insert_id();
				return($last_id);
			}
	}
	
	function insert_campaign($last_id=false,$inventoryid=false,$cityid=false,$inventoryquantity=false,$inventoryduration=false,$inventoryamount=false,$planid=false,$planquantity=false,$planduration=false,$planamount=false,$plancarryforwrd=false,$currentexpiryplan=false,$lastexpiryplan=false,$date=false,$filter=false)
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
				$db2->insert('dbho_campaigninventory',$data1);
				
				
				$data2=array('campaignID'=>$last_id,
							 'planID'=>$planid,
							 'Quantity'=>$planquantity,
							 'Duration'=>$planduration,
							 'Amount'=>$planamount,
							 'CarryForward'=>$plancarryforwrd,
							 'currentExpiry'=>$currentexpiryplan,'LastExpiry'=>$lastexpiryplan);
				$db2->insert('dbho_campaignplan',$data2);
				
			
				
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
	
	function get_inventory()
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select dbho_inventorytype.inventorytypeID,inventoryDescription from dbho_inventorytype where
									dbho_inventorytype.LanguageID='1'");	
			return $qry->Result();	
	}
	
	function get_plan()
	{
			$qry = $this->db->query("select rp_user_plans.planID,planTitle from rp_user_plans,rp_user_plan_details where
									rp_user_plans.planID=rp_user_plan_details.planID and rp_user_plan_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function check($table=false,$filter=false)
   {		$db2 = $this->load->database('both', TRUE);
			$query = $db2->get_where($table, $filter);
			return $query->Result();
   }
   
   function inventory_availablity($inventoryid=false,$date=false)
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select * from dbho_planinventoryconsumptiondates where
									inventoryID=$inventoryid and date in ($date)");
		return $qry->Result();	
	}
	
	function get_campaignlist()
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select dbho_campaignmaster.campaignID,userCompanyName,userEmail,userPhone,startDate,expiry_date_campaign,dbho_campaignmaster.created, sum(dbho_campaigninventory.amount) + sum(dbho_campaignplan.Amount) as amount from dbho_campaignmaster,homeonline.rp_users,homeonline.rp_user_details,dbho_campaigninventory,dbho_campaignplan where
									dbho_campaignmaster.userID=rp_users.userID and 
									rp_users.userID=rp_user_details.userID and
									dbho_campaignmaster.campaignID=dbho_campaigninventory.campaignID and
									dbho_campaignmaster.campaignID=dbho_campaignplan.campaignID and
									rp_user_details.languageID='1' GROUP BY campaignID");
		//echo $db2->last_query();die;									
			return $qry->Result();	
	}
	
	function get_inventorylist($id=FALSE)
	{		$db2 = $this->load->database('both', TRUE);
		$qry = $db2->query("select dbho_campaignmaster.userID,dbho_campaigninventory.campaignID,dbho_campaigninventory.inventoryID,inventoryDescription,cityName,quantity,amount,duration from dbho_campaignmaster,dbho_campaigninventory,dbho_inventorymaster,dbho_inventorytype,homeonline.rp_city_details where
									dbho_campaigninventory.campaignID=$id and
									dbho_campaignmaster.campaignID=$id and
									dbho_campaigninventory.inventoryID=dbho_inventorymaster.inventoryID and
									dbho_inventorymaster.inventorytypeID=dbho_inventorytype.inventorytypeID and
									dbho_campaigninventory.cityID=rp_city_details.cityID and rp_city_details.languageID='1'");
	return $qry->Result();
	}
	
	function get_planlist($id=FALSE)
	{		$db2 = $this->load->database('both', TRUE);
	$qry = $db2->query("select dbho_campaignplan.planID,planTitle,Quantity,Duration,CarryForward,LastExpiry,currentExpiry,Amount from dbho_campaignplan,homeonline.rp_user_plan_details where
									dbho_campaignplan.campaignID=$id and
									dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_user_plan_details.languageID='1'");
	return $qry->Result();
	}
		
}