<?php
class PersonData {
	public static $tablename = "person";
	public function  __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->identity = "";
		$this->image = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add_client(){
		$sql = "insert into person (name,lastname,identity,address1,email1,phone1,phone2,company,nit,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->identity\",\"$this->address1\",\"$this->email1\",\"$this->phone1\",\"$this->phone2\",\"$this->company\",\"$this->nit\",1,$this->created_at)";
		Executor::doit($sql);
	}

	public function add_client_with_image(){
		$sql = "insert into person (name,image,lastname,identity,address1,email1,phone1,phone2,company,nit,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->image\",\"$this->lastname\",\"$this->identity\",\"$this->address1\",\"$this->email1\",\"$this->phone1\",\"$this->phone2\",\"$this->company\",\"$this->nit\",1,$this->created_at)";
		Executor::doit($sql);
	}



	public function add_provider(){
		$sql = "insert into person (name,lastname,identity,address1,email1,phone1,phone2,company,nit,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->identity\",\"$this->address1\",\"$this->email1\",\"$this->phone1\",\"$this->phone2\",\"$this->company\",\"$this->nit\",2,$this->created_at)";
		Executor::doit($sql);
	}

	public function add_provider_with_image(){
		$sql = "insert into person (name,image,lastname,identity,address1,email1,phone1,phone2,company,nit,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->image\",\"$this->lastname\",\"$this->identity\",\"$this->address1\",\"$this->email1\",\"$this->phone1\",\"$this->phone2\",\"$this->company\",\"$this->nit\",2,$this->created_at)";
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

	// partiendo de que ya tenemos creado un objecto PersonData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email1=\"$this->email1\",address1=\"$this->address1\",lastname=\"$this->lastname\",phone1=\"$this->phone1\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_client(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email1=\"$this->email1\",address1=\"$this->address1\",lastname=\"$this->lastname\",phone1=\"$this->phone1\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_provider(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email1=\"$this->email1\",address1=\"$this->address1\",lastname=\"$this->lastname\",phone1=\"$this->phone1\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}
	public static function getById2($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new PersonData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->name = $r['name'];
			$data->lastname = $r['lastname'];
			$data->address1 = $r['address1'];
			$data->phone1 = $r['phone1'];
			$data->email1 = $r['email1'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by 'id' asc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->lastname = $r['lastname'];
			$array[$cnt]->email = $r['email1'];
			$array[$cnt]->username = $r['username'];
			$array[$cnt]->phone1 = $r['phone1'];
			$array[$cnt]->address1 = $r['address1'];
			$array[$cnt]->created_at = $r['created_at'];

			$array[$cnt]->image = $r['image'];
			$array[$cnt]->company = $r['company'];
			$array[$cnt]->identity = $r['identity'];
			$array[$cnt]->nit = $r['nit'];
			$array[$cnt]->phone2 = $r['phone2'];

			$cnt++;
		}
		return $array;
	}

	public static function getClients(){
		$sql = "select * from ".self::$tablename." where kind=1 order by name,lastname";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->lastname = $r['lastname'];
			$array[$cnt]->email1 = $r['email1'];
			$array[$cnt]->phone1 = $r['phone1'];
			$array[$cnt]->address1 = $r['address1'];
			$array[$cnt]->created_at = $r['created_at'];

			$array[$cnt]->image = $r['image'];
			$array[$cnt]->company = $r['company'];
			$array[$cnt]->identity = $r['identity'];
			$array[$cnt]->nit = $r['nit'];
			$array[$cnt]->phone2 = $r['phone2'];

			$cnt++;
		}
		return $array;
	}


	public static function getProviders(){
		$sql = "select * from ".self::$tablename." where kind=2 order by name,lastname";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->lastname = $r['lastname'];
			$array[$cnt]->email1 = $r['email1'];
			$array[$cnt]->phone1 = $r['phone1'];
			$array[$cnt]->address1 = $r['address1'];
			$array[$cnt]->created_at = $r['created_at'];


			$array[$cnt]->image = $r['image'];
			$array[$cnt]->company = $r['company'];
			$array[$cnt]->identity = $r['identity'];
			$array[$cnt]->nit = $r['nit'];
			$array[$cnt]->phone2 = $r['phone2'];

			$cnt++;
		}
		return $array;
	}

	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where identity like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


}

?>
