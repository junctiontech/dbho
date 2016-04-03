<?php


class Mapping {
	private $map_table_names = array(); // contain the table name's map
	
	public function Mapping(){
		$this->map_table_names['l_main'] = 'rp_special_listing_schedule';
		$this->map_table_names['l_dates'] = 'rp_special_listing_schedule_dates';
		$this->map_table_names['l_object'] = 'rp_special_listing_schedule_objects';
		$this->map_table_names['l_cities'] = 'rp_special_listing_schedule_to_cities';
		$this->map_table_names['l_images'] = 'rp_special_project_month_images';
	}
	
	public function get_mappped_value($map_name, $key){
		if (!isset($this->$map_name)){
			die("The map $map_name not found.");
		}
		
		if(isset($this->$map_name[$key])) {
			return $this->$map_name[$key];
		} else {
			die("The key $key not exist.");
		}
	}
	
	public function get_flipped_mappped_value($map_name, $key){
		$rev_arr =  array_flip($this->$map_name);
		if(isset($rev_arr[$key])) {
			return $rev_arr[$key];
		} else {
			die("The key $key not exist.");
		}
	}
	
	public function get_all_keys(){
		return 
	}
}

?>