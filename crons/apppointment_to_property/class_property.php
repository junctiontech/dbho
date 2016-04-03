<?php

class Property {
	private static $dbh;
	private static $property = NULL;
	private static $attribute_options  = array();
	private static $attribute_types = array();
	
	
	
	private function __construct(){
		$ob_db = new DB();
		
		try {
			self::$dbh = new PDO('mysql:host=' . $ob_db->host . ';dbname=' . $ob_db->admin_db, $ob_db->user, $ob_db->pass);
		} catch (PDOException $e) {
			die("Error!: " . $e->getMessage() ."<br/>");
		}
		
		self::$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
	}
	
	
	
	
	public static function get_instance(){
		if(self::$property == NULL){
			self::$property = new Property();
		}
		
		return self::$property;
	}
	
	
	public static function get_property_types($columns = array(), $distinct = FALSE){
		$str_columns = ' * ';
		$str_distinct = '';
		
		if (count($columns) != 0) {
			if (is_array($columns)){
				$str_columns = join($columns, ', ');
			} else
				exit('File => ' . __FILE__ . ':: Function => ' . __FUNCTION__ . ':: Message => Columns should be array.');
		}
		
		if($distinct == TRUE){
			$str_distinct = 'distinct';
		}
		

		$query = "select {$str_distinct} {$str_columns} 
		from rp_property_types pt, rp_property_type_details ptd
		where pt.typename = 'Property'
		and pt.propertyTypeID = ptd.propertyTypeID
		and ptd.languageID = 1
		and propertyTypeStatus = 'Active'";
		
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			my_print('Please use these tables :- rp_properties p, rp_property_types pt, rp_property_type_details ptd');
			die();
		}
		
		$dbh->execute();
		
		return $dbh->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	
	
