<?php
header('Content-type: application/json');
$resultado = array();
$categories = CategorycData::getAll();
$resultado = $categories;
return print(json_encode($resultado));
?>
