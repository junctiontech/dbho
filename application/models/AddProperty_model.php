<?php

class AddProperty_model extends CI_Model {

    //variable initialize
    var $title = '';
    var $content = '';
    var $date = '';
    public $imageSizeX;
    public $imageSizeY;
    public $resizeX;
    public $resizeY;
    public $reduction_height;
    public $reduction_width;
    public $fileName;
    public $msg;
    public $image;
    public $imageType;

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        //Load database connection
        $this->load->database();
    }

    function Insert_data($table = false, $data = false, $filter = false) {

        if ($filter) {

            $this->db->where($filter);
            $this->db->update($table, $data);
        } else {
            $this->db->insert($table, $data);
            $last_id = $this->db->insert_id();
            return($last_id);
        }
    }

    function get_project($addquery = false) {
        $qry = $this->db->query("select * from rp_projects,rp_project_details where
									rp_projects.projectID=rp_project_details.projectID and rp_project_details.languageID='1' and rp_projects.projectStatus='Active' $addquery");
        return $qry->Result();
    }

    public function getPropertyType($extraquery = false) {
        $this->db->select('t1.propertyTypeID,t1.propertyTypeName,t2.propertyTypeKey');
        $this->db->from('rp_property_type_details t1');
        $this->db->join('rp_property_types t2', "t1.propertyTypeID = t2.propertyTypeID AND t2.propertyTypeParentID AND t2.propertyTypeStatus = 'active' AND t2.typeName='Property'
		AND t1.languageID =1 $extraquery", 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    function get_user_type($extraquery = false) {
        $qry = $this->db->query("select rp_user_types.userTypeID,userTypeName from rp_user_types,rp_user_type_details where
									rp_user_types.userTypeID=rp_user_type_details.userTypeID and
									userTypeStatus='Active' and
									rp_user_type_details.languageID='1' $extraquery");
        return $qry->Result();
    }

    public function getuser($userTypeID = false) {
        if ($userTypeID != null) {
            $filter = array('userTypeID' => $userTypeID);
            $this->db->select('userID,userEmail');
            $query = $this->db->get_where('rp_users', $filter);
            return $query->result();
        }
    }

    public function getuserforpreview($userid = false) {
        if ($userid != null) {
            $filter = array('userID' => $userid);
            $this->db->select('userTypeID,userEmail');
            $query = $this->db->get_where('rp_users', $filter);
            return $query->result();
        }
    }

    public function Getattributesgroups($propertyTypeID = false) {
        $this->db->select('distinct (t1.attributeGroupID),t1.propertyTypeID,t2.name');
        $this->db->from('rp_attribute_group t1');
        $this->db->join('rp_attribute_group_details t2', 't2.attributeGroupID=t1.attributeGroupID AND t1.propertyTypeID="' . $propertyTypeID . '"', 'inner');
        $this->db->join('rp_attribute_to_group t3', 't3.attributeGroupID=t1.attributeGroupID AND t2.languageID=1', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetAttributes($attributeGroupID = false) {
        $this->db->select('t2.attributeID,t2.attrInputType,t2.attributeKey,t3.attrName');
        $this->db->from('rp_attribute_to_group t1');
        $this->db->join('rp_attributes t2', 't1.attributeID=t2.attributeID', 'inner');
        $this->db->join('rp_attribute_details t3', 't3.attributeID=t2.attributeID AND t3.languageID=1 AND t2.attrStatus="A" AND t1.attributeGroupID="' . $attributeGroupID . '" AND t2.attrStatus="A"', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetAttributesoption($attribute = false) {
        $this->db->select('t2.attrOptionID,t2.attrOptName,t1.attributeID,t1.attrClassName');
        $this->db->from('rp_attribute_options t1');
        $this->db->join('rp_attribute_option_details t2', 't1.attrOptionID=t2.attrOptionID AND t2.languageID=1 AND t1.attributeID="' . $attribute . '" ', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

	public function Getflooringvaluesofproperty($propertyID = false,$attributeID=false) {
        $this->db->select('*');
        $this->db->from('rp_property_attribute_values t1');
        $this->db->join('rp_property_attribute_value_details t2', 't1.attrValueID=t2.attrValueID AND t2.languageID=1 AND t1.propertyID="' . $propertyID . '" AND t1.attributeID="' . $attributeID . '"', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
	
    function GetUserplan($userid = false) {
        $qry = $this->db->query("select rp_dbho_campaignplan.planID,planTitle,rp_dbho_campaignmaster.campaignID from rp_dbho_campaignmaster,rp_dbho_campaignplan,rp_user_plan_details,rp_dbho_user_plans_subdetail where
									rp_dbho_campaignmaster.userID=$userid and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID and
									rp_dbho_campaignplan.planID=rp_user_plan_details.planID and
									rp_dbho_campaignplan.planID=rp_dbho_user_plans_subdetail.planID and
									rp_dbho_user_plans_subdetail.listingType='Property' and
									rp_user_plan_details.languageID='1' and rp_dbho_campaignplan.status='Active'");
        return $qry->Result();
    }

    public function InsertProperty($table = false, $data = false, $filter = false) {
        if (empty($filter)) {
            $this->db->insert($table, $data);
            $lastid = $this->db->insert_id();
            return $lastid;
        } else {
            $query = $this->db->get_where($table, $filter);
            $result = $query->result();
            if (!empty($result)) {
                $this->db->where($filter);
                $this->db->update($table, $data);
            } else {
                $data = array_merge($data, $filter);
                $this->db->insert($table, $data);
            }
        }
    }

    public function Insertotherinfo($table = false, $data = false) {


        $this->db->insert($table, $data);
    }

    public function deleteattributesandvalues($filter = false, $in = false) {
        $this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter' and rp_property_attribute_values.attributeID NOT IN ($in)");
    }
	
	public function deleteallattributesandvalues($filter = false) {
        $this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter'");
    }

    public function deleteattributesandvaluesflooring($filter = false, $attributeid = false) {
        $this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter' and rp_property_attribute_values.attributeID ='$attributeid'");
    }

    function get_propertylisting($extraqry = false,$RequestProperties= false) {
		//echo "<li>====>".$RequestProperty;die;
		
		if($RequestProperties){
			$qry = $this->db->query("select rp_properties.propertyID,rp_properties.userID,propertyKey,propertyStatus,propertyAddedDate,propertyName,userEmail,userTypeName,rp_user_plan_details.planTitle,isVerified from rp_properties,rp_property_details,rp_users,rp_user_type_details,rp_user_plan_details,rp_dbho_plan_mapping  where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.userID=rp_users.userID and
									rp_users.userTypeID=rp_user_type_details.userTypeID and
									rp_property_details.languageID='1' and
									rp_user_type_details.languageID='1' and
									rp_properties.propertyID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='property' AND
									rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and
									rp_user_plan_details.languageID='1' and
									rp_properties.propertyStatus ='Request' $extraqry ORDER BY rp_properties.propertyID DESC");
		}
		else{
			
			if($this->input->post('submit') == 'Export to CSV') {
				$qry = $this->db->query("select propertyName as 'Property Name', propertyKey as 'Property Key',propertyStatus as 'Property Status', userFirstName as 'Owner Name' ,userEmail as Email, userTypeName as 'Owner Type' ,rp_user_plan_details.planTitle as 'Plan Name',propertyAddedDate as 'Property Post On' from rp_properties,rp_property_details,rp_users,rp_user_details,rp_user_type_details,rp_user_plan_details,rp_dbho_plan_mapping  where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.userID=rp_users.userID and
									rp_users.userID=rp_user_details.userID and
									rp_users.userTypeID=rp_user_type_details.userTypeID and
									rp_user_details.languageID='1' and
									rp_property_details.languageID='1' and
									rp_property_details.versionID ='0' and
									rp_user_type_details.languageID='1' and
									rp_properties.propertyID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='property' AND
									rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and
									rp_user_plan_details.languageID='1' and
									rp_properties.propertyStatus NOT IN('Deleted','Request','Inactive') $extraqry ORDER BY rp_properties.propertyID DESC");
										return $this->dbutil->csv_from_result($qry); 
									}
        $qry = $this->db->query("select rp_properties.propertyID,rp_properties.userID,propertyKey,propertyStatus,propertyAddedDate,propertyName,userEmail,userTypeName,rp_user_plan_details.planTitle,isVerified from rp_properties,rp_property_details,rp_users,rp_user_type_details,rp_user_plan_details,rp_dbho_plan_mapping  where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.userID=rp_users.userID and
									rp_users.userTypeID=rp_user_type_details.userTypeID and
									rp_property_details.languageID='1' and
									rp_property_details.versionID ='0' and
									rp_user_type_details.languageID='1' and
									rp_properties.propertyID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='property' AND
									rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and
									rp_user_plan_details.languageID='1' and
									rp_properties.propertyStatus NOT IN('Deleted','Request','Inactive') $extraqry ORDER BY rp_properties.propertyID DESC");
									
									
		}							
        return $qry->Result();
    }

    public function Shownoofbedrooms($table = false, $propertyID = false) {

        $this->db->select('attrDetValue,attrOptionID');
        $this->db->from('rp_property_attribute_values t1');
        $this->db->join('rp_property_attribute_value_details t2', 't1.attrValueID=t2.attrValueID AND t2.languageID=1 ', 'inner');
        $this->db->where($propertyID);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function Shownpreview($propertyid = false) {
        if ($propertyid != null) {
            $qry = $this->db->query("select * from rp_properties,rp_property_details where
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.propertyID='$propertyid' and
									rp_property_details.languageID='1'");
            return $qry->Result();
        }
    }
	
	 public function Getpropertylogdetails($propertyid = false,$actiontype=false) {
        if ($propertyid != null) {
			
            $qry = $this->db->query("select userID,userAccessType from rp_dbho_property_log where
									rp_dbho_property_log.propertyID='$propertyid' and
									rp_dbho_property_log.actionType='$actiontype' 
									ORDER BY rp_dbho_property_log.logID DESC");
            return $qry->Result();
        }
    }
	
	public function Getuserdetails($select=false,$from=false,$where=false) {
        
            $qry = $this->db->query("select $select from $from where
									$where ");
            return $qry->Result();
        
    }
	
	public function getplandetailsofproperty($propertyid = false) {
        if ($propertyid != null) {
            $qry = $this->db->query("select planTitle from rp_dbho_plan_mapping,rp_user_plan_details where
									rp_dbho_plan_mapping.objectID='$propertyid' and
									rp_dbho_plan_mapping.objectType='property' AND
									rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and
									rp_user_plan_details.languageID='1'");
            return $qry->Result();
        }
    }

    public function Getotherdata($table = false, $filter = false) {
        $query = $this->db->get_where($table, $filter);
        return $query->result();
    }

    public function Getotherdatafromnewdb($table = false, $filter = false) {

			$query =$this->db->get_where($table, $filter);		
			return $query->result();
    }
	
	 public function Getbedbathroomdata($table = false, $filter = false,$orderby=false) {

				if(!empty($orderby)){
							$this->db->order_by("$orderby","asc");
							$query =$this->db->get_where($table, $filter);
							
							
							return $query->result();
				}
	}

    public function Deletepropertyimage($filter = false) {
        $this->db->query("DELETE rp_property_images,rp_property_image_details FROM rp_property_images JOIN rp_property_image_details ON rp_property_image_details.propertyImageID = rp_property_images.propertyImageID WHERE rp_property_images.propertyImageID ='$filter'");
    }

    public function deletestep3data($table = false, $filter = false) {

        $this->db->delete($table, $filter);
    }

    function get_propertyloglisting($filter = false) {

        $qry = $this->db->query("select logID,propertyName, rp_dbho_property_log.userID ,createdOn, actionType,planTitle,userAccessType from rp_dbho_property_log,rp_properties,rp_property_details,rp_dbho_plan_mapping,rp_user_plan_details where
									rp_dbho_property_log.propertyID=rp_properties.propertyID and
									rp_properties.propertyID=rp_property_details.propertyID and
									rp_properties.propertyID=rp_dbho_plan_mapping.objectID AND
									rp_dbho_plan_mapping.objectType='property' AND
									rp_user_plan_details.planID=rp_dbho_plan_mapping.planID and
									rp_user_plan_details.languageID='1' and
									rp_property_details.languageID='1' $filter ORDER BY rp_properties.propertyID DESC");
									
									if($this->input->post('submit') == 'Export to CSV') {
										return $this->dbutil->csv_from_result($qry); 
									}
        return $qry->Result();
    }

    public function Getpropertyimages($propertyid = false) {
        $this->db->select('*');
        $this->db->from('rp_property_images t1');
        $this->db->join('rp_property_image_details t2', 't1.propertyImageID=t2.propertyImageID AND t2.languageID=1 AND t1.propertyID="' . $propertyid . '"', 'inner');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }

	/***********create this Image as cover page image for property**********************************/
		public function isCoverImage($imageID=null,$propertyid=null){
			$data = array();
			$this->db->select('t1.*');
			$this->db->from('rp_property_images t1');
			$this->db->where('t1.propertyID', $propertyid);
			$query = $this->db->get();
			$allpropertyimages = $query->result();
			
			foreach($allpropertyimages as $key=>$value){
				if($value->propertyImageID==$imageID){
					$data['isCoverImage'] = 'Yes';
					$this->db->set($data);
					$this->db->where('propertyImageID', $imageID);
					$this->db->update('rp_property_images');
				}else{
					$data['isCoverImage'] = 'No';
					$this->db->set($data);
					$this->db->where('propertyImageID', $value->propertyImageID);
					$this->db->update('rp_property_images');
				}
			}
			return "success";
		}
	/*******************End create this Image as cover page image for property*********************/
	
	
    public function editImageTag($imageid = false, $imagetagText = false, $imagetagText1 = false) {

        $this->db->set('propertyImageTitle', $imagetagText);
        $this->db->where('propertyImageID', $imageid);
        $this->db->update('rp_property_image_details');

        $this->db->set('propertyImagePriority', $imagetagText1);
        $this->db->where('propertyImageID', $imageid);
        return $this->db->update('rp_property_images');
    }

    /*     * *******************************************Google Api Info Save Start********************************************************* */

    function saveGoogleLocalInfos($googleLocalInfos = "", $localInfoTypeID = "", $propertyID = "") {
        for ($j = 0; $j < count($googleLocalInfos); $j++) {
            $googleInfoPlaceId = $googleLocalInfos[$j]->place_id;
            $googleInfoLat = $googleLocalInfos[$j]->geometry->location->lat;
            $googleInfoLong = $googleLocalInfos[$j]->geometry->location->lng;
            $googleInfoImageUrl = $googleLocalInfos[$j]->icon;
            $googleInfoName = $googleLocalInfos[$j]->name;
            $googleInfoAddress = $googleLocalInfos[$j]->vicinity;

            if ($googleInfoPlaceId != "") {
                $placeIdCheck = $this->db->query("SELECT * 
										FROM rp_google_localinfo 
										WHERE googleInfoPlaceId = '" . $googleInfoPlaceId . "'");
                $placeIdCheck = $placeIdCheck->result();


                if ($placeIdCheck) {
                    $sqlSelectLink = $this->db->query("SELECT googleInfoToPropertyID 
										FROM rp_google_localinfo_to_property 
										WHERE googleInfoID = '" . $placeIdCheck[0]->googleInfoID . "' AND propertyID = '" . $propertyID . "'");

                    $linkCheck = $sqlSelectLink->result();
                    if (!$linkCheck) {
                        $this->db->query("INSERT INTO rp_google_localinfo_to_property (
													googleInfoID,
													propertyID) 
												values (
													'" . $placeIdCheck[0]->googleInfoID . "',
													'" . $propertyID . "')");
                    }
                } else {
                    $sqlInsertInfo = "INSERT INTO rp_google_localinfo (
										localinfoTypeID,
										googleInfoPlaceId,
										googleInfoLat,
										googleInfoLong,
										googleInfoImageUrl,
										googleInfoStatus ) 
									values (
										'" . $localInfoTypeID . "',
										'" . $googleInfoPlaceId . "',
										'" . $googleInfoLat . "',    
										'" . $googleInfoLong . "',
										'" . $googleInfoImageUrl . "',
										'Active')";

                    $this->db->query($sqlInsertInfo);

                    $googleInfoID = $this->db->insert_id();


                    $insertdata = array('languageID' => '1',
                        'googleInfoID' => $googleInfoID,
                        'googleInfoName' => $googleInfoName,
                        'googleInfoAddress' => $googleInfoAddress,
                        'infoName' => $googleInfoName,
                        'infoAddress' => $googleInfoAddress);
                    $this->db->insert('rp_google_localinfo_details', $insertdata);
                    /* }  */

                    $sqlLinkWithProject = "INSERT INTO rp_google_localinfo_to_property (
												googleInfoID,
												propertyID) 
											values (
												'" . $googleInfoID . "',
												'" . $propertyID . "')";

                    $this->db->query($sqlLinkWithProject);
                    //return true;
                }
            }
        }
    }

    /*     * *******************************************Google Api Info Save End********************************************************* */

    public function fetchLocalInfoTypes($propertyid = false) {
        $this->db->select('*');
        $this->db->from('rp_localinfo_types t1');
        $this->db->join('rp_localinfo_type_details t2', 't1.localinfoTypeID=t2.localinfoTypeID AND t2.languageID=1 ', 'inner');
        $query = $this->db->get();

        return $query->result();
    }

    public function Getaddressids($arr = array(), $propertyid = false) {


        $sublocality = $arr['sublocality']; // => Maharana Pratap Nagar
        $country = $arr['country']; // => India
        $administrative_area_level_1 = $arr['administrative_area_level_1']; // => Madhya Pradesh
        $locality = $arr['locality']; // => Bhopal
        $lat = $arr['propertyLatitude'];
        $long = $arr['propertyLongitude'];

        $countryid = '';
        $stateid = '';
        $cityid = '';
        $citylocid = '';

        /*         * **************************************Get Country ID************************************************************* */
        $removeSpacecountry = str_replace(' ', '_', $country);
        $removeSpaceLowercasecountry = strtolower($removeSpacecountry);

        $this->db->select("t1.*");
        $this->db->from('rp_countries t1');
        $this->db->where('t1.countryUrlKey like "' . $removeSpaceLowercasecountry . '"');
        $query = $this->db->get();

        $queryResult = $query->result();

        if (!empty($queryResult)) {
            $countryid = $queryResult[0]->countryID;
        } else {

            $countrydata = array('countryAvailable' => 'Yes',
                'countryIsoA2' => '',
                'countryIsoA3' => '',
                'countryIsoNumber' => '',
                'countryPriority' => '',
                'addressFormatID' => '',
                'countryUrlKey' => $removeSpaceLowercasecountry);

            $this->db->insert('rp_countries', $countrydata);

            $lastinsertedcountryid = $this->db->insert_id();

            $countrydetaildata = array('countryID' => $lastinsertedcountryid,
                'languageID' => '1',
                'countryName' => $removeSpacecountry);

            $this->db->insert('rp_country_details', $countrydetaildata);

            $countryid = $lastinsertedcountryid;
        }
        /*         * **************************************Get Country ID************************************************************* */

        /*         * **************************************Get State ID************************************************************* */
        $removeSpacestate = explode(' ', $administrative_area_level_1);
        $removeSpacestate = implode('_', $removeSpacestate);
        $removeSpaceLowercasestate = strtolower($removeSpacestate);

        $this->db->select("t1.*");
        $this->db->from('rp_states t1');
        $this->db->where('t1.stateUrlKey like "' . $removeSpaceLowercasestate . '"');
        $query = $this->db->get();

        $queryResult1 = $query->result();

        if (!empty($queryResult1)) {
            $stateid = $queryResult1[0]->stateID;
        } else {

            $statedata = array('countryID' => $countryid,
                'stateShortName' => '',
                'stateStatus' => 'Active',
                'stateUrlKey' => $removeSpaceLowercasestate,
                'googleStateName' => $administrative_area_level_1);

            $this->db->insert('rp_states', $statedata);

            $lastinsertedstateid = $this->db->insert_id();

            $statedetaildata = array('stateID' => $lastinsertedstateid,
                'languageID' => '1',
                'stateName' => $administrative_area_level_1);

            $this->db->insert('rp_state_details', $statedetaildata);

            $stateid = $lastinsertedstateid;
        }
        /*         * **************************************Get State ID************************************************************* */

        /*         * **************************************Get City ID************************************************************* */
        //$removeSpacecity = str_replace(' ','_',$locality);
        $removeSpacecity = explode(' ', $locality);
        $removeSpacecity = implode('_', $removeSpacecity);
        $removeSpaceLowercasecity = strtolower($removeSpacecity);

        $this->db->select("t1.*");
        $this->db->from('rp_cities t1');
        $this->db->where('t1.cityKeyID like "' . $removeSpaceLowercasecity . '"');
        $query2 = $this->db->get();

        $queryResult2 = $query2->result();

        if (!empty($queryResult2)) {
            $cityid = $queryResult2[0]->cityID;
        } else {

            $citydata = array('countryID' => $countryid,
                'stateID' => $stateid,
                'parentcityID' => '0',
                'timeZoneID' => '0',
                'cityKeyID' => $removeSpaceLowercasecity,
                'cityProximity' => 'City',
                'cityLat' => $lat,
                'cityLng' => $long,
                'citylogoImage' => '',
                'citybgImage' => '',
                'cityStatus' => 'Active',
                'cityCampaignListID' => '',
                'googleCityName' => $locality,
                'isDefault' => 'No',
                'explore' => 'No');

            $this->db->insert('rp_cities', $citydata);

            $lastinsertedcityid = $this->db->insert_id();

            $citydetaildata = array('cityID' => $lastinsertedcityid,
                'languageID' => '1',
                'cityName' => $locality,
                'province' => '',
                'cityDescription' => '');

            $this->db->insert('rp_city_details', $citydetaildata);

            $cityid = $lastinsertedcityid;
        }
        /*         * **************************************Get City ID************************************************************* */

        /*         * **************************************Get City Locality ID************************************************************* */

        $removeSpace = str_replace(' ', '_', $sublocality);
        $removeSpaceLowercase = strtolower($removeSpace);
        $this->db->select("t1.*");
        $this->db->from('rp_city_locations t1');
        $this->db->where('t1.cityLocUrlKey like "' . $removeSpaceLowercase . '"');
        $query3 = $this->db->get();
        $queryResult3 = $query3->result();

        if (!empty($queryResult3)) {

            $citylocid = $queryResult3[0]->cityLocID;
        } else {
            $locdata = array();
            $locdata['cityID'] = $cityid;
            $removeSpacescityLocUrlKey = str_replace(' ', '_', $sublocality);
            $locdata['cityLocUrlKey'] = strtolower($removeSpacescityLocUrlKey);
            $locdata['cityLocLat'] = $lat;
            $locdata['cityLocLng'] = $long;
            $locdata['cityLocStatus'] = 'Active';
            $locdata['googleLocName'] = $sublocality;

            $this->db->insert('rp_city_locations', $locdata);
            $lastInsertedcityLocID = $this->db->insert_id();

            $locdata = array();
            $locdata['cityLocID'] = $lastInsertedcityLocID;
            $locdata['cityLocName'] = $sublocality;
            $locdata['cityLocTips'] = $sublocality;
            $locdata['languageID'] = 1;

            $this->db->insert('rp_city_location_details', $locdata);
            $citylocid = $lastInsertedcityLocID;
        }
        $returnids = array('countryID' => $countryid,
            'stateID' => $stateid,
            'cityID' => $cityid,
            'cityLocID' => $citylocid);


        return $returnids;
    }

    public function Insertareacode($citylocid = false, $lat = false, $long = false, $propertyid = false) {
        $areacode = number_format((float) $lat, 1, '.', '');
        $areacode.= number_format((float) $long, 1, '.', '');
        $areacode = str_replace('.', '', "$areacode");
		
		$countresult = $this->db->get_where('rp_property_to_areas', array('propertyID' => $propertyid, 'propertyType' => 'Property'));
		$countresult1=$countresult->result();
		if(empty($countresult1)){
        $arealocalitydata = array('areaCode' => $areacode, 'localityID' => $citylocid);
        $this->db->insert('rp_locality_to_areas', $arealocalitydata);
        $propertytoarea = array('areaCode' => $areacode, 'propertyID' => $propertyid, 'propertyType' => 'Property');
        $this->db->insert('rp_property_to_areas', $propertytoarea);
		}else{
			
		$arealocalitydata = array('areaCode' => $areacode, 'localityID' => $citylocid);
        //$this->db->insert('rp_locality_to_areas', $arealocalitydata);
        $propertytoarea = array('areaCode' => $areacode, 'propertyID' => $propertyid, 'propertyType' => 'Property');
       // $this->db->insert('rp_property_to_areas', $propertytoarea);
		
		$this->db->where(array('localityID' => $citylocid));
        $this->db->update('rp_locality_to_areas', $arealocalitydata);
		
		$this->db->where(array('propertyID' => $propertyid, 'propertyType' => 'Property'));
        $this->db->update('rp_property_to_areas', $propertytoarea);
		}
    }

    public function getcountryname($table = false, $filter = false, $key = false) {
        $this->db->select($key);
        $query = $this->db->get_where($table, $filter);
        return $query->result();
    }

    public function resizeImage($imgName, $red_width, $red_height, $imageQuality = "") {
        $this->reduction_height = $red_height;
        $this->reduction_width = $red_width;
        if (is_file($imgName)) {
            if (file_exists($imgName)) {
                $this->fileName = $imgName;
                $this->getSize();
                $this->setSize();
                $this->resizeIt();
                $this->saveImage($imgName, $imageQuality);
            } else {
                //$this->errorState(0);
            }
        } else {
            //$this->errorState(2);
        }
    }

    //END OF FUNCTION
    //FUNCTION TO SET IMAGE SIZE   
    public function setSize() {
        $ratio_image = $this->imageSizeX / $this->imageSizeY;
        $ratio = $this->reduction_width / $this->reduction_height;
        if ($ratio_image < $ratio) {
            $ratio_image = $this->imageSizeX / $this->imageSizeY;
            $this->resizeY = $this->reduction_height;
            $this->resizeX = round($ratio_image * $this->resizeY);
        } else {
            $ratio_image = $this->imageSizeY / $this->imageSizeX;
            $this->resizeX = $this->reduction_width;
            $this->resizeY = round($ratio_image * $this->resizeX);
        }
    }

    //END OF FUNCTION      
    //FUNCTION TO SAVE IMAGE 
    public function saveImage($imgName, $imageQuality = "") {
        if ($imageQuality == "") {
            //Defined in application.php
            //$imageQuality=JPEG_IMAGE_QUALITY;
            $imageQuality = 200;
        }
        switch ($this->imageType) {
            case "gif":
                imagegif($this->image, $imgName);
                break;
            case "jpg":
                imagejpeg($this->image, $imgName, $imageQuality);
                break;
            case "png":
                $scaleQuality = round(($imageQuality / 100) * 9);
                $invertScaleQuality = 9 - $scaleQuality;
                imagepng($this->image, $imgName, $invertScaleQuality);
                break;
        }
    }

    //END OF FUNCTION
    //FUNCTION TO GET SIZE       
    public function getSize() {
        $this->imgParams = getimagesize($this->fileName);
        $this->imageSizeX = $this->imgParams[0];
        $this->imageSizeY = $this->imgParams[1];
        switch ($this->imgParams[2]) {
            case 1:
                $this->imageType = "gif";
                $this->image = imagecreatefromgif($this->fileName);
                break;
            case 2:
                $this->imageType = "jpg";
                $this->image = imagecreatefromjpeg($this->fileName);
                break;
            case 3:
                $this->imageType = "png";
                $this->image = imagecreatefrompng($this->fileName);
                //$this->image=imagealphablending($this->image, false);
                //	$this->image=imagesavealpha($this->image, true);
                break;
            default:
                $this->errorState(1);
        }
    }

    //END OF FUNCTION
    //FUNCTION  TO RESIZE     
    public function resizeIt() {
        $imageWidth = $width = $this->reduction_width;
        $imageHeight = $height = $this->reduction_height;

        list($width_orig, $height_orig) = $this->imgParams;

        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        $copy = imagecreatetruecolor($imageWidth, $imageHeight);
        /* Setting transparent background for png */
        $white = imagecolorallocate($copy, 255, 255, 255);
        // Fill the background with white
        imagefill($copy, 0, 0, $white);
        // Alpha blending must be enabled on the background!
        imagealphablending($copy, TRUE);
        /* Setting transparent background for png */
        if ($copy) {
            if (imagecopyresampled($copy, $this->image, ($imageWidth - $width) / 2, ($imageHeight - $height) / 2, 0, 0, $width, $height, $width_orig, $height_orig)) {
                if (imagedestroy($this->image)) {
                    $this->image = $copy;
                } else {
                    $this->errorState(6);
                }
            } else {
                $this->errorState(4);
            }
        } else {
            $this->errorState(5);
        }
    }

    public function getAppStatus($pid) {
        $this->db->select('t2.appointmentStatus');
        $this->db->from('rp_appointment_property t1');
        $this->db->join('rp_appointments t2', 't1.ApID=t2.appointmentID AND t1.LPID="' . $pid . '"', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
	
	function Getuserplandata($planid=false,$userid=FALSE)
	{		
			$qry = $this->db->query("select rp_dbho_campaignmaster.campaignID,Quantity,currentExpiry,plan_unitconsumed,status from rp_dbho_campaignmaster,rp_dbho_campaignplan where
									rp_dbho_campaignmaster.userID='$userid' and 
									rp_dbho_campaignplan.planID='$planid' and 
									rp_dbho_campaignplan.status ='Active' and
									rp_dbho_campaignmaster.campaignID=rp_dbho_campaignplan.campaignID");
			return $qry->Result();
	
	}
	
	function get_plandetails()
	{
			
			$qry = $this->db->query("select planTypeID,planTypeTitle,Priority from rp_dbho_plantype ");	
			return $qry->Result();	
	}

	function getlanguage()
	{
			
			$qry = $this->db->query("select languageID from rp_languages where languageStatus='Active' ");	
			return $qry->Result();	
	}

	function getcurrency()
	{
			
			$qry = $this->db->query("select currencyID from rp_currencies where currencyStatus='Active' ");	
			return $qry->Result();	
	}

}