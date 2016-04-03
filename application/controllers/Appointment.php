<?php
/******************Rajesh Vishwakarma***********************/
if(!defined('BASEPATH')) exit ('No direct script access allowed');
class Appointment extends CI_Controller{
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
/*------------------------Notification code--------------------------------*/
			public function getAppointmentStatus(){
				$this->load->model('Appointment_model');
			echo $getNotification=$this->Appointment_model->getAppointmentStatus();
			exit;
			}
/* --------------------------End-------------------------------------------- */
			  public function getAppointmentNotification(){
					$this->load->model('Appointment_model');
					$appointmentNotifiDetail =$this->Appointment_model->getAppointmentNotification();
				for($i=0;$i<count($appointmentNotifiDetail);$i++){
					$pid = $appointmentNotifiDetail[$i]->LPID;
					$userimage = $appointmentNotifiDetail[$i]->userProfilePicture;
					echo '<li><a href="'.base_url().'AddProperty/index/'.$pid.'"><span class="image">';
				if($userimage!=''){
					echo '<img src="/public/uploads/profile/avatar/xlarge/'.$userimage.'" alt="Profile Image" />';
				}else{
					echo '<img src="/public/default/manage/standard/images/no_image_male.gif" alt="Profile Image" />';
				}
					echo '</span> <span></span>';
					echo $appointmentNotifiDetail[$i]->name.'</span></span> <span class="message">';
					echo $appointmentNotifiDetail[$i]->note.'</span></a></li>';
			
				}
					echo '<li>
					<div class="text-center"> <a href="'.base_url().'Appointment/ListAppointment/complete"> <strong>See All Complete Appointment</strong> <i class="fa fa-angle-right"></i> </a> </div>
					</li>';
					exit;
				}  
			public function CreateAppointment(){
				$userID=$this->uri->segment(3);
				$propertyID=$this->uri->segment(4);
				$this->data['pId'] = $propertyID;
				$this->load->model('Appointment_model');		
				$propertycheck = $this->Appointment_model->getPropertycheck($propertyID);
				if(count($propertycheck)){
					$getApid =$this->Appointment_model->getApidInfo($propertyID);
					$this->data['getAppointment']=$this->Appointment_model->getAppointmentInfo($userID);
					$this->data['appointassign'] = $this->Appointment_model->appointmentAssignee();
					 /* echo"<pre>";
					print_r($this->data['appointassign']);die;  */ 
					$propertypurpose = $this->Appointment_model->propertytypepurpose($propertyID);
					if(count($propertypurpose)){
						$this->data['propertypurpose'] = $propertypurpose;
					}									
					$this->parser->parse('header',$this->data);
					$this->load->view('createAppointment',$this->data);
					$this->parser->parse('footer',$this->data);
				}else{
					 redirect('/AddProperty/PropertyListing', 'refresh');
				}
			}
				public function listAppointment(){
				$complete=$this->uri->segment(3);
					
					$this->load->model('Appointment_model');
					$this->data['allAppointments'] = $this->Appointment_model->appointmentList($complete);	
					$this->parser->parse('header',$this->data);
					$this->load->view('listAppointment',$this->data);
					$this->parser->parse('footer',$this->data);
				}
							
			public function saveAppointment(){
				
					//$hidappointmentID = $this->input->post('hidappointmentID');
					 $propertyID = $this->input->post('pId');
					$AppointmentAssignee = $this->input->post('AppointmentAssignee');
					$appointmentName = ucfirst($this->input->post('username'));
					$appointmentPhone = $this->input->post('phone');
					$appointmentEmail = $this->input->post('email');
					$appointmentAddress = $this->input->post('address');
					$usertype = $this->input->post('usertype');
					if($this->input->post('selectagency') ){
						$propertyUser = $this->input->post('selectagency');
					}else if( $this->input->post('selectindividual') ){
						$propertyUser = $this->input->post('selectindividual');
					}else if( $this->input->post('selectbuilder') ){
						$propertyUser = $this->input->post('selectbuilder');
					}else if( $this->input->post('selectagent') ){
						$propertyUser = $this->input->post('selectagent');
					}
					
					$saleRent = $this->input->post('ptype');
					$notes = $this->input->post('notes');
					$date = $this->input->post('date');
					$selectstatus = $this->input->post('selectstatus');
					
					$this->load->model('Appointment_model');
					$userExists = $this->Appointment_model->userExists($propertyUser);
					if(count($userExists)){
					$userExistsStatus = 1;
					}else{
						$userExistsStatus = 0;
					}
					$data = array(
						'userID' => $AppointmentAssignee,
						'name' => $appointmentName,
						'phone' => $appointmentPhone,
						'email' => $appointmentEmail,
						'address' => $appointmentAddress,
						'appointmentTime' => $date,
						'userExistsStatus' => $userExistsStatus,
						'note' => $notes,
						'userType' => $usertype,
						'userTypeID' => $propertyUser,
						'propertyPurpose' => $saleRent,	        
						'appointmentStatus'=>$selectstatus,
						'stratTime' => '',
						'endTime' => ''
					);
					$result = $this->Appointment_model->saveAppointment($data,$propertyID);		
					if($result){
					 redirect('/Appointment/listAppointment', 'refresh');
					}else{
						//redirect('<?php=base_url();/Appointment/CreateAppointment/', 'refresh');
					}
					

				}
				
				
				
				
					
					   }


?>
