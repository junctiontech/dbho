<?php

class Prod_listing {
	private static $dbh;
	private static $prod_list = NULL;
	
	private function __construct(){
		$ob_db = new DB();
		
		try {
			self::$dbh = new PDO('mysql:host=' . $ob_db->p_host . ';dbname=' . $ob_db->p_db, $ob_db->p_user, $ob_db->p_pass);
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
		$table_name = $ob_mapping->get_mappped_value($table_name);
		
		$query = "SELECT * FROM $table_name ";
		
		if($id_field !=  '' && $id_value !=  '') {
			$query .= "WHERE $id_field = $id_value";
		}
		
		$dbh = self::$dbh->prepare($query);
		
		if (! $dbh) {
			my_print(self::$dbh->errorInfo());
			die();
		}
		
		$dbh->execute();
		
		return $dbh->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	/*public static function get_appointment_data($table_name, $appointmentID, $column_name = NULL) {
		if(empty($appointmentID)) {
			die("The appointmentID can not be null. \n");
		}
		
		if (!is_numeric($appointmentID)) {
			die("The appointmentID should be numeric. \n");
		}
		
		$column_name = $column_name ? $column_name : 'appointmentID';
		
		// To do - validate the $table_name
		$ob_mapping = new Mapping();
		
		$data = self::get_data($ob_mapping->get_mappped_value($table_name), $column_name, $appointmentID);
		
		return $data;
	}*/
	
	public static function get_complted_appointments() {
		$app_data_dbh = self::$dbh->prepare("
		SELECT a.* 
		FROM rp_appointments a
		WHERE a.appointmentStatus = 'Complete'
		AND not exists (SELECT * FROM rp_appointment_property ap
						WHERE ap.apid = a.appointmentID)
		");

		$app_data_dbh->execute();

		return $app_data_dbh->fetchAll(PDO::FETCH_ASSOC);
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
	
}

// Get Appointment class instance
$ob_listing = Prod_listing::get_instance();

?>