<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	$user = CategoryData::getById($_POST["id"]);
	$user->name = $_POST["name"];
	$user->description = $_POST["descripcion"];
	$user->update();
	$resultado = array("estado" => "true");
//print "<script>window.location='index.php?view=categories';</script>";
}
return print(json_encode($resultado));
?>
