<?php
if(isset($_GET["o"]) && $_GET["o"]=="fra"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["fraction"])){
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"] , "price_outf"=>$_GET["price_outf"]);
		$_SESSION["fraction"] = array($fraction);
		$cart = $_SESSION["fraction"];
	}else {
		$cart = $_SESSION["fraction"];
		$nc = count($cart);
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"], "price_outf"=>$_GET["price_outf"]);
		$cart[$nc] = $fraction;
		$_SESSION["fraction"] = $cart;
	}
	//	print_r($cart); //pra ver que hay en el array en forma de arbol
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));
}else if(isset($_GET["o"]) && $_GET["o"]=="main"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["presentacionmain"])){
		$fraction = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"]);
		$_SESSION["presentacionmain"] = array($fraction);
		$cart = $_SESSION["presentacionmain"];
	}
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));

}else if(isset($_GET["o"]) && $_GET["o"]=="gru"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["grupo"])){
		$grupo = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"], "price_outg"=>$_GET["price_outg"]);
		$_SESSION["grupo"] = array($grupo);
		$cart = $_SESSION["grupo"];
	}else {
		$cart = $_SESSION["grupo"];
		$nc = count($cart);
		$grupo = array("unit_id"=>$_GET["unit_id"],"q"=>$_GET["q"],"price_outg"=>$_GET["price_outg"]);
		$cart[$nc] = $grupo;
		$_SESSION["grupo"] = $cart;
	}
	$resultado = array("estado" => "true");
	return print(json_encode($resultado));
}

//saver siexiste $_SESSION["presentacionmain"]
else if(isset($_GET["o"]) && $_GET["o"]=="is"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(!isset($_SESSION["presentacionmain"])){
		$resultado = array("estado" => "true");
	}
	return print(json_encode($resultado));
}
///eliminar las presentaciones definidas
else if(isset($_GET["o"]) && $_GET["o"]=="borrar"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	if(isset($_SESSION["fraction"])){
		 unset($_SESSION["fraction"]);
	}
	if(isset($_SESSION["presentacionmain"])){
		 unset($_SESSION["presentacionmain"]);
	}
	if(isset($_SESSION["grupo"])){
		 unset($_SESSION["grupo"]);
	}
		$resultado = array("estado" => "true");
	return print(json_encode($resultado));
}
//eliminar una presentacion grupal
else if(isset($_GET["o"]) && $_GET["o"]=="cleargrupo"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "true");

	if(isset($_GET["idgrupo"])){
		$grupo=$_SESSION["grupo"];
		if(count($grupo)==1){
		 unset($_SESSION["grupo"]);
		}else{
			$ngrupo = null;
			$nx=0;
			$ny=0;
			foreach($grupo as $g){
				if($nx!=$_GET["idgrupo"]){
					$ngrupo[$ny]= $g;
					$ny++;
				}
				$nx++;
			}
			$_SESSION["grupo"] = $ngrupo;
		}
	}else{
	 unset($_SESSION["grupo"]);
	}
		return print(json_encode($resultado));
}
//eliminar una presentacion fraction
else if(isset($_GET["o"]) && $_GET["o"]=="clearfraction"){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "true");

	if(isset($_GET["idfraction"])){
		$grupo=$_SESSION["fraction"];
		if(count($grupo)==1){
		 unset($_SESSION["fraction"]);
		}else{
			$ngrupo = null;
			$nx=0;
			$ny=0;
			foreach($grupo as $g){
				if($nx!=$_GET["idfraction"]){
					$ngrupo[$ny]= $g;
					$ny++;
				}
				$nx++;
			}
			$_SESSION["fraction"] = $ngrupo;
		}
	}else{
	 unset($_SESSION["grupo"]);
	}
		return print(json_encode($resultado));
}



?>
