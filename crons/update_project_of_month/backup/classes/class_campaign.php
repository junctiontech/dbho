<?php

class Property {
	private static $dbh;
	private static $property = NULL;
	private static $attribute_options = array();
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
		
		//my_print($dbh->queryString);
		
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
							if($field_name == 'flooringType1')
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][0]['flooringType'];
							elseif ($field_name == 'flooringType2')
								$app_table_value[] = $app_data[$map->get_flipped_mappped_value($app_table)][1]['flooringType'];
							else {
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
	
	
	public static function get_attribute_options($attr_id) {
		if (self::get_attribute_type($attr_id) == 'select') {
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
				
				//my_print($dbh->queryString);
				
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
			
			//my_print($dbh->queryString);
			
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
					$map_value = 1;
				} if ($key == 15 && $value == 'All Type') {
					$map_value = 'No preference';
				} if ($key == 124 && $value > 0) {
					$map_value = 'Yes';
				} elseif($key == 124 && $value = 0) {
					$map_value = 'No';
				}
				
				$attr_option_id = isset($attr_options[$map_value]) ? $attr_options[$map_value] : 0;
				$attr_option_value = $map_value;
				
				//my_print('arrt_id: '.$key);
				//my_print('value: '.$value);
				//my_print('Map value: '.$map_value);
				//my_print($attr_options);
			} else {
				$attr_option_id = 0;
				$attr_option_value = $map->get_app_field_value($value);
			}
			
			//my_print($key . '::' .  $attr_option_id . '::' . $attr_option_value . '::' .  $attr_type);
			
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
	
}

// Get property class instance
$ob_property = Property::get_instance();


function my_print($data){
	echo '<pre>' .  print_r($data, 1) . '</pre>';
}

?>