<?php

if(count($_POST)>0){
	$user = PersonData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->address1 = $_POST["address1"];
	$user->phone1 = $_POST["phone1"];
	$user->update_client();


print "<script>window.location='index.php?view=clients';</script>";


}


?>