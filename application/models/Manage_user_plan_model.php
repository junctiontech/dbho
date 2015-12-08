<?php
class Manage_user_plan_model extends CI_Model
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
	
	function insert_userplan($plantitle=false,$planusertype=false,$planorder=false,$plantype=false,$planstatus=false,$date=false,$filter=false)
   {	
		 if($filter){
			 $data=array('userTypeID'=>$planusertype,'planPrice'=>$planorder,'planStatus'=>$planstatus);
				$this->db->where($filter);
				$this->db->update('rp_user_plans',$data);
				$qry = $this->db->query("select userTypeName from rp_user_type_details where
										userTypeID=$planusertype");
										$qry=$qry->Result();
										$usertypename=$qry[0]->userTypeName;
				$data1=array('planTitle'=>$plantitle.' For '.$usertypename);
				$this->db->where($filter);
				$this->db->update('rp_user_plan_details',$data1);
				
		}else{
				$data=array('userTypeID'=>$planusertype,
							'planPrice'=>$planorder,
							'planStatus'=>$planstatus,
							'planDate'=>$date);
				$qry = $this->db->query("select userTypeName from rp_user_type_details where
										userTypeID=$planusertype");
										$qry=$qry->Result();
										$usertypename=$qry[0]->userTypeName;
				$this->db->insert('rp_user_plans',$data);
				$last_id = $this->db->insert_id();
				$data1=array('planID'=>$last_id,
							 'planTitle'=>$plantitle.' For '.$usertypename,
							 'languageID'=>'1');
				$this->db->insert('rp_user_plan_details',$data1);
				
				
			}
	}
	
	function select_for_update($filter=false)
   {	
			$qry = $this->db->query("select rp_user_plans.planID,planPrice,planTitle,userTypeID,planStatus  from rp_user_plans,rp_user_plan_details where
			rp_user_plans.planID=rp_user_plan_details.planID and
			rp_user_plan_details.languageID='1' and
			rp_user_plans.planID=$filter");	
			return $qry->Result();	
	}
	
	
	function get_userplans($plantitle=false,$usertype=false)
	{	
			if(!empty($plantitle) && !empty($usertype)){
				$query="and `planTitle` like TRIM('%$plantitle%') and `userTypeName` like TRIM('%$usertype%') ";
			}else{
				$query="";
			}
			$qry = $this->db->query("select rp_user_plans.planID,planPrice,planDate,planTitle,userTypeName  from rp_user_plans,rp_user_plan_details,rp_user_types,rp_user_type_details where
			rp_user_plans.planID=rp_user_plan_details.planID and
			rp_user_plans.userTypeID=rp_user_types.userTypeID and
			rp_user_types.userTypeID=rp_user_type_details.userTypeID and 
			rp_user_type_details.languageID='1' and
			rp_user_plan_details.languageID='1' $query");	
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
			$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select planTypeID,planTypeTitle,Priority from db_plantype ");	
			return $qry->Result();	
	}
	
	function select_for_update_plantittle($tittle=false)
	{
			$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select planTypeID from db_plantype where `planTypeTitle` like TRIM('$tittle')");	
			//echo $db2->last_query();die;
			return $qry->Result();	
	}
	
	function get_plantypelist()
	{
			$db2 = $this->load->database('both', TRUE);
			$qry = $db2->query("select * from db_plantype ");	
			return $qry->Result();	
	}
	
	function insert_plantype($plantitle=false,$planpriority=false,$filter=false)
   {	$db2 = $this->load->database('both', TRUE);
		 if($filter){
			 
				$data=array('planTypeTitle'=>$plantitle,'Priority'=>$planpriority);
				$db2->where($filter);
				$db2->update('db_plantype',$data);
				
		}else{
				$data=array('planTypeTitle'=>$plantitle,'Priority'=>$planpriority);
				$db2->insert('db_plantype',$data);
			}
	}
		
}