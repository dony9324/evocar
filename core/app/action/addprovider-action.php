<?php

if(count($_POST)>0){
	$user = new PersonData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->identity = $_POST["identity"];
	$user->address1 = $_POST["address1"];
	$user->phone1 = $_POST["phone1"];
	$user->phone2 = $_POST["phone2"];
	$user->company = $_POST["company"];
	$user->nit = $_POST["nit"];
	$user->email1 = $_POST["email1"];
	
		 if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("storage/persons/");
      if($image->processed){
        $user->image = $image->file_dst_name;
        $use = $user->add_provider_with_image();
      }
    }else{

  $use= $user->add_provider();
    }
  }
  else{
  $use= $user->add_provider();

  }
	
	
	

print "<script>window.location='index.php?view=providers';</script>";


}


?>