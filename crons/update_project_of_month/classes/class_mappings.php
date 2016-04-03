<?php


class Mapping {
	private $map_table_names = array(); // contain the table name's map
	
	public function Mapping(){
		$this->map_table_names['l_main'] = 'rp_special_listing_schedule';
		$this->map_table_names['l_dates'] = 'rp_special_listing_schedule_dates';
		$this->map_table_names['l_object'] = 'rp_special_listing_schedule_objects';
		$this->map_table_names['l_cities'] = 'rp_special_listing_schedule_to_cities';
		$this->map_table_names['l_images'] = 'rp_special_project_month_images';
		$this->map_table_names['l_mlp_property'] = 'rp_special_listing_mlp_featured_properties';
		
		$this->map_table_names['c_main'] = 'rp_campaigns';
		$this->map_table_names['c_inv_types'] = 'rp_dbho_inventorytype';
		$this->map_table_names['c_inv_master'] = 'rp_dbho_inventorymaster';
		$this->map_table_names['c_inv_log'] = 'rp_dbho_inventory_log';
		$this->map_table_names['c_inv_consumption'] = 'rp_dbho_planinventoryconsumption';
		$this->map_table_names['c_inv_consumption_dates'] = 'rp_dbho_planinventoryconsumptiondates';
		$this->map_table_names['c_test'] = 'test';
	}
	
	public function get_mappped_value($map_name, $key){
		if (!isset($this->$map_name)){
			die("The map $map_name not found.");
		}
		
		$map = $this->$map_name;
		
		if(isset($map[$key])) {
			return $map[$key];
		} else {
			die("The key $key not exist.");
		}
	}
	
	public function get_flipped_mappped_value($map_name, $key){
		if (!isset($this->$map_name)){
			die("The map $map_name not found.");
		}
		
		$rev_arr =  array_flip($this->$map_name);
		if(isset($rev_arr[$key])) {
			return $rev_arr[$key];
		} else {
			die("The key $key not exist.");
		}
	}
	
	public function get_all_keys($map_name){
		if (!isset($this->$map_name)){
			die("The map $map_name not found.");
		}
		
		return array_keys($this->$map_name);
	}
}

?>