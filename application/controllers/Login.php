<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
	 function __construct() {
		parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('Login_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
// Login Started Here.................................................................................................................

/*Login view Load Start.............................................................................................................*/
	function index()
	{	
			
		$this->load->view('login',$this->data);
		
	}
/*Login view Load End.............................................................................................................*/

/*Login Authentication Start.............................................................................................................*/
	function login_user($info=false) {
		
		
		$data=array(
				'adminUserLoginName'=>$this->input->post('username'),
				'adminUserLoginPass'=>md5($this->input->post('password')),
				'adminUserStatus'=>'Active'
			);
			
		$row = $this->Login_model->login_check('rp_admin_users',$data);
						
		if($row=='') { 									
			$homeonline = array( 
				'adminUserID' => '1',
				'adminUserFirstName' => 'Rohit'
			);
			
			$this->session->set_userdata('homeonline',$homeonline);
			$user_session_data = $this->session->userdata('homeonline');
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message', $this->config->item("index")." Login Successfully!!");	
			redirect('Manage_user_plan');

		} else {
			$this->session->set_flashdata('category_error_login', " Invalid Username Or Password!! Please Try Again. ");
			redirect('Login');
		}
	}
/*Login Authentication End.............................................................................................................*/

/*Logout function start...................................................................................*/
	function logout()
	{
		$homeonline=$this->session->userdata('homeonline');
		$this->session->sess_destroy($homeonline);
		$this->session->set_flashdata('category_success_login', " Logout Successfully!! Thank You.. ");
		redirect('Login');
	}

	/*Logout function start...................................................................................*/
	


		
}
