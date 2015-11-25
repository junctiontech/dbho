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
	
	function insert_userplan($type=false,$user_id=false,$inventory_des=false,$city_id=false,$project_id=false,$file=false,$start_date=false,$duration=false,$weightage=false,$remark=false,$date=false,$filter=false)
   {	
		$db2 = $this->load->database('both', TRUE);
		 if($filter){
				$data=array('City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'Weightage'=>$weightage,'Remark'=>$remark);
				$db2->where($filter);
				$db2->update('dbho_planinventoryconsumption',$data);
				
		}else{
				$data=array('days'=>'0','MaximumQuantity'=>'2','OverdrawingAllowed'=>'','City'=>$city_id);
				$db2->insert('dbho_inventorymaster',$data);
				$last_id = $db2->insert_id();
				$data1=array('inventoryID'=>$last_id, 'inventoryDescription'=>$inventory_des,'LanguageID'=>'1');
				$db2->insert('dbho_inventorydescription',$data1);
				$data2=array('inventoryID'=>$last_id,'UserID'=>$user_id,'UnitsConsumed'=>'','CampaignID'=>'','City'=>$city_id,'ProjectID'=>$project_id,'BannerImagePath'=>$file,'StartDate'=>$start_date,'Duration'=>$duration,'Weightage'=>$weightage,'Remark'=>$remark,'Status'=>'Created','DaysCompleted'=>'');
				$db2->insert('dbho_planinventoryconsumption',$data2);
			}
	}
	
	function select_for_update($table=false,$filter=false)
   {	
			$query = $this->db->get_where($table, $filter);
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
	
	function get_inventorylist()
	{		$db3 = $this->load->database('both', TRUE);
			$qry = $db3->query("select dbho_inventorymaster.inventoryID,userCompanyName,userEmail,cityName,userPhone,inventoryDescription,projectName,StartDate,Duration,Weightage from homeonline_junction.dbho_inventorymaster,homeonline_junction.dbho_inventorydescription,homeonline_junction.dbho_planinventoryconsumption,
						 homeonline.rp_users,homeonline.rp_user_details,homeonline.rp_city_details,homeonline.rp_project_details where
			dbho_inventorymaster.inventoryID=dbho_inventorydescription.inventoryID and
			dbho_inventorymaster.inventoryID=dbho_planinventoryconsumption.inventoryID and
			dbho_planinventoryconsumption.UserID=rp_user_details.UserID and
			dbho_planinventoryconsumption.City=rp_city_details.cityID and
			dbho_planinventoryconsumption.ProjectID=rp_project_details.projectID and
			dbho_inventorydescription.LanguageID='1' and
			rp_user_details.languageID='1' and
			rp_city_details.languageID='1' and
			rp_project_details.languageID='1'");	
			
			return $qry->Result();	
	}
		
}