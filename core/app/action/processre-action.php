<?php
	header('Content-type: application/json');
if(isset($_SESSION["reabastecer"])){
	$cart = $_SESSION["reabastecer"];
	if(count($cart)>0){
$process = true;
//////////////////////////////////
		if($process==true){
			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->total = $_POST["total"];
			 if(isset($_POST["client_id"]) && $_POST["client_id"]!=""){
			 	$sell->person_id=$_POST["client_id"];
 				$s = $sell->add_re_with_client();
			 }else{
 				$s = $sell->add_re();
			 }
		foreach($cart as  $c){
			$op = new OperationData();
			 $op->product_id = $c["product_id"] ;
			 $op->operation_type_id=1; // 1 - entrada

			 $op->sell_id=$s[1];
			 $op->q= $c["q"];
			if(isset($_POST["is_oficial"])){
				$op->is_oficial = 1;
			}
			$add = $op->add();
		}
			unset($_SESSION["reabastecer"]);
			setcookie("selled","selled");
////////////////////
print "<script>window.location='index.php?view=onere&id=$s[1]';</script>";
		}
	}
}
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
return print(json_encode($resultado));
}
}
?>
