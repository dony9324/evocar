<?php
class BodegaData {
	public static $tablename = "bodega";
	public function  __construct(){
		$this->id = "";
		$this->operation_id = "";
		$this->q = "";
		$this->product_id = "";
		$this->operation_type_id = "";
		$this->almacemaiento_id= "";
		$this->almacemaiento_id2= NULL;
		$this->type= "";
		$this->user_id = "";
		$this->created_at = "NOW()";
		$this->cancel= "";
	}
	public function add(){ //nigun dato puede faltar porque da error
		$sql = "INSERT INTO bodega (id, operation_id, q, product_id, operation_type_id, almacenamiento_id, almacenamiento_id2, type, user_id, created_at, cancel)";
		$sql .= " VALUES (NULL, '$this->operation_id', '$this->q', '$this->product_id', '$this->operation_type_id', '$this->almacemaiento_id', '$this->almacemaiento_id2', '$this->type', '$this->user_id', '$this->created_at', NULL)";
		Executor::doit($sql);
	}

	public function add_with_image(){
		$sql = "insert into bodega (name,name_corto,location,image,color,user_id,created_at) ";
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

// partiendo de que ya tenemos creado un objecto BodegaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",description=\"$this->description\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new BodegaData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->name = $r['name'];
			$data->name_corto = $r['name_corto'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}
	public static function getAlloperation_id($id){
		$sql = "select * from ".self::$tablename." where operation_id=".$id;
		$query = Executor::doit($sql);
		$cnt=0;
		$array = array();
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new BodegaData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->operation_id = $r['operation_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->almacenamiento_id = $r['almacenamiento_id'];
			$array[$cnt]->almacenamiento_id2 = $r['almacenamiento_id2'];
			$array[$cnt]->type = $r['type'];
			$array[$cnt]->user_id = $r['user_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$array[$cnt]->cancel = $r['cancel'];
			$cnt++;
		}
		return $array;
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename ." ORDER BY id ";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new BodegaData();
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
			$array[$cnt] = new BodegaData();
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
