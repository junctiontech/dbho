<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProperty extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('AddProperty_model');
		$this->load->library('parser');
		$this->load->library('utilities');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}

	}
	
// AddProperty Started Here.................................................................................................................

/*AddProperty view Load Start.............................................................................................................*/
	function index()
	{	
		/*$this->data['user_type']=$this->campaign_model->get_user_type();
		$this->data['company_name']=$this->campaign_model->get_company_name();
		$this->data['cities']=$this->campaign_model->get_city();
		$this->data['inventory']=$this->campaign_model->get_inventory();
		$this->data['plan']=$this->campaign_model->get_plan();*/
		
		$this->parser->parse('header',$this->data);
		$this->load->view('addproperty',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*AddProperty view Load End.............................................................................................................*/
	

		
}
