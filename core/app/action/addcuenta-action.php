<?php
if(count($_POST)>0){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	$user = new CuentasData();
	$user->name = $_POST["name"];
	$user->saldo_inicial = $_POST["saldo_inicial"];
	$user->user_id = $_SESSION["user_id"];
  $use= $user->add();
	$resultado = array("estado" => "true" );
	return print(json_encode($resultado));
}
?>
