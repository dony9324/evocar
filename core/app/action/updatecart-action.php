<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
	$errors = array();
if(!isset($_SESSION["cart"])){
$resultado = array("estado" => "false");
}else {
$found = false;
$cart = $_SESSION["cart"];
$index=0;
$can = true;
if($can==true){
foreach($cart as $c){
	if($c["product_id"]==$_GET["product_id"]){
		$found=true;
		break;
	}
	$index++;
}
if($found==true){
	$cart[$index]["price_out"]= $_GET["price_out"];
	$cart[$index]["descuento"]= $_GET["descuento"];
	$_SESSION["cart"] = $cart;
}
}
}
	return print(json_encode($resultado));
?>
