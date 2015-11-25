<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	/**
	Developer : Rohit thakur
	Utilities : Utilities Class for customization function
	*/
	
class Utilities extends CI_Controller {

	public function __construct() 
	{
         # parent::__construct();
		$ci =& get_instance();
	 }
	 
	function get_planpriority($plantypeid=false)
	{
		$CI = & get_instance();
		$db2 = $CI->load->database('both', TRUE);
			$qry = $db2->query("select Priority from db_plantype where planTypeID=$plantypeid");
		return $qry->Result();
	}
	
	
	
	
}



?>
