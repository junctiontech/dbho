<?php
date_default_timezone_set('America/New_York'); 

require_once('config/init.php');
require_once('classes/class_logger.php');
require_once('config/obdb.php');
require_once('classes/class_prod_listing.php');
require_once('classes/class_campaign.php');
require_once('classes/class_mappings.php');

class Test {
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
			self::$prod_list = new Test();
		}
		
		return self::$prod_list;
	}
	
	public static function test($fpTypeID){
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

$ob_test = Test::get_instance();

var_dump($ob_test::test(6));

?>