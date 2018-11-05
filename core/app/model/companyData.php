<?php
class CompanyData {
	public static $tablename = "company";

	public function  __construct(){
		$this->id = "";
		$this->name = "";
		$this->value = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,value) ";
		$sql .= "value (\"$this->name\",\"$this->value\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}
public function update(){
		$sql = "update ".self::$tablename." set value=\"$this->value\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CompanyData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CompanyData());
	}
}
?>
