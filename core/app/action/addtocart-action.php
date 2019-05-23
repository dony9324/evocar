<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
	$errors = array();
if(!isset($_SESSION["cart"])){
	$p = ProductData::getById($_GET["product_id"]);
	$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"], "price_out"=>$p->price_out, "descuento"=>0);
	$_SESSION["cart"] = array($product);
	$cart = $_SESSION["cart"];
	$num_succ = 0;
	$process=false;
	foreach($cart as $c){
			$productdatos = ProductData::getById($c["product_id"]);
			$q = OperationData::getQYesF($c["product_id"]);
			if($c["q"]<=$q){
				$num_succ++;
			}else{
				if ($productdatos->control_stock==1) {
					$rre = $c["q"] - $q;
					$resultado = array("estado" => "false");
					$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario.","re"=>$rre);
					$errors[count($errors)] = $error;
				}else {
					$num_succ++;
				}

			}
		}

	if($num_succ==count($cart)){
		$process = true;
	}
	if($process==false){
		unset($_SESSION["cart"]);
		$_SESSION["errors"] = $errors;
	}
}else {

	$found = false;
	$cart = $_SESSION["cart"];
	$index=0;
	$q = OperationData::getQYesF($_GET["product_id"]);
	$can = true;
	if($_GET["q"]<=$q){
	}else{
		$productdatos = ProductData::getById($_GET["product_id"]);
		if ($productdatos->control_stock==1) {
		$rre = $_GET["q"] - $q;
		$resultado = array("estado" => "false");
		$error = array("product_id"=>$_GET["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario.","re"=>$rre);
		$errors[count($errors)] = $error;
		$can=false;
	}
	}
	if($can==false){
		$_SESSION["errors"] = $errors;
	}
	if($can==true){
		foreach($cart as $c){
			if($c["product_id"]==$_GET["product_id"]){
				$found=true;
				break;
			}
			$index++;
		}
		if($found==true){
			$q1 = $cart[$index]["q"];
			$q2 = $_GET["q"];
			$cart[$index]["q"]=$q1+$q2;
			///////////////////////////////////
			if(($q1+$q2) <=$q){
			}else{
				$productdatos = ProductData::getById($_GET["product_id"]);
				if ($productdatos->control_stock==1) {
				$rre = ($q1+$q2) - $q;
				$resultado = array("estado" => "false");
				$error = array("product_id"=>$_GET["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario.","re"=>$rre);
				$errors[count($errors)] = $error;
				$can=false;
			}
			}
			if($can==false){
				$_SESSION["errors"] = $errors;
			}
			if($can==true){
				$_SESSION["cart"] = $cart;
			}
		}
		if($found==false){
			$p = ProductData::getById($_GET["product_id"]);
			$q = OperationData::getQYesF($c["product_id"]);
			if($c["q"]<=$q){
				$nc = count($cart);
				$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"], "price_out"=>$p->price_out, "descuento"=>0);
				$cart[$nc] = $product;
				$_SESSION["cart"] = $cart;
			}else{
				if ($productdatos->control_stock==1) {
					$rre = $c["q"] - $q;
					$resultado = array("estado" => "false");
					$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario.","re"=>$rre);
					$errors[count($errors)] = $error;
				}else {
					$nc = count($cart);
					$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"], "price_out"=>$p->price_out, "descuento"=>0);
					$cart[$nc] = $product;
					$_SESSION["cart"] = $cart;
				}
			}
		}
	}
}
	return print(json_encode($resultado));
?>
