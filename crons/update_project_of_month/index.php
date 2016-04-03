<?php
date_default_timezone_set('America/New_York'); 

require_once('config/init.php');
require_once('classes/class_logger.php');
require_once('config/obdb.php');
require_once('classes/class_prod_listing.php');
require_once('classes/class_campaign.php');
require_once('classes/class_mappings.php');

// Begin script
debug_message('Script begin.');

/**
 *	Save the Agent information
 */
$ra = @$_SERVER['REMOTE_ADDR'];
$hua = @$_SERVER['HTTP_USER_AGENT'];

$ob_log->write("Remote IP: {$ra}");
$ob_log->write("Remote User Agents: {$hua}");
$ob_log->write("");


/***

Availble variables
	$ob_listing
	$ob_campaign
*/

// Get all appointments whose status is complete
// To do - This should go in the Appointment class
$map = new Mapping;

//my_print($map->get_all_keys('map_table_names'));


// ------------------------------ Start Project of the month ------------------------------ //
##$listings = $ob_listing::get_data('l_main', 'specialListingSection', 'projectOfMonth');
$listings = $ob_listing::get_data('l_main');
my_print($listings);

$listing_ids = array();
$listingUpdateDates = array();
$inventories = $ob_campaign::get_project_of_month();

foreach ($listings as $listing) {
	$listing_ids[] = (int)$listing['specialListingID'];
	$listingUpdateDates[$listing['specialListingID']] = $listing['specialListingUpdatedDate'];
	$listingTypes[$listing['specialListingID']] = $listing['specialListingSection'];
	$listingCity[$listing['specialListingID']] = $ob_campaign::get_field_value('l_cities', 'cityID', 'specialListingID', $listing['specialListingID']);
}

