
<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");

if(isset($_GET["product_id"])){
	$cart=$_SESSION["cart"];
	if(count($cart)==1){
	 unset($_SESSION["cart"]);
	}else{
		$ncart = null;
		$nx=0;
		foreach($cart as $c){
			if($c["product_id"]!=$_GET["product_id"]){
				$ncart[$nx]= $c;
			}
			$nx++;
		}
		$_SESSION["cart"] = $ncart;
	}
}else{
 unset($_SESSION["cart"]);
}
	return print(json_encode($resultado));
?>