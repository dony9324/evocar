<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	$user = new IvaData();
	$user->name = $_POST["name"];
	$user->porcentage	= $_POST["description"];
	$user->created_at = "NOW()";
	$user->user_id = $_SESSION["user_id"];
	$user->add();
	$resultado = array("estado" => "true" );
//print "<script>window.location='index.php?view=categories';</script>";
}
return print(json_encode($resultado));
?>
