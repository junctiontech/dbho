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
		$this->load->dbutil();
		$this->db->query('SET time_zone = "+05:30"');
	}
	
		/*.................................... Start Function For Retrieve Data From Database .................................................*/
	function GetMultipleData($table=false,$filter=false)
	{
		$this->db->select('*');
		$query=$this->db->get_where($table,$filter);
		return $query->result();
	}
	/*.................................... End For Retrieve Data From Database .................................................*/
	
	/*.................................... Start Function For Retrieve Project Type .................................................*/
	function getPropertyType(){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2','t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeStatus = "active"
		AND t1.languageID =1','inner');
		$query = $this->db->get();
		return $query->result();
	}
	/*.................................... End Function For Retrieve Project Type .................................................*/
	
	/*.................................... Start Function For Retrieve User Plan Behalf On User Id .................................................*/
	function GetUserplan($userid=false,$IdentityVariable=false)
	{		
			if($IdentityVariable=='')
			{
				$IdentityVariable='Project';
			}
			$qry = $this->db->query("select rp_dbho_campaignplan.planID,planTitle,rp_dbho_campaignmaster.campaignID from rp_dbho_campaignmaster,rp_dbho_campaignplan,rp_user_plan_details,rp_dbho_user_plans_subdetail where
									rp_dbho_campaignmaster.userID=$userid and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID and
									rp_dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_dbho_campaignplan.planID=rp_dbho_user_plans_subdetail.planID and
									rp_dbho_user_plans_subdetail.listingType='$IdentityVariable' and
									rp_user_plan_details.languageID='1' and rp_dbho_campaignplan.status!='completed'");	
			return $qry->Result();	
	}	
	/*.................................... End Function For Retrieve User Plan Behalf On User Id .................................................*/
	
	
	/******************************** Start Function For Get User Information *************************************************************/
	function GetUserInfromation($userID=false,$languageID=false)
	{
		$this->db->query("select rp_users.userEmail,rp_user_details.userCompanyName from rp_users,rp_user_details where rp_users.userID='$userID' and rp_user_details.userID='$userID' and rp_users.userStatus='Active' and rp_user_details.languageID='$languageID'");
		return $qry->result();
	}
	/***************************** End Function For Get User Information *************************************************************/
	
	
	/******************************** Start Function For UserId *********************************************************/
	
	function GetUserId($UserTypeId=false,$languageID=false)
	{
		$this->db->query("select rp_user_to_type.userID,rp_user_type_details.userTypeName from rp_user_to_type,rp_user_type_details where rp_user_to_type.UserTypeId='$UserTypeId' and rp_user_to_type.userTypeID=rp_user_type_details.userTypeID and rp_user_type_details.languageID='$languageID'");
	}
	
	
	/******* End *******/
	
	/*.......................... Start Function For Retrieve Attribute Group Behalf On Project Type(Property Type) .....................................*/
	function Getattributesgroups($propertyTypeID=false)
	{
		$this->db->select('distinct (t1.attributeGroupID),t1.propertyTypeID,t2.name');
		$this->db->from('rp_attribute_group t1');
		$this->db->join('rp_attribute_group_details t2','t2.attributeGroupID=t1.attributeGroupID AND t1.propertyTypeID="'.$propertyTypeID.'"','inner');
		$this->db->join('rp_attribute_to_group t3','t3.attributeGroupID=t1.attributeGroupID AND t2.languageID=1','inner');
		$query = $this->db->get();
		return $query->result();
	}
	/*.......................... End Function For Retrieve Attribute Group Behalf On Project Type(Property Type) .....................................*/

	
	/*.......................... Start Function For Retrieve Attribute (Project Specification and amenities and Project unit) .....................................*/
	function GetAttributes($attributeGroupID=false)
	{
		$this->db->select('t2.attributeID,t2.attrInputType,t3.attrName');
		$this->db->from('rp_attribute_to_group t1');
		$this->db->join('rp_attributes t2','t1.attributeID=t2.attributeID','inner');
		$this->db->join('rp_attribute_details t3','t3.attributeID=t2.attributeID AND t3.languageID=1 AND t2.attrStatus="A" AND t1.attributeGroupID="'.$attributeGroupID.'"','inner');
		$query = $this->db->get();
		return $query->result();
	}
	/*.......................... End Function For Retrieve Attribute (Project Specification and amenities and Project unit) .....................................*/
	
	
	/*................ Start Function For Retrieve Attribute Option (Project Specification and amenities and Project unit) ............................*/
	function GetAttributesoption($attribute=false)
	{
		$this->db->select('t2.attrOptionID,t2.attrOptName,t1.attributeID,t1.attrClassName');
		$this->db->from('rp_attribute_options t1');
		$this->db->join('rp_attribute_option_details t2','t1.attrOptionID=t2.attrOptionID AND t2.languageID=1 AND t1.attributeID="'.$attribute.'"','inner');
		$query = $this->db->get();
		return $query->result();
	}
	/*................ End Function For Retrieve Attribute Option (Project Specification and amenities and Project unit) ............................*/
	
	
	/*................ Start Function For Retrieve Attribute Details (Project Specification and amenities and Project unit) ............................*/
	function getAttributedetail($filter=false)
	{
		$qry=$this->db->query("select * from rp_project_attribute_values where projectID='$filter'");
		return $qry->result();
	}			
	/*................ End Function For Retrieve Attribute Details (Project Specification and amenities and Project unit) ............................*/
	
	
	/*................................. Check This Function ........................................*/
	function GetMultipleDataJoin($table1=false,$table2=false,$filter1=false,$filter2=false)
	{	//echo $table1; echo $table2; echo $filter1; echo $filter2;die;
		$qry=$this->db->query("select $table1.*,$table2.* from $table1,$table2 where $table1.$filter1=$table2.$filter1 ");//print_r($qry);die;
		return $qry->result();
	}
	

	/*............................... Start Function For Insert and Update Data .....................................*/
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
				$qry=$this->db->update($table,$data);
		}
	}
	/*................ End Function For Insert Data ............................*/
	
	
	/*................................ Start Function For Locality Area Code Insert ...................................*/
	function Insertareacode($citylocid=false,$lat=false,$long=false,$projectid=false)
	{
		$areacode=	number_format((float)$lat, 1, '.', '');	
		$areacode.=	number_format((float)$long, 1, '.', '');
		$areacode=str_replace('.','',"$areacode");
		$CountDetails=$this->db->get_where('rp_property_to_areas',array('propertyID'=>$projectid,'propertyType'=>'Project'));
		$count=$CountDetails->result();
		if(empty($count))
		{
			$arealocalitydata=array('areaCode'=>$areacode,'localityID'=>$citylocid);					 
			$this->db->insert('rp_locality_to_areas',$arealocalitydata);
			$propertytoarea=array('areaCode'=>$areacode,'propertyID'=>$projectid,'propertyType'=>'Project');
			$this->db->insert('rp_property_to_areas',$propertytoarea);
		}
		else
		{
			$arealocalitydata=array('areaCode'=>$areacode);		
			$this->db->where(array('localityID'=>$citylocid));		
			$this->db->update('rp_locality_to_areas',$arealocalitydata);
			$propertytoarea=array('areaCode'=>$areacode);
			$this->db->where(array('propertyID'=>$projectid,'propertyType'=>'Project'));
			$this->db->update('rp_property_to_areas',$propertytoarea);
		}
	}
	/*................................ End Function For Locality Area Code Insert ...................................*/
	
	
	/*................ Start Function For Retrieve All Project Data For Project List View ............................*/
	function GetProjectList()
	{
		$qry=$this->db->query("select  DISTINCT rp_projects.projectKey,rp_projects.projectID,rp_projects.projectAddedDate,rp_projects.projectStatus,rp_user_plan_details.planTitle,rp_projects.projectKey,rp_project_details.projectName,rp_users.userEmail,rp_user_details.userFirstName,rp_user_types.userTypeStatus,rp_user_type_details.userTypeName from rp_dbho_user_plans_subdetail,rp_dbho_plan_mapping,rp_projects,rp_project_details,rp_users,rp_user_plan_details,rp_user_details,rp_user_to_type,rp_user_types,rp_user_type_details where rp_projects.projectID=rp_project_details.projectID and rp_projects.projectID=rp_dbho_plan_mapping.objectID and rp_dbho_plan_mapping.objectType='project' and rp_dbho_plan_mapping.planID=rp_dbho_user_plans_subdetail.planID and rp_dbho_user_plans_subdetail.listingType='Project' and rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and rp_projects.userID=rp_users.userID and rp_users.userID=rp_user_details.userID and rp_projects.userID=rp_user_to_type.userID and rp_user_to_type.userTypeID =rp_user_types.userTypeID and rp_user_types.userTypeStatus='Active' and rp_user_types.userTypeID=rp_user_type_details.userTypeID and rp_projects.projectStatus!='Deleted' and rp_user_type_details.languageID=1 and rp_project_details.languageID=1 and rp_project_details.versionID=0 and rp_user_details.languageID=1 ORDER BY rp_projects.projectID DESC ");  
		return $qry->result(); 
	}
	/*................ End Function For Retrieve Project Data For Project List View ............................*/
	
	
	/*................. Start Function For Project List Show Behalf on Search Keyword ......................................*/
	function GetProjectFilterList($search=false)
	{		
			if($this->input->post('submit')=='Export to CSV')
			{	//echo $search;die;
				$qry = $this->db->query("select DISTINCT rp_projects.projectKey,rp_user_plan_details.planTitle,rp_projects.projectStatus,rp_projects.projectAddedDate,rp_project_details.projectName,rp_users.userEmail,rp_user_type_details.userTypeName from rp_dbho_user_plans_subdetail, rp_user_plan_details,rp_projects,rp_project_details,rp_users,rp_user_type_details,rp_dbho_plan_mapping where
				rp_projects.projectID=rp_project_details.projectID and rp_projects.projectID=rp_dbho_plan_mapping.objectID and rp_dbho_plan_mapping.objectType='project' and rp_dbho_plan_mapping.planID=rp_dbho_user_plans_subdetail.planID and rp_dbho_user_plans_subdetail.listingType='Project'  and rp_dbho_plan_mapping.objectType='project' and rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and 
				rp_projects.userID=rp_users.userID and
				rp_users.userTypeID=rp_user_type_details.userTypeID and
				rp_project_details.languageID='1' and
				rp_user_type_details.languageID='1' and rp_project_details.versionID=0 and
				rp_projects.projectStatus !='Deleted' $search ORDER BY rp_projects.projectID DESC");	
				return $this->dbutil->csv_from_result($qry); 
			}
			$qry = $this->db->query("select DISTINCT rp_projects.projectID,rp_projects.userID,projectKey,rp_user_plan_details.planTitle,projectStatus,projectStatus,projectAddedDate,projectName,userEmail,rp_user_type_details.userTypeName from rp_dbho_user_plans_subdetail, rp_user_plan_details,rp_projects,rp_project_details,rp_users,rp_user_type_details,rp_dbho_plan_mapping where
			rp_projects.projectID=rp_project_details.projectID and rp_projects.projectID=rp_dbho_plan_mapping.objectID and rp_dbho_plan_mapping.objectType='project' and rp_dbho_plan_mapping.planID=rp_dbho_user_plans_subdetail.planID and rp_dbho_user_plans_subdetail.listingType='Project'  and rp_dbho_plan_mapping.objectType='project' and rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and 
			rp_projects.userID=rp_users.userID and
			rp_users.userTypeID=rp_user_type_details.userTypeID and
			rp_project_details.languageID='1' and
			rp_user_type_details.languageID='1' and rp_project_details.versionID=0 and
			rp_projects.projectStatus !='Deleted' $search ");	
			return $qry->Result();	
	}
				/*................. End Function For Project List Show Behalf on Search Keyword ......................................*/
	
	/*.............................................. Start Function For Project Log Search ......................................................*/
	
	function GetProjectlogdetails($projectID =false,$actiontype=false) {
        if ($projectID != null) {  
            $qry = $this->db->query("select rp_admin_users.adminUserEmail from  rp_project_log,rp_admin_users where
									rp_project_log.projectID='$projectID' and
									rp_project_log.Action='$actiontype' and
									rp_project_log.userID=rp_admin_users.adminUserID
									ORDER BY rp_project_log.logID DESC");
            return $qry->Result();
        }
    }
	
	 function GetProjectFilterlog($filter = false, $offset=false,$count=false) {  //echo $offset; echo $count;die;
		 	if($this->input->post('submit') == 'Export to CSV') {
        $qry = $this->db->query("select DISTINCT rp_project_details.projectName,adminUserEmail,DateTime,Action,planTitle from rp_project_log,rp_projects,rp_project_details,rp_admin_users,rp_dbho_plan_mapping,rp_user_plan_details where
									rp_project_log.projectID=rp_projects.projectID and
									rp_projects.projectID=rp_project_details.projectID and
									rp_project_log.userID=rp_admin_users.adminUserID and 
									rp_projects.projectID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='project' AND
									rp_user_plan_details.planID=rp_project_log.planID and
									rp_user_plan_details.languageID='1' and
									rp_project_details.languageID='1' $filter ORDER BY rp_project_log.logID DESC");
									return $this->dbutil->csv_from_result($qry); 
									}
								  $qry = $this->db->query("select DISTINCT rp_projects.projectKey,rp_project_details.projectName,adminUserEmail,DateTime,Action,planTitle from rp_project_log,rp_projects,rp_project_details,rp_admin_users,rp_dbho_plan_mapping,rp_user_plan_details where
									rp_project_log.projectID=rp_projects.projectID and
									rp_projects.projectID=rp_project_details.projectID and
									rp_project_log.userID=rp_admin_users.adminUserID and 
									rp_projects.projectID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='project' AND
									rp_user_plan_details.planID=rp_project_log.planID and
									rp_user_plan_details.languageID='1' and
									rp_project_details.languageID='1' $filter LIMIT $offset,$count ");	 
        return $qry->Result();
    }
	
	/*..................Start Function For Retrieve Country Details........................................*/
	function GetProjectCountryDetail($countryId=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_country_details.countryName from rp_countries,rp_country_details where rp_countries.countryID='$countryId' and rp_countries.countryAvailable='Yes' and rp_country_details.countryID='$countryId' and rp_country_details.languageID='$languageID'");
		return $qry->result();
	}
	/*..................End Function For Retrieve Country Details........................................*/
	
	
	
	/*................... Start Function Retrieve Bedroom ..............................................*/
		function PropertBedroomDetails($projectID=false,$unitType=false)
		{
			$query=$this->db->query("select rp_property_attribute_value_details.attrDetValue from  rp_properties ,rp_property_attribute_values,rp_property_attribute_value_details where rp_properties.projectID='$projectID' and rp_properties.type='$unitType' and rp_properties.propertyID=rp_property_attribute_values.propertyID and rp_property_attribute_values.attributeID='1' and rp_property_attribute_values.attrValueID=rp_property_attribute_value_details.attrValueID and rp_property_attribute_value_details.languageID='1'");
			return $query->result();	
		}
	/*......................End Function For Retrieve State Details........................................*/
	
	
	
	/*....................... Start Function For Retrieve Unit Details ...................................*/
	
	function PropertyUnitPriceRange($projectID=false,$unitType=false)
	{	//echo $projectID; echo $unitType;die;
		$qry=$this->db->query("select rp_property_price.propertyPrice from rp_properties,rp_property_price where rp_properties.projectID='$projectID' and rp_properties.type='$unitType' and rp_properties.propertyID=rp_property_price.propertyID and rp_property_price.currencyID='3'");
		return $qry->result();
	}
	
	/*......................End Function For Retrieve State Details........................................*/
	
	
	/*..................Start Function For Retrieve State Details........................................*/
	function GetProjectStateDetail($stateID=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_state_details.stateName from rp_states,rp_state_details where rp_states.stateID='$stateID' and rp_states.stateStatus='Active' and rp_state_details.stateID='$stateID' and rp_state_details.languageID='$languageID'");
		return $qry->result();
	}
	/*..................End Function For Retrieve State Details........................................*/
	
	
	/*..................Start Function For Retrieve City Details........................................*/
	function GetProjectCityDetail($cityID=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_city_details.cityName from rp_cities,rp_city_details where rp_cities.cityID='$cityID' and rp_cities.cityStatus='Active' and rp_city_details.cityID='$cityID' and rp_city_details.languageID='$languageID'");
		return $qry->result();
	}
	/*..................End Function For Retrieve City Details........................................*/
	
	
	/*.............. Start Function For Retrieve Project Data For Edit Case For Project View And Insert Data For Project Log ......................*/
	function GetProjectDataDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_projects.*,rp_project_details.*,rp_users.*,rp_user_details.* from rp_projects,rp_project_details,rp_users,rp_user_details where rp_projects.projectID=$filter and rp_project_details.projectID=$filter and rp_projects.userID=rp_users.userID and rp_users.userID=rp_user_details.userID and rp_project_details.languageID=$languageID and rp_user_details.languageID=$languageID");
		return $qry->result();
	}
	/*.............. End Function For Retrieve Project Data For Edit Case For Project View And Insert Data For Project Log ......................*/
	
	
	
	
	
	/*.............. Start Function For Retrieve Project Payment Data For Edit Case For Project View  ......................*/
	function GetProjectPaymentDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select * from `rp_project_payment_info` where projectID=$filter and languageID=$languageID");
		return $qry->result();
	}
	/*.............. End Function For Retrieve Project Payment Data For Edit Case For Project View  ......................*/
	
	
	/*.............. Start Function For Retrieve Project Images For Edit Case For Project View  ......................*/
	function GetProjectImageDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_project_images.*,rp_project_image_details.* from rp_project_images,rp_project_image_details where rp_project_images.projectID=$filter and rp_project_images.projectImageID=rp_project_image_details.projectImageID and rp_project_image_details.languageID=$languageID");
		return $qry->result();
	}
	/*.............. End Function For Retrieve Project Images For Edit Case For Project View  ......................*/
	
	
	 public function DeleteProjectGalery($filter = false) {
        $this->db->query("DELETE rp_project_images,rp_project_image_details FROM rp_project_images JOIN rp_project_image_details ON rp_project_image_details.projectImageID = rp_project_images.projectImageID WHERE rp_project_images.projectImageID ='$filter'");
    }
	
	
	 public function DeleteProjectVideo($filter = false) {
        $this->db->query("DELETE rp_project_videos,rp_project_video_details FROM rp_project_videos JOIN rp_project_video_details ON rp_project_video_details.projectVideoID = rp_project_videos.projectVideoID WHERE rp_project_videos.projectVideoID ='$filter'");
    }
	
	
	/*.............. Start Function For Retrieve Project Video For Edit Case For Project View  ......................*/
	function GetProjectVideoDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_project_videos.*,rp_project_video_details.* from rp_project_videos,rp_project_video_details where rp_project_videos.projectID=$filter and rp_project_videos.projectVideoID=rp_project_video_details.projectVideoID and rp_project_video_details.languageID=$languageID");
		return $qry->result();
	}
	/*.............. End Function For Retrieve Project Video For Edit Case For Project View  ......................*/
	
	
	/*.............. Start Function For Retrieve Project Unit Details For Edit Case For Project View  ......................*/
	function GetProjectUnitDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_properties.propertyID,rp_property_attribute_values.*,rp_property_attribute_value_details.*,rp_property_price.* where rp_properties.projectID='$filter' and rp_properties.type='Unit' and rp_property_attribute_values.propertyID=rp_properties.propertyID and rp_property_attribute_value_details.attrValueID=rp_property_attribute_values.attrValueID and rp_property_price.propertyID=rp_properties.propertyID");
		return $qry->result();
	}
	/*.............. End Function For Retrieve Project Unit Details For Edit Case For Project View  ......................*/
	
	
	/*........................... Start Function For Retrieve Data Behalf On Filter ....................................*/
	function GetSingleData($table=false,$filter=false)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
	/*........................... End Function For Retrieve Data Behalf On Filter ....................................*/
	
	
	/*........................... Start Function For Delete Data Behalf On Filter But Recently Not Used In Project ....................................*/
	function DeleteSingleData($table=false,$filter=false)
	{
		$this->db->where($filter);
		$qry=$this->db->delete($table);
		return $qry;
	}
	/*........................... End Function For Delete Data Behalf On Filter But Recently Not Used In Project ....................................*/
	
	
	/*.................. Start Function For Delete Attribute Value And Attribute Value Details Behalf On Filter(Project ID) .......................*/
	function deleteattributesandvalues($filter=false)
	{
		$qry=$this->db->query("DELETE rp_project_attribute_values,rp_project_attribute_value_details FROM rp_project_attribute_values JOIN rp_project_attribute_value_details ON rp_project_attribute_value_details.attrValueID = rp_project_attribute_values.attrValueID WHERE rp_project_attribute_values.projectID ='$filter'");
		//return $qry->result();
	}
	/*.................. End Function For Delete Attribute Value And Attribute Value Details Behalf On Filter(Project ID) .......................*/
	
	
	/* ............... Start Function For delete Attribute Value and Attribute Value Detail For Project unit .....................................*/
	public function deleteattributesandvaluesProjectUnit($filter=false)
	{
		$this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter'");
	}
	/* ............... End Function For delete Attribute Value and Attribute Value Detail For Project unit .....................................*/
	
	
	/* ............... Start Function For Retrieve All Data For Project Log View .....................................*/
	function LogDetail($table=false)
	{
		$this->db->select('*');
		$qry=$this->db->get($table);
		return $qry->result();
	}
	/* ............... End Function For Retrieve All Data For Project Log View .....................................*/
	
	
	/* ............... Start Function For Retrieve Amenities Detail Data For Project Unit Specification View .....................*/
	function GetAminitiesDetail($table=false,$filter=false){
		$query=$this->db->get_where($table,$filter);
		return $query->result();
	}
	/* ............... End Function For Retrieve Amenities Detail Data For Project Unit Specification View .....................*/


	/* ............... Start Function For Retrieve Project Unit Details Behalf On Project ID .....................*/
	function Getunitdetails($filter=false)
	{
		$query=$this->db->query("select * from rp_properties where projectID='$filter' and type='Unit'");
		return $query->result();
	}
	/* ............... End Function For Retrieve Project Unit Details Behalf On Project ID .....................*/
	
	
	/* ............... Start Function For Retrieve Attribute Value And Attribute Value Details In Project Unit Details Behalf On Project ID ..............*/
	function GetAttributeDeatilValueDetail($filter=false,$filter2)
	{
		$query=$this->db->query("select rp_attribute_details.attrName,rp_property_attribute_value_details.attrDetValue from rp_attribute_details,rp_property_attribute_value_details where rp_attribute_details.attributeID='$filter' and rp_attribute_details.languageID=1 and rp_property_attribute_value_details.attrValueID='$filter2' and rp_property_attribute_value_details.languageID=1");
		return $query->result();
	}
	/* ............... End Function For Retrieve Attribute Value And Attribute Value Details In Project Unit Details Behalf On Project ID ..............*/
	
	
	/*.............. Start Function For Retrieve Project Floar Images For Edit Case In Project View  ......................*/
	function GetPropertyImageDetail($filter=false,$languageID=false)
	{
		$qry=$this->db->query("select rp_property_images.*,rp_property_image_details.* from rp_property_images,rp_property_image_details where rp_property_images.propertyID=$filter and rp_property_images.propertyImageID=rp_property_image_details.propertyImageID and rp_property_image_details.languageID=$languageID");
		return $qry->result();
	}	
	/*.............. End Function For Retrieve Project Floar Images For Edit Case In Project View  ......................*/
	
	
	/*.............. Start Function For Retrieve Campaign Details Behalf on UserId And Plan Id ......................*/
	function GetCampaignIDPlaneDetail($filter=false,$filter2=false)
	{
		$query=$this->db->query("select  rp_dbho_campaignmaster.campaignID,rp_dbho_campaignplan.* from rp_dbho_campaignmaster,rp_dbho_campaignplan where rp_dbho_campaignmaster.userID='$filter' and rp_dbho_campaignplan.planID='$filter2' and  rp_dbho_campaignplan.campaignID= rp_dbho_campaignmaster.campaignID  and rp_dbho_campaignplan.status='Active'");
		return $query->result();
	}
	/*.............. End Function For Retrieve Campaign Details Behalf on UserId And Plan Id ......................*/
	
	
	
	function Shownoofbedrooms($table=false,$projectID=false)
	{
		$this->db->select('attrDetValue,attrOptionID');
	   $this->db->from('rp_project_attribute_values t1');
	   $this->db->join('rp_project_attribute_value_details t2','t1.attrValueID=t2.attrValueID AND t2.languageID=1 ','inner');
	   $this->db->where($projectID);
	   $query = $this->db->get();
	   return $result = $query->result();
	}
	
	
	 function Getotherdata($table=false,$filter=false){
		$query=$this->db->get_where($table,$filter);
		return $query->result();
	} 
	
	
	/*.............................. Start Function For Project Unit Delete .......................................*/
	function ProjectUnitDelete($propertyID,$projectID)
	{
		$this->db->query("delete rp_properties,rp_property_price from rp_properties,rp_property_price where rp_properties.propertyID='$propertyID' and rp_property_price.propertyID='$propertyID'");
		$this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$propertyID'");
	}
	/*.............................. End Function For Project Unit Delete .......................................*/
	
	
	
	/*.......................Start Function For Get Project Unit Details..........................................*/
	function GetProjectUnitDetails($filter=false,$languageID=false)
	{
		$query=$this->db->query("select rp_property_attribute_values.*,rp_property_attribute_value_details.* from rp_property_attribute_values,rp_property_attribute_value_details where rp_property_attribute_values.propertyID='$filter' and rp_property_attribute_values.attrValueID=rp_property_attribute_value_details.attrValueID and rp_property_attribute_value_details.languageID=$languageID");
		return $query->result();
	}
	/*.......................End Function For Get Project Unit Details..........................................*/
	
	
	
	/*..................... Satrt Function For Get Badroom Detail In unit List ......................................*/
	function GetBedroomDetailsUnit($filter=false,$languageID=false)
	{
		$query=$this->db->query("select rp_property_attribute_values.*,rp_property_attribute_value_details.* from rp_property_attribute_values,rp_property_attribute_value_details where rp_property_attribute_values.propertyID='$filter' and rp_property_attribute_values.attributeID=1 and rp_property_attribute_values.attrValueID=rp_property_attribute_value_details.attrValueID and rp_property_attribute_value_details.languageID=$languageID");
	}
	/*..................... End Function For Get Badroom Detail In unit List ......................................*/	
		
		
		/*********************************************Google Api Info Save Start**********************************************************/
	 function saveGoogleLocalInfos($googleLocalInfos="", $localInfoTypeID="", $projectID="")
    {
		for($j=0; $j<count($googleLocalInfos); $j++) 
		{
			$googleInfoPlaceId  = $googleLocalInfos[$j]->place_id;
			$googleInfoLat      = $googleLocalInfos[$j]->geometry->location->lat;
			$googleInfoLong     = $googleLocalInfos[$j]->geometry->location->lng;
			$googleInfoImageUrl = $googleLocalInfos[$j]->icon;
			$googleInfoName     = str_replace("'",",",$googleLocalInfos[$j]->name);
			$googleInfoAddress  = str_replace("'",",",$googleLocalInfos[$j]->vicinity);
			
			if($googleInfoPlaceId != "")
			{				
				$placeIdCheck=$this->db->query("SELECT * 
										FROM rp_google_localinfo 
										WHERE googleInfoPlaceId = '".$googleInfoPlaceId."'");
				$placeIdCheck= $placeIdCheck->result();
				
				
				if($placeIdCheck)
				{
					$sqlSelectLink	= $this->db->query("SELECT googleInfoToProjectID 
										FROM rp_google_localinfo_to_project 
										WHERE googleInfoID = '".$placeIdCheck[0]->googleInfoID."' AND projectID = '".$projectID."'");

					$linkCheck	= $sqlSelectLink->result();
					if(!$linkCheck)
					{
						$this->db->query("INSERT INTO rp_google_localinfo_to_project (
													googleInfoID,
													projectID) 
												values (
													'".$placeIdCheck[0]->googleInfoID."',
													'".$projectID."')");
											
						
					}	
				}
				else
				{  
					$sqlInsertInfo	= "INSERT INTO rp_google_localinfo (
										localinfoTypeID,
										googleInfoPlaceId,
										googleInfoLat,
										googleInfoLong,
										googleInfoImageUrl,
										googleInfoStatus ) 
									values (
										'".$localInfoTypeID."',
										'".$googleInfoPlaceId."',
										'".$googleInfoLat."',    
										'".$googleInfoLong."',
										'".$googleInfoImageUrl."',
										'Active')";

					$this->db->query($sqlInsertInfo);
					
					$googleInfoID   = $this->db->insert_id();
					
					/* for ($z = 0; $z < count($languages); $z++) 
					{ */
						 $sqlInsertInfoDtls	= "INSERT INTO rp_google_localinfo_details (
												languageID,
												googleInfoID,
												googleInfoName,
												googleInfoAddress,
												infoName,
												infoAddress ) 
											values (
												'1',
												'".$googleInfoID."',
												'".$googleInfoName."',    
												'".$googleInfoAddress."',
												'".$googleInfoName."',    
												'".$googleInfoAddress."')";
												
						 $this->db->query($sqlInsertInfoDtls);
					/* }  */
					
					$sqlLinkWithProject	= "INSERT INTO rp_google_localinfo_to_project (
												googleInfoID,
												projectID) 
											values (
												'".$googleInfoID."',
												'".$projectID."')";
											
					$this->db->query($sqlLinkWithProject);
					//return true;
				}   
			}    
		} 		
    }
	
	
	public function editImageTag($imageid=false,$imagetagText=false,$imagetagText1=false)
	{
			
			$this->db->set('projectImageTitle',$imagetagText );
			$this->db->where('projectImageID', $imageid);
			$this->db->update('rp_project_image_details');
			
			$this->db->set('projectImagePriority',$imagetagText1 );
			$this->db->where('projectImageID', $imageid);
			return $this->db->update('rp_project_images');

	}	
	
	
	public function Deleteprojectimage($filter=false)
	{
		$this->db->query("DELETE rp_project_images,rp_project_image_details FROM rp_project_images JOIN rp_project_image_details ON rp_project_image_details.projectImageID = rp_project_images.projectImageID WHERE rp_project_images.projectID='$filter'");
	}
	
	/*********************************************Google Api Info Save End**********************************************************/
	
	public function fetchLocalInfoTypes()
	{
				$this->db->select('*');
				$this->db->from('rp_localinfo_types t1');
				$this->db->join('rp_localinfo_type_details t2','t1.localinfoTypeID=t2.localinfoTypeID AND t2.languageID=1 ','inner');
				$query = $this->db->get();
				
			return $query->result();
	}
	
	public function Getaddressids($arr = array())
	{
		
		
		$sublocality = $arr['sublocality'];// => Maharana Pratap Nagar
		$country = $arr['country'];// => India
		$administrative_area_level_1 = $arr['administrative_area_level_1'];// => Madhya Pradesh
		$locality = $arr['locality'];// => Bhopal
		$lat=$arr['projectLatitude'];
		$long=$arr['projectLongitude'];
		
		$countryid='';
		$stateid='';
		$cityid='';
		$citylocid='';
		
		/****************************************Get Country ID**************************************************************/
		$removeSpacecountry = str_replace(' ','_',$country);
		$removeSpaceLowercasecountry = strtolower($removeSpacecountry);
		
		$this->db->select("t1.*");
		$this->db->from('rp_countries t1');
		$this->db->where('t1.countryUrlKey like "'.$removeSpaceLowercasecountry.'"');
		$query = $this->db->get();
		
		$queryResult = $query->result();
		
		if(!empty($queryResult))
		{
			$countryid=$queryResult[0]->countryID;
			
		}else{
			
			$countrydata=array( 'countryAvailable'=>'Yes',
								'countryIsoA2'=>'',
								'countryIsoA3'=>'', 
								'countryIsoNumber'=>'',
								'countryPriority'=>'',
								'addressFormatID'=>'',
								'countryUrlKey'=>$removeSpaceLowercasecountry);
								
			$this->db->insert('rp_countries',$countrydata);	
			
			$lastinsertedcountryid=$this->db->insert_id();
			
			$countrydetaildata=array('countryID'=>$lastinsertedcountryid,
									 'languageID'=>'1',
									 'countryName'=>$removeSpacecountry);
					
			$this->db->insert('rp_country_details',$countrydetaildata);	
			
			$countryid=$lastinsertedcountryid;
		}
		/****************************************Get Country ID**************************************************************/
		
		/****************************************Get State ID**************************************************************/
		$removeSpacestate = explode(' ',$administrative_area_level_1);
		$removeSpacestate = implode('_',$removeSpacestate);
		$removeSpaceLowercasestate = strtolower($removeSpacestate);
		
		$this->db->select("t1.*");
		$this->db->from('rp_states t1');
		$this->db->where('t1.stateUrlKey like "'.$removeSpaceLowercasestate.'"');
		$query = $this->db->get();
		
		$queryResult1 = $query->result();
		
		if(!empty($queryResult1))
		{
			$stateid=$queryResult1[0]->stateID;
			
		}else{
			
			$statedata=array(   'countryID'=>$countryid,
								'stateShortName'=>'',
								'stateStatus'=>'Active', 
								'stateUrlKey'=>$removeSpaceLowercasestate,
								'googleStateName'=>$administrative_area_level_1);
								
			$this->db->insert('rp_states',$statedata);	
			
			$lastinsertedstateid=$this->db->insert_id();
			
			$statedetaildata=array('stateID'=>$lastinsertedstateid,
									 'languageID'=>'1',
									 'stateName'=>$administrative_area_level_1);
									 
			$this->db->insert('rp_state_details',$statedetaildata);		
			
			$stateid=$lastinsertedstateid;
		}
		/****************************************Get State ID**************************************************************/
		
		/****************************************Get City ID**************************************************************/
		//$removeSpacecity = str_replace(' ','_',$locality);
		$removeSpacecity = explode(' ',$locality);
		$removeSpacecity = implode('_',$removeSpacecity);
		$removeSpaceLowercasecity = strtolower($removeSpacecity);
		
		$this->db->select("t1.*");
		$this->db->from('rp_cities t1');
		$this->db->where('t1.cityKeyID like "'.$removeSpaceLowercasecity.'"');
		$query2 = $this->db->get();
		
		$queryResult2 = $query2->result();
		
		if(!empty($queryResult2))
		{
			$cityid=$queryResult2[0]->cityID;
			
		}else{
			
			$citydata=array( 	'countryID'=>$countryid,
								'stateID'=>$stateid,
								'parentcityID'=>'0', 
								'timeZoneID'=>'0',
								'cityKeyID'=>$removeSpaceLowercasecity,
								'cityProximity'=>'City',
								'cityLat'=>$lat,
								'cityLng'=>$long,
								'citylogoImage'=>'',
								'citybgImage'=>'',
								'cityStatus'=>'Active',
								'cityCampaignListID'=>'',
								'googleCityName'=>$locality,
								'isDefault'=>'No',
								'explore'=>'No');
								
			$this->db->insert('rp_cities',$citydata);	
			
			$lastinsertedcityid=$this->db->insert_id();
			
			$citydetaildata=array('cityID'=>$lastinsertedcityid,
									 'languageID'=>'1',
									 'cityName'=>$locality,
									 'province'=>'',
									 'cityDescription'=>'');
					
			$this->db->insert('rp_city_details',$citydetaildata);	
			
			$cityid=$lastinsertedcityid;
		}
		/****************************************Get City ID**************************************************************/
		
		/****************************************Get City Locality ID**************************************************************/
		
		$removeSpace = str_replace(' ','_',$sublocality);
		$removeSpaceLowercase = strtolower($removeSpace);
		$this->db->select("t1.*");
		$this->db->from('rp_city_locations t1');
		$this->db->where('t1.cityLocUrlKey like "'.$removeSpaceLowercase.'"');
		$query3 = $this->db->get();
		$queryResult3 = $query3->result();
		
		if(!empty($queryResult3))
		{
			
			$citylocid = $queryResult3[0]->cityLocID;
			
		}else
		{
			$locdata = array();
			$locdata['cityID'] = $cityid;
			$removeSpacescityLocUrlKey = str_replace(' ','_',$sublocality);
			$locdata['cityLocUrlKey'] = strtolower($removeSpacescityLocUrlKey);
			$locdata['cityLocLat'] = $lat;
			$locdata['cityLocLng'] = $long;
			$locdata['cityLocStatus'] = 'Active';
			$locdata['googleLocName'] = $sublocality;
			
			$this->db->insert('rp_city_locations',$locdata);
			$lastInsertedcityLocID = $this->db->insert_id();
			
			$locdata = array();
			$locdata['cityLocID'] = $lastInsertedcityLocID;
			$locdata['cityLocName'] = $sublocality;
			$locdata['cityLocTips'] = $sublocality;
			$locdata['languageID'] = 1;
			
			$this->db->insert('rp_city_location_details',$locdata);
			$citylocid = $lastInsertedcityLocID;
			
		}	
			$returnids=array( 	 'countryID'=>$countryid,
								 'stateID'=>$stateid,
								 'cityID'=>$cityid,
								 'cityLocID'=>$citylocid);
			return $returnids;
	}
		
	function paination($offset=false,$count=false)
	{
		 $qry = $this->db->query("select DISTINCT rp_projects.projectKey,rp_project_details.projectName,adminUserEmail,DateTime,Action,planTitle from rp_project_log,rp_projects,rp_project_details,rp_admin_users,rp_dbho_plan_mapping,rp_user_plan_details where
									rp_project_log.projectID=rp_projects.projectID and
									rp_projects.projectID=rp_project_details.projectID and
									rp_project_log.userID=rp_admin_users.adminUserID and 
									rp_projects.projectID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='project' AND
									rp_user_plan_details.planID=rp_project_log.planID and
									rp_user_plan_details.languageID='1' and
									rp_project_details.languageID='1' LIMIT $offset,$count");	 
        return $qry->Result();
	}
	
	
}