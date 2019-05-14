<?php
header('Content-type: application/json');
$resultado = array();
$clientes = PersonData::getClients();
$resultado = $clientes;
return print(json_encode($resultado));
?>
