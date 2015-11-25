<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_functions extends CI_Controller {

	 /*
	 # Programmer : Rohit thakur
	 # Common_functions controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->model('manage_user_plan_model');
		
	}
	
	public function get_planpriority()
	{
		$plantypeid = $this->input->post('plantypeid');
		$plantypeid=explode("-",$plantypeid);
		$planpriority = $this->utilities->get_planpriority($plantypeid[0]);
		print_r($planpriority[0]->Priority);
	}
	
	 
}	
?>
