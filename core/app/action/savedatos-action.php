<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	setcookie("cliente_id", $_POST["cliente_id"],(time()+300));
		setcookie("discount",	$_POST["discount"],(time()+300));
	$resultado = array("estado" => "true" );
}
return print(json_encode($resultado));
?>
