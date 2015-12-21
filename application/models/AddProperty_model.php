<?php
class AddProperty_model extends CI_Model
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
	
	function Insert_data($campaignstartdate=false,$user_id=false,$currentexpiry=false,$filter=false)
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
	
	function get_project()
	{
			$qry = $this->db->query("select rp_projects.projectID,projectName from rp_projects,rp_project_details where
									rp_projects.projectID=rp_project_details.projectID and rp_project_details.languageID='1'");	
			return $qry->Result();	
	}
	
	public function getPropertyType(){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2','t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeStatus = "active"
		AND t1.languageID =1','inner');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_user_type()
	{
			$qry = $this->db->query("select rp_user_types.userTypeID,userTypeName from rp_user_types,rp_user_type_details where
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1'");	
			return $qry->Result();	
	}
	
	public function getuser($userTypeID=false){
		if($userTypeID!=null){
			$filter=array('userTypeID'=>$userTypeID);
			$this->db->select('userID,userEmail');
			$query=$this->db->get_where('rp_users', $filter);
			return $query->result();
		}

	}
	
	
		
}