<?php
class OperationData {
	public static $tablename = "operation";

	public function  __construct(){
		$this->id = 0;
		$this->product_id = 0;
		$this->id_group = 0;
		$this->q = 0;
		$this->precitotal = 0;
		$this->discount = 0;
		$this->change_price_out = 0;
		$this->change_price_in = 0;
		$this->operation_type_id = 0;
		$this->sell_id = 0;
		$this->user_id = 0;
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO `operation` (`id`, `product_id`, `q`, `precitotal`, `discount`, `change_price_out`, `change_price_in`, `operation_type_id`, `sell_id`, `user_id`, `created_at`) ";
		$sql .= "VALUES (NULL, $this->product_id, $this->q, $this->precitotal, $this->discount, $this->change_price_out, $this->change_price_in, $this->operation_type_id, $this->sell_id, $this->user_id, $this->created_at)";

			//\"\",\"\",,,,,,,,)";
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

// partiendo de que ya tenemos creado un objecto OperationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set product_id=\"$this->product_id\",q=\"$this->q\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by 'id' asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());

	}



	public static function getAllByDateOfficial($start,$end){
 $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" order by created_at desc";
		if($start == $end){
		 $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByDateOfficialBP($product, $start,$end){
 $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and product_id=$product order by created_at desc";
		if($start == $end){
		 $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public function getProduct(){ return ProductData::getById($this->product_id);}
	/*public function getOperationtype(){ return OperationTypeData::getById($this->operation_type_id);}*/





	public static function getQYesF($product_id){
		$q=0;
		$q2=0;
		$product = ProductData::getById($product_id);// los datos del producto
		////aki se buscan y calculan las operaciones dela presentacion principal
		$operations = self::getAllByProductId($product_id);
			foreach($operations as $operation){
				if($operation->operation_type_id==1){ $q+=$operation->q; }
				else if($operation->operation_type_id==2){  $q+=(-$operation->q); }

			}
		///aki buscamos las operaciones de las presentaciones segundarias las convertimos y la sumamos la la cantidad principal
		if ($product->other_presentations == 1) {
			$other_presentations = ProductData::getById_group($product_id);
			//$q = $q +1;


			foreach ( $other_presentations as $other) {
				//$q = $q +1;
				$qtmp=0;
				$operationstmp = self::getAllByProductId($other->id);

			foreach($operationstmp as $operationtmp){
				//$q = $q +1;
				if($operationtmp->operation_type_id==1){ $qtmp = $qtmp + $operationtmp->q ;

				 }
				else if($operationtmp->operation_type_id==2){  $qtmp = $qtmp - $operationtmp->q; }
			}
///el error era que confundi la variable operation con operationtmp
			$q2 = $q2 + ($qtmp *$other->group_amount / $other->fractions);

			}
}
		//	$q= $q + 1;
		$q= $q + $q2;
		// print_r($data);
//$q= $q2;
		return $q;
	}



	public static function getQprice($product_id){
		$q=0;
		$p=0;
		$entradas=0;
		$salidas=0;
		$qt=0;
		$operations = self::getAllByProductId($product_id);
		//obtenemos las entradas y las salidas
				foreach($operations as $operation){
				if($operation->operation_type_id==1){
					 $q+=$operation->q;
					 $entradas+=$operation->q;
				 }
				else if($operation->operation_type_id==2){
					 $q+=(-$operation->q);
					 $salidas+=$operation->q;
				  }
		}
//buscamos el precion por donde va la cuenta
		foreach($operations as $operation){
		if($operation->operation_type_id==1){
			$salidas+=(-$operation->q);//al total de las salidas le resto las entradas
				$qt=$operation->q;
				if ($salidas<0) {
					$p=$operation->change_price_out;
					$qt= $q - ($q-$salidas);
					break;
				}
 		if ($p==0) {
			$p=$operation->change_price_out;
 		}
		 }
		else if($operation->operation_type_id==2){
			/*  $entradas+=(-$operation->q);//al total de las entradas le reto la salidas
				if ($entradas==q) {
					$p=$operation->price_out;
				}*/
//	 $salidas+=$operation->q;
			}
		}
		  $resultado = array("Precio" => $p, "Cantidad"=>$qt, "q"=>$q);
		return $resultado;
	}


	public static function getAllByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id  order by created_at asc
		";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getAllByProductIdCutIdOficial($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		return Model::many($query[0],new OperationData());
	}


	public static function getAllProductsBySellId($sell_id){
		$sql = "select * from ".self::$tablename." where sell_id=$sell_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getAllByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		return Model::many($query[0],new OperationData());
		return $array;
	}

////////////////////////////////////////////////////////////////////
	public static function getOutputQ($product_id,$cut_id){
		$q=0;
		$operations = self::getOutputByProductIdCutId($product_id,$cut_id);
		$input_id = 1;
		$output_id = 2;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getOutputQYesF($product_id){
		$q=0;
		$operations = self::getOutputByProductId($product_id);
		$input_id = 1;
		$output_id = 2;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getInputQYesF($product_id){
		$q=0;
		$operations = self::getInputByProductId($product_id);
		$input_id = 1;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
		}
		// print_r($data);
		return $q;
	}



	public static function getOutputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getOutputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

////////////////////////////////////////////////////////////////////
	public static function getInputQ($product_id,$cut_id){
		$q=0;
		return Model::many($query[0],new OperationData());
		$operations = self::getInputByProductId($product_id);
		$input_id = 1;
		$output_id = 2;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}


	public static function getInputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getInputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getInputByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

////////////////////////////////////////////////////////////////////////////


}

?>
