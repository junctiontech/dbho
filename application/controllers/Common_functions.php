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
	
	public function get_usertype()
	{
		$userid = $this->input->post('userid');
		
		$user_type = $this->utilities->get_usertype($userid);
		print_r($user_type[0]->userTypeName);
	}
	
	public function get_planbyusertype()
	{
		$userid = $this->input->post('userid');
		if(!empty($userid)){
		$user_type = $this->utilities->get_usertype($userid);
		$usertypeid=$user_type[0]->userTypeID;
		$user_typeplan = $this->utilities->get_planbyusertype($usertypeid);
		
		echo"<select required name='planid[]' class='select2_group form-control'>"; 
		echo "<option value=''>Select Plan</option>";
		foreach($user_typeplan as $plan1){
		echo "<option value=".$plan1->planID.">$plan1->planTitle";
		echo "</option>";
		}
		echo"</select>";
		}
	}
	
	public function getcityforinventory()
	{
		$inventoryid = $this->input->post('inventoryid');
		if(!empty($inventoryid)){
			
			$cityid = $this->utilities->getcityidforinventory($inventoryid);
			
		if(!empty($cityid[0]->City)){
				
			$inventorycity = $this->utilities->getcityforinventory($cityid[0]->City);
			echo"<select required name='cityid[]' class='select2_group form-control'>"; 
			echo "<option value=''>Select Plan</option>";
			foreach($inventorycity as $inventorycitys){
			echo "<option selected value=".$inventorycitys->cityID.">$inventorycitys->cityName";
			echo "</option>";
			}
			echo"</select>";
		}
		
		}
	}
	
	 
}	
?>
