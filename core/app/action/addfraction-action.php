<?php
if(isset($_GET["o"]) && $_GET["o"]=="fra"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["fraction"])){
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$_SESSION["fraction"] = array($fraction);
		$cart = $_SESSION["fraction"];
	}else {
		$cart = $_SESSION["fraction"];
		$nc = count($cart);
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$cart[$nc] = $fraction;
		$_SESSION["fraction"] = $cart;
	}
	//	print_r($cart); //pra ver que hay en el array en forma de arbol
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));
}else if(isset($_GET["o"]) && $_GET["o"]=="main"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["presentacionmain"])){
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$_SESSION["presentacionmain"] = array($fraction);
		$cart = $_SESSION["presentacionmain"];
	}
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));

}else if(isset($_GET["o"]) && $_GET["o"]=="gru"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["grupo"])){
		$grupo = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$_SESSION["grupo"] = array($grupo);
		$cart = $_SESSION["grupo"];
	}else {
		$cart = $_SESSION["grupo"];
		$nc = count($cart);
		$grupo = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$cart[$nc] = $grupo;
		$_SESSION["grupo"] = $cart;
	}
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));
}

//saver siexiste $_SESSION["presentacionmain"]
else if(isset($_GET["o"]) && $_GET["o"]=="is"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["presentacionmain"])){
		$resultado = array("estado" => "true");
	}
	return print(json_encode($resultado));
}
?>
