<?php
if(count($_POST)>0){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	$user = new PersonData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->identity = $_POST["identity"];
	$user->address1 = $_POST["address1"];
	$user->email1 = $_POST["email1"];
	$user->phone1 = $_POST["phone1"];
	$user->phone2 = $_POST["phone2"];
	$user->company = $_POST["company"];
	$user->nit = $_POST["nit"];
	$user->user_id = $_SESSION["user_id"];
	 if(isset($_FILES["image"])){
	    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("res/img/");
      if($image->processed){
        $user->image = $image->file_dst_name;
        $use = $user->add_client_with_image();
				$resultado = array("estado" => "true" );
      }
    }else{
  $use= $user->add_client();
	$resultado = array("estado" => "true" );
    }
  }
  else{
  $use= $user->add_client();
	$resultado = array("estado" => "true" );
  }
return print(json_encode($resultado));
}
?>
