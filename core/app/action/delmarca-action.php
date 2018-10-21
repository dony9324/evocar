<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
$category = TrademarkData::getById($_POST["idc"]);
$products = ProductData::getAllByCategoryId($category->id);
foreach ($products as $product) {
	$product->del_trademark();
}
$resultado = array("estado" => "true");
$category->del();
//Core::redir("./index.php?view=categories");
return print(json_encode($resultado));
?>
