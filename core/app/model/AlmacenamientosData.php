<?php
class AlmacenamientosData {
	public static $tablename = "almacenamientos";
	public function  __construct(){
		$this->id = "";
		$this->name = "";
		$this->name_corto = "";
		$this->location = "";
		$this->image = "";
		$this->color= "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}
	public function add(){
		$sql = "insert into almacenamientos (name,name_corto,location,color,user_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->name_corto\",\"$this->location\",\"$this->color\",\"$this->user_id\",$this->created_at)";
		Executor::doit($sql);
	}

	public function add_with_image(){
		$sql = "insert into almacenamientos (name,name_corto,location,image,color,user_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->name_corto\",\"$this->location\",\"$this->image\",\"$this->color\",\"$this->user_id\",$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto AlmacenamientosData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",description=\"$this->description\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new AlmacenamientosData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->name = $r['name'];
			$data->name_corto = $r['name_corto'];
			$data->color = $r['color'];
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
			$array[$cnt] = new AlmacenamientosData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
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
			$array[$cnt] = new AlmacenamientosData();
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
