<?php
header('Content-type: application/json');
$resultado = array();
$categories = TrademarkData::getAll();
$resultado = $categories;
return print(json_encode($resultado));
?>
