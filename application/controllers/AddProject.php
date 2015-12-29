<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProject extends CI_Controller {

	 function __construct() {
		parent::__construct();
		$this->data['LanguageId']='1';
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('AddProject_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}

	}
	


		/*......................Add Project view Load Start......................*/
	function index($filter=false)
	{	//echo $filter;die;
		if(!empty($filter)) 
		{
			$ProjectFilterData=$this->data['ProjectFilterData']=$this->AddProject_model->GetProjectDataDetail($filter,$this->data['LanguageId']);// print_r($ProjectFilterData);die;
			
			$ProjectPaymentInfo=$this->data['ProjectPaymentInfo']=$this->AddProject_model->GetProjectPaymentDetail($filter,$this->data['LanguageId']);//print_r($ProjectFilterData);die;
			
			$ProjectImageInfo=$this->data['ProjectImageInfo']=$this->AddProject_model->GetProjectImageDetail($filter,$this->data['LanguageId']);//print_r($ProjectImageInfo);die;
			
			$ProjectVideoInfo=$this->data['ProjectVideoInfo']=$this->AddProject_model->GetProjectVideoDetail($filter,$this->data['LanguageId']);//print_r($ProjectImageInfo);die;
		}
		$UserType=$this->data['UserType']=$this->AddProject_model->GetMultipleData('rp_user_type_details',array('languageID'=>$this->data['LanguageId']));//print_r($UserType);die;$UserType
		$ProjectType=$this->data['ProjectType']=$this->AddProject_model->GetMultipleData('rp_property_types',array('typeName'=>'Project','propertyTypeStatus'=>'Active'));
		$this->data['propertytype']=$this->AddProject_model->getPropertyType();
		$this->parser->parse('header',$this->data);
		$this->load->view('addproject',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
		/*......................Add Project view Load End......................*/
	
	function UserTypeDetail()
	{
		$userids=$this->input->post('userid');
		$UserTypeId= $this->input->post('UserTypeId');//echo $UserTypeId;die;
		$UserId=$this->data['UserId']=$this->AddProject_model->GetMultipleData('rp_user_type_details',array('userTypeID'=>$UserTypeId,'languageID'=>$this->data['LanguageId'])); //print_r($UserId);die;
		$UserTypeName=$UserId[0]->userTypeName;
		$UserId=$this->data['UserId']=$this->AddProject_model->GetMultipleData('rp_user_to_type',array('userTypeID'=>$UserTypeId)); //print_r($UserId);
		?>
		<div class="form-group col-xs-12 col-sm-2 martop20">
		   <label class="control-label" for="last-name"><?=$UserTypeName?></label>
			 <select class="select2_group form-control" name="userID" onchange="UserPlane(this.value,this.id)">
			   <option value="0">Select</option>
			 <?php 
			 foreach ($UserId as $list)
			 {
				$UserDetail=$this->data['UserDetail']=$this->AddProject_model->GetMultipleData('rp_user_details',array('userID'=>$list->userID,'languageID'=>$this->data['LanguageId'])); //print_r($UserId);
			 foreach ($UserDetail as $list){ ?> 
				 <option value="<?php echo $list->userID; ?>" <?php if(!empty($userids) && $userids==$list->userID){ echo 'selected'; } ?> ><?php echo ucwords(str_replace('_', ' ', $list->userCompanyName)); ?>( <?php echo ucwords($list->userFirstName); ?>&nbsp;<?php echo ucwords($list->userLastName); ?> )</option>
			 <?php } }?>
		   </select>
		</div>
		<?php 
		
	}
	
	function UserPlaneDetail()
	{
		$UserId= $this->input->post('UserId');//echo $UserId;die;
		if(isset($UserId)&&!empty($UserId))
		{
		$PlaneId=$this->data['PlaneId']=$this->AddProject_model->GetUserplan($UserId);
		if(isset($PlaneId)&&!empty($PlaneId))
		{
		?>
			<div class="form-group col-xs-12 col-sm-2 martop20">
			   <label class="control-label" for="first-name">User Plane</label>
				 <select class="select2_group form-control" name="UserPlaneDetail" onchange="">
				   <option value="0">Select</option>
				 <?php 
				 foreach ($PlaneId as $list){ ?> 
					 <option value="<?php echo $list->planID; ?>"><?php  echo ucwords(str_replace('_', ' ', $list->planTitle)); ?></option>
				 <?php } ?>
			   </select>
			</div>
			<?php 
		}
		else
		{ ?>
			<div class="form-group col-xs-12 col-sm-2 martop20">
			   <label class="control-label" for="first-name">User Plane</label>
				 <select class="select2_group form-control" >
				   <option value="0">Select</option>
				   <option value="0">No Plane</option>
				</select>
			</div>		
		<?php 
		}
		}
		else
		{ ?>
			<div class="form-group col-xs-12 col-sm-2 martop20">
			   <label class="control-label" for="first-name">User Plane</label>
				 <select class="select2_group form-control" >
				   <option value="0">Select</option>
				   <option value="0">No Plane</option>
				</select>
			</div>		
		<?php 
		}	
	}
		
	function StatusDatePicker()
	{
		$StatusValue= $this->input->post('StatusValue');//echo $UserId;die;
		?>
			<div class="form-group col-xs-12 col-sm-3">
				<label class="control-label" for="last-name">Date</label>
				<div class="xdisplay_inputx form-group has-feedback">
					<input type="text" name="Date" class="form-control has-feedback-left" <?php if($StatusValue=='Redy To Move'){ ?> id="single_cal2" <?php  }?> placeholder="Select Date" aria-describedby="inputSuccess2Status2" <?php if($StatusValue!=='Redy To Move'){ ?> readonly <?php  }?>>
					<span class="fa fa-calendar-o form-control-feedback left" style="left:5px;" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> 
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function () {
					
					$('#single_cal2').daterangepicker({
						singleDatePicker: true,
						calender_style: "picker_2"
					}, function (start, end, label) {
						console.log(start.toISOString(), end.toISOString(), label);
					});
					 
				});
			</script> 
		<?php 
	}
	
	
	function ProjectType()
	{
		if(!empty($this->input->post('projectTypeId')))
		{
			$AttributesGroup=$this->AddProject_model->Getattributesgroups($this->input->post('projectTypeId'));
				
			if(!empty($AttributesGroup)){
	
				$atti=1;
				foreach($AttributesGroup as $AttributesGroups)
				{
					if($AttributesGroups->name=='Project Specification')
					{
					?>
					<div class="panel"> <a class="panel-heading" role="tab" id="headingOneA<?=$atti?>" data-toggle="collapse" data-parent="#accordionA<?=$atti?>" href="#collapseOneA<?=$atti?>" aria-expanded="false" aria-controls="collapseOneA<?=$atti?>">
					<h4 class="panel-title StepTitle"><?=$AttributesGroups->name?></h4>
					</a>
					<div id="collapseOneA<?=$atti?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body black-filed">
					<?php
					$Attribute=$this->AddProject_model->GetAttributes($AttributesGroups->attributeGroupID);
					if(!empty($Attribute))
					{
						foreach($Attribute as $Attributes)
						{
							if($Attributes->attrName!=='Amenities')
							{
								$Attributeoption=$this->AddProject_model->GetAttributesoption($Attributes->attributeID);
								if($Attributes->attrInputType=="select"){
								?>
									<div class="form-group col-xs-12 col-sm-4 martop20">
									<label class="control-label" for="last-name"><?=$Attributes->attrName?> </label>
									<?php if($Attributes->attrName=="Bed Rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}?>
									<select class="form-control"<?php echo $call; echo $id;?> >
									<optgroup label="Select">
									<option value="">select</option>
									<?php foreach($Attributeoption as $Attributeoptions){ ?>
										<option value="$Attributeoptions->attrOptionID"><?=$Attributeoptions->attrOptName;?></option>
									<?php } ?>
									</optgroup>
									</select>
									</div>
								
							<?php 	}	
								if($Attributes->attrInputType=="texbox"){ ?>
									<div class="form-group col-xs-12 col-sm-4 ">
									<label class="control-label" for="last-name"><?=$Attributes->attrName;?> </label>
									<input id="middle-name" class="form-control" type="text" name="middle-name">
									</div>
								<?php }
	
								if($Attributes->attrInputType=="multiselect"){ ?>
									<div class="form-group col-xs-12 col-sm-4">
									<label class="control-label" for="last-name" style="display:block;"><?=$Attributes->attrName?></label>
									<?php foreach($Attributeoption as $Attributeoptions){ ?>
											
										<span class="checkbozsty">
										<input type="checkbox"  value="$Attributeoptions->attrOptionID" name="multiselect_Amenities_Security_6">
										<?=$Attributeoptions->attrOptName?></span>
									<?php } ?>
									</div>
									<?php 
								}
							}
							else
							{ 
							
							}
						}
					}
						
				} 
				else
				{
					?>
					<div class="panel">
					<h4 class="panel-title StepTitle"><?=$AttributesGroups->name?></h4>
					<div id="collapseOneA<?=$atti?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body black-filed">
					<?php
					$Attribute=$this->AddProject_model->GetAttributes($AttributesGroups->attributeGroupID);
					if(!empty($Attribute))
					{
						foreach($Attribute as $Attributes)
						{
							if($Attributes->attrName!=='Amenities')
							{
								$Attributeoption=$this->AddProject_model->GetAttributesoption($Attributes->attributeID);
								if($Attributes->attrInputType=="select"){
								?>
									<div class="form-group col-xs-12 col-sm-4 martop20">
									<label class="control-label" for="last-name"><?=$Attributes->attrName?> </label>
									<?php if($Attributes->attrName=="Bed Rooms"){ $call="onchange='generatenameproperty();'"; $id="id='bedroom'";}else{$call=''; $id='';}?>
									<select class="form-control"<?php echo $call; echo $id;?> >
									<optgroup label="Select">
									<option value="">select</option>
									<?php foreach($Attributeoption as $Attributeoptions){ ?>
										<option value="$Attributeoptions->attrOptionID"><?=$Attributeoptions->attrOptName;?></option>
									<?php } ?>
									</optgroup>
									</select>
									</div>
								
							<?php 	}	
								if($Attributes->attrInputType=="texbox"){ ?>
									<div class="form-group col-xs-12 col-sm-4 ">
									<label class="control-label" for="last-name"><?=$Attributes->attrName;?> </label>
									<input id="middle-name" class="form-control" type="text" name="middle-name">
									</div>
								<?php }
	
								if($Attributes->attrInputType=="multiselect"){ ?>
									<div class="form-group col-xs-12 col-sm-4">
									<label class="control-label" for="last-name" style="display:block;"><?=$Attributes->attrName?></label>
									<?php foreach($Attributeoption as $Attributeoptions){ ?>
											
										<span class="checkbozsty">
										<input type="checkbox"  value="$Attributeoptions->attrOptionID" name="multiselect_Amenities_Security_6">
										<?=$Attributeoptions->attrOptName?></span>
									<?php } ?>
									</div>
									<?php 
								}
							}
							else
							{ 
							
							}
						}
					}?>
				</div>
					</div>
					</div>
				<?php 
				}
				$atti++;
				}
	
			}else{
				echo"List Is Empty!!";
			}
		}else{
			echo"Project Is Not Found!!";
		}
	
	}

	
	function InsertProject($formid=false)
	{
		$data=$_POST;
		//print_r($data);die;
		$date=date("Y-m-d");
		if(!empty($data))
		{
			$data1=array();
			$data2=array();
			foreach($data as $key=> $datas)
			{
				if($key=="userID")
				{
					$data1['userID']=$datas;
				}
	
				if($key=="projectTypeID")
				{
					$data1['projectTypeID']= $datas;
				}
	
				if($key=="lat")
				{
					$data1['projectLatitude']= $datas;
				}
	
				if($key=="lng")
				{
					$data1['projectLongitude']= $datas;
				}
	
	
				if($key=="postal_code")
				{
					$data1['projectZipCode']= $datas;
				}
				
				
				/* ................. Project Details Table Data .................... */
				if($key=="projectName")
				{
					$data2['projectName']= $datas;
				}
				
				if($key=="projectDescription")
				{
					$data2['projectDescription']= $datas;
				}
				
				if($key=="projectCurrentStatus")
				{
					$data2['projectCurrentStatus']= $datas;
				}
				
				if($key=="projectAddress1")
				{
					$data2['projectAddress1']= $datas;
				}
	
				if($key=="sublocality")
				{
					$data2['projectAddress2']= $datas;
				}
	
				if($key=="projectMetaTitle")
				{
					$data2['projectMetaTitle']= $datas;
				}
				
				if($key=="projectMetaKeyword")
				{
					$data2['projectMetaKeyword']= $datas;
				}
				
				if($key=="projectMetaDescription")
				{
					$data2['projectMetaDescription']= $datas;
				}
				
				if($key=="projectOgTitle")
				{
					$data2['projectOgTitle']= $datas;
				}
				
				if($key=="projectOgDescription")
				{
					$data2['projectOgDescription']= $datas;
				}
			}	
			if(!empty($data['projectID']))
			{
				$data1['projectAddedDate']= $date;
				$this->AddProject_model->InsertProject('rp_projects',$data1,array('projectID'=>$data['projectID']));
				$data2['languageID']= $this->data['LanguageId'];
				$this->AddProject_model->InsertProject('rp_project_details',$data2,array('projectID'=>$data['projectID']));
				/************ Payment Information Insert ****************/
				if($data['paymentInfoLable'])
				{
					$delete=$this->AddProject_model->DeleteSingleData('rp_project_payment_info',array('projectID'=>$data['projectID']));
					if($delete)
					{
						for($i=0;$i<count($data['paymentInfoLable']);$i++)
						{
							$paymentLable=array(
											'projectID'=>$data['projectID'],
											'paymentInfoLabel'=>$data['paymentInfoLable'][$i],
											'paymentInfoValue'=>$data['paymentInfoValue'][$i],
											'languageID'=>$this->data['LanguageId'],
										  );
							$paymentID=$this->AddProject_model->InsertProject('rp_project_payment_info',$paymentLable);
						}
					}
				}
			}
			else
			{
				$projectKey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
				$data1['projectKey']= $projectKey;
				$data1['projectAddedDate']= $date;
				$projectID=$this->AddProject_model->InsertProject('rp_projects',$data1);
				//echo $projectID;//die;
				$data2['projectID']= $projectID;// $data2['projectID'];die;
				$data2['languageID']= $this->data['LanguageId'];
				$this->AddProject_model->InsertProject('rp_project_details',$data2);
				/************ Payment Information Insert ****************/
				for($i=0;$i<count($data['paymentInfoLable']);$i++)
				{
					$paymentLable=array(
									'projectID'=>$projectID,
									'paymentInfoLabel'=>$data['paymentInfoLable'][$i],
									'paymentInfoValue'=>$data['paymentInfoValue'][$i],
									'languageID'=>$this->data['LanguageId'],
								  );
					$paymentID=$this->AddProject_model->InsertProject('rp_project_payment_info',$paymentLable);
				}
			}
			if(!empty($projectID)){ echo $projectID; } else{ if(!empty($data['projectID'])){ echo $data['projectID']; }}
		}else{
			echo"Add Project Fail!!";
		}
	
	}
	
		
	public function uploadimage()
	{
		$projectID=$this->input->post('projectID');//echo $projectID;
		$Elevationimagecategory=$this->input->post('ElevationImageCategory');
		$ThreeSixtyImageCategory=$this->input->post('ThreeSixtyImageCategory');
		$imagecategory=$this->input->post('imagecategory');
		$MasterImage=$this->input->post('MasterImage');
		if(!empty($projectID))
		{
			
			if($_FILES['file']['name']!='')
			{
				$data['image_z1']= $_FILES['file']['name'];
				$image=sha1($_FILES['file']['name']).time().rand(0, 9);
				
					if(!empty($_FILES['file']['name']))
					{
				
						$config =  array(
						'upload_path'	  => './projectImages/',
						'file_name'       => $image,
						'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
						'overwrite'       => true);
						
							$this->upload->initialize($config);
							$this->load->library('upload');
							if($this->upload->do_upload("file"))
								{
									$upload_data = $this->upload->data();
									$image=$upload_data['file_name'];
									/* project Elevation view image insert */
									if(!empty($Elevationimagecategory))
									{
										$projectElevationImage=array('projectID'=>$projectID,'projectElevationImage'=>$image);
										$projectElevationImage=$this->AddProject_model->InsertProject('rp_projects',$projectElevationImage,array('projectID'=>$projectID));
									}
									/* project 360 view image insert */
									if(!empty($ThreeSixtyImageCategory))
									{
										$projectThreeSixtyImage=array('projectID'=>$projectID,'projectThreeSixtyImage'=>$image);
										$projectThreeSixtyImage=$this->AddProject_model->InsertProject('rp_projects',$projectThreeSixtyImage,array('projectID'=>$projectID));
									}
									/* project image insert */
									if($imagecategory==3 || $imagecategory==4 || $imagecategory==5)
									{
										$checkPropertyID=$this->AddProject_model->GetSingleData('rp_project_images',array('projectID'=>$projectID,'imageCatID'=>$imagecategory));
										if(count($checkPropertyID)>0)
										{
											$projectImage=array('projectImageName'=>$image);
											$propertyImageID=$this->AddProject_model->InsertProject('rp_project_images',$projectImage,array('projectID'=>$projectID,'imageCatID'=>$imagecategory));
											/* project Image Details insert
											$projectImageDetails=array('languageID'=>$this->data['LanguageId'],'projectImageTitle'=>'','projectImageAltTag'=>'');
											$this->AddProject_model->InsertProject('rp_project_image_details',$projectImageDetails,array('projectID'=>$projectID);*/
										}
										else
										{
											$projectImage=array('projectID'=>$projectID,'imageCatID'=>$imagecategory,'projectImageName'=>$image,'isCoverImage'=>'No','projectImagePriority'=>'1','projectImageStatus'=>'Active');
											$propertyImageID=$this->AddProject_model->InsertProject('rp_project_images',$projectImage);
											/* project Image Details insert */
											$projectImageDetails=array('projectImageID'=>$propertyImageID,'languageID'=>$this->data['LanguageId'],'projectImageTitle'=>'','projectImageAltTag'=>'');
											$this->AddProject_model->InsertProject('rp_project_image_details',$projectImageDetails);
										}
									}
								}else
								{
										echo $this->upload->display_errors()."file upload failed";
								}
					}
			}
		}
	}	
	
	public function uploadvideo()
	{
		$projectID=$this->input->post('projectID');//echo $projectID;
		$videocategory=$this->input->post('videocategory');//echo $imagecategory;  echo $projectID;die;//alert($this->input->post('imagecategory'));die;echo $propertyID;echo $imagecategory;die;
		if(!empty($projectID) && !empty($videocategory))
		{
			
			if($_FILES['file']['name']!='')
			{
				$data['image_z1']= $_FILES['file']['name'];
				$video=sha1($_FILES['file']['name']).time().rand(0, 9);
				
					if(!empty($_FILES['file']['name']))
					{
				
						$config =  array(
						'upload_path'	  => './projectVideos/',
						'file_name'       => $video,
						'allowed_types'   => "avi|mov|mp4|flv|mkv|vlc|wmv",
						'overwrite'       => true);
						
							$this->upload->initialize($config);
							$this->load->library('upload');
							if($this->upload->do_upload("file"))
								{
									$upload_data = $this->upload->data();
									$video=$upload_data['file_name'];
									
									/* project video insert */
									$projectVideo=array('projectID'=>$projectID,'projectVideo'=>$video,'projectVideoPriority'=>'1','projectVideoStatus'=>'Active');
									$propertyVideoID=$this->AddProject_model->InsertProject('rp_project_videos',$projectVideo);
									/* project video Details insert */
									$projectVideoDetails=array('projectVideoID'=>$propertyVideoID,'languageID'=>$this->data['LanguageId'],'projectVideoTitle'=>'','projectVideoDesc'=>'');
									$this->AddProject_model->InsertProject('rp_project_video_details',$projectVideoDetails);
								}else
								{
										echo $this->upload->display_errors()."file upload failed";
								}
					}
			}
		}
	}
	
	/*function InsertPropertyDetail($formid=false)
	{
		$data=$_POST;
	print_r($data);die;
		$date=date("Y-m-d");
		/*$formid=$this->input->post('formid');
			$formname="form-";
			$formname.=$formid;
		
	
		if(!empty($data))
		{
	
			/*if($formname="form-1")
			 {
			$data1=array();
			$data2=array();
			foreach($data as $key=> $datas)
			{
				if($key=="userID")
				{
					$data1['userID']=$datas;
				}
	
				if($key=="propertyTypeID")
				{
					$data1['propertyTypeID']= $datas;
				}
	
				if($key=="lat")
				{
					$data1['projectLatitude']= $datas;
				}
	
				if($key=="lng")
				{
					$data1['projectLongitude']= $datas;
				}
	
	
				if($key=="postal_code")
				{
					$data1['projectZipCode']= $datas;
				}
				
				
				//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				if($key=="projectName")
				{
					$data2['projectName']= $datas;
				}
				
				if($key=="projectDescription")
				{
					$data2['projectDescription']= $datas;
				}
				
				if($key=="projectCurrentStatus")
				{
					$data2['projectCurrentStatus']= $datas;
				}
				
				if($key=="projectAddress1")
				{
					$data2['projectAddress1']= $datas;
				}
	
				if($key=="sublocality")
				{
					$data2['projectAddress2']= $datas;
				}
	
				if($key=="projectMetaTitle")
				{
					$data2['projectMetaTitle']= $datas;
				}
				
				if($key=="projectMetaKeyword")
				{
					$data2['projectMetaKeyword']= $datas;
				}
				
				if($key=="projectMetaDescription")
				{
					$data2['projectMetaDescription']= $datas;
				}
				
				if($key=="projectOgTitle")
				{
					$data2['projectOgTitle']= $datas;
				}
				
				if($key=="projectOgDescription")
				{
					$data2['projectOgDescription']= $datas;
				}
			}
			$projectKey=strtoupper(bin2hex(mcrypt_create_iv(4, MCRYPT_DEV_RANDOM)));
			$data1['projectKey']= $projectKey;
			$data1['projectAddedDate']= $date;
			//print_r($data1);die;
			$ProjectID=$this->AddProject_model->InsertProject('rp_projects',$data1);
			$data2['projectID']= $ProjectID;
			$data2['languageID']= $this->data['LanguageId'];
			//print_r($data2);die;
			$this->AddProject_model->InsertProject('rp_project_details',$data2);
			//}
			if(!empty($ProjectID)){ echo $ProjectID;	}else{ if(!empty($data['ProjectID'])){ echo $data['ProjectID']; }}
				
		}else{
			//echo"Add Project Fail!!";
			if(!empty($ProjectID)){ echo $ProjectID;	}else{ if(!empty($data['ProjectID'])){ echo $data['ProjectID']; }}
		}
	
	}*/
	
	function ProjectList($ProjectList=false)
	{	
		if(!empty($this->input->post('userTypeName')))
		{
			$filter1=$this->input->post('userTypeName');
			$filter2=$this->input->post('userAccount');
			$ProjectList=$this->data['ProjectList']=$this->AddProject_model->GetProjectFilterDataList($filter1,$filter2);//print_r($ProjectList);die;
		}
		else
		{
			$ProjectList=$this->data['ProjectList']=$this->AddProject_model->GetProjectList();//print_r($ProjectList);die;
		}
		$this->parser->parse('header',$this->data);
		$this->load->view('ProjectList',$this->data);
		$this->parser->parse('footer',$this->data);
	}
	
	function ProjectFilterDataList()
	{	
		
		if($ProjectList)
		{
			redirect('AddProject/ProjectList/'.$ProjectList);
		}
	}
	
}
