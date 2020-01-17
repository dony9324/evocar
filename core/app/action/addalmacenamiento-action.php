<?php
if(count($_POST)>0){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	$user = new AlmacenamientosData();
	$user->name = $_POST["name"];
	$user->name_corto = $_POST["namecorto"];
	$user->location = $_POST["address1"];
	$color = array("bg-yellow", "bg-green", "bg-red", "bg-aqua");
	$users = AlmacenamientosData::getAll();
		$i=count($users);
	if(count($users)>0){
		while (4 <= $i) {
			$i= $i - 4;
		}


	}
	$user->color= $color[$i];

	$user->user_id = $_SESSION["user_id"];
	 if(isset($_FILES["image"])){
	    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("res/img/");
      if($image->processed){
        $user->image = $image->file_dst_name;
        $use = $user->add_with_image();
				$resultado = array("estado" => "true" );
      }
    }else{
  $use= $user->add();
	$resultado = array("estado" => "true" );
    }
  }
  else{
  $use= $user->add();
	$resultado = array("estado" => "true" );
  }
return print(json_encode($resultado));
}
?>
