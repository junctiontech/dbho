<?php
class AddProject_model extends CI_Model
{
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
	
	function GetMultipleData($table=false,$filter=false)
	{
		$this->db->select('*');
		$query=$this->db->get_where($table,$filter);
		return $query->result();
	}
	public function getPropertyType(){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2','t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeStatus = "active"
		AND t1.languageID =1','inner');
		$query = $this->db->get();
		return $query->result();
	}
	
	function GetUserplan($userid=false)
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select dbho_campaignplan.planID,planTitle from dbho_campaignmaster,dbho_campaignplan,homeonline.rp_user_plan_details where
									dbho_campaignmaster.userID=$userid and
									dbho_campaignmaster.campaignID=dbho_campaignplan.campaignID and
									dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_user_plan_details.languageID='1'");	
			return $qry->Result();	
	}	
	public function Getattributesgroups($propertyTypeID=false)
	{
		$this->db->select('distinct (t1.attributeGroupID),t1.propertyTypeID,t2.name');
		$this->db->from('rp_attribute_group t1');
		$this->db->join('rp_attribute_group_details t2','t2.attributeGroupID=t1.attributeGroupID AND t1.propertyTypeID="'.$propertyTypeID.'"','inner');
		$this->db->join('rp_attribute_to_group t3','t3.attributeGroupID=t1.attributeGroupID AND t2.languageID=1','inner');
		$query = $this->db->get();
		return $query->result();
	
	}
	
	public function GetAttributes($attributeGroupID=false)
	{
		$this->db->select('t2.attributeID,t2.attrInputType,t3.attrName');
		$this->db->from('rp_attribute_to_group t1');
		$this->db->join('rp_attributes t2','t1.attributeID=t2.attributeID','inner');
		$this->db->join('rp_attribute_details t3','t3.attributeID=t2.attributeID AND t3.languageID=1 AND t2.attrStatus="A" AND t1.attributeGroupID="'.$attributeGroupID.'"','inner');
		$query = $this->db->get();
		return $query->result();
	
	}
	
	public function GetAttributesoption($attribute=false)
	{
		$this->db->select('t2.attrOptionID,t2.attrOptName,t1.attributeID,t1.attrClassName');
		$this->db->from('rp_attribute_options t1');
		$this->db->join('rp_attribute_option_details t2','t1.attrOptionID=t2.attrOptionID AND t2.languageID=1 AND t1.attributeID="'.$attribute.'"','inner');
		$query = $this->db->get();
		return $query->result();
	
	}
	
	
	function GetMultipleDataJoin($table1=false,$table2=false,$filter1=false,$filter2=false)
	{	//echo $table1; echo $table2; echo $filter1; echo $filter2;die;
		$qry=$this->db->query("select $table1.*,$table2.* from $table1,$table2 where $table1.$filter1=$table2.$filter1 ");//print_r($qry);die;
		return $qry->result();
	}
		
	public function InsertProject($table=false,$data=false,$filter=false)
	{
		if(empty($filter))
		{
				$this->db->insert($table,$data);
				$lastid=$this->db->insert_id();
				return $lastid;
		}else
		{
				$this->db->where($filter);
				$this->db->update($table,$data);
		}
				

	}
	
	function GetProjectList()
	{
		$qry=$this->db->query('select rp_projects.*,rp_project_details.*,rp_users.*,rp_user_details.* from rp_projects,rp_project_details,rp_users,rp_user_details where rp_projects.projectID=rp_project_details.projectID and rp_projects.userID=rp_users.userID and rp_users.userID=rp_user_details.userID and rp_project_details.languageID=1 and rp_user_details.languageID=1 ');
		return $qry->result();
	}
}