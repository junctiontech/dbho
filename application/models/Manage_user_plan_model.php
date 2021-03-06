<?php class Manage_user_plan_model extends CI_Model
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
	}
	
	function insert_userplan($plantitle=false,$planusertype=false,$planorder=false,$plantype=false,$planstatus=false,$date=false,$listingtype=false,$filter=false)
   {	
		 if($filter){
			 $data=array('userTypeID'=>$planusertype,'currencyID'=>'3','planPrice'=>$planorder,'planStatus'=>$planstatus,'planDisplayTime'=>'1000','planEnquiryCount'=>'1000','planAgentCount'=>'50','planEmployeeCount'=>'50');
				$this->db->where($filter);
				$this->db->update('rp_user_plans',$data);
				$qry = $this->db->query("select userTypeName from rp_user_type_details where
										userTypeID=$planusertype");
										$qry=$qry->Result();
										$usertypename=$qry[0]->userTypeName;
				$data1=array('planTitle'=>$plantitle.' For '.$usertypename.' '.$listingtype);
				$this->db->where($filter);
				$this->db->update('rp_user_plan_details',$data1);
				$data2=array('listingType'=>$listingtype);
				$this->db->where($filter);
				$this->db->update('rp_dbho_user_plans_subdetail',$data2);
				
		}else{
				$data=array('userTypeID'=>$planusertype,
							'currencyID'=>'3',
							'planPrice'=>$planorder,
							'planStatus'=>$planstatus,
							'planDate'=>$date,
							'planDisplayTime'=>'1000','planEnquiryCount'=>'1000','planAgentCount'=>'50','planEmployeeCount'=>'50');
				$qry = $this->db->query("select userTypeName from rp_user_type_details where
										userTypeID=$planusertype");
										$qry=$qry->Result();
										$usertypename=$qry[0]->userTypeName;
				$this->db->insert('rp_user_plans',$data);
				$last_id = $this->db->insert_id();
				$data1=array('planID'=>$last_id,
							 'planTitle'=>$plantitle.' For '.$usertypename.' '.$listingtype,
							 'languageID'=>'1');
				$data2=array('planID'=>$last_id,
							 'listingType'=>$listingtype);
				$this->db->insert('rp_user_plan_details',$data1);
				$this->db->insert('rp_dbho_user_plans_subdetail',$data2);
				
				
				
			}
	}
	
	function select_for_update($filter=false)
   {	
			$qry = $this->db->query("select rp_user_plans.planID,planPrice,planTitle,userTypeID,planStatus,listingType  from rp_user_plans,rp_user_plan_details,rp_dbho_user_plans_subdetail where
			rp_user_plans.planID=rp_user_plan_details.planID and
			rp_user_plans.planID=rp_dbho_user_plans_subdetail.planID and
			rp_user_plan_details.languageID='1' and
			rp_user_plans.planID=$filter ");	
			return $qry->Result();	
	}
	
	
	function get_userplans($plantitle=false,$usertype=false,$listingType=false)
	{	
			$query="";
			if(!empty($plantitle)){
				$query.=" and `planTitle` like TRIM('%$plantitle%') ";
			}
			if(!empty($usertype)){
				$query.=" and `userTypeName` like TRIM('%$usertype%') ";
			}
			if(!empty($listingType)){
				$query.=" and `listingType` like TRIM('%$listingType%') ";
			}
			
			if($this->input->post('submit') == 'Export to CSV') {
				
				$qry = $this->db->query("select planTitle as PlanName,planPrice as PlanOrder,planDate as CreatedOn,userTypeName as PlanUserType,listingType as ListingType  from rp_user_plans,rp_user_plan_details,rp_user_types,rp_user_type_details,rp_dbho_user_plans_subdetail where
				rp_user_plans.planID=rp_user_plan_details.planID and
				rp_user_plans.planID=rp_dbho_user_plans_subdetail.planID and
				rp_user_plans.userTypeID=rp_user_types.userTypeID and
				rp_user_types.userTypeID=rp_user_type_details.userTypeID and 
				rp_user_type_details.languageID='1' and
				rp_user_plan_details.languageID='1' $query ORDER BY planPrice DESC");	
										return $this->dbutil->csv_from_result($qry); 
									}
			
			$qry = $this->db->query("select rp_user_plans.planID,planPrice,planDate,planTitle,userTypeName,listingType  from rp_user_plans,rp_user_plan_details,rp_user_types,rp_user_type_details,rp_dbho_user_plans_subdetail where
			rp_user_plans.planID=rp_user_plan_details.planID and
			rp_user_plans.planID=rp_dbho_user_plans_subdetail.planID and
			rp_user_plans.userTypeID=rp_user_types.userTypeID and
			rp_user_types.userTypeID=rp_user_type_details.userTypeID and 
			rp_user_type_details.languageID='1' and
			rp_user_plan_details.languageID='1' $query ORDER BY planPrice DESC");	
			
									
			return $qry->Result();	
	}
	
	function get_user_type()
	{
			$qry = $this->db->query("select rp_user_types.userTypeID,userTypeName from rp_user_types,rp_user_type_details where
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1'");	
			return $qry->Result();	
	}
	
	function get_plandetails()
	{
			
			$qry = $this->db->query("select planTypeID,planTypeTitle,Priority from rp_dbho_plantype ");	
			return $qry->Result();	
	}
	
	function select_for_update_plantittle($tittle=false)
	{
			$qry = $this->db->query("select planTypeID from rp_dbho_plantype where `planTypeTitle` like TRIM('$tittle')");	
			//echo $db2->last_query();die;
			return $qry->Result();	
	}
	
	function get_plantypelist($extraqry=false)
	{
			$qry = $this->db->query("select * from rp_dbho_plantype $extraqry ORDER BY Priority DESC");	
			if($this->input->post('submit') == 'Export to CSV') {
				return $this->dbutil->csv_from_result($qry); 
			}
			return $qry->Result();	
	}
	
	function insert_plantype($plantitle=false,$planpriority=false,$filter=false)
   {	if($filter){
			 
				$data=array('planTypeTitle'=>$plantitle,'Priority'=>$planpriority);
				$this->db->where($filter);
				$this->db->update('rp_dbho_plantype',$data);
				
		}else{
				$data=array('planTypeTitle'=>$plantitle,'Priority'=>$planpriority);
				$this->db->insert('rp_dbho_plantype',$data);
			}
	}
	
	function Planlog($query=false)
	{		
			$qry = $this->db->query("select planTitle,userCompanyName,rp_dbho_campaignmaster.created,objectID,objectType,rp_dbho_plan_consumption_log.createdon,rp_dbho_plan_consumption_log.createdBy,rp_dbho_plan_consumption_log.status as UnitconsumuedType 
			from 
			rp_dbho_campaignmaster,
			rp_users,rp_user_details,rp_dbho_plan_consumption_log,rp_user_plan_details 
			where
			rp_dbho_plan_consumption_log.campaignID=rp_dbho_campaignmaster.campaignID and
			rp_dbho_plan_consumption_log.planID=rp_user_plan_details.planID and
			rp_user_plan_details.languageID='1' and
			rp_dbho_campaignmaster.UserID=rp_users.UserID and
			rp_users.UserID=rp_user_details.UserID and
			rp_user_details.languageID='1' $query ORDER BY rp_dbho_plan_consumption_log.logID DESC");
			
			  if($this->input->post('submit') == 'Export to CSV') {
				return $this->dbutil->csv_from_result($qry); 
			} 
			
			return $qry->Result();	
	}
	
	function get_object_name($table=false,$key=false,$filter=false)
   {				$this->db->select("$key as 'name'");
			$query = $this->db->get_where($table, $filter);
			return $query->Result();
   }
		
}