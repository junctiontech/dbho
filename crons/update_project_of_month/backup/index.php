<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

define('DEBUG_MODE', 'On');
 
require_once('classes/class_logger.php');
require_once('config/obdb.php');
require_once('classes/class_prod_listing.php');
require_once('classes/class_mappings.php');

// Begin script
debug_message('Script begin.');

/**
 *	Save the Agent information
 */
$ob_log->write("Remote IP: {$_SERVER['REMOTE_ADDR']}");
$ob_log->write("Remote User Agents: {$_SERVER['HTTP_USER_AGENT']}");
$ob_log->write("");


/***

Availble variables
	$ob_listing
	$ob_appointment 
*/

// Get all appointments whose status is complete
// To do - This should go in the Appointment class
$results = $ob_listing::get_data('l_main');
$count = count($results);

my_print($results);

$ob_log->write("Total {$count} completed appointment found.");



$app_db = NULL;
$admin_dbh = NULL;

$ob_log->write("Script execution complete.");

exit('Script execution complete.');
?>