	public static function save_data($table, $data = array()){
		if (!is_array($data))
			die("No value to insert into $table \n");
		
		$columns = array_keys($data);
		$values = array_values($data);
		
		if(count($columns) != count($values))
			die("No of columns are not matched with no. of values while inserting into table $table. \n");
		
		$str_columns = join($columns, ', ');
		$str_values = join($values, '\', \'');
		$query = "INSERT INTO $table ($str_columns) VALUES ('$str_values')";
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		$last_id = self::$dbh->lastInsertId();
		
		return $last_id;
	}
	
	
	
	
	public static function get_rand_id() {
		return substr(strtoupper(md5(uniqid(rand() .  time(), true))), 5, 7);
	}
	
	
	
	
	public function prepare_property_attributes($attributes_map, $app_data) {
		$arr_attributes = array();
		$map = new Mapping();
		
		foreach($attributes_map as $attr_id => $app_field_name){
			if(!is_array($app_field_name)) {
				$arr_attributes[$attr_id] = $app_data['app_details'][0][$app_field_name];
			} else {
				$app_table_value = array();
				
				foreach($app_field_name as $app_table => $app_table_field_names){
					
					if(isset($app_data[$map->get_flipped_mappped_value($app_table)])) {
						foreach($app_table_field_names as $field_name) {
							if($field_name == 'flooringType1' && isset($app_data[$map->get_flipped_mappped_value($app_table)][0]['flooringType']))
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][0]['flooringType'];
							elseif ($field_name == 'flooringType2' && isset($app_data[$map->get_flipped_mappped_value($app_table)][1]['flooringType']))
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][1]['flooringType'];
							elseif($app_table == 'rp_app_detail' && !count($app_table_value)) {
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][0]['waterSupply_municipal'];
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][0]['waterSupply_borewell'];
							}
							elseif(!count($app_table_value)) {
								$app_table_value[] = join(array(
									$map->get_app_field_name($field_name), 
									$map->get_app_field_value($app_data[$map->get_flipped_mappped_value($app_table)][1][$field_name]))
									, ' : '
								);
							}
						}
					}
				}
				
				$arr_attributes[$attr_id] = join($app_table_value, ', ');
				//$arr_attributes[$attr_id] = $app_table_value;
			}
		}
		
		return $arr_attributes;
	}
	
	
	public function prepare_property_amenities($amenities_map, $app_data) {
		$arr_attributes = array();
		$map = new Mapping();
		$arr_options = array();
		
		foreach($amenities_map as $attr_id => $app_field_name){
			if(!is_array($app_field_name)) {
				$arr_attributes[$attr_id] = $app_data['app_details'][0][$app_field_name];
				$arr_options[$attr_id]['field_name'] = $app_field_name;
				$arr_options[$attr_id]['field_value'] = $app_data['app_details'][0][$app_field_name];
			} else {
				$app_table_value = '';
				
				foreach($app_field_name as $app_table => $app_table_field_names){
					if(isset($app_data[$map->get_flipped_mappped_value($app_table)])) {
						foreach($app_table_field_names as $field_name) {
							$app_table_value = 
								$map->get_app_field_value($app_data[$map->get_flipped_mappped_value($app_table)][0][$field_name]);
							$arr_options[$attr_id]['field_name'] = $field_name;
							$arr_options[$attr_id]['field_value'] = $map->get_app_field_value($app_data[$map->get_flipped_mappped_value($app_table)][0][$field_name]);
						}
					}
				}
				
				$arr_attributes[$attr_id] = $app_table_value;
				//$arr_attributes[$attr_id] = $app_table_value;
			}
		}
		
		$fomatedAmenities = $this->formatAmenities($arr_options);
		
		return $fomatedAmenities;
	}
	
	private function formatAmenities($arr_options){
		$ids = $labels = array();
		
		foreach($arr_options as $id => $value){
			
			if(in_array($value['field_value'], array('y', 'Y', 'Yes', 'yes', 1))){
				$ids[] = $id;
				$labels[] = $value['field_name'];
			}
		}
		$strIds = join($ids, '#|#');
		$strValues = join($labels, '#|#');
		
		return array($strIds => $strValues);
	}
	
	public static function get_attribute_options($attr_id) {
		if (self::get_attribute_type($attr_id) == 'select' || self::get_attribute_type($attr_id) == 'multiselect') {
			if(isset(self::$attribute_options[$attr_id])) {
				return self::$attribute_options[$attr_id];
			} else {
				$query = "select aod.attrOptionID, aod.attrOptName
					from rp_attribute_options ao, rp_attribute_option_details aod
					where ao.attributeID = $attr_id
					and ao.attrOptionID = aod.attrOptionID
					and aod.languageID = 1";
				
				$dbh = self::$dbh->prepare($query);
				
				if (! $dbh) {
					my_print(self::$dbh->errorInfo());
					die();
				}
				
				$dbh->execute();
				
				$results = $dbh->fetchAll(PDO::FETCH_ASSOC);
				
				$options = array();
				
				foreach($results as $result) {
					$options[$result['attrOptName']] = $result['attrOptionID'];
				}
				
				self::$attribute_options[$attr_id] = $options;
				
				return $options;
			}
		} else {
			return '';
		}
	}
	
	
	
	public static function get_attribute_type($attr_id) {
		if (isset(self::$attribute_types[$attr_id])) {
			return self::$attribute_types[$attr_id];
		} else {
			$query = "select attrInputType
				from rp_attributes ao
				where attributeID = $attr_id";
			
			$dbh = self::$dbh->prepare($query);
			
			if (! $dbh) {
				my_print(self::$dbh->errorInfo());
				die();
			}
			
			$dbh->execute();
			
			$results = $dbh->fetchAll(PDO::FETCH_ASSOC);
			
			self::$attribute_types[$attr_id] = $results[0]['attrInputType'];
			
			return $results[0]['attrInputType'];			
		}
	}
	
	
	public static function save_attributes($property_id, $attributes){
		$map = new Mapping();
		
		foreach($attributes as $key => $value) {
			$attr_type = self::get_attribute_type($key);
			if($attr_type == 'select') {
				$map_value = $map->get_app_field_value($value);
				$attr_options = self::get_attribute_options($key);
				
				if($key == 21) {
					if ($map_value > 3) {
						$map_value = '4+';
					}
				} if ($key == 15 && $value == 'All Type') {
					$map_value = 'No preference';
				} if ($key == 124 && $value > 0) {
					$map_value = 'Yes';
				} elseif($key == 124 && $value = 0) {
					$map_value = 'No';
				}
				
				$attr_option_id = isset($attr_options[$map_value]) ? $attr_options[$map_value] : 0;
				$attr_option_value = $map_value;
				
			} elseif($attr_type == 'multiselect') {
				$map_value = explode(',', $map->get_app_field_value($value));
				$attr_options = self::get_attribute_options($key);
				
				$options = $details = array();
				
				$i = 0;
				foreach($attr_options as $id => $option) {
					if(trim($map_value[$i])  == 'Y') {
						$options[$id] = $option;
						$details[$id] = $id;
					}
					
					$i++;
				}
				
				$attr_option_id = join($options, '#|#');
				$attr_option_value = join($details, '#|#');
			} else {
				$attr_option_id = 0;
				$attr_option_value = $map->get_app_field_value($value);
			}
			
			$ar_proprerty_attribute_values = array(
				'propertyID' => $property_id,
				'attributeID' => $key,
				'attrOptionID' => $attr_option_id
			);
			
			$attrValueID = self::save_data('rp_property_attribute_values', $ar_proprerty_attribute_values);
			
			$ar_proprerty_attribute_values_l1 = array(
				'attrValueID' => $attrValueID,
				'languageID' => 1,
				'attrDetValue' => $attr_option_value
			);
			
			$attrValueID = self::save_data('rp_property_attribute_value_details', $ar_proprerty_attribute_values_l1);			
			
			$ar_proprerty_attribute_values_l2 = array(
				'attrValueID' => $attrValueID,
				'languageID' => 2,
				'attrDetValue' => $attr_option_value
			);
			
			$attrValueID = self::save_data('rp_property_attribute_value_details', $ar_proprerty_attribute_values_l2);
		}
	}
	
	public static function save_amenities($property_id, $amenities){
		
		$data = array();
		$data['propertyID'] = $property_id;
		$data['attributeID'] = 6;
		$data['attrOptionID'] = key($amenities);
		
		$attrValueID = self::save_data('rp_property_attribute_values', $data);
		$data = array();
		$data['attrValueID'] = $attrValueID;
		$data['languageID'] = 1;
		$data['attrDetValue'] = $amenities[key($amenities)];
		
		$attrValueID = self::save_data('rp_property_attribute_value_details', $data);
		
		
	}
	
}

// Get property class instance
$ob_property = Property::get_instance();


function my_print($data){
	echo '<pre>' .  print_r($data, 1) . '</pre>';
}

?>