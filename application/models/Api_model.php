<?php

ini_set('display_errors', 'off');

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function checkLogin($data = false) {
        if ($data) {
            $this->db->select('t1.*');
            $this->db->from('rp_app_users t1');
            $this->db->where($data);
            $query = $this->db->get();
            return $query->result();
        }
    }

    public function getAllAppointment($userId) {
        $this->db->select('t1.*,t2.LPID');
        $this->db->from('rp_appointments t1');
        $this->db->join('rp_appointment_property t2', ' t1.appointmentID = t2.APID AND t1.appointmentStatus="Open" AND t1.userID="' . $userId . '"', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPropertyID($appID) {
        $this->db->select('t1.LPID');
        $this->db->from('rp_appointment_property t1');
        $this->db->where(' t1.APID = "' . $appID . '" ');
        $query = $this->db->get();
        return $query->result();
    }

    public function getRpTableData($propertyId) {
        $this->db->select('t1.propertyLatitude,t1.propertyLongitude,t1.userID,t1.propertyTypeID');
        $this->db->from('rp_properties t1');
        $this->db->where('propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        return $query->result();
    }

    public function propertyInfo($PID) {
        $this->db->select('t1.*,t2.*');
        $this->db->from('rp_properties t1');
        $this->db->join('rp_property_details t2', 't1.propertyID=t2.propertyID AND t1.propertyID="' . $PID . '"', 'INNER');
        $query = $this->db->get();
        return $propertyInfo = $query->result();
    }

    public function alternativePhone($userID) {
        $this->db->select('t1.userAlternatePhone');
        $this->db->from('rp_user_details t1');
        $this->db->where('userID="' . $userID . '" AND t1.languageID=1');
        $query = $this->db->get();
        return $alternativePhone = $query->result();
    }

    public function userTypeforAdvertiserType($userID) {
        $this->db->select('t1.*');
        $this->db->from('rp_users t1');
        $this->db->where('userID="' . $userID . '"');
        $query = $this->db->get();
        return $userTypeforAdvertiserType = $query->result();
    }

    public function getPropertyPrice($PID) {
        $this->db->select('t1.*');
        $this->db->from('rp_property_price t1');
        $this->db->where('propertyID="' . $PID . '"');
        $this->db->where('currencyID=3');
        $query = $this->db->get();
        return $propertyPrice = $query->result();
    }

    public function bedrooms($propertyId, $userId, $appointmentID) {
        $details = array();
        $details1 = array();
        $this->db->select('t1.*');
        $this->db->from('rp_dbho_bed_room t1');
        $this->db->where('propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        $bedrooms = $query->result();
        if (!empty($bedrooms)) {
            
            foreach ($bedrooms as $bedroom) {
                $details['bedroomID'] = $bedroom->bedroomKey;
                $details['appointmentID'] = $appointmentID;
                $expOther = explode(',', $bedroom->others);
                if (in_array('Bed', $expOther)) {
                    $details['bed'] = 'Y';
                } else {
                    $details['bed'] = 'n';
                }
                if (in_array('TV', $expOther)) {
                    $details['tv'] = 'Y';
                } else {
                    $details['tv'] = 'n';
                }
                if (in_array('AC', $expOther)) {
                    $details['ac'] = 'Y';
                } else {
                    $details['ac'] = 'n';
                }
                if (in_array('DressingTable', $expOther)) {
                    $details['dressingTable'] = 'Y';
                } else {
                    $details['dressingTable'] = 'n';
                }if (in_array('Wardrobe', $expOther)) {
                    $details['wardrobe'] = 'Y';
                } else {
                    $details['wardrobe'] = 'n';
                }if (in_array('Window', $expOther)) {
                    $details['window'] = 'Y';
                } else {
                    $details['window'] = 'n';
                }if (in_array('AttachedBalcony', $expOther)) {
                    $details['attachedBalconey'] = 'Y';
                } else {
                    $details['attachedBalconey'] = 'n';
                }if (in_array('AttachedBathroom', $expOther)) {
                    $details['attachedBathroom'] = 'Y';
                } else {
                    $details['attachedBathroom'] = 'n';
                }if (in_array('FalseCeiling', $expOther)) {
                    $details['falseCeiling'] = 'Y';
                } else {
                    $details['falseCeiling'] = 'n';
                }
				if (in_array('Ventilation', $expOther)) {
                    $details['Ventilation'] = 'Y';
                } else {
                    $details['Ventilation'] = 'n';
                }
                $details['flooringType'] = $bedroom->flooringType;
                
                $details1[] = $details;
            }
            return $details1;
        }
    }

    public function kitchens($propertyId, $userId, $appointmentID) {

        $this->db->select('distinct(t1.attributeID),t1.attrOptionID,t2.attrDetValue');
        $this->db->from('rp_property_attribute_values t1');
        $this->db->join('rp_property_attribute_value_details t2', 't1.attrValueID=t2.attrValueID and t1.propertyID="' . $propertyId . '" and t1.attributeID=176 and t2.languageID="1"', 'INNER');
        $query = $this->db->get();
        $plateform = $query->result();
        //print_r($plateform[0]->attrDetValue);

        $details = array();
        $details1 = array();
        $this->db->select('t1.*');
        $this->db->from('rp_dbho_kitchen t1');
        $this->db->where('propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        $kitchens = $query->result();
        if (!empty($kitchens)) {
            $an = 1;
            foreach ($kitchens as $kitchen) {
                //print_r($kitchen);
                $details['kitchenID'] = 'Kitchen' . $an;
                $details['appointmentID'] = $appointmentID;
                $expOther = explode(',', $kitchen->others);

                if (in_array('GasPipeline', $expOther)) {
                    $details['gaspipLine'] = 'Y';
                } else {
                    $details['gaspipLine'] = 'n';
                }
                if (in_array('Refrigerator', $expOther)) {
                    $details['refrigerator'] = 'Y';
                } else {
                    $details['refrigerator'] = 'n';
                }
                if (in_array('Waterpurifier', $expOther)) {
                    $details['waterPurifier'] = 'Y';
                } else {
                    $details['waterPurifier'] = 'n';
                }if (in_array('Microwave', $expOther)) {
                    $details['microwave'] = 'Y';
                } else {
                    $details['microwave'] = 'n';
                }//$details['microwave'] = 'Y';
                if (in_array('Loft', $expOther)) {
                    $details['loft'] = 'Y';
                } else {
                    $details['loft'] = 'n';
                }//$details['loft'] = 'Y';
                if (in_array('ChimneyExhaust', $expOther)) {
                    $details['chimneyExhaust'] = 'Y';
                } else {
                    $details['chimneyExhaust'] = 'n';
                }//$details['chimneyExhaust'] = 'Y';
                if ($kitchen->platformType == 'Marble Flooring') {
                    $details['kitchen_flooring'] = 'Marble Flooring';
                } else if ($kitchen->platformType == 'Granite Flooring') {
                    $details['kitchen_flooring'] = 'Granite Flooring';
                } else if ($kitchen->platformType == 'Laminated Flooring') {
                    $details['kitchen_flooring'] = 'Laminated Flooring';
                } else if ($kitchen->platformType == 'Wooden Flooring') {
                    $details['kitchen_flooring'] = 'Wooden Flooring';
                } else if ($kitchen->platformType == 'Stone Flooring') {
                    $details['kitchen_flooring'] = 'Stone Flooring';
                } else if ($kitchen->platformType == 'Ceramic - Vitrified Tiles') {
                    $details['kitchen_flooring'] = 'Ceramic - Vitrified Tiles';
                } else if ($kitchen->platformType == 'Anti Skid Tiles') {
                    $details['kitchen_flooring'] = 'Anti Skid Tiles';
                }
                //print_r($details);
                $details['cabinet'] = $kitchen->cabinet;
                if (isset($plateform[0])) {
                    $details['plateformMaterial'] = $plateform[0]->attrDetValue;
                } else {
                    $details['plateformMaterial'] = "";
                }
                $an++;
                $details1[] = $details;
            }

            return $details1;
        }
    }

    public function toilets($propertyId, $userId, $appointmentID) {
        $details = array();
        $details1 = array();
        $this->db->select('t1.*');
        $this->db->from('rp_dbho_bath_room t1');
        $this->db->where('propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        $toilets = $query->result();
        if (!empty($toilets)) {
            $an = 1;
            foreach ($toilets as $toilet) {
                $details['toiletID'] = $toilet->bathroomKey;
                $details['appointmentID'] = $appointmentID;
                $expOther = explode(',', $toilet->others);
                if (in_array('Common', $expOther)) {
                    $details['type'] = 'Common';
                } else {
                    $details['type'] = 'Attached';
                }
                // this is amenities please check it 183
                if (in_array('Geyser', $expOther)) {
                    $details['geyser'] = 'Y';
                } else {
                    $details['geyser'] = 'n';
                }
                //$details['geyser'] = 'y';
                // end 
                if (in_array('GlassPartition', $expOther)) {
                    $details['glassPartition'] = 'Y';
                } else {
                    $details['glassPartition'] = 'n';
                }
                if (in_array('ShowerCurtain', $expOther)) {
                    $details['showerPartition'] = 'Y';
                } else {
                    $details['showerPartition'] = 'n';
                }
                if (in_array('BathTub', $expOther)) {
                    $details['bathTub'] = 'Y';
                } else {
                    $details['bathTub'] = 'n';
                }
                if (in_array('Cabinet', $expOther)) {
                    $details['cabinate'] = 'Y';
                } else {
                    $details['cabinate'] = 'n';
                }if (in_array('Window', $expOther)) {
                    $details['window'] = 'Y';
                } else {
                    $details['window'] = 'n';
                }if (in_array('ExhaustFan', $expOther)) {
                    $details['exhaustFan'] = 'Y';
                } else {
                    $details['exhaustFan'] = 'n';
                }
                if (in_array('Washingmachine', $expOther)) {
                    $details['washing_machine'] = 'Y';
                } else {
                    $details['washing_machine'] = 'n';
                }


                $details['Style'] = $toilet->toilet;
                $details['flooringType'] = $toilet->flooringType;
                $an++;
                $details1[] = $details;
            }
            return $details1;
        }
    }

    public function livingroom($propertyId, $userId, $appointmentID) {

        $details = array();
        $details1 = array();
        $this->db->select('t1.*');
        $this->db->from('rp_dbho_living_room t1');
        $this->db->where('propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        $livingroom = $query->result();
        if (!empty($livingroom)) {
            $an = 1;
            foreach ($livingroom as $livingroom) {
                $details['livingRoomID'] = 'LivingRoom' . $an;
                $details['appointmentID'] = $appointmentID;
                $expOther = explode(',', $livingroom->others);
                if (in_array('Sofa', $expOther)) {
                    $details['sofa'] = 'Y';
                } else {
                    $details['sofa'] = 'n';
                }
                if (in_array('DiningTable', $expOther)) {
                    $details['dinningTable'] = 'Y';
                } else {
                    $details['dinningTable'] = 'n';
                }
                if (in_array('AC', $expOther)) {
                    $details['ac'] = 'Y';
                } else {
                    $details['ac'] = 'n';
                }
                if (in_array('TV', $expOther)) {
                    $details['tv'] = 'Y';
                } else {
                    $details['tv'] = 'n';
                }if (in_array('ShoeRack', $expOther)) {
                    $details['shoeRack'] = 'Y';
                } else {
                    $details['shoeRack'] = 'n';
                }if (in_array('FalseCeiling', $expOther)) {
                    $details['falseCeiling'] = 'Y';
                } else {
                    $details['falseCeiling'] = 'n';
                }
                $details['flooringType'] = $livingroom->flooringType;
                $an++;
                $details1[] = $details;
            }
            return $details1;
        }
    }

    public function getAllSpecificationByPropertyID($propertyId) {
        $this->db->select('t1.*');
        $this->db->from('rp_property_attribute_values t1');
        $this->db->where('t1.propertyID="' . $propertyId . '"');
        $query = $this->db->get();
        return $query->result();
        //$this->db->join('rp_property_attribute_value_details t2','t1.attrValueID=t2.attrValueID AND t1.attributeID="'.$allSpecAttr[$i]->attributeID.'" AND t1.propertyID="'.$propertyId.'" AND t2.languageID=1','INNER');
    }

    public function getPropertyAttributes($propertyId, $userId, $appointmentID) {

        $this->db->select('t1.attributeID,t1.attributeKey,t2.attrName');
        $this->db->from('rp_attributes t1');
        $this->db->join('rp_attribute_details t2', 't1.attributeID=t2.attributeID AND t1.attrStatus="A" AND t1.attributeKey !="amenities-project" AND t2.languageID=1', 'INNER');
        $query = $this->db->get();
        $allSpecAttr = $query->result(); // all amenities and specifications

        for ($i = 0; $i < count($allSpecAttr); $i++) {

            $this->db->select('t1.*,t2.*');
            $this->db->from('rp_property_attribute_values t1');
            $this->db->join('rp_property_attribute_value_details t2', 't1.attrValueID=t2.attrValueID AND t1.attributeID="' . $allSpecAttr[$i]->attributeID . '" AND t1.propertyID="' . $propertyId . '" AND t2.languageID=1', 'INNER');
            $query = $this->db->get();
            $arr[] = $query->result();

            //If Amenities and specifications exits in property Start..............
            if (!empty($arr[$i][0])) {

                if (($allSpecAttr[$i]->attributeID == 6) or ( $allSpecAttr[$i]->attributeID == 177) or ( $allSpecAttr[$i]->attributeID == 174) or ( $allSpecAttr[$i]->attributeID == 175) or ( $allSpecAttr[$i]->attributeID == 180) or ( $allSpecAttr[$i]->attributeID == 161) or ( $allSpecAttr[$i]->attributeID == 155) or ( $allSpecAttr[$i]->attributeID == 197) or ( $allSpecAttr[$i]->attributeID == 182) or ( $allSpecAttr[$i]->attributeID == 179)) {

                    $this->db->select('t1.attrOptionID,t2.attrOptName');
                    $this->db->from('rp_attribute_options t1');
                    $this->db->join('rp_attribute_option_details t2', 't1.attrOptionID=t2.attrOptionID AND t1.attributeID="' . $allSpecAttr[$i]->attributeID . '" AND t2.languageID=1', 'INNER');
                    $amenities = $this->db->get();
                    $amen = $amenities->result();

                    foreach ($amen as $k => $v) {
                        $expPropertyAmenities = explode('#|#', $arr[$i][0]->attrOptionID);
                        if (in_array($v->attrOptionID, $expPropertyAmenities)) {
                            $farr[$allSpecAttr[$i]->attributeID][$v->attrOptionID] = 'Y';
                            if ($v->attrOptionID == 180) {
                                $farr[$allSpecAttr[$i]->attributeID][$v->attrOptionID] = $v->attrOptName;
                            }
                        } else {
                            $farr[$allSpecAttr[$i]->attributeID][$v->attrOptionID] = 'N';
                        }
                    }
                } else {
                    $farr[$allSpecAttr[$i]->attributeID] = array(
                        $allSpecAttr[$i]->attributeID => $arr[$i][0]->attrDetValue,
                    );
                }
            } // If Amenities and specifications exits in property END..............
            else {

                if (($allSpecAttr[$i]->attributeID == 6) or ( $allSpecAttr[$i]->attributeID == 177) or ( $allSpecAttr[$i]->attributeID == 174) or ( $allSpecAttr[$i]->attributeID == 175) or ( $allSpecAttr[$i]->attributeID == 180) or ( $allSpecAttr[$i]->attributeID == 161) or ( $allSpecAttr[$i]->attributeID == 155) or ( $allSpecAttr[$i]->attributeID == 197) or ( $allSpecAttr[$i]->attributeID == 182) or ( $allSpecAttr[$i]->attributeID == 179)) {
                    $this->db->select('t1.attrOptionID,t2.attrOptName');
                    $this->db->from('rp_attribute_options t1');
                    $this->db->join('rp_attribute_option_details t2', 't1.attrOptionID=t2.attrOptionID AND t1.attributeID="' . $allSpecAttr[$i]->attributeID . '" AND t2.languageID=1', 'INNER');
                    $amenities = $this->db->get();

                    $amen = $amenities->result();

                    foreach ($amen as $k => $v) {
                        $farr[$allSpecAttr[$i]->attributeID][$v->attrOptionID] = 'N';
                    }
                } else {
                    $farr[$allSpecAttr[$i]->attributeID] = array(
                        $allSpecAttr[$i]->attributeID => ''
                    );
                }
            }
        }
        //return $farr;	die;
        //End For Loop............................................................
        // $details['balcony_dp'] = $farr[197][197];

        if ($farr[197][960] == "Y") {
            $details['balcony_dp'] = "Marble Flooring";
        } else if ($farr[197][961] == "Y") {
            $details['balcony_dp'] = "Granite Flooring";
        } else if ($farr[197][962] == "Y") {
            $details['balcony_dp'] = "Laminated Flooring";
        } else if ($farr[197][963] == "Y") {
            $details['balcony_dp'] = "Wooden Flooring";
        } else if ($farr[197][964] == "Y") {
            $details['balcony_dp'] = "Stone Flooring";
        } else if ($farr[197][965] == "Y") {
            $details['balcony_dp'] = "Ceramic - Vitrified Tiles";
        } else if ($farr[197][966] == "Y") {
            $details['balcony_dp'] = "Anti Skid Tiles";
        } else {
            $details['balcony_dp'] = "";
        }

        if ($farr[182][880] == "Y") {
            $details['common_area'] = "Marble Flooring";
        } else if ($farr[182][881] == "Y") {
            $details['common_area'] = "Wooden Flooring";
        } else if ($farr[182][883] == "Y") {
            $details['common_area'] = "Stone Flooring";
        } else if ($farr[182][884] == "Y") {
            $details['common_area'] = "Anti skid Tiles";
        } else if ($farr[182][885] == "Y") {
            $details['common_area'] = "Laminated Flooring";
        } else if ($farr[182][958] == "Y") {
            $details['common_area'] = "Granite Flooring";
        } else if ($farr[182][959] == "Y") {
            $details['common_area'] = "Ceramic - Vitrified Tiles";
        } else {
            $details['common_area'] = "";
        }

        //print_r($details);die;
        $details['parking_type'] = $farr[148][148];
        $details['furnishing_status'] = $farr[7][7];
        $details['maintenance_frequency'] = $farr[158][158];
        $details['petsAllowed'] = $farr[166][166];
        $details['apointmentFood'] = $farr[165][165];
        $details['floorNum'] = $farr[152][152];
        $details['ownerType'] = $farr[151][151];
        $details['securityDeposit'] = $farr[160][160];
        $details['brokarageFee'] = $farr[162][162];
        $details['securityNegotiable'] = $farr[161][801];
        $details['maintainenceFee'] = $farr[157][157];
        $details['noOfFloors'] = $farr[153][153]; // this is total no floors
        $details['numOfLifts'] = $farr[172][172];
        $details['buildingAge'] = $farr[164][164];
        $details['numOfToilet'] = ($farr[3][3] == '' ? '1' : $farr[3][3]);
        $details['builtupArea'] = $farr[4][4];
        $details['carpetArea'] = $farr[154][154];
        $details['serventRoom'] = ($farr[149][149] == 'Yes' ? 'Y' : 'N'); //$farr[149][149];
        $details['balcony'] = $farr[147][147]; //($farr[147][147]=='' ? '1':$farr[147][147]);
        $details['powerBackup'] = $farr[171][171];
        $details['wifiInternet'] = $farr[6][453];
        $details['gatedCommunity'] = ($farr[170][170] == 'Yes' ? 'Y' : 'N'); //$farr[170][170];
        $details['registeredSociety'] = ($farr[169][169] == 'Yes' ? 'Y' : 'N'); //$farr[169][169];
        $details['SocietyName'] = $farr[168][168];
        $details['boundryWall'] = $farr[173][173];
        $details['mainEnterenceFacing'] = $farr[150][150];
        $details['passessionTime'] = $farr[163][163];
        $details['preferredVisitTime'] = 'Weekends';
        $details['waterSupply_municipal'] = $farr[174][840];
        $details['waterSupply_borewell'] = $farr[174][841];
        $details['prayerRoom'] = $farr[177][850];
        $details['privateTerrace'] = $farr[177][851];
        $details['solarWaterHeater'] = $farr[177][855];
        $details['smokeDetector'] = $farr[177][853];
        $details['fireHyderantSystem'] = $farr[177][854];

        $details['cctvSurvelance'] = $farr[6][584];
        $details['security'] = $farr[6][57];
        $details['clubHouse'] = $farr[6][452];
        $details['swimmingPool'] = $farr[6][549];
        $details['gym'] = $farr[6][246];
        $details['multipurposHall'] = $farr[6][575];
        $details['gardenLawn'] = $farr[6][550];
        $details['numofKitchens'] = '1';
        $details['numOfLivingRooms'] = '1';
        $details['numOfBedrooms'] = ($farr[1][1] == '' ? '1' : $farr[1][1]);
        $details['plotArea'] = $farr[2][2];
        $details['salesStatus'] = $farr[8][8];
        $details['leaseType'] = $farr[167][167];
        $details['waterBackUp_grounded_tank'] = $farr[175][842];
        $details['waterBackUp_terrace_tank'] = $farr[175][843];
        //////////////////////$details['kitchen-flooring'] = $farr[180][]
        $details['24hourswatersupply'] = $farr[6][560];
        $details['aerobicRoom'] = $farr[6][561];
        $details['amphithreater'] = $farr[6][562];
        $details['atm_or_bank'] = $farr[6][553]; //...
        $details['banquetHall'] = $farr[6][559];
        $details['barbequePit'] = $farr[6][563];
        $details['basketBall_or_TennisCourt'] = $farr[6][564];
        $details['centralizedAC'] = $farr[6][585];
        $details['confrenceRoom'] = $farr[6][373];
        $details['dayCareCenter'] = $farr[6][565];
        $details['dthTvFacilities'] = $farr[6][566];
        $details['earlyLearningCentre_playGroup'] = $farr[6][567];
        $details['golfCource'] = $farr[6][568];
        $details['guestAccomadation'] = $farr[6][569];
        $details['indoorGamesRoom'] = $farr[6][570];
        $details['indoorSquash_or_bedmintonCourt'] = $farr[6][571];
        $details['intercom'] = $farr[6][451];
        $details['kidsClub'] = $farr[6][572];
        $details['kidsPlayArea'] = $farr[6][573];
        $details['laundryService'] = $farr[6][449];
        $details['meditiationCenter'] = $farr[6][574];
        $details['pavedCompound'] = $farr[6][576];
        $details['property_or_MaintenaceStaff'] = $farr[6][551];
        $details['rainWaterHarvesting'] = $farr[6][548];
        $details['recreationalPool_or_Facilities'] = $farr[6][577];
        $details['rentableCommunitySpace'] = $farr[6][578];
        $details['reserverdParking'] = $farr[6][58];
        $details['school'] = $farr[6][552];
        $details['service_or_GoodsLift'] = $farr[6][579];
        $details['sevageTreatmentPlan'] = $farr[6][580];
        $details['shoopingCenter_or_retailShop'] = $farr[6][558];
        $details['skatingCourt'] = $farr[6][581];
        $details['strollingCycling_or_joggingTrack'] = $farr[6][582];
        $details['vaastuComplaint'] = $farr[6][450];
        $details['visitorParking'] = $farr[6][59];
        $details['waitingLounge'] = $farr[6][583];
        $details['wasteDisposal'] = $farr[6][337];
        $details['powerBackupSociety'] = $farr[6][338];

        $details['price_plc'] = $farr[155][786];
        $details['price_parking'] = $farr[155][787];
        $details['price_club'] = $farr[155][788];
        ///print_r($details);
        return $details;
    }

    public function getUIDBYAPPID($appID) {
        $this->db->select('t1.*');
        $this->db->from('rp_appointments t1');
        $this->db->where('t1.appointmentID="' . $appID . '"');
        $query = $this->db->get();
        return $query->result();
    }

    public function UpdateProperties($mobileData) {
        $data = json_decode($mobileData);
        //print_r($data);die;
        $appointmentID = $data->ap_id;
        $propertyID = $this->getPropertyId($appointmentID);
        $this->db->select('t1.*');
        $this->db->from('rp_appointments t1');
        $this->db->where('t1.appointmentID="' . $appointmentID . '"');
        $query = $this->db->get();
        $uid = $query->result();

        $an['appointmentStatus'] = $data->ap_status;
        $an['propertyNotes'] = $data->society_notes;
        $this->db->set($an);
        $this->db->where('appointmentID', $appointmentID);
        $this->db->update('rp_appointments');

        $mapAppointmentUser = $data->userid;
        $address = $data->ap_address;
        $address2 = $data->ap_address_2;
        $rppropertyDetailetable['propertyAddress1'] = $address;
        $rppropertyDetailetable['propertyAddress2'] = $address2;
        $appointmentStatus = $data->ap_status;
        $userName = $data->ap_name;
        $userPhone = $data->ap_phone;
        $ap_alternate_phone_no = $data->ap_alternate_phone_no;
        $alph['userAlternatePhone'] = $ap_alternate_phone_no;
        $this->db->set($alph);
        $this->db->where('userID', $uid[0]->userTypeID);
        $this->db->update('rp_user_details');
        $ap_email = $data->ap_email;
        $ap_pincode['propertyZipCode'] = $data->ap_pincode;

        $this->db->set($ap_pincode);
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->update('rp_properties');

        $ap_rent_ammount['propertyPrice'] = $data->ap_rent_ammount;
        $this->db->set($ap_rent_ammount);
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->update('rp_property_price');


        if (($data->ap_rent_negotiable == 'Y') || ($data->ap_rent_negotiable == 'y')) {
            $rpptable['isNegotiable'] = 'Yes';
            $this->db->set($rpptable);
            $this->db->where('propertyID', $propertyID[0]->LPID);
            $this->db->update('rp_properties');
        }

        //$ap_preferred_visit_time = $data->ap_preferred_visit_time;
        //$ap_possesion_compilation_date = $data->ap_possesion_compilation_date;

        $propertyTypeValue = $data->ap_property_type;
        if ($propertyTypeValue == '57') {
            $propertyType = '57';
        } else if ($propertyTypeValue == '58') {
            $propertyType = '58';
        } else if ($propertyTypeValue == '59') {
            $propertyType = '59';
        } else if ($propertyTypeValue == '61') {
            $propertyType = '61';
        } else if ($propertyTypeValue == '60') {
            $propertyType = '60';
        } else if ($propertyTypeValue == '62') {
            $propertyType = '62';
        } else if ($propertyTypeValue == '63') {
            $propertyType = '63';
        } else if ($propertyTypeValue == '64') {
            $propertyType = '64';
        }
        $pty['propertyTypeID'] = $propertyType;
        $pty['propertyCurrentStatus'] = $data->property_current_status;
        $this->db->set($pty);
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->update('rp_properties');

        $this->db->set($rppropertyDetailetable);
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->update('rp_property_details');

        if (strpos($data->ap_possesion_compilation_date, '-')) {
            $ap_possesion_compilation_date['possessionDate'] = $data->ap_possesion_compilation_date;
            $this->db->set($ap_possesion_compilation_date);
            $this->db->where('propertyID', $propertyID[0]->LPID);
            $this->db->update('rp_properties');
        } else if (strpos($data->ap_possesion_compilation_date, '/')) {
            $expdate = explode('/', $data->ap_possesion_compilation_date);
            $ap_possesion_compilation_date['possessionDate'] = $expdate[2] . '-' . $expdate[1] . '-' . $expdate[0];
            $this->db->set($ap_possesion_compilation_date);
            $this->db->where('propertyID', $propertyID[0]->LPID);
            $this->db->update('rp_properties');
        }
        //$specificatin[44][44] = $data->ap_advertiser_type; do

        $specificatin[1][1] = $data->ap_total_bedroom;
        $specificatin[2][2] = $data->ap_pricing_plot_area;
        $specificatin[3][3] = $data->ap_no_of_toilet;
        $specificatin[4][4] = $data->ap_builtup_area;
        $specificatin[7][7] = $data->furnishing_status;
        $specificatin[8][8] = $data->ap_pricing_sale_status;
        $specificatin[147][147] = $data->ap_total_balcony;
        $specificatin[148][148] = $data->parking_type;
        $specificatin[150][150] = $data->ap_main_entrance_facing;
        $specificatin[151][151] = $data->ap_ownership_type;
        $specificatin[152][152] = $data->ap_floor_no;
        $specificatin[153][153] = $data->ap_no_of_floor;
        $specificatin[154][154] = $data->ap_carpet_area;
        $specificatin[157][157] = $data->ap_maintainance;
        $specificatin[158][158] = $data->maintenance_frequency;
        $specificatin[160][160] = $data->ap_security_deposit;
        $specificatin[162][162] = $data->ap_brokerage_fee;
        $specificatin[164][164] = $data->ap_age_of_building;
        $specificatin[165][165] = $data->ap_food;
        $specificatin[166][166] = $data->ap_pets_allowed;
        $specificatin[167][167] = $data->ap_lease_type;
        $specificatin[168][168] = $data->ap_society_name;
        $specificatin[169][169] = ($data->ap_societydata_reg_society == 'Y' ? 'Yes' : 'No');
        $specificatin[170][170] = ($data->ap_societydata_gated_community == 'Y' ? 'Yes' : 'No');
        $specificatin[171][171] = $data->ap_power_backup;
        $specificatin[172][172] = $data->ap_no_of_lift;
        $specificatin[173][173] = $data->ap_boundary_wall;
        $specificatin[176][176] = $data->ap_kitchens->Kitchen1->platform_material;
        $specificatin[184][184] = $data->ap_total_livingroom;
        $specificatin[185][185] = $data->ap_total_kitchen;
        
        if ($data->ap_servant_room == 'Y') {
            $specificatin[149][149] = 'Yes';
        }
        //$data->ap_servant_room;	
        /* $allSpecification = $this->getAllSpecificationByPropertyID($propertyID[0]->LPID);

          $propertyAttrValueDetail = array();
          foreach($allSpecification as $spec){
          $propertyAttrValueDetail[] = $spec->attrValueID;
          }

          for($i=0;$i<count($propertyAttrValueDetail);$i++){
          $this->db->where('attrValueID', $propertyAttrValueDetail[$i]);
          $this->db->delete('rp_property_attribute_value_details');
          $this->db->where('attrValueID', $propertyAttrValueDetail[$i]);
          $this->db->where('propertyID',$propertyID[0]->LPID);
          $this->db->delete('rp_property_attribute_values');
          } */
        $filter = $propertyID[0]->LPID;
        $this->db->query("DELETE rp_property_attribute_values,rp_property_attribute_value_details FROM rp_property_attribute_values JOIN rp_property_attribute_value_details ON rp_property_attribute_value_details.attrValueID = rp_property_attribute_values.attrValueID WHERE rp_property_attribute_values.propertyID ='$filter'");

        foreach ($specificatin as $key => $value) {
            $rp_PAV = array();
            $rp_PAVD = array();
            $this->db->select('t1.attrInputType');
            $this->db->from('rp_attributes t1');
            $this->db->where('attributeID="' . $key . '"');
            $attrType = $this->db->get();
            $attributeType = $attrType->result();
            if ($attributeType[0]->attrInputType == 'textbox') {
                $rp_PAV['propertyID'] = $propertyID[0]->LPID;
                $rp_PAV['attributeID'] = $key;
                $rp_PAV['attrOptionID'] = 0;
                $this->db->insert('rp_property_attribute_values', $rp_PAV);
                $last_id = $this->db->insert_id();
                $rp_PAVD['attrValueID'] = $last_id;
                $rp_PAVD['languageID'] = 1;
                $rp_PAVD['attrDetValue'] = $value[$key];
                $this->db->insert('rp_property_attribute_value_details', $rp_PAVD);
            }
            $keyvalue = $value[$key];
            if ($attributeType[0]->attrInputType == 'select') {
                $this->db->select("t1.attrOptionID");
                $this->db->from("rp_attribute_options t1");
                $this->db->join("rp_attribute_option_details t2", "t1.attrOptionID=t2.attrOptionID AND t1.attributeID='" . $key . "' AND t2.attrOptName='" . $keyvalue . "' AND t2.languageID=1", "INNER");
                $attrType = $this->db->get();

                $attrOptionID = $attrType->result();
                if (!empty($attrOptionID)) {
                    $rp_PAV['propertyID'] = $propertyID[0]->LPID;
                    $rp_PAV['attributeID'] = $key;
                    $rp_PAV['attrOptionID'] = $attrOptionID[0]->attrOptionID;
                    $this->db->insert('rp_property_attribute_values', $rp_PAV);
                    //echo  $this->db->last_query();
                    $last_id = $this->db->insert_id();
                    $rp_PAVD['attrValueID'] = $last_id;
                    $rp_PAVD['languageID'] = 1;
                    $rp_PAVD['attrDetValue'] = $value[$key];
                    $this->db->insert('rp_property_attribute_value_details', $rp_PAVD);
                    //echo  $this->db->last_query();echo "-----";
                }
            }
        }

        $amenities[6][57] = $data->ap_societydata_security;
        $amenities[6][58] = $data->ap_society_ck_reserverd_parking;
        $amenities[6][59] = $data->ap_society_ck_visitor_parking;
        $amenities[6][246] = $data->ap_societydata_gym;
        $amenities[6][584] = $data->ap_societydata_cctv_servillance;
        $amenities[6][453] = $data->ap_wifi;
        $amenities[6][452] = $data->ap_societydata_club_house;
        $amenities[6][549] = $data->ap_societydata_swiming_pool;
        $amenities[6][550] = $data->ap_garden_lawn;
        $amenities[6][575] = $data->ap_societydata_multi_purpose;
        $amenities[6][560] = $data->ap_society_ck_24HWS;
        $amenities[6][561] = $data->ap_society_ck_aerobic_room;
        $amenities[6][562] = $data->ap_society_ck_amphithreater;
        $amenities[6][553] = $data->ap_society_ck_atm_bank;
        $amenities[6][559] = $data->ap_society_ck_banquet_hall;
        $amenities[6][563] = $data->ap_society_ck_barbeque_pit;
        $amenities[6][564] = $data->ap_society_ck_basketball_tennis_court;
        $amenities[6][585] = $data->ap_society_ck_centralized_ac;
        $amenities[6][373] = $data->ap_society_ck_conference_room;
        $amenities[6][565] = $data->ap_society_ck_day_care_center;
        $amenities[6][566] = $data->ap_society_ck_dth_tv_facility;
        $amenities[6][567] = $data->ap_society_ck_early_learning_play_group;
        $amenities[6][568] = $data->ap_society_ck_golf_cource;
        $amenities[6][569] = $data->ap_society_ck_guest_accomadation;
        $amenities[6][570] = $data->ap_society_ck_indoor_games_room;
        $amenities[6][571] = $data->ap_society_ck_indoor_bedminton_court;
        $amenities[6][451] = $data->ap_society_ck_intercom;
        $amenities[6][572] = $data->ap_society_ck_kids_club;
        $amenities[6][573] = $data->ap_society_ck_kids_play_area;
        $amenities[6][449] = $data->ap_society_ck_laundry_service;
        $amenities[6][574] = $data->ap_society_ck_meditation_center;
        $amenities[6][576] = $data->ap_society_ck_paved_comound;
        $amenities[6][551] = $data->ap_society_ck_property_maintenace_staff;
        $amenities[6][548] = $data->ap_society_ck_rain_water_harvesting;
        $amenities[6][577] = $data->ap_society_ck_recreational_facilities;
        $amenities[6][578] = $data->ap_society_ck_rentable_community_space;
        $amenities[6][552] = $data->ap_society_ck_school;
        $amenities[6][579] = $data->ap_society_ck_service_goods_lift;
        $amenities[6][580] = $data->ap_society_ck_sevage_treatment_plan;
        $amenities[6][558] = $data->ap_society_ck_shooping_retail;
        $amenities[6][581] = $data->ap_society_ck_skating_court;
        $amenities[6][582] = $data->ap_society_ck_strolling_cycling_jogging;
        $amenities[6][450] = $data->ap_society_ck_vaastu_complaint;
        $amenities[6][583] = $data->ap_society_ck_waiting_lounge;
        $amenities[6][337] = $data->ap_society_ck_waste_disposal;
        $amenities[6][338] = $data->ap_society_ck_power_backup;
        //print_r($amenities);die;
        $mislanious[177][850] = $data->ap_prayer_room;
        $mislanious[177][851] = $data->ap_private_terrace;
        $mislanious[177][853] = $data->ap_societydata_smoke_detector;
        $mislanious[177][854] = $data->ap_societydata_fire_hydrant_system;
        $mislanious[177][855] = $data->ap_solar_heater;
        foreach ($mislanious[177] as $k1 => $v1) {
            if ($v1 == 'Y') {
                $MisamenitiesOptionIDs[] = $k1;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $k1 . '" and t1.languageID=1');
                $query = $this->db->get();
                $optionValue1 = $query->result();
                $MisamentiesValue[] = $optionValue1[0]->attrOptName;
            }
        }
        if (!(empty($MisamenitiesOptionIDs)) && !(empty($MisamentiesValue))) {
            $MisamenitiesOption = implode('#|#', $MisamenitiesOptionIDs);
            $amentiesval = implode('#|#', $MisamentiesValue);
            $Misamentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $Misamentiesrp_PAV['attributeID'] = 177;
            $Misamentiesrp_PAV['attrOptionID'] = $MisamenitiesOption;
            $this->db->insert('rp_property_attribute_values', $Misamentiesrp_PAV);
            $lOne = $this->db->insert_id();
            $Misamentiesrp_PAVD['attrValueID'] = $lOne;
            $Misamentiesrp_PAVD['languageID'] = 1;
            $Misamentiesrp_PAVD['attrDetValue'] = $amentiesval;
            $this->db->insert('rp_property_attribute_value_details', $Misamentiesrp_PAVD);
        }
        
        $waterBackup[175][842] = $data->ap_waterbackup_grounded_tank;
        $waterBackup[175][843] = $data->ap_waterbackup_terrace_tank;

        foreach ($waterBackup[175] as $key => $value) {
            if ($value == 'Y') {
                $waterBackamenitiesOptionIDs[] = $key;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $key . '"');
                $query = $this->db->get();
                $opVal = $query->result();
                $waterBackamentiesValue[] = $opVal[0]->attrOptName;
            }
        }

        if (!(empty($waterBackamenitiesOptionIDs)) && !(empty($waterBackamentiesValue))) {
            $WaterBackMisamenitiesOption = implode('#|#', $waterBackamenitiesOptionIDs);
            $WaterBackupamentiesval = implode('#|#', $waterBackamentiesValue);
            $WaterBackMisamentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $WaterBackMisamentiesrp_PAV['attributeID'] = 175;
            $WaterBackMisamentiesrp_PAV['attrOptionID'] = $WaterBackMisamenitiesOption;
            $this->db->insert('rp_property_attribute_values', $WaterBackMisamentiesrp_PAV);
            $last_id = $this->db->insert_id();
            $WaterBackMisamentiesrp_PAVD['attrValueID'] = $last_id;
            $WaterBackMisamentiesrp_PAVD['languageID'] = 1;
            $WaterBackMisamentiesrp_PAVD['attrDetValue'] = $WaterBackupamentiesval;
            $this->db->insert('rp_property_attribute_value_details', $WaterBackMisamentiesrp_PAVD);
        }
        $waterSupply[174][840] = $data->ap_water_supply_municipal;
        $waterSupply[174][841] = $data->ap_water_supply_borewell;
        foreach ($waterSupply[174] as $key => $value) {
            if ($value == 'Y') {
                $waterSupplyamenitiesOptionIDs[] = $key;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $key . '" and t1.languageID=1');
                $query = $this->db->get();
                //echo $this->db->last_query();
                $opVal = $query->result();

                $waterSupplyamentiesValue[] = $opVal[0]->attrOptName;
            }
        }
        //print_r($waterSupplyamenitiesOptionIDs);
        // print_r($waterSupplyamentiesValue);
        // die;
        if (!(empty($waterSupplyamenitiesOptionIDs)) && !(empty($waterSupplyamentiesValue))) {
            $WaterMisamenitiesOption = implode('#|#', $waterSupplyamenitiesOptionIDs);
            $Wateramentiesval = implode('#|#', $waterSupplyamentiesValue);
            $WaterMisamentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $WaterMisamentiesrp_PAV['attributeID'] = 174;
            $WaterMisamentiesrp_PAV['attrOptionID'] = $WaterMisamenitiesOption;
            $this->db->insert('rp_property_attribute_values', $WaterMisamentiesrp_PAV);
            //echo $this->db->last_query();
            $last_id = $this->db->insert_id();
            $WaterMisamentiesrp_PAVD['attrValueID'] = $last_id;
            $WaterMisamentiesrp_PAVD['languageID'] = 1;
            $WaterMisamentiesrp_PAVD['attrDetValue'] = $Wateramentiesval;
            $this->db->insert('rp_property_attribute_value_details', $WaterMisamentiesrp_PAVD);
        }
        $priceInclude[155][786] = $data->price_plc;
        $priceInclude[155][787] = $data->price_parking;
        $priceInclude[155][788] = $data->price_club;
        foreach ($priceInclude[155] as $key => $value) {
            if ($value == 'Y' || $value == 'y') {
                $priceIncludeOptionIDs[] = $key;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $key . '" and t1.languageID=1');
                $query = $this->db->get();
                $opVal = $query->result();
                $priceIncludeValue[] = $opVal[0]->attrOptName;
            }
        }
        //print_r($priceIncludeOptionIDs);print_r($priceIncludeValue);die;
        if (!(empty($priceIncludeOptionIDs)) && !(empty($priceIncludeValue))) {
            $priceIncludeamenitiesOption = implode('#|#', $priceIncludeOptionIDs);
            $priceIncludeamentiesval = implode('#|#', $priceIncludeValue);
            $priceIncludeamentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $priceIncludeamentiesrp_PAV['attributeID'] = 155;
            $priceIncludeamentiesrp_PAV['attrOptionID'] = $priceIncludeamenitiesOption;
            $this->db->insert('rp_property_attribute_values', $priceIncludeamentiesrp_PAV);
            //echo $this->db->last_query();
            $l = $this->db->insert_id();
            $priceIncludeamentiesrp_PAVD['attrValueID'] = $l;
            $priceIncludeamentiesrp_PAVD['languageID'] = 1;
            $priceIncludeamentiesrp_PAVD['attrDetValue'] = $priceIncludeamentiesval;
            $this->db->insert('rp_property_attribute_value_details', $priceIncludeamentiesrp_PAVD);
            //echo $this->db->last_query();
        }
        if ($data->balcony == "Marble Flooring") {
            $balconyFlooring[197][960] = $data->balcony;
        }if ($data->balcony == "Granite Flooring") {
            $balconyFlooring[197][961] = $data->balcony;
        }if ($data->balcony == "Laminated Flooring") {
            $balconyFlooring[197][962] = $data->balcony;
        }if ($data->balcony == "Wooden Flooring") {
            $balconyFlooring[197][963] = $data->balcony;
        }if ($data->balcony == "Stone Flooring") {
            $balconyFlooring[197][964] = $data->balcony;
        }if ($data->balcony == "Ceramic - Vitrified Tiles") {
            $balconyFlooring[197][965] = $data->balcony;
        }if ($data->balcony == "Anti Skid Tiles") {
            $balconyFlooring[197][966] = $data->balcony;
        }
        // print_r($balconyFlooring[197]);die;
        if (isset($balconyFlooring[197])) {
            foreach ($balconyFlooring[197] as $key => $value) {
                //print_r($key); print_r($value);
                $balconyFlooring_PAV['propertyID'] = $propertyID[0]->LPID;
                $balconyFlooring_PAV['attributeID'] = 197;
                $balconyFlooring_PAV['attrOptionID'] = $key;
                $this->db->insert('rp_property_attribute_values', $balconyFlooring_PAV);
                $last_id = $this->db->insert_id();
                $balconyFlooring_PAVD['attrValueID'] = $last_id;
                $balconyFlooring_PAVD['languageID'] = 1;
                $balconyFlooring_PAVD['attrDetValue'] = $value;
                $this->db->insert('rp_property_attribute_value_details', $balconyFlooring_PAVD);
            }
        }

        if ($data->common_area == "Marble Flooring") {
            $commonarea[182][880] = $data->common_area;
        }if ($data->common_area == "Wooden Flooring") {
            $commonarea[182][881] = $data->common_area;
        }if ($data->common_area == "Stone Flooring") {
            $commonarea[182][883] = $data->common_area;
        }if ($data->common_area == "Anti skid Tiles") {
            $commonarea[182][884] = $data->common_area;
        }if ($data->common_area == "Laminated Flooring") {
            $commonarea[182][885] = $data->common_area;
        }if ($data->common_area == "Granite Flooring") {
            $commonarea[182][958] = $data->common_area;
        }if ($data->common_area == "Ceramic - Vitrified Tiles") {
            $commonarea[182][959] = $data->common_area;
        }
        if (isset($commonarea[182])) {
            foreach ($commonarea[182] as $key => $value) {
                $commonarea_PAV['propertyID'] = $propertyID[0]->LPID;
                $commonarea_PAV['attributeID'] = 182;
                $commonarea_PAV['attrOptionID'] = $key;
                $this->db->insert('rp_property_attribute_values', $commonarea_PAV);

                $last_id = $this->db->insert_id();
                $commonarea_PAVD['attrValueID'] = $last_id;
                $commonarea_PAVD['languageID'] = 1;
                $commonarea_PAVD['attrDetValue'] = $value;
                $this->db->insert('rp_property_attribute_value_details', $commonarea_PAVD);
            }
        }
        $securityNegotiable[161][801] = $data->ap_security_negotiable;
        foreach ($securityNegotiable[161] as $key => $value) {
            if ($value == 'Y' || $value == 'y') {
                $securityNegotiableOptionIDs[] = $key;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $key . '"');
                $query = $this->db->get();
                $opVal = $query->result();
                $securityNegotiableValue[] = $opVal[0]->attrOptName;
            }
        }
        if (!(empty($securityNegotiableOptionIDs)) && !(empty($securityNegotiableValue))) {
            $securityNegotiableOption = implode('#|#', $securityNegotiableOptionIDs);
            $securityNegotiableval = implode('#|#', $securityNegotiableValue);
            $securityNegotiable_PAV['propertyID'] = $propertyID[0]->LPID;
            $securityNegotiable_PAV['attributeID'] = 161;
            $securityNegotiable_PAV['attrOptionID'] = $securityNegotiableOption;
            $this->db->insert('rp_property_attribute_values', $securityNegotiable_PAV);
            $last_id = $this->db->insert_id();
            $securityNegotiable_PAVD['attrValueID'] = $last_id;
            $securityNegotiable_PAVD['languageID'] = 1;
            $securityNegotiable_PAVD['attrDetValue'] = $securityNegotiableval;
            $this->db->insert('rp_property_attribute_value_details', $securityNegotiable_PAVD);
        }

        $propertyAttrValueDetailAmenities = array();

        foreach ($amenities[6] as $key => $value) {
            if ($value == 'Y' || $value == 'y') {
                $amenitiesOptionIDs[] = $key;
                $this->db->select('t1.attrOptName');
                $this->db->from('rp_attribute_option_details t1');
                $this->db->where('attrOptionID="' . $key . '"');
                $query = $this->db->get();
                $opVal = $query->result();
                $amentiesValue[] = $opVal[0]->attrOptName;
            }
        }
        if (!(empty($amenitiesOptionIDs)) && !(empty($amentiesValue))) {
            $amenitiesOption = implode('#|#', $amenitiesOptionIDs);
            $amentiesval = implode('#|#', $amentiesValue);
            $amentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $amentiesrp_PAV['attributeID'] = 6;
            $amentiesrp_PAV['attrOptionID'] = $amenitiesOption;
            $this->db->insert('rp_property_attribute_values', $amentiesrp_PAV);
            $last_id = $this->db->insert_id();
            $amentiesrp_PAVD['attrValueID'] = $last_id;
            $amentiesrp_PAVD['languageID'] = 1;
            $amentiesrp_PAVD['attrDetValue'] = $amentiesval;
            $this->db->insert('rp_property_attribute_value_details', $amentiesrp_PAVD);
        }

		
		
		
        $acCount = 0;
        $bedCount = 0;
        $tvCount = 0;
        $wardrobeCount = 0;
        $sofaCount = 0;
        $dinningCount = 0;
        $refrigeratorCount = 0;
        $washingmachineCount = 0;
        $microwaveCount = 0;
        $modularKitchenCount = 0;
        $waterpurifierCount = 0;
        $electricchimneyCount = 0;
        $geyserCount = 0;
		
		/*Living Room*/
	
        if ($data->ap_living_room->LivingRoom1->flooring_type == 'Marble Flooring') {
            $livingflooringDropdown[179][863] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Wooden Flooring') {
            $livingflooringDropdown[179][864] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Stone Flooring') {
            $livingflooringDropdown[179][866] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Anti skid Tiles') {
            $livingflooringDropdown[179][867] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Laminated Flooring') {
            $livingflooringDropdown[179][868] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Granite Flooring') {
            $livingflooringDropdown[179][952] = $data->ap_living_room->LivingRoom1->flooring_type;
        } else if ($data->ap_living_room->LivingRoom1->flooring_type == 'Ceramic - Vitrified Tiles') {
            $livingflooringDropdown[179][953] = $data->ap_living_room->LivingRoom1->flooring_type;
        }

        if (isset($livingflooringDropdown[179])) {
            $key = key($livingflooringDropdown[179]);
            $livingflooringDropdown_PAV['propertyID'] = $propertyID[0]->LPID;
            $livingflooringDropdown_PAV['attributeID'] = 179;
            $livingflooringDropdown_PAV['attrOptionID'] = $key;
            $this->db->insert('rp_property_attribute_values', $livingflooringDropdown_PAV);
            $lTwo = $this->db->insert_id();
            $livingflooringDropdown_PAVD['attrValueID'] = $lTwo;
            $livingflooringDropdown_PAVD['languageID'] = 1;
            $livingflooringDropdown_PAVD['attrDetValue'] = $livingflooringDropdown[179][$key];
            $this->db->insert('rp_property_attribute_value_details', $livingflooringDropdown_PAVD);
            //echo $this->db->last_query();                    
        }		
        $livingRoom = array();
        $Lvalue = '';
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->delete('rp_dbho_living_room');
        foreach ($data->ap_living_room as $key => $value) {

            if ($value->sofa == 'Y' || $value->sofa == 'y') {
                $Lvalue .= 'Sofa,';
                $sofaCount = $sofaCount + 1;
            }if ($value->dining_table == 'Y' || $value->dining_table == 'y') {
                $Lvalue .= 'DiningTable,';
                $dinningCount = $dinningCount + 1;
            }if ($value->ac == 'Y' || $value->ac == 'y') {
                $Lvalue .= 'AC,';
                $acCount = $acCount + 1;
            }if ($value->tv == 'Y' || $value->tv == 'y') {
                $Lvalue .= 'TV,';
                $tvCount = $tvCount + 1;
            }if ($value->shoe_rack == 'Y' || $value->shoe_rack == 'y') {
                $Lvalue .= 'ShoeRack,';
            }if ($value->false_ceiling == 'Y' || $value->false_ceiling == 'y') {
                $Lvalue .= 'FalseCeiling,';
            }
            $livingRoom['propertyID'] = $propertyID[0]->LPID;
            $livingRoom['flooringType'] = $value->flooring_type;
            $livingRoom['others'] = rtrim($Lvalue, ',');
            $livingRoom['updatedOn'] = date('Y-m-d H:i:s');
            $livingRoom['updatedBy'] = $mapAppointmentUser;

            $this->db->insert('rp_dbho_living_room', $livingRoom);
            $Lvalue = '';
        }
		/* End Living Room */
		
        /* .........Kitchen........... */

        if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Marble Flooring') {
            $kitchenAmenities[180][869] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Wooden Flooring') {
            $kitchenAmenities[180][870] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Stone Flooring') {
            $kitchenAmenities[180][872] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Anti Skid Tiles') {
            $kitchenAmenities[180][873] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Laminated Flooring') {
            $kitchenAmenities[180][874] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Granite Flooring') {
            $kitchenAmenities[180][954] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        } else if ($data->ap_kitchens->Kitchen1->kitchen_flooring == 'Ceramic - Vitrified Tiles') {
            $kitchenAmenities[180][955] = $data->ap_kitchens->Kitchen1->kitchen_flooring;
        }

        if (isset($kitchenAmenities[180])) {
            $key = key($kitchenAmenities[180]);
            $KitchenMisamentiesrp_PAV['propertyID'] = $propertyID[0]->LPID;
            $KitchenMisamentiesrp_PAV['attributeID'] = 180;
            $KitchenMisamentiesrp_PAV['attrOptionID'] = $key;
            $this->db->insert('rp_property_attribute_values', $KitchenMisamentiesrp_PAV);
            $lTwo = $this->db->insert_id();
            $KitchenMisamentiesrp_PAVD['attrValueID'] = $lTwo;
            $KitchenMisamentiesrp_PAVD['languageID'] = 1;
            $KitchenMisamentiesrp_PAVD['attrDetValue'] = $kitchenAmenities[180][$key];
            $this->db->insert('rp_property_attribute_value_details', $KitchenMisamentiesrp_PAVD);
        }
        $kitchen = array();
        $Lvalue = '';
        $k = 0;
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->delete('rp_dbho_kitchen');
        foreach ($data->ap_kitchens as $key => $value) {

            if ($value->cabinet == 'Modular') {
               // $Lvalue .= 'Cabinet,';
                $modularKitchenCount = $modularKitchenCount + 1;
                $k = 1;
            }
            
            if ($value->gas_pipeline == 'Y' || $value->gas_pipeline == 'y') {
                $Lvalue .= 'GasPipeline,';
            }if ($value->refrigerator == 'Y' || $value->refrigerator == 'y') {
                $Lvalue .= 'Refrigerator,';
                $refrigeratorCount = $refrigeratorCount + 1;
            }if ($value->water_purifier == 'Y' || $value->water_purifier == 'y') {
                $Lvalue .= 'Waterpurifier,';
                $waterpurifierCount = $waterpurifierCount + 1;
            }if ($value->microwave == 'Y' || $value->microwave == 'y') {
                $Lvalue .= 'Microwave,';
                $microwaveCount = $microwaveCount + 1;
            }if ($value->loft == 'Y' || $value->loft == 'y') {
                $Lvalue .= 'Loft,';
            }if ($value->chimney_exhaust == 'Y' || $value->chimney_exhaust == 'y') {
                $Lvalue .= 'ChimneyExhaust,';
                $electricchimneyCount = $electricchimneyCount + 1;
            }
            if ($k == 1) {
                $furnishingArr[183][939] = 'Modular Kitchen';
            }
            if (isset($value->kitchen_flooring)) {
                $kitchen_flooring = $value->kitchen_flooring;
            } else {
                $kitchen_flooring = "Marble Flooring";
            }
            ;
            $kitchen['propertyID'] = $propertyID[0]->LPID;
            $kitchen['platformType'] = $kitchen_flooring;
            $kitchen['cabinet'] = $value->cabinet;
            $kitchen['others'] = rtrim($Lvalue, ',');
            $kitchen['updatedOn'] = date('Y-m-d H:i:s');
            $kitchen['updatedBy'] = $mapAppointmentUser;

            $this->db->insert('rp_dbho_kitchen', $kitchen);
            $Lvalue = '';
        }
		/* End Kitchen*/
		
        /* .........Toilet........... */

        foreach ($data->ap_toilets as $key11 => $value11) {
            if ($value11->flooring_type == 'Marble Flooring') {
                $bathroomFlooringDropdown[875][] = $value11->flooring_type;
            } else if ($value11->flooring_type == 'Stone Flooring') {
                $bathroomFlooringDropdown[877][] = $value11->flooring_type;
            } else if ($value11->flooring_type == 'Anti skid Tiles') {
                $bathroomFlooringDropdown[878][] = $value11->flooring_type;
            } else if ($value11->flooring_type == 'Granite Flooring') {
                $bathroomFlooringDropdown[956][] = $value11->flooring_type;
            } else if ($value11->flooring_type == 'Ceramic - Vitrified Tiles') {
                $bathroomFlooringDropdown[957][] = $value11->flooring_type;
            }
        }
         $an=1;
        foreach($bathroomFlooringDropdown as $key=>$value){
            if($an < count($bathroomFlooringDropdown)){
            $optionsIDs .= $key."#|#";
            $optionValuean .= $value[0]."#|#";
            }
            else {
                $optionsIDs .= $key;
                $optionValuean .= $value[0];
            }
            $an++;
        }
        
        if (isset($optionsIDs)) {  
            $bathroomFlooringDropdown_PAV['propertyID'] = $propertyID[0]->LPID;
            $bathroomFlooringDropdown_PAV['attributeID'] = 181;
            $bathroomFlooringDropdown_PAV['attrOptionID'] = $optionsIDs;
            $this->db->insert('rp_property_attribute_values', $bathroomFlooringDropdown_PAV);
            $lastThree = $this->db->insert_id();
            $bathroomFlooringDropdown_PAVD['attrValueID'] = $lastThree;
            $bathroomFlooringDropdown_PAVD['languageID'] = 1;
            $bathroomFlooringDropdown_PAVD['attrDetValue'] = $optionValuean;
            $this->db->insert('rp_property_attribute_value_details', $bathroomFlooringDropdown_PAVD);                    
        }
		
		$toilets = array();
        $Lvalue = '';
        $t = 0;
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->delete('rp_dbho_bath_room');
        foreach ($data->ap_toilets as $key => $value) {

            if ($value->glass_partition == 'Y' || $value->glass_partition == 'y') {
                $Lvalue .= 'GlassPartition,';
            }if ($value->shower_curtain == 'Y' || $value->shower_curtain == 'y') {
                $Lvalue .= 'ShowerCurtain,';
            }if ($value->bath_tub == 'Y' || $value->bath_tub == 'y') {
                $Lvalue .= 'BathTub,';
            }if ($value->cabinet == 'Y' || $value->cabinet == 'y') {
                $Lvalue .= 'Cabinet,';
            }if ($value->window == 'Y' || $value->window == 'y') {
                $Lvalue .= 'Window,';
            }if ($value->exhaust_fan == 'Y' || $value->exhaust_fan == 'y') {
                $Lvalue .= 'ExhaustFan,';
            }if ($value->type == 'Common' || $value->type == 'common') {
                $Lvalue .= 'Common,';
            }if ($value->type == 'Attached' || $value->type == 'attached') {
                $Lvalue .= 'Attached,';
            }if ($value->geyser == 'Y' || $value->geyser == 'y') {
                $Lvalue .= 'Geyser,';
                $geyserCount = $geyserCount + 1;
            }if ($value->washing_machine == 'Y' || $value->washing_machine == 'y') {
                $Lvalue .= 'Washingmachine,';
                $t = 1;
                $washingmachineCount = $washingmachineCount + 1;
            }

            if ($t == 1) {
                $furnishingArr[183][937] = 'Washing Machine';
            }
			$toilets['bathroomKey'] = $value->id;
            $toilets['propertyID'] = $propertyID[0]->LPID;
            $toilets['flooringType'] = $value->flooring_type;
            $toilets['others'] = rtrim($Lvalue, ',');
            $toilets['updatedOn'] = date('Y-m-d H:i:s');
            $toilets['updatedBy'] = $mapAppointmentUser;
            //$toilets['hotwatersupply'] =  $value->hot_water_supply;
            $toilets['toilet'] = $value->style;

            $this->db->insert('rp_dbho_bath_room', $toilets);
            $Lvalue = '';
        }

        /* .........Bed rooms........... */
		foreach ($data->ap_bedrooms as $key113 => $value113) {
            if ($value113->flooring_type == 'Marble Flooring') {
                $bedroomFlooringDropdown[857][] = $value113->flooring_type;
            } else if ($value113->flooring_type == 'Wooden Flooring') {
                $bedroomFlooringDropdown[858][] = $value113->flooring_type;
            } else if ($value113->flooring_type == 'Stone Flooring') {
                $bedroomFlooringDropdown[860][] = $value113->flooring_type;
            } else if ($value113->flooring_type == 'Anti skid Tiles') {
                $bedroomFlooringDropdown[861][] = $value113->flooring_type;
            } else if ($value113->flooring_type == 'Ceramic - Vitrified Tiles') {
                $bedroomFlooringDropdown[950][] = $value113->flooring_type;
            }else if ($value113->flooring_type == 'Granite Flooring') {
                $bedroomFlooringDropdown[951][] = $value113->flooring_type;
            }
        }
       
         $a=1;$optionsIDs = ''; $optionValuean='';
        foreach($bedroomFlooringDropdown as $key1=>$value1){
           
            if($a < count($bedroomFlooringDropdown)){
            $optionsIDs .= $key1."#|#";
            $optionValuean .= $value1[0]."#|#";
            }
            else {
                $optionsIDs .= $key1;
                $optionValuean .= $value1[0];
            }
            $a++;
        }
       // echo $optionsIDs;echo $optionValuean;die;
        if (isset($optionsIDs)) {
  
            $bedroomFlooringDropdown_PAV['propertyID'] = $propertyID[0]->LPID;
            $bedroomFlooringDropdown_PAV['attributeID'] = 178;
            $bedroomFlooringDropdown_PAV['attrOptionID'] = $optionsIDs;
            $this->db->insert('rp_property_attribute_values', $bedroomFlooringDropdown_PAV);
            $lastThree = $this->db->insert_id();
            $bedroomFlooringDropdown_PAVD['attrValueID'] = $lastThree;
            $bedroomFlooringDropdown_PAVD['languageID'] = 1;
            $bedroomFlooringDropdown_PAVD['attrDetValue'] = $optionValuean;
            $this->db->insert('rp_property_attribute_value_details', $bedroomFlooringDropdown_PAVD);                   
        }		
        $bedrooms = array();
        $Lvalue = '';
        $this->db->where('propertyID', $propertyID[0]->LPID);
        $this->db->delete('rp_dbho_bed_room');
        foreach ($data->ap_bedrooms as $key => $value) {

            if ($value->bed == 'Y' || $value->bed == 'y') {
                $Lvalue .= 'Bed,';
                $bedCount = $bedCount + 1;
            }if ($value->ac == 'Y' || $value->ac == 'y') {
                $Lvalue .= 'AC,';
                $acCount = $acCount + 1;
            }if ($value->tv == 'Y' || $value->tv == 'y') {
                $Lvalue .= 'TV,';
                $tvCount = $tvCount + 1;
            }if ($value->dressing_table == 'Y' || $value->dressing_table == 'y') {
                $Lvalue .= 'DressingTable,';
            }if ($value->wardrobe == 'Y' || $value->wardrobe == 'y') {
                $Lvalue .= 'Wardrobe,';
                $wardrobeCount = $wardrobeCount + 1;
            }if ($value->attached_balconey == 'Y' || $value->attached_balconey == 'y') {
                $Lvalue .= 'AttachedBalcony,';
            }if ($value->attached_bathroom == 'Y' || $value->attached_bathroom == 'y') {
                $Lvalue .= 'AttachedBathroom,';
            }if ($value->false_ceiling == 'Y' || $value->false_ceiling == 'y') {
                $Lvalue .= 'FalseCeiling,';
            }if ($value->window == 'Y' || $value->window == 'y') {
                $Lvalue .= 'Window,';
            }
			$bedrooms['bedroomKey'] = $value->id;
            $bedrooms['propertyID'] = $propertyID[0]->LPID;
            $bedrooms['flooringType'] = $value->flooring_type;
            $bedrooms['others'] = rtrim($Lvalue, ',');
            $bedrooms['updatedOn'] = date('Y-m-d H:i:s');
            $bedrooms['updatedBy'] = $mapAppointmentUser;

            $this->db->insert('rp_dbho_bed_room', $bedrooms);
            $Lvalue = '';
        }
        if ($acCount == 0) {
            $furnishingArr[183][907] = 'No AC';
        } else if ($acCount == 1) {
            $furnishingArr[183][886] = '1 AC';
        } else if ($acCount == 2) {
            $furnishingArr[183][902] = '2 AC';
        } else if ($acCount == 3) {
            $furnishingArr[183][903] = '3 AC';
        } else if ($acCount == 4) {
            $furnishingArr[183][904] = '4 AC';
        } else if ($acCount == 5) {
            $furnishingArr[183][905] = '5 AC';
        } else if ($acCount >= 5) {
            $furnishingArr[183][906] = '5+ AC';
        }

        if ($bedCount == 0) {
            $furnishingArr[183][914] = 'No Bed';
        } else if ($bedCount == 1) {
            $furnishingArr[183][908] = '1 Bed';
        } else if ($bedCount == 2) {
            $furnishingArr[183][909] = '2 Bed';
        } else if ($bedCount == 3) {
            $furnishingArr[183][910] = '3 Bed';
        } else if ($bedCount == 4) {
            $furnishingArr[183][911] = '4 Bed';
        } else if ($bedCount == 5) {
            $furnishingArr[183][913] = '5 Bed';
        } else if ($bedCount >= 5) {
            $furnishingArr[183][913] = '5+ Bed';
        }
        if ($tvCount == 0) {
            $furnishingArr[183][921] = 'No TV';
        } else if ($tvCount == 1) {
            $furnishingArr[183][915] = '1 TV';
        } else if ($tvCount == 2) {
            $furnishingArr[183][916] = '2 TV';
        } else if ($tvCount == 3) {
            $furnishingArr[183][917] = '3 TV';
        } else if ($tvCount == 4) {
            $furnishingArr[183][918] = '4 TV';
        } else if ($tvCount == 5) {
            $furnishingArr[183][919] = '5 TV';
        } else if ($tvCount >= 5) {
            $furnishingArr[183][920] = '5+ TV';
        }
        if ($wardrobeCount == 0) {
            $furnishingArr[183][933] = 'No Wardrobe';
        } else if ($wardrobeCount == 1) {
            $furnishingArr[183][922] = '1 Wardrobe';
        } else if ($wardrobeCount == 2) {
            $furnishingArr[183][923] = '2 Wardrobe';
        } else if ($wardrobeCount == 3) {
            $furnishingArr[183][924] = '3 Wardrobe';
        } else if ($wardrobeCount == 4) {
            $furnishingArr[183][925] = '4 Wardrobe';
        } else if ($wardrobeCount == 5) {
            $furnishingArr[183][926] = '5 Wardrobe';
        } else if ($wardrobeCount >= 5) {
            $furnishingArr[183][932] = '5+ Wardrobe';
        }
        if ($geyserCount == 0) {
            $furnishingArr[183][948] = 'No Geyser';
        } else if ($geyserCount == 1) {
            $furnishingArr[183][942] = '1 Geyser';
        } else if ($geyserCount == 2) {
            $furnishingArr[183][943] = '2 Geyser';
        } else if ($geyserCount == 3) {
            $furnishingArr[183][944] = '3 Geyser';
        } else if ($geyserCount == 4) {
            $furnishingArr[183][945] = '4 Geyser';
        } else if ($geyserCount == 5) {
            $furnishingArr[183][946] = '5 Geyser';
        } else if ($geyserCount >= 5) {
            $furnishingArr[183][947] = '5+ Geyser';
        }

        if ($sofaCount != 0) {
            $furnishingArr[183][934] = 'Sofa';
        }
        if ($dinningCount != 0) {
            $furnishingArr[183][935] = 'Dining Table';
        }
        if ($refrigeratorCount != 0) {
            $furnishingArr[183][936] = 'Refrigerator';
        }
        if ($washingmachineCount != 0) {
            $furnishingArr[183][937] = 'Washing Machine';
        }
        if ($microwaveCount != 0) {
            $furnishingArr[183][938] = 'Microwave';
        }
        if ($modularKitchenCount != 0) {
            $furnishingArr[183][939] = 'Modular Kitchen';
        }
        if ($waterpurifierCount != 0) {
            $furnishingArr[183][940] = 'Water Purifier';
        }
        if ($electricchimneyCount != 0) {
            $furnishingArr[183][941] = 'Electric Chimney';
        }
        $ids = '';
        $value = '';
        $i = 1;
        foreach ($furnishingArr[183] as $k => $v) {
            if ($i < count($furnishingArr[183])) {
                $ids .= $k . '#|#';
                $value .= $v . '#|#';
            } else {
                $ids .= $k;
                $value .= $v;
            }
            $i++;
        }
        $furnishing_PAV['propertyID'] = $propertyID[0]->LPID;
        $furnishing_PAV['attributeID'] = 183;
        $furnishing_PAV['attrOptionID'] = $ids;
        $this->db->insert('rp_property_attribute_values', $furnishing_PAV);
        $last_id = $this->db->insert_id();
        $furnishing_PAVD['attrValueID'] = $last_id;
        $furnishing_PAVD['languageID'] = 1;
        $furnishing_PAVD['attrDetValue'] = $value;
        $this->db->insert('rp_property_attribute_value_details', $furnishing_PAVD);
		
		$this->db->select("t1.*");
		$this->db->from('rp_dbho_plan_mapping t1');
		$this->db->where('t1.objectID="'.$propertyID[0]->LPID.'" and t1.objectType="property"');
		$query = $this->db->get();
		$isVerifiedCheck = $query->result();
		$planMapping = array();
		if($isVerifiedCheck){
			$planMapping['isVerified'] = 1;
			$this->db->set($planMapping);
            $this->db->where('objectID', $propertyID[0]->LPID);
			$this->db->where('objectType', 'property');
            $this->db->update('rp_dbho_plan_mapping');
		}
        return true;
    }

}

?>