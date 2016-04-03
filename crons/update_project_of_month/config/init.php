<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

define('DEBUG_MODE', 'On');
define('PRINT_MODE', 'On');
define('LOG_MODE', 'Off');

// Utility functions
function debug_message($message){
	if(DEBUG_MODE == 'On') {
		print $message . "<br/>";
	}
}

function my_print($str) {
	if(PRINT_MODE == 'On') {
		print "<pre>"; var_dump($str); print "</pre>";
	}
}
?>