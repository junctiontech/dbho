<?php
$arr_propery_types = array(
	'villas' => 13,
	'row_house' => 22,
	'apartment' => 23,
	'builder_floor' => 41,
	'farm_house1' => 46,
	'residential_plot' => 51,
	'studio_apartment' => 53,
	'service_apartment' => 54,
	'flat' => 55
);



/*$arr_propery_types = array(
	'industrial_buildings' 	=> 11,
	'villas'				=> 13,
	'shop_showroom'			=> 14,
	'row_house'				=> 22,
	'apartment'				=> 23,
	'office_space'			=> 25,
	'commercial_land'		=> 26,
	'warehouse_godown'		=> 27,
	'industrial_shed'		=> 28,
	'builder_floor'			=> 41,
	'shoping_complex1'		=> 44,
	'farm_house1'			=> 46,
	'residential_plot'		=> 51,
	'studio_apartment'		=> 53,
	'service_apartment'		=> 54,
	'flat'					=> 55
);*/

class Mapping {
	private $appointment_table_map = array();
	
	public function Mapping(){
		$this->appointment_table_map['app_bedrooms'] = 'rp_app_bedrooms';
		//$this->appointment_table_map['app_details'] = '`rp_app_detail_10-10`';
		$this->appointment_table_map['app_details'] = 'rp_app_detail';
		$this->appointment_table_map['app_images'] = 'rp_app_images';
		$this->appointment_table_map['app_kitchens'] = 'rp_app_kitchens';
		$this->appointment_table_map['app_toilets'] = 'rp_app_toilets';
		$this->appointment_table_map['app_livingroom'] = 'rp_app_livingroom';
		$this->appointment_table_map['app_appointments'] = 'rp_appointments';
		$this->appointment_table_map['app_washdry_area'] = 'rp_washdry_area';
		
		
		$this->property_names = array(
			13 => 'Villas',
			22 => 'Row House',
			23 => 'Apartment',
			41 => 'Builder Floor',
			46 => 'Farm House',
			51 => 'Residential Plot',
			53 => 'Studio Apartment',
			54 => 'Service Apartment',
			55 => 'Flat'
		);
	}
	
	public function get_mappped_value($key){
		if(isset($this->appointment_table_map[$key])) {
			return $this->appointment_table_map[$key];
		} else {
			my_print(debug_backtrace());
			die("The key $key not exist.");
		}
	}
	
	public function get_flipped_mappped_value($key){
		$rev_arr =  array_flip($this->appointment_table_map);
		if(isset($rev_arr[$key])) {
			return $rev_arr[$key];
		} else {
			my_print(debug_backtrace());
			die("The key $key not exist.");
		}
	}
	
	public function get_property_name($key){
		if(isset($this->property_names[$key])) {
			return $this->property_names[$key];
		} else {
			my_print(debug_backtrace());
			die("The key $key not exist.");
		}
	}
	
	public function get_attributes_map(){
		
		$arr_bhk_type = array(
			65	=> 'buildingAge',
			130	=> 'balcony',
			21	=> 'balcony',
			3	=> 'numOfToilet',
			109	=> array('rp_app_toilets' => array('flooringType1')),
			1	=> 'numOfBedrooms',
			56	=> 'brokarageFee',
			4	=> 'builtupArea',
			67	=> 'carpetArea',
			15	=> 'apointmentFood',
			81	=> 'gatedCommunity',
			#136	=> array('rp_app_kitchens' => array('cabinet', 'plateformMaterial', 'refrigerator', 'waterPurifier', 'microwave', 'loft', 'chimneyExhaust')),
			16	=> 'leaseType',
			#127	=> array('rp_app_livingroom' => array('sofa', 'dinningTable', 'ac', 'tv', 'shoeRack', 'flooringType', 'falseCeiling')),
			72	=> 'mainEnterenceFacing',
			59	=> 'maintainenceFee',
			128	=> array('rp_app_bedrooms' => array('flooringType1')), // - First BedRoom's 
			122	=> 'noOfFloors',
			63	=> 'numOfLifts',
			129	=> array('rp_app_bedrooms' => array('flooringType2')), // - Second BedRoom's
			18	=> 'ownerType',
			14	=> 'petsAllowed',
			97	=> 'registeredSociety',
			103	=> 'rentAmount',
			57	=> 'rentNegotiable',
			55	=> 'securityDeposit',
			58	=> 'securityNegotiable',
			69	=> 'serventRoom',
			98	=> 'SocietyName',
			80	=> 'solarWaterHeater',
			#142	=> array('rp_app_toilets' => array('type', 'Style', 'hotWaterSupply', 'glassPartition', 'showerPartition', 'bathTub', 'cabinate', 'window', 'exhaustFan')), 
			141	=> array('rp_app_toilets' => array('flooringType1')),
			132	=> array('rp_app_toilets' => array('flooringType2')),
			8 => 'salesStatus',
			#21 => 'balcony',
			#124	=> 'numofwashdry',
			123	=> array('rp_app_detail' =>  array('waterSupply_municipal', 'waterSupply_borewell'))
		);
		
		return $arr_bhk_type;
	}
	
	public function get_amenities_map(){
		$amenitiesMap = array(
								57 => 'security', // security 
								58 => 'reserverdParking', // Reserved Parking
								59 => 'visitorParking', // visitor parking
								246 => 'wifiInternet', // wifi
								333 => array('rp_app_kitchens' => array('waterPurifier')), // ro water system
								337 => 'vaastuComplaint', // Vastu
								338 => 'intercom', // intercom
								360 => array('rp_app_kitchens' => array('gaspipLine')), // Gas Pipe
								373 => 'centralizedAC', // Centerlised AC
								448 => '24hourswatersupply', // 24 hour water suppli
								449 => 'cctvSurvelance', // CCTV 
								450 => 'dthTvFacilities', // DTH TV
								451 => 'guestAccomadation', // guest  accomodation
								452 => 'laundryService', // Loundry service
								453 => 'powerBackup'// power backup
							);
		return $amenitiesMap;
	}
	
	public function get_app_field_name($key) {
		$map = array(
			'cabinet' => 'Cabinet',
			'plateformMaterial' => 'Plateform Material',
			'refrigerator' => 'Refrigerator',
			'waterPurifier' => 'Water Purifier',
			'microwave' => 'Microwave',
			'loft' => 'Loft',
			'chimneyExhaust' => 'Chimney Exhaust',
			'sofa' => 'Sofa',
			'dinningTable' => 'Dinning Table',
			'ac' => 'Air Conditioner',
			'tv' => 'Television',
			'shoeRack' => 'Shoe Rack',
			'flooringType' => 'Flooring Type',
			'falseCeiling' => 'False Ceiling',
			'type' => 'Type',
			'Style' => 'Style',
			'hotWaterSupply' => 'Hot Water Supply',
			'glassPartition' => 'Glass Partition',
			'showerPartition' => 'Shower Partition',
			'bathTub' => 'Bath Tub',
			'cabinate' => 'Cabinate',
			'window' => 'Window',
			'exhaustFan' => 'Exhaust Fan',
			'gaspipLine' => 'Gas Pipeline'
		);
		
		return isset($map[$key]) ? $map[$key] : '';
	}
	
	public function get_app_field_value($key) {
		$map = array(
			'Y' => 'Yes',
			'N' => 'No',
			'y' => 'Yes',
			'n' => 'No',
			'Ceramic' => 'Ceramic Tile'
		);
		
		if ($key == 'N' || $key == 'n' || $key == 'Y' || $key == 'y' || $key == 'Ceramic')
			return $map[$key];
		else
			return $key;
	}
}

?>