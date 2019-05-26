<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	setcookie("cliente_id", $_POST["cliente_id"],(time()+600));
	setcookie("discount",	$_POST["discount"],(time()+600));
	setcookie("acreditar",	$_POST["acreditar"],(time()+600));
	setcookie("adelanto",	$_POST["adelanto"],(time()+600));
	setcookie("cantidad_adelanto",	$_POST["cantidad_adelanto"],(time()+600));
	setcookie("efectivo",	$_POST["efectivo"],(time()+600));
	setcookie("entrega",	$_POST["entrega"],(time()+600));
	$resultado = array("estado" => "true" );
}
return print(json_encode($resultado));
?>
