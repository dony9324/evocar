<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");

if(count($_POST)>0){
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		if(count($cart)>0){
			/// antes de proceder con lo que sigue vamos a verificar que:
			// haya existencia de productos
			// si se va a facturar la cantidad a facturr debe ser menor o igual al producto facturado en inventario
			$num_succ = 0;
			$process=false;
			$errors = array();
			foreach($cart as $c){
				$productdatos = ProductData::getById($c["product_id"]);
				if ($productdatos->control_stock == 1){
					if ($productdatos->other_presentations==1) {
						if ($productdatos->id_group==0) {
							//si llego aki este producto tiene mas presentaciones y esta la presentacion principal
							$q = OperationData::getQYesF($c["product_id"]);
							if($c["q"]<=$q){
								$num_succ++;
							}else{
								$productdatos = ProductData::getById($c["product_id"]);
								if ($productdatos->control_stock==1) {
									$rre = $c["q"] - $q;
									$resultado = array("estado" => "false");
									$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario 2.","re"=>$rre);
									$errors[count($errors)] = $error;
								}
							}
						}else {
							//si llego aki esta es una presentacion segundaria Y SE 	MIDE LA CANTIDAD DE LA principal
							$q = OperationData::getQYesF($productdatos->id_group);
							if(( $c["q"]*$productdatos->total_quantity) <=$q){
								$num_succ++;
							}else{
								$productdatos = ProductData::getById($c["product_id"]);
								if ($productdatos->control_stock==1) {
									$rre = $c["q"] - $q;
									$resultado = array("estado" => "false");
									$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario 3.","re"=>$rre);
									$errors[count($errors)] = $error;
								}
							}
						}
					}else {
						//si llego aki este producto NO tiene mas presentacioneS
						$q = OperationData::getQYesF($c["product_id"]);
						if($c["q"]<=$q){
							$num_succ++;
						}else{
							$productdatos = ProductData::getById($c["product_id"]);
							if ($productdatos->control_stock==1) {
								$rre = $c["q"] - $q;
								$resultado = array("estado" => "false");
								$error = array("product_id"=>$c["product_id"],"message"=>"No hay suficiente cantidad de producto en inventario 4.","re"=>$rre);
								$errors[count($errors)] = $error;
							}
						}
					}
				}else{$num_succ++;}
			}
			if($num_succ==count($cart)){
				$process = true;
			}
			if($process==false){
				$_SESSION["errors"] = $errors;
			}
			/*fin de verificacion*/
			/////////////////////////////////
			if($process==true){
				$sell = new SellData();
				$sell->accredit = $_POST["switch_2"];
				$sell->accreditlast = $_POST["switch_2"];
				$sell->total = $_POST["total"];
				$sell->cost = $_POST["cost"];
				$sell->adelanto = $_POST["adelanto"];
				$sell->cantidad_adelanto = $_POST["cantidad_adelanto"];
				$sell->money_person = $_POST["money"];
				$sell->entrega = $_POST["entrega"];
				$sell->extracode = ""; //este campo no tiene uso actualmente
				foreach($cart as  $c){
					$sell->discount += $c["descuento"];
				}
				$sell->user_id = $_SESSION["user_id"];
				if(isset($_POST["client_id"]) && $_POST["client_id"]!=""){
					$sell->person_id=$_POST["client_id"];
					$s = $sell->add_with_client();
				}else{
					$s = $sell->add();
				}
				if ($s[1]!=0) {//si la primera trasacion no fallo
					foreach($cart as  $c){
						//////////voy por aki
						$productdatos = ProductData::getById($c["product_id"]);
						$op = new OperationData();
						$op->product_id = $c["product_id"];
						$op->q= $c["q"];
						$op->id_group= $productdatos->id_group;
						$op->precitotal= $c["q"]*$c["price_out"];
						$op->change_price_out= $c["price_out"];
						$op->discount = $c["descuento"];
						$op->operation_type_id=2;
						$op->sell_id=$s[1];
						$op->user_id = $_SESSION["user_id"];
						$add = $op->add();
					}
					//hacer un pago a credito
					if ($process == true && $s[1]!=0 && $_POST["adelanto"]==1 && $_POST["switch_2"]==1) {

						$Payment = new PaymentData();
						$Payment->user_id = $_SESSION["user_id"];
						$Payment->sell_id = $s[1];
						$Payment->payment = $_POST["cantidad_adelanto"];
						$Payment->person_id = $_POST["client_id"];
						$pago= $Payment->add();
					}

					unset($_SESSION["cart"]);
					setcookie("selled","selled");//para saver si la venta fue reciente
					$resultado = array("estado" => "true", "onesell" => $s[1]);
					//print "<script> window.location='index.php?view=onesell&id=$s[1]';</script>";
				}
			}
		}
	}
	return print(json_encode($resultado));
}
?>
