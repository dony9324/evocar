<?php
header('Content-type: application/json');
$resultado = array();
$categories = IvaData::getAll();
$resultado = $categories;
return print(json_encode($resultado));
?>
