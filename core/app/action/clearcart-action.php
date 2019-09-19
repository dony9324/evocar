
<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "true");

if(isset($_GET["product_id"])){
	$cart=$_SESSION["cart"];
	if(count($cart)==1){
	 unset($_SESSION["cart"]);
	setcookie("cliente_id","",time()-18600);
	setcookie("discount","",time()-18600);
	setcookie("acreditar","",time()-18600);
	setcookie("adelanto","",time()-18600);
	setcookie("cantidad_adelanto","",time()-18600);
	setcookie("efectivo","",time()-18600);
	setcookie("entrega","",time()-18600);
	}else{
		$ncart = array();
		$nx=0;
		foreach($cart as $c){
			if($c["product_id"]!=$_GET["product_id"]){
				$ncart[$nx]= $c;
			}
			$nx++;
		}
		$_SESSION["cart"] =  array_merge($ncart);
	}
}else{
 unset($_SESSION["cart"]);
 setcookie("cliente_id","",time()-18600);
 setcookie("discount","",time()-18600);
 setcookie("acreditar","",time()-18600);
 setcookie("adelanto","",time()-18600);
 setcookie("cantidad_adelanto","",time()-18600);
 setcookie("efectivo","",time()-18600);
 setcookie("entrega","",time()-18600);
}
	return print(json_encode($resultado));
?>
