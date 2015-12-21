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
		$this->data['projects']=$this->AddProperty_model->get_project();
		$this->data['propertytype']=$this->AddProperty_model->getPropertyType();
		$this->data['user_type']=$this->AddProperty_model->get_user_type();
		$this->parser->parse('header',$this->data);
		$this->load->view('addproperty',$this->data);
		$this->parser->parse('footer',$this->data);
		
	}
/*AddProperty view Load End.............................................................................................................*/

/*AddProperty Get User Start.............................................................................................................*/
	function GetUser()
	{	
			if(!empty($this->input->post('usertypeID')))
			{
					$usertype=$this->AddProperty_model->getuser($this->input->post('usertypeID'));
					if(!empty($usertype)){
						echo"<option value=''>Select User</option>";
						foreach($usertype as $usertypes){
							echo"<option value=".$usertypes->userID.">$usertypes->userEmail</option>";
						}
						
					}else{
						echo"<option>No user Found!</option>";
					}
			}else{
				
			}
		
	}
/*AddProperty Get User End.............................................................................................................*/
	

		
}
