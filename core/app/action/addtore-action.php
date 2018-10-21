<?php

if(!isset($_SESSION["reabastecer"])){


	$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"]);
	$_SESSION["reabastecer"] = array($product);


	$cart = $_SESSION["reabastecer"];

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

$process=true;


}else {

$found = false;
$cart = $_SESSION["reabastecer"];
$index=0;

$q = OperationData::getQYesF($_GET["product_id"]);





$can = true;

?>

<?php
if($can==true){
foreach($cart as $c){
	if($c["product_id"]==$_GET["product_id"]){
		echo "found";
		$found=true;
		break;
	}
	$index++;
//	print_r($c);
//	print "<br>";
}

if($found==true){
	$q1 = $cart[$index]["q"];
	$q2 = $_GET["q"];
	$cart[$index]["q"]=$q1+$q2;
	$_SESSION["reabastecer"] = $cart;
}

if($found==false){
    $nc = count($cart);
	$product = array("product_id"=>$_GET["product_id"],"q"=>$_GET["q"]);
	$cart[$nc] = $product;
//	print_r($cart);
	$_SESSION["reabastecer"] = $cart;
}

}
}
print "<script>window.location='index.php?view=re';</script>";
// unset($_SESSION["reabastecer"]);

?>