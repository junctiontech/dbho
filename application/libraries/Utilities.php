<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	/**
	Developer : Rohit thakur
	Utilities : Utilities Class for customization function
	*/
	
class Utilities extends CI_Controller {

	public function __construct() 
	{
         # parent::__construct();
		$ci =& get_instance();
	 }
	 
	function get_planpriority($plantypeid=false)
	{
		$CI = & get_instance();
		
			$qry = $CI->db->query("select Priority from rp_dbho_plantype where planTypeID=$plantypeid");
		return $qry->Result();
	}
	
	function get_campaign_name($campaignid=false)
	{
		$CI = & get_instance();
		
			$qry = $CI->db->query("select created from rp_dbho_campaignmaster where campaignID=$campaignid");
		return $qry->Result();
	}
	
	function get_usertype($userid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select rp_user_types.userTypeID,userTypeName from rp_users,rp_user_types,rp_user_type_details where
									rp_users.userID='$userid' and 
									rp_users.userTypeID=rp_user_types.userTypeID and
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1'");
		return $qry->Result();
	}
	
	function get_planbyusertype($usertypeid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select rp_user_plans.planID,planTitle from rp_user_plans,rp_user_plan_details where
									rp_user_plans.userTypeID='$usertypeid' and
									rp_user_plans.planID=rp_user_plan_details.planID and rp_user_plan_details.languageID='1'");
		return $qry->Result();
	}
	
	function getcityidforinventory($inventoryid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select City from rp_dbho_inventorymaster where
									inventorytypeID='$inventoryid'");
		return $qry->Result();
	}
	
	function getcityforinventory($cityid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select rp_cities.cityID,cityName from rp_cities,rp_city_details where
									rp_cities.cityID in($cityid) and 
									rp_cities.cityID=rp_city_details.cityID and rp_city_details.languageID='1'");
		return $qry->Result();
	}
	
	function checkplanavailable($planid=false,$userid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select Quantity,currentExpiry,plan_unitconsumed from rp_dbho_campaignmaster,rp_dbho_campaignplan where
									rp_dbho_campaignmaster.userID='$userid' and 
									rp_dbho_campaignplan.planID='$planid' and 
									rp_dbho_campaignplan.status !='completed' and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID");
		return $qry->Result();
	}
	
	function sumofamount($table=false,$campaignid=false)
	{	
		$CI = & get_instance();
		
			$qry = $CI->db->query("select sum(amount) as amount  from $table where
									campaignID='$campaignid' ");
		return $qry->Result();
	}
	
	
	
}



?>
