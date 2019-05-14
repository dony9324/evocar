<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");
	$errors = array();
if(!isset($_SESSION["reabastecer"])){
	$p = ProductData::getById($_GET["product_id"]);
	$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"], "price_out"=>$p->price_out, "price_in"=>$p->price_in);
	$_SESSION["reabastecer"] = array($product);
	$cart = $_SESSION["reabastecer"];
////////////////////////////////////////////////////////////////
$process=true;
}else {
$found = false;
$cart = $_SESSION["reabastecer"];
$index=0;
$can = true;
?>
<?php
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
	$_SESSION["reabastecer"] = $cart;
}
if($found==false){
	$p = ProductData::getById($_GET["product_id"]);
  $nc = count($cart);
	$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"], "price_out"=>$p->price_out, "price_in"=>$p->price_in);
	$cart[$nc] = $product;
//	print_r($cart);
	$_SESSION["reabastecer"] = $cart;
}
}
}
	return print(json_encode($resultado));
?>
