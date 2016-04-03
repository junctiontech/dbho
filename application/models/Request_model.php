<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Request_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function getRequests(){
		$query = $this->db->get('rp_raise_request');
		return $query->result();
	}
	
	public function getRequest($raiseRequestID){
		$query = $this->db->get_where('rp_raise_request', array('raiseRequestID' => $raiseRequestID));
		$results = $query->result();
		return $results;
	}
}
?>
