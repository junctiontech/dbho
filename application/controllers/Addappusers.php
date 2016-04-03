<?php

if(!defined('BASEPATH')) exit ('No direct script access allowed');
class Addappusers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->data[]="";
			$this->data['url'] = base_url();
			$this->load->library('parser');
			$this->load->library('utilities');
			$this->data['base_url']=base_url();
			$this->load->library('session');
			if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}
			$timezone = "Asia/Calcutta";
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		  
			}
		public function Index(){
			$this->load->model('Addappuser_model');
			$this->data['allAppUser'] = $this->Addappuser_model->getAllAppUsers();
			/* echo"<pre>";
				print_r($this->data['allAppUser']); die; */
			$this->parser->parse('header',$this->data);
			$this->load->view('appUserList',$this->data);
			$this->parser->parse('footer',$this->data);
			}
		public function addAppUser(){
			$this->load->model('Addappuser_model');
			$this->data['getCity']=$this->Addappuser_model->getAllCities();
			//print_r($this->data['getCity']);
			$this->parser->parse('header',$this->data);
			$this->load->view('addAppUser',$this->data);
			$this->parser->parse('footer',$this->data);
		}
		public function editAppUser(){			
			$userID = $this->uri->segment(3);
			$this->load->model('Addappuser_model');
			$this->data['userInfo'] = $this->Addappuser_model->getUser($userID);
			$this->data['getCity']=$this->Addappuser_model->getAllCities();
			//echo"<pre>";print_r($this->data['userInfo']);
			$this->parser->parse('header',$this->data);
			$this->load->view('editAppUser',$this->data);
			$this->parser->parse('footer',$this->data);
			
		}
		public function saveAppuser(){
			$this->load->model('Addappuser_model');
			$this->data['saveUsers']=$this->Addappuser_model->saveAllAppUsers($this->input->post());
			if($this->data['saveUsers']==1){
				redirect('/Addappusers/index', 'refresh');
			}
			else{
				redirect('/Addappusers/addAppUser', 'refresh');
			} 		 
		}
		 public function saveEditAppuser(){			
			$this->load->model('Addappuser_model');
			$this->data['saveEditUsers']=$this->Addappuser_model->saveAllEditAppUsers($this->input->post());
			//echo"<pre>";print_r($this->data['saveEditUsers']);die;
			if($this->data['saveEditUsers']){
				redirect('/Addappusers/index', 'refresh');
			}
			else{
				redirect('/Addappusers/editAppUser/'.$this->input->post('userid'), 'refresh');
			} 	
			 
			
		} 
		
		public function getAppuserAssignee(){
			$datetimeVar = $this->input->post('datetimevar');
			$this->load->model('Addappuser_model');
			$freeUsers = $this->Addappuser_model->getAppuserAssignee($datetimeVar);
			//echo "<pre>";print_r($freeUsers);
			echo '<div class="form-group"><label class="control-label" for="AppointmentAssignee">Appointment Assignee</label><div class="controls"><select id="AppointmentAssignee" name="AppointmentAssignee" data-rel="chosen" class="form-control"><option value="0">Select Assignee User</option>';
			foreach($freeUsers as $key=>$value){				
				echo '<option value="'.$value->userID.'">';
				echo $value->name.' ('.$value->email.')';
				echo '</option>';
			}
			echo '</select></div></div>';
			exit;
		}
		
		public function getAppusernameCheck(){
			$username = $this->input->post('username');
			$this->load->model('Addappuser_model');
			$username = $this->Addappuser_model->getAppusernameCheck($username);
			//print_r($username);
			if(count($username)>0)
				echo "User Already in our system";
			
			exit;
		}
					
  }


?>
