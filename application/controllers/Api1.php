<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api1 extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('Api_model');
		$this->load->model('AddProperty_model');		
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}
	
	
	public function login(){
		$userName = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$data = array('username'=>$userName,'password'=>md5($password),'status'=>1);
		if( $userName != ''  && $password != '' )
		{
			$LoginInfo = $this->Api_model->checkLogin($data);			
			if(!empty($LoginInfo)){
			$result	=	array(
								'status'	=>	'success',
								'code'		=>	'200',
								'data'		=>	array(
													'userid'	=>	$LoginInfo[0]->userID,
													'name'		=>	$LoginInfo[0]->name
												)
					        );
			}
			else{
				$result	=	array(
							'status'	=>	'error',
							'code'		=>	'400',
							'data'		=>	array(
												'message'	=>	'Invalid username/password'
											)
						);
			}			
		}else{
			$result	=	array(
							'status'	=>	'error',
							'code'		=>	'400',
							'data'		=>	array(
												'message'	=>	'Invalid username/password'
											)
						);
		}
		echo json_encode( $result );
	}
	public function image(){	
		//echo "Rajesh"; die;
		//$propertyID=$this->input->post('propertyID');
		//$imagecategory=$this->input->post('imagecategory');
	    $image = $_FILES['image']['name'];
		$userid	= $this->input->post('userid');
		$app_id = $this->input->post('app_id');
		$room_id=	$this->input->post('room_id');
		$type = $this->input->post('type');
		/*********************Get Property ID**************************/
		$Pid = $this->Api_model->getPropertyID($app_id);
		$propertyID = $Pid[0]->LPID;
		/*********************End Property ID**************************/
		//if(!empty($propertyID) && !empty($imagecategory))
		//{
			
			if($_FILES['image']['name']!='')
			{
				$data['image_z1']= $_FILES['image']['name'];
				$image=sha1($_FILES['image']['name']).time().rand(0, 9);
				
				
					if(!empty($_FILES['image']['name']))
					{
						
						$config =  array(
						'upload_path'	  => '/data/homeonline/staging.homeonline.com/public/uploads/property/images/medium/',
						'file_name'       => $image,
						'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
						'overwrite'       => true);
						
							$this->upload->initialize($config);
							$this->load->library('upload');
				 
								if($this->upload->do_upload("image"))
								{
									$upload_data = $this->upload->data();
									
									$image=$upload_data['file_name'];
									$data=array('propertyID'=>$propertyID,
												'imageCatID'=>2,// this is only for Gallery
												'propertyImageName'=>$image,
												'isCoverImage'=>'No',
												'propertyImagePriority'=>'1',
												'propertyImageStatus'=>'Active'
									);
									$propertyImageID = $this->AddProperty_model->InsertProperty('rp_property_images',$data);
									//echo"<li>room==>".print_r($propertyImageID);
									$data1=array('propertyImageID'=>$propertyImageID,'languageID'=>'1','propertyImageTitle'=>$room_id,'propertyImageAltTag'=>'');
									$this->AddProperty_model->InsertProperty('rp_property_image_details',$data1);
									$status='Success';    
								}else{
									$status='Failure'; 
								}
					}
					if($status=='Success'){
						$code=200;
					}
					else{
						$code=400;
					}
					$msg=array(
								'id'=>$userid,
								'image'=>$image,
								'room_id'=>$room_id,
								'status'=>$status,
								'code'=>$code
							);
					echo json_encode($msg);
			}
		
		//}
	}
	public function appointment(){
		
		$userId = trim((int)$this->input->post('userid'));
		if( $userId != '' )
		{
			$allAppointments = $this->Api_model->getAllAppointment($userId);
			$i=0;
			$finalArr = array();
			for($k=0;$k<count($allAppointments);$k++){
					
				$propertyId = $allAppointments[$k]->LPID;	
				$details = $this->Api_model->getPropertyAttributes($propertyId,$userId);
				
				
				
				$finalArr[$i]['appointmentID']= $allAppointments[$i]->appointmentID;
				$finalArr[$i]['userID']= $allAppointments[$i]->userID;
				$finalArr[$i]['name']= $allAppointments[$i]->name;
				$finalArr[$i]['phone']= $allAppointments[$i]->phone;			
                $finalArr[$i]["email"]= $allAppointments[$i]->email;
                $finalArr[$i]["address"]= $allAppointments[$i]->address;
                $finalArr[$i]["appointmentTime"]= $allAppointments[$i]->appointmentTime;
                $finalArr[$i]["appointmentDate"] =  $allAppointments[$i]->appointmentDate;
				$finalArr[$i]["note"]= $allAppointments[$i]->note;
                $finalArr[$i]["userType"]= $allAppointments[$i]->userType;
                $finalArr[$i]["userTypeID"]= $allAppointments[$i]->userTypeID;
                $finalArr[$i]["userExistsStatus"]= null;
                $finalArr[$i]["propertyType"]= $allAppointments[$i]->propertyType;
                $finalArr[$i]["propertyPurpose"]= $allAppointments[$i]->propertyPurpose;
                $finalArr[$i]["projectType"]= $allAppointments[$i]->projectType;
                $finalArr[$i]["projectID"]= null;
                $finalArr[$i]["price"]= $allAppointments[$i]->price;
                $finalArr[$i]["negotiable"]= null;
                $finalArr[$i]["appointmentStatus"]= $allAppointments[$i]->appointmentStatus;
                $finalArr[$i]["stratTime"]= $allAppointments[$i]->stratTime;
                $finalArr[$i]["endTime"]= $allAppointments[$i]->endTime; 
				
				$details['appdetailID'] = '';
				$details['appointmentID'] = $allAppointments[$i]->appointmentID;
				$details['geoLatitude'] = 2;
				$details['geoLongitude'] = 34;
				$details['userID'] = $allAppointments[$i]->userID;
				$details['propertyType'] = $allAppointments[$i]->propertyType;
				$details['bhkType'] = '1 RK';
				$details['passessionTime'] = '';
				$details['ap_availability_date'] = '0000-00-00';
				$details['preferredVisitTime'] = "By Appointment";				
				$details['name'] = $allAppointments[$i]->name;
				$details['phone'] = $allAppointments[$i]->phone;
				$details['appointmentAlterPhone'] = '';
				$details['appointmentEmail'] = $allAppointments[$i]->email;							
				$details['apponitmentStreet'] = $allAppointments[$i]->address;
				$details['locality'] = 'static value';
				$details['subLocality'] = 'static value';
				$details['pincode'] = '123456';
				$details['landmark'] = "static value";		
					
				$finalArr[$i]['details']=$details; 
					$i++;
			
			}
			//print_r($allSpecAmenities);
			$result	=	array(
								'status'	=>	'success',
								'code'		=>	'200',
								'data'		=>	array(
														'userID'			=>	$userId,
														'appointments'		=>	$k,
														'appointment_list'	=>	$finalArr
													   )	
							);
			
			echo json_encode( $result );
		}
	}
	public function update(){
		echo "update";
	}
}
?>