<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	//la operation
	$strin ="id";
	$operation = OperationData::getById($_POST[$strin]);
	//el producto de la operacion
	$product  = $operation->getProduct();
	///los registros de la bodegas uno por cada almacemaiento
	$bodega = BodegaData::getAlloperation_id($_POST["id"]);

	//recoremos los registros
foreach($bodega as $bode){
	//cambiamos la cantidad
	  $color=AlmacenamientosData::getById($bode->almacenamiento_id);

	$bode->q = $_POST[$color->id];
//actualizo el nuevo Valor
	$bode->update();
}
	$resultado = array("estado" => "true");
//print "<script>window.location='index.php?view=categories';</script>";
}
return print(json_encode($resultado));
?>
