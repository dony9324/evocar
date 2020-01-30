<?php
if(count($_POST)>0){
	header('Content-type: application/json');
	$resultado = array();
	$resultado = array("estado" => "false");
	$user = new TransaccionesData();
	$user->cuenta_id = $_POST["cuenta_id"];
	$user->type = ((int)$_POST["switch_2"] + 1);//1=salida de dinero 2=regreso
	$user->money = $_POST["efectivo"];
	///que chicharron el de las fechas tengo que hacer un tutorial de como resolvi esto de dar formato a la fechas y las horas a datetime
	$time = $_POST["hora"];
	$new_time = DateTime::createFromFormat('h:i A', $time); //lo combertimos en objeto datetime
	$time_24 = $new_time->format('H:i:s');//cambiamos el formato de 12 a 24 horas
	$datetime = $_POST["fecha"];//resivimos la fecha
	$fecha = $datetime." ".$time_24;//comcatenamos la fecha y la hora
	$fecha2 = DateTime::createFromFormat('Y-m-d H:i:s', $fecha); //lo combertimos en objeto datetime
	$user->fecha = $fecha2->format('Y-m-d H:i:s');//le damos format para que no sea un objeto sino una fecha y hora porque no se puede guardar objetos en la base de datos solo cadenas de texto.
	$user->person = $_POST["acredor"];
	if ($_POST["category_id"]!="") {///SI SE MANDA ESTE CAMPO VASIO NO SE GUARDA EL REGISTRO SQL
	$user->categoria = $_POST["category_id"];
}else {
	$user->categoria = 0;
}

	$user->notas = $_POST["nota"];
	$user->user_id = $_SESSION["user_id"];
	$hora_local= time(); //hora local del sistema servidor
	$user->created_at = date('Y-m-d H:i:s',time());//le damos format para que no sea un objeto sino una fecha y hora porque no se puede guardar objetos en la base de datos solo cadenas de texto.
  $use= $user->add();
	$resultado = array("estado" => "true", "fecha" => $user->created_at );
	return print(json_encode($resultado));
}
?>
