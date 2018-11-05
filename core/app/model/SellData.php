<?php
class SellData {
	public static $tablename = "sell";

	public function  __construct(){
		$this->id = "";
		$this->person_id = "";
		$this->total = "";
		$this->	cost = "";
		$this->user_id = "";
		$this->accredit = "";
		$this->accreditlast = "";
		$this->box_id = "";
		$this->didcount = "0";
		$this->created_at = "NOW()";

	}

	public function getPerson(){ return PersonData::getById($this->person_id);}
	public function getUser(){ return UserData::getById($this->user_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (total,cost,discount,user_id,created_at) ";
		$sql .= "value ($this->total,$this->cost,$this->discount,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function add_re(){
		$sql = "insert into ".self::$tablename." (user_id,operation_type_id,total,created_at) ";
		$sql .= "value ($this->user_id,1,$this->total,$this->created_at)";
		return Executor::doit($sql);
	}


	public function add_with_client(){
		$sql = "insert into ".self::$tablename." (total,cost,accredit,accreditlast,discount,person_id,user_id,created_at) ";
		$sql .= "value ($this->total,$this->cost,$this->switch_2,$this->accreditlast,$this->discount,$this->person_id,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function add_re_with_client(){
		$sql = "insert into ".self::$tablename." (person_id,operation_type_id,user_id,total,created_at) ";
		$sql .= "value ($this->person_id,1,$this->user_id,$this->total,$this->created_at)";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update_box(){
		$sql = "update ".self::$tablename." set box_id=$this->box_id where id=$this->id";
		Executor::doit($sql);
	}
	public function update_accredit(){
		$sql = "update ".self::$tablename." set accredit=0 where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SellData());
	}
public static function getById2($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

public static function getByperson_id($id){
		 $sql = "select * from ".self::$tablename." where person_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSells(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsUnBoxed(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and accredit=0 and box_id is NULL order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}
	public static function getSellsUnBoxed2(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and accredit=1 and box_id is NULL order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getByBoxId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and box_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getRes(){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id<=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}
////////////////////////para obtener la ventar entre dos fechas////////////////////////

	public static function getAllByDateOpp($start,$end,$op){
  $sql = "select * from ".self::$tablename." where date(created_at) BETWEEN '$start' AND '$end' and operation_type_id=$op order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	////////////////////////para obtener la ventar entre dos fechas////////////////////////

	public static function getAllByDateOp($start,$end,$op){
  $sql = "select * from ".self::$tablename." where date(created_at) BETWEEN '$start' AND '$end' and operation_type_id=$op and accreditlast=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}
	////////////////////////para obtener los creditos entre dos fechas////////////////////////
		public static function getAllByDateOp2($start,$end,$op){
  $sql = "select * from ".self::$tablename." where date(created_at) BETWEEN '$start' AND '$end' and operation_type_id=$op and accreditlast=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getAllByDateBCOp($clientid,$start,$end,$op){
 $sql = "select * from ".self::$tablename." where date(created_at) BETWEEN '$start' AND '$end' and operation_type_id=$op and person_id= $clientid order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}

}

?>
