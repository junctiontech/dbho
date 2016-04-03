<?php

class Prod_listing {
	private static $dbh;
	private static $prod_list = NULL;
	
	private function __construct(){
		$ob_db = new DB();
		
		try {
			self::$dbh = new PDO('mysql:host=' . $ob_db->l_host . ';dbname=' . $ob_db->l_db, $ob_db->l_user, $ob_db->l_pass);
		} catch (PDOException $e) { 
			print "Error!: " . $e->getMessage() ."<br/>";
		}
		
		self::$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
	}
	
	
	public static function get_instance(){
		if(self::$prod_list == NULL){
			self::$prod_list = new Prod_listing();
		}
		
		return self::$prod_list;
	}
	
	
	public static function get_data($table_name, $id_field = '', $id_value = ''){
		
		$ob_mapping = new Mapping();
		
		$table_name = $ob_mapping->get_mappped_value('map_table_names', $table_name);
		
		$query = "SELECT * FROM $table_name ";
		
		if($id_field !=  '' && $id_value !=  '') {
			$id_value = is_numeric($id_value)? $id_value : "'$id_value'" ;
			$query .= "WHERE $id_field = $id_value";
		}
		//my_print($query);
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		
		return $dbh->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public static function get_field_value($table_name, $field_name, $id_field = '', $id_value = ''){
		
		$ob_mapping = new Mapping();
		
		$table_name = $ob_mapping->get_mappped_value('map_table_names', $table_name);
		
		$query = "SELECT $field_name FROM $table_name ";
		
		if($id_field !=  '' && $id_value !=  '') {
			$id_value = is_numeric($id_value)? $id_value : "'$id_value'" ;
			$query .= "WHERE $id_field = $id_value";
		}
		//my_print($query);
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		
		$ar_result = $dbh->fetchAll(PDO::FETCH_ASSOC);
		
		return $ar_result[0][$field_name];
	}
	
	public static function delete_data($table_name, $id_field = '', $id_value = '', $condition  = ''){
		
		$ob_mapping = new Mapping();
		
		$table_name = $ob_mapping->get_mappped_value('map_table_names', $table_name);
		
		$query = "DELETE FROM $table_name ";
		
		if($id_field !=  '' && $id_value !=  '') {
			$id_value = is_numeric($id_value)? $id_value : "'$id_value'" ;
			if (!empty($condition)) 
				$query .= "WHERE $id_field = $id_value AND $condition";
			else
				$query .= "WHERE $id_field = $id_value";
		} else {
			die("WHERE condition is compulsory.");
		}
		//my_print($query);
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
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
		
		$ob_mapping = new Mapping();
		$table_name = $ob_mapping->get_mappped_value('map_table_names', $table);
		
		$query = "INSERT INTO $table_name ($str_columns) VALUES ('$str_values')";
		$dbh = self::$dbh->prepare($query);
		
		my_print($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		$last_id = self::$dbh->lastInsertId();
		
		return $last_id;
	}
	
	public static function update_data($table, $data, $key_field){
		$ar_columns = array();
		$str_columns = array();
		
		// Todo : use a validation class to get validation massages
		if (!is_string($table))
			die("\$table should be a string \n");
		
		if (!is_array($data))
			die("\$data should be an array \n");
		
		if (!is_string($key_field))
			die("\$key_field should be an array \n");
		
		
		if(isset($data[$key_field])) {
			$key_value =$data[$key_field];
			unset($data[$key_field]);
		} else {
			echo "The key field <em>$key_field</em> is not in the data.";
			die();
		}
		
		foreach($data as $col_name => $col_value){
			$ar_columns[] = "$col_name = '$col_value'";
		}
		
		$str_columns = join($ar_columns);
		$ob_mapping = new Mapping();
		$table_name = $ob_mapping->get_mappped_value('map_table_names', $table);
		
		$query = "UPDATE $table_name SET $str_columns WHERE $key_field = '$key_value'";
		$dbh = self::$dbh->prepare($query);
		
		//my_print($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		$last_id = self::$dbh->lastInsertId();
		
		return $last_id;
	}
	
	public static function saveMlpData($fpTypeID){
		$ob_mapping = new Mapping();
		
		$table_name = $ob_mapping->get_mappped_value('map_table_names', 'l_mlp_property');
		
		$querySelect = "SELECT 1 FROM $table_name WHERE listingType = 'rhsProject' AND fpTypeID = $fpTypeID AND specialListingID = 3";
		
		my_print($querySelect);
		
		$dbhSelect = self::$dbh->prepare($querySelect);
		
		if (! $dbhSelect) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbhSelect->execute();
		
		$ar_result = $dbhSelect->fetchAll(PDO::FETCH_ASSOC);
		
		# If result already exist then do nothing
		if(count($ar_result)){
			return false;
		}
		
		$queryInsert = "INSERT INTO $table_name (listingType, fpTypeID, specialListingID) VALUES ('rhsProject', $fpTypeID, 3)";
		
		$dbhInsert = self::$dbh->prepare($queryInsert);
		
		if (! $dbhInsert) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbhInsert->execute();
		$last_id = self::$dbh->lastInsertId();
		
		return $last_id;
	}
}

// Get Appointment class instance
$ob_listing = Prod_listing::get_instance();

?>