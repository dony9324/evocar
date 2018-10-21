<?php

if(count($_POST)>0){
	$user = CompanyData::getById($_POST["user_id"]);
	$user->value = $_POST["value"];
	$user->update();
print "<script>window.location='index.php?view=settings';</script>";


}


?>