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
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}

		
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
		if(!empty($user_type)){
		print_r($user_type[0]->userTypeName);
		}
	}
	
	public function get_planbyusertype()
	{ 
		$userid = $this->input->post('userid');
		$rowcount = $this->input->post('rowcount');
		if(!empty($rowcount)){
			
		}else{
			$rowcount=0;
		}
		if(!empty($userid)){
		$user_type = $this->utilities->get_usertype($userid);
		$usertypeid=$user_type[0]->userTypeID;
		$user_typeplan = $this->utilities->get_planbyusertype($usertypeid);
		if(!empty($user_typeplan)){
		echo"<select onchange='checkplanavailable(this.value,this.id)' id='plan_$rowcount' required name='planid[]' class='select2_group form-control newin'>"; 
		echo "<option value=''>Select Plan</option>";
		foreach($user_typeplan as $plan1){
		echo "<option value=".$plan1->planID.">$plan1->planTitle";
		echo "</option>";
		}
		echo"</select>";
		}
		}
	}
	
	public function getcityforinventory()
	{
		$inventoryid = $this->input->post('inventoryid');
		if(!empty($inventoryid)){
			
			$cityid = $this->utilities->getcityidforinventory($inventoryid);
			
		if(!empty($cityid)){
			
			$citiesin='';
			$i=1;
			foreach($cityid as $cityids){
				$citiesin.="$cityids->City";
				if(count($cityid)-1>=$i){
					$citiesin.=",";
				}
				$i++;
			}
			
			$inventorycity = $this->utilities->getcityforinventory($citiesin);
			
			echo"<select required name='cityid' class='select2_group form-control'>"; 
			echo "<option value=''>Select City</option>";
			foreach($inventorycity as $inventorycitys){
			echo "<option  value=".$inventorycitys->cityID.">$inventorycitys->cityName";
			echo "</option>";
			}
			echo"</select>";
		}
		
		}
	}
	
	public function checkplanavailable()
	{
		$planid = $this->input->post('planid');
		$userid = $this->input->post('userid');
		
		$plandetails = $this->utilities->checkplanavailable($planid,$userid);
		
		
		if(!empty($plandetails)){
			$datearray='';
			$quantityarray='';
			foreach($plandetails as $plandetailss){
				
				$datearray[]=$plandetailss->currentExpiry;
				$quantityarray[]=$plandetailss->Quantity;
			}
			
			$max = max(array_map('strtotime', $datearray));
			
			date_default_timezone_set("Asia/Kolkata");
			
			$date=date("m/d/Y");
			
			if($max>=strtotime($date))
			{
				$indexno=array_search(date("m/d/Y",$max),$datearray);
				$date1=date("m/d/Y",$max);
				$newarr[]=array('quantity'=>$quantityarray[$indexno],'currentExpiry'=>"$date1");
				print_r(json_encode($newarr));
			}
			
		
		}
		
	}
	
	 
}	
?>
