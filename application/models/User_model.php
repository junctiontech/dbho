<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function getUser($userID){
		$query = $this->db->get_where('rp_users', array('userID' => $userID));
		return $query->result();
	}
	
	public function getUserDetail($userID){
		$this->db->join('rp_user_to_type', 'rp_user_to_type.userID = rp_user_details.userID');
		$this->db->join('rp_user_type_details', 'rp_user_type_details.userTypeID = rp_user_to_type.userTypeID');
		$this->db->where(array('rp_user_details.userID' => $userID, 'rp_user_details.languageID' => 1, 'rp_user_type_details.languageID' => 1));
		$query = $this->db->get('rp_user_details');
		
		//echo $this->db->last_query();
		$results = $query->result();
		return $results[0];
	}
}
?>
