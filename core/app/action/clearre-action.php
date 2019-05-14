<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(isset($_GET["product_id"])){
	$cart=$_SESSION["reabastecer"];
	if(count($cart)==1){
	 unset($_SESSION["reabastecer"]);
	 $resultado = array("estado" => "true");
	}else{
		$ncart = null;
		$nx=0;
		foreach($cart as $c){
			if($c["product_id"]!=$_GET["product_id"]){
				$ncart[$nx]= $c;
			}
			$nx++;
		}
		$_SESSION["reabastecer"] = $ncart;
	$resultado = array("estado" => "true");
	}

}else{
 unset($_SESSION["reabastecer"]);
 $resultado = array("estado" => "true");
}
return print(json_encode($resultado));
?>
