<?php
class Database {
	public static $db;
	public static $con;
	function  __construct(){
		///evocar es la oficial ya 2020 - 01 -14
			$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="evocar";
		//	$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="evocarpruevas";
			if ($this->ddbb=="evocarpruevas") {
				$_SESSION['pruevas']=true;
			}else {
				$_SESSION['pruevas']=false;
			}
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
