<?php
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "true");
	if (isset($_GET["o"]) AND $_GET["o"]="one") {
				$op = new OperationData();
				$op->product_id = $_GET["product_id"]  ;
				$op->operation_type_id=1;
				$op->q= $_GET["product_q"];
				$op->change_price_in=$_GET["price_in"];
				$op->sell_id="NULL";
				$op->user_id=$_SESSION["user_id"];
				$op->is_oficial = 1;
				if($add = $op->add()){
				$resultado = array("estado" => "true");
					return print(json_encode($resultado));
	}else {
		$resultado = array("estado" => "false");
	}
}else {
if(isset($_SESSION["reabastecer"])){
	$cart = $_SESSION["reabastecer"];
	if(count($cart)>0){
////rigistramos la compra
			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->total = $_POST["total"];
			$sell->accredit = $_POST["acreditar"];
			$sell->accreditlast = $_POST["acreditar"];
			$sell->extracode = "0";
		 	$sell->person_id=$_POST["client_id"];
			if( $s = $sell->add_re_with_client()){
		 	}else {
		 	$resultado = array("estado" => "false");
		 	}
////rigistramos las entradas de productos
		foreach($cart as  $c){
			$op = new OperationData();
			 $op->product_id = $c["product_id"] ;
			 $op->q= $c["q"];
			 $op->precitotal= $c["q"]*$c["price_in"];;
			 $op->discount= 0;
			 $op->change_price_out= $c["price_out"];
			 $op->change_price_in= $c["price_in"];
			 $op->operation_type_id=1; // 1 - entrada
			 $op->sell_id=$s[1];
			 $op->user_id =  $_SESSION["user_id"];
			 if($add = $op->add()){

 	 		}else {
	 		$resultado = array("estado" => "false");
 			}
			////rigistramos el almacemaiento temporalmente se registran en la bodega principal
			$almacemaiento=AlmacenamientosData::getAll();
			$bodega = new BodegaData();
			$bodega->operation_id = $add[1];
			$bodega->q = $op->q;
			$bodega->product_id = $op->product_id;
			$bodega->operation_type_id = 1; //entrada 2 salida esta es para el calculo rapido de inventario;
			$bodega->created_at = "NOW()";
			$bodega->almacemaiento_id = 1;
			$bodega->almacenamiento_id2 = NULL;
			$bodega->type = 1;
			$bodega->user_id = $_SESSION["user_id"];
			if (count($almacemaiento)>0) {
			foreach ($almacemaiento as $key) {
			 if ($key->id==1) {
				 $bodega->almacemaiento_id = $key->id;
				 $bodega->q = $op->q;
					$bodega->add();
			 }else {
				 $bodega->almacemaiento_id = $key->id;
				 $bodega->q=0;
				 $bodega->add();
			 }
			}
			}
		}
			unset($_SESSION["reabastecer"]);
			setcookie("selled","selled");
			setcookie("bodega",$s[1],(time()+1600));///segundos
	}
}
}
$resultado += array("id" => $s[1]);
	return print(json_encode($resultado));
?>
