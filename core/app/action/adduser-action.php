<?php

if(count($_POST)>0){
	$is_admin=0;
	if(isset($_POST["is_admin"])){$is_admin=1;}
	$user = new UserData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->identity = $_POST["identity"];
	$user->username = $_POST["username"];
	$user->is_admin=$is_admin;
	$user->password = sha1(md5($_POST["password"]));



if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("storage/persons/");
      if($image->processed){
        $user->image = $image->file_dst_name;
        $use = $user->add_user_with_image();
      }
    }else{

  $use= $user->add();
    }
  }
  else{
  $use= $user->add();

  }
  




print "<script>window.location='index.php?action=users';</script>";


}


?>