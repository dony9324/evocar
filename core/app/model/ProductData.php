<?php
class ProductData {
	public static $tablename = "product";
	public function  __construct(){
		$this->id = "";
		$this->id_group = ""; //hace referencia al producto principal en caso de ser una variacion de este si vale cero no es una variacion
		$this->group_amount = "";
		$this->fractions = "";
		$this->total_quantity = ""; // es la cantidad traducida ala presentacion principal
		$this->image = "";
		$this->extracode = "";
		$this->name = "";
		$this->barcode = "";
		$this->description = "";
		$this->location = "";
		$this->trademark_id = "";
		$this->category_id = "";
		$this->type_of_iva_id = "";
		$this->unit_id = "";
		$this->cantidad = "";//es la cantidad de la unidad ej si la unidad es metro y el producto mide 6 metros aki se indica
		$this->other_presentations = "";//indica si tiene otras presentaciones
		$this->price_in = "";
		$this->price_out = "";
		$this->inventary_min = "";
		$this->control_stock = "";
		$this->divide = "";
		$this->is_active = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
	}
	public function getCategory(){ return CategoryData::getById($this->category_id);}
	public function add(){
		$sql = "insert into ".self::$tablename." (id_group,group_amount,fractions,total_quantity,image,extracode,name,barcode,description,location,trademark_id,category_id,type_of_iva_id,unit_id,cantidad,other_presentations,price_in,price_out,inventary_min,control_stock,divide,is_active,user_id,created_at) ";
		$sql .= "value (\"$this->id_group\",\"$this->group_amount\",\"$this->fractions\",\"$this->total_quantity\",\"$this->image\",\"$this->extracode\",\"$this->name\",\"$this->barcode\",\"$this->description\",\"$this->location\",\"$this->trademark_id\",\"$this->category_id\",\"$this->type_of_iva_id\",\"$this->unit_id\",\"$this->cantidad\",\"$this->other_presentations\",\"$this->price_in\",\"$this->price_out\",\"$this->inventary_min\",\"$this->control_stock\",\"$this->divide\",\"$this->is_active\",\"$this->user_id\",NOW())";
		//antes -> return Executor::doit($sql);
		//despues, guardar el id de la ultima incercion en mysql
		$query = Executor::doit($sql);
		$_SESSION["insert_id"] = $query[1];

	}
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}
	// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set barcode=\"$this->barcode\",name=\"$this->name\",price_in=\"$this->price_in\",price_out=\"$this->price_out\",unit=\"$this->unit\",presentation=\"$this->presentation\",category_id=$this->category_id,inventary_min=\"$this->inventary_min\",description=\"$this->description\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}
	public function del_categoryiva(){
		$sql = "update ".self::$tablename." set type_of_iva_id=NULL where id=$this->id";
		Executor::doit($sql);
	}
	public function del_trademark(){
		$sql = "update ".self::$tablename." set trademark_id=NULL where id=$this->id";
		Executor::doit($sql);
	}
	public function update_image(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";
		Executor::doit($sql);
	}
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());
	}
	public static function getAll(){
		$sql = "select * from ".self::$tablename." ORDER BY id asc" ;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getAll2(){
		$sql = "select * from ".self::$tablename." ORDER BY id asc" ;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where id_group = 0 and (barcode like '%$p%' or name like '%$p%' or id like '%$p%') and is_active = 1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getAllByCategoryId($category_id){
		$sql = "select * from ".self::$tablename." where category_id=$category_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
	public static function getAllByCategoryIvaId($category_id){
		$sql = "select * from ".self::$tablename." where type_of_iva_id = $category_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
}
?>
