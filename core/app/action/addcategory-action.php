<?php
header('Content-type: application/json');
$resultado = array();
$resultado = array("estado" => "false");
if(count($_POST)>0){
	$user = new CategoryData();
	$user->name = $_POST["name"];

	$user->description	= $_POST["description"];
	$user->created_at = "NOW()";
	$user->user_id = $_SESSION["user_id"];
	if (isset($_POST["abbreviation"])) {
	$user->abbreviation = $_POST["abbreviation"];
	$user->add2();
}else{
		$user->add();
}

	$resultado = array("estado" => "true" );
//print "<script>window.location='index.php?view=categories';</script>";
}
return print(json_encode($resultado));
?>
