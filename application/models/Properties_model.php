<?php
class Properties_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		
		/*$dsn1 = 'mysql://homeadmin:Ht5@nhomeadmin@localhost/homeadmin';
		$this->db1= $this->load->database($dsn1, true); */
		

	}

	public function getPropertyType(){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2','t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeStatus = "active"
AND t1.languageID =1','inner');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	public function IndividualUserList(){
		$this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
		$this->db->from('rp_property_type_details t1');
		$this->db->join('rp_property_types t2','t1.propertyTypeID = t2.propertyTypeID AND T2.propertyTypeParentID=1 AND t2.propertyTypeStatus = "Active"
AND t1.languageID =1','inner');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	public function getPropertyName($propertyID=null){
		//$propertyID = 142;
		$this->db->select('t1.*,t2.*,t4.propertyTypeKey');
		$this->db->from('rp_property_details t1');
		$this->db->join('rp_properties t2','t1.propertyID=t2.propertyID AND t2.propertyStatus="Draft" AND t2.propertyID="'.$propertyID.'" AND t1.languageID=1','inner');
		$this->db->join('rp_property_type_details t3','t2.propertyTypeID=t3.propertyTypeID AND t3.languageID=1','inner');
		$this->db->join('rp_property_types t4','t4.propertyTypeID=t3.propertyTypeID AND t3.languageID=1','inner');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();

	}

	public function getUserType($userID=null){
		if($userID!=null)
		{
			$this->db->select('distinct(t1.userTypeName),t3.userTypeID');
			$this->db->from('rp_user_type_details t1');
			$this->db->join('rp_users t2','t2.userTypeID=t1.userTypeID AND userID="'.$userID.'" AND t1.languageID=1','inner');
			$this->db->join('rp_user_types t3','t3.userTypeID=t1.userTypeID AND t3.userTypeStatus="Active"','inner');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}

	public function getUser($userID=null,$userTypeID=null){
		if($userTypeID!=null){
			$this->db->select('t2.userID,t1.userFirstName,t1.userLastName,t2.userEmail');
			$this->db->from('rp_user_details t1');
			$this->db->join('rp_users t2','t1.userID=t2.userID AND t1.languageID=1 AND t2.userID="'.$userID.'" AND t2.userTypeID="'.$userTypeID.'"','inner');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}

	}

	public function getPropertyPrice($propertyID=null){
		if($propertyID!=null){
			$this->db->select('propertyPrice');
			$this->db->from('rp_property_price');
			$this->db->where('propertyID="'.$propertyID.'" AND currencyID=3');
			$query =$this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}

	}
	/*********************************************All Projects ************************************************************/
	public function getAllProjects(){
		$this->db->select('t1.projectID,t1.projectName,t2.projectStatus');
		$this->db->from('rp_project_details t1');
		$this->db->join('rp_projects t2','t2.projectID=t1.projectID AND t2.projectStatus="active" AND t1.languageID=1','inner');
		$query =$this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}

	public function getPropertyAttributes($propertyTypeID=null,$propertyID=null){
		//echo "<li>ttttttt--->".$propertyID;echo "<li>=======>".$propertyTypeID;
		if($propertyTypeID != null && $propertyID !=null ){
			
			$allAttributeInfo = array();
			$this->db->select('distinct (t1.attributeGroupID),t1.propertyTypeID,t2.name');
			$this->db->from('rp_attribute_group t1');
			$this->db->join('rp_attribute_group_details t2','t2.attributeGroupID=t1.attributeGroupID AND t1.propertyTypeID="'.$propertyTypeID.'"','inner');
			$this->db->join('rp_attribute_to_group t3','t3.attributeGroupID=t1.attributeGroupID AND t2.languageID=1','inner');
			$query = $this->db->get();
			//echo "<li>1=>".$this->db->last_query();
			$firstResult = $query->result();
			//echo "<pre>1=";print_r($firstResult);echo "</pre>";
			foreach ($firstResult as $key => $value) {
				$allAttributeInfo['final'][$value->attributeGroupID][] = $value->attributeGroupID;
				$allAttributeInfo['final'][$value->attributeGroupID][] = $value->name;

				$this->db->select('t2.attributeID,t2.attrInputType,t3.attrName');
				$this->db->from('rp_attribute_to_group t1');
				$this->db->join('rp_attributes t2','t1.attributeID=t2.attributeID','inner');
				$this->db->join('rp_attribute_details t3','t3.attributeID=t2.attributeID AND t3.languageID=1 AND t2.attrStatus="A" AND t1.attributeGroupID="'.$value->attributeGroupID.'"','inner');
				$query = $this->db->get();
				//echo "<li>2=>".$this->db->last_query();
				$secondResult = $query->result();
				//echo "<pre>2=";print_r($secondResult);echo "</pre>";

				foreach ($secondResult as $key1 => $value1) {
					$arr_attr_data = array();
					$arr_attr_data = (array) $value1;

					$this->db->select('distinct(t1.attrValueID), t1.*,t4.attrName,t2.attrDetValue,t3.attrInputType');
					$this->db->from('rp_property_attribute_values t1');
					$this->db->join('rp_property_attribute_value_details t2','t2.attrValueID=t1.attrValueID','inner');
					$this->db->join('rp_attributes t3','t3.attributeID =t1.attributeID','inner');
					$this->db->join('rp_attribute_details t4','t4.attributeID = t3.attributeID AND t1.propertyID="'.$propertyID.'" AND t4.languageID=1 AND t1.attributeID="'.$value1->attributeID.'"','inner');
					$query = $this->db->get();
					//echo "<li>3=>".$this->db->last_query();
					$thirdResult = $query->result();

					// Get the property current value
					$current_field_value = array();

					foreach($thirdResult as $key2 => $value2){						
						$current_field_value[$value2->attrOptionID] = $value2->attrDetValue;
					}

					$arr_attr_data['current_value'] = $current_field_value;
					// Get the attribute option value
					$allOption_field_value = array();

					$this->db->select('t2.attrOptionID,t2.attrOptName');
					$this->db->from('rp_attribute_options t1');
					$this->db->join('rp_attribute_option_details t2','t2.attrOptionID=t1.attrOptionID AND attributeID="'.$value1->attributeID.'" AND t2.languageID=1','inner');
					$query = $this->db->get();

					 //echo "<li>4=>".$this->db->last_query();

					$optionResults = $query->result();

					foreach($optionResults as $key2 => $value2){						
						$allOption_field_value[$value2->attrOptionID] = $value2->attrOptName;

					}

					$arr_attr_data['options'] = $allOption_field_value;
					$allAttributeInfo['final'][$value->attributeGroupID]['attr'][] = $arr_attr_data;

				}
			}

			/*$this->db->select('propertyDescription');
			$this->db->from('rp_property_details');
			$this->db->where('propertyID="'.$propertyID.'" AND languageID=1');
			$query= $this->db->get();
			$propertyDescription = $query->result();
			$allAttributeInfo['final']['description'][] = $propertyDescription;*/
			//print_r($propertyDescription);
			return $allAttributeInfo;
		}

	}
	/**********************For cityLocID*************************************/
	
	public function saveLocation($arr = array()){
		//echo "<pre>";print_r($arr);echo "</pre>";
		$propertyID = $arr['propertyid'];// => 502
		$geocomplete = $arr['geocomplete']; //=> DB Mall Square, Maharana Pratap Nagar, Bhopal, Madhya Pradesh, India
		$sublocality = $arr['sublocality'];// => Maharana Pratap Nagar
		$country = $arr['country'];// => India
		$administrative_area_level_1 = $arr['administrative_area_level_1'];// => Madhya Pradesh
		$locality = $arr['locality'];// => Bhopal
		$postal_code = $arr['postal_code'];// => 
		$lat = $arr['lat'];// => 23.2337128
		$lng = $arr['lng'];// => 77.43014519999997
		
		$removeSpace = str_replace(' ','_',$sublocality);
		$removeSpaceLowercase = strtolower($removeSpace);
		$this->db->select("t1.*");
		$this->db->from('rp_city_locations t1');
		$this->db->where('t1.cityLocUrlKey like "%'.$removeSpaceLowercase.'%"');
		$query = $this->db->get();
		$queryResult = $query->result();
		//echo "<pre>"; print_r($queryResult);
		$row = $this->db->affected_rows();
		if($row){
			$data = array();
			$data['cityLocID'] = $queryResult[0]->cityLocID;
			
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_properties');
			//$this->db->last_query();
		}else{
			
			$this->db->select('t1.*');
			$this->db->from('rp_city_details t1');
			$this->db->where('cityName="'.$locality.'"');
			$query = $this->db->get();
			$queryResult = $query->result();
			//echo "<pre>";print_r($queryResult);
			$row = $this->db->affected_rows();
			/**************This is for city*********************/
			if($row<=0){
				$data = array();
				$data['countryID'] = 99;
				$data['stateID'] = 0;
				$data['parentcityID'] = 0;
				$data['timeZoneID'] = 0;
				$data['cityKeyID'] = strtolower($locality);
				$data['cityProximity'] = 'City';
				$data['cityLat'] = $lat;
				$data['cityLng'] = $lng;
				$data['citylogoImage'] = '';
				$data['citybgImage'] = '';
				$data['cityStatus'] = 'Active';
				$data['cityCampaignListID'] = '';
				$data['googleCityName'] = $locality;
				$data['isDefault'] = 'No';			
				$this->db->insert('rp_cities',$data);
				$lastInsertedcityID = $this->db->insert_id();// city id
				
				$data1 = array();
				$data1['cityID'] = $lastInsertedcityID;
				$data1['languageID'] = 1;
				$data1['cityName'] = $locality;
				$data1['province'] = '';
				$this->db->insert('rp_city_details',$data1);
				$lastInsertedcityDetailsID = $this->db->insert_id();// city details id
			}else{
				$lastInsertedcityID = $queryResult[0]->cityID;
			}
			
			/**************End is for city*********************/
			/**************This is for state*********************/
				$this->db->select('t1.*');
				$this->db->from('rp_states t1');
				$this->db->where('googleStateName="'.$administrative_area_level_1.'"');
				$query = $this->db->get();
				$queryResult = $query->result();
				$row = $this->db->affected_rows();
				if($row<=0){
				$data = array();
				
				$data['countryID'] = 99;
				$data['stateShortName'] = '';
				$data['stateStatus'] = 'Active';
				$removeSpacestateUrlKey = str_replace(' ','_',$administrative_area_level_1);
				$data['stateUrlKey'] = strtolower($removeSpacestateUrlKey);
				$data['googleStateName'] = strtolower($administrative_area_level_1);
						
				$this->db->insert('rp_states',$data);
				$lastInsertedIDState = $this->db->insert_id();// State id
				
				/********************update city table**************************/
				$citydata = array();
				$citydata['stateID'] = $lastInsertedIDState;
				$this->db->set($citydata);
				$this->db->where('cityID', $lastInsertedcityID);
				$this->db->update('rp_cities');
				
				/********************end update city table**************************/
				
				$data1 = array();
				$data1['stateID'] = $lastInsertedIDState;
				$data1['languageID'] = 1;
				$data1['stateName'] = $locality;
				
				$this->db->insert('rp_state_details',$data1);
				$lastInsertedIDstatedetails = $this->db->insert_id();// state details id
			}
			
			/**************End for state*********************/
			
			/******************Insert city Location *************/
			$locdata = array();
			$locdata['cityID'] = $lastInsertedcityID;
			$removeSpacescityLocUrlKey = str_replace(' ','_',$sublocality);
			$locdata['cityLocUrlKey'] = strtolower($removeSpacescityLocUrlKey);
			$locdata['cityLocLat'] = $lat;
			$locdata['cityLocLng'] = $lng;
			$locdata['cityLocStatus'] = 'Active';
			$locdata['googleLocName'] = $sublocality;
			
			$this->db->insert('rp_city_locations',$locdata);
			$lastInsertedcityLocID = $this->db->insert_id();// cityLocID
			
			$locdata = array();
			$locdata['cityLocID'] = $lastInsertedcityLocID;
			$locdata['cityLocName'] = $sublocality;
			$locdata['cityLocTips'] = $sublocality;
			$locdata['languageID'] = 1;
			
			$this->db->insert('rp_city_location_details',$locdata);
			$lastInsertedcityLocDetailID = $this->db->insert_id();// cityLocID
			/******************Insert city Location *************/
			
			$data = array();
			$data['cityLocID'] = $lastInsertedcityLocID;
			
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_properties');
		} 
	}
	
	/***********************End For cityLocID*********************************/
	public function saveUpperPropertyValue($expfeildName,$feildValue,$propertyID){
		
		if($expfeildName=='locality'){
			$this->db->select("t1.*");
			$this->db->from('rp_cities t1');
			$this->db->join('rp_city_details t2','t2.cityID=t1.cityID AND t2.cityName="'.$feildValue.'" AND languageID=1','inner');
			//$this->db->where('');
			$query = $this->db->get();
			$queryResult = $query->result();
			$row = $this->db->affected_rows();
			if($row){
				$data = array();
				$data['cityID'] = $queryResult[0]->cityID;
				$data['countryID'] = $queryResult[0]->countryID;
				$data['stateID'] = $queryResult[0]->stateID;
				$data['propertyLatitude'] = $queryResult[0]->cityLat;
				$data['propertyLongitude'] = $queryResult[0]->cityLng;
				//$data['propertyZipCode'] = $queryResult[0]->propertyZipCode;
				//echo "<pre>";print_r($queryResult);
				$this->db->set($data);
				$this->db->where('propertyID', $propertyID);
				$this->db->update('rp_properties');
			}else{
				$this->db->select("propertyID");
				$this->db->from('rp_property_new_location');
				$this->db->where('propertyID="'.$propertyID.'"');
				$query = $this->db->get();
				$queryResult = $query->result();
				$row = $this->db->affected_rows();
				if($row){
					$data = array();
					$data['city'] = $feildValue;
					$this->db->set($data);
					$this->db->where('propertyID', $propertyID);
					$this->db->update('rp_property_new_location');
				}else{
					$data = array();
					$data['city'] = $feildValue;
					$data['propertyID'] = $propertyID;
					$this->db->insert('rp_property_new_location',$data);
				}
			}		

		}else if($expfeildName=='geocomplete'){
			$data = array();
			$data['fullAddress'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}else if($expfeildName=='sublocality'){
			$data = array();
			$data['locality'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}else if($expfeildName=='country'){
			$data = array();
			$data['country'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}else if($expfeildName=='postal'){
			$data = array();
			$data['zipcode'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}else if($expfeildName=='lat'){
			$data = array();
			$data['lat'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}else if($expfeildName=='lng'){
			$data = array();
			$data['lng'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}
		else if($expfeildName=='administrative_area_level_1'){
			$data = array();
			$data['state'] = $feildValue;
			$data['propertyID'] = $propertyID;
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_new_location');
		}
		else if($expfeildName=='propertyname'){
			$data = array();
			$data['propertyName'] = $feildValue;

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_details');
		}else if($expfeildName=='currentstatus'){
			$data = array();
			$data['propertyCurrentStatus'] = $feildValue;

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_property_details');
		}else if($expfeildName=='currency'){
			$data = array();
			$data['propertyPrice'] = $feildValue;

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->where('currencyID', 3);
			$this->db->update('rp_property_price');
		}else if($expfeildName=='negotiable' && $feildValue=='on'){
			$data = array();
			$data['isNegotiable'] = 'Yes';

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_properties');
		}else if($expfeildName=='descriptionan'){
			$data = array();
			$data['propertyDescription'] = $feildValue;

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->where('languageID', 1);
			$this->db->update('rp_property_details');
		}else if($expfeildName=='purpose'){
			$data = array();
			$data['propertyPurpose'] = $feildValue;

			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->update('rp_properties');
		}



	}
	public function saveAmenities($propertyID,$attributeIDs,$string1,$string2){
		$data = array();
		$this->db->select('t1.*');
		$this->db->from('rp_property_attribute_values t1');
		$this->db->where('propertyID', $propertyID);
		$this->db->where('attributeID', $attributeIDs);
		$query = $this->db->get();

		$queryResult = $query->result();
		$row = $this->db->affected_rows();
		if($row){
			$data['attrOptionID'] = $string1;
				
			$this->db->set($data);
			$this->db->where('propertyID', $propertyID);
			$this->db->where('attributeID', $attributeIDs);
			$this->db->update('rp_property_attribute_values');

			$this->db->select('t1.attrValueID');
			$this->db->from('rp_property_attribute_values t1');
			$this->db->where('t1.propertyID="'.$propertyID.'" AND t1.attributeID="'.$attributeIDs.'"');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			//echo "<pre>";print_r($result);echo "</pre>";
			$attrValueID = $result[0]->attrValueID;

			$data = array();
			$data['attrDetValue'] = $string2;
				
			$this->db->set($data);
			$this->db->where('attrValueID', $attrValueID);
			$this->db->update('rp_property_attribute_value_details');
		//echo "<li>".$this->db->last_query();
		}else{
			$data['attrOptionID'] = $string1;
			$data['propertyID'] = $propertyID;
			$data['attributeID'] = $attributeIDs;
			$this->db->insert('rp_property_attribute_values',$data);
			$lastInsertedID = $this->db->insert_id();

			$data1 = array();
			$data1['attrValueID'] = $lastInsertedID;
			$data1['languageID'] = 1;
			$data1['attrDetValue'] = $string2;
			$this->db->insert('rp_property_attribute_value_details',$data1);
		}
		return true;

	}

	public function saveEditPropertyFeilds($feildType,$feildvalue,$attributeIDs,$propertyID){
		/* echo "<li>====> ".$feildType;
		echo "<li>====> ".$feildvalue;
		echo "<li>====> ".$attributeIDs;
		echo "<li>====> ".$propertyID; */
		$checkResult = $this->checkAttrintoTable($propertyID,$attributeIDs);

		if($checkResult<1){
		//insert
			if($feildType=='textbox' && $feildvalue!=''){
				$attrOptionId = 0;
				$data = array();
				$data['propertyID'] = $propertyID;
				$data['attributeID'] = $attributeIDs;
				$data['attrOptionID'] = $attrOptionId;
				$this->db->insert('rp_property_attribute_values',$data);
				$lastInsertedID = $this->db->insert_id();
				$data1 = array();
				$data1['attrValueID'] = $lastInsertedID;
				$data1['languageID'] = 1;
				$data1['attrDetValue'] = $feildvalue;
				$this->db->insert('rp_property_attribute_value_details',$data1);

				}else if($feildType=='select' && $feildvalue!='0'){
					$this->db->select('t1.attrOptName');
					$this->db->from('rp_attribute_option_details t1');
					$this->db->where('t1.attrOptionID="'.$feildvalue.'" AND t1.languageID=1');
					$query = $this->db->get();
					$attrvalueName = $query->result();
					
					$data = array();
					$data['propertyID'] = $propertyID;
					$data['attributeID'] = $attributeIDs;
					$data['attrOptionID'] = $feildvalue;
					$this->db->insert('rp_property_attribute_values',$data);
					//echo $this->db->last_query();
					$lastInsertedID = $this->db->insert_id();
					$data1 = array();
					$data1['attrValueID'] = $lastInsertedID;
					$data1['languageID'] = 1;
					$data1['attrDetValue'] = $attrvalueName[0]->attrOptName;
					$this->db->insert('rp_property_attribute_value_details',$data1);
					//echo $this->db->last_query();
					
				}else if($feildType=='multiselect' && $feildvalue!=0 && $attributeIDs!=6){
					$this->db->select('t1.attrOptName');
					$this->db->from('rp_attribute_option_details t1');
					$this->db->where('t1.attrOptionID="'.$feildvalue.'" AND t1.languageID=1');
					$query = $this->db->get();
					//echo $this->db->last_query();
					$attrvalueName = $query->result();
				
					$data = array();
					$data['propertyID'] = $propertyID;
					$data['attributeID'] = $attributeIDs;
					$data['attrOptionID'] = $feildvalue;
					$this->db->insert('rp_property_attribute_values',$data);
					//echo $this->db->last_query();
					$lastInsertedID = $this->db->insert_id();

					$data1 = array();
					$data1['attrValueID'] = $lastInsertedID;
					$data1['languageID'] = 1;
					$data1['attrDetValue'] = $attrvalueName[0]->attrOptName;
					$this->db->insert('rp_property_attribute_value_details',$data1);
					echo $this->db->last_query();

				}				
		}
		else{
			// update
			
		
			if($feildType=='textbox' && $feildvalue!=''){

				$this->db->select('t1.attrValueID');
				$this->db->from('rp_property_attribute_values t1');
				$this->db->where('t1.propertyID="'.$propertyID.'" AND t1.attributeID="'.$attributeIDs.'"');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$result = $query->result();
				//echo "<pre>";print_r($result);echo "</pre>";
				$attrValueID = $result[0]->attrValueID;

				$data = array();
				$data['attrDetValue'] = $feildvalue;
				
				$this->db->set($data);
				$this->db->where('attrValueID', $attrValueID);
				$this->db->update('rp_property_attribute_value_details');

				}else if($feildType=='select' && $feildvalue!='0'){
					/* echo "<li>====> ".$feildType;
					echo "<li>====> ".$feildvalue;
					echo "<li>====> ".$attributeIDs;
					echo "<li>====> ".$propertyID; */
				$data1 = array();
				$data1['attrOptionID'] = $feildvalue;
				$this->db->set($data1);
				$this->db->where('propertyID', $propertyID);
				$this->db->where('attributeID', $attributeIDs);
				$this->db->update('rp_property_attribute_values');
				//echo $this->db->last_query();
				
				$this->db->select('t1.attrOptName');
				$this->db->from('rp_attribute_option_details t1');
				$this->db->where('t1.attrOptionID="'.$feildvalue.'" AND t1.languageID=1');
				$query = $this->db->get();
				$attrvalueName = $query->result();


				$this->db->select('t1.attrValueID');
				$this->db->from('rp_property_attribute_values t1');
				$this->db->where('t1.propertyID="'.$propertyID.'" AND t1.attributeID="'.$attributeIDs.'"');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$result = $query->result();
				//echo "<pre>";print_r($result);echo "</pre>";
				$attrValueID = $result[0]->attrValueID;

				$data = array();
				$data['attrDetValue'] = $attrvalueName[0]->attrOptName;
				
				$this->db->set($data);
				$this->db->where('attrValueID', $attrValueID);
				$this->db->update('rp_property_attribute_value_details');
				

				}else if($feildType=='multiselect' && $feildvalue!=0 && $attributeIDs!=6){
					//echo "<li>feild type===> ".$feildType;echo "<li>feild value===> ".$feildvalue;
					$this->db->select('t1.attrOptName');
					$this->db->from('rp_attribute_option_details t1');
					$this->db->where('t1.attrOptionID="'.$feildvalue.'" AND t1.languageID=1');
					$query = $this->db->get();
					$attrvalueName = $query->result();
					//echo "<pre>";print_r($result);echo "</pre>";

					$this->db->select('t1.attrValueID');
					$this->db->from('rp_property_attribute_values t1');
					$this->db->where('t1.propertyID="'.$propertyID.'" AND t1.attributeID="'.$attributeIDs.'"');
					$query = $this->db->get();
					//echo $this->db->last_query();
					$result = $query->result();
					//echo "<pre>";print_r($result);echo "</pre>";
					$attrValueID = $result[0]->attrValueID;

					$data = array();
					$data['attrDetValue'] = $attrvalueName[0]->attrOptName;
				
					$this->db->set($data);
					$this->db->where('attrValueID', $attrValueID);
					$this->db->update('rp_property_attribute_value_details');

				}

		}

		}

		public function checkAttrintoTable($propertyID,$attributeIDs){
			$this->db->select('t1.attrValueID');
			$this->db->from('rp_property_attribute_values t1');
			$this->db->where('t1.propertyID="'.$propertyID.'" AND t1.attributeID="'.$attributeIDs.'"');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$query->result();
			return $this->db->affected_rows();
		}

		public function getUserAddress($userID=null){
		   if($userID !=null){
		      $this->db->select('userAddress1, userAddress2');
		      $this->db->from('rp_user_details');
		      $this->db->where('languageID=1 AND userID="'.$userID.'"');
		     // $this->db->where(' languageID =1"');
		      $query = $this->db->get();
		      return $query->result();
                }
		}

		public function getProjectInfo($userID=null){

		if($userID != null){
			$this->db->select('t2.userCompanyName, t3.projectName');
			$this->db->from('rp_projects t1');
			$this->db->join('rp_user_details t2','t2.userID=t1.userID','inner');
			$this->db->join('rp_project_details t3',' t3.projectID = t1.projectID AND t3.languageID =1 AND t2.languageID =1 AND t1.userID ="'.$userID.'"','inner');
			$query = $this->db->get();
			echo $this->db->last_query();
			return $query->result();
		}

	}
	public function getPropertyLoc($propertyID = null){
              $this->db->select('t1.cityLocName,t1.cityLocID');
              $this->db->from('rp_city_location_details t1');
              $this->db->join('rp_properties t2','t2.cityLocID = t1.cityLocID AND t1.languageID =1 AND t2.propertyID ="'.$propertyID.'"','inner');
              $query = $this->db->get();
			  //echo $this->db->last_query();;
              return $query->result();

	}
	
	public function getPropertyCityName($cityLocID = null){
		$this->db->select('t1.cityID,t2.cityName');
        $this->db->from('rp_city_locations t1');
        $this->db->join('rp_city_details t2','t2.cityID = t1.cityID AND t2.languageID=1 AND t1.cityLocID ="'.$cityLocID.'"','inner');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
		
	}

	public function getPropertySpecInfo($propertyID = null){
		$this->db->select ('t2.attrName,t1.attrDetValue');
		$this->db->from('rp_property_attribute_values t3');
		$this->db->join('rp_property_attribute_value_details t1','t3.attrValueID=t1.attrValueID','inner');
		$this->db->join('rp_attribute_details t2','t3.attributeID=t2.attributeID AND t2.languageID =1 AND t1.languageID =1 AND propertyID ="'.$propertyID.'"','inner');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}

	/******************Synch code start******************************/

	public function getPropertyTable($propertyID = null){

		$this->db->select('t1.APID');
		$this->db->from('rp_appointment_property t1');
		$this->db->where('t1.LPID="'.$propertyID.'"');
		$query = $this->db->get();
		$appointmentID = $query->result();
		$appointmentID = $appointmentID[0]->APID;
		
		$this->db->select("t1.*");
		$this->db->from("rp_properties t1");
		$this->db->where('t1.propertyID="'.$propertyID.'"');
		$query = $this->db->get();
		$row = $this->db->affected_rows();
		//if($row){
			$propertyData = (array) $query->result();
			$propertiesTableData = (array) $propertyData[0];
			unset($propertiesTableData['propertyID']);
			//print_r($propertiesTableData);			die;
			//$propertiesTableData = array_slice($propertyData,1);			
			$propertiesTableData['propertyStatus'] = "Active";
			
			/* Properties table */
			$db1 = $this->load->database('test', TRUE); 
			$db1->insert('rp_properties',$propertiesTableData);
			$newpropertyID = $db1->insert_id();
			/* End Properties table */
			
			/****** New property id save into rp_appointment_property Table *******************/
			$newPropertyIDarr = array();
			$newPropertyIDarr['PPID']=$newpropertyID; 
			$this->db->set($newPropertyIDarr);
			$this->db->where('APID', $appointmentID);
			$this->db->where('LPID', $propertyID);
			$this->db->update('rp_appointment_property');
			/****** End New property id save into rp_appointment_property Table **************/
			
			$this->db->select('t1.*');
			$this->db->from('rp_property_details t1');
			$this->db->where('t1.propertyID="'.$propertyID.'"');
			$query = $this->db->get();
			$propertyDetailsData = (array) $query->result();	
			$propertyDetailsTableData = (array) $propertyDetailsData[0];
			unset($propertyDetailsTableData['propertyDetailsID']);
			$propertyDetailsTableData['propertyID'] =  $newpropertyID;
			//print_r($propertyDetailsTableData);die;
			$db1 = $this->load->database('test', TRUE);
			$db1->insert('rp_property_details',$propertyDetailsTableData);
			//return $db1->last_query();
			//print_r($propertyDetailsTableData);
			//die;
			$this->db->select('t1.*');
			$this->db->from('rp_property_price t1');
			$this->db->where('t1.propertyID="'.$propertyID.'"');
			$query = $this->db->get();

			$propertyPriceData = (array) $query->result();
			
			$propertyPriceTableData = (array) $propertyPriceData[0];
			//$propertyPriceTableData = array_slice($propertyPriceTableData,1);
			$propertyPriceTableData['propertyID'] = $newpropertyID;
			unset($propertyPriceTableData['propertyPriceID']);
			//$db1 = $this->load->database('test', TRUE);
			$db1->insert('rp_property_price',$propertyPriceTableData);
			
			$this->db->select('t1.*,t2.attrDetValue');
			$this->db->from('rp_property_attribute_values t1');
			$this->db->join('rp_property_attribute_value_details t2','t1.attrValueID=t2.attrValueID','inner');
			$this->db->where('propertyID="'.$propertyID.'"');
			$query = $this->db->get();
			$propertyAttributeValuesTableData = array();
			$data = array();
			foreach ($query->result() as $key => $value) {

				$propertyAttributeValuesTableData = array(					
				    'propertyID' => $newpropertyID,
				    'attributeID' => $value->attributeID,
				    'attrOptionID' => $value->attrOptionID
				    );
				$db1->insert('rp_property_attribute_values',$propertyAttributeValuesTableData);
				$newattrValueID = $db1->insert_id();
				$data['attrValueID'][] = array($newattrValueID,$value->attrDetValue);
			}
			$propertyAttributeValuesTableData = array();	

			$propertyAttributeValueDetailsTableData = array();
			
			foreach ($data['attrValueID'] as $key => $value) {
				
				$propertyAttributeValueDetailsTableData = array(
					'attrValueID'=>$value[0],
				    'languageID' => 1,
				    'attrDetValue' => $value[1]				    
				    );	
				$db1->insert('rp_property_attribute_value_details',$propertyAttributeValueDetailsTableData);
			}
		
			/********************************Image synch **************************/
		$this->db->select('t1.*');
		$this->db->from('rp_app_images t1');
		$this->db->where('t1.appointment_id="'.$appointmentID.'"');
		$query = $this->db->get();
		$allImages = $query->result();
		
		$this->load->library('ftp');
		$config['hostname'] = 'dbproperties.ooo';
		$config['username'] = 'mobile';
		$config['password'] = 'Ht5@nMobile#';
		$config['debug'] = TRUE;
		$config['port']     = 21;
		$config['passive']  = FALSE;
		$this->ftp->connect($config);

	//print_r($allImages);
		foreach($allImages as $key=>$value){
			//$this->ftp->upload($src,$dest, 'ascii', 0775);
			$propertyImageTableData = array();
			$this->ftp->download('img/'.$value->image, 'assests/property/'.$value->image, 'auto');
			$propertyImageTableData = array(					
				    'propertyID' => $newpropertyID,
				    'imageCatID' => 2,
				    'propertyImageName' => $value->image,
					'isCoverImage' => $value->coverImage,// need to change when image is cover or not
					'propertyImagePriority' => 1,
					'propertyImageStatus' => 'Active',
					'propertyImageAddedDate' => date('Y-m-d H:i:s') 
				    );
					//print_r($propertyImageTableData);
				//$db1 = $this->load->database('test', TRUE);
				$db1->insert('rp_property_images',$propertyImageTableData);
				//echo $db1->last_query();
			
		}
		$this->ftp->close();
		//return $allImages;
		/********************************End Image synch**************************/
		return "SUCCESS";
		
	}
	
	public function getPropertyImage($propertyID = null){
		 
	   $this->db->select('APID');
	   $this->db->from('rp_appointment_property');
	   $this->db->where('LPID="'.$propertyID.'"');
	   $query = $this->db->get();
	   
	   $result = $query->result();
	   $APID = $result[0]->APID;
	   $this->db->select('*');
	   $this->db->from('rp_app_images');
	   $this->db->where('appointment_id="'.$APID.'"');
	   $query = $this->db->get();
	   //echo $this->db->last_query();
	   return $result = $query->result();

  }

	public function getPropertyAmenitiesInfo($propertyID = null){
		$this->db->select('t1.attrClassName');
		$this->db->from('rp_attribute_options t1');
		$this->db->join('rp_property_attribute_values t2', 't1.attributeID=t2.attributeID AND t2.attributeID=6 AND t2.propertyID ="'.$propertyID.'"','inner');
		$query = $this->db->get();
		return $query->result();

	}
	
	public function getPropertyPreviewType($propertyID = null){
		$this->db->select('t1.propertyName');// as discuss with Mayank he is save 2 bhk into property name
		$this->db->from('rp_property_details t1');
		$this->db->where('propertyID="'.$propertyID.'"');
		$query = $this->db->get();
		return $query->result();
	}
	public function appImageDelete($imageID=null,$appointmentid=null){
		$this->db->where('imageID', $imageID);
		$this->db->where('appointment_id', $appointmentid);
		return $this->db->delete('rp_app_images'); 
		
	}
	public function editImageTag($imageID=null,$appointmentid=null,$imagetagText){
		
		$data = array();
		$data['room_id'] = $imagetagText;
		$this->db->set($data);
		$this->db->where('imageID', $imageID);
		$this->db->where('appointment_id', $appointmentid);
		return $this->db->update('rp_app_images');
		
	}
	/***********create this Image as cover page image for property**********************************/
		public function isCoverImage($imageID=null,$appointmentid=null){
			$data = array();
			$this->db->select('t1.*');
			$this->db->from('rp_app_images t1');
			$this->db->where('t1.appointment_id', $appointmentid);
			$query = $this->db->get();
			$allAppointmentImages = $query->result();
			
			foreach($allAppointmentImages as $key=>$value){
				if($value->imageId==$imageID){
					$data['coverImage'] = 'Yes';
					$this->db->set($data);
					$this->db->where('imageID', $imageID);
					$this->db->where('appointment_id', $appointmentid);
					$this->db->update('rp_app_images');
				}else{
					$data['coverImage'] = 'No';
					$this->db->set($data);
					$this->db->where('imageID', $value->imageId);
					$this->db->where('appointment_id', $appointmentid);
					$this->db->update('rp_app_images');
				}
			}
			return "success";
		}
	/*******************End create this Image as cover page image for property*********************/
	
	public function previewbutton($propertyID=null){
		$this->db->select('t1.*');
		$this->db->from('rp_appointment_property t1');
		$this->db->where('t1.LPID="'.$propertyID.'"');
		$query = $this->db->get();
		return $query->result();
		
	}
	
	public function IsAppointmentProperty($propertyID){
		$this->db->select('t1.*');
		$this->db->from('rp_appointment_property t1');
		$this->db->where('t1.LPID="'.$propertyID.'"');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAppointmentID($propertyID){
		$this->db->select('t1.*');
		$this->db->from('rp_appointment_property t1');
		$this->db->where('t1.LPID="'.$propertyID.'"');
		$query = $this->db->get();
		$getresult = $query->result();
		return $getresult[0]->APID;
	}
	public function getUserRegisterStatus($appointmentID){
		$this->db->select('t1.userExistsStatus');
		$this->db->from('rp_appointments t1');
		$this->db->where('t1.appointmentID="'.$appointmentID.'"');
		$query = $this->db->get();
		$getresult = $query->result();
		//echo "<pre>";print_r($getresult);
		return $getresult[0]->userExistsStatus;
	}

	public function getUnregisterEmail($appointmentID){
		$this->db->select('t1.email');
		$this->db->from('rp_appointments t1');
		$this->db->where('t1.appointmentID="'.$appointmentID.'"');
		$query = $this->db->get();
		$getresult = $query->result();
		//echo "<pre>";print_r($getresult);
		return $getresult[0]->email;
	}
}

?>