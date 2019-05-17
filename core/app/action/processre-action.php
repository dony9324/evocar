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
//////////////////////////////////
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
		}
			unset($_SESSION["reabastecer"]);
			setcookie("selled","selled");

	}

}
}
$resultado += array("id" => $s[1]);
	return print(json_encode($resultado));
?>