// Clean the special Listing Tables
if(count($inventories)) {
	foreach($listing_ids as $listing_id) {
		if(strtotime(date('Y-m-d')) > strtotime($listingUpdateDates[$listing_id])){
			# Delete the existing date from listing
			$ob_listing::delete_data('l_dates', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
			
			# Delete the existing object from listing
			$ob_listing::delete_data('l_object', 'specialListingID', $listing_id);
			
			# Update the update date to today date
			$ob_listing::update_data('l_main', array('specialListingID' => $listing_id, 'specialListingUpdatedDate' => date("Y-m-d H:i:s")), 'specialListingID');
		}
	}
}

if(count($inventories) && count($listing_ids)) {
	foreach($listing_ids as $listing_id) {
		
		# If its rsh listing type, update the mlp listing
		if($listingTypes[$listing_id] == 'rhsProjectListing') {
			$fpTypeID = $listingCity[$listing_id];			
			$ob_listing::saveMlpData($fpTypeID);
		}
		
		foreach($inventories as $inventory){
			if($inventory['inventoryDescription'] === $listingTypes[$listing_id]) {
				
				if($inventory['Status'] == 'Created') {
					// update the status to Started
					$ar_inv = array('Status' => 'Started', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
					
					$log_data = array(
						'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID'],
						'status' => 'Started',
						'createdBy' => 'System'
					);
					
					$ob_campaign::save_data('c_inv_log', $log_data);
					
					# Do log entry
					$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
				}
				
				// update the status to Completed
				if($inventory['Duration'] ==  $inventory['DaysCompleted']) {
					$ar_inv = array('Status' => 'Completed', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
					
					$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
				}
				
				// Get the days completed
				$daysCompleted = $ob_campaign::get_field_value('c_inv_consumption', 'DaysCompleted', 'planinventoryconsumptionID', $inventory['planinventoryconsumptionID']);
				
				// Increse the date completed
				$ar_inv = array('DaysCompleted' => $daysCompleted + 1, 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
				
				$log_data = array(
					'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID'],
					'status' => 'Played',
					'createdBy' => 'System'
				);
				
				$ob_campaign::save_data('c_inv_log', $log_data);
			
				// Change the state of the date status to Finished
				$ar_inv = array('status' => 'Finished', 'planinventoryconsumptiondateID' => $inventory['planinventoryconsumptiondateID']);
				
				$ob_campaign::update_data('c_inv_consumption_dates', $ar_inv, 'planinventoryconsumptiondateID');
				
				// Save the objects and dates 
				$ar_date = array('specialListingID' => $listing_id, 'scheduleDate' => date('Y-m-d', strtotime($inventory['date'])));
				$ar_object = array('specialListingID' => $listing_id, 'objectID' => $inventory['ProjectID']);
				
				$ob_listing::save_data('l_object', $ar_object);
				$ob_listing::save_data('l_dates', $ar_date);
			}
		}
	}
}

// ------------------------------ End Project of the month ------------------------------ //
/*

// ------------------------------ Start RHS Listing Project ------------------------------ //
$listings = $ob_listing::get_data('l_main', 'specialListingSection', 'rhsProjectListing');

$listing_ids = array();

foreach ($listings as $listing) {
	$listing_ids[] = $listing['specialListingID'];
}

$inventories = $ob_campaign::get_rhs_listing_projects();

foreach($listing_ids as $listing_id) {
	# Delete the existing date from listing
	$ob_listing::delete_data('l_dates', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
	
	# Delete the existing object from listing
	$ob_listing::delete_data('l_object', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
}

if(count($inventories) && count($listing_ids)) {
	foreach($listing_ids as $listing_id) {
		foreach($inventories as $inventory){
			if($inventory['Status'] == 'Created') {
				// update the status to Started
				$ar_inv = array('Status' => 'Started', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// update the status to Completed
			if($inventory['Duration'] ==  $inventory['DaysCompleted']) {
				$ar_inv = array('Status' => 'Completed', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// Get the days completed
			$daysCompleted = $ob_campaign::get_field_value('c_inv_consumption', 'DaysCompleted', 'planinventoryconsumptionID', $inventory['planinventoryconsumptionID']);
			
			// Increse the date completed
			$ar_inv = array('DaysCompleted' => $daysCompleted + 1, 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
			
			$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			
			// Change the state of the date status to Finished
			$ar_inv = array('status' => 'Finished', 'planinventoryconsumptiondateID' => $inventory['planinventoryconsumptiondateID']);
			
			$ob_campaign::update_data('c_inv_consumption_dates', $ar_inv, 'planinventoryconsumptiondateID');
			
			// Update 
			$ar_date = array('specialListingID' => $listing_id, 'scheduleDate' => date('Y-m-d', strtotime($inventory['date'])));
			$ar_object = array('specialListingID' => $listing_id, 'objectID' => $inventory['ProjectID']);
			
			$ob_listing::save_data('l_object', $ar_object);
			$ob_listing::save_data('l_dates', $ar_date);
		}
	}
}
// ------------------------------ End RHS Listing Project ------------------------------ //


// ------------------------------ Start Project Gallery------------------------------ //
$listings = $ob_listing::get_data('l_main', 'specialListingSection', 'projectGallery');

$listing_ids = array();

foreach ($listings as $listing) {
	$listing_ids[] = $listing['specialListingID'];
}

$inventories = $ob_campaign::get_project_gallery();

foreach($listing_ids as $listing_id) {
	# Delete the existing date from listing
	$ob_listing::delete_data('l_dates', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
	
	# Delete the existing object from listing
	$ob_listing::delete_data('l_object', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
}

if(count($inventories) && count($listing_ids)) {
	foreach($listing_ids as $listing_id) {
		foreach($inventories as $inventory){
			if($inventory['Status'] == 'Created') {
				// update the status to Started
				$ar_inv = array('Status' => 'Started', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// update the status to Completed
			if($inventory['Duration'] ==  $inventory['DaysCompleted']) {
				$ar_inv = array('Status' => 'Completed', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// Get the days completed
			$daysCompleted = $ob_campaign::get_field_value('c_inv_consumption', 'DaysCompleted', 'planinventoryconsumptionID', $inventory['planinventoryconsumptionID']);
			
			// Increse the date completed
			$ar_inv = array('DaysCompleted' => $daysCompleted + 1, 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
			
			$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			
			// Change the state of the date status to Finished
			$ar_inv = array('status' => 'Finished', 'planinventoryconsumptiondateID' => $inventory['planinventoryconsumptiondateID']);
			
			$ob_campaign::update_data('c_inv_consumption_dates', $ar_inv, 'planinventoryconsumptiondateID');
			
			// Update 
			$ar_date = array('specialListingID' => $listing_id, 'scheduleDate' => date('Y-m-d', strtotime($inventory['date'])));
			$ar_object = array('specialListingID' => $listing_id, 'objectID' => $inventory['ProjectID']);
			
			$ob_listing::save_data('l_object', $ar_object);
			$ob_listing::save_data('l_dates', $ar_date);
		}
	}
}
// ------------------------------ End Project Gallery------------------------------ //


// ------------------------------ Start Hot Projects------------------------------ //
$listings = $ob_listing::get_data('l_main', 'specialListingSection', 'hotProjects');

$listing_ids = array();

foreach ($listings as $listing) {
	$listing_ids[] = $listing['specialListingID'];
}

$inventories = $ob_campaign::get_hot_projects();

foreach($listing_ids as $listing_id) {
	# Delete the existing date from listing
	$ob_listing::delete_data('l_dates', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
	
	# Delete the existing object from listing
	$ob_listing::delete_data('l_object', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
}

if(count($inventories) && count($listing_ids)) {
	foreach($listing_ids as $listing_id) {
		foreach($inventories as $inventory){
			if($inventory['Status'] == 'Created') {
				// update the status to Started
				$ar_inv = array('Status' => 'Started', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// update the status to Completed
			if($inventory['Duration'] ==  $inventory['DaysCompleted']) {
				$ar_inv = array('Status' => 'Completed', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// Get the days completed
			$daysCompleted = $ob_campaign::get_field_value('c_inv_consumption', 'DaysCompleted', 'planinventoryconsumptionID', $inventory['planinventoryconsumptionID']);
			
			// Increse the date completed
			$ar_inv = array('DaysCompleted' => $daysCompleted + 1, 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
			
			$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			
			// Change the state of the date status to Finished
			$ar_inv = array('status' => 'Finished', 'planinventoryconsumptiondateID' => $inventory['planinventoryconsumptiondateID']);
			
			$ob_campaign::update_data('c_inv_consumption_dates', $ar_inv, 'planinventoryconsumptiondateID');
			
			// Update 
			$ar_date = array('specialListingID' => $listing_id, 'scheduleDate' => date('Y-m-d', strtotime($inventory['date'])));
			$ar_object = array('specialListingID' => $listing_id, 'objectID' => $inventory['ProjectID']);
			
			$ob_listing::save_data('l_object', $ar_object);
			$ob_listing::save_data('l_dates', $ar_date);
		}
	}
}
// ------------------------------ End Hot Projects------------------------------ //

// ------------------------------ Start Featured Listing------------------------------ //
$listings = $ob_listing::get_data('l_main', 'specialListingSection', 'featuredListing');

$listing_ids = array();

foreach ($listings as $listing) {
	$listing_ids[] = $listing['specialListingID'];
}

$inventories = $ob_campaign::get_featured_Listing();

foreach($listing_ids as $listing_id) {
	# Delete the existing date from listing
	$ob_listing::delete_data('l_dates', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
	
	# Delete the existing object from listing
	$ob_listing::delete_data('l_object', 'specialListingID', $listing_id, 'scheduleDate < CURDATE()');
}

if(count($inventories) && count($listing_ids)) {
	foreach($listing_ids as $listing_id) {
		foreach($inventories as $inventory){
			if($inventory['Status'] == 'Created') {
				// update the status to Started
				$ar_inv = array('Status' => 'Started', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// update the status to Completed
			if($inventory['Duration'] ==  $inventory['DaysCompleted']) {
				$ar_inv = array('Status' => 'Completed', 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
				
				$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			}
			
			// Get the days completed
			$daysCompleted = $ob_campaign::get_field_value('c_inv_consumption', 'DaysCompleted', 'planinventoryconsumptionID', $inventory['planinventoryconsumptionID']);
			
			// Increse the date completed
			$ar_inv = array('DaysCompleted' => $daysCompleted + 1, 'planinventoryconsumptionID' => $inventory['planinventoryconsumptionID']);
			
			$ob_campaign::update_data('c_inv_consumption', $ar_inv, 'planinventoryconsumptionID');
			
			// Change the state of the date status to Finished
			$ar_inv = array('status' => 'Finished', 'planinventoryconsumptiondateID' => $inventory['planinventoryconsumptiondateID']);
			
			$ob_campaign::update_data('c_inv_consumption_dates', $ar_inv, 'planinventoryconsumptiondateID');
			
			// Update 
			$ar_date = array('specialListingID' => $listing_id, 'scheduleDate' => date('Y-m-d', strtotime($inventory['date'])));
			$ar_object = array('specialListingID' => $listing_id, 'objectID' => $inventory['ProjectID']);
			
			$ob_listing::save_data('l_object', $ar_object);
			$ob_listing::save_data('l_dates', $ar_date);
		}
	}
}
// ------------------------------ End Featured Listing------------------------------ //

*/

$ob_log->write("Script execution complete.");

exit('Script execution complete.');
?>