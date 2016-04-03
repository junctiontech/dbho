<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {
	private $data = array();
	
	public function __construct(){
		parent::__construct();
		$this->load->model('cron_model');
		$this->load->library('parser');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('session');
		if (!$this->session->userdata('homeonline')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect('Login');}
		$this->userinfo=$this->session->userdata('homeonline');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		
	}
	
	public function index() {
		if($this->input->post('action') == 'clear_inv_data') {
			$this->cron_model->clear_inventory_data();
			$this->session->set_flashdata('message_data', array('type' => 'success', 'message' => 'Inventory data successfully cleared!!!'));
		}
		
		if($this->input->post('action') == 'run_inv_cron') {
			$this->cron_model->reset_inventory_data();
			$this->session->set_flashdata('message_data', array('type' => 'success', 'message' => 'Cron successfully run!!!'));
		}
		
		if($this->input->post('action') == 'Clear Cache') {
			$this->cron_model->clear_cache_data();
			$this->session->set_flashdata('message_data', array('type' => 'success', 'message' => 'Cache successfully cleared!!!'));
		}

		$this->parser->parse('header', $this->data);
		$this->load->view('cron/cron_management');
		$this->parser->parse('footer', $this->data);
	}
	
}

?>