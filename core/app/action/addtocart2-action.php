<?php

if(!isset($_SESSION["cart2"])){
	$sell = array("sell_id"=>$_POST["sell_id"],"q"=>$_POST["q"]);
	$_SESSION["cart2"] = array($sell);
	$cart2 = $_SESSION["cart2"];
///////////////////////////////////////////////////////////////////
		$num_succ = 0;
		$process=false;
		$errors = array();
		foreach($cart2 as $c){
			///
			$q = PaymentData::getQYesF($c["sell_id"]);
//			echo ">>".$q;
			if($c["q"]<=$q){
				$num_succ++;
			}else{
				$error = array("sell_id"=>$c["sell_id"],"message"=>"No es posible hacer pago mayor a la deuda.");
				$errors[count($errors)] = $error;
			}
		}
///////////////////////////////////////////////////////////////////
//echo $num_succ;
if($num_succ > 0){
	$process = true;
}
if($process==false){
	unset($_SESSION["cart2"]);
$_SESSION["errors"] = $errors;
	?>
<script>
	$('#myModal').modal('show');
	newpayment();
</script>
<?php
}
}else {
$found = false;
$cart2 = $_SESSION["cart2"];
$index=0;
$q = PaymentData::getQYesF($_POST["sell_id"]);

$can = true;
if($_POST["q"]<=$q){
}else{
	$error = array("sell_id"=>$_POST["sell_id"],"message"=>"No hay suficiente cantidad de sello en inventarioOOOOO.");
	$errors[count($errors)] = $error;
	$can=false;
}

if($can==false){
$_SESSION["errors"] = $errors;
	?>
<script>
	$('#myModal').modal('show');
		newpayment();
		//window.location="index.php?view=payment";
</script>
<?php
}
?>

<?php
if($can==true){
foreach($cart2 as $c){
	if($c["sell_id"]==$_POST["sell_id"]){
		echo "found";
		$found=true;
		break;
	}
	$index++;
//	print_r($c);
//	print "<br>";
}

if($found==true){
	$q1 = $cart2[$index]["q"];
	$q2 = $_POST["q"];
	$cart2[$index]["q"]=$q1+$q2;
	$_SESSION["cart2"] = $cart2;
}

if($found==false){
    $nc = count($cart2);
	$sell = array("sell_id"=>$_POST["sell_id"],"q"=>$_POST["q"]);
	$cart2[$nc] = $sell;
//	print_r($cart2);
	$_SESSION["cart2"] = $cart2;
}
}
}
 print "<script>$('#myModal').modal('show');  newpayment();</script>";
// unset($_SESSION["cart2"]);
?>
