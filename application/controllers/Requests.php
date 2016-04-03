<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Requests extends CI_Controller {

	private $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('request_model');
		$this->load->model('user_model');
		$this->load->library('parser');
		$this->load->helper('form');
		$this->load->library('session');
		
		if (!$this->session->userdata('homeonline')) {
			$this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. ");
			redirect('Login');
		}
		$this->userinfo = $this->session->userdata('homeonline');
		$timezone = "Asia/Calcutta";
		if (function_exists('date_default_timezone_set'))
			date_default_timezone_set($timezone);
	}

	public function index() {
		 $requestsResult = $this->request_model->getRequests();
		 $requests = array();
		 
		 foreach($requestsResult as $request){
			 $request->userDetail = $this->user_model->getUserDetail($request->userID);
			 $requests[] = $request;
		 }
		 
		 //echo '<pre>'. print_r($requests, 1).'</pre>';
		 
		 $this->data['requests'] = $requests;
		 
		$this->parser->parse('header', $this->data);
		$this->load->view('requests/list', $this->data);
		$this->parser->parse('footer', $this->data);
	}
	
	public function view($requestID) {
		$this->data['request'] = $this->request_model->getRequest($requestID);
		
		$this->parser->parse('header', $this->data);
		$this->load->view('requests/view', $this->data);
		$this->parser->parse('footer', $this->data);
	}

}

?>