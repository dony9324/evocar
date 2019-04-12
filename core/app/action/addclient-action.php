<?php
//header('Content-type: application/json');
$resultado = array();
if(count($_POST)>0){
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
	 if(isset($_FILES["image"])){
	    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("res/img/");
      if($image->processed){
        $user->image = $image->file_dst_name;
        $use = $user->add_client_with_image();
      }
    }else{
  $use= $user->add_client();
    }
  }
  else{
  $use= $user->add_client();
  }
	echo "Se guardó nuevo cliente.";
}
//$resultado = array("estado" => "true");
?>
