<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
	
	public function clear_inventory_data(){
		$this->db->query("UPDATE rp_dbho_planinventoryconsumptiondates SET status = '' WHERE STR_TO_DATE(`date`, '%m/%d/%Y') >= CURDATE()");
		
		$this->db->query("UPDATE rp_special_listing_schedule SET specialListingUpdatedDate = (CURDATE() - INTERVAL 1 DAY)");
	}
	
	public function reset_inventory_data(){
		file_get_contents('http://homeonline:helloworld2016@staging.homeonline.com/dbho/crons/update_project_of_month/index.php');
	}
	
	public function clear_cache_data(){
		$document_root = $_SERVER['DOCUMENT_ROOT'];
		$cache_dir = $document_root . '/public/cache/filecache/*';
		
		$files = glob($cache_dir); // get all file names
		
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}
	}
	
}

?>