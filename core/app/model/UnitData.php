<?php
class UnitData {
	public static $tablename = "unit";
	public function  __construct(){
		$this->id = "";
		$this->equivalent_id = "";
		$this->name = "";
		$this->description = "";
		$this->abbreviation = "";
		$this->value_equivalent = "";
		$this->fractions = "";
		$this->type = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}
	public function add(){
		$sql = "insert into unit (name,description,abbreviation,user_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->description\",\"$this->abbreviation\",\"$this->user_id\",$this->created_at)";
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
// partiendo de que ya tenemos creado un objecto UnitData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",description=\"$this->description\" where id=$this->id";
		Executor::doit($sql);
	}
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new UnitData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->equivalent_id = $r['equivalent_id'];
			$data->name = $r['name'];
			$data->description = $r['description'];
			$data->abbreviation = $r['abbreviation'];
			$data->value_equivalent	 = $r['value_equivalent	'];
			$data->fractions = $r['fractions'];
			$data->type = $r['type'];
			$data->user_id = $r['user_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}
	public static function getAll(){
		$sql = "select * from ".self::$tablename ." ORDER BY id ";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new UnitData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->equivalent_id = $r['equivalent_id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->description = $r['description'];
			$array[$cnt]->abbreviation = $r['abbreviation'];
			$array[$cnt]->value_equivalent  = $r['value_equivalent'];
			$array[$cnt]->fractions = $r['fractions'];
			$array[$cnt]->type = $r['type'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new UnitData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->description = $r['description'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}
}
?>
