<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

define('DEBUG_MODE', 'Off');
 
require_once('class_logger.php');
require_once('obdb.php');
require_once('class_property.php');
require_once('class_appointment.php');
require_once('class_mappings.php');

// Begin script
debug_message('Script begin.');

/**
 *	Save the Agent information
 */
$ra = @$_SERVER['REMOTE_ADDR'];
$hua = @$_SERVER['HTTP_USER_AGENT'];

$ob_log->write("Remote IP: {$ra}");
$ob_log->write("Remote User Agents: {$hua}");


/***

Availble variables
	$ob_property
	$ob_appointment 
*/

$ob_map = new Mapping();

// Get all appointments whose status is complete
// To do - This should go in the Appointment class
$results = $ob_appointment::get_complted_appointments();
$count = count($results);

$ob_log->write("Total {$count} completed appointment found.");

// Go through each result
foreach($results as $key => $result) {
	$ap_details = array();
	$ai_details = array();
	$aw_details = array();
	$ak_details = array();
	$ab_details = array();
	$at_details = array();
	$al_details = array();
	
	// Get the appointment details
	$app_output .= "Detail : \n";
		
	$ad_results = $ob_appointment::get_appointment_data('app_details', $result['appointmentID']);
	
	foreach($ad_results as $ad_key => $ad_result) {
		$app_output .= print_r($ad_result, 1);
		$ap_details[] = $ad_result;
	}
	$ob_log->write("Get details data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment images
	$app_output .= "Images : \n";
	$ai_results = $ob_appointment::get_appointment_data('app_images', $result['appointmentID'], 'appointment_id');
	
	foreach($ai_results as $ai_key => $ai_result) {
		$app_output .= print_r($ai_result, 1);
		$ai_details[] = $ai_result;
	}
	$ob_log->write("Get images data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment Kitchens
	$app_output .= "Kitchens : \n";	
	$ak_results = $ob_appointment::get_appointment_data('app_kitchens', $result['appointmentID']);
	
	foreach($ak_results as $ak_key => $ak_result) {
		$app_output .= print_r($ai_result, 1);
		$ak_details[] = $ak_result;
	}
	$ob_log->write("Get kitchens data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment Livingroom	
	$app_output .= "Livingroom : \n";	
	$ai_results = $ob_appointment::get_appointment_data('app_livingroom', $result['appointmentID']);
	
	foreach($ai_results as $ai_key => $ai_result) {
		$app_output .= print_r($ai_result, 1);
		$al_details[] = $ai_result;
	}
	$ob_log->write("Get living rooms data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment Toilets	
	$app_output .= "Toilets : \n";	
	$ai_results = $ob_appointment::get_appointment_data('app_toilets', $result['appointmentID']);
	
	foreach($ai_results as $ai_key => $ai_result) {
		$app_output .= print_r($ai_result, 1);
		$at_details[] = $ai_result;
	}
	$ob_log->write("Get toilets data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment Bedroom	
	$app_output .= "Bedroom : \n";
	$ai_results = $ob_appointment::get_appointment_data('app_bedrooms', $result['appointmentID']);
	
	foreach($ai_results as $ai_key => $ai_result) {
		$app_output .= print_r($ai_result, 1);
		$ab_details[] = $ai_result;
	}
	$ob_log->write("Get bedrooms data for appointmentID: {$result['appointmentID']} ");
	
	// Get the appointment Washdry area	
	/*$app_output .= "Washdry Area: \n";
	$ai_results = $ob_appointment::get_appointment_data('app_washdry_area', $result['appointmentID']);
	
	foreach($ai_results as $ai_key => $ai_result) {
		$app_output .= print_r($ai_result, 1);
		$aw_details[] = $ai_result;
	}
	$ob_log->write("Get wash dry data for appointmentID: {$result['appointmentID']} ");*/
	
	debug_message('Gathered Appointment data.');
	
	
	
	// Gather the property type
	if (isset($result['propertyType']) and !empty($result['propertyType'])) {
		//$property_type = $arr_propery_types[strtolower($result['propertyType'])]; // To Do - add to Mapping class
		$property_type = strtolower($result['propertyType']); // To Do - add to Mapping class
	} else {
		die('Property type is not defined in the appointment '. $result['appointmentID']);
	}
	my_print($result['appointmentID']);
	//my_print($ap_details);
	
	if(!count($ap_details)) {
		$ob_log->write("Appointment details not found for {$result['appointmentID']}. Cron skip this appointment.");
		continue;
	}
	
	if($result['propertyPurpose'] == 1)
		$propertyPurpose = 'Sell';
	elseif($result['propertyPurpose'] == 2)
		$propertyPurpose = 'Rent';
	
	// property data array
	$arr_property = array(
		'propertyKey' => $ob_property::get_rand_id(),   // Generate random id
		'userID' => $result['userTypeID'],
		'propertyTypeID' => $property_type,
		'propertyFeatured' => 'OFF',
		'propertyPurpose' => $propertyPurpose,
		'propertyCoverImage' => NULL,
		'propertyAddedDate' => date("Y-m-d H:i:s"),
		'propertyUpdateDate' => date("Y-m-d H:i:s"),
		'propertyApprovedDate' => NULL,
		'propertySoldOutStatus' => 'No',
		'propertySoldOutPrice' => 0,
		'propertySoldOutDate' => NULL,
		'propertyLatitude' => NULL,
		'propertyLongitude' => NULL,
		'countryID' => 99,
		'stateID' => NULL,
		'cityID' => NULL,
		'cityLocID' => NULL,
		'communityID' => 0,
		'subCommunityID' => 0,
		'buildingID' => 0,
		'propertyZipCode' => $ap_details[0]['pincode'],
		'propertyStatus' => 'draft',
		'propertyPopularity' => 0,
		'propertyThreeSixtyView' => NULL,
		'propertyRank' => 0,
		'projectID' => $result['projectID'],
		'type' => 'Property',
		'isNegotiable' => ($ap_details[0]['rentNegotiable']) ? 'Yes' : 'No',
	);
	
	// Save the property
	$property_id = $ob_property::save_data('rp_properties', $arr_property);
	##$property_id = 520;
	
	$property_name = join (array($ap_details[0]['bhkType'], $ob_map->get_property_name($ap_details[0]['propertyType'])), ' ');
	$propertyDescription = join(array($property_name, 'at', $result['address']), ' ');
	
	$arr_property_address2 = array(
		#'developerName: ' . $ap_details[0]['developerName'], 
		$ap_details[0]['building_no_or_name'],
		#'buildingName: ' . $ap_details[0]['buildingName'],
		$ap_details[0]['flatNO'],
		#$ap_details[0]['floorNum'],
		$ap_details[0]['apointmentWing'],
		$ap_details[0]['apponitmentStreet'],
		$ap_details[0]['locality'],
		$ap_details[0]['subLocality'],
		$ap_details[0]['pincode'],
		$ap_details[0]['landmark']
	);
	
	$propertyAddress2 = join($arr_property_address2, ' ');	
	
	$arr_property_details = array(
		'propertyID' => $property_id,
		'versionID' => 1,
		'languageID' => 1,
		'propertyName' => $property_name, 
		'propertyAddress1' => $result['address'],
		'propertyAddress2' => $propertyAddress2,
		'propertyDescription' => $propertyDescription,
		'propertyLocality' => $ap_details[0]['locality'],
		'propertyMetaTitle' => $propertyDescription,
		'propertyMetaKeyword' => $propertyDescription,
		'propertyMetaDescription' => $propertyDescription,
		'propertyShortDescription' => $propertyDescription,
		'propertySpecifications' => $property_name,
		'propertyCurrentStatus' => ''
	);
	
	$arr_property_prices = array(
		'propertyID' => $property_id, 
		'currencyID' => 3, 
		'propertyPrice' => $ap_details[0]['rentAmount']
	);
	
	$app_data = array();
	
	// Get appointment mapping
	$app_data['app_details'] = $ap_details;
	$app_data['app_kitchens'] = $ak_details;
	$app_data['app_images'] = $ai_details;
	$app_data['app_livingroom'] = $al_details;
	$app_data['app_toilets'] = $at_details;
	$app_data['app_bedrooms'] = $ab_details;
	//$app_data['app_washdry_area'] = $aw_details;
	
	
	
	$attributes_map = $ob_map->get_attributes_map();
	$attributes = $ob_property->prepare_property_attributes($attributes_map, $app_data);
	
	$amenities_map = $ob_map->get_amenities_map();
	$amenities = $ob_property->prepare_property_amenities($amenities_map, $app_data);
	
	// Save all amenities 
	$ob_property::save_amenities($property_id, $amenities);
	
	debug_message('Create data for property data.');
	
	$property_details_id = $ob_property::save_data('rp_property_details', $arr_property_details);
	$property_price_id = $ob_property::save_data('rp_property_price', $arr_property_prices);
	
	// Save all attributes
	$ob_property::save_attributes($property_id, $attributes);
	
	// Update the property appointment relationship
	$ob_appointment::save_data('rp_appointment_property', array('APID' => $result['appointmentID'], 'LPID' => $property_id));
	
	$ob_log->write("A new property with id $property_id is created.");
}

$app_db = NULL;
$admin_dbh = NULL;

$ob_log->write("Script execution complete.");

exit('Script execution complete.');
?>