<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class HO_Session {
	
	public function __construct(){
		print '<pre>'; var_dump($_SESSION); print '</pre>';
	}
	
		
}

?>