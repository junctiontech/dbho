<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct() {
		parent::__construct();		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('Api_model');
		$this->load->model('AddProperty_model');
		$this->languages=$this->AddProperty_model->getlanguage();		
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

	    $image = $_FILES['image']['name'];
		$userid	= $this->input->post('userid');
		$app_id = $this->input->post('app_id');
		$room_id=	$this->input->post('room_id');
		$type = $this->input->post('type');
		
		$Pid = $this->Api_model->getPropertyID($app_id);
		if($_FILES['image']['name']!='')
		{
			$coverimage='No';
			$propertyID = $Pid[0]->LPID;
			$imagecategory = 2;
			$propertyImageTitle = $type.$this->input->post('room_id');
			if(!empty($propertyID) && !empty($imagecategory))
			{
				$commonThumbWidth = 81;
				$commonThumbHeight = 54;
				$mediumWidth  = 618;
				$mediumHeight  = 412;
				$lightboxWidth    = 1098;
				$lightboxHeight   = 732;
				$largeWidth=300;
				$largeHeight=200;
				$maprightWidth=108;
				$maprightHeight=72;
				$mappopWidth=324;
				$mappopHeight=216;
				$sponsoredWidth   	= 210;
				$sponsoredHeight  	= 140;
				$timelineWidth   	= 93;
				$timelineHeight  	= 62;
				$defaultThumbWidth	= 72;
				$defaultThumbHeight	= 48;
				$smallWidth   		= 81;
				$smallHeight  		= 54;
				$galleryWidth   	= 618;
				$galleryHeight  	= 412;
				$imgName = uniqid(rand(1, 99999)) . '' . $_FILES["image"]["name"];
			   	$originalPath  ="../public/uploads/property/images/original/".$imgName; 
				$commonThumbPath =  "../public/uploads/property/images/thumb/".$imgName;
				$mediumPath   = "../public/uploads/property/images/medium/".$imgName;
				$lightboxPath       = "../public/uploads/property/images/lightbox/".$imgName;
				$largePath       = "../public/uploads/property/images/default/large/".$imgName;
				$maprightPath       = "../public/uploads/property/images/default/mapRight/".$imgName;
				$mappopupPath       = "../public/uploads/property/images/default/mapPopup/".$imgName;
				$sponsoredPath       = "../public/uploads/property/images/default/sponsored/".$imgName;
				$timelinePath       = "../public/uploads/property/images/default/timeline/".$imgName;
				$defaultThumbPath       = "../public/uploads/property/images/default/thumb/".$imgName;
				$smallPath       = "../public/uploads/property/images/default/small/".$imgName;
				$galleryPath       = "../public/uploads/property/images/default/gallery/".$imgName;
				copy($_FILES["image"]["tmp_name"], $originalPath);  
				copy($_FILES["image"]["tmp_name"], $commonThumbPath);
				copy($_FILES["image"]["tmp_name"], $mediumPath);
				copy($_FILES["image"]["tmp_name"], $lightboxPath);
				copy($_FILES["image"]["tmp_name"], $largePath);
				copy($_FILES["image"]["tmp_name"], $maprightPath);
				copy($_FILES["image"]["tmp_name"], $mappopupPath);
				copy($_FILES["image"]["tmp_name"], $sponsoredPath);
				copy($_FILES["image"]["tmp_name"], $timelinePath);
				copy($_FILES["image"]["tmp_name"], $defaultThumbPath);
				copy($_FILES["image"]["tmp_name"], $smallPath);
				copy($_FILES["image"]["tmp_name"], $galleryPath);
				$imgData = @getimagesize($originalPath);
				$w          = $imgData[0];
				$h          = $imgData[1];
				if ($w < $lightboxWidth && $h < $lightboxHeight) 
				{
					$lightboxWidth = $w;
					$lightboxHeight = $h;
				}
				$this->AddProperty_model->resizeImage($mediumPath, $mediumWidth, $mediumHeight);
				$this->AddProperty_model->resizeImage($commonThumbPath, $commonThumbWidth, $commonThumbHeight);
				$this->AddProperty_model->resizeImage($lightboxPath, $lightboxWidth, $lightboxHeight);
				$this->AddProperty_model->resizeImage($largePath, $largeWidth, $largeHeight);
				$this->AddProperty_model->resizeImage($maprightPath, $maprightWidth, $maprightHeight);
				$this->AddProperty_model->resizeImage($mappopupPath, $mappopWidth, $mappopHeight);
				$this->AddProperty_model->resizeImage($sponsoredPath, $sponsoredWidth, $sponsoredHeight);
				$this->AddProperty_model->resizeImage($timelinePath, $timelineWidth, $timelineHeight);
				$this->AddProperty_model->resizeImage($defaultThumbPath, $defaultThumbWidth, $defaultThumbHeight);
				$this->AddProperty_model->resizeImage($smallPath, $smallWidth, $smallHeight);
				$this->AddProperty_model->resizeImage($galleryPath, $galleryWidth, $galleryHeight);
				$resDefaultImg = $this->AddProperty_model->Getotherdata('rp_property_images',array('propertyID'=>$propertyID,'isCoverImage'=>'Yes'));
				if(!empty($resDefaultImg)){
					$coverimage='No';
				}else{
					$coverimage='Yes';
				}
				
				if(!empty($imgName))
				{
					$data=array('propertyID'=>$propertyID,'imageCatID'=>$imagecategory,'propertyImageName'=>$imgName,'isCoverImage'=>$coverimage,'propertyImagePriority'=>'1','propertyImageStatus'=>'Active');
					$propertyImageID=$this->AddProperty_model->InsertProperty('rp_property_images',$data);
					foreach($this->languages as $language){
						$data1=array('propertyImageID'=>$propertyImageID,'languageID'=>$language->languageID,'propertyImageTitle'=>$propertyImageTitle,'propertyImageAltTag'=>$propertyImageTitle);
						$this->AddProperty_model->InsertProperty('rp_property_image_details',$data1);
					}		  
				}
					
				$msg=array(
								'id'=>$userid,
								'image'=>$image,
								'room_id'=>$room_id,
								'status'=>'Success',
								'code'=>'200'
							);
					echo json_encode($msg);
		}
	}
}
	public function appointment(){
		
		$userId = trim((int)$this->input->post('userid'));
		if($userId)
		{
                    $allAppointments = $this->Api_model->getAllAppointment($userId);
                    $i=0;
                    $finalArr = array();
                    for($k=0;$k<count($allAppointments);$k++){
                        $propertyId = $allAppointments[$k]->LPID;
			$propertyPrice = $this->Api_model->getPropertyPrice($propertyId);
			$bedrooms = $this->Api_model->bedrooms($propertyId,$userId,$allAppointments[$i]->appointmentID);
			$kitchens = $this->Api_model->kitchens($propertyId,$userId,$allAppointments[$i]->appointmentID);
			$toilets = $this->Api_model->toilets($propertyId,$userId,$allAppointments[$i]->appointmentID);
			$livingroom = $this->Api_model->livingroom($propertyId,$userId,$allAppointments[$i]->appointmentID);
			$propertyInfo = $this->Api_model->propertyInfo($propertyId);
			$alternativePhone = $this->Api_model->alternativePhone($propertyInfo[0]->userID);
			$userTypeforAdvertiserType = $this->Api_model->userTypeforAdvertiserType($propertyInfo[0]->userID);
			if($userTypeforAdvertiserType[0]->userTypeID==1){
                            $advertiserType = "Owner";
			}else if($userTypeforAdvertiserType[0]->userTypeID==4){
                            $advertiserType = "Broker";
			}else{
                            $advertiserType = "";
			}
			$details = $this->Api_model->getPropertyAttributes($propertyId,$userId,$allAppointments[$i]->appointmentID);							
			$finalArr[$i]['appointmentID']= $allAppointments[$i]->appointmentID;
			$finalArr[$i]['userID']= $allAppointments[$i]->userID;
			$finalArr[$i]['name']= $allAppointments[$i]->name;
			$finalArr[$i]['phone']= $allAppointments[$i]->phone;			
                        $finalArr[$i]["email"]= $allAppointments[$i]->email;
                        $finalArr[$i]["address"]= $propertyInfo[0]->propertyAddress1;
			$finalArr[$i]['address2'] = $propertyInfo[0]->propertyAddress2;
                        $finalArr[$i]["appointmentTime"]= $allAppointments[$i]->appointmentTime;
                //$finalArr[$i]["appointmentDate"] =  $allAppointments[$i]->appointmentDate;
			$finalArr[$i]["note"]= $allAppointments[$i]->note;
                        $finalArr[$i]["userType"]= $allAppointments[$i]->userType;
                        $finalArr[$i]["userTypeID"]= $allAppointments[$i]->userTypeID;
                        $finalArr[$i]["userExistsStatus"]= null;
                        $finalArr[$i]["propertyType"]=  $propertyInfo[0]->propertyTypeID;
                        $finalArr[$i]["propertyPurpose"]= $propertyInfo[0]->propertyPurpose;
                        $finalArr[$i]["property_current_status"]= $propertyInfo[0]->propertyCurrentStatus;
                        $finalArr[$i]["projectID"]= null;
                //$finalArr[$i]["price"]= $allAppointments[$i]->price;
                //$finalArr[$i]["negotiable"]= null;
                        $finalArr[$i]["appointmentStatus"]= $allAppointments[$i]->appointmentStatus;
                        $finalArr[$i]["stratTime"]= $allAppointments[$i]->stratTime;
                        $finalArr[$i]["endTime"]= $allAppointments[$i]->endTime;
                        
			$details['society_notes'] = $allAppointments[$i]->propertyNotes;	
			$details['appointmentID'] = $allAppointments[$i]->appointmentID;
			$details['userID'] = $allAppointments[$i]->userID;
			$details['propertyType'] = $propertyInfo[0]->propertyTypeID;
			$details['passessionTime'] = $propertyInfo[0]->possessionDate;
			$details['ap_availability_date'] = '0000-00-00';
			$details['preferredVisitTime'] = $allAppointments[$i]->appointmentTime;			
			$details['name'] = $allAppointments[$i]->name;
			$details['phone'] = $allAppointments[$i]->phone;
			$details['appointmentAlterPhone'] = $alternativePhone[0]->userAlternatePhone;
			$details['appointmentEmail'] = $allAppointments[$i]->email;	
			$details['pincode'] = $propertyInfo[0]->propertyZipCode;
			$details['rentNegotiable']  = ($propertyInfo[0]->isNegotiable=='Yes' ? 'Y':'N');
			$details['rentAmount']  = $propertyPrice[0]->propertyPrice;
			$details['advertiserType'] = $advertiserType;
			
                        $finalArr[$i]['details']=$details; 
			if($bedrooms){
                            $finalArr[$i]['bedrooms']=$bedrooms;
			}
			if($kitchens){
                            $finalArr[$i]['kitchens']=$kitchens;
			}
			if($toilets){
                            $finalArr[$i]['toilets']=$toilets;
			}
			if($livingroom){
                            $finalArr[$i]['livingroom']=$livingroom;
			}				
			$i++;	
                    }
//print_r($finalArr);die;
		$result	=   array(
                                'status' =>	'success',
                                'code' => '200',
                                'data' => array(
                                        'userID' =>	$userId,
                                        'appointments'=>$k,
                                        'appointment_list'	=> $finalArr
                                       )	
				);
			//echo json_encode( $result );
		}else{
                    $result = array(
				'status' => 'errot',
				'code' => '400',
				'data' =>array(
                                            'message' =>'error details.'
                                            )	
                                );
//echo json_encode( $result );
		}
		echo json_encode( $result );
	}
public function update(){
		$MobileData =$this->input->post('jsondata');		
		//$data=json_decode($MobileData);
		//print_r($data);
		$appStatus = json_decode($MobileData);
		if($appStatus->ap_status !='Deferred'){
		$data = $this->Api_model->UpdateProperties($MobileData);
		if($data){
		     $msg = array(
				'status'	=>	'success',
							'code'		=>	'200',
							'data'		=>	array(
													'message'	

												=>	'Appointment updated successfully.'
												)
						
						  );
               echo json_encode($msg);
	      }
	      else{
	      	$msg = array(
							'status'	=>	'error',
							'code'		=>	'400',
							'data'		=>	array(
													'message'	
	=>	'error details.'
												)
						
						);
                         echo json_encode($msg);
			}
		}else{
			$arr['appointmentStatus'] = 'Deferred';
			$this->db->set($arr);
			$this->db->where('appointmentID',$appStatus->ap_id);
			$this->db->update('rp_appointments');
			$msg = array(
							'status'	=>	'success',
							'code'		=>	'200',
							'data'		=>	array(
													'message'	

												=>	'Appointment Status updated successfully.'
												)
						
						  );
               echo json_encode($msg);
		}
	}
}
?>