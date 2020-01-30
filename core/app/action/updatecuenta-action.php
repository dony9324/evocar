<?php
if(count($_POST)>0){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	$user = CuentasData::getById($_POST["id"]);
	$user->name = $_POST["name"];
	$user->update();
	$resultado = array("estado" => "true" );
	return print(json_encode($resultado));
}


?>
