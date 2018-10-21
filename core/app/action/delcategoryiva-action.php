<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
$category = Ivadata::getById($_POST["idc"]);
$products = ProductData::getAllByCategoryIvaId($category->id);
foreach ($products as $product) {
	$product->del_categoryiva();
}
$resultado = array("estado" => "true");
$category->del();
//Core::redir("./index.php?view=categories");
return print(json_encode($resultado));
?>
