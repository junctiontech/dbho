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
	
	function insert_campaign($campaignstartdate=false,$user_id=false,$inventoryid=false,$cityid=false,$inventoryquantity=false,$inventoryduration=false,$inventoryamount=false,$planid=false,$planquantity=false,$planduration=false,$planamount=false,$plancarryforwrd=false,$date=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$db2->where($filter);
				$db2->update($table,$data);
				
		}else{
				$data=array('userID'=>$user_id,
							'startDate'=>$campaignstartdate);
				$db2->insert('dbho_campaignmaster',$data);
				$last_id = $db2->insert_id();
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
							 'CarryForward'=>$plancarryforwrd);
				$db2->insert('dbho_campaignplan',$data2);
				
				if($inventoryduration>1){
					
					for($k=0;$k<=$inventoryduration-1;$k++){
					if($k==0){
						$datess=$campaignstartdate;	
						}else{
							
					$newdates=explode("/",$campaignstartdate);
					$add=$newdates[1]+$k;
					$datess="$newdates[0]/$add/$newdates[2]";
						}
					$data3=array('inventoryID'=>$inventoryid,
							 'userID'=>$user_id,
							 'campaignid'=>$last_id,
							 'date'=>$datess);
					$db2->insert('dbho_planinventoryconsumptiondates',$data3);
					
					}
				}else{
					$datess=$campaignstartdate;
					$data3=array('inventoryID'=>$inventoryid,
							 'userID'=>$user_id,
							 'campaignid'=>$last_id,
							 'date'=>$datess);
				$db2->insert('dbho_planinventoryconsumptiondates',$data3);
				}
				
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
			$qry = $db2->query("select dbho_inventorymaster.inventoryID,inventoryDescription from dbho_inventorymaster,dbho_inventorydescription where
									dbho_inventorymaster.inventoryID=dbho_inventorydescription.inventoryID and dbho_inventorydescription.LanguageID='1'");	
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
		//echo $db2->last_query();die;									
			return $qry->Result();	
	}
		
}