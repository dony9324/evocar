<?php
class Database {
	public static $db;
	public static $con;
	function  __construct(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="evocar";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con -> set_charset("utf8");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}

}
?>
