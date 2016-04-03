<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');
 class Addappuser_model extends CI_Model{
 			public function __construct(){
 				$this->load->database();
 			}
 		public function getAllAppUsers(){
 			
 			$this->db->select('*');
			$this->db->from('rp_app_users');
			$this->db->order_by('userID','desc');
			$query = $this->db->get();			
			return $query->result();
	 			}
		public function getAllCities(){
			$this->db->select('cityName');
			$this->db->from('rp_city_details');
			$this->db->where('cityID=5 and languageID=1');
			$query=$this->db->get();
			return $query->result();
			
		}		
 		
	public function saveAllAppUsers($arr = array()){
		
			/* if($arr['password']!=$arr['confirmpassword']){
				return false;
			}
			$saveData = array();
			if(!isset($arr['userid'])){
				$saveData['userID']=$arr['userid'];
				$saveData['username']=$arr['username'];
				$saveData['name']=$arr['name'];
				$saveData['email']=$arr['email'];
				$saveData['cityID']=$arr['usercity'];
				$saveData['status']=$arr['status'];	
				$saveData['password']=md5($arr['password']);
				return $this->db->insert('rp_app_users',$saveData);
			}else if (isset($arr['userid'])){
				if($arr['password']!=$arr['confirmpassword']){
					return false;
				}else if(!empty($arr['password'])){
					if($arr['password']==$arr['confirmpassword']){
						$saveData['userID']=$arr['userid'];
						$saveData['username']=$arr['username'];
						$saveData['name']=$arr['name'];
						$saveData['email']=$arr['email'];
						$saveData['cityID']=$arr['usercity'];
						$saveData['status']=$arr['status'];	
						$saveData['password']=md5($arr['password']);
					}
							
				$this->db->set($saveData);
				$this->db->where('userID', $arr['userid']);	
				$this->db->update('rp_app_users');
				}else{
						$saveData['userID']=$arr['userid'];
						$saveData['username']=$arr['username'];
						$saveData['name']=$arr['name'];
						$saveData['email']=$arr['email'];
						$saveData['cityID']=$arr['usercity'];
						$saveData['status']=$arr['status'];	
						$this->db->set($saveData);
						$this->db->where('userID', $arr['userid']);	
						$this->db->update('rp_app_users');
				}
			}
			 */
			 //$saveData['userID']=$arr['userid'];
			 $saveData = array();
				//$saveData['userID']=$arr['userid'];
				$saveData['username']=$arr['username'];
				$saveData['name']=$arr['name'];
				$saveData['email']=$arr['email'];
				$saveData['cityID']=$arr['usercity'];
				$saveData['status']=$arr['status'];	
				$saveData['password']=md5($arr['password']);
				return $this->db->insert('rp_app_users',$saveData);
			
	}
	public function saveAllEditAppUsers($arr = array()){
		
			$saveData = array();
			if(empty($arr['password']) && empty($arr['confirmpassword'])){
				$saveData['username']=$arr['username'];
				$saveData['name']=$arr['name'];
				$saveData['email']=$arr['email'];
				$saveData['cityID']=$arr['usercity'];
				$saveData['status']=$arr['status'];	
				$this->db->set($saveData);
				$this->db->where('userID', $arr['userid']);	
				return $this->db->update('rp_app_users');
			}else if(!empty($arr['password']) || !empty($arr['confirmpassword'])){
				if(trim($arr['password'])==trim($arr['confirmpassword'])){
					$saveData['username']=$arr['username'];
					$saveData['name']=$arr['name'];
					$saveData['email']=$arr['email'];
					$saveData['cityID']=$arr['usercity'];
					$saveData['status']=$arr['status'];	
					$saveData['password']=md5($arr['password']);
					$this->db->set($saveData);
					$this->db->where('userID', $arr['userid']);
					return $this->db->update('rp_app_users');
				}
				
			}
			
		 
	}
	
	public function getUser($userid){
		$this->db->select('*');
			$this->db->from('rp_app_users');
			$this->db->where('userID="'.$userid.'"');
			$query=$this->db->get();
			return $query->result();
	}
	public function getAppusernameCheck($username){
			$this->db->select('*');
			$this->db->from('rp_app_users');
			$this->db->where('username="'.$username.'"');
			$query=$this->db->get();
			return $query->result();
	}
	
	public function getAppuserAssignee($datetimeVar){
		$datetimeVar1 = str_replace('/','-',$datetimeVar);
		$datetimeVar = $datetimeVar1.':00';
		$d = date('Y-m-d H:i:s');
		$this->db->select('distinct (t1.userID),t1.name,t1.email,t2.appointmentTime');
		$this->db->from('rp_app_users t1');
		$this->db->join('rp_appointments t2',"t1.userID=t2.userID and t2.appointmentTime!='$datetimeVar' and t2.appointmentTime >='$d' and t1.status='1' group by t1.userID",'LEFT');
		//$this->db->where('appointmentTime="'.$datetimeVar.'"');
		$query=$this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
 }	
?>