<?php
header('Content-type: application/json');
$resultado = array();
$categories = CategoryData::getAll();
$resultado = $categories;
return print(json_encode($resultado));
?>
