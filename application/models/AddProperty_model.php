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
	
	function get_project($addquery=false)
	{
			$qry = $this->db->query("select rp_projects.projectID,projectName from rp_projects,rp_project_details where
									rp_projects.projectID=rp_project_details.projectID and rp_project_details.languageID='1' $addquery");	
			return $qry->Result();	
	}
	
	public function getPropertyType($extraquery=false){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2',"t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeStatus = 'active' AND t2.typeName='Property'
		AND t1.languageID =1 $extraquery",'inner');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_user_type($extraquery=false)
	{
			$qry = $this->db->query("select rp_user_types.userTypeID,userTypeName from rp_user_types,rp_user_type_details where
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1' $extraquery");	
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
	
	public function getuserforpreview($userid=false){
		if($userid!=null){
			$filter=array('userID'=>$userid);
			$this->db->select('userTypeID,userEmail');
			$query=$this->db->get_where('rp_users', $filter);
			return $query->result();
		}

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
	
	
	function GetUserplan($userid=false)
	{		$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select dbho_campaignplan.planID,planTitle from dbho_campaignmaster,dbho_campaignplan,homeonline.rp_user_plan_details where
									dbho_campaignmaster.userID=$userid and
									dbho_campaignmaster.campaignID=dbho_campaignplan.campaignID and
									dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_user_plan_details.languageID='1'");	
			return $qry->Result();	
	}
	
	public function InsertProperty($table=false,$data=false,$filter=false)
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
	
	public function Insertotherinfo($table=false,$data=false)
	{
		$db2 = $this->load->database('both', TRUE);
		
				$db2->insert($table,$data);
		
	}
	
	public function deleteattributesandvalues($filter=false)
	{
		$this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter'");
	}
	
	function get_propertylisting()
	{		
			$qry = $this->db->query("select rp_properties.propertyID,propertyStatus,propertyAddedDate,propertyName,userEmail,userTypeName from rp_properties,rp_property_details,rp_users,rp_user_type_details where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.userID=rp_users.userID and
									rp_users.userTypeID=rp_user_type_details.userTypeID and
									rp_property_details.languageID='1' and
									rp_user_type_details.languageID='1'");	
			return $qry->Result();	
	}
	
	public function Shownoofbedrooms($table=false,$propertyID=false){
		 
	   $this->db->select('attrDetValue,attrOptionID');
	   $this->db->from('rp_property_attribute_values t1');
	   $this->db->join('rp_property_attribute_value_details t2','t1.attrValueID=t2.attrValueID AND t2.languageID=1 ','inner');
	   $this->db->where($propertyID);
	   $query = $this->db->get();
	   return $result = $query->result();

  }

public function Shownpreview($propertyid=false){
		if($propertyid!=null){
			$qry = $this->db->query("select * from rp_properties,rp_property_details where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.propertyID='$propertyid' and
									rp_property_details.languageID='1'");	
			return $qry->Result();
		}

	} 

public function Getotherdata($table=false,$filter=false){
		$query=$this->db->get_where($table,$filter);
			return $query->result();
		
	} 	
	
public function Getotherdatafromnewdb($table=false,$filter=false){
	$db2 = $this->load->database('both', TRUE);
		$query=$db2->get_where($table,$filter);
			return $query->result();
		
	}

public function Deletepropertyimage($filter=false)
	{
		$this->db->query("DELETE rp_property_images,rp_property_image_details FROM rp_property_images JOIN rp_property_image_details ON rp_property_image_details.propertyImageID = rp_property_images.propertyImageID WHERE rp_property_images.propertyImageID ='$filter'");
	}
	
public function deletestep3data($table=false,$filter=false)
	{
		$db2 = $this->load->database('both', TRUE);
		$db2->delete($table,$filter);
	}
	
}