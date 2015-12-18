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
	
	
		
}