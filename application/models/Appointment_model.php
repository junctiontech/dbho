<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');
 class Appointment_model extends CI_Model{
 			public function __construct(){
 				$this->load->database();
 			}
 		public function getAppointmentInfo($userID=null){
 			if(!empty($userID)){
 			$this->db->select('t1.*,t2.*');
			$this->db->from('rp_users t1');
			$this->db->join('rp_user_details t2','t1.userID=t2.userID AND t1.userID="'.$userID.'" AND t2.languageID=1','inner');
			$query = $this->db->get();
			return $query->result();
	 			}
 		}
		/*------------------------Notification code--------------------------------*/
		public function getAppointmentStatus(){
			$this->db->select('appointmentStatus');
			$this->db->from('rp_appointments');
			$this->db->where('appointmentStatus="complete"');
			$query = $this->db->get();
			$this->db->last_query();
			$affectedCount = count($query->result());
			return $affectedCount;
			
		}
		/*------------------------Notification code End---------------------------*/
		  /* public function getAppointmentNotification(){
			$this->db->select('t1.LPID,t2.name,t2.note');
			//$this->db->from('rp_appointments t2');
			$this->db->from('rp_appointment_property t1');
			//$this->db->where('appointmentStatus="complete"');
			$this->db->join('rp_appointments t2','t1.ApID=t2.appointmentID','t2.appointmentStatus="complete"','inner');
			$query = $this->db->get();
			return $query->result();
		} */  
		public function getAppointmentNotification(){
			$this->db->select('t3.userProfilePicture, t1.LPID, t2.name, t2.note');			
			$this->db->from('rp_appointment_property t1');
			$this->db->join('rp_appointments t2','t1.APID = t2.appointmentID','inner');
			$this->db->join('rp_users t3','t3.userID = t2.userTypeID AND t2.appointmentStatus = "complete"','inner');
			$query = $this->db->get();
			return $query->result();
		}
		/*---------------------[Rajesh10-02-2016]----------------------------------*/
		 public function getApidInfo($propertyID=null){
			if(!empty($propertyID)){
				$this->db->select('t1.APID,t2.appointmentStatus');
				$this->db->from('rp_appointment_property t1');
				$this->db->join('rp_appointments t2','t1.ApID=t2.appointmentID AND t1.LPID="'.$propertyID.'"','inner');
				$query=$this->db->get();
				//echo $this->db->last_query();
				if($query->result()){
					return $query->result();
				}else{
					return false;
				}
				
			}
			
		} 
		/*-----------------------------[END]--------------------------------------*/
 		public function getUserByType($userType=null){
		if($userType!=null){
		$this->db->select('distinct(t1.userID),t2.userFirstName,t2.userLastName,t1.userEmail,t1.userTypeID');
		$this->db->from('rp_users t1');
		$this->db->join('rp_user_details t2','t2.userID=t1.userID AND t1.userTypeID="'.$userType.'"','inner');
		$query = $this->db->get();
		$this->db->last_query();
		return $query->result();
		}else{
			return "fail";
		}
	}	
		public function appointmentList($complete){
			if($complete=='complete'){
				$this->db->select('t1.*,t2.LPID');
				$this->db->from('rp_appointments t1');
				$this->db->join('rp_appointment_property t2',' t1.appointmentID = t2.APID AND t1.appointmentStatus="complete"','inner');
			}else{
				$this->db->select('t1.*,t2.LPID');
				$this->db->from('rp_appointments t1');
				$this->db->join('rp_appointment_property t2',' t1.appointmentID = t2.APID','inner');
			}
				$query = $this->db->get();
			//echo $this->db->last_query();
				return $query->result();
		}
		public function appointmentAssignee(){
			$this->db->select('userID,name,cityID');
			$this->db->from('rp_app_users');
			$this->db->where('status=1 and cityID=5');
			$query = $this->db->get();
			$this->db->last_query();
			return $query->result();
		}
		public function propertytypepurpose($propertyID=null){
			$this->db->select('t1.propertyID,t1.propertyTypeID,t1.propertyPurpose,t1.type,t1.isNegotiable,t2.propertyPrice');
			$this->db->from('rp_properties t1');
			$this->db->join('rp_property_price t2','t1.propertyID=t2.propertyID','inner');
			
			$this->db->where('t1.propertyID ='.$propertyID);
			//$this->db->where('t2.currencyID =3');
			$query = $this->db->get();
			////echo $this->db->last_query();
			return $query->result();
		}
		public function getProjectTypeDetail($projectID=null){
			
			$this->db->select('projectName,projectID');
			$this->db->from('rp_project_details');
			$this->db->where('projectID ='.$projectID );
			$this->db->where('languageID =1' );
			$query = $this->db->get();
			$this->db->last_query();
			return $query->result();
		}
	
		public function userExists($userId){
			$this->db->select('t1.*');
			$this->db->from('rp_users t1');
			$this->db->where('t1.userID ='.$userId );
			$query = $this->db->get();
			$this->db->last_query();
			return $query->result();
		}
		public function saveAppointment($data=array(),$propertyID){

		   if($this->db->insert('rp_appointments',$data)){
			   $lastInsertAppointmentId = $this->db->insert_id();
			   $mapData = array();
			   $mapData['APID'] = $lastInsertAppointmentId;
			   $mapData['LPID'] = $propertyID;
			   $this->db->insert('rp_appointment_property',$mapData);
			   return true;
			}
			else{
				return false;
			}
		}
		
		public function getPropertycheck($pid){
			$this->db->select('t1.*');
			$this->db->from('rp_properties t1');
			$this->db->where('t1.propertyID ='.$pid );
			$query = $this->db->get();
			$this->db->last_query();
			return $query->result();
		}

	 }

?>