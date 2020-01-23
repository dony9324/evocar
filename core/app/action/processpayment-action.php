<?php

if(isset($_SESSION["cart2"])){
	$cart2 = $_SESSION["cart2"];
	if(count($cart2)>0){
/// antes de proceder con lo que sigue vamos a verificar que:
		// haya existencia de sellos
		// si se va a facturar la cantidad a facturr debe ser menor o igual al sello facturado en inventario
		$num_succ = 0;
		$process=false;
		$errors = array();
		foreach($cart2 as $c){

			///
			$q = PaymentData::getQYesF($c["sell_id"]);
			if($c["q"]<=$q){
				if(isset($_POST["is_oficial"])){
				$qyf =PaymentData::getQYesF($c["sell_id"]); /// son los sellos que puedo facturar
				if($c["q"]<=$qyf){
					$num_succ++;
				}else{
				$error = array("sell_id"=>$c["sell_id"],"message"=>"No hay suficiente cantidad de sello para facturar en inventario.");
				$errors[count($errors)] = $error;
				}
				}else{
					// si llegue hasta aqui y no voy a facturar, entonces continuo ...
					$num_succ++;
				}
			}else{
				$error = array("sell_id"=>$c["sell_id"],"message"=>"No hay suficiente cantidad de sello en inventario.");
				$errors[count($errors)] = $error;
			}

		}

if($num_succ==count($cart2)){
	$process = true;
}

if($process==false){
$_SESSION["errors"] = $errors;
	?>
<script>
$('#myModal').modal('show');
newpayment();
	//window.location="index.php?view=payment";
</script>
<?php
}


/*fin de verificacion*/

//////////////////////////////////
		if($process==true){
			$sell = new PaymentData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->sell_id = $_POST["sell_id"];
			$sell->payment = $_POST["payment"];
			$sell->person_id = $_POST["person_id"];

	  				$s = $sell->add();


////////////////////
print "<script>window.location='index.php?view=onepayment&id=$s[1]';</script>";
		}
	}
}



?>